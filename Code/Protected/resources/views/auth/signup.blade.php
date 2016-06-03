@extends ('templates.default')
@section('content')
<div class='container'>
    @include('templates.partials.alerts')
    <div class="row">
        <form class="form-vertical" role="form" method="post" action="{{ route ('auth.signup') }}">
            <div class="col-lg-12">
                <div class="col-lg-6 col-lg-offset-3 col-md-offset-3 col-sm-offset-2 col-md-6 col-sm-8 col-xs-12">
                    <div class="row">
                        <h3>Регистрация</h3>
                        <a class="fb-log" href="{{ route('auth.Facebook') }}">Facebook</a>
                        <a class="google-log" href="{{ route('auth.Google') }}">Google+</a>
                        <a class="twitter-log" href="{{ route('auth.Twitter') }}">Twitter</a>
                    </div>
                    <div class="row margin-top-10">
                        <div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
                            <label for="first_name" class="control-label">Име<span class="star-form">*</span></label>
                            <span class="help-block margin-5-5">Нужни са поне 3 символа.</span>
                            @if(session()->has('first_name'))
                            <input type="text" required class="form-control transliterate" value="{{ session('first_name') }}" id="first_name" name="first_name" title="Име" placeholder="Как се казвате?">
                            @else
                            <input type="text" required class="form-control transliterate" value="{{ Request::old('first_name') ?: '' }}" id="first_name" name="first_name" title="Име" placeholder="Как се казвате?">
                            @endif
                            <div class="phoholder">
                                <div class="pho photext current" title="Активна кирилица с фонетична клавиатура."></div>
                                <div class="pho bdstext" style="display: none;" title="Активна кирилица с БДС клавиатура."></div>
                                <div class="pho offtext" style="display: none;" title="Кирилизаторът е изключен."></div>
                            </div>
                            @if ($errors->has('first_name'))
                            <span class='help-block'>{{ $errors->first('first_name') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">
                            <label for="last_name" class="control-label">Фамилия<span class="star-form">*</span></label>
                            <span class="help-block margin-5-5">Нужни са поне 3 символа.</span>
                            @if(session()->has('last_name'))
                            <input type="text" required class="form-control transliterate" value="{{ session('last_name') }}" name="last_name" id="lastname" title="Фамилия" placeholder="Каква е вашата фамилия?">
                            @else
                            <input type="text" required class="form-control transliterate" value="{{ Request::old('last_name') ?: '' }}" name="last_name" id="lastname" title="Фамилия" placeholder="Каква е вашата фамилия?">
                            @endif
                            <div class="phoholder">
                                <div class="pho photext current" title="Активна кирилица с фонетична клавиатура."></div>
                                <div class="pho bdstext" style="display: none;" title="Активна кирилица с БДС клавиатура."></div>
                                <div class="pho offtext" style="display: none;" title="Кирилизаторът е изключен."></div>
                            </div>
                            @if ($errors->has('last_name'))
                            <span class='help-block'>{{ $errors->first('last_name') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="control-label">Електронна поща<span class="star-form">*</span></label>
                            <span class="help-block margin-5-5">Нужни са поне 6 символа.</span>
                            @if(session()->has('email'))
                            <input type="text" required title="Електронна поща" value="{{ session('email') }}" name="email" class="form-control" id="email" placeholder="Каква е вашата електронна поща?">
                            @else
                            <input type="text" required title="Електронна поща" value="{{ Request::old('email') ?: '' }}" name="email" class="form-control" id="email" placeholder="Каква е вашата електронна поща?">
                            @endif
                            @if ($errors->has('email'))
                            <span class='help-block'>{{ $errors->first('email') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }} margin-bottom-30">
                            <label for="password" class="control-label">Парола<span class="star-form">*</span></label>
                            <span class="help-block margin-5-5">Нужни са поне 6 символа.</span>
                            <input title="Парола" required type="password" class="form-control" name="password" id="password" placeholder="Букви, числа, символи">
                            @if ($errors->has('password'))
                            <span class='help-block'>{{ $errors->first('password') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <button type="submit" class="btn btn-default btn-lg">
                                Регистрация
                            </button>
                            <a class="btn btn-default btn-lg" id="wait_tip" style="display:none"><span><img height="20" src="./images/loading-gif.gif"
                                id="loading_img"/> Моля изчакайте...</span></a>
                        </div>
                    </div>
                </div>    
                <input type="hidden" name="_token" value="{{ Session::token() }}">
            </div>
        </form>
    </div>
</div>
@stop