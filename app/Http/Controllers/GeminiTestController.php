<?php

namespace App\Http\Controllers;

use App\Services\GeminiService;
use Illuminate\Http\Request;

class GeminiTestController extends Controller
{
    public function testConnection(GeminiService $gemini)
    {
        $result = $gemini->checkConnection();

        return response()->json([
            'success' => (bool) ($result['success'] ?? false),
            'message' => $result['message'] ?? null,
            'code' => $result['code'] ?? null,
        ], 200);
    }
}
