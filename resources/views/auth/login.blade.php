<!DOCTYPE html>
<html class="light" lang="fr">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Connexion | NEARSEO</title>
    <!-- Google Fonts: Inter -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&amp;display=swap" rel="stylesheet"/>
    <!-- Material Symbols -->
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    
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
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
            display: inline-block;
            vertical-align: middle;
        }
        .login-card {
            background-color: #ffffff;
            border: 1px solid #E5E7EB;
            box-shadow: 0px 4px 12px rgba(0,0,0,0.05);
        }
        .btn-primary {
            background-color: #8c4a2f;
            transition: opacity 0.2s ease;
        }
        .btn-primary:hover {
            opacity: 0.9;
        }
        .ai-indicator-line {
            border-left: 3px solid #47664b;
        }
        .input-focus:focus {
            border-color: #8c4a2f;
            box-shadow: inset 0 0 0 1px #8c4a2f;
            outline: none;
        }
    </style>
</head>
<body class="flex flex-col min-h-screen text-on-surface">

<main class="flex-grow flex items-center justify-center px-gutter py-section-margin">
    <!-- Login Container -->
    <div class="w-full max-w-[440px]">
        
        <!-- Login Card -->
        <div class="login-card rounded-lg p-card-padding">
            <div class="text-center mb-section-margin">
                <h1 class="font-h2 text-h2 text-on-surface mb-stack-gap-sm">Bon retour !</h1>
                <p class="font-body-sm text-body-sm text-on-surface-variant">Connectez-vous à votre espace local SEO</p>
            </div>
            
            @if($errors->any())
            <div class="mb-4 p-3 bg-error-container text-on-error-container rounded-lg text-sm">
                {{ $errors->first() }}
            </div>
            @endif
            
            <form action="{{ route('login') }}" class="space-y-stack-gap-md" method="POST">
                @csrf
                
                        <!-- Champ : Email ou nom d'utilisateur -->
<div>
    <x-input-label for="login" :value="__('Email ou nom d\'utilisateur')" />

    <x-text-input
        id="login"
        type="text"
        name="login"
        :value="old('login')"
        required
        autofocus
        autocomplete="username"
        class="block mt-1 w-full"
    />

    <x-input-error :messages="$errors->get('login')" class="mt-2" />
</div>
                
                <!-- Password Field -->
                <div class="space-y-1">
                    <div class="flex justify-between items-center">
                        <label class="font-label text-label text-on-surface-variant" for="password">MOT DE PASSE</label>
                        <a href="{{ route('password.request') }}" class="font-label text-label text-primary hover:underline">Mot de passe oublié ?</a>
                    </div>
                    <div class="relative">
                        <input class="w-full px-4 py-3 border border-outline-variant rounded bg-white text-body input-focus transition-all @error('password') border-error @enderror" id="password" name="password" required type="password"/>
                    </div>
                    @error('password')
                    <p class="text-error text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Remember Me -->
                <div class="flex items-center gap-2">
                    <input type="checkbox" name="remember" id="remember" class="rounded border-outline-variant text-primary focus:ring-primary">
                    <label for="remember" class="font-body-sm text-body-sm text-on-surface-variant">Se souvenir de moi</label>
                </div>
                
                <!-- Submit Button -->
                <button class="w-full btn-primary text-white font-h3 text-h3 py-3 rounded-lg shadow-sm transition-all transform active:scale-[0.98]" type="submit">
                    Se connecter
                </button>
            </form>
            
            <!-- Divider -->
            <div class="relative my-section-margin">
                <div aria-hidden="true" class="absolute inset-0 flex items-center">
                    <div class="w-full border-t border-outline-variant"></div>
                </div>
                <div class="relative flex justify-center text-label">
                    <span class="bg-white px-4 text-on-surface-variant font-label">OU</span>
                </div>
            </div>
            
            <!-- Social Login -->
            <button class="w-full flex items-center justify-center gap-stack-gap-sm px-4 py-3 border border-outline-variant rounded-lg bg-white hover:bg-surface-container-low transition-colors duration-200" type="button">
                <svg class="w-5 h-5" viewBox="0 0 24 24">
                    <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"></path>
                    <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"></path>
                    <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l3.66-2.84z" fill="#FBBC05"></path>
                    <path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 12-4.53z" fill="#EA4335"></path>
                </svg>
                <span class="font-body text-body font-semibold text-on-surface">Continuer avec Google</span>
            </button>
            
            <!-- Signup Prompt -->
            <div class="mt-section-margin text-center">
                <p class="font-body-sm text-body-sm text-on-surface-variant">
                    Pas encore de compte ? 
                    <a href="{{ route('register') }}" class="text-primary font-bold hover:underline ml-1">S'inscrire</a>
                </p>
            </div>
        </div>
        
        <!-- Optional AI Context Hint -->
        <div class="mt-8 p-4 bg-[#F0F4F0] ai-indicator-line rounded-r-lg">
            <p class="font-body-sm text-body-sm text-secondary italic">
                "NEARSEO utilise l'intelligence artificielle pour automatiser votre référencement local en quelques clics."
            </p>
        </div>
    </div>
</main>

<!-- Footer -->
<footer class="w-full py-stack-gap-md px-gutter bg-surface-container-low border-t border-outline-variant">
    <div class="max-w-container-max-width mx-auto flex flex-col md:flex-row justify-between items-center gap-stack-gap-md">
        <div class="font-h3 text-h3 font-bold text-on-surface">NEARSEO</div>
        <div class="flex flex-wrap justify-center gap-stack-gap-md">
            <a class="font-body-sm text-body-sm text-on-surface-variant hover:underline decoration-primary transition-colors" href="#">Privacy Policy</a>
            <a class="font-body-sm text-body-sm text-on-surface-variant hover:underline decoration-primary transition-colors" href="#">Terms of Service</a>
            <a class="font-body-sm text-body-sm text-on-surface-variant hover:underline decoration-primary transition-colors" href="#">Contact Support</a>
        </div>
        <div class="font-body-sm text-body-sm text-on-surface-variant opacity-70">
            © 2024 NEARSEO. All rights reserved.
        </div>
    </div>
</footer>

<script>
    // Simple micro-interaction for the primary button
    const loginBtn = document.querySelector('button[type="submit"]');
    if (loginBtn) {
        loginBtn.addEventListener('click', (e) => {
            const form = document.querySelector('form');
            if (!form.checkValidity()) return;
            loginBtn.innerHTML = '<span class="material-symbols-outlined animate-spin mr-2">progress_activity</span> Connexion...';
            loginBtn.classList.add('opacity-80');
        });
    }

    // Hover effects for the inputs
    const inputs = document.querySelectorAll('input');
    inputs.forEach(input => {
        input.addEventListener('focus', () => {
            const label = input.parentElement.querySelector('label');
            if (label) {
                label.classList.replace('text-on-surface-variant', 'text-primary');
            }
        });
        input.addEventListener('blur', () => {
            const label = input.parentElement.querySelector('label');
            if (label) {
                label.classList.replace('text-primary', 'text-on-surface-variant');
            }
        });
    });
</script>

</body>
</html>