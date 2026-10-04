import type { DefaultSession } from "next-auth";
import type { Role } from "@/lib/roles";

// authorize() renvoie un role, que les callbacks jwt() puis session()
// recopient. Les trois maillons doivent etre declares, sinon `token.role` et
// `user.role` restent typés `unknown` cote TypeScript.
declare module "next-auth" {
  interface Session {
    user: {
      role?: Role;
      id?: string;
    } & DefaultSession["user"];
  }

  // Ce que authorize() retourne.
  interface User {
    role?: Role;
  }
}

declare module "@auth/core/jwt" {
  interface JWT {
    role?: Role;
    id?: string;
  }
}
