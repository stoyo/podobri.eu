<div class="container-fluid colorfff margin-top-35 margin-bottom--20"> 
    <div class="container">
        <div class="col-md-12 padding-20-0">
            <div class="row">
                <div class="col-md-3 col-sm-4 col-xs-6">
                    @if(Auth::check())
                    <a href="{{ route('user.index', ['id' => Auth::user()->id]) }}" title="Профил" class="footer-item">Профил</a> <br/>
                    <a href="{{ route('profile.edit') }}" title="Редакция на профил" class="footer-item">Редакция на профил</a> <br/>
                    @else
                    <a href="{{ route('auth.signin') }}" title="Вход" class="footer-item">Вход</a> <br/>
                    <a href="{{ route('auth.signup') }}" title="Регистрация" class="footer-item">Регистрация</a> <br/>
                    @endif 
                    <a href="{{ route('add.problem') }}" title="Добавете проблем" class="footer-item">Добавете проблем</a> <br/>
                </div>
                <div class="col-md-3 col-sm-4 col-xs-6">
                    <a href="{{ route('goal') }}" title="За нас" class="footer-item">За нас</a> <br/>
                    <a href="{{ route('info.security') }}" title="Сигурност" class="footer-item">Сигурност </a> <br/>
                    <a href="{{ route('info.maintenance') }}" title="Поддръжка" class="footer-item">Поддръжка </a> <br/>
                </div>
                <div class="col-md-3 col-sm-4 col-xs-6">
                    <a href="{{ route('info.ads') }}" title="Реклама" class="footer-item">Реклама </a> <br/>
                    <a href="{{ route ('info.cookies') }}" title="Бисквитки" class="footer-item">Бисквитки </a> <br/>
                </div>
                <div class="col-md-3 col-sm-4 col-xs-6">
                    <a href="{{ route('info.tos') }}" title="Условия за Използване" class="footer-item">Условия за Използване</a> <br/>
                    <a href="{{ route('info.faq') }}" title="Често Задавани Въпроси" class="footer-item">Често Задавани Въпроси </a> <br/>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class='margin-top-20'>
                        <span class="footer-brand">Подобри © 2016</span>     
                        <a title="Подобри във Vimeo" target="_blank" href="https://vimeo.com/user50250359"><li id="vimeo" class="share-button footer-social"></li></a>
                        <a title="Подобри във Facebook" target="_blank" href="https://www.facebook.com/podobri.eu"><li id="face" class="share-button footer-social margin-right-4"></li></a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 margin-top-20">
                    <div id="google_translate_element"></div><script type="text/javascript">
                        function googleTranslateElementInit() {
                            new google.translate.TranslateElement({pageLanguage: 'bg', gaTrack: true, gaId: 'UA-72105517-1'}, 'google_translate_element');
                        }
                    </script><script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
                </div>
            </div>
        </div>
    </div>    
</div>
