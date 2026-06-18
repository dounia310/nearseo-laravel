<?php
// app/Http/Controllers/TrendController.php

namespace App\Http\Controllers;

use App\Services\BusinessTrendService;
use Illuminate\Http\Request;

class TrendController extends Controller
{
    protected BusinessTrendService $trendService;

    public function __construct(BusinessTrendService $trendService)
    {
        $this->trendService = $trendService;
    }

    /**
     * Afficher la page des tendances
     */
    public function index()
    {
        $trends = $this->trendService->getCurrentTrends();
        
        return view('dashboard.trends.index', compact('trends'));
    }

    /**
     * API: Récupérer les tendances en JSON
     */
    public function getSuggestions(Request $request)
    {
        $suggestions = $this->trendService->getApiSuggestions();
        
        return response()->json($suggestions);
    }
}