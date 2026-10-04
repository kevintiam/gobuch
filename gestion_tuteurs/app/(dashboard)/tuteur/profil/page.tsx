"use client";

import {
  FiMapPin,
  FiClock,
  FiPhone,
  FiSmartphone,
  FiUser,
  FiHash,
  FiCheckCircle,
  FiMap,
  FiBookOpen,
  FiInbox,
  FiDollarSign,
  FiEdit2,
  FiStar
} from "react-icons/fi";

import { fcfa } from "@/lib/format";
import { Panneau, Chip,Champ,Piece,LigneStat } from "@/lib/function";
import useTutorInfos from "@/hooks/useTutorInfos";
const NUNITO = { fontFamily: "var(--font-nunito), sans-serif" };

/* -------------------------------------------------------------------------- */

export default function ProfilPage() {
  const { loading, error, tutorInfos: tuteur } = useTutorInfos();

  if(loading) {
    return <p className="py-16 text-center text-sm text-slate-400">Chargement…</p>;
  }
  if(error) {
    return (
      <div className="py-16 text-center">
        <p className="font-medium text-slate-700">
          Impossible de charger le tableau de bord
        </p>
        <p className="mt-1 text-sm text-slate-400">{error}</p>
      </div>
    );
  }

  const matieres = [...new Set(tuteur?.assignments.map((a) => a.subject.name))];
  const classes = [...new Set(tuteur?.assignments.map((a) => a.level.name))];
  const acceptees = tuteur?.applications.filter(
    (a) => a.status === "ACCEPTED",
  ).length;

  const champs = [
    tuteur?.city,
    tuteur?.district,
    tuteur?.availability,
    tuteur?.photo,
    tuteur?.phone,
    tuteur?.whatsapp,
  ];
  const remplis = champs.filter(Boolean).length;
  const completude = Math.round((remplis / champs.length) * 100)

  return (
    <div className="space-y-6">
      {/* ---------- Bandeau ---------- */}
      <header
        className="relative overflow-hidden rounded-3xl px-6 py-7 text-white sm:px-8"
        style={{ background: "linear-gradient(135deg, #0c1847, #2d4db4)" }}
      >
        <div
          aria-hidden="true"
          className="pointer-events-none absolute -right-20 -top-24 h-72 w-72 rounded-full opacity-20 blur-2xl"
          style={{
            background: "radial-gradient(circle, #758ee1, transparent 70%)",
          }}
        />

        <div className="relative flex flex-wrap items-start gap-5">
          <span
            className="flex h-20 w-20 shrink-0 items-center justify-center rounded-2xl bg-white/15 text-2xl font-black backdrop-blur"
            style={NUNITO}
          >
            {tuteur?.firstName ? `${tuteur.firstName[0]}` : ""}
            {tuteur?.lastName ? ` ${tuteur.lastName[0]}` : ""}
          </span>

          <div className="min-w-0 flex-1">
            <div className="flex flex-wrap items-center gap-3">
              <h1
                className="text-2xl font-black tracking-tight sm:text-3xl"
                style={NUNITO}
              >
                {tuteur?.firstName} {tuteur?.lastName}
              </h1>
              <span className="rounded-full bg-white/15 px-3 py-1 text-xs font-bold backdrop-blur">
                Enseignant
              </span>
            </div>

            <p className="mt-1.5 flex flex-wrap items-center gap-x-4 gap-y-1 text-sm text-brand-200">
              <span className="flex items-center gap-1.5">
                <FiMapPin className="h-3.5 w-3.5" />
                {tuteur?.city ?? "Ville non renseignée"}
                {tuteur?.district ? ` · ${tuteur?.district}` : ""}
              </span>
              <span className="flex items-center gap-1.5">
                <FiHash className="h-3.5 w-3.5" />
                Compte n° {tuteur?.userId}
              </span>
            </p>

            {/* Completude */}
            <div className="mt-5 max-w-lg">
              <div className="flex items-center justify-between text-xs font-semibold">
                <span className="text-white/90">Profil complété</span>
                <span className="text-brand-200">
                  {remplis} / {champs.length} champs
                </span>
              </div>
              <div className="mt-2 h-1.5 overflow-hidden rounded-full bg-white/15">
                <div
                  className="h-full rounded-full bg-amber-400 transition-[width] duration-500"
                  style={{ width: `${completude}%` }}
                />
              </div>
              <p className="mt-2 text-xs text-brand-200">
                {completude === 100
                  ? "Votre profil est complet."
                  : `Complétez votre fiche pour rassurer les familles (${completude} %).`}
              </p>
            </div>
          </div>
        </div>
      </header>

      {/* ---------- Deux colonnes ---------- */}
      <div className="grid gap-6 lg:grid-cols-3">
        {/* Colonne principale */}
        <div className="space-y-6 lg:col-span-2">
          <section className="overflow-hidden rounded-2xl border border-slate-200/70 bg-white shadow-sm shadow-slate-200/50">
            <div className="flex items-center gap-3 border-b border-slate-100 px-5 py-4">
              <h2 className="font-bold text-slate-900" style={NUNITO}>
                Informations personnelles
              </h2>
              <span className="ml-auto flex items-center gap-1.5 text-xs font-semibold text-slate-400">
                <FiEdit2 className="h-3.5 w-3.5" />
                Modification bientôt disponible
              </span>
            </div>
            <dl className="grid gap-3 p-5 sm:grid-cols-2">
              <Champ
                label="Nom"
                valeur={tuteur?.firstName}
                icone={<FiUser className="h-4 w-4" />}
              />
              <Champ
                label="Prénom"
                valeur={tuteur?.lastName}
                icone={<FiUser className="h-4 w-4" />}
              />
              <Champ
                label="Téléphone"
                valeur={tuteur?.phone}
                icone={<FiPhone className="h-4 w-4" />}
              />
              <Champ
                label="WhatsApp"
                valeur={tuteur?.whatsapp}
                icone={<FiSmartphone className="h-4 w-4" />}
              />
              <Champ
                label="Ville"
                valeur={tuteur?.city}
                icone={<FiMapPin className="h-4 w-4" />}
              />
              <Champ
                label="Quartier"
                valeur={tuteur?.district}
                icone={<FiMap className="h-4 w-4" />}
              />
              <div className="sm:col-span-2">
                <Champ
                  label="Disponibilités"
                  valeur={tuteur?.availability}
                  icone={<FiClock className="h-4 w-4" />}
                />
              </div>
            </dl>
          </section>

          <section className="overflow-hidden rounded-2xl border border-slate-200/70 bg-white shadow-sm shadow-slate-200/50">
            <div className="flex items-center gap-3 border-b border-slate-100 px-5 py-4">
              <span className="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-slate-100 text-slate-500">
                <FiBookOpen className="h-4 w-4" />
              </span>
              <h2 className="font-bold text-slate-900" style={NUNITO}>
                Mes enseignements
              </h2>
            </div>
            <div className="grid gap-6 p-5 sm:grid-cols-2">
              <div>
                <p className="mb-2.5 text-xs font-semibold uppercase tracking-wide text-slate-400">
                  Matières
                </p>
                <div className="flex flex-wrap gap-1.5">
                  {matieres.length === 0 ? (
                    <p className="text-sm text-slate-400">
                      Aucune matière déclarée.
                    </p>
                  ) : (
                    matieres.map((m) => (
                      <Chip key={m} ton="marque">
                        {m}
                      </Chip>
                    ))
                  )}
                </div>
              </div>
              <div>
                <p className="mb-2.5 text-xs font-semibold uppercase tracking-wide text-slate-400">
                  Classes
                </p>
                <div className="flex flex-wrap gap-1.5">
                  {classes.length === 0 ? (
                    <p className="text-sm text-slate-400">
                      Aucune classe déclarée.
                    </p>
                  ) : (
                    classes.map((c) => <Chip key={c}>{c}</Chip>)
                  )}
                </div>
              </div>
            </div>
          </section>
        </div>

        {/* Colonne laterale */}
        <div className="space-y-6">
          <Panneau titre="Statistiques">
            <div className="divide-y divide-slate-100">
              <LigneStat
                icone={<FiStar className="h-4 w-4" />}
                label="Séances effectuées"
                valeur={
                  tuteur?.averageRating === null
                    ? "—"
                    : `${tuteur?.averageRating} / 5 (${tuteur?.reviewsCount} avis)`
                }
              />
              <LigneStat
                icone={<FiInbox className="h-4 w-4" />}
                label="Demandes reçues"
                valeur={String(tuteur?.applications.length)}
              />
              <LigneStat
                icone={<FiCheckCircle className="h-4 w-4" />}
                label="Demandes acceptées"
                valeur={String(acceptees)}
              />
              <LigneStat
                icone={<FiDollarSign className="h-4 w-4" />}
                label="Revenus encaissés"
                valeur={fcfa(tuteur?.revenus)}
              />
            </div>
          </Panneau>

          <Panneau titre="Pièces du dossier">
            <div className="space-y-2.5">
              <Piece
                label="Photo de profil"
                detail={
                  tuteur?.photo
                    ? "Fournie"
                    : "Les fiches avec photo sont plus consultées"
                }
                fournie={Boolean(tuteur?.photo)}
              />
              <Piece
                label="Coordonnées téléphoniques"
                detail={
                  tuteur?.phone || tuteur?.whatsapp
                    ? "Renseignées"
                    : "Indispensables pour être contacté"
                }
                fournie={Boolean(tuteur?.phone || tuteur?.whatsapp)}
              />
              <Piece
                label="Zone d'intervention"
                detail={
                  tuteur?.city
                    ? "Renseignée"
                    : "Aide les familles proches à vous trouver"
                }
                fournie={Boolean(tuteur?.city)}
              />
            </div>
          </Panneau>
        </div>
      </div>
    </div>
  );
}
