@extends ('templates.default')
@section('content')
<div class="container">
    <div class="goal-title-holder block-border">
        <h1 class="margin-0 colorfff-c">Условия за използване</h1>
        <p class="margin-0 goal-desc">Какво декларирате при използване на Подобри?</p>
    </div>
    <div class="page-header">
        <div class="block-border colorfff">
            <h1 class="margin-top-0 margin-left-15"><small>Ще запазя позитивно и добронамерено поведение</small></h1>
            <p class="margin-left-15">Без прояви на расизъм, предразсъдъци и омраза към останалите хора. Уважение на различното мнение. Без спамене, фалшиви заглавия, описания и т.н. на добавените проблеми.</p>
        </div>
        <div class="block-border colorfff margin-top-20">
            <h1 class="margin-top-0 margin-left-15"><small>Ще прочета долупосочени линкове</small></h1>
            <p class="margin-left-15"><a class="btn btn-sm btn-default margin-top-10" href="{{ route('goal') }}">За нас</a><a class="btn btn-sm btn-default margin-top-10" href="{{ route('info.security') }}">Сигурност</a><a class="btn btn-sm btn-default margin-top-10" href="{{ route('info.cookies') }}">Бисквитки</a><a class="btn btn-sm btn-default margin-top-10" href="{{ route('info.faq') }}">Често задавани въпроси </a></p>
        </div>
    </div>
</div>
@stop