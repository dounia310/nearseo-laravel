{{-- resources/views/dashboard/ai/preview.blade.php --}}
@extends('layouts.app')

@section('title', 'Aperçu de l\'article')
@section('header-title', 'Aperçu de l\'article')

@section('content')
<div class="py-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-on-surface">Aperçu de l'article généré</h1>
        <div class="flex gap-3">
            <form action="{{ route('articles.store') }}" method="POST">
                @csrf
                <input type="hidden" name="title" value="{{ $generated['title'] }}">
                <input type="hidden" name="content" value="{{ $generated['content'] }}">
                <input type="hidden" name="focus_keyword" value="{{ $generated['focus_keyword'] }}">
                <input type="hidden" name="status" value="draft">
                <button type="submit" class="px-4 py-2 bg-secondary text-white rounded-lg hover:bg-secondary-dark transition">
                    📝 Sauvegarder en brouillon
                </button>
            </form>
            <form action="{{ route('articles.store') }}" method="POST">
                @csrf
                <input type="hidden" name="title" value="{{ $generated['title'] }}">
                <input type="hidden" name="content" value="{{ $generated['content'] }}">
                <input type="hidden" name="focus_keyword" value="{{ $generated['focus_keyword'] }}">
                <input type="hidden" name="status" value="published">
                <button type="submit" class="px-4 py-2 bg-primary text-white rounded-lg hover:bg-primary-dark transition">
                    🚀 Publier directement
                </button>
            </form>
            <a href="{{ route('ai.create') }}" class="px-4 py-2 border border-outline-variant rounded-lg hover:bg-surface-container transition">
                ↩️ Nouvelle génération
            </a>
        </div>
    </div>
    
    <div class="bg-surface-container-lowest rounded-xl border border-outline-variant/30 p-8">
        <!-- Métriques SEO -->
        <div class="mb-6 p-4 bg-primary/5 rounded-lg border border-primary/20">
            <div class="flex flex-wrap gap-6">
                <div>
                    <span class="text-xs text-on-surface-variant">Titre SEO</span>
                    <p class="font-medium">{{ $generated['title'] }}</p>
                </div>
                <div>
                    <span class="text-xs text-on-surface-variant">Mot-clé principal</span>
                    <p class="font-medium text-primary">{{ $generated['focus_keyword'] }}</p>
                </div>
                <div>
                    <span class="text-xs text-on-surface-variant">Nombre de mots</span>
                    <p class="font-medium">{{ $generated['word_count'] }} mots</p>
                </div>
                <div>
                    <span class="text-xs text-on-surface-variant">Meta description</span>
                    <p class="text-sm max-w-md">{{ $generated['meta_description'] ?? 'Non générée' }}</p>
                </div>
            </div>
        </div>
        
        <!-- Contenu de l'article -->
        <div class="prose max-w-none">
            {!! $generated['content'] !!}
        </div>
    </div>
</div>

<style>
    .prose h1 {
        font-size: 2rem;
        font-weight: 700;
        margin-bottom: 1.5rem;
        color: #1a202c;
    }
    .prose h2 {
        font-size: 1.5rem;
        font-weight: 600;
        margin-top: 2rem;
        margin-bottom: 1rem;
        color: #2d3748;
    }
    .prose h3 {
        font-size: 1.25rem;
        font-weight: 600;
        margin-top: 1.5rem;
        margin-bottom: 0.75rem;
        color: #4a5568;
    }
    .prose p {
        line-height: 1.6;
        margin-bottom: 1rem;
        color: #4a5568;
    }
    .prose ul, .prose ol {
        margin: 1rem 0;
        padding-left: 1.5rem;
    }
    .prose li {
        margin-bottom: 0.5rem;
    }
    .faq-item {
        margin-bottom: 1.5rem;
        padding-bottom: 1rem;
        border-bottom: 1px solid #e2e8f0;
    }
    .faq-item p:first-child {
        font-weight: 600;
        color: #2d3748;
    }
</style>
@endsection