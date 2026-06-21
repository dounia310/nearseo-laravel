// resources/js/share-modal.js

document.addEventListener('DOMContentLoaded', function() {
    console.log('✅ share-modal.js chargé');
    
    // Vérifier que l'élément existe avant d'ajouter l'écouteur
    const shareModal = document.getElementById('shareModal');
    if (shareModal) {
        const closeBtn = shareModal.querySelector('[data-close-modal]');
        if (closeBtn) {
            closeBtn.addEventListener('click', function() {
                shareModal.classList.add('hidden');
            });
        }
    }
    
    // Gérer les boutons de partage
    const shareButtons = document.querySelectorAll('[data-share]');
    if (shareButtons.length > 0) {
        shareButtons.forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                const url = this.dataset.url || window.location.href;
                const title = this.dataset.title || document.title;
                
                if (navigator.share) {
                    navigator.share({ title, url }).catch(() => {});
                } else {
                    navigator.clipboard.writeText(url).then(() => {
                        alert('Lien copié !');
                    }).catch(() => {
                        prompt('Copiez ce lien :', url);
                    });
                }
            });
        });
    }
});