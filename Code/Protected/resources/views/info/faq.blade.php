@extends ('templates.default')
@section('content')
<div class="container">
    <div class="goal-title-holder block-border">
        <h1 class="margin-0 colorfff-c">Често задавани въпроси</h1>
        <p class="margin-0 goal-desc">Не сте намерили това, което търсите? <a href="{{ route('info.maintenance') }}" class="btn btn-sm btn-default">Задайте въпрос !</a></p>
    </div>
    <div class="page-header">
        <div class="block-border colorfff">
            <h1 class="margin-top-0 margin-left-15"><small>Какво представлява Подобри?</small></h1>
            <p class="margin-left-15">Подобри е интернет платформа, която позволява на всеки човек, регистриран или не, голям или малък, от Мелник или от София, да опише и локализира проблем от всякакво естество, да следи и коментира, вече добавени проблеми, и да добавя решения за тях.</p>
        </div>
        <div class="block-border colorfff margin-top-20">
            <h1 class="margin-top-0 margin-left-15"><small>Кой може да използва Подобри?</small></h1>
            <p class="margin-left-15">Всеки! Продуктът е единствен по рода си и услугата е напълно безплатна за потребители. </p> 
        </div>
        <div class="block-border colorfff margin-top-20">
            <h1 class="margin-top-0 margin-left-15"><small>Защо да добавяме проблеми?</small></h1>
            <p class="margin-left-15">Добавяйки проблеми, Вие не само помагате на уебсайта да се развива, но и на хората да са по-информирани и стимулирани. Да желаят да помагат.</p>
        </div>
        <div class="block-border colorfff margin-top-20">
            <h1 class="margin-top-0 margin-left-15"><small>Какви проблеми да добавяме?</small></h1>
            <p class="margin-left-15">Всякакви! Ние вярваме, че проблемите могат да бъдат решени, ако се включат правилните хора. Визираме обезпокоени граждани, нестопански организации и компании, занимаващи се със социални дейности. Надяваме се да обединим хората да решават проблеми, към които са пристрастни. </p>
        </div>
        <div class="block-border colorfff margin-top-20">
            <h1 class="margin-top-0 margin-left-15"><small>Къде се пращат проблемите?</small></h1>
            <p class="margin-left-15">Проблемите се публикуват само и единствено в сайта. Веднъж публикувани, потребителите имат възможност да ги споделят в някои от социалните мрежи (Facebook, Google+, Twitter). Надяваме се на по-късен етап да привлечем интереса на радиа и телевизии.</p>
        </div>
        <div class="block-border colorfff margin-top-20">
            <h1 class="margin-top-0 margin-left-15"><small>Относно авторските права?</small></h1>
            <p class="margin-left-15">Веднъж добавени, проблемите стават свободно разпространяеми. Всеки има право да ги използва и публикува, като не е задължително да посочва източник. Целта на това е информацията да е по-лесно достъпна и да стигне до възможно най-голям брой хора.</p>
        </div>
    </div>
</div>
@stop