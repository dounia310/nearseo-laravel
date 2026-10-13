<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    /**
     * Render HTML page (Voir tout)
     */
    public function index()
    {
        $user = Auth::user();

        $notifications = Notification::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        $unreadCount = Notification::where('user_id', $user->id)
            ->where('is_read', false)
            ->count();

        $mentionsCount = Notification::where('user_id', $user->id)
            ->where('type', 'mention')
            ->count();

        $stats = [
            'visibility_growth' => 12
        ];

        return view('dashboard.notifications', compact('notifications', 'unreadCount', 'mentionsCount', 'stats'));
    }

    /**
     * Marquer une notification comme lue (AJAX)
     */
    public function markAsRead(Notification $notification)
    {
        if ($notification->user_id !== Auth::id()) {
            abort(403);
        }

        $notification->update(['is_read' => true]);

        return response()->json(['success' => true]);
    }

    /**
     * Marquer toutes les notifications comme lues (AJAX)
     */
    public function markAllAsRead(Request $request)
    {
        Notification::where('user_id', Auth::id())
            ->where('is_read', false)
            ->update(['is_read' => true]);
            
        return response()->json(['success' => true]);
    }

    /**
     * ✅ Retour JSON pour la modale (AJAX)
     * Inclut les URLs pour la redirection
     */
    public function data(Request $request)
    {
        $userId = Auth::id();

        $unreadCount = Notification::where('user_id', $userId)
            ->where('is_read', false)
            ->count();

        // ✅ Dernières notifications avec URLs
        $notifications = Notification::where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->limit(20) // ✅ Augmenté à 20 pour plus de contenu
            ->get()
            ->map(function (Notification $n) {
                // ✅ Construire l'URL de redirection
                $redirectUrl = null;
                
                // Si la notification a déjà une URL
                if (!empty($n->url)) {
                    $redirectUrl = $n->url;
                }
                // Si c'est une notification d'article publié
                elseif ($n->type === 'article_published' || $n->type === 'article_updated') {
                    $redirectUrl = $n->article_id ? '/articles/' . $n->article_id . '/edit' : null;
                }
                // Si c'est une notification de commentaire
                elseif ($n->type === 'comment') {
                    $redirectUrl = $n->article_id ? '/articles/' . $n->article_id . '#comment-' . $n->comment_id : null;
                }
                // Si c'est une notification de badge
                elseif ($n->type === 'badge_earned') {
                    $redirectUrl = '/profile';
                }
                // Fallback : utiliser l'ID de l'article
                elseif ($n->article_id) {
                    $redirectUrl = '/articles/' . $n->article_id . '/edit';
                }

                return [
                    'id' => $n->id,
                    'message' => (string) $n->message,
                    'created_at' => $n->created_at ? $n->created_at->diffForHumans() : null,
                    'is_read' => (bool) $n->is_read,
                    'icon' => $n->icon ?? $this->getIconForType($n->type),
                    'type' => $n->type ?? null,
                    'url' => $redirectUrl, // ✅ URL pour la redirection
                    'article_id' => $n->article_id, // ✅ Pour référence
                ];
            });

        return response()->json([
            'unread_count' => $unreadCount,
            'notifications' => $notifications,
        ]);
    }

    /**
     * ✅ Déterminer l'icône selon le type de notification
     */
    private function getIconForType(?string $type): string
    {
        return match ($type) {
            'article_published' => 'article',
            'article_updated' => 'edit_note',
            'comment' => 'comment',
            'mention' => 'alternate_email',
            'badge_earned' => 'stars',
            'like' => 'favorite',
            'follow' => 'person_add',
            default => 'notifications',
        };
    }

    /**
     * ✅ Créer une notification (helper pour les autres parties de l'app)
     */
    public static function createNotification(
        int $userId,
        string $message,
        string $type = 'general',
        ?int $articleId = null,
        ?string $url = null,
        ?string $icon = null
    ) {
        return Notification::create([
            'user_id' => $userId,
            'message' => $message,
            'type' => $type,
            'article_id' => $articleId,
            'url' => $url,
            'icon' => $icon ?? self::getIconForTypeStatic($type),
            'is_read' => false,
        ]);
    }

    /**
     * ✅ Version static pour l'helper
     */
    private static function getIconForTypeStatic(?string $type): string
    {
        return match ($type) {
            'article_published' => 'article',
            'article_updated' => 'edit_note',
            'comment' => 'comment',
            'mention' => 'alternate_email',
            'badge_earned' => 'stars',
            'like' => 'favorite',
            'follow' => 'person_add',
            default => 'notifications',
        };
    }
}