@extends ('templates.default')
@section('content')
<div class="container">
    <div class="goal-title-holder block-border">
        <h1 class="margin-0 colorfff-c">Бисквитки</h1>
        <p class="margin-0 goal-desc">Подобри използва бисквитки за да осигури най-приятното преживяване за потребители</p>
    </div>
    <div class="page-header">
        <div class="block-border colorfff">
            <h1 class="margin-top-0 margin-left-15"><small>Какво представляват бисквитките?</small></h1>
            <p class="margin-left-15">HTTP бисквитката, обикновено наричана просто „бисквитка“, е пакет информация, изпратен от уеб сървър към Интернет браузър, а след това връщан от браузъра всеки път, когато той получи достъп до този сървър. <br/><a class="btn btn-sm btn-default margin-top-10" target="_blank" href="https://bg.wikipedia.org/wiki/HTTP-%D0%B1%D0%B8%D1%81%D0%BA%D0%B2%D0%B8%D1%82%D0%BA%D0%B0">Повече информация</a></p>
        </div>
        <div class="block-border colorfff margin-top-20">
            <h1 class="margin-top-0 margin-left-15"><small>Не искам да се съхранява моя информация, какво да направя?</small></h1>
            <p class="margin-left-15">Все още използваме само задължителни бисквитки (essential cookies): Тези бисквитки са строго необходими, за да може уебсайтът да изпълнява своите функции. Например, възможно е да използваме тези бисквитки, за да установим автентичността и самоличността на нашите потребители, когато те използват Нашия Сайт. Без тези бисквитки не бихме могли да Ви разпознаем, а Вие на свой ред не бихте могли да получите достъп до нашите услуги.<br/><a class="btn btn-sm btn-default margin-top-10" href="{{ route('info.maintenance') }}">Искате да зададете въпрос?</a></p>
        </div>
    </div>
</div>
@stop