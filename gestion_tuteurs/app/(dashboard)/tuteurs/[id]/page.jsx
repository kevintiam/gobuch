import { prisma } from "@/lib/prisma";
import { notFound } from "next/navigation";
import Link from "next/link";

export default async function TuteurDetailPage({ params }) {
  const { id } = await params;
  const tuteur = await prisma.enseignant.findUnique({
    where: { idutilisateur: Number(id) },
    include: {
      utilisateur: true,
      ensmatclas: {
        include: { matiere: true, classe: true },
      },
      estsollicitee: {
        include: {
          demande: { include: { utilisateur: true } },
          matiere: true,
          seances: true,
        },
        orderBy: { idestsollicitee: "desc" },
        take: 10,
      },
    },
  });

  if (!tuteur) notFound();

  const { utilisateur: u } = tuteur;

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
    <div className="max-w-4xl">
      <Link href="/tuteurs" className="text-sm text-blue-600 hover:underline mb-6 inline-block">
        ← Retour à la liste
      </Link>

      <div className="bg-white rounded-xl border border-gray-200 p-6 mb-6">
        <div className="flex items-start gap-6">
          <div className="w-20 h-20 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 font-bold text-3xl flex-shrink-0">
            {u.prenom[0]}{u.nom[0]}
          </div>
          <div className="flex-1">
            <h1 className="text-2xl font-bold text-gray-900">{u.prenom} {u.nom}</h1>
            <p className="text-gray-500 text-sm mt-1">{u.nomuser}</p>
            <div className="flex flex-wrap gap-4 mt-4 text-sm text-gray-600">
              {tuteur.ville && (
                <span className="flex items-center gap-1">
                  <svg className="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                  </svg>
                  {tuteur.ville}{tuteur.quartier ? `, ${tuteur.quartier}` : ""}
                </span>
              )}
              {u.numtelsimpl && (
                <span className="flex items-center gap-1">
                  <svg className="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.948V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                  </svg>
                  {u.numtelsimpl}
                </span>
              )}
              <span className={`px-2 py-0.5 rounded-full text-xs font-medium ${
                tuteur.dispo === "1" ? "bg-green-100 text-green-700" : "bg-gray-100 text-gray-500"
              }`}>
                {tuteur.dispo === "1" ? "Disponible" : "Indisponible"}
              </span>
            </div>
          </div>
        </div>
      </div>

      <div className="bg-white rounded-xl border border-gray-200 p-6 mb-6">
        <h2 className="font-semibold text-gray-900 mb-4">Matières enseignées</h2>
        {tuteur.ensmatclas.length === 0 ? (
          <p className="text-sm text-gray-400">Aucune matière assignée</p>
        ) : (
          <div className="overflow-x-auto">
            <table className="w-full text-sm">
              <thead>
                <tr className="text-left text-xs text-gray-400 uppercase tracking-wide border-b border-gray-100">
                  <th className="pb-3 pr-6">Matière</th>
                  <th className="pb-3">Niveau / Classe</th>
                </tr>
              </thead>
              <tbody className="divide-y divide-gray-50">
                {tuteur.ensmatclas.map((emc) => (
                  <tr key={emc.idensmatclas}>
                    <td className="py-3 pr-6 font-medium text-gray-800">{emc.matiere.nomatiere}</td>
                    <td className="py-3 text-gray-600">{emc.classe.nomclasse}</td>
                  </tr>
                ))}
              </tbody>
            </table>
          </div>
        )}
      </div>

      <div className="bg-white rounded-xl border border-gray-200 p-6">
        <h2 className="font-semibold text-gray-900 mb-4">
          Dernières demandes reçues
          <span className="ml-2 text-xs font-normal text-gray-400">({tuteur.estsollicitee.length})</span>
        </h2>
        {tuteur.estsollicitee.length === 0 ? (
          <p className="text-sm text-gray-400">Aucune demande reçue</p>
        ) : (
          <div className="space-y-3">
            {tuteur.estsollicitee.map((es) => (
              <div key={es.idestsollicitee} className="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                <div>
                  <p className="font-medium text-sm text-gray-900">
                    {es.demande.utilisateur.prenom} {es.demande.utilisateur.nom}
                  </p>
                  <p className="text-xs text-gray-500 mt-0.5">
                    {es.matiere.nomatiere} · {es.jourcours ?? "—"} · {es.horairedeb ?? "—"}
                    {es.duree ? ` · ${es.duree}h` : ""}
                  </p>
                </div>
                <div className="flex items-center gap-3">
                  <span className="text-sm font-semibold text-gray-700">
                    {es.montant ? `${es.montant} FCFA` : "—"}
                  </span>
                  <span className={`px-2 py-0.5 rounded-full text-xs font-medium ${decisionColor[es.decision ?? "0"] ?? "bg-gray-100 text-gray-600"}`}>
                    {decisionLabel[es.decision ?? "0"] ?? es.decision}
                  </span>
                </div>
              </div>
            ))}
          </div>
        )}
      </div>
    </div>
  );
}
