"use client";
import { FiMenu, FiSearch, FiClock, FiBell } from "react-icons/fi";

export default function Header({ onMenuClick, role }) {
  return (
    <header className="flex items-center gap-4 px-4 lg:px-6 py-5 bg-white border-b border-slate-200 sticky top-0 z-20">
      <button
        className="lg:hidden text-slate-500 hover:text-slate-900"
        onClick={onMenuClick}
        aria-label="Ouvrir le menu"
      >
        <FiMenu className="w-6 h-6" />
      </button>

      {/* Search */}
      <div className="flex-1">
        <div className="relative flex gap-2">
          <FiSearch className="w-5 h-5 absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400" />
          <input
            type="text"
            placeholder="Rechercher un cours, une épreuve..."
            className="w-full pl-9 pr-4 ml-2 py-2 text-[16px] bg-slate-100 rounded-xl border-0 focus:outline-none focus:ring-2 focus:ring-blue-400 placeholder-slate-400"
          />
        </div>
      </div>

      <div className="flex items-center gap-2 ml-auto">
        {role === "eleve" && (
          <button
            className="flex items-center gap-1.5 text-xs font-semibold text-slate-600 bg-slate-100 hover:bg-amber-50 hover:text-amber-700 px-3 py-2 rounded-xl transition-colors"
            title="Mode Concentration"
          >
            <FiClock className="w-4 h-4" />
            <span className="hidden sm:inline">Concentration</span>
          </button>
        )}

        {/* Notifications */}
        <button className="relative text-slate-500 hover:text-slate-900 p-2 rounded-xl hover:bg-slate-100">
          <FiBell className="w-5 h-5" />
          <span className="absolute top-1.5 right-1.5 w-2 h-2 bg-rose-500 rounded-full" />
        </button>
      </div>
    </header>
  );
}
