<?php $__env->startSection('title', "Éditeur d'article"); ?>
<?php $__env->startSection('header-title', "Éditeur d'article"); ?>

<?php $__env->startPush('styles'); ?>
<link rel="stylesheet" href="<?php echo e(asset('vendor/jodit/jodit.min.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
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
                    <input type="text" id="articleTitle" value="<?php echo e(clean_title($article->title)); ?>" 
                           class="w-full border rounded-lg px-4 py-3 focus:ring-1 focus:ring-primary focus:border-primary outline-none" 
                           oninput="updateSeoAnalysis()">
                </div>
                <div>
                    <div class="flex justify-between items-end mb-2">
                        <label class="text-xs font-bold text-gray-500 uppercase">Meta description</label>
                        <span class="text-sm text-gray-400" id="metaCount">0 / 160</span>
                    </div>
                    <textarea id="metaDescription" rows="2" 
                              class="w-full border rounded-lg px-4 py-3 focus:ring-1 focus:ring-primary focus:border-primary outline-none" 
                              oninput="updateSeoAnalysis()"><?php echo e(clean_meta($article->meta_description ?? '')); ?></textarea>
                </div>
            </div>
        </div>

        <!-- Jodit Editor Container -->
        <div class="bg-white border rounded-xl overflow-hidden shadow-sm">
            <div id="editor-container">
                <textarea id="editor"><?php echo e(clean_content($article->content)); ?></textarea>
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
                    <input type="text" id="keywordInput" value="<?php echo e(clean_title($article->focus_keyword ?? '')); ?>" 
                           class="w-full border rounded-lg px-4 py-2 pr-10 focus:ring-1 focus:ring-primary" 
                           oninput="updateSeoAnalysis()">
                    <span class="absolute right-3 top-1/2 -translate-y-1/2 text-green-600 text-sm">✓</span>
                </div>
            </div>
        </div>

        <!-- Image de couverture -->
        <div class="bg-white border rounded-xl p-6 shadow-sm">
            <label class="text-xs font-bold text-gray-500 uppercase block mb-3">Image de couverture</label>
            <div class="flex flex-col items-center gap-4">
                <?php if($article->image): ?>
                <div class="relative group w-full">
                    <img src="<?php echo e(asset('storage/' . $article->image)); ?>" 
                         alt="<?php echo e(clean_title($article->title)); ?>" 
                         class="w-full h-48 object-cover rounded-lg border">
                    <button onclick="removeCoverImage()" class="absolute top-2 right-2 bg-red-500 text-white p-2 rounded-full opacity-0 group-hover:opacity-100 transition text-xs hover:bg-red-600">
                        ✕
                    </button>
                </div>
                <?php else: ?>
                <div class="w-full h-40 border-2 border-dashed border-gray-300 rounded-lg flex items-center justify-center text-gray-400">
                    <div class="text-center">
                        <span class="text-4xl block mb-2">🖼️</span>
                        <span class="text-sm">Aucune image</span>
                    </div>
                </div>
                <?php endif; ?>
                <div class="w-full">
                    <label class="cursor-pointer bg-gray-100 hover:bg-gray-200 w-full block text-center px-4 py-3 rounded-lg text-sm border transition">
                        📁 Choisir une image
                        <input type="file" id="coverImage" class="hidden" accept="image/*" onchange="uploadCoverImage(this)">
                    </label>
                    <p class="text-xs text-gray-400 mt-2 text-center">PNG, JPG, WEBP (max 5MB)</p>
                </div>
            </div>
        </div>

        <!-- Planification -->
        <div class="bg-white border rounded-xl p-6 shadow-sm">
            <h3 class="text-sm font-bold text-gray-500 uppercase mb-4">📅 Planification</h3>
            <div class="space-y-4">
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
                <div>
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" id="enable_scheduling" class="rounded text-primary w-4 h-4">
                        <span class="text-sm">Planifier la publication automatique</span>
                    </label>
                </div>
                <div id="scheduling_info" class="text-sm text-gray-500 hidden bg-gray-50 p-3 rounded-lg">
                    <span class="font-medium">📌</span> L'article sera publié automatiquement le 
                    <span id="display_date" class="font-semibold text-primary"></span>
                </div>
            </div>
        </div>

        <!-- Checklist Card -->
        <div class="bg-white border rounded-xl p-6 shadow-sm">
            <h4 class="text-secondary font-bold text-sm uppercase mb-3">Points positifs ✅</h4>
            <ul id="positivePoints" class="space-y-2 text-sm">
                <li class="text-gray-500">En attente d'analyse...</li>
            </ul>

            <h4 class="text-tertiary font-bold text-sm uppercase mt-6 mb-3">Suggestions 💡</h4>
            <ul id="suggestions" class="space-y-2 text-sm">
                <li class="text-gray-500">Écrivez votre contenu pour voir l'analyse</li>
            </ul>
        </div>

        <!-- Google Preview -->
        <div class="bg-white border rounded-xl p-6 shadow-sm">
            <h4 class="font-semibold text-lg mb-4">Aperçu Google</h4>
            <div class="border rounded-lg p-4 space-y-3">
                <div class="text-xs text-gray-500">https://nearseo.ai › blog</div>
                
                <?php if($article->image): ?>
                <div class="mt-1">
                    <img src="<?php echo e(asset('storage/' . $article->image)); ?>" 
                         alt="<?php echo e(clean_title($article->title)); ?>" 
                         class="w-full h-32 object-cover rounded-lg border border-gray-200">
                </div>
                <?php endif; ?>
                
                <div class="text-blue-600 text-lg font-medium hover:underline cursor-pointer" id="previewTitle"><?php echo e(clean_title($article->title)); ?></div>
                <div class="text-gray-600 text-sm" id="previewDescription"><?php echo e(clean_meta($article->meta_description ?? 'Découvrez les meilleures stratégies pour améliorer votre visibilité locale...')); ?></div>
                <div class="text-xs text-gray-400"><?php echo e($article->created_at ? $article->created_at->format('d/m/Y') : ''); ?></div>
            </div>
        </div>
    </div>
</div>

<!-- Sticky Footer -->
<footer class="fixed bottom-0 left-64 right-0 bg-white border-t h-20 z-40 flex items-center justify-center">
    <div class="max-w-7xl w-full px-6 flex justify-between items-center">
        
        <div class="flex gap-4">
            <button onclick="saveArticle()" class="bg-white border px-6 py-2 rounded-lg hover:bg-gray-50 flex items-center gap-2">
                💾 Sauvegarder
            </button>
        </div>

        
        <div class="text-right">
            <?php if($article->status === 'published'): ?>
                <p class="text-sm text-green-600 font-semibold">✅ Article publié</p>
                <p class="text-xs text-gray-500">
                    Publié le <?php echo e($article->published_at ? $article->published_at->format('d/m/Y à H:i') : '—'); ?>

                </p>
            <?php else: ?>
                <p class="text-sm text-gray-500" id="statusMessage">Prêt à être publié</p>
            <?php endif; ?>
            <p class="text-xs font-bold text-secondary uppercase" id="optimizationStatus">Optimisation : À améliorer</p>
        </div>

        
        <?php if($article->status !== 'published'): ?>
            <button onclick="publishArticle()" class="bg-primary text-white px-10 py-2 rounded-lg hover:opacity-90 flex items-center gap-2">
                Publier l'article 📤
            </button>
        <?php else: ?>
            <a href="<?php echo e(route('blog.user.article', ['slug' => $article->user->slug, 'articleSlug' => $article->slug])); ?>" 
   target="_blank"
   class="bg-secondary text-white px-6 py-2 rounded-lg hover:opacity-90 flex items-center gap-2">
                <span class="material-symbols-outlined">visibility</span>
                Voir l'article
            </a>
        <?php endif; ?>
    </div>
</footer>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script src="<?php echo e(asset('vendor/jodit/jodit.min.js')); ?>"></script>
<script>
// ══════════════════════════════════════════════════════
// VARIABLES GLOBALES
// ══════════════════════════════════════════════════════
let editor = null;
let currentContent = <?php echo json_encode(clean_content($article->content)); ?>;
let currentSeoScore = <?php echo e($article->seo_score ?? 0); ?>;
let autoSaveTimer = null;
let isSaving = false;
let isPublishing = false;
let lastAutosaveAt = 0;
const AUTOSAVE_INTERVAL_MS = 60000;

// ✅ Statut actuel de l'article (pour ne pas l'écraser lors de la sauvegarde)
const ARTICLE_STATUS = '<?php echo e($article->status); ?>';

// ══════════════════════════════════════════════════════
// INITIALISATION AU CHARGEMENT DU DOM
// ══════════════════════════════════════════════════════
document.addEventListener('DOMContentLoaded', function() {
    console.log('🚀 DOMContentLoaded déclenché');
    console.log('Jodit disponible ?', typeof Jodit);
    console.log('Statut article :', ARTICLE_STATUS);
    
    // Vérifier que Jodit est chargé
    if (typeof Jodit === 'undefined') {
        console.error('❌ Jodit n\'est pas chargé !');
        document.getElementById('editor-container').innerHTML = `
            <div class="p-8 text-center bg-red-50 border-2 border-red-300 rounded-lg">
                <p class="text-red-600 font-bold text-lg mb-2">❌ Erreur de chargement de l'éditeur</p>
                <p class="text-red-500 text-sm">Jodit n'a pas pu être chargé. Vérifiez votre connexion internet.</p>
                <p class="text-gray-500 text-xs mt-2">Essayez de recharger la page avec Ctrl+F5</p>
            </div>
        `;
        return;
    }
    
    // Initialiser Jodit
    try {
        editor = Jodit.make('#editor', {
            height: 500,
            minHeight: 400,
            toolbarAdaptive: false,
            toolbarSticky: false,
            language: 'fr',
            buttons: [
                'bold', 'italic', 'underline', 'strikethrough',
                '|',
                'ul', 'ol',
                '|',
                'paragraph', 'h2', 'h3',
                '|',
                'link', 'image',
                '|',
                'undo', 'redo',
                '|',
                'fullsize'
            ],
            uploader: {
                insertImageAsBase64URI: true
            },
            events: {
                'change': function() {
                    currentContent = editor.value;
                    updateWordCount();
                    updateSeoAnalysis();
                    
                    if (autoSaveTimer) clearTimeout(autoSaveTimer);
                    autoSaveTimer = setTimeout(saveArticle, 3000);
                }
            }
        });
        
        console.log('✅ Jodit initialisé avec succès');
        
        // Charger le contenu initial
        editor.value = currentContent;
        
        // Lancer l'analyse SEO initiale
        updateWordCount();
        updateSeoAnalysis();
        
        // Restaurer la planification si elle existe
        <?php if($article->scheduled_for): ?>
            const scheduledDate = new Date('<?php echo e($article->scheduled_for); ?>');
            document.getElementById('scheduled_date').value = scheduledDate.toISOString().split('T')[0];
            document.getElementById('scheduled_time').value = scheduledDate.toTimeString().slice(0, 5);
            document.getElementById('enable_scheduling').checked = true;
            document.getElementById('enable_scheduling').dispatchEvent(new Event('change'));
        <?php endif; ?>
        
    } catch (error) {
        console.error('❌ Erreur lors de l\'initialisation de Jodit:', error);
        document.getElementById('editor-container').innerHTML = `
            <div class="p-8 text-center bg-red-50 border-2 border-red-300 rounded-lg">
                <p class="text-red-600 font-bold text-lg mb-2">❌ Erreur d'initialisation</p>
                <p class="text-red-500 text-sm">${error.message}</p>
            </div>
        `;
    }
});

// ══════════════════════════════════════════════════════
// HELPER — Texte brut depuis le HTML de Jodit
// ══════════════════════════════════════════════════════
function getEditorText() {
    if (!editor) return '';
    const temp = document.createElement('div');
    temp.innerHTML = editor.value || '';
    return temp.innerText || '';
}

// ══════════════════════════════════════════════════════
// COMPTEUR DE MOTS
// ══════════════════════════════════════════════════════
function updateWordCount() {
    const text = getEditorText();
    const words = text.trim().split(/\s+/).filter(function(w) { return w.length > 0; }).length;
    document.getElementById('wordCount').innerHTML = words;
    const readTime = Math.max(1, Math.ceil(words / 200));
    document.getElementById('readTime').innerHTML = readTime;
    return words;
}

// ══════════════════════════════════════════════════════
// ANALYSE SEO
// ══════════════════════════════════════════════════════
function updateSeoAnalysis() {
    const title = document.getElementById('articleTitle').value;
    const metaDesc = document.getElementById('metaDescription').value;
    const keyword = document.getElementById('keywordInput').value;
    const content = editor ? (editor.value || '') : '';
    const contentText = getEditorText();
    const wordCount = updateWordCount();

    let score = 30;
    let positives = [];
    let suggestions = [];

    // Titre
    document.getElementById('titleCount').innerHTML = title.length + ' / 60';
    document.getElementById('previewTitle').innerHTML = title || 'Titre de l\'article';

    if (title.length > 0 && title.length <= 60) {
        score += 15;
        positives.push('✅ Titre optimisé (longueur idéale)');
    } else if (title.length > 0) {
        suggestions.push('⚠️ Titre trop long (max 60 caractères)');
    } else {
        suggestions.push('⚠️ Ajoutez un titre');
    }

    // Meta description
    document.getElementById('metaCount').innerHTML = metaDesc.length + ' / 160';
    document.getElementById('previewDescription').innerHTML = metaDesc || 'Description...';

    if (metaDesc.length >= 120 && metaDesc.length <= 160) {
        score += 15;
        positives.push('✅ Meta description optimisée');
    } else if (metaDesc.length > 0) {
        suggestions.push('⚠️ Meta description: ' + metaDesc.length + '/160 caractères');
    } else {
        suggestions.push('⚠️ Ajoutez une meta description');
    }

    // Mot-clé
    if (keyword) {
        const titleHasKeyword = title.toLowerCase().includes(keyword.toLowerCase());
        const contentHasKeyword = contentText.toLowerCase().includes(keyword.toLowerCase());

        if (titleHasKeyword) {
            score += 10;
            positives.push('✅ Mot-clé présent dans le titre');
        } else {
            suggestions.push('⚠️ Ajoutez le mot-clé "' + keyword + '" dans le titre');
        }

        if (contentHasKeyword) {
            score += 10;
            positives.push('✅ Mot-clé présent dans le contenu');
        } else {
            suggestions.push('⚠️ Utilisez le mot-clé "' + keyword + '" dans le contenu');
        }
    } else {
        suggestions.push('⚠️ Ajoutez un mot-clé principal');
    }

    // Longueur
    if (wordCount > 1000) {
        score += 15;
        positives.push('✅ Excellent contenu (+1000 mots)');
    } else if (wordCount > 500) {
        score += 10;
        positives.push('✅ Bonne longueur (+500 mots)');
    } else if (wordCount > 300) {
        score += 5;
        positives.push('✅ Contenu acceptable (+300 mots)');
        suggestions.push('⚠️ Visez 500+ mots pour un meilleur SEO');
    } else if (wordCount > 0) {
        suggestions.push('⚠️ Ajoutez plus de contenu (500+ mots)');
    } else {
        suggestions.push('⚠️ Commencez à écrire votre contenu');
    }

    // Structure
    if (content.includes('<h2>') || content.includes('<h3>')) {
        score += 10;
        positives.push('✅ Structure H2/H3 présente');
    } else {
        suggestions.push('⚠️ Ajoutez des sous-titres (H2, H3)');
    }

    currentSeoScore = Math.min(score, 100);
    updateSeoDisplay(currentSeoScore);

    const positiveList = document.getElementById('positivePoints');
    positiveList.innerHTML = positives.length > 0
        ? positives.map(p => `<li class="flex items-start gap-2 text-sm text-green-700">${p}</li>`).join('')
        : '<li class="text-gray-500">Aucun point positif pour le moment</li>';

    const suggestionsList = document.getElementById('suggestions');
    suggestionsList.innerHTML = suggestions.length > 0
        ? suggestions.map(s => `<li class="flex items-start gap-2 text-sm text-orange-600">${s}</li>`).join('')
        : '<li class="text-green-600">🎉 Excellent ! Tous les critères sont remplis !</li>';

    const statusEl = document.getElementById('optimizationStatus');
    if (currentSeoScore >= 80) {
        statusEl.innerHTML = '🏆 Optimisation : Excellente';
        statusEl.className = 'text-xs font-bold text-green-600 uppercase';
    } else if (currentSeoScore >= 60) {
        statusEl.innerHTML = '📈 Optimisation : Bonne';
        statusEl.className = 'text-xs font-bold text-primary uppercase';
    } else {
        statusEl.innerHTML = '⚠️ Optimisation : À améliorer';
        statusEl.className = 'text-xs font-bold text-red-600 uppercase';
    }
}

function updateSeoDisplay(score) {
    const circumference = 352;
    const offset = circumference - (score / 100) * circumference;
    const circle = document.getElementById('seoCircle');
    if (circle) circle.style.strokeDashoffset = offset;
    document.getElementById('seoScore').innerHTML = score;
}

// ══════════════════════════════════════════════════════
// AUTOSAVE PÉRIODIQUE
// ══════════════════════════════════════════════════════
async function maybeAutosave() {
    if (!editor || isSaving || isPublishing) return;
    const now = Date.now();
    if (now - lastAutosaveAt < AUTOSAVE_INTERVAL_MS) return;
    lastAutosaveAt = now;
    currentContent = editor.value;
    await saveArticle();
}

setInterval(function() {
    maybeAutosave().catch(function() {});
}, 5000);

// ══════════════════════════════════════════════════════
// IMAGE DE COUVERTURE
// ══════════════════════════════════════════════════════
async function uploadCoverImage(input) {
    const file = input.files[0];
    if (!file) return;

    if (file.size > 5 * 1024 * 1024) {
        showToast('❌ L\'image est trop volumineuse (max 5MB)');
        input.value = '';
        return;
    }

    const formData = new FormData();
    formData.append('image', file);
    formData.append('_token', document.querySelector('meta[name="csrf-token"]').content);

    try {
        showToast('⏳ Upload en cours...');
        const response = await fetch('<?php echo e(route("articles.upload-image", $article)); ?>', {
            method: 'POST',
            body: formData
        });

        if (response.ok) {
            showToast('✅ Image de couverture uploadée avec succès !');
            setTimeout(function() { location.reload(); }, 1000);
        } else {
            showToast('❌ Erreur lors de l\'upload');
        }
    } catch (error) {
        console.error('Upload error:', error);
        showToast('❌ Erreur lors de l\'upload');
    }
}

async function removeCoverImage() {
    if (!confirm('Supprimer cette image ?')) return;

    const formData = new FormData();
    formData.append('_method', 'DELETE');
    formData.append('_token', document.querySelector('meta[name="csrf-token"]').content);

    try {
        const response = await fetch('<?php echo e(route("articles.remove-image", $article)); ?>', {
            method: 'POST',
            body: formData
        });

        if (response.ok) {
            showToast('✅ Image supprimée avec succès');
            setTimeout(function() { location.reload(); }, 1000);
        }
    } catch (error) {
        console.error('Remove error:', error);
        showToast('❌ Erreur lors de la suppression');
    }
}

// ══════════════════════════════════════════════════════
// SAUVEGARDE
// ══════════════════════════════════════════════════════
async function saveArticle() {
    if (!editor || isSaving) return;
    isSaving = true;

    const title = document.getElementById('articleTitle').value.trim();
    if (!title) {
        showToast('❌ Veuillez ajouter un titre avant de sauvegarder');
        isSaving = false;
        return;
    }

    const formData = {
        title: title,
        meta_description: document.getElementById('metaDescription').value,
        content: editor.value,
        focus_keyword: document.getElementById('keywordInput').value,
        seo_score: currentSeoScore,
        // ✅ CONSERVER le statut actuel (ne pas écraser)
        status: ARTICLE_STATUS
    };

    try {
        const response = await fetch('<?php echo e(route("articles.update.post", $article)); ?>', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify(formData)
        });

        if (response.ok) {
            document.getElementById('lastSave').innerHTML = 'à l\'instant';
            
            // ✅ Protéger contre les éléments manquants (article publié)
            const statusEl = document.getElementById('statusMessage');
            if (statusEl) statusEl.innerHTML = '✅ Sauvegardé à l\'instant';
            
            showToast('✅ Article sauvegardé avec succès');
            
            setTimeout(() => {
                document.getElementById('lastSave').innerHTML = 'à ' + new Date().toLocaleTimeString();
            }, 3000);
        } else {
            const error = await response.json();
            showToast('❌ Erreur lors de la sauvegarde: ' + (error.message || 'Erreur inconnue'));
        }
    } catch (error) {
        console.error('Save error:', error);
        showToast('❌ Erreur de connexion lors de la sauvegarde');
    } finally {
        isSaving = false;
    }
}

// ══════════════════════════════════════════════════════
// PUBLICATION
// ══════════════════════════════════════════════════════
async function publishArticle() {
    if (!editor || isPublishing) return;
    
    const title = document.getElementById('articleTitle').value.trim();
    if (!title) {
        showToast('❌ Veuillez ajouter un titre avant de publier');
        return;
    }

    if (!confirm('📤 Publier cet article ?\n\nL\'article sera visible publiquement sur votre blog.')) {
        return;
    }

    isPublishing = true;
    const publishBtn = document.querySelector('[onclick="publishArticle()"]');
    const originalText = publishBtn.innerHTML;
    publishBtn.innerHTML = '⏳ Publication...';
    publishBtn.disabled = true;

    const formData = {
        title: title,
        meta_description: document.getElementById('metaDescription').value,
        content: editor.value,
        focus_keyword: document.getElementById('keywordInput').value,
        seo_score: currentSeoScore,
        status: 'published'
    };

    try {
        const response = await fetch('<?php echo e(route("articles.update.post", $article)); ?>', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify(formData)
        });

        if (response.ok) {
            showToast('✅ Article publié avec succès ! 🎉');
            setTimeout(function() {
                window.location.href = '<?php echo e(route("articles.index")); ?>';
            }, 1500);
        } else {
            const raw = await response.text();
            showToast('❌ Erreur lors de la publication (HTTP ' + response.status + ')');
            console.error('Publish failed:', raw);
            publishBtn.innerHTML = originalText;
            publishBtn.disabled = false;
        }
    } catch (error) {
        console.error('Publish error:', error);
        showToast('❌ Erreur de connexion lors de la publication');
        publishBtn.innerHTML = originalText;
        publishBtn.disabled = false;
    } finally {
        isPublishing = false;
    }
}

// ══════════════════════════════════════════════════════
// PLANIFICATION
// ══════════════════════════════════════════════════════
document.addEventListener('DOMContentLoaded', function() {
    const enableSchedulingEl = document.getElementById('enable_scheduling');
    if (enableSchedulingEl) {
        enableSchedulingEl.addEventListener('change', function() {
            const schedulingInfo = document.getElementById('scheduling_info');
            if (this.checked) {
                schedulingInfo.classList.remove('hidden');
                updateDisplayDate();
            } else {
                schedulingInfo.classList.add('hidden');
            }
        });
    }

    document.getElementById('scheduled_date')?.addEventListener('change', updateDisplayDate);
    document.getElementById('scheduled_time')?.addEventListener('change', updateDisplayDate);
});

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

// ══════════════════════════════════════════════════════
// TOAST
// ══════════════════════════════════════════════════════
function showToast(message) {
    const oldToasts = document.querySelectorAll('.custom-toast');
    oldToasts.forEach(function(toast) { toast.remove(); });

    const toast = document.createElement('div');
    toast.className = 'custom-toast';
    toast.innerHTML = message;
    toast.style.cssText = `
        position: fixed;
        bottom: 90px;
        right: 20px;
        background: ${message.includes('✅') ? '#1a1a2e' : message.includes('❌') ? '#dc2626' : '#1a1a2e'};
        color: white;
        padding: 14px 24px;
        border-radius: 12px;
        z-index: 9999;
        font-size: 14px;
        font-weight: 500;
        box-shadow: 0 4px 20px rgba(0,0,0,0.25);
        animation: slideUp 0.3s ease-out;
        max-width: 420px;
        border-left: 4px solid ${message.includes('✅') ? '#22c55e' : message.includes('❌') ? '#ef4444' : '#f59e0b'};
    `;
    document.body.appendChild(toast);
    
    setTimeout(function() {
        toast.style.opacity = '0';
        toast.style.transition = 'opacity 0.4s ease';
        setTimeout(function() {
            if (toast.parentNode) {
                toast.parentNode.removeChild(toast);
            }
        }, 400);
    }, 4000);
}

// Animation CSS pour les toasts
const style = document.createElement('style');
style.textContent = `
    @keyframes slideUp {
        from { opacity: 0; transform: translateY(20px) scale(0.95); }
        to { opacity: 1; transform: translateY(0) scale(1); }
    }
    .custom-toast { animation: slideUp 0.3s ease-out; }
`;
document.head.appendChild(style);
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\pc\nearseo-laravel\resources\views/dashboard/articles/edit.blade.php ENDPATH**/ ?>