import { NextResponse } from "next/server";
import { prisma } from "@/lib/prisma";
import { guardApi } from "@/lib/guards";

export async function GET() {
  const { error } = await guardApi("admin");
  if (error) return error;

  const seances = await prisma.seance.findMany({
    include: {
      estsollicitee: {
        include: {
          enseignant: { include: { utilisateur: { select: { nom: true, prenom: true } } } },
          demande: { include: { utilisateur: { select: { nom: true, prenom: true } } } },
          matiere: true,
        },
      },
    },
    orderBy: { idseance: "desc" },
  });

  return NextResponse.json(seances);
}
