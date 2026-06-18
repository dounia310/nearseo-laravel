<!-- Top Navigation -->
<header class="bg-white dark:bg-surface-container border-b border-gray-200 dark:border-gray-700 sticky top-0 z-30">
    <div class="flex justify-between items-center px-4 w-full h-16 mx-auto max-w-7xl">
        <div class="flex items-center gap-4">
            <span class="md:hidden material-symbols-outlined text-primary cursor-pointer" onclick="toggleMobileMenu()">menu</span>
            <h2 class="text-xl font-bold text-primary dark:text-primary-fixed-dim tracking-tight">@yield('header-title', 'NEARSEO')</h2>
        </div>
        
        <div class="flex items-center gap-6">
            <div class="hidden sm:flex items-center bg-gray-50 dark:bg-gray-800 px-4 py-1.5 rounded-full border border-gray-200 dark:border-gray-600 relative">
                <span class="material-symbols-outlined text-gray-400 text-sm mr-2">search</span>
                <input id="globalSearch" 
                       class="bg-transparent border-none focus:ring-0 text-sm w-48 focus:w-64 transition-all duration-300 outline-none text-gray-800 dark:text-gray-200" 
                       placeholder="Rechercher" 
                       type="text"
                       onkeyup="handleSearch(event)"
                       onfocus="handleSearch(event)"
                       autocomplete="off"/>
                <div id="searchResults" class="absolute top-full left-0 right-0 mt-2 bg-white dark:bg-gray-800 rounded-lg shadow-xl border border-gray-200 dark:border-gray-700 hidden max-h-96 overflow-y-auto z-50"></div>
            </div>
            
            <div class="flex items-center gap-3">
                <a href="{{ route('notifications.index') }}" class="material-symbols-outlined text-gray-600 dark:text-gray-300 cursor-pointer p-2 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-full transition-colors">notifications</a>
                <a href="{{ route('help') }}" 
   class="material-symbols-outlined text-gray-600 dark:text-gray-300 p-2 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-full transition-colors"
   title="Aide">
    help
</a>
                <a href="{{ route('profile.public', ['username' => Auth::user()->slug ?? Auth::user()->name]) }}" 
   class="w-8 h-8 rounded-full bg-primary/20 flex items-center justify-center text-primary dark:text-primary-fixed font-bold text-xs hover:bg-primary/30 transition-colors"
   title="{{ __('messages.public_profile') }}">
    {{ strtoupper(substr(Auth::user()->name ?? 'U', 0, 2)) }}
</a>
            </div>
        </div>
    </div>
</header>

<script>
    // Données de recherche GLOBALES (toutes les pages du site)
    const siteSearchData = [
        // Pages principales
        { title: 'Tableau de bord', url: '/dashboard', icon: 'dashboard', category: 'Navigation' },
        { title: 'Stratégie de contenu', url: '/ai/create', icon: 'edit_note', category: 'Navigation' },
        { title: 'Articles', url: '/articles', icon: 'description', category: 'Navigation' },
        { title: 'Communauté', url: '/community', icon: 'groups', category: 'Navigation' },
        { title: 'Géolocalisation', url: '/geo', icon: 'distance', category: 'Navigation' },
        { title: 'Mon Blog', url: '/blog', icon: 'feed', category: 'Navigation' },
        { title: 'Profil', url: '/profile', icon: 'account_circle', category: 'Navigation' },
        { title: 'Paramètres', url: '/settings', icon: 'settings', category: 'Navigation' },
        
        // Articles (exemples - à remplacer par vos vrais articles)
        { title: 'Guide SEO 2024', url: '/articles/seo-guide-2024', icon: 'article', category: 'Articles' },
        { title: 'Optimisation des images', url: '/articles/image-optimization', icon: 'image', category: 'Articles' },
        { title: 'Stratégie de contenu efficace', url: '/articles/content-strategy', icon: 'strategy', category: 'Articles' },
        { title: 'Backlinks et autorité', url: '/articles/backlinks-guide', icon: 'link', category: 'Articles' },
        { title: 'SEO technique', url: '/articles/technical-seo', icon: 'code', category: 'Articles' },
        { title: 'Analyse concurrentielle', url: '/articles/competitor-analysis', icon: 'analytics', category: 'Articles' },
        
        // Aide & Support
        { title: 'Centre d\'aide', url: '/help', icon: 'help_outline', category: 'Support' },
        { title: 'FAQ', url: '/help/faq', icon: 'quiz', category: 'Support' },
        { title: 'Contact support', url: '/help/contact', icon: 'contact_support', category: 'Support' },
        
        // Communauté
        { title: 'Forum de discussion', url: '/community/forum', icon: 'forum', category: 'Communauté' },
        { title: 'Événements', url: '/community/events', icon: 'event', category: 'Communauté' },
        { title: 'Membres', url: '/community/members', icon: 'people', category: 'Communauté' },
        
        // Autres pages
        { title: 'Gestion des utilisateurs', url: '/admin/users', icon: 'admin_panel_settings', category: 'Administration' },
        { title: 'Rapports SEO', url: '/reports', icon: 'bar_chart', category: 'Rapports' },
        { title: 'Calendrier éditorial', url: '/calendar', icon: 'calendar_today', category: 'Planning' },
        { title: 'Notifications', url: '/notifications', icon: 'notifications', category: 'Account' },
        
        // Actions rapides
        { title: 'Créer un article', url: '/articles/create', icon: 'add_circle', category: 'Actions' },
        { title: 'Nouvelle stratégie', url: '/ai/create', icon: 'add_circle', category: 'Actions' },
        { title: 'Exporter les données', url: '/export', icon: 'download', category: 'Actions' },
    ];

    // Fonction de recherche améliorée
    function handleSearch(event) {
        const query = event.target.value.trim();
        const resultsContainer = document.getElementById('searchResults');
        
        if (query.length < 2) {
            resultsContainer.classList.add('hidden');
            return;
        }

        const searchTerms = query.toLowerCase().split(' ');
        
        // Filtrer les résultats avec correspondance multi-mots
        const results = siteSearchData.filter(item => {
            const searchableText = (item.title + ' ' + item.category + ' ' + (item.tags || '')).toLowerCase();
            return searchTerms.every(term => searchableText.includes(term));
        });

        // Afficher les résultats
        if (results.length > 0) {
            // Grouper par catégorie
            const groupedResults = {};
            results.forEach(item => {
                if (!groupedResults[item.category]) {
                    groupedResults[item.category] = [];
                }
                groupedResults[item.category].push(item);
            });
            
            let html = '';
            for (const [category, items] of Object.entries(groupedResults)) {
                html += `
                    <div class="px-4 py-1.5 text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider bg-gray-50 dark:bg-gray-900/50">
                        ${category}
                    </div>
                `;
                items.forEach(item => {
                    html += `
                        <a href="${item.url}" 
                           class="flex items-center gap-3 px-4 py-2.5 hover:bg-primary/5 dark:hover:bg-gray-700 transition-colors group">
                            <span class="material-symbols-outlined text-gray-500 dark:text-gray-400 text-lg">${item.icon}</span>
                            <div class="flex-1">
                                <div class="text-sm font-medium text-gray-800 dark:text-gray-200">${item.title}</div>
                                <div class="text-xs text-gray-400 dark:text-gray-500">${item.category}</div>
                            </div>
                            <span class="material-symbols-outlined text-gray-400 text-sm opacity-0 group-hover:opacity-100 transition-opacity">arrow_forward</span>
                        </a>
                    `;
                });
            }
            
            // Ajouter le compteur de résultats
            const resultCount = document.createElement('div');
            resultsContainer.innerHTML = `
                <div class="px-4 py-1.5 text-xs text-gray-400 dark:text-gray-500 border-b border-gray-100 dark:border-gray-700">
                    ${results.length} résultat${results.length > 1 ? 's' : ''} trouvé${results.length > 1 ? 's' : ''}
                </div>
                ${html}
            `;
            resultsContainer.classList.remove('hidden');
        } else {
            resultsContainer.innerHTML = `
                <div class="px-4 py-6 text-center">
                    <span class="material-symbols-outlined text-4xl text-gray-300 dark:text-gray-600">search_off</span>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-2">
                        Aucun résultat trouvé pour "<strong>${query}</strong>"
                    </p>
                    <p class="text-xs text-gray-400 dark:text-gray-500 mt-1">
                        Essayez avec d'autres mots-clés
                    </p>
                </div>
            `;
            resultsContainer.classList.remove('hidden');
        }
    }
    <!-- Dans le header / topbar -->
<button onclick="toggleTheme()" 
        class="p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition">
    <span class="material-symbols-outlined text-gray-600 dark:text-gray-300">
        {{ session('theme', 'light') === 'dark' ? 'light_mode' : 'dark_mode' }}
    </span>
</button>



    // Fermer les résultats en cliquant ailleurs
    document.addEventListener('click', function(e) {
        const searchContainer = document.querySelector('.hidden\\:sm\\:flex.items-center');
        if (searchContainer && !searchContainer.contains(e.target)) {
            document.getElementById('searchResults').classList.add('hidden');
        }
    });

    // Raccourci clavier Ctrl+K ou Cmd+K
    document.addEventListener('keydown', function(e) {
        if ((e.ctrlKey || e.metaKey) && e.key === 'k') {
            e.preventDefault();
            const searchInput = document.getElementById('globalSearch');
            searchInput.focus();
            searchInput.select();
        }
        // Touche Escape pour fermer
        if (e.key === 'Escape') {
            document.getElementById('searchResults').classList.add('hidden');
            document.getElementById('globalSearch').blur();
        }
    });

    // Focus sur la recherche au chargement avec Ctrl+F
    document.addEventListener('keydown', function(e) {
        if ((e.ctrlKey || e.metaKey) && e.key === 'f') {
            // Ne pas interférer avec le Ctrl+F du navigateur
        }
    });

    // Fonction pour ajouter dynamiquement des résultats de recherche (utile pour les données dynamiques)
    function addSearchItems(items) {
        siteSearchData.push(...items);
    }

    // Exemple d'utilisation pour ajouter des articles dynamiques
    // addSearchItems([
    //     { title: 'Nouvel article', url: '/articles/nouveau', icon: 'article', category: 'Articles' }
    // ]);

    // Fonction pour la recherche instantanée avec debounce
    let searchTimeout;
    function handleSearchWithDebounce(event) {
        clearTimeout(searchTimeout);
        searchTimeout = setTimeout(() => {
            handleSearch(event);
        }, 300);
    }

    // Remplacer onkeyup par oninput pour une meilleure réactivité
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('globalSearch');
        if (searchInput) {
            searchInput.addEventListener('input', handleSearch);
        }
    });
    
function toggleTheme() {
    const html = document.documentElement;
    const isDark = html.classList.contains('dark');
    
    if (isDark) {
        html.classList.remove('dark');
        html.classList.add('light');
        localStorage.setItem('theme', 'light');
        document.querySelector('[onclick="toggleTheme()"] .material-symbols-outlined').textContent = 'dark_mode';
    } else {
        html.classList.remove('light');
        html.classList.add('dark');
        localStorage.setItem('theme', 'dark');
        document.querySelector('[onclick="toggleTheme()"] .material-symbols-outlined').textContent = 'light_mode';
    }
    
    // Sauvegarder via AJAX
    fetch('{{ route("settings.theme.update") }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify({ theme: isDark ? 'light' : 'dark' })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Mettre à jour la session
            location.reload();
        }
    })
    .catch(err => console.error('Erreur:', err));
}

// Charger le thème sauvegardé
document.addEventListener('DOMContentLoaded', function() {
    const savedTheme = localStorage.getItem('theme') || 'light';
    const html = document.documentElement;
    
    if (savedTheme === 'dark') {
        html.classList.remove('light');
        html.classList.add('dark');
    } else {
        html.classList.remove('dark');
        html.classList.add('light');
    }
});
</script>


<style>
    /* Animation pour les résultats de recherche */
    #searchResults {
        animation: slideDown 0.2s ease-out;
    }
    
    @keyframes slideDown {
        from {
            opacity: 0;
            transform: translateY(-10px) scale(0.95);
        }
        to {
            opacity: 1;
            transform: translateY(0) scale(1);
        }
    }
    
    /* Scrollbar personnalisée */
    #searchResults::-webkit-scrollbar {
        width: 6px;
    }
    
    #searchResults::-webkit-scrollbar-track {
        background: transparent;
    }
    
    #searchResults::-webkit-scrollbar-thumb {
        background: #d1d5db;
        border-radius: 3px;
    }
    
    #searchResults::-webkit-scrollbar-thumb:hover {
        background: #9ca3af;
    }
    
    .dark #searchResults::-webkit-scrollbar-thumb {
        background: #4b5563;
    }
    
    .dark #searchResults::-webkit-scrollbar-thumb:hover {
        background: #6b7280;
    }
    
    /* Effet de focus sur la recherche */
    #globalSearch:focus {
        width: 300px;
    }
    
    /* Badge de raccourci clavier */
    .search-shortcut {
        display: inline-flex;
        align-items: center;
        gap: 2px;
        font-size: 10px;
        color: #9ca3af;
        background: #f3f4f6;
        padding: 2px 6px;
        border-radius: 4px;
        border: 1px solid #e5e7eb;
        font-weight: 600;
    }
    
    .dark .search-shortcut {
        background: #374151;
        border-color: #4b5563;
        color: #9ca3af;
    }
</style>