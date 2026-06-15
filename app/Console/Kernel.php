<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Les commandes Artisan enregistrées dans l'application.
     *
     * @var array
     */
    protected $commands = [
        // Commandes enregistrées automatiquement
    ];

    /**
     * Planification des commandes.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // ⭐ PLANIFICATION DES ARTICLES PROGRAMMÉS
        // Vérifie toutes les minutes les articles à publier
        $schedule->command('articles:publish-scheduled')->everyMinute();
        
        // ⭐ ATTRIBUTION DES BADGES (tous les jours à minuit)
        $schedule->command('badges:award')->dailyAt('00:00');
        
        // ⭐ ENVOYER LES RAPPELS HEBDOMADAIRES (tous les lundis à 9h)
        $schedule->command('notify:weekly-article-reminder')->weeklyOn(1, '09:00');
        
        // Alternative : tous les jours à 9h
        // $schedule->command('notify:weekly-article-reminder')->dailyAt('09:00');
    }

    /**
     * Enregistrement des commandes.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}