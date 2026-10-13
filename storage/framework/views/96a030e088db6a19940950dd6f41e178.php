<!-- Statistiques - Cartes KPI -->
<div class="grid grid-cols-1 md:grid-cols-4 gap-4">
    <div class="bg-surface-container-lowest p-6 border border-outline-variant rounded-xl">
        <div class="flex justify-between items-start mb-4">
            <span class="material-symbols-outlined p-2 bg-primary-fixed text-primary rounded-lg">group</span>
            <span class="text-secondary font-label flex items-center gap-1">+12% <span class="material-symbols-outlined text-sm">trending_up</span></span>
        </div>
        <p class="text-on-surface-variant font-label uppercase">Total Utilisateurs</p>
        <h3 class="font-h1 text-h1 text-on-surface mt-1"><?php echo e(number_format($totalUsers)); ?></h3>
    </div>
    
    <div class="bg-surface-container-lowest p-6 border border-outline-variant rounded-xl">
        <div class="flex justify-between items-start mb-4">
            <span class="material-symbols-outlined p-2 bg-secondary-container text-secondary rounded-lg">article</span>
            <span class="text-secondary font-label flex items-center gap-1">+5% <span class="material-symbols-outlined text-sm">trending_up</span></span>
        </div>
        <p class="text-on-surface-variant font-label uppercase">Total Articles</p>
        <h3 class="font-h1 text-h1 text-on-surface mt-1"><?php echo e(number_format($totalArticles)); ?></h3>
    </div>
    
    <div class="bg-surface-container-lowest p-6 border border-outline-variant rounded-xl">
        <div class="flex justify-between items-start mb-4">
            <span class="material-symbols-outlined p-2 bg-tertiary-fixed text-tertiary rounded-lg">visibility</span>
            <span class="text-error font-label flex items-center gap-1">-2% <span class="material-symbols-outlined text-sm">trending_down</span></span>
        </div>
        <p class="text-on-surface-variant font-label uppercase">Total Vues</p>
        <h3 class="font-h1 text-h1 text-on-surface mt-1"><?php echo e(number_format($totalViews)); ?></h3>
    </div>
    
    <div class="bg-surface-container-lowest p-6 border border-outline-variant rounded-xl border-l-4 border-l-secondary">
        <div class="flex justify-between items-start mb-4">
            <span class="material-symbols-outlined p-2 bg-secondary-container text-secondary rounded-lg">bolt</span>
            <span class="text-secondary font-label">Optimisé</span>
        </div>
        <p class="text-on-surface-variant font-label uppercase">Score SEO Moyen</p>
        <h3 class="font-h1 text-h1 text-on-surface mt-1"><?php echo e($avgSeoScore); ?><span class="text-body text-on-surface-variant">/100</span></h3>
    </div>
</div>

<!-- Articles par ville -->
<div class="bg-surface-container-lowest border border-outline-variant rounded-xl p-6 mt-6">
    <div class="flex items-center justify-between mb-6">
        <h3 class="font-h3 text-h3 text-on-surface">Articles par ville</h3>
        <span class="material-symbols-outlined text-on-surface-variant">location_on</span>
    </div>
    <div class="space-y-4">
        <?php $__currentLoopData = $articlesByCity; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $city): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="space-y-1">
            <div class="flex justify-between font-label">
                <span class="text-on-surface"><?php echo e($city->address ?? 'Non localisé'); ?></span>
                <span class="text-primary"><?php echo e($city->count); ?></span>
            </div>
            <div class="h-2 w-full bg-surface-container-high rounded-full overflow-hidden">
                <div class="h-full bg-primary rounded-full opacity-<?php echo e(min(100, $city->count / 10)); ?>" style="width: <?php echo e(min(100, $city->count / 10)); ?>%"></div>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
    <button class="w-full mt-6 py-2 text-primary font-label border border-primary rounded-lg hover:bg-primary-fixed transition-colors">
        Voir le rapport complet
    </button>
</div>

<!-- Insight IA -->
<div class="bg-secondary-container p-6 rounded-xl relative overflow-hidden group mt-6">
    <div class="absolute -right-8 -top-8 w-32 h-32 bg-on-secondary-container opacity-5 rounded-full group-hover:scale-125 transition-transform duration-500"></div>
    <div class="relative z-10">
        <div class="flex items-center gap-2 mb-2 text-on-secondary-container">
            <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">auto_awesome</span>
            <span class="font-label uppercase">Insight IA</span>
        </div>
        <p class="text-body-sm text-on-secondary-fixed-variant leading-relaxed">
            L'activité de publication est en hausse de <strong class="font-bold">14%</strong> à Lyon ce mois-ci. Nous suggérons d'allouer plus de ressources de révision humaine sur ce secteur pour maintenir la qualité SEO.
        </p>
    </div>
</div><?php /**PATH C:\Users\pc\nearseo-laravel\resources\views/settings/partials/admin-stats.blade.php ENDPATH**/ ?>