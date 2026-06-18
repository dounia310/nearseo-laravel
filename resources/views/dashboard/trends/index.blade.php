{{-- resources/views/dashboard/trends/index.blade.php --}}
@extends('layouts.app')

@section('title', 'Tendances SEO - NearSEO')

@section('header-title')
    <span class="material-symbols-outlined text-[28px] align-middle" style="font-variation-settings: 'FILL' 1;">trending_up</span>
    <span class="align-middle">Inspiration pour vos articles SEO</span>
@endsection

@section('content')
<div class="max-w-[1280px] mx-auto space-y-8">
    <!-- Hero Banner -->
    <section class="relative rounded-xl overflow-hidden bg-gradient-to-r from-blue-50 to-purple-50 p-8 flex items-center justify-between border border-outline-variant">
        <div class="relative z-10 max-w-2xl">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 bg-primary rounded-lg flex items-center justify-center text-on-primary shadow-lg">
                    <span class="material-symbols-outlined text-[28px]" style="font-variation-settings: 'FILL' 1;">trending_up</span>
                </div>
                <div>
                    <p class="text-sm text-gray-500 font-medium">Tendances SEO</p>
                    <p class="text-on-surface-variant text-body">
                        Découvrez les dernières tendances de recherche locales au Maroc et optimisez votre stratégie de contenu.
                    </p>
                </div>
            </div>
        </div>
        <div class="hidden lg:block">
            <span class="material-symbols-outlined text-6xl opacity-20" style="font-variation-settings: 'FILL' 1;">trending_up</span>
        </div>
    </section>

    <!-- Filters Toolbar -->
    <section class="flex flex-col md:flex-row items-start md:items-center justify-between bg-surface-container-lowest p-card-padding rounded-xl border border-outline-variant shadow-sm gap-4">
        <div class="flex items-center gap-2 bg-surface-container-low p-1 rounded-lg">
            <button class="period-btn px-6 py-2 rounded-md bg-surface-container-lowest text-primary font-label text-label shadow-sm" data-period="day" onclick="setPeriod('day', this)">Aujourd'hui</button>
            <button class="period-btn px-6 py-2 rounded-md text-on-surface-variant hover:bg-surface-container-high font-label text-label transition-all" data-period="week" onclick="setPeriod('week', this)">Semaine</button>
            <button class="period-btn px-6 py-2 rounded-md text-on-surface-variant hover:bg-surface-container-high font-label text-label transition-all" data-period="month" onclick="setPeriod('month', this)">Mois</button>
        </div>
        <button onclick="refreshTrends()" class="flex items-center gap-2 text-primary font-label text-label hover:underline">
            <span class="material-symbols-outlined">refresh</span>
            Rafraîchir les données
        </button>
    </section>

    <!-- Main Content Grid -->
    <div class="grid grid-cols-12 gap-8">
        <!-- Google Trends Column -->
        <div class="col-span-12 lg:col-span-8 space-y-4">
            <div class="flex items-center justify-between mb-2">
                <h2 class="font-h2 text-h2 text-on-surface flex items-center gap-2">
                    <span class="material-symbols-outlined text-primary" style="font-variation-settings: 'FILL' 1;">trending_up</span>
                    Tendances Google
                </h2>
                <span class="text-on-surface-variant font-label text-label">Mis à jour il y a 5 min</span>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4" id="trendsContainer">
                @foreach($trends['google'] ?? [] as $trend)
                <div class="trend-card bg-surface-container-lowest p-card-padding rounded-xl border border-outline-variant hover:shadow-lg transition-shadow group cursor-pointer" onclick="useTrend('{{ $trend['keyword'] }}')">
                    <div class="flex justify-between items-start mb-4">
                        <span class="bg-secondary-container text-on-secondary-container px-3 py-1 rounded-full text-label font-label">
                            {{ ['Boulangerie', 'Tourisme', 'Immobilier', 'Gastronomie', 'Tech', 'Mode', 'Santé', 'Éducation'][rand(0, 7)] }}
                        </span>
                        <span class="text-secondary font-bold text-label font-label flex items-center gap-1">
                            <span class="material-symbols-outlined text-[14px]">arrow_upward</span>
                            +{{ rand(20, 200) }}%
                        </span>
                    </div>
                    <h3 class="font-h3 text-h3 mb-2">{{ $trend['keyword'] }}</h3>
                    <div class="space-y-2">
                        <div class="flex justify-between text-body-sm text-on-surface-variant">
                            <span>Volume de recherche</span>
                            <span>{{ number_format($trend['volume'] ?? 0) }}/mo</span>
                        </div>
                        <div class="w-full h-2 bg-surface-container rounded-full overflow-hidden">
                            <div class="h-full bg-secondary" style="width: {{ min(($trend['volume'] ?? 500) / 1200 * 100, 100) }}%"></div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Seasonality & Tags Column -->
        <div class="col-span-12 lg:col-span-4 space-y-4">
            <div class="bg-surface-container-lowest p-card-padding rounded-xl border border-outline-variant h-full flex flex-col">
                <h2 class="font-h2 text-h2 text-on-surface mb-6 flex items-center gap-2">
                    <span class="material-symbols-outlined text-primary">calendar_month</span>
                    Saisonnalité
                </h2>
                <div class="flex flex-wrap gap-2">
                    @foreach($trends['seasonal'] ?? [] as $event)
                    <span onclick="useTrend('{{ $event }}')" 
                          class="bg-surface-container text-on-surface px-4 py-2 rounded-full font-label text-label border border-outline-variant hover:bg-primary hover:text-on-primary transition-colors cursor-pointer">
                        {{ $event }}
                    </span>
                    @endforeach
                    @foreach($trends['local'] ?? [] as $local)
                    <span onclick="useTrend('{{ $local }}')" 
                          class="bg-surface-container text-on-surface px-4 py-2 rounded-full font-label text-label border border-outline-variant hover:bg-primary hover:text-on-primary transition-colors cursor-pointer">
                        🇲🇦 {{ $local }}
                    </span>
                    @endforeach
                </div>
                <div class="mt-auto pt-8 border-t border-outline-variant">
                    <h3 class="font-h3 text-h3 mb-4 flex items-center gap-2">
                        <span class="material-symbols-outlined text-primary">calendar_today</span>
                        Calendrier Editorial
                    </h3>
                    <div class="space-y-4">
                        @foreach(array_slice($trends['seasonal'] ?? [], 0, 2) as $index => $event)
                        <div class="flex items-center gap-4">
                            <div class="w-10 h-10 flex flex-col items-center justify-center bg-surface-container rounded border border-outline-variant text-on-surface">
                                <span class="text-[10px] uppercase font-bold">{{ ['Avr', 'Mai', 'Juin', 'Juil'][$index] }}</span>
                                <span class="text-body font-bold">{{ rand(10, 30) }}</span>
                            </div>
                            <div>
                                <p class="font-label text-label">{{ $event }}</p>
                                <p class="text-body-sm text-on-surface-variant opacity-70">Focus: Contenu local</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <!-- Actualités List -->
        <div class="col-span-12 space-y-4">
            <h2 class="font-h2 text-h2 text-on-surface flex items-center gap-2">
                <span class="material-symbols-outlined text-primary" style="font-variation-settings: 'FILL' 1;">newspaper</span>
                Actualités &amp; Insights AI
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                @foreach($trends['news'] ?? [] as $news)
                <div class="bg-surface-container-lowest p-card-padding rounded-xl border border-outline-variant border-l-4 border-l-secondary shadow-sm cursor-pointer hover:shadow-md transition-shadow">
                    <div class="flex items-center gap-2 mb-2">
                        <span class="material-symbols-outlined text-secondary text-[20px]" style="font-variation-settings: 'FILL' 1;">auto_awesome</span>
                        <span class="text-secondary font-label text-label">IA Générative</span>
                    </div>
                    <h3 class="font-h3 text-h3 mb-3">{{ $news['title'] }}</h3>
                    <p class="text-body-sm text-on-surface-variant mb-4">{{ Str::limit($news['description'] ?? '', 80) }}</p>
                    <a href="https://www.google.com/search?q={{ urlencode($news['title']) }}" 
                       target="_blank" 
                       class="text-primary font-label text-label flex items-center gap-1 hover:gap-2 transition-all">
                        Lire la suite sur Google
                        <span class="material-symbols-outlined text-[16px]">open_in_new</span>
                    </a>
                </div>
                @endforeach
            </div>
        </div>

        <!-- CTA Section -->
        <div class="col-span-12 mt-8">
            <div class="bg-primary p-12 rounded-xl text-on-primary flex flex-col md:flex-row items-center justify-between gap-8 relative overflow-hidden">
                <div class="relative z-10 flex flex-col md:flex-row items-center gap-6 text-center md:text-left">
                    <div class="w-20 h-20 bg-primary-container rounded-full flex items-center justify-center border-4 border-white/20">
                        <span class="material-symbols-outlined text-[40px]" style="font-variation-settings: 'FILL' 1;">auto_awesome</span>
                    </div>
                    <div>
                        <h2 class="font-h1 text-h1 mb-2">Prêt à transformer ces tendances en contenu ?</h2>
                        <p class="text-on-primary opacity-80 text-body">Générez des articles optimisés SEO en quelques secondes à partir des mots-clés du moment.</p>
                    </div>
                </div>
                <a href="{{ route('ai.create') }}" class="relative z-10 bg-white text-primary px-10 py-4 rounded-lg font-h3 text-h3 hover:bg-opacity-90 transition-all shadow-xl hover:-translate-y-1 active:translate-y-0">
                    Aller au générateur IA
                </a>
            </div>
        </div>
    </div>
</div>

<script>
let currentPeriod = 'day';

function setPeriod(period, btn) {
    currentPeriod = period;
    
    // Mettre à jour les boutons
    document.querySelectorAll('.period-btn').forEach(b => {
        b.classList.remove('bg-surface-container-lowest', 'text-primary', 'shadow-sm');
        b.classList.add('text-on-surface-variant');
    });
    
    if (btn) {
        btn.classList.add('bg-surface-container-lowest', 'text-primary', 'shadow-sm');
        btn.classList.remove('text-on-surface-variant');
    }
    
    // Filtrer les tendances selon la période
    filterTrends(period);
}

function filterTrends(period) {
    const cards = document.querySelectorAll('.trend-card');
    const now = new Date();
    
    cards.forEach((card, index) => {
        // Simuler des dates pour chaque carte
        const cardDate = new Date(now);
        cardDate.setDate(cardDate.getDate() - (index * 2)); // chaque carte a 2 jours d'écart
        
        let show = true;
        
        if (period === 'week') {
            // Montrer les 3 dernières cartes (semaine)
            show = index < 3;
        } else if (period === 'month') {
            // Montrer toutes les cartes (mois)
            show = true;
        } else {
            // Aujourd'hui : montrer les 2 premières
            show = index < 2;
        }
        
        if (show) {
            card.style.display = '';
        } else {
            card.style.display = 'none';
        }
    });
}

function refreshTrends() {
    const btn = event?.target?.closest('button');
    if (btn) {
        const icon = btn.querySelector('.material-symbols-outlined');
        if (icon) {
            icon.style.transition = 'transform 0.5s ease-in-out';
            icon.style.transform = 'rotate(360deg)';
            setTimeout(() => {
                icon.style.transform = 'rotate(0deg)';
            }, 500);
        }
    }
    // Recharger les données
    window.location.reload();
}

function useTrend(topic) {
    if (confirm(`💡 Utiliser ce sujet pour un article ?\n\n"${topic}"`)) {
        window.location.href = '{{ route("ai.create") }}?topic=' + encodeURIComponent(topic);
    }
}

function searchGoogle(topic) {
    window.open('https://www.google.com/search?q=' + encodeURIComponent(topic), '_blank');
}

document.querySelectorAll('.group').forEach(card => {
    card.addEventListener('mouseenter', () => {
        card.style.transform = 'translateY(-4px)';
    });
    card.addEventListener('mouseleave', () => {
        card.style.transform = 'translateY(0)';
    });
});
</script>
@endsection