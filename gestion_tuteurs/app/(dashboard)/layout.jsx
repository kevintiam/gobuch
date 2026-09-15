import { auth } from "@/lib/auth";
import { redirect } from "next/navigation";
import Sidebar from "@/components/Sidebar";

export default async function DashboardLayout({ children }) {
  const session = await auth();
  if (!session) redirect("/login");

  // Le layout ne connait pas la page demandee : le controle fin est fait par
  // requireRole() dans chaque page (lib/guards.ts). Ici on ne fait que passer
  // le role et le nom a la barre laterale.
  return (
    <div className="flex min-h-screen bg-slate-50">
      <Sidebar role={session.user?.role} nom={session.user?.name} />
      <main className="flex-1 overflow-auto">
        <div className="mx-auto max-w-6xl px-6 py-8 lg:px-10 lg:py-10">
          {children}
        </div>
      </main>
    </div>
  );
}
