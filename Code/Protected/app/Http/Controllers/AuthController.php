<?php namespace Podobri\Http\Controllers;

use Auth;
use Podobri\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller{
    
    public function getSignin(){
        return view('auth.signin')
                ->with('title', 'Вход | Подобри')
                ->with('description', 'Вход в системата на Подобри');
    }
    
    public function postSignin(Request $request){
        $this->validate($request,[
           'email'=> 'required|email',
           'password'=>'required',
        ]);
        
        if(!Auth::attempt($request->only(['email', 'password']), $request->has('remember'))){
            return redirect()->back()->with('info', 'Грешна електронна поща или парола.');
        }
        
        return redirect()
                ->route('problems.index');
    }
    
    public function getSignup(){
        return view('auth.signup')
                ->with('title', 'Регистрация | Подобри')
                ->with('description', 'Регистрация в системата на Подобри');
    }
    
    public function postSignup(Request $request){
        $this->validate($request,[
           'first_name'=> 'required|alpha|max:20|min:3',
           'last_name'=> 'required|alpha|max:20|min:3',
           'email'=> 'required|unique:users|email|max:255',
           'password'=>'required|min:6',
        ]);
        
        User::create([
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
        ]);
        
        return redirect()
                ->route('auth.signin')
                ->with('info', 'Успешна регистрация, защо не влезете в профила си?');
    }
    
    public function getSignout(){
        Auth::logout();
        
        return redirect()
                ->route('problems.index');
    }
}