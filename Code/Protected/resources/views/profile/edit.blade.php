@extends ('templates.default')
@section('content')
<div class='container'>
    @include('templates.partials.alerts')
    <h3>Подновете информация</h3>
    <div class="row margin-top-20">
        <form class="form-vertical" enctype="multipart/form-data" role="form" method="post" action="{{ route ('profile.edit') }}">
            <div class="col-lg-12">
                <div class='col-lg-3 col-md-3 margin-top-20 col-sm-3 col-xs-12'>
                    <div class='row'>
                        <div class="padding-3per colorfff block-border">
                            @if(Auth::user()->picture)
                            <a href='./images/userphotos/{{ Auth::user()->picture->picture_name }}' class='fancybox prof-pic-holder' data-fancybox-group="gallery" title="Профилна снимка на {{ Auth::user()->getFirstAndLastName() }}">
                                <img class="prof-pic" alt="Профилна снимка на потребител" src="./images/userphotos/{{ Auth::user()->picture->picture_name }}">
                            </a>
                            <a title="Изтрийте профилната си снимка" href='{{ route('profile.image.delete') }}' onclick="if (!confirm('На път сте да изтриете профилната си снимка. Сигурни ли сте?'))
                                            return false;" class='margin-top-5 btn btn-default btn-block'>Изтрийте снимката</a>
                            @else
                            <img class="full-width" src="{{ Auth::user()->getAvatarUrl() }}">
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-lg-offset-1 margin-top-20 col-md-offset-1 col-sm-offset-1 col-md-6 col-sm-8 col-xs-12">
                    <div class="row">
                        <div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
                            <label for="first_name" class="control-label">Име<span class="star-form">*</span></label>
                            <span class="help-block margin-5-5">Нужни са поне 3 символа.</span>
                            <input type="text" required class="form-control transliterate" value="{{ Request::old('first_name') ?: Auth::user()->first_name }}" id="first_name" name="first_name" title="Име" placeholder="Как се казвате?">
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
                            <input type="text" required class="form-control transliterate" value="{{ Request::old('last_name') ?: Auth::user()->last_name }}" name="last_name" id="last_name" title="Фамилия" placeholder="Каква е вашата фамилия?">
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
                            <input type="text" required title="Електронна поща" value="{{ Request::old('email') ?: Auth::user()->email }}" name="email" class="form-control" id="email" placeholder="пример@пример.пример">
                            @if ($errors->has('email'))
                            <span class='help-block'>{{ $errors->first('email') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group{{ $errors->has('day') ? ' has-error' : '' || $errors->has('month') ? ' has-error' : '' || $errors->has('year') ? ' has-error' : '' }}">
                            <label for="day" class="control-label">Дата на раждане</label>
                            <span class="help-block margin-5-5">Моля, бъдете коректни.</span>
                            <div class="row">
                                <div class="col-md-4 col-xs-12">
                                    <select title="Ден на раждане" class="form-control" id="day" name="day">
                                        <option disabled selected hidden value="">Ден</option>
                                        @for ($i = 1; $i <= 31 ; $i++)
                                        <option value="{{ $i }}"{{ (Request::old('day')==$i ? ' selected' : (Auth::user()->day==$i ? ' selected' : '')) }}>{{ $i }}</option>
                                        @endfor
                                    </select>
                                    @if ($errors->has('day'))
                                    <span class='help-block'>{{ $errors->first('day') }}</span>
                                    @endif
                                </div>
                                <div class="col-md-4 col-xs-12">
                                    <select title="Месец на раждане" id="month" class="form-control" name="month">
                                        <option disabled selected hidden value="">Месец</option>
                                        <option value="Януари"{{ (Request::old('month')=='Януари' ? ' selected' : '') }} {{ (Auth::user()->month=='Януари' ? ' selected' : '') }}>Януари</option>
                                        <option value="Февруари"{{ (Request::old('month')=='Февруари' ? ' selected' : '') }} {{ (Auth::user()->month=='Февруари' ? ' selected' : '') }}>Февруари</option>
                                        <option value="Март"{{ (Request::old('month')=='Март' ? ' selected' : '') }} {{ (Auth::user()->month=='Март' ? ' selected' : '') }}>Март</option>
                                        <option value="Април"{{ (Request::old('month')=='Април' ? ' selected' : '') }} {{ (Auth::user()->month=='Април' ? ' selected' : '') }}>Април</option>
                                        <option value="Май"{{ (Request::old('month')=='Май' ? ' selected' : '') }} {{ (Auth::user()->month=='Май' ? ' selected' : '') }}>Май</option>
                                        <option value="Юни"{{ (Request::old('month')=='Юни' ? ' selected' : '') }} {{ (Auth::user()->month=='Юни' ? ' selected' : '') }}>Юни</option>
                                        <option value="Юли"{{ (Request::old('month')=='Юли' ? ' selected' : '') }} {{ (Auth::user()->month=='Юли' ? ' selected' : '') }}>Юли</option>
                                        <option value="Август"{{ (Request::old('month')=='Август' ? ' selected' : '') }} {{ (Auth::user()->month=='Август' ? ' selected' : '') }}>Август</option>
                                        <option value="Септември"{{ (Request::old('month')=='Септември' ? ' selected' : '') }} {{ (Auth::user()->month=='Септември' ? ' selected' : '') }}>Септември</option>
                                        <option value="Октомври"{{ (Request::old('month')=='Октомври' ? ' selected' : '') }} {{ (Auth::user()->month=='Октомври' ? ' selected' : '') }}>Октомври</option>
                                        <option value="Ноември"{{ (Request::old('month')=='Ноември' ? ' selected' : '') }} {{ (Auth::user()->month=='Ноември' ? ' selected' : '') }}>Ноември</option>
                                        <option value="Декември"{{ (Request::old('month')=='Декември' ? ' selected' : '') }} {{ (Auth::user()->month=='Декември' ? ' selected' : '') }}>Декември</option>
                                    </select>
                                    @if ($errors->has('month'))
                                    <span class='help-block'>{{ $errors->first('month') }}</span>
                                    @endif
                                </div>
                                <div class="col-md-4 col-xs-12">
                                    <select title="Година на раждане" id="year" class="form-control" name="year">
                                        <option disabled selected hidden value="">Година</option>
                                        @for ($i = 1905; $i <= 2006 ; $i++)
                                        <option value="{{ $i }}"{{ (Request::old('year')==$i ? ' selected' : (Auth::user()->year==$i ? ' selected' : '')) }}>{{ $i }}</option>
                                        @endfor
                                    </select>
                                    @if ($errors->has('year'))
                                    <span class='help-block'>{{ $errors->first('year') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class='row'>
                        <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                            <label for="phone" class="control-label">Телефонен номер</label>
                            <span class="help-block margin-5-5">Моля, бъдете коректни.</span>
                            <input type="text" title="Телефонен номер" value="{{ Request::old('phone') ?: Auth::user()->phone }}" name="phone" class="form-control" id="phone" placeholder="Пример: 0883600750">
                            @if ($errors->has('phone'))
                            <span class='help-block'>{{ $errors->first('phone') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class='row'>
                        <div class="form-group">
                            <label for="location">Къде живеете?</label>
                            <span class="help-block margin-5-5">Моля използвайте падащото меню.</span>
                            <select class="form-control" id='location' title="Къде живеете?" name="location">
                                <option disabled selected hidden value="">Населено място</option>
                                @foreach($cities as $city)
                                <option value="{{ $city->city_name }}"{{ (Auth::user()->location==$city->city_name ? ' selected' : '') }}>{{ $city->city_name }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('location'))
                            <span class='help-block'>{{ $errors->first('location') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class='row'>
                        <div class="form-group{{ $errors->has('about') ? ' has-error' : '' }}">
                            <label for="about">Кратка информация за вас</label>
                            <span class="help-block margin-5-5">Нужни са поне 10 символа.</span>
                            <textarea class="form-control about-me-area" name='about' id='about' title="Кратка информация за вас" rows="3" placeholder="Напишете каквото пожелаете">{{ Request::old('about') ?: Auth::user()->about }}</textarea>
                            <script type="text/javascript">
                                CKEDITOR.replace('about', {
                                    language:'bg'
                                });
                            </script>
                            @if ($errors->has('about'))
                            <span class='help-block'>{{ $errors->first('about') }}</span>
                            @endif
                        </div>
                    </div>
                    @if(!Auth::user()->picture)
                    <div class='row'>
                        <div class="form-group{{ $errors->has('user_photo') ? ' has-error' : '' }}">
                            <label for="user_photo" class="control-label">Добавете профилна снимка</label>
                            <span class="help-block margin-5-5">Разрешени разширения са: .jpg, .jpeg, .png</span>
                            <div id="result"></div>
                            <button type="button" class="btn-block btn btn-default margin-top-10 margin-bottom-10" id="clear">Премахнете снимката</button>
                            <div id="alert">Добавихте повече от 9 снимки.</div>
                            <div class="input-group">
                                <span class="input-group-btn">
                                    <span class="btn btn-primary btn-file">
                                        Изберете <input accept="image/png, image/jpeg" name="user_photo" id="files" type="file">
                                    </span>
                                </span>
                                <input type="text" value="" id="representer" class="form-control" readonly title="Добавете една снимка">
                            </div> 
                            @if ($errors->has('user_photo'))
                            <span class='help-block'>{{ $errors->first('user_photo') }}</span>
                            @endif
                        </div>
                    </div>
                    @endif
                    <div class='row'>
                        <div class="form-group">
                            <button type="submit" class="btn btn-default btn-lg">
                                Подновете
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
