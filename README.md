# NEARSEO

**Plateforme SaaS d'optimisation SEO local assistée par Intelligence Artificielle**

## Présentation

NEARSEO est une plateforme SaaS qui permet aux commerçants de proximité (boulangeries, coiffeurs, restaurants, fleuristes, artisans) de générer automatiquement des articles SEO optimisés et de les publier sur leur propre blog ou site web, sans aucune compétence technique.

L'application combine :

- L'intelligence artificielle (API Google Gemini) pour la génération automatique d'articles SEO
- La géolocalisation (OpenStreetMap / Leaflet) pour le ciblage territorial
- Un algorithme d'analyse SEO maison (score 0-100) pour garantir la qualité rédactionnelle

---

## Problématique

Durant un stage de cinq mois en SEO, trois difficultés majeures ont été identifiées :

1. La rédaction chronophage d'articles SEO pour plusieurs clients
2. La gestion complexe d'un calendrier éditorial multi-clients
3. Les limites des outils SEO existants (Rank Math, Yoast) confinés à WordPress, sans vue consolidée des performances

**Question centrale :** Comment concevoir une plateforme SaaS qui automatise la génération d'articles SEO par IA, intègre une analyse en temps réel, centralise la gestion éditoriale, ajoute une dimension géographique pour le ciblage territorial, et reste accessible aux commerçants locaux non experts ?

---

## Fonctionnalités

### Génération d'articles par Intelligence Artificielle

- Génération automatique d'articles SEO en moins de 30 secondes
- Utilisation de l'API Google Gemini (`gemini-2.5-flash`)
- Structure HTML respectée : `<h1>`, `<h2>`, `<h3>`, `<p>`, `<ul>`, `<strong>`, `<a>`
- Prompt optimisé (anti-IA, EEAT, storytelling terrain)

### Analyse SEO en temps réel

- Score SEO de 0 à 100 basé sur :
  - Couverture sémantique (H1, H2, H3)
  - Présence de FAQ (signal EEAT)
  - Entités locales (mention de la ville)
  - Liens internes et externes
  - Longueur du contenu
- Suggestions d'amélioration en temps réel
- Aperçu Google

### Éditeur d'article

- Éditeur WYSIWYG Jodit intégré
- Barre d'outils complète : gras, italique, listes, titres, liens, images
- Sauvegarde automatique
- Planification de publication

### SEO Local avec OpenStreetMap

- Carte interactive Leaflet + OpenStreetMap
- Ancrage géographique du contenu (quartier, ville, pays)
- Recherche d'adresse
- Géolocalisation automatique

### Onboarding en 3 étapes

- Étape 1 : Compte (nom, email, mot de passe)
- Étape 2 : Mon commerce (nom, catégorie, adresse, mode local ou en ligne)
- Étape 3 : Préférences (langue, ton, format, objectifs)

### Blog public

- Chaque utilisateur dispose de son blog accessible à `/blog/{slug}`
- Article accessible à `/blog/{slug}/{article-slug}`
- Design responsive

### Communauté

- Page communautaire avec les articles populaires
- Système de likes et de commentaires

### Notifications

- Notifications en temps réel (article généré, badges, rappels)
- API JSON pour l'intégration front

### Panneau d'administration

- Gestion des utilisateurs (CRUD, rôles)
- Statistiques globales
- Configuration de la plateforme

---

## Stack technique

| Composant | Technologie |
|---|---|
| Framework | Laravel 12 |
| Langage | PHP 8.2 |
| Base de données | MySQL 8.0 |
| Frontend | Blade, Tailwind CSS, JavaScript |
| Éditeur | Jodit 4.x (installation locale) |
| Intelligence Artificielle | Google Gemini API |
| Cartographie | Leaflet, OpenStreetMap |
| Build | Vite |
| Versionnement | Git, GitHub |
| Environnement local | XAMPP (Apache, MySQL, phpMyAdmin) |
| Éditeur de code | Visual Studio Code |

---

## Prérequis

- PHP >= 8.2
- Composer >= 2.5
- Node.js >= 18
- MySQL >= 8.0
- Clé API Google Gemini
- Git

---

## Installation

### 1. Cloner le projet

```bash
git clone https://github.com/dounia310/nearseo-laravel.git
cd nearseo-laravel
```

### 2. Installer les dépendances PHP

```bash
composer install
```

### 3. Installer les dépendances JavaScript

```bash
npm install
```

### 4. Copier le fichier d'environnement

```bash
cp .env.example .env
```

### 5. Générer la clé d'application

```bash
php artisan key:generate
```

### 6. Configurer la base de données

Modifiez les variables dans le fichier `.env` :

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nearseo_db
DB_USERNAME=root
DB_PASSWORD=
```

### 7. Exécuter les migrations

```bash
php artisan migrate
```

### 8. Créer le lien symbolique pour le stockage

```bash
php artisan storage:link
```

### 9. Compiler les ressources front

```bash
npm run build
```

### 10. Lancer le serveur

```bash
php artisan serve
```

Ouvrez ensuite `http://127.0.0.1:8000`.

---

## Configuration

### Variables d'environnement essentielles

```env
# Application
APP_NAME=NEARSEO
APP_ENV=local
APP_DEBUG=true
APP_URL=http://127.0.0.1:8000
APP_TIMEZONE=Africa/Casablanca
APP_LOCALE=fr

# Base de données
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nearseo_db
DB_USERNAME=root
DB_PASSWORD=

# Session
SESSION_DRIVER=file
SESSION_LIFETIME=120
SESSION_DOMAIN=null
SESSION_SECURE_COOKIE=false

# API Google Gemini
GEMINI_API_KEY=votre_cle_api_ici
GEMINI_MODEL=gemini-2.5-flash
GEMINI_TIMEOUT=45
GEMINI_RETRY_TIMES=2
GEMINI_RETRY_MS=1500

# Queue
QUEUE_CONNECTION=sync

# Mail
MAIL_MAILER=log
```

### Configuration de l'API Gemini

1. Créez une clé API sur Google AI Studio : https://aistudio.google.com/app/apikey
2. Ajoutez-la dans le fichier `.env`
3. Videz les caches :

```bash
php artisan config:clear
```

Note : le quota gratuit de Gemini est limité à 15 requêtes par minute et 1500 requêtes par jour. Pour la production, activez la facturation Google Cloud.

---

## Utilisation

### 1. Créer un compte

Rendez-vous sur `/register` et inscrivez-vous.

### 2. Compléter l'onboarding

Après l'inscription, vous serez redirigé vers `/onboarding/business` :

- Remplissez les informations du commerce
- Choisissez le mode (Commerce local ou Entreprise en ligne)
- Complétez les préférences

### 3. Générer un article

Rendez-vous sur `/ai/create` :

- Saisissez le sujet
- Ajustez éventuellement les options avancées (langue, ton, format)
- Cliquez sur le bouton de génération

### 4. Éditer et publier

Vous serez redirigé vers `/articles/{id}/edit` :

- Modifiez le titre, la meta description, le contenu
- Vérifiez le score SEO en temps réel
- Publiez l'article

### 5. Consulter le blog public

Votre blog est accessible à `/blog/{votre-slug}`.

---

## Architecture

### Structure du projet

```
nearseo-laravel/
├── app/
│   ├── Console/Commands/          # Commands Artisan (Badges, Rappels)
│   ├── Http/
│   │   ├── Controllers/           # Contrôleurs (AI, Article, Profile)
│   │   ├── Middleware/            # EnsureOnboardingCompleted, AdminMiddleware
│   │   └── Requests/              # Form Requests (Login, ProfileUpdate)
│   ├── Models/                    # Eloquent (User, Article, Badge)
│   ├── Policies/                  # ArticlePolicy
│   ├── Providers/                 # AppServiceProvider, AuthServiceProvider
│   └── Services/                  # Services métier
│       ├── GeminiService.php      # API Google Gemini
│       ├── ContentCleanerService.php
│       ├── SeoAnalyzerService.php
│       └── SeoValidatorService.php
├── bootstrap/app.php              # Configuration Laravel 12
├── database/migrations/           # Migrations
├── public/vendor/jodit/           # Éditeur Jodit (local)
├── resources/views/               # Vues Blade
│   ├── dashboard/                 # Dashboard, AI, Articles
│   ├── onboarding/                # Onboarding 3 étapes
│   ├── auth/                      # Login, Register, Reset
│   ├── blog/                      # Blog public
│   └── settings/                  # Paramètres utilisateur
└── routes/web.php                 # Toutes les routes
```

### Modèle relationnel

```
users (id, name, email, password, role, avatar, bio, created_at, updated_at)
articles (id, user_id, title, slug, content, focus_keyword, meta_description, status, views, seo_score, address, image, published_at, scheduled_for, created_at, updated_at)
badges (id, name, icon, description, points_required)
user_badges (user_id, badge_id, awarded_at)
ai_generations (id, user_id, topic, location, generated_title, generated_content, created_at)
notifications (id, user_id, title, message, type, is_read, created_at)
```

### Flux de génération d'article

```
Utilisateur -> /ai/create
     |
AIController::generate()
     |
GeminiService::generateArticle()
     |
API Gemini (avec responseMimeType: json)
     |
Parsing JSON -> HTML structuré
     |
ContentCleanerService::clean()
     |
Article::create() -> Base de données
     |
Redirection vers /articles/{id}/edit
```

---

## Tests

### Lancer tous les tests

```bash
php artisan test
```

### Tests unitaires

```bash
php artisan test --testsuite=Unit
```

### Tests fonctionnels

```bash
php artisan test --testsuite=Feature
```

### Test spécifique

```bash
php artisan test --filter=AuthenticationTest
```

---

## Déploiement

### Préparation

```bash
# Mode production
APP_ENV=production
APP_DEBUG=false

# Optimisation
composer install --no-dev --optimize-autoloader
npm run build
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

### Hébergement recommandé

- Hébergeur : Hetzner CX22 (2 vCPU, 4 Go RAM)
- Panneau : Laravel Forge ou Ploi
- SSL : Let's Encrypt
- CDN : Cloudflare
- Monitoring : Sentry, UptimeRobot

### Checklist avant mise en ligne

- `APP_DEBUG=false`
- `APP_ENV=production`
- Clé d'application régénérée
- HTTPS actif
- Base de données MySQL avec sauvegardes automatiques
- Redis pour cache, session et queue
- Supervisor pour les workers
- Cron pour le scheduler
- Cloudflare CDN actif
- Clé Gemini avec facturation activée

---

## Roadmap

### Version 1.0 (terminée)

- Génération d'articles avec Gemini
- Analyse SEO en temps réel
- Éditeur Jodit en local
- Cartographie OpenStreetMap
- Blog public
- Onboarding en 3 étapes
- Middleware onboarding
- Panneau d'administration
- Notifications

### Version 1.1 (en cours)

- Publication automatique sur WordPress
- Configuration de la page "Mon site web"
- Historique des publications externes

### Version 2.0 (prévue)

- Support Shopify
- Support Wix
- API publique
- Application mobile
- Multilingue (français, anglais, arabe)
- Génération automatique d'images par IA
- Intégration Google My Business
- Système de paiement en ligne (CIH Bank, PayPal, Stripe)

---

## Modèle économique

| Formule | Prix | Fonctionnalités |
|---|---|---|
| Starter | 19 euros par mois | 5 articles par mois, blog NEARSEO |
| Pro | 29 euros par mois | 20 articles par mois, publication WordPress |
| Business | 49 euros par mois | Articles illimités, multi-sites, support prioritaire |

Modèle SaaS classique avec revenus récurrents mensuels.

---

## Documentation

- Laravel 12 : https://laravel.com/docs
- Google Gemini API : https://ai.google.dev/docs
- Jodit Editor : https://xdsoft.net/jodit/
- Leaflet : https://leafletjs.com/
- OpenStreetMap : https://www.openstreetmap.org/
- Tailwind CSS : https://tailwindcss.com/

---

## Contribution

Les contributions sont les bienvenues.

1. Forkez le projet
2. Créez une branche (`git checkout -b feature/NouvelleFonctionnalite`)
3. Committez vos changements (`git commit -m 'Ajout d'une nouvelle fonctionnalité'`)
4. Poussez la branche (`git push origin feature/NouvelleFonctionnalite`)
5. Ouvrez une Pull Request

---

## Licence

Ce projet est sous licence MIT. Voir le fichier LICENSE pour plus de détails.

---

## Auteur

Dounia EL Horre

- GitHub : https://github.com/dounia310
- Dépôt : https://github.com/dounia310/nearseo-laravel

---

## Support

Pour toute question ou problème :

- Issues : https://github.com/dounia310/nearseo-laravel/issues
- Documentation : https://github.com/dounia310/nearseo-laravel/wiki
