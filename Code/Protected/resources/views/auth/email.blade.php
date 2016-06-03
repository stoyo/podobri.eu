@extends ('templates.default')
@section('content')
<div class='container'>
    @include('templates.partials.alerts')
    <h3>Забравена парола</h3>
    <div class="row margin-top-35 margin-bottom-10">
        <div class="col-md-6 col-xs-12">
            <form class="form-vertical" role="form" method="post" action="{{ route ('post.email') }}">
                <div class="form-group{{ $errors->has('email') ? ' has-error' : ''}}">
                    <label for="email" class="control-label">Електронна поща<span class="star-form">*</span></label>
                    <span class="help-block margin-5-5">Нужни са поне 6 символа.</span>
                    <input title="Електронна поща" required type="text" name="email" class="form-control" value="{{ Request::old('email') ?: '' }}" placeholder="Каква е вашата електронна поща?" id="email">
                    @if ($errors->has('email'))
                    <span class='help-block'>{{ $errors->first('email') }}</span>
                    @endif
                </div>
                <div class="form-gorup">
                    <button type="submit" class="btn btn-default btn-lg">Изпращане</button>
                    <a class="btn btn-default btn-lg" id="wait_tip" style="display:none"><span><img height="20" src="./images/loading-gif.gif"
                                id="loading_img"/> Моля изчакайте...</span></a>
                </div>
                <input type='hidden' name='_token' value='{{ Session::token() }}'>
            </form>
        </div>    
    </div>
</div>
@stop






