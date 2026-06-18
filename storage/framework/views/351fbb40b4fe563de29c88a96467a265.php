

<?php $__env->startSection('title', 'Profil Utilisateur'); ?>
<?php $__env->startSection('header-title', 'Profil Utilisateur'); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-[1280px] mx-auto">
    <!-- Page Header -->
    <div class="mb-8">
        <p class="text-body text-on-surface-variant">Gérez vos informations personnelles et suivez vos performances SEO.</p>
    </div>
    
    <div class="grid grid-cols-12 gap-8">
        <!-- Left Column: User Information Form -->
        <div class="col-span-12 lg:col-span-7 space-y-4">
            <section class="bg-white border rounded-xl p-6">
                <h3 class="font-semibold text-lg mb-6">Informations Générales</h3>
                
                <form id="profileForm" class="space-y-6" action="<?php echo e(route('profile.update')); ?>" method="POST" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PATCH'); ?>
                    
                    <!-- Avatar Upload Section -->
                    <div class="flex items-center space-x-6 pb-6 border-b">
                        <div class="relative group">
                            <div class="w-24 h-24 rounded-full overflow-hidden border-2 border-primary/20 bg-gray-100">
                                <img id="avatarPreview" alt="Avatar Preview" class="w-full h-full object-cover" src="<?php echo e(Auth::user()->avatar ? Storage::url(Auth::user()->avatar) : 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name ?? 'User') . '&background=8c4a2f&color=fff'); ?>"/>
                            </div>
                            <label for="avatarInput" class="absolute bottom-0 right-0 bg-primary text-white p-1.5 rounded-full shadow-lg hover:scale-110 transition-transform cursor-pointer">
                                <span class="material-symbols-outlined text-[18px]">photo_camera</span>
                            </label>
                            <input type="file" id="avatarInput" name="avatar" accept="image/*" class="hidden" onchange="previewAvatar(this)">
                        </div>
                        <div>
                            <h4 class="font-semibold">Photo de profil</h4>
                            <p class="text-sm text-gray-500">JPG, GIF ou PNG. 800px max.</p>
                            <button type="button" class="mt-2 text-primary text-sm font-semibold hover:underline" onclick="document.getElementById('avatarInput').click()">Modifier l'image</button>
                        </div>
                    </div>
                    
                    <!-- Input Fields Grid -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="text-xs font-bold text-gray-500 uppercase tracking-wider">Nom Complet</label>
                            <input name="name" class="w-full mt-1 bg-white border rounded-lg px-4 py-2.5 focus:ring-1 focus:ring-primary focus:border-primary outline-none" type="text" value="<?php echo e(old('name', Auth::user()->name)); ?>"/>
                        </div>
                        <div>
                            <label class="text-xs font-bold text-gray-500 uppercase tracking-wider">Email</label>
                            <input name="email" class="w-full mt-1 bg-white border rounded-lg px-4 py-2.5 focus:ring-1 focus:ring-primary focus:border-primary outline-none" type="email" value="<?php echo e(old('email', Auth::user()->email)); ?>"/>
                        </div>
                        <div>
                            <label class="text-xs font-bold text-gray-500 uppercase tracking-wider">Numéro de Téléphone</label>
                            <input name="phone" class="w-full mt-1 bg-white border rounded-lg px-4 py-2.5 focus:ring-1 focus:ring-primary focus:border-primary outline-none" type="tel" value="<?php echo e(old('phone', Auth::user()->phone ?? '+33 6 12 34 56 78')); ?>"/>
                        </div>
                        <div>
                            <label class="text-xs font-bold text-gray-500 uppercase tracking-wider">Localisation</label>
                            <input name="location" class="w-full mt-1 bg-white border rounded-lg px-4 py-2.5 focus:ring-1 focus:ring-primary focus:border-primary outline-none" type="text" value="<?php echo e(old('location', Auth::user()->location ?? 'Paris, France')); ?>"/>
                        </div>
                    </div>
                    
                    <div class="pt-6 border-t flex justify-end">
                        <button class="bg-primary text-white px-8 py-3 rounded-xl font-semibold shadow-sm hover:opacity-90 active:scale-95 transition-all" type="submit">
                            Enregistrer
                        </button>
                    </div>
                </form>
            </section>
        </div>
        
        <!-- Right Column: User Stats and Rewards -->
        <div class="col-span-12 lg:col-span-5 space-y-4">
            <!-- Current Plan Card -->
            <div class="bg-gray-800 text-white rounded-xl p-6 relative overflow-hidden">
                <div class="absolute top-0 right-0 w-32 h-32 bg-primary/20 rounded-full -mr-16 -mt-16 blur-3xl"></div>
                <div class="relative z-10">
                    <span class="bg-primary/20 text-primary text-[10px] px-2 py-1 rounded-full uppercase mb-4 inline-block">Plan Actuel</span>
                    <h3 class="text-2xl font-bold mb-1"><?php echo e(Auth::user()->plan ?? 'Pro Plan'); ?></h3>
                    <p class="text-sm opacity-80 mb-6">Renouvellement le <?php echo e(Auth::user()->subscription_end ?? '12 Octobre 2023'); ?></p>
                    <button class="w-full py-2.5 border border-white/30 rounded-lg font-semibold hover:bg-white hover:text-gray-800 transition-colors">
                        Gérer l'abonnement
                    </button>
                </div>
            </div>
            
            <!-- Personal Stats Section -->
            <div class="bg-white border rounded-xl p-6">
                <h3 class="font-semibold text-lg mb-6">Statistiques Personnelles</h3>
                <div class="grid grid-cols-1 gap-4">
                    <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-green-100 text-green-800 rounded-full flex items-center justify-center mr-4">
                                <span class="material-symbols-outlined">edit_note</span>
                            </div>
                            <span class="text-sm font-medium">Articles Publiés</span>
                        </div>
                        <span class="text-2xl font-bold"><?php echo e($stats['published_articles'] ?? 0); ?></span>
                    </div>
                    <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-orange-100 text-orange-800 rounded-full flex items-center justify-center mr-4">
                                <span class="material-symbols-outlined">visibility</span>
                            </div>
                            <span class="text-sm font-medium">Vues Totales</span>
                        </div>
                        <span class="text-2xl font-bold"><?php echo e(number_format($stats['total_views'] ?? 0)); ?></span>
                    </div>
                    <div class="flex items-center justify-between p-4 bg-green-50 rounded-lg border-l-4 border-green-600">
                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-green-100 text-green-800 rounded-full flex items-center justify-center mr-4">
                                <span class="material-symbols-outlined">trending_up</span>
                            </div>
                            <span class="text-sm font-medium">Score SEO Moyen</span>
                        </div>
                        <div class="flex items-center text-green-700">
                            <span class="text-2xl font-bold mr-1"><?php echo e($stats['avg_seo_score'] ?? 0); ?></span>
                            <span class="text-xs font-bold">/100</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Achievement Badges Grid -->
            <div class="bg-white border rounded-xl p-6">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="font-semibold text-lg">Badges de Réussite</h3>
                    <button class="text-primary text-sm hover:underline">Voir tous les badges</button>
                </div>
                <div class="grid grid-cols-3 gap-4">
                    <?php $__currentLoopData = $badges; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $badge): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="achievement-card flex flex-col items-center p-3 rounded-lg border transition-all cursor-help" title="<?php echo e($badge['title']); ?>">
                        <div class="w-12 h-12 <?php echo e($badge['active'] ? 'bg-amber-100 text-amber-800' : 'bg-gray-100 text-gray-400'); ?> rounded-full flex items-center justify-center mb-2">
                            <span class="material-symbols-outlined"><?php echo e($badge['icon']); ?></span>
                        </div>
                        <span class="text-[10px] text-center uppercase font-bold <?php echo e(!$badge['active'] ? 'text-gray-400' : ''); ?>"><?php echo e($badge['name']); ?></span>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('styles'); ?>
<style>
    .achievement-card:hover {
        transform: translateY(-2px);
        box-shadow: 0px 4px 12px rgba(0,0,0,0.05);
    }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
    // Preview avatar before upload
    function previewAvatar(input) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('avatarPreview').src = e.target.result;
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
    
    // Profile form submission
    document.getElementById('profileForm').addEventListener('submit', function(e) {
        const btn = this.querySelector('button[type="submit"]');
        const originalText = btn.innerHTML;
        btn.innerHTML = '<span class="material-symbols-outlined animate-spin mr-2">sync</span> Enregistrement...';
        btn.disabled = true;
        
        // Le formulaire sera soumis normalement
        setTimeout(() => {
            btn.innerHTML = originalText;
            btn.disabled = false;
        }, 2000);
    });
    
    // Soft interaction on badge cards
    const cards = document.querySelectorAll('.achievement-card');
    cards.forEach(card => {
        card.addEventListener('mouseenter', () => {
            card.style.borderColor = '#8c4a2f';
        });
        card.addEventListener('mouseleave', () => {
            card.style.borderColor = '';
        });
    });
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\pc\nearseo-laravel\resources\views/dashboard/profile.blade.php ENDPATH**/ ?>