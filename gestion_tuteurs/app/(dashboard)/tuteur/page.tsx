import { requireRole } from "@/lib/guards";
import StatutBadge from "@/components/dashboard/StatutBadge";
import { getTuteurDashboard } from "@/data/selectors";
import { fcfa, formatDate } from "@/lib/format";
import {
  FiInbox,
  FiClock,
  FiCheckCircle,
  FiDollarSign,
  FiMapPin,
  FiCalendar,
} from "react-icons/fi";

// Tableau de bord d'un tuteur : ce qui le concerne lui, par opposition a
// /tuteurs qui liste tous les tuteurs pour l'administration.
// Les donnees viennent encore de data/mockData.ts, le temps de valider les
// informations a afficher.

function Stat({
  icon,
  label,
  value,
}: {
  icon: React.ReactNode;
  label: string;
  value: string;
}) {
  return (
    <div className="rounded-2xl border border-slate-200/70 bg-white shadow-sm shadow-slate-200/50 p-5">
      <div className="flex items-center gap-2 text-gray-400 mb-2">
        {icon}
        <p className="text-xs uppercase tracking-wide font-medium">{label}</p>
      </div>
      <p className="text-2xl font-bold text-gray-900">{value}</p>
    </div>
  );
}

export default async function TuteurDashboardPage() {
  const session = await requireRole("enseignant");
  const data = getTuteurDashboard(Number(session?.user?.id));

  if (!data) {
    return (
      <div className="text-center py-16 text-gray-400">
        <p className="font-medium text-gray-600">Aucune fiche tuteur</p>
        <p className="text-sm mt-1">
          Le compte connecté (id {session?.user?.id ?? "?"}) n&apos;a pas de
          fiche enseignant dans les données de démonstration.
        </p>
      </div>
    );
  }

  const { tuteur, matieres, classes, sollicitations, seancesAVenir, stats } = data;
  const u = tuteur.utilisateur;

  return (
    <div>
      {/* En-tete */}
      <div className="flex items-start gap-4 mb-8">
        <div className="w-14 h-14 rounded-full bg-brand-100 flex items-center justify-center text-brand-600 font-bold text-xl flex-shrink-0">
          {u.prenom[0]}
          {u.nom[0]}
        </div>
        <div>
          <h1
            className="text-[1.75rem] font-black tracking-tight text-slate-900"
            style={{ fontFamily: "var(--font-nunito), sans-serif" }}
          >
            Bonjour {u.prenom} 👋
          </h1>
          <p className="text-sm text-gray-500 mt-1 flex flex-wrap items-center gap-x-4 gap-y-1">
            <span className="flex items-center gap-1.5">
              <FiMapPin className="w-3.5 h-3.5" />
              {tuteur.ville ?? "Ville non renseignée"}
              {tuteur.quartier ? ` · ${tuteur.quartier}` : ""}
            </span>
            {tuteur.dispo && (
              <span className="flex items-center gap-1.5">
                <FiClock className="w-3.5 h-3.5" />
                {tuteur.dispo}
              </span>
            )}
          </p>
        </div>
      </div>

      {/* Indicateurs */}
      <div className="grid grid-cols-2 xl:grid-cols-4 gap-4 mb-8">
        <Stat
          icon={<FiInbox className="w-4 h-4" />}
          label="Demandes reçues"
          value={String(stats.demandesRecues)}
        />
        <Stat
          icon={<FiClock className="w-4 h-4" />}
          label="En attente"
          value={String(stats.enAttente)}
        />
        <Stat
          icon={<FiCheckCircle className="w-4 h-4" />}
          label="Acceptées"
          value={String(stats.acceptees)}
        />
        <Stat
          icon={<FiDollarSign className="w-4 h-4" />}
          label="Encaissé"
          value={fcfa(stats.revenus)}
        />
      </div>

      {/* Enseignements */}
      <section className="rounded-2xl border border-slate-200/70 bg-white shadow-sm shadow-slate-200/50 p-6 mb-6">
        <h2 className="font-semibold text-gray-900 mb-4">Mes enseignements</h2>
        <div className="grid sm:grid-cols-2 gap-4">
          <div>
            <p className="text-xs text-gray-400 mb-2 uppercase tracking-wide font-medium">
              Matières
            </p>
            <div className="flex flex-wrap gap-1.5">
              {matieres.map((m) => (
                <span
                  key={m}
                  className="text-xs font-medium px-2.5 py-1 rounded-full bg-brand-50 text-brand-700"
                >
                  {m}
                </span>
              ))}
            </div>
          </div>
          <div>
            <p className="text-xs text-gray-400 mb-2 uppercase tracking-wide font-medium">
              Classes
            </p>
            <div className="flex flex-wrap gap-1.5">
              {classes.map((c) => (
                <span
                  key={c}
                  className="text-xs font-medium px-2.5 py-1 rounded-full bg-gray-100 text-gray-700"
                >
                  {c}
                </span>
              ))}
            </div>
          </div>
        </div>
      </section>

      {/* Prochaines seances */}
      <section className="rounded-2xl border border-slate-200/70 bg-white shadow-sm shadow-slate-200/50 p-6 mb-6">
        <h2 className="font-semibold text-gray-900 mb-4">Prochaines séances</h2>
        {seancesAVenir.length === 0 ? (
          <p className="text-sm text-gray-400 py-4">Aucune séance programmée.</p>
        ) : (
          <ul className="divide-y divide-gray-100">
            {seancesAVenir.map((s) => (
              <li key={s.idseance} className="flex items-center gap-4 py-3">
                <FiCalendar className="w-4 h-4 text-gray-400 flex-shrink-0" />
                <div className="flex-1 min-w-0">
                  <p className="text-sm font-medium text-gray-900">
                    {s.estsollicitee.matiere.nomatiere} ·{" "}
                    {s.estsollicitee.demande.utilisateur.prenom}{" "}
                    {s.estsollicitee.demande.utilisateur.nom}
                  </p>
                  <p className="text-xs text-gray-500">
                    {formatDate(s.dateseance)} · {s.heuredeb} → {s.heurefin} (
                    {s.duree})
                  </p>
                </div>
                <span className="text-sm font-semibold text-gray-900">
                  {fcfa(s.total)}
                </span>
                <StatutBadge decision={s.decisionsea} />
              </li>
            ))}
          </ul>
        )}
      </section>

      {/* Demandes */}
      <section className="rounded-2xl border border-slate-200/70 bg-white shadow-sm shadow-slate-200/50 p-6">
        <h2 className="font-semibold text-gray-900 mb-4">
          Demandes qui me sont adressées
        </h2>
        {sollicitations.length === 0 ? (
          <p className="text-sm text-gray-400 py-4">Aucune demande pour le moment.</p>
        ) : (
          <ul className="divide-y divide-gray-100">
            {sollicitations.map(({ sollicitation: s, demande }) => (
              <li
                key={s.idestsollicitee}
                className="flex flex-wrap items-center gap-x-4 gap-y-2 py-3"
              >
                <div className="flex-1 min-w-[12rem]">
                  <p className="text-sm font-medium text-gray-900">
                    {demande.utilisateur.prenom} {demande.utilisateur.nom} ·{" "}
                    {demande.classe.nomclasse}
                  </p>
                  <p className="text-xs text-gray-500">
                    {s.matiere.nomatiere} · {s.jourcours} {s.horairedeb} ({s.duree})
                    {demande.lieusouh ? ` · ${demande.lieusouh}` : ""}
                  </p>
                </div>
                {s.montant && (
                  <span className="text-sm font-semibold text-gray-900">
                    {fcfa(s.montant)}
                  </span>
                )}
                <StatutBadge decision={s.decision} />
              </li>
            ))}
          </ul>
        )}
      </section>
    </div>
  );
}
