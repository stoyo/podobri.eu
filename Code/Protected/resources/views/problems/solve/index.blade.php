@extends ('templates.default')
@section('content')
<div class="container">
    <div class='row'>
        <form class="form-vertical" role="form" enctype="multipart/form-data" method="post" action="{{ route('add.solution.post', ['id'=>$problem->id]) }}">
            <div class="col-lg-6 col-lg-offset-3 col-md-offset-3 col-sm-offset-2 col-md-6 col-sm-8 col-xs-12">
                <div class="margin-bottom-10">
                    <h3>Добавяне на решение</h3>
                    <h4>Лична информация</h4>
                </div>    
                <div class="col-md-6 col-sm-12">
                    <div class="row">
                        <div class="form-group{{ $errors->has('user_fullname') ? ' has-error' : '' }}">
                            <label for="user_fullname" class="control-label">Име и Фамилия</label>
                            <span class="help-block margin-5-5">Незадължително поле.</span>
                            @if(Auth::check())
                            <input type="text" class="form-control" readonly value="{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}" id="user_fullname" name="user_fullname" title="Име и фамилия" placeholder="Как се казвате?">
                            @elseif(Request::old('user_fullname'))
                            <input type="text" class="form-control transliterate" value="{{ Request::old('user_fullname') }}" id="user_fullname" name="user_fullname" title="Име и фамилия" placeholder="Как се казвате?">
                            <div class="phoholder">
                                <div class="pho photext current" title="Активна кирилица с фонетична клавиатура."></div>
                                <div class="pho bdstext" style="display: none;" title="Активна кирилица с БДС клавиатура."></div>
                                <div class="pho offtext" style="display: none;" title="Кирилизаторът е изключен."></div>
                            </div>
                            @else
                            <input type="text" class="form-control transliterate" id="user_fullname" name="user_fullname" title="Име и фамилия" placeholder="Как се казвате?">
                            <div class="phoholder">
                                <div class="pho photext current" title="Активна кирилица с фонетична клавиатура."></div>
                                <div class="pho bdstext" style="display: none;" title="Активна кирилица с БДС клавиатура."></div>
                                <div class="pho offtext" style="display: none;" title="Кирилизаторът е изключен."></div>
                            </div>
                            @endif
                            @if ($errors->has('user_fullname'))
                            <span class='help-block'>{{ $errors->first('user_fullname') }}</span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12">
                    <div class="row">
                        <div class="form-group{{ $errors->has('user_email') ? ' has-error' : '' }}">
                            <label for="user_email" class="control-label">Електронна поща</label>
                            <span class="help-block margin-5-5">Незадължително поле.</span>
                            @if(Auth::check())
                            <input type="text" class="form-control" readonly value="{{ Auth::user()->email }}" id="user_email" name="user_email" title="Електронна поща" placeholder="Каква е вашата електронна поща?">
                            @elseif(Request::old('user_email'))
                            <input type="text" class="form-control" value="{{ Request::old('user_email') }}" id="user_email" name="user_email" title="Електронна поща" placeholder="Каква е вашата електронна поща?">
                            @else
                            <input type="text" class="form-control" id="user_email" name="user_email" title="Електронна поща" placeholder="Каква е вашата електронна поща?">
                            @endif
                            @if ($errors->has('user_email'))
                            <span class='help-block'>{{ $errors->first('user_email') }}</span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class='row'>
                        <h4>Относно решението</h4>
                        <div class="form-group{{ $errors->has('solution_description') ? ' has-error' : '' }}">
                            <label for="solution_description" class='control-label'>Как решихте <a href="{{ route('problem.custom', ['id'=>$problem->id]) }}">"{{ $problem->problem_title }}"</a>?<span class="star-form">*</span></label>
                            <span class="help-block margin-5-5">Нужни са поне 20 символа.</span>
                            <textarea class="form-control height-160" required title='Как решихте проблема?' name='solution_description' id='solution_description' rows="3" placeholder="Обяснете какво, как, къде, защо, кога и т.н">{{ Request::old('solution_description') ?: '' }}</textarea>
                            <script type="text/javascript">
                                CKEDITOR.replace('solution_description', {
                                    language:"bg",   
                                 });
                            </script>
                            @if ($errors->has('solution_description'))
                            <span class='help-block'>{{ $errors->first('solution_description') }}</span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class='col-lg-12'>
                    <div class="row">
                        <div class="form-group{{ $errors->has('solution_photo') ? ' has-error' : '' }}">
                            <label for="solution_photo" class="control-label">Добавете една снимка<span class="star-form">*</span></label>
                            <span class="help-block margin-5-5">Разрешени разширения са: .jpg, .png</span>
                            <div id="result"></div>
                            <button type="button" class="btn-block btn btn-default margin-top-10 margin-bottom-10" id="clear">Премахнете снимката</button>
                            <div id="alert">Добавихте повече от 9 снимки.</div>
                            <div class="input-group">
                                <span class="input-group-btn">
                                    <span class="btn btn-primary btn-file">
                                        Изберете <input accept="image/png, image/jpeg" required name="solution_photo" id="files" type="file">
                                    </span>
                                </span>
                                <input type="text" value="" id="representer" class="form-control" readonly title="Добавете една снимка">
                            </div> 
                            @if ($errors->has('solution_photo'))
                            <span class='help-block'>{{ $errors->first('solution_photo') }}</span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class='row'>
                        <div class="form-group margin-top-6">
                            <button type="submit" class="btn btn-success">
                                Добавете
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
            </div>
            <input type='hidden' name='_token' value='{{ Session::token() }}'>
        </form>
    </div>
</div>
@stop