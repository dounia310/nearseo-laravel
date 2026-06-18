<!-- Preferences Section -->
<div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-6">
    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-6 flex items-center gap-2">
        <span class="material-symbols-outlined text-primary">settings_brightness</span>
        Préférences
    </h3>
    
    <form id="preferencesForm" method="POST" action="{{ route('settings.preferences.update') }}">
        @csrf
        @method('PUT')
        
        <!-- Langue -->
        <div class="mb-6">
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                🌐 Langue de l'interface
            </label>
            <select name="language" id="languageSelect" 
                    class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition">
                <option value="fr" {{ auth()->user()->preferences['language'] ?? 'fr' === 'fr' ? 'selected' : '' }}>
                    🇫🇷 Français
                </option>
                <option value="en" {{ auth()->user()->preferences['language'] ?? 'fr' === 'en' ? 'selected' : '' }}>
                    🇬🇧 English
                </option>
                <option value="ar" {{ auth()->user()->preferences['language'] ?? 'fr' === 'ar' ? 'selected' : '' }}>
                    🇸🇦 العربية
                </option>
                <option value="es" {{ auth()->user()->preferences['language'] ?? 'fr' === 'es' ? 'selected' : '' }}>
                    🇪🇸 Español
                </option>
            </select>
            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                Choisissez la langue de l'interface
            </p>
        </div>
        
        <!-- Thème -->
        <div class="mb-6">
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-3">
                🎨 Thème de l'application
            </label>
            <div class="grid grid-cols-3 gap-3">
                <!-- Thème Clair -->
                <button type="button" 
                        onclick="setTheme('light')"
                        class="theme-option flex flex-col items-center gap-2 p-4 border-2 rounded-xl transition-all {{ auth()->user()->preferences['theme'] ?? 'light' === 'light' ? 'border-primary bg-primary/5' : 'border-gray-200 dark:border-gray-600 hover:border-gray-300 dark:hover:border-gray-500' }}">
                    <span class="material-symbols-outlined text-3xl text-yellow-500">light_mode</span>
                    <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Clair</span>
                    <span class="text-xs text-gray-400">light_mode</span>
                </button>
                
                <!-- Thème Sombre -->
                <button type="button" 
                        onclick="setTheme('dark')"
                        class="theme-option flex flex-col items-center gap-2 p-4 border-2 rounded-xl transition-all {{ auth()->user()->preferences['theme'] ?? 'light' === 'dark' ? 'border-primary bg-primary/5' : 'border-gray-200 dark:border-gray-600 hover:border-gray-300 dark:hover:border-gray-500' }}">
                    <span class="material-symbols-outlined text-3xl text-indigo-400">dark_mode</span>
                    <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Sombre</span>
                    <span class="text-xs text-gray-400">dark_mode</span>
                </button>
                
                <!-- Thème Système -->
                <button type="button" 
                        onclick="setTheme('system')"
                        class="theme-option flex flex-col items-center gap-2 p-4 border-2 rounded-xl transition-all {{ auth()->user()->preferences['theme'] ?? 'light' === 'system' ? 'border-primary bg-primary/5' : 'border-gray-200 dark:border-gray-600 hover:border-gray-300 dark:hover:border-gray-500' }}">
                    <span class="material-symbols-outlined text-3xl text-purple-400">settings_brightness</span>
                    <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Système</span>
                    <span class="text-xs text-gray-400">settings_brightness</span>
                </button>
            </div>
            <p class="text-xs text-gray-500 dark:text-gray-400 mt-2">
                Choisissez entre mode clair, sombre ou automatique selon votre système
            </p>
        </div>
        
        <!-- Notifications -->
        <div class="mb-6">
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-3">
                🔔 Notifications
            </label>
            <div class="space-y-3">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-700 dark:text-gray-300">Notifications par email</p>
                        <p class="text-xs text-gray-500 dark:text-gray-400">Recevoir des notifications par email</p>
                    </div>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" name="email_notifications" value="1" 
                               {{ auth()->user()->preferences['email_notifications'] ?? true ? 'checked' : '' }}
                               class="sr-only peer">
                        <div class="w-11 h-6 bg-gray-200 dark:bg-gray-600 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-primary"></div>
                    </label>
                </div>
                
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-700 dark:text-gray-300">Notifications push</p>
                        <p class="text-xs text-gray-500 dark:text-gray-400">Recevoir des notifications dans le navigateur</p>
                    </div>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" name="push_notifications" value="1" 
                               {{ auth()->user()->preferences['push_notifications'] ?? true ? 'checked' : '' }}
                               class="sr-only peer">
                        <div class="w-11 h-6 bg-gray-200 dark:bg-gray-600 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-primary"></div>
                    </label>
                </div>
            </div>
        </div>
        
        <!-- Bouton de sauvegarde -->
        <div class="flex justify-end pt-4 border-t border-gray-200 dark:border-gray-700">
            <button type="submit" 
                    class="px-6 py-2 bg-primary text-white rounded-lg hover:bg-primary/90 transition flex items-center gap-2">
                <span class="material-symbols-outlined text-sm">save</span>
                Enregistrer les préférences
            </button>
        </div>
    </form>
</div>

<script>
// ============================================
// GESTION DU THÈME
// ============================================

function setTheme(theme) {
    // Mettre à jour l'interface
    document.querySelectorAll('.theme-option').forEach(btn => {
        btn.classList.remove('border-primary', 'bg-primary/5');
        btn.classList.add('border-gray-200', 'dark:border-gray-600');
    });
    
    const selectedBtn = document.querySelector(`.theme-option:has(.material-symbols-outlined:contains('${theme === 'light' ? 'light_mode' : theme === 'dark' ? 'dark_mode' : 'settings_brightness'}'))`);
    if (selectedBtn) {
        selectedBtn.classList.remove('border-gray-200', 'dark:border-gray-600');
        selectedBtn.classList.add('border-primary', 'bg-primary/5');
    }
    
    // Appliquer le thème
    if (theme === 'dark') {
        document.documentElement.classList.add('dark');
        document.documentElement.classList.remove('light');
        localStorage.setItem('theme', 'dark');
    } else if (theme === 'light') {
        document.documentElement.classList.remove('dark');
        document.documentElement.classList.add('light');
        localStorage.setItem('theme', 'light');
    } else {
        // Système
        localStorage.removeItem('theme');
        if (window.matchMedia('(prefers-color-scheme: dark)').matches) {
            document.documentElement.classList.add('dark');
            document.documentElement.classList.remove('light');
        } else {
            document.documentElement.classList.remove('dark');
            document.documentElement.classList.add('light');
        }
    }
    
    // Sauvegarder via AJAX
    fetch('{{ route("settings.theme.update") }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify({ theme: theme })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            showToast('✅ Thème mis à jour avec succès !');
        }
    })
    .catch(err => {
        console.error('Erreur:', err);
    });
}

// ============================================
// GESTION DE LA LANGUE
// ============================================

document.getElementById('languageSelect')?.addEventListener('change', function() {
    const lang = this.value;
    
    fetch('{{ route("settings.language.update") }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify({ language: lang })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            showToast('✅ Langue mise à jour !');
            setTimeout(() => window.location.reload(), 1000);
        }
    })
    .catch(err => {
        console.error('Erreur:', err);
        showToast('❌ Erreur lors du changement de langue');
    });
});

// ============================================
// TOAST NOTIFICATION
// ============================================

function showToast(message) {
    const toast = document.createElement('div');
    toast.textContent = message;
    const isSuccess = message.includes('✅');
    toast.style.cssText = `
        position: fixed;
        bottom: 20px;
        right: 20px;
        background: ${isSuccess ? '#10B981' : '#EF4444'};
        color: white;
        padding: 12px 24px;
        border-radius: 12px;
        z-index: 9999;
        font-size: 14px;
        font-weight: 500;
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        animation: slideIn 0.3s ease-out;
        max-width: 400px;
    `;
    document.body.appendChild(toast);
    
    setTimeout(() => {
        toast.style.opacity = '0';
        toast.style.transition = 'opacity 0.3s';
        setTimeout(() => toast.remove(), 300);
    }, 3000);
}

// ============================================
// CHARGEMENT INITIAL DU THÈME
// ============================================

document.addEventListener('DOMContentLoaded', function() {
    // Récupérer le thème sauvegardé
    const savedTheme = localStorage.getItem('theme');
    
    if (savedTheme === 'dark') {
        document.documentElement.classList.add('dark');
        document.documentElement.classList.remove('light');
    } else if (savedTheme === 'light') {
        document.documentElement.classList.remove('dark');
        document.documentElement.classList.add('light');
    } else if (savedTheme === 'system') {
        if (window.matchMedia('(prefers-color-scheme: dark)').matches) {
            document.documentElement.classList.add('dark');
            document.documentElement.classList.remove('light');
        } else {
            document.documentElement.classList.remove('dark');
            document.documentElement.classList.add('light');
        }
    }
    
    // Mettre à jour les boutons de thème
    const currentTheme = savedTheme || 'light';
    document.querySelectorAll('.theme-option').forEach(btn => {
        const icon = btn.querySelector('.material-symbols-outlined')?.textContent;
        if ((currentTheme === 'light' && icon === 'light_mode') ||
            (currentTheme === 'dark' && icon === 'dark_mode') ||
            (currentTheme === 'system' && icon === 'settings_brightness')) {
            btn.classList.remove('border-gray-200', 'dark:border-gray-600');
            btn.classList.add('border-primary', 'bg-primary/5');
        }
    });
});
</script>

<style>
/* Animation pour les boutons de thème */
.theme-option {
    transition: all 0.3s ease;
    cursor: pointer;
}

.theme-option:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
}

.theme-option:active {
    transform: scale(0.95);
}

/* Switch toggle personnalisé */
.peer:checked + .peer ~ .peer-checked\:bg-primary {
    background-color: #A24E29;
}

/* Dark mode support */
.dark .theme-option {
    border-color: #374151;
}

.dark .theme-option:hover {
    border-color: #6B7280;
}

/* Toast animation */
@keyframes slideIn {
    from {
        opacity: 0;
        transform: translateX(20px);
    }
    to {
        opacity: 1;
        transform: translateX(0);
    }
}
</style>