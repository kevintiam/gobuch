import Link from "next/link";
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
  FiFileText,
  FiFolder,
  FiChevronRight,
  FiArrowRight,
  FiAlertCircle,
  FiBookOpen,
  FiUser,
} from "react-icons/fi";
import {Stat,Carte,Panneau,Tuile,LigneLien,Chip} from "@/lib/function";

export type TuteurDashboardData = NonNullable<
  ReturnType<typeof getTuteurDashboard>
>;

const NUNITO = { fontFamily: "var(--font-nunito), sans-serif" };

/**
 * Affichage pur : recoit ses donnees, ne va rien chercher.
 */
export default function TuteurDashboard({
  data,
}: {
  data: TuteurDashboardData;
}) {
  const { tuteur, matieres, classes, sollicitations, seancesAVenir, stats } =
    data;
  const u = tuteur.utilisateur;

  // "0" = en attente de reponse (voir StatutBadge / data/mockData).
  const aTraiter = sollicitations.filter(
    ({ sollicitation }) => sollicitation.decision === "0"
  );

  return (
    <div className="space-y-6">
      {/* ---------- En-tete ---------- */}
      <header className="flex flex-wrap items-start justify-between gap-4">
        <div>
          <h1
            className="text-2xl font-black tracking-tight text-slate-900 sm:text-[1.75rem]"
            style={NUNITO}
          >
            Bonjour {u.prenom} 👋
          </h1>
          <p className="mt-1 text-sm text-slate-500">
            Gérez vos séances et suivez votre progression.
          </p>
        </div>

        <div className="flex flex-wrap items-center gap-2">
          <span className="flex items-center gap-1.5 rounded-xl border border-slate-200 bg-white px-3 py-2 text-xs font-semibold text-slate-600">
            <FiMapPin className="h-3.5 w-3.5 text-slate-400" />
            {tuteur.ville ?? "Ville non renseignée"}
            {tuteur.quartier ? ` · ${tuteur.quartier}` : ""}
          </span>
          {tuteur.dispo && (
            <span className="flex items-center gap-1.5 rounded-xl border border-amber-200 bg-amber-50 px-3 py-2 text-xs font-semibold text-amber-700">
              <FiClock className="h-3.5 w-3.5" />
              {tuteur.dispo}
            </span>
          )}
        </div>
      </header>

      {/* ---------- Indicateurs ---------- */}
      <div className="grid gap-4 sm:grid-cols-2 xl:grid-cols-4">
        <Stat
          icon={<FiDollarSign className="h-4 w-4" />}
          periode="Total"
          valeur={fcfa(stats.revenus)}
          label="Revenus encaissés"
          lien="/tuteur/mes-seances"
          lienLabel="Voir mes séances"
          accent="emerald"
        />
        <Stat
          icon={<FiInbox className="h-4 w-4" />}
          periode="Total"
          valeur={String(stats.demandesRecues)}
          label="Demandes reçues"
          lien="/tuteur/mes-demandes"
          lienLabel="Consulter les demandes"
          accent="brand"
        />
        <Stat
          icon={<FiClock className="h-4 w-4" />}
          periode="À traiter"
          valeur={String(stats.enAttente)}
          label="En attente de réponse"
          lien="/tuteur/mes-demandes"
          lienLabel="Répondre maintenant"
          accent="amber"
        />
        <Stat
          icon={<FiCheckCircle className="h-4 w-4" />}
          periode="Total"
          valeur={String(stats.acceptees)}
          label="Demandes acceptées"
          lien="/tuteur/mes-contrats"
          lienLabel="Voir mes contrats"
          accent="sky"
        />
      </div>

      {/* ---------- Deux colonnes ---------- */}
      <div className="grid gap-6 lg:grid-cols-3">
        {/* Colonne principale */}
        <div className="space-y-6 lg:col-span-2">
          <Carte
            titre="Actions requises"
            sousTitre="Demandes en attente de votre réponse"
            icon={<FiAlertCircle className="h-4 w-4 text-rose-500" />}
            compteur={aTraiter.length}
          >
            {aTraiter.length === 0 ? (
              <div className="flex flex-col items-center gap-2 px-5 py-10 text-center">
                <span className="flex h-11 w-11 items-center justify-center rounded-full bg-emerald-50 text-emerald-500">
                  <FiCheckCircle className="h-5 w-5" />
                </span>
                <p className="text-sm font-semibold text-slate-700">
                  Tout est à jour
                </p>
                <p className="text-sm text-slate-400">
                  Aucune demande n&apos;attend de réponse.
                </p>
              </div>
            ) : (
              <ul className="divide-y divide-slate-100">
                {aTraiter.map(({ sollicitation: s, demande }) => (
                  <li
                    key={s.idestsollicitee}
                    className="flex flex-wrap items-center gap-x-4 gap-y-2 px-5 py-4 transition-colors hover:bg-slate-50"
                  >
                    <span className="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-slate-100 text-xs font-bold text-slate-500">
                      {demande.utilisateur.prenom[0]}
                      {demande.utilisateur.nom[0]}
                    </span>
                    <div className="min-w-48 flex-1">
                      <p className="text-sm font-semibold text-slate-900">
                        {demande.utilisateur.prenom} {demande.utilisateur.nom}
                        <span className="font-normal text-slate-400"> · </span>
                        {demande.classe.nomclasse}
                      </p>
                      <p className="mt-0.5 text-xs text-slate-500">
                        {s.matiere.nomatiere} · {s.jourcours} {s.horairedeb} (
                        {s.duree})
                        {demande.lieusouh ? ` · ${demande.lieusouh}` : ""}
                      </p>
                    </div>
                    {s.montant && (
                      <span
                        className="text-sm font-bold text-slate-900"
                        style={NUNITO}
                      >
                        {fcfa(s.montant)}
                      </span>
                    )}
                    <Link
                      href="/tuteur/mes-demandes"
                      className="group flex items-center gap-1 text-sm font-semibold text-brand-600 transition-colors hover:text-brand-800"
                    >
                      Répondre
                      <FiArrowRight className="h-3.5 w-3.5 transition-transform motion-safe:group-hover:translate-x-0.5" />
                    </Link>
                  </li>
                ))}
              </ul>
            )}
          </Carte>

          <Carte
            titre="Prochaines séances"
            icon={<FiCalendar className="h-4 w-4" />}
            action={{ href: "/calendrier", label: "Calendrier complet" }}
          >
            {seancesAVenir.length === 0 ? (
              <div className="flex flex-col items-center gap-2 px-5 py-12 text-center">
                <span className="flex h-12 w-12 items-center justify-center rounded-full bg-slate-50 text-slate-300">
                  <FiCalendar className="h-5 w-5" />
                </span>
                <p className="text-sm font-semibold text-slate-700">
                  Aucune séance à venir
                </p>
                <p className="text-sm text-slate-400">
                  Votre planning est vide pour le moment.
                </p>
                <Link
                  href="/tuteur/contrats"
                  className="mt-3 rounded-xl border border-slate-300 px-4 py-2 text-sm font-semibold text-slate-700 transition-colors hover:border-brand-300 hover:bg-brand-50 hover:text-brand-700"
                >
                  Trouver des élèves
                </Link>
              </div>
            ) : (
              <ul className="divide-y divide-slate-100">
                {seancesAVenir.map((s) => (
                  <li
                    key={s.idseance}
                    className="flex flex-wrap items-center gap-x-4 gap-y-2 px-5 py-4 transition-colors hover:bg-slate-50"
                  >
                    <span className="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-brand-50 text-brand-600">
                      <FiCalendar className="h-4 w-4" />
                    </span>
                    <div className="min-w-48 flex-1">
                      <p className="text-sm font-semibold text-slate-900">
                        {s.estsollicitee.matiere.nomatiere}
                        <span className="font-normal text-slate-400"> · </span>
                        {s.estsollicitee.demande.utilisateur.prenom}{" "}
                        {s.estsollicitee.demande.utilisateur.nom}
                      </p>
                      <p className="mt-0.5 text-xs text-slate-500">
                        {formatDate(s.dateseance)} · {s.heuredeb} → {s.heurefin}{" "}
                        ({s.duree})
                      </p>
                    </div>
                    <span
                      className="text-sm font-bold text-slate-900"
                      style={NUNITO}
                    >
                      {fcfa(s.total)}
                    </span>
                    <StatutBadge decision={s.decisionsea} />
                  </li>
                ))}
              </ul>
            )}
          </Carte>
        </div>

        {/* Colonne laterale */}
        <div className="space-y-6">
          <Panneau titre="Mon travail">
            <div className="grid grid-cols-2 gap-3">
              <Tuile
                href="/tuteur/calendrier"
                icon={<FiCalendar className="h-5 w-5" />}
                label="Mon calendrier"
              />
              <Tuile
                href="/tuteur/mes-contrats"
                icon={<FiFileText className="h-5 w-5" />}
                label="Mes contrats"
              />
              <Tuile
                href="/tuteur/contrats"
                icon={<FiFolder className="h-5 w-5" />}
                label="Contrats disponibles"
              />
              <Tuile
                href="/tuteur/mes-seances"
                icon={<FiClock className="h-5 w-5" />}
                label="Mes séances"
              />
            </div>
          </Panneau>
          
          <Panneau titre="Mes enseignements">
            <p className="mb-2 text-xs font-semibold uppercase tracking-wide text-slate-400">
              Matières
            </p>
            <div className="mb-4 flex flex-wrap gap-1.5">
              {matieres.length === 0 ? (
                <p className="text-sm text-slate-400">Aucune matière.</p>
              ) : (
                matieres.map((m) => (
                  <Chip key={m} ton="marque">
                    {m}
                  </Chip>
                ))
              )}
            </div>

            <p className="mb-2 text-xs font-semibold uppercase tracking-wide text-slate-400">
              Classes
            </p>
            <div className="flex flex-wrap gap-1.5">
              {classes.length === 0 ? (
                <p className="text-sm text-slate-400">Aucune classe.</p>
              ) : (
                classes.map((c) => <Chip key={c}>{c}</Chip>)
              )}
            </div>
          </Panneau>
        </div>
      </div>
    </div>
  );
}
