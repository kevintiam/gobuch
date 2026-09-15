import type { DefaultSession } from "next-auth";

// Le callback session() dans lib/auth.js ajoute role et id : on le declare ici
// pour que les composants puissent les lire sans cast.
declare module "next-auth" {
  interface Session {
    user: {
      role?: string;
      id?: string;
    } & DefaultSession["user"];
  }
}
