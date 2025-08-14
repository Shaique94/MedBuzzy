<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use Exception;
use Illuminate\Support\Str;
use Illuminate\Http\Request;


class SocialiteController extends Controller
{
    /**
     * Redirect the user to the Google authentication page.
     */
    public function redirectToGoogle(Request $request)
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Obtain the user information from Google.
     */
    public function handleGoogleCallback(Request $request)
    {
        try {
            $googleUser = Socialite::driver('google')->user();
            
            \Log::info('Google OAuth callback received', [
                'google_user_id' => $googleUser->id,
                'email' => $googleUser->email,
                'name' => $googleUser->name
            ]);
            
            // Check if user exists by google_id first
            $user = User::where('google_id', $googleUser->id)->first();

            if ($user) {
                \Log::info('Existing Google user found, logging in', ['user_id' => $user->id]);
                Auth::login($user);
            } else {
                // Check if user exists by email
                $existingUser = User::where('email', $googleUser->email)->first();
                
                if ($existingUser) {
                    \Log::info('Existing user found by email, linking Google account', ['user_id' => $existingUser->id]);
                    // Update existing user with Google ID
                    $existingUser->update([
                        'google_id' => $googleUser->id,
                        'avatar' => $googleUser->avatar,
                        'email_verified_at' => now(),
                    ]);
                    Auth::login($existingUser);
                } else {
                    \Log::info('Creating new user from Google OAuth');
                    // Create new user
                    $user = User::create([
                        'name' => $googleUser->name,
                        'email' => $googleUser->email,
                        'avatar' => $googleUser->avatar,
                        'password' => Hash::make(Str::random(24)), // Secure random password   
                        'google_id' => $googleUser->id,
                        'role' => 'patient', // Set default role for Google users
                        'email_verified_at' => now(), // Mark email as verified for Google users
                    ]);
                    \Log::info('New user created successfully', ['user_id' => $user->id]);
                    Auth::login($user);
                }
            }

            \Log::info('Google OAuth login successful, redirecting to hero page');
            return redirect()->route('hero');

        } catch (Exception $e) {
            \Log::error('Google OAuth failed', [
                'error' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString()
            ]);
            return redirect('/login')->with('error', 'Failed to login with Google: ' . $e->getMessage());
        }
    }
}
