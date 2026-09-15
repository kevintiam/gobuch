import { NextResponse } from "next/server";
import { prisma } from "@/lib/prisma";
import { guardApi } from "@/lib/guards";

export async function GET(_req, { params }) {
  const { error } = await guardApi("admin");
  if (error) return error;

  const { id } = await params;
  const tuteur = await prisma.enseignant.findUnique({
    where: { idutilisateur: Number(id) },
    include: {
      utilisateur: true,
      ensmatclas: { include: { matiere: true, classe: true } },
      estsollicitee: {
        include: { demande: { include: { utilisateur: true } }, matiere: true, seances: true },
        orderBy: { idestsollicitee: "desc" },
      },
    },
  });

  if (!tuteur) return NextResponse.json({ error: "Tuteur introuvable" }, { status: 404 });
  return NextResponse.json(tuteur);
}

export async function PATCH(req, { params }) {
  // Un administrateur modifie n'importe quelle fiche ; un enseignant ne peut
  // modifier que la sienne.
  const { error, session, role } = await guardApi("admin", "enseignant");
  if (error) return error;

  const { id } = await params;
  if (role === "enseignant" && String(session.user?.id) !== String(id)) {
    return NextResponse.json({ error: "Accès refusé" }, { status: 403 });
  }

  const body = await req.json();
  const { dispo, ville, quartier } = body;

  const updated = await prisma.enseignant.update({
    where: { idutilisateur: Number(id) },
    data: {
      ...(dispo !== undefined && { dispo }),
      ...(ville !== undefined && { ville }),
      ...(quartier !== undefined && { quartier }),
    },
  });

  return NextResponse.json(updated);
}
