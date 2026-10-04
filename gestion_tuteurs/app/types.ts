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

export type TutorInfos = {
  userId: number;
  firstName: string;
  email: string;
  lastName: string;
  gender: string | null;
  createdAt: string;
  bio: string | null;
  photo: string | null;
  phone: string | null;
  whatsapp: string | null;
  locationMap: string | null;
  city: string | null;
  district: string | null;
  availability: string | null;
  isVerified: boolean;
  verifiedAt: string | null;
  averageRating: number | null;
  reviewsCount: number;
  revenus: number;

  assignments: {
    id: number;

    subject: {
      id: number;
      name: string;
    };

    level: {
      id: number;
      name: string;
      cycle: string | null;
    };
  }[];

  applications: {
    id: number;
    status: "PENDING" | "ACCEPTED" | "DECLINED";
    createdAt: string;
  }[];
  request: {
    id: number;
    applicationId: number;
    applicationStatus: "PENDING" | "ACCEPTED" | "DECLINED";
    status: "OPEN" | "FULFILLED" | "CANCELLED";
    createdAt: string;
    montantOffert: number ;
    subject: string;
    day: string | null;
    time: string | null;
    duration: number | null;
    gender: "MALE" | "FEMALE" | null;
    place: string | null;
    student: {
      id: number; 
      firstName: string;
      lastName: string;
      level: {
        id: number;
        name: string;
      };
    }
  }[];
} ;
