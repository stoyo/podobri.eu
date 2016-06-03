@extends ('templates.default')
@section('content')
<div class="container">
    <div class="goal-title-holder block-border">
        <h1 class="margin-0 colorfff-c">Реклама</h1>
        <p class="margin-0 goal-desc">Научете как да промотирате в Подобри</p>
    </div>
    <div class="page-header">
        <div class="block-border colorfff">
            <h1 class="margin-top-0 margin-left-15"><small>Партньорства</small></h1>
            <p class="margin-left-15">За партньорства или специални рекламни кампании може да ни намерите <a href="{{ route('info.maintenance') }}">тук</a>.</p>
        </div>
        <div class="block-border colorfff margin-top-20">
            <h1 class="margin-top-0 margin-left-15"><small>Adwise реклама</small></h1>
            <p class="margin-left-15">Възможността за Adwise реклама е неактивна за момента. Екипът на Подобри работи усилено.</p>
        </div>
        <div class="block-border colorfff margin-top-20">
            <h1 class="margin-top-0 margin-left-15"><small>Банерна реклама</small></h1>
            <p class="margin-left-15">Възможността за банерна реклама е неактивна за момента. Екипът на Подобри работи усилено.</p>
        </div>
    </div>
</div>
@stop