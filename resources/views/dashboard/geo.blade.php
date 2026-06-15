@extends('layouts.app')

@section('title', 'Géolocalisation')
@section('header-title', 'Géolocalisation')

@section('content')
<div class="flex flex-col lg:flex-row flex-1 overflow-hidden">
    <!-- Map Container -->
    <div class="relative flex-1 map-container bg-[#f0ede6]">
        <div id="map" class="w-full h-full relative overflow-hidden rounded-xl shadow-lg"></div>
        
        <!-- Floating Controls -->
        <div class="absolute bottom-6 left-6 z-20 flex flex-col gap-2">
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
    </div>
    
    <!-- Right Sidebar -->
    <aside class="w-full lg:w-96 bg-white border-l border-gray-200 flex flex-col">
        <div class="p-6 border-b bg-white/95">
            <h3 class="text-2xl font-bold text-gray-800 mb-6">Articles à proximité</h3>

            <!-- Barre de recherche (pour searchLocation) -->
            <div class="mb-6">
                <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2" for="searchCity">
                    Rechercher une ville
                </label>
                <input
                    id="searchCity"
                    type="text"
                    placeholder="Ex: Casablanca"
                    class="w-full px-3 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary"
                />
                <p class="text-xs text-gray-500 mt-2">Appuie sur Entrée pour chercher.</p>
            </div>

            <div class="space-y-4">
                <div class="flex justify-between items-center mb-1">
                    <label class="text-xs font-bold text-gray-500 uppercase tracking-wider">Rayon de recherche</label>
                    <span class="text-primary font-bold" id="radius-val">10 km</span>
                </div>
                <div class="relative pt-1">
                    <input class="w-full h-1.5 bg-gray-200 rounded-lg appearance-none cursor-pointer accent-primary" id="radius-slider" max="3" min="0" step="1" type="range" value="1" onchange="updateRadius()"/>
                    <div class="flex justify-between px-1 mt-2">
                        <span class="text-[10px] font-bold text-gray-400">5km</span>
                        <span class="text-[10px] font-bold text-gray-400">10km</span>
                        <span class="text-[10px] font-bold text-gray-400">20km</span>
                        <span class="text-[10px] font-bold text-gray-400">50km</span>
                    </div>
                </div>
            </div>
        </div>
        
        <div id="articlesList" class="flex-1 overflow-y-auto p-4 space-y-3">
            @forelse($nearbyArticles as $article)
            <div class="group bg-white border border-gray-200 p-4 rounded-xl hover:shadow-md transition-all cursor-pointer" data-lat="{{ $article->latitude }}" data-lng="{{ $article->longitude }}" onclick="focusOnMarker({{ $article->latitude }}, {{ $article->longitude }})">
                <div class="flex justify-between items-start gap-3">
                    <div class="flex-1">
                        <h4 class="font-semibold text-gray-800 leading-snug group-hover:text-primary transition-colors">{{ $article->title }}</h4>
                        <div class="flex items-center gap-2 mt-2">
                            <span class="material-symbols-outlined text-[16px] text-gray-500">location_on</span>
                            <span class="text-sm font-medium text-gray-600">{{ $article->address ?? 'Adresse non spécifiée' }}</span>
                        </div>
                    </div>
                    <button onclick="event.stopPropagation(); focusOnMarker({{ $article->latitude }}, {{ $article->longitude }})" class="text-gray-500 p-2 hover:bg-gray-100 rounded-full transition-all">
                        <span class="material-symbols-outlined text-[20px]">map</span>
                    </button>
                </div>
            </div>
            @empty
            <div class="text-center py-8 text-gray-500">
                <span class="material-symbols-outlined text-4xl mb-2">location_off</span>
                <p>Aucun article géolocalisé</p>
                <p class="text-xs mt-2">Ajoutez une adresse à vos articles pour les voir apparaître sur la carte</p>
            </div>
            @endforelse
        </div>
        
        <div class="p-6 bg-white border-t">
            <button onclick="openAddAddressModal()" class="w-full bg-primary text-white py-4 rounded-xl font-bold flex items-center justify-center gap-2 hover:bg-primary/90 transition-all active:scale-[0.98] shadow-lg">
                <span class="material-symbols-outlined">add_location_alt</span>
                Ajouter une adresse à un article
            </button>
        </div>
    </aside>
</div>
@endsection

@push('styles')
<style>
    .map-container {
        height: calc(100vh - 64px);
        min-height: 500px;
    }
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
</style>
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
@endpush

@push('scripts')
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script>
    let map;
    let markers = [];
    let userMarker = null;
    let currentRadius = 10;
    const radiusMap = ['5', '10', '20', '50'];
    const slider = document.getElementById('radius-slider');
    const radiusVal = document.getElementById('radius-val');
    
    // Initialisation de la carte OpenStreetMap
    function initMap() {
        // Centre par défaut sur le Maroc
        const defaultCenter = [31.7917, -7.0926];
        
        map = L.map('map').setView(defaultCenter, 6);
        
        // Tuile gratuite OpenStreetMap
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributeurs',
            maxZoom: 19,
            minZoom: 3
        }).addTo(map);
        
        // Ajouter les marqueurs des articles
        addMarkersToMap();
    }
    
    // Ajouter les marqueurs sur la carte
    function addMarkersToMap() {
        const articles = @json($nearbyArticles);
        
        articles.forEach(article => {
            if (article.latitude && article.longitude) {
                // Créer une icône personnalisée
                const customIcon = L.divIcon({
                    html: '<div class="w-8 h-8 bg-primary rounded-full flex items-center justify-center border-2 border-white shadow-lg"><span class="material-symbols-outlined text-white text-sm">location_on</span></div>',
                    iconSize: [32, 32],
                    popupAnchor: [0, -16],
                    className: 'custom-marker'
                });
                
                const marker = L.marker([article.latitude, article.longitude], { icon: customIcon }).addTo(map);
                
                marker.bindPopup(`
                    <div class="p-2 max-w-[200px]">
                        <h4 class="font-bold text-primary mb-1">${article.title}</h4>
                        <p class="text-sm text-gray-600 mb-2">${article.address || ''}</p>
                        <a href="/articles/${article.id}" class="text-primary text-sm font-semibold hover:underline inline-flex items-center gap-1">
                            Voir l'article <span class="material-symbols-outlined text-sm">arrow_forward</span>
                        </a>
                    </div>
                `);
                
                markers.push(marker);
            }
        });
        
        // Si des articles existent, centrer sur le premier
        if (articles.length > 0 && articles[0].latitude && articles[0].longitude) {
            map.setView([articles[0].latitude, articles[0].longitude], 12);
        }
    }
    
    // Zoom sur un marqueur spécifique
    function focusOnMarker(lat, lng) {
        map.setView([lat, lng], 15);
        markers.forEach(marker => {
            const markerLatLng = marker.getLatLng();
            if (Math.abs(markerLatLng.lat - lat) < 0.0001 && Math.abs(markerLatLng.lng - lng) < 0.0001) {
                marker.openPopup();
            }
        });
    }
    
    // Zoom in
    function zoomIn() {
        map.zoomIn();
    }
    
    // Zoom out
    function zoomOut() {
        map.zoomOut();
    }
    
    // Obtenir la position de l'utilisateur
    function getUserLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(position => {
                const userLat = position.coords.latitude;
                const userLng = position.coords.longitude;
                map.setView([userLat, userLng], 13);
                
                // Supprimer l'ancien marqueur utilisateur
                if (userMarker) {
                    map.removeLayer(userMarker);
                }
                
                // Icône utilisateur avec animation
                const userIcon = L.divIcon({
                    html: '<div class="w-4 h-4 bg-primary rounded-full border-2 border-white shadow-lg marker-pulse"></div>',
                    iconSize: [16, 16],
                    popupAnchor: [0, -8],
                    className: 'user-marker'
                });
                
                userMarker = L.marker([userLat, userLng], { icon: userIcon }).addTo(map);
                userMarker.bindPopup('📍 Votre position').openPopup();
                    
                // Rechercher les articles à proximité
                fetchNearbyArticles(userLat, userLng);
            }, error => {
                console.error('Erreur de géolocalisation:', error);
                alert('Impossible d\'obtenir votre position. Vérifiez vos paramètres de localisation.');
            });
        } else {
            alert('Géolocalisation non supportée par votre navigateur');
        }
    }
    
    // Rechercher des articles à proximité
    async function fetchNearbyArticles(lat, lng) {
        try {
            const response = await fetch(`{{ route("geo.nearby") }}?lat=${lat}&lng=${lng}&radius=${currentRadius}`);
            const data = await response.json();
            updateArticlesList(data);
            
            // Mettre à jour les marqueurs
            updateMarkers(data);
        } catch (error) {
            console.error('Error fetching nearby articles:', error);
        }
    }
    
    // Mettre à jour les marqueurs
    function updateMarkers(articles) {
        // Supprimer tous les anciens marqueurs
        markers.forEach(marker => {
            map.removeLayer(marker);
        });
        markers = [];
        
        // Ajouter les nouveaux marqueurs
        articles.forEach(article => {
            if (article.latitude && article.longitude) {
                const customIcon = L.divIcon({
                    html: '<div class="w-8 h-8 bg-primary rounded-full flex items-center justify-center border-2 border-white shadow-lg"><span class="material-symbols-outlined text-white text-sm">location_on</span></div>',
                    iconSize: [32, 32],
                    popupAnchor: [0, -16],
                    className: 'custom-marker'
                });
                
                const marker = L.marker([article.latitude, article.longitude], { icon: customIcon }).addTo(map);
                marker.bindPopup(`
                    <div class="p-2">
                        <h4 class="font-bold text-primary mb-1">${article.title}</h4>
                        <p class="text-sm text-gray-600 mb-2">${article.address || ''}</p>
                        <a href="/articles/${article.id}" class="text-primary text-sm font-semibold hover:underline">Voir l'article →</a>
                    </div>
                `);
                markers.push(marker);
            }
        });
    }
    
    // Mettre à jour la liste des articles
    function updateArticlesList(articles) {
        const container = document.getElementById('articlesList');
        if (articles.length === 0) {
            container.innerHTML = `
                <div class="text-center py-8 text-gray-500">
                    <span class="material-symbols-outlined text-4xl mb-2">location_off</span>
                    <p>Aucun article à proximité</p>
                </div>
            `;
            return;
        }
        
        container.innerHTML = articles.map(article => `
            <div class="group bg-white border border-gray-200 p-4 rounded-xl hover:shadow-md transition-all cursor-pointer" data-lat="${article.latitude}" data-lng="${article.longitude}" onclick="focusOnMarker(${article.latitude}, ${article.longitude})">
                <div class="flex justify-between items-start gap-3">
                    <div class="flex-1">
                        <h4 class="font-semibold text-gray-800 leading-snug group-hover:text-primary transition-colors">${article.title}</h4>
                        <div class="flex items-center gap-2 mt-2">
                            <span class="material-symbols-outlined text-[16px] text-gray-500">location_on</span>
                            <span class="text-sm font-medium text-gray-600">${article.address || 'Adresse non spécifiée'}</span>
                            ${article.distance ? `<span class="text-xs text-primary ml-2">${article.distance.toFixed(1)} km</span>` : ''}
                        </div>
                    </div>
                    <button onclick="event.stopPropagation(); focusOnMarker(${article.latitude}, ${article.longitude})" class="text-gray-500 p-2 hover:bg-gray-100 rounded-full transition-all">
                        <span class="material-symbols-outlined text-[20px]">map</span>
                    </button>
                </div>
            </div>
        `).join('');
    }
    
    // Mettre à jour le rayon de recherche
    function updateRadius() {
        const value = slider.value;
        currentRadius = parseInt(radiusMap[value]);
        radiusVal.textContent = radiusMap[value] + ' km';
        radiusVal.style.transform = 'scale(1.1)';
        setTimeout(() => radiusVal.style.transform = 'scale(1)', 150);
        
        // Recharger les articles à proximité
        const center = map.getCenter();
        fetchNearbyArticles(center.lat, center.lng);
    }
    
    // Rechercher une localisation (OpenStreetMap Nominatim)
    async function searchLocation(event) {
        if (event.key === 'Enter') {
            const query = event.target.value;
            if (!query) return;
            
            try {
                const response = await fetch(`https://nominatim.openstreetmap.org/search?q=${encodeURIComponent(query)}&format=json&limit=1`);
                const data = await response.json();
                
                if (data.length > 0) {
                    const location = data[0];
                    map.setView([location.lat, location.lon], 13);
                    fetchNearbyArticles(location.lat, location.lon);
                } else {
                    alert('Localisation non trouvée');
                }
            } catch (error) {
                console.error('Error searching location:', error);
                alert('Erreur lors de la recherche');
            }
        }
    }
    
    // Ouvrir le modal pour ajouter une adresse
    function openAddAddressModal() {
        const articleId = prompt('ID de l\'article à géolocaliser :\n\nPour voir vos articles, allez dans la section Articles');
        if (articleId && !isNaN(articleId)) {
            window.location.href = `/articles/${articleId}/edit?tab=location`;
        } else if (articleId) {
            alert('Veuillez entrer un ID valide');
        }
    }
    
    // Initialiser la carte au chargement
    document.addEventListener('DOMContentLoaded', initMap);
    
    // Animation d'entrée pour la sidebar
    document.querySelectorAll('#articlesList > div').forEach((item, index) => {
        item.style.opacity = '0';
        item.style.transform = 'translateY(10px)';
        setTimeout(() => {
            item.style.transition = 'all 0.3s ease-out';
            item.style.opacity = '1';
            item.style.transform = 'translateY(0)';
        }, 100 * index);
    });
    
    // Barre de recherche
    const searchInput = document.getElementById('searchCity');
    if (searchInput) {
        searchInput.addEventListener('keypress', searchLocation);
    }
</script>
@endpush