<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleAuthController extends Controller
{
    public function redirect(): RedirectResponse
    {
        return Socialite::driver('google')->stateless()->redirect();
    }

    public function callback(): Redirector|Application|RedirectResponse
    {
        $user = Socialite::driver('google')->stateless()->user();
        $user = User::query()->updateOrCreate([
            'provider_id' => $user->id,
            'provider' => 'google',
        ], [
            'name' => $user->name,
            'email' => $user->email,
        ]);

        Auth::login($user);

        return redirect(config('app.url').'/login-redirect?token='.$user->createToken('google')->plainTextToken);
    }
}
