<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Exception;

class GoogleAuthController extends Controller
{
    /**
     * Redirect to Google OAuth
     */
    public function redirectToGoogle()
    {
        try {
            // Gunakan stateless() untuk API
            $url = Socialite::driver('google')
                ->stateless()
                ->redirect()
                ->getTargetUrl();

            return redirect($url);

        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to redirect to Google',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Handle Google OAuth callback
     */
    public function handleGoogleCallback()
    {
        try {
            // Gunakan stateless() untuk API
            $googleUser = Socialite::driver('google')
                ->stateless()
                ->user();

            $user = User::where('email', $googleUser->email)->first();

            if ($user) {
                $user->update([
                    'google_id' => $googleUser->id,
                    'avatar' => $googleUser->avatar,
                    'provider' => 'google',
                ]);
            } else {
                $user = User::create([
                    'name' => $googleUser->name,
                    'email' => $googleUser->email,
                    'google_id' => $googleUser->id,
                    'avatar' => $googleUser->avatar,
                    'provider' => 'google',
                    'email_verified_at' => now(),999
                ]);
            }

            $token = $user->createToken('google_auth_token')->plainTextToken;

            // Redirect ke callback page
            return redirect()->to('/callback?token=' . $token);

        } catch (Exception $e) {
            return redirect()->to('/callback?message=' . urlencode($e->getMessage()));
        }
    }
}
