import { prisma } from "@/lib/prisma";

export default async function DemandesPage() {
  const demandes = await prisma.demande.findMany({
    include: {
      utilisateur: true,
      classe: true,
      estsollicitee: {
        include: {
          enseignant: { include: { utilisateur: true } },
          matiere: true,
        },
      },
    },
    orderBy: { idemande: "desc" },
  });

  const decisionLabel = {
    "0": "En attente",
    "1": "Acceptée",
    "2": "Refusée",
  };
  const decisionColor = {
    "0": "bg-yellow-100 text-yellow-700",
    "1": "bg-green-100 text-green-700",
    "2": "bg-red-100 text-red-700",
  };

  return (
    <div>
      <div className="mb-8">
        <h1 className="text-2xl font-bold text-gray-900">Demandes de tutorat</h1>
        <p className="text-sm text-gray-500 mt-1">{demandes.length} demande(s) au total</p>
      </div>

      {demandes.length === 0 ? (
        <div className="text-center py-16 text-gray-400">
          <svg className="w-12 h-12 mx-auto mb-4 opacity-40" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={1.5} d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
          </svg>
          <p>Aucune demande enregistrée</p>
        </div>
      ) : (
        <div className="space-y-4">
          {demandes.map((demande) => (
            <div key={demande.idemande} className="bg-white rounded-xl border border-gray-200 p-6">
              <div className="flex items-start justify-between mb-4">
                <div>
                  <h3 className="font-semibold text-gray-900">
                    {demande.utilisateur.prenom} {demande.utilisateur.nom}
                  </h3>
                  <p className="text-xs text-gray-400 mt-0.5">
                    Demande #{demande.idemande} · Classe : {demande.classe.nomclasse}
                    {demande.date ? ` · ${demande.date}` : ""}
                  </p>
                </div>
                {demande.lieusouh && (
                  <span className="text-xs text-gray-500 bg-gray-100 px-3 py-1 rounded-full">
                    {demande.lieusouh}
                  </span>
                )}
              </div>

              {demande.estsollicitee.length === 0 ? (
                <p className="text-sm text-gray-400 italic">Aucun tuteur sollicité</p>
              ) : (
                <div className="space-y-2">
                  <p className="text-xs uppercase tracking-wide text-gray-400 font-medium mb-2">
                    Tuteurs sollicités ({demande.estsollicitee.length})
                  </p>
                  {demande.estsollicitee.map((es) => (
                    <div
                      key={es.idestsollicitee}
                      className="flex items-center justify-between bg-gray-50 rounded-lg px-4 py-3"
                    >
                      <div className="flex items-center gap-3">
                        <div className="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 text-xs font-bold">
                          {es.enseignant.utilisateur.prenom[0]}{es.enseignant.utilisateur.nom[0]}
                        </div>
                        <div>
                          <p className="text-sm font-medium text-gray-800">
                            {es.enseignant.utilisateur.prenom} {es.enseignant.utilisateur.nom}
                          </p>
                          <p className="text-xs text-gray-500">
                            {es.matiere.nomatiere}
                            {es.jourcours ? ` · ${es.jourcours}` : ""}
                            {es.horairedeb ? ` à ${es.horairedeb}` : ""}
                            {es.duree ? ` · ${es.duree}h` : ""}
                          </p>
                        </div>
                      </div>
                      <div className="flex items-center gap-3">
                        {es.montant && (
                          <span className="text-sm font-semibold text-gray-700">{es.montant} FCFA</span>
                        )}
                        <span className={`px-2 py-0.5 rounded-full text-xs font-medium ${decisionColor[es.decision ?? "0"] ?? "bg-gray-100 text-gray-600"}`}>
                          {decisionLabel[es.decision ?? "0"] ?? es.decision}
                        </span>
                      </div>
                    </div>
                  ))}
                </div>
              )}
            </div>
          ))}
        </div>
      )}
    </div>
  );
}
