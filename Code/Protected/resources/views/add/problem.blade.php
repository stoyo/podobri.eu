@extends ('templates.default')
@section('content')
<div class="container">
    @include('templates.partials.alerts')
    <h3>Добавяне на проблем</h3>
    <h4>Лична информация</h4>
    <div class='row margin-top-20'>
        <form class="form-vertical" role="form" method="post" enctype="multipart/form-data" action="{{ route('add.problem.post') }}" multiple>
            <div class="col-lg-12">
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
            </div>
            <div class='col-lg-12'>
                <h4>Относно проблема</h4>
            </div>
            <div class='col-lg-12'>
                <div class="form-group{{ $errors->has('day') ? ' has-error' : '' || $errors->has('month') ? ' has-error' : '' || $errors->has('year') ? ' has-error' : '' }}">
                    <label for="day" class="control-label">Категория на проблема<span class="star-form">*</span></label>
                    <span class="help-block margin-5-5">Моля използвайте падащото меню.</span>
                    <select title="Категория на проблема" required class="form-control" name="category">
                        <option disabled selected hidden value="">Категория</option>
                        @foreach($categories as $category)
                        <option value="{{ $category->category_name }}"{{ (Request::old('category')==$category->category_name ? ' selected' : '') }}>{{ $category->category_name }}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('category'))
                    <span class='help-block'>{{ $errors->first('category') }}</span>
                    @endif
                </div>    
            </div>
            <div class="col-lg-12">
                <div class="col-md-6 col-sm-12">
                    <div class='row'>
                        <div class="form-group{{ $errors->has('problem_title') ? ' has-error' : '' }}">
                            <label for="problem_title" class="control-label">Какъв е проблемът?<span class="star-form">*</span></label>
                            <span class="help-block margin-5-5">Нужни са поне 6 символа.</span>
                            <input type="text" required title="Какъв е проблемът?" value="{{ Request::old('problem_title') ?: '' }}" name="problem_title" class="form-control transliterate" id="problem_title" placeholder="Бъдете възможно най - точни">
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
                            <label for="problem_description" class='control-label'>Информация за проблема</label>
                            <span class="help-block margin-5-5">Незадължително поле.</span>
                            <textarea class="form-control height-160" title='Информация за проблема' name='problem_description' id='problem_description' rows="3" placeholder="Обяснете какво, как, къде, защо, кога и т.н">{{ Request::old('problem_description') ?: '' }}</textarea>
                            <script type="text/javascript">
                                CKEDITOR.replace('problem_description', {
                                    language: "bg",
                                });
                            </script>
                            @if ($errors->has('problem_description'))
                            <span class='help-block'>{{ $errors->first('problem_description') }}</span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12">
                    <div class='row'>
                        <div class="form-group{{ $errors->has('location') ? ' has-error' : '' }}">
                            <label for="pac-input" class='control-label'>Къде е забелязан?<span class="star-form">*</span></label>
                            <span class="help-block margin-5-5">Моля използвайте автоматичното допълване.</span>
                            <input id="pac-input" required name='location' value='{{ Request::old('location') }}' title='Къде е забелязан?' class="form-control transliterate" type="text"
                                   placeholder="Въведете местоположение">
                            <div class="phoholder">
                                <div class="pho photext current" title="Активна кирилица с фонетична клавиатура."></div>
                                <div class="pho bdstext" style="display: none;" title="Активна кирилица с БДС клавиатура."></div>
                                <div class="pho offtext" style="display: none;" title="Кирилизаторът е изключен."></div>
                            </div>
                            @if ($errors->has('location'))
                            <span class='help-block'>{{ $errors->first('location') }}</span>
                            @endif
                        </div>
                    </div>
                    <div>    
                        <div class="form-group">
                            <div id="map"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="margin-bottom-14">
                    <ul class="nav nav-pills">
                        <li role="presentation" id="picturemenu" class="active swtichfieldp"><a>Добавете снимки за проблема</a></li>
                        <li role="presentation" id="videomenu" class="swtichfieldv"><a>Добавете видео за проблема</a></li>
                    </ul>
                </div>
                <span class="help-block margin-5-5 star-form">Задължително е да добавите или снимка/и, или видео. Не може и двете!</span>
                <div class='col-lg-12' id="picturefield">
                    <div class="row">
                        <div class="form-group{{ $errors->has('problem_photos') ? ' has-error' : '' }}">
                            <label for="problem_photos" class='control-label'>Добавете поне една снимка</label>
                            <span class="help-block margin-5-5">Можете да добавите до 9 снимки. Максимална големина на снимка: 3.5MB. Разрешени разширения са: .jpg, .png, .jpeg</span>
                            <div id="result"></div>
                            <button type="button" class="btn-block btn btn-default margin-top-10 margin-bottom-10" id="clear">Премахнете всички снимки</button>
                            <div id="alert">Добавихте повече от 9 снимки.</div>
                            <div class="input-group">
                                <span class="input-group-btn">
                                    <span class="btn btn-primary btn-file">
                                        Изберете <input accept="image/png, image/jpeg, image/jpg" name="problem_photos[]" id="files" type="file" multiple>
                                    </span>
                                </span>
                                <input type="text" value="" id="representer" class="form-control" readonly title="Добавете поне една снимка">
                            </div>
                            @if ($errors->has('problem_photos'))
                            <span class='help-block'>{{ $errors->first('problem_photos') }}</span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class='col-lg-12 notvisible' id="videofield">
                    <div class="row">
                        <div class="form-group{{ $errors->has('video') ? ' has-error' : '' }}">
                            <label for="video" class='control-label'>Добавете видео</label>
                            <span class="help-block margin-5-5">Можете да добавите видео материал. Разрешени разширения са: .mp4, .m4v, .ogg, .webbm, .webm, .ogv, .avi</span>
                            <span class="help-block margin-5-5">Максимална големина на видео: 220MB. <span class="star-form">Формата ще се обработва повече от обикновено.</span> Благодарим за разбирането!</span>
                            <div id="alert">Добавихте повече от 9 снимки.</div>
                            <div class="input-group">
                                <span class="input-group-btn">
                                    <span class="btn btn-primary btn-file">
                                        Изберете <input accept="video/*" name="video" id="video" type="file">
                                    </span>
                                </span>
                                <input type="text" value="" id="representer" class="form-control" readonly title="Добавете видео">
                            </div>
                            @if ($errors->has('video'))
                            <span class='help-block'>{{ $errors->first('video') }}</span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class='row'>
                        <div class="form-group">
                            <button type="submit" id="upload" class="btn btn-default btn-lg">
                                Добавете
                            </button>
                            <a class="btn btn-default btn-lg" id="wait_tip" style="display:none"><span><img height="20" src="./images/loading-gif.gif"
                                id="loading_img"/> Моля изчакайте...</span></a>
                        </div>
                    </div>
                </div>
            </div>
            <input type='hidden' name='_token' value='{{ Session::token() }}'>
        </form>
    </div>
</div>
@stop