import { FiBarChart2 } from "react-icons/fi";

import EnConstruction from "@/components/dashboard/EnConstruction";
import { requireRole } from "@/lib/guards";

export default async function MesRapportsPage() {
  await requireRole("tutor");

  return (
    <EnConstruction
      titre="Mes rapports"
      sousTitre="Le bilan de tes heures, de tes élèves et de tes revenus."
      icone={<FiBarChart2 className="w-10 h-10" />}
      detail="Le modèle Rapport n’existe pas encore dans prisma/schema.prisma : il reste à définir avant de brancher cette page."
    />
  );
}
