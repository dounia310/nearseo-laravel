{{-- resources/views/auth/forgot-password.blade.php --}}
@extends('layouts.guest')

@section('title', 'Mot de passe oublié')

@section('content')
<div class="flex items-center justify-center min-h-screen p-gutter">
    <!-- Main Container (Mobile focused 375px) -->
    <main class="w-full max-w-[375px] mx-auto space-y-section-margin">
        <!-- Logo/Header branding -->
        <div class="flex flex-col items-center justify-center text-center space-y-stack-gap-md">
            <!-- Icon Wrapper: Soft primary-colored circle -->
            <div class="w-16 h-16 rounded-full bg-primary-fixed flex items-center justify-center text-primary shadow-sm">
                <span class="material-symbols-outlined text-[32px]">lock_reset</span>
            </div>
            <div class="space-y-stack-gap-sm">
                <h1 class="font-h1-mobile text-h1-mobile text-on-surface">Mot de passe oublié</h1>
                <p class="font-body-sm text-body-sm text-on-surface-variant max-w-[280px] mx-auto">
                    Entrez votre adresse email et nous vous enverrons un lien de réinitialisation.
                </p>
            </div>
        </div>

        <!-- Session Status (Success Alert) -->
        @if (session('status'))
        <div id="success-alert">
            <div class="bg-secondary-fixed text-on-secondary-fixed-variant p-4 rounded-xl flex items-start gap-3 border border-secondary-fixed-dim animate-in fade-in slide-in-from-top-4 duration-500">
                <span class="material-symbols-outlined text-[20px] mt-0.5" style="font-variation-settings: 'FILL' 1;">check_circle</span>
                <p class="font-body-sm text-body-sm">
                    {{ session('status') }}
                </p>
            </div>
        </div>
        @endif

        <!-- Reset Password Form -->
        <form class="space-y-stack-gap-md" id="reset-form" method="POST" action="{{ route('password.email') }}">
            @csrf

            <!-- Input Group -->
            <div class="space-y-stack-gap-sm">
                <label class="font-label text-label text-on-surface-variant ml-1" for="email">Adresse Email</label>
                <div class="relative group">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-outline group-focus-within:text-primary transition-colors">
                        <span class="material-symbols-outlined text-[20px]">email</span>
                    </div>
                    <input 
                        class="block w-full pl-10 pr-4 py-3 bg-white border border-outline-variant rounded-xl font-body text-body text-on-surface placeholder:text-outline focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition-all duration-200 @error('email') border-red-500 @enderror" 
                        id="email" 
                        name="email" 
                        type="email" 
                        required 
                        value="{{ old('email') }}"
                        placeholder="exemple@nearseo.com"
                        autofocus
                    />
                </div>
                @error('email')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- CTA Button -->
            <button 
                class="w-full flex items-center justify-center gap-2 bg-[#c97c5d] hover:bg-primary text-white font-h3 text-h3 py-4 rounded-xl shadow-md active:scale-[0.98] transition-all duration-200" 
                type="submit"
            >
                <span class="material-symbols-outlined text-[20px]">send</span>
                <span>Envoyer le lien</span>
            </button>
        </form>

        <!-- Footer Link -->
        <div class="pt-stack-gap-md text-center">
            <a href="{{ route('login') }}" class="inline-flex items-center gap-1 font-body-sm text-body-sm text-primary font-bold hover:underline transition-all">
                <span class="material-symbols-outlined text-[18px]">arrow_back</span>
                Retour à la connexion
            </a>
        </div>
    </main>

    <!-- Background Decorative Elements -->
    <div class="fixed inset-0 -z-10 pointer-events-none overflow-hidden">
        <div class="absolute -top-24 -right-24 w-64 h-64 bg-secondary-fixed opacity-20 blur-3xl rounded-full"></div>
        <div class="absolute -bottom-32 -left-32 w-96 h-96 bg-primary-fixed opacity-20 blur-3xl rounded-full"></div>
    </div>
</div>

@push('styles')
<style>
    body {
        background-color: #F8F9FA;
        font-family: 'Inter', sans-serif;
    }
    
    .material-symbols-outlined {
        font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        display: inline-block;
        line-height: 1;
    }
    
    .glass-card {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        border: 1px solid #E5E7EB;
    }

    /* Spacing utilities from design */
    .space-y-stack-gap-md > :not([hidden]) ~ :not([hidden]) {
        margin-top: 16px;
    }
    .space-y-stack-gap-sm > :not([hidden]) ~ :not([hidden]) {
        margin-top: 8px;
    }
    .space-y-section-margin > :not([hidden]) ~ :not([hidden]) {
        margin-top: 32px;
    }
    .pt-stack-gap-md {
        padding-top: 16px;
    }
    .p-gutter {
        padding: 16px;
    }

    /* Animations */
    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    .animate-in {
        animation: fadeIn 0.5s ease-out forwards;
    }
    .fade-in {
        opacity: 0;
        animation-fill-mode: forwards;
    }
    .slide-in-from-top-4 {
        transform: translateY(-10px);
    }

    /* Typography utilities from design */
    .font-h1-mobile {
        font-family: 'Inter', sans-serif;
    }
    .text-h1-mobile {
        font-size: 28px;
        line-height: 1.2;
        font-weight: 700;
    }
    .font-body-sm {
        font-family: 'Inter', sans-serif;
    }
    .text-body-sm {
        font-size: 14px;
        line-height: 1.5;
        font-weight: 400;
    }
    .font-label {
        font-family: 'Inter', sans-serif;
    }
    .text-label {
        font-size: 12px;
        line-height: 1;
        letter-spacing: 0.05em;
        font-weight: 600;
    }
    .font-body {
        font-family: 'Inter', sans-serif;
    }
    .text-body {
        font-size: 16px;
        line-height: 1.6;
        font-weight: 400;
    }
    .font-h3 {
        font-family: 'Inter', sans-serif;
    }
    .text-h3 {
        font-size: 18px;
        line-height: 1.4;
        font-weight: 600;
    }
</style>
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Micro-interaction for back button
        const backLink = document.querySelector('a[href="{{ route("login") }}"]');
        if (backLink) {
            backLink.addEventListener('mouseenter', function() {
                const icon = this.querySelector('.material-symbols-outlined');
                if (icon) {
                    icon.style.transform = 'translateX(-4px)';
                    icon.style.transition = 'transform 0.2s ease';
                }
            });
            backLink.addEventListener('mouseleave', function() {
                const icon = this.querySelector('.material-symbols-outlined');
                if (icon) {
                    icon.style.transform = 'translateX(0)';
                }
            });
        }
    });
</script>
@endpush
@endsection