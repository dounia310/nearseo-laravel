<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        // Mettre à jour les notifications existantes
        $notifications = DB::table('notifications')->get();
        
        foreach ($notifications as $n) {
            $icon = match ($n->type) {
                'success' => 'check_circle',
                'warning' => 'warning',
                'error' => 'error',
                'info' => 'info',
                default => 'notifications',
            };
            
            DB::table('notifications')
                ->where('id', $n->id)
                ->update([
                    'icon' => $icon,
                    'url' => $n->data ? json_decode($n->data, true)['url'] ?? null : null,
                ]);
        }
    }

    public function down() {}
};