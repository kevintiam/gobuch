"use client";

import Link from "next/link";
import Image from "next/image";
import { usePathname } from "next/navigation";
import { signOut } from "next-auth/react";
import type { IconType } from "react-icons";
import type { Role } from "@/lib/roles";

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

type NavItem = {
  href: string;
  label: string;
  Icone: IconType;
  section?: string;
};

type Groupe = { titre: string; items: NavItem[] };

const NAV_PAR_ROLE: Record<Role, NavItem[]> = {
  eleve: [{ href: "/eleve", label: "Mon espace", Icone: FiHome }],
  tutor: [
    {
      href: "/tuteur",
      label: "Mon espace",
      Icone: FiHome,
      section: "Vue d'ensemble",
    },
    {
      href: "/tuteur/profil",
      label: "Mon profil",
      Icone: FiUser,
      section: "Vue d'ensemble",
    },
    {
      href: "/tuteur/mes-demandes",
      label: "Mes demandes",
      Icone: FiClipboard,
      section: "Vue d'ensemble",
    },
    {
      href: "/tuteur/calendrier",
      label: "Mon calendrier",
      Icone: FiGrid,
      section: "Vue d'ensemble",
    },
    {
      href: "/tuteur/mes-seances",
      label: "Mes séances",
      Icone: FiCalendar,
      section: "Mon travail",
    },
    {
      href: "/tuteur/contrats",
      label: "Contrats disponibles",
      Icone: FiFileText,
      section: "Mon travail",
    },
    {
      href: "/tuteur/mes-contrats",
      label: "Mes contrats",
      Icone: FiFolder,
      section: "Mon travail",
    },
    {
      href: "/tuteur/mes-rapports",
      label: "Mes rapports",
      Icone: FiBarChart2,
      section: "Mon travail",
    },
  ],
  admin: [
    { href: "/tuteurs", label: "Tuteurs", Icone: FiUsers },
    { href: "/demandes", label: "Demandes", Icone: FiClipboard },
    { href: "/seances", label: "Séances", Icone: FiCalendar },
  ],
};

const SOUS_TITRE_PAR_ROLE: Record<Role, string> = {
  eleve: "Espace élève",
  tutor: "Espace tuteurs",
  admin: "Administration",
};

const parSection = (items: NavItem[]): Groupe[] => {
  const groupes: Groupe[] = [];
  for (const item of items) {
    const titre = item.section ?? "";
    const dernier = groupes[groupes.length - 1];
    if (dernier && dernier.titre === titre) dernier.items.push(item);
    else groupes.push({ titre, items: [item] });
  }
  return groupes;
};

const initiales = (nom?: string) =>
  (nom ?? "")
    .split(" ")
    .filter(Boolean)
    .slice(0, 2)
    .map((mot: string) => mot[0])
    .join("")
    .toUpperCase() || "?";

export default function Sidebar({
  role,
  nom,
  open = false,
  onClose,
}: {
  role?: string;
  nom?: string;
  open?: boolean;
  onClose?: () => void;
}) {
  const pathname = usePathname();
  const roleConnu = (
    role && role in NAV_PAR_ROLE ? role : undefined
  ) as Role | undefined;
  const items = roleConnu ? NAV_PAR_ROLE[roleConnu] : [];
  const groupes = parSection(items);
  const hrefActif = items
    .map((item) => item.href)
    .filter((href) => pathname === href || pathname.startsWith(`${href}/`))
    .sort((a, b) => b.length - a.length)[0];

  return (
    <aside
      className={`
          fixed inset-y-0 left-0 z-40 w-65 flex flex-col
          bg-blue-950 text-white
          transition-transform duration-300
          ${open ? "translate-x-0" : "-translate-x-full"}
          lg:translate-x-0 lg:static lg:inset-auto
        `}
    >
      {/* Marque */}
      <div className="flex items-center gap-3 px-5 py-5 border-b border-blue-900">
        <Image
          src="/logo1.svg"
          alt="Logo Gobuch"
          width={120}
          height={10}
          className="h-10 w-auto object-contain invert"
        />
      </div>

      {/* Navigation */}
      <nav className="flex-1 px-3 py-4 space-y-1 overflow-y-auto">
        {groupes.map((groupe) => (
          <div key={groupe.titre || "sans-section"}>
            {groupe.titre && (
              <p className="px-3 pt-5 pb-2 text-[14px] font-bold uppercase tracking-[0.12em] text-brand-400">
                {groupe.titre}
              </p>
            )}
            {groupe.items.map((item) => {
              const { href, label, Icone } = item;
              const isActive = href === hrefActif;
              return (
                <Link
                  key={href}
                  href={href}
                  aria-current={isActive ? "page" : undefined}
                  className={`w-full flex items-center gap-3 px-3 py-2.5 rounded-xl text-[16px] font-semibold
                transition-all duration-150 text-left ${
                  isActive
                    ? "bg-blue-800 text-white"
                    : "text-blue-300 hover:bg-blue-950 hover:text-white"
                }`}
                >
                  {/* Repere de la page courante */}
                  <span
                    aria-hidden="true"
                    className={`h-5 w-1 shrink-0 rounded-full transition-colors ${
                      isActive ? "bg-amber-400" : "bg-transparent"
                    }`}
                  />
                  <Icone className="h-4.5 w-4.5 shrink-0" />
                  <span className="truncate">{label}</span>
                </Link>
              );
            })}
          </div>
        ))}
      </nav>

      {/* Compte connecte */}
      <div className="p-4 border-t border-blue-900">
        <div className="flex items-center gap-3">
          <span className="w-9 h-9 rounded-full bg-amber-400 flex items-center justify-center text-amber-900 font-black text-sm">
            {initiales(nom)}
          </span>
          <div className="flex-1 min-w-0">
            <p className="text-[16px] font-bold text-white truncate">
              {nom ?? "Compte"}
            </p>
            <p className="text-xs text-blue-400">
              {roleConnu ? SOUS_TITRE_PAR_ROLE[roleConnu] : ""}
            </p>
          </div>
          <div className="text-blue-400 hover:text-white transition-colors">
            <button
              onClick={() => signOut({ callbackUrl: "/login" })}
              className="mt-1 flex w-full cursor-pointer items-center rounded-lg py-2.5 px-3 text-[16px] font-medium text-brand-200 transition-colors duration-200 hover:bg-red-500/15 hover:text-red-200"
            >
              <FiLogOut className="h-4.5 w-4.5 shrink-0" />
            </button>
          </div>
        </div>
      </div>
    </aside>
  );
}
