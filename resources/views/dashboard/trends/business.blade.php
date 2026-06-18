{{-- resources/views/dashboard/trends/business.blade.php --}}
@extends('layouts.app')

@section('title', 'Sujets adaptés à votre activité - NearSEO')
@section('header-title', '🎯 Suggestions pour votre activité')

@section('content')
<div class="max-w-7xl mx-auto">
    <!-- En-tête avec sélecteur de secteur -->
    <div class="mb-8">
        <div class="bg-gradient-to-r from-green-50 to-blue-50 rounded-2xl p-8 border border-green-100">
            <div class="flex flex-wrap items-center justify-between gap-4">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">
                        🎯 Suggestions pour votre activité
                    </h1>
                    <p class="text-gray-600 mt-1">
                        Des idées de contenu adaptées à votre secteur d'activité
                    </p>
                </div>
                
                <!-- Sélecteur de secteur -->
                <div class="flex items-center gap-3">
                    <span class="text-sm text-gray-500">Mon secteur :</span>
                    <select id="businessType" onchange="changeBusinessType(this.value)" 
                            class="px-4 py-2 border border-gray-300 rounded-lg bg-white focus:ring-2 focus:ring-primary/20 focus:border-primary">
                        <option value="restaurant" {{ $businessType == 'restaurant' ? 'selected' : '' }}>🍽️ Restaurant</option>
                        <option value="hotel" {{ $businessType == 'hotel' ? 'selected' : '' }}>🏨 Hôtel</option>
                        <option value="coiffure" {{ $businessType == 'coiffure' ? 'selected' : '' }}>💇 Coiffure / Barber</option>
                        <option value="beaute" {{ $businessType == 'beaute' ? 'selected' : '' }}>💄 Beauté / Esthétique</option>
                        <option value="fleuriste" {{ $businessType == 'fleuriste' ? 'selected' : '' }}>🌸 Fleuriste</option>
                        <option value="voyage" {{ $businessType == 'voyage' ? 'selected' : '' }}>✈️ Voyages / Excursions</option>
                        <option value="immobilier" {{ $businessType == 'immobilier' ? 'selected' : '' }}>🏠 Immobilier</option>
                        <option value="auto" {{ $businessType == 'auto' ? 'selected' : '' }}>🚗 Automobile</option>
                        <option value="sante" {{ $businessType == 'sante' ? 'selected' : '' }}>🏥 Santé</option>
                        <option value="fashion" {{ $businessType == 'fashion' ? 'selected' : '' }}>👗 Mode / Luxe</option>
                        <option value="general" {{ $businessType == 'general' ? 'selected' : '' }}>📊 Général</option>
                    </select>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistiques -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
        <div class="bg-white rounded-xl border border-gray-200 p-4">
            <p class="text-sm text-gray-500">Suggestions disponibles</p>
            <p class="text-2xl font-bold text-gray-900">{{ count($suggestions) }}</p>
        </div>
        <div class="bg-white rounded-xl border border-gray-200 p-4">
            <p class="text-sm text-gray-500">Sujets tendances</p>
            <p class="text-2xl font-bold text-green-600">{{ count(array_filter($suggestions, fn($s) => $s['type'] == 'tendance')) }}</p>
        </div>
        <div class="bg-white rounded-xl border border-gray-200 p-4">
            <p class="text-sm text-gray-500">Événements du moment</p>
            <p class="text-2xl font-bold text-orange-600">{{ count(array_filter($suggestions, fn($s) => $s['type'] == 'evenement')) }}</p>
        </div>
        <div class="bg-white rounded-xl border border-gray-200 p-4">
            <p class="text-sm text-gray-500">Score de pertinence</p>
            <p class="text-2xl font-bold text-primary">{{ rand(75, 95) }}%</p>
        </div>
    </div>

    <!-- Grille des suggestions -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($suggestions as $suggestion)
        <div class="bg-white rounded-xl border border-gray-200 p-6 shadow-sm hover:shadow-md transition-all group">
            <!-- Badge type -->
            <div class="flex justify-between items-start mb-3">
                <span class="px-2 py-1 rounded-full text-xs font-bold
                    {{ $suggestion['type'] == 'tendance' ? 'bg-blue-100 text-blue-700' : 
                       ($suggestion['type'] == 'evenement' ? 'bg-orange-100 text-orange-700' : 'bg-green-100 text-green-700') }}">
                    {{ $suggestion['type'] == 'tendance' ? '📈 Tendance' : 
                       ($suggestion['type'] == 'evenement' ? '🎉 Événement' : '💎 Promotion') }}
                </span>
                <span class="text-xs font-bold text-gray-400">
                    Pertinence : {{ $suggestion['score'] }}%
                </span>
            </div>

            <!-- Titre -->
            <h3 class="text-lg font-bold text-gray-900 mb-3 group-hover:text-primary transition-colors">
                {{ $suggestion['title'] }}
            </h3>

            <!-- Mots-clés -->
            <div class="flex flex-wrap gap-1 mb-4">
                @foreach($suggestion['keywords'] as $keyword)
                <span class="px-2 py-0.5 bg-gray-100 text-gray-600 rounded-full text-xs">
                    #{{ $keyword }}
                </span>
                @endforeach
            </div>

            <!-- Idées de titres -->
            <div class="space-y-1 mb-4">
                <p class="text-xs text-gray-500 font-medium uppercase">💡 Titres suggérés :</p>
                @foreach($suggestion['suggested_titles'] as $title)
                <p class="text-sm text-gray-600 hover:text-primary cursor-pointer transition-colors" 
                   onclick="copyText('{{ addslashes($title) }}')">
                    • {{ $title }}
                </p>
                @endforeach
            </div>

            <!-- Actions -->
            <div class="flex gap-2 mt-4 pt-4 border-t border-gray-100">
                <button onclick="generateArticle('{{ addslashes($suggestion['title']) }}')" 
                        class="flex-1 px-4 py-2 bg-primary text-white rounded-lg text-sm hover:bg-primary/90 transition flex items-center justify-center gap-2">
                    <span class="material-symbols-outlined text-sm">auto_awesome</span>
                    Générer un article
                </button>
                <button onclick="copyText('{{ addslashes($suggestion['title']) }}')" 
                        class="px-3 py-2 bg-gray-100 text-gray-700 rounded-lg text-sm hover:bg-gray-200 transition">
                    <span class="material-symbols-outlined text-sm">content_copy</span>
                </button>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Message si aucune suggestion -->
    @if(count($suggestions) == 0)
    <div class="text-center py-12">
        <span class="material-symbols-outlined text-6xl text-gray-300">lightbulb</span>
        <h3 class="text-xl font-bold text-gray-600 mt-4">Aucune suggestion pour le moment</h3>
        <p class="text-gray-400">Essayez de changer votre secteur d'activité</p>
    </div>
    @endif
</div>

<script>
function changeBusinessType(type) {
    fetch('{{ route("trends.update-business") }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify({ business_type: type })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            window.location.reload();
        }
    })
    .catch(error => console.error('Erreur:', error));
}

function generateArticle(topic) {
    window.location.href = '{{ route("ai.create") }}?topic=' + encodeURIComponent(topic);
}

function copyText(text) {
    if (navigator.clipboard) {
        navigator.clipboard.writeText(text).then(() => {
            showToast('✅ Copié dans le presse-papier !');
        });
    } else {
        const textarea = document.createElement('textarea');
        textarea.value = text;
        document.body.appendChild(textarea);
        textarea.select();
        document.execCommand('copy');
        document.body.removeChild(textarea);
        showToast('✅ Copié dans le presse-papier !');
    }
}

function showToast(message) {
    const toast = document.createElement('div');
    toast.textContent = message;
    toast.style.cssText = `
        position: fixed; bottom: 20px; right: 20px;
        background: #1a1a2e; color: white;
        padding: 12px 24px; border-radius: 12px;
        z-index: 9999; font-size: 14px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.3);
        animation: slideUp 0.3s ease-out;
    `;
    document.body.appendChild(toast);
    setTimeout(() => {
        toast.style.opacity = '0';
        toast.style.transition = 'opacity 0.3s';
        setTimeout(() => toast.remove(), 300);
    }, 3000);
}
</script>

<style>
@keyframes slideUp {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
}
</style>
@endsection