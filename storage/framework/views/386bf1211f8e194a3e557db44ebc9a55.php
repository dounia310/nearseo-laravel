
<div class="bg-surface-container-lowest border border-outline-variant rounded-xl p-6">
    <div class="flex items-center gap-4 mb-6">
        <div class="w-16 h-16 rounded-full bg-primary-fixed flex items-center justify-center">
            <span class="material-symbols-outlined text-3xl text-primary">account_circle</span>
        </div>
        <div>
            <h3 class="font-h2 text-h2 text-on-surface">Informations du profil</h3>
            <p class="text-body-sm text-on-surface-variant">Modifiez vos informations personnelles et de commerce</p>
        </div>
    </div>
    
    <?php if(session('success')): ?>
        <div class="mb-4 p-3 bg-green-50 border border-green-200 text-green-700 rounded-lg text-sm">
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>

    <?php if($errors->any()): ?>
        <div class="mb-4 p-3 bg-red-50 border border-red-200 text-red-700 rounded-lg text-sm">
            <ul class="list-disc list-inside">
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    <?php endif; ?>
    
    <form method="POST" action="<?php echo e(route('profile.update')); ?>" class="space-y-6">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PATCH'); ?>
        
        
        
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block font-label text-label text-on-surface-variant mb-1">
                    Nom complet <span class="text-red-500">*</span>
                </label>
                <input type="text" name="name" value="<?php echo e(old('name', Auth::user()->name)); ?>" required
                       class="w-full border border-outline-variant rounded-lg px-4 py-2 focus:ring-1 focus:ring-primary focus:border-primary outline-none">
                <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-red-500 text-xs mt-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            <div>
                <label class="block font-label text-label text-on-surface-variant mb-1">
                    Email <span class="text-red-500">*</span>
                </label>
                <input type="email" name="email" value="<?php echo e(old('email', Auth::user()->email)); ?>" required
                       class="w-full border border-outline-variant rounded-lg px-4 py-2 focus:ring-1 focus:ring-primary focus:border-primary outline-none">
                <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-red-500 text-xs mt-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            <div>
                <label class="block font-label text-label text-on-surface-variant mb-1">Téléphone</label>
                <input type="tel" name="phone" value="<?php echo e(old('phone', Auth::user()->phone)); ?>" 
                       class="w-full border border-outline-variant rounded-lg px-4 py-2">
            </div>
            <div>
                <label class="block font-label text-label text-on-surface-variant mb-1">Localisation</label>
                <input type="text" name="location" value="<?php echo e(old('location', Auth::user()->location)); ?>" 
                       class="w-full border border-outline-variant rounded-lg px-4 py-2">
            </div>
        </div>

        
        
        
        <div id="business" class="mt-8 pt-8 border-t border-outline-variant">
            <div class="flex items-center gap-2 mb-2">
                <span class="material-symbols-outlined text-primary text-2xl">storefront</span>
                <h3 class="font-h2 text-h2 text-on-surface">Mon commerce</h3>
            </div>
            <p class="text-body-sm text-on-surface-variant mb-6">
                Ces informations seront utilisées automatiquement pour générer vos articles SEO.
            </p>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                
                <div>
                    <label class="block font-label text-label text-on-surface-variant mb-1">
                        Nom du commerce
                    </label>
                    <input type="text" 
                           name="business_name" 
                           value="<?php echo e(old('business_name', Auth::user()->business_name)); ?>"
                           class="w-full border border-outline-variant rounded-lg px-4 py-2"
                           placeholder="Ex: La Maison du Pain">
                </div>

                
                <div>
                    <label class="block font-label text-label text-on-surface-variant mb-1">
                        Catégorie
                    </label>
                    <select name="business_category" 
                            class="w-full border border-outline-variant rounded-lg px-4 py-2">
                        <option value="">Sélectionner...</option>
                        <?php $__currentLoopData = ['Tourisme', 'E-commerce', 'Gastronomie', 'Immobilier', 'Santé', 'Mode', 'Tech', 'Artisanat', 'Sport', 'Culture', 'Éducation', 'Automobile', 'Autre']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($cat); ?>" <?php echo e(old('business_category', Auth::user()->business_category) === $cat ? 'selected' : ''); ?>>
                                <?php echo e($cat); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
            </div>

            
            <div class="mt-4">
                <label class="block font-label text-label text-on-surface-variant mb-2">
                    Type d'activité
                </label>
                <div class="grid grid-cols-2 gap-3">
                    <label class="cursor-pointer">
                        <input type="radio" name="business_mode" value="local" id="settingsModeLocal"
                               <?php echo e(old('business_mode', Auth::user()->business_mode ?? 'local') === 'local' ? 'checked' : ''); ?>

                               class="peer sr-only">
                        <div class="p-3 border-2 border-outline-variant rounded-lg text-center peer-checked:border-primary peer-checked:bg-primary/5">
                            <div class="text-2xl">🏪</div>
                            <div class="font-bold text-sm">Commerce local</div>
                        </div>
                    </label>
                    <label class="cursor-pointer">
                        <input type="radio" name="business_mode" value="online" id="settingsModeOnline"
                               <?php echo e(old('business_mode', Auth::user()->business_mode) === 'online' ? 'checked' : ''); ?>

                               class="peer sr-only">
                        <div class="p-3 border-2 border-outline-variant rounded-lg text-center peer-checked:border-primary peer-checked:bg-primary/5">
                            <div class="text-2xl">🌐</div>
                            <div class="font-bold text-sm">Entreprise en ligne</div>
                        </div>
                    </label>
                </div>
            </div>

            
            <div id="settingsLocalFields" class="mt-4 space-y-4">
                
                <div>
                    <label class="block font-label text-label text-on-surface-variant mb-1">Adresse</label>
                    <input type="text" 
                           name="business_address" 
                           id="settingsBusinessAddress"
                           value="<?php echo e(old('business_address', Auth::user()->business_address)); ?>"
                           class="w-full border border-outline-variant rounded-lg px-4 py-2"
                           placeholder="Ex: 123 Avenue Mohammed VI">
                </div>

                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block font-label text-label text-on-surface-variant mb-1">Ville</label>
                        <input type="text" 
                               name="business_city" 
                               id="settingsBusinessCity"
                               value="<?php echo e(old('business_city', Auth::user()->business_city)); ?>"
                               class="w-full border border-outline-variant rounded-lg px-4 py-2"
                               placeholder="Marrakech">
                    </div>
                    <div>
                        <label class="block font-label text-label text-on-surface-variant mb-1">Quartier</label>
                        <input type="text" 
                               name="business_district" 
                               value="<?php echo e(old('business_district', Auth::user()->business_district)); ?>"
                               class="w-full border border-outline-variant rounded-lg px-4 py-2"
                               placeholder="Guéliz">
                    </div>
                </div>
            </div>

            
            <div class="mt-4">
                <label class="block font-label text-label text-on-surface-variant mb-1">Pays</label>
                <select name="business_country" 
                        class="w-full border border-outline-variant rounded-lg px-4 py-2">
                    <?php $__currentLoopData = ['Maroc', 'France', 'Belgique', 'Suisse', 'Canada', 'Sénégal', 'Côte d\'Ivoire', 'Espagne', 'Italie', 'Allemagne']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pays): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($pays); ?>" <?php echo e(old('business_country', Auth::user()->business_country ?? 'Maroc') === $pays ? 'selected' : ''); ?>>
                            <?php echo e($pays); ?>

                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>

            
            <div class="mt-4">
                <label class="block font-label text-label text-on-surface-variant mb-1">
                    Site web <span id="settingsWebsiteRequired" class="text-red-500 hidden">*</span>
                </label>
                <input type="url" 
                       name="business_website" 
                       id="settingsBusinessWebsite"
                       value="<?php echo e(old('business_website', Auth::user()->business_website)); ?>"
                       class="w-full border border-outline-variant rounded-lg px-4 py-2"
                       placeholder="https://monsite.com">
            </div>
        </div>
        
        
        <div class="flex justify-end pt-4 border-t border-outline-variant">
            <button type="submit" 
                    class="bg-primary text-on-primary px-6 py-2 rounded-lg font-label hover:opacity-90 transition">
                Enregistrer
            </button>
        </div>
    </form>
</div>

<?php $__env->startPush('scripts'); ?>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const modeLocal = document.getElementById('settingsModeLocal');
    const modeOnline = document.getElementById('settingsModeOnline');
    const localFields = document.getElementById('settingsLocalFields');
    const websiteRequired = document.getElementById('settingsWebsiteRequired');
    const businessWebsite = document.getElementById('settingsBusinessWebsite');
    const businessAddress = document.getElementById('settingsBusinessAddress');
    const businessCity = document.getElementById('settingsBusinessCity');

    function toggleFields() {
        if (modeOnline && modeOnline.checked) {
            // ═══ MODE ONLINE ═══
            localFields.style.display = 'none';
            if (businessAddress) businessAddress.removeAttribute('required');
            if (businessCity) businessCity.removeAttribute('required');

            if (websiteRequired) websiteRequired.classList.remove('hidden');
            if (businessWebsite) businessWebsite.setAttribute('required', 'required');
        } else {
            // ═══ MODE LOCAL ═══
            localFields.style.display = 'block';

            if (websiteRequired) websiteRequired.classList.add('hidden');
            if (businessWebsite) businessWebsite.removeAttribute('required');
        }
    }

    if (modeLocal) modeLocal.addEventListener('change', toggleFields);
    if (modeOnline) modeOnline.addEventListener('change', toggleFields);
    toggleFields();
});
</script>
<?php $__env->stopPush(); ?><?php /**PATH C:\Users\pc\nearseo-laravel\resources\views/settings/partials/profile.blade.php ENDPATH**/ ?>