{{-- resources/views/dashboard/ai/create.blade.php --}}
@extends('layouts.app')

@section('title', 'Générateur d\'articles IA - NEARSEO')
@section('header-title', 'Générateur d\'articles IA')

@section('content')
<div class="max-w-[1400px] mx-auto">
    <!-- Header -->
    <div class="mb-8 flex flex-col md:flex-row md:items-end justify-between gap-4">
        <div>
            <div class="flex items-center gap-3 mb-2">
                <p class="text-gray-600">Créez du contenu stratégique optimisé pour le SEO en quelques secondes.</p>
                <span class="bg-green-100 text-green-700 text-[10px] font-extrabold px-2.5 py-1 rounded-full border border-green-200">3H → 30 SEC</span>
            </div>
        </div>
        <div class="hidden lg:flex items-center gap-2 bg-gray-100 px-4 py-2 rounded-lg border border-gray-200">
            <span class="material-symbols-outlined text-lg text-primary">bolt</span>
            <span class="text-sm font-semibold text-gray-700">Propulsé par l'agent NEARSEO</span>
        </div>
    </div>

    <div class="grid grid-cols-12 gap-8 items-start">
        
        <!-- Left Column: Configuration Form -->
        <div class="col-span-12 lg:col-span-5 space-y-6">
            
            {{-- ⭐ CARTE INFO COMMERCE (lecture seule) --}}
            <div class="bg-gradient-to-br from-primary/5 to-secondary/5 p-5 rounded-xl border-2 border-primary/20">
                <div class="flex items-start gap-3">
                    <div class="w-12 h-12 rounded-full bg-primary/10 flex items-center justify-center flex-shrink-0">
                        <span class="material-symbols-outlined text-primary text-2xl" style="font-variation-settings: 'FILL' 1;">storefront</span>
                    </div>
                    <div class="flex-1 min-w-0">
                        <h3 class="font-bold text-lg text-gray-900 truncate">
                            {{ auth()->user()->business_name ?? 'Mon commerce' }}
                        </h3>
                        <div class="text-sm text-gray-600 space-y-0.5 mt-1">
                            @if(auth()->user()->business_mode === 'local')
                                {{-- Mode local : adresse complète --}}
                                @if(auth()->user()->business_address)
                                    <p class="flex items-center gap-1">
                                        <span class="material-symbols-outlined text-sm text-gray-400">location_on</span>
                                        {{ auth()->user()->business_address }}
                                    </p>
                                @endif
                                @if(auth()->user()->business_city)
                                    <p class="flex items-center gap-1">
                                        <span class="material-symbols-outlined text-sm text-gray-400">location_city</span>
                                        {{ auth()->user()->business_district ? auth()->user()->business_district . ', ' : '' }}{{ auth()->user()->business_city }}, {{ auth()->user()->business_country }}
                                    </p>
                                @endif
                            @else
                                {{-- Mode online : site web --}}
                                @if(auth()->user()->business_website)
                                    <p class="flex items-center gap-1">
                                        <span class="material-symbols-outlined text-sm text-gray-400">public</span>
                                        {{ auth()->user()->business_website }}
                                    </p>
                                @endif
                            @endif
                            
                            @if(auth()->user()->business_category)
                                <p class="flex items-center gap-1">
                                    <span class="material-symbols-outlined text-sm text-gray-400" style="font-variation-settings: 'FILL' 1;">category</span>
                                    {{ auth()->user()->business_category }}
                                </p>
                            @endif
                        </div>
                        
                       <a href="{{ route('profile.edit') }}#business" 
   class="inline-flex items-center gap-1 text-xs text-primary font-semibold mt-2 hover:underline">
                            <span class="material-symbols-outlined text-sm">edit</span>
                            Modifier mes informations
                        </a>
                    </div>
                </div>
            </div>

            <div class="bg-white p-6 rounded-xl border shadow-sm">
                <div class="space-y-5">
                    
                    <!-- Sujet -->
                    <div class="space-y-2">
                        <label class="text-xs font-bold text-gray-500 uppercase flex items-center gap-1">
                            <span class="material-symbols-outlined text-sm text-gray-400">edit_note</span>
                            Sujet de l'article <span class="text-red-500">*</span>
                        </label>
                        <textarea id="subject" rows="4" 
                                  class="w-full rounded-lg border border-gray-300 p-3 focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all resize-none"
                                  placeholder="Ex: Pourquoi choisir notre boulangerie artisanale au cœur de Guéliz..."></textarea>
                    </div>

                    <!-- Options avancées (repliables) -->
                    <details class="border rounded-lg">
                        <summary class="cursor-pointer p-3 hover:bg-gray-50 text-sm font-semibold text-gray-700 flex items-center gap-2 rounded-lg">
                            <span class="material-symbols-outlined text-gray-400">tune</span>
                            Options avancées (facultatif)
                        </summary>
                        <div class="p-4 pt-0 space-y-4 border-t">
                            
                            {{-- Langue --}}
                            <div class="space-y-1">
                                <label class="text-xs font-bold text-gray-500 uppercase">Langue</label>
                                <select id="language" class="w-full rounded-lg border border-gray-300 px-3 py-2 bg-white text-sm">
                                    @php $prefLang = auth()->user()->preferences['language'] ?? 'fr'; @endphp
                                    <option value="fr" {{ $prefLang === 'fr' ? 'selected' : '' }}>🇫🇷 Français</option>
                                    <option value="en" {{ $prefLang === 'en' ? 'selected' : '' }}>🇬🇧 English</option>
                                    <option value="ar" {{ $prefLang === 'ar' ? 'selected' : '' }}>🇲🇦 العربية</option>
                                </select>
                            </div>

                            {{-- Ton --}}
                            <div class="space-y-1">
                                <label class="text-xs font-bold text-gray-500 uppercase">Ton</label>
                                <select id="tone" class="w-full rounded-lg border border-gray-300 px-3 py-2 bg-white text-sm">
                                    @php $prefTone = auth()->user()->preferences['preferred_tone'] ?? 'professional'; @endphp
                                    <option value="professional" {{ $prefTone === 'professional' ? 'selected' : '' }}>💼 Professionnel & Chaleureux</option>
                                    <option value="expert" {{ $prefTone === 'expert' ? 'selected' : '' }}>🎓 Expert / Autorité</option>
                                    <option value="storytelling" {{ $prefTone === 'storytelling' ? 'selected' : '' }}>📖 Storytelling</option>
                                </select>
                            </div>

                            {{-- Format --}}
                            <div class="space-y-1">
                                <label class="text-xs font-bold text-gray-500 uppercase">Format</label>
                                <select id="format" class="w-full rounded-lg border border-gray-300 px-3 py-2 bg-white text-sm">
                                    @php $prefFormat = auth()->user()->preferences['preferred_format'] ?? 'medium'; @endphp
                                    <option value="short" {{ $prefFormat === 'short' ? 'selected' : '' }}>Court (600 mots)</option>
                                    <option value="medium" {{ $prefFormat === 'medium' ? 'selected' : '' }}>Moyen (1000 mots)</option>
                                    <option value="long" {{ $prefFormat === 'long' ? 'selected' : '' }}>Long (1600 mots)</option>
                                </select>
                            </div>

                            {{-- Objectifs (mode local uniquement) --}}
                            @if(auth()->user()->business_mode === 'local')
                            <div class="space-y-2">
                                <label class="text-xs font-bold text-gray-500 uppercase">Objectifs</label>
                                <div class="grid grid-cols-2 gap-2">
                                    @php $prefGoals = auth()->user()->preferences['preferred_goals'] ?? []; @endphp
                                    <label class="flex items-center gap-2 p-2 border rounded-lg cursor-pointer hover:bg-gray-50 text-sm">
                                        <input type="checkbox" value="attirer_boutique" class="goal-checkbox accent-primary" 
                                               {{ in_array('attirer_boutique', $prefGoals) ? 'checked' : '' }}>
                                        🏪 Attirer
                                    </label>
                                    <label class="flex items-center gap-2 p-2 border rounded-lg cursor-pointer hover:bg-gray-50 text-sm">
                                        <input type="checkbox" value="appels" class="goal-checkbox accent-primary"
                                               {{ in_array('appels', $prefGoals) ? 'checked' : '' }}>
                                        📞 Appels
                                    </label>
                                    <label class="flex items-center gap-2 p-2 border rounded-lg cursor-pointer hover:bg-gray-50 text-sm">
                                        <input type="checkbox" value="promotion" class="goal-checkbox accent-primary"
                                               {{ in_array('promotion', $prefGoals) ? 'checked' : '' }}>
                                        🏷️ Promo
                                    </label>
                                    <label class="flex items-center gap-2 p-2 border rounded-lg cursor-pointer hover:bg-gray-50 text-sm">
                                        <input type="checkbox" value="reservations" class="goal-checkbox accent-primary"
                                               {{ in_array('reservations', $prefGoals) ? 'checked' : '' }}>
                                        📅 RDV
                                    </label>
                                </div>
                            </div>
                            @endif
                        </div>
                    </details>

                    <!-- Generate Button -->
                    <button id="generateBtn" onclick="generateArticle()"
                            class="w-full bg-secondary text-white py-4 rounded-xl font-semibold flex items-center justify-center gap-3 hover:shadow-lg active:scale-95 transition-all mt-4 group">
                        <span>Générer l'article avec l'agent NEARSEO</span>
                        <span class="material-symbols-outlined group-hover:rotate-180 transition-transform duration-500 text-white" style="font-variation-settings: 'FILL' 1;">auto_awesome</span>
                    </button>
                </div>
            </div>

            <!-- Conseils -->
            <div class="border-l-4 border-secondary bg-green-50 p-5 rounded-xl">
                <div class="flex items-start gap-3">
                    <span class="material-symbols-outlined text-secondary">lightbulb</span>
                    <div>
                        <h4 class="font-semibold text-secondary mb-1">Conseil NEARSEO</h4>
                        <p class="text-sm text-gray-600">
                            @if(auth()->user()->business_mode === 'local')
                                L'agent NEARSEO intègre automatiquement votre zone géographique ({{ auth()->user()->business_city ?? 'ville' }}) dans l'article pour un ciblage SEO ultra-précis.
                            @else
                                L'agent NEARSEO va générer un article optimisé pour votre site web avec un ton adapté à votre audience.
                            @endif
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Column: Preview + Suggestions -->
        <div class="col-span-12 lg:col-span-7 space-y-6">
            
            <!-- Tendances & Événements -->
            <div class="bg-white rounded-xl border shadow-sm p-4">
                <div class="flex items-center justify-between mb-3">
                    <h3 class="font-bold text-gray-900 flex items-center gap-2 text-sm">
                        <span class="material-symbols-outlined text-primary" style="font-variation-settings: 'FILL' 1;">trending_up</span>
                        Tendances & Événements
                    </h3>
                    <span class="text-xs text-gray-400">Mise à jour quotidienne</span>
                </div>
                
                @if(isset($trends) && !empty($trends))
                <div class="flex gap-3 overflow-x-auto pb-2" style="scrollbar-width: thin;">
                    @foreach($trends['google'] ?? [] as $trend)
                    <div onclick="selectTopic('{{ addslashes($trend['keyword']) }}')" 
                         class="min-w-[180px] max-w-[200px] p-3 bg-blue-50 rounded-lg hover:bg-blue-100 cursor-pointer transition-all group flex-shrink-0 border border-blue-100">
                        <p class="text-xs font-medium text-gray-900 group-hover:text-primary transition-colors line-clamp-2">
                            {{ $trend['keyword'] }}
                        </p>
                        <span class="text-[9px] text-blue-600 font-bold">📈 Tendance</span>
                    </div>
                    @endforeach

                    @foreach($trends['seasonal'] ?? [] as $event)
                    <div onclick="selectTopic('{{ addslashes($event) }}')" 
                         class="min-w-[160px] max-w-[180px] p-3 bg-orange-50 rounded-lg hover:bg-orange-100 cursor-pointer transition-all group flex-shrink-0 border border-orange-100">
                        <p class="text-xs font-medium text-gray-900 group-hover:text-primary transition-colors line-clamp-2">
                            {{ $event }}
                        </p>
                        <span class="text-[9px] text-orange-600 font-bold">🎯 Événement</span>
                    </div>
                    @endforeach
                </div>
                @else
                <div class="text-center py-4">
                    <span class="material-symbols-outlined text-3xl text-gray-300">trending_up</span>
                    <p class="text-xs text-gray-400 mt-1">Aucune tendance disponible</p>
                </div>
                @endif
            </div>
            
            <!-- Aperçu -->
            <div class="bg-white rounded-xl border shadow-sm flex flex-col">
                <!-- Preview Header -->
                <div class="p-4 border-b flex justify-between items-center bg-gray-50 rounded-t-xl">
                    <div class="flex items-center gap-3">
                        <span class="material-symbols-outlined text-gray-500">visibility</span>
                        <h2 class="font-semibold text-lg">Aperçu de l'article</h2>
                    </div>
                    <div class="flex items-center gap-2 bg-green-100 text-green-700 px-3 py-1 rounded-full border border-green-200">
                        <span class="material-symbols-outlined text-base text-green-600" style="font-variation-settings: 'FILL' 1;">auto_awesome</span>
                        <span class="text-[11px] font-bold uppercase tracking-wider">
                            {{ auth()->user()->business_mode === 'local' ? 'Mode Local' : 'Mode Global' }}
                        </span>
                    </div>
                </div>

                <!-- Empty State -->
                <div id="emptyState" class="flex-1 flex flex-col items-center justify-center p-12 text-center" style="min-height: 400px;">
                    <div class="w-24 h-24 bg-primary/5 rounded-full flex items-center justify-center mb-6 relative">
                        <span class="material-symbols-outlined text-5xl text-primary/30">article</span>
                        <div class="absolute -right-1 -bottom-1 w-10 h-10 bg-white rounded-full flex items-center justify-center shadow-md border">
                            <span class="material-symbols-outlined text-primary text-xl">auto_awesome</span>
                        </div>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-700 mb-2">Agent NEARSEO prêt</h3>
                    <p class="text-gray-500 max-w-sm text-base">
                        Écrivez votre sujet et cliquez sur "Générer".<br>
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
                        <button id="publishBtn" onclick="publishArticle()" disabled class="px-5 py-2 bg-gray-300 text-white rounded-lg text-sm font-bold cursor-not-allowed flex items-center gap-2">
                            <span class="material-symbols-outlined text-lg text-white">ios_share</span> 
                            Exporter
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .prose { max-width: none; }
    .prose h1 { font-size: 2rem; font-weight: 700; margin-bottom: 1rem; }
    .prose h2 { font-size: 1.5rem; font-weight: 600; margin-top: 1.5rem; margin-bottom: 0.75rem; }
    .prose h3 { font-size: 1.25rem; font-weight: 600; margin-top: 1rem; margin-bottom: 0.5rem; }
    .prose p { margin-bottom: 1rem; line-height: 1.6; }
    .prose ul, .prose ol { padding-left: 1.5rem; margin-bottom: 1rem; }
</style>
@endpush

@push('scripts')
<script>
    let generatedContent = '';
    let currentSeoScore = 0;

    function selectTopic(topic) {
        document.getElementById('subject').value = topic;
        document.getElementById('subject').focus();
        document.getElementById('subject').style.borderColor = '#8c4a2f';
        document.getElementById('subject').style.backgroundColor = '#f0f7ff';
        setTimeout(() => {
            document.getElementById('subject').style.borderColor = '';
            document.getElementById('subject').style.backgroundColor = '';
        }, 2000);
        document.getElementById('subject').scrollIntoView({ behavior: 'smooth', block: 'center' });
    }

    function showToast(message) {
        const toast = document.createElement('div');
        toast.innerHTML = message;
        toast.style.cssText = `
            position: fixed; bottom: 20px; right: 20px;
            background: #1a1a2e; color: white;
            padding: 12px 24px; border-radius: 12px;
            z-index: 9999; font-size: 14px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.3);
            max-width: 400px;
        `;
        document.body.appendChild(toast);
        setTimeout(() => {
            toast.style.opacity = '0';
            toast.style.transition = 'opacity 0.3s';
            setTimeout(() => toast.remove(), 300);
        }, 4000);
    }

    function updateSeoScore(score) {
        let circumference = 150;
        let offset = circumference - (score / 100) * circumference;
        let circle = document.getElementById('seoScoreCircle');
        if (circle) circle.style.strokeDashoffset = offset;
        document.getElementById('seoScore').innerText = score;
        let statusEl = document.getElementById('seoStatus');
        if (score >= 80) statusEl.innerHTML = '🏆 Excellent';
        else if (score >= 60) statusEl.innerHTML = '👍 Bon';
        else statusEl.innerHTML = '⚠️ À améliorer';
    }

    function enableActions() {
        let publishBtn = document.getElementById('publishBtn');
        let actionBar = document.getElementById('actionBar');
        if (publishBtn) {
            publishBtn.disabled = false;
            publishBtn.classList.remove('bg-gray-300', 'cursor-not-allowed');
            publishBtn.classList.add('bg-secondary', 'cursor-pointer', 'hover:bg-secondary/90', 'shadow-md');
        }
        if (actionBar) actionBar.classList.remove('opacity-50');
    }

    async function generateArticle() {
        const subject = document.getElementById('subject').value.trim();
        
        if (!subject) {
            showToast('❌ Veuillez saisir le sujet de l\'article');
            return;
        }
        
        const btn = document.getElementById('generateBtn');
        const originalHtml = btn.innerHTML;
        btn.innerHTML = '<span class="material-symbols-outlined animate-spin">sync</span> Génération en cours...';
        btn.disabled = true;
        
        document.getElementById('emptyState').classList.add('hidden');
        document.getElementById('articleContent').classList.remove('hidden');
        document.getElementById('articleContent').innerHTML = `
            <div class="space-y-4 animate-pulse">
                <div class="h-8 bg-gray-200 rounded w-3/4"></div>
                <div class="h-4 bg-gray-200 rounded w-full"></div>
                <div class="h-4 bg-gray-200 rounded w-5/6"></div>
                <div class="h-32 bg-gray-200 rounded w-full"></div>
            </div>
        `;
        
        // ✅ Payload MINIMAL — les infos du commerce sont prises côté serveur
        const payload = {
            subject: subject,
            language: document.getElementById('language').value,
            tone: document.getElementById('tone').value,
            format: document.getElementById('format').value,
            goals: Array.from(document.querySelectorAll('.goal-checkbox:checked')).map(cb => cb.value),
        };
        
        console.log('🔍 Payload envoyé:', payload);
        
        try {
            const controller = new AbortController();
            const timeoutId = setTimeout(() => controller.abort(), 120000);
            
            const response = await fetch('{{ route("ai.generate") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '',
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: JSON.stringify(payload),
                signal: controller.signal,
                credentials: 'same-origin'
            });
            
            clearTimeout(timeoutId);
            
            const contentType = response.headers.get('content-type') || '';
            const responseText = await response.text();
            
            console.log(`📡 Status: ${response.status}`);
            
            if (!contentType.includes('application/json')) {
                document.getElementById('articleContent').innerHTML = `
                    <div class="text-center py-12">
                        <span class="material-symbols-outlined text-5xl text-red-500">error</span>
                        <p class="text-red-600 mt-4 font-semibold">❌ Erreur serveur (${response.status})</p>
                        <pre class="mt-4 text-xs text-left bg-gray-100 p-4 rounded-lg">${responseText.substring(0, 500)}</pre>
                        <button onclick="generateArticle()" class="mt-4 px-6 py-2 bg-primary text-white rounded-lg">
                            Réessayer
                        </button>
                    </div>
                `;
                btn.innerHTML = originalHtml;
                btn.disabled = false;
                return;
            }
            
            const data = JSON.parse(responseText);
            console.log('📦 Response:', data);
            
            if (data.success) {
                showToast('✅ Article généré avec succès !');
                generatedContent = data.content || '';
                currentSeoScore = data.seo_score || 0;
                
                if (data.redirect_url) {
                    window.location.href = data.redirect_url;
                    return;
                }
                
                document.getElementById('articleContent').innerHTML = data.content || 'Contenu vide';
                if (data.seo_score) updateSeoScore(data.seo_score);
                if (data.word_count) {
                    document.getElementById('seoStatus').innerHTML = `📝 ${data.word_count} mots • Score: ${data.seo_score}%`;
                }
                enableActions();
            } else {
                document.getElementById('articleContent').innerHTML = `
                    <div class="text-center py-12">
                        <span class="material-symbols-outlined text-5xl text-red-500">error</span>
                        <p class="text-red-600 mt-4 font-semibold">❌ ${data.message || 'Génération échouée'}</p>
                        <button onclick="generateArticle()" class="mt-4 px-6 py-2 bg-primary text-white rounded-lg">
                            Réessayer
                        </button>
                    </div>
                `;
            }
        } catch (error) {
            console.error('❌ Error:', error);
            document.getElementById('articleContent').innerHTML = `
                <div class="text-center py-12">
                    <span class="material-symbols-outlined text-5xl text-red-500">wifi_off</span>
                    <p class="text-red-600 mt-4 font-semibold">❌ ${error.message || 'Erreur de connexion'}</p>
                    <button onclick="generateArticle()" class="mt-4 px-6 py-2 bg-primary text-white rounded-lg">
                        Réessayer
                    </button>
                </div>
            `;
        } finally {
            btn.innerHTML = originalHtml;
            btn.disabled = false;
        }
    }
    
    function publishArticle() {
        if (!generatedContent) return;
        let title = prompt('Titre de l\'article :', document.getElementById('subject').value);
        if (!title) return;
        
        fetch('{{ route("articles.store") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({
                title: title,
                content: generatedContent,
                seo_score: currentSeoScore,
                status: 'published'
            })
        }).then(response => {
            if (response.ok) {
                showToast('✅ Article publié !');
                setTimeout(() => window.location.href = '{{ route("articles.index") }}', 1000);
            } else {
                showToast('❌ Erreur');
            }
        });
    }
</script>
@endpush