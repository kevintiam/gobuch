import { NextResponse } from "next/server";
import { prisma } from "@/lib/prisma";
import { auth } from "@/lib/auth";

export async function GET(_req, { params }) {
  const session = await auth();
  if (!session) return NextResponse.json({ error: "Non autorisé" }, { status: 401 });

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
  const session = await auth();
  if (!session) return NextResponse.json({ error: "Non autorisé" }, { status: 401 });

  const { id } = await params;
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
