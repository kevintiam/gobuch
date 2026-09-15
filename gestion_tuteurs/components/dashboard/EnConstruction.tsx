import type { ReactNode } from "react";

import PageTitle from "./PageTitle";

// Ecran d'attente partage par les pages dont le modele de donnees n'existe pas
// encore (Contrat et Rapport n'ont pas de table dans prisma/schema.prisma).
export default function EnConstruction({
  titre,
  sousTitre,
  icone,
  detail,
}: {
  titre: string;
  sousTitre: string;
  icone: ReactNode;
  detail: string;
}) {
  return (
    <div>
      <PageTitle titre={titre} sousTitre={sousTitre} />

      <div className="rounded-2xl border border-slate-200/70 bg-white shadow-sm shadow-slate-200/50 p-10 text-center">
        <div className="mb-4 flex justify-center text-slate-300">{icone}</div>
        <p className="font-semibold text-slate-700">Bientôt disponible</p>
        <p className="text-sm text-gray-500 mt-1 max-w-md mx-auto">{detail}</p>
      </div>
    </div>
  );
}
