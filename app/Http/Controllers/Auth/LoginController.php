<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Laravel\Socialite\Two\InvalidStateException;
use SocialiteProviders\Steam\OpenIDValidationException;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    //
    public function index()
    {
        return view('home');
    }

    public function logout(): RedirectResponse
    {
        // Logout and remove auth session
        auth()->logout();

        return redirect()->back();
    }

    public function steam()
    {
        // Steam Login
        session()->put('previous-url', url()->previous());
        return Socialite::driver('steam')->redirect();
    }

    public function steamRedirect()
    {
        try {
            $data = Socialite::driver('steam')->user();
        } catch (InvalidStateException | OpenIDValidationException $_) {
            return view('errors.loginerror', [
                'description' => 'Please try to login again.'
            ]);
        }

        $user = User::firstOrCreate(
            [
                'steamid' => $data->getId()
            ],
            [
                'name' => $data->getNickname(),
                'avatar' => $data->getAvatar(),
            ],
        );

        if (!$user->wasRecentlyCreated) {
            $user->update([
                'name' => $data->getNickname(),
                'avatar' => $data->getAvatar()
            ]);
        } else {
            $user->assignRole('user');
        }

        // why I need the boolean parameter here I have NO idea...
        // It fixed something that isn't "broken"
        auth()->login($user, true);

        return redirect()->to(
            session()->get('previous-url') ?: route('/')
        );
    }
}
