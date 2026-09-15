import { NextResponse } from "next/server";
import { prisma } from "@/lib/prisma";
import { guardApi } from "@/lib/guards";

export async function GET() {
  const { error } = await guardApi("admin");
  if (error) return error;

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
