@extends('layouts.app')

@section('title', 'Nouvel Article')
@section('header-title', 'Créer un nouvel article')

@section('content')
<div class="max-w-[1280px] mx-auto w-full p-6">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-on-surface">Nouvel Article</h1>
        <p class="text-on-surface-variant mt-1">Rédigez manuellement ou utilisez l'assistant IA</p>
    </div>

    <div class="grid grid-cols-12 gap-8">
        
        <!-- Left Column: Éditeur -->
        <div class="col-span-12 lg:col-span-8 space-y-6">
            
            <!-- SEO Metadata -->
            <div class="bg-white border rounded-xl p-6 shadow-sm">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label class="text-xs font-bold text-on-surface-variant uppercase tracking-wider">Titre de l'article</label>
                        <input id="title" 
                               type="text" 
                               class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent"
                               placeholder="Ex: La meilleure boulangerie artisanale de Lyon 6">
                    </div>
                    <div class="space-y-2">
                        <label class="text-xs font-bold text-on-surface-variant uppercase tracking-wider">Mot-clé principal</label>
                        <input id="keyword" 
                               type="text" 
                               class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent"
                               placeholder="boulangerie lyon 6">
                    </div>
                </div>
                
                <div class="mt-6 space-y-2">
                    <label class="text-xs font-bold text-on-surface-variant uppercase tracking-wider">Meta Description</label>
                    <textarea id="metaDescription" 
                              rows="2"
                              class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent"
                              placeholder="Description courte pour les résultats Google..."></textarea>
                </div>
            </div>

            <!-- AI Assistant Toolbar -->
            <div class="ai-glow p-4 rounded-xl border border-secondary/30 bg-white">
                <div class="flex items-center gap-3 flex-wrap">
                    <div class="flex items-center gap-2 text-secondary font-semibold">
                        <span class="material-symbols-outlined">auto_awesome</span>
                        <span class="text-sm uppercase tracking-wider">Assistant IA</span>
                    </div>
                    <button onclick="generateIntroduction()" 
                            class="flex items-center gap-2 px-4 py-2 bg-white border rounded-lg hover:bg-gray-50 text-sm">
                        <span class="material-symbols-outlined">add_circle</span>
                        Introduction
                    </button>
                    <button onclick="generateConclusion()" 
                            class="flex items-center gap-2 px-4 py-2 bg-white border rounded-lg hover:bg-gray-50 text-sm">
                        <span class="material-symbols-outlined">check_circle</span>
                        Conclusion
                    </button>
                    <button onclick="optimizeSeo()" 
                            class="flex items-center gap-2 px-4 py-2 bg-white border rounded-lg hover:bg-gray-50 text-sm">
                        <span class="material-symbols-outlined">trending_up</span>
                        Optimiser SEO
                    </button>
                </div>
            </div>

            <!-- Rich Editor -->
            <div class="bg-white border rounded-xl overflow-hidden shadow-sm">
                <!-- Toolbar -->
                <div class="border-b p-3 flex items-center gap-2 bg-gray-50">
                    <button onclick="formatText('bold')" class="p-2 hover:bg-white rounded-lg transition-colors" title="Gras">
                        <span class="material-symbols-outlined">format_bold</span>
                    </button>
                    <button onclick="formatText('italic')" class="p-2 hover:bg-white rounded-lg transition-colors" title="Italique">
                        <span class="material-symbols-outlined">format_italic</span>
                    </button>
                    <button onclick="formatText('insertUnorderedList')" class="p-2 hover:bg-white rounded-lg transition-colors" title="Liste">
                        <span class="material-symbols-outlined">format_list_bulleted</span>
                    </button>
                    <button onclick="formatText('insertOrderedList')" class="p-2 hover:bg-white rounded-lg transition-colors" title="Liste numérotée">
                        <span class="material-symbols-outlined">format_list_numbered</span>
                    </button>
                    <div class="w-px h-6 bg-gray-300 mx-2"></div>
                    <button onclick="insertLink()" class="p-2 hover:bg-white rounded-lg transition-colors" title="Lien">
                        <span class="material-symbols-outlined">link</span>
                    </button>
                    <button onclick="insertImage()" class="p-2 hover:bg-white rounded-lg transition-colors" title="Image">
                        <span class="material-symbols-outlined">image</span>
                    </button>
                </div>

                <!-- Contenteditable -->
                <div id="editor" 
                     contenteditable="true"
                     class="p-8 min-h-[520px] outline-none prose max-w-none focus:outline-none">
                    <p>Commencez à rédiger votre article ici...</p>
                </div>

                <!-- Footer stats -->
                <div class="border-t px-6 py-3 flex justify-between text-sm text-on-surface-variant bg-gray-50">
                    <span>Mots : <span id="wordCount" class="font-semibold text-on-surface">0</span></span>
                    <span>Temps de lecture : <span id="readTime" class="font-semibold text-on-surface">0</span> min</span>
                </div>
            </div>
        </div>

        <!-- Right Column: SEO Panel -->
        <div class="col-span-12 lg:col-span-4 space-y-6">
            
            <!-- SEO Score -->
            <div class="bg-white border rounded-xl p-6 shadow-sm">
                <h3 class="font-semibold text-lg mb-5">Analyse SEO</h3>
                <div class="flex flex-col items-center">
                    <div class="relative w-40 h-40">
                        <svg class="w-full h-full -rotate-90" viewBox="0 0 128 128">
                            <circle cx="64" cy="64" r="56" fill="none" stroke="#e5e7eb" stroke-width="12"/>
                            <circle id="seoCircle" 
                                    cx="64" cy="64" r="56" 
                                    fill="none" 
                                    stroke="#47664b" 
                                    stroke-width="12"
                                    stroke-dasharray="352"
                                    stroke-dashoffset="352"
                                    stroke-linecap="round"/>
                        </svg>
                        <div class="absolute inset-0 flex flex-col items-center justify-center">
                            <span id="seoScore" class="text-5xl font-bold text-secondary">0</span>
                            <span class="text-sm text-on-surface-variant">/100</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Suggestions -->
            <div class="bg-white border rounded-xl p-6 shadow-sm">
                <h4 class="font-bold text-secondary text-sm uppercase mb-4 flex items-center gap-2">
                    <span class="material-symbols-outlined">thumb_up</span>
                    Points positifs
                </h4>
                <ul id="positivePoints" class="space-y-2 text-sm text-gray-600">
                    <li class="text-gray-400">• Rédigez pour voir l’analyse</li>
                </ul>

                <h4 class="font-bold text-amber-600 text-sm uppercase mt-8 mb-4 flex items-center gap-2">
                    <span class="material-symbols-outlined">warning</span>
                    Suggestions d’amélioration
                </h4>
                <ul id="suggestions" class="space-y-2 text-sm text-gray-600">
                    <li class="text-gray-400">• Rédigez pour voir les suggestions</li>
                </ul>
            </div>
        </div>
    </div>
</div>

<!-- Sticky Footer -->
<footer class="fixed bottom-0 left-0 right-0 bg-white border-t z-50 lg:left-64">
    <div class="max-w-[1280px] mx-auto px-6 py-5 flex justify-between items-center">
        <div class="flex items-center gap-4">
            <button onclick="saveArticle()" 
                    class="flex items-center gap-2 px-6 py-3 border rounded-xl hover:bg-gray-50 transition-colors font-medium">
                <span class="material-symbols-outlined">save</span>
                Sauvegarder comme brouillon
            </button>
        </div>
        
        <button onclick="publishArticle()" 
                class="flex items-center gap-3 bg-primary text-white px-10 py-3 rounded-xl font-semibold hover:opacity-90 transition-all">
            Publier l'article
            <span class="material-symbols-outlined">send</span>
        </button>
    </div>
</footer>
@endsection

@push('scripts')
<script>
    const editor = document.getElementById('editor');
    let currentSeoScore = 0;

    // Mise à jour stats en temps réel
    editor.addEventListener('input', () => {
        updateWordCount();
        analyzeSeo();
    });

    function updateWordCount() {
        const text = editor.innerText.trim();
        const words = text.split(/\s+/).filter(Boolean).length;
        document.getElementById('wordCount').textContent = words;
        const readTime = Math.max(1, Math.ceil(words / 200));
        document.getElementById('readTime').textContent = readTime;
    }

    function analyzeSeo() {
        const keyword = document.getElementById('keyword').value.toLowerCase();
        const title = document.getElementById('title').value;
        const content = editor.innerText.toLowerCase();
        
        let score = 40;
        let positives = [];
        let suggestions = [];

        if (title.length > 10) {
            score += 15;
            positives.push("Titre bien renseigné");
        } else {
            suggestions.push("Ajoutez un titre attractif");
        }

        if (keyword && content.includes(keyword)) {
            score += 25;
            positives.push("Mot-clé principal présent");
        } else if (keyword) {
            suggestions.push("Intégrez le mot-clé principal dans le texte");
        }

        const wordCount = editor.innerText.trim().split(/\s+/).filter(Boolean).length;
        if (wordCount > 600) {
            score += 15;
            positives.push("Contenu suffisamment long");
        } else if (wordCount > 300) {
            suggestions.push("Visez au moins 600 mots pour un bon article local");
        }

        if (editor.innerHTML.includes('<h2>') || editor.innerHTML.includes('<h3>')) {
            score += 15;
            positives.push("Structure avec sous-titres");
        } else {
            suggestions.push("Ajoutez des H2 et H3");
        }

        currentSeoScore = Math.min(Math.max(score, 0), 100);
        updateSeoDisplay(currentSeoScore);
    }

    function updateSeoDisplay(score) {
        const circumference = 352;
        const offset = circumference - (score / 100) * circumference;
        document.getElementById('seoCircle').style.strokeDashoffset = offset;
        document.getElementById('seoScore').textContent = score;
    }

    // Fonctions d'édition
    function formatText(command) {
        document.execCommand(command, false, null);
        editor.focus();
        updateWordCount();
        analyzeSeo();
    }

    function insertLink() {
        const url = prompt("URL du lien :", "https://");
        if (url) document.execCommand('createLink', false, url);
    }

    function insertImage() {
        const url = prompt("URL de l'image :", "https://");
        if (url) document.execCommand('insertImage', false, url);
    }

    // Fonctions IA (à implémenter plus tard)
    function generateIntroduction() { alert('Génération d\'introduction IA à venir'); }
    function generateConclusion() { alert('Génération de conclusion IA à venir'); }
    function optimizeSeo() { alert('Optimisation SEO IA à venir'); }

    // Sauvegarde & Publication
    async function saveArticle() {
        const data = {
            title: document.getElementById('title').value,
            meta_description: document.getElementById('metaDescription').value,
            focus_keyword: document.getElementById('keyword').value,
            content: editor.innerHTML,
            seo_score: currentSeoScore,
            status: 'draft'
        };

        // Ajouter ici votre appel fetch vers le controller
        alert('Article sauvegardé en brouillon !');
    }

    async function publishArticle() {
        if (!document.getElementById('title').value) {
            alert("Veuillez renseigner un titre avant de publier.");
            return;
        }
        await saveArticle();
        alert('Article publié avec succès !');
        // window.location.href = '{{ route("articles.index") }}';
    }

    // Initialisation
    document.addEventListener('DOMContentLoaded', () => {
        updateWordCount();
        analyzeSeo();
    });
</script>
@endpush