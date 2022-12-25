<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GithubAuthController extends Controller
{
    public function redirect(): RedirectResponse
    {
        return Socialite::driver('github')->stateless()->redirect();
    }

    public function callback(): Redirector|Application|RedirectResponse
    {
        $user = Socialite::driver('github')->stateless()->user();
        $user = User::query()->updateOrCreate([
            'provider_id' => $user->id,
            'provider' => 'github',
        ], [
            'name' => $user->name,
            'email' => $user->email,
        ]);

        Auth::login($user);
        return redirect(config('app.url') . '/login-redirect?token=' . $user->createToken('github')->plainTextToken);
    }
}
