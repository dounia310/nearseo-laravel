

<?php $__env->startSection('title', 'Articles'); ?>
<?php $__env->startSection('header-title', 'Articles'); ?>

<?php $__env->startSection('content'); ?>
<div class="space-y-6">
    <!-- Header Section -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4">
        <div>
            <h1 class="font-h1 text-h1 text-on-surface">Gérez vos contenus locaux et optimisez votre visibilité IA.</h1>
        </div>
        <a href="<?php echo e(route('ai.create')); ?>" class="bg-[#C97C5D] text-white px-6 py-3 rounded-xl font-bold flex items-center gap-2 hover:opacity-90 transition-all shadow-md active:scale-95">
            <span class="material-symbols-outlined">add_circle</span>
            Nouvel article
        </a>
    </div>

    <!-- Filters & Tools -->
    <div class="flex flex-wrap items-center justify-between mb-6 gap-4">
        <div class="flex items-center gap-2 overflow-x-auto pb-2 md:pb-0">
            <button onclick="filterByStatus('all')" class="filter-btn px-4 py-2 rounded-full text-xs font-bold transition-all shadow-sm" data-status="all" style="background: #8c4a2f; color: white;">Tous</button>
            <button onclick="filterByStatus('published')" class="filter-btn px-4 py-2 rounded-full text-xs font-bold transition-all" data-status="published" style="background: white; border: 1px solid #d1d5db; color: #6b7280;">Publiés</button>
            <button onclick="filterByStatus('draft')" class="filter-btn px-4 py-2 rounded-full text-xs font-bold transition-all" data-status="draft" style="background: white; border: 1px solid #d1d5db; color: #6b7280;">Brouillons</button>
            <button onclick="filterByStatus('scheduled')" class="filter-btn px-4 py-2 rounded-full text-xs font-bold transition-all" data-status="scheduled" style="background: white; border: 1px solid #d1d5db; color: #6b7280;">Programmés</button>
        </div>
        <div class="flex items-center gap-3">
            <input type="text" id="searchInput" placeholder="Rechercher un article..." class="px-4 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-primary focus:border-primary outline-none transition-all">
        </div>
    </div>

    <!-- Data Table Card -->
    <div class="bg-white border rounded-xl overflow-hidden shadow-sm">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead class="bg-gray-50 border-b">
                    <tr class="text-left">
                        <th class="px-6 py-4 text-xs text-gray-500 uppercase font-bold">Titre</th>
                        <th class="px-6 py-4 text-xs text-gray-500 uppercase font-bold">Statut</th>
                        <th class="px-6 py-4 text-xs text-gray-500 uppercase font-bold">Vues</th>
                        <th class="px-6 py-4 text-xs text-gray-500 uppercase font-bold">Score SEO</th>
                        <th class="px-6 py-4 text-right text-xs text-gray-500 uppercase font-bold">Actions</th>
                    </tr>
                </thead>
                <tbody id="articlesTableBody" class="divide-y divide-gray-100">
                    <?php $__empty_1 = true; $__currentLoopData = $articles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $article): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr class="article-row hover:bg-gray-50 transition-colors" 
                        data-id="<?php echo e($article->id); ?>"
                        data-title="<?php echo e(strtolower($article->title)); ?>"
                        data-status="<?php echo e($article->status); ?>">
                        
                        <td class="px-6 py-4">
                            <?php if($article->status === 'published'): ?>
                            <a href="<?php echo e(route('blog.user.article', ['slug' => auth()->user()->slug ?? 'admin-nearseo', 'articleSlug' => $article->slug])); ?>" 
                               target="_blank"
                               class="font-semibold text-gray-800 hover:text-primary hover:underline transition-colors flex items-center gap-2 group">
                                <span><?php echo e($article->title); ?></span>
                                <span class="material-symbols-outlined text-sm text-gray-400 group-hover:text-primary transition-colors">open_in_new</span>
                            </a>
                            <?php else: ?>
                            <div class="font-semibold text-gray-800"><?php echo e($article->title); ?></div>
                            <?php endif; ?>
                            <div class="text-xs text-gray-500">Créé le <?php echo e($article->created_at->format('d/m/Y')); ?></div>
                        </td>
                        
                        <td class="px-6 py-4">
                            <?php if($article->scheduled_for && $article->status === 'draft'): ?>
                                <span class="inline-flex items-center gap-1 px-2 py-1 rounded-full text-xs bg-blue-100 text-blue-700">
                                    <span class="material-symbols-outlined text-sm">schedule</span>
                                    Programmé le <?php echo e($article->scheduled_for->format('d/m/Y H:i')); ?>

                                </span>
                            <?php elseif($article->status === 'published'): ?>
                                <span class="inline-flex items-center gap-1 px-2 py-1 rounded-full text-xs bg-green-100 text-green-700">
                                    <span class="material-symbols-outlined text-sm">check_circle</span>
                                    Publié
                                </span>
                            <?php else: ?>
                                <span class="inline-flex items-center gap-1 px-2 py-1 rounded-full text-xs bg-gray-100 text-gray-600">
                                    <span class="material-symbols-outlined text-sm">edit_note</span>
                                    Brouillon
                                </span>
                            <?php endif; ?>
                        </td>
                        
                        <td class="px-6 py-4"><?php echo e(number_format($article->views ?? 0)); ?></td>
                        
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-2">
                                <div class="w-10 h-1.5 bg-gray-200 rounded-full overflow-hidden">
                                    <div class="bg-green-600 h-full" style="width: <?php echo e($article->seo_score ?? 0); ?>%"></div>
                                </div>
                                <span class="text-sm font-bold text-green-700"><?php echo e($article->seo_score ?? 0); ?></span>
                            </div>
                        </td>
                        
                        <td class="px-6 py-4 text-right space-x-2">
                            <a href="<?php echo e(route('articles.edit', $article)); ?>" class="p-1.5 text-gray-500 hover:text-primary hover:bg-orange-50 rounded inline-block transition-colors" title="Modifier">
                                <span class="material-symbols-outlined text-lg">edit</span>
                            </a>
                            <button onclick="deleteArticle(<?php echo e($article->id); ?>, '<?php echo e(addslashes($article->title)); ?>')" class="p-1.5 text-gray-500 hover:text-red-600 rounded inline-block transition-colors" title="Supprimer">
                                <span class="material-symbols-outlined text-lg">delete</span>
                            </button>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="5" class="px-6 py-12 text-center text-gray-500">
                            <span class="material-symbols-outlined text-4xl mb-2 block">article</span>
                            Aucun article pour le moment.
                            <a href="<?php echo e(route('ai.create')); ?>" class="text-primary hover:underline block mt-2">Créez votre premier article</a>
                        </td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="px-6 py-4 bg-gray-50 border-t flex items-center justify-between">
            <span class="text-sm text-gray-500">Page <?php echo e($articles->currentPage()); ?> sur <?php echo e($articles->lastPage()); ?></span>
            <div class="flex items-center gap-2">
                <?php if($articles->onFirstPage()): ?>
                <span class="p-2 border rounded-lg text-gray-400 cursor-not-allowed">
                    <span class="material-symbols-outlined text-lg">chevron_left</span>
                </span>
                <?php else: ?>
                <a href="<?php echo e($articles->previousPageUrl()); ?>" class="p-2 border rounded-lg text-gray-600 hover:bg-gray-100 transition-all">
                    <span class="material-symbols-outlined text-lg">chevron_left</span>
                </a>
                <?php endif; ?>
                
                <?php if($articles->hasMorePages()): ?>
                <a href="<?php echo e($articles->nextPageUrl()); ?>" class="p-2 border rounded-lg text-gray-600 hover:bg-gray-100 transition-all">
                    <span class="material-symbols-outlined text-lg">chevron_right</span>
                </a>
                <?php else: ?>
                <span class="p-2 border rounded-lg text-gray-400 cursor-not-allowed">
                    <span class="material-symbols-outlined text-lg">chevron_right</span>
                </span>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Organic Insight Section -->
    <div class="mt-6 grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white border-l-4 border-secondary p-6 rounded-xl shadow-sm flex items-start gap-4">
            <div class="p-3 bg-green-100 text-secondary rounded-lg">
                <span class="material-symbols-outlined">auto_awesome</span>
            </div>
            <div>
                <h4 class="font-semibold text-gray-800">Insight IA</h4>
                <p class="text-sm text-gray-500 mt-2">Le sujet "Bois Local" connaît une hausse de 15% d'intérêt dans votre région ce mois-ci.</p>
            </div>
        </div>
        <div class="bg-white border-l-4 border-primary p-6 rounded-xl shadow-sm flex items-start gap-4">
            <div class="p-3 bg-orange-100 text-primary rounded-lg">
                <span class="material-symbols-outlined">trending_up</span>
            </div>
            <div>
                <h4 class="font-semibold text-gray-800">Performance</h4>
                <p class="text-sm text-gray-500 mt-2">Votre score SEO moyen a progressé de 4 points suite aux dernières optimisations.</p>
            </div>
        </div>
        <div class="bg-white border-l-4 border-tertiary p-6 rounded-xl shadow-sm flex items-start gap-4">
            <div class="p-3 bg-amber-100 text-tertiary rounded-lg">
                <span class="material-symbols-outlined">tips_and_updates</span>
            </div>
            <div>
                <h4 class="font-semibold text-gray-800">Conseil Local</h4>
                <p class="text-sm text-gray-500 mt-2">Ajoutez des mentions de quartiers spécifiques pour booster vos résultats "Near Me".</p>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
    // =============================================
    // RECHERCHE ET FILTRES
    // =============================================
    
    function filterArticles() {
        var searchTerm = document.getElementById('searchInput') ? document.getElementById('searchInput').value.toLowerCase() : '';
        var rows = document.querySelectorAll('#articlesTableBody .article-row');
        var activeFilter = document.querySelector('.filter-btn[style*="background: #8c4a2f"]');
        var status = activeFilter ? activeFilter.dataset.status : 'all';
        
        rows.forEach(function(row) {
            if (row.cells && row.cells.length > 0) {
                var title = row.dataset.title || '';
                var rowStatus = row.dataset.status || '';
                
                // Vérifier si l'article est programmé
                var isScheduled = rowStatus === 'draft' && row.querySelector('.bg-blue-100');
                if (status === 'scheduled') {
                    rowStatus = isScheduled ? 'scheduled' : rowStatus;
                }
                
                var matchesSearch = title.indexOf(searchTerm) !== -1;
                var matchesFilter = status === 'all' || rowStatus === status;
                
                if (matchesSearch && matchesFilter) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            }
        });
        
        // Afficher un message si aucun résultat
        var visibleRows = document.querySelectorAll('#articlesTableBody .article-row[style*="display:"]:not([style*="display: none"])');
        var emptyMessage = document.getElementById('emptyFilterMessage');
        
        if (visibleRows.length === 0) {
            if (!emptyMessage) {
                var tbody = document.getElementById('articlesTableBody');
                var msg = document.createElement('tr');
                msg.id = 'emptyFilterMessage';
                msg.innerHTML = `
                    <td colspan="5" class="px-6 py-12 text-center text-gray-500">
                        <span class="material-symbols-outlined text-4xl mb-2 block">search_off</span>
                        Aucun article ne correspond à vos filtres.
                    </td>
                `;
                tbody.appendChild(msg);
            }
        } else {
            if (emptyMessage) {
                emptyMessage.remove();
            }
        }
    }
    
    function filterByStatus(status) {
        var btns = document.querySelectorAll('.filter-btn');
        btns.forEach(function(btn) {
            btn.style.background = 'white';
            btn.style.color = '#6b7280';
            btn.style.border = '1px solid #d1d5db';
        });
        
        var activeBtn = document.querySelector('.filter-btn[data-status="' + status + '"]');
        if (activeBtn) {
            activeBtn.style.background = '#8c4a2f';
            activeBtn.style.color = 'white';
            activeBtn.style.border = 'none';
        }
        
        filterArticles();
    }
    
    // =============================================
    // SUPPRESSION D'ARTICLE
    // =============================================
    
    function deleteArticle(id, title) {
        if (!confirm('⚠️ Supprimer l\'article "' + title + '" ?\n\nCette action est irréversible.')) {
            return;
        }
        
        var token = document.querySelector('meta[name="csrf-token"]').content;
        
        
        fetch('/articles/' + id, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': token,
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            },
            body: JSON.stringify({ _method: 'DELETE' })
        })
        .then(function(response) {


            if (!response.ok) {
                return response.json().then(function(err) {
                    throw new Error(err.message || 'Erreur serveur');
                });
            }

            // Certains controllers retournent redirect/html au lieu de JSON
            return response.text().then(function(t) {
                try { return JSON.parse(t); } catch(e) { return { success: true }; }
            });

        })
        .then(function(data) {

            // Si l'article a disparu côté DB, la réponse peut être non-JSON (redirect HTML).
            if (data && data.success) {
                var row = document.querySelector('.article-row[data-id="' + id + '"]');
                if (row) row.remove();
                showToast('✅ Article supprimé avec succès');
                return;
            }

            // Fallback: on considère que si la requête est ok mais pas de JSON success,
            // l'opération a probablement réussi (surtout si la ligne disparaît côté UI).
            var row = document.querySelector('.article-row[data-id="' + id + '"]');
            if (row) row.remove();
            showToast('✅ Article supprimé (mode compatibilité)');

        })
        .catch(function(error) {
            console.error('Error:', error);
            alert('❌ Erreur lors de la suppression: ' + error.message);
        });
    }
    
    // =============================================
    // TOAST NOTIFICATION
    // =============================================
    
    function showToast(message) {
        var toast = document.createElement('div');
        toast.innerHTML = message;
        toast.style.cssText = `
            position: fixed;
            bottom: 20px;
            right: 20px;
            background: #1a1a2e;
            color: white;
            padding: 12px 24px;
            border-radius: 12px;
            z-index: 9999;
            font-size: 14px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.3);
            animation: slideUp 0.3s ease-out;
            max-width: 400px;
        `;
        document.body.appendChild(toast);
        setTimeout(function() {
            toast.style.opacity = '0';
            toast.style.transition = 'opacity 0.3s';
            setTimeout(function() {
                if (toast.parentNode) {
                    toast.parentNode.removeChild(toast);
                }
            }, 300);
        }, 3000);
    }
    
    // =============================================
    // RECHERCHE EN TEMPS RÉEL
    // =============================================
    
    var searchInput = document.getElementById('searchInput');
    if (searchInput) {
        searchInput.addEventListener('input', filterArticles);
        searchInput.addEventListener('focus', function() {
            this.parentElement.classList.add('scale-[1.02]');
            this.parentElement.style.transition = 'transform 0.2s ease-out';
        });
        searchInput.addEventListener('blur', function() {
            this.parentElement.classList.remove('scale-[1.02]');
        });
    }
    
    // =============================================
    // INITIALISATION
    // =============================================
    
    document.addEventListener('DOMContentLoaded', function() {
        filterArticles();
    });
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\pc\nearseo-laravel\resources\views/dashboard/articles/index.blade.php ENDPATH**/ ?>