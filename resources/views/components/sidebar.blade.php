<aside class="fixed left-0 top-0 h-full flex flex-col z-40 bg-white dark:bg-inverse-surface border-r border-gray-200 dark:border-gray-700 w-64 hidden md:flex select-none">
    
    <!-- Logo Section - EN HAUT avec alignement à gauche comme les menus -->
    <div class="flex items-center w-full px-3 py-2 shrink-0 border-b border-gray-200 dark:border-gray-700">
        <img src="{{ asset('logo.png') }}" 
             alt="NEARSEO Logo" 
             class="h-14 w-auto object-contain"
             onerror="this.src='{{ asset('images/logo.png') }}'">
    </div>
    
    <!-- Navigation Section -->
    <nav class="flex-1 flex flex-col gap-1.5 overflow-y-auto overflow-x-hidden scrollbar-none hover:scrollbar-thin transition-all">
        <!-- Dashboard -->
        <a href="{{ route('dashboard') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all {{ request()->routeIs('dashboard') ? 'bg-secondary-container dark:bg-on-secondary-fixed-variant text-on-secondary-container dark:text-secondary-fixed font-semibold' : 'text-on-surface-variant dark:text-surface-variant hover:bg-surface-container-low dark:hover:bg-surface-container-high' }}">
            <span class="material-symbols-outlined !text-[22px]">dashboard</span>
            <span class="truncate">Tableau de bord</span>
        </a>
       
        <!-- Trends (Nouveau) -->
        <a href="{{ route('trends.index') }}" 
           class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all {{ request()->routeIs('trends.*') ? 'bg-secondary-container dark:bg-on-secondary-fixed-variant text-on-secondary-container dark:text-secondary-fixed font-semibold' : 'text-on-surface-variant dark:text-surface-variant hover:bg-surface-container-low dark:hover:bg-surface-container-high' }}">
            <span class="material-symbols-outlined !text-[22px]">trending_up</span>
            <span class="truncate">Tendances</span>
        </a>
        
        <!-- Content Strategy -->
        <a href="{{ route('ai.create') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all {{ request()->routeIs('ai.*') ? 'bg-secondary-container dark:bg-on-secondary-fixed-variant text-on-secondary-container dark:text-secondary-fixed font-semibold' : 'text-on-surface-variant dark:text-surface-variant hover:bg-surface-container-low dark:hover:bg-surface-container-high' }}">
            <span class="material-symbols-outlined !text-[22px]">edit_note</span>
            <span class="truncate">Stratégie de contenu</span>
        </a>
        
        <!-- Articles -->
        <a href="{{ route('articles.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all {{ request()->routeIs('articles.*') ? 'bg-secondary-container dark:bg-on-secondary-fixed-variant text-on-secondary-container dark:text-secondary-fixed font-semibold' : 'text-on-surface-variant dark:text-surface-variant hover:bg-surface-container-low dark:hover:bg-surface-container-high' }}">
            <span class="material-symbols-outlined !text-[22px]">description</span>
            <span class="truncate">Articles</span>
        </a>
        
        <!-- Communauté -->
        <a href="{{ route('community') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all {{ request()->routeIs('community') ? 'bg-secondary-container dark:bg-on-secondary-fixed-variant text-on-secondary-container dark:text-secondary-fixed font-semibold' : 'text-on-surface-variant dark:text-surface-variant hover:bg-surface-container-low dark:hover:bg-surface-container-high' }}">
            <span class="material-symbols-outlined !text-[22px]">groups</span>
            <span class="truncate">Communauté</span>
        </a>
        
        <!-- Géo -->
        <a href="{{ route('geo.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all {{ request()->routeIs('geo.*') ? 'bg-secondary-container dark:bg-on-secondary-fixed-variant text-on-secondary-container dark:text-secondary-fixed font-semibold' : 'text-on-surface-variant dark:text-surface-variant hover:bg-surface-container-low dark:hover:bg-surface-container-high' }}">
            <span class="material-symbols-outlined !text-[22px]">distance</span>
            <span class="truncate">Géolocalisation</span>
        </a>
        
        <!-- Blog -->
        @auth
        <a href="{{ route('blog.user', auth()->user()->blogSlug) }}" 
           class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all {{ request()->routeIs('blog.user*') ? 'bg-secondary-container dark:bg-on-secondary-fixed-variant text-on-secondary-container dark:text-secondary-fixed font-semibold' : 'text-on-surface-variant dark:text-surface-variant hover:bg-surface-container-low dark:hover:bg-surface-container-high' }}">
            <span class="material-symbols-outlined !text-[22px]">feed</span>
            <span class="truncate">Mon Blog</span>
        </a>
        @endauth
        
        <!-- Profil -->
        <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all {{ request()->routeIs('profile.*') ? 'bg-secondary-container dark:bg-on-secondary-fixed-variant text-on-secondary-container dark:text-secondary-fixed font-semibold' : 'text-on-surface-variant dark:text-surface-variant hover:bg-surface-container-low dark:hover:bg-surface-container-high' }}">
            <span class="material-symbols-outlined !text-[22px]">account_circle</span>
            <span class="truncate">Profil</span>
        </a>
        
        <!-- Paramètres -->
        <a href="{{ route('settings.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all {{ request()->routeIs('settings.*') ? 'bg-secondary-container dark:bg-on-secondary-fixed-variant text-on-secondary-container dark:text-secondary-fixed font-semibold' : 'text-on-surface-variant dark:text-surface-variant hover:bg-surface-container-low dark:hover:bg-surface-container-high' }}">
            <span class="material-symbols-outlined !text-[22px]">settings</span>
            <span class="truncate">Paramètres</span>
        </a>
    </nav>

    <!-- Footer Section -->
    <div class="border-t border-outline-variant pt-4 mt-2 flex flex-col gap-1.5 shrink-0">
        <!-- Aide -->
        <a href="{{ route('help') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all text-on-surface-variant dark:text-surface-variant hover:bg-surface-container-low dark:hover:bg-surface-container-high">
            <span class="material-symbols-outlined !text-[22px]">help_outline</span>
            <span class="truncate">Aide</span>
        </a>
        
        <!-- Déconnexion -->
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="w-full flex items-center gap-3 px-4 py-3 rounded-xl transition-all text-on-surface-variant dark:text-surface-variant hover:bg-surface-container-low dark:hover:bg-surface-container-high">
                <span class="material-symbols-outlined !text-[22px]">logout</span>
                <span class="truncate">Déconnexion</span>
            </button>
        </form>
    </div>
</aside>