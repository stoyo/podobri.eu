@extends ('templates.default')
@section('content')
<div class='container'>
    @include('templates.partials.alerts')
    <div class="row">
        <form class="form-vertical" role="form" method="post" action="{{ route ('info.maintenance') }}">
            <div class="col-lg-12">
                <div class="col-lg-6 col-lg-offset-3 col-md-offset-3 col-sm-offset-2 col-md-6 col-sm-8 col-xs-12">
                    <div class="row">
                        <h3>Поддръжка</h3> 
                    </div>
                    <div class='row margin-top-10'>
                        <div class="form-group{{ $errors->has('reason') ? ' has-error' : '' }}">
                            <label class="control-label" for="reason">Посочете тема<span class="star-form">*</span></label>
                            <span class="help-block margin-5-5">Моля използвайте падащото меню.</span>
                            <select class="form-control" required id='reason' title="Посочете тема" name="reason">
                                <option disabled selected hidden value="">Тема</option>
                                <option value="Вход в профил / Забравена парола"{{ Request::old('reason')=='Вход в профил / Забравена парола'? ' selected' : '' }} >Вход в профил / Забравена парола</option>
                                <option value="Технически проблем"{{ Request::old('reason')=='Технически проблем'? ' selected' : ''}} >Технически проблем</option>
                                <option value="Въпрос за проблем"{{ Request::old('reason')=='Въпрос за проблем'? ' selected' : ''}} >Въпрос за проблем</option>
                                <option value="Предложения, сътрудничество"{{ Request::old('reason')=='Предложения, сътрудничество'? ' selected' : ''}} >Предложения, сътрудничество</option>
                                <option value="Друго"{{ Request::old('reason')=='Друго'? ' selected' : ''}} >Друго</option>
                            </select>
                            @if ($errors->has('reason'))
                            <span class='help-block'>{{ $errors->first('reason') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class='row'>
                        <div class="form-group{{ $errors->has('message') ? ' has-error' : '' }}">
                            <label for="message" class="control-label">Съобщение<span class="star-form">*</span></label>
                            <span class="help-block margin-5-5">Нужни са поне 20 символа.</span>
                            <textarea class="form-control transliterate" style="resize:vertical;" required name='message' id='message' title="Съобщение" rows="3" placeholder="Напишете каквото пожелаете">{{ Request::old('message') }}</textarea>
                            <div class="phoholder" style="float:right; margin:0px !important;">
                                <div class="pho photext current" title="Активна кирилица с фонетична клавиатура."></div>
                                <div class="pho bdstext" style="display: none;" title="Активна кирилица с БДС клавиатура."></div>
                                <div class="pho offtext" style="display: none;" title="Кирилизаторът е изключен."></div>
                            </div>
                            @if ($errors->has('message'))
                            <span class='help-block'>{{ $errors->first('message') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group{{ $errors->has('url') ? ' has-error' : '' }}">
                            <label for="url" class="control-label">Линк към проблем</label>
                            <span class="help-block margin-5-5">Незадължително поле.</span>
                            <input type="text" class="form-control" value="{{ Request::old('url') }}" id="url" name="url" title="Линк към проблем" placeholder="http://www.podobri.com/problem/пример">
                            @if ($errors->has('url'))
                            <span class='help-block'>{{ $errors->first('url') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group{{ $errors->has('user_email') ? ' has-error' : '' }}">
                            <label for="user_email" class="control-label">Електронна поща<span class="star-form">*</span></label>
                            <span class="help-block margin-5-5">Нужни са поне 6 символа.</span>
                            @if(Auth::check())
                            <input type="text" class="form-control" readonly value="{{ Auth::user()->email }}" id="user_email" name="user_email" title="Електронна поща" placeholder="Каква е вашата електронна поща?">
                            @elseif(Request::old('user_email'))
                            <input type="text" class="form-control" required value="{{ Request::old('user_email') }}" id="user_email" name="user_email" title="Електронна поща" placeholder="Каква е вашата електронна поща?">
                            @else
                            <input type="text" class="form-control" required id="user_email" name="user_email" title="Електронна поща" placeholder="Каква е вашата електронна поща?">
                            @endif
                            @if ($errors->has('user_email'))
                            <span class='help-block'>{{ $errors->first('user_email') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class='row'>
                        <div class="form-group">
                            <button type="submit" class="btn btn-default btn-lg">
                                Изпращане
                            </button>
                            <a class="btn btn-default btn-lg" id="wait_tip" style="display:none"><span><img height="20" src="./images/loading-gif.gif"
                                id="loading_img"/> Моля изчакайте...</span></a>
                        </div>
                    </div>
                </div>
            </div>
            <input type="hidden" name="_token" value="{{ Session::token() }}">
        </form>
    </div>
</div>
@stop
