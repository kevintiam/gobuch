// Types partagés de l'application
export  type Page =
  | "dashboard"
  | "courses"
  | "exams"
  | "challenge"
  | "chatbot"
  | "community"
  | "pricing"
  | "tuteurs";


// Props pour le composant Banner
export interface Props {
  setPage: (p: Page) => void;
}
