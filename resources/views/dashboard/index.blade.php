@extends('layouts.app')

@section('title', 'Tableau de bord')
@section('header-title', 'Tableau de bord')

@section('content')
<!-- Alerte de rappel hebdomadaire -->
@if(isset($weeklyReminder) && $weeklyReminder)
<div class="bg-amber-50 border-l-4 border-amber-500 rounded-lg p-4 mb-6">
    <div class="flex items-center gap-3">
        <span class="material-symbols-outlined text-amber-500">schedule</span>
        <div class="flex-1">
            <p class="text-amber-800 font-medium">Rappel hebdomadaire</p>
            <p class="text-amber-700 text-sm">Cela fait {{ $daysSinceLastArticle ?? 0 }} jours que vous n'avez pas publié d'article.</p>
        </div>
        <a href="{{ route('ai.create') }}" class="bg-amber-500 text-white px-4 py-2 rounded-lg text-sm hover:bg-amber-600">
            Créer un article
        </a>
    </div>
</div>
@endif

<!-- Hero Welcome Section -->
<div class="mb-8">
    <div class="bg-gradient-to-r from-primary/10 to-secondary/10 rounded-2xl p-8">
        <div class="flex items-center gap-4 mb-4">
            @if(Auth::user()->role === 'admin')
                <span class="material-symbols-outlined text-5xl text-primary">admin_panel_settings</span>
                <div>
                    <h1 class="text-3xl font-bold text-on-surface">Bonjour, {{ Auth::user()->name }} </h1>
                    <p class="text-on-surface-variant">Vous êtes connecté en tant qu'administrateur. Accès complet à la plateforme.</p>
                </div>
            @else
                <span class="material-symbols-outlined text-5xl text-primary">analytics</span>
                <div>
                    <h1 class="text-3xl font-bold text-on-surface">Bonjour, {{ Auth::user()->name }} 👋</h1>
                    <p class="text-on-surface-variant">Bienvenue sur votre tableau de bord NEARSEO.</p>
                </div>
            @endif
        </div>
    </div>
</div>

<!-- Stat Cards -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
    @if(Auth::user()->role === 'admin')
    <div class="bg-white border rounded-xl p-6 shadow-sm hover:translate-y-[-2px] transition-transform">
        <div class="flex items-center justify-between mb-4">
            <span class="text-xs font-bold text-gray-500 uppercase">Total utilisateurs</span>
            <div class="w-10 h-10 rounded-full bg-blue-50 flex items-center justify-center">
                <span class="material-symbols-outlined text-blue-600" style="font-variation-settings: 'FILL' 1;">people</span>
            </div>
        </div>
        <span class="text-3xl font-bold text-gray-800">{{ number_format($stats['total_users'] ?? 0) }}</span>
        <div class="flex items-center gap-1 text-green-600 text-sm mt-1">
            <span class="material-symbols-outlined text-sm">trending_up</span>
            <span>+{{ $stats['user_growth'] ?? 12 }}%</span>
        </div>
    </div>
    @endif
    
    <div class="bg-white border rounded-xl p-6 shadow-sm hover:translate-y-[-2px] transition-transform">
        <div class="flex items-center justify-between mb-4">
            <span class="text-xs font-bold text-gray-500 uppercase">
                @if(Auth::user()->role === 'admin') Total articles @else Mes articles @endif
            </span>
            <div class="w-10 h-10 rounded-full bg-green-50 flex items-center justify-center">
                <span class="material-symbols-outlined text-green-600" style="font-variation-settings: 'FILL' 1;">article</span>
            </div>
        </div>
        <span class="text-3xl font-bold text-gray-800">
            @if(Auth::user()->role === 'admin')
                {{ number_format($stats['total_articles'] ?? 0) }}
            @else
                {{ number_format($stats['user_articles'] ?? 0) }}
            @endif
        </span>
        <div class="flex items-center gap-1 text-green-600 text-sm mt-1">
            <span class="material-symbols-outlined text-sm">trending_up</span>
            <span>
                @if(Auth::user()->role === 'admin')
                    {{ $stats['published_this_month'] ?? 24 }} publiés ce mois
                @else
                    {{ $stats['user_published_month'] ?? 0 }} publiés ce mois
                @endif
            </span>
        </div>
    </div>
    
    <div class="bg-white border rounded-xl p-6 shadow-sm hover:translate-y-[-2px] transition-transform">
        <div class="flex items-center justify-between mb-4">
            <span class="text-xs font-bold text-gray-500 uppercase">
                @if(Auth::user()->role === 'admin') Total vues @else Mes vues @endif
            </span>
            <div class="w-10 h-10 rounded-full bg-orange-50 flex items-center justify-center">
                <span class="material-symbols-outlined text-orange-600" style="font-variation-settings: 'FILL' 1;">visibility</span>
            </div>
        </div>
        <span class="text-3xl font-bold text-gray-800">
            @if(Auth::user()->role === 'admin')
                {{ number_format($stats['total_views'] ?? 0) }}
            @else
                {{ number_format($stats['user_views'] ?? 0) }}
            @endif
        </span>
        <div class="flex items-center gap-1 text-green-600 text-sm mt-1">
            <span class="material-symbols-outlined text-sm">trending_up</span>
            <span>
                @if(Auth::user()->role === 'admin')
                    {{ number_format($stats['unique_views'] ?? 0) }} uniques
                @else
                    +{{ $stats['user_views_growth'] ?? 0 }} ce mois
                @endif
            </span>
        </div>
    </div>
    
    <div class="bg-white border rounded-xl p-6 shadow-sm hover:translate-y-[-2px] transition-transform">
        <div class="flex items-center justify-between mb-4">
            <span class="text-xs font-bold text-gray-500 uppercase">
                @if(Auth::user()->role === 'admin') Score SEO moyen @else Mon score SEO @endif
            </span>
            <div class="w-10 h-10 rounded-full bg-purple-50 flex items-center justify-center">
                <span class="material-symbols-outlined text-purple-600" style="font-variation-settings: 'FILL' 1;">trending_up</span>
            </div>
        </div>
        <span class="text-3xl font-bold text-gray-800">
            @if(Auth::user()->role === 'admin')
                {{ $stats['avg_seo_score'] ?? 0 }}/100
            @else
                {{ $stats['user_avg_seo'] ?? 0 }}/100
            @endif
        </span>
        <div class="w-full bg-gray-200 h-2 rounded-full overflow-hidden mt-2">
            <div class="bg-green-600 h-full" style="width: {{ Auth::user()->role === 'admin' ? ($stats['avg_seo_score'] ?? 0) : ($stats['user_avg_seo'] ?? 0) }}%"></div>
        </div>
    </div>
</div>

<!-- Main Grid Layout -->
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Chart Section -->
    <div class="lg:col-span-2 space-y-6">
        <div class="bg-white border rounded-xl overflow-hidden shadow-sm">
            <div class="p-6 border-b flex justify-between items-center">
                <h3 class="font-semibold text-lg">
                    @if(Auth::user()->role === 'admin') Croissance du trafic global
                    @else Évolution de mes vues @endif
                </h3>
                <div class="flex gap-2">
                    <button type="button" onclick="setPeriod('week')" class="period-btn text-sm px-3 py-1 rounded-full bg-gray-100">7 jours</button>
                    <button type="button" onclick="setPeriod('month')" class="period-btn text-sm px-3 py-1 bg-primary text-white rounded-full">30 jours</button>
                </div>
            </div>
            <div class="p-6 h-[400px]">
                <canvas id="trafficChart"></canvas>
            </div>
        </div>
        
        <!-- Articles performants -->
        <div class="bg-white border rounded-xl shadow-sm">
            <div class="p-6 border-b">
                <h3 class="font-semibold text-lg">
                    @if(Auth::user()->role === 'admin') Derniers articles publiés
                    @else Mes derniers articles @endif
                </h3>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead class="bg-gray-50 text-xs font-bold text-gray-500 uppercase">
                        <tr>
                            <th class="px-6 py-4">Titre</th>
                            @if(Auth::user()->role === 'admin')
                            <th class="px-6 py-4">Auteur</th>
                            @endif
                            <th class="px-6 py-4">Vues</th>
                            <th class="px-6 py-4">SEO</th>
                            <th class="px-6 py-4 text-right">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y">
                        @forelse($topArticles as $article)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4 font-medium">{{ Str::limit($article->title, 50) }}</td>
                            @if(Auth::user()->role === 'admin')
                            <td class="px-6 py-4 text-sm">{{ $article->user->name ?? 'N/A' }}</td>
                            @endif
                            <td class="px-6 py-4">{{ number_format($article->views ?? 0) }}</td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-2">
                                    <div class="w-12 h-1.5 bg-gray-200 rounded-full overflow-hidden">
                                        <div class="bg-green-600 h-full" style="width: {{ $article->seo_score ?? 0 }}%"></div>
                                    </div>
                                    <span class="text-xs font-bold text-green-700">{{ $article->seo_score ?? 0 }}%</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <a href="{{ route('articles.edit', $article) }}" class="text-gray-400 hover:text-primary">
                                    <span class="material-symbols-outlined text-lg">edit</span>
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="{{ Auth::user()->role === 'admin' ? 5 : 4 }}" class="px-6 py-8 text-center text-gray-500">
                                <span class="material-symbols-outlined text-4xl mb-2 block">article</span>
                                Aucun article pour le moment.
                                <a href="{{ route('ai.create') }}" class="text-primary hover:underline block mt-2">Créer mon premier article</a>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
    <!-- Sidebar -->
    <div class="space-y-6">
        @if(Auth::user()->role === 'admin')
        <!-- ACTIONS ADMIN -->
        <section class="bg-white border rounded-xl p-6 shadow-sm">
            <h3 class="font-semibold text-lg mb-4 flex items-center gap-2">
                <span class="material-symbols-outlined text-primary">admin_meds</span>
                Administration
            </h3>
            <div class="flex flex-col gap-3">
                <a href="{{ route('admin.users') }}" class="flex items-center justify-between p-3 bg-gray-50 rounded-lg hover:bg-orange-50 transition group">
                    <span class="font-medium">Gérer les utilisateurs</span>
                    <span class="material-symbols-outlined text-gray-400 group-hover:translate-x-1 transition">chevron_right</span>
                </a>
                <a href="{{ route('admin.settings') }}" class="flex items-center justify-between p-3 bg-gray-50 rounded-lg hover:bg-orange-50 transition group">
                    <span class="font-medium">Paramètres globaux</span>
                    <span class="material-symbols-outlined text-gray-400 group-hover:translate-x-1 transition">chevron_right</span>
                </a>
            </div>
        </section>
        @else
        <!-- RECOMMANDATIONS IA -->
        <section class="bg-white border rounded-xl p-6 shadow-sm">
            <div class="flex items-center gap-2 mb-4">
                <span class="material-symbols-outlined text-secondary">auto_awesome</span>
                <h3 class="font-semibold">Recommandations IA</h3>
            </div>
            <div class="space-y-4">
                <div class="p-3 rounded-lg bg-green-50 border-l-4 border-secondary">
                    <p class="text-sm">🎯 <span class="font-bold">Optimisez votre SEO</span></p>
                    <p class="text-xs text-gray-600 mt-1">Utilisez notre générateur IA pour créer des articles optimisés.</p>
                    <a href="{{ route('ai.create') }}" class="inline-block mt-2 text-secondary text-xs font-bold">Générer un article →</a>
                </div>
                <div class="p-3 rounded-lg bg-amber-50 border-l-4 border-tertiary">
                    <p class="text-sm">📍 <span class="font-bold">Géolocalisez vos articles</span></p>
                    <p class="text-xs text-gray-600 mt-1">Ajoutez une adresse pour apparaître dans les recherches locales.</p>
                    <a href="{{ route('geo.index') }}" class="inline-block mt-2 text-tertiary text-xs font-bold">Ajouter une adresse →</a>
                </div>
            </div>
        </section>
        @endif
        
        <!-- Impact Local -->
        <section class="bg-white border rounded-xl p-6 shadow-sm border-l-4 border-l-green-600">
            <div class="flex items-start gap-3">
                <div class="bg-green-100 text-green-600 p-2 rounded-lg">
                    <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">location_on</span>
                </div>
                <div>
                    <h4 class="font-semibold">Impact Local</h4>
                    <p class="text-sm text-gray-500 mt-1">
                        @if(Auth::user()->role === 'admin')
                        La plateforme génère un trafic local en croissance de 15% ce mois-ci.
                        @else
                        Votre visibilité locale a augmenté de {{ $stats['local_visibility'] ?? 12 }}% ce mois-ci.
                        @endif
                    </p>
                </div>
            </div>
        </section>
        
        <!-- Générer un article (CTA) -->
        <div class="bg-gradient-to-r from-primary to-primary/80 rounded-xl p-6 text-white text-center">
            <span class="material-symbols-outlined text-4xl mb-2">auto_awesome</span>
            <h4 class="font-bold text-lg mb-2">Nouvel article IA</h4>
            <p class="text-sm text-white/80 mb-4">Générez un article optimisé SEO en quelques secondes.</p>
            <a href="{{ route('ai.create') }}" class="inline-block bg-white text-primary px-4 py-2 rounded-lg text-sm font-semibold hover:bg-gray-100 transition">
                Commencer
            </a>
        </div>
    </div>
</div>
@endsection

@push('styles')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
@endpush

@push('scripts')
<script>
    // Variables globales
    var trafficChart = null;
    var currentPeriod = 'month';
    
    // Données du graphique
    var chartData = {
        week: {
            labels: ['Lun', 'Mar', 'Mer', 'Jeu', 'Ven', 'Sam', 'Dim'],
            data: {{ json_encode($weeklyViews ?? [0, 0, 0, 0, 0, 0, 0]) }}
        },
        month: {
            labels: ['Sem 1', 'Sem 2', 'Sem 3', 'Sem 4'],
            data: {{ json_encode($monthlyViews ?? [0, 0, 0, 0]) }}
        }
    };
    
    // Initialiser le graphique
    function initChart() {
        var canvas = document.getElementById('trafficChart');
        if (!canvas) return;
        
        var ctx = canvas.getContext('2d');
        if (trafficChart) {
            trafficChart.destroy();
        }
        
        trafficChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: chartData[currentPeriod].labels,
                datasets: [{
                    label: 'Vues',
                    data: chartData[currentPeriod].data,
                    borderColor: '#8c4a2f',
                    backgroundColor: 'rgba(140, 74, 47, 0.1)',
                    tension: 0.4,
                    fill: true,
                    pointBackgroundColor: '#8c4a2f',
                    pointBorderColor: '#ffffff',
                    pointBorderWidth: 2,
                    pointRadius: 4,
                    pointHoverRadius: 6
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        backgroundColor: '#ffffff',
                        titleColor: '#091d2e',
                        bodyColor: '#53433d',
                        borderColor: '#d9c2ba',
                        borderWidth: 1,
                        callbacks: {
                            label: function(context) {
                                return context.raw + ' vues';
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: '#e5e7eb'
                        },
                        ticks: {
                            callback: function(value) {
                                return value.toLocaleString();
                            }
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        }
                    }
                }
            }
        });
    }
    
    // Changer la période d'affichage
    function setPeriod(period) {
        currentPeriod = period;
        
        // Mettre à jour les boutons
        var btns = document.querySelectorAll('.period-btn');
        for (var i = 0; i < btns.length; i++) {
            btns[i].classList.remove('bg-primary', 'text-white');
            btns[i].classList.add('bg-gray-100', 'text-gray-700');
        }
        
        // Mettre en évidence le bouton actif
        var target = window.event && window.event.target ? window.event.target : null;
        if (target) {
            target.classList.add('bg-primary', 'text-white');
            target.classList.remove('bg-gray-100', 'text-gray-700');
        } else {
            var allBtns = document.querySelectorAll('.period-btn');
            var periodMap = { 'week': 0, 'month': 1 };
            var idx = periodMap[period] || 1;
            if (allBtns[idx]) {
                allBtns[idx].classList.add('bg-primary', 'text-white');
                allBtns[idx].classList.remove('bg-gray-100', 'text-gray-700');
            }
        }
        
        // Mettre à jour les données du graphique
        if (trafficChart) {
            trafficChart.data.labels = chartData[currentPeriod].labels;
            trafficChart.data.datasets[0].data = chartData[currentPeriod].data;
            trafficChart.update();
        }
    }
    
    // Attendre le chargement complet de la page
    document.addEventListener('DOMContentLoaded', function() {
        initChart();
    });
    
    // Recharger le graphique après rafraîchissement de la page
    window.addEventListener('load', function() {
        if (trafficChart) {
            trafficChart.resize();
        }
    });
</script>
@endpush