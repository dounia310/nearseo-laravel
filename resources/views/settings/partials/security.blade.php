<!-- Security Section -->
<div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl p-6">
    <div class="flex items-center gap-4 mb-6">
        <div class="w-16 h-16 rounded-full bg-primary/10 flex items-center justify-center">
            <span class="material-symbols-outlined text-3xl text-primary">lock</span>
        </div>
        <div>
            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">Sécurité du compte</h3>
            <p class="text-sm text-gray-500 dark:text-gray-400">Modifiez votre mot de passe</p>
        </div>
    </div>
    
    <form id="passwordForm" method="POST" action="{{ route('settings.password') }}" class="space-y-4">
        @csrf
        
        <!-- Messages d'erreur -->
        <div id="passwordErrors" class="hidden bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-lg p-3">
            <ul id="errorList" class="text-sm text-red-600 dark:text-red-400 space-y-1"></ul>
        </div>
        
        <!-- Message de succès -->
        <div id="passwordSuccess" class="hidden bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-lg p-3">
            <p class="text-sm text-green-600 dark:text-green-400 flex items-center gap-2">
                <span class="material-symbols-outlined text-sm">check_circle</span>
                Mot de passe modifié avec succès !
            </p>
        </div>
        
        <!-- Mot de passe actuel -->
        <div>
            <label for="current_password" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                Mot de passe actuel
            </label>
            <div class="relative">
                <input type="password" 
                       id="current_password" 
                       name="current_password" 
                       required
                       class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-4 py-2 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition">
                <button type="button" 
                        onclick="togglePassword('current_password')"
                        class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
                    <span class="material-symbols-outlined text-sm">visibility</span>
                </button>
            </div>
            <p id="current_password_error" class="text-sm text-red-600 dark:text-red-400 mt-1 hidden"></p>
        </div>
        
        <!-- Nouveau mot de passe -->
        <div>
            <label for="new_password" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                Nouveau mot de passe
            </label>
            <div class="relative">
                <input type="password" 
                       id="new_password" 
                       name="password" 
                       required
                       minlength="8"
                       class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-4 py-2 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition">
                <button type="button" 
                        onclick="togglePassword('new_password')"
                        class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
                    <span class="material-symbols-outlined text-sm">visibility</span>
                </button>
            </div>
            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Minimum 8 caractères</p>
            <p id="new_password_error" class="text-sm text-red-600 dark:text-red-400 mt-1 hidden"></p>
            
            <!-- Indicateur de force du mot de passe -->
            <div class="mt-2">
                <div class="flex gap-1 h-1">
                    <div id="strength-1" class="flex-1 bg-gray-200 dark:bg-gray-600 rounded-full transition-all"></div>
                    <div id="strength-2" class="flex-1 bg-gray-200 dark:bg-gray-600 rounded-full transition-all"></div>
                    <div id="strength-3" class="flex-1 bg-gray-200 dark:bg-gray-600 rounded-full transition-all"></div>
                    <div id="strength-4" class="flex-1 bg-gray-200 dark:bg-gray-600 rounded-full transition-all"></div>
                </div>
                <p id="strength-text" class="text-xs text-gray-500 dark:text-gray-400 mt-1">Faible</p>
            </div>
        </div>
        
        <!-- Confirmer le mot de passe -->
        <div>
            <label for="password_confirmation" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                Confirmer le mot de passe
            </label>
            <div class="relative">
                <input type="password" 
                       id="password_confirmation" 
                       name="password_confirmation" 
                       required
                       class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-4 py-2 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition">
                <button type="button" 
                        onclick="togglePassword('password_confirmation')"
                        class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
                    <span class="material-symbols-outlined text-sm">visibility</span>
                </button>
            </div>
            <p id="password_confirmation_error" class="text-sm text-red-600 dark:text-red-400 mt-1 hidden"></p>
        </div>
        
        <!-- Bouton de soumission -->
        <div class="flex justify-end pt-4 border-t border-gray-200 dark:border-gray-700">
            <button type="submit" 
                    id="submitPasswordBtn"
                    class="px-6 py-2 bg-primary text-white rounded-lg hover:bg-primary/90 transition flex items-center gap-2 disabled:opacity-50 disabled:cursor-not-allowed">
                <span class="material-symbols-outlined text-sm">lock_reset</span>
                Changer le mot de passe
            </button>
        </div>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // ============================================
    // AFFICHER/MASQUER LE MOT DE PASSE
    // ============================================
    window.togglePassword = function(inputId) {
        const input = document.getElementById(inputId);
        if (!input) return;
        const icon = input.parentElement.querySelector('.material-symbols-outlined');
        
        if (input.type === 'password') {
            input.type = 'text';
            icon.textContent = 'visibility_off';
        } else {
            input.type = 'password';
            icon.textContent = 'visibility';
        }
    };

    // ============================================
    // INDICATEUR DE FORCE DU MOT DE PASSE
    // ============================================
    const newPasswordInput = document.getElementById('new_password');
    if (newPasswordInput) {
        newPasswordInput.addEventListener('input', function() {
            const password = this.value;
            const strength = checkPasswordStrength(password);
            
            const bars = [
                document.getElementById('strength-1'),
                document.getElementById('strength-2'),
                document.getElementById('strength-3'),
                document.getElementById('strength-4')
            ];
            
            const strengthText = document.getElementById('strength-text');
            const colors = ['bg-red-500', 'bg-orange-500', 'bg-yellow-500', 'bg-green-500'];
            const labels = ['Très faible', 'Faible', 'Moyen', 'Fort', 'Très fort'];
            
            // Réinitialiser
            bars.forEach(bar => {
                if (bar) bar.className = 'flex-1 bg-gray-200 dark:bg-gray-600 rounded-full transition-all';
            });
            
            // Colorier les barres
            for (let i = 0; i < strength; i++) {
                if (bars[i]) bars[i].className = `flex-1 ${colors[Math.min(i, 3)]} rounded-full transition-all`;
            }
            
            // Texte
            if (password.length === 0) {
                if (strengthText) {
                    strengthText.textContent = 'Faible';
                    strengthText.className = 'text-xs text-gray-500 dark:text-gray-400 mt-1';
                }
            } else {
                if (strengthText) {
                    strengthText.textContent = labels[Math.min(strength, 4)];
                    const colorClasses = ['text-red-500', 'text-orange-500', 'text-yellow-600', 'text-green-500', 'text-green-600'];
                    strengthText.className = `text-xs font-medium ${colorClasses[Math.min(strength, 4)]} mt-1`;
                }
            }
        });
    }

    function checkPasswordStrength(password) {
        let strength = 0;
        
        if (password.length >= 8) strength++;
        if (password.length >= 12) strength++;
        if (/[a-z]/.test(password) && /[A-Z]/.test(password)) strength++;
        if (/\d/.test(password)) strength++;
        if (/[^a-zA-Z0-9]/.test(password)) strength++;
        
        return Math.min(strength, 4);
    }

    // ============================================
    // SOUMISSION DU FORMULAIRE
    // ============================================
    const passwordForm = document.getElementById('passwordForm');
    if (passwordForm) {
        passwordForm.addEventListener('submit', async function(e) {
            e.preventDefault();
            
            // Réinitialiser les messages
            hideAllErrors();
            document.getElementById('passwordSuccess').classList.add('hidden');
            
            const currentPassword = document.getElementById('current_password').value;
            const newPassword = document.getElementById('new_password').value;
            const confirmPassword = document.getElementById('password_confirmation').value;
            
            // Validation client
            if (newPassword.length < 8) {
                showError('new_password', 'Le mot de passe doit contenir au moins 8 caractères');
                return;
            }
            
            if (newPassword !== confirmPassword) {
                showError('password_confirmation', 'Les mots de passe ne correspondent pas');
                return;
            }
            
            const submitBtn = document.getElementById('submitPasswordBtn');
            const originalText = submitBtn.innerHTML;
            submitBtn.innerHTML = '<span class="material-symbols-outlined text-sm animate-spin">refresh</span> Modification...';
            submitBtn.disabled = true;
            
            try {
                const response = await fetch('{{ route("settings.password") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({
                        current_password: currentPassword,
                        password: newPassword,
                        password_confirmation: confirmPassword
                    })
                });
                
                const data = await response.json();
                
                if (data.success) {
                    // Succès
                    document.getElementById('passwordSuccess').classList.remove('hidden');
                    document.getElementById('passwordForm').reset();
                    
                    // Réinitialiser l'indicateur de force
                    document.querySelectorAll('#strength-1, #strength-2, #strength-3, #strength-4').forEach(bar => {
                        if (bar) bar.className = 'flex-1 bg-gray-200 dark:bg-gray-600 rounded-full transition-all';
                    });
                    const strengthText = document.getElementById('strength-text');
                    if (strengthText) {
                        strengthText.textContent = 'Faible';
                        strengthText.className = 'text-xs text-gray-500 dark:text-gray-400 mt-1';
                    }
                    
                    // Toast de succès
                    showToast('✅ Mot de passe modifié avec succès !');
                    
                    // Fermer la modale si elle existe
                    if (typeof closeModal === 'function') {
                        closeModal();
                    }
                    
                } else {
                    // Erreurs de validation
                    if (data.errors) {
                        for (const [field, messages] of Object.entries(data.errors)) {
                            showError(field, messages[0]);
                        }
                    } else {
                        showToast('❌ ' + (data.message || 'Erreur lors du changement de mot de passe'));
                    }
                }
            } catch (error) {
                console.error('Erreur:', error);
                showToast('❌ Erreur de connexion. Veuillez réessayer.');
            } finally {
                submitBtn.innerHTML = originalText;
                submitBtn.disabled = false;
            }
        });
    }

    // ============================================
    // GESTION DES ERREURS
    // ============================================
    window.showError = function(field, message) {
        const errorElement = document.getElementById(`${field}_error`);
        if (errorElement) {
            errorElement.textContent = message;
            errorElement.classList.remove('hidden');
            
            // Ajouter la classe d'erreur au champ
            const input = document.getElementById(field);
            if (input) {
                input.classList.add('border-red-500', 'dark:border-red-500');
            }
        }
        
        // Afficher le conteneur d'erreurs
        const errorsContainer = document.getElementById('passwordErrors');
        if (errorsContainer) {
            errorsContainer.classList.remove('hidden');
        }
        
        // Ajouter l'erreur à la liste
        const errorList = document.getElementById('errorList');
        if (errorList) {
            const li = document.createElement('li');
            li.textContent = `• ${message}`;
            errorList.appendChild(li);
        }
    }

    window.hideAllErrors = function() {
        const errorsContainer = document.getElementById('passwordErrors');
        if (errorsContainer) {
            errorsContainer.classList.add('hidden');
        }
        
        const errorList = document.getElementById('errorList');
        if (errorList) {
            errorList.innerHTML = '';
        }
        
        document.querySelectorAll('[id$="_error"]').forEach(el => {
            el.classList.add('hidden');
            el.textContent = '';
        });
        
        document.querySelectorAll('.border-red-500').forEach(el => {
            el.classList.remove('border-red-500', 'dark:border-red-500');
        });
    }

    // ============================================
    // TOAST NOTIFICATION
    // ============================================
    window.showToast = function(message) {
        const existingToasts = document.querySelectorAll('.custom-toast');
        existingToasts.forEach(toast => toast.remove());
        
        const toast = document.createElement('div');
        toast.className = 'custom-toast';
        const isSuccess = message.includes('✅');
        toast.style.cssText = `
            position: fixed;
            bottom: 20px;
            right: 20px;
            background: ${isSuccess ? '#10B981' : '#EF4444'};
            color: white;
            padding: 12px 24px;
            border-radius: 12px;
            z-index: 9999;
            font-size: 14px;
            font-weight: 500;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
            animation: slideIn 0.3s ease-out;
            max-width: 400px;
        `;
        toast.textContent = message;
        document.body.appendChild(toast);
        
        setTimeout(() => {
            toast.style.opacity = '0';
            toast.style.transition = 'opacity 0.3s';
            setTimeout(() => toast.remove(), 300);
        }, 4000);
    }
});

// ============================================
// STYLES D'ANIMATION
// ============================================
const style = document.createElement('style');
style.textContent = `
    @keyframes slideIn {
        from {
            opacity: 0;
            transform: translateX(20px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }
    
    .custom-toast {
        animation: slideIn 0.3s ease-out;
    }
    
    @keyframes spin {
        from { transform: rotate(0deg); }
        to { transform: rotate(360deg); }
    }
    .animate-spin {
        animation: spin 1s linear infinite;
    }
`;
document.head.appendChild(style);
</script>