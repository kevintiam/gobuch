import { DECISION_LABEL, type Decision } from "@/data/mockData";

// Codes "0" / "1" / "2" stockes en base (voir data/mockData.ts).
const COULEUR: Record<Decision, string> = {
  "0": "bg-yellow-100 text-yellow-700",
  "1": "bg-green-100 text-green-700",
  "2": "bg-red-100 text-red-700",
};

export default function StatutBadge({ decision }: { decision: Decision }) {
  return (
    <span
      className={`text-xs font-medium px-2.5 py-1 rounded-full whitespace-nowrap ${COULEUR[decision]}`}
    >
      {DECISION_LABEL[decision]}
    </span>
  );
}
