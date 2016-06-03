@extends ('templates.default')
@section('content')
<div class='container margin-bottom-76'>
    @include('templates.partials.alerts')
    <h3>Вход</h3>
    <div class="row margin-top-35">
        <div class="col-md-6 col-xs-12">
            <form class="form-vertical" role="form" method="post" action="{{ route ('auth.signin') }}">
                <div class="form-group{{ $errors->has('email') ? ' has-error' : ''}}">
                    <label for="email" class="control-label">Електронна поща<span class="star-form">*</span></label>
                    <input title="Електронна поща" required type="text" name="email" class="form-control" value="{{ Request::old('email') ?: '' }}" placeholder="Каква е вашата електронна поща?" id="email">
                    @if ($errors->has('email'))
                    <span class='help-block'>{{ $errors->first('email') }}</span>
                    @endif
                </div>
                <div class="form-group{{ $errors->has('password') ? ' has-error' : ''}}">
                    <label for="password" class="control-label">Парола<span class="star-form">*</span></label>
                    <input title="Парола" required type="password" name="password" class="form-control" placeholder="букви, числа, символи" id="password">
                    @if ($errors->has('password'))
                    <span class='help-block'>{{ $errors->first('password') }}</span>
                    @endif
                </div>
                <div class="checkbox">
                    <label>
                        <input type="checkbox" title="Запомнете ме!" name="remember"> Запомнете ме
                    </label>
                </div>
                <div class="form-gorup margin-bottom-10">
                    <button type="submit" class="btn btn-default btn-lg">Вход</button>
                    <a class="btn btn-default btn-lg" id="wait_tip" style="display:none"><span><img height="20" src="./images/loading-gif.gif"
                                id="loading_img"/> Моля изчакайте...</span></a>
                </div>
                <a href="{{ route('get.email') }}" title='Забравена парола'>Забравена парола</a>
                <input type='hidden' name='_token' value='{{ Session::token() }}'>
            </form>
        </div>    
    </div>
</div>
@stop






