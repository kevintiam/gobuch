import { FiFolder } from "react-icons/fi";

import EnConstruction from "@/components/dashboard/EnConstruction";
import { requireRole } from "@/lib/guards";

export default async function MesContratsPage() {
  await requireRole("enseignant");

  return (
    <EnConstruction
      titre="Mes contrats"
      sousTitre="Les missions que tu as acceptées et leur état d’avancement."
      icone={<FiFolder className="w-10 h-10" />}
      detail="Le modèle Contrat n’existe pas encore dans prisma/schema.prisma : il reste à définir avant de brancher cette page."
    />
  );
}
