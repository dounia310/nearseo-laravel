{{-- resources/views/dashboard/articles/edit.blade.php --}}
@extends('layouts.app')

@section('title', "Éditeur d'article")
@section('header-title', "Éditeur d'article")

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
                    <input type="text" id="articleTitle" value="{{ $article->title ?? '' }}" 
                           class="w-full border rounded-lg px-4 py-3 focus:ring-1 focus:ring-primary focus:border-primary outline-none">
                </div>
                <div>
                    <div class="flex justify-between items-end mb-2">
                        <label class="text-xs font-bold text-gray-500 uppercase">Meta description</label>
                        <span class="text-sm text-gray-400" id="metaCount">0 / 160</span>
                    </div>
                    <textarea id="metaDescription" rows="2" 
                              class="w-full border rounded-lg px-4 py-3 focus:ring-1 focus:ring-primary focus:border-primary outline-none">{{ $article->meta_description ?? '' }}</textarea>
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

        <!-- Editor.js Container -->
        <div class="bg-white border rounded-xl overflow-hidden shadow-sm">
            <div class="border-b p-3 bg-gray-50 flex justify-between items-center">
                <div class="flex items-center gap-2 text-sm text-gray-500">
                    <span>📝 Éditeur</span>
                    <span class="text-gray-300">|</span>
                    <span id="editorStatus" class="text-green-600">Prêt</span>
                </div>
                <div class="flex items-center gap-4 text-sm text-gray-400">
                    <span>Mots: <strong id="wordCount">0</strong></span>
                    <span>Lecture: <strong id="readTime">0</strong> min</span>
                </div>
            </div>
            
            @php
                $contentData = null;
                if (!empty($article->content_json)) {
                    $contentData = $article->content_json;
                } elseif (!empty($article->content)) {
                    $contentData = $article->convertHtmlToEditorJs($article->content);
                }
            @endphp
            
            <div id="editorjs" 
                 data-article-id="{{ $article->id }}"
data-content='@json($contentData)'
            </div>
        </div>

        <!-- Planification Section -->
        <div class="bg-white rounded-xl shadow-sm p-6 mt-6 border">
            <h3 class="text-lg font-semibold mb-4 flex items-center gap-2">
                <span class="material-symbols-outlined text-primary">schedule</span>
                Planification de publication
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Date de publication</label>
                    <input type="date" id="scheduled_date" 
                           class="w-full border rounded-lg px-4 py-2 focus:ring-1 focus:ring-primary focus:border-primary outline-none">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Heure de publication</label>
                    <input type="time" id="scheduled_time" 
                           class="w-full border rounded-lg px-4 py-2 focus:ring-1 focus:ring-primary focus:border-primary outline-none">
                </div>
            </div>
            <div class="mt-4">
                <label class="flex items-center gap-2">
                    <input type="checkbox" id="enable_scheduling" class="rounded text-primary">
                    <span class="text-sm">Planifier la publication automatique</span>
                </label>
            </div>
            <div id="scheduling_info" class="mt-3 text-sm text-gray-500 hidden">
                📅 L'article sera publié automatiquement le <span id="display_date"></span>
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
                        <circle id="seoCircle" cx="64" cy="64" r="56" fill="none" stroke="#47664b" stroke-width="8" 
                                stroke-dasharray="352" stroke-dashoffset="{{ 352 - (($article->seo_score ?? 0) / 100) * 352 }}"/>
                    </svg>
                    <div class="absolute inset-0 flex items-center justify-center">
                        <span id="seoScore" class="text-3xl font-bold text-secondary">{{ $article->seo_score ?? 0 }}</span>
                        <span class="text-sm">/100</span>
                    </div>
                </div>
                <div id="seoGrade" class="text-sm font-bold mt-2 text-primary">
                    {{ $article->seo_grade ?? 'F' }}
                </div>
            </div>
            <div class="mt-6">
                <label class="text-xs font-bold uppercase text-gray-500">Mot-clé principal</label>
                <div class="relative mt-1">
                    <input type="text" id="keywordInput" value="{{ $article->focus_keyword ?? '' }}" 
                           class="w-full border rounded-lg px-4 py-2 pr-10 focus:ring-1 focus:ring-primary focus:border-primary outline-none">
                    <span class="material-symbols-outlined absolute right-3 top-2 text-green-600">check_circle</span>
                </div>
            </div>
        </div>

        <!-- Image de couverture -->
        <div class="bg-white border rounded-xl p-6 shadow-sm">
            <label class="text-xs font-bold text-gray-500 uppercase block mb-3">Image de couverture</label>
            <div class="flex flex-col items-center gap-4">
                @if($article->image ?? false)
                <div class="relative group w-full">
                    <img src="{{ asset('storage/' . $article->image) }}" class="w-full h-48 object-cover rounded-lg border">
                    <button onclick="removeCoverImage()" class="absolute top-2 right-2 bg-red-500 text-white p-2 rounded-full opacity-0 group-hover:opacity-100 transition text-xs hover:bg-red-600">
                        <span class="material-symbols-outlined text-sm">close</span>
                    </button>
                </div>
                @else
                <div class="w-full h-40 border-2 border-dashed border-gray-300 rounded-lg flex items-center justify-center text-gray-400">
                    <div class="text-center">
                        <span class="material-symbols-outlined text-4xl block mb-2">image</span>
                        <span class="text-sm">Aucune image</span>
                    </div>
                </div>
                @endif
                <div class="w-full">
                    <label class="cursor-pointer bg-gray-100 hover:bg-gray-200 w-full block text-center px-4 py-3 rounded-lg text-sm border transition">
                        📁 Choisir une image
                        <input type="file" id="coverImage" class="hidden" accept="image/*" onchange="uploadCoverImage(this)">
                    </label>
                    <p class="text-xs text-gray-400 mt-2 text-center">PNG, JPG, WEBP (max 5MB)</p>
                </div>
            </div>
        </div>

        <!-- Checklist Card -->
        <div class="bg-white border rounded-xl p-6 shadow-sm">
            <h4 class="text-secondary font-bold text-sm uppercase mb-3 flex items-center gap-2">
                <span class="material-symbols-outlined text-lg">thumb_up</span> Points positifs
            </h4>
            <ul id="seoSuccesses" class="space-y-2 text-sm">
                @if(isset($article->seo_details))
                    @foreach(json_decode($article->seo_details, true)['successes'] ?? [] as $success)
                        <li class="flex items-start gap-2 text-sm text-green-700">
                            <span class="material-symbols-outlined text-green-600 text-base">check_circle</span>
                            {{ $success }}
                        </li>
                    @endforeach
                @else
                    <li class="text-gray-500">En attente d'analyse...</li>
                @endif
            </ul>

            <h4 class="text-tertiary font-bold text-sm uppercase mt-6 mb-3 flex items-center gap-2">
                <span class="material-symbols-outlined text-lg">warning</span> Suggestions
            </h4>
            <ul id="seoIssues" class="space-y-2 text-sm">
                @if(isset($article->seo_details))
                    @foreach(json_decode($article->seo_details, true)['issues'] ?? [] as $issue)
                        <li class="flex items-start gap-2 text-sm text-orange-600">
                            <span class="material-symbols-outlined text-orange-500 text-base">warning</span>
                            {{ $issue }}
                        </li>
                    @endforeach
                @else
                    <li class="text-gray-500">Écrivez votre contenu pour voir l'analyse</li>
                @endif
            </ul>
        </div>

        <!-- Google Preview -->
        <div class="bg-white border rounded-xl p-6 shadow-sm">
            <h4 class="font-semibold text-lg mb-4">Aperçu Google</h4>
            <div class="border rounded-lg p-4">
                <div class="text-xs text-gray-500 mb-1">https://nearseo.ai › blog</div>
                <div class="text-blue-600 text-lg font-medium hover:underline cursor-pointer" id="previewTitle">{{ $article->title ?? 'Titre de l\'article' }}</div>
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
            <button onclick="toggleScheduleModal()" class="bg-white border p-2 rounded-lg hover:bg-gray-50">
                <span class="material-symbols-outlined">schedule</span>
            </button>
        </div>
        <div class="text-right">
            <p class="text-sm text-gray-500" id="statusMessage">Prêt à être publié</p>
            <p class="text-xs font-bold uppercase" id="optimizationStatus">
                @php
                    $score = $article->seo_score ?? 0;
                    $status = $score >= 80 ? '🏆 Excellente' : ($score >= 60 ? '📈 Bonne' : '⚠️ À améliorer');
                    $class = $score >= 80 ? 'text-green-600' : ($score >= 60 ? 'text-primary' : 'text-red-600');
                @endphp
                <span class="{{ $class }}">Optimisation : {{ $status }}</span>
            </p>
        </div>
        <button onclick="publishArticle()" class="bg-primary text-white px-10 py-2 rounded-lg hover:opacity-90 flex items-center gap-2">
            Publier l'article <span class="material-symbols-outlined">send</span>
        </button>
    </div>
</footer>
@endsection

@push('scripts')
<script>
    let currentContent = {!! json_encode($article->content ?? '') !!};
    let currentSeoScore = {{ $article->seo_score ?? 0 }};
    let autoSaveTimer = null;
    let seoAnalysisTimer = null;

    // ====== EDITOR.JS INTERACTIONS ======
    window.updateSeoAnalysis = async function() {
        try {
            const title = document.getElementById('articleTitle')?.value || '';
            const metaDesc = document.getElementById('metaDescription')?.value || '';
            const keyword = document.getElementById('keywordInput')?.value || '';
            
            let content = '';
            if (window.articleEditor) {
                const data = await window.articleEditor.getContent();
                if (data && data.blocks) {
                    content = data.blocks
                        .filter(block => block.data && block.data.text)
                        .map(block => block.data.text)
                        .join(' ');
                }
            }

            // Mise à jour du preview
            document.getElementById('previewTitle').textContent = title || 'Titre de l\'article';
            document.getElementById('previewDescription').textContent = metaDesc || 'Description...';
            
            // Compteurs
            document.getElementById('titleCount').textContent = title.length + ' / 60';
            document.getElementById('metaCount').textContent = metaDesc.length + ' / 160';

            // Appel à l'API SEO
            const response = await fetch('/api/seo/analyze', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
                },
                body: JSON.stringify({
                    content: content,
                    title: title,
                    keyword: keyword,
                    meta_description: metaDesc
                })
            });

            if (response.ok) {
                const result = await response.json();
                if (result.success) {
                    const data = result.data;
                    updateSeoDisplay(data);
                    
                    const statusEl = document.getElementById('optimizationStatus');
                    if (statusEl) {
                        const score = data.score || 0;
                        if (score >= 80) {
                            statusEl.innerHTML = '<span class="text-green-600">🏆 Optimisation : Excellente</span>';
                        } else if (score >= 60) {
                            statusEl.innerHTML = '<span class="text-primary">📈 Optimisation : Bonne</span>';
                        } else {
                            statusEl.innerHTML = '<span class="text-red-600">⚠️ Optimisation : À améliorer</span>';
                        }
                    }
                }
            }
        } catch (error) {
            console.error('Erreur analyse SEO:', error);
        }
    };

    function updateSeoDisplay(data) {
        const score = data.score || 0;
        const grade = data.grade || 'F';
        const wordCount = data.word_count || 0;
        const readTime = data.read_time || 0;
        
        document.getElementById('seoScore').textContent = score;
        document.getElementById('seoGrade').textContent = grade;
        document.getElementById('wordCount').textContent = wordCount;
        document.getElementById('readTime').textContent = readTime;

        const circumference = 352;
        const offset = circumference - (score / 100) * circumference;
        const circle = document.getElementById('seoCircle');
        if (circle) {
            circle.style.strokeDashoffset = offset;
        }

        const successesEl = document.getElementById('seoSuccesses');
        if (successesEl && data.successes) {
            if (data.successes.length > 0) {
                successesEl.innerHTML = data.successes.map(s => 
                    `<li class="flex items-start gap-2 text-sm text-green-700">
                        <span class="material-symbols-outlined text-green-600 text-base">check_circle</span>
                        ${s}
                    </li>`
                ).join('');
            } else {
                successesEl.innerHTML = '<li class="text-gray-500">Aucun point positif pour le moment</li>';
            }
        }

        const issuesEl = document.getElementById('seoIssues');
        if (issuesEl && data.issues) {
            if (data.issues.length > 0) {
                issuesEl.innerHTML = data.issues.map(s => 
                    `<li class="flex items-start gap-2 text-sm text-orange-600">
                        <span class="material-symbols-outlined text-orange-500 text-base">warning</span>
                        ${s}
                    </li>`
                ).join('');
            } else {
                issuesEl.innerHTML = '<li class="text-green-600">🎉 Excellent ! Tous les critères sont remplis !</li>';
            }
        }
    }

    // ====== SAUVEGARDE ======
    async function saveArticle() {
        try {
            let content = currentContent;
            if (window.articleEditor) {
                const data = await window.articleEditor.getContent();
                content = data;
            }

            const formData = {
                title: document.getElementById('articleTitle').value,
                meta_description: document.getElementById('metaDescription').value,
                content: JSON.stringify(content),
                focus_keyword: document.getElementById('keywordInput').value,
                seo_score: parseInt(document.getElementById('seoScore').textContent) || 0,
                status: 'draft'
            };

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
                document.getElementById('statusMessage').innerHTML = '✅ Sauvegardé à l\'instant';
                setTimeout(() => {
                    document.getElementById('lastSave').innerHTML = 'à ' + new Date().toLocaleTimeString();
                }, 3000);
            }
        } catch (error) {
            console.error('Save error:', error);
            document.getElementById('statusMessage').innerHTML = '❌ Erreur de sauvegarde';
        }
    }

    // ====== PUBLICATION ======
    async function publishArticle() {
        if (!confirm('Publier cet article ?')) return;

        try {
            let content = currentContent;
            if (window.articleEditor) {
                const data = await window.articleEditor.getContent();
                content = data;
            }

            const formData = {
                title: document.getElementById('articleTitle').value,
                meta_description: document.getElementById('metaDescription').value,
                content: JSON.stringify(content),
                focus_keyword: document.getElementById('keywordInput').value,
                seo_score: parseInt(document.getElementById('seoScore').textContent) || 0,
                status: 'published'
            };

            const response = await fetch('{{ route("articles.update", $article) }}', {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify(formData)
            });

            if (response.ok) {
                alert('✅ Article publié avec succès !');
                window.location.href = '{{ route("articles.index") }}';
            }
        } catch (error) {
            console.error('Publish error:', error);
            alert('❌ Erreur lors de la publication');
        }
    }

    // ====== IMAGE DE COUVERTURE ======
    async function uploadCoverImage(input) {
        const file = input.files[0];
        if (!file) return;

        if (file.size > 5 * 1024 * 1024) {
            alert('L\'image est trop volumineuse (max 5MB)');
            input.value = '';
            return;
        }

        const formData = new FormData();
        formData.append('image', file);
        formData.append('_token', document.querySelector('meta[name="csrf-token"]').content);

        try {
            const response = await fetch('{{ route("articles.upload-image", $article) }}', {
                method: 'POST',
                body: formData
            });

            if (response.ok) {
                location.reload();
            } else {
                alert('Erreur lors de l\'upload');
            }
        } catch (error) {
            console.error('Upload error:', error);
            alert('Erreur lors de l\'upload');
        }
    }

    async function removeCoverImage() {
        if (!confirm('Supprimer cette image ?')) return;

        const formData = new FormData();
        formData.append('_method', 'DELETE');
        formData.append('_token', document.querySelector('meta[name="csrf-token"]').content);

        try {
            const response = await fetch('{{ route("articles.remove-image", $article) }}', {
                method: 'POST',
                body: formData
            });

            if (response.ok) {
                location.reload();
            }
        } catch (error) {
            console.error('Remove error:', error);
        }
    }

    // ====== PLANIFICATION ======
    function toggleScheduleModal() {
        const checkbox = document.getElementById('enable_scheduling');
        if (checkbox) {
            checkbox.checked = !checkbox.checked;
            checkbox.dispatchEvent(new Event('change'));
        }
    }

    function updateDisplayDate() {
        const date = document.getElementById('scheduled_date')?.value;
        const time = document.getElementById('scheduled_time')?.value;
        if (date && time) {
            const displayDate = new Date(date + ' ' + time);
            document.getElementById('display_date').innerText = displayDate.toLocaleString('fr-FR', {
                day: '2-digit',
                month: '2-digit',
                year: 'numeric',
                hour: '2-digit',
                minute: '2-digit'
            });
        }
    }

    // ====== AI FUNCTIONS ======
    function generateIntroduction() {
        const keyword = document.getElementById('keywordInput')?.value;
        if (!keyword) {
            alert('Veuillez d\'abord définir un mot-clé principal');
            return;
        }
        alert('🤖 Génération d\'introduction par IA pour le mot-clé: "' + keyword + '" (Fonctionnalité à venir)');
    }

    function generateConclusion() {
        alert('🤖 Génération de conclusion par IA (Fonctionnalité à venir)');
    }

    function suggestTitles() {
        const keyword = document.getElementById('keywordInput')?.value;
        if (!keyword) {
            alert('Veuillez d\'abord définir un mot-clé principal');
            return;
        }
        alert('💡 Suggestions de titres pour: "' + keyword + '"\n\n1. ' + keyword + ' : Le Guide Complet\n2. Les Meilleurs ' + keyword + ' en 2025\n3. Comment Maîtriser ' + keyword + ' en 5 Étapes');
    }

    function optimizeSeo() {
        alert('🔍 Optimisation SEO du contenu (Fonctionnalité à venir)');
    }

    function rewriteForSocial() {
        const platform = prompt('📱 Choisissez la plateforme :\n1. Instagram\n2. Twitter/X\n3. LinkedIn\n4. Facebook', '1');
        if (!platform) return;
        
        const platforms = ['Instagram', 'Twitter/X', 'LinkedIn', 'Facebook'];
        const selected = platforms[parseInt(platform) - 1] || 'Instagram';
        alert('📱 Reformulation pour ' + selected + ' (Fonctionnalité à venir)');
    }

    // ====== INITIALISATION ======
    document.addEventListener('DOMContentLoaded', function() {
        // Planification
        const schedulingCheckbox = document.getElementById('enable_scheduling');
        if (schedulingCheckbox) {
            schedulingCheckbox.addEventListener('change', function() {
                const schedulingInfo = document.getElementById('scheduling_info');
                if (this.checked) {
                    schedulingInfo.classList.remove('hidden');
                    updateDisplayDate();
                } else {
                    schedulingInfo.classList.add('hidden');
                }
            });
        }

        @if(isset($article) && $article->scheduled_for)
            const scheduledDate = new Date('{{ $article->scheduled_for }}');
            document.getElementById('scheduled_date').value = scheduledDate.toISOString().split('T')[0];
            document.getElementById('scheduled_time').value = scheduledDate.toTimeString().slice(0, 5);
            document.getElementById('enable_scheduling').checked = true;
            document.getElementById('enable_scheduling').dispatchEvent(new Event('change'));
        @endif

        // Mise à jour automatique de l'analyse SEO
        ['articleTitle', 'keywordInput', 'metaDescription'].forEach(id => {
            const element = document.getElementById(id);
            if (element) {
                element.addEventListener('input', function() {
                    if (seoAnalysisTimer) clearTimeout(seoAnalysisTimer);
                    seoAnalysisTimer = setTimeout(() => {
                        window.updateSeoAnalysis();
                    }, 1000);
                });
            }
        });

        setTimeout(() => {
            window.updateSeoAnalysis();
        }, 2000);
    });

    document.getElementById('scheduled_date')?.addEventListener('change', updateDisplayDate);
    document.getElementById('scheduled_time')?.addEventListener('change', updateDisplayDate);
</script>
@endpush

<style>
    .prose h1 {
        font-size: 2.5rem !important;
        font-weight: 800 !important;
        color: #1a202c !important;
        margin-bottom: 1.5rem !important;
        line-height: 1.2 !important;
    }
    .prose h2 {
        font-size: 1.8rem !important;
        font-weight: 700 !important;
        margin-top: 1.5rem !important;
        margin-bottom: 1rem !important;
        color: #2d3748 !important;
    }
    .prose h3 {
        font-size: 1.4rem !important;
        font-weight: 600 !important;
        margin-top: 1.2rem !important;
        margin-bottom: 0.75rem !important;
        color: #4a5568 !important;
    }
    
    /* Material Icons */
    .material-symbols-outlined {
        font-size: 20px;
        vertical-align: middle;
    }
    
    /* Editor.js Styles */
    .codex-editor {
        padding: 20px;
    }
    
    .ce-block__content {
        max-width: 100%;
    }
    
    .ce-toolbar__content {
        max-width: 100%;
    }
</style>