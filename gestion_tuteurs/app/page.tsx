"use client";

import { useRouter } from "next/navigation";
import { type Page } from "./types";
import HomePage from "./HomePage/HomePage";

const ROUTES: Partial<Record<Page, string>> = {
  dashboard: "/login",
  courses: "/login",
  exams: "/login",
  challenge: "/login",
  chatbot: "/login",
  community: "/login",
  tuteurs: "/login/tuteur",
};

export default function App() {
  const router = useRouter();

  function setPage(p: Page) {
    const href = ROUTES[p];
    if (href) {
      router.push(href);
      return;
    }
    // Sans ce message, un bouton non cable reste muet et parait casse.
    console.warn(`[navigation] aucune route definie pour "${p}"`);
  }

  return <HomePage setPage={setPage} />;
}
