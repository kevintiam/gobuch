import Image from "next/image";
import { FiUsers } from "react-icons/fi";

import { Page } from "../types";
import ExamSection from "./ExamSection";
import Feature from "./Feature";
import Steps from "./Steps";
import Testimonials from "./Testimonials";
import Banner from "./Banner";

// Soulignement anime, partage par les liens de la navbar
const UNDERLINE =
  "relative after:absolute after:inset-x-0 after:-bottom-1 after:h-0.5 after:origin-left after:scale-x-0 after:rounded-full after:bg-brand-600 after:transition-transform after:duration-300 after:ease-out after:content-[''] hover:after:scale-x-100";

interface Props {
  setPage: (p: Page) => void;
}

export default function HomePage({ setPage }: Props) {
  return (
    <div className="min-h-screen bg-white">
      {/* Navbar */}
      <nav className="flex items-center gap-4 px-6 lg:px-12 py-4 border-b border-slate-100 sticky top-0 bg-white/95 backdrop-blur z-50">
        <div className="group flex cursor-pointer items-center gap-2">
          <Image
            src="/logo1.png"
            alt="Logo Gobuch"
            width={165}
            height={38}
            priority
            className="h-6 sm:h-9 md:h-10 w-auto rounded-xl object-contain transition-transform duration-300 ease-out motion-safe:group-hover:-rotate-6 motion-safe:group-hover:scale-110"
          />
        </div>

        <div className="hidden md:flex items-center gap-6 ml-8 text-[16px] font-semibold text-slate-500 cursor-pointer">
          <a
            href="#features"
            className={`${UNDERLINE} hover:text-brand-700 transition-colors`}
          >
            Fonctionnalités
          </a>
          <a
            href="#how"
            className={`${UNDERLINE} hover:text-brand-700 transition-colors`}
          >
            Comment ça marche
          </a>
          <button
            onClick={() => setPage("pricing")}
            className={`${UNDERLINE} cursor-pointer font-semibold text-slate-600 transition-colors hover:text-brand-700`}
          >
            Tarifs
          </button>
        </div>

        <div className="ml-auto flex items-center gap-3 ">
          <button
            onClick={() => setPage("tuteurs")}
            className="hidden cursor-pointer items-center gap-1.5 rounded-xl px-3 py-2 text-[15px] font-semibold text-slate-500 transition-colors duration-300 hover:bg-brand-50 hover:text-brand-700 sm:inline-flex"
          >
            <FiUsers className="h-4 w-4" />
            Espace tuteurs
          </button>

          <button
            onClick={() => setPage("dashboard")}
            className="cursor-pointer rounded-xl border border-slate-300 px-4 py-2 text-[16px] font-semibold text-slate-600 transition-all duration-300 ease-out hover:border-brand-300 hover:bg-brand-50 hover:text-brand-700 motion-safe:hover:-translate-y-0.5 active:translate-y-0 active:scale-[0.97]"
          >
            Se connecter
          </button>

          <button
            onClick={() => setPage("dashboard")}
            className="cursor-pointer rounded-xl px-4 py-2 text-[16px] font-bold text-white shadow-sm shadow-brand-600/20 transition-all duration-300 ease-out hover:shadow-lg hover:shadow-brand-600/40 motion-safe:hover:-translate-y-0.5 active:translate-y-0 active:scale-[0.97]"
            style={{ background: "linear-gradient(135deg, #2D4DB4, #4a6dd8)" }}
          >
            Commencer gratuitement
          </button>
        </div>
      </nav>

      {/* Hero */}
      <section className="relative overflow-hidden px-6 pt-10 pb-16 sm:px-8 lg:px-12 lg:pt-10 lg:pb-15">
        {/* Halos decoratifs, purement visuels */}
        <div
          aria-hidden="true"
          className="pointer-events-none absolute inset-0"
        >
          <div
            className="absolute -top-40 right-[-15%] h-[540px] w-[540px] rounded-full blur-3xl opacity-[0.13]"
            style={{
              background: "radial-gradient(circle, #2D4DB4, transparent 70%)",
            }}
          />
          <div
            className="absolute -bottom-48 left-[-15%] h-[440px] w-[440px] rounded-full blur-3xl opacity-[0.13]"
            style={{
              background: "radial-gradient(circle, #E8920A, transparent 70%)",
            }}
          />
        </div>

        <div className="relative mx-auto grid w-full max-w-[90rem] items-stretch gap-12 lg:grid-cols-2 lg:gap-20">
          {/* Texte — colonne de gauche */}
          <div className="text-center lg:text-left">
            <p className="inline-flex items-center gap-2 rounded-full border border-brand-200 bg-brand-50 px-3.5 py-1.5 text-xs font-bold text-brand-700 sm:text-sm">
              <span className="h-1.5 w-1.5 shrink-0 rounded-full bg-brand-500 motion-safe:animate-pulse" />
              🎓 Plateforme éducative n°1 au Cameroun
            </p>

            <h1
              className="mt-6 text-balance text-4xl font-black leading-[1.08] tracking-tight text-slate-900 sm:text-5xl"
              style={{ fontFamily: "var(--font-nunito), sans-serif" }}
            >
              Réussis tes{" "}
              <span className="relative inline-block text-brand-700">
                examens.
              </span>
              <br />
              Depuis ton <span className="text-accent-500">téléphone.</span>
            </h1>

            <p className="mx-auto mt-6 max-w-2xl text-pretty text-xl leading-relaxed text-slate-600 sm:text-xl lg:mx-0">
              <span className="font-semibold text-slate-900">
                Tes cours en entier dans la plateforme
              </span>{" "}
              : vidéos, PDF et exercices, rien à chercher ailleurs. Défie tes
              camarades en temps réel, interroge le chatbot IA à toute heure,
              même quand la connexion faiblit. Tous les anciens sujets du BEPC,
              du Probatoire et du BAC t&apos;attendent, de la 6ème à la
              Terminale. Et quand tu bloques vraiment, un{" "}
              <span className="font-semibold text-slate-900">
                répétiteur qualifié près de chez toi est la pour t&apos;aider.
              </span>
            </p>

            <div className="mt-8 flex flex-wrap items-center justify-center gap-3 lg:justify-start">
              <button
                type="button"
                onClick={() => setPage("dashboard")}
                className="rounded-2xl px-6 py-3 text-base cursor-pointer font-bold text-white shadow-lg shadow-brand-600/20 transition-all hover:-translate-y-0.5 hover:shadow-xl hover:shadow-brand-600/30 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-brand-600"
                style={{
                  background: "linear-gradient(135deg, #2D4DB4, #4a6dd8)",
                }}
              >
                Commencer gratuitement
              </button>
              <a
                href="#how"
                className="rounded-2xl border-2 border-slate-200 px-6 py-3 text-base font-semibold text-slate-700 transition-colors hover:border-brand-300 hover:text-brand-700 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-brand-600"
              >
                Devenir tuteur
              </a>
            </div>
          </div>

          <div className="relative mx-auto w-full max-w-[520px] lg:max-w-none">
            <div className="h-full overflow-hidden rounded-3xl bg-slate-900 lg:absolute lg:inset-0 shadow-2xl shadow-brand-900/20 ring-1 ring-slate-900/5">
              <video
                className="aspect-video w-full object-cover lg:aspect-auto lg:h-full"
                poster="/hero.svg"
                controls
                autoPlay
                muted
                loop
                playsInline
                preload="metadata"
              >
                <source src="/demo.webm" type="video/webm" />
                <source src="/demo.mp4" type="video/mp4" />
                Votre navigateur ne peut pas lire cette vidéo.{" "}
                <a href="/demo.mp4" className="underline">
                  Télécharger la vidéo
                </a>
                .
              </video>
            </div>
          </div>
        </div>

        {/* Chiffres cles */}
        <div className="flex justify-between px-50 mx-auto mt-10  w-full divide-slate-200">
          {[
            { n: "+ 8 500", l: "Élèves actifs" },
            { n: "+ 350", l: "Sujets d'examen" },
            { n: "+ 15", l: "Matières couvertes" },
          ].map((s) => (
            <div key={s.l} className="px-3 text-center sm:px-4">
              <div
                className="text-2xl font-black text-brand-700 sm:text-3xl"
                style={{ fontFamily: "var(--font-nunito), sans-serif" }}
              >
                {s.n}
              </div>
              <div className="mt-1 text-[16px] font-semibold text-slate-500 sm:text-[18px]">
                {s.l}
              </div>
            </div>
          ))}
        </div>
      </section>

      {/* Exam badges */}
      <ExamSection />

      {/* Features */}
      <Feature />

      {/* steps */}
      <Steps />

      {/* Testimonials */}
      <Testimonials />

      {/* Banner */}
      <Banner setPage={setPage} />

      {/* Footer */}
      <footer className="px-6 lg:px-20 py-8 bg-slate-900 text-slate-400 text-sm">
        <div className="flex justify-between gap-4 items-center">
          <div className="flex items-center gap-2">
            <Image
              src="/logo1.png"
              alt="Logo Gobuch"
              width={48}
              height={48}
              className="h-auto w-20 object-contain"
            />
            <span className="text-slate-600 text-[0.95rem]">
              — La réussite scolaire pour tous
            </span>
          </div>
          <div className="text-slate-600 text-[0.95rem] mt-2">
            © 2026 Gobuch · Douala, Cameroun
          </div>
          <div className="flex gap-4 items-center text-[0.95rem] text-slate-400">
            <a href="#" className="hover:text-white transition-colors">
              CGU
            </a>
            <a href="#" className="hover:text-white transition-colors">
              Confidentialité
            </a>
            <a href="#" className="hover:text-white transition-colors">
              Contact
            </a>
          </div>
        </div>
      </footer>
    </div>
  );
}
