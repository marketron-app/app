<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use Ramsey\Uuid\Uuid;

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
            'email' => $user->email,
        ], [
            'name' => $user->name,
            'provider_id' => $user->id,
            'provider' => 'github',
            'password' => Hash::make(Uuid::uuid4())
        ]);

        Auth::login($user);

        return redirect("/");
    }
}
