

<?php $__env->startSection('title', 'Communauté NEARSEO'); ?>
<?php $__env->startSection('header-title', 'Communauté'); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-container-max-width mx-auto">
    <!-- Page Header Section -->
    <section class="mb-10 flex flex-col md:flex-row md:items-end justify-between gap-gutter">
        <div>
            <h2 class="font-h1 text-h1 text-on-surface mb-2">Communauté NEARSEO</h2>
            <p class="font-body text-body text-on-surface-variant max-w-2xl">Découvrez les dernières tendances du SEO local et les insights de notre communauté d'experts à travers le monde.</p>
        </div>
        <div class="flex items-center gap-3">
            <button class="flex items-center gap-2 px-4 py-2 bg-white border border-outline-variant rounded-lg font-label text-on-surface hover:bg-surface-container-low transition-colors shadow-sm">
                <span>🌍 Tous les pays</span>
                <span class="material-symbols-outlined text-sm">expand_more</span>
            </button>
        </div>
    </section>

    <!-- Cities Filter (Bento Style Chips) -->
    <section class="mb-12">
        <h3 class="font-label text-label text-on-surface-variant uppercase tracking-widest mb-4">Villes actives</h3>
        <div class="flex flex-wrap gap-3">
            <button class="px-5 py-2.5 bg-primary text-white rounded-full font-label flex items-center gap-2 shadow-sm transition-all hover:scale-105">
                <span>Toutes</span>
            </button>
            <?php $__currentLoopData = $cities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $city): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <button onclick="filterByCity('<?php echo e($city->address); ?>')" class="px-5 py-2.5 bg-white border border-outline-variant text-on-surface rounded-full font-label flex items-center gap-2 hover:bg-surface-container transition-all hover:scale-105">
                <span><?php echo e($city->address); ?></span>
                <span class="bg-surface-container-highest px-2 py-0.5 rounded-full text-[10px]"><?php echo e($city->articles_count); ?></span>
            </button>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </section>

    <!-- Articles Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
        <?php $__empty_1 = true; $__currentLoopData = $articles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $article): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <article class="group bg-white rounded-xl border border-outline-variant overflow-hidden hover:shadow-xl transition-all duration-300 flex flex-col <?php echo e($article->ai_generated ? 'ai-indicator' : ''); ?>">
            <div class="relative h-52 overflow-hidden">
                <?php if($article->featured_image): ?>
                <img src="<?php echo e($article->featured_image); ?>" alt="<?php echo e($article->title); ?>" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                <?php else: ?>
                <div class="w-full h-full bg-gradient-to-br from-primary to-secondary flex items-center justify-center">
                    <span class="material-symbols-outlined text-white text-6xl opacity-40">article</span>
                </div>
                <?php endif; ?>
                
                <div class="absolute top-4 left-4 bg-white/90 backdrop-blur-md px-3 py-1.5 rounded-lg flex items-center gap-1.5 shadow-sm">
                    <span class="material-symbols-outlined text-primary text-sm" style="font-variation-settings: 'FILL' 1;">location_on</span>
                    <span class="font-label text-[10px] text-on-surface uppercase"><?php echo e($article->address ?? 'Non localisé'); ?></span>
                </div>
                
                <?php if($article->ai_generated): ?>
                <div class="absolute bottom-0 left-0 right-0 p-3 bg-secondary/90 backdrop-blur-sm">
                    <p class="font-label text-[10px] text-white flex items-center gap-1">
                        <span class="material-symbols-outlined text-[12px]">auto_awesome</span> ANALYSE PRÉDICTIVE AI
                    </p>
                </div>
                <?php endif; ?>
            </div>
            
            <div class="p-card-padding flex-1 flex flex-col">
                <div class="flex justify-between items-center mb-3">
                    <span class="font-body-sm text-on-surface-variant opacity-60"><?php echo e($article->created_at->diffForHumans()); ?></span>
                    <?php if($article->seo_score >= 80): ?>
                    <div class="flex items-center gap-1">
                        <span class="material-symbols-outlined text-secondary text-sm">trending_up</span>
                        <span class="font-label text-[10px] text-secondary">Boosté par AI</span>
                    </div>
                    <?php endif; ?>
                </div>
                
                <h3 class="font-h3 text-h3 text-on-surface mb-3 group-hover:text-primary transition-colors line-clamp-2"><?php echo e($article->title); ?></h3>
                <p class="font-body text-body-sm text-on-surface-variant line-clamp-3 mb-6"><?php echo e(Str::limit(strip_tags($article->content), 120)); ?></p>
                
                <div class="mt-auto pt-6 border-t border-outline-variant flex items-center justify-between">
                    <div class="flex items-center gap-2">
                        <div class="w-8 h-8 rounded-full bg-primary-fixed flex items-center justify-center">
                            <span class="text-primary text-xs font-bold"><?php echo e(strtoupper(substr($article->user->name ?? 'U', 0, 1))); ?></span>
                        </div>
                        <span class="font-label text-on-surface"><?php echo e($article->user->name ?? 'Anonyme'); ?></span>
                    </div>
                    <a href="<?php echo e(route('articles.show', $article)); ?>" class="font-label text-primary flex items-center gap-1 hover:gap-2 transition-all">
                        Lire <span class="material-symbols-outlined text-sm">arrow_forward</span>
                    </a>
                </div>
            </div>
        </article>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <div class="col-span-3 text-center py-12">
            <span class="material-symbols-outlined text-6xl text-gray-300 mb-3">forum</span>
            <p class="text-gray-500">Aucun article publié pour le moment</p>
            <a href="<?php echo e(route('ai.create')); ?>" class="inline-block mt-3 text-primary hover:underline">✏️ Créer votre premier article</a>
        </div>
        <?php endif; ?>
    </div>

    <!-- Pagination -->
    <nav class="flex items-center justify-center gap-2 mb-20">
        <?php echo e($articles->links()); ?>

    </nav>

    <!-- Community Call to Action -->
    <section class="relative bg-inverse-surface text-white rounded-3xl p-12 overflow-hidden">
        <div class="relative z-10 flex flex-col md:flex-row items-center justify-between gap-8">
            <div class="max-w-xl text-center md:text-left">
                <h2 class="font-h1 text-h1 text-white mb-4">Rejoignez l'élite du SEO Local</h2>
                <p class="font-body text-body text-white/80">Partagez votre expertise, accédez à des outils exclusifs et connectez-vous avec les meilleurs agences locales du réseau NEARSEO.</p>
            </div>
            <div class="flex flex-col sm:flex-row gap-4">
                <a href="<?php echo e(route('ai.create')); ?>" class="px-8 py-4 bg-white text-primary font-bold rounded-xl shadow-lg hover:scale-105 transition-all text-center">
                    Devenir contributeur
                </a>
                <button class="px-8 py-4 border border-white/30 text-white font-bold rounded-xl hover:bg-white/10 transition-all">
                    En savoir plus
                </button>
            </div>
        </div>
    </section>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('styles'); ?>
<style>
    .ai-indicator {
        border-left: 4px solid #47664b;
        background-color: #f0f4f0;
    }
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    .line-clamp-3 {
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
    function filterByCity(city) {
        const url = new URL(window.location.href);
        url.searchParams.set('city', city);
        window.location.href = url.toString();
    }
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\pc\nearseo-laravel\resources\views/dashboard/community.blade.php ENDPATH**/ ?>