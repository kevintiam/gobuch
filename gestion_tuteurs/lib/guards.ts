// Controle d'acces par role, en un seul endroit.
//
// La session seule ne suffit pas : /tuteurs, /demandes et /seances listent
// TOUS les tuteurs, toutes les demandes et tous les montants. Un simple
// `if (!session)` laisse passer n'importe quel eleve connecte.
import { redirect } from "next/navigation";
import { NextResponse } from "next/server";

import { auth } from "./auth";
import { homeForRole, type Role } from "./roles";

function roleDe(session: unknown): Role | null {
  const role = (session as { user?: { role?: string } } | null)?.user?.role;
  return role === "eleve" || role === "enseignant" || role === "admin"
    ? role
    : null;
}

/**
 * A appeler en tete d'une page serveur. Renvoie la session si le role est
 * autorise, sinon redirige : vers /login si personne n'est connecte, vers
 * l'espace du role sinon (jamais une page blanche ni un acces silencieux).
 */
export async function requireRole(...roles: Role[]) {
  const session = await auth();
  if (!session) redirect("/login");

  const role = roleDe(session);
  if (!role || !roles.includes(role)) redirect(homeForRole(role));

  return session;
}

/**
 * Equivalent pour les routes d'API : renvoie soit `{ session }`, soit
 * `{ error }` a retourner tel quel. Sans ce controle, un fetch direct
 * contourne entierement les gardes des pages.
 */
export async function guardApi(...roles: Role[]) {
  const session = await auth();
  if (!session) {
    return {
      error: NextResponse.json({ error: "Non autorisé" }, { status: 401 }),
    };
  }

  const role = roleDe(session);
  if (!role || !roles.includes(role)) {
    return {
      error: NextResponse.json({ error: "Accès refusé" }, { status: 403 }),
    };
  }

  return { session, role };
}
