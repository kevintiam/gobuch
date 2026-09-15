import NextAuth from "next-auth";
import CredentialsProvider from "next-auth/providers/credentials";
import { prisma } from "./prisma";
import { findUser } from "@/data/mockData";

// Repli de developpement : sans base joignable, on authentifie sur les comptes
// de data/mockData.ts pour pouvoir parcourir l'interface. Jamais en production.
function authorizeMock(identifiant, motpasse) {
  const user = findUser(identifiant, motpasse);
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

export const { handlers, signIn, signOut, auth } = NextAuth({
  providers: [
    CredentialsProvider({
      name: "Credentials",
      credentials: {
        nomuser: { label: "Nom d'utilisateur ou email", type: "text" },
        motpasse: { label: "Mot de passe", type: "password" },
      },
      // Le role n'est plus demande a la connexion : il est deduit du compte
      // trouve. Il est fixe a la creation du compte.
      async authorize(credentials) {
        const identifiant = credentials?.nomuser;
        const motpasse = credentials?.motpasse;
        if (!identifiant || !motpasse) return null;

        try {
          const user = await prisma.utilisateur.findUnique({
            where: { nomuser: identifiant },
            include: { enseignant: true },
          });

          if (user) {
            if (user.motpasse !== motpasse) return null;
            return {
              id: String(user.idutilisateur),
              name: `${user.prenom} ${user.nom}`,
              email: user.nomuser,
              role: user.enseignant ? "enseignant" : "eleve",
            };
          }

          // Aucun utilisateur sous ce nom : ce peut etre un administrateur,
          // identifie par son email.
          const admin = await prisma.admin.findUnique({
            where: { emailadm: identifiant },
          });

          if (admin && admin.mtpadm === motpasse) {
            return {
              id: String(admin.idamin),
              name: admin.emailadm,
              email: admin.emailadm,
              role: "admin",
            };
          }

          return null;
        } catch (erreur) {
          // En production, une base injoignable doit remonter comme une panne,
          // pas se transformer en connexion sur des comptes fictifs.
          if (process.env.NODE_ENV === "production") throw erreur;
          return authorizeMock(identifiant, motpasse);
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
        session.user.id = token.id;
      }
      return session;
    },
  },
  pages: {
    signIn: "/login",
  },
  session: { strategy: "jwt" },
});
