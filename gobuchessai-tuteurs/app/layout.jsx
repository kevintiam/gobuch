import { Geist } from "next/font/google";
import "./globals.css";

const geistSans = Geist({
  variable: "--font-geist-sans",
  subsets: ["latin"],
});

export const metadata = {
  title: "Gobuch — Gestion des tuteurs",
  description: "Plateforme de gestion des tuteurs Gobuch",
};

export default function RootLayout({ children }) {
  return (
    <html lang="fr" className={`${geistSans.variable} h-full antialiased`}>
      <body className="min-h-full bg-gray-50 flex flex-col">{children}</body>
    </html>
  );
}
