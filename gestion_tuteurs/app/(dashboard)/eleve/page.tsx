import Link from "next/link";
import { FiCompass } from "react-icons/fi";

import PageTitle from "@/components/dashboard/PageTitle";
import { requireRole } from "@/lib/guards";

// Place d'attente : les eleves avaient jusqu'ici /tuteurs comme destination de
// connexion, c'est-a-dire la liste de tous les tuteurs avec leurs numeros de
// telephone. Ils atterrissent maintenant ici.
export default async function EleveDashboardPage() {
  const session = await requireRole("eleve");
  const prenom = session.user?.name?.split(" ")[0] ?? "";

  return (
    <div>
      <PageTitle
        titre={`Bonjour ${prenom} 👋`}
        sousTitre="Ton espace de révision arrive bientôt."
      />

      <div className="rounded-2xl border border-slate-200/70 bg-white shadow-sm shadow-slate-200/50 p-8 text-center">
        <FiCompass className="w-10 h-10 mx-auto text-gray-300 mb-4" />
        <p className="font-medium text-gray-700">Espace élève en construction</p>
        <p className="text-sm text-gray-500 mt-1 max-w-md mx-auto">
          Les cours, les défis et le suivi de tes séances de tutorat
          apparaîtront ici.
        </p>
        <Link
          href="/"
          className="inline-block mt-6 text-sm font-semibold text-brand-700 hover:text-brand-900 transition-colors"
        >
          Retour à l&apos;accueil
        </Link>
      </div>
    </div>
  );
}
