@extends ('templates.default')
@section('content')
<div class='container'>
    @include('templates.partials.alerts')
    <div class="row">
        <form class="form-vertical" role="form" method="post" action="{{ route('problem.edit', ['id'=>$problem->id]) }}">
                <div class="col-lg-6 col-lg-offset-3 col-md-offset-3 col-sm-offset-2 col-md-6 col-sm-8 col-xs-12">
                    <div>
                        <h3>Редактиране на проблем</h3>
                    </div>
                    <div class="margin-top-20">
                        <div class="form-group{{ $errors->has('problem_title') ? ' has-error' : '' }}">
                            <label for="problem_title" class='control-label'>Заглавие на проблема<span class="star-form">*</span></label>
                            <span class="help-block margin-5-5">Нужни са поне 6 символа.</span>
                            <input type="text" title="Заглавие на проблема" name='problem_title' required class="form-control transliterate" id="problem_title" value="{{ Request::old('problem_title') ?: $problem->problem_title }}" placeholder="Кратко и описателно">
                            <div class="phoholder">
                                <div class="pho photext current" title="Активна кирилица с фонетична клавиатура."></div>
                                <div class="pho bdstext" style="display: none;" title="Активна кирилица с БДС клавиатура."></div>
                                <div class="pho offtext" style="display: none;" title="Кирилизаторът е изключен."></div>
                            </div>
                            @if ($errors->has('problem_title'))
                            <span class='help-block'>{{ $errors->first('problem_title') }}</span>
                            @endif
                        </div>
                        <div class="form-group{{ $errors->has('problem_description') ? ' has-error' : '' }}">
                            <label for="problem_description" class='control-label'>Описание на проблема<span class="star-form">*</span></label>
                            <span class="help-block margin-5-5">Незадължително поле.</span>
                            <textarea name='problem_description' title="Описание на проблема" required id="problem_description" class="form-control height-170" rows="3" placeholder="Обяснете какво, как, къде, защо, кога и т.н">{{ Request::old('problem_description') ?: $problem->problem_description }}</textarea>
                            <script type="text/javascript">
                                CKEDITOR.replace('problem_description', {
                                    language:"bg",   
                                });
                            </script>
                            @if ($errors->has('problem_description'))
                            <span class='help-block'>{{ $errors->first('problem_description') }}</span>
                            @endif
                        </div>
                        <div class="form-group margin-top-20">
                            <button type="submit" class="btn btn-success">
                                Подновете
                            </button>
                            <a class="btn btn-default" id="wait_tip" style="display:none"><span><img height="20" src="./images/loading-gif.gif"
                                id="loading_img"/> Моля изчакайте...</span></a>
                            или
                            <a href="{{ route('problem.custom', ['id'=>$problem->id]) }}" class="btn btn-danger">
                                Назад
                            </a>
                        </div>
                    </div>
                </div>
            <input type='hidden' name='_token' value='{{ Session::token() }}'>
        </form>
    </div>
</div>
@stop