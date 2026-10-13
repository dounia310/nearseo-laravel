


<?php $__env->startSection('title', $user->name . ' - Profil'); ?>
<?php $__env->startSection('blog-title', $user->name); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <!-- Profil Header -->
    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden">
        <div class="bg-gradient-to-r from-primary/10 to-secondary/10 dark:from-primary/20 dark:to-secondary/20 px-8 py-12 text-center">
            <!-- Avatar -->
            <div class="w-32 h-32 rounded-full mx-auto mb-4 bg-white dark:bg-gray-800 shadow-lg flex items-center justify-center border-4 border-white dark:border-gray-800">
                <?php if($user->avatar): ?>
                    <img src="<?php echo e(asset('storage/' . $user->avatar)); ?>" alt="<?php echo e($user->name); ?>" class="w-full h-full rounded-full object-cover">
                <?php else: ?>
                    <span class="material-symbols-outlined text-6xl text-primary">person</span>
                <?php endif; ?>
            </div>
            
            <!-- Nom et bio -->
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white"><?php echo e($user->name); ?></h1>
            <p class="text-gray-500 dark:text-gray-400 mt-1"><?php echo e($user->bio ?? 'Auteur sur NEARSEO'); ?></p>
            
            <!-- Statistiques -->
            <div class="flex flex-wrap justify-center gap-6 mt-4 text-sm text-gray-500 dark:text-gray-400">
                <span class="flex items-center gap-1">
                    <span class="material-symbols-outlined text-sm">article</span>
                    <?php echo e($user->articles()->where('status', 'published')->count()); ?> articles
                </span>
                <span class="flex items-center gap-1">
                    <span class="material-symbols-outlined text-sm">calendar_month</span>
                    Inscrit en <?php echo e($user->created_at->format('F Y')); ?>

                </span>
                <span class="flex items-center gap-1">
                    <span class="material-symbols-outlined text-sm">visibility</span>
                    <?php echo e(number_format($user->articles()->where('status', 'published')->sum('views'))); ?> vues
                </span>
                <?php if(auth()->guard()->check()): ?>
                    <?php if(Auth::id() === $user->id): ?>
                        <a href="<?php echo e(route('profile.edit')); ?>" 
                           class="flex items-center gap-1 text-primary hover:text-primary/80 transition">
                            <span class="material-symbols-outlined text-sm">edit</span>
                            Modifier
                        </a>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
        </div>

        <!-- Contenu -->
        <div class="p-8">
            <?php if($user->bio): ?>
                <div class="mb-8">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">À propos</h3>
                    <p class="text-gray-600 dark:text-gray-300 leading-relaxed"><?php echo e($user->bio); ?></p>
                </div>
            <?php endif; ?>

            <!-- Derniers articles -->
            <div>
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">
                    Derniers articles
                    <?php if($articles instanceof \Illuminate\Contracts\Pagination\LengthAwarePaginator): ?>
                        <span class="ml-2 text-sm font-normal text-gray-500 dark:text-gray-400">
                            (<?php echo e($articles->total()); ?>)
                        </span>
                    <?php else: ?>
                        <span class="ml-2 text-sm font-normal text-gray-500 dark:text-gray-400">
                            (<?php echo e($articles->count()); ?>)
                        </span>
                    <?php endif; ?>
                </h3>
                
                <?php if($articles->count() > 0): ?>
                    <div class="space-y-4">
                        <?php $__currentLoopData = $articles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $article): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="flex items-center gap-4 p-4 bg-gray-50 dark:bg-gray-900/50 rounded-xl hover:bg-gray-100 dark:hover:bg-gray-800 transition group">
                                <!-- Image miniature -->
                                <div class="w-16 h-16 rounded-lg overflow-hidden flex-shrink-0 bg-primary/10 dark:bg-primary/20 flex items-center justify-center">
                                    <?php if($article->image): ?>
                                        <img src="<?php echo e(asset('storage/' . $article->image)); ?>" alt="<?php echo e($article->title); ?>" class="w-full h-full object-cover">
                                    <?php else: ?>
                                        <span class="material-symbols-outlined text-2xl text-primary/40 dark:text-primary/60">article</span>
                                    <?php endif; ?>
                                </div>
                                
                                <!-- Infos article -->
                                <div class="flex-1 min-w-0">
                                    <a href="<?php echo e(route('blog.user.article', [$user->slug, $article->slug])); ?>" 
                                       class="font-semibold text-gray-900 dark:text-white group-hover:text-primary transition">
                                        <?php echo e($article->title); ?>

                                    </a>
                                    <div class="flex items-center flex-wrap gap-3 text-xs text-gray-500 dark:text-gray-400 mt-1">
                                        <span><?php echo e($article->created_at->format('d/m/Y')); ?></span>
                                        <span>•</span>
                                        <span class="flex items-center gap-1">
                                            <span class="material-symbols-outlined text-xs">visibility</span>
                                            <?php echo e($article->views ?? 0); ?> vues
                                        </span>
                                        <?php if($article->seo_score): ?>
                                            <span>•</span>
                                            <span class="flex items-center gap-1">
                                                <span class="material-symbols-outlined text-xs">trending_up</span>
                                                <span class="<?php echo e($article->seo_score >= 70 ? 'text-green-600 dark:text-green-400' : ($article->seo_score >= 50 ? 'text-yellow-600 dark:text-yellow-400' : 'text-red-600 dark:text-red-400')); ?>">
                                                    <?php echo e($article->seo_score); ?>%
                                                </span>
                                            </span>
                                        <?php endif; ?>
                                        <?php if($article->status === 'published'): ?>
                                            <span class="px-2 py-0.5 bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-400 rounded-full text-xs">
                                                Publié
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                
                                <a href="<?php echo e(route('blog.user.article', [$user->slug, $article->slug])); ?>" 
                                   class="text-primary hover:text-primary/80 text-sm font-medium flex items-center gap-1">
                                    Lire
                                    <span class="material-symbols-outlined text-sm">arrow_forward</span>
                                </a>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                    
                    <!-- Pagination -->
                    <?php if($articles instanceof \Illuminate\Contracts\Pagination\LengthAwarePaginator): ?>
                        <div class="mt-6">
                            <?php echo e($articles->links()); ?>

                        </div>
                    <?php endif; ?>
                <?php else: ?>
                    <div class="text-center py-8">
                        <span class="material-symbols-outlined text-4xl text-gray-300 dark:text-gray-600">article</span>
                        <p class="mt-2 text-gray-500 dark:text-gray-400">Aucun article publié</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.blog', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\pc\nearseo-laravel\resources\views/blog/user-profile.blade.php ENDPATH**/ ?>