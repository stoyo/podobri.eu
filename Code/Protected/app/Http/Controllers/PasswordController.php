<?php namespace Podobri\Http\Controllers;

use Illuminate\Http\Request;
use Podobri\Models\User;
use Mail;
use Podobri\Models\Password_reset;

class PasswordController extends Controller{
    
    public function getEmail(){
        return view('auth.email')
            ->with('title', 'Забравена парола | Подобри')
            ->with('description', 'Страница за възстановяване на парола. Нуждаем се само от електронната ви поща.');
    }
    
    public function postEmail(Request $request){
        $this->validate($request, [
            'email'=>'required|email',
        ]);
        
        $user = User::where('email', $request->input('email'))->first();
        
        if(!$user){
            return redirect()->back()->with('info', 'Няма потребител с въведената електронна поща.');
        }
        
        $token=str_random(40);
        
        $previous_reset = Password_reset::where('email', $request->input('email'))->first();
        
        if($previous_reset){
            
            $previous_reset->update([
               'token' => $token,
            ]);
            
        }else{
            
            Password_reset::create([
               'email' => $request->input('email'),
               'token' => $token,
            ]);
            
        }
        
        Mail::send('emails.forgottenpass', ['user' => $user, 'token'=>$token], function ($m) use ($user) {
            $m->getHeaders()->addTextHeader('X-MC-Tags', 'Забравена парола'); 
            $m->from('podobri.eu@abv.bg', 'podobri.eu@abv.bg');
            $m->to($user->email, $user->first_name.' '.$user->last_name)->subject('Забравена парола');
        });
        
        return redirect()->back()->with('info', 'Успешно изпратена заявка. Проверете електронната си поща.');
    }
    
    public function getReset($token){
        
        $password_reset = Password_reset::where('token', $token)->first();
        
        if(!$password_reset){
            abort(404);
        }
        
        return view('auth.password')
                ->with('title', 'Избиране на нова парола | Подобри')
                ->with('description', 'Страница за въвеждане на нова парола.');
        
    }
    
    public function postReset(Request $request){
        
        $password_reset = Password_reset::where('token', $request->input('token_for_email'))->first();
        
        if(!$password_reset){
            abort(404);
        }
        
        $email=$password_reset->email;
        
        $this->validate($request, [
           'password'=>'required|min:6|same:repassword',
           'repassword'=>'required|min:6|same:password', 
        ]);
        
        $password_reset->delete();
        
        User::where('email', $email)->first()->update([
            'password' => bcrypt($request->input('password')),
        ]);
        
        return redirect()->route('auth.signin')
                ->with('info', 'Успешно подновяване на парола. Защо не влезете в профила си?');
        
    }
    
}