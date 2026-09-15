import Link from "next/link";
import LoginCard from "@/components/auth/LoginCard";

export const metadata = {
  title: "Connexion — Gobuch",
};

// Ecran de connexion des eleves. Le tuteur a le sien : app/login/tuteur.
export default function LoginPage() {
  return (
    <LoginCard
      pageBg="#F8FAFC"
      gradient="linear-gradient(135deg, #2D4DB4, #4a6dd8)"
      title="Bon retour parmi nous 👋"
      subtitle="Connecte-toi pour reprendre tes révisions"
      identifierLabel="Nom d'utilisateur ou e-mail"
      showSocialLogins
      footerSlot={
        <>
          <p className="text-center text-sm text-slate-500 mt-6">
            Pas encore de compte ?{" "}
            <Link
              href="/register"
              className="font-black text-brand-700 hover:text-brand-900 transition-colors"
            >
              S&apos;inscrire gratuitement
            </Link>
          </p>
          <p className="text-center text-sm text-slate-400 mt-3">
            Tu es tuteur ?{" "}
            <Link
              href="/login/tuteur"
              className="font-bold text-slate-600 hover:text-brand-700 transition-colors"
            >
              Espace tuteurs
            </Link>
          </p>
        </>
      }
    />
  );
}
