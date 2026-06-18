<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HelpController extends Controller
{
    public function index()
    {
        // Utiliser la vue dashboard.help
        return view('dashboard.help');
    }
    
    // Supprimez la méthode article() si elle existe
}