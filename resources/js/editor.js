// resources/js/editor.js

import EditorJS from '@editorjs/editorjs';
import Header from '@editorjs/header';
import List from '@editorjs/list';
import ImageTool from '@editorjs/image';
import Paragraph from '@editorjs/paragraph';
import Table from '@editorjs/table';
import LinkTool from '@editorjs/link';
import Quote from '@editorjs/quote';
import Marker from '@editorjs/marker';
import Checklist from '@editorjs/checklist';

console.log('📝 Editor.js chargé !');

class ArticleEditor {
    constructor(containerId, options = {}) {
        this.containerId = containerId;
        this.options = options;
        this.editor = null;
        this.autosaveTimer = null;
        this.init();
    }

    init() {
        const container = document.getElementById(this.containerId);
        if (!container) {
            console.warn('Conteneur #' + this.containerId + ' non trouvé');
            return;
        }

        console.log('🚀 Initialisation de Editor.js...');

        // Récupérer les données initiales
        let initialData = null;
        const dataAttr = container.dataset.content;
        if (dataAttr && dataAttr !== 'null' && dataAttr !== 'undefined' && dataAttr !== '') {
            try {
                initialData = JSON.parse(dataAttr);
            } catch (e) {
                console.warn('Données initiales JSON invalides, utilisation du contenu par défaut');
                initialData = null;
            }
        }

        // Normalisation du format Editor.js
        if (!initialData || !Array.isArray(initialData.blocks)) {
            const title = document.getElementById('articleTitle')?.value || 'Titre de l\'article';
            initialData = {
                blocks: [
                    {
                        type: 'header',
                        data: {
                            text: title,
                            level: 1
                        }
                    },
                    {
                        type: 'paragraph',
                        data: {
                            text: 'Commencez à rédiger votre article ici...'
                        }
                    }
                ]
            };
        }


        this.editor = new EditorJS({
            holder: this.containerId,
            placeholder: this.options.placeholder || 'Commencez à écrire votre article...',
            tools: {
                header: {
                    class: Header,
                    inlineToolbar: true,
                    config: {
                        levels: [1, 2, 3, 4],
                        defaultLevel: 2,
                    }
                },
                list: {
                    class: List,
                    inlineToolbar: true,
                },
                paragraph: {
                    class: Paragraph,
                    inlineToolbar: true,
                },
                image: {
                    class: ImageTool,
                    config: {
                        endpoints: {
                            byFile: '/api/editor/upload',
                        },
                        field: 'image',
                        types: 'image/*',
                        additionalRequestHeaders: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
                        }
                    }
                },
                table: {
                    class: Table,
                    inlineToolbar: true,
                },
                linkTool: {
                    class: LinkTool,
                    config: {
                        endpoint: '/api/editor/fetch-url',
                    }
                },
                quote: {
                    class: Quote,
                    inlineToolbar: true,
                },
                marker: {
                    class: Marker,
                },
                checklist: {
                    class: Checklist,
                    inlineToolbar: true,
                }
            },
            data: initialData,
            onChange: () => {
                this.handleAutosave();
                this.updateSeoAnalysis();
            }
        });

        console.log('✅ Editor.js initialisé avec succès !');
        
        // Mettre à jour l'analyse SEO initiale
        setTimeout(() => this.updateSeoAnalysis(), 1000);
    }

    async handleAutosave() {
        if (this.autosaveTimer) {
            clearTimeout(this.autosaveTimer);
        }

        this.autosaveTimer = setTimeout(async () => {
            await this.save();
        }, 3000);
    }

    async save() {
        try {
            const outputData = await this.editor.save();
            console.log('💾 Sauvegarde automatique...');

            const response = await fetch('/api/editor/autosave', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
                },
                body: JSON.stringify({
                    content: outputData,
                    article_id: this.options.articleId || null
                })
            });

            if (response.ok) {
                const result = await response.json();
                this.updateStatus('✅ Sauvegardé à ' + new Date().toLocaleTimeString());
                if (result.article_id) {
                    this.options.articleId = result.article_id;
                }
            }
        } catch (error) {
            console.error('❌ Erreur de sauvegarde:', error);
            this.updateStatus('❌ Erreur de sauvegarde', 'error');
        }
    }

    async getContent() {
        try {
            return await this.editor.save();
        } catch (error) {
            console.error('Erreur récupération contenu:', error);
            return null;
        }
    }

    async updateSeoAnalysis() {
        try {
            const content = await this.getContent();
            const title = document.getElementById('articleTitle')?.value || '';
            const keyword = document.getElementById('keywordInput')?.value || '';
            const metaDesc = document.getElementById('metaDescription')?.value || '';

            // Extraire le texte du contenu
            let textContent = '';
            if (content && content.blocks) {
                textContent = content.blocks
                    .filter(block => block.data && block.data.text)
                    .map(block => block.data.text)
                    .join(' ');
            }

            const response = await fetch('/api/seo/analyze', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
                },
                body: JSON.stringify({
                    content: textContent,
                    title: title,
                    keyword: keyword,
                    meta_description: metaDesc
                })
            });

            if (response.ok) {
                const result = await response.json();
                this.updateSeoDisplay(result.data);
            }
        } catch (error) {
            console.error('Erreur analyse SEO:', error);
        }
    }

    updateSeoDisplay(data) {
        // Mettre à jour le score
        const score = data.score || 0;
        const grade = data.grade || 'F';
        
        document.getElementById('seoScore').textContent = score;
        document.getElementById('seoGrade').textContent = grade;

        // Mettre à jour le cercle
        const circumference = 251;
        const offset = circumference - (score / 100) * circumference;
        const circle = document.getElementById('seoCircle');
        if (circle) {
            circle.style.strokeDashoffset = offset;
        }

        // Mettre à jour les points positifs
        const successesEl = document.getElementById('seoSuccesses');
        if (successesEl && data.successes) {
            successesEl.innerHTML = data.successes.map(s => `<div>✅ ${s}</div>`).join('');
        }

        // Mettre à jour les suggestions
        const issuesEl = document.getElementById('seoIssues');
        if (issuesEl && data.issues) {
            issuesEl.innerHTML = data.issues.map(s => `<div>⚠️ ${s}</div>`).join('');
        }
    }

    updateStatus(message, type = 'success') {
        const statusEl = document.getElementById('editorStatus');
        if (statusEl) {
            statusEl.textContent = message;
            statusEl.className = 'text-sm ' + (type === 'success' ? 'text-green-600' : 'text-red-600');
        }
    }

    destroy() {
        if (this.editor) {
            this.editor.destroy();
        }
    }
}

// Initialisation automatique au chargement de la page
document.addEventListener('DOMContentLoaded', function() {
    const editorContainer = document.getElementById('editorjs');
    if (editorContainer) {
        const articleId = editorContainer.dataset.articleId || null;
        
        window.articleEditor = new ArticleEditor('editorjs', {
            articleId: articleId,
            placeholder: 'Commencez à rédiger votre article...'
        });

        // Écouter les changements du titre pour mettre à jour le SEO
        document.getElementById('articleTitle')?.addEventListener('input', function() {
            if (window.articleEditor) {
                window.articleEditor.updateSeoAnalysis();
            }
        });

        document.getElementById('keywordInput')?.addEventListener('input', function() {
            if (window.articleEditor) {
                window.articleEditor.updateSeoAnalysis();
            }
        });

        document.getElementById('metaDescription')?.addEventListener('input', function() {
            if (window.articleEditor) {
                window.articleEditor.updateSeoAnalysis();
            }
        });
    }
});

export default ArticleEditor;