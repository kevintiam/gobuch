// Mises en forme partagees par les pages du tableau de bord.

export const fcfa = (montant: number | string | null | undefined) =>
  `${Number(montant ?? 0).toLocaleString("fr-FR")} FCFA`;

/** "2026-09-18" -> "vendredi 18 septembre". Renvoie la chaine telle quelle si
 *  elle n'est pas une date ISO (les champs date sont des String en base).
 *
 *  new Date("2026-09-18") serait interprete en UTC puis reaffiche dans le
 *  fuseau local : a l'ouest de Greenwich on retombe sur la veille. On
 *  construit donc la date a partir des trois nombres, en heure locale. */
export function formatDate(iso: string | null | undefined): string {
  if (!iso) return "Date non renseignée";
  // slice(0, 10) : accepte aussi un horodatage complet ("2026-09-18T10:00:00Z"),
  // forme sous laquelle Prisma serialise les DateTime.
  const [annee, mois, jour] = iso.slice(0, 10).split("-").map(Number);
  if (!annee || !mois || !jour) return iso;
  const d = new Date(annee, mois - 1, jour);
  if (Number.isNaN(d.getTime())) return iso;
  return d.toLocaleDateString("fr-FR", {
    weekday: "long",
    day: "numeric",
    month: "long",
  });
}
