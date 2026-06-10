@extends('layouts.app')

@section('title', 'Paramètres')
@section('header-title', 'Paramètres')

@section('content')
<div class="max-w-7xl mx-auto">
    <!-- Page Header -->
    <div class="mb-8">
        <p class="text-gray-600">Gérez vos préférences de compte, les configurations de votre blog et votre abonnement.</p>
    </div>

    <!-- Horizontal Tabs -->
    <div class="flex border-b mb-8 overflow-x-auto gap-8">
        <button class="tab-btn pb-4 px-2 font-medium transition-all active-tab" data-tab="general">Général</button>
        <button class="tab-btn pb-4 px-2 font-medium text-gray-500 hover:text-primary transition-all" data-tab="blog">Blog</button>
        <button class="tab-btn pb-4 px-2 font-medium text-gray-500 hover:text-primary transition-all" data-tab="security">Sécurité</button>
        <button class="tab-btn pb-4 px-2 font-medium text-gray-500 hover:text-primary transition-all" data-tab="subscription">Abonnement</button>
    </div>

    <!-- GENERAL SECTION -->
    <div class="tab-section" id="section-general">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="bg-white border rounded-xl p-6 shadow-sm">
                <h3 class="font-semibold text-lg mb-6 flex items-center gap-2">
                    <span class="material-symbols-outlined text-primary">language</span>
                    Interface &amp; Langue
                </h3>
                <div class="space-y-4">
                    <div>
                        <label class="block text-xs font-bold text-gray-500 uppercase mb-2">Langue de l'interface</label>
                        <select id="languageSelect" class="w-full border rounded-lg p-3 focus:ring-1 focus:ring-primary focus:border-primary outline-none">
                            <option value="fr" {{ (Auth::user()->settings['language'] ?? 'fr') == 'fr' ? 'selected' : '' }}>Français</option>
                            <option value="en" {{ (Auth::user()->settings['language'] ?? 'fr') == 'en' ? 'selected' : '' }}>English</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-gray-500 uppercase mb-2">Thème de l'application</label>
                        <div class="grid grid-cols-3 gap-2">
                            <button type="button" onclick="setTheme('light')" class="theme-btn flex flex-col items-center gap-2 p-3 border-2 rounded-xl transition-all {{ (Auth::user()->settings['theme'] ?? 'light') == 'light' ? 'border-primary bg-orange-50' : 'border-gray-200' }}">
                                <span class="material-symbols-outlined text-primary">light_mode</span>
                                <span class="text-xs font-medium">Clair</span>
                            </button>
                            <button type="button" onclick="setTheme('dark')" class="theme-btn flex flex-col items-center gap-2 p-3 border-2 rounded-xl transition-all {{ (Auth::user()->settings['theme'] ?? 'light') == 'dark' ? 'border-primary bg-orange-50' : 'border-gray-200' }}">
                                <span class="material-symbols-outlined">dark_mode</span>
                                <span class="text-xs font-medium">Sombre</span>
                            </button>
                            <button type="button" onclick="setTheme('auto')" class="theme-btn flex flex-col items-center gap-2 p-3 border-2 rounded-xl transition-all {{ (Auth::user()->settings['theme'] ?? 'light') == 'auto' ? 'border-primary bg-orange-50' : 'border-gray-200' }}">
                                <span class="material-symbols-outlined">settings_brightness</span>
                                <span class="text-xs font-medium">Auto</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white border rounded-xl p-6 shadow-sm">
                <h3 class="font-semibold text-lg mb-6 flex items-center gap-2">
                    <span class="material-symbols-outlined text-primary">mail</span>
                    Notifications par e-mail
                </h3>
                <div class="space-y-4">
                    <div class="flex items-center justify-between py-3">
                        <div>
                            <p class="font-semibold">Rapports de performance hebdomadaires</p>
                            <p class="text-sm text-gray-500">Recevez un résumé de votre SEO local chaque lundi.</p>
                        </div>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" id="weeklyReport" class="sr-only peer" {{ (Auth::user()->settings['weekly_report'] ?? true) ? 'checked' : '' }} onchange="saveSetting('weekly_report', this.checked)">
                            <div class="w-11 h-6 bg-gray-300 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-primary"></div>
                        </label>
                    </div>
                    <div class="flex items-center justify-between py-3 border-t">
                        <div>
                            <p class="font-semibold">Alertes de sécurité</p>
                            <p class="text-sm text-gray-500">Notifications pour les nouvelles connexions suspectes.</p>
                        </div>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" id="securityAlerts" class="sr-only peer" {{ (Auth::user()->settings['security_alerts'] ?? true) ? 'checked' : '' }} onchange="saveSetting('security_alerts', this.checked)">
                            <div class="w-11 h-6 bg-gray-300 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-primary"></div>
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- BLOG SECTION -->
    <div class="tab-section hidden" id="section-blog">
        <div class="bg-white border rounded-xl p-6 shadow-sm max-w-3xl">
            <h3 class="font-semibold text-lg mb-6 flex items-center gap-2">
                <span class="material-symbols-outlined text-primary">article</span>
                Identité du Blog
            </h3>
            <div class="space-y-6">
                <div class="flex flex-col md:flex-row gap-8 items-start">
                    <div class="w-32 h-32 rounded-xl border-2 border-dashed border-gray-300 bg-gray-50 flex flex-col items-center justify-center text-center p-4 cursor-pointer hover:border-primary transition-colors group">
                        <span class="material-symbols-outlined text-gray-400 group-hover:text-primary mb-2">upload_file</span>
                        <span class="text-xs text-gray-500">Logo du Blog</span>
                    </div>
                    <div class="flex-grow space-y-4 w-full">
                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase mb-2">Nom du Blog</label>
                            <input id="blogName" class="w-full border rounded-lg p-3 focus:ring-1 focus:ring-primary focus:border-primary outline-none" type="text" value="{{ $blogSettings['name'] ?? 'Mon Blog Local Expert' }}">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase mb-2">Sous-domaine</label>
                            <div class="flex">
                                <input id="blogSubdomain" class="flex-grow border rounded-l-lg p-3 focus:ring-1 focus:ring-primary focus:border-primary outline-none" type="text" value="{{ $blogSettings['subdomain'] ?? 'monblog' }}">
                                <span class="bg-gray-100 border border-l-0 rounded-r-lg p-3 text-gray-600 text-sm flex items-center">.nearseo.com</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase mb-2">Description SEO (Meta)</label>
                    <textarea id="blogDescription" class="w-full border rounded-lg p-3 focus:ring-1 focus:ring-primary focus:border-primary outline-none" rows="3">{{ $blogSettings['description'] ?? 'Expertise locale et conseils personnalisés pour optimiser votre visibilité sur Google Maps et les moteurs de recherche.' }}</textarea>
                </div>
                <div class="flex justify-end pt-4">
                    <button type="button" onclick="saveBlogSettings()" class="px-6 py-2.5 bg-primary text-white font-semibold rounded-lg hover:opacity-90 transition-all">Enregistrer les modifications</button>
                </div>
            </div>
        </div>
    </div>

    <!-- SECURITY SECTION -->
    <div class="tab-section hidden" id="section-security">
        <div class="space-y-6">
            <div class="bg-white border rounded-xl p-6 shadow-sm max-w-3xl">
                <h3 class="font-semibold text-lg mb-6 flex items-center gap-2">
                    <span class="material-symbols-outlined text-primary">lock</span>
                    Accès et Sécurité
                </h3>
                <div class="space-y-6">
                    <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                        <div>
                            <p class="font-semibold">Authentification à deux facteurs (2FA)</p>
                            <p class="text-sm text-gray-500">Ajoutez une couche de sécurité supplémentaire à votre compte.</p>
                        </div>
                        <button type="button" onclick="enable2FA()" class="px-4 py-2 border border-primary text-primary font-semibold rounded-lg hover:bg-primary hover:text-white transition-all">Activer</button>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase mb-2">Nouveau mot de passe</label>
                            <input id="newPassword" class="w-full border rounded-lg p-3 focus:ring-1 focus:ring-primary focus:border-primary outline-none" placeholder="••••••••" type="password">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase mb-2">Confirmer le mot de passe</label>
                            <input id="confirmPassword" class="w-full border rounded-lg p-3 focus:ring-1 focus:ring-primary focus:border-primary outline-none" placeholder="••••••••" type="password">
                        </div>
                    </div>
                    <div class="flex justify-end pt-4">
                        <button type="button" onclick="updatePassword()" class="px-6 py-2.5 bg-primary text-white font-semibold rounded-lg hover:opacity-90 transition-all">Changer le mot de passe</button>
                    </div>
                </div>
            </div>

            <div class="bg-white border rounded-xl p-6 shadow-sm max-w-3xl">
                <h3 class="font-semibold text-lg mb-6 flex items-center gap-2">
                    <span class="material-symbols-outlined text-primary">devices</span>
                    Sessions actives
                </h3>
                <div class="space-y-4">
                    @foreach($sessions as $session)
                    <div class="flex items-center justify-between p-4 border rounded-lg">
                        <div class="flex items-center gap-4">
                            <div class="w-10 h-10 rounded-full bg-gray-100 flex items-center justify-center">
                                <span class="material-symbols-outlined text-primary">{{ $session['icon'] ?? 'desktop_windows' }}</span>
                            </div>
                            <div>
                                <p class="font-semibold">{{ $session['device'] }}</p>
                                <p class="text-sm text-gray-500">{{ $session['location'] }} • {{ $session['last_active'] }}</p>
                            </div>
                        </div>
                        @if($session['is_current'])
                        <span class="text-xs font-bold text-green-600">Actif</span>
                        @else
                        <button type="button" onclick="revokeSession('{{ $session['id'] }}')" class="text-red-500 text-sm hover:underline">Révoquer</button>
                        @endif
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <!-- SUBSCRIPTION SECTION -->
    <div class="tab-section hidden" id="section-subscription">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <div class="lg:col-span-1 bg-primary text-white rounded-xl p-6 shadow-lg relative overflow-hidden">
                <div class="absolute -right-10 -top-10 w-40 h-40 bg-white/10 rounded-full blur-3xl"></div>
                <p class="text-xs opacity-80 uppercase tracking-widest mb-1">Plan actuel</p>
                <h3 class="text-3xl font-bold mb-6">{{ $subscription['plan'] ?? 'Pro Agency' }}</h3>
                <div class="space-y-4 mb-8">
                    @foreach($subscription['features'] ?? [] as $feature)
                    <div class="flex items-center gap-2">
                        <span class="material-symbols-outlined text-sm">check_circle</span>
                        <span class="text-sm">{{ $feature }}</span>
                    </div>
                    @endforeach
                </div>
                <p class="text-2xl font-bold mb-8">{{ $subscription['price'] ?? '49€' }}<span class="text-sm font-normal opacity-70"> / mois</span></p>
                <button type="button" class="w-full py-3 bg-white text-primary font-bold rounded-lg hover:bg-gray-100 transition-colors">Changer de plan</button>
            </div>
            <div class="lg:col-span-2 bg-white border rounded-xl p-6 shadow-sm overflow-hidden">
                <h3 class="font-semibold text-lg mb-6 flex items-center gap-2">
                    <span class="material-symbols-outlined text-primary">history</span>
                    Historique de facturation
                </h3>
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="p-4 text-xs font-bold text-gray-500 uppercase border-b">Date</th>
                                <th class="p-4 text-xs font-bold text-gray-500 uppercase border-b">Description</th>
                                <th class="p-4 text-xs font-bold text-gray-500 uppercase border-b">Montant</th>
                                <th class="p-4 text-xs font-bold text-gray-500 uppercase border-b text-right">Facture</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y">
                            @foreach($invoices as $invoice)
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="p-4 text-sm">{{ $invoice['date'] }}</td>
                                <td class="p-4 text-sm">{{ $invoice['description'] }}</td>
                                <td class="p-4 text-sm font-semibold">{{ $invoice['amount'] }}</td>
                                <td class="p-4 text-right">
                                    <button type="button" onclick="downloadInvoice('{{ $invoice['id'] }}')" class="text-primary hover:scale-110 transition-transform">
                                        <span class="material-symbols-outlined">download</span>
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Gestion des onglets
    document.querySelectorAll('.tab-btn').forEach(function(btn) {
        btn.addEventListener('click', function() {
            var tabId = this.dataset.tab;

            document.querySelectorAll('.tab-section').forEach(function(section) {
                section.classList.add('hidden');
            });

            document.getElementById('section-' + tabId).classList.remove('hidden');

            document.querySelectorAll('.tab-btn').forEach(function(b) {
                b.classList.remove('active-tab', 'text-primary', 'border-primary');
                b.classList.add('text-gray-500');
            });
            this.classList.add('active-tab', 'text-primary', 'border-primary');
            this.classList.remove('text-gray-500');
        });
    });

    // Laravel routes -> JS constants
    var settingsUpdateUrl = @json(route('settings.update'));
    var settingsPasswordUrl = @json(route('settings.password'));

    // Sauvegarder un paramètre
    async function saveSetting(key, value) {
        try {
            var response = await fetch(settingsUpdateUrl, {
                method: 'PUT',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ [key]: value })
            });

            if (response.ok) {
                console.log('Setting saved:', key, value);
            }
        } catch (error) {
            console.error('Error saving setting:', error);
        }
    }

    // Changer le thème
    async function setTheme(theme) {
        await saveSetting('theme', theme);

        var btns = document.querySelectorAll('.theme-btn');
        btns.forEach(function(btn) {
            btn.classList.remove('border-primary', 'bg-orange-50');
            btn.classList.add('border-gray-200');
        });

        if (theme === 'light') {
            if (btns[0]) btns[0].classList.add('border-primary', 'bg-orange-50');
            document.documentElement.classList.remove('dark');
            if (document.body) document.body.classList.remove('dark');
        } else if (theme === 'dark') {
            if (btns[1]) btns[1].classList.add('border-primary', 'bg-orange-50');
            document.documentElement.classList.add('dark');
            if (document.body) document.body.classList.add('dark');
        } else if (theme === 'auto') {
            if (btns[2]) btns[2].classList.add('border-primary', 'bg-orange-50');
            var isDarkMode = window.matchMedia('(prefers-color-scheme: dark)').matches;
            if (isDarkMode) {
                document.documentElement.classList.add('dark');
            } else {
                document.documentElement.classList.remove('dark');
            }
        }
    }

    // Changer la langue
    var languageSelect = document.getElementById('languageSelect');
    if (languageSelect) {
        languageSelect.addEventListener('change', async function() {
            var language = this.value;
            await saveSetting('language', language);
            alert('Langue changée. Veuillez rafraîchir la page.');
            location.reload();
        });
    }

    // Sauvegarder les paramètres du blog
    async function saveBlogSettings() {
        var settings = {
            name: document.getElementById('blogName').value,
            subdomain: document.getElementById('blogSubdomain').value,
            description: document.getElementById('blogDescription').value
        };
        await saveSetting('blog', settings);
        alert('Paramètres du blog enregistrés !');
    }

    // Mettre à jour le mot de passe
    async function updatePassword() {
        var newPassword = document.getElementById('newPassword').value;
        var confirmPassword = document.getElementById('confirmPassword').value;

        if (newPassword !== confirmPassword) {
            alert('Les mots de passe ne correspondent pas');
            return;
        }
        if (newPassword.length < 8) {
            alert('Le mot de passe doit contenir au moins 8 caractères');
            return;
        }

        try {
            var response = await fetch(settingsPasswordUrl, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ new_password: newPassword })
            });

            if (response.ok) {
                alert('Mot de passe mis à jour !');
                document.getElementById('newPassword').value = '';
                document.getElementById('confirmPassword').value = '';
            } else {
                alert('Erreur lors de la mise à jour du mot de passe');
            }
        } catch (error) {
            console.error('Error:', error);
            alert('Erreur lors de la mise à jour du mot de passe');
        }
    }

    function enable2FA() {
        alert('Fonctionnalité 2FA à venir prochainement');
    }

    function revokeSession(sessionId) {
        if (confirm('Révoquer cette session ?')) {
            alert('Session ' + sessionId + ' révoquée');
        }
    }

    function downloadInvoice(invoiceId) {
        alert('Téléchargement de la facture ' + invoiceId);
    }
</script>
@endpush