import { steps } from "../../lib/constante";

export default function Steps() {
  return (
    <div>
      <section id="how" className="px-6 lg:px-12 py-20 bg-white">
        <div className="max-w-4xl mx-auto">
          <div className="text-center mb-12">
            <span className="text-sm font-bold text-accent-600 uppercase tracking-widest">
              Simple & Rapide
            </span>
            <h2
              className="text-3xl lg:text-4xl font-black text-slate-900 mt-2"
              style={{ fontFamily: "var(--font-nunito), sans-serif" }}
            >
              Prêt en 3 étapes
            </h2>
          </div>

          <div className="space-y-6">
            {steps.map((s, i) => (
              <div key={s.n} className="flex gap-6 items-start">
                <div
                  className="shrink-0 w-14 h-14 rounded-2xl flex items-center justify-center font-black text-lg text-white"
                  style={{
                    background:
                      i === 1
                        ? "linear-gradient(135deg, #E8920A, #F5A623)"
                        : "linear-gradient(135deg, #2D4DB4, #4a6dd8)",
                    fontFamily: "var(--font-nunito), sans-serif",
                  }}
                >
                  {s.n}
                </div>
                <div className="pt-2">
                  <h3
                    className="font-black text-slate-900 text-[1.5rem] mb-1"
                    style={{ fontFamily: "var(--font-nunito), sans-serif" }}
                  >
                    {s.title}
                  </h3>
                  <p className="text-slate-600 text-[18px]">{s.desc}</p>
                </div>
              </div>
            ))}
          </div>
        </div>
      </section>
    </div>
  );
}
