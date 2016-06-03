<?php namespace Podobri\Http\Controllers;

use Illuminate\Http\Request;
use Podobri\Models\Maintenance;

class MaintenanceController extends Controller{
    
    public function getMaintenance(){
        return view('info.maintenance')
                ->with('title', 'Поддръжка | Задайте въпрос | Подобри')
                ->with('description', 'Екипът на Подобри обича да полува обратна връзка, било то позитивна или негативна.');
    }
    
    public function postMaintenance(Request $request){
        
        $reasons = ['Вход в профил / Забравена парола', 'Технически проблем', 
            'Въпрос за проблем', 'Предложения, сътрудничество', 
            'Друго'];
        
        if(!in_array($request->input('reason'), $reasons)){
            return redirect()->back()->with('info', 'Не се прави така!');
        }
        
        $this->validate($request, [
            'user_email'=> 'required|email',
            'reason'=>'required|max:1000|string|min:5',
            'message'=>'required|max:2500|string|min:20',
            'url'=>'url',
        ]);
        
        Maintenance::create([
            'user_email'=> $request->input('user_email'),
            'reason' => $request->input('reason'),
            'message' => $request->input('message'),
            'url' => $request->input('url'),
        ]);
        
        return redirect()
                ->route('info.maintenance')
                ->with('info', 'Формата беше изпратена успешно. Ще се свържем с вас възможно най - скоро.');
    }
}