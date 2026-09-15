import { testimonials } from "../../lib/constante";

export default function Testimonials() {
  return (
    <div>
      <section className="px-6 lg:px-12 py-20 bg-slate-50">
        <div className="max-w-6xl mx-auto">
          <div className="text-center mb-12">
            <span className="text-[1rem] font-bold text-emerald-600 uppercase tracking-widest">
              Témoignages
            </span>
            <h2
              className="text-3xl lg:text-4xl font-black text-slate-900 mt-2"
              style={{ fontFamily: "var(--font-nunito), sans-serif" }}
            >
              Ils ont réussi avec Gobuch
            </h2>
          </div>

          <div className="grid md:grid-cols-3 gap-6">
            {testimonials.map((t) => (
              <div
                key={t.name}
                className="bg-white border border-slate-200 rounded-2xl p-6 hover:shadow-md transition-shadow"
              >
                <div className="flex text-accent-400 text-sm mb-4">★★★★★</div>
                <p className="text-slate-700 text-[1rem] leading-relaxed mb-6">
                  &quot; {t.text} &quot;
                </p>
                <div className="flex items-center gap-3">
                  <div
                    className={`w-10 h-10 rounded-full ${t.color} flex items-center justify-center text-white text-xs font-black`}
                  >
                    {t.avatar}
                  </div>
                  <div>
                    <div className="font-bold text-slate-900 text-sm">
                      {t.name}
                    </div>
                    <div className="text-[0.75rem] text-slate-500">{t.level}</div>
                  </div>
                </div>
              </div>
            ))}
          </div>
        </div>
      </section>
    </div>
  );
}
