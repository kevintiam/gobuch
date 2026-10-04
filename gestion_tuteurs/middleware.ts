import NextAuth from "next-auth";
import { authConfig } from "@/lib/auth.config";

/**
 * Filet de securite : toute route listee dans `matcher` exige une session,
 * meme si la page oublie d'appeler requireRole().
 *
 * Le middleware ne verifie QUE la presence d'une session, pas le role : il
 * n'a pas acces a la base. Le controle fin reste dans requireRole(), qui
 * redirige un eleve arrivant sur /tuteur vers son propre espace.
 */
export const { auth: middleware } = NextAuth(authConfig);

export const config = {
  matcher: [
    "/tuteur/:path*",
    "/eleve/:path*",
    "/tuteurs/:path*",
    "/demandes/:path*",
    "/seances/:path*",
  ],
};
