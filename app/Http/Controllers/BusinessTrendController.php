<?php
// app/Http/Controllers/BusinessTrendController.php

namespace App\Http\Controllers;

use App\Services\BusinessTrendService;
use Illuminate\Http\Request;

class BusinessTrendController extends Controller
{
    protected $trendService;

    public function __construct(BusinessTrendService $trendService)
    {
        $this->trendService = $trendService;
    }

    /**
     * Afficher les suggestions
     */
    public function index()
    {
        $user = auth()->user();
        $suggestions = $this->trendService->getSuggestionsForBusiness();
        $businessType = $user->business_type ?? 'general';
        
        return view('dashboard.trends.business', compact('suggestions', 'businessType', 'user'));
    }

    /**
     * API: Obtenir les suggestions
     */
    public function getSuggestions(Request $request)
    {
        $businessType = $request->input('business_type');
        return response()->json(
            $this->trendService->getApiSuggestions($businessType)
        );
    }

    /**
     * Mettre à jour le secteur d'activité
     */
    public function updateBusinessType(Request $request)
    {
        $validated = $request->validate([
            'business_type' => 'required|string|in:restaurant,hotel,coiffure,beaute,fleuriste,voyage,immobilier,auto,sante,fashion,general',
            'business_name' => 'nullable|string|max:255',
            'business_address' => 'nullable|string|max:255',
        ]);
        
        $user = auth()->user();
        $user->update($validated);
        
        return response()->json([
            'success' => true,
            'message' => 'Secteur d\'activité mis à jour'
        ]);
    }
}