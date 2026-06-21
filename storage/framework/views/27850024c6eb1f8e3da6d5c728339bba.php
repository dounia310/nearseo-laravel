


<?php $__env->startSection('title', 'Communauté NEARSEO | Expertise SEO Locale & IA'); ?>
<?php $__env->startSection('header-title', 'Communauté NEARSEO'); ?>

<?php $__env->startSection('content'); ?>
<div class="pt-16 min-h-screen">
    <!-- Hero Section -->
    <section class="py-20 bg-white border-b border-outline-variant">
        <div class="max-w-container-max-width mx-auto px-gutter text-center">
            <div class="inline-flex items-center gap-2 mb-4 bg-secondary-container px-3 py-1 rounded-full text-on-secondary-container">
                <span class="material-symbols-outlined text-sm">stars</span>
                <span class="font-label text-label">ORGANIC INTELLIGENCE</span>
            </div>
            <h1 class="font-h1 text-h1 md:text-5xl mb-6 text-on-surface">Communauté NEARSEO</h1>
            <p class="max-w-2xl mx-auto text-on-surface-variant text-body">
                Rejoignez le premier écosystème d'experts en SEO local. Alliez l'intuition humaine à la puissance de l'IA pour dominer vos marchés régionaux.
            </p>
        </div>
    </section>

    <!-- Dual-Level Filtering System -->
    <div class="sticky top-16 z-40 bg-background/80 backdrop-blur-md border-b border-outline-variant">
        <div class="max-w-container-max-width mx-auto px-gutter py-6 space-y-6">
            <!-- Level 1: Countries -->
            <div class="flex flex-wrap items-center gap-4">
                <label for="country-select" class="font-label text-on-surface-variant">PAYS :</label>
                <select id="country-select" class="bg-surface-container-low border border-outline-variant rounded-lg px-4 py-2 text-on-surface-variant focus:ring-2 focus:ring-primary focus:outline-none font-label cursor-pointer transition-all">
                    <option value="all">Tout</option>
                    <option value="maroc" selected>Maroc</option>
                    <option value="france">France</option>
                    <option value="belgique">Belgique</option>
                    <option value="suisse">Suisse</option>
                    <option value="canada">Canada</option>
                </select>
            </div>
            <!-- Level 2: Cities -->
            <div class="flex flex-wrap items-center gap-4">
                <label for="city-select" class="font-label text-on-surface-variant">VILLES :</label>
                <div class="relative flex-grow md:flex-grow-0">
                    <select id="city-select" class="appearance-none w-full md:w-48 bg-surface-container-low border border-outline-variant rounded-lg px-4 py-2 text-on-surface-variant focus:ring-2 focus:ring-primary focus:border-primary focus:outline-none font-label cursor-pointer transition-all">
                        <option value="casablanca" selected>Casablanca</option>
                        <option value="marrakech">Marrakech</option>
                        <option value="rabat">Rabat</option>
                        <option value="tanger">Tanger</option>
                        <option value="agadir">Agadir</option>
                        <option value="fes">Fès</option>
                    </select>
                    <span class="material-symbols-outlined absolute right-3 top-1/2 -translate-y-1/2 pointer-events-none text-on-surface-variant text-sm">expand_more</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Article Grid -->
    <section class="max-w-container-max-width mx-auto px-gutter py-section-margin">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php $__empty_1 = true; $__currentLoopData = $articles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $article): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <article class="tonal-card overflow-hidden rounded-xl">
                <div class="h-56 relative">
                    <div class="absolute top-4 right-4 z-10 flex items-center gap-1.5 bg-surface/80 backdrop-blur-md px-2.5 py-1 rounded-full text-on-surface shadow-lg border border-outline-variant">
                        <span class="font-label text-label"><?php echo e($article->category ?? 'SEO'); ?></span>
                    </div>
                    <?php if($article->image): ?>
                    <img class="w-full h-full object-cover" src="<?php echo e(asset('storage/' . $article->image)); ?>" alt="<?php echo e($article->title); ?>">
                    <?php else: ?>
                    <div class="w-full h-full bg-surface-container-high flex items-center justify-center">
                        <span class="material-symbols-outlined text-6xl text-on-surface-variant/30">article</span>
                    </div>
                    <?php endif; ?>
                </div>
                <div class="p-card-padding flex flex-col gap-stack-gap-md h-full">
                    <div class="ai-border-tint p-3 rounded-r-lg">
                        <span class="font-label text-secondary block mb-1"><?php echo e($article->type ?? 'STRATÉGIE LOCALE'); ?></span>
                        <h3 class="font-h3 text-h3 text-on-surface"><?php echo e($article->title); ?></h3>
                    </div>
                    <p class="text-on-surface-variant text-body-sm line-clamp-3">
                        <?php echo e(Str::limit(strip_tags($article->excerpt ?? $article->content), 150)); ?>

                    </p>
                    <div class="mt-auto pt-4 flex justify-between items-center border-t border-outline-variant">
                        <div class="flex items-center gap-2">
                            <div class="w-8 h-8 rounded-full bg-primary-fixed flex items-center justify-center text-primary font-bold text-xs">
                                <?php echo e($article->user->name[0] ?? 'A'); ?>

                            </div>
                            <span class="font-label text-body-sm"><?php echo e($article->user->name ?? 'Anonyme'); ?></span>
                        </div>
                        <a href="<?php echo e(route('community.article', $article->slug ?? $article->id)); ?>" class="text-primary font-bold text-label hover:underline flex items-center gap-1">
                            Lire plus <span class="material-symbols-outlined text-xs">arrow_forward</span>
                        </a>
                    </div>
                </div>
            </article>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div class="col-span-1 md:col-span-2 lg:col-span-3 text-center py-12">
                <span class="material-symbols-outlined text-6xl text-on-surface-variant/30">forum</span>
                <h3 class="text-xl font-bold text-on-surface mt-4">Aucun article</h3>
                <p class="text-on-surface-variant">Soyez le premier à partager une expertise</p>
            </div>
            <?php endif; ?>
        </div>

        <!-- Pagination -->
        <?php if($articles->hasPages()): ?>
        <div class="mt-8">
            <?php echo e($articles->links()); ?>

        </div>
        <?php endif; ?>
    </section>

    <!-- Newsletter CTA Section -->
    <section class="max-w-container-max-width mx-auto px-gutter mb-section-margin">
        <div class="bg-surface-container-highest rounded-2xl overflow-hidden relative p-12 flex flex-col items-center text-center">
            <div class="absolute top-0 left-0 w-full h-full opacity-10 pointer-events-none"></div>
            <div class="relative z-10 max-w-xl flex flex-col gap-6">
                <h2 class="font-h1 text-h1 text-on-surface">Restez à la pointe</h2>
                <p class="text-on-surface-variant text-body">
                    Recevez chaque semaine les dernières tendances de l'IA appliquée au SEO local, directement dans votre boîte mail.
                </p>
                <form class="flex flex-col md:flex-row gap-stack-gap-sm w-full" action="<?php echo e(route('newsletter.subscribe')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <input type="email" name="email" class="flex-grow bg-white border border-outline-variant rounded-full px-6 py-4 focus:ring-2 focus:ring-primary focus:border-primary outline-none transition-all" placeholder="Votre adresse email professionnel" required>
                    <button type="submit" class="bg-primary text-white px-8 py-4 rounded-full font-label hover:bg-primary-container transition-all active:scale-95 shadow-lg">
                        S'abonner maintenant
                    </button>
                </form>
                <p class="text-body-sm text-on-surface-variant/70">Rejoignez +5,000 experts déjà inscrits. Sans spam, jamais.</p>
            </div>
        </div>
    </section>
</div>

<style>
    .ai-border-tint {
        border-left: 4px solid #47664b;
        background-color: #f0f4f0;
    }
    .tonal-card {
        background-color: #ffffff;
        border: 1px solid #e5e7eb;
        transition: all 0.3s ease;
    }
    .tonal-card:hover {
        box-shadow: 0px 4px 12px rgba(0,0,0,0.05);
        transform: translateY(-2px);
    }
    .line-clamp-3 {
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
</style>

<script>
    // Interactive Micro-interactions
    document.querySelectorAll('.tonal-card').forEach(card => {
        card.addEventListener('mouseenter', () => {
            const img = card.querySelector('img');
            if (img) {
                img.style.transform = 'scale(1.05)';
                img.style.transition = 'transform 0.5s ease';
            }
        });
        card.addEventListener('mouseleave', () => {
            const img = card.querySelector('img');
            if (img) {
                img.style.transform = 'scale(1)';
            }
        });
    });

    // City filtering logic
    const citySelect = document.getElementById('city-select');
    const countrySelect = document.getElementById('country-select');

    if (citySelect) {
        citySelect.addEventListener('change', function() {
            // Filtrer les articles selon la ville
            const city = this.value;
            window.location.href = '<?php echo e(route("community.index")); ?>?city=' + encodeURIComponent(city) + '&country=' + encodeURIComponent(countrySelect.value);
        });
    }

    if (countrySelect) {
        countrySelect.addEventListener('change', function() {
            const country = this.value;
            window.location.href = '<?php echo e(route("community.index")); ?>?country=' + encodeURIComponent(country) + '&city=' + encodeURIComponent(citySelect.value);
        });
    }
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\pc\nearseo-laravel\resources\views/community.blade.php ENDPATH**/ ?>