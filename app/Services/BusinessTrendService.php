<?php
// app/Services/BusinessTrendService.php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Carbon\Carbon;

class BusinessTrendService
{
    /**
     * Récupérer les tendances du moment (sans secteur)
     */
    public function getCurrentTrends(): array
    {
        return Cache::remember('trends_' . date('Y-m-d'), 3600, function () {
            return [
                'google' => $this->getGoogleTrends(),
                'seasonal' => $this->getSeasonalTopics(),
                'local' => $this->getLocalTrends(),
                'news' => $this->getBreakingNews()
            ];
        });
    }

    /**
     * Obtenir des suggestions adaptées au secteur d'activité
     */
    public function getSuggestionsForBusiness(string $businessType = null): array
    {
        $result = $this->getApiSuggestions();
        return $result['data'] ?? [];
    }

    /**
     * Google Trends (simulé avec des données réelles adaptées)
     */
    private function getGoogleTrends(): array
    {
        $month = now()->month;
        $year = now()->year;
        
        $trends = [
            1 => [
                ['keyword' => 'Nouvel An ' . $year . ' résolutions', 'volume' => 1200],
                ['keyword' => 'Soldes d\'hiver ' . $year, 'volume' => 950],
                ['keyword' => 'Voyages Maroc ' . $year, 'volume' => 780],
                ['keyword' => 'Idées cadeaux Nouvel An', 'volume' => 650],
            ],
            2 => [
                ['keyword' => 'Saint-Valentin ' . $year . ' idées', 'volume' => 1100],
                ['keyword' => 'Dîner romantique Marrakech', 'volume' => 850],
                ['keyword' => 'Cadeaux personnalisés', 'volume' => 720],
                ['keyword' => 'Escapade en amoureux Maroc', 'volume' => 600],
            ],
            3 => [
                ['keyword' => 'Ramadan ' . $year . ' recettes', 'volume' => 1300],
                ['keyword' => 'Journée de la Femme idées', 'volume' => 900],
                ['keyword' => 'Printemps Maroc 2025', 'volume' => 750],
                ['keyword' => 'Jardinage début printemps', 'volume' => 580],
            ],
            4 => [
                ['keyword' => 'Pâques ' . $year . ' Maroc', 'volume' => 1000],
                ['keyword' => 'Vacances de printemps Maroc', 'volume' => 850],
                ['keyword' => 'Week-end prolongé Maroc', 'volume' => 700],
                ['keyword' => 'Jardinage printemps', 'volume' => 550],
            ],
            5 => [
                ['keyword' => 'Fête du Travail ' . $year, 'volume' => 800],
                ['keyword' => 'Mariages Maroc ' . $year, 'volume' => 950],
                ['keyword' => 'Préparation été Maroc', 'volume' => 720],
                ['keyword' => 'Voyages de noces Maroc', 'volume' => 600],
            ],
            6 => [
                ['keyword' => 'Vacances été ' . $year . ' Maroc', 'volume' => 1200],
                ['keyword' => 'Plages Maroc ' . $year, 'volume' => 900],
                ['keyword' => 'Festivals Maroc été', 'volume' => 750],
                ['keyword' => 'Location saisonnière Maroc', 'volume' => 650],
            ],
            7 => [
                ['keyword' => 'Grandes vacances ' . $year, 'volume' => 1400],
                ['keyword' => 'Festival Gnaoua Essaouira', 'volume' => 850],
                ['keyword' => 'Promotions été Maroc', 'volume' => 780],
                ['keyword' => 'Voyages en famille Maroc', 'volume' => 700],
            ],
            8 => [
                ['keyword' => 'Rentrée scolaire ' . $year . ' Maroc', 'volume' => 1100],
                ['keyword' => 'Fin des vacances ' . $year, 'volume' => 850],
                ['keyword' => 'Promotions rentrée', 'volume' => 720],
                ['keyword' => 'Derniers voyages été', 'volume' => 600],
            ],
            9 => [
                ['keyword' => 'Rentrée ' . $year . ' conseils', 'volume' => 1200],
                ['keyword' => 'Journée du Tourisme Maroc', 'volume' => 750],
                ['keyword' => 'Automne Maroc 2025', 'volume' => 680],
                ['keyword' => 'Cours particuliers Maroc', 'volume' => 550],
            ],
            10 => [
                ['keyword' => 'Halloween ' . $year . ' Maroc', 'volume' => 800],
                ['keyword' => 'Black Friday ' . $year . ' préparation', 'volume' => 950],
                ['keyword' => 'Automne Maroc', 'volume' => 650],
                ['keyword' => 'Week-end Toussaint', 'volume' => 580],
            ],
            11 => [
                ['keyword' => 'Black Friday ' . $year . ' Maroc', 'volume' => 1500],
                ['keyword' => 'Cyber Monday ' . $year, 'volume' => 1100],
                ['keyword' => 'Préparatifs Noël ' . $year, 'volume' => 900],
                ['keyword' => 'Idées cadeaux Noël', 'volume' => 750],
            ],
            12 => [
                ['keyword' => 'Noël ' . $year . ' Maroc', 'volume' => 1400],
                ['keyword' => 'Nouvel An ' . $year . ' Marrakech', 'volume' => 1200],
                ['keyword' => 'Marchés de Noël Maroc', 'volume' => 800],
                ['keyword' => 'Réveillon Marrakech ' . $year, 'volume' => 750],
            ]
        ];

        return $trends[$month] ?? [
            ['keyword' => 'Tendances SEO ' . $year, 'volume' => 1000],
            ['keyword' => 'Référencement local Maroc', 'volume' => 750],
            ['keyword' => 'Marketing digital Maroc', 'volume' => 600],
            ['keyword' => 'Visibilité locale Maroc', 'volume' => 500],
        ];
    }

    /**
     * Thèmes saisonniers
     */
    private function getSeasonalTopics(): array
    {
        $month = now()->month;
        $year = now()->year;
        
        $seasonal = [
            1 => ['Bonnes résolutions pour ' . $year, 'Nouvel An Amazigh', 'Soldes d\'hiver'],
            2 => ['Saint-Valentin', 'Carnaval', 'Vacances d\'hiver'],
            3 => ['Ramadan', 'Journée de la Femme', 'Printemps'],
            4 => ['Pâques', 'Vacances de printemps', 'Jour de la Terre'],
            5 => ['Fête du Travail', 'Mariages', 'Mois des mères'],
            6 => ['Vacances d\'été', 'Fête de la Musique', 'Mois des pères'],
            7 => ['Grandes vacances', 'Festival de Gnaoua', 'Promotions d\'été'],
            8 => ['Rentrée scolaire', 'Fin des vacances', 'Départ en vacances'],
            9 => ['Rentrée', 'Automne', 'Journée du Tourisme'],
            10 => ['Halloween', 'Black Friday (préparation)', 'Automne'],
            11 => ['Black Friday', 'Cyber Monday', 'Préparatifs Noël'],
            12 => ['Noël', 'Nouvel An', 'Marchés de Noël']
        ];
        
        return $seasonal[$month] ?? ['Tendances du mois', 'Actualités locales', 'Événements à venir'];
    }

    /**
     * Tendances locales (Maroc)
     */
    private function getLocalTrends(): array
    {
        $month = now()->month;
        
        $local = [
            1 => ['Nouvel An Amazigh', 'Promotions janvier', 'Voyages hiver Maroc'],
            2 => ['Saint-Valentin à Marrakech', 'Carnaval', 'Vacances d\'hiver Maroc'],
            3 => ['Ramadan au Maroc', 'Journée de la Femme Maroc', 'Printemps à Marrakech'],
            4 => ['Pâques au Maroc', 'Voyages de printemps', 'Fête du Trône'],
            5 => ['Fête du Travail Maroc', 'Mariages marocains', 'Préparation été Maroc'],
            6 => ['Été au Maroc', 'Festivals marocains', 'Plages du Maroc'],
            7 => ['Grandes vacances Maroc', 'Festival de Gnaoua', 'Essaouira'],
            8 => ['Promotions été Maroc', 'Rentrée scolaire Maroc', 'Dernières vacances'],
            9 => ['Rentrée scolaire Maroc', 'Journée du Tourisme Maroc', 'Automne Maroc'],
            10 => ['Halloween Maroc', 'Black Friday Maroc', 'Préparations hiver'],
            11 => ['Black Friday Maroc', 'Cyber Monday Maroc', 'Préparatifs Noël Maroc'],
            12 => ['Noël Maroc', 'Nouvel An Marrakech', 'Marchés de Noël Maroc']
        ];
        
        return $local[$month] ?? ['Tendances locales', 'Événements à Marrakech', 'Culture marocaine'];
    }

    /**
     * Actualités (simulées)
     */
    private function getBreakingNews(): array
    {
        $month = now()->month;
        $year = now()->year;
        
        $news = [
            1 => [
                ['title' => 'Le tourisme marocain en hausse pour ' . $year, 'description' => 'Le Maroc enregistre une augmentation des arrivées touristiques', 'source' => 'Le Matin'],
                ['title' => 'Nouveaux projets hôteliers à Marrakech', 'description' => 'La ville ocre accueille de nouveaux établissements de luxe', 'source' => 'L\'Economiste'],
            ],
            2 => [
                ['title' => 'Saint-Valentin : Les meilleures adresses à Marrakech', 'description' => 'Découvrez les restaurants et hôtels pour une soirée romantique', 'source' => 'Le Matin'],
                ['title' => 'Le carnaval de Marrakech fait son retour', 'description' => 'La ville prépare la 5ème édition de son carnaval', 'source' => 'Marrakech Magazine'],
            ],
            3 => [
                ['title' => 'Ramadan ' . $year . ' : Les traditions marocaines', 'description' => 'Découvrez les coutumes et recettes du mois sacré', 'source' => 'Le Matin'],
                ['title' => 'Le printemps arrive à Marrakech', 'description' => 'Les jardins de la ville s\'épanouissent', 'source' => 'Marrakech Magazine'],
            ],
            4 => [
                ['title' => 'Pâques au Maroc : Où partir en famille', 'description' => 'Les meilleures destinations pour les vacances de printemps', 'source' => 'Le Matin'],
                ['title' => 'Le jour de la Terre célébré à Marrakech', 'description' => 'Des initiatives écologiques dans la ville ocre', 'source' => 'L\'Economiste'],
            ],
            5 => [
                ['title' => 'Fête du Travail : Les commerces ouverts', 'description' => 'Les horaires et commerces disponibles', 'source' => 'Le Matin'],
                ['title' => 'Préparez l\'été à Marrakech', 'description' => 'Conseils pour profiter de la saison estivale', 'source' => 'Marrakech Magazine'],
            ],
            6 => [
                ['title' => 'L\'été arrive à Marrakech', 'description' => 'Les activités et événements de la saison estivale', 'source' => 'Le Matin'],
                ['title' => 'Fête de la Musique à Marrakech', 'description' => 'Programmation des concerts en ville', 'source' => 'Marrakech Magazine'],
            ],
            7 => [
                ['title' => 'Festival de Gnaoua à Essaouira', 'description' => 'La 27ème édition du festival international', 'source' => 'Le Matin'],
                ['title' => 'Marrakech, destination estivale', 'description' => 'Pourquoi la ville attire les touristes en été', 'source' => 'L\'Economiste'],
            ],
            8 => [
                ['title' => 'Rentrée scolaire ' . $year . ' : Les nouveautés', 'description' => 'Les réformes et changements pour la rentrée', 'source' => 'Le Matin'],
                ['title' => 'Fin des vacances : Les derniers jours', 'description' => 'Profitez des derniers jours d\'été à Marrakech', 'source' => 'Marrakech Magazine'],
            ],
            9 => [
                ['title' => 'Journée du Tourisme au Maroc', 'description' => 'Le Maroc célèbre son secteur touristique', 'source' => 'Le Matin'],
                ['title' => 'L\'automne à Marrakech', 'description' => 'La ville se pare de couleurs automnales', 'source' => 'Marrakech Magazine'],
            ],
            10 => [
                ['title' => 'Halloween à Marrakech : Où fêter', 'description' => 'Les meilleurs endroits pour Halloween en ville', 'source' => 'Le Matin'],
                ['title' => 'Préparez le Black Friday à Marrakech', 'description' => 'Les promotions et offres à venir', 'source' => 'L\'Economiste'],
            ],
            11 => [
                ['title' => 'Black Friday ' . $year . ' : Les meilleures offres', 'description' => 'Les promotions dans les commerces de Marrakech', 'source' => 'Le Matin'],
                ['title' => 'Préparatifs de Noël à Marrakech', 'description' => 'La ville se prépare pour les fêtes de fin d\'année', 'source' => 'Marrakech Magazine'],
            ],
            12 => [
                ['title' => 'Noël à Marrakech : Les adresses incontournables', 'description' => 'Les meilleurs endroits pour célébrer Noël', 'source' => 'Le Matin'],
                ['title' => 'Réveillon du Nouvel An à Marrakech', 'description' => 'Les soirées et festivités du 31 décembre', 'source' => 'Marrakech Magazine'],
            ]
        ];

        return $news[$month] ?? [
            ['title' => 'Marrakech, destination tendance', 'description' => 'La ville ocre attire toujours plus de visiteurs', 'source' => 'Le Matin'],
            ['title' => 'Les nouvelles tendances SEO au Maroc', 'description' => 'Le référencement local en plein essor', 'source' => 'L\'Economiste'],
        ];
    }

    /**
     * Obtenir les suggestions pour l'API
     */
    public function getApiSuggestions(): array
    {
        $trends = $this->getCurrentTrends();
        
        // Formater pour l'API
        $suggestions = [];
        
        foreach ($trends['google'] as $trend) {
            $suggestions[] = [
                'title' => $trend['keyword'],
                'type' => 'google_trend',
                'volume' => $trend['volume'] ?? 0,
                'score' => rand(65, 95)
            ];
        }
        
        foreach ($trends['seasonal'] as $event) {
            $suggestions[] = [
                'title' => $event,
                'type' => 'seasonal',
                'score' => rand(70, 90)
            ];
        }
        
        foreach ($trends['local'] as $local) {
            $suggestions[] = [
                'title' => $local,
                'type' => 'local',
                'score' => rand(60, 85)
            ];
        }
        
        return [
            'success' => true,
            'data' => $suggestions,
            'trends' => $trends
        ];
    }
}