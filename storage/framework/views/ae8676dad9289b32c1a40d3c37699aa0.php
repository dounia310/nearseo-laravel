


<?php $__env->startSection('title', 'Gestion des utilisateurs - Admin'); ?>
<?php $__env->startSection('header-title', 'Gestion des utilisateurs'); ?>

<?php $__env->startSection('content'); ?>
<div class="py-6">
    <div class="max-w-7xl mx-auto">
        <!-- Header -->
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-gray-900">Gestion des utilisateurs</h1>
            <p class="text-gray-500 text-sm">Administrez les accès et rôles de votre équipe SEO</p>
        </div>
        
        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
            <div class="bg-white rounded-xl border border-gray-100 p-4 shadow-sm">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-500">Total utilisateurs</p>
                        <p class="text-2xl font-bold text-gray-900"><?php echo e($users->total()); ?></p>
                    </div>
                    <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center">
                        <span class="material-symbols-outlined text-blue-600">people</span>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-xl border border-gray-100 p-4 shadow-sm">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-500">Administrateurs</p>
                        <p class="text-2xl font-bold text-gray-900"><?php echo e($users->where('role', 'admin')->count()); ?></p>
                    </div>
                    <div class="w-10 h-10 bg-red-100 rounded-lg flex items-center justify-center">
                        <span class="material-symbols-outlined text-red-600">admin_panel_settings</span>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-xl border border-gray-100 p-4 shadow-sm">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-500">Utilisateurs</p>
                        <p class="text-2xl font-bold text-gray-900"><?php echo e($users->where('role', 'user')->count()); ?></p>
                    </div>
                    <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center">
                        <span class="material-symbols-outlined text-green-600">person</span>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-xl border border-gray-100 p-4 shadow-sm">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-500">Articles totaux</p>
                        <p class="text-2xl font-bold text-gray-900"><?php echo e($users->sum('articles_count')); ?></p>
                    </div>
                    <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center">
                        <span class="material-symbols-outlined text-purple-600">article</span>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Filters Bar -->
        <div class="bg-white rounded-xl border border-gray-100 p-4 mb-6 flex flex-wrap gap-4 items-center justify-between">
            <div class="flex flex-wrap gap-3 items-center">
                <div class="relative">
                    <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-lg">search</span>
                    <input type="text" id="searchInput" placeholder="Rechercher par nom, email..." 
                           class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg w-64 focus:ring-2 focus:ring-primary/20 focus:border-primary">
                </div>
                
                <select id="roleFilter" class="px-3 py-2 border border-gray-300 rounded-lg bg-white text-sm">
                    <option value="">Tous les rôles</option>
                    <option value="admin">Administrateur</option>
                    <option value="user">Utilisateur</option>
                </select>
                
                <select id="sortFilter" class="px-3 py-2 border border-gray-300 rounded-lg bg-white text-sm">
                    <option value="recent">Plus récents</option>
                    <option value="oldest">Plus anciens</option>
                    <option value="name_asc">Nom (A-Z)</option>
                    <option value="name_desc">Nom (Z-A)</option>
                </select>
            </div>
            
            <div class="flex gap-2">
                <button onclick="exportUsers()" 
                        class="flex items-center gap-2 px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition">
                    <span class="material-symbols-outlined text-sm">download</span>
                    Exporter CSV
                </button>
                <button onclick="showCreateUserModal()" 
                        class="flex items-center gap-2 px-4 py-2 bg-primary text-white rounded-lg hover:bg-primary/90 transition">
                    <span class="material-symbols-outlined text-sm">add</span>
                    Ajouter un utilisateur
                </button>
            </div>
        </div>
        
        <!-- Users Table -->
        <div class="bg-white rounded-xl border border-gray-100 overflow-hidden shadow-sm">
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-gray-50 border-b">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Utilisateur</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Rôle</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Articles</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Vues</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Score SEO</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Inscrit le</th>
                            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100" id="usersTableBody">
                        <?php $__empty_1 = true; $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr class="hover:bg-gray-50 transition user-row" data-role="<?php echo e($user->role); ?>" data-name="<?php echo e(strtolower($user->name)); ?>" data-email="<?php echo e(strtolower($user->email)); ?>" data-date="<?php echo e($user->created_at->timestamp); ?>">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-full bg-primary/10 flex items-center justify-center">
                                        <span class="material-symbols-outlined text-primary text-lg"><?php echo e($user->role === 'admin' ? 'admin_panel_settings' : 'person'); ?></span>
                                    </div>
                                    <div>
                                        <p class="font-medium text-gray-900"><?php echo e($user->name); ?></p>
                                        <p class="text-xs text-gray-500"><?php echo e($user->email); ?></p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-2 py-1 text-xs rounded-full <?php echo e($user->role === 'admin' ? 'bg-red-100 text-red-700' : 'bg-green-100 text-green-700'); ?>">
                                    <?php echo e($user->role === 'admin' ? 'Admin' : 'User'); ?>

                                </span>
                            </td>
                            <td class="px-6 py-4"><?php echo e($user->articles_count ?? 0); ?></td>
                            <td class="px-6 py-4"><?php echo e(number_format($user->articles_sum_views ?? 0)); ?></td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-2">
                                    <div class="w-16 bg-gray-200 rounded-full h-1.5">
                                        <div class="bg-primary h-1.5 rounded-full" style="width: <?php echo e($user->articles_avg_seo_score ?? 0); ?>%"></div>
                                    </div>
                                    <span class="text-xs"><?php echo e(round($user->articles_avg_seo_score ?? 0)); ?>%</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-gray-500"><?php echo e($user->created_at->format('d M Y')); ?></td>
                            <td class="px-6 py-4 text-center">
                                <div class="flex items-center justify-center gap-1">
                                    <button onclick="viewUser(<?php echo e($user->id); ?>)" 
                                            class="p-1.5 hover:bg-blue-50 rounded-lg transition" 
                                            title="Voir les détails">
                                        <span class="material-symbols-outlined text-sm text-blue-600">visibility</span>
                                    </button>
                                    <?php if($user->id !== auth()->id()): ?>
                                    <button onclick="toggleRole(<?php echo e($user->id); ?>, '<?php echo e($user->role); ?>')" 
                                            class="p-1.5 hover:bg-orange-50 rounded-lg transition" 
                                            title="Changer rôle">
                                        <span class="material-symbols-outlined text-sm text-orange-600">admin_panel_settings</span>
                                    </button>
                                    <button onclick="deleteUser(<?php echo e($user->id); ?>)" 
                                            class="p-1.5 hover:bg-red-50 rounded-lg transition" 
                                            title="Supprimer">
                                        <span class="material-symbols-outlined text-sm text-red-600">delete</span>
                                    </button>
                                    <?php endif; ?>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="7" class="px-6 py-12 text-center text-gray-500">
                                Aucun utilisateur trouvé
                            </td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
            
            <!-- Pagination -->
            <div class="px-6 py-4 border-t border-gray-100 flex items-center justify-between">
                <div class="text-sm text-gray-500">
                    Affichage de <?php echo e($users->firstItem() ?? 0); ?>-<?php echo e($users->lastItem() ?? 0); ?> sur <?php echo e($users->total()); ?> utilisateurs
                </div>
                <div>
                    <?php echo e($users->links()); ?>

                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Création Utilisateur -->
<div id="createUserModal" class="fixed inset-0 bg-black/50 z-50 hidden flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl max-w-md w-full shadow-2xl">
        <div class="flex justify-between items-center p-6 border-b">
            <h3 class="text-xl font-semibold">➕ Ajouter un utilisateur</h3>
            <button onclick="closeCreateUserModal()" class="text-gray-400 hover:text-gray-600 transition">
                <span class="material-symbols-outlined">close</span>
            </button>
        </div>
        
        <form id="createUserForm" class="p-6 space-y-4">
            <?php echo csrf_field(); ?>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Nom complet *</label>
                <input type="text" id="userName" required 
                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none">
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Email *</label>
                <input type="email" id="userEmail" required 
                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none">
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Mot de passe *</label>
                <input type="password" id="userPassword" required minlength="8"
                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none">
                <p class="text-xs text-gray-400 mt-1">Minimum 8 caractères</p>
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Rôle</label>
                <select id="userRole" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none">
                    <option value="user">Utilisateur</option>
                    <option value="admin">Administrateur</option>
                </select>
            </div>
            
            <div class="flex gap-3 pt-4">
                <button type="button" onclick="closeCreateUserModal()" 
                        class="flex-1 px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition">
                    Annuler
                </button>
                <button type="submit" 
                        class="flex-1 px-4 py-2 bg-primary text-white rounded-lg hover:bg-primary/90 transition">
                    Ajouter l'utilisateur
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Voir Utilisateur -->
<div id="viewUserModal" class="fixed inset-0 bg-black/50 z-50 hidden flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl max-w-2xl w-full max-h-[90vh] shadow-2xl animate-modal">
        <!-- En-tête -->
        <div class="flex justify-between items-center p-6 border-b bg-gradient-to-r from-blue-50 to-purple-50 rounded-t-2xl">
            <div class="flex items-center gap-3">
                <div class="w-12 h-12 rounded-full bg-primary/20 flex items-center justify-center">
                    <span class="material-symbols-outlined text-primary text-2xl">person</span>
                </div>
                <div>
                    <h3 id="modalUserName" class="text-xl font-bold text-gray-900">Chargement...</h3>
                    <p id="modalUserEmail" class="text-sm text-gray-500">email@example.com</p>
                </div>
            </div>
            <button onclick="closeViewUserModal()" class="text-gray-400 hover:text-gray-600 transition text-2xl">
                ✕
            </button>
        </div>

        <!-- Corps -->
        <div id="modalUserContent" class="p-6 overflow-y-auto max-h-[60vh] space-y-4">
            <div class="text-center py-8 text-gray-400">
                <span class="material-symbols-outlined text-4xl animate-spin">refresh</span>
                <p class="mt-2">Chargement des données...</p>
            </div>
        </div>

        <!-- Pied -->
        <div class="border-t p-4 flex justify-end gap-3">
            <button onclick="closeViewUserModal()" 
                    class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition">
                Fermer
            </button>
            
        </div>
    </div>
</div>

<style>
@keyframes modalSlideIn {
    from {
        opacity: 0;
        transform: scale(0.95) translateY(20px);
    }
    to {
        opacity: 1;
        transform: scale(1) translateY(0);
    }
}
.animate-modal {
    animation: modalSlideIn 0.3s ease-out;
}
</style>

<script>
let currentUserData = null;

// =============================================
// RECHERCHE ET FILTRES
// =============================================
document.getElementById('searchInput').addEventListener('input', filterTable);
document.getElementById('roleFilter').addEventListener('change', filterTable);
document.getElementById('sortFilter').addEventListener('change', sortTable);

function filterTable() {
    const searchTerm = document.getElementById('searchInput').value.toLowerCase();
    const roleFilter = document.getElementById('roleFilter').value;
    const rows = document.querySelectorAll('.user-row');
    
    rows.forEach(row => {
        const name = row.dataset.name || '';
        const email = row.dataset.email || '';
        const role = row.dataset.role || '';
        
        const matchesSearch = name.includes(searchTerm) || email.includes(searchTerm);
        const matchesRole = !roleFilter || role === roleFilter;
        
        row.style.display = matchesSearch && matchesRole ? '' : 'none';
    });
}

function sortTable() {
    const sortBy = document.getElementById('sortFilter').value;
    const tbody = document.querySelector('#usersTableBody');
    const rows = Array.from(document.querySelectorAll('.user-row'));
    
    rows.sort((a, b) => {
        if (sortBy === 'recent') {
            return (b.dataset.date || 0) - (a.dataset.date || 0);
        } else if (sortBy === 'oldest') {
            return (a.dataset.date || 0) - (b.dataset.date || 0);
        } else if (sortBy === 'name_asc') {
            return (a.dataset.name || '').localeCompare(b.dataset.name || '');
        } else if (sortBy === 'name_desc') {
            return (b.dataset.name || '').localeCompare(a.dataset.name || '');
        }
        return 0;
    });
    
    rows.forEach(row => tbody.appendChild(row));
}

// =============================================
// VOIR UTILISATEUR - MODALE
// =============================================
function viewUser(id) {
    // Afficher le modal
    const modal = document.getElementById('viewUserModal');
    modal.classList.remove('hidden');
    modal.classList.add('flex');
    
    // Afficher le chargement
    document.getElementById('modalUserContent').innerHTML = `
        <div class="text-center py-8 text-gray-400">
            <span class="material-symbols-outlined text-4xl animate-spin">refresh</span>
            <p class="mt-2">Chargement des données...</p>
        </div>
    `;
    document.getElementById('modalUserName').textContent = 'Chargement...';
    document.getElementById('modalUserEmail').textContent = '...';
    
    // Récupérer les données
    fetch(`/admin/users/${id}/details`, {
        headers: { 
            'Accept': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        }
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Erreur HTTP: ' + response.status);
        }
        return response.json();
    })
    .then(data => {
        if (data.success) {
            currentUserData = data.data;
            displayUserData(currentUserData);
        } else {
            document.getElementById('modalUserContent').innerHTML = `
                <div class="text-center py-8 text-red-500">
                    <span class="material-symbols-outlined text-4xl">error</span>
                    <p class="mt-2">Erreur: ${data.message || 'Données non disponibles'}</p>
                </div>
            `;
        }
    })
    .catch(err => {
        document.getElementById('modalUserContent').innerHTML = `
            <div class="text-center py-8 text-red-500">
                <span class="material-symbols-outlined text-4xl">error</span>
                <p class="mt-2">Erreur de connexion: ${err.message}</p>
                <button onclick="viewUser(${id})" class="mt-4 px-4 py-2 bg-primary text-white rounded-lg">
                    Réessayer
                </button>
            </div>
        `;
    });
}

// Afficher les informations SANS JSON - AVEC ICONES MATERIAL
function displayUserData(user) {
    // Mettre à jour l'en-tête
    document.getElementById('modalUserName').textContent = user.name;
    document.getElementById('modalUserEmail').textContent = user.email;
    
    // Badge rôle
    const roleBadge = user.role === 'admin' 
        ? '<span class="px-2 py-1 bg-red-100 text-red-700 rounded-full text-xs font-medium">Administrateur</span>'
        : '<span class="px-2 py-1 bg-green-100 text-green-700 rounded-full text-xs font-medium">Utilisateur</span>';
    
    // Articles
    let articlesHtml = '';
    if (user.articles && user.articles.length > 0) {
        articlesHtml = `
            <div class="border-t pt-4 mt-2">
                <p class="text-sm font-medium text-gray-700 mb-2 flex items-center gap-2">
                    <span class="material-symbols-outlined text-lg">article</span>
                    Articles (${user.articles_count})
                </p>
                <div class="space-y-1 max-h-40 overflow-y-auto">
                    ${user.articles.map(a => `
                        <div class="flex items-center justify-between bg-gray-50 px-3 py-2 rounded-lg text-sm">
                            <span class="text-gray-700">${a.title}</span>
                            <span class="px-2 py-0.5 rounded-full text-xs ${a.status === 'published' ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700'}">
                                ${a.status || 'Brouillon'}
                            </span>
                        </div>
                    `).join('')}
                </div>
            </div>
        `;
    } else {
        articlesHtml = `
            <div class="border-t pt-4 mt-2">
                <p class="text-sm text-gray-400 flex items-center gap-2">
                    <span class="material-symbols-outlined text-lg">article</span>
                    Aucun article publié
                </p>
            </div>
        `;
    }
    
    document.getElementById('modalUserContent').innerHTML = `
        <div class="grid grid-cols-2 gap-4">
            <div class="bg-gray-50 rounded-lg p-3">
                <label class="text-xs text-gray-500 flex items-center gap-1">
                    <span class="material-symbols-outlined text-sm">person</span>
                    Nom complet
                </label>
                <p class="font-medium text-gray-900 mt-1">${user.name}</p>
            </div>
            <div class="bg-gray-50 rounded-lg p-3">
                <label class="text-xs text-gray-500 flex items-center gap-1">
                    <span class="material-symbols-outlined text-sm">email</span>
                    Email
                </label>
                <p class="font-medium text-gray-900 mt-1">${user.email}</p>
            </div>
            <div class="bg-gray-50 rounded-lg p-3">
                <label class="text-xs text-gray-500 flex items-center gap-1">
                    <span class="material-symbols-outlined text-sm">admin_panel_settings</span>
                    Rôle
                </label>
                <div class="mt-1">${roleBadge}</div>
            </div>
            <div class="bg-gray-50 rounded-lg p-3">
                <label class="text-xs text-gray-500 flex items-center gap-1">
                    <span class="material-symbols-outlined text-sm">calendar_today</span>
                    Inscrit le
                </label>
                <p class="font-medium text-gray-900 mt-1">${user.created_at || 'N/A'}</p>
            </div>
            <div class="bg-gray-50 rounded-lg p-3">
                <label class="text-xs text-gray-500 flex items-center gap-1">
                    <span class="material-symbols-outlined text-sm">description</span>
                    Nombre d'articles
                </label>
                <p class="font-medium text-gray-900 mt-1">${user.articles_count || 0}</p>
            </div>
        </div>
        ${articlesHtml}
    `;
}

function closeViewUserModal() {
    document.getElementById('viewUserModal').classList.add('hidden');
    document.getElementById('viewUserModal').classList.remove('flex');
}

function closeViewUserModal() {
    document.getElementById('viewUserModal').classList.add('hidden');
    document.getElementById('viewUserModal').classList.remove('flex');
}


// Toast notification
function showToast(message) {
    const toast = document.createElement('div');
    toast.textContent = message;
    toast.style.cssText = `
        position: fixed; bottom: 20px; right: 20px;
        background: #1a1a2e; color: white;
        padding: 12px 24px; border-radius: 12px;
        z-index: 9999; font-size: 14px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.3);
        animation: slideIn 0.3s ease-out;
    `;
    document.body.appendChild(toast);
    setTimeout(() => {
        toast.style.opacity = '0';
        toast.style.transition = 'opacity 0.3s';
        setTimeout(() => toast.remove(), 300);
    }, 3000);
}

// Fermer avec la touche Echap
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeViewUserModal();
        closeCreateUserModal();
    }
});

// Fermer en cliquant à l'extérieur
document.getElementById('viewUserModal')?.addEventListener('click', function(e) {
    if (e.target === this) {
        closeViewUserModal();
    }
});

document.getElementById('createUserModal')?.addEventListener('click', function(e) {
    if (e.target === this) {
        closeCreateUserModal();
    }
});

// =============================================
// TOGGLE ROLE
// =============================================
function toggleRole(id, currentRole) {
    const newRole = currentRole === 'admin' ? 'user' : 'admin';
    if (confirm(`Changer le rôle de cet utilisateur vers "${newRole}" ?`)) {
        fetch(`/admin/users/${id}/role`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({ role: newRole })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                showToast('✅ Rôle modifié avec succès !');
                setTimeout(() => window.location.reload(), 1000);
            } else {
                alert('Erreur: ' + data.error);
            }
        })
        .catch(err => alert('Erreur: ' + err));
    }
}

// =============================================
// DELETE USER
// =============================================
function deleteUser(id) {
    if (confirm('⚠️ Êtes-vous sûr de vouloir supprimer cet utilisateur ? Cette action est irréversible.')) {
        fetch(`/admin/users/${id}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                showToast('✅ Utilisateur supprimé !');
                setTimeout(() => window.location.reload(), 1000);
            } else {
                alert('Erreur: ' + data.error);
            }
        })
        .catch(err => alert('Erreur: ' + err));
    }
}

// =============================================
// EXPORT
// =============================================
function exportUsers() {
    window.location.href = '<?php echo e(route("admin.users.export")); ?>';
}

// =============================================
// CREATE USER MODAL
// =============================================
function showCreateUserModal() {
    document.getElementById('createUserModal').classList.remove('hidden');
    document.getElementById('createUserModal').classList.add('flex');
}

function closeCreateUserModal() {
    document.getElementById('createUserModal').classList.add('hidden');
    document.getElementById('createUserModal').classList.remove('flex');
    document.getElementById('createUserForm').reset();
}

document.getElementById('createUserForm').addEventListener('submit', async function(e) {
    e.preventDefault();
    
    const name = document.getElementById('userName').value;
    const email = document.getElementById('userEmail').value;
    const password = document.getElementById('userPassword').value;
    const role = document.getElementById('userRole').value;
    
    if (!name || !email || !password) {
        alert('Veuillez remplir tous les champs obligatoires');
        return;
    }
    
    if (password.length < 8) {
        alert('Le mot de passe doit contenir au moins 8 caractères');
        return;
    }
    
    const submitBtn = e.target.querySelector('button[type="submit"]');
    const originalText = submitBtn.innerHTML;
    submitBtn.innerHTML = 'Ajout en cours...';
    submitBtn.disabled = true;
    
    try {
        const response = await fetch('<?php echo e(route("admin.users.store")); ?>', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({ name, email, password, role })
        });
        
        const data = await response.json();
        
        if (response.ok && data.success) {
            showToast('✅ Utilisateur ajouté avec succès !');
            closeCreateUserModal();
            setTimeout(() => window.location.reload(), 1000);
        } else {
            alert('Erreur: ' + (data.error || data.message || 'Impossible d\'ajouter l\'utilisateur'));
        }
    } catch (error) {
        console.error('Error:', error);
        alert('Erreur de connexion. Veuillez réessayer.');
    } finally {
        submitBtn.innerHTML = originalText;
        submitBtn.disabled = false;
    }
});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\pc\nearseo-laravel\resources\views/admin/users.blade.php ENDPATH**/ ?>