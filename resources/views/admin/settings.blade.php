{{-- resources/views/admin/settings.blade.php --}}
@extends('layouts.app')

@section('title', 'Paramètres - Admin')
@section('header-title', 'Paramètres généraux')

@section('content')
<div class="py-6">
    <div class="max-w-7xl mx-auto">
        <div class="bg-white rounded-xl shadow-sm p-6">
            <h1 class="text-2xl font-bold mb-6">⚙️ Paramètres</h1>
            
            <form action="{{ route('admin.settings.update') }}" method="POST">
                @csrf
                
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium mb-1">Nom de la plateforme</label>
                        <input type="text" name="platform_name" class="w-full border rounded-lg px-3 py-2">
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium mb-1">Email de contact</label>
                        <input type="email" name="contact_email" class="w-full border rounded-lg px-3 py-2">
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium mb-1">Langue par défaut</label>
                        <select name="default_language" class="w-full border rounded-lg px-3 py-2">
                            <option value="fr">Français</option>
                            <option value="en">English</option>
                            <option value="ar">العربية</option>
                        </select>
                    </div>
                    
                    <button type="submit" class="bg-primary text-white px-4 py-2 rounded-lg">
                        Enregistrer
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection