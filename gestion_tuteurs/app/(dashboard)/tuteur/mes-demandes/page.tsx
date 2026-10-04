"use client";

import { useState } from "react";
import {
  FiClock,
  FiInbox,
  FiCheckCircle,
  FiXCircle,
  FiAlertCircle,
} from "react-icons/fi";

import StatutBadge, {
  type StatutCandidature,
} from "@/components/dashboard/StatutBadge";
import PageTitle from "@/components/dashboard/PageTitle";
import {
  formatTutorDashboard,
  type TuteurDashboard,
} from "@/data/selectors";
import useTutorInfos from "@/hooks/useTutorInfos";
import { CarteDemande,Squelette,Message,Resume } from "@/components/components";


type Demande = TuteurDashboard["request"][number];
type Filtre = "TOUTES" | StatutCandidature;

const FILTRES: { valeur: Filtre; label: string }[] = [
  { valeur: "TOUTES", label: "Toutes" },
  { valeur: "PENDING", label: "En attente" },
  { valeur: "ACCEPTED", label: "Acceptées" },
  { valeur: "DECLINED", label: "Refusées" },
];


// Celles qui attendent une reponse d'abord, puis les plus recentes.
const trier = (a: Demande, b: Demande) => {
  const aAttend = a.applicationStatus === "PENDING";
  const bAttend = b.applicationStatus === "PENDING";
  if (aAttend !== bAttend) return aAttend ? -1 : 1;
  return b.createdAt.localeCompare(a.createdAt);
};


export default function MesDemandesPage() {
  const { loading, error, tutorInfos, setApplicationStatus } = useTutorInfos();
  const [filtre, setFiltre] = useState<Filtre>("TOUTES");

  if (loading) return <Squelette />;

  if (error) {
    return (
      <Message
        icone={<FiAlertCircle className="h-5 w-5" />}
        ton="rose"
        titre="Impossible de charger vos demandes"
        texte={error}
      />
    );
  }

  const tutor = formatTutorDashboard(tutorInfos);

  if (!tutor) {
    return (
      <Message
        icone={<FiAlertCircle className="h-5 w-5" />}
        ton="amber"
        titre="Aucune fiche tuteur"
        texte="Le compte connecté n'a pas encore de fiche tuteur."
      />
    );
  }

  const compte: Record<Filtre, number> = {
    TOUTES: tutor.received,
    PENDING: tutor.pending,
    ACCEPTED: tutor.accepted,
    DECLINED: tutor.declined,
  };

  const demandes = tutor.request
    .filter((rq) => filtre === "TOUTES" || rq.applicationStatus === filtre)
    .sort(trier);

  return (
    <div>
      <PageTitle
        titre="Mes demandes"
        sousTitre="Les demandes de cours pour lesquelles vous avez été proposé."
      />

      {/* ---------- Resume ---------- */}
      <div className="mb-6 grid grid-cols-2 gap-3 lg:grid-cols-4">
        <Resume
          icone={<FiInbox className="h-4 w-4" />}
          ton="brand"
          valeur={tutor.received}
          label="Reçues"
        />
        <Resume
          icone={<FiClock className="h-4 w-4" />}
          ton="amber"
          valeur={tutor.pending}
          label="En attente"
        />
        <Resume
          icone={<FiCheckCircle className="h-4 w-4" />}
          ton="emerald"
          valeur={tutor.accepted}
          label="Acceptées"
        />
        <Resume
          icone={<FiXCircle className="h-4 w-4" />}
          ton="rose"
          valeur={tutor.declined}
          label="Refusées"
        />
      </div>

      {/* ---------- Filtres ---------- */}
      <div
        role="group"
        aria-label="Filtrer les demandes"
        className="mb-5 flex gap-1 overflow-x-auto rounded-xl bg-slate-100 p-1"
      >
        {FILTRES.map(({ valeur, label }) => {
          const actif = filtre === valeur;
          return (
            <button
              key={valeur}
              type="button"
              aria-pressed={actif}
              onClick={() => setFiltre(valeur)}
              className={`flex shrink-0 items-center gap-2 cursor-pointer rounded-lg px-3.5 py-2 text-sm font-semibold transition-colors ${
                actif
                  ? "bg-white text-slate-900 shadow-sm"
                  : "text-slate-500 hover:text-slate-800"
              }`}
            >
              {label}
              <span
                className={`rounded-full px-1.5 text-xs ${
                  actif ? "bg-brand-50 text-brand-700" : "bg-slate-200/70"
                }`}
              >
                {compte[valeur]}
              </span>
            </button>
          );
        })}
      </div>

      {/* ---------- Liste ---------- */}
      {demandes.length === 0 ? (
        <Message
          icone={<FiInbox className="h-5 w-5" />}
          ton="brand"
          titre={
            filtre === "TOUTES"
              ? "Aucune demande pour le moment"
              : "Aucune demande dans cette catégorie"
          }
          texte={
            filtre === "TOUTES"
              ? "Les demandes des élèves apparaîtront ici dès que vous serez proposé."
              : "Choisissez un autre filtre pour voir vos autres demandes."
          }
        />
      ) : (
        <div className="grid gap-4 xl:grid-cols-2">
          {demandes.map((rq) => (
            <CarteDemande
              key={rq.applicationId}
              rq={rq}
              onRepondu={setApplicationStatus}
            />
          ))}
        </div>
      )}
    </div>
  );
}
