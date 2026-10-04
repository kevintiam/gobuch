export type Role = "eleve" | "tutor" | "admin";

export const HOME_BY_ROLE: Record<Role, string> = {
  tutor: "/tuteur",
  admin: "/tuteurs",
  eleve: "/eleve",
};

export function homeForRole(role: unknown): string {
  if (typeof role === "string" && role in HOME_BY_ROLE) {
    return HOME_BY_ROLE[role as Role];
  }
  
  return "/login";
}