import Link from "next/link";
import LoginCard from "@/components/auth/LoginCard";

export const metadata = {
  title: "Espace tuteurs — Gobuch",
};

export default function LoginTuteurPage() {
  return (
    <LoginCard
      pageBg="#0c1847"
      gradient="linear-gradient(135deg, #0c1847, #2D4DB4)"
      title="Espace tuteurs 👩‍🏫"
      subtitle="Retrouve tes élèves, tes demandes et tes séances."
      identifierLabel="Nom d'utilisateur ou e-mail professionnel"
      emailPlaceholder="nomutilisateur ou adresse e-mail"
      footerSlot={
        <>
          <p className="text-center text-sm text-slate-500 mt-6">
            Pas encore de compte tuteur ? Les accès sont créés par
            l&apos;administration {" "}
            <a
              href="mailto:contact@gobuch.cm"
              className="font-bold text-brand-700 hover:text-brand-900 transition-colors"
            >
              nous contacter
            </a>
            .
          </p>
          <p className="text-center text-sm text-slate-400 mt-3">
            Tu es élève ?{" "}
            <Link
              href="/login"
              className="font-bold text-slate-600 hover:text-brand-700 transition-colors"
            >
              Connexion élève
            </Link>
          </p>
        </>
      }
    />
  );
}
