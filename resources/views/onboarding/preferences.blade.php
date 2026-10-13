@extends('layouts.app')

@section('title', 'Mes préférences')
@section('header-title', 'Bienvenue sur NEARSEO')

@section('content')
<div class="max-w-2xl mx-auto">
    {{-- Stepper --}}
    <div class="flex items-center justify-center gap-4 mb-8">
        <div class="flex items-center gap-2">
            <span class="w-8 h-8 rounded-full bg-gray-300 text-white flex items-center justify-center font-bold">1</span>
            <span class="text-sm text-gray-500">Compte</span>
        </div>
        <div class="w-12 h-0.5 bg-primary"></div>
        <div class="flex items-center gap-2">
            <span class="w-8 h-8 rounded-full bg-primary text-white flex items-center justify-center font-bold">2</span>
            <span class="text-sm text-primary font-bold">Mon commerce</span>
        </div>
        <div class="w-12 h-0.5 bg-primary"></div>
        <div class="flex items-center gap-2">
            <span class="w-8 h-8 rounded-full bg-primary text-white flex items-center justify-center font-bold">3</span>
            <span class="text-sm font-bold text-primary">Préférences</span>
        </div>
    </div>

    <div class="bg-white rounded-xl border shadow-sm p-8">
        <h1 class="text-2xl font-bold mb-2">Vos préférences</h1>
        <p class="text-gray-500 mb-6">Ces choix serviront de valeurs par défaut. Vous pourrez les modifier à tout moment.</p>

        <form method="POST" action="{{ route('onboarding.preferences.save') }}" class="space-y-5">
            @csrf

            <div>
                <label class="block text-sm font-bold text-gray-700 mb-1">Langue par défaut</label>
                <select name="preferred_language" class="w-full border rounded-lg px-4 py-3" required>
                    <option value="fr" {{ (auth()->user()->preferences['language'] ?? 'fr') === 'fr' ? 'selected' : '' }}>🇫🇷 Français</option>
                    <option value="en" {{ (auth()->user()->preferences['language'] ?? '') === 'en' ? 'selected' : '' }}>🇬🇧 English</option>
                    <option value="ar" {{ (auth()->user()->preferences['language'] ?? '') === 'ar' ? 'selected' : '' }}>🇲🇦 العربية</option>
                </select>
            </div>

            <div>
                <label class="block text-sm font-bold text-gray-700 mb-1">Ton par défaut</label>
                <select name="preferred_tone" class="w-full border rounded-lg px-4 py-3" required>
                    <option value="professional" {{ (auth()->user()->preferences['preferred_tone'] ?? 'professional') === 'professional' ? 'selected' : '' }}>💼 Professionnel & Chaleureux</option>
                    <option value="expert" {{ (auth()->user()->preferences['preferred_tone'] ?? '') === 'expert' ? 'selected' : '' }}>🎓 Expert / Autorité</option>
                    <option value="storytelling" {{ (auth()->user()->preferences['preferred_tone'] ?? '') === 'storytelling' ? 'selected' : '' }}>📖 Storytelling</option>
                </select>
            </div>

            <div>
                <label class="block text-sm font-bold text-gray-700 mb-1">Format par défaut</label>
                <select name="preferred_format" class="w-full border rounded-lg px-4 py-3" required>
                    <option value="short" {{ (auth()->user()->preferences['preferred_format'] ?? '') === 'short' ? 'selected' : '' }}>Court (600 mots)</option>
                    <option value="medium" {{ (auth()->user()->preferences['preferred_format'] ?? 'medium') === 'medium' ? 'selected' : '' }}>Moyen (1000 mots)</option>
                    <option value="long" {{ (auth()->user()->preferences['preferred_format'] ?? '') === 'long' ? 'selected' : '' }}>Long (1600 mots)</option>
                </select>
            </div>

            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Objectifs habituels</label>
                <div class="grid grid-cols-2 gap-2">
                    @php
                        $goals = [
                            'attirer_boutique' => '🏪 Attirer en boutique',
                            'appels' => '📞 Générer des appels',
                            'promotion' => '🏷️ Promouvoir une offre',
                            'reservations' => '📅 Prise de rendez-vous',
                            'livraison' => '🚚 Livraison à domicile',
                        ];
                        $selectedGoals = auth()->user()->preferences['preferred_goals'] ?? [];
                    @endphp
                    @foreach($goals as $value => $label)
                        <label class="flex items-center gap-2 p-3 border rounded-lg cursor-pointer hover:bg-gray-50">
                            <input type="checkbox" name="preferred_goals[]" value="{{ $value }}"
                                   {{ in_array($value, $selectedGoals) ? 'checked' : '' }}
                                   class="rounded">
                            <span class="text-sm">{{ $label }}</span>
                        </label>
                    @endforeach
                </div>
            </div>

            <div class="flex justify-between gap-3 pt-4 border-t">
                <a href="{{ route('onboarding.business') }}" class="px-6 py-2 border rounded-lg hover:bg-gray-50">
                    ← Retour
                </a>
                <button type="submit" class="px-8 py-2 bg-primary text-white rounded-lg hover:opacity-90 font-bold">
                    🎉 Terminer
                </button>
            </div>
        </form>
    </div>
</div>
@endsection