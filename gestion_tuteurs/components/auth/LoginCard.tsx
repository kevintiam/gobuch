"use client";
import { useState, type SubmitEvent } from "react";
import { isValidEmail } from "@/lib/validation";
import Link from "next/link";
import Image from "next/image";
import { useRouter } from "next/navigation";
import { signIn, getSession } from "next-auth/react";
import {
  FiMail,
  FiLock,
  FiEye,
  FiEyeOff,
  FiLoader,
  FiPhone,
  FiChevronLeft,
} from "react-icons/fi";
import { FcGoogle } from "react-icons/fc";
import { homeForRole } from "@/lib/roles";
import type { LoginInterface } from "./../interface";

const FIELD =
  "w-full pl-10 py-3 bg-slate-50 border-2 border-slate-200 rounded-xl focus:outline-none focus:border-brand-500 focus:bg-white transition-all placeholder-slate-400";

export default function LoginCard({
  pageBg,
  gradient,
  title,
  subtitle,
  identifierLabel,
  emailPlaceholder = "Adresse e-mail",
  showSocialLogins = false,
  footerSlot,
}: LoginInterface) {
  const router = useRouter();
  const [mode, setMode] = useState<"login" | "forgot">("login");
  const [email, setEmail] = useState("");
  const [password, setPassword] = useState("");
  const [showPwd, setShowPwd] = useState(false);
  const [loading, setLoading] = useState(false);
  const [error, setError] = useState("");

  const handleSubmit = async (e: SubmitEvent<HTMLFormElement>) => {
    e.preventDefault();
    setLoading(true);
    setError("");

    if (!isValidEmail(email)) {
      setLoading(false);
      setError("Mauvais format d'adresse e-mail.");
      return;
    }

    const result = await signIn("credentials", {
      email: email.trim().toLowerCase(),
      password: password.trim(),
      redirect: false,
    });

    if (result?.error) {
      setLoading(false);
      setError("Identifiants incorrects.");
      return;
    }
    const session = await getSession();

    if (!session?.user?.role) {
      setLoading(false);
      setError("Impossible de récupérer la session.");
      return;
    }

    router.replace(homeForRole(session.user.role));
    router.refresh();
  };

  const handleForgot = (e: SubmitEvent<HTMLFormElement>) => {
    e.preventDefault();
    alert(
      "La réinitialisation par e-mail n'est pas encore active. Contacte un administrateur pour retrouver ton accès.",
    );
  };

  return (
    <div className="min-h-screen flex flex-col" style={{ background: pageBg }}>
      <div className="flex-1 flex flex-col items-center justify-center px-6 py-12 overflow-y-auto">
        <div className="w-full lg:max-w-xl bg-white rounded-3xl shadow-lg px-8 py-10 lg:px-12 lg:py-14">
          <Link
            href="/"
            className="flex items-center justify-center gap-2 mb-8"
          >
            <Image
              src="/logo.png"
              alt="Logo Gobuch"
              width={168}
              height={30}
              priority
            />
          </Link>

          {/* ─── MODE LOGIN ─── */}
          {mode === "login" && (
            <>
              <div className="mb-8 text-center">
                <h1
                  className="text-2xl font-black text-slate-900"
                  style={{ fontFamily: "var(--font-nunito), sans-serif" }}
                >
                  {title}
                </h1>
                <p className="text-slate-500 text-[1.125rem] mt-1">
                  {subtitle}
                </p>
              </div>

              <form onSubmit={handleSubmit} className="space-y-4">
                <div>
                  <label
                    htmlFor="identifiant"
                    className="text-[16px] font-bold text-slate-700 block mb-1.5"
                  >
                    {identifierLabel}
                  </label>
                  <div className="relative">
                    <FiMail className="w-4 h-4 absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400" />
                    <input
                      id="identifiant"
                      name="email"
                      autoComplete="email"
                      type="email"
                      required
                      value={email}
                      onChange={(e) => setEmail(e.target.value)}
                      placeholder={emailPlaceholder}
                      className={`${FIELD} pr-4 text-[1rem]`}
                    />
                  </div>
                </div>

                <div>
                  <div className="flex items-center justify-between mb-1.5">
                    <label
                      htmlFor="motpasse"
                      className="text-[16px] font-bold text-slate-700"
                    >
                      Mot de passe
                    </label>
                    <button
                      type="button"
                      onClick={() => setMode("forgot")}
                      className="text-[16px] cursor-pointer font-semibold text-brand-600 hover:text-brand-800 transition-colors"
                    >
                      Mot de passe oublié ?
                    </button>
                  </div>
                  <div className="relative">
                    <FiLock className="w-5 h-5 absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400" />
                    <input
                      id="motpasse"
                      name="password"
                      autoComplete="current-password"
                      type={showPwd ? "text" : "password"}
                      required
                      value={password}
                      onChange={(e) => setPassword(e.target.value)}
                      placeholder="••••••••"
                      className={`${FIELD} pr-11 text-[1.125rem]`}
                    />
                    <button
                      type="button"
                      onClick={() => setShowPwd(!showPwd)}
                      aria-label={
                        showPwd
                          ? "Masquer le mot de passe"
                          : "Afficher le mot de passe"
                      }
                      className="absolute right-3.5 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-700 transition-colors cursor-pointer"
                    >
                      {showPwd ? (
                        <FiEyeOff className="w-5 h-5" />
                      ) : (
                        <FiEye className="w-5 h-5" />
                      )}
                    </button>
                  </div>
                </div>

                <label className="flex items-center gap-2.5 cursor-pointer">
                  <div className="relative">
                    <input type="checkbox" className="sr-only peer" />
                    <div className="w-10 h-5 bg-slate-200 rounded-full peer peer-checked:bg-brand-600 transition-colors" />
                    <div className="absolute top-0.5 left-0.5 w-4 h-4 bg-white rounded-full shadow transition-transform peer-checked:translate-x-5" />
                  </div>
                  <span className="text-[1rem] text-slate-600 font-semibold">
                    Se souvenir de moi
                  </span>
                </label>

                {error && (
                  <div
                    role="alert"
                    className="flex items-start gap-2 rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700"
                  >
                    <span>{error}</span>
                  </div>
                )}

                <button
                  type="submit"
                  disabled={loading}
                  className="w-full font-black cursor-pointer text-white py-3.5 rounded-2xl transition-all hover:opacity-90 hover:shadow-xl disabled:opacity-60"
                  style={{ background: gradient }}
                >
                  {loading ? (
                    <span className="flex items-center justify-center gap-2">
                      <FiLoader className="animate-spin w-4 h-4" />
                      Connexion...
                    </span>
                  ) : (
                    "Se connecter"
                  )}
                </button>
              </form>

              {showSocialLogins && (
                <div className="mt-6">
                  <div className="relative flex items-center gap-3">
                    <div className="flex-1 h-px bg-slate-200" />
                    <span className="text-xs text-slate-400 font-semibold">
                      ou continuer avec
                    </span>
                    <div className="flex-1 h-px bg-slate-200" />
                  </div>

                  <div className="flex gap-3 mt-4">
                    {[
                      {
                        label: "Google",
                        icon: <FcGoogle className="w-5 h-5" />,
                      },
                      {
                        label: "Téléphone",
                        icon: <FiPhone className="w-5 h-5" />,
                      },
                    ].map((b) => (
                      <button
                        key={b.label}
                        type="button"
                        className="flex-1 flex items-center justify-center gap-2 bg-white border-2 border-slate-200 py-3 rounded-xl text-sm font-semibold text-slate-700 transition-all disabled:cursor-not-allowed disabled:opacity-50"
                      >
                        {b.icon}
                        {b.label}
                      </button>
                    ))}
                  </div>
                </div>
              )}

              {footerSlot}
            </>
          )}
          {mode === "forgot" && (
            <>
              <div className="mb-8">
                <button
                  onClick={() => setMode("login")}
                  className="flex items-center cursor-pointer gap-2 text-slate-400 hover:text-slate-700 transition-colors mb-5"
                >
                  <FiChevronLeft className="w-4 h-4" />
                  <span className="text-sm font-semibold">Retour</span>
                </button>
                <div className="w-14 h-14 bg-brand-100 rounded-2xl flex items-center justify-center mb-4">
                  <FiMail className="w-7 h-7 text-brand-600" />
                </div>
                <h1
                  className="text-2xl font-black text-slate-900"
                  style={{ fontFamily: "var(--font-nunito), sans-serif" }}
                >
                  Réinitialiser 🔐
                </h1>
                <p className="text-slate-500 text-[16px] mt-1">
                  Entre ton adresse e-mail et on t&apos;envoie un lien de
                  réinitialisation.
                </p>
              </div>

              <form onSubmit={handleForgot} className="space-y-4">
                <div>
                  <label
                    htmlFor="email-reset"
                    className="text-[16px] font-bold text-slate-700 block mb-1.5"
                  >
                    Adresse e-mail
                  </label>
                  <div className="relative">
                    <FiMail className="w-4 h-4 absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400" />
                    <input
                      id="email-reset"
                      type="email"
                      required
                      value={email}
                      onChange={(e) => setEmail(e.target.value)}
                      placeholder="email@exemple.com"
                      className={`${FIELD} pr-4 text-[16px]`}
                    />
                  </div>
                </div>

                <button
                  type="submit"
                  disabled={loading}
                  className="w-full font-black cursor-pointer text-white py-3.5 rounded-2xl transition-all hover:opacity-90 hover:shadow-xl disabled:opacity-60"
                  style={{ background: gradient }}
                >
                  {loading ? (
                    <span className="flex items-center justify-center gap-2">
                      <FiLoader className="animate-spin w-4 h-4" />
                      <span>Envoi en cours...</span>
                    </span>
                  ) : (
                    "Envoyer le lien de réinitialisation"
                  )}
                </button>
              </form>
            </>
          )}
        </div>
      </div>
    </div>
  );
}
