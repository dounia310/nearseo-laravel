<!DOCTYPE html>
<html class="light" lang="fr">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>NEARSEO - Notifications</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&amp;family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
    
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
        .scale-98 { transform: scale(0.98); }
        .glass-panel {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(10px);
        }
    </style>
    
    <script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    "colors": {
                        "on-tertiary-fixed-variant": "#6d3900",
                        "surface-dim": "#c9dcf3",
                        "surface-container-lowest": "#ffffff",
                        "surface-container-low": "#edf4ff",
                        "on-tertiary-container": "#fffbff",
                        "on-surface": "#091d2e",
                        "on-tertiary": "#ffffff",
                        "on-error-container": "#93000a",
                        "primary-fixed-dim": "#ffb599",
                        "primary": "#8c4a2f",
                        "inverse-surface": "#203243",
                        "tertiary": "#8c4b00",
                        "surface-container-high": "#d9eaff",
                        "surface-container": "#e3efff",
                        "on-secondary": "#ffffff",
                        "primary-fixed": "#ffdbce",
                        "surface-variant": "#d1e4fb",
                        "on-secondary-container": "#4d6c50",
                        "outline": "#86736c",
                        "on-background": "#091d2e",
                        "tertiary-container": "#b06000",
                        "on-tertiary-fixed": "#2e1500",
                        "tertiary-fixed-dim": "#ffb77c",
                        "background": "#f7f9ff",
                        "secondary": "#47664b",
                        "on-surface-variant": "#53433d",
                        "outline-variant": "#d9c2ba",
                        "secondary-fixed": "#c9ecc9",
                        "tertiary-fixed": "#ffdcc2",
                        "on-primary": "#ffffff",
                        "on-primary-fixed-variant": "#71361c",
                        "on-error": "#ffffff",
                        "surface-bright": "#f7f9ff",
                        "secondary-container": "#c9ecc9",
                        "on-primary-container": "#fffbff",
                        "surface": "#f7f9ff",
                        "surface-container-highest": "#d1e4fb",
                        "surface-tint": "#8e4c31",
                        "on-secondary-fixed": "#03210c",
                        "inverse-on-surface": "#e8f2ff",
                        "primary-container": "#a96245",
                        "secondary-fixed-dim": "#adcfae",
                        "inverse-primary": "#ffb599",
                        "error": "#ba1a1a",
                        "on-secondary-fixed-variant": "#304d34",
                        "on-primary-fixed": "#370e00",
                        "error-container": "#ffdad6"
                    },
                    "borderRadius": {
                        "DEFAULT": "0.125rem",
                        "lg": "0.25rem",
                        "xl": "0.5rem",
                        "full": "0.75rem"
                    },
                    "spacing": {
                        "gutter": "16px",
                        "container-max-width": "1280px",
                        "stack-gap-sm": "8px",
                        "card-padding": "24px",
                        "stack-gap-md": "16px",
                        "section-margin": "32px"
                    },
                    "fontFamily": {
                        "h1": ["Inter", "sans-serif"],
                        "h2": ["Inter", "sans-serif"],
                        "h3": ["Inter", "sans-serif"],
                        "body": ["Inter", "sans-serif"],
                        "body-sm": ["Inter", "sans-serif"],
                        "label": ["Inter", "sans-serif"]
                    },
                    "fontSize": {
                        "h1": ["32px", { "lineHeight": "1.2", "letterSpacing": "-0.02em", "fontWeight": "700" }],
                        "h2": ["24px", { "lineHeight": "1.3", "fontWeight": "600" }],
                        "h3": ["18px", { "lineHeight": "1.4", "fontWeight": "600" }],
                        "body": ["16px", { "lineHeight": "1.6", "fontWeight": "400" }],
                        "body-sm": ["14px", { "lineHeight": "1.5", "fontWeight": "400" }],
                        "label": ["12px", { "lineHeight": "1", "letterSpacing": "0.05em", "fontWeight": "600" }]
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-background text-on-surface font-body">

<!-- SideNavBar Shell -->
<aside class="h-screen w-64 fixed left-0 top-0 border-r border-outline-variant bg-surface flex flex-col p-gutter z-50">
    <div class="mb-section-margin">
        <h1 class="font-h2 text-h2 font-bold text-primary">NEARSEO</h1>
        <p class="font-label text-label text-on-surface-variant opacity-70">Local Growth Engine</p>
    </div>
    <nav class="flex-1 space-y-1">
        <a href="{{ route('dashboard') }}" class="flex items-center gap-stack-gap-md p-3 text-on-surface-variant hover:bg-surface-container-low transition-colors duration-200 rounded-lg group">
            <span class="material-symbols-outlined">dashboard</span>
            <span class="font-body text-body">Dashboard</span>
        </a>
        <a href="{{ route('articles.index') }}" class="flex items-center gap-stack-gap-md p-3 text-on-surface-variant hover:bg-surface-container-low transition-colors duration-200 rounded-lg group">
            <span class="material-symbols-outlined">auto_awesome</span>
            <span class="font-body text-body">Content AI</span>
        </a>
        <a href="#" class="flex items-center gap-stack-gap-md p-3 text-on-surface-variant hover:bg-surface-container-low transition-colors duration-200 rounded-lg group">
            <span class="material-symbols-outlined">analytics</span>
            <span class="font-body text-body">SEO Audit</span>
        </a>
        <a href="{{ route('notifications.index') }}" class="flex items-center gap-stack-gap-md p-3 bg-secondary-container text-on-secondary-container font-bold rounded-lg transition-transform scale-98 active:scale-95">
            <span class="material-symbols-outlined">notifications</span>
            <span class="font-body text-body">Notifications</span>
        </a>
        <a href="{{ route('settings.index') }}" class="flex items-center gap-stack-gap-md p-3 text-on-surface-variant hover:bg-surface-container-low transition-colors duration-200 rounded-lg group">
            <span class="material-symbols-outlined">settings</span>
            <span class="font-body text-body">Settings</span>
        </a>
    </nav>
    <div class="mt-auto pt-6 border-t border-outline-variant">
        <div class="flex items-center gap-stack-gap-md mb-4 px-2">
            <img alt="User profile avatar" class="w-10 h-10 rounded-full object-cover border-2 border-primary-fixed" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAbg0PEnctdqg6oBNNW7LZqsrAvfBbc4rs-uNyHZwxk-nMFheUNMVPCsM1X_cO0Hz4j4M_btwgQ0k2tSUndj9nAe7yHj_vE1_3hAeGePf10FtCG_QhAZgMSGxmOEiwRqzJLqi58whR33ydF8MHkncxZjrjZ7oVD8N1zoSzI33FMul7VWsFT1DBjGOyh2o-GnGqKnrS2vYl6vMzupqkGlPGV8Gv-b60--HCU9S0YtKLbRb3keZFT82o539c4vNxyt7q3J3TO8tcutK_6"/>
            <div>
                <p class="font-body-sm text-body-sm font-bold">{{ Auth::user()->name ?? 'Marie Laurent' }}</p>
                <p class="font-label text-label text-on-surface-variant">{{ Auth::user()->role ?? 'Admin' }}</p>
            </div>
        </div>
        <button class="w-full py-2 bg-primary text-on-primary font-label text-label rounded-lg hover:opacity-90 transition-opacity">Upgrade Plan</button>
    </div>
</aside>

<!-- TopNavBar Shell -->
<header class="flex justify-between items-center w-[calc(100%-16rem)] ml-64 px-gutter h-16 sticky top-0 bg-surface/80 backdrop-blur-md border-b border-outline-variant z-40">
    <div class="flex items-center gap-gutter flex-1">
        <div class="relative w-full max-w-md">
            <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-on-surface-variant">search</span>
            <input id="searchNotifications" class="w-full bg-surface-container-low border-none rounded-full pl-10 pr-4 py-2 text-body-sm focus:ring-1 focus:ring-primary" placeholder="Rechercher des notifications..." type="text" onkeyup="filterNotifications()"/>
        </div>
    </div>
    <nav class="flex items-center gap-section-margin">
        <div class="flex items-center gap-stack-gap-md">
            <button onclick="filterByTab('all')" class="tab-btn font-body-sm text-body-sm text-primary border-b-2 border-primary pb-1" data-tab="all">All</button>
            <button onclick="filterByTab('unread')" class="tab-btn font-body-sm text-body-sm text-on-surface-variant hover:text-primary transition-colors" data-tab="unread">Unread</button>
            <button onclick="filterByTab('mentions')" class="tab-btn font-body-sm text-body-sm text-on-surface-variant hover:text-primary transition-colors" data-tab="mentions">Mentions</button>
        </div>
        <div class="flex items-center gap-stack-gap-md">
            <button class="material-symbols-outlined text-on-surface-variant hover:text-primary">help</button>
            <a href="{{ route('profile.edit') }}" class="material-symbols-outlined text-on-surface-variant hover:text-primary">account_circle</a>
        </div>
    </nav>
</header>

<!-- Main Content -->
<main class="ml-64 p-gutter min-h-screen">
    <div class="max-w-[1280px] mx-auto">
        <!-- Content Header -->
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-stack-gap-md mb-section-margin">
            <div>
                <h2 class="font-h1 text-h1 text-on-surface mb-2">Notifications</h2>
                <p class="font-body text-body text-on-surface-variant max-w-xl">Restez informé des performances de votre contenu local et des interactions de votre audience.</p>
            </div>
            <button onclick="markAllAsRead()" class="flex items-center gap-stack-gap-sm px-4 py-2 text-primary border border-primary rounded-lg hover:bg-primary-fixed transition-colors font-label text-label">
                <span class="material-symbols-outlined" style="font-size: 18px;">done_all</span>
                Tout marquer comme lu
            </button>
        </div>
        
        <!-- Custom Tabs Component -->
        <div class="flex gap-stack-gap-md border-b border-outline-variant mb-gutter">
            <button onclick="filterByTab('all')" class="tab-header pb-3 px-4 text-primary border-b-2 border-primary font-label text-label" data-tab="all">
                Toutes ({{ $notifications->total() }})
            </button>
            <button onclick="filterByTab('unread')" class="tab-header pb-3 px-4 text-on-surface-variant hover:text-on-surface font-label text-label transition-colors" data-tab="unread">
                Non lues ({{ $unreadCount }})
            </button>
            <button onclick="filterByTab('mentions')" class="tab-header pb-3 px-4 text-on-surface-variant hover:text-on-surface font-label text-label transition-colors" data-tab="mentions">
                Mentions ({{ $mentionsCount }})
            </button>
        </div>
        
        <!-- Notifications List -->
        <div id="notificationsList" class="space-y-2">
            @forelse($notifications as $notification)
            <div class="notification-item group relative flex items-start gap-card-padding p-card-padding rounded-xl transition-all duration-300 {{ $notification->is_read ? 'bg-surface border border-outline-variant' : 'bg-primary-fixed/20 border border-primary-fixed/30' }}" data-id="{{ $notification->id }}" data-read="{{ $notification->is_read ? 'true' : 'false' }}" data-type="{{ $notification->type }}">
                <div class="relative">
                    <div class="w-12 h-12 rounded-full {{ $notification->type === 'article' ? 'bg-primary-container/20 text-primary' : ($notification->type === 'comment' ? 'bg-secondary-container/30 text-secondary' : 'bg-surface-container text-on-surface-variant') }} flex items-center justify-center">
                        <span class="material-symbols-outlined">{{ $notification->icon ?? 'notifications' }}</span>
                    </div>
                    @if(!$notification->is_read)
                    <div class="absolute -top-1 -right-1 w-3 h-3 bg-primary rounded-full border-2 border-background"></div>
                    @endif
                </div>
                <div class="flex-1">
                    <p class="font-body text-body {{ $notification->is_read ? 'text-on-surface-variant' : 'text-on-surface' }} mb-1">
                        {!! $notification->message !!}
                    </p>
                    <p class="font-body-sm text-body-sm text-on-surface-variant opacity-70">
                        {{ $notification->created_at->diffForHumans() }}
                    </p>
                </div>
                @if(!$notification->is_read)
                <div class="opacity-0 group-hover:opacity-100 transition-opacity">
                    <button onclick="markAsRead({{ $notification->id }})" class="text-primary hover:bg-primary-fixed p-2 rounded-full transition-colors material-symbols-outlined" title="Marquer comme lu">
                        check_circle
                    </button>
                </div>
                @endif
            </div>
            @empty
            <div class="text-center py-12">
                <span class="material-symbols-outlined text-5xl text-on-surface-variant mb-3">notifications_off</span>
                <p class="text-on-surface-variant">Aucune notification pour le moment</p>
            </div>
            @endforelse
        </div>
        
        <!-- Pagination -->
        <div class="mt-8">
            {{ $notifications->links() }}
        </div>
        
        <!-- AI Insight Card -->
        <div class="mt-section-margin bg-on-secondary-fixed-variant p-card-padding rounded-xl text-on-secondary overflow-hidden relative">
            <div class="relative z-10 flex flex-col md:flex-row items-center gap-section-margin">
                <div class="flex-1">
                    <div class="flex items-center gap-stack-gap-sm mb-4">
                        <span class="material-symbols-outlined text-secondary-fixed">auto_awesome</span>
                        <span class="font-label text-label uppercase tracking-widest text-secondary-fixed">Insight Hebdomadaire</span>
                    </div>
                    <h3 class="font-h2 text-h2 mb-4">Votre visibilité locale a augmenté de {{ $stats['visibility_growth'] ?? 12 }}%</h3>
                    <p class="font-body text-body opacity-90 mb-6">Grâce à vos récents articles optimisés par l'IA, NEARSEO a détecté une hausse significative des interactions dans votre zone de chalandise.</p>
                    <button class="bg-secondary-fixed text-on-secondary-fixed px-6 py-2 rounded-lg font-label text-label hover:opacity-90 transition-opacity">Consulter le rapport</button>
                </div>
                <div class="w-full md:w-1/3">
                    <div class="aspect-square rounded-full border-4 border-secondary-fixed/20 p-4 flex items-center justify-center">
                        <div class="w-full h-full rounded-full border-4 border-secondary-fixed/40 p-4 flex items-center justify-center animate-pulse">
                            <div class="w-full h-full rounded-full bg-secondary-fixed/10 flex items-center justify-center">
                                <span class="material-symbols-outlined text-secondary-fixed" style="font-size: 48px;">trending_up</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="absolute top-0 right-0 w-64 h-64 bg-secondary-fixed/5 rounded-full -mr-32 -mt-32 blur-3xl"></div>
        </div>
    </div>
</main>

<script>
    let currentTab = 'all';
    
    function filterNotifications() {
        const searchTerm = document.getElementById('searchNotifications').value.toLowerCase();
        const items = document.querySelectorAll('.notification-item');
        
        items.forEach(item => {
            const text = item.innerText.toLowerCase();
            if (text.includes(searchTerm)) {
                item.style.display = '';
            } else {
                item.style.display = 'none';
            }
        });
    }
    
    function filterByTab(tab) {
        currentTab = tab;
        
        // Update tab styles
        document.querySelectorAll('.tab-header').forEach(btn => {
            btn.classList.remove('text-primary', 'border-b-2', 'border-primary');
            btn.classList.add('text-on-surface-variant');
        });
        
        const activeBtn = document.querySelector(`.tab-header[data-tab="${tab}"]`);
        activeBtn.classList.add('text-primary', 'border-b-2', 'border-primary');
        activeBtn.classList.remove('text-on-surface-variant');
        
        // Filter notifications
        const items = document.querySelectorAll('.notification-item');
        items.forEach(item => {
            const isRead = item.dataset.read === 'true';
            const type = item.dataset.type;
            
            if (tab === 'all') {
                item.style.display = '';
            } else if (tab === 'unread') {
                item.style.display = !isRead ? '' : 'none';
            } else if (tab === 'mentions') {
                item.style.display = type === 'mention' ? '' : 'none';
            }
        });
    }
    
    async function markAsRead(id) {
        try {
            const response = await fetch(`/notifications/${id}/read`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Content-Type': 'application/json'
                }
            });
            
            if (response.ok) {
                const item = document.querySelector(`.notification-item[data-id="${id}"]`);
                item.classList.remove('bg-primary-fixed/20', 'border-primary-fixed/30');
                item.classList.add('bg-surface', 'border-outline-variant');
                item.dataset.read = 'true';
                
                const dot = item.querySelector('.bg-primary');
                if (dot) dot.remove();
                
                const btn = item.querySelector('.opacity-0');
                if (btn) btn.remove();
                
                const text = item.querySelector('.text-on-surface');
                if (text) {
                    text.classList.remove('text-on-surface');
                    text.classList.add('text-on-surface-variant');
                }
                
                // Update unread count
                const unreadCountEl = document.querySelector('.tab-header[data-tab="unread"]');
                if (unreadCountEl) {
                    const currentCount = parseInt(unreadCountEl.innerText.match(/\d+/)?.[0] || 0);
                    const newCount = Math.max(0, currentCount - 1);
                    unreadCountEl.innerHTML = `Non lues (${newCount})`;
                }
            }
        } catch (error) {
            console.error('Error marking as read:', error);
        }
    }
    
    async function markAllAsRead() {
        try {
            const response = await fetch('{{ route("notifications.mark-all-read") }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Content-Type': 'application/json'
                }
            });
            
            if (response.ok) {
                location.reload();
            }
        } catch (error) {
            console.error('Error marking all as read:', error);
        }
    }
</script>

</body>
</html>