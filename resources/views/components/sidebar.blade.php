<!-- Sidebar Navigation -->
<aside class="fixed left-0 top-0 h-full flex flex-col p-4 z-40 bg-surface-container-lowest dark:bg-inverse-surface border-r border-outline-variant dark:border-outline w-64 hidden md:flex">
    <div class="mb-8">
        <h1 class="font-h3 text-h3 text-primary dark:text-primary-fixed-dim font-bold">NEARSEO</h1>
        <p class="text-xs text-on-surface-variant opacity-70">Expert SEO Local</p>
    </div>
    
    <nav class="flex-1 flex flex-col gap-2">
        <a href="{{ route('dashboard') }}" class="flex items-center gap-stack-gap-md px-4 py-3 rounded-xl transition-all {{ request()->routeIs('dashboard') ? 'bg-secondary-container dark:bg-on-secondary-fixed-variant text-on-secondary-container dark:text-secondary-fixed font-semibold' : 'text-on-surface-variant dark:text-surface-variant hover:bg-surface-container-low dark:hover:bg-surface-container-high' }}">
            <span class="material-symbols-outlined {{ request()->routeIs('dashboard') ? 'filled-icon' : '' }}">dashboard</span>
            <span>Tableau de bord</span>
        </a>
        
        <a href="{{ route('articles.index') }}" class="flex items-center gap-stack-gap-md px-4 py-3 rounded-xl transition-all {{ request()->routeIs('articles.*') ? 'bg-secondary-container dark:bg-on-secondary-fixed-variant text-on-secondary-container dark:text-secondary-fixed font-semibold' : 'text-on-surface-variant dark:text-surface-variant hover:bg-surface-container-low dark:hover:bg-surface-container-high' }}">
            <span class="material-symbols-outlined {{ request()->routeIs('articles.*') ? 'filled-icon' : '' }}">description</span>
            <span>Articles</span>
        </a>
        
        <a href="{{ route('ai.create') }}" class="flex items-center gap-stack-gap-md px-4 py-3 rounded-xl transition-all {{ request()->routeIs('ai.*') ? 'bg-secondary-container dark:bg-on-secondary-fixed-variant text-on-secondary-container dark:text-secondary-fixed font-semibold' : 'text-on-surface-variant dark:text-surface-variant hover:bg-surface-container-low dark:hover:bg-surface-container-high' }}">
            <span class="material-symbols-outlined {{ request()->routeIs('ai.*') ? 'filled-icon' : '' }}">auto_awesome</span>
            <span>Outils IA</span>
        </a>
        
        <a href="#" class="flex items-center gap-stack-gap-md px-4 py-3 rounded-xl transition-all text-on-surface-variant dark:text-surface-variant hover:bg-surface-container-low dark:hover:bg-surface-container-high">
            <span class="material-symbols-outlined">groups</span>
            <span>Communauté</span>
        </a>
        
        <a href="{{ route('geo.index') }}" class="flex items-center gap-stack-gap-md px-4 py-3 rounded-xl transition-all {{ request()->routeIs('geo.*') ? 'bg-secondary-container dark:bg-on-secondary-fixed-variant text-on-secondary-container dark:text-secondary-fixed font-semibold' : 'text-on-surface-variant dark:text-surface-variant hover:bg-surface-container-low dark:hover:bg-surface-container-high' }}">
            <span class="material-symbols-outlined {{ request()->routeIs('geo.*') ? 'filled-icon' : '' }}" style="{{ request()->routeIs('geo.*') ? 'font-variation-settings: \'FILL\' 1;' : '' }}">distance</span>
            <span>Géolocalisation</span>
        </a>
        
        <a href="{{ route('profile.edit') }}" class="flex items-center gap-stack-gap-md px-4 py-3 rounded-xl transition-all {{ request()->routeIs('profile.*') ? 'bg-secondary-container dark:bg-on-secondary-fixed-variant text-on-secondary-container dark:text-secondary-fixed font-semibold' : 'text-on-surface-variant dark:text-surface-variant hover:bg-surface-container-low dark:hover:bg-surface-container-high' }}">
            <span class="material-symbols-outlined {{ request()->routeIs('profile.*') ? 'filled-icon' : '' }}">account_circle</span>
            <span>Profil</span>
        </a>
        
        <a href="{{ route('settings.index') }}" class="flex items-center gap-stack-gap-md px-4 py-3 rounded-xl transition-all {{ request()->routeIs('settings.*') ? 'bg-secondary-container dark:bg-on-secondary-fixed-variant text-on-secondary-container dark:text-secondary-fixed font-semibold' : 'text-on-surface-variant dark:text-surface-variant hover:bg-surface-container-low dark:hover:bg-surface-container-high' }}">
            <span class="material-symbols-outlined {{ request()->routeIs('settings.*') ? 'filled-icon' : '' }}">settings</span>
            <span>Paramètres</span>
        </a>
    </nav>
    
    <div class="mt-auto border-t border-outline-variant pt-4 flex flex-col gap-2">
        <a href="#" class="flex items-center gap-stack-gap-md text-on-surface-variant dark:text-surface-variant px-4 py-3 hover:bg-surface-container-low transition-all rounded-xl">
            <span class="material-symbols-outlined">help_outline</span>
            <span>Aide</span>
        </a>
        
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="w-full flex items-center gap-stack-gap-md text-on-surface-variant dark:text-surface-variant px-4 py-3 hover:bg-surface-container-low transition-all rounded-xl">
                <span class="material-symbols-outlined">logout</span>
                <span>Déconnexion</span>
            </button>
        </form>
    </div>
</aside>