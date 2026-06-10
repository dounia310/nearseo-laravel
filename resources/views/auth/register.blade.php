<!DOCTYPE html>
<html class="light" lang="fr">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Inscription | NEARSEO</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&amp;display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
    
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    "colors": {
                        "on-secondary-fixed": "#03210c",
                        "on-secondary": "#ffffff",
                        "on-background": "#091d2e",
                        "surface-container-lowest": "#ffffff",
                        "tertiary-container": "#b06000",
                        "on-tertiary-fixed": "#2e1500",
                        "inverse-primary": "#ffb599",
                        "on-tertiary-fixed-variant": "#6d3900",
                        "on-tertiary": "#ffffff",
                        "error-container": "#ffdad6",
                        "surface-container": "#e3efff",
                        "surface-container-high": "#d9eaff",
                        "secondary-fixed": "#c9ecc9",
                        "primary-fixed-dim": "#ffb599",
                        "inverse-surface": "#203243",
                        "error": "#ba1a1a",
                        "primary": "#8c4a2f",
                        "on-surface-variant": "#53433d",
                        "on-error-container": "#93000a",
                        "surface-container-highest": "#d1e4fb",
                        "surface-dim": "#c9dcf3",
                        "tertiary": "#8c4b00",
                        "background": "#f7f9ff",
                        "surface-variant": "#d1e4fb",
                        "on-tertiary-container": "#fffbff",
                        "secondary-container": "#c9ecc9",
                        "on-primary-container": "#fffbff",
                        "on-secondary-fixed-variant": "#304d34",
                        "inverse-on-surface": "#e8f2ff",
                        "on-error": "#ffffff",
                        "surface-container-low": "#edf4ff",
                        "surface": "#f7f9ff",
                        "primary-container": "#a96245",
                        "tertiary-fixed": "#ffdcc2",
                        "surface-bright": "#f7f9ff",
                        "primary-fixed": "#ffdbce",
                        "on-primary": "#ffffff",
                        "surface-tint": "#8e4c31",
                        "on-primary-fixed-variant": "#71361c",
                        "on-secondary-container": "#4d6c50",
                        "tertiary-fixed-dim": "#ffb77c",
                        "on-primary-fixed": "#370e00",
                        "outline": "#86736c",
                        "secondary": "#47664b",
                        "secondary-fixed-dim": "#adcfae",
                        "outline-variant": "#d9c2ba",
                        "on-surface": "#091d2e"
                    },
                    "borderRadius": {
                        "DEFAULT": "0.125rem",
                        "lg": "0.25rem",
                        "xl": "0.5rem",
                        "full": "0.75rem"
                    },
                    "spacing": {
                        "gutter": "16px",
                        "card-padding": "24px",
                        "container-max-width": "1280px",
                        "stack-gap-md": "16px",
                        "stack-gap-sm": "8px",
                        "section-margin": "32px"
                    },
                    "fontFamily": {
                        "h3": ["Inter"],
                        "label": ["Inter"],
                        "body": ["Inter"],
                        "h2": ["Inter"],
                        "h1-mobile": ["Inter"],
                        "h1": ["Inter"],
                        "body-sm": ["Inter"]
                    },
                    "fontSize": {
                        "h3": ["18px", {"lineHeight": "1.4", "fontWeight": "600"}],
                        "label": ["12px", {"lineHeight": "1", "letterSpacing": "0.05em", "fontWeight": "600"}],
                        "body": ["16px", {"lineHeight": "1.6", "fontWeight": "400"}],
                        "h2": ["24px", {"lineHeight": "1.3", "fontWeight": "600"}],
                        "h1-mobile": ["28px", {"lineHeight": "1.2", "fontWeight": "700"}],
                        "h1": ["32px", {"lineHeight": "1.2", "letterSpacing": "-0.02em", "fontWeight": "700"}],
                        "body-sm": ["14px", {"lineHeight": "1.5", "fontWeight": "400"}]
                    }
                }
            }
        }
    </script>
    
    <style>
        body {
            background-color: #F8F9FA;
            font-family: 'Inter', sans-serif;
        }
        .tonal-layer {
            background: linear-gradient(135deg, #f7f9ff 0%, #e3efff 100%);
        }
        .soft-shadow {
            box-shadow: 0px 4px 12px rgba(0,0,0,0.05);
        }
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
            vertical-align: middle;
        }
        .ai-accent {
            border-left: 3px solid #adcfae;
            background-color: #f0f4f0;
        }
    </style>
</head>

<body class="min-h-screen flex items-center justify-center p-gutter tonal-layer text-on-surface">

<!-- Auth Card Container -->
<main class="w-full max-w-[480px] bg-white border border-outline-variant rounded-xl soft-shadow overflow-hidden">
    <!-- Header / Brand Section -->
    <div class="px-card-padding pt-10 pb-6 flex flex-col items-center text-center">
        <img alt="NEARSEO Logo" class="h-10 mb-8 object-contain" src="https://lh3.googleusercontent.com/aida/AP1WRLu_EKuaJe9oBaxM7rn6hG6D3S59a96XdvCbHlyIXUW_7P7D3XsoueFyViWT7WQ8k-42FwZ7rl77B1MIpzF2L8F79WsyPIzd9jtxzPgLibhQcM4NluzE7xXHapKSn1mZJfPkYwVKsWaIgVKI9qxh5jZD3ESTe_Hv6HVW3vuFEJrQMvbBBASWHA71QkQTXXVJ1-0oKXstfwix0kjHym4790nXfqkl_BiN6D1xJWb2dHCqQGvAwzp24KBe71qj"/>
        <h1 class="font-h1 text-h1 text-on-background mb-stack-gap-sm">Créez votre compte</h1>
        <p class="font-body text-body text-on-surface-variant max-w-[320px]">
            Boostez votre visibilité locale avec l'IA.
        </p>
    </div>
    
    <!-- Form Section -->
    <div class="px-card-padding pb-10 space-y-stack-gap-md">
        @if($errors->any())
        <div class="mb-4 p-3 bg-error-container text-on-error-container rounded-lg text-sm">
            @foreach($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
        @endif
        
        <form action="{{ route('register') }}" class="space-y-4" method="POST">
            @csrf
            
            <!-- Full Name -->
            <div class="space-y-2">
                <label class="font-label text-label text-on-surface-variant" for="name">NOM COMPLET</label>
                <div class="relative">
                    <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-on-surface-variant text-[20px]">person</span>
                    <input class="w-full pl-10 pr-4 py-3 bg-white border border-outline-variant rounded-lg focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all font-body text-body @error('name') border-error @enderror" id="name" name="name" placeholder="Jean Dupont" type="text" value="{{ old('name') }}"/>
                </div>
                @error('name')
                <p class="text-error text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <!-- Email -->
            <div class="space-y-2">
                <label class="font-label text-label text-on-surface-variant" for="email">EMAIL PROFESSIONNEL</label>
                <div class="relative">
                    <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-on-surface-variant text-[20px]">mail</span>
                    <input class="w-full pl-10 pr-4 py-3 bg-white border border-outline-variant rounded-lg focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all font-body text-body @error('email') border-error @enderror" id="email" name="email" placeholder="jean@entreprise.fr" type="email" value="{{ old('email') }}"/>
                </div>
                @error('email')
                <p class="text-error text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <!-- Password -->
            <div class="space-y-2">
                <label class="font-label text-label text-on-surface-variant" for="password">MOT DE PASSE</label>
                <div class="relative">
                    <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-on-surface-variant text-[20px]">lock</span>
                    <input class="w-full pl-10 pr-12 py-3 bg-white border border-outline-variant rounded-lg focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all font-body text-body @error('password') border-error @enderror" id="password" name="password" placeholder="••••••••" type="password"/>
                    <button type="button" onclick="togglePassword()" class="absolute right-3 top-1/2 -translate-y-1/2 text-on-surface-variant hover:text-primary transition-colors">
                        <span class="material-symbols-outlined text-[20px]">visibility</span>
                    </button>
                </div>
                @error('password')
                <p class="text-error text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <!-- Password Confirmation -->
            <div class="space-y-2">
                <label class="font-label text-label text-on-surface-variant" for="password_confirmation">CONFIRMER LE MOT DE PASSE</label>
                <div class="relative">
                    <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-on-surface-variant text-[20px]">lock</span>
                    <input class="w-full pl-10 pr-4 py-3 bg-white border border-outline-variant rounded-lg focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all font-body text-body" id="password_confirmation" name="password_confirmation" placeholder="••••••••" type="password"/>
                </div>
            </div>
            
            <!-- Consent -->
            <div class="flex items-start gap-3 pt-2">
                <div class="flex items-center h-5">
                    <input class="h-4 w-4 rounded border-outline-variant text-primary focus:ring-primary transition-colors cursor-pointer" id="terms" name="terms" required type="checkbox"/>
                </div>
                <label class="font-body-sm text-body-sm text-on-surface-variant leading-tight cursor-pointer" for="terms">
                    J'accepte les <a class="text-primary hover:underline font-semibold" href="#">Conditions d'Utilisation</a> et la <a class="text-primary hover:underline font-semibold" href="#">Politique de Confidentialité</a>.
                </label>
            </div>
            
            <!-- Primary Action -->
            <button class="w-full mt-4 bg-primary text-on-primary py-4 rounded-lg font-h3 text-h3 hover:opacity-90 active:scale-[0.98] transition-all soft-shadow" type="submit">
                Créer mon compte
            </button>
        </form>
        
        <!-- Divider -->
        <div class="relative flex items-center py-2">
            <div class="flex-grow border-t border-outline-variant"></div>
            <span class="flex-shrink mx-4 font-label text-label text-on-surface-variant bg-white px-2">OU</span>
            <div class="flex-grow border-t border-outline-variant"></div>
        </div>
        
        <!-- Social Provider -->
        <button class="w-full flex items-center justify-center gap-3 py-3 border border-outline-variant rounded-lg font-body text-body text-on-background hover:bg-surface transition-colors active:scale-[0.98]">
            <svg height="20" viewBox="0 0 24 24" width="20" xmlns="http://www.w3.org/2000/svg">
                <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"></path>
                <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"></path>
                <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l3.66-2.84z" fill="#FBBC05"></path>
                <path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 12-4.53z" fill="#EA4335"></path>
            </svg>
            Continuer avec Google
        </button>
        
        <!-- Footer / Switch to Login -->
        <div class="text-center pt-4">
            <p class="font-body-sm text-body-sm text-on-surface-variant">
                Déjà un compte ? 
                <a href="{{ route('login') }}" class="text-primary font-bold hover:underline ml-1">Se connecter</a>
            </p>
        </div>
    </div>
</main>

<script>
    // Password visibility toggle
    function togglePassword() {
        const passwordInput = document.getElementById('password');
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);
    }
    
    // Input focus effects
    document.querySelectorAll('input').forEach(input => {
        input.addEventListener('focus', () => {
            const label = input.closest('.space-y-2')?.querySelector('label');
            if (label) {
                label.classList.add('text-primary');
            }
        });
        input.addEventListener('blur', () => {
            const label = input.closest('.space-y-2')?.querySelector('label');
            if (label) {
                label.classList.remove('text-primary');
            }
        });
    });
    
    // Form submission animation
    const registerBtn = document.querySelector('button[type="submit"]');
    if (registerBtn) {
        registerBtn.addEventListener('click', (e) => {
            const termsCheckbox = document.getElementById('terms');
            if (!termsCheckbox.checked) {
                e.preventDefault();
                alert('Veuillez accepter les conditions d\'utilisation');
                return;
            }
            registerBtn.innerHTML = '<span class="material-symbols-outlined animate-spin">progress_activity</span>';
            // Le formulaire sera soumis normalement
        });
    }
</script>

</body>
</html>