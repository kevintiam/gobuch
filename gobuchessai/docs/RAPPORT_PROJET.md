# Rapport d'analyse — Projet GobuchessAI

> Généré le 2026-07-26  
> Répertoire racine : `/gobuchessai/`

---

## Table des matières

1. [Vue d'ensemble](#1-vue-densemble)
2. [Stack technique](#2-stack-technique)
3. [Structure des dossiers](#3-structure-des-dossiers)
4. [Fichiers PHP — Rôles et tailles](#4-fichiers-php--rôles-et-tailles)
5. [Base de données](#5-base-de-données)
6. [Architecture fonctionnelle](#6-architecture-fonctionnelle)
7. [Flux utilisateur](#7-flux-utilisateur)
8. [Sécurité — Points critiques](#8-sécurité--points-critiques)
9. [Points d'amélioration potentiels](#9-points-damélioration-potentiels)

---

## 1. Vue d'ensemble

**GobuchessAI** est une **plateforme LMS (Learning Management System)** pour l'éducation en ligne et le tutorat privé à domicile.  
Malgré son nom, le projet n'a aucun lien avec les échecs ou l'intelligence artificielle — il s'agit d'une application web académique couvrant les matières scolaires :

- Mathématiques
- Physique / Chimie
- Histoire / Géographie
- Biologie
- Informatique (ICT)

La plateforme permet à des élèves de :
- Accéder à des cours, exercices et évaluations structurés
- Trouver et contacter des tuteurs/répétiteurs
- Planifier des séances de cours particuliers
- Suivre leur progression

Elle permet également à des **enseignants/tuteurs** de proposer leurs services, et à des **administrateurs** de gérer l'ensemble de la plateforme.

---

## 2. Stack technique

### Backend

| Technologie | Rôle |
|-------------|------|
| **PHP** (sans framework) | Logique serveur — pages, contrôleurs, fonctions |
| **MySQL** | Base de données relationnelle |
| **PDO** | Abstraction de l'accès base de données |
| **Sessions PHP** | Authentification et état utilisateur |
| **FPDF / FPDI / TCPDF** | Génération de PDF (leçons, examens) |

### Frontend

| Technologie | Version | Rôle |
|-------------|---------|------|
| **Bootstrap** | 4.6.1 | Framework CSS responsive |
| **AdminLTE** | 3.2.0 | Template dashboard admin |
| **jQuery** | 3.6.0 | Manipulation DOM et AJAX |
| **DataTables** | 1.11.4 | Tableaux avec tri/filtrage |
| **Select2** | 4.0.13 | Menus déroulants enrichis |
| **SweetAlert2** | 11.4.0 | Popups et alertes |
| **Chart.js** | 2.9.4 | Graphiques et visualisations |
| **FullCalendar** | 5.10.1 | Calendrier de planification |
| **CodeMirror** | 5.65.1 | Éditeur de code embarqué |
| **Font Awesome** | 5.15.4 | Icônes |
| **Summernote** | 0.8.20 | Éditeur WYSIWYG |
| **Toastr** | 2.1.4 | Notifications toast |
| **Moment.js** | 2.29.1 | Manipulation des dates |

### Build & Déploiement

| Outil | Rôle |
|-------|------|
| **npm** | Gestionnaire de paquets |
| **Rollup.js** | Bundler JavaScript |
| **node-sass** | Compilation SCSS → CSS |
| **PostCSS** | Transformations CSS (autoprefixer) |
| **Terser** | Minification JavaScript |
| **ESLint** | Linting JavaScript |
| **Stylelint** | Linting SCSS/CSS |
| **Docker** | Conteneurisation (Node 14) |
| **Hostinger** | Hébergement web |

---

## 3. Structure des dossiers

```
gobuchessai/
│
├── *.php                  → 78 fichiers PHP à la racine (pages + logique)
│
├── /lecon/                → Images des leçons          (1 294 fichiers)
├── /leconpdf/             → PDFs des leçons             (210 fichiers)
├── /exercice/             → Contenu des exercices         (3 fichiers)
├── /exercicepdf/          → PDFs des exercices
├── /examen/               → Contenu des examens            (0 fichier)
├── /examenpdf/            → PDFs des examens
├── /evaluation/           → Contenu des évaluations      (573 fichiers)
│
├── /img/                  → Images du site (cours, tuteurs, blog)
├── /bild/                 → Icônes (ICONEP.png, icon1-5.png)
├── /client/               → Ressources côté client (profil.png, etc.)
├── /fonts/                → Polices web
│
├── /css/                  → Feuilles de style personnalisées
├── /js/                   → JavaScript personnalisé
├── /scss/                 → Sources SCSS personnalisées
│
├── /build/                → Sources AdminLTE (JS, SCSS, config)
│   ├── /js/               → Composants JS AdminLTE
│   ├── /scss/             → 47 fichiers SCSS AdminLTE
│   └── /config/           → Config Rollup, PostCSS, Babel
│
├── /dist/                 → Assets compilés et minifiés
│   ├── /css/              → CSS AdminLTE compilé
│   ├── /js/               → JS AdminLTE compilé
│   └── /img/              → Images de distribution
│
├── /plugins/              → 62 paquets npm (dépendances frontend)
├── /vendor/               → Librairies front-end vendorisées
├── /vendors/              → Plugins additionnels
│
├── /phptest/              → Utilitaires de génération PDF
│   └── /vendor/           → Dépendances Composer (FPDF, FPDI, TCPDF)
│
├── /gerer/                → Redirection vers interface de gestion
├── /update/               → Scripts de mise à jour/maintenance
├── /pages/                → Pages de démonstration AdminLTE
├── /docs/                 → Documentation (Jekyll)
│
├── package.json           → Configuration npm (AdminLTE 3.2.0)
├── Dockerfile             → Image Docker (Node 14)
└── .eslintrc.json         → Configuration ESLint
```

---

## 4. Fichiers PHP — Rôles et tailles

### Fichiers de configuration et connexion

| Fichier | Lignes | Rôle |
|---------|--------|------|
| [lien.php](lien.php) | 18 | Credentials base de données (host, user, password) |
| [connectC.php](connectC.php) | 374 | Fonctions de session, audit connexion, comptage visiteurs |
| [auth.php](auth.php) | — | Middleware d'authentification |

### Fichiers core (bibliothèques de fonctions)

| Fichier | Lignes | Rôle |
|---------|--------|------|
| [lesfunctions.php](lesfunctions.php) | **1 540** | ~60 fonctions utilitaires DB (classes, matières, élèves, séances...) |
| [lesmenus.php](lesmenus.php) | 429 | Génération des menus de navigation |
| [lesmenusgerer.php](lesmenusgerer.php) | — | Menus de l'espace de gestion admin |
| [executereq.php](executereq.php) | **2 596** | Handler central AJAX et formulaires POST (toutes actions) |

### Pages principales (parcours élève)

| Fichier | Lignes | Rôle |
|---------|--------|------|
| [index.php](index.php) | — | Page d'accueil — catalogue de cours |
| [login.php](login.php) | — | Page de connexion |
| [logincreat.php](logincreat.php) | — | Création de compte (étape 1) |
| [logincreat2.php](logincreat2.php) | — | Création de compte (étape 2) |
| [delogin.php](delogin.php) | — | Déconnexion |
| [infoperso.php](infoperso.php) | — | Gestion du profil utilisateur |
| [cours.php](cours.php) | 927 | Liste et navigation des cours |
| [lecon.php](lecon.php) | 977 | Affichage du contenu d'une leçon |
| [exercice.php](exercice.php) | 875 | Exercices pratiques |
| [evaluation.php](evaluation.php) | — | Évaluations / QCM |
| [evaluation2.php](evaluation2.php) | — | Variante d'évaluation |
| [ressources.php](ressources.php) | — | Bibliothèque de ressources |
| [examensgen.php](examensgen.php) | — | Examens généraux |
| [examensgen2.php](examensgen2.php) | — | Examens généraux (variante) |
| [programme.php](programme.php) | — | Programme scolaire |
| [programmegen.php](programmegen.php) | — | Programme général |

### Pages tutorat et séances

| Fichier | Lignes | Rôle |
|---------|--------|------|
| [repetition.php](repetition.php) | — | Accueil — demande de répétition/tutorat |
| [repetition-a-domicile.php](repetition-a-domicile.php) | — | Tutorat à domicile |
| [repetitionajax.php](repetitionajax.php) | — | Handler AJAX pour demandes de répétition |
| [seance.php](seance.php) | **1 040** | Gestion des séances de cours |
| [seancejr.php](seancejr.php) | — | Séances journalières |
| [seanceper.php](seanceper.php) | — | Séances périodiques |
| [seanceall.php](seanceall.php) | — | Vue globale des séances |
| [seanceajaxdate.php](seanceajaxdate.php) | — | AJAX — gestion des dates de séance |
| [seanceajaxdate2.php](seanceajaxdate2.php) | — | AJAX — dates (variante) |
| [organiser.php](organiser.php) | — | Organisation des séances |
| [organiser1.php](organiser1.php) | — | Organisation (étape 1) |
| [organiser2.php](organiser2.php) | — | Organisation (étape 2) |
| [organiser3.php](organiser3.php) | — | Organisation (étape 3) |
| [mesdemandes.php](mesdemandes.php) | 250+ | Suivi des demandes en cours |
| [confirmation.php](confirmation.php) | — | Confirmation d'actions |
| [stop.php](stop.php) | — | Arrêt/annulation d'opérations |
| [acturepet.php](acturepet.php) | — | Mise à jour des répétitions |
| [searperiod.php](searperiod.php) | — | Recherche par période |

### Pages enseignants / tuteurs

| Fichier | Lignes | Rôle |
|---------|--------|------|
| [emploi.php](emploi.php) | — | Profil et informations tuteur |
| [emploivue.php](emploivue.php) | — | Vue du profil tuteur |
| [emploivuech.php](emploivuech.php) | — | Vue tuteur (variante) |
| [trituteur.php](trituteur.php) | — | Tri et sélection des tuteurs |
| [modetuteur.php](modetuteur.php) | — | Mode d'affichage tuteur |
| [kontoensg.php](kontoensg.php) | — | Compte enseignant |
| [kontonoensg.php](kontonoensg.php) | — | Compte non-enseignant |
| [creat.php](creat.php) | — | Création de compte tuteur |

### Pages administration

| Fichier | Lignes | Rôle |
|---------|--------|------|
| [detail.php](detail.php) | 958 | Vue détaillée / rapports |
| [detailadm.php](detailadm.php) | **1 382** | Vue détaillée admin |
| [detailPOURADMIN.php](detailPOURADMIN.php) | — | Rapport réservé admin |
| [evaluationadm.php](evaluationadm.php) | — | Gestion évaluations (admin) |
| [evaluation2adm.php](evaluation2adm.php) | — | Évaluations admin (variante) |
| [examensgenadm.php](examensgenadm.php) | — | Examens admin |
| [examensgen2adm.php](examensgen2adm.php) | — | Examens admin (variante) |
| [leskontoacc.php](leskontoacc.php) | — | Gestion des comptes |
| [leskontodet.php](leskontodet.php) | — | Détail des comptes |
| [demandeacc.php](demandeacc.php) | — | Demandes d'accès |
| [dmdcon.php](dmdcon.php) | — | Demandes de connexion |
| [viewvisite.php](viewvisite.php) | — | Statistiques de visites |

### Pages utilitaires / système

| Fichier | Lignes | Rôle |
|---------|--------|------|
| [accesimage.php](accesimage.php) | — | Serveur d'images (leçons) |
| [accesimagexo.php](accesimagexo.php) | — | Serveur d'images (exercices) |
| [numtelaisse.php](numtelaisse.php) | — | Gestion numéros de téléphone |
| [modepaye.php](modepaye.php) | — | Configuration modes de paiement |
| [modetab.php](modetab.php) | — | Mode d'affichage tableau |
| [retrait.php](retrait.php) | — | Retraits / remboursements |
| [paiement en ligne.php](paiement%20en%20ligne.php) | — | Paiement en ligne |
| [infolieu.php](infolieu.php) | — | Information de localisation |
| [locali.php](locali.php) | — | Fonctions de localisation |
| [listnouscon.php](listnouscon.php) | — | Liste de contacts |
| [listavis.php](listavis.php) | — | Avis / témoignages |
| [rand.php](rand.php) | — | Fonctions aléatoires/utilitaires |
| [rand1.php](rand1.php) | — | Utilitaires (variante) |
| [testel.php](testel.php) | — | Tests unitaires simples |
| [indextest.php](indextest.php) | — | Page de test index |
| [widgets1.php](widgets1.php) | — | Widgets dashboard |
| [default.php](default.php) | — | Page par défaut Hostinger |

---

## 5. Base de données

**Nom de la base :** `u356752624_essai`  
**Hôte :** `127.0.0.1`  
**Connexion :** PDO (credentials dans [lien.php](lien.php))

### Tables identifiées

#### Utilisateurs & Comptes

| Table | Colonnes clés | Description |
|-------|--------------|-------------|
| `utilisateur` | `idutilisateur`, `nomuser`, `motpasse` | Élèves / comptes étudiants |
| `admin` | `idamin`, `emailadm`, `mtpadm` | Comptes administrateurs |
| `enseignant` | `idutilisateur`, `quartier`, ... | Profils des enseignants/tuteurs |

#### Contenu pédagogique

| Table | Colonnes clés | Description |
|-------|--------------|-------------|
| `classe` | `idclasse`, `nomclasse` | Niveaux scolaires |
| `matiere` | `idmatiere`, `nomatiere` | Matières enseignées |
| `chapitre` | `idchapitre`, `nomchap`, `ordre` | Chapitres par matière |
| `lecon` | `idlecon`, `nomlecon`, `video`, `date`, `ordre` | Leçons par chapitre |
| `session` | `ordre` | Sessions d'apprentissage |
| `exercice` | — | Exercices pratiques |

#### Tutorat & Séances

| Table | Colonnes clés | Description |
|-------|--------------|-------------|
| `demande` | `idemande` | Demandes de tutorat |
| `estsollicitee` | `idemande`, `idenseign`, `idmatiere`, `duree`, `horairedeb`, `jourcours`, `montant`, `decision` | Offres de tuteurs en réponse aux demandes |
| `seance` | `idseance`, `decisionsea`, `idestsollicitee` | Séances planifiées |
| `momentsouh` | `idmom` | Moments souhaités pour les cours |
| `ensmatclas` | `idcl`, `idmat` | Relation Enseignant–Matière–Classe |
| `estenseigne` | `idcl`, `idmat` | Ce qui est enseigné |

#### Évaluations & Notes

| Table | Colonnes clés | Description |
|-------|--------------|-------------|
| `estevalue` | `idclasse`, `idmatiere`, `nom`, `date` | Évaluations créées |
| `note` | `idnote`, `idlecon`, `idutilisateur`, `texte` | Notes personnelles des élèves |

#### Système & Audit

| Table | Colonnes clés | Description |
|-------|--------------|-------------|
| `enligne` | `idresp`, `dateligne`, `heureligne`, `adrip`, `typeappareil`, `typeutil`, `temps` | Utilisateurs actuellement en ligne |
| `auditconnexion` | `idresp`, `dateaudit`, `heureaudit`, `adrip`, `typeutil`, `temps`, `etab` | Journal de toutes les connexions |
| `acontact` | `nom`, `numsimple`, `numwh` | Contacts de support |

#### Types utilisateurs (`typeutil`)

| Valeur | Signification |
|--------|--------------|
| `0` | Visiteur non identifié |
| `1` | Élève connecté |
| `2` | Administrateur |

#### Types d'appareils (`typeappareil`)

| Valeur | Signification |
|--------|--------------|
| `0` | Téléphone mobile |
| `1` | Ordinateur |

---

## 6. Architecture fonctionnelle

### Fonctions dans `lesfunctions.php` (60+ fonctions)

Regroupées par domaine :

**Formatage & utilitaires**
- `visuelnote()` — Formate l'affichage des notes
- `format()` / `format2()` — Formatage des dates
- `comparaisonheure()` — Compare des plages horaires
- `calculduree()` — Calcule la durée entre deux heures

**Données pédagogiques**
- `nomclasse($id)` — Retourne le nom d'un niveau
- `nomatiere($id)` — Retourne le nom d'une matière
- `nomchap($id)` / `nomlecon($id)` — Noms des chapitres/leçons
- `videolecon($id)` — URL vidéo d'une leçon
- `imagelecon($id)` / `imagexo($id)` — Images de leçon/exercice
- `nbrelecon($idchap)` — Nombre de leçons dans un chapitre
- `datelecon()` / `ordlecon()` / `ordchap()` — Métadonnées

**Évaluations & examens**
- `evalutout($idclas,$idmat)` — Toutes les évaluations d'une classe/matière
- `evaludat()` / `evaludatp()` — Évaluations par date / période
- `examtout()` / `examdat()` / `examdatp()` — Idem pour les examens

**Enseignants**
- `verifensg($idutil)` — Vérifie si un utilisateur est enseignant
- `verifensgcomp($idu,$idmat,$idclas)` — Vérifie compétence enseignant
- `imagensg($idu)` — Photo de profil enseignant
- `vilensg($idu)` / `qtierensg($idu)` — Ville/quartier de l'enseignant
- `genre($id)` — Genre de l'utilisateur

**Utilisateurs**
- `completname($idutil)` — Nom complet
- `namekonto()` / `vornamekonto()` — Prénom / Nom
- `infokontouser($idutil)` — Infos complètes du compte
- `note($idlecon,$idutil)` — Note personnelle de l'élève

**Séances & disponibilités**
- `infosdemande($idemand)` — Infos d'une demande de tutorat
- `infoseanc($idseanc)` — Infos d'une séance
- `lastsean($idestsoll)` — Dernière séance
- `seancemploi($idestsoll)` — Emploi du temps de séance
- `disponibilite($iduser,$jr,$min1,$max1)` — Vérifie disponibilité tuteur
- `momentsouh($idmom)` — Moment souhaité
- `nomjour($id)` / `nomheure($id)` — Libellés jours/heures
- `nomduree($id)` — Libellé durée

**Vérifications et correspondances**
- `mmclasse($nom)` / `mmatiere($nom)` / `mmchap($nom)` / `mmlecon($nom)` — Vérification d'existence
- `existestenseigne()` / `existordre()` — Vérifications de doublons
- `idestenseigne($idcl,$idmat)` — ID de la relation ens.–matière

### Fonctions dans `connectC.php`

- `verifadmin($user,$mot)` — Authentification admin (SELECT * FROM admin)
- `verifuser($user,$mot)` — Authentification élève (SELECT * FROM utilisateur)
- `timestampajour()` — Met à jour la table `enligne` (présence)
- `tentative_connexion()` — Insère dans `auditconnexion`
- `pourcomptervisite()` — Calcule la durée de visite (delta temps)
- `useronline()` — Retourne compteurs visiteurs actifs
- `nbreverbinden($date,$monadrip)` — Nombre de connexions par jour
- `pagesvisites($date,$monadrip)` — Nombre de pages vues

---

## 7. Flux utilisateur

### Parcours Élève

```
[index.php]
    │
    ├── Nouveau → [logincreat.php] → [logincreat2.php]
    │
    └── Existant → [login.php] → session démarrée
                        │
                        ├── [cours.php] ─── choisir matière/niveau
                        │       │
                        │       └── [lecon.php] ─── voir leçon (images/vidéo)
                        │               │
                        │               ├── [exercice.php] ─── pratiquer
                        │               └── [evaluation.php] ─── s'évaluer
                        │
                        ├── [repetition.php] ─── demander un tuteur
                        │       │
                        │       └── [seance.php] ─── gérer les séances
                        │               │
                        │               └── [organiser.php] ─── planifier
                        │
                        └── [infoperso.php] ─── gérer son profil
```

### Parcours Tuteur

```
[login.php] → session enseignant
    │
    ├── [emploi.php] ─── voir/éditer son profil
    ├── [mesdemandes.php] ─── consulter les demandes
    ├── [seance.php] ─── gérer ses séances
    └── [programme.php] ─── voir son emploi du temps
```

### Parcours Admin

```
[login.php] → session admin (typeutil=2)
    │
    ├── Dashboard AdminLTE
    ├── [detailadm.php] ─── rapports détaillés
    ├── [evaluationadm.php] / [examensgenadm.php] ─── gérer évaluations
    ├── [leskontoacc.php] ─── gérer les comptes
    └── [viewvisite.php] ─── statistiques de visite
```

### Traitement des requêtes

Toutes les actions (formulaires POST, AJAX) passent par **[executereq.php](executereq.php)** (2596 lignes) — c'est le point central de traitement côté serveur.

---

## 8. Sécurité — Points critiques

> Ces points sont à traiter en priorité avant toute mise en production.

### Credentials en clair dans le code

Le fichier [lien.php](lien.php) contient les identifiants de base de données en clair :

```php
$host = 'mysql:host=127.0.0.1;dbname=u356752624_essai';
$UTIL = 'u356752624_essai';
$mtp  = 'SV6PduF7v8UDq5S';  // mot de passe en clair
```

**Risque :** Si le fichier est exposé ou le dépôt rendu public, les credentials sont compromis.  
**Solution recommandée :** Utiliser des variables d'environnement (`.env` + `getenv()`).

### Mots de passe non hashés

Dans `connectC.php`, la vérification des mots de passe se fait par comparaison directe :

```php
if($donnees['nomuser']==$user AND $donnees['motpasse']==$mot)
```

**Risque :** Les mots de passe sont stockés en clair en base de données.  
**Solution recommandée :** `password_hash()` à la création + `password_verify()` à la connexion.

### Injections SQL potentielles

De nombreuses requêtes construisent des chaînes SQL directement avec des variables de session :

```php
$r = "UPDATE enligne SET dateligne='".$date."' WHERE adrip='".$_SERVER['REMOTE_ADDR']."'";
```

**Risque :** Injection SQL si les données ne sont pas validées.  
**Solution recommandée :** Utiliser systématiquement les requêtes préparées PDO (`->prepare()` + `->execute()`).

### Authentification par SELECT * 

Les fonctions `verifadmin()` et `verifuser()` font un `SELECT * FROM admin` et itèrent sur **tous** les enregistrements. 

**Risque :** Performance dégradée + logique fragile.  
**Solution recommandée :** `SELECT * FROM admin WHERE emailadm = ? AND mtpadm = ? LIMIT 1`.

---

## 9. Points d'amélioration potentiels

### Performance

| Problème | Localisation | Impact |
|----------|-------------|--------|
| `SELECT *` sur toutes les tables pour vérifier un utilisateur | `connectC.php:17,42` | Lent sur grandes tables |
| Nouvelle connexion PDO créée à chaque appel de fonction | Toutes les fonctions de `lesfunctions.php` | Overhead de connexion |
| Pas de cache ni d'indexation visible | Base de données | Requêtes lentes |

### Organisation du code

| Problème | Description |
|----------|-------------|
| 78 fichiers PHP à la racine | Pas de routing, pas de MVC — difficile à maintenir |
| `executereq.php` à 2596 lignes | Fichier "god" gérant tout — à découper |
| `lesfunctions.php` à 1540 lignes | Bibliothèque monolithique sans namespace |
| Logique et HTML mélangés | Chaque page mêle PHP et HTML directement |
| Duplication de code | Nombreuses variantes de fichiers (`organiser1/2/3.php`, `evaluation/evaluation2.php`) |

### Nommage

| Problème | Exemples |
|----------|---------|
| Mélange de langues | `verifuser` (FR/EN) + `nomevaluation` (FR) + `Verbinden` (DE) + `vorname` (DE) |
| Noms peu explicites | `rand.php`, `rand1.php`, `testel.php`, `widgets1.php` |
| Fichier avec espace | `paiement en ligne.php` — problématique en URL |

### Autres observations

- **Pas de framework PHP** — Tout est écrit en PHP procédural pur, ce qui rend les évolutions difficiles
- **Pas de gestion d'erreurs centralisée** — Les `die()` sont utilisés pour les erreurs DB
- **Fichiers image à la racine** — `3.jpg`, `aa.jpg`, `bb.jpg`, etc. — à organiser dans `/img/`
- **Docker basé sur Node 14** — Version en fin de vie (EOL)
- **Base de données nommée `_essai`** — Suggère un environnement de test utilisé en production

---

*Rapport généré par analyse statique du projet. Pour toute question ou modification, référez-vous aux fichiers listés ci-dessus.*
