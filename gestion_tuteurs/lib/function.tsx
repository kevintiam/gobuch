import Link from "next/link";
import { FiChevronRight,FiCheckCircle,FiAlertCircle } from "react-icons/fi";

const NUNITO = { fontFamily: "var(--font-nunito), sans-serif" };

/* -------------------------------------------------------------------------- */
/*  Briques d'affichage                                                       */
/* -------------------------------------------------------------------------- */

// Tailwind ne lit que des classes ecrites en entier : pas de `bg-${accent}-50`.
const ACCENTS = {
  brand: "bg-brand-50 text-brand-600",
  amber: "bg-amber-50 text-amber-600",
  emerald: "bg-emerald-50 text-emerald-600",
  sky: "bg-sky-50 text-sky-600",
} as const;

export function Stat({
  icon,
  periode,
  valeur,
  label,
  lien,
  lienLabel,
  accent,
}: {
  icon: React.ReactNode;
  periode: string;
  valeur: string;
  label: string;
  lien: string;
  lienLabel: string;
  accent: keyof typeof ACCENTS;
}) {
  return (
    <div className="flex flex-col rounded-2xl border border-slate-200/70 bg-white p-5 shadow-sm shadow-slate-200/50 transition-shadow hover:shadow-md">
      <div className="mb-4 flex items-start justify-between gap-2">
        <span
          className={`flex h-9 w-9 items-center justify-center rounded-xl ${ACCENTS[accent]}`}
        >
          {icon}
        </span>
        <span className="text-xs font-medium text-slate-400">{periode}</span>
      </div>

      <p className="text-3xl font-black text-slate-900" style={NUNITO}>
        {valeur}
      </p>
      <p className="mt-1 text-sm text-slate-500">{label}</p>

      <Link
        href={lien}
        className="group mt-4 flex items-center gap-1 border-t border-slate-100 pt-3 text-sm font-semibold text-brand-600 transition-colors hover:text-brand-800"
      >
        {lienLabel}
      </Link>
    </div>
  );
}

export function Carte({
  titre,
  sousTitre,
  icon,
  compteur,
  action,
  children,
}: {
  titre: string;
  sousTitre?: string;
  icon?: React.ReactNode;
  compteur?: number;
  action?: { href: string; label: string };
  children: React.ReactNode;
}) {
  return (
    <section className="overflow-hidden rounded-2xl border border-slate-200/70 bg-white shadow-sm shadow-slate-200/50">
      <div className="flex items-center gap-3 border-b border-slate-100 px-5 py-4">
        {icon && (
          <span className="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-slate-100 text-slate-500">
            {icon}
          </span>
        )}
        <div className="min-w-0">
          <h2 className="font-bold text-slate-900" style={NUNITO}>
            {titre}
          </h2>
          {sousTitre && <p className="text-xs text-slate-400">{sousTitre}</p>}
        </div>

        <div className="ml-auto flex shrink-0 items-center gap-3">
          {compteur !== undefined && compteur > 0 && (
            <span className="rounded-full bg-rose-50 px-2.5 py-0.5 text-xs font-bold text-rose-600">
              {compteur}
            </span>
          )}
          {action && (
            <Link
              href={action.href}
              className="group flex items-center gap-1 text-sm font-semibold text-brand-600 transition-colors hover:text-brand-800"
            >
              {action.label}
            </Link>
          )}
        </div>
      </div>
      {children}
    </section>
  );
}

/** Tuile carree de la grille "Mon travail". */
export function Tuile({
  href,
  icon,
  label,
}: {
  href: string;
  icon: React.ReactNode;
  label: string;
}) {
  return (
    <Link
      href={href}
      className="flex flex-col items-center gap-2 rounded-xl border border-slate-200/70 bg-slate-50/60 px-3 py-5 text-center transition-all hover:border-brand-200 hover:bg-brand-50/60 motion-safe:hover:-translate-y-0.5"
    >
      <span className="text-slate-500">{icon}</span>
      <span className="text-xs font-semibold text-slate-700">{label}</span>
    </Link>
  );
}

/** Ligne cliquable de la colonne laterale. */
export function LigneLien({
  href,
  icon,
  titre,
  sousTitre,
}: {
  href: string;
  icon: React.ReactNode;
  titre: string;
  sousTitre: string;
}) {
  return (
    <Link
      href={href}
      className="flex items-center gap-3 rounded-xl px-2 py-2.5 transition-colors hover:bg-slate-50"
    >
      <span className="flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-slate-100 text-slate-500">
        {icon}
      </span>
      <span className="min-w-0 flex-1">
        <span className="block truncate text-sm font-semibold text-slate-800">
          {titre}
        </span>
        <span className="block truncate text-xs text-slate-400">
          {sousTitre}
        </span>
      </span>
      <FiChevronRight className="h-4 w-4 shrink-0 text-slate-300" />
    </Link>
  );
}

export function Chip({
  children,
  ton = "neutre",
}: {
  children: React.ReactNode;
  ton?: "marque" | "neutre";
}) {
  return (
    <span
      className={`rounded-full px-2.5 py-1 text-xs font-semibold ${
        ton === "marque"
          ? "bg-brand-50 text-brand-700 ring-1 ring-brand-100"
          : "bg-slate-100 text-slate-600 ring-1 ring-slate-200/70"
      }`}
    >
      {children}
    </span>
  );
}

export function Panneau({
  titre,
  children,
}: {
  titre: string;
  children: React.ReactNode;
}) {
  return (
    <section className="rounded-2xl border border-slate-200/70 bg-white p-5 shadow-sm shadow-slate-200/50">
      <h2 className="mb-4 text-xs font-bold uppercase tracking-wider text-slate-400">
        {titre}
      </h2>
      {children}
    </section>
  );
}

export function Champ({
  label,
  valeur,
  icone,
}: {
  label: string;
  valeur: string | null | undefined;
  icone: React.ReactNode;
}) {
  return (
    <div className="flex items-start gap-3 rounded-xl border border-slate-200/70 bg-slate-50/50 px-4 py-3">
      <span className="mt-0.5 text-slate-400">{icone}</span>
      <div className="min-w-0">
        <dt className="text-xs text-slate-400">{label}</dt>
        <dd className="truncate text-sm font-semibold text-slate-800">
          {valeur || (
            <span className="font-normal text-slate-400">Non renseigné</span>
          )}
        </dd>
      </div>
    </div>
  );
}

/** Ligne "piece fournie / manquante" de la colonne laterale. */
export function Piece({
  label,
  detail,
  fournie,
}: {
  label: string;
  detail: string;
  fournie: boolean;
}) {
  return (
    <div
      className={`flex items-start gap-3 rounded-xl border px-4 py-3 ${
        fournie
          ? "border-emerald-200 bg-emerald-50/60"
          : "border-slate-200 bg-slate-50/60"
      }`}
    >
      <span className={fournie ? "text-emerald-600" : "text-slate-300"}>
        {fournie ? (
          <FiCheckCircle className="h-5 w-5" />
        ) : (
          <FiAlertCircle className="h-5 w-5" />
        )}
      </span>
      <div className="min-w-0">
        <p
          className={`text-sm font-bold ${
            fournie ? "text-emerald-800" : "text-slate-700"
          }`}
        >
          {label}
        </p>
        <p
          className={`text-xs ${
            fournie ? "text-emerald-700/80" : "text-slate-400"
          }`}
        >
          {detail}
        </p>
      </div>
    </div>
  );
}

export function LigneStat({
  icone,
  label,
  valeur,
}: {
  icone: React.ReactNode;
  label: string;
  valeur: string;
}) {
  return (
    <div className="flex items-center gap-3 py-2.5">
      <span className="text-slate-400">{icone}</span>
      <span className="flex-1 text-sm text-slate-600">{label}</span>
      <span className="text-sm font-bold text-slate-900" style={NUNITO}>
        {valeur}
      </span>
    </div>
  );
}
