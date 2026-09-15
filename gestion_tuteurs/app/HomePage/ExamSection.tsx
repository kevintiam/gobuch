export default function ExamSection() {

    const CLASS = [
        "6ème",
        "5ème",
        "4ème",
        "3ème",
        "2nde A",
        "2nde C",
        "1ère A",
        "1ère C",
        "1ère D",
        "Tle A",
        "Tle C",
        "Tle D",
    ];
    
  return (
    <div>
      <section className="bg-slate-900 py-4 overflow-hidden">
        <div className="flex justify-center gap-10 animate-none px-6">
          {CLASS.map((b) => (
            <span
              key={b}
              className="shrink-0 text-sm font-bold text-slate-400 border border-slate-700 px-3 py-1.5 rounded-full whitespace-nowrap"
            >
              {b}
            </span>
          ))}
        </div>
      </section>
    </div>
  );
}
