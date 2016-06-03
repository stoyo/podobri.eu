<?php namespace Podobri\Http\Controllers;

use Socialite;
use Illuminate\Http\Request;

class FacebookController extends Controller {
		
    // Facebook authentication

    public function getSocialAuth() {
        return Socialite::driver('facebook')->redirect();
    }

    public function getSocialAuthCallback(Request $request) {
        if($request->error=='access_denied'){
            return redirect()->route('auth.signup')
                    ->with('info', 'Неуспешно извличане на данни от вашия Facebook профил.');
        }
        try {
            $user = Socialite::driver('facebook')->user();
        } catch (Exception $e) {
            return abort(404);
        }
        
        $fbuser_email = isset($user->user['email']) ?$user->user['email']: "";
              
        return redirect()->route('auth.signup')
                ->with('first_name', $user->user['first_name'])
                ->with('last_name' ,$user->user['last_name'])
                ->with('email', $fbuser_email);
    }
    

}
