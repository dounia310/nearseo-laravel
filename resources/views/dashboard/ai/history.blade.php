{{-- resources/views/dashboard/ai/history.blade.php --}}
@extends('layouts.app')

@section('title', 'Historique - NEARSEO')
@section('header-title', 'Historique des générations')

@section('content')
<div class="py-6">
    <div class="max-w-7xl mx-auto">
        <div class="bg-white rounded-xl shadow-sm border p-6">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-xl font-bold">🤖 Historique des articles IA</h2>
                <a href="{{ route('ai.create') }}" class="bg-primary text-white px-4 py-2 rounded-lg text-sm">
                    + Nouvelle génération
                </a>
            </div>
            
            @if($generations->count() > 0)
            <div class="space-y-4">
                @foreach($generations as $gen)
                <div class="border rounded-lg p-4 hover:shadow-md transition">
                    <div class="flex justify-between items-start">
                        <div>
                            <h3 class="font-semibold text-lg">{{ $gen->generated_title ?? 'Article généré' }}</h3>
                            <p class="text-sm text-gray-500 mt-1">Sujet: {{ $gen->topic }}</p>
                            <p class="text-xs text-gray-400 mt-2">{{ $gen->created_at->diffForHumans() }}</p>
                        </div>
                        <div class="flex gap-2">
                            <a href="#" class="text-primary text-sm hover:underline">Voir</a>
                            <button class="text-gray-400 hover:text-red-500 text-sm">🗑️</button>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @else
            <div class="text-center py-12">
                <span class="material-symbols-outlined text-5xl text-gray-300">history</span>
                <p class="text-gray-500 mt-2">Aucune génération enregistrée</p>
                <a href="{{ route('ai.create') }}" class="inline-block mt-4 text-primary hover:underline">
                    Générer votre premier article →
                </a>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection