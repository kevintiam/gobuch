import NextAuth from "next-auth";
import CredentialsProvider from "next-auth/providers/credentials";
import { prisma } from "./prisma";

export const { handlers, signIn, signOut, auth } = NextAuth({
  providers: [
    CredentialsProvider({
      name: "Credentials",
      credentials: {
        nomuser: { label: "Nom d'utilisateur", type: "text" },
        motpasse: { label: "Mot de passe", type: "password" },
        role: { label: "Rôle", type: "text" },
      },
      async authorize(credentials) {
        if (!credentials?.nomuser || !credentials?.motpasse) return null;

        const role = credentials.role;

        if (role === "admin") {
          const admin = await prisma.admin.findUnique({
            where: { emailadm: credentials.nomuser },
          });
          if (admin && admin.mtpadm === credentials.motpasse) {
            return {
              id: String(admin.idamin),
              name: admin.emailadm,
              email: admin.emailadm,
              role: "admin",
            };
          }
          return null;
        }

        const user = await prisma.utilisateur.findUnique({
          where: { nomuser: credentials.nomuser },
          include: { enseignant: true },
        });

        if (!user || user.motpasse !== credentials.motpasse) return null;

        return {
          id: String(user.idutilisateur),
          name: `${user.prenom} ${user.nom}`,
          email: user.nomuser,
          role: user.enseignant ? "enseignant" : "eleve",
        };
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
