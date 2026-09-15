import type { ReactNode } from "react";

// En-tete commun a toutes les pages du tableau de bord : meme police
// d'affichage que la landing (Nunito), meme rythme vertical.
export default function PageTitle({
  titre,
  sousTitre,
  action,
}: {
  titre: string;
  sousTitre?: ReactNode;
  action?: ReactNode;
}) {
  return (
    <header className="mb-8 flex flex-wrap items-end justify-between gap-4">
      <div>
        <h1
          className="text-[1.75rem] font-black tracking-tight text-slate-900"
          style={{ fontFamily: "var(--font-nunito), sans-serif" }}
        >
          {titre}
        </h1>
        {sousTitre && (
          <p className="mt-1 text-sm text-slate-500">{sousTitre}</p>
        )}
      </div>
      {action}
    </header>
  );
}
