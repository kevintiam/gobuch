import Link from "next/link";
import {  type TuteurDashboard as TuteurDashboardData } from "@/data/selectors";
import { fcfa } from "@/lib/format";
import {
  FiInbox,
  FiClock,
  FiCheckCircle,
  FiDollarSign,
  FiMail,
  FiCalendar,
  FiFileText,
  FiFolder,
  FiAlertCircle
} from "react-icons/fi";
import {Stat,Carte,Panneau,Tuile,Chip} from "@/lib/function";

const NUNITO = { fontFamily: "var(--font-nunito), sans-serif" };

/**
 * Affichage pur : recoit ses donnees, ne va rien chercher.
 */
export default function TuteurDashboard({ tutor }: { tutor: TuteurDashboardData }) {
    const enAttente = tutor.request.filter(
    (_, i) => tutor.applications[i]?.status === "PENDING",
  )

  return (
    <div className="space-y-6">
      {/* ---------- En-tete ---------- */}
      <header className="flex flex-wrap items-start justify-between gap-4">
        <div>
          <h1
            className="text-2xl font-black tracking-tight text-slate-900 sm:text-[1.75rem]"
            style={NUNITO}
          >
            Bonjour {tutor.name} 👋
          </h1>
          <p className="mt-1 text-sm text-slate-500">
            Gérez vos séances et suivez votre progression.
          </p>
        </div>

        <div className="flex flex-wrap items-center gap-2">
          <span className="flex items-center gap-1.5 rounded-xl border border-slate-200 bg-white px-3 py-2 text-xs font-semibold text-slate-600">
            <FiMail className="h-3.5 w-3.5 text-slate-400" />
            {tutor.email}
          </span>
        </div>
      </header>

      {/* ---------- Indicateurs ---------- */}
      <div className="grid gap-4 sm:grid-cols-2 xl:grid-cols-4">
        <Stat
          icon={<FiDollarSign className="h-4 w-4" />}
          periode="Total"
          valeur={fcfa(tutor.revenus)}
          label="Revenus encaissés"
          lien="/tuteur/mes-seances"
          lienLabel="Voir mes séances"
          accent="emerald"
        />
        <Stat
          icon={<FiInbox className="h-4 w-4" />}
          periode="Total"
          valeur={String(tutor.received)}
          label="Demandes reçues"
          lien="/tuteur/mes-demandes"
          lienLabel="Consulter les demandes"
          accent="brand"
        />
        <Stat
          icon={<FiClock className="h-4 w-4" />}
          periode="À traiter"
          valeur={String(tutor.pending)}
          label="En attente de réponse"
          lien="/tuteur/mes-demandes"
          lienLabel="Répondre maintenant"
          accent="amber"
        />
        <Stat
          icon={<FiCheckCircle className="h-4 w-4" />}
          periode="Total"
          valeur={String(tutor.accepted)}
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
            compteur={tutor.pending}
          >
            {enAttente?.length === 0 ? (
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
                {enAttente?.map((req) => (
                  <li
                    key={req.id}
                    className="flex flex-wrap items-center gap-x-4 gap-y-2 px-5 py-4 transition-colors hover:bg-slate-50"
                  >
                    <span className="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-slate-100 text-xs font-bold text-slate-500">
                      {req.student?.firstName[0] || ""}
                      {req.student?.lastName[0] || ""}
                    </span>
                    <div className="min-w-48 flex-1">
                      <p className="text-sm font-semibold text-slate-900">
                        {req.student?.firstName} {req.student?.lastName}
                        <span className="font-normal text-slate-400"> · </span>
                        {req.student.level}
                      </p>
                      {/* <p className="mt-0.5 text-xs text-slate-500">
                        {s.matiere.nomatiere} · {s.jourcours} {s.horairedeb} (
                        {s.duree})
                        {tutor.request[0]?.lieusouh ? ` · ${tutor.request[0]?.lieusouh}` : ""}
                      </p> */}
                    </div>
                    {req.montant && (
                      <span
                        className="text-sm font-bold text-slate-900"
                        style={NUNITO}
                      >
                        {fcfa(req.montant)}
                      </span>
                    )}
                    <Link
                      href="/tuteur/mes-demandes"
                      className="group flex items-center gap-1 text-sm font-semibold text-brand-600 transition-colors hover:text-brand-800"
                    >
                      Répondre

                    </Link>
                  </li>
                ))}
              </ul>
            )}
          </Carte>

          {/* <Carte
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
          </Carte> */}
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
              {tutor.sujets.length === 0 ? (
                <p className="text-sm text-slate-400">Aucune matière.</p>
              ) : (
                tutor.sujets.map((m) => (
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
              {tutor.levels.length === 0 ? (
                <p className="text-sm text-slate-400">Aucune classe.</p>
              ) : (
                tutor.levels.map((c) => <Chip key={c}>{c}</Chip>)
              )}
            </div>
          </Panneau>
        </div>
      </div>
    </div>
  );
}
