<div class="bg-surface-container-lowest border border-outline-variant rounded-xl p-6">
    <div class="flex items-center gap-4 mb-6">
        <div class="w-16 h-16 rounded-full bg-secondary-fixed flex items-center justify-center">
            <span class="material-symbols-outlined text-3xl text-secondary">lock</span>
        </div>
        <div>
            <h3 class="font-h2 text-h2 text-on-surface">Sécurité du compte</h3>
            <p class="text-body-sm text-on-surface-variant">Modifiez votre mot de passe</p>
        </div>
    </div>
    
    <form method="POST" action="{{ route('settings.password') }}" class="space-y-4">
        @csrf
        <div>
            <label class="block font-label text-label text-on-surface-variant mb-1">Mot de passe actuel</label>
            <input type="password" name="current_password" class="w-full border border-outline-variant rounded-lg px-4 py-2 focus:ring-1 focus:ring-primary focus:border-primary outline-none">
        </div>
        <div>
            <label class="block font-label text-label text-on-surface-variant mb-1">Nouveau mot de passe</label>
            <input type="password" name="new_password" class="w-full border border-outline-variant rounded-lg px-4 py-2">
        </div>
        <div>
            <label class="block font-label text-label text-on-surface-variant mb-1">Confirmer le mot de passe</label>
            <input type="password" name="new_password_confirmation" class="w-full border border-outline-variant rounded-lg px-4 py-2">
        </div>
        <div class="flex justify-end pt-4">
            <button type="submit" class="bg-primary text-on-primary px-6 py-2 rounded-lg font-label hover:opacity-90 transition">Changer le mot de passe</button>
        </div>
    </form>
</div>