// Statut d'une candidature du tuteur (enum Prisma TutorApplicationStatus).
export type StatutCandidature = "PENDING" | "ACCEPTED" | "DECLINED";

const STATUTS: Record<StatutCandidature, { label: string; couleur: string }> = {
  PENDING: { label: "En attente", couleur: "bg-yellow-100 text-yellow-700" },
  ACCEPTED: { label: "Acceptée", couleur: "bg-green-100 text-green-700" },
  DECLINED: { label: "Refusée", couleur: "bg-red-100 text-red-700" },
};

export default function StatutBadge({ statut }: { statut: StatutCandidature }) {
  const { label, couleur } = STATUTS[statut];

  return (
    <span
      className={`text-xs font-medium px-2.5 py-1 rounded-full whitespace-nowrap ${couleur}`}
    >
      {label}
    </span>
  );
}
