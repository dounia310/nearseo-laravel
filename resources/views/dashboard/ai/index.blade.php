{{-- resources/views/dashboard/ai/index.blade.php --}}
@extends('layouts.app')

@section('title', 'Historique IA - NEARSEO')
@section('header-title', 'Historique des générations IA')

@section('content')
<div class="py-6">
    <div class="max-w-7xl mx-auto">
        <div class="bg-white rounded-xl shadow-sm border p-6">
            <h2 class="text-xl font-bold mb-4">📜 Historique des articles générés</h2>
            
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-3 text-left">Titre</th>
                            <th class="px-4 py-3 text-left">Sujet</th>
                            <th class="px-4 py-3 text-left">Date</th>
                            <th class="px-4 py-3 text-left">Statut</th>
                            <th class="px-4 py-3 text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($generations as $gen)
                        <tr class="border-t hover:bg-gray-50">
                            <td class="px-4 py-3">{{ $gen->generated_title ?? 'Sans titre' }}</td>
                            <td class="px-4 py-3">{{ Str::limit($gen->topic, 50) }}</td>
                            <td class="px-4 py-3">{{ $gen->created_at->format('d/m/Y H:i') }}</td>
                            <td class="px-4 py-3">
                                <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-700">Publié</span>
                            </td>
                            <td class="px-4 py-3 text-center">
                                <a href="#" class="text-primary hover:underline">Voir</a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-4 py-8 text-center text-gray-500">
                                Aucune génération trouvée
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection