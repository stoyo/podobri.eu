@extends ('templates.default')
@section('content')
<div class='container'>
    @include('templates.partials.alerts')
    <div class="row">
        <div class="col-md-12">
            <div class="col-md-3 col-xs-12 margin-top-20 margin-right--50">
                <div class="row">
                    <div class="padding-3per colorfff block-border">
                        @if($user->picture)
                        <a href='./images/userphotos/{{ $user->picture->picture_name }}' class='fancybox prof-pic-holder' data-fancybox-group="gallery" title="Профилна снимка на {{ $user->getFirstAndLastName() }}">
                            <img class="prof-pic" alt="Профилна снимка на потребител" src="./images/userphotos/{{ $user->picture->picture_name }}">
                        </a>
                        @else
                        <img class="full-width" src="{{ $user->getAvatarUrl() }}">
                        @endif
                    </div>
                    <div class="white-block-small block-border"><span class="glyphicon glyphicon-user"></span><span class="margin-left-7">{{ $user->getFirstAndLastName() }}</span></div>                           
                    @if($user->getLocation())
                    <div class="white-block-small block-border"><span class="glyphicon glyphicon-home"></span><span class="margin-left-7">Живее в {{ $user->getLocation() }}</span></div>                 
                    @endif
                    <div class="white-block-small block-border"><span class="glyphicon glyphicon-edit"></span>
                        @if($user->problems->count() == 1)
                        {{ $user->problems->count() }} Добавен проблем
                        @else
                        {{ $user->problems->count() }} Добавени проблема
                        @endif
                    </div>
                    @if($user->getBirthday())
                    <div class="white-block-small block-border"><span class="glyphicon glyphicon-calendar"></span><span class="margin-left-7">Роден/а на {{ $user->getBirthday() }}</span></div>
                    @endif
                    @if($user->getPhone())
                    <div class="white-block-small block-border"><span class="glyphicon glyphicon-phone"></span><span class="margin-left-7">{{ $user->getPhone() }}</span></div>
                    @endif
                    @if($user->getAbout())
                    <div class="white-block-small block-border"><h3 class='margin-0'>Малко за мен</h3><span class="block-me margin-bottom--10">{!! $user->getAbout() !!}</span></div>
                    @endif
                    @if(Auth::check() && Auth::user()->getId()==$user->getId())
                    <div class="white-block-small block-border"><a href="{{ route('profile.edit') }}" class="btn-block btn-primary btn">Редакция на профил</a></div>
                    @endif   
                    @if(Auth::check() && Auth::user()->is_owner == 1 && $user->is_admin == 0 && Auth::user()->getId()!=$user->getId())
                    <div class="white-block-small block-border"><a href="{{ route('admin.makeadmin', ['id'=>$user->getId()]) }}" class="btn-block btn-success btn">Направете Админ</a></div>
                    @endif 
                    @if(Auth::check() && Auth::user()->is_owner == 1 && $user->is_admin == 1 && Auth::user()->getId()!=$user->getId())
                    <div class="white-block-small block-border"><a href="{{ route('admin.makeuser', ['id'=>$user->getId()]) }}" class="btn-block btn-danger btn">Направете Потребител</a></div>
                    @endif 
                    @if(Auth::check() && Auth::user()->is_owner == 1 && Auth::user()->getId()!=$user->getId())
                    <div class="white-block-small block-border"><a href="{{ route('admin.deleteprofile', ['id'=>$user->getId()]) }}" class="btn-block btn-danger btn" onclick="if (!confirm('Веднъж изтрит, профилът не може да бъде възобновен. Сигурни ли сте?'))
                                return false;">Изтрийте Профил</a></div>
                    @endif 
                </div>
            </div>
            <div class="col-lg-8 col-lg-offset-1 margin-top-20 col-md-offset-1 col-md-8 col-xs-12">
                <div class="row col-lg-12">
                    <div class="row">
                        <ul class="nav nav-pills">
                            <li role="presentation" class="margin-bottom-10
                                @if(class_basename(Request::url())==$user->id)
                                active
                                @endif
                                "><a href="{{ route('user.index', ['id' => $user->id]) }}">Всички проблеми</a></li>
                            <li role="presentation" class="margin-bottom-10
                                @if(class_basename(Request::url())=='solved')
                                active
                                @endif
                                "><a href="{{ route('user.filter', ['id' => $user->id, 'action'=>'solved']) }}">Решени проблеми</a></li>
                            <li role="presentation" class="margin-bottom-10
                                @if(class_basename(Request::url())=='unsolved')
                                active
                                @endif
                                "><a href="{{ route('user.filter', ['id' => $user->id, 'action'=>'unsolved']) }}">Нерешени проблеми</a></li>
                            <li role="presentation" class="margin-bottom-10
                                @if(class_basename(Request::url())=='pending')
                                active
                                @endif
                                "><a href="{{ route('user.filter', ['id' => $user->id, 'action'=>'pending']) }}">Чакащи потвърждение проблеми</a></li>
                        </ul>
                    </div>
                </div>
                @if(!$problems->count())
                <div class="clearfix"></div>
                <div class='row margin-top-20 padding-left-10 block-border colorfff'>
                    <h4>Заявката върна празен резултат.</h4>
                    @if(Auth::check() && Auth::user()->getId()==$user->getId())
                    <a href="{{ route('add.problem') }}" class="margin-bottom-10 btn-default btn">Добавете проблем</a>
                    @endif
                </div>
                @else
                <div class="margin-top--20">
                    @foreach($problems as $problem)
                    <div class="row">
                        @include('problems.partials.problemblock')
                    </div>
                    @endforeach
                </div>
                <div class='row'>
                    {!! $problems->render() !!}
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@stop