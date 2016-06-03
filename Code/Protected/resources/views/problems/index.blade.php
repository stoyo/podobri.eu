@extends ('templates.default')
@section('content')
<div class='container'>
    @include('templates.partials.alerts')
    <div class="white-block block-border margin-bottom-20 col-md-12">
        <div>
            <a class="btn btn-default btn-sm activatefilters">Филтри <span class='glyphicon glyphicon-menu-down'></span></a>
            @if(class_basename(Request::url())=='Sofia')
            <a href='{{ route('problems.index') }}' title='Премахнете филтъра' class='shownfilter'>София x</a>
            @endif
            @if(class_basename(Request::url())=='Dobrich')
            <a href='{{ route('problems.index') }}' title='Премахнете филтъра' class='shownfilter'>Добрич x</a>
            @endif
            @if(class_basename(Request::url())=='Varna')
            <a href='{{ route('problems.index') }}' title='Премахнете филтъра' class='shownfilter'>Варна x</a>
            @endif
            @if(class_basename(Request::url())=='solved')
            <a href='{{ route('problems.index') }}' title='Премахнете филтъра' class='shownfilter'>Решени проблеми x</a>
            @endif
            @if(class_basename(Request::url())=='unsolved')
            <a href='{{ route('problems.index') }}' title='Премахнете филтъра' class='shownfilter'>Нерешени проблеми x</a>
            @endif
            @if(class_basename(Request::url())=='pending')
            <a href='{{ route('problems.index') }}' title='Премахнете филтъра' class='shownfilter'>Чакащи потвърждение проблеми x</a>
            @endif
            @if(class_basename(Request::url())=='asc')
            <a href='{{ route('problems.index') }}' title='Премахнете филтъра' class='shownfilter'>Първо добавени x</a>
            @endif
            @if(class_basename(Request::url())=='desc')
            <a href='{{ route('problems.index') }}' title='Премахнете филтъра' class='shownfilter'>Последно добавени x</a>
            @endif
            @if(class_basename(Request::url())=='lastWeek')
            <a href='{{ route('problems.index') }}' title='Премахнете филтъра' class='shownfilter'>От последната седмица x</a>
            @endif
            @foreach($categories as $category)
            @if(class_basename(Request::url())==$category->category_slug)
            <a href='{{ route('problems.index') }}' title='Премахнете филтъра' class='shownfilter'>{{ $category->category_name }} x</a>
            @endif
            @endforeach
        </div>
        <div class='filters margin-top-15 filterinout hidefirst'>
            <div class='col-md-3 col-xs-4'>
                <ul>
                    <li><b>Категории</b></li>
                    @foreach($categories as $category)
                    @if(class_basename(Request::url())==$category->category_slug)
                    <li><a href='{{ route('problems.index') }}' title='Премахнете филтъра'>{{ $category->category_name }} x</a></li>
                    @else
                    <li><a title='Търсете за {{ $category->category_name }}' href='{{ route('sort.category', [$category->category_slug]) }}'>{{ $category->category_name }}</a></li>
                    @endif
                    @endforeach
                </ul>
            </div>
            <div class='col-md-3 col-xs-4'>
                <ul>
                    <li><b>Дата на добавяне</b></li>
                    @if(class_basename(Request::url())=='asc')
                    <li><a href='{{ route('problems.index') }}' title='Премахнете филтъра'>Първо добавени x</a></li>
                    @else
                    <li><a title='Търсете за Първо добавени проблеми' href='{{ route('sort.date', ['asc']) }}'>Първо добавени</a></li>
                    @endif
                    @if(class_basename(Request::url())=='desc')
                    <li><a href='{{ route('problems.index') }}' title='Премахнете филтъра'>Последно добавени x</a></li>
                    @else
                    <li><a title='Търсете за Последно добавени проблеми' href='{{ route('sort.date', ['desc']) }}'>Последно добавени</a></li>
                    @endif
                    @if(class_basename(Request::url())=='lastWeek')
                    <li><a href='{{ route('problems.index') }}' title='Премахнете филтъра'>От последната седмица x</a></li>
                    @else
                    <li><a title='Търсете за проблеми от последната седмица' href='{{ route('sort.date', ['lastWeek']) }}'>От последната седмица</a></li>
                    @endif
                </ul>
                <ul>
                    <li><b>Статус</b></li>
                    @if(class_basename(Request::url())=='solved')
                    <li><a href='{{ route('problems.index') }}' title='Премахнете филтъра'>Решени проблеми x</a></li>
                    @else
                    <li><a title='Търсете за Решени проблеми' href='{{ route('sort.status', ['solved']) }}'>Решени проблеми</a></li>
                    @endif
                    @if(class_basename(Request::url())=='unsolved')
                    <li><a href='{{ route('problems.index') }}' title='Премахнете филтъра'>Нерешени проблеми x</a></li>
                    @else
                    <li><a title='Търсете за Нерешени проблеми' href='{{ route('sort.status', ['unsolved']) }}'>Нерешени проблеми</a></li>
                    @endif
                    @if(class_basename(Request::url())=='pending')
                    <li><a href='{{ route('problems.index') }}' title='Премахнете филтъра'>Чакащи потвърждение проблеми x</a></li>
                    @else
                    <li><a title='Търсете за Чакащи потвърждение проблеми' href='{{ route('sort.status', ['pending']) }}'>Чакащи потвърждение проблеми</a></li>
                    @endif
                </ul>
            </div>
            <div class='col-md-3 col-xs-4'>
                <ul>
                    <li><b>Често срещани градове</b></li>
                    @if(class_basename(Request::url())=='Dobrich')
                    <li><a href='{{ route('problems.index') }}' title='Премахнете филтъра'>Добрич x</a></li>
                    @else
                    <li><a title='Търсете за проблеми в Добрич' href='{{ route('sort.city', ['Dobrich']) }}'>Добрич</a></li>
                    @endif
                    @if(class_basename(Request::url())=='Sofia')
                    <li><a href='{{ route('problems.index') }}' title='Премахнете филтъра'>София x</a></li>
                    @else
                    <li><a title='Търсете за проблеми в София' href='{{ route('sort.city', ['Sofia']) }}'>София</a></li>
                    @endif
                    @if(class_basename(Request::url())=='Varna')
                    <li><a href='{{ route('problems.index') }}' title='Премахнете филтъра'>Варна x</a></li>
                    @else
                    <li><a title='Търсете за проблеми в Варна' href='{{ route('sort.city', ['Varna']) }}'>Варна</a></li>
                    @endif
                </ul>
            </div>
        </div>
        <div class='clearfix'></div>
    </div>     
    <div class="row">
        <div class="col-md-8 col-sm-12 margin-top--20">
            @if(!$problems->count())
            <div class="clearfix"></div>
            <div class="colorfff block-border margin-top-20 padding-left-10">
                <h4>Заявката върна празен резултат.</h4>
                <a href="{{ route('add.problem') }}" title='Добавете проблем' class="margin-bottom-10 btn-default btn">Добавете проблем</a>
            </div>
            @else
            @foreach($problems as $problem)
            @include('problems.partials.problemblock') 
            @endforeach
            {!! $problems->render() !!}
            @endif
        </div>
        <div class="col-md-4 hidden-xs hidden-sm">
            <div class="margin-bottom-10">
                <div class="list-group">
                    <div>
                        @if(!$rand_probs->count())
                        <a class="list-group-item"><span class='glyphicon glyphicon-edit margin-right-4'></span>Все още няма проблеми</a>
                        @else
                        @foreach($rand_probs as $problem)
                        @include('problems.partials.problemrand')
                        @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop