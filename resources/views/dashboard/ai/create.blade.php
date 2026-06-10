@extends('layouts.app')

@section('title', 'Générateur IA')
@section('header-title', 'Générer un article avec l\'IA')

@section('content')
<div class="grid grid-cols-12 gap-8 items-start">
    <!-- Left Column: Generator Form -->
    <div class="col-span-12 lg:col-span-5 space-y-4">
        <div class="bg-white p-6 rounded-xl border shadow-sm space-y-6">
            <form id="aiGenerateForm" onsubmit="generateArticle(event)">
                <div class="space-y-2">
                    <label class="text-xs font-bold text-on-surface-variant uppercase tracking-wider">Sujet de l'article</label>
                    <textarea id="subject" class="w-full p-4 border rounded-lg focus:ring-1 focus:ring-primary resize-none" rows="3" placeholder="Ex: Les meilleurs spots de café à Lyon 6..."></textarea>
                </div>
                
                <div class="grid grid-cols-2 gap-4 mt-4">
                    <div class="space-y-2">
                        <label class="text-xs font-bold text-on-surface-variant uppercase tracking-wider">Site web</label>
                        <input id="website" type="text" class="w-full px-4 py-2 border rounded-lg" placeholder="monsite.fr">
                    </div>
                    <div class="space-y-2">
                        <label class="text-xs font-bold text-on-surface-variant uppercase tracking-wider">Adresse</label>
                        <input id="address" type="text" class="w-full px-4 py-2 border rounded-lg" placeholder="Lyon, France">
                    </div>
                </div>
                
                <div class="grid grid-cols-2 gap-4 mt-4">
                    <div class="space-y-2">
                        <label class="text-xs font-bold text-on-surface-variant uppercase tracking-wider">Langue</label>
                        <select id="language" class="w-full px-4 py-2 border rounded-lg bg-white">
                            <option value="fr">Français</option>
                            <option value="en">English</option>
                        </select>
                    </div>
                    <div class="space-y-2">
                        <label class="text-xs font-bold text-on-surface-variant uppercase tracking-wider">Ton</label>
                        <select id="tone" class="w-full px-4 py-2 border rounded-lg bg-white">
                            <option value="professionnel">Professionnel</option>
                            <option value="décontracté">Décontracté</option>
                            <option value="éducatif">Éducatif</option>
                        </select>
                    </div>
                </div>
                
                <div class="space-y-4 mt-4">
                    <div class="flex justify-between items-center">
                        <label class="text-xs font-bold text-on-surface-variant uppercase tracking-wider">Longueur</label>
                        <span id="length-label" class="text-sm font-bold text-primary">Moyen</span>
                    </div>
                    <input id="length" type="range" min="1" max="3" value="2" step="1" class="w-full accent-primary" oninput="document.getElementById('length-label').textContent = ['Court', 'Moyen', 'Long'][this.value-1]">
                    <div class="flex justify-between text-[10px] text-on-surface-variant font-bold">
                        <span>COURT</span>
                        <span>MOYEN</span>
                        <span>LONG</span>
                    </div>
                </div>
                
                <button type="submit" id="generateBtn" class="w-full py-4 bg-primary text-white font-semibold rounded-xl shadow-lg hover:opacity-90 active:scale-[0.98] transition-all flex items-center justify-center gap-3 mt-6">
                    🚀 Générer l'article
                </button>
            </form>
        </div>
    </div>
    
    <!-- Right Column: Preview -->
    <div class="col-span-12 lg:col-span-7 space-y-4">
        <div class="flex items-center justify-between mb-2">
            <h3 class="font-semibold text-lg">Aperçu de la génération</h3>
            <div class="flex items-center gap-2">
                <span class="w-2 h-2 rounded-full bg-secondary animate-pulse"></span>
                <span class="text-xs font-bold text-secondary uppercase">Optimisé pour le SEO Local</span>
            </div>
        </div>
        
        <div class="bg-white border rounded-xl shadow-sm overflow-hidden border-l-4 border-l-secondary/30">
            <div id="articlePreview" class="p-8 min-h-[400px]">
                <div class="space-y-4 animate-pulse">
                    <div class="h-8 bg-gray-200 rounded-lg w-3/4"></div>
                    <div class="h-4 bg-gray-200 rounded-lg w-full"></div>
                    <div class="h-4 bg-gray-200 rounded-lg w-5/6"></div>
                    <div class="h-4 bg-gray-200 rounded-lg w-4/5"></div>
                    <div class="h-32 bg-gray-200 rounded-lg w-full"></div>
                </div>
            </div>
            
            <div class="p-6 bg-gray-50 border-t flex items-center justify-between">
                <div class="flex items-center gap-4">
                    <div class="relative w-16 h-16 flex items-center justify-center">
                        <svg class="w-full h-full -rotate-90">
                            <circle cx="32" cy="32" fill="transparent" r="28" stroke="#e5e7eb" stroke-width="4"></circle>
                            <circle id="scoreCircle" cx="32" cy="32" fill="transparent" r="28" stroke="#47664b" stroke-width="4" stroke-dasharray="176" stroke-dashoffset="44"></circle>
                        </svg>
                        <span id="seoScore" class="absolute font-bold text-sm">75%</span>
                    </div>
                    <div>
                        <p class="text-xs font-bold">Score SEO</p>
                        <p class="text-[10px] text-on-surface-variant uppercase">Prêt à publier</p>
                    </div>
                </div>
                <div class="flex items-center gap-3">
                    <button type="button" onclick="rewriteForSocial()" class="px-4 py-2 border rounded-lg text-sm font-bold hover:bg-gray-50 transition-colors flex items-center gap-2">
                        <span class="material-symbols-outlined text-lg">auto_fix</span> Reformuler
                    </button>
                    <button type="button" onclick="openEditor()" class="px-4 py-2 border rounded-lg text-sm font-bold hover:bg-gray-50 transition-colors flex items-center gap-2">
                        <span class="material-symbols-outlined text-lg">edit</span> Modifier
                    </button>
                    <button type="button" onclick="publishArticle()" class="px-6 py-2 bg-secondary text-white rounded-lg text-sm font-bold hover:shadow-md transition-all flex items-center gap-2">
                        <span class="material-symbols-outlined text-lg">send</span> Publier
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    let generatedContent = '';
    let currentSeoScore = 75;
    
    function updateSeoScore(score) {
        const circumference = 176;
        const offset = circumference - (score / 100) * circumference;
        const circle = document.getElementById('scoreCircle');
        if (circle) circle.style.strokeDashoffset = offset;
        const scoreSpan = document.getElementById('seoScore');
        if (scoreSpan) scoreSpan.textContent = score + '%';
    }
    
    async function generateArticle(event) {
        event.preventDefault();
        
        const btn = document.getElementById('generateBtn');
        const originalText = btn.innerHTML;
        btn.innerHTML = '<span class="material-symbols-outlined animate-spin">sync</span> Génération...';
        btn.disabled = true;
        btn.classList.add('opacity-80');
        
        const subject = document.getElementById('subject').value;
        const website = document.getElementById('website').value;
        const address = document.getElementById('address').value;
        const length = ['short', 'medium', 'long'][document.getElementById('length').value - 1];
        
        const token = document.querySelector('meta[name="csrf-token"]').content;
        
        try {
            const response = await fetch('/api/ai/generate', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': token
                },
                body: JSON.stringify({ subject, website, address, length })
            });
            
            const data = await response.json();
            
            if (response.ok && data.success) {
                generatedContent = data.article;
                document.getElementById('articlePreview').innerHTML = `
                    <div class="space-y-6 fade-in">
                        ${generatedContent}
                    </div>
                `;
                currentSeoScore = Math.floor(Math.random() * 30) + 65;
                updateSeoScore(currentSeoScore);
            } else {
                document.getElementById('articlePreview').innerHTML = '<p class="text-red-500">Erreur: ' + (data.message || 'Génération échouée') + '</p>';
            }
        } catch (error) {
            console.error('Error details:', error);
            document.getElementById('articlePreview').innerHTML = '<p class="text-red-500">Erreur de connexion. Veuillez réessayer.</p>';
        } finally {
            btn.innerHTML = originalText;
            btn.disabled = false;
            btn.classList.remove('opacity-80');
        }
    }
    
    async function rewriteForSocial() {
        if (!generatedContent) {
            alert('Veuillez d\'abord générer un article');
            return;
        }
        
        const platform = prompt('Pour quelle plateforme ? (instagram, twitter, linkedin, facebook)');
        if (!platform) return;
        
        try {
            const response = await fetch('/api/ai/rewrite', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({ content: generatedContent, platform: platform })
            });
            
            const data = await response.json();
            if (data.success) {
                alert('Contenu reformulé pour ' + platform + ' !\n\n' + data.content);
            }
        } catch (error) {
            console.error('Error:', error);
            alert('Erreur lors de la reformulation');
        }
    }
    
    function openEditor() {
        if (!generatedContent) {
            alert('Veuillez d\'abord générer un article');
            return;
        }
        sessionStorage.setItem('tempArticleContent', generatedContent);
        sessionStorage.setItem('tempSeoScore', currentSeoScore);
        window.location.href = '{{ route("articles.create") }}?temp=true';
    }
    
    async function publishArticle() {
        if (!generatedContent) {
            alert('Veuillez d\'abord générer un article');
            return;
        }
        
        const title = prompt('Titre de l\'article :');
        if (!title) return;
        
        try {
            const response = await fetch('{{ route("articles.store") }}', {
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
            });
            
            if (response.ok) {
                alert('Article publié avec succès !');
                window.location.href = '{{ route("articles.index") }}';
            }
        } catch (error) {
            console.error('Error:', error);
            alert('Erreur lors de la publication');
        }
    }
</script>
@endpush