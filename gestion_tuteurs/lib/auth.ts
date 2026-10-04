import NextAuth from "next-auth";
import CredentialsProvider from "next-auth/providers/credentials";
import { compare } from "bcryptjs";

import { prisma } from "./prisma";
import { findUser } from "@/data/mockData";
import type { Role } from "./roles";
import { authConfig } from "./auth.config";


const ROLE_APP: Record<string, Role> = {
  STUDENT: "eleve",
  TUTOR: "tutor",
  ADMIN: "admin",
};

/**
 * Repli sur les donnees de demonstration quand la base est injoignable.
 * Reserve au developpement : en production une panne doit remonter.
 */
const authorizeMock = (email: string, password: string) => {
  const user = findUser(email, password);
  if (!user) return null;

  console.warn(
    "[auth] base de donnees injoignable : connexion via les donnees de demonstration",
  );

  return {
    id: String(user.idutilisateur),
    name: `${user.prenom} ${user.nom}`,
    email: user.email,
    role: user.role,
  };
}

// ---------------------------------------------------------------------------
// Limitation des tentatives de connexion
//
// Compteur en memoire du processus : il protege contre le bourrinage d'un
// compte depuis un poste, mais il est remis a zero a chaque redemarrage et
// n'est pas partage entre instances.
// ---------------------------------------------------------------------------
const MAX_TENTATIVES = 5;
const FENETRE_MS = 15 * 60 * 1000;

const tentatives = new Map<string, { nombre: number; expireA: number }>();

const estBloque=(cle: string) => {
  const entree = tentatives.get(cle);
  if (!entree) return false;
  if (Date.now() > entree.expireA) {
    tentatives.delete(cle);
    return false;
  }
  return entree.nombre >= MAX_TENTATIVES;
}

const enregistrerEchec=(cle: string) => {
  const maintenant = Date.now();
  const entree = tentatives.get(cle);

  if (!entree || maintenant > entree.expireA) {
    tentatives.set(cle, { nombre: 1, expireA: maintenant + FENETRE_MS });
    return;
  }
  entree.nombre += 1;

  if (tentatives.size > 5000) {
    for (const [autreCle, valeur] of tentatives) {
      if (maintenant > valeur.expireA) tentatives.delete(autreCle);
    }
  }
}

export const { handlers, signIn, signOut, auth } = NextAuth({
  ...authConfig,
  providers: [
    CredentialsProvider({
      name: "Credentials",
      credentials: {
        email: { label: "Email", type: "text" },
        password: { label: "Mot de passe", type: "password" },
      },
      async authorize(credentials) {
        const email =
          typeof credentials?.email === "string" ? credentials.email : "";
        const password =
          typeof credentials?.password === "string" ? credentials.password : "";
        if (!email || !password) return null;

        const cle = email.trim().toLowerCase();
        if (estBloque(cle)) {
          console.warn(`[auth] trop de tentatives pour ${cle}`);
          return null;
        }

        try {
          const user = await prisma.user.findUnique({ where: { email } });
          if (!user || !user.isActive) {
            enregistrerEchec(cle);
            return null;
          }

          const motDePasseValide = await compare(password, user.passwordHash);
          if (!motDePasseValide) {
            enregistrerEchec(cle);
            return null;
          }

          // Connexion reussie : le compteur repart de zero.
          tentatives.delete(cle);

          return {
            id: String(user.id),
            name: `${user.firstName} ${user.lastName}`,
            email: user.email,
            role: ROLE_APP[user.role],
          };
        } catch (erreur) {
          if (process.env.NODE_ENV === "production") throw erreur;

          const utilisateurFictif = authorizeMock(email, password);
          if (!utilisateurFictif) enregistrerEchec(cle);
          else tentatives.delete(cle);
          return utilisateurFictif;
        }
      },
    }),
  ],
  callbacks: {
    jwt({ token, user }) {
      if (user) {
        token.role = user.role;
        token.id = user.id;
      }
      return token;
    },
    session({ session, token }) {
      if (session.user) {
        session.user.role = token.role;
        if (token.id) session.user.id = token.id;
      }
      return session;
    },
  },
  pages: {
    signIn: "/login",
  },
  session: { strategy: "jwt" },
});
