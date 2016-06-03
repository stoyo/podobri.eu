<?php namespace Podobri\Http\Controllers;

use Socialite;
use Illuminate\Http\Request;

class TwitterController extends Controller {

    // Twitter authentication

    public function getSocialAuth() {
        return Socialite::driver('twitter')->redirect();
    }

    public function getSocialAuthCallback(Request $request) {
        if($request->denied){
            return redirect()->route('auth.signup')
                    ->with('info', 'Неуспешно извличане на данни от вашия Twitter профил.');
        }
        try {
            $user = Socialite::driver('twitter')->user();
        } catch (Exception $e) {
            return abort(404);
        }
        
        $name = explode(' ' ,$user->name);
        
        $first_name=isset($name[0]) ?$name[0]: "";
        $last_name=isset($name[1]) ?$name[1]: "";
        
        return redirect()->route('auth.signup')
                ->with('first_name', $first_name)
                ->with('last_name' ,$last_name)
                ->with('email', $user->email);
    }
    

}
