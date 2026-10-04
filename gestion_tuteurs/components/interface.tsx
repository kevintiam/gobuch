import { ReactNode } from "react";

export interface LoginInterface {
  pageBg: string;
  gradient: string;
  title: string;
  subtitle: string;
  identifierLabel: string;
  emailPlaceholder?: string;
  showSocialLogins?: boolean;
  footerSlot?: ReactNode;
}