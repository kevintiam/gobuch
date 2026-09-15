import { FiFileText } from "react-icons/fi";

import EnConstruction from "@/components/dashboard/EnConstruction";
import { requireRole } from "@/lib/guards";

export default async function ContratsPage() {
  await requireRole("enseignant");

  return (
    <EnConstruction
      titre="Contrats disponibles"
      sousTitre="Les missions de tutorat ouvertes auxquelles tu peux postuler."
      icone={<FiFileText className="w-10 h-10" />}
      detail="Le modèle Contrat n’existe pas encore dans prisma/schema.prisma : il reste à définir avant de brancher cette page."
    />
  );
}
