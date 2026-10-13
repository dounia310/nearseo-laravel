@extends('layouts.app')

@section('title', 'Mon commerce')
@section('header-title', 'Bienvenue sur NEARSEO')

@section('content')
<div class="max-w-2xl mx-auto">
    {{-- Stepper --}}
    <div class="flex items-center justify-center gap-4 mb-8">
        <div class="flex items-center gap-2">
            <span class="w-8 h-8 rounded-full bg-gray-300 text-white flex items-center justify-center font-bold">1</span>
            <span class="text-sm text-gray-500">Compte</span>
        </div>
        <div class="w-12 h-0.5 bg-primary"></div>
        <div class="flex items-center gap-2">
            <span class="w-8 h-8 rounded-full bg-primary text-white flex items-center justify-center font-bold">2</span>
            <span class="text-sm font-bold text-primary">Mon commerce</span>
        </div>
        <div class="w-12 h-0.5 bg-gray-300"></div>
        <div class="flex items-center gap-2">
            <span class="w-8 h-8 rounded-full bg-gray-300 text-white flex items-center justify-center font-bold">3</span>
            <span class="text-sm text-gray-500">Préférences</span>
        </div>
    </div>

    <div class="bg-white rounded-xl border shadow-sm p-8">
        <h1 class="text-2xl font-bold mb-2">Parlez-nous de votre commerce</h1>
        <p class="text-gray-500 mb-6">Ces informations ne seront plus jamais redemandées.</p>

        @if(session('info'))
            <div class="mb-4 p-3 bg-blue-50 text-blue-700 rounded-lg text-sm">
                {{ session('info') }}
            </div>
        @endif

        <form method="POST" action="{{ route('onboarding.business.save') }}" class="space-y-5">
            @csrf

            {{-- 1. Nom du commerce --}}
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-1">
                    Nom du commerce <span class="text-red-500">*</span>
                </label>
                <input type="text" name="business_name" 
                       value="{{ old('business_name', auth()->user()->business_name) }}"
                       class="w-full border rounded-lg px-4 py-3 focus:ring-1 focus:ring-primary focus:border-primary"
                       placeholder="Ex: La Maison du Pain" required>
                @error('business_name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            {{-- 2. Catégorie --}}
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-1">
                    Catégorie <span class="text-red-500">*</span>
                </label>
                <select name="business_category" class="w-full border rounded-lg px-4 py-3" required>
                    <option value="">Sélectionner...</option>
                    @foreach(['Tourisme', 'E-commerce', 'Gastronomie', 'Immobilier', 'Santé', 'Mode', 'Tech', 'Artisanat', 'Sport', 'Culture', 'Éducation', 'Automobile', 'Autre'] as $cat)
                        <option value="{{ $cat }}" {{ old('business_category', auth()->user()->business_category) === $cat ? 'selected' : '' }}>
                            {{ $cat }}
                        </option>
                    @endforeach
                </select>
                @error('business_category') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            {{-- 3. ⭐ TYPE D'ACTIVITÉ (déplacé ici) --}}
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-1">
                    Type d'activité <span class="text-red-500">*</span>
                </label>
                <div class="grid grid-cols-2 gap-3">
                    <label class="cursor-pointer">
                        <input type="radio" name="business_mode" value="local" id="modeLocal"
                               {{ old('business_mode', auth()->user()->business_mode ?? 'local') === 'local' ? 'checked' : '' }}
                               class="peer sr-only">
                        <div class="p-4 border-2 rounded-lg text-center peer-checked:border-primary peer-checked:bg-primary/5">
                            <div class="text-2xl mb-1">🏪</div>
                            <div class="font-bold text-sm">Commerce local</div>
                            <div class="text-xs text-gray-500">Boutique physique</div>
                        </div>
                    </label>
                    <label class="cursor-pointer">
                        <input type="radio" name="business_mode" value="online" id="modeOnline"
                               {{ old('business_mode', auth()->user()->business_mode) === 'online' ? 'checked' : '' }}
                               class="peer sr-only">
                        <div class="p-4 border-2 rounded-lg text-center peer-checked:border-primary peer-checked:bg-primary/5">
                            <div class="text-2xl mb-1">🌐</div>
                            <div class="font-bold text-sm">Entreprise en ligne</div>
                            <div class="text-xs text-gray-500">Site web uniquement</div>
                        </div>
                    </label>
                </div>
            </div>

            {{-- 4. ⭐ CHAMPS LOCAL UNIQUEMENT (masqués en mode online) --}}
            <div id="localFields" class="space-y-5">
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-1">
                        Adresse <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="business_address" id="businessAddress"
                           value="{{ old('business_address', auth()->user()->business_address) }}"
                           class="w-full border rounded-lg px-4 py-3"
                           placeholder="Ex: 123 Avenue Mohammed VI">
                    @error('business_address') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1">
                            Ville <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="business_city" id="businessCity"
                               value="{{ old('business_city', auth()->user()->business_city) }}"
                               class="w-full border rounded-lg px-4 py-3"
                               placeholder="Marrakech">
                        @error('business_city') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1">Quartier</label>
                        <input type="text" name="business_district" 
                               value="{{ old('business_district', auth()->user()->business_district) }}"
                               class="w-full border rounded-lg px-4 py-3"
                               placeholder="Guéliz">
                    </div>
                </div>
            </div>

            {{-- 5. Pays (toujours affiché) --}}
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-1">
                    Pays <span class="text-red-500">*</span>
                </label>
                <select name="business_country" class="w-full border rounded-lg px-4 py-3" required>
                    @foreach(['Maroc', 'France', 'Belgique', 'Suisse', 'Canada', 'Sénégal', 'Côte d\'Ivoire', 'Espagne', 'Italie', 'Allemagne'] as $pays)
                        <option value="{{ $pays }}" {{ old('business_country', auth()->user()->business_country ?? 'Maroc') === $pays ? 'selected' : '' }}>
                            {{ $pays }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- 6. Site web (optionnel en local, obligatoire en online) --}}
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-1">
                    Site web <span id="websiteRequired" class="text-red-500 hidden">*</span>
                    <span id="websiteOptional" class="text-gray-400 text-xs">(optionnel)</span>
                </label>
                <input type="url" name="business_website" id="businessWebsite"
                       value="{{ old('business_website', auth()->user()->business_website) }}"
                       class="w-full border rounded-lg px-4 py-3"
                       placeholder="https://monsite.com">
                @error('business_website') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            {{-- Boutons --}}
            <div class="flex justify-end gap-3 pt-4 border-t">
                <a href="{{ route('dashboard') }}" class="px-6 py-2 border rounded-lg hover:bg-gray-50">
                    Plus tard
                </a>
                <button type="submit" class="px-8 py-2 bg-primary text-white rounded-lg hover:opacity-90 font-bold">
                    Continuer →
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const modeLocal = document.getElementById('modeLocal');
    const modeOnline = document.getElementById('modeOnline');
    const localFields = document.getElementById('localFields');
    const websiteRequired = document.getElementById('websiteRequired');
    const websiteOptional = document.getElementById('websiteOptional');
    const businessWebsite = document.getElementById('businessWebsite');
    const businessAddress = document.getElementById('businessAddress');
    const businessCity = document.getElementById('businessCity');

    function toggleFields() {
        if (modeOnline && modeOnline.checked) {
            // ═══ MODE ONLINE ═══
            localFields.style.display = 'none';
            if (businessAddress) businessAddress.removeAttribute('required');
            if (businessCity) businessCity.removeAttribute('required');

            if (websiteRequired) websiteRequired.classList.remove('hidden');
            if (websiteOptional) websiteOptional.classList.add('hidden');
            if (businessWebsite) businessWebsite.setAttribute('required', 'required');
        } else {
            // ═══ MODE LOCAL ═══
            localFields.style.display = 'block';
            if (businessAddress) businessAddress.setAttribute('required', 'required');
            if (businessCity) businessCity.setAttribute('required', 'required');

            if (websiteRequired) websiteRequired.classList.add('hidden');
            if (websiteOptional) websiteOptional.classList.remove('hidden');
            if (businessWebsite) businessWebsite.removeAttribute('required');
        }
    }

    if (modeLocal) modeLocal.addEventListener('change', toggleFields);
    if (modeOnline) modeOnline.addEventListener('change', toggleFields);
    toggleFields();
});
</script>
@endpush