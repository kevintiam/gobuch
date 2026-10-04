import type { NextAuthConfig } from "next-auth";

/**
 * Partie de la configuration utilisable dans le middleware.
 *
 * Le middleware s'execute sur l'Edge Runtime, ou Prisma et bcrypt ne peuvent
 * pas tourner. Ce fichier ne doit donc importer NI l'un NI l'autre : il ne
 * contient que ce qui sait fonctionner a partir du seul cookie de session.
 * Les providers sont ajoutes dans lib/auth.ts, cote Node.
 */
export const authConfig = {
  providers: [],
  pages: {
    signIn: "/login",
  },
  session: { strategy: "jwt" },
  callbacks: {
    // Appele par le middleware pour chaque requete correspondant au matcher.
    // Renvoyer false declenche une redirection vers pages.signIn.
    authorized({ auth }) {
      return Boolean(auth?.user);
    },
  },
} satisfies NextAuthConfig;
