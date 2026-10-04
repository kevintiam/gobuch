import { PrismaClient } from "@prisma/client";

// globalThis n'est pas typé : sans ce cast, `globalForPrisma.prisma` vaut
// `any`, et l'operateur ?? propage ce `any` a l'export. Tout le client Prisma
// devient alors non typé dans l'application entiere.
const globalForPrisma = globalThis as unknown as {
  prisma: PrismaClient | undefined;
};

// Une seule instance en developpement : le rechargement a chaud recree le
// module a chaque edition, ce qui ouvrirait une connexion de plus a chaque fois.
export const prisma =
  globalForPrisma.prisma ??
  new PrismaClient({
    log:
      process.env.NODE_ENV === "development"
        ? ["query", "error", "warn"]
        : ["error"],
  });

if (process.env.NODE_ENV !== "production") globalForPrisma.prisma = prisma;
