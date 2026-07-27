import { prisma } from "@/lib/prisma";

export default async function SeancesPage() {
  const seances = await prisma.seance.findMany({
    include: {
      estsollicitee: {
        include: {
          enseignant: { include: { utilisateur: true } },
          demande: { include: { utilisateur: true } },
          matiere: true,
        },
      },
    },
    orderBy: { idseance: "desc" },
  });

  const statusColor = {
    "1": "bg-green-100 text-green-700",
    "0": "bg-yellow-100 text-yellow-700",
    "2": "bg-red-100 text-red-700",
  };

  return (
    <div>
      <div className="mb-8">
        <h1 className="text-2xl font-bold text-gray-900">Séances</h1>
        <p className="text-sm text-gray-500 mt-1">{seances.length} séance(s) au total</p>
      </div>

      {seances.length === 0 ? (
        <div className="text-center py-16 text-gray-400">
          <svg className="w-12 h-12 mx-auto mb-4 opacity-40" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={1.5} d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
          </svg>
          <p>Aucune séance enregistrée</p>
        </div>
      ) : (
        <div className="bg-white rounded-xl border border-gray-200 overflow-hidden">
          <table className="w-full text-sm">
            <thead className="bg-gray-50 border-b border-gray-200">
              <tr className="text-left text-xs text-gray-400 uppercase tracking-wide">
                <th className="px-6 py-4">#</th>
                <th className="px-6 py-4">Élève</th>
                <th className="px-6 py-4">Tuteur</th>
                <th className="px-6 py-4">Matière</th>
                <th className="px-6 py-4">Date</th>
                <th className="px-6 py-4">Horaire</th>
                <th className="px-6 py-4">Montant</th>
                <th className="px-6 py-4">Statut</th>
              </tr>
            </thead>
            <tbody className="divide-y divide-gray-100">
              {seances.map((s) => {
                const es = s.estsollicitee;
                return (
                  <tr key={s.idseance} className="hover:bg-gray-50 transition-colors">
                    <td className="px-6 py-4 text-gray-400 font-mono text-xs">#{s.idseance}</td>
                    <td className="px-6 py-4">
                      <p className="font-medium text-gray-900">
                        {es.demande.utilisateur.prenom} {es.demande.utilisateur.nom}
                      </p>
                    </td>
                    <td className="px-6 py-4">
                      <p className="font-medium text-gray-900">
                        {es.enseignant.utilisateur.prenom} {es.enseignant.utilisateur.nom}
                      </p>
                    </td>
                    <td className="px-6 py-4 text-gray-600">{es.matiere.nomatiere}</td>
                    <td className="px-6 py-4 text-gray-600">{s.dateseance ?? "—"}</td>
                    <td className="px-6 py-4 text-gray-600">
                      {s.heuredeb && s.heurefin
                        ? `${s.heuredeb} – ${s.heurefin}`
                        : s.heuredeb ?? "—"}
                    </td>
                    <td className="px-6 py-4 font-semibold text-gray-700">
                      {s.total ? `${s.total} FCFA` : "—"}
                    </td>
                    <td className="px-6 py-4">
                      <span className={`px-2 py-0.5 rounded-full text-xs font-medium ${statusColor[s.decisionsea ?? "0"] ?? "bg-gray-100 text-gray-600"}`}>
                        {s.decisionsea === "1" ? "Confirmée" : s.decisionsea === "2" ? "Annulée" : "En attente"}
                      </span>
                    </td>
                  </tr>
                );
              })}
            </tbody>
          </table>
        </div>
      )}
    </div>
  );
}
