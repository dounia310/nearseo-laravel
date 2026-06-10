@extends('layouts.app')
<!DOCTYPE html>
<html class="light" lang="fr">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>NEARSEO - Nouvel Article</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&amp;display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
    
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        primary: "#8c4a2f",
                        secondary: "#47664b",
                        background: "#f7f9ff",
                        "surface-container-lowest": "#ffffff",
                        "surface-container-low": "#edf4ff",
                        "outline-variant": "#d9c2ba",
                        "on-surface-variant": "#53433d",
                        "on-surface": "#091d2e",
                    }
                }
            }
        }
    </script>
    
    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
            vertical-align: middle;
        }
        .ai-glow {
            border-left: 4px solid #47664b;
            background-color: #f0f4f0;
        }
    </style>
</head>
<body class="bg-background text-on-surface font-body min-h-screen">
    </header>

    <!-- Main Content -->
    <main class="max-w-[1280px] mx-auto w-full p-6">
        <div class="mb-6">
            <h1 class="text-3xl font-bold text-on-surface">Nouvel Article</h1>
            <p class="text-on-surface-variant mt-1">Créez votre article manuellement ou utilisez l'IA</p>
        </div>
        
        <div class="grid grid-cols-12 gap-8">
            <!-- Left Column: Editor -->
            <div class="col-span-12 lg:col-span-8 space-y-4">
                <!-- SEO Metadata -->
                <div class="bg-white border rounded-lg p-6">
                    <div class="space-y-4">
                        <div>
                            <label class="text-xs font-bold text-on-surface-variant uppercase">Titre de l'article</label>
                            <input id="title" type="text" class="w-full mt-1 px-4 py-3 border rounded-lg focus:ring-1 focus:ring-primary" placeholder="Titre de votre article">
                        </div>
                        <div>
                            <label class="text-xs font-bold text-on-surface-variant uppercase">Meta description</label>
                            <textarea id="metaDescription" rows="2" class="w-full mt-1 px-4 py-3 border rounded-lg focus:ring-1 focus:ring-primary" placeholder="Courte description pour Google..."></textarea>
                        </div>
                        <div>
                            <label class="text-xs font-bold text-on-surface-variant uppercase">Mot-clé principal</label>
                            <input id="keyword" type="text" class="w-full mt-1 px-4 py-3 border rounded-lg focus:ring-1 focus:ring-primary" placeholder="ex: boulangerie lyon">
                        </div>
                    </div>
                </div>
                
                <!-- AI Assistant Toolbar -->
                <div class="ai-glow p-4 rounded-lg flex flex-wrap gap-2 items-center border border-secondary/20">
                    <div class="flex items-center gap-2 mr-2 text-secondary">
                        <span class="material-symbols-outlined">magic_button</span>
                        <span class="text-xs font-bold uppercase">Assistant IA</span>
                    </div>
                    <button type="button" onclick="generateIntroduction()" class="bg-white border px-3 py-2 rounded-lg text-sm hover:bg-gray-50 flex items-center gap-1">
                        <span class="material-symbols-outlined text-lg">add_circle</span> Introduction
                    </button>
                    <button type="button" onclick="generateConclusion()" class="bg-white border px-3 py-2 rounded-lg text-sm hover:bg-gray-50 flex items-center gap-1">
                        <span class="material-symbols-outlined text-lg">check_circle</span> Conclusion
                    </button>
                    <button type="button" onclick="optimizeSeo()" class="bg-white border px-3 py-2 rounded-lg text-sm hover:bg-gray-50 flex items-center gap-1">
                        <span class="material-symbols-outlined text-lg">trending_up</span> Optimiser SEO
                    </button>
                </div>
                
                <!-- Editor -->
                <div class="bg-white border rounded-lg overflow-hidden">
                    <div class="border-b p-3 flex items-center gap-2">
                        <button type="button" onclick="formatText('bold')" class="p-2 hover:bg-gray-100 rounded"><span class="material-symbols-outlined">format_bold</span></button>
                        <button type="button" onclick="formatText('italic')" class="p-2 hover:bg-gray-100 rounded"><span class="material-symbols-outlined">format_italic</span></button>
                        <button type="button" onclick="formatText('insertUnorderedList')" class="p-2 hover:bg-gray-100 rounded"><span class="material-symbols-outlined">format_list_bulleted</span></button>
                        <div class="w-px h-6 bg-gray-300 mx-1"></div>
                        <button type="button" onclick="insertLink()" class="p-2 hover:bg-gray-100 rounded"><span class="material-symbols-outlined">link</span></button>
                        <button type="button" onclick="insertImage()" class="p-2 hover:bg-gray-100 rounded"><span class="material-symbols-outlined">image</span></button>
                    </div>
                    <div id="editor" class="p-6 min-h-[500px] outline-none prose max-w-none" contenteditable="true">
                        <p>Commencez à écrire votre article ici...</p>
                    </div>
                    <div class="border-t p-3 flex justify-between text-sm text-on-surface-variant">
                        <span>Mots: <span id="wordCount">0</span></span>
                        <span>Temps de lecture: <span id="readTime">0</span> min</span>
                    </div>
                </div>
            </div>
            
            <!-- Right Column: SEO Panel -->
            <div class="col-span-12 lg:col-span-4 space-y-4">
                <!-- Score Card -->
                <div class="bg-white border rounded-lg p-6">
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
                        <label class="text-xs font-bold uppercase">Mot-clé principal</label>
                        <input id="seoKeyword" type="text" class="w-full mt-1 px-4 py-2 border rounded-lg" placeholder="Mot-clé">
                    </div>
                </div>
                
                <!-- Suggestions -->
                <div class="bg-white border rounded-lg p-6">
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
            </div>
        </div>
    </main>
    
    <!-- Sticky Footer -->
    <footer class="fixed bottom-0 left-64 right-0 bg-white border-t h-20 z-40 flex items-center justify-center">
        <div class="max-w-[1280px] w-full px-6 flex justify-between items-center">
            <div class="flex gap-4">
                <button onclick="saveArticle()" class="bg-white border px-6 py-2 rounded-lg hover:bg-gray-50 flex items-center gap-2">
                    <span class="material-symbols-outlined">save</span> Sauvegarder
                </button>
                <button onclick="scheduleArticle()" class="bg-white border p-2 rounded-lg hover:bg-gray-50">
                    <span class="material-symbols-outlined">schedule</span>
                </button>
            </div>
            <div>
                <button onclick="publishArticle()" class="bg-primary text-white px-10 py-2 rounded-lg hover:opacity-90 flex items-center gap-2">
                    Publier <span class="material-symbols-outlined">send</span>
                </button>
            </div>
        </div>
    </footer>
</div>

<script>
    let currentContent = '';
    let currentSeoScore = 0;
    
    // Editor content tracking
    const editor = document.getElementById('editor');
    editor.addEventListener('input', function() {
        currentContent = this.innerHTML;
        updateWordCount();
        analyzeSeo();
    });
    
    function updateWordCount() {
        const text = editor.innerText || '';
        const words = text.trim().split(/\s+/).filter(w => w.length > 0).length;
        document.getElementById('wordCount').innerHTML = words;
        const readTime = Math.max(1, Math.ceil(words / 200));
        document.getElementById('readTime').innerHTML = readTime;
    }
    
    function analyzeSeo() {
        const keyword = document.getElementById('seoKeyword').value;
        const content = editor.innerText || '';
        const title = document.getElementById('title').value;
        
        let score = 30;
        let positives = [];
        let suggestions = [];
        
        if (title.length > 0) {
            score += 10;
            positives.push('Titre renseigné');
        } else {
            suggestions.push('Ajoutez un titre');
        }
        
        if (keyword && content.toLowerCase().includes(keyword.toLowerCase())) {
            score += 20;
            positives.push('Mot-clé présent dans le contenu');
        } else if (keyword) {
            suggestions.push('Utilisez le mot-clé dans le contenu');
        }
        
        const wordCount = content.trim().split(/\s+/).filter(w => w.length > 0).length;
        if (wordCount > 500) {
            score += 15;
            positives.push('Plus de 500 mots');
        } else if (wordCount > 0) {
            suggestions.push('Ajoutez plus de contenu (500+ mots recommandé)');
        }
        
        if (content.includes('<h2>') || content.includes('<h3>')) {
            score += 15;
            positives.push('Structure H2/H3 présente');
        } else {
            suggestions.push('Ajoutez des sous-titres');
        }
        
        if (editor.innerHTML.includes('<img')) {
            score += 10;
            positives.push('Images présentes');
        } else {
            suggestions.push('Ajoutez des images');
        }
        
        currentSeoScore = Math.min(score, 100);
        updateSeoDisplay(currentSeoScore);
    }
    
    function updateSeoDisplay(score) {
        const circumference = 352;
        const offset = circumference - (score / 100) * circumference;
        document.getElementById('seoCircle').style.strokeDashoffset = offset;
        document.getElementById('seoScore').innerHTML = score;
    }
    
    async function saveArticle() {
        const data = {
            title: document.getElementById('title').value,
            meta_description: document.getElementById('metaDescription').value,
            focus_keyword: document.getElementById('keyword').value,
            content: currentContent,
            seo_score: currentSeoScore,
            status: 'draft'
        };
        
        try {
            const response = await fetch('{{ route("articles.store") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify(data)
            });
            
            if (response.ok) {
                alert('Article sauvegardé !');
            }
        } catch (error) {
            console.error('Error:', error);
        }
    }
    
    async function publishArticle() {
        await saveArticle();
        alert('Article publié !');
        window.location.href = '{{ route("articles.index") }}';
    }
    
    function formatText(command) {
        document.execCommand(command, false, null);
        editor.focus();
        updateWordCount();
        analyzeSeo();
    }
    
    function insertLink() {
        const url = prompt('URL :', 'https://');
        if (url) document.execCommand('createLink', false, url);
    }
    
    function insertImage() {
        const url = prompt('URL de l\'image :', 'https://');
        if (url) document.execCommand('insertImage', false, url);
    }
    
    function generateIntroduction() {
        alert('Fonctionnalité à venir');
    }
    
    function generateConclusion() {
        alert('Fonctionnalité à venir');
    }
    
    function optimizeSeo() {
        alert('Fonctionnalité à venir');
    }
    
    function scheduleArticle() {
        alert('Programmation à venir');
    }
</script>

</body>
</html>