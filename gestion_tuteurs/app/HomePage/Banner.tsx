import { Page } from "../types";

interface Props {
  setPage: (p: Page) => void;
}

export default function Banner({ setPage }: Props) {
  return (
    <div>
      <section
        className="px-6 lg:px-12 py-16"
        style={{ background: "linear-gradient(135deg, #0c1847, #2D4DB4)" }}
      >
        <div className="max-w-3xl mx-auto text-center text-white">
          <h2
            className="text-3xl lg:text-4xl font-black mb-4"
            style={{ fontFamily: "var(--font-nunito), sans-serif" }}
          >
            Commence à réviser aujourd&apos;hui. C&apos;est gratuit.
          </h2>
          <p className="text-brand-200 mb-8 text-lg">
            Rejoins 8 500 élèves qui préparent déjà leur BAC et BEPC sur Gobuch.
          </p>
          <div className="flex flex-wrap gap-4 justify-center">
            <button
              type="button"
              onClick={() => setPage("dashboard")}
              className="cursor-pointer rounded-2xl bg-accent-400 px-8 py-3 text-base font-bold text-brand-900 shadow-lg shadow-accent-950/20 transition-all duration-300 ease-out hover:bg-accent-300 hover:shadow-xl hover:shadow-accent-900/30 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-white motion-safe:hover:-translate-y-0.5 active:translate-y-0 active:scale-[0.97]"
            >
              Créer mon compte gratuitement
            </button>
            <button
              type="button"
              onClick={() => setPage("pricing")}
              className="cursor-pointer rounded-2xl border-2 border-brand-400 px-8 py-3 text-base font-bold text-white transition-all duration-300 ease-out hover:border-white hover:bg-white/10 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-white motion-safe:hover:-translate-y-0.5 active:translate-y-0 active:scale-[0.97]"
            >
              Voir les offres
            </button>
          </div>
        </div>
      </section>
    </div>
  );
}
