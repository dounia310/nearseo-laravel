{{-- resources/views/profile/partials/update-profile-information-form.blade.php --}}
<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Informations du profil') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Modifiez vos informations personnelles et de commerce.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        {{-- ═══════════════════════════════════════════════ --}}
        {{-- SECTION 1 : PROFIL PERSONNEL --}}
        {{-- ═══════════════════════════════════════════════ --}}
        <div>
            <x-input-label for="name" :value="__('Nom complet')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800">
                        {{ __('Votre adresse email n\'est pas vérifiée.') }}

                        <button form="send-verification" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            {{ __('Cliquez ici pour renvoyer l\'email de vérification.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600">
                            {{ __('Un nouveau lien de vérification a été envoyé à votre adresse email.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div>
            <x-input-label for="phone" :value="__('Téléphone')" />
            <x-text-input id="phone" name="phone" type="tel" class="mt-1 block w-full" :value="old('phone', $user->phone)" autocomplete="tel" />
            <x-input-error class="mt-2" :messages="$errors->get('phone')" />
        </div>

        <div>
            <x-input-label for="location" :value="__('Localisation')" />
            <x-text-input id="location" name="location" type="text" class="mt-1 block w-full" :value="old('location', $user->location)" />
            <x-input-error class="mt-2" :messages="$errors->get('location')" />
        </div>

        {{-- ═══════════════════════════════════════════════ --}}
        {{-- SECTION 2 : MON COMMERCE --}}
        {{-- ═══════════════════════════════════════════════ --}}
        <div id="business" class="mt-8 pt-8 border-t border-gray-200">
            <div class="flex items-center gap-2 mb-2">
                <span class="material-symbols-outlined text-primary text-2xl">storefront</span>
                <h3 class="text-lg font-semibold text-gray-900">Mon commerce</h3>
            </div>
            <p class="text-sm text-gray-500 mb-6">
                Ces informations seront utilisées automatiquement pour générer vos articles SEO.
            </p>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                {{-- Nom du commerce --}}
                <div>
                    <x-input-label for="business_name" :value="__('Nom du commerce')" />
                    <x-text-input id="business_name" name="business_name" type="text" class="mt-1 block w-full" 
                                  :value="old('business_name', $user->business_name)" 
                                  placeholder="Ex: La Maison du Pain" />
                    <x-input-error class="mt-2" :messages="$errors->get('business_name')" />
                </div>

                {{-- Catégorie --}}
                <div>
                    <x-input-label for="business_category" :value="__('Catégorie')" />
                    <select id="business_category" name="business_category" 
                            class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                        <option value="">Sélectionner...</option>
                        @foreach(['Tourisme', 'E-commerce', 'Gastronomie', 'Immobilier', 'Santé', 'Mode', 'Tech', 'Artisanat', 'Sport', 'Culture', 'Éducation', 'Automobile', 'Autre'] as $cat)
                            <option value="{{ $cat }}" {{ old('business_category', $user->business_category) === $cat ? 'selected' : '' }}>
                                {{ $cat }}
                            </option>
                        @endforeach
                    </select>
                    <x-input-error class="mt-2" :messages="$errors->get('business_category')" />
                </div>
            </div>

            {{-- Type d'activité --}}
            <div class="mt-4">
                <x-input-label :value="__('Type d\'activité')" />
                <div class="grid grid-cols-2 gap-3 mt-2">
                    <label class="cursor-pointer">
                        <input type="radio" name="business_mode" value="local" id="profileModeLocal"
                               {{ old('business_mode', $user->business_mode ?? 'local') === 'local' ? 'checked' : '' }}
                               class="peer sr-only">
                        <div class="p-3 border-2 border-gray-300 rounded-lg text-center peer-checked:border-primary peer-checked:bg-primary/5">
                            <div class="text-2xl">🏪</div>
                            <div class="font-bold text-sm">Commerce local</div>
                        </div>
                    </label>
                    <label class="cursor-pointer">
                        <input type="radio" name="business_mode" value="online" id="profileModeOnline"
                               {{ old('business_mode', $user->business_mode) === 'online' ? 'checked' : '' }}
                               class="peer sr-only">
                        <div class="p-3 border-2 border-gray-300 rounded-lg text-center peer-checked:border-primary peer-checked:bg-primary/5">
                            <div class="text-2xl">🌐</div>
                            <div class="font-bold text-sm">Entreprise en ligne</div>
                        </div>
                    </label>
                </div>
                <x-input-error class="mt-2" :messages="$errors->get('business_mode')" />
            </div>

            {{-- Champs LOCAL UNIQUEMENT --}}
            <div id="profileLocalFields" class="mt-4 space-y-4">
                <div>
                    <x-input-label for="business_address" :value="__('Adresse')" />
                    <x-text-input id="business_address" name="business_address" type="text" class="mt-1 block w-full" 
                                  :value="old('business_address', $user->business_address)"
                                  placeholder="Ex: 123 Avenue Mohammed VI" />
                    <x-input-error class="mt-2" :messages="$errors->get('business_address')" />
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <x-input-label for="business_city" :value="__('Ville')" />
                        <x-text-input id="business_city" name="business_city" type="text" class="mt-1 block w-full" 
                                      :value="old('business_city', $user->business_city)"
                                      placeholder="Marrakech" />
                        <x-input-error class="mt-2" :messages="$errors->get('business_city')" />
                    </div>
                    <div>
                        <x-input-label for="business_district" :value="__('Quartier')" />
                        <x-text-input id="business_district" name="business_district" type="text" class="mt-1 block w-full" 
                                      :value="old('business_district', $user->business_district)"
                                      placeholder="Guéliz" />
                        <x-input-error class="mt-2" :messages="$errors->get('business_district')" />
                    </div>
                </div>
            </div>

            {{-- Pays (toujours affiché) --}}
            <div class="mt-4">
                <x-input-label for="business_country" :value="__('Pays')" />
                <select id="business_country" name="business_country" 
                        class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                    @foreach(['Maroc', 'France', 'Belgique', 'Suisse', 'Canada', 'Sénégal', 'Côte d\'Ivoire', 'Espagne', 'Italie', 'Allemagne'] as $pays)
                        <option value="{{ $pays }}" {{ old('business_country', $user->business_country ?? 'Maroc') === $pays ? 'selected' : '' }}>
                            {{ $pays }}
                        </option>
                    @endforeach
                </select>
                <x-input-error class="mt-2" :messages="$errors->get('business_country')" />
            </div>

            {{-- Site web --}}
            <div class="mt-4">
                <x-input-label for="business_website">
                    {{ __('Site web') }} 
                    <span id="profileWebsiteRequired" class="text-red-500 hidden">*</span>
                </x-input-label>
                <x-text-input id="business_website" name="business_website" type="url" class="mt-1 block w-full" 
                              :value="old('business_website', $user->business_website)"
                              placeholder="https://monsite.com" />
                <x-input-error class="mt-2" :messages="$errors->get('business_website')" />
            </div>
        </div>

        {{-- ═══════════════════════════════════════════════ --}}
        {{-- BOUTON --}}
        {{-- ═══════════════════════════════════════════════ --}}
        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Enregistrer') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('Enregistré.') }}</p>
            @endif

            @if (session('success'))
                <p class="text-sm text-green-600">{{ session('success') }}</p>
            @endif
        </div>
    </form>
</section>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const modeLocal = document.getElementById('profileModeLocal');
    const modeOnline = document.getElementById('profileModeOnline');
    const localFields = document.getElementById('profileLocalFields');
    const websiteRequired = document.getElementById('profileWebsiteRequired');
    const businessWebsite = document.getElementById('business_website');
    const businessAddress = document.getElementById('business_address');
    const businessCity = document.getElementById('business_city');

    function toggleFields() {
        if (modeOnline && modeOnline.checked) {
            // MODE ONLINE
            if (localFields) localFields.style.display = 'none';
            if (websiteRequired) websiteRequired.classList.remove('hidden');
            if (businessWebsite) businessWebsite.setAttribute('required', 'required');
        } else {
            // MODE LOCAL
            if (localFields) localFields.style.display = 'block';
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