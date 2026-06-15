


<?php $__env->startSection('title', 'Générateur d\'articles IA - NEARSEO'); ?>
<?php $__env->startSection('header-title', 'Générateur d\'articles IA'); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-[1400px] mx-auto">
    <!-- Header -->
    <div class="mb-8 flex flex-col md:flex-row md:items-end justify-between gap-4">
        <div>
            <div class="flex items-center gap-3 mb-2">
                <h1 class="text-3xl font-bold text-on-surface">Générateur d'articles IA</h1>
                <span class="bg-green-100 text-green-700 text-[10px] font-extrabold px-2.5 py-1 rounded-full border border-green-200">3H → 30 SEC</span>
            </div>
            <p class="text-gray-600">Créez du contenu stratégique optimisé pour le SEO en quelques secondes.</p>
        </div>
        <div class="hidden lg:flex items-center gap-2 bg-gray-100 px-4 py-2 rounded-lg border border-gray-200">
            <span class="material-symbols-outlined text-lg">bolt</span>
            <span class="text-sm font-semibold text-gray-700">Propulsé par l'agent NEARSEO</span>
        </div>
    </div>

    <div class="grid grid-cols-12 gap-8 items-start">
        
        <!-- Left Column: Configuration Form -->
        <div class="col-span-12 lg:col-span-5 space-y-6">
            <div class="bg-white p-6 rounded-xl border shadow-sm">
                <div class="space-y-5">
                    
                    <!-- Mode Selector -->
                    <div class="p-1 bg-gray-100 rounded-xl flex gap-1 mb-2">
                        <button type="button" class="mode-btn flex-1 flex items-center justify-center gap-2 py-2.5 px-4 rounded-lg text-sm transition-all bg-white text-primary shadow-sm ring-1 ring-black/5" data-mode="local" onclick="switchMode('local')">
                            <span class="material-symbols-outlined text-lg" style="font-variation-settings: 'FILL' 1;">location_on</span>
                            Commerce Local
                        </button>
                        <button type="button" class="mode-btn flex-1 flex items-center justify-center gap-2 py-2.5 px-4 rounded-lg text-sm transition-all text-gray-600" data-mode="online" onclick="switchMode('online')">
                            <span class="material-symbols-outlined text-lg">language</span>
                            Entreprise en ligne
                        </button>
                    </div>

                    <!-- Nom du commerce -->
                    <div class="space-y-2">
                        <label class="text-xs font-bold text-gray-500 uppercase">
                            Nom du commerce / entreprise <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">storefront</span>
                            <input id="businessName" type="text" 
                                   class="w-full pl-10 pr-4 py-3 border rounded-xl required-field"
                                   placeholder="Ex: La Maison du Pain, Coiffeur Elite">
                        </div>
                        <p class="text-xs text-red-500 hidden" id="businessNameError">Le nom du commerce est obligatoire</p>
                    </div>

                    <!-- Sujet -->
                    <div class="space-y-2">
                        <label class="text-xs font-bold text-gray-500 uppercase" id="subjectLabel">Sujet de l'article</label>
                        <textarea id="subject" rows="3" 
                                  class="w-full rounded-lg border border-gray-300 p-3 focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all resize-none"
                                  placeholder="Ex: Pourquoi choisir notre boulangerie artisanale..."></textarea>
                    </div>

                    <!-- Adresse -->
                    <div class="space-y-2">
                        <label class="text-xs font-bold text-gray-500 uppercase">
                            Adresse <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">location_on</span>
                            <input id="address" type="text" 
                                   class="w-full pl-10 pr-4 py-3 border rounded-xl required-field"
                                   placeholder="Ex: 123 Avenue Mohammed VI, Guéliz, Marrakech">
                        </div>
                        <p class="text-xs text-red-500 hidden" id="addressError">L'adresse est obligatoire</p>
                    </div>

                    <!-- Site web (optionnel) - CACHÉ PAR DÉFAUT -->
                    <div id="websiteField" class="hidden space-y-2">
                        <label class="text-xs font-bold text-gray-500 uppercase">Site web (optionnel)</label>
                        <div class="relative">
                            <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">public</span>
                            <input id="website" type="url" class="w-full pl-10 pr-4 py-2 border rounded-lg text-sm" placeholder="https://www.maboutique.ma">
                        </div>
                    </div>
                    <button type="button" onclick="toggleWebsiteField()" class="text-primary text-sm flex items-center gap-1 mt-1 hover:underline">
                        <span class="material-symbols-outlined text-sm">add</span>
                         Ajouter un site web existant
                    </button>

                    <!-- Zone géographique d'intervention -->
                    <div id="geoZoneFields" class="space-y-2">
                        <label class="text-xs font-bold text-gray-500 uppercase">
                            Zone géographique d'intervention <span class="text-red-500">*</span>
                        </label>
                        <div class="grid grid-cols-3 gap-3">
                            <div class="relative">
                                <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-sm">radio_button_checked</span>
                                <input type="text" id="geoQuartier" class="w-full pl-9 pr-3 py-2 border rounded-lg text-sm" placeholder="Quartier">
                            </div>
                            <div class="relative">
                                <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-sm">location_city</span>
                                <input type="text" id="geoVille" class="w-full pl-9 pr-3 py-2 border rounded-lg text-sm required-field" placeholder="Ville *">
                            </div>
                            <div class="relative">
                                <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-sm">public</span>
                                <select id="geoPays" class="w-full pl-9 pr-3 py-2 border rounded-lg text-sm bg-white">
                                    <option value="Maroc">Maroc</option>
                                    <option value="France">France</option>
                                    <option value="Belgique">Belgique</option>
                                    <option value="Suisse">Suisse</option>
                                    <option value="Canada">Canada</option>
                                    <option value="Sénégal">Sénégal</option>
                                    <option value="Côte d'Ivoire">Côte d'Ivoire</option>
                                    <option value="Espagne">Espagne</option>
                                    <option value="Italie">Italie</option>
                                    <option value="Allemagne">Allemagne</option>
                                </select>
                            </div>
                        </div>
                        <p class="text-xs text-red-500 hidden" id="geoVilleError">La ville est obligatoire</p>
                        <p class="text-xs text-gray-400 mt-1">🌍 La carte se met à jour automatiquement lorsque vous changez le pays, la ville ou le quartier</p>
                    </div>

                    <!-- Local Fields -->
                    <div id="localFields" class="grid grid-cols-2 gap-4">
                        <div class="space-y-2">
                            <label class="text-xs font-bold text-gray-500 uppercase">Fiche Google (GBP)</label>
                            <select id="gbpOption" class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm bg-white">
                                <option value="optimize">Optimiser pour GBP</option>
                                <option value="ignore">Ignorer</option>
                            </select>
                        </div>
                        <div class="space-y-2"></div>
                    </div>

                    <!-- Online Fields -->
                    <div id="onlineFields" class="hidden space-y-4">
                        <div class="space-y-2">
                            <label class="text-xs font-bold text-gray-500 uppercase">Site Web <span class="text-red-500">*</span></label>
                            <div class="relative">
                                <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">public</span>
                                <input id="websiteOnline" type="url" class="w-full pl-10 pr-4 py-2 border rounded-lg text-sm" placeholder="https://www.monsite.ma">
                            </div>
                        </div>
                        <div class="space-y-2">
                            <label class="text-xs font-bold text-gray-500 uppercase">Mots-clés stratégiques</label>
                            <input id="keywords" type="text" class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm" placeholder="Ex: artisanat, tourisme">
                        </div>
                    </div>

                    <!-- Horaires -->
                    <div id="localDetailsFields" class="space-y-2">
                        <label class="text-xs font-bold text-gray-500 uppercase">Horaires d'ouverture</label>
                        <input id="hours" type="text" class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm" placeholder="Lun-Sam : 09h00 - 20h00">
                    </div>

                    <!-- Objectifs -->
                    <div id="goalsFields" class="space-y-2">
                        <label class="text-xs font-bold text-gray-500 uppercase">Objectif(s) de l'article</label>
                        <div class="grid grid-cols-2 gap-2">
                            <label class="flex items-center gap-2 p-2 border rounded-lg cursor-pointer hover:bg-gray-50">
                                <input type="checkbox" value="attirer_boutique" class="goal-checkbox"> Attirer en boutique
                            </label>
                            <label class="flex items-center gap-2 p-2 border rounded-lg cursor-pointer hover:bg-gray-50">
                                <input type="checkbox" value="appels" class="goal-checkbox"> Générer des appels
                            </label>
                            <label class="flex items-center gap-2 p-2 border rounded-lg cursor-pointer hover:bg-gray-50">
                                <input type="checkbox" value="promotion" class="goal-checkbox"> Promouvoir une offre
                            </label>
                            <label class="flex items-center gap-2 p-2 border rounded-lg cursor-pointer hover:bg-gray-50">
                                <input type="checkbox" value="reservations" class="goal-checkbox"> Prise de rendez-vous
                            </label>
                            <label class="flex items-center gap-2 p-2 border rounded-lg cursor-pointer hover:bg-gray-50">
                                <input type="checkbox" value="livraison" class="goal-checkbox"> Livraison à domicile
                            </label>
                        </div>
                    </div>

                    <!-- Langue & Ton -->
                    <div class="grid grid-cols-2 gap-4">
                        <div class="space-y-2">
                            <label class="text-xs font-bold text-gray-500 uppercase">Langue</label>
                            <select id="language" class="w-full rounded-lg border border-gray-300 px-3 py-2 bg-white text-sm">
                                <option value="fr">Français</option>
                                <option value="en">English</option>
                                <option value="ar">العربية</option>
                            </select>
                        </div>
                        <div class="space-y-2">
                            <label class="text-xs font-bold text-gray-500 uppercase">Ton</label>
                            <select id="tone" class="w-full rounded-lg border border-gray-300 px-3 py-2 bg-white text-sm">
                                <option value="professional">Professionnel & Chaleureux</option>
                                <option value="expert">Expert / Autorité</option>
                                <option value="storytelling">Storytelling</option>
                            </select>
                        </div>
                    </div>

                    <!-- Length Slider -->
                    <div class="space-y-4 py-2">
                        <div class="flex justify-between items-center">
                            <label class="text-xs font-bold text-gray-500 uppercase">Format SEO</label>
                            <span class="text-primary font-bold text-sm" id="lengthValue">Moyen</span>
                        </div>
                        <input id="lengthSlider" type="range" min="1" max="3" value="2" step="1"
                               class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer accent-primary"
                               oninput="updateLength(this.value)">
                        <div class="flex justify-between text-[10px] font-bold text-gray-400 uppercase tracking-wider px-1">
                            <span>Court (600 mots)</span>
                            <span>Moyen (1000 mots)</span>
                            <span>Long (1600 mots)</span>
                        </div>
                    </div>

                    <!-- Generate Button -->
                    <button id="generateBtn" onclick="generateArticle()"
                            class="w-full bg-secondary text-white py-4 rounded-xl font-semibold flex items-center justify-center gap-3 hover:shadow-lg active:scale-95 transition-all mt-4 group">
                        <span>Générer l'article avec l'agent NEARSEO</span>
                        <span class="material-symbols-outlined group-hover:rotate-180 transition-transform duration-500" style="font-variation-settings: 'FILL' 1;">auto_awesome</span>
                    </button>
                </div>
            </div>

            <!-- Conseils -->
            <div class="border-l-4 border-secondary bg-green-50 p-5 rounded-xl">
                <div class="flex items-start gap-3">
                    <span class="material-symbols-outlined text-secondary">lightbulb</span>
                    <div>
                        <h4 class="font-semibold text-secondary mb-1" id="tipTitle">Conseil Local</h4>
                        <p class="text-sm text-gray-600" id="tipText">L'agent NEARSEO intègre automatiquement votre zone géographique (quartier/ville/pays) dans l'article pour un ciblage SEO ultra-précis.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Column: MAP + Preview -->
        <div class="col-span-12 lg:col-span-7">
            <div class="bg-white rounded-xl border shadow-sm flex flex-col">
                
                <!-- MAP SECTION avec barre de recherche -->
                <div class="relative w-full" style="height: 320px;">
                    <div class="absolute top-4 left-4 right-4 z-20">
                        <div class="relative max-w-md">
                            <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-lg">search</span>
                            <input type="text" id="mapSearchInput" 
                                   placeholder="Rechercher une adresse, une ville..." 
                                   class="w-full pl-10 pr-4 py-2.5 bg-white rounded-lg shadow-md border border-gray-200 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent text-sm"
                                   onkeypress="searchMapLocation(event)">
                            <span class="absolute right-3 top-1/2 -translate-y-1/2 text-xs text-gray-400">⌘K</span>
                        </div>
                    </div>
                    
                    <div id="map" class="w-full h-full rounded-t-xl overflow-hidden bg-gray-100"></div>
                    
                    <div class="absolute bottom-4 left-4 z-20 flex flex-col gap-2">
                        <button onclick="zoomIn()" class="w-10 h-10 bg-white rounded-lg shadow-md flex items-center justify-center text-gray-600 hover:text-primary transition-colors">
                            <span class="material-symbols-outlined">add</span>
                        </button>
                        <button onclick="zoomOut()" class="w-10 h-10 bg-white rounded-lg shadow-md flex items-center justify-center text-gray-600 hover:text-primary transition-colors">
                            <span class="material-symbols-outlined">remove</span>
                        </button>
                        <button onclick="getUserLocation()" class="w-10 h-10 bg-white rounded-lg shadow-md flex items-center justify-center text-gray-600 hover:text-primary transition-colors mt-4">
                            <span class="material-symbols-outlined">my_location</span>
                        </button>
                    </div>
                    
                    <div class="absolute bottom-4 right-4 z-20">
                        <span class="text-xs bg-white/90 backdrop-blur-sm px-3 py-1.5 rounded-full shadow-md text-gray-600 flex items-center gap-1">
                            <span class="material-symbols-outlined text-sm">location_on</span>
                            <span id="mapStatus">🌍 Carte centrée</span>
                        </span>
                    </div>
                </div>
                
                <!-- Preview Header -->
                <div class="p-4 border-b border-t flex justify-between items-center bg-gray-50">
                    <div class="flex items-center gap-3">
                        <span class="material-symbols-outlined text-gray-500">visibility</span>
                        <h2 class="font-semibold text-lg">Aperçu de l'article</h2>
                    </div>
                    <div class="flex items-center gap-2 bg-green-100 text-green-700 px-3 py-1 rounded-full border border-green-200">
                        <span class="material-symbols-outlined text-base" style="font-variation-settings: 'FILL' 1;">auto_awesome</span>
                        <span class="text-[11px] font-bold uppercase tracking-wider" id="previewBadge">Mode Local Actif</span>
                    </div>
                </div>

                <!-- Empty State -->
                <div id="emptyState" class="flex-1 flex flex-col items-center justify-center p-12 text-center" style="min-height: 300px;">
                    <div class="w-24 h-24 bg-primary/5 rounded-full flex items-center justify-center mb-6 relative">
                        <span class="material-symbols-outlined text-5xl text-primary/30">article</span>
                        <div class="absolute -right-1 -bottom-1 w-10 h-10 bg-white rounded-full flex items-center justify-center shadow-md border">
                            <span class="material-symbols-outlined text-primary text-xl">auto_awesome</span>
                        </div>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-700 mb-2">Agent NEARSEO prêt</h3>
                    <p class="text-gray-500 max-w-sm text-base">
                        Remplissez le formulaire à gauche et cliquez sur "Générer".<br>
                        <span class="text-sm text-primary">Votre article apparaîtra ici</span>
                    </p>
                </div>

                <!-- Article Content -->
                <div id="articleContent" class="hidden p-8 prose max-w-none"></div>

                <!-- Bottom Action Bar -->
                <div id="actionBar" class="p-6 border-t bg-gray-50 rounded-b-xl flex items-center justify-between opacity-50">
                    <div class="flex items-center gap-4">
                        <div class="relative w-14 h-14 flex items-center justify-center">
                            <svg class="w-full h-full -rotate-90">
                                <circle cx="28" cy="28" fill="transparent" r="24" stroke="#e5e7eb" stroke-width="4"></circle>
                                <circle id="seoScoreCircle" cx="28" cy="28" fill="transparent" r="24" stroke="#47664b" stroke-dasharray="150" stroke-dashoffset="150" stroke-width="4"></circle>
                            </svg>
                            <div class="absolute inset-0 flex flex-col items-center justify-center">
                                <span id="seoScore" class="text-xs font-bold text-gray-800">--</span>
                                <span class="text-[8px] uppercase text-gray-400">SEO</span>
                            </div>
                        </div>
                        <div>
                            <p class="text-[10px] text-gray-400 uppercase">Score d'optimisation</p>
                            <p id="seoStatus" class="text-sm font-semibold text-gray-500">Attente de génération...</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-3">
                        <button id="rewriteBtn" onclick="rewriteArticle()" disabled class="px-4 py-2 border rounded-lg text-sm font-semibold text-gray-400 cursor-not-allowed flex items-center gap-2">
                            <span class="material-symbols-outlined text-lg">refresh</span> 
                            Reformuler
                        </button>
                        <button id="publishBtn" onclick="publishArticle()" disabled class="px-5 py-2 bg-gray-300 text-white rounded-lg text-sm font-bold cursor-not-allowed flex items-center gap-2">
                            <span class="material-symbols-outlined text-lg">ios_share</span> 
                            Exporter
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('styles'); ?>
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<style>
    .marker-pulse::after {
        content: '';
        position: absolute;
        width: 100%;
        height: 100%;
        background: rgba(140, 74, 47, 0.4);
        border-radius: 50%;
        animation: pulse 2s infinite;
    }
    @keyframes pulse {
        0% { transform: scale(1); opacity: 1; }
        100% { transform: scale(3); opacity: 0; }
    }
    .prose {
        max-width: none;
    }
    .prose h1 { font-size: 2rem; font-weight: 700; margin-bottom: 1rem; }
    .prose h2 { font-size: 1.5rem; font-weight: 600; margin-top: 1.5rem; margin-bottom: 0.75rem; }
    .prose h3 { font-size: 1.25rem; font-weight: 600; margin-top: 1rem; margin-bottom: 0.5rem; }
    .prose p { margin-bottom: 1rem; line-height: 1.6; }
    .prose ul, .prose ol { padding-left: 1.5rem; margin-bottom: 1rem; }
    .faq-item { margin-bottom: 1rem; padding-bottom: 0.5rem; border-bottom: 1px solid #e5e7eb; }
    .faq-item p:first-child { font-weight: 600; }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('scripts'); ?>
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script>
    let map;
    let currentMarker = null;
    let currentMode = 'local';
    let generatedContent = '';
    let currentSeoScore = 0;
    let updateTimeout = null;

    function initMap() {
        const defaultCenter = [31.7917, -7.0926];
        map = L.map('map').setView(defaultCenter, 6);
        L.tileLayer('https://{s}.basemaps.cartocdn.com/light_all/{z}/{x}/{y}{r}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> & CartoDB',
            subdomains: 'abcd',
            maxZoom: 19
        }).addTo(map);
        
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(position => {
                map.setView([position.coords.latitude, position.coords.longitude], 10);
                document.getElementById('mapStatus').innerHTML = '📍 Votre position';
                addMarker(position.coords.latitude, position.coords.longitude);
            }, error => {
                document.getElementById('mapStatus').innerHTML = '🌍 Carte centrée sur le Maroc';
            });
        }
        updateMapFromGeoZone();
    }
    
    function addMarker(lat, lng) {
        if (currentMarker) map.removeLayer(currentMarker);
        const customIcon = L.divIcon({
            html: '<div class="w-8 h-8 bg-primary rounded-full flex items-center justify-center border-2 border-white shadow-lg"><span class="material-symbols-outlined text-white text-sm">location_on</span></div>',
            iconSize: [32, 32],
            popupAnchor: [0, -16],
            className: 'custom-marker'
        });
        currentMarker = L.marker([lat, lng], { icon: customIcon, draggable: true }).addTo(map);
        currentMarker.bindPopup(`<b>${document.getElementById('businessName').value || 'Votre commerce'}</b>`);
        currentMarker.on('dragend', (e) => reverseGeocode(e.target.getLatLng().lat, e.target.getLatLng().lng));
    }
    
    async function updateMapFromGeoZone() {
        const quartier = document.getElementById('geoQuartier')?.value || '';
        const ville = document.getElementById('geoVille')?.value || '';
        const pays = document.getElementById('geoPays')?.value || '';
        let query = [quartier, ville, pays].filter(Boolean).join(', ');
        if (!query) return;
        
        document.getElementById('mapStatus').innerHTML = '🔍 Recherche...';
        try {
            const response = await fetch(`https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(query)}&limit=1`);
            const data = await response.json();
            if (data?.length) {
                map.setView([data[0].lat, data[0].lon], 13);
                addMarker(data[0].lat, data[0].lon);
                document.getElementById('mapStatus').innerHTML = `📍 ${ville || pays}`;
            } else {
                document.getElementById('mapStatus').innerHTML = '⚠️ Localisation non trouvée';
            }
        } catch (error) {
            document.getElementById('mapStatus').innerHTML = '❌ Erreur de recherche';
        }
    }
    
    async function reverseGeocode(lat, lng) {
        try {
            const response = await fetch(`https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lng}&zoom=18&addressdetails=1`);
            const data = await response.json();
            if (data?.address) {
                const ville = data.address.city || data.address.town || data.address.village || '';
                const quartier = data.address.suburb || data.address.neighbourhood || '';
                const pays = data.address.country || '';
                if (ville) document.getElementById('geoVille').value = ville;
                if (quartier) document.getElementById('geoQuartier').value = quartier;
                if (pays) {
                    let opt = Array.from(document.getElementById('geoPays').options).find(o => o.value === pays);
                    if (opt) document.getElementById('geoPays').value = pays;
                }
                document.getElementById('mapStatus').innerHTML = `📍 ${quartier ? quartier + ', ' : ''}${ville}`;
            }
        } catch (error) { console.error('Reverse geocoding error:', error); }
    }
    
    function setupGeoListeners() {
        ['geoQuartier', 'geoVille', 'geoPays'].forEach(id => {
            let el = document.getElementById(id);
            if (el) el.addEventListener('change', () => {
                clearTimeout(updateTimeout);
                updateTimeout = setTimeout(() => updateMapFromGeoZone(), 500);
            });
        });
    }
    
    function zoomIn() { map?.zoomIn(); }
    function zoomOut() { map?.zoomOut(); }
    
    function getUserLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(position => {
                map.setView([position.coords.latitude, position.coords.longitude], 14);
                addMarker(position.coords.latitude, position.coords.longitude);
                reverseGeocode(position.coords.latitude, position.coords.longitude);
                document.getElementById('mapStatus').innerHTML = '📍 Votre position';
            }, () => alert('Impossible d\'obtenir votre position'));
        } else alert('Géolocalisation non supportée');
    }
    
    async function searchMapLocation(event) {
        if (event.key !== 'Enter') return;
        const query = event.target.value;
        if (!query) return;
        document.getElementById('mapStatus').innerHTML = '🔍 Recherche...';
        try {
            const response = await fetch(`https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(query)}&limit=1`);
            const data = await response.json();
            if (data?.length) {
                map.setView([data[0].lat, data[0].lon], 14);
                addMarker(data[0].lat, data[0].lon);
                document.getElementById('mapStatus').innerHTML = `📍 ${data[0].display_name.substring(0, 40)}`;
                let parts = data[0].display_name.split(',');
                if (parts.length >= 2) document.getElementById('geoVille').value = parts[1].trim();
                if (parts.length >= 3) document.getElementById('geoPays').value = parts[2].trim();
            } else document.getElementById('mapStatus').innerHTML = '⚠️ Localisation non trouvée';
        } catch (error) { document.getElementById('mapStatus').innerHTML = '❌ Erreur de recherche'; }
    }
    
    function toggleWebsiteField() {
        let field = document.getElementById('websiteField');
        let btn = event.target.closest('button');
        if (field.classList.contains('hidden')) {
            field.classList.remove('hidden');
            btn.innerHTML = '<span class="material-symbols-outlined text-sm">remove</span> Supprimer mon site web';
        } else {
            field.classList.add('hidden');
            document.getElementById('website').value = '';
            btn.innerHTML = '<span class="material-symbols-outlined text-sm">add</span> + Ajouter un site web existant';
        }
    }
    
    function updateLength(val) {
        let values = ["Court", "Moyen", "Long"];
        document.getElementById('lengthValue').innerText = values[val-1];
    }
    
    function validateForm() {
        let isValid = true;
        let businessName = document.getElementById('businessName').value.trim();
        let address = document.getElementById('address').value.trim();
        let geoVille = document.getElementById('geoVille')?.value.trim();
        
        if (!businessName) {
            document.getElementById('businessName').classList.add('border-red-500');
            document.getElementById('businessNameError').classList.remove('hidden');
            isValid = false;
        } else {
            document.getElementById('businessName').classList.remove('border-red-500');
            document.getElementById('businessNameError').classList.add('hidden');
        }
        
        if (!address) {
            document.getElementById('address').classList.add('border-red-500');
            document.getElementById('addressError').classList.remove('hidden');
            isValid = false;
        } else {
            document.getElementById('address').classList.remove('border-red-500');
            document.getElementById('addressError').classList.add('hidden');
        }
        
        if (currentMode === 'local' && !geoVille) {
            document.getElementById('geoVille').classList.add('border-red-500');
            document.getElementById('geoVilleError').classList.remove('hidden');
            isValid = false;
        } else if (document.getElementById('geoVille')) {
            document.getElementById('geoVille').classList.remove('border-red-500');
            document.getElementById('geoVilleError').classList.add('hidden');
        }
        return isValid;
    }
    
    function switchMode(mode) {
        currentMode = mode;
        let localBtn = document.querySelector('[data-mode="local"]');
        let onlineBtn = document.querySelector('[data-mode="online"]');
        let localFields = document.getElementById('localFields');
        let onlineFields = document.getElementById('onlineFields');
        let localDetailsFields = document.getElementById('localDetailsFields');
        let goalsFields = document.getElementById('goalsFields');
        let geoZoneFields = document.getElementById('geoZoneFields');
        let subjectLabel = document.getElementById('subjectLabel');
        let tipTitle = document.getElementById('tipTitle');
        let tipText = document.getElementById('tipText');
        let previewBadge = document.getElementById('previewBadge');
        
        if (mode === 'local') {
            localBtn.classList.add('bg-white', 'text-primary', 'shadow-sm');
            localBtn.classList.remove('text-gray-600');
            onlineBtn.classList.remove('bg-white', 'text-primary', 'shadow-sm');
            onlineBtn.classList.add('text-gray-600');
            localFields.classList.remove('hidden');
            onlineFields.classList.add('hidden');
            localDetailsFields.classList.remove('hidden');
            goalsFields.classList.remove('hidden');
            if (geoZoneFields) geoZoneFields.classList.remove('hidden');
            subjectLabel.innerText = "Sujet de l'article local";
            tipTitle.innerText = "Conseil Local";
            tipText.innerHTML = "L'agent NEARSEO intègre automatiquement votre zone géographique (quartier/ville/pays) dans l'article pour un ciblage SEO ultra-précis.";
            previewBadge.innerText = "Mode Local Actif";
            updateMapFromGeoZone();
        } else {
            onlineBtn.classList.add('bg-white', 'text-primary', 'shadow-sm');
            onlineBtn.classList.remove('text-gray-600');
            localBtn.classList.remove('bg-white', 'text-primary', 'shadow-sm');
            localBtn.classList.add('text-gray-600');
            onlineFields.classList.remove('hidden');
            localFields.classList.add('hidden');
            localDetailsFields.classList.add('hidden');
            goalsFields.classList.add('hidden');
            if (geoZoneFields) geoZoneFields.classList.add('hidden');
            subjectLabel.innerText = "Sujet de l'article";
            tipTitle.innerText = "Conseil Entreprise";
            tipText.innerHTML = "L'agent NEARSEO va générer un article optimisé pour votre site web avec des backlinks pertinents.";
            previewBadge.innerText = "Mode Global Actif";
        }
    }
    
    function updateSeoScore(score) {
        let circumference = 150;
        let offset = circumference - (score / 100) * circumference;
        let circle = document.getElementById('seoScoreCircle');
        if (circle) circle.style.strokeDashoffset = offset;
        document.getElementById('seoScore').innerText = score;
        let statusEl = document.getElementById('seoStatus');
        if (score >= 80) statusEl.innerHTML = '🏆 Excellent - Prêt à publier';
        else if (score >= 60) statusEl.innerHTML = '👍 Bon - Quelques améliorations possibles';
        else statusEl.innerHTML = '⚠️ À améliorer - Relisez le contenu';
    }
    
    function enableActions() {
        let rewriteBtn = document.getElementById('rewriteBtn');
        let publishBtn = document.getElementById('publishBtn');
        let actionBar = document.getElementById('actionBar');
        if (rewriteBtn) {
            rewriteBtn.disabled = false;
            rewriteBtn.classList.remove('text-gray-400', 'cursor-not-allowed');
            rewriteBtn.classList.add('text-primary', 'cursor-pointer', 'hover:bg-primary/5', 'border-primary/30');
        }
        if (publishBtn) {
            publishBtn.disabled = false;
            publishBtn.classList.remove('bg-gray-300', 'cursor-not-allowed');
            publishBtn.classList.add('bg-secondary', 'cursor-pointer', 'hover:bg-secondary/90', 'shadow-md');
        }
        if (actionBar) actionBar.classList.remove('opacity-50');
    }
    
    async function generateArticle() {
    if (!validateForm()) return;
    
    let btn = document.getElementById('generateBtn');
    let originalHtml = btn.innerHTML;
    btn.innerHTML = '<span class="material-symbols-outlined animate-spin">sync</span> Génération en cours...';
    btn.disabled = true;
    
    document.getElementById('emptyState').classList.add('hidden');
    document.getElementById('articleContent').classList.remove('hidden');
    document.getElementById('articleContent').innerHTML = `<div class="space-y-4 animate-pulse"><div class="h-8 bg-gray-200 rounded w-3/4"></div><div class="h-4 bg-gray-200 rounded w-full"></div><div class="h-4 bg-gray-200 rounded w-5/6"></div><div class="h-4 bg-gray-200 rounded w-4/5"></div><div class="h-32 bg-gray-200 rounded w-full"></div></div>`;
    
    let payload = {
        mode: currentMode,
        business_name: document.getElementById('businessName').value,
        subject: document.getElementById('subject').value,
        address: document.getElementById('address').value,
        language: document.getElementById('language').value,
        tone: document.getElementById('tone').value,
        format: ['short', 'medium', 'long'][document.getElementById('lengthSlider').value - 1]
    };
    
    if (currentMode === 'local') {
        payload.website = document.getElementById('website').value || '';
        payload.hours = document.getElementById('hours').value;
        payload.goals = Array.from(document.querySelectorAll('.goal-checkbox:checked')).map(cb => cb.value);
        payload.geo_quartier = document.getElementById('geoQuartier')?.value || '';
        payload.geo_ville = document.getElementById('geoVille')?.value || '';
        payload.geo_pays = document.getElementById('geoPays')?.value || 'Maroc';
    } else {
        payload.website = document.getElementById('websiteOnline').value;
        payload.keywords = document.getElementById('keywords').value;
    }
    
    try {
        let response = await fetch('/api/ai/generate', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify(payload)
        });
        let data = await response.json();
        
        if (response.ok && data.success) {
            // ✅ REDIRECTION VERS L'ÉDITEUR
            window.location.href = data.redirect_url;
        } else {
            document.getElementById('articleContent').innerHTML = `<div class="text-center py-12 text-red-600">❌ Erreur: ${data.message || 'Génération échouée'}</div>`;
            btn.innerHTML = originalHtml;
            btn.disabled = false;
        }
    } catch (error) {
        document.getElementById('articleContent').innerHTML = `<div class="text-center py-12 text-red-600">❌ Erreur de connexion. Veuillez réessayer.</div>`;
        btn.innerHTML = originalHtml;
        btn.disabled = false;
    }
}
        
    
    function rewriteArticle() { alert('Fonctionnalité à venir : Reformulation de l\'article avec l\'agent NEARSEO'); }
    
    function publishArticle() {
        if (!generatedContent) return;
        let title = prompt('Titre de l\'article :', document.getElementById('subject').value);
        if (!title) return;
        fetch('<?php echo e(route("articles.store")); ?>', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({
                title: title,
                content: generatedContent,
                seo_score: currentSeoScore,
                status: 'published',
                address: document.getElementById('address').value,
                business_name: document.getElementById('businessName').value,
                geo_ville: document.getElementById('geoVille')?.value || '',
                geo_pays: document.getElementById('geoPays')?.value || ''
            })
        }).then(response => {
            if (response.ok) {
                alert('✅ Article publié avec succès !');
                window.location.href = '<?php echo e(route("articles.index")); ?>';
            } else alert('Erreur lors de la publication');
        }).catch(error => alert('Erreur de connexion'));
    }
    
    document.getElementById('businessName')?.addEventListener('input', function() {
        if (this.value.trim()) {
            this.classList.remove('border-red-500');
            document.getElementById('businessNameError')?.classList.add('hidden');
        }
    });
    document.getElementById('address')?.addEventListener('input', function() {
        if (this.value.trim()) {
            this.classList.remove('border-red-500');
            document.getElementById('addressError')?.classList.add('hidden');
        }
    });
    document.getElementById('geoVille')?.addEventListener('input', function() {
        if (this.value.trim()) {
            this.classList.remove('border-red-500');
            document.getElementById('geoVilleError')?.classList.add('hidden');
        }
    });
    
    document.addEventListener('DOMContentLoaded', () => {
        initMap();
        setupGeoListeners();
        updateLength(2);
    });
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\pc\nearseo-laravel\resources\views/dashboard/ai/create.blade.php ENDPATH**/ ?>