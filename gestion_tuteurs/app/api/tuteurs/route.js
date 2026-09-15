import { NextResponse } from "next/server";
import { prisma } from "@/lib/prisma";
import { guardApi } from "@/lib/guards";

export async function GET() {
  const { error } = await guardApi("admin");
  if (error) return error;

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
