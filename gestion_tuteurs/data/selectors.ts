import { type TutorInfos } from "@/app/types";

export type TuteurDashboard = {
  name: string;
  genre: string | null;
  email: string;
  sujets: string[];
  levels: string[];
  photo: string | null;
  availability: string | null;
  revenus: number;
  assignments: {
    id: number;
    subject: string;
  }[] | null;
  received: number;
  applications: {
    id: number;
    status: "PENDING" | "ACCEPTED" | "DECLINED";
    createdAt: string;
  }[];
  accepted: number;
  pending: number;
  declined: number;
  request: {
    id: number;
    applicationId: number;
    applicationStatus: "PENDING" | "ACCEPTED" | "DECLINED";
    status: "OPEN" | "FULFILLED" | "CANCELLED";
    createdAt: string;
    montant: number;
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
      level: string;
    };
  }[];
  montant: number;
};

export const formatTutorDashboard = (data: TutorInfos|null) : TuteurDashboard | null => {
  if(!data) return null;

    const compter = (status: TuteurDashboard["applications"][number]["status"]) =>
    data.applications.filter((application) => application.status === status)
      .length;

  return {
    name: `${data?.firstName} ${data?.lastName}`,
    genre: data?.gender,
    email: data?.email,
    photo: data?.photo,
    availability: data?.availability,
    revenus: data?.revenus,
    sujets: [
      ...new Set(data?.assignments.map((a) => a.subject.name)),
    ],
    levels: [
      ...new Set(data?.assignments.map((a) => a.level.name)),
    ],
    assignments: data?.assignments.map((a) => ({
      id: a.id,
      subject: a.subject.name,
    })),
    received: data?.applications.length,
    applications: data?.applications.map((ap) => ({
      id: ap.id,
      status: ap.status,
      createdAt: ap.createdAt,
    })),
    request: data.request.map((request) => ({
      id: request.id,
      applicationId: request.applicationId,
      applicationStatus: request.applicationStatus,
      status: request.status,
      createdAt: request.createdAt,
      montant: request.montantOffert,
      subject: request.subject,
      day: request.day,
      time: request.time,
      duration: request.duration,
      gender: request.gender,
      place: request.place,
      student: {
        id: request.student.id,
        firstName: request.student.firstName,
        lastName: request.student.lastName,
        level: request.student.level.name,
      },
    })),
    accepted: compter("ACCEPTED"),
    pending: compter("PENDING"),
    declined: compter("DECLINED"),
        montant: data.request.reduce((total, request) => total + request.montantOffert, 0),

  };
};

export const formatDuree = (minutes: number | null) => {
  if (!minutes) return null;
  const heures = Math.floor(minutes / 60);
  const reste = minutes % 60;
  if (heures === 0) return `${reste} min`;
  return reste === 0
    ? `${heures} h`
    : `${heures} h ${String(reste).padStart(2, "0")}`;
};
