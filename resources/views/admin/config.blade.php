@extends('layouts.app')

@section('title', 'Configuration')
@section('header-title', '⚙️ Configuration de la plateforme')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="bg-white rounded-xl shadow-sm p-6">
        <h2 class="text-xl font-bold mb-6">Paramètres généraux</h2>
        
        <form id="configForm" class="space-y-6">
            @csrf
            
            <div>
                <label class="block text-sm font-semibold mb-1">Nom de la plateforme</label>
                <input type="text" name="platform_name" value="NEARSEO" class="w-full border border-gray-300 rounded-lg px-4 py-2">
            </div>
            
            <div>
                <label class="block text-sm font-semibold mb-1">Email de contact</label>
                <input type="email" name="contact_email" value="contact@nearseo.com" class="w-full border border-gray-300 rounded-lg px-4 py-2">
            </div>
            
            <div>
                <label class="block text-sm font-semibold mb-1">Langue par défaut</label>
                <select name="default_language" class="w-full border border-gray-300 rounded-lg px-4 py-2">
                    <option value="fr">Français</option>
                    <option value="en">English</option>
                    <option value="ar">العربية</option>
                </select>
            </div>
            
            <div>
                <label class="block text-sm font-semibold mb-1">Langues disponibles</label>
                <div class="space-y-2">
                    <label class="flex items-center gap-2">
                        <input type="checkbox" name="languages[]" value="fr" checked> Français
                    </label>
                    <label class="flex items-center gap-2">
                        <input type="checkbox" name="languages[]" value="en" checked> English
                    </label>
                    <label class="flex items-center gap-2">
                        <input type="checkbox" name="languages[]" value="ar"> العربية
                    </label>
                </div>
            </div>
            
            <div class="pt-4 border-t">
                <h3 class="font-semibold mb-3">Limites des plans (articles/mois)</h3>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm mb-1">Plan Gratuit</label>
                        <input type="number" name="plan_limits[free]" value="5" class="w-full border rounded-lg px-4 py-2">
                    </div>
                    <div>
                        <label class="block text-sm mb-1">Plan Pro</label>
                        <input type="number" name="plan_limits[pro]" value="50" class="w-full border rounded-lg px-4 py-2">
                    </div>
                    <div>
                        <label class="block text-sm mb-1">Plan Business</label>
                        <input type="number" name="plan_limits[business]" value="500" class="w-full border rounded-lg px-4 py-2">
                    </div>
                </div>
            </div>
            
            <div class="flex justify-end">
                <button type="submit" class="bg-primary text-white px-6 py-2 rounded-lg hover:opacity-90 transition">
                    Enregistrer
                </button>
            </div>
        </form>
    </div>
</div>

<script>
document.getElementById('configForm').addEventListener('submit', async function(e) {
    e.preventDefault();
    
    const formData = new FormData(this);
    const data = Object.fromEntries(formData);
    data.languages = formData.getAll('languages[]');
    data.plan_limits = {
        free: formData.get('plan_limits[free]'),
        pro: formData.get('plan_limits[pro]'),
        business: formData.get('plan_limits[business]')
    };
    
    try {
        const response = await fetch('{{ route("admin.settings.update") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify(data)
        });
        
        const result = await response.json();
        if (result.success) {
            alert('Configuration enregistrée avec succès !');
        } else {
            alert('Erreur lors de l\'enregistrement');
        }
    } catch (error) {
        console.error('Error:', error);
        alert('Erreur de connexion');
    }
});
</script>
@endsection