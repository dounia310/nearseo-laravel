<!DOCTYPE html>
<html class="light" lang="fr">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Réinitialisation | NEARSEO</title>
    <!-- Google Fonts: Inter -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&amp;display=swap" rel="stylesheet"/>
    <!-- Material Symbols -->
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
        .input-error {
            border-color: #ba1a1a;
        }
        .input-error:focus {
            border-color: #ba1a1a;
            box-shadow: inset 0 0 0 1px #ba1a1a;
        }
    </style>
</head>
<body class="flex flex-col min-h-screen text-on-surface">

<main class="flex-grow flex items-center justify-center px-gutter py-section-margin">
    <!-- Reset Password Container -->
    <div class="w-full max-w-[440px]">
        
        <!-- Reset Card -->
        <div class="login-card rounded-lg p-card-padding">
            <div class="text-center mb-section-margin">
                <div class="w-16 h-16 bg-primary/10 rounded-full flex items-center justify-center mx-auto mb-4">
                    <span class="material-symbols-outlined text-4xl text-primary">password</span>
                </div>
                <h1 class="font-h2 text-h2 text-on-surface mb-stack-gap-sm">Nouveau mot de passe</h1>
                <p class="font-body-sm text-body-sm text-on-surface-variant">Créez un nouveau mot de passe pour votre compte</p>
            </div>
            
            @if ($errors->any())
                <div class="mb-4 p-3 bg-error-container text-on-error-container rounded-lg text-sm">
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            @if (session('status'))
                <div class="mb-4 p-3 bg-green-50 text-green-700 rounded-lg text-sm border border-green-200">
                    <span class="material-symbols-outlined text-green-500 mr-1">check_circle</span>
                    {{ session('status') }}
                </div>
            @endif
            
            <form action="{{ route('password.store') }}" class="space-y-stack-gap-md" method="POST">
                @csrf
                
                <!-- Token caché -->
                <input type="hidden" name="token" value="{{ $token ?? '' }}">
                
                <!-- Email Field -->
                <div class="space-y-1">
                    <label class="font-label text-label text-on-surface-variant" for="email">EMAIL</label>
                    <input class="w-full px-4 py-3 border border-outline-variant rounded bg-white text-body input-focus transition-all @error('email') input-error @enderror" 
                           id="email" name="email" placeholder="nom@agence.com" required type="email" 
                           value="{{ $email ?? old('email') }}"/>
                    @error('email')
                    <p class="text-error text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Password Field -->
                <div class="space-y-1">
                    <label class="font-label text-label text-on-surface-variant" for="password">NOUVEAU MOT DE PASSE</label>
                    <div class="relative">
                        <input class="w-full px-4 py-3 border border-outline-variant rounded bg-white text-body input-focus transition-all @error('password') input-error @enderror" 
                               id="password" name="password" required type="password" placeholder="••••••••"/>
                    </div>
                    @error('password')
                    <p class="text-error text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Confirm Password Field -->
                <div class="space-y-1">
                    <label class="font-label text-label text-on-surface-variant" for="password_confirmation">CONFIRMER LE MOT DE PASSE</label>
                    <div class="relative">
                        <input class="w-full px-4 py-3 border border-outline-variant rounded bg-white text-body input-focus transition-all" 
                               id="password_confirmation" name="password_confirmation" required type="password" placeholder="••••••••"/>
                    </div>
                </div>
                
                <!-- Submit Button -->
                <button class="w-full btn-primary text-white font-h3 text-h3 py-3 rounded-lg shadow-sm transition-all transform active:scale-[0.98]" type="submit">
                    <span class="material-symbols-outlined text-lg mr-2">save</span>
                    Réinitialiser le mot de passe
                </button>
            </form>
            
            <!-- Signup Prompt -->
            <div class="mt-section-margin text-center">
                <p class="font-body-sm text-body-sm text-on-surface-variant">
                    <a href="{{ route('login') }}" class="text-primary font-bold hover:underline flex items-center justify-center gap-1">
                        <span class="material-symbols-outlined text-sm">arrow_back</span>
                        Retour à la connexion
                    </a>
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
    // Micro-interaction for the primary button
    const resetBtn = document.querySelector('button[type="submit"]');
    if (resetBtn) {
        resetBtn.addEventListener('click', (e) => {
            const form = document.querySelector('form');
            if (!form.checkValidity()) return;
            resetBtn.innerHTML = '<span class="material-symbols-outlined animate-spin mr-2">progress_activity</span> Réinitialisation...';
            resetBtn.classList.add('opacity-80');
        });
    }

    // Hover effects for the inputs
    const inputs = document.querySelectorAll('input');
    inputs.forEach(input => {
        input.addEventListener('focus', () => {
            const label = input.parentElement.parentElement.querySelector('label');
            if (label) {
                label.classList.replace('text-on-surface-variant', 'text-primary');
            }
        });
        input.addEventListener('blur', () => {
            const label = input.parentElement.parentElement.querySelector('label');
            if (label) {
                label.classList.replace('text-primary', 'text-on-surface-variant');
            }
        });
    });
</script>

</body>
</html>