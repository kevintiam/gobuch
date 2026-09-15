import { Geist, Nunito, Coming_Soon } from "next/font/google";
import "./globals.css";

const geistSans = Geist({
  variable: "--font-geist-sans",
  subsets: ["latin"],
});

const nunito = Nunito({
  variable: "--font-nunito",
  subsets: ["latin"],
  display: "swap",
});

const comingSoon = Coming_Soon({
  variable: "--font-coming-soon",
  subsets: ["latin"],
  weight: "400",
  display: "swap",
});

export const metadata = {
  title: "Gobuch",
  description:
    "Cours intégrés, défis entre élèves, chatbot IA et répétiteurs qualifiés : la plateforme de révision des élèves camerounais, du BEPC au BAC.",
};

export default function RootLayout({ children }) {
  return (
    <html
      lang="fr"
      className={`${geistSans.variable} ${nunito.variable} ${comingSoon.variable} h-full antialiased`}
    >
      <head>
        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link
          rel="preconnect"
          href="https://fonts.gstatic.com"
          crossOrigin="anonymous"
        />
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Acme&family=Bpmf+Iansui&family=Charmonman:wght@400;700&family=Comic+Neue:ital,wght@0,300;0,400;0,700;1,300;1,400;1,700&family=Coming+Soon&family=Comme:wght@100..900&family=Delius&family=Elsie+Swash+Caps:wght@400;900&family=Epunda+Sans:ital,wght@0,300..900;1,300..900&family=Felipa&family=Indie+Flower&family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=JetBrains+Mono:ital,wght@0,100..800;1,100..800&family=League+Spartan:wght@100..900&family=Merienda:wght@300..900&family=Mona+Sans:ital,wght@0,200..900;1,200..900&family=Noto+Sans+KR:wght@100..900&family=Noto+Sans:ital,wght@0,100..900;1,100..900&family=Nunito+Sans:ital,opsz,wght@0,6..12,200..1000;1,6..12,200..1000&family=Playpen+Sans&family=Quintessential&family=Roboto:ital,wght@0,100..900;1,100..900&family=SN+Pro:ital,wght@0,200..900;1,200..900&family=Shantell+Sans:ital,wght,BNCE@0,300..800,-20;1,300..800,-20&family=Sofia&family=Space+Mono:wght@700&family=Tangerine:wght@400;700&family=Ysabeau+Infant:ital,wght@0,1..1000;1,1..1000&display=swap" />
      </head>
      <body className="h-full bg-gray-50 flex flex-col">{children}</body>
    </html>
  );
}
