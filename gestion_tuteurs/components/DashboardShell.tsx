"use client";

import { useState } from "react";
import Sidebar from "@/components/Sidebar";
import Header from "./header";


export default function DashboardShell({
  role,
  nom,
  children,
}: {
  role?: string;
  nom?: string;
  children: React.ReactNode;
}) {
  const [menuOpen, setMenuOpen] = useState(false);

  return (
    <div className="flex h-screen overflow-hidden bg-slate-50">
      <Sidebar
        role={role}
        nom={nom}
        open={menuOpen}
        onClose={() => setMenuOpen(false)}
      />

      {menuOpen && (
        <div
          aria-hidden="true"
          onClick={() => setMenuOpen(false)}
          className="fixed inset-0 z-30 bg-slate-900/50 lg:hidden"
        />
      )}

      <div className="flex min-w-0 flex-1 flex-col overflow-hidden">
        <Header onMenuClick={() => setMenuOpen(true)} role={role} />
        <main className="flex-1 overflow-y-auto">
          <div className="p-6 lg:p-8 max-w-7xl mx-auto">
            {children}
          </div>
        </main>
      </div>
    </div>
  );
}
