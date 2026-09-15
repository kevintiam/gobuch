import { features } from "../../lib/constante";

export default function Feature() {

  return (
    <div>
      <section id="features" className="px-6 lg:px-12 py-10 bg-slate-50">
        <div className="max-w-6xl mx-auto">
          <div className="text-center mb-12">
            <h2
              className="text-3xl lg:text-4xl font-black text-slate-900 mt-2"
              style={{ fontFamily: "var(--font-nunito), sans-serif" }}
            >
              Tout ce qu&apos;il te faut pour réussir
            </h2>
          </div>

          <div className="grid md:grid-cols-2 lg:grid-cols-3 gap-5">
            {features.map((f) => (
              <div
                key={f.title}
                className={`${f.color} border rounded-2xl p-6 hover:shadow-md transition-shadow`}
              >
                <div
                  className={`${f.badge} text-2xl w-12 h-12 rounded-xl flex items-center justify-center mb-4`}
                >
                  {f.icon}
                </div>
                <h3
                  className="font-black text-slate-900 mb-2 text-xl"
                  style={{ fontFamily: "var(--font-nunito), sans-serif" }}
                >
                  {f.title}
                </h3>
                <p className="text-[18px] text-slate-600 leading-relaxed">
                  {f.desc}
                </p>
              </div>
            ))}
          </div>
        </div>
      </section>
    </div>
  );
}
