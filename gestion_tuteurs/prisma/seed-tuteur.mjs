/**
 * Cree (ou met a jour) un compte tuteur pour tester la connexion.
 *
 *   node --env-file=.env prisma/seed-tuteur.mjs
 *   node --env-file=.env prisma/seed-tuteur.mjs autre@mail.com MonPass123
 *
 * Le script est idempotent : relance-le autant de fois que necessaire, il
 * remet simplement le mot de passe et les informations a jour.
 */
import { PrismaClient } from "@prisma/client";
import { hash } from "bcryptjs";

const prisma = new PrismaClient();

const EMAIL = process.argv[2] ?? "tuteur@gobuch.cm";
const MOT_DE_PASSE = process.argv[3] ?? "Tuteur123";

// Le cout 10 est le compromis habituel : assez lent pour resister au
// bourrinage, assez rapide pour ne pas penaliser la connexion.
const COUT_BCRYPT = 10;

async function main() {
  const passwordHash = await hash(MOT_DE_PASSE, COUT_BCRYPT);

  // 1. Le compte : role TUTOR, c'est lui qui pilote la redirection apres
  //    connexion (ROLE_APP dans lib/auth.ts le traduit en "enseignant").
  const user = await prisma.user.upsert({
    where: { email: EMAIL },
    update: { passwordHash, role: "TUTOR", isActive: true },
    create: {
      email: EMAIL,
      passwordHash,
      role: "TUTOR",
      lastName: "Nkouaga",
      firstName: "Kevin",
      phone: "+237 6 99 00 00 00",
      whatsapp: "+237 6 99 00 00 00",
    },
  });

  // 2. La fiche tuteur, en relation 1-1 avec le compte.
  await prisma.tutor.upsert({
    where: { userId: user.id },
    update: {},
    create: {
      userId: user.id,
      bio: "Tuteur en mathematiques et physique, trois ans d'experience.",
      city: "Douala",
      district: "Bonapriso",
      availability: "Lundi au vendredi, 16h - 19h",
      isVerified: true,
      verifiedAt: new Date(),
    },
  });

  console.log("Compte tuteur pret :");
  console.log("  email        :", EMAIL);
  console.log("  mot de passe :", MOT_DE_PASSE);
  console.log("  id           :", user.id);
  console.log("  role         :", user.role, "-> redirige vers /tuteur");
}

main()
  .catch((erreur) => {
    console.error("Echec :", erreur.message);
    process.exitCode = 1;
  })
  .finally(() => prisma.$disconnect());
