<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\RedirectResponse;

class VerifyEmailController extends Controller
{
    /**
     * Mark the authenticated user's email address as verified.
     */
    public function __invoke(EmailVerificationRequest $request): RedirectResponse
    {
        // "Already verified": keep a safe UX and redirect to login.
        if ($request->user()->hasVerifiedEmail()) {
            return redirect()->route('login')->with('status', __('Votre email est déjà vérifié.'));
        }

        if ($request->user()->markEmailAsVerified()) {
            event(new Verified($request->user()));
        }

        // After verification, redirect to login (as requested).
        return redirect()->route('login')->with('status', __('Votre email a bien été vérifié.'));
    }
}

