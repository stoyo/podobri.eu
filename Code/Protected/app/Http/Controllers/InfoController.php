<?php namespace Podobri\Http\Controllers;

class InfoController extends Controller{
    
    public function getFaq(){
        return view('info.faq')
                ->with('title', 'Често задавани въпроси | Подобри')
                ->with('description', 'Какво представлява Подобри? Кой може да използва Подобри? Защо да добавяме проблеми? Отговор на тези и много други въпроси.');
    }
    
    public function getSecurity(){
        return view('info.security')
                ->with('title', 'Сигурност | Подобри')
                ->with('description', 'Не се чувствате в безопасност, използвайки Подобри? Прочетете тук какво може да направите.');
    }
    
    public function getCookies(){
        return view('info.cookies')
                ->with('title', 'Бисквитки | Подобри')
                ->with('description', 'Подобри използва бисквитки за да осигури най - приятното преживяване за потребители.');
    }
    
    public function getAdsInfo(){
        return view('info.ads')
                ->with('title', 'Реклама | Подобри')
                ->with('description', 'Ако се интересувате как да публикуваме ваши реклами в сайта, прочетете тук.');
    }
    
    public function getTos(){
        return view('info.tos')
                ->with('title', 'Условия за използване | Подобри')
                ->with('description', 'Както всяка онлайн услуга, така и Подобри има Условия за използване, с които трябва да се запознаете.');
    }
}