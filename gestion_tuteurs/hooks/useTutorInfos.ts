"use client";

import { useState, useEffect, useCallback } from "react";
import { type TutorInfos } from "../app/types";

export default function useTutorInfos() {
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState<string | null>(null);
  const [tutorInfos, setTutorInfos] = useState<TutorInfos | null>(null);

  const getTutorInfos = useCallback(async (signal?: AbortSignal) => {
    setLoading(true);
    setError(null);
    setTutorInfos(null);

    try {
      const response = await fetch("/api/tuteur/me", { signal });

      if (!response.ok) {
        const errorData = await response.json().catch(() => null);
        if (errorData && errorData.message) {
          setError(errorData.message);
        } else {
          setError(`Erreur HTTP ${response.status}`);
        }
        throw new Error(`Erreur HTTP ${response.status}`);
      }

      const data: { tutorData: TutorInfos } = await response.json();

      setTutorInfos(data.tutorData);
      setError(null);
    } catch (erreur) {
      if ((erreur as Error).name !== "AbortError") {
        setError(
          erreur instanceof Error ? erreur.message : "Une erreur est survenue",
        );
      }
    } finally {
      setLoading(false);
    }
  }, []);

  useEffect(() => {
    const controller = new AbortController();
      // eslint-disable-next-line react-hooks/set-state-in-effect
    getTutorInfos(controller.signal);

    // Fonction de nettoyage : annule la requête si le composant est démonté
    return () => {
      controller.abort();
    };
    
  }, [getTutorInfos]);

  // Reporte localement une reponse deja enregistree par l'API, sans
  // recharger : refetch repasserait la page entiere en chargement.
  const setApplicationStatus = useCallback(
    (applicationId: number, status: "ACCEPTED" | "DECLINED") => {
      setTutorInfos((infos) =>
        infos
          ? {
              ...infos,
              applications: infos.applications.map((a) =>
                a.id === applicationId ? { ...a, status } : a,
              ),
              request: infos.request.map((r) =>
                r.applicationId === applicationId
                  ? { ...r, applicationStatus: status }
                  : r,
              ),
            }
          : infos,
      );
    },
    [],
  );

  // refetch permet de recharger apres une modification du profil.
  return {
    loading,
    error,
    tutorInfos,
    refetch: getTutorInfos,
    setApplicationStatus,
  };
}
