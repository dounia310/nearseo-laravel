<div class="bg-surface-container-lowest border border-outline-variant rounded-xl p-6">
    <div class="flex items-center gap-4 mb-6">
        <div class="w-16 h-16 rounded-full bg-primary-fixed flex items-center justify-center">
            <span class="material-symbols-outlined text-3xl text-primary">account_circle</span>
        </div>
        <div>
            <h3 class="font-h2 text-h2 text-on-surface">Informations du profil</h3>
            <p class="text-body-sm text-on-surface-variant">Modifiez vos informations personnelles</p>
        </div>
    </div>
    
    <form method="POST" action="<?php echo e(route('profile.update')); ?>" class="space-y-4">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PATCH'); ?>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block font-label text-label text-on-surface-variant mb-1">Nom complet</label>
                <input type="text" name="name" value="<?php echo e(Auth::user()->name); ?>" class="w-full border border-outline-variant rounded-lg px-4 py-2 focus:ring-1 focus:ring-primary focus:border-primary outline-none">
            </div>
            <div>
                <label class="block font-label text-label text-on-surface-variant mb-1">Email</label>
                <input type="email" name="email" value="<?php echo e(Auth::user()->email); ?>" class="w-full border border-outline-variant rounded-lg px-4 py-2 focus:ring-1 focus:ring-primary focus:border-primary outline-none">
            </div>
            <div>
                <label class="block font-label text-label text-on-surface-variant mb-1">Téléphone</label>
                <input type="tel" name="phone" value="<?php echo e(Auth::user()->phone); ?>" class="w-full border border-outline-variant rounded-lg px-4 py-2">
            </div>
            <div>
                <label class="block font-label text-label text-on-surface-variant mb-1">Localisation</label>
                <input type="text" name="location" value="<?php echo e(Auth::user()->location); ?>" class="w-full border border-outline-variant rounded-lg px-4 py-2">
            </div>
        </div>
        
        <div class="flex justify-end pt-4">
            <button type="submit" class="bg-primary text-on-primary px-6 py-2 rounded-lg font-label hover:opacity-90 transition">Enregistrer</button>
        </div>
    </form>
</div><?php /**PATH C:\Users\pc\nearseo-laravel\resources\views/settings/partials/profile.blade.php ENDPATH**/ ?>