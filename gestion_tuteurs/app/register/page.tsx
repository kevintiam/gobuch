"use client";

import { useState } from "react";
import Link from "next/link";
import { useRouter } from "next/navigation";
import Image from "next/image";

import {
  FiChevronLeft,
  FiChevronDown,
  FiUser,
  FiMail,
  FiLock,
  FiEye,
  FiEyeOff,
  FiMapPin,
  FiLoader,
} from "react-icons/fi";
import { FaGraduationCap } from "react-icons/fa";
import { levels,regions } from "@/lib/constante";

const FIELD =
  "w-full pl-10 py-3 text-sm bg-slate-50 border-2 border-slate-200 rounded-xl focus:outline-none focus:border-brand-500 focus:bg-white transition-all";
const ICON_LEFT =
  "w-4 h-4 absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400";
const CHEVRON =
  "w-4 h-4 absolute right-3.5 top-1/2 -translate-y-1/2 text-slate-400 pointer-events-none";

export default function RegisterPage() {
  const router = useRouter();
  const [step, setStep] = useState(1);
  const [form, setForm] = useState({
    email: "",
    password: "",
    name: "",
    level: "",
    region: "",
  });
  const [showPwd, setShowPwd] = useState(false);
  const [loading, setLoading] = useState(false);

  const set = (k: string, v: string) => setForm((f) => ({ ...f, [k]: v }));

  const handleSubmit = (e: React.FormEvent) => {
    e.preventDefault();
    if (step === 1) {
      setStep(2);
      return;
    }

    setLoading(true);
    // Simulation de création de compte
    setTimeout(() => {
      setLoading(false);
      router.push("/dashboard");
    }, 1200);
  };

  return (
    <div
      className="min-h-screen flex flex-col"
      style={{ background: "#F8FAFC" }}
    >
      <div className="flex-1 flex flex-col items-center justify-center px-6 py-12 overflow-y-auto">
        <div className="w-full lg:max-w-xl bg-white rounded-3xl shadow-lg px-8 py-10 lg:px-12 lg:py-14">
          <Link
            href="/"
            className="flex items-center justify-center gap-2 mb-8"
          >
            <Image
              src="/logo.png"
              alt="Logo Gobuch"
              width={200}
              height={60}
              priority
            />
          </Link>

          <div className="max-w-md mx-auto">
            <div className="mb-8">
              <div className="flex items-center gap-3 mb-4">
                {step === 2 ? (
                  <button
                    type="button"
                    onClick={() => setStep(1)}
                    aria-label="Revenir à l’étape précédente"
                    className="text-slate-400 hover:text-slate-700 transition-colors cursor-pointer"
                  >
                    <FiChevronLeft className="w-5 h-5" />
                  </button>
                ) : (
                  <Link
                    href="/login"
                    aria-label="Retour à la connexion"
                    className="text-slate-400 hover:text-slate-700 transition-colors"
                  >
                    <FiChevronLeft className="w-5 h-5" />
                  </Link>
                )}
                <div className="flex gap-1.5 flex-1">
                  {[1, 2].map((n) => (
                    <div
                      key={n}
                      className={`h-1.5 flex-1 rounded-full transition-all ${n <= step ? "bg-brand-600" : "bg-slate-200"}`}
                    />
                  ))}
                </div>
                <span className="text-xs text-slate-400 font-semibold whitespace-nowrap">
                  {step}/2
                </span>
              </div>

              <h1
                className="text-2xl text-center font-black text-slate-900"
                style={{ fontFamily: "var(--font-nunito), sans-serif" }}
              >
                {step === 1 ? "Crée ton compte 🎓" : "Ton profil scolaire 📚"}
              </h1>
              <p className="text-slate-500 text-center text-[14px] mt-1">
                {step === 1
                  ? "Inscription gratuite, aucune carte requise"
                  : "Pour personnaliser ton expérience"}
              </p>
            </div>

            <form onSubmit={handleSubmit} className="space-y-4">
              {step === 1 ? (
                <>
                  <div>
                    <label
                      htmlFor="name"
                      className="text-[16px] font-bold text-slate-700 block mb-1.5"
                    >
                      Nom complet
                    </label>
                    <div className="relative">
                      <FiUser className={ICON_LEFT} />
                      <input
                        id="name"
                        name="name"
                        autoComplete="name"
                        type="text"
                        required
                        value={form.name}
                        onChange={(e) => set("name", e.target.value)}
                        placeholder="Amina Mbarga"
                        className={`${FIELD} pr-4 placeholder-slate-400`}
                      />
                    </div>
                  </div>

                  <div>
                    <label
                      htmlFor="email"
                      className="text-[16px] font-bold text-slate-700 block mb-1.5"
                    >
                      Adresse e-mail
                    </label>
                    <div className="relative">
                      <FiMail className={ICON_LEFT} />
                      <input
                        id="email"
                        name="email"
                        autoComplete="email"
                        type="email"
                        required
                        value={form.email}
                        onChange={(e) => set("email", e.target.value)}
                        placeholder="ton.email@exemple.com"
                        className={`${FIELD} pr-4 placeholder-slate-400`}
                      />
                    </div>
                  </div>

                  <div>
                    <label
                      htmlFor="password"
                      className="text-[16px] font-bold text-slate-700 block mb-1.5"
                    >
                      Mot de passe
                    </label>
                    <div className="relative">
                      <FiLock className={ICON_LEFT} />
                      <input
                        id="password"
                        name="password"
                        autoComplete="new-password"
                        type={showPwd ? "text" : "password"}
                        required
                        minLength={8}
                        value={form.password}
                        onChange={(e) => set("password", e.target.value)}
                        placeholder="Minimum 8 caractères"
                        className={`${FIELD} pr-11 placeholder-slate-400`}
                      />
                      <button
                        type="button"
                        onClick={() => setShowPwd(!showPwd)}
                        aria-label={
                          showPwd
                            ? "Masquer le mot de passe"
                            : "Afficher le mot de passe"
                        }
                        className="absolute right-3.5 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-700 cursor-pointer"
                      >
                        {showPwd ? (
                          <FiEyeOff className="w-4 h-4" />
                        ) : (
                          <FiEye className="w-4 h-4" />
                        )}
                      </button>
                    </div>
                    {form.password.length > 0 && (
                      <div className="flex gap-1 mt-2">
                        {[...Array(4)].map((_, i) => (
                          <div
                            key={i}
                            className={`h-1 flex-1 rounded-full transition-all ${
                              form.password.length < 6 && i === 0
                                ? "bg-rose-400"
                                : form.password.length < 8 && i < 2
                                  ? "bg-amber-400"
                                  : form.password.length >= 8 && i < 3
                                    ? "bg-emerald-400"
                                    : form.password.length >= 12 && i < 4
                                      ? "bg-emerald-500"
                                      : "bg-slate-200"
                            }`}
                          />
                        ))}
                        <span className="text-xs text-slate-400 ml-1">
                          {form.password.length < 6
                            ? "Faible"
                            : form.password.length < 8
                              ? "Moyen"
                              : form.password.length < 12
                                ? "Fort"
                                : "Très fort"}
                        </span>
                      </div>
                    )}
                  </div>

                  <label className="flex items-start gap-2.5 cursor-pointer">
                    <input
                      type="checkbox"
                      required
                      className="mt-0.5 w-4 h-4 accent-brand-600"
                    />
                    <span className="text-xs text-slate-600 leading-relaxed">
                      J&apos;accepte les{" "}
                      <a
                        href="#"
                        className="font-bold text-brand-600 hover:underline"
                      >
                        Conditions d&apos;utilisation
                      </a>{" "}
                      et la{" "}
                      <a
                        href="#"
                        className="font-bold text-brand-600 hover:underline"
                      >
                        Politique de confidentialité
                      </a>{" "}
                      de Gobuch
                    </span>
                  </label>
                </>
              ) : (
                <>
                  <div>
                    <label
                      htmlFor="level"
                      className="text-[16px] font-bold text-slate-700 block mb-1.5"
                    >
                      Classe actuelle
                    </label>
                    <div className="relative">
                      <FaGraduationCap
                        className={`${ICON_LEFT} pointer-events-none`}
                      />
                      <select
                        id="level"
                        name="level"
                        required
                        value={form.level}
                        onChange={(e) => set("level", e.target.value)}
                        className={`${FIELD} pr-10 appearance-none text-slate-700 cursor-pointer`}
                      >
                        <option value="">-- Sélectionne ta classe --</option>
                        {levels.map((l) => (
                          <option key={l} value={l}>
                            {l}
                          </option>
                        ))}
                      </select>
                      <FiChevronDown className={CHEVRON} />
                    </div>
                  </div>

                  <div>
                    <label
                      htmlFor="region"
                      className="text-[16px] font-bold text-slate-700 block mb-1.5"
                    >
                      Région
                    </label>
                    <div className="relative">
                      <FiMapPin className={`${ICON_LEFT} pointer-events-none`} />
                      <select
                        id="region"
                        name="region"
                        required
                        value={form.region}
                        onChange={(e) => set("region", e.target.value)}
                        className={`${FIELD} pr-10 appearance-none text-slate-700 cursor-pointer`}
                      >
                        <option value="">-- Sélectionne ta région --</option>
                        {regions.map((r) => (
                          <option key={r} value={r}>
                            {r}
                          </option>
                        ))}
                      </select>
                      <FiChevronDown className={CHEVRON} />
                    </div>
                  </div>

                  <div>
                    <label className="text-[14px] font-bold text-slate-700 block mb-2">
                      Matières prioritaires (optionnel)
                    </label>
                    <div className="flex flex-wrap gap-2">
                      {[
                        "Mathématiques",
                        "Physique-Chimie",
                        "SVT",
                        "Français",
                        "Histoire-Géo",
                        "Anglais",
                        "Philosophie",
                      ].map((m) => (
                        <button
                          key={m}
                          type="button"
                          className="text-xs font-semibold px-3 py-1.5 rounded-full border-2 border-slate-200 text-slate-600 hover:border-brand-400 hover:text-brand-700 hover:bg-brand-50 transition-all cursor-pointer"
                        >
                          {m}
                        </button>
                      ))}
                    </div>
                  </div>

                  <div>
                    <label className="text-xs font-bold text-slate-700 block mb-2">
                      Objectif principal
                    </label>
                    <div className="grid grid-cols-2 gap-2">
                      {[
                        { label: "Réussir le BAC", icon: "🎓" },
                        { label: "Réussir le BEPC", icon: "📜" },
                        { label: "Améliorer mes notes", icon: "📈" },
                        { label: "Préparer le Probatoire", icon: "✍️" },
                      ].map((o) => (
                        <button
                          key={o.label}
                          type="button"
                          className="flex items-center gap-2 p-3 border-2 border-slate-200 hover:border-brand-400 hover:bg-brand-50 rounded-xl text-xs font-semibold text-slate-700 transition-all text-left cursor-pointer"
                        >
                          <span>{o.icon}</span>
                          {o.label}
                        </button>
                      ))}
                    </div>
                  </div>
                </>
              )}

              <button
                type="submit"
                disabled={loading}
                className="w-full font-black text-white py-3.5 rounded-2xl transition-all hover:opacity-90 hover:shadow-xl disabled:opacity-60 cursor-pointer"
                style={{
                  background: "linear-gradient(135deg, #2D4DB4, #4a6dd8)",
                }}
              >
                {loading ? (
                  <span className="flex items-center justify-center gap-2">
                    <FiLoader className="animate-spin w-4 h-4" />
                    Création du compte...
                  </span>
                ) : step === 1 ? (
                  "Continuer"
                ) : (
                  "Créer mon compte"
                )}
              </button>
            </form>

            <p className="text-center text-sm text-slate-500 mt-5">
              Déjà inscrit ?{" "}
              <Link
                href="/login"
                className="font-black text-brand-700 hover:text-brand-900"
              >
                Se connecter
              </Link>
            </p>
          </div>
        </div>
      </div>
    </div>
  );
}
