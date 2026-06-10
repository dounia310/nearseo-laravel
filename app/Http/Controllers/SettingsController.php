<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SettingsController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        // Paramètres du blog
        $blogSettings = [
            'name' => 'Mon Blog Local Expert',
            'subdomain' => 'monblog',
            'description' => 'Expertise locale et conseils personnalisés pour optimiser votre visibilité.'
        ];
        
        // Abonnement
        $subscription = [
            'plan' => 'Pro Agency',
            'price' => '49€',
            'features' => ['Blogs illimités', 'IA Premium', 'Audit SEO hebdomadaire']
        ];
        
        // Factures
        $invoices = [
            ['id' => 'INV-001', 'date' => '01 Oct 2024', 'description' => 'Abonnement Pro Agency', 'amount' => '49,00€'],
            ['id' => 'INV-002', 'date' => '01 Sep 2024', 'description' => 'Abonnement Pro Agency', 'amount' => '49,00€'],
            ['id' => 'INV-003', 'date' => '01 Août 2024', 'description' => 'Abonnement Pro Agency', 'amount' => '49,00€'],
            ['id' => 'INV-004', 'date' => '01 Juil 2024', 'description' => 'Abonnement Pro Agency', 'amount' => '49,00€'],
        ];
        
        // Sessions actives
        $sessions = [
            [
                'id' => 's1',
                'device' => 'MacBook Pro - Chrome',
                'location' => 'Paris, France',
                'last_active' => 'Actuel',
                'is_current' => true,
                'icon' => 'desktop_windows'
            ],
            [
                'id' => 's2',
                'device' => 'iPhone 14 - App Mobile',
                'location' => 'Lyon, France',
                'last_active' => 'Il y a 2 jours',
                'is_current' => false,
                'icon' => 'smartphone'
            ]
        ];
        
        return view('dashboard.settings', compact('blogSettings', 'subscription', 'invoices', 'sessions'));
    }
    
    public function update(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        
        $validated = $request->validate([
            'language' => 'in:fr,en',
            'theme' => 'in:light,dark,auto',
            'email_notifications' => 'boolean',
            'weekly_report' => 'boolean'
        ]);
        
        // Récupérer les paramètres existants
        $settings = $user->settings ?? [];
        if (!is_array($settings)) {
            $settings = [];
        }
        
        // Fusionner avec les nouveaux paramètres
        $settings = array_merge($settings, $validated);
        
        // Mettre à jour
        User::where('id', $user->id)->update([
            'settings' => $settings
        ]);
        
        return response()->json(['success' => true]);
    }
    
    public function updatePassword(Request $request)
    {
        $validated = $request->validate([
            'current_password' => 'required|string',
            'new_password' => 'required|string|min:8|confirmed'
        ]);
        
        /** @var \App\Models\User $user */
        $user = Auth::user();
        
        if (!Hash::check($validated['current_password'], $user->password)) {
            return response()->json(['error' => 'Mot de passe incorrect'], 422);
        }
        
        // Mettre à jour le mot de passe
        User::where('id', $user->id)->update([
            'password' => Hash::make($validated['new_password'])
        ]);
        
        return response()->json(['success' => true]);
    }
}