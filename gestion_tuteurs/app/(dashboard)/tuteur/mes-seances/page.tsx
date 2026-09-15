import { FiCalendar } from "react-icons/fi";

import StatutBadge from "@/components/dashboard/StatutBadge";
import { getTuteurDashboard } from "@/data/selectors";
import type { Seance } from "@/data/mockData";
import PageTitle from "@/components/dashboard/PageTitle";
import { requireRole } from "@/lib/guards";
import { fcfa, formatDate } from "@/lib/format";

// Les seances du tuteur connecte uniquement. A ne pas confondre avec /seances,
// qui liste celles de tout le monde et reste reservee a l'administration.

function Liste({ seances }: { seances: Seance[] }) {
  if (seances.length === 0) {
    return <p className="text-sm text-gray-400 py-4">Aucune séance.</p>;
  }

  return (
    <ul className="divide-y divide-gray-100">
      {seances.map((s) => (
        <li
          key={s.idseance}
          className="flex flex-wrap items-center gap-x-4 gap-y-2 py-3"
        >
          <FiCalendar className="w-4 h-4 text-gray-400 flex-shrink-0" />
          <div className="flex-1 min-w-[14rem]">
            <p className="text-sm font-medium text-gray-900">
              {s.estsollicitee.matiere.nomatiere} ·{" "}
              {s.estsollicitee.demande.utilisateur.prenom}{" "}
              {s.estsollicitee.demande.utilisateur.nom}
            </p>
            <p className="text-xs text-gray-500">
              {formatDate(s.dateseance)} · {s.heuredeb} → {s.heurefin} ({s.duree})
            </p>
          </div>
          <span className="text-sm font-semibold text-gray-900">
            {fcfa(s.total)}
          </span>
          <StatutBadge decision={s.decisionsea} />
        </li>
      ))}
    </ul>
  );
}

export default async function MesSeancesPage() {
  const session = await requireRole("enseignant");
  const data = getTuteurDashboard(Number(session.user?.id));

  if (!data) {
    return (
      <p className="text-gray-500">
        Aucune fiche tuteur pour le compte connecté.
      </p>
    );
  }

  const { seancesAVenir, seancesPassees } = data;

  return (
    <div>
      <PageTitle
        titre="Mes séances"
        sousTitre={`${seancesAVenir.length} à venir · ${seancesPassees.length} passée(s)`}
      />

      <section className="rounded-2xl border border-slate-200/70 bg-white shadow-sm shadow-slate-200/50 p-6">
        <h2 className="font-semibold text-gray-900 mb-4">À venir</h2>
        <Liste seances={seancesAVenir} />
      </section>

      <section className="mt-6 rounded-2xl border border-slate-200/70 bg-white shadow-sm shadow-slate-200/50 p-6">
        <h2 className="font-semibold text-gray-900 mb-4">Historique</h2>
        <Liste seances={seancesPassees} />
      </section>
    </div>
  );
}
