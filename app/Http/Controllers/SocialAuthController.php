<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{SocialAuth, User};

class SocialAuthController extends Controller
{
    public function facebookRedirect($provider)
    {
        return \Socialite::driver($provider)->redirect();
    }

    public function facebookCallback($provider)
    {
        $user = \Socialite::driver($provider)->user();
        $social = SocialAuth::where('provider', $provider)
            ->where('social_id', $user->id)
            ->first();

        if ($social) {
            $social->user->photo = $user->avatar;
            $social->user->save();
            auth()->login($social->user);
            return redirect()->to('/');
        }

        $localUser = User::where('email', $user->email)->first();

        if ($localUser) {
            $localUser->photo = $user->avatar;
            $localUser->save();
            auth()->login($localUser);
            return redirect()->to('/');
        }

        $newUser = new User;
        $newUser->name = $user->name;
        $newUser->photo = $user->avatar;
        $newUser->email = $user->email;
        $newUser->password = md5($user->id);
        $newUser->save();

        $newSocial = new SocialAuth;
        $newSocial->avatar = $user->avatar;
        $newSocial->social_id = $user->id;
        $newSocial->provider = $provider;
        $newSocial->user()->associate($newUser);
        $newSocial->save();

        auth()->login($newUser);

        return redirect()->to('/');
    }
}
