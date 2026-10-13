<!-- Top Navigation -->
<header class="bg-white dark:bg-surface-container border-b border-gray-200 dark:border-gray-700 sticky top-0 z-30">
    <div class="flex justify-between items-center px-4 w-full h-16 mx-auto max-w-7xl">
        <!-- Logo / Menu -->
        <div class="flex items-center gap-4">
            <span class="md:hidden material-symbols-outlined text-primary cursor-pointer" onclick="toggleMobileMenu()">menu</span>
            <h2 class="text-xl font-bold text-primary dark:text-primary-fixed-dim tracking-tight">@yield('header-title', 'NEARSEO')</h2>
        </div>

        <!-- Right Side -->
        <div class="flex items-center gap-6">
            <!-- Search -->
            <div class="hidden sm:flex items-center bg-gray-50 dark:bg-gray-800 px-4 py-1.5 rounded-full border border-gray-200 dark:border-gray-600 relative">
                <span class="material-symbols-outlined text-gray-400 text-sm mr-2">search</span>
                <input id="globalSearch"
                       class="bg-transparent border-none focus:ring-0 text-sm w-48 focus:w-64 transition-all duration-300 outline-none text-gray-800 dark:text-gray-200"
                       placeholder="Rechercher"
                       type="text"
                       autocomplete="off"/>
                <div id="searchResults" class="absolute top-full left-0 right-0 mt-2 bg-white dark:bg-gray-800 rounded-lg shadow-xl border border-gray-200 dark:border-gray-700 hidden max-h-96 overflow-y-auto z-50"></div>
            </div>

            <div class="flex items-center gap-3">
                <a href="{{ route('help') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all text-on-surface-variant dark:text-surface-variant hover:bg-surface-container-low dark:hover:bg-surface-container-high">
    <span class="material-symbols-outlined !text-[22px]">help_outline</span>
    <span class="truncate">Aide</span>
</a>

                <!-- Theme Toggle -->
                <button onclick="toggleTheme()" 
                        class="p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition">
                    <span class="material-symbols-outlined text-gray-600 dark:text-gray-300" id="themeIcon">
                        {{ session('theme', 'light') === 'dark' ? 'light_mode' : 'dark_mode' }}
                    </span>
                </button>

                <!-- ✅ NOTIFICATIONS BUTTON -->
                @php
                    $unreadCount = \App\Models\Notification::where('user_id', Auth::id())
                        ->where('is_read', false)
                        ->count();
                @endphp

                <button type="button"
                        id="notificationsButton"
                        class="relative material-symbols-outlined text-gray-600 dark:text-gray-300 cursor-pointer p-2 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-full transition-colors"
                        aria-haspopup="dialog"
                        aria-controls="notificationsModal"
                        aria-expanded="false">
                    notifications

                    @if($unreadCount > 0)
                        <span id="notificationsBadge"
                              class="absolute -top-0.5 -right-0.5 min-w-5 h-5 px-1 rounded-full bg-red-500 text-white text-[10px] flex items-center justify-center font-bold">
                            {{ $unreadCount }}
                        </span>
                    @endif
                </button>

                <!-- ✅ MODALE NOTIFICATIONS -->
                <div id="notificationsModal" class="fixed inset-0 z-[60] hidden" role="dialog" aria-modal="true" aria-labelledby="notificationsModalTitle">
                    <div id="notificationsModalOverlay" class="absolute inset-0 bg-black/40 backdrop-blur-sm"></div>

                    <div class="relative w-full max-w-lg mx-auto my-6 bg-white dark:bg-surface-container-highest border border-outline-variant rounded-2xl shadow-xl overflow-hidden max-h-[90vh] flex flex-col">
                        <!-- Header -->
                        <div class="flex items-center justify-between px-4 py-3 border-b border-outline-variant flex-shrink-0">
                            <div>
                                <div class="font-bold text-primary" id="notificationsModalTitle">Notifications</div>
                                <div class="text-xs text-gray-500 dark:text-gray-400" id="notificationsModalSub">Chargement...</div>
                            </div>
                            <button type="button" id="notificationsCloseBtn" class="material-symbols-outlined text-gray-500 hover:text-gray-800 dark:hover:text-gray-200">close</button>
                        </div>

                        <!-- ✅ Liste scrollable -->
                        <div id="notificationsModalList" class="p-4 space-y-2 overflow-y-auto flex-1 max-h-[50vh]">
                            <div class="text-center py-8 text-gray-400">⏳ Chargement des notifications...</div>
                        </div>

                        <!-- Footer -->
                        <div class="px-4 py-3 border-t border-outline-variant flex items-center justify-between flex-shrink-0 bg-gray-50 dark:bg-gray-900/50">
                            <button type="button" id="markAllNotificationsReadBtn" class="text-primary font-semibold text-sm hover:opacity-90 transition-colors">
                                Tout marquer comme lu
                            </button>

                        </div>
                    </div>
                </div>

                <!-- Profile -->
                <a href="{{ route('profile.public', ['username' => Auth::user()->slug ?? Auth::user()->name]) }}"
                   class="w-8 h-8 rounded-full bg-primary/20 flex items-center justify-center text-primary dark:text-primary-fixed font-bold text-xs hover:bg-primary/30 transition-colors"
                   title="{{ __('messages.public_profile') }}">
                    {{ strtoupper(substr(Auth::user()->name ?? 'U', 0, 2)) }}
                </a>
            </div>
        </div>
    </div>
</header>

<!-- ✅ SCRIPTS -->
<script>
    // =============================================
    // GLOBAL SEARCH
    // =============================================
    const siteSearchData = [
        { title: 'Tableau de bord', url: '/dashboard', icon: 'dashboard', category: 'Navigation' },
        { title: 'Stratégie de contenu', url: '/ai/create', icon: 'edit_note', category: 'Navigation' },
        { title: 'Articles', url: '/articles', icon: 'description', category: 'Navigation' },
        { title: 'Communauté', url: '/community', icon: 'groups', category: 'Navigation' },
        { title: 'Géolocalisation', url: '/geo', icon: 'distance', category: 'Navigation' },
        { title: 'Mon Blog', url: '/blog', icon: 'feed', category: 'Navigation' },
        { title: 'Profil', url: '/profile', icon: 'account_circle', category: 'Navigation' },
        { title: 'Paramètres', url: '/settings', icon: 'settings', category: 'Navigation' },
        { title: 'Centre d\'aide', url: '/help', icon: 'help_outline', category: 'Support' },
        { title: 'Créer un article', url: '/articles/create', icon: 'add_circle', category: 'Actions' },
    ];

    function handleSearch(event) {
        const query = event.target.value.trim();
        const resultsContainer = document.getElementById('searchResults');

        if (query.length < 2) {
            resultsContainer.classList.add('hidden');
            return;
        }

        const results = siteSearchData.filter(item => 
            item.title.toLowerCase().includes(query.toLowerCase()) ||
            item.category.toLowerCase().includes(query.toLowerCase())
        );

        if (results.length > 0) {
            let html = `
                <div class="px-4 py-1.5 text-xs text-gray-400 dark:text-gray-500 border-b border-gray-100 dark:border-gray-700">
                    ${results.length} résultat${results.length > 1 ? 's' : ''} trouvé${results.length > 1 ? 's' : ''}
                </div>
            `;
            results.forEach(item => {
                html += `
                    <a href="${item.url}" class="flex items-center gap-3 px-4 py-2.5 hover:bg-primary/5 dark:hover:bg-gray-700 transition-colors group">
                        <span class="material-symbols-outlined text-gray-500 dark:text-gray-400 text-lg">${item.icon}</span>
                        <div class="flex-1">
                            <div class="text-sm font-medium text-gray-800 dark:text-gray-200">${item.title}</div>
                            <div class="text-xs text-gray-400 dark:text-gray-500">${item.category}</div>
                        </div>
                        <span class="material-symbols-outlined text-gray-400 text-sm opacity-0 group-hover:opacity-100 transition-opacity">arrow_forward</span>
                    </a>
                `;
            });
            resultsContainer.innerHTML = html;
            resultsContainer.classList.remove('hidden');
        } else {
            resultsContainer.innerHTML = `
                <div class="px-4 py-6 text-center">
                    <span class="material-symbols-outlined text-4xl text-gray-300 dark:text-gray-600">search_off</span>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-2">Aucun résultat trouvé pour "<strong>${query}</strong>"</p>
                </div>
            `;
            resultsContainer.classList.remove('hidden');
        }
    }

    // Search input events
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('globalSearch');
        if (searchInput) {
            searchInput.addEventListener('input', handleSearch);
            searchInput.addEventListener('blur', function() {
                setTimeout(() => {
                    document.getElementById('searchResults').classList.add('hidden');
                }, 300);
            });
            searchInput.addEventListener('focus', function() {
                if (this.value.length >= 2) handleSearch({ target: this });
            });
        }
    });

    // =============================================
    // THEME TOGGLE
    // =============================================
    function toggleTheme() {
        const html = document.documentElement;
        const isDark = html.classList.contains('dark');
        const icon = document.getElementById('themeIcon');

        if (isDark) {
            html.classList.remove('dark');
            html.classList.add('light');
            localStorage.setItem('theme', 'light');
            if (icon) icon.textContent = 'dark_mode';
        } else {
            html.classList.remove('light');
            html.classList.add('dark');
            localStorage.setItem('theme', 'dark');
            if (icon) icon.textContent = 'light_mode';
        }

        // Sauvegarder en base
        fetch('{{ route("settings.theme.update") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
            },
            body: JSON.stringify({ theme: isDark ? 'light' : 'dark' })
        }).catch(err => console.error('Erreur theme:', err));
    }

    // Init theme
    document.addEventListener('DOMContentLoaded', function() {
        const savedTheme = localStorage.getItem('theme') || 'light';
        const html = document.documentElement;
        const icon = document.getElementById('themeIcon');

        if (savedTheme === 'dark') {
            html.classList.remove('light');
            html.classList.add('dark');
            if (icon) icon.textContent = 'light_mode';
        } else {
            html.classList.remove('dark');
            html.classList.add('light');
            if (icon) icon.textContent = 'dark_mode';
        }
    });

    // =============================================
    // NOTIFICATIONS MODALE
    // =============================================
    document.addEventListener('DOMContentLoaded', function() {
        const button = document.getElementById('notificationsButton');
        const modal = document.getElementById('notificationsModal');
        const overlay = document.getElementById('notificationsModalOverlay');
        const closeBtn = document.getElementById('notificationsCloseBtn');
        const list = document.getElementById('notificationsModalList');
        const sub = document.getElementById('notificationsModalSub');
        const badge = document.getElementById('notificationsBadge');
        const markAllBtn = document.getElementById('markAllNotificationsReadBtn');

        if (!button) {
            console.error('❌ Bouton notifications non trouvé');
            return;
        }

        console.log('✅ Notifications modale initialisée');

        let isOpen = false;
        let isLoading = false;

        function openModal() {
            modal.classList.remove('hidden');
            modal.style.display = 'block';
            document.body.style.overflow = 'hidden'; // ✅ Bloquer le scroll du body
            button.setAttribute('aria-expanded', 'true');
            isOpen = true;
            if (!isLoading) loadNotifications();
        }

        function closeModal() {
            modal.classList.add('hidden');
            modal.style.display = 'none';
            document.body.style.overflow = ''; // ✅ Restaurer le scroll
            button.setAttribute('aria-expanded', 'false');
            isOpen = false;
        }

        async function loadNotifications() {
            if (isLoading) return;
            isLoading = true;
            sub.textContent = 'Chargement...';
            list.innerHTML = '<div class="text-center py-8 text-gray-400">⏳ Chargement...</div>';

            try {
                const response = await fetch('/notifications/data', {
                    headers: { 
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
                    }
                });

                if (!response.ok) throw new Error('HTTP ' + response.status);
                const data = await response.json();

                console.log('📩 Notifications reçues:', data);

                // ✅ Mettre à jour le badge
                if (data.unread_count > 0) {
                    if (badge) {
                        badge.textContent = data.unread_count > 99 ? '99+' : data.unread_count;
                        badge.classList.remove('hidden');
                    }
                } else {
                    if (badge) badge.classList.add('hidden');
                }

                sub.textContent = data.unread_count > 0 
                    ? data.unread_count + ' non lue' + (data.unread_count > 1 ? 's' : '')
                    : '✅ Tout est à jour';

                if (!data.notifications || data.notifications.length === 0) {
                    list.innerHTML = `
                        <div class="text-center py-8 text-gray-400">
                            <span class="material-symbols-outlined text-4xl block mb-2">notifications_off</span>
                            <p class="text-sm">Aucune notification</p>
                        </div>
                    `;
                    return;
                }

                // ✅ Afficher les notifications avec redirection
                list.innerHTML = data.notifications.map(n => {
                    // Construire l'URL de redirection
                    let redirectUrl = n.url || '#';
                    if (!n.url && n.article_id) {
                        redirectUrl = '/articles/' + n.article_id + '/edit';
                    } else if (!n.url && n.type === 'article_published') {
                        redirectUrl = '/articles/' + (n.article_id || '') + '/edit';
                    } else if (!n.url && n.link) {
                        redirectUrl = n.link;
                    }

                    return `
                        <div class="rounded-xl border p-3 flex gap-3 items-start ${n.is_read ? 'bg-gray-50 dark:bg-gray-800/50' : 'bg-primary/10 border-primary/20'} cursor-pointer hover:shadow-md transition-shadow"
                             onclick="window.location.href='${redirectUrl}'">
                            <span class="material-symbols-outlined text-gray-600 dark:text-gray-400 mt-0.5">${n.icon || 'notifications'}</span>
                            <div class="flex-1 min-w-0">
                                <div class="text-sm ${n.is_read ? 'text-gray-600 dark:text-gray-400' : 'text-gray-900 dark:text-gray-100 font-medium'}">
                                    ${n.message}
                                </div>
                                <div class="text-xs text-gray-400 mt-1">${n.created_at || ''}</div>
                                ${!n.is_read ? `
                                    <button type="button" 
                                            onclick="event.stopPropagation(); markNotificationRead(${n.id})"
                                            class="mt-1 text-xs text-primary font-semibold hover:underline">
                                        Marquer comme lu
                                    </button>
                                ` : ''}
                            </div>
                            ${!n.is_read ? `<span class="w-2 h-2 bg-primary rounded-full flex-shrink-0 mt-1.5"></span>` : ''}
                        </div>
                    `;
                }).join('');

            } catch (error) {
                console.error('❌ Erreur chargement:', error);
                sub.textContent = '❌ Erreur';
                list.innerHTML = `
                    <div class="text-center py-8 text-red-500">
                        <span class="material-symbols-outlined text-4xl block mb-2">error</span>
                        <p class="text-sm">Impossible de charger</p>
                        <button onclick="loadNotifications()" class="mt-2 text-sm text-primary hover:underline">Réessayer</button>
                    </div>
                `;
            } finally {
                isLoading = false;
            }
        }

        // ✅ Marquer une notification comme lue (global)
        window.markNotificationRead = async function(id) {
            try {
                const response = await fetch('/notifications/' + id + '/read', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '',
                        'Accept': 'application/json'
                    }
                });
                if (response.ok) {
                    await loadNotifications();
                    loadBadge();
                }
            } catch (error) {
                console.error('❌ Erreur:', error);
            }
        };

        // ✅ Marquer tout comme lu
        markAllBtn?.addEventListener('click', async function() {
            try {
                const response = await fetch('/notifications/mark-all-read', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '',
                        'Accept': 'application/json'
                    }
                });
                if (response.ok) {
                    await loadNotifications();
                    loadBadge();
                }
            } catch (error) {
                console.error('❌ Erreur:', error);
            }
        });

        // ✅ Charger le badge
        async function loadBadge() {
            try {
                const response = await fetch('/notifications/data', {
                    headers: { 'Accept': 'application/json' }
                });
                if (response.ok) {
                    const data = await response.json();
                    if (data.unread_count > 0 && badge) {
                        badge.textContent = data.unread_count > 99 ? '99+' : data.unread_count;
                        badge.classList.remove('hidden');
                    } else if (badge) {
                        badge.classList.add('hidden');
                    }
                }
            } catch (error) {
                console.error('❌ Badge error:', error);
            }
        }

        // ✅ Événements
        button.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            if (isOpen) {
                closeModal();
            } else {
                openModal();
            }
        });

        overlay?.addEventListener('click', closeModal);
        closeBtn?.addEventListener('click', closeModal);

        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && isOpen) closeModal();
        });

        // ✅ Charger le badge au démarrage
        loadBadge();

        console.log('✅ Notifications modale prête !');
    });

    // =============================================
    // MOBILE MENU TOGGLE
    // =============================================
    function toggleMobileMenu() {
        const sidebar = document.querySelector('.sidebar');
        if (sidebar) {
            sidebar.classList.toggle('translate-x-0');
            sidebar.classList.toggle('-translate-x-full');
        }
    }
</script>

<style>
    /* Search animations */
    #searchResults { animation: slideDown 0.2s ease-out; }
    @keyframes slideDown {
        from { opacity: 0; transform: translateY(-10px) scale(0.95); }
        to { opacity: 1; transform: translateY(0) scale(1); }
    }

    #searchResults::-webkit-scrollbar { width: 6px; }
    #searchResults::-webkit-scrollbar-track { background: transparent; }
    #searchResults::-webkit-scrollbar-thumb { background: #d1d5db; border-radius: 3px; }
    #searchResults::-webkit-scrollbar-thumb:hover { background: #9ca3af; }
    .dark #searchResults::-webkit-scrollbar-thumb { background: #4b5563; }
    .dark #searchResults::-webkit-scrollbar-thumb:hover { background: #6b7280; }

    #globalSearch:focus { width: 300px; }

    /* Notifications modal scroll */
    #notificationsModalList::-webkit-scrollbar { width: 6px; }
    #notificationsModalList::-webkit-scrollbar-track { background: transparent; }
    #notificationsModalList::-webkit-scrollbar-thumb { background: #d1d5db; border-radius: 3px; }
    #notificationsModalList::-webkit-scrollbar-thumb:hover { background: #9ca3af; }
    .dark #notificationsModalList::-webkit-scrollbar-thumb { background: #4b5563; }
    .dark #notificationsModalList::-webkit-scrollbar-thumb:hover { background: #6b7280; }

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