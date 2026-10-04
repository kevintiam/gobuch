export const features = [
  {
    icon: "📖",
    title: "Cours Intégrés",
    desc: "Lis tes cours directement dans la plateforme. Vidéos, PDF, exercices tout en un.",
    color: "bg-brand-50 border-brand-200",
    badge: "bg-brand-100 text-brand-700",
  },
  {
    icon: "⚡",
    title: "Défis Multijoueurs",
    desc: "Affronte tes camarades en temps réel. Style Kahoot plus vite tu réponds, plus tu marques.",
    color: "bg-accent-50 border-accent-200",
    badge: "bg-accent-100 text-accent-700",
  },
  {
    icon: "🤖",
    title: "Chatbot IA Éducatif",
    desc: "Un assistant IA bloqué sur les sujets scolaires. Il t'explique le cours que tu lis.",
    color: "bg-emerald-50 border-emerald-200",
    badge: "bg-emerald-100 text-emerald-700",
  },
  {
    icon: "📋",
    title: "Banque d'Épreuves",
    desc: "Tous les anciens sujets du BAC, BEPC et Probatoire. Filtre par matière et année.",
    color: "bg-sky-50 border-sky-200",
    badge: "bg-sky-100 text-sky-700",
  },
  {
    icon: "⏱️",
    title: "Mode Concentration",
    desc: "Minuteur Pomodoro intégré. Travaille 25 min, repose 5 min sans distraction.",
    color: "bg-rose-50 border-rose-200",
    badge: "bg-rose-100 text-rose-700",
  },
  {
    icon: "📶",
    title: "Accès Hors-Ligne",
    desc: "Télécharge tes cours et lis-les même sans connexion. Parfait pour les zones rurales.",
    color: "bg-teal-50 border-teal-200",
    badge: "bg-teal-100 text-teal-700",
  },
];

export const testimonials = [
  {
    name: "Clarisse Ngo Biyong",
    level: "Terminale A · Yaoundé",
    text: "Grâce à Gobuch j'ai eu 14/20 en Français au BAC. Le chatbot IA m'expliquait les textes que je ne comprenais pas. C'est vraiment révolutionnaire.",
    avatar: "CN",
    color: "bg-brand-500",
  },
  {
    name: "Serge Talla",
    level: "3ème · Douala",
    text: "Les défis multijoueurs avec mes amis le soir, c'est trop bien ! On révise en s'amusant. J'ai progressé en Maths sans m'en rendre compte.",
    avatar: "ST",
    color: "bg-accent-500",
  },
  {
    name: "Fatou Diallo",
    level: "Terminale D · Bafoussam",
    text: "Je n'avais pas Internet stable, mais avec le mode hors-ligne j'ai pu réviser SVT pendant les coupures de courant. Résultat : mention Bien.",
    avatar: "FD",
    color: "bg-emerald-500",
  },
];

export const steps = [
  {
    n: "01",
    title: "Inscris-toi gratuitement",
    desc: "Crée ton compte en 30 secondes. Pas de carte bancaire requise.",
  },
  {
    n: "02",
    title: "Choisis ta classe et tes matières",
    desc: "6ème jusqu'en Terminale. BAC A, C, D, E on couvre tout le programme camerounais.",
  },
  {
    n: "03",
    title: "Apprends à ton rythme",
    desc: "Cours, exercices, défis et chatbot IA disponibles 24h/24. Depuis ton téléphone.",
  },
];

export const levels = [
  "6ème",
  "5ème",
  "4ème",
  "3ème",
  "2nde A",
  "2nde C",
  "1ère A",
  "1ère C",
  "1ère D",
  "Terminale A",
  "Terminale C",
  "Terminale D",
  "Terminale E",
  "Terminale F",
];

export const regions = [
  "Centre",
  "Littoral",
  "Ouest",
  "Nord-Ouest",
  "Sud-Ouest",
  "Adamaoua",
  "Est",
  "Extrême-Nord",
  "Nord",
  "Sud",
];

export const TONS = {
  brand: "bg-brand-50 text-brand-600",
  amber: "bg-amber-50 text-amber-600",
  emerald: "bg-emerald-50 text-emerald-600",
  rose: "bg-rose-50 text-rose-600",
} as const;
