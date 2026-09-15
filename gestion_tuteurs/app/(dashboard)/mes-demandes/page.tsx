import { FiMapPin, FiClock } from "react-icons/fi";

import StatutBadge from "@/components/dashboard/StatutBadge";
import { getTuteurDashboard } from "@/data/selectors";
import PageTitle from "@/components/dashboard/PageTitle";
import { requireRole } from "@/lib/guards";
import { fcfa, formatDate } from "@/lib/format";

// Les demandes adressees au tuteur connecte. /demandes, elle, liste celles de
// tous les eleves et reste reservee a l'administration.
export default async function MesDemandesPage() {
  const session = await requireRole("enseignant");
  const data = getTuteurDashboard(Number(session.user?.id));

  if (!data) {
    return (
      <p className="text-gray-500">
        Aucune fiche tuteur pour le compte connecté.
      </p>
    );
  }

  const { sollicitations, stats } = data;

  return (
    <div>
      <PageTitle
        titre="Mes demandes"
        sousTitre={`${stats.demandesRecues} reçue(s) · ${stats.enAttente} en attente · ${stats.acceptees} acceptée(s)`}
      />

      <div className="space-y-4">
        {sollicitations.length === 0 ? (
          <p className="text-sm text-gray-400">
            Aucune demande ne t&apos;a été adressée pour le moment.
          </p>
        ) : (
          sollicitations.map(({ sollicitation: s, demande }) => (
            <article
              key={s.idestsollicitee}
              className="rounded-2xl border border-slate-200/70 bg-white shadow-sm shadow-slate-200/50 p-5"
            >
              <div className="flex flex-wrap items-start justify-between gap-3">
                <div>
                  <p className="font-semibold text-gray-900">
                    {demande.utilisateur.prenom} {demande.utilisateur.nom}
                    <span className="text-gray-400 font-normal">
                      {" "}
                      · {demande.classe.nomclasse}
                    </span>
                  </p>
                  <p className="text-sm text-brand-700 font-medium mt-0.5">
                    {s.matiere.nomatiere}
                  </p>
                </div>
                <StatutBadge decision={s.decision} />
              </div>

              <dl className="grid sm:grid-cols-3 gap-4 mt-4 text-sm">
                <div>
                  <dt className="text-xs text-gray-400 uppercase tracking-wide font-medium mb-0.5">
                    Créneau
                  </dt>
                  <dd className="text-gray-700 flex items-center gap-1.5">
                    <FiClock className="w-3.5 h-3.5 text-gray-400" />
                    {s.jourcours} {s.horairedeb} ({s.duree})
                  </dd>
                </div>
                <div>
                  <dt className="text-xs text-gray-400 uppercase tracking-wide font-medium mb-0.5">
                    Lieu
                  </dt>
                  <dd className="text-gray-700 flex items-center gap-1.5">
                    <FiMapPin className="w-3.5 h-3.5 text-gray-400" />
                    {demande.lieusouh ?? "Non précisé"}
                  </dd>
                </div>
                <div>
                  <dt className="text-xs text-gray-400 uppercase tracking-wide font-medium mb-0.5">
                    Forfait proposé
                  </dt>
                  <dd className="text-gray-900 font-semibold">
                    {s.montant ? fcfa(s.montant) : "À négocier"}
                  </dd>
                </div>
              </dl>

              <p className="text-xs text-gray-400 mt-4">
                Demande déposée le {formatDate(demande.date)}
              </p>
            </article>
          ))
        )}
      </div>
    </div>
  );
}
