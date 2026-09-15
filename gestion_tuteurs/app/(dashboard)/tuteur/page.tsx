import { requireRole } from "@/lib/guards";
import { getTuteurDashboard } from "@/data/selectors";
import TuteurDashboard from "@/components/dashboard/TuteurDashboard";

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

  return <TuteurDashboard data={data} />;
}
