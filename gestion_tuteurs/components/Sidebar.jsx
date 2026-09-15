"use client";

import Link from "next/link";
import Image from "next/image";
import { usePathname } from "next/navigation";
import { signOut } from "next-auth/react";

import {
  FiHome,
  FiUser,
  FiUsers,
  FiClipboard,
  FiCalendar,
  FiGrid,
  FiFileText,
  FiFolder,
  FiBarChart2,
  FiLogOut,
} from "react-icons/fi";

// La navigation depend du role : /tuteurs, /demandes et /seances listent tous
// les tuteurs, toutes les demandes et tous les montants — c'est de
// l'administration, pas l'espace d'un tuteur. Masquer les liens ne suffit
// evidemment pas : la vraie garde est dans lib/guards.ts, cote serveur.
const NAV_PAR_ROLE = {
  eleve: [{ href: "/eleve", label: "Mon espace", Icone: FiHome }],
  enseignant: [
    { href: "/tuteur", label: "Mon espace", Icone: FiHome, section: "Vue d'ensemble" },
    { href: "/profil", label: "Mon profil", Icone: FiUser, section: "Vue d'ensemble" },
    { href: "/mes-demandes", label: "Mes demandes", Icone: FiClipboard, section: "Vue d'ensemble" },
    { href: "/calendrier", label: "Mon calendrier", Icone: FiGrid, section: "Vue d'ensemble" },
    { href: "/mes-seances", label: "Mes séances", Icone: FiCalendar, section: "Mon travail" },
    { href: "/contrats", label: "Contrats disponibles", Icone: FiFileText, section: "Mon travail" },
    { href: "/mes-contrats", label: "Mes contrats", Icone: FiFolder, section: "Mon travail" },
    { href: "/mes-rapports", label: "Mes rapports", Icone: FiBarChart2, section: "Mon travail" },
  ],
  admin: [
    { href: "/tuteurs", label: "Tuteurs", Icone: FiUsers },
    { href: "/demandes", label: "Demandes", Icone: FiClipboard },
    { href: "/seances", label: "Séances", Icone: FiCalendar },
  ],
};

const SOUS_TITRE_PAR_ROLE = {
  eleve: "Espace élève",
  enseignant: "Espace tuteurs",
  admin: "Administration",
};

// Regroupe en conservant l'ordre de declaration. Object.groupBy n'est pas
// utilise : il demande un runtime plus recent que la cible du projet.
const parSection = (items) => {
  const groupes = [];
  for (const item of items) {
    const titre = item.section ?? "";
    const dernier = groupes[groupes.length - 1];
    if (dernier && dernier.titre === titre) dernier.items.push(item);
    else groupes.push({ titre, items: [item] });
  }
  return groupes;
};

const initiales = (nom) =>
  (nom ?? "")
    .split(" ")
    .filter(Boolean)
    .slice(0, 2)
    .map((mot) => mot[0])
    .join("")
    .toUpperCase() || "?";

export default function Sidebar({ role, nom }) {
  const pathname = usePathname();
  const groupes = parSection(NAV_PAR_ROLE[role] ?? []);

  return (
    <aside className="sticky top-0 flex h-screen w-64 shrink-0 flex-col bg-brand-900 text-brand-100">
      {/* Marque */}
      <div className="flex items-center gap-2.5 px-5 py-6">
        <Image
          src="/logo.png"
          alt="Logo Gobuch"
          width={36}
          height={36}
          className="h-9 w-9 rounded-xl bg-white/95 object-contain p-1"
        />
        <div className="leading-tight">
          <p
            className="text-lg font-black text-white"
            style={{ fontFamily: "var(--font-nunito), sans-serif" }}
          >
            Gobuch
          </p>
          <p className="text-[11px] font-medium text-brand-300">
            {SOUS_TITRE_PAR_ROLE[role] ?? "Tableau de bord"}
          </p>
        </div>
      </div>

      {/* Navigation */}
      <nav className="flex-1 overflow-y-auto px-3 pb-4">
        {groupes.map((groupe) => (
          <div key={groupe.titre || "sans-section"}>
            {groupe.titre && (
              <p className="px-3 pt-5 pb-2 text-[16px] font-bold uppercase tracking-[0.12em] text-brand-400">
                {groupe.titre}
              </p>
            )}
            {groupe.items.map(({ href, label, Icone }) => {
              const isActive =
                pathname === href || pathname.startsWith(`${href}/`);
              return (
                <Link
                  key={href}
                  href={href}
                  aria-current={isActive ? "page" : undefined}
                  className={`group relative mb-0.5 flex items-center gap-3 rounded-lg px-3 py-2.5 text-[16px] font-medium transition-colors duration-200 ${
                    isActive
                      ? "bg-white/10 text-white"
                      : "text-brand-200 hover:bg-white/5 hover:text-white"
                  }`}
                >
                  {/* Repere de la page courante */}
                  <span
                    aria-hidden="true"
                    className={`absolute left-0 top-1/2 h-5 w-1 -translate-y-1/2 rounded-r-full bg-accent-400 transition-opacity duration-200 ${
                      isActive ? "opacity-100" : "opacity-0"
                    }`}
                  />
                  <Icone
                    className="h-4.5 w-4.5 shrink-0"
                  />
                  <span className="truncate">{label}</span>
                </Link>
              );
            })}
          </div>
        ))}
      </nav>

      {/* Compte connecte */}
      <div className="border-t border-white/10 p-3">
        <div className="flex items-center gap-3 px-2 py-2">
          <span className="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-white/10 text-xs font-bold text-white">
            {initiales(nom)}
          </span>
          <div className="min-w-0 leading-tight">
            <p className="truncate text-sm font-semibold text-white">
              {nom ?? "Compte"}
            </p>
            <p className="text-[11px] text-brand-300">
              {SOUS_TITRE_PAR_ROLE[role] ?? ""}
            </p>
          </div>
        </div>

        <button
          onClick={() => signOut({ callbackUrl: "/login" })}
          className="mt-1 flex w-full cursor-pointer items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium text-brand-200 transition-colors duration-200 hover:bg-red-500/15 hover:text-red-200"
        >
          <FiLogOut className="h-4.5 w-4.5 shrink-0" />
          Déconnexion
        </button>
      </div>
    </aside>
  );
}
