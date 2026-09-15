import { FiMapPin, FiClock, FiPhone, FiSmartphone } from "react-icons/fi";

import { getTuteurDashboard } from "@/data/selectors";
import PageTitle from "@/components/dashboard/PageTitle";
import { requireRole } from "@/lib/guards";

// Fiche du tuteur connecte. L'edition passera par PATCH /api/tuteurs/[id], qui
// autorise deja un enseignant a modifier sa propre fiche (dispo, ville,
// quartier) — mais elle attend une base de donnees joignable.

function Champ({
  label,
  valeur,
  icone,
}: {
  label: string;
  valeur: string | null | undefined;
  icone?: React.ReactNode;
}) {
  return (
    <div>
      <dt className="text-xs text-gray-400 uppercase tracking-wide font-medium mb-1">
        {label}
      </dt>
      <dd className="text-sm text-gray-800 flex items-center gap-1.5">
        {icone}
        {valeur ?? <span className="text-gray-400">Non renseigné</span>}
      </dd>
    </div>
  );
}

export default async function ProfilPage() {
  const session = await requireRole("enseignant");
  const data = getTuteurDashboard(Number(session.user?.id));

  if (!data) {
    return (
      <p className="text-gray-500">
        Aucune fiche tuteur pour le compte connecté.
      </p>
    );
  }

  const { tuteur, matieres, classes } = data;
  const u = tuteur.utilisateur;

  return (
    <div>
      <PageTitle
        titre="Mon profil"
        sousTitre="Les informations que les élèves voient avant de te solliciter."
      />

      <section className="rounded-2xl border border-slate-200/70 bg-white shadow-sm shadow-slate-200/50 p-6">
        <div className="flex items-center gap-4 pb-6 mb-6 border-b border-gray-100">
          <div className="w-16 h-16 rounded-full bg-brand-100 flex items-center justify-center text-brand-600 font-bold text-2xl flex-shrink-0">
            {u.prenom[0]}
            {u.nom[0]}
          </div>
          <div>
            <p className="text-lg font-semibold text-gray-900">
              {u.prenom} {u.nom}
            </p>
            <p className="text-sm text-gray-500">Tuteur · compte n° {tuteur.idutilisateur}</p>
          </div>
        </div>

        <dl className="grid sm:grid-cols-2 gap-6">
          <Champ
            label="Ville"
            valeur={tuteur.ville}
            icone={<FiMapPin className="w-3.5 h-3.5 text-gray-400" />}
          />
          <Champ label="Quartier" valeur={tuteur.quartier} />
          <Champ
            label="Téléphone"
            valeur={u.numtelsimpl}
            icone={<FiPhone className="w-3.5 h-3.5 text-gray-400" />}
          />
          <Champ
            label="WhatsApp"
            valeur={u.numtelwh}
            icone={<FiSmartphone className="w-3.5 h-3.5 text-gray-400" />}
          />
          <div className="sm:col-span-2">
            <Champ
              label="Disponibilités"
              valeur={tuteur.dispo}
              icone={<FiClock className="w-3.5 h-3.5 text-gray-400" />}
            />
          </div>
        </dl>
      </section>

      <section className="mt-6 rounded-2xl border border-slate-200/70 bg-white shadow-sm shadow-slate-200/50 p-6">
        <h2 className="font-semibold text-gray-900 mb-4">Mes enseignements</h2>
        <div className="grid sm:grid-cols-2 gap-4">
          <div>
            <p className="text-xs text-gray-400 mb-2 uppercase tracking-wide font-medium">
              Matières
            </p>
            <div className="flex flex-wrap gap-1.5">
              {matieres.map((m) => (
                <span
                  key={m}
                  className="text-xs font-medium px-2.5 py-1 rounded-full bg-brand-50 text-brand-700"
                >
                  {m}
                </span>
              ))}
            </div>
          </div>
          <div>
            <p className="text-xs text-gray-400 mb-2 uppercase tracking-wide font-medium">
              Classes
            </p>
            <div className="flex flex-wrap gap-1.5">
              {classes.map((c) => (
                <span
                  key={c}
                  className="text-xs font-medium px-2.5 py-1 rounded-full bg-gray-100 text-gray-700"
                >
                  {c}
                </span>
              ))}
            </div>
          </div>
        </div>
      </section>

      <p className="text-xs text-gray-400 mt-4">
        La modification de la ville, du quartier et des disponibilités sera
        activée une fois la base de données branchée.
      </p>
    </div>
  );
}
