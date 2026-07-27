import { NextResponse } from "next/server";
import { prisma } from "@/lib/prisma";
import { auth } from "@/lib/auth";

export async function GET() {
  const session = await auth();
  if (!session) return NextResponse.json({ error: "Non autorisé" }, { status: 401 });

  const demandes = await prisma.demande.findMany({
    include: {
      utilisateur: { select: { idutilisateur: true, nom: true, prenom: true } },
      classe: true,
      estsollicitee: {
        include: {
          enseignant: { include: { utilisateur: { select: { nom: true, prenom: true } } } },
          matiere: true,
        },
      },
    },
    orderBy: { idemande: "desc" },
  });

  return NextResponse.json(demandes);
}
