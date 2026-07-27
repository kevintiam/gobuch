import { NextResponse } from "next/server";
import { prisma } from "@/lib/prisma";
import { auth } from "@/lib/auth";

export async function GET() {
  const session = await auth();
  if (!session) return NextResponse.json({ error: "Non autorisé" }, { status: 401 });

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
