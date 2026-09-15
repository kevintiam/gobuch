// Vues derivees des donnees factices : regroupe, pour un tuteur donne, ce que
// son tableau de bord affiche. Les sollicitations ne portent que le nom et le
// prenom de l'enseignant (c'est la forme renvoyee par /api/demandes), on
// rapproche donc sur ces deux champs.
import {
  TUTEURS,
  DEMANDES,
  SEANCES,
  type Tuteur,
  type Demande,
  type Seance,
  type Sollicitation,
} from "./mockData";

export type SollicitationAvecDemande = {
  sollicitation: Sollicitation;
  demande: Demande;
};

export type TuteurDashboard = {
  tuteur: Tuteur;
  matieres: string[];
  classes: string[];
  sollicitations: SollicitationAvecDemande[];
  seancesAVenir: Seance[];
  seancesPassees: Seance[];
  stats: {
    demandesRecues: number;
    enAttente: number;
    acceptees: number;
    revenus: number;
  };
};

const memeEnseignant = (
  t: Tuteur,
  e: { utilisateur: { nom: string; prenom: string } },
) => e.utilisateur.nom === t.utilisateur.nom && e.utilisateur.prenom === t.utilisateur.prenom;

export function getTuteurDashboard(
  idutilisateur: number,
  aujourdhui = new Date().toISOString().slice(0, 10),
): TuteurDashboard | null {
  const tuteur = TUTEURS.find((t) => t.idutilisateur === idutilisateur);
  if (!tuteur) return null;

  const sollicitations: SollicitationAvecDemande[] = DEMANDES.flatMap((demande) =>
    demande.estsollicitee
      .filter((s) => memeEnseignant(tuteur, s.enseignant))
      .map((sollicitation) => ({ sollicitation, demande })),
  );

  const idsSollicitations = new Set(
    sollicitations.map(({ sollicitation }) => sollicitation.idestsollicitee),
  );
  const seances = SEANCES.filter((s) =>
    idsSollicitations.has(s.estsollicitee.idestsollicitee),
  );

  return {
    tuteur,
    matieres: [...new Set(tuteur.ensmatclas.map((e) => e.matiere.nomatiere))],
    classes: [...new Set(tuteur.ensmatclas.map((e) => e.classe.nomclasse))],
    sollicitations,
    seancesAVenir: seances.filter((s) => (s.dateseance ?? "") >= aujourdhui),
    seancesPassees: seances.filter((s) => (s.dateseance ?? "") < aujourdhui),
    stats: {
      demandesRecues: sollicitations.length,
      enAttente: sollicitations.filter((s) => s.sollicitation.decision === "0").length,
      acceptees: sollicitations.filter((s) => s.sollicitation.decision === "1").length,
      // Seules les seances validees sont comptees comme encaissees.
      revenus: seances
        .filter((s) => s.decisionsea === "1")
        .reduce((total, s) => total + Number(s.total ?? 0), 0),
    },
  };
}
