<?php namespace Podobri\Http\Controllers;

use Socialite;
use Illuminate\Http\Request;

class GoogleController extends Controller {

    // Google+ authentication
    
    public function getSocialAuth() {
        return Socialite::driver('google')->redirect();
    }

    public function getSocialAuthCallback(Request $request) {
        if($request->error=='access_denied'){
            return redirect()->route('auth.signup')
                    ->with('info', 'Неуспешно извличане на данни от вашия Google+ профил.');
        }
        try {
            $user = Socialite::driver('google')->user();
        } catch (Exception $e) {
            return abort(404);
        }
        
        return redirect()->route('auth.signup')
                ->with('first_name', ucfirst($user->user['name']['givenName']))
                ->with('last_name' ,ucfirst($user->user['name']['familyName']))
                ->with('email', $user->email);
    }
    

}
