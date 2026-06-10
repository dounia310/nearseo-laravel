<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        // Récupérer toutes les notifications
        $notifications = Notification::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->paginate(20);
        
        // Compter les notifications non lues
        $unreadCount = Notification::where('user_id', $user->id)
            ->where('is_read', false)
            ->count();
        
        // Compter les mentions (notifications de type 'mention')
        $mentionsCount = Notification::where('user_id', $user->id)
            ->where('type', 'mention')
            ->count();
        
        // Statistiques pour l'insight
        $stats = [
            'visibility_growth' => 12
        ];
        
        return view('dashboard.notifications', compact('notifications', 'unreadCount', 'mentionsCount', 'stats'));
    }
    
    public function markAsRead(Notification $notification)
    {
        if ($notification->user_id !== Auth::id()) {
            abort(403);
        }
        
        $notification->update(['is_read' => true]);
        
        return response()->json(['success' => true]);
    }
    
    public function markAllAsRead(Request $request)
    {
        Notification::where('user_id', Auth::id())
            ->where('is_read', false)
            ->update(['is_read' => true]);
            
        return response()->json(['success' => true]);
    }
}