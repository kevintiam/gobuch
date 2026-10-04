"use client";

import { useState } from "react";
import {
  FiBookOpen,
  FiCalendar,
  FiCheck,
  FiClock,
  FiMapPin,
  FiX,
} from "react-icons/fi";
import { formatDuree,TuteurDashboard} from "../data/selectors";
import StatutBadge from "./dashboard/StatutBadge";
import { fcfa, formatDate } from "@/lib/format";
import { TONS } from "@/lib/constante";
const NUNITO = { fontFamily: "var(--font-nunito), sans-serif" };


type Demande = TuteurDashboard["request"][number];
type Reponse = "ACCEPTED" | "DECLINED";




export function CarteDemande({rq}: {
  rq: Demande;
}) {
  const attend = rq.applicationStatus === "PENDING";
  const creneau = [rq.day, rq.time].filter(Boolean).join(" · ");
  const duree = formatDuree(rq.duration);

  return (
    <article
      className={"relative overflow-hidden rounded-2xl border bg-white p-5 shadow-sm shadow-slate-200/50 transition-shadow hover:shadow-md border-slate-200/70"
      }
    >
      {/* Eleve + statut */}
      <div className="flex items-start gap-3">
        <span
          className="flex h-11 w-11 shrink-0 items-center justify-center rounded-full bg-brand-50 text-sm font-black text-brand-700"
          style={NUNITO}
        >
          {rq.student.firstName[0]}
          {rq.student.lastName[0]}
        </span>
        <div className="min-w-0 flex-1">
          <p className="truncate font-bold text-slate-900" style={NUNITO}>
            {rq.student.firstName} {rq.student.lastName}
          </p>
          <p className="text-sm text-slate-500">{rq.student.level}</p>
        </div>
        <StatutBadge statut={rq.applicationStatus} />
      </div>

      <p className="mt-4 inline-flex items-center gap-1.5 rounded-full bg-brand-50 px-3 py-1 text-sm font-semibold text-brand-700 ring-1 ring-brand-100">
        <FiBookOpen className="h-3.5 w-3.5" />
        {rq.subject}
      </p>

      {/* Details */}
      <div className="mt-4 grid gap-3 sm:grid-cols-3">
        <Info
          icone={<FiClock className="h-3.5 w-3.5" />}
          label="Créneau"
          valeur={creneau || null}
          detail={duree}
        />
        <Info
          icone={<FiMapPin className="h-3.5 w-3.5" />}
          label="Lieu"
          valeur={rq.place}
        />
        <div className="rounded-xl bg-slate-50/80 px-3.5 py-2.5">
          <dt className="text-xs font-medium text-slate-400">Forfait proposé</dt>
          <dd
            className="mt-0.5 text-base font-black text-slate-900"
            style={NUNITO}
          >
            {rq.montant > 0 ? fcfa(rq.montant) : "À négocier"}
          </dd>
        </div>
      </div>

      {/* Pied */}
      <div className="mt-4 flex items-center justify-end">
        {attend && (
            <div className="flex flex-wrap items-center justify-end gap-5">
                <button
                    type="button"
                    onClick={() => alert("ACCEPTED")}
                    className="inline-flex cursor-pointer items-center gap-1.5 rounded-xl bg-emerald-600 px-4 py-2 text-sm font-semibold text-white transition-colors hover:bg-emerald-700 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-emerald-600"
                        >
                    <FiCheck className="h-4 w-4" />
                    Accepter
                </button>
                <button
                    type="button"
                    onClick={() => alert("DECLINED")}
                    className="inline-flex cursor-pointer items-center gap-1.5 rounded-xl border border-slate-300 px-4 py-2 text-sm font-semibold text-slate-700 transition-colors hover:border-rose-300 hover:bg-rose-50 hover:text-rose-700 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-rose-500"
                >
                    <FiX className="h-4 w-4" />
                    Refuser
                </button>
            </div>
        )}
      </div>
    </article>
  );
}


export function Info({
  icone,
  label,
  valeur,
  detail,
}: {
  icone: React.ReactNode;
  label: string;
  valeur: string | null;
  detail?: string | null;
}) {
  return (
    <div className="min-w-0 rounded-xl bg-slate-50/80 px-3.5 py-2.5">
      <dt className="flex items-center gap-1.5 text-xs font-medium text-slate-400">
        {icone}
        {label}
      </dt>
      <dd className="mt-0.5 truncate text-sm font-semibold text-slate-800">
        {valeur ?? <span className="font-normal text-slate-400">Non précisé</span>}
      </dd>
      {detail && <dd className="text-xs text-slate-500">{detail}</dd>}
    </div>
  );
}

export function Resume({
  icone,
  ton,
  valeur,
  label,
}: {
  icone: React.ReactNode;
  ton: keyof typeof TONS;
  valeur: number;
  label: string;
}) {
  return (
    <div className="flex items-center gap-3 rounded-2xl border border-slate-200/70 bg-white p-4 shadow-sm shadow-slate-200/50">
      <span
        className={`flex h-9 w-9 shrink-0 items-center justify-center rounded-xl ${TONS[ton]}`}
      >
        {icone}
      </span>
      <div>
        <p className="text-2xl font-black leading-none text-slate-900" style={NUNITO}>
          {valeur}
        </p>
        <p className="mt-1 text-xs text-slate-500">{label}</p>
      </div>
    </div>
  );
}

export function Message({
  icone,
  ton,
  titre,
  texte,
}: {
  icone: React.ReactNode;
  ton: keyof typeof TONS;
  titre: string;
  texte: string;
}) {
  return (
    <div className="flex flex-col items-center gap-2 rounded-2xl border border-dashed border-slate-200 bg-white px-5 py-14 text-center">
      <span
        className={`mb-1 flex h-12 w-12 items-center justify-center rounded-full ${TONS[ton]}`}
      >
        {icone}
      </span>
      <p className="font-bold text-slate-800" style={NUNITO}>
        {titre}
      </p>
      <p className="max-w-sm text-sm text-slate-400">{texte}</p>
    </div>
  );
}

export function Squelette() {
  return (
    <div aria-busy="true" aria-label="Chargement des demandes">
      <div className="mb-8 h-9 w-56 rounded-lg bg-slate-200/70 motion-safe:animate-pulse" />
      <div className="mb-6 grid grid-cols-2 gap-3 lg:grid-cols-4">
        {[0, 1, 2, 3].map((i) => (
          <div
            key={i}
            className="h-18 rounded-2xl bg-slate-200/50 motion-safe:animate-pulse"
          />
        ))}
      </div>
      <div className="grid gap-4 xl:grid-cols-2">
        {[0, 1].map((i) => (
          <div
            key={i}
            className="h-60 rounded-2xl bg-slate-200/50 motion-safe:animate-pulse"
          />
        ))}
      </div>
    </div>
  );
}
