{{-- resources/views/settings/partials/profile.blade.php --}}
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
    
    @if(session('success'))
        <div class="mb-4 p-3 bg-green-50 border border-green-200 text-green-700 rounded-lg text-sm">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="mb-4 p-3 bg-red-50 border border-red-200 text-red-700 rounded-lg text-sm">
            <ul class="list-disc list-inside">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    
    <form method="POST" action="{{ route('profile.update') }}" class="space-y-6">
        @csrf
        @method('PATCH')
        
        {{-- ═══════════════════════════════════════════════ --}}
        {{-- SECTION 1 : PROFIL PERSONNEL --}}
        {{-- ═══════════════════════════════════════════════ --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block font-label text-label text-on-surface-variant mb-1">
                    Nom complet <span class="text-red-500">*</span>
                </label>
                <input type="text" name="name" value="{{ old('name', Auth::user()->name) }}" required
                       class="w-full border border-outline-variant rounded-lg px-4 py-2 focus:ring-1 focus:ring-primary focus:border-primary outline-none">
                @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="block font-label text-label text-on-surface-variant mb-1">
                    Email <span class="text-red-500">*</span>
                </label>
                <input type="email" name="email" value="{{ old('email', Auth::user()->email) }}" required
                       class="w-full border border-outline-variant rounded-lg px-4 py-2 focus:ring-1 focus:ring-primary focus:border-primary outline-none">
                @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="block font-label text-label text-on-surface-variant mb-1">Téléphone</label>
                <input type="tel" name="phone" value="{{ old('phone', Auth::user()->phone) }}" 
                       class="w-full border border-outline-variant rounded-lg px-4 py-2">
            </div>
            <div>
                <label class="block font-label text-label text-on-surface-variant mb-1">Localisation</label>
                <input type="text" name="location" value="{{ old('location', Auth::user()->location) }}" 
                       class="w-full border border-outline-variant rounded-lg px-4 py-2">
            </div>
        </div>

        {{-- ═══════════════════════════════════════════════ --}}
        {{-- SECTION 2 : MON COMMERCE --}}
        {{-- ═══════════════════════════════════════════════ --}}
        <div id="business" class="mt-8 pt-8 border-t border-outline-variant">
            <div class="flex items-center gap-2 mb-2">
                <span class="material-symbols-outlined text-primary text-2xl">storefront</span>
                <h3 class="font-h2 text-h2 text-on-surface">Mon commerce</h3>
            </div>
            <p class="text-body-sm text-on-surface-variant mb-6">
                Ces informations seront utilisées automatiquement pour générer vos articles SEO.
            </p>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                {{-- Nom du commerce --}}
                <div>
                    <label class="block font-label text-label text-on-surface-variant mb-1">
                        Nom du commerce
                    </label>
                    <input type="text" 
                           name="business_name" 
                           value="{{ old('business_name', Auth::user()->business_name) }}"
                           class="w-full border border-outline-variant rounded-lg px-4 py-2"
                           placeholder="Ex: La Maison du Pain">
                </div>

                {{-- Catégorie --}}
                <div>
                    <label class="block font-label text-label text-on-surface-variant mb-1">
                        Catégorie
                    </label>
                    <select name="business_category" 
                            class="w-full border border-outline-variant rounded-lg px-4 py-2">
                        <option value="">Sélectionner...</option>
                        @foreach(['Tourisme', 'E-commerce', 'Gastronomie', 'Immobilier', 'Santé', 'Mode', 'Tech', 'Artisanat', 'Sport', 'Culture', 'Éducation', 'Automobile', 'Autre'] as $cat)
                            <option value="{{ $cat }}" {{ old('business_category', Auth::user()->business_category) === $cat ? 'selected' : '' }}>
                                {{ $cat }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            {{-- Type d'activité --}}
            <div class="mt-4">
                <label class="block font-label text-label text-on-surface-variant mb-2">
                    Type d'activité
                </label>
                <div class="grid grid-cols-2 gap-3">
                    <label class="cursor-pointer">
                        <input type="radio" name="business_mode" value="local" id="settingsModeLocal"
                               {{ old('business_mode', Auth::user()->business_mode ?? 'local') === 'local' ? 'checked' : '' }}
                               class="peer sr-only">
                        <div class="p-3 border-2 border-outline-variant rounded-lg text-center peer-checked:border-primary peer-checked:bg-primary/5">
                            <div class="text-2xl">🏪</div>
                            <div class="font-bold text-sm">Commerce local</div>
                        </div>
                    </label>
                    <label class="cursor-pointer">
                        <input type="radio" name="business_mode" value="online" id="settingsModeOnline"
                               {{ old('business_mode', Auth::user()->business_mode) === 'online' ? 'checked' : '' }}
                               class="peer sr-only">
                        <div class="p-3 border-2 border-outline-variant rounded-lg text-center peer-checked:border-primary peer-checked:bg-primary/5">
                            <div class="text-2xl">🌐</div>
                            <div class="font-bold text-sm">Entreprise en ligne</div>
                        </div>
                    </label>
                </div>
            </div>

            {{-- ═══ Champs LOCAL UNIQUEMENT (masqués en mode online) ═══ --}}
            <div id="settingsLocalFields" class="mt-4 space-y-4">
                {{-- Adresse --}}
                <div>
                    <label class="block font-label text-label text-on-surface-variant mb-1">Adresse</label>
                    <input type="text" 
                           name="business_address" 
                           id="settingsBusinessAddress"
                           value="{{ old('business_address', Auth::user()->business_address) }}"
                           class="w-full border border-outline-variant rounded-lg px-4 py-2"
                           placeholder="Ex: 123 Avenue Mohammed VI">
                </div>

                {{-- Ville + Quartier --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block font-label text-label text-on-surface-variant mb-1">Ville</label>
                        <input type="text" 
                               name="business_city" 
                               id="settingsBusinessCity"
                               value="{{ old('business_city', Auth::user()->business_city) }}"
                               class="w-full border border-outline-variant rounded-lg px-4 py-2"
                               placeholder="Marrakech">
                    </div>
                    <div>
                        <label class="block font-label text-label text-on-surface-variant mb-1">Quartier</label>
                        <input type="text" 
                               name="business_district" 
                               value="{{ old('business_district', Auth::user()->business_district) }}"
                               class="w-full border border-outline-variant rounded-lg px-4 py-2"
                               placeholder="Guéliz">
                    </div>
                </div>
            </div>

            {{-- Pays (toujours affiché) --}}
            <div class="mt-4">
                <label class="block font-label text-label text-on-surface-variant mb-1">Pays</label>
                <select name="business_country" 
                        class="w-full border border-outline-variant rounded-lg px-4 py-2">
                    @foreach(['Maroc', 'France', 'Belgique', 'Suisse', 'Canada', 'Sénégal', 'Côte d\'Ivoire', 'Espagne', 'Italie', 'Allemagne'] as $pays)
                        <option value="{{ $pays }}" {{ old('business_country', Auth::user()->business_country ?? 'Maroc') === $pays ? 'selected' : '' }}>
                            {{ $pays }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Site web --}}
            <div class="mt-4">
                <label class="block font-label text-label text-on-surface-variant mb-1">
                    Site web <span id="settingsWebsiteRequired" class="text-red-500 hidden">*</span>
                </label>
                <input type="url" 
                       name="business_website" 
                       id="settingsBusinessWebsite"
                       value="{{ old('business_website', Auth::user()->business_website) }}"
                       class="w-full border border-outline-variant rounded-lg px-4 py-2"
                       placeholder="https://monsite.com">
            </div>
        </div>
        
        {{-- Bouton Enregistrer --}}
        <div class="flex justify-end pt-4 border-t border-outline-variant">
            <button type="submit" 
                    class="bg-primary text-on-primary px-6 py-2 rounded-lg font-label hover:opacity-90 transition">
                Enregistrer
            </button>
        </div>
    </form>
</div>

@push('scripts')
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
@endpush