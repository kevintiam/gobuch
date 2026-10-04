import { NextRequest, NextResponse } from "next/server";
import { prisma } from "@/lib/prisma";
import { guardApi } from "@/lib/guards";

type RouteContext = {
  params: Promise<{
    id: string;
  }>;
};

// Seules reponses possibles du tuteur : une candidature ne revient jamais
// a PENDING.
const REPONSES = ["ACCEPTED", "DECLINED"] as const;
type Reponse = (typeof REPONSES)[number];

const estReponse = (valeur: unknown): valeur is Reponse =>
  REPONSES.includes(valeur as Reponse);

/** Le tuteur connecte accepte ou refuse une de SES candidatures en attente. */
export async function PATCH(request: NextRequest, context: RouteContext) {
  try {
    const garde = await guardApi("tutor");
    if ("error" in garde) return garde.error;

    const tutorId = Number(garde.session.user?.id);
    if (!Number.isInteger(tutorId) || tutorId <= 0) {
      return NextResponse.json({ message: "Session invalide." }, { status: 401 });
    }

    const { id } = await context.params;
    const applicationId = Number(id);
    if (!Number.isInteger(applicationId) || applicationId <= 0) {
      return NextResponse.json(
        { message: "Identifiant de candidature invalide." },
        { status: 400 },
      );
    }

    const body = await request.json().catch(() => null);
    const status = body?.status;
    if (!estReponse(status)) {
      return NextResponse.json(
        { message: "Statut invalide : ACCEPTED ou DECLINED attendu." },
        { status: 400 },
      );
    }

    // Filtrer sur tutorId : un tuteur ne doit pas pouvoir repondre a la
    // place d'un autre en changeant l'identifiant dans l'URL.
    const candidature = await prisma.tutorApplication.findFirst({
      where: { id: applicationId, tutorId },
      select: { status: true, request: { select: { status: true } } },
    });

    if (!candidature) {
      return NextResponse.json(
        { message: "Candidature introuvable." },
        { status: 404 },
      );
    }

    if (candidature.request.status !== "OPEN") {
      return NextResponse.json(
        { message: "Cette demande n'est plus ouverte." },
        { status: 409 },
      );
    }

    // La condition status: "PENDING" dans la mise a jour elle-meme evite
    // qu'une double soumission (deux clics, deux onglets) ne repasse dessus.
    const { count } = await prisma.tutorApplication.updateMany({
      where: { id: applicationId, tutorId, status: "PENDING" },
      data: { status, reviewedAt: new Date() },
    });

    if (count === 0) {
      return NextResponse.json(
        { message: "Vous avez déjà répondu à cette demande." },
        { status: 409 },
      );
    }

    return NextResponse.json({ id: applicationId, status }, { status: 200 });
  } catch (error) {
    console.error("Erreur lors de la mise à jour de la candidature :", error);

    return NextResponse.json(
      { message: "Une erreur est survenue pendant la mise à jour." },
      { status: 500 },
    );
  }
}
