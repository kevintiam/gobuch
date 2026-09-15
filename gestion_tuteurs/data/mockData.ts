
export type Role = "eleve" | "enseignant" | "admin";

/** Codes stockes en base par Demande/Seance (voir app/(dashboard)/demandes). */
export type Decision = "0" | "1" | "2";

export const DECISION_LABEL: Record<Decision, string> = {
  "0": "En attente",
  "1": "Acceptée",
  "2": "Refusée",
};

export type User = {
  idutilisateur: number;
  nom: string;
  prenom: string;
  email: string;
  motpasse: string;
  numtelsimpl?: string;
  numtelwh?: string;
  role: Role;
  classe?: string;
};

export type Matiere = { idmatiere: number; nomatiere: string };
export type Classe = { idclasse: number; nomclasse: string };

/** Forme renvoyee par GET /api/tuteurs. */
export type Tuteur = {
  idutilisateur: number;
  photo: string | null;
  ville: string | null;
  quartier: string | null;
  dispo: string | null;
  utilisateur: Pick<
    User,
    "idutilisateur" | "nom" | "prenom" | "numtelsimpl" | "numtelwh"
  >;
  ensmatclas: {
    idensmatclas: number;
    matiere: Matiere;
    classe: Classe;
  }[];
};

/** Une proposition faite a un tuteur pour une demande donnee. */
export type Sollicitation = {
  idestsollicitee: number;
  idemande: number;
  duree: string | null;
  horairedeb: string | null;
  jourcours: string | null;
  decision: Decision;
  montant: string | null;
  tauxensei: string | null;
  matiere: Matiere;
  enseignant: { utilisateur: Pick<User, "nom" | "prenom"> };
};

/** Forme renvoyee par GET /api/demandes. */
export type Demande = {
  idemande: number;
  genresouh: string | null;
  date: string | null;
  heure: string | null;
  lieusouh: string | null;
  classe: Classe;
  utilisateur: Pick<User, "idutilisateur" | "nom" | "prenom">;
  estsollicitee: Sollicitation[];
};

/** Forme renvoyee par GET /api/seances. */
export type Seance = {
  idseance: number;
  dateseance: string | null;
  heuredeb: string | null;
  heurefin: string | null;
  duree: string | null;
  taux: string | null;
  total: string | null;
  decisionsea: Decision;
  estsollicitee: {
    idestsollicitee: number;
    matiere: Matiere;
    enseignant: { utilisateur: Pick<User, "nom" | "prenom"> };
    demande: { utilisateur: Pick<User, "nom" | "prenom"> };
  };
};

// ────────────────────────  Referentiels  ────────────────────────

export const MATIERES: Matiere[] = [
  { idmatiere: 1, nomatiere: "Mathématiques" },
  { idmatiere: 2, nomatiere: "Physique-Chimie" },
  { idmatiere: 3, nomatiere: "SVT" },
  { idmatiere: 4, nomatiere: "Français" },
  { idmatiere: 5, nomatiere: "Anglais" },
  { idmatiere: 6, nomatiere: "Histoire-Géographie" },
  { idmatiere: 7, nomatiere: "Philosophie" },
];

export const CLASSES: Classe[] = [
  { idclasse: 1, nomclasse: "6ème" },
  { idclasse: 2, nomclasse: "5ème" },
  { idclasse: 3, nomclasse: "4ème" },
  { idclasse: 4, nomclasse: "3ème" },
  { idclasse: 5, nomclasse: "2nde" },
  { idclasse: 6, nomclasse: "1ère" },
  { idclasse: 7, nomclasse: "Terminale C" },
  { idclasse: 8, nomclasse: "Terminale D" },
];

// Raccourcis pour garder les objets ci-dessous lisibles.
const m = (id: number) => MATIERES.find((x) => x.idmatiere === id)!;
const c = (id: number) => CLASSES.find((x) => x.idclasse === id)!;

// ──────────────────────────  Comptes  ──────────────────────────

// Mots de passe en clair : c'est deja le cas en base (voir lib/auth.js, qui
// compare user.motpasse !== motpasse). A hacher avec bcryptjs avant la prod.
export const USERS: User[] = [
  {
    idutilisateur: 1,
    nom: "Ngo Biyong",
    prenom: "Clarisse",
    email: "clarisse.ngo@gmail.com",
    motpasse: "eleve123",
    numtelsimpl: "690112233",
    role: "eleve",
    classe: "Terminale A",
  },
  {
    idutilisateur: 2,
    nom: "Talla",
    prenom: "Serge",
    email: "serge.talla",
    motpasse: "eleve123",
    numtelsimpl: "677445566",
    role: "eleve",
    classe: "3ème",
  },
  {
    idutilisateur: 10,
    nom: "Mbarga",
    prenom: "Amina",
    email: "amina.mbarga@gmail.com",
    motpasse: "tuteur123",
    numtelsimpl: "699887766",
    numtelwh: "699887766",
    role: "enseignant",
  },
  {
    idutilisateur: 11,
    nom: "Fotso",
    prenom: "Bertrand",
    email: "bertrand.fotso",
    motpasse: "tuteur123",
    numtelsimpl: "678332211",
    role: "enseignant",
  },
  {
    idutilisateur: 99,
    nom: "Admin",
    prenom: "Gobuch",
    email: "admin@gobuch.cm",
    motpasse: "admin123",
    role: "admin",
  },
];

/**
 * Reproduit authorize() de lib/auth.js : un seul champ pour le nom
 * d'utilisateur ou l'e-mail, et le role vient du compte trouve.
 */
export function findUser(identifiant: string, motpasse: string): User | null {
  const user = USERS.find((u) => u.email === identifiant);
  if (!user || user.motpasse !== motpasse) return null;
  return user;
}

// ──────────────────────────  Tuteurs  ──────────────────────────

export const TUTEURS: Tuteur[] = [
  {
    idutilisateur: 10,
    photo: null,
    ville: "Douala",
    quartier: "Bonapriso",
    dispo: "Lundi au vendredi, 16h - 20h",
    utilisateur: {
      idutilisateur: 10,
      nom: "Mbarga",
      prenom: "Amina",
      numtelsimpl: "699887766",
      numtelwh: "699887766",
    },
    ensmatclas: [
      { idensmatclas: 1, matiere: m(1), classe: c(7) },
      { idensmatclas: 2, matiere: m(1), classe: c(8) },
      { idensmatclas: 3, matiere: m(2), classe: c(7) },
    ],
  },
  {
    idutilisateur: 11,
    photo: null,
    ville: "Yaoundé",
    quartier: "Bastos",
    dispo: "Samedi et dimanche, 9h - 13h",
    utilisateur: {
      idutilisateur: 11,
      nom: "Fotso",
      prenom: "Bertrand",
      numtelsimpl: "678332211",
      numtelwh: undefined,
    },
    ensmatclas: [
      { idensmatclas: 4, matiere: m(4), classe: c(4) },
      { idensmatclas: 5, matiere: m(7), classe: c(7) },
    ],
  },
];

// ──────────────────────────  Demandes  ─────────────────────────

export const DEMANDES: Demande[] = [
  {
    idemande: 101,
    genresouh: "Femme",
    date: "2026-09-10",
    heure: "18:30",
    lieusouh: "Domicile — Douala, Bonapriso",
    classe: c(7),
    utilisateur: { idutilisateur: 1, nom: "Ngo Biyong", prenom: "Clarisse" },
    estsollicitee: [
      {
        idestsollicitee: 501,
        idemande: 101,
        duree: "2h",
        horairedeb: "17:00",
        jourcours: "Mercredi",
        decision: "1",
        montant: "30000",
        tauxensei: "2500",
        matiere: m(1),
        enseignant: { utilisateur: { nom: "Mbarga", prenom: "Amina" } },
      },
    ],
  },
  {
    idemande: 102,
    genresouh: "Indifférent",
    date: "2026-09-12",
    heure: "09:15",
    lieusouh: "En ligne",
    classe: c(4),
    utilisateur: { idutilisateur: 2, nom: "Talla", prenom: "Serge" },
    estsollicitee: [
      {
        idestsollicitee: 502,
        idemande: 102,
        duree: "1h30",
        horairedeb: "10:00",
        jourcours: "Samedi",
        decision: "0",
        montant: null,
        tauxensei: null,
        matiere: m(4),
        enseignant: { utilisateur: { nom: "Fotso", prenom: "Bertrand" } },
      },
    ],
  },
  {
    idemande: 103,
    genresouh: "Homme",
    date: "2026-09-14",
    heure: "14:00",
    lieusouh: "Domicile — Yaoundé, Bastos",
    classe: c(7),
    utilisateur: { idutilisateur: 2, nom: "Talla", prenom: "Serge" },
    estsollicitee: [],
  },
];

// ──────────────────────────  Seances  ──────────────────────────

export const SEANCES: Seance[] = [
  {
    idseance: 901,
    dateseance: "2026-09-11",
    heuredeb: "17:00",
    heurefin: "19:00",
    duree: "2h",
    taux: "2500",
    total: "5000",
    decisionsea: "1",
    estsollicitee: {
      idestsollicitee: 501,
      matiere: m(1),
      enseignant: { utilisateur: { nom: "Mbarga", prenom: "Amina" } },
      demande: { utilisateur: { nom: "Ngo Biyong", prenom: "Clarisse" } },
    },
  },
  {
    idseance: 902,
    dateseance: "2026-09-18",
    heuredeb: "17:00",
    heurefin: "19:00",
    duree: "2h",
    taux: "2500",
    total: "5000",
    decisionsea: "0",
    estsollicitee: {
      idestsollicitee: 501,
      matiere: m(1),
      enseignant: { utilisateur: { nom: "Mbarga", prenom: "Amina" } },
      demande: { utilisateur: { nom: "Ngo Biyong", prenom: "Clarisse" } },
    },
  },
];
