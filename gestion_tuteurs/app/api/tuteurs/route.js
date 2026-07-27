import { NextResponse } from "next/server";
import { prisma } from "@/lib/prisma";
import { auth } from "@/lib/auth";

export async function GET() {
  const session = await auth();
  if (!session) return NextResponse.json({ error: "Non autorisé" }, { status: 401 });

  const tuteurs = await prisma.enseignant.findMany({
    include: {
      utilisateur: {
        select: { idutilisateur: true, nom: true, prenom: true, numtelsimpl: true, numtelwh: true },
      },
      ensmatclas: {
        include: { matiere: true, classe: true },
      },
    },
  });

  return NextResponse.json(tuteurs);
}
