{{-- resources/views/components/header.blade.php --}}
@props(['active' => null])

<!-- TopAppBar -->
<header class="fixed top-0 w-full z-50 bg-surface/80 backdrop-blur-md border-b border-outline-variant/30">
    <div class="max-w-container-max-width mx-auto px-gutter flex justify-between items-center h-24">
        
        <!-- Logo agrandi -->
        <div class="flex items-center">
            <img src="{{ asset('logo.png') }}" 
                 alt="NEARSEO Logo" 
                 class="h-16 w-auto md:h-20 object-contain"
                 onerror="this.src='{{ asset('images/logo.png') }}'">
        </div>
        
        <!-- Navigation desktop -->
        <nav class="hidden md:flex items-center gap-8">
            <a class="text-on-surface-variant font-body text-body hover:text-primary transition-colors {{ $active === 'features' ? 'text-primary font-bold' : '' }}" 
               href="{{ route('landing') }}#features">
                Fonctionnalités
            </a>
            <a class="text-on-surface-variant font-body text-body hover:text-primary transition-colors {{ $active === 'pricing' ? 'text-primary font-bold' : '' }}" 
               href="{{ route('landing') }}#pricing">
                Tarifs
            </a>
            <a class="text-on-surface-variant font-body text-body hover:text-primary transition-colors {{ $active === 'community' ? 'text-primary font-bold border-b-2 border-primary pb-1' : '' }}" 
               href="{{ route('community') }}">
                Communauté
            </a>
            <a class="text-on-surface-variant font-body text-body hover:text-primary transition-colors flex items-center gap-1 {{ $active === 'help' ? 'text-primary font-bold border-b-2 border-primary pb-1' : '' }}" 
               href="{{ route('help') }}">
                Aide
            </a>
            
            <!-- ===== AUTHENTIFICATION ===== -->
            @auth
                <!-- Utilisateur connecté -->
                <div class="flex items-center gap-3 ml-4">
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-2 text-on-surface-variant hover:text-primary transition-colors">
                        <div class="w-8 h-8 rounded-full bg-primary/10 flex items-center justify-center text-primary font-bold text-xs">
                            {{ auth()->user()->name ? strtoupper(substr(auth()->user()->name, 0, 2)) : 'U' }}
                        </div>
                        <span class="font-body text-body hidden lg:inline">{{ auth()->user()->name ?? 'Utilisateur' }}</span>
                    </a>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="text-on-surface-variant hover:text-error transition-colors text-sm font-label flex items-center gap-1">
                            <span class="material-symbols-outlined text-sm">logout</span>
                            <span class="hidden lg:inline">Déconnexion</span>
                        </button>
                    </form>
                </div>
            @else
                <!-- Utilisateur non connecté -->
                <div class="flex items-center gap-4 ml-4">
                    <a href="{{ route('login') }}" class="text-on-surface-variant font-body text-body hover:text-primary transition-colors">Connexion</a>
                    <a href="{{ route('register') }}" class="bg-primary hover:bg-primary-container text-on-primary px-6 py-2.5 rounded-full font-label transition-all active:scale-95 whitespace-nowrap">
                        Essai gratuit
                    </a>
                </div>
            @endauth
            <!-- ===== FIN AUTHENTIFICATION ===== -->
        </nav>
        
        <!-- Version mobile (hamburger menu) -->
        <div class="md:hidden flex items-center gap-3">
            @auth
                <a href="{{ route('dashboard') }}" class="w-8 h-8 rounded-full bg-primary/10 flex items-center justify-center text-primary font-bold text-xs">
                    {{ auth()->user()->name ? strtoupper(substr(auth()->user()->name, 0, 2)) : 'U' }}
                </a>
            @else
                <a href="{{ route('login') }}" class="text-on-surface-variant hover:text-primary transition-colors">
                    <span class="material-symbols-outlined">person</span>
                </a>
            @endauth
            <button id="mobileMenuBtn" class="text-on-surface-variant hover:text-primary transition-colors">
                <span class="material-symbols-outlined">menu</span>
            </button>
        </div>
    </div>
    
    <!-- Menu mobile (dropdown) -->
    <div id="mobileMenu" class="hidden md:hidden bg-surface border-b border-outline-variant/30">
        <div class="max-w-container-max-width mx-auto px-gutter py-4 flex flex-col gap-4">
            <a class="text-on-surface-variant font-body text-body hover:text-primary transition-colors" href="{{ route('landing') }}#features">Fonctionnalités</a>
            <a class="text-on-surface-variant font-body text-body hover:text-primary transition-colors" href="{{ route('landing') }}#pricing">Tarifs</a>
            <a class="text-on-surface-variant font-body text-body hover:text-primary transition-colors" href="{{ route('community') }}">Communauté</a>
            <a class="text-on-surface-variant font-body text-body hover:text-primary transition-colors" href="{{ route('help') }}">Aide</a>
            
            @auth
                <a href="{{ route('dashboard') }}" class="text-on-surface-variant font-body text-body hover:text-primary transition-colors flex items-center gap-2">
                    <span class="material-symbols-outlined">dashboard</span>
                    Dashboard
                </a>
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit" class="text-on-surface-variant hover:text-error transition-colors text-body flex items-center gap-2">
                        <span class="material-symbols-outlined">logout</span>
                        Déconnexion
                    </button>
                </form>
            @else
                <a href="{{ route('login') }}" class="text-on-surface-variant font-body text-body hover:text-primary transition-colors">Connexion</a>
                <a href="{{ route('register') }}" class="bg-primary text-on-primary px-6 py-2.5 rounded-full font-label text-center hover:bg-primary-container transition-all">
                    Essai gratuit
                </a>
            @endauth
        </div>
    </div>
</header>

<script>
    // Toggle mobile menu
    document.addEventListener('DOMContentLoaded', function() {
        const mobileBtn = document.getElementById('mobileMenuBtn');
        const mobileMenu = document.getElementById('mobileMenu');
        
        if (mobileBtn && mobileMenu) {
            mobileBtn.addEventListener('click', function(e) {
                e.stopPropagation();
                mobileMenu.classList.toggle('hidden');
            });

            // Fermer le menu en cliquant ailleurs
            document.addEventListener('click', function(event) {
                if (!mobileMenu.classList.contains('hidden')) {
                    if (!mobileMenu.contains(event.target) && !mobileBtn.contains(event.target)) {
                        mobileMenu.classList.add('hidden');
                    }
                }
            });
        }
    });

    // Header scroll effect - Ajouter une ombre quand on scroll
    window.addEventListener('scroll', () => {
        const header = document.querySelector('header');
        if (window.scrollY > 20) {
            header.classList.add('shadow-md');
        } else {
            header.classList.remove('shadow-md');
        }
    });
</script>