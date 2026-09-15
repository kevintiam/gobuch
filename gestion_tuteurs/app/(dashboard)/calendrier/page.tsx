import { FiCalendar } from "react-icons/fi";

import EnConstruction from "@/components/dashboard/EnConstruction";
import { requireRole } from "@/lib/guards";

export default async function CalendrierPage() {
  await requireRole("enseignant");

  return (
    <EnConstruction
      titre="Mon calendrier"
      sousTitre="Tes séances et tes disponibilités en vue mensuelle."
      icone={<FiCalendar className="w-10 h-10" />}
      detail="Cette vue s’appuiera sur tes séances planifiées et sur le champ dispo de ta fiche."
    />
  );
}
