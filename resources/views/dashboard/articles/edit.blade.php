@extends('layouts.app')

@section('title', 'Éditeur d\'article')
@section('header-title', 'Éditeur d\'article')

@section('content')
<div class="grid grid-cols-12 gap-6">
    <!-- Left Column: Editor -->
    <div class="col-span-12 lg:col-span-8 space-y-4">
        <!-- SEO Metadata Card -->
        <div class="bg-white border rounded-xl p-6 shadow-sm">
            <div class="space-y-4">
                <div>
                    <div class="flex justify-between items-end mb-2">
                        <label class="text-xs font-bold text-gray-500 uppercase">Titre SEO (H1)</label>
                        <span class="text-sm text-gray-400" id="titleCount">0 / 60</span>
                    </div>
                    <input type="text" id="articleTitle" value="{{ $article->title }}" class="w-full border rounded-lg px-4 py-3 focus:ring-1 focus:ring-primary focus:border-primary outline-none" oninput="updateSeoAnalysis()">
                </div>
                <div>
                    <div class="flex justify-between items-end mb-2">
                        <label class="text-xs font-bold text-gray-500 uppercase">Meta description</label>
                        <span class="text-sm text-gray-400" id="metaCount">0 / 160</span>
                    </div>
                    <textarea id="metaDescription" rows="2" class="w-full border rounded-lg px-4 py-3 focus:ring-1 focus:ring-primary focus:border-primary outline-none" oninput="updateSeoAnalysis()">{{ $article->meta_description ?? '' }}</textarea>
                </div>
            </div>
        </div>

        <!-- AI Assistant Toolbar -->
        <div class="bg-green-50 border-l-4 border-secondary p-4 rounded-lg flex flex-wrap gap-2 items-center">
            <div class="flex items-center gap-2 mr-2 text-secondary">
                <span class="material-symbols-outlined">magic_button</span>
                <span class="text-xs font-bold uppercase">Assistant IA</span>
            </div>
            <button onclick="generateIntroduction()" class="bg-white border px-3 py-2 rounded-lg text-sm hover:bg-gray-50 flex items-center gap-1">
                <span class="material-symbols-outlined text-lg">add_circle</span> Introduction
            </button>
            <button onclick="generateConclusion()" class="bg-white border px-3 py-2 rounded-lg text-sm hover:bg-gray-50 flex items-center gap-1">
                <span class="material-symbols-outlined text-lg">check_circle</span> Conclusion
            </button>
            <button onclick="suggestTitles()" class="bg-white border px-3 py-2 rounded-lg text-sm hover:bg-gray-50 flex items-center gap-1">
                <span class="material-symbols-outlined text-lg">lightbulb</span> Titres
            </button>
            <button onclick="optimizeSeo()" class="bg-white border px-3 py-2 rounded-lg text-sm hover:bg-gray-50 flex items-center gap-1">
                <span class="material-symbols-outlined text-lg">trending_up</span> Optimiser
            </button>
            <button onclick="rewriteForSocial()" class="bg-white border px-3 py-2 rounded-lg text-sm hover:bg-gray-50 flex items-center gap-1">
                <span class="material-symbols-outlined text-lg">share</span> Réseaux
            </button>
        </div>

        <!-- Editor Canvas -->
        <div class="bg-white border rounded-xl overflow-hidden shadow-sm">
            <div class="border-b p-3 flex flex-wrap gap-1">
                <button type="button" onclick="formatText('bold')" class="p-2 hover:bg-gray-100 rounded"><span class="material-symbols-outlined">format_bold</span></button>
                <button type="button" onclick="formatText('italic')" class="p-2 hover:bg-gray-100 rounded"><span class="material-symbols-outlined">format_italic</span></button>
                <button type="button" onclick="formatText('insertUnorderedList')" class="p-2 hover:bg-gray-100 rounded"><span class="material-symbols-outlined">format_list_bulleted</span></button>
                <button type="button" onclick="formatText('insertOrderedList')" class="p-2 hover:bg-gray-100 rounded"><span class="material-symbols-outlined">format_list_numbered</span></button>
                <div class="w-px h-6 bg-gray-300 mx-1"></div>
                <button type="button" onclick="insertLink()" class="p-2 hover:bg-gray-100 rounded"><span class="material-symbols-outlined">link</span></button>
                <button type="button" onclick="insertImage()" class="p-2 hover:bg-gray-100 rounded"><span class="material-symbols-outlined">image</span></button>
                <button type="button" onclick="undoEdit()" class="p-2 hover:bg-gray-100 rounded ml-auto"><span class="material-symbols-outlined">history</span></button>
            </div>
            <div id="editor" class="p-6 min-h-[500px] outline-none prose max-w-none" contenteditable="true">
                {!! $article->content !!}
            </div>
            <div class="border-t p-3 flex justify-between text-sm text-gray-500">
                <span>Dernière sauvegarde : <span id="lastSave">jamais</span></span>
                <div class="flex gap-4">
                    <span>Mots : <strong id="wordCount">0</strong></span>
                    <span>Temps de lecture : <strong id="readTime">0</strong> min</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Right Column: SEO Panel -->
    <div class="col-span-12 lg:col-span-4 space-y-4">
        <!-- Score Card -->
        <div class="bg-white border rounded-xl p-6 shadow-sm">
            <h3 class="font-semibold text-lg mb-4">Analyse SEO</h3>
            <div class="flex flex-col items-center">
                <div class="relative w-32 h-32">
                    <svg class="w-full h-full -rotate-90">
                        <circle cx="64" cy="64" r="56" fill="none" stroke="#e5e7eb" stroke-width="8"/>
                        <circle id="seoCircle" cx="64" cy="64" r="56" fill="none" stroke="#47664b" stroke-width="8" stroke-dasharray="352" stroke-dashoffset="352"/>
                    </svg>
                    <div class="absolute inset-0 flex items-center justify-center">
                        <span id="seoScore" class="text-3xl font-bold text-secondary">0</span>
                        <span class="text-sm">/100</span>
                    </div>
                </div>
            </div>
            <div class="mt-6">
                <label class="text-xs font-bold uppercase text-gray-500">Mot-clé principal</label>
                <div class="relative mt-1">
                    <input type="text" id="keywordInput" value="{{ $article->focus_keyword ?? 'meilleur fleuriste' }}" class="w-full border rounded-lg px-4 py-2 pr-10 focus:ring-1 focus:ring-primary" oninput="updateSeoAnalysis()">
                    <span class="material-symbols-outlined absolute right-3 top-2 text-green-600">check_circle</span>
                </div>
            </div>
        </div>

        <!-- Checklist Card -->
        <div class="bg-white border rounded-xl p-6 shadow-sm">
            <h4 class="text-secondary font-bold text-sm uppercase mb-3 flex items-center gap-2">
                <span class="material-symbols-outlined text-lg">thumb_up</span> Points positifs
            </h4>
            <ul id="positivePoints" class="space-y-2 text-sm">
                <li class="text-gray-500">En attente d'analyse...</li>
            </ul>
            
            <h4 class="text-tertiary font-bold text-sm uppercase mt-6 mb-3 flex items-center gap-2">
                <span class="material-symbols-outlined text-lg">warning</span> Suggestions
            </h4>
            <ul id="suggestions" class="space-y-2 text-sm">
                <li class="text-gray-500">Écrivez votre contenu pour voir l'analyse</li>
            </ul>
        </div>

        <!-- Google Preview -->
        <div class="bg-white border rounded-xl p-6 shadow-sm">
            <h4 class="font-semibold text-lg mb-4">Aperçu Google</h4>
            <div class="border rounded-lg p-4">
                <div class="text-xs text-gray-500 mb-1">https://nearseo.ai › blog</div>
                <div class="text-blue-600 text-lg font-medium hover:underline cursor-pointer" id="previewTitle">{{ $article->title }}</div>
                <div class="text-gray-600 text-sm" id="previewDescription">{{ $article->meta_description ?? 'Découvrez les meilleures stratégies pour améliorer votre visibilité locale...' }}</div>
            </div>
        </div>
    </div>
</div>

<!-- Sticky Footer -->
<footer class="fixed bottom-0 left-64 right-0 bg-white border-t h-20 z-40 flex items-center justify-center">
    <div class="max-w-7xl w-full px-6 flex justify-between items-center">
        <div class="flex gap-4">
            <button onclick="saveArticle()" class="bg-white border px-6 py-2 rounded-lg hover:bg-gray-50 flex items-center gap-2">
                <span class="material-symbols-outlined">save</span> Sauvegarder
            </button>
            <button onclick="scheduleArticle()" class="bg-white border p-2 rounded-lg hover:bg-gray-50">
                <span class="material-symbols-outlined">schedule</span>
            </button>
        </div>
        <div class="text-right">
            <p class="text-sm text-gray-500">Prêt à être publié</p>
            <p class="text-xs font-bold text-secondary uppercase" id="optimizationStatus">Optimisation : À améliorer</p>
        </div>
        <button onclick="publishArticle()" class="bg-primary text-white px-10 py-2 rounded-lg hover:opacity-90 flex items-center gap-2">
            Publier l'article <span class="material-symbols-outlined">send</span>
        </button>
    </div>
</footer>
@endsection

@push('scripts')
<script>
    let currentContent = {!! json_encode($article->content) !!};
    let currentSeoScore = {{ $article->seo_score ?? 0 }};
    let autoSaveTimer = null;
    
    // Initialisation
    const editor = document.getElementById('editor');
    
    function updateWordCount() {
        const text = editor.innerText || '';
        const words = text.trim().split(/\s+/).filter(function(w) { return w.length > 0; }).length;
        document.getElementById('wordCount').innerHTML = words;
        const readTime = Math.max(1, Math.ceil(words / 200));
        document.getElementById('readTime').innerHTML = readTime;
        return words;
    }
    
    function updateSeoAnalysis() {
        const title = document.getElementById('articleTitle').value;
        const metaDesc = document.getElementById('metaDescription').value;
        const keyword = document.getElementById('keywordInput').value;
        const content = editor.innerText || '';
        const wordCount = updateWordCount();
        
        let score = 30;
        let positives = [];
        let suggestions = [];
        
        // 1. Analyse du titre
        document.getElementById('titleCount').innerHTML = title.length + ' / 60';
        document.getElementById('previewTitle').innerHTML = title || 'Titre de l\'article';
        
        if (title.length > 0 && title.length <= 60) {
            score += 15;
            positives.push(' Titre optimisé (longueur idéale)');
        } else if (title.length > 0) {
            suggestions.push(' Titre trop long (max 60 caractères)');
        } else {
            suggestions.push(' Ajoutez un titre');
        }
        
        // 2. Analyse de la meta description
        document.getElementById('metaCount').innerHTML = metaDesc.length + ' / 160';
        document.getElementById('previewDescription').innerHTML = metaDesc || 'Description de l\'article...';
        
        if (metaDesc.length >= 120 && metaDesc.length <= 160) {
            score += 15;
            positives.push(' Meta description optimisée');
        } else if (metaDesc.length > 0) {
            suggestions.push(' Meta description: ' + metaDesc.length + '/160 caractères');
        } else {
            suggestions.push(' Ajoutez une meta description');
        }
        
        // 3. Analyse du mot-clé
        if (keyword) {
            const titleHasKeyword = title.toLowerCase().includes(keyword.toLowerCase());
            const metaHasKeyword = metaDesc.toLowerCase().includes(keyword.toLowerCase());
            const contentHasKeyword = content.toLowerCase().includes(keyword.toLowerCase());
            
            if (titleHasKeyword) {
                score += 10;
                positives.push(' Mot-clé présent dans le titre');
            } else {
                suggestions.push(' Ajoutez le mot-clé dans le titre');
            }
            
            if (metaHasKeyword) {
                score += 5;
                positives.push(' Mot-clé dans la meta description');
            }
            
            if (contentHasKeyword) {
                score += 10;
                positives.push(' Mot-clé présent dans le contenu');
            } else {
                suggestions.push(' Utilisez le mot-clé dans le contenu');
            }
            
            // Densité du mot-clé
            const keywordCount = (content.toLowerCase().match(new RegExp(keyword.toLowerCase(), 'g')) || []).length;
            const density = wordCount > 0 ? (keywordCount / wordCount) * 100 : 0;
            
            if (density >= 1 && density <= 3) {
                score += 10;
                positives.push(' Bonne densité du mot-clé (' + density.toFixed(1) + '%)');
            } else if (keywordCount > 0) {
                suggestions.push(' Densité du mot-clé: ' + density.toFixed(1) + '% (idéal: 1-3%)');
            }
        } else {
            suggestions.push(' Ajoutez un mot-clé principal');
        }
        
        // 4. Longueur du contenu
        if (wordCount > 1000) {
            score += 15;
            positives.push(' Excellent contenu (+1000 mots)');
        } else if (wordCount > 500) {
            score += 10;
            positives.push(' Bonne longueur (+500 mots)');
        } else if (wordCount > 300) {
            score += 5;
            positives.push('👍 Contenu correct (+300 mots)');
        } else if (wordCount > 0) {
            suggestions.push(' Ajoutez plus de contenu (500+ mots recommandé)');
        } else {
            suggestions.push(' Commencez à écrire votre contenu');
        }
        
        // 5. Structure (titres H2/H3)
        if (content.includes('<h2>') || content.includes('<h3>')) {
            score += 10;
            positives.push(' Structure H2/H3 présente');
        } else {
            suggestions.push(' Ajoutez des sous-titres (H2, H3)');
        }
        
        // 6. Images
        if (editor.innerHTML.includes('<img')) {
            score += 5;
            positives.push(' Images présentes');
        } else {
            suggestions.push('💡 Ajoutez des images pour enrichir');
        }
        
        // 7. Liens
        if (editor.innerHTML.includes('<a')) {
            score += 5;
            positives.push(' Liens présents');
        } else {
            suggestions.push('💡 Ajoutez des liens internes/externes');
        }
        
        currentSeoScore = Math.min(score, 100);
        updateSeoDisplay(currentSeoScore);
        
        // Mettre à jour les listes
        const positiveList = document.getElementById('positivePoints');
        positiveList.innerHTML = positives.length > 0 
            ? positives.map(function(p) { return '<li class="flex items-start gap-2 text-sm text-green-700"><span class="material-symbols-outlined text-green-600 text-base">check_circle</span> ' + p + '</li>'; }).join('')
            : '<li class="text-gray-500">Aucun point positif pour le moment</li>';
        
        const suggestionsList = document.getElementById('suggestions');
        suggestionsList.innerHTML = suggestions.length > 0
            ? suggestions.map(function(s) { return '<li class="flex items-start gap-2 text-sm text-orange-600"><span class="material-symbols-outlined text-orange-500 text-base">warning</span> ' + s + '</li>'; }).join('')
            : '<li class="text-green-600">🎉 Excellent ! Continuez comme ça !</li>';
        
        // Mettre à jour le statut
        const statusEl = document.getElementById('optimizationStatus');
        if (currentSeoScore >= 80) {
            statusEl.innerHTML = 'Optimisation : Excellente 🎉';
            statusEl.className = 'text-xs font-bold text-green-600 uppercase';
        } else if (currentSeoScore >= 60) {
            statusEl.innerHTML = 'Optimisation : Bonne 👍';
            statusEl.className = 'text-xs font-bold text-primary uppercase';
        } else {
            statusEl.innerHTML = 'Optimisation : À améliorer ⚠️';
            statusEl.className = 'text-xs font-bold text-tertiary uppercase';
        }
    }
    
    function updateSeoDisplay(score) {
        const circumference = 352;
        const offset = circumference - (score / 100) * circumference;
        const circle = document.getElementById('seoCircle');
        if (circle) circle.style.strokeDashoffset = offset;
        const scoreSpan = document.getElementById('seoScore');
        if (scoreSpan) scoreSpan.innerHTML = score;
    }
    
    // Écouter les changements dans l'éditeur
    editor.addEventListener('input', function() {
        currentContent = this.innerHTML;
        updateWordCount();
        updateSeoAnalysis();
        
        // Auto-save après 3 secondes d'inactivité
        if (autoSaveTimer) clearTimeout(autoSaveTimer);
        autoSaveTimer = setTimeout(saveArticle, 3000);
    });
    
    async function saveArticle() {
        const formData = {
            title: document.getElementById('articleTitle').value,
            meta_description: document.getElementById('metaDescription').value,
            content: currentContent,
            focus_keyword: document.getElementById('keywordInput').value,
            seo_score: currentSeoScore,
            status: 'draft'
        };
        
        try {
            const response = await fetch('{{ route("articles.update", $article) }}', {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify(formData)
            });
            
            if (response.ok) {
                document.getElementById('lastSave').innerHTML = 'à l\'instant';
                setTimeout(function() {
                    document.getElementById('lastSave').innerHTML = 'à ' + new Date().toLocaleTimeString();
                }, 3000);
            }
        } catch (error) {
            console.error('Save error:', error);
        }
    }
    
    async function publishArticle() {
        if (confirm('Publier cet article ?')) {
            const formData = {
                title: document.getElementById('articleTitle').value,
                meta_description: document.getElementById('metaDescription').value,
                content: currentContent,
                focus_keyword: document.getElementById('keywordInput').value,
                seo_score: currentSeoScore,
                status: 'published'
            };
            
            try {
                const response = await fetch('{{ route("articles.update", $article) }}', {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify(formData)
                });
                
                if (response.ok) {
                    alert('Article publié avec succès !');
                    window.location.href = '{{ route("articles.index") }}';
                }
            } catch (error) {
                console.error('Publish error:', error);
                alert('Erreur lors de la publication');
            }
        }
    }
    
    function formatText(command) {
        document.execCommand(command, false, null);
        editor.focus();
        updateSeoAnalysis();
    }
    
    function insertLink() {
        const url = prompt('URL :', 'https://');
        if (url) document.execCommand('createLink', false, url);
        updateSeoAnalysis();
    }
    
    function insertImage() {
        const url = prompt('URL de l\'image :', 'https://');
        if (url) document.execCommand('insertImage', false, url);
        updateSeoAnalysis();
    }
    
    function undoEdit() {
        document.execCommand('undo', false, null);
        updateSeoAnalysis();
    }
    
    function generateIntroduction() {
        alert('Fonctionnalité à venir : Génération d\'introduction par IA');
    }
    
    function generateConclusion() {
        alert('Fonctionnalité à venir : Génération de conclusion par IA');
    }
    
    function suggestTitles() {
        alert('Fonctionnalité à venir : Suggestions de titres IA');
    }
    
    function optimizeSeo() {
        alert('Fonctionnalité à venir : Optimisation SEO par IA');
    }
    
    function rewriteForSocial() {
        const platform = prompt('Plateforme : (instagram, twitter, linkedin, facebook)');
        if (platform) alert('Reformulation pour ' + platform + ' à venir');
    }
    
    function scheduleArticle() {
        const date = prompt('Date de publication (YYYY-MM-DD) :');
        if (date) alert('Article programmé pour le ' + date);
    }
    
    // Initialiser l'analyse au chargement
    document.addEventListener('DOMContentLoaded', function() {
        updateWordCount();
        updateSeoAnalysis();
    });
</script>
@endpush