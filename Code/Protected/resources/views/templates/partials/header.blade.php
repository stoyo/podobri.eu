<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button class="navbar-toggle" data-target=".navbar-responsive-collapse" data-toggle="collapse" type="button">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a href="{{ route('problems.index') }}" class="navbar-brand"><img class="logo" src="images/logo.png" alt="Лого" /></a>
        </div>
        <div class="collapse navbar-collapse navbar-responsive-collapse">
            <ul class="nav navbar-nav navbar-right">
                @if(Auth::check())  
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">

                        @if(Auth::user()->picture)
                        <img class="menu-pic-thumb" alt="Профилна снимка" src="./images/userphotos/{{ Auth::user()->picture->picture_name }}" />
                        @else
                        <img class="menu-pic-thumb" src="{{ Auth::user()->getAvatarUrl() }}" /> 
                        @endif

                        <span class="hh-fhidden">{{ Auth::user()->getFirstAndLastName() }}</span> <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ route('user.index', ['id' => Auth::user()->id]) }}">Профил</a></li>
                        <li role="separator" class="divider"></li>
                        @if(Auth::user()->is_admin != 0)
                        <li><a href='{{ route('admin.reports') }}'>Доклади</a></li>
                        <li><a href='{{ route('admin.maintenance') }}'>Поддръжка</a></li>
                        @else
                        <li><a href="{{ route('profile.edit') }}">Редакция на профил</a></li>
                        <li><a href="{{ route('add.problem') }}">Добавяне на проблем</a></li>
                        @endif
                        <li role="separator" class="divider"></li>
                        <li><a href="{{ route('auth.signout') }}">Изход</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="{{ route('profile.delete') }}" class="link statuslikes color777" onclick="if (!confirm('Веднъж изтрит, профилът Ви не може да бъде възобновен. Сигурни ли сте?'))
                                    return false;">Изтриване на профил</a></li>
                    </ul>
                </li> 
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                        <span class="glyphicon glyphicon-flash hh-fshown"></span>
                        <span class="hh-fhidden">Известия</span>
                        @if(Auth::user()->pending())
                        <span class="notification-counter">{{ count(Auth::user()->pending()) }}</span>
                        @else
                        <span class="caret"></span>
                        @endif
                    </a>
                    <ul class="dropdown-menu">

                        @if(Auth::user()->pending())
                        <li class="dropdown-header">Последни 10 чакащи потвърждение</li>
                        @foreach(Auth::user()->pending() as $pend)
                        <li><a href="{{ route('problem.custom', ['id' => $pend->id ]) }}">{{ str_limit($pend->problem_title, 30) }}</a></li>
                        @endforeach
                        @else
                        <li class="dropdown-header">Няма чакащи потвърждение на състояние</li>
                        @endif

                    </ul>
                </li>
                <li
                    @if(class_basename(Request::url())=='problem')
                    class="open"
                    @endif
                    ><a href="{{ route('add.problem') }}">Добавете проблем</a></li>
                @else  
                <li
                    @if(class_basename(Request::url())=='problem')
                    class="open"
                    @endif
                    ><a href="{{ route('add.problem') }}">Добавете проблем</a></li>
                <li
                    @if(class_basename(Request::url())=='signin')
                    class="open"
                    @endif
                    ><a href="{{ route('auth.signin') }}">Вход</a></li>
                <li 
                    @if(class_basename(Request::url())=='signup')
                    class="open"
                    @endif
                    ><a href="{{ route('auth.signup') }}">Регистрация</a></li>
                @endif   
            </ul>
            <form action="{{ route('search.results') }}" role="search" class="navbar-form-alt">
                <div class="form-group">
                    <div class="input-group">
                        <input type="text" required id='searchQuery' title="Търсете за проблеми" value="{{ Request::input('term') }}" name="term" class="inputAB form-control"
                               placeholder="Търсете за проблеми"/>
                        <span class="input-group-btn">
                            <button type="submit" id='searchBtn' class="btn btn-default"><span class="glyphicon glyphicon-search"></span></button>
                        </span>
                    </div>
                </div>
            </form>
        </div>
    </div>
</nav>