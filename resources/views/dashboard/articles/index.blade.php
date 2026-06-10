@extends('layouts.app')

@section('title', 'Articles')
@section('header-title', 'Articles')

@section('content')
<div class="space-y-6">
    <!-- Header Section -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4">
        <div>
            <h1 class="font-h1 text-h1 text-on-surface">Articles</h1>
            <p class="text-on-surface-variant text-sm mt-1">Gérez vos contenus locaux et optimisez votre visibilité IA.</p>
        </div>
        <a href="{{ route('ai.create') }}" class="bg-[#C97C5D] text-white px-6 py-3 rounded-xl font-bold flex items-center gap-2 hover:opacity-90 transition-all shadow-md active:scale-95">
            <span class="material-symbols-outlined">add_circle</span>
             Nouvel article
        </a>
    </div>

    <!-- Filters & Tools -->
    <div class="flex flex-wrap items-center justify-between mb-6 gap-4">
        <div class="flex items-center gap-2 overflow-x-auto pb-2 md:pb-0">
            <button onclick="filterByStatus('all')" class="filter-btn px-4 py-2 bg-primary text-white rounded-full text-xs font-bold transition-all shadow-sm" data-status="all">Tous</button>
            <button onclick="filterByStatus('published')" class="filter-btn px-4 py-2 bg-white border border-gray-300 text-gray-600 rounded-full text-xs font-bold hover:bg-gray-50 transition-all" data-status="published">Publiés</button>
            <button onclick="filterByStatus('draft')" class="filter-btn px-4 py-2 bg-white border border-gray-300 text-gray-600 rounded-full text-xs font-bold hover:bg-gray-50 transition-all" data-status="draft">Brouillons</button>
        </div>
        <div class="flex items-center gap-3">
            <button class="flex items-center gap-2 px-3 py-2 text-gray-600 border border-gray-300 rounded-lg text-xs font-bold hover:bg-gray-50 transition-all">
                <span class="material-symbols-outlined text-base">filter_list</span>
                Filtrer par blog
            </button>
            <button class="flex items-center gap-2 px-3 py-2 text-gray-600 border border-gray-300 rounded-lg text-xs font-bold hover:bg-gray-50 transition-all">
                <span class="material-symbols-outlined text-base">sort</span>
                Trier
            </button>
        </div>
    </div>

    <!-- Data Table Card -->
    <div class="bg-white border rounded-xl overflow-hidden shadow-sm">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50 text-gray-500 border-b">
                        <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider">Titre de l'article</th>
                        <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider">Statut</th>
                        <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider">Vues</th>
                        <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider">Score SEO</th>
                        <th class="px-6 py-4 text-xs font-bold uppercase tracking-wider">Date</th>
                        <th class="px-6 py-4 text-right text-xs font-bold uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody id="articlesTableBody" class="divide-y divide-gray-200">
                    @forelse($articles as $article)
                    <tr class="hover:bg-gray-50 transition-colors duration-150 group" data-status="{{ $article->status }}" data-title="{{ strtolower($article->title) }}">
                        <td class="px-6 py-5">
                            <a href="{{ route('articles.edit', $article) }}" class="font-semibold text-gray-800 hover:text-primary transition-colors block">
                                {{ $article->title }}
                            </a>
                            <span class="text-xs text-green-600 bg-green-100 px-2 py-0.5 rounded mt-1 inline-block">Humain + IA</span>
                        </td>
                        <td class="px-6 py-5">
                            @if($article->status === 'published')
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-green-100 text-green-800 rounded-full text-xs font-bold">
                                <span class="w-1.5 h-1.5 rounded-full bg-green-600"></span>
                                Publié
                            </span>
                            @else
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-gray-100 text-gray-600 rounded-full text-xs font-bold">
                                <span class="w-1.5 h-1.5 rounded-full bg-gray-400"></span>
                                Brouillon
                            </span>
                            @endif
                        </td>
                        <td class="px-6 py-5 text-gray-600">{{ number_format($article->views ?? 0) }}</td>
                        <td class="px-6 py-5">
                            <div class="flex items-center gap-3">
                                <div class="w-16 bg-gray-200 rounded-full h-1.5 overflow-hidden">
                                    <div class="{{ $article->seo_score >= 70 ? 'bg-green-600' : 'bg-orange-500' }} h-full" style="width: {{ $article->seo_score ?? 0 }}%"></div>
                                </div>
                                <span class="font-bold {{ $article->seo_score >= 70 ? 'text-green-600' : 'text-orange-500' }} text-sm">{{ $article->seo_score ?? 0 }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-5 text-gray-500 text-sm whitespace-nowrap">{{ $article->created_at->format('d M Y') }}</td>
                        <td class="px-6 py-5 text-right">
                            <div class="flex items-center justify-end gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                                <a href="{{ route('articles.edit', $article) }}" class="p-2 text-gray-400 hover:text-primary transition-colors">
                                    <span class="material-symbols-outlined text-lg">edit</span>
                                </a>
                                <a href="{{ route('articles.show', $article) }}" class="p-2 text-gray-400 hover:text-primary transition-colors">
                                    <span class="material-symbols-outlined text-lg">visibility</span>
                                </a>
                                <button onclick="deleteArticle({{ $article->id }}, '{{ $article->title }}')" class="p-2 text-gray-400 hover:text-red-500 transition-colors">
                                    <span class="material-symbols-outlined text-lg">delete</span>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-12 text-center text-gray-500">
                            <span class="material-symbols-outlined text-4xl mb-2 block">article</span>
                            <p>Aucun article pour le moment.</p>
                            <a href="{{ route('ai.create') }}" class="text-primary hover:underline mt-2 inline-block">Créez votre premier article</a>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="px-6 py-4 bg-gray-50 border-t flex items-center justify-between">
            <span class="text-sm text-gray-500">Page {{ $articles->currentPage() }} sur {{ $articles->lastPage() }}</span>
            <div class="flex items-center gap-2">
                @if($articles->onFirstPage())
                <span class="p-2 border rounded-lg text-gray-400 cursor-not-allowed">
                    <span class="material-symbols-outlined text-lg">chevron_left</span>
                </span>
                @else
                <a href="{{ $articles->previousPageUrl() }}" class="p-2 border rounded-lg text-gray-600 hover:bg-gray-100 transition-all">
                    <span class="material-symbols-outlined text-lg">chevron_left</span>
                </a>
                @endif
                
                @if($articles->hasMorePages())
                <a href="{{ $articles->nextPageUrl() }}" class="p-2 border rounded-lg text-gray-600 hover:bg-gray-100 transition-all">
                    <span class="material-symbols-outlined text-lg">chevron_right</span>
                </a>
                @else
                <span class="p-2 border rounded-lg text-gray-400 cursor-not-allowed">
                    <span class="material-symbols-outlined text-lg">chevron_right</span>
                </span>
                @endif
            </div>
        </div>
    </div>

    <!-- Organic Insight Section -->
    <div class="mt-6 grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white border-l-4 border-secondary p-6 rounded-xl shadow-sm flex items-start gap-4">
            <div class="p-3 bg-green-100 text-secondary rounded-lg">
                <span class="material-symbols-outlined">auto_awesome</span>
            </div>
            <div>
                <h4 class="font-semibold text-gray-800">Insight IA</h4>
                <p class="text-sm text-gray-500 mt-2">Le sujet "Bois Local" connaît une hausse de 15% d'intérêt dans votre région ce mois-ci.</p>
            </div>
        </div>
        <div class="bg-white border-l-4 border-primary p-6 rounded-xl shadow-sm flex items-start gap-4">
            <div class="p-3 bg-orange-100 text-primary rounded-lg">
                <span class="material-symbols-outlined">trending_up</span>
            </div>
            <div>
                <h4 class="font-semibold text-gray-800">Performance</h4>
                <p class="text-sm text-gray-500 mt-2">Votre score SEO moyen a progressé de 4 points suite aux dernières optimisations.</p>
            </div>
        </div>
        <div class="bg-white border-l-4 border-tertiary p-6 rounded-xl shadow-sm flex items-start gap-4">
            <div class="p-3 bg-amber-100 text-tertiary rounded-lg">
                <span class="material-symbols-outlined">tips_and_updates</span>
            </div>
            <div>
                <h4 class="font-semibold text-gray-800">Conseil Local</h4>
                <p class="text-sm text-gray-500 mt-2">Ajoutez des mentions de quartiers spécifiques pour booster vos résultats "Near Me".</p>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Search and filter functionality
    function filterArticles() {
        var searchTerm = document.getElementById('searchInput') ? document.getElementById('searchInput').value.toLowerCase() : '';
        var rows = document.querySelectorAll('#articlesTableBody tr');
        var activeFilter = document.querySelector('.filter-btn.bg-primary');
        var status = activeFilter ? activeFilter.dataset.status : 'all';
        
        rows.forEach(function(row) {
            if (row.cells) {
                var title = row.dataset.title || '';
                var rowStatus = row.dataset.status || '';
                
                var matchesSearch = title.indexOf(searchTerm) !== -1;
                var matchesFilter = status === 'all' || rowStatus === status;
                
                if (matchesSearch && matchesFilter) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            }
        });
    }
    
    function filterByStatus(status) {
        // Update button styles
        var btns = document.querySelectorAll('.filter-btn');
        btns.forEach(function(btn) {
            btn.classList.remove('bg-primary', 'text-white');
            btn.classList.add('bg-white', 'border', 'border-gray-300', 'text-gray-600');
        });
        
        var activeBtn = document.querySelector('.filter-btn[data-status="' + status + '"]');
        if (activeBtn) {
            activeBtn.classList.add('bg-primary', 'text-white');
            activeBtn.classList.remove('bg-white', 'border', 'border-gray-300', 'text-gray-600');
        }
        
        // Filter rows
        var rows = document.querySelectorAll('#articlesTableBody tr');
        var searchTerm = document.getElementById('searchInput') ? document.getElementById('searchInput').value.toLowerCase() : '';
        
        rows.forEach(function(row) {
            if (row.cells) {
                var title = row.dataset.title || '';
                var rowStatus = row.dataset.status || '';
                
                var matchesSearch = title.indexOf(searchTerm) !== -1;
                var matchesFilter = status === 'all' || rowStatus === status;
                
                if (matchesSearch && matchesFilter) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            }
        });
    }
    
    function deleteArticle(id, title) {
        if (confirm('Supprimer l\'article "' + title + '" ? Cette action est irréversible.')) {
            var token = document.querySelector('meta[name="csrf-token"]').content;
            
            fetch('/articles/' + id, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': token,
                    'Content-Type': 'application/json'
                }
            }).then(function(response) {
                if (response.ok) {
                    location.reload();
                } else {
                    alert('Erreur lors de la suppression');
                }
            }).catch(function(error) {
                console.error('Error:', error);
                alert('Erreur lors de la suppression');
            });
        }
    }
    
    // Search bar focus effect
    var searchInput = document.getElementById('searchInput');
    if (searchInput) {
        searchInput.addEventListener('focus', function() {
            if (searchInput.parentElement) {
                searchInput.parentElement.classList.add('scale-[1.02]');
                searchInput.parentElement.style.transition = 'transform 0.2s ease-out';
            }
        });
        searchInput.addEventListener('blur', function() {
            if (searchInput.parentElement) {
                searchInput.parentElement.classList.remove('scale-[1.02]');
            }
        });
    }
</script>
@endpush