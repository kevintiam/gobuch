"use client";

import { formatTutorDashboard } from "@/data/selectors";
import TuteurDashboard from "@/components/dashboard/TuteurDashboard";
import useTutorInfos from "@/hooks/useTutorInfos";

export default function TuteurDashboardPage() {
  const { loading, error, tutorInfos } = useTutorInfos();

  if (loading) {
    return <p className="py-16 text-center text-sm text-slate-400">Chargement…</p>;
  }

  if (error) {
    return (
      <div className="py-16 text-center">
        <p className="font-medium text-slate-700">
          Impossible de charger le tableau de bord
        </p>
        <p className="mt-1 text-sm text-slate-400">{error}</p>
      </div>
    );
  }

  const tutor = formatTutorDashboard(tutorInfos);

  if (!tutor) {
    return (
      <div className="py-16 text-center">
        <p className="font-medium text-slate-700">Aucune fiche tuteur</p>
        <p className="mt-1 text-sm text-slate-400">
          Le compte connecté n&apos;a pas encore de fiche tuteur.
        </p>
      </div>
    );
  }

  return <TuteurDashboard tutor={tutor} />;
}
