@extends('layouts.app')

@section('title', 'Paramètres administrateur')
@section('header-title', 'Paramètres administrateur')

@section('content')
<div class="bg-white rounded-xl shadow-sm p-6">
    <h2 class="text-xl font-semibold mb-6">Configuration de la plateforme</h2>
    
    <form id="adminSettingsForm">
        @csrf
        @method('PUT')
        
        <div class="space-y-6">
            <!-- Paramètres généraux -->
            <div class="border-b pb-4">
                <h3 class="font-medium mb-4">Paramètres généraux</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium mb-1">Nom de la plateforme</label>
                        <input type="text" id="platformName" name="platform_name" value="{{ $settings['platform_name'] ?? 'NEARSEO' }}" class="w-full border rounded-lg px-4 py-2 focus:ring-1 focus:ring-primary focus:border-primary outline-none">
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-1">Email de contact</label>
                        <input type="email" id="contactEmail" name="contact_email" value="{{ $settings['contact_email'] ?? 'contact@nearseo.com' }}" class="w-full border rounded-lg px-4 py-2 focus:ring-1 focus:ring-primary focus:border-primary outline-none">
                    </div>
                </div>
            </div>
            
            <!-- Langues disponibles -->
            <div class="border-b pb-4">
                <h3 class="font-medium mb-4">Langues disponibles</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium mb-1">Langue par défaut</label>
                        <select id="defaultLanguage" name="default_language" class="w-full border rounded-lg px-4 py-2 focus:ring-1 focus:ring-primary focus:border-primary outline-none">
                            <option value="fr" {{ ($settings['default_language'] ?? 'fr') == 'fr' ? 'selected' : '' }}>Français</option>
                            <option value="en" {{ ($settings['default_language'] ?? 'fr') == 'en' ? 'selected' : '' }}>English</option>
                            <option value="es" {{ ($settings['default_language'] ?? 'fr') == 'es' ? 'selected' : '' }}>Español</option>
                            <option value="ar" {{ ($settings['default_language'] ?? 'fr') == 'ar' ? 'selected' : '' }}>العربية</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-1">Langues activées</label>
                        <div class="space-y-2">
                            <label class="flex items-center gap-2">
                                <input type="checkbox" name="languages[]" value="fr" {{ in_array('fr', $settings['languages'] ?? ['fr', 'en']) ? 'checked' : '' }} class="rounded border-gray-300 text-primary focus:ring-primary">
                                <span>Français</span>
                            </label>
                            <label class="flex items-center gap-2">
                                <input type="checkbox" name="languages[]" value="en" {{ in_array('en', $settings['languages'] ?? ['fr', 'en']) ? 'checked' : '' }} class="rounded border-gray-300 text-primary focus:ring-primary">
                                <span>English</span>
                            </label>
                            <label class="flex items-center gap-2">
                                <input type="checkbox" name="languages[]" value="es" {{ in_array('es', $settings['languages'] ?? []) ? 'checked' : '' }} class="rounded border-gray-300 text-primary focus:ring-primary">
                                <span>Español</span>
                            </label>
                            <label class="flex items-center gap-2">
                                <input type="checkbox" name="languages[]" value="ar" {{ in_array('ar', $settings['languages'] ?? []) ? 'checked' : '' }} class="rounded border-gray-300 text-primary focus:ring-primary">
                                <span>العربية</span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Traductions -->
            <div class="border-b pb-4">
                <h3 class="font-medium mb-4">Traductions personnalisées</h3>
                <div class="space-y-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium mb-1">Titre site (Français)</label>
                            <input type="text" id="titleFr" name="translations[fr][site_title]" value="{{ $settings['translations']['fr']['site_title'] ?? 'NEARSEO - Le SEO local propulsé par l\'IA' }}" class="w-full border rounded-lg px-4 py-2">
                        </div>
                        <div>
                            <label class="block text-sm font-medium mb-1">Site Title (English)</label>
                            <input type="text" id="titleEn" name="translations[en][site_title]" value="{{ $settings['translations']['en']['site_title'] ?? 'NEARSEO - Local SEO powered by AI' }}" class="w-full border rounded-lg px-4 py-2">
                        </div>
                        <div>
                            <label class="block text-sm font-medium mb-1">Bienvenue (Français)</label>
                            <input type="text" id="welcomeFr" name="translations[fr][welcome]" value="{{ $settings['translations']['fr']['welcome'] ?? 'Bon retour !' }}" class="w-full border rounded-lg px-4 py-2">
                        </div>
                        <div>
                            <label class="block text-sm font-medium mb-1">Welcome (English)</label>
                            <input type="text" id="welcomeEn" name="translations[en][welcome]" value="{{ $settings['translations']['en']['welcome'] ?? 'Welcome back!' }}" class="w-full border rounded-lg px-4 py-2">
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Limites par plan -->
            <div class="border-b pb-4">
                <h3 class="font-medium mb-4">Limites par plan</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-sm font-medium mb-1">Gratuit (articles/mois)</label>
                        <input type="number" id="freeLimit" name="plan_limits[free]" value="{{ $settings['plan_limits']['free'] ?? 5 }}" class="w-full border rounded-lg px-4 py-2">
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-1">Pro (articles/mois)</label>
                        <input type="number" id="proLimit" name="plan_limits[pro]" value="{{ $settings['plan_limits']['pro'] ?? 50 }}" class="w-full border rounded-lg px-4 py-2">
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-1">Business (articles/mois)</label>
                        <input type="number" id="businessLimit" name="plan_limits[business]" value="{{ $settings['plan_limits']['business'] ?? 999 }}" class="w-full border rounded-lg px-4 py-2">
                    </div>
                </div>
            </div>
            
            <!-- Boutons -->
            <div class="flex justify-end gap-3">
                <button type="button" onclick="resetSettings()" class="px-6 py-2 border border-gray-300 rounded-lg hover:bg-gray-50 transition">Annuler</button>
                <button type="submit" class="bg-primary text-white px-6 py-2 rounded-lg hover:opacity-90 transition">Enregistrer</button>
            </div>
        </div>
    </form>
</div>

<!-- Message de notification -->
<div id="notificationMessage" class="fixed bottom-4 right-4 bg-green-500 text-white px-4 py-2 rounded-lg shadow-lg hidden transition-opacity z-50">
    Paramètres enregistrés avec succès !
</div>
@endsection

@push('scripts')
<script>
    // Récupérer les paramètres depuis le localStorage
    function loadSettings() {
        const savedSettings = localStorage.getItem('nearseo_admin_settings');
        if (savedSettings) {
            const settings = JSON.parse(savedSettings);
            
            document.getElementById('platformName').value = settings.platform_name || 'NEARSEO';
            document.getElementById('contactEmail').value = settings.contact_email || 'contact@nearseo.com';
            document.getElementById('defaultLanguage').value = settings.default_language || 'fr';
            document.getElementById('freeLimit').value = settings.plan_limits?.free || 5;
            document.getElementById('proLimit').value = settings.plan_limits?.pro || 50;
            document.getElementById('businessLimit').value = settings.plan_limits?.business || 999;
            
            if (settings.titleFr) document.getElementById('titleFr').value = settings.titleFr;
            if (settings.titleEn) document.getElementById('titleEn').value = settings.titleEn;
            if (settings.welcomeFr) document.getElementById('welcomeFr').value = settings.welcomeFr;
            if (settings.welcomeEn) document.getElementById('welcomeEn').value = settings.welcomeEn;
        }
    }
    
    // Sauvegarder les paramètres
    async function saveAdminSettings(data) {
        try {
            const response = await fetch('{{ route("admin.settings.update") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify(data)
            });
            
            if (response.ok) {
                // Sauvegarder aussi dans localStorage
                localStorage.setItem('nearseo_admin_settings', JSON.stringify(data));
                
                // Afficher la notification
                const notification = document.getElementById('notificationMessage');
                notification.classList.remove('hidden');
                setTimeout(() => {
                    notification.classList.add('hidden');
                }, 3000);
                
                return true;
            }
        } catch (error) {
            console.error('Error saving settings:', error);
            alert('Erreur lors de l\'enregistrement');
        }
        return false;
    }
    
    // Réinitialiser les paramètres
    function resetSettings() {
        if (confirm('Réinitialiser tous les paramètres ?')) {
            localStorage.removeItem('nearseo_admin_settings');
            location.reload();
        }
    }
    
    // Changer la langue de l'interface en temps réel
    function changeUILanguage(lang) {
        // Sauvegarder la langue préférée de l'utilisateur
        localStorage.setItem('nearseo_user_language', lang);
        
        // Recharger la page pour appliquer la langue
        location.reload();
    }
    
    // Appliquer la langue sauvegardée au chargement
    function applySavedLanguage() {
        const savedLang = localStorage.getItem('nearseo_user_language');
        if (savedLang && savedLang !== 'fr') {
            // Changer la langue de l'interface (implémentation selon votre système)
            console.log('Langue utilisateur:', savedLang);
        }
    }
    
    // Formulaire d'envoi
    document.getElementById('adminSettingsForm').addEventListener('submit', async function(e) {
        e.preventDefault();
        
        // Récupérer les langues sélectionnées
        const selectedLanguages = [];
        document.querySelectorAll('input[name="languages[]"]:checked').forEach(cb => {
            selectedLanguages.push(cb.value);
        });
        
        const formData = {
            platform_name: document.getElementById('platformName').value,
            contact_email: document.getElementById('contactEmail').value,
            default_language: document.getElementById('defaultLanguage').value,
            languages: selectedLanguages,
            plan_limits: {
                free: parseInt(document.getElementById('freeLimit').value),
                pro: parseInt(document.getElementById('proLimit').value),
                business: parseInt(document.getElementById('businessLimit').value)
            },
            translations: {
                fr: {
                    site_title: document.getElementById('titleFr').value,
                    welcome: document.getElementById('welcomeFr').value
                },
                en: {
                    site_title: document.getElementById('titleEn').value,
                    welcome: document.getElementById('welcomeEn').value
                }
            }
        };
        
        await saveAdminSettings(formData);
    });
    
    // Charger les paramètres au démarrage
    loadSettings();
    applySavedLanguage();
    
    // Témoin de changement de langue (démo)
    const langSelect = document.getElementById('defaultLanguage');
    if (langSelect) {
        langSelect.addEventListener('change', function() {
            const demoMessage = document.getElementById('notificationMessage');
            demoMessage.textContent = 'Langue par défaut changée. Rafraîchissez la page pour voir les effets.';
            demoMessage.classList.remove('hidden', 'bg-green-500');
            demoMessage.classList.add('bg-blue-500');
            setTimeout(() => {
                demoMessage.classList.add('hidden');
                demoMessage.classList.remove('bg-blue-500');
                demoMessage.classList.add('bg-green-500');
                demoMessage.textContent = 'Paramètres enregistrés avec succès !';
            }, 3000);
        });
    }
</script>
@endpush