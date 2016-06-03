@extends ('templates.default')
@section('content')
<div class='container'>
    @include('templates.partials.alerts')
    <h3>Избиране на нова парола</h3>
    <div class="row margin-top-35 margin-bottom-10">
        <div class="col-md-6 col-xs-12">
            <form class="form-vertical" role="form" method="post" action="{{ route ('post.reset', ['token', class_basename(Request::url())]) }}">
                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }} margin-bottom-30">
                    <label for="password" class="control-label">Парола<span class="star-form">*</span></label>
                    <span class="help-block margin-5-5">Нужни са поне 6 символа.</span>
                    <input title="Парола" required type="password" class="form-control" name="password" id="password" placeholder="Букви, числа, символи">
                    @if ($errors->has('password'))
                    <span class='help-block'>{{ $errors->first('password') }}</span>
                    @endif
                </div>
                <div class="form-group{{ $errors->has('repassword') ? ' has-error' : '' }} margin-bottom-30">
                    <label for="repassword" class="control-label">Повторете парола<span class="star-form">*</span></label>
                    <span class="help-block margin-5-5">Нужни са поне 6 символа.</span>
                    <input title="Повтори парола" required type="password" name="repassword" class="form-control" id="repassword" placeholder="Букви, числа, символи">
                    @if ($errors->has('repassword'))
                    <span class='help-block'>{{ $errors->first('repassword') }}</span>
                    @endif
                </div>
                <div class="form-gorup">
                    <button type="submit" class="btn btn-default btn-lg">Смяна</button>
                    <a class="btn btn-default btn-lg" id="wait_tip" style="display:none"><span><img height="20" src="./images/loading-gif.gif"
                                id="loading_img"/> Моля изчакайте...</span></a>
                </div>
                <input type='hidden' name='_token' value='{{ Session::token() }}'>
                <input type='hidden' name='token_for_email' value='{{ class_basename(Request::url()) }}'>
            </form>
        </div>    
    </div>
</div>
@stop






