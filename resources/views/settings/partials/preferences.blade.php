<div class="bg-surface-container-lowest border border-outline-variant rounded-xl p-6">
    <div class="flex items-center gap-4 mb-6">
        <div class="w-16 h-16 rounded-full bg-tertiary-fixed flex items-center justify-center">
            <span class="material-symbols-outlined text-3xl text-tertiary">settings</span>
        </div>
        <div>
            <h3 class="font-h2 text-h2 text-on-surface">Préférences</h3>
            <p class="text-body-sm text-on-surface-variant">Personnalisez votre expérience</p>
        </div>
    </div>
    
    <div class="space-y-6">
        <div>
            <label class="block font-label text-label text-on-surface-variant mb-2">Langue de l'interface</label>
            <select id="languageSelect" class="w-64 border border-outline-variant rounded-lg px-4 py-2 focus:ring-1 focus:ring-primary focus:border-primary outline-none">
                <option value="fr" {{ (Auth::user()->settings['language'] ?? 'fr') == 'fr' ? 'selected' : '' }}>Français</option>
                <option value="en" {{ (Auth::user()->settings['language'] ?? 'fr') == 'en' ? 'selected' : '' }}>English</option>
                <option value="ar" {{ (Auth::user()->settings['language'] ?? 'fr') == 'ar' ? 'selected' : '' }}>العربية</option>
            </select>
        </div>
        
        <div>
            <label class="block font-label text-label text-on-surface-variant mb-2">Thème de l'application</label>
            <div class="flex gap-3">
                <button onclick="setTheme('light')" class="theme-btn px-4 py-2 border rounded-lg flex items-center gap-2 {{ (Auth::user()->settings['theme'] ?? 'light') == 'light' ? 'border-primary bg-primary-fixed' : 'border-outline-variant' }}">
                    <span class="material-symbols-outlined">light_mode</span> Clair
                </button>
                <button onclick="setTheme('dark')" class="theme-btn px-4 py-2 border rounded-lg flex items-center gap-2 {{ (Auth::user()->settings['theme'] ?? 'light') == 'dark' ? 'border-primary bg-primary-fixed' : 'border-outline-variant' }}">
                    <span class="material-symbols-outlined">dark_mode</span> Sombre
                </button>
                <button onclick="setTheme('auto')" class="theme-btn px-4 py-2 border rounded-lg flex items-center gap-2 {{ (Auth::user()->settings['theme'] ?? 'light') == 'auto' ? 'border-primary bg-primary-fixed' : 'border-outline-variant' }}">
                    <span class="material-symbols-outlined">settings_brightness</span> Auto
                </button>
            </div>
        </div>
    </div>
</div>

<script>
function setTheme(theme) {
    fetch('{{ route("settings.theme") }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify({ theme: theme })
    });
    
    if (theme === 'dark') {
        document.documentElement.classList.add('dark');
    } else if (theme === 'light') {
        document.documentElement.classList.remove('dark');
    } else {
        const isDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
        if (isDark) document.documentElement.classList.add('dark');
        else document.documentElement.classList.remove('dark');
    }
    
    document.querySelectorAll('.theme-btn').forEach(btn => {
        btn.classList.remove('border-primary', 'bg-primary-fixed');
        btn.classList.add('border-outline-variant');
    });
    event.target.closest('.theme-btn').classList.add('border-primary', 'bg-primary-fixed');
}

document.getElementById('languageSelect')?.addEventListener('change', function() {
    fetch('{{ route("settings.update") }}', {
        method: 'PUT',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify({ language: this.value })
    }).then(() => location.reload());
});
</script>