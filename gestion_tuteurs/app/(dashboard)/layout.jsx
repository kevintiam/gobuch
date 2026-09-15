import { auth } from "@/lib/auth";
import { redirect } from "next/navigation";
import DashboardShell from "@/components/DashboardShell";

export default async function DashboardLayout({ children }) {
  const session = await auth();
  if (!session) redirect("/login");

  // Le layout ne connait pas la page demandee : le controle fin du role est
  // fait par requireRole() dans chaque page (lib/guards.ts).
  return (
    <DashboardShell role={session.user?.role} nom={session.user?.name}>
      {children}
    </DashboardShell>
  );
}
