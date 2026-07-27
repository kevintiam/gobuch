import { prisma } from "@/lib/prisma";
import Link from "next/link";

export default async function TuteursPage() {
  const tuteurs = await prisma.enseignant.findMany({
    include: {
      utilisateur: true,
      ensmatclas: {
        include: {
          matiere: true,
          classe: true,
        },
      },
    },
  });

  return (
    <div>
      <div className="flex items-center justify-between mb-8">
        <div>
          <h1 className="text-2xl font-bold text-gray-900">Tuteurs</h1>
          <p className="text-sm text-gray-500 mt-1">{tuteurs.length} tuteur(s) enregistré(s)</p>
        </div>
      </div>

      {tuteurs.length === 0 ? (
        <div className="text-center py-16 text-gray-400">
          <svg className="w-12 h-12 mx-auto mb-4 opacity-40" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={1.5} d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" />
          </svg>
          <p>Aucun tuteur enregistré</p>
        </div>
      ) : (
        <div className="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
          {tuteurs.map((tuteur) => {
            const matieres = [...new Set(tuteur.ensmatclas.map((e) => e.matiere.nomatiere))];
            const classes = [...new Set(tuteur.ensmatclas.map((e) => e.classe.nomclasse))];
            return (
              <Link
                key={tuteur.idutilisateur}
                href={`/tuteurs/${tuteur.idutilisateur}`}
                className="bg-white rounded-xl border border-gray-200 p-6 hover:shadow-md hover:border-blue-200 transition-all"
              >
                <div className="flex items-center gap-4 mb-4">
                  <div className="w-12 h-12 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 font-bold text-lg flex-shrink-0">
                    {tuteur.utilisateur.prenom[0]}{tuteur.utilisateur.nom[0]}
                  </div>
                  <div>
                    <p className="font-semibold text-gray-900">
                      {tuteur.utilisateur.prenom} {tuteur.utilisateur.nom}
                    </p>
                    <p className="text-xs text-gray-500">{tuteur.ville ?? "Ville non renseignée"}</p>
                  </div>
                </div>

                {matieres.length > 0 && (
                  <div className="mb-3">
                    <p className="text-xs text-gray-400 mb-1 uppercase tracking-wide font-medium">Matières</p>
                    <div className="flex flex-wrap gap-1">
                      {matieres.map((m) => (
                        <span key={m} className="px-2 py-0.5 bg-blue-50 text-blue-700 text-xs rounded-full">
                          {m}
                        </span>
                      ))}
                    </div>
                  </div>
                )}

                {classes.length > 0 && (
                  <div>
                    <p className="text-xs text-gray-400 mb-1 uppercase tracking-wide font-medium">Niveaux</p>
                    <div className="flex flex-wrap gap-1">
                      {classes.map((c) => (
                        <span key={c} className="px-2 py-0.5 bg-gray-100 text-gray-600 text-xs rounded-full">
                          {c}
                        </span>
                      ))}
                    </div>
                  </div>
                )}

                <div className="mt-4 pt-4 border-t border-gray-100 flex items-center justify-between text-xs text-gray-400">
                  <span>{tuteur.quartier ?? "Quartier non renseigné"}</span>
                  <span
                    className={`px-2 py-0.5 rounded-full ${
                      tuteur.dispo === "1"
                        ? "bg-green-100 text-green-600"
                        : "bg-gray-100 text-gray-500"
                    }`}
                  >
                    {tuteur.dispo === "1" ? "Disponible" : "Indisponible"}
                  </span>
                </div>
              </Link>
            );
          })}
        </div>
      )}
    </div>
  );
}
