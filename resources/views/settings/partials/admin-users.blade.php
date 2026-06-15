<div class="bg-surface-container-lowest border border-outline-variant rounded-xl overflow-hidden">
    <!-- En-tête -->
    <div class="p-6 border-b border-outline-variant flex justify-between items-center flex-wrap gap-4">
        <div>
            <h3 class="font-h2 text-h2 text-on-surface">Gestion des Utilisateurs</h3>
            <p class="text-body-sm text-on-surface-variant">Administrez les accès et rôles de votre équipe SEO</p>
        </div>
        <div class="flex gap-3">
            <button onclick="exportUsers()" 
                    class="flex items-center gap-2 bg-primary text-white px-4 py-2 rounded-lg font-label hover:opacity-90 transition text-sm">
                <span class="material-symbols-outlined text-lg">download</span>
                Exporter CSV
            </button>
            
            <button onclick="showAddUserModal()" 
                    class="flex items-center gap-2 bg-primary text-white px-5 py-2 rounded-lg font-label hover:opacity-90 transition text-sm">
                <span class="material-symbols-outlined text-lg">add</span>
                Ajouter un utilisateur
            </button>
        </div>
    </div>

    <!-- Barre de recherche et filtres -->
    <div class="p-4 border-b border-outline-variant bg-surface-container-low">
        <div class="flex flex-wrap gap-3 items-center justify-between">
            <div class="flex flex-wrap gap-3">
                <div class="relative">
                    <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-on-surface-variant">search</span>
                    <input type="text" id="searchUsers" placeholder="Rechercher par nom, email..." 
                           class="pl-10 pr-4 py-2 border border-outline-variant rounded-lg w-64 focus:ring-1 focus:ring-primary focus:border-primary outline-none text-sm">
                </div>
                <select id="roleFilter" class="px-4 py-2 border border-outline-variant rounded-lg text-sm focus:ring-1 focus:ring-primary focus:border-primary outline-none">
                    <option value="all">Tous les rôles</option>
                    <option value="admin">Administrateurs</option>
                    <option value="user">Utilisateurs</option>
                </select>
                <select id="sortBy" class="px-4 py-2 border border-outline-variant rounded-lg text-sm focus:ring-1 focus:ring-primary focus:border-primary outline-none">
                    <option value="latest">Plus récents</option>
                    <option value="oldest">Plus anciens</option>
                    <option value="name_asc">Nom (A-Z)</option>
                    <option value="name_desc">Nom (Z-A)</option>
                    <option value="articles_desc">+ d'articles</option>
                </select>
            </div>
            <div class="text-sm text-on-surface-variant">
                Total: <span id="totalUsers">{{ $users->total() }}</span> utilisateur(s)
            </div>
        </div>
    </div>

    <!-- Tableau des utilisateurs -->
    <div class="bg-white border border-outline-variant rounded-xl overflow-hidden overflow-x-auto shadow-sm">
        <table class="w-full text-left border-collapse min-w-[800px]">
            <thead class="bg-surface-container-lowest border-b border-outline-variant">
                <tr>
                    <th class="px-6 py-4 font-label text-on-surface-variant">UTILISATEUR</th>
                    <th class="px-6 py-4 font-label text-on-surface-variant">RÔLE</th>
                    <th class="px-6 py-4 font-label text-on-surface-variant">ARTICLES</th>
                    <th class="px-6 py-4 font-label text-on-surface-variant">VUES</th>
                    <th class="px-6 py-4 font-label text-on-surface-variant">SCORE SEO</th>
                    <th class="px-6 py-4 font-label text-on-surface-variant">INSCRIT LE</th>
                    <th class="px-6 py-4 font-label text-on-surface-variant text-right">ACTIONS</th>
                </tr>
            </thead>
            <tbody id="usersTableBody" class="divide-y divide-outline-variant">
                @foreach($users as $user)
                <tr class="user-row hover:bg-surface-container-low transition-colors" 
                    data-id="{{ $user->id }}"
                    data-name="{{ strtolower($user->name) }}"
                    data-email="{{ strtolower($user->email) }}"
                    data-role="{{ $user->role }}"
                    data-articles="{{ $user->articles_count ?? 0 }}">
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-full bg-primary-fixed flex items-center justify-center">
                                <span class="text-primary font-bold text-sm">{{ strtoupper(substr($user->name, 0, 1)) }}</span>
                            </div>
                            <div>
                                <p class="font-body text-on-surface font-semibold">{{ $user->name }}</p>
                                <p class="text-body-sm text-on-surface-variant">{{ $user->email }}</p>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <span class="role-badge px-3 py-1 rounded-full text-xs font-semibold 
                            {{ $user->role === 'admin' ? 'bg-primary-fixed text-primary' : 'bg-secondary-container text-secondary' }}">
                            {{ ucfirst($user->role) }}
                        </span>
                    </td>
                    <td class="px-6 py-4 font-body text-on-surface">{{ $user->articles_count ?? 0 }}</td>
                    <td class="px-6 py-4 text-on-surface-variant">{{ number_format($user->articles_sum_views ?? 0) }}</td>
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-2">
                            <div class="w-16 h-1.5 bg-surface-container-high rounded-full overflow-hidden">
                                <div class="h-full bg-secondary rounded-full" 
                                     style="width: {{ min(100, $user->articles_avg_seo_score ?? 0) }}%"></div>
                            </div>
                            <span class="text-xs font-medium text-secondary">{{ round($user->articles_avg_seo_score ?? 0) }}</span>
                        </div>
                    </td>
                    <td class="px-6 py-4 text-sm text-on-surface-variant">{{ $user->created_at->format('d M Y') }}</td>
                    <td class="px-6 py-4 text-right">
                        <div class="flex justify-end gap-1">
                            <button onclick="viewUser({{ $user->id }})" 
                                    class="p-2 text-on-surface-variant hover:text-primary rounded-lg transition-colors" 
                                    title="Voir détails">
                                <span class="material-symbols-outlined text-lg">visibility</span>
                            </button>
                            
                            <button onclick="toggleRole({{ $user->id }}, '{{ $user->role }}')" 
                                    class="p-2 text-on-surface-variant hover:text-primary rounded-lg transition-colors" 
                                    title="Changer rôle">
                                <span class="material-symbols-outlined text-lg">admin_panel_settings</span>
                            </button>
                            
                            @if($user->id !== Auth::id())
                            <button onclick="deleteUser({{ $user->id }}, '{{ addslashes($user->name) }}')" 
                                    class="p-2 text-on-surface-variant hover:text-error rounded-lg transition-colors" 
                                    title="Supprimer">
                                <span class="material-symbols-outlined text-lg">delete</span>
                            </button>
                            @endif
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="p-4 border-t border-outline-variant bg-surface-container-lowest flex justify-between items-center flex-wrap gap-3">
        <p class="text-body-sm text-on-surface-variant">
            Affichage de {{ $users->firstItem() }}-{{ $users->lastItem() }} sur {{ $users->total() }} utilisateurs
        </p>
        <div>
            {{ $users->links() }}
        </div>
    </div>
</div>

<!-- ====================== MODALE DÉTAILS UTILISATEUR ====================== -->
<div id="userModal" class="fixed inset-0 bg-black/50 flex items-center justify-center z-50 hidden">
    <div class="bg-surface-container-lowest rounded-2xl w-full max-w-md mx-4 shadow-2xl">
        <div class="flex justify-between items-center p-5 border-b border-outline-variant">
            <h3 class="text-xl font-bold text-on-surface">Détails utilisateur</h3>
            <button onclick="closeUserModal()" class="text-on-surface-variant hover:text-primary transition-colors">
                <span class="material-symbols-outlined">close</span>
            </button>
        </div>
        <div id="userDetails" class="p-5 space-y-4">
            <!-- Contenu dynamique -->
        </div>
        <div class="flex justify-end p-5 border-t border-outline-variant">
            <button onclick="closeUserModal()" class="px-4 py-2 border border-outline-variant rounded-lg text-on-surface-variant hover:bg-surface-container-low transition-colors">
                Fermer
            </button>
        </div>
    </div>
</div>

<!-- ====================== MODALE AJOUT UTILISATEUR ====================== -->
<div id="addUserModal" class="fixed inset-0 bg-black/50 flex items-center justify-center z-50 hidden">
    <div class="bg-surface-container-lowest rounded-2xl w-full max-w-lg mx-4 shadow-2xl">
        <div class="flex justify-between items-center p-5 border-b border-outline-variant">
            <h3 class="text-xl font-bold text-on-surface">Ajouter un utilisateur</h3>
            <button onclick="closeAddUserModal()" class="text-on-surface-variant hover:text-primary transition-colors">
                <span class="material-symbols-outlined">close</span>
            </button>
        </div>

        <form id="addUserForm" class="p-5 space-y-5">
            @csrf
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-on-surface-variant mb-1">Nom complet</label>
                    <input type="text" id="name" name="name" required
                           class="w-full px-4 py-2 border border-outline-variant rounded-lg focus:ring-1 focus:ring-primary focus:border-primary outline-none">
                </div>
                <div>
                    <label class="block text-sm font-medium text-on-surface-variant mb-1">Email</label>
                    <input type="email" id="email" name="email" required
                           class="w-full px-4 py-2 border border-outline-variant rounded-lg focus:ring-1 focus:ring-primary focus:border-primary outline-none">
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-on-surface-variant mb-1">Mot de passe</label>
                <input type="password" id="password" name="password" required minlength="8"
                       class="w-full px-4 py-2 border border-outline-variant rounded-lg focus:ring-1 focus:ring-primary focus:border-primary outline-none">
                <p class="text-xs text-on-surface-variant mt-1">Minimum 8 caractères</p>
            </div>

            <div>
                <label class="block text-sm font-medium text-on-surface-variant mb-1">Rôle</label>
                <select id="role" name="role" class="w-full px-4 py-2 border border-outline-variant rounded-lg focus:ring-1 focus:ring-primary focus:border-primary outline-none">
                    <option value="user">Utilisateur</option>
                    <option value="admin">Administrateur</option>
                </select>
            </div>

            <div class="flex justify-end gap-3 pt-4 border-t border-outline-variant">
                <button type="button" onclick="closeAddUserModal()" 
                        class="px-5 py-2 border border-outline-variant rounded-lg text-on-surface-variant hover:bg-surface-container-low transition-colors">
                    Annuler
                </button>
                <button type="submit"
                        class="px-5 py-2 bg-primary text-white rounded-lg hover:opacity-90 transition-colors">
                    Créer l'utilisateur
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    // ====================== FONCTIONS GLOBALES ======================
    let searchTimeout;

    function showToast(type, message) {
        const toast = document.createElement('div');
        toast.className = `fixed bottom-4 right-4 px-6 py-3 rounded-xl text-white z-[100] shadow-xl transition-all ${
            type === 'success' ? 'bg-green-600' : 'bg-red-600'
        }`;
        toast.innerHTML = message;
        document.body.appendChild(toast);

        setTimeout(() => {
            toast.style.opacity = '0';
            setTimeout(() => toast.remove(), 400);
        }, 3000);
    }

    // ====================== FILTRES & RECHERCHE AVEC DEBOUNCE ======================
    function filterUsers() {
        const search = document.getElementById('searchUsers')?.value.toLowerCase() || '';
        const role = document.getElementById('roleFilter')?.value || 'all';
        
        let visibleCount = 0;
        document.querySelectorAll('#usersTableBody .user-row').forEach(row => {
            const name = row.dataset.name || '';
            const email = row.dataset.email || '';
            const rowRole = row.dataset.role || '';
            
            const matchesSearch = name.includes(search) || email.includes(search);
            const matchesRole = role === 'all' || rowRole === role;
            const visible = matchesSearch && matchesRole;
            
            row.style.display = visible ? '' : 'none';
            if (visible) visibleCount++;
        });
        
        document.getElementById('totalUsers').innerText = visibleCount;
    }

    // Debounce pour la recherche
    document.getElementById('searchUsers')?.addEventListener('input', function() {
        clearTimeout(searchTimeout);
        searchTimeout = setTimeout(() => filterUsers(), 300);
    });
    
    document.getElementById('roleFilter')?.addEventListener('change', filterUsers);

    // ====================== MODALE AJOUT UTILISATEUR ======================
    function showAddUserModal() {
        document.getElementById('addUserModal').classList.remove('hidden');
        document.getElementById('addUserForm').reset();
    }

    function closeAddUserModal() {
        document.getElementById('addUserModal').classList.add('hidden');
    }

    document.getElementById('addUserForm').addEventListener('submit', async function(e) {
        e.preventDefault();
        
        const submitBtn = this.querySelector('button[type="submit"]');
        const originalHtml = submitBtn.innerHTML;
        submitBtn.innerHTML = '<span class="material-symbols-outlined animate-spin">progress_activity</span> Création...';
        submitBtn.disabled = true;

        const formData = {
            name: document.getElementById('name').value.trim(),
            email: document.getElementById('email').value.trim(),
            password: document.getElementById('password').value,
            role: document.getElementById('role').value
        };

        try {
            const response = await fetch('{{ route("admin.users.store") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify(formData)
            });

            const data = await response.json();

            if (response.ok && data.success) {
                showToast('success', `✅ Utilisateur "${formData.name}" créé avec succès !`);
                closeAddUserModal();
                setTimeout(() => location.reload(), 1200);
            } else {
                showToast('error', data.message || data.error || 'Erreur lors de la création');
            }
        } catch (error) {
            console.error(error);
            showToast('error', 'Erreur de connexion au serveur');
        } finally {
            submitBtn.innerHTML = originalHtml;
            submitBtn.disabled = false;
        }
    });

    // ====================== VOIR DÉTAILS ======================
    async function viewUser(userId) {
        try {
            const response = await fetch(`/admin/users/${userId}/details`);
            const user = await response.json();

            document.getElementById('userDetails').innerHTML = `
                <div class="flex items-center gap-4 pb-4 border-b">
                    <div class="w-16 h-16 rounded-full bg-primary-fixed flex items-center justify-center">
                        <span class="text-3xl font-bold text-primary">${user.name?.charAt(0) || 'U'}</span>
                    </div>
                    <div>
                        <p class="font-bold text-xl">${user.name}</p>
                        <p class="text-on-surface-variant">${user.email}</p>
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-4 mt-6">
                    <div class="bg-surface-container-low p-4 rounded-xl text-center">
                        <p class="text-3xl font-bold text-primary">${user.articles_count || 0}</p>
                        <p class="text-sm text-on-surface-variant">Articles</p>
                    </div>
                    <div class="bg-surface-container-low p-4 rounded-xl text-center">
                        <p class="text-3xl font-bold text-secondary">${user.total_views || 0}</p>
                        <p class="text-sm text-on-surface-variant">Vues</p>
                    </div>
                    <div class="bg-surface-container-low p-4 rounded-xl text-center">
                        <p class="text-3xl font-bold">${user.avg_seo_score || 0}</p>
                        <p class="text-sm text-on-surface-variant">Score SEO</p>
                    </div>
                    <div class="bg-surface-container-low p-4 rounded-xl text-center">
                        <p class="text-3xl font-bold">${user.role}</p>
                        <p class="text-sm text-on-surface-variant">Rôle</p>
                    </div>
                </div>
                <div class="pt-2 text-sm text-on-surface-variant">
                    <p>📅 Inscrit le ${new Date(user.created_at).toLocaleDateString('fr-FR')}</p>
                    <p>🕐 Dernière activité: ${user.last_activity || 'N/A'}</p>
                </div>
            `;
            document.getElementById('userModal').classList.remove('hidden');
        } catch (error) {
            console.error('Error:', error);
            showToast('error', 'Impossible de charger les détails');
        }
    }

    function closeUserModal() {
        document.getElementById('userModal').classList.add('hidden');
    }

    // ====================== CHANGER RÔLE ======================
    async function toggleRole(userId, currentRole) {
        const newRole = currentRole === 'admin' ? 'user' : 'admin';
        if (!confirm(`Changer le rôle de cet utilisateur en "${newRole}" ?`)) return;

        try {
            const response = await fetch(`/admin/users/${userId}/role`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({ role: newRole })
            });

            const data = await response.json();

            if (response.ok && data.success) {
                showToast('success', `Rôle changé en "${newRole}" avec succès`);
                setTimeout(() => location.reload(), 800);
            } else {
                showToast('error', data.error || 'Erreur lors du changement de rôle');
            }
        } catch (error) {
            console.error('Error:', error);
            showToast('error', 'Erreur de connexion');
        }
    }

    // ====================== SUPPRIMER UTILISATEUR ======================
    async function deleteUser(userId, userName) {
        if (!confirm(`⚠️ Supprimer définitivement "${userName}" ?\n\nCette action est irréversible.`)) return;

        const btn = event.currentTarget;
        const originalHtml = btn.innerHTML;
        btn.innerHTML = '<span class="material-symbols-outlined animate-spin">progress_activity</span>';
        btn.disabled = true;

        try {
            const response = await fetch(`/admin/users/${userId}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            });

            const data = await response.json();

            if (response.ok && data.success) {
                const row = document.querySelector(`.user-row[data-id="${userId}"]`);
                if (row) {
                    row.style.transition = 'all 0.3s ease';
                    row.style.opacity = '0';
                    row.style.transform = 'translateX(20px)';
                    setTimeout(() => {
                        row.remove();
                        showToast('success', `Utilisateur "${userName}" supprimé avec succès`);
                        filterUsers(); // Mettre à jour le compteur
                    }, 300);
                } else {
                    location.reload();
                }
            } else {
                showToast('error', data.error || 'Erreur lors de la suppression');
            }
        } catch (error) {
            console.error('Error:', error);
            showToast('error', 'Erreur de connexion');
        } finally {
            btn.innerHTML = originalHtml;
            btn.disabled = false;
        }
    }

    // ====================== EXPORT CSV ======================
    function exportUsers() {
        window.location.href = '/admin/users/export';
    }

    // ====================== INITIALISATION ======================
    document.addEventListener('DOMContentLoaded', function() {
        // Filtre initial
        filterUsers();
    });
</script>