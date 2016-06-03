@extends ('templates.default')
@section('content')
<!-- Popup containing people who have liked the comment -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="exampleModalLabel">Хора, харесали проблема</h4>
            </div>
            <div class="modal-body">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 margin-top-10 float-free">
                    @foreach($problem->likes as $person)
                    <div class='row'>
                        @include('user.partials.userblock')
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Затворете</button>
            </div>
        </div>
    </div>
</div>

<div class='container'>
    @include('templates.partials.alerts')
<div class="col-lg-12">
    <div class="row">
    <nav class="margin-top--20 margin-bottom--10">
        <ul class="pager">
          @if(!$previous)
          <li class="previous disabled"><a><span aria-hidden="true">←</span> Предишен</a></li>
          @else
          <li class="previous"><a href="{{ route('problem.custom', ['id'=>$previous]) }}"><span aria-hidden="true">←</span> Предишен</a></li>
          @endif
          @if(!$next)
          <li class="next disabled"><a>Следващ <span aria-hidden="true">→</span></a></li>
          @else
          <li class="next"><a href="{{ route('problem.custom', ['id'=>$next]) }}">Следващ <span aria-hidden="true">→</span></a></li>
          @endif
        </ul>
    </nav>
    </div>
    <div class='row'>   
        @if($problem->state($problem->id) == 1)
        <div class="col-md-7 col-sm-12 margin-top-10 colorfff block-border top-waiting">
        @elseif($problem->state($problem->id) == 2)
        <div class="col-md-7 col-sm-12 margin-top-10 colorfff block-border top-success">
        @else($problem->state($problem->id) == 0)
        <div class="col-md-7 col-sm-12 margin-top-10 colorfff block-border top-danger">
        @endif
            <div class='row margin-top-15 border-b-body'>
                <div class='margin-bottom-14 margin-top--18 margin-left-4'>
                    <a 
                        @if($problem->state($problem->id) == 1)
                        class="problem-category pending-category"
                        @elseif($problem->state($problem->id) == 2)
                        class="problem-category solved-category"
                        @else
                        class="problem-category unsolved-category"
                        @endif
                        href="{{ route('sort.category', [$problem->categoryslug()]) }}"><span >{{ $problem->category }}</span></a>
                </div>
                @if($problem->pictures->first())
                @foreach($problem->pictures as $picture)
                <div class='col-md-4 col-sm-12 text-center'><a href='./images/problemphotos/{{ $picture->picture_name }}' class='prob-img-holder fancybox' data-fancybox-group="gallery" title="От {{ $problem->user_fullname ?: 'Анонимен потребител' }} {{ $problem->created_at->diffForHumans() }}"><img class='prob-img' alt="Снимка на проблем" src='./images/problemphotos/{{ $picture->picture_name }}' /></a></div>
                @endforeach   
                @else
                <div class='col-md-12'>
                    <div class="embed-container">
                        <iframe src="https://player.vimeo.com/video/{{ $problem->video->video_id }}" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
                    </div>
                </div>
                @endif
            </div>    
            <div class="row border-b-body margin-top-10">    
                <div class="col-lg-11 col-md-10 col-sm-10 col-xs-10">
                    <div class="media-left text-center">
                        @if($problem->user_id)
                        <a title="Профилна снимка" href="{{ route('user.index', ['id'=>$problem->user_id]) }}" class="problem-comment-holder" >
                            @endif
                            @if(!$problem->user)
                            <img class="problem-comment" src="https://gravatar.com/avatar/md5({{ $problem->problem_title }})?d=mm&s=40">
                            @else
                            @if($problem->user->picture)
                            <img class="problem-comment" alt="Профилна снимка на потребител" src="./images/userphotos/{{ $problem->user->picture->picture_name }}">
                            @else
                            <img class="problem-comment" src="https://gravatar.com/avatar/md5({{ $problem->user_email }})?d=mm&s=40">
                            @endif
                            @endif
                            @if($problem->user_id)
                        </a>
                        @endif
                    </div>
                    <div class="media-body">
                        @if($problem->user_id)
                        <a title="{{ $problem->user->getFirstAndLastName() }}" href="{{ route('user.index', ['id'=>$problem->user->getId()]) }}" class="just-link" >
                            <h4 class="media-heading problem-author">{{ $problem->user->getFirstAndLastName() }}</h4>
                        </a>    
                        @else
                        @if($problem->user_fullname)
                        <h4 class="media-heading problem-author">{{ $problem->user_fullname }} <small>(нерегистриран/а)</small></h4>
                        @else
                        <h4 class="media-heading problem-author">Анонимен потребител</h4>
                        @endif
                        @endif
                        <div class="row">
                            <div class="col-lg-11 col-md-10 col-sm-11 col-xs-10">
                                <p>
                                    <span class="problem-location">
                                        @if($problem->user && $problem->user->location)
                                        {{ $problem->user->location }}
                                        @endif
                                    </span>
                                    @if($problem->user && $problem->user->location)
                                    · 
                                    @endif
                                    <a href="{{ route('problem.custom', ['id'=>$problem->id]) }}" class="just-link"><span class="problem-location">{{ $problem->created_at->diffForHumans() }}</span></a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>    
                <div class="col-lg-1 col-md-2 col-sm-2 col-xs-2 text-right margin-left--13 margin-top--7">
                    <div class="row">
                        <div class="dropdown">
                            <button class="dropdown-toggle colorfff no-border" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu1">
                                @if($problem->state($problem->id) == 0)
                                <li><a href="{{ route('add.solution', ['id'=>$problem->id]) }}">Реших проблема</a></li>
                                @endif
                                <li><a href='{{ route('problem.custom', ['id'=>$problem->id]) }}'>Прегледайте проблема</a></li>
                                @if(Auth::check() && (Auth::user()->id == $problem->user_id || Auth::user()->is_admin == 1))
                                <li><a href="{{ route('problem.edit', ['id' => $problem->id]) }}">Редактирайте проблема</a></li>
                                @endif
                                @if(Auth::check() && !Auth::user()->hasReportedProblem($problem) && Auth::user()->id != $problem->user_id)
                                <li><a onclick="if (!confirm('На път сте да отбележете проблема като неподходящ или спам. Сигурни ли сте?'))
                                            return false;" href="{{ route('problem.report', ['id'=>$problem->id]) }}">Докладвайте проблема</a></li>
                                @endif
                                @if(Auth::check() && (Auth::user()->id == $problem->user_id || Auth::user()->is_admin == 1 ))
                                <li><a href="{{ route('problem.delete', ['id'=>$problem->id]) }}" onclick="if (!confirm('Веднъж изтрит, проблемът не може да бъде възобновен. Сигурни ли сте?'))
                                            return false;">Изтрийте проблема</a></li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class='row border-b-body'>
                <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>
                    <h4>Проблем</h4>
                    <p>{{ $problem->problem_title }}</p>
                </div>
            </div>
            <div class='row border-b-body'>
                <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>
                    <h4>Описание</h4>
                    <p>{!! $problem->problem_description ? : 'Потребителят не е добавил описание.' !!}</p>
                </div>
            </div>
            <div class='row border-b-body'>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="col-lg-8 col-md-8 col-sm-6 col-xs-6">
                        <h4 class='problem-subtitle'>
                            Място
                        </h4>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6 text-right">
                        <span class="click link">
                            вижте на карта
                        </span>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 margin-bottom-6">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <span class="glyphicon glyphicon-map-marker margin-left--11"></span>
                        <span class="margin-left-3 size14"><b>{{ $problem->location }}</b></span>
                    </div>
                </div>
            </div>
            <div class="row ">
                <iframe
                    id="map" class="hidden" 
                    frameborder="0" style="border:0"
                    src="https://www.google.com/maps/embed/v1/place?key=AIzaSyAMPenOp_YY_szPqqbTzNWX79CGXYV0roU&q={{ $problem->location }}" allowfullscreen>
                </iframe>
            </div>
            <div class="row padding-top-5">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <p>
                        @if($problem->likes->count() == 0)
                        <span>
                            @if($problem->likes->count() == 1)
                            {{ $problem->likes->count() }} човек
                            @else
                            {{ $problem->likes->count() }} души
                            @endif 
                        </span> 
                        @else
                        <a href="#" class="link" data-toggle="modal" data-target="#myModal">
                            @if($problem->likes->count() == 1)
                            {{ $problem->likes->count() }} човек
                            @else
                            {{ $problem->likes->count() }} души
                            @endif 
                        </a> 
                        @endif
                        @if($problem->likes->count() == 1)
                        харесва
                        @else
                        харесват
                        @endif 
                        това
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <p class='show-prob-com link comment comment-decor'>
                        <span class="problem-l-c">
                            @if($problem->likes->count() == 1)
                            {{ $problem->likes->count() }} Харесване
                            @else
                            {{ $problem->likes->count() }} Харесвания
                            @endif
                        </span> 
                        <span class="problem-l-c">
                            @if(count($problem->comments->where('problem_id', $problem->id)->where('parent_id', null)) == 1) 
                            {{ count($problem->comments->where('problem_id', $problem->id)->where('parent_id', null)) }} Коментар
                            @else
                            {{ count($problem->comments->where('problem_id', $problem->id)->where('parent_id', null)) }} Коментара
                            @endif
                        </span> 
                        <span class="problem-l-c">
                            @if(Counter::showAndCount('customimg', $problem->id) == 1)
                            {{ Counter::showAndCount('customimg', $problem->id) }} Преглед
                            @else
                            {{ Counter::showAndCount('customimg', $problem->id) }} Прегледа
                            @endif
                        </span>
                    </p>   
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 margin-top--10 padding-bottom-10">
                    <ul class="list-inline interaction-wrapper">
                        @if(Auth::check())
                        @if( Auth::user()->hasLikedProblem($problem) == false )
                        <li class="margin-right-12"><a href='{{ route('problem.like', ['problemId'=>$problem->id]) }}' class="statuslikes color777"><span class="glyphicon glyphicon-thumbs-up color777 margin-right-4"></span>Харесвам</a></li>
                        @else
                        <li class="margin-right-12"><a href='{{ route('problem.dislike', ['problemId'=>$problem->id]) }}' class="statuslikes color777"><span class="glyphicon glyphicon-thumbs-down color777 margin-right-4"></span>Отхаресвам</a></li>
                        @endif
                        @else
                        <li class="margin-right-12"><a class="link statuslikes color777" onClick="alert('Трябва да се регистрирате, за да използвате функцията!')"><span class="glyphicon glyphicon-thumbs-up color777 margin-right-4"></span>Харесвам</a></li>
                        @endif                    
                        <li class="margin-right-12 comment statuslikes color777 link"><span class="glyphicon glyphicon-comment color777 margin-right-4"></span>Коментар</li>
                    </ul> 
                </div>
            </div>
            <div class='row' id='prob-com'>
                <div class='col-lg-12 col-sm-12 col-md-12 col-xs-12 comment-background padding-top-5'>                               
                    <ul class="media-list margin-top-10">
                        <!-- Comment input field start -->    
                        <li class="media comment-sep">
                            <div class="media-left text-center">
                                @if(Auth::check())
                                <a title="Профилна снимка" class="problem-comment-holder" href='{{ route('user.index', ['id' => Auth::user()->id]) }}'>
                                @else
                                <a class="problem-comment-holder">
                                    @endif
                                    @if(Auth::check())
                                        @if(Auth::user()->picture)
                                        <img alt="Профилна снимка на потребител" class="problem-comment" src="./images/userphotos/{{ Auth::user()->picture->picture_name }}">
                                        @else
                                        <img class="problem-comment" src="https://gravatar.com/avatar/md5({{ $problem->user_email }})?d=mm&s=40">
                                        @endif
                                    @else
                                    <img class="problem-comment" src="https://gravatar.com/avatar/md5({{ $problem->user_email }})?d=mm&s=40">
                                    @endif
                                </a>
                            </div>
                            <div class="media-body">
                                @if($errors->has("comment-{$problem->id}"))
                                <div class='form-group has-error' >
                                @else
                                <div class='form-group' >
                                    @endif
                                    @if(Auth::check())
                                    <form role="form" class="commnent-form" action="{{ route('comment.problem', ['problemId'=>$problem->id]) }}" method="post">
                                        <textarea id='prob-com-input' style="resize:vertical;" required title="Напишете коментар..." name="comment-{{ $problem->id }}" class="form-control transliterate" placeholder="Напишете коментар..."></textarea>
                                        <div class="phoholder" style="float:right; margin:0px !important;">
                                            <div class="pho photext current" title="Активна кирилица с фонетична клавиатура."></div>
                                            <div class="pho bdstext" style="display: none;" title="Активна кирилица с БДС клавиатура."></div>
                                            <div class="pho offtext" style="display: none;" title="Кирилизаторът е изключен."></div>
                                        </div>
                                        <input type="hidden" name="_token" value="{{ Session::token() }}">
                                        @if($errors->has("comment-{$problem->id}"))
                                        <span class='help-block'>{{ $errors->first("comment-{$problem->id}") }}</span>
                                        @endif
                                    </form>  
                                    @else
                                    <input type="text" name="comment-{{ $problem->id }}" class="form-control comment-input" disabled placeholder="Влезте в профила си, за да коментирате.">
                                    @endif
                                </div>
                            </div>
                        </li>
                        <!-- Comment input field end -->  
                        <!-- Comments start-->  
                        <!-- Comment start -->    
                        @foreach($problem->comments as $comment)
                        @if($comment->problem_id == $problem->id && !$comment->parent_id)
                        <li class="media margin-top-10">
                            <div class="media-left text-center">
                                <a title="Профилна снимка" href='{{ route('user.index', ['id' => $comment->user_id]) }}' class="problem-comment-holder">
                                    @if($comment->user->picture)
                                    <img alt="Профилна снимка на потребител" class="problem-comment" src="./images/userphotos/{{ $comment->user->picture->picture_name }}">
                                    @else
                                    <img class="problem-comment" src="https://gravatar.com/avatar/md5({{ $comment->user->firstname }})?d=mm&s=40">
                                    @endif
                                </a>
                            </div>
                            <div class="media-body reply-form">
                                <a title="{{ $comment->user->first_name }} {{ $comment->user->last_name }}" href='{{ route('user.index', ['id' => $comment->user_id]) }}' class="just-link"><h4 class="media-heading problem-author">{{ $comment->user->first_name }} {{ $comment->user->last_name }}</h4></a>
                                <div class="row">
                                    @if(Auth::check() && !Auth::user()->hasReportedComment($comment))
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <p>{{ $comment->comment_body }}</p>
                                    </div>
                                    @else
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <p>{{ $comment->comment_body }}</p>
                                    </div>
                                    @endif
                                   
                                </div>
                                <p>
                                     
                                    @if(Auth::check())
                                        @if( Auth::user()->hasLikedComment($comment) == false )
                                        <a href='{{ route('comment.like', ['commentId'=>$comment->id]) }}'>Харесвам</a>
                                        @else
                                        <a href='{{ route('comment.dislike', ['commentId'=>$comment->id]) }}'>Отхаресвам</a>
                                        @endif
                                    @else
                                        <a class="link" onClick="alert('Трябва да се регистрирате, за да използвате функцията!')">Харесвам</a>
                                    @endif

                                    &bull; <a class="link clickreply">Отговор</a> &bull;<span class="glyphicon glyphicon-thumbs-up thumbs"></span><span class='thumbs-count'>{{ $comment->likes->count() }}</span> &bull; <span class='time'>{{ $comment->created_at->diffForHumans() }}</span>
                                </p> 
                                    @if(Auth::check() && !Auth::user()->hasReportedComment($comment))   
                                <p class="margin-top--10">             
                                    @if(Auth::user()->id == $comment->user_id || Auth::user()->is_admin == 1)
                                                    <a href="{{ route('delete.comment', ['id' => $comment->id]) }}" onclick="if (!confirm('Веднъж изтрит, коментарът не може да бъде възобновен. Сигурни ли сте?'))
                                                                return false;">Изтрийте коментара</a>
                                                    @else
                                                        @if(!Auth::user()->hasReportedComment($comment))
                                                        <a onclick="if (!confirm('На път сте да отбележете коментара като неподходящ или спам. Сигурни ли сте?'))
                                            return false;" href="{{ route('comment.report', ['id'=>$comment->id]) }}">Докладвайте коментара</a>
                                                        @endif
                                                    @endif
                                </p>
                                    @endif
                                <div  class="reply-pattern">
                                    <ul class="media-list margin-top-10">
                                        <!-- Reply input field start -->    
                                        <li class="media comment-sep hidden" id='replyformwrapper'>
                                            <div class="media-left text-center">
                                                @if(Auth::check())
                                                <a title="Профилна снимка" class="problem-comment-holder" href='{{ route('user.index', ['id' => Auth::user()->id]) }}'>
                                                @else
                                                <a class="problem-comment-holder">
                                                @endif
                                                @if(Auth::check())
                                                    @if(Auth::user()->picture)
                                                    <img class="problem-comment" alt="Профилна снимка на потребител" src="./images/userphotos/{{ Auth::user()->picture->picture_name }}">
                                                    @else
                                                    <img class="problem-comment" src="https://gravatar.com/avatar/md5({{ $problem->user_email }})?d=mm&s=40">
                                                    @endif
                                                @else
                                                    <img class="problem-comment" src="https://gravatar.com/avatar/md5({{ $problem->user_email }})?d=mm&s=40">
                                                @endif
                                                </a>
                                            </div>
                                            <div class="media-body">
                                            @if($errors->has("reply-{$problem->id}-{$comment->id}"))
                                            <div class='form-group has-error' >
                                            @else
                                                <div class='form-group' >
                                                    @endif
                                                    @if(Auth::check())
                                                    <form role="form" class="commnent-form" action="{{ route('reply.comment', ['problemId'=>$problem->id, 'parentId'=>$comment->id]) }}" method="post">
                                                        <textarea required style="resize:vertical;" title="Напишете отговор..." name="reply-{{ $problem->id }}-{{ $comment->id }}" class="form-control transliterate" id="reply" placeholder="Напишете отговор..."></textarea>
                                                        <div class="phoholder" style="float:right; margin:0px !important;">
                                                            <div class="pho photext current" title="Активна кирилица с фонетична клавиатура."></div>
                                                            <div class="pho bdstext" style="display: none;" title="Активна кирилица с БДС клавиатура."></div>
                                                            <div class="pho offtext" style="display: none;" title="Кирилизаторът е изключен."></div>
                                                        </div>
                                                        <div class="clearfix"></div>
                                                        <input type="hidden" name="_token" value="{{ Session::token() }}">
                                                        @if($errors->has("reply-{$problem->id}-{$comment->id}"))
                                                        <span class='help-block'>{{ $errors->first("reply-{$problem->id}-{$comment->id}") }}</span>
                                                        @endif
                                                    </form>  
                                                    @else
                                                    <input type="text" name="comment-{{ $problem->id }}" class="form-control comment-input" disabled placeholder="Влезте в профила си, за да коментирате.">
                                                    @endif
                                                </div>
                                            </div>
                                        </li>
                                        <!-- Reply input field end -->   
                                        <!-- Replies start -->
                                        @foreach($problem->comments as $reply)
                                        @if($reply->problem_id == $problem->id && $comment->id == $reply->parent_id)
                                        <!-- Reply start -->    
                                        <li class="media margin-top-10">
                                            <div class="media-left text-center">
                                                <a title="Профилна снимка" href='{{ route('user.index', ['id' => $reply->user_id]) }}' class="problem-comment-holder">
                                                    @if($reply->user->picture)
                                                    <img alt="Профилна снимка на потребител" class="problem-comment" src="./images/userphotos/{{ $reply->user->picture->picture_name }}">
                                                    @else
                                                    <img class="problem-comment" src="https://gravatar.com/avatar/md5({{ $reply->user->first_name }})?d=mm&s=40">
                                                    @endif
                                                </a>
                                            </div>
                                            <div class="media-body">
                                                <a title="{{ $reply->user->first_name }} {{ $reply->user->last_name }}" href='{{ route('user.index', ['id' => $reply->user_id]) }}' class="just-link"><h4 class="media-heading problem-author">{{ $reply->user->first_name }} {{ $reply->user->last_name }}</h4></a>
                                                <div class="row">
                                                    @if(Auth::check() && !Auth::user()->hasReportedComment($reply))
                                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                        <p>{{ $reply->comment_body }}</p>
                                                    </div>
                                                    @else
                                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                        <p>{{ $reply->comment_body }}</p>
                                                    </div>
                                                    @endif
                                                    
                                                </div>
                                                <p>
                                                    
                                                    @if(Auth::user())
                                                        @if( Auth::user()->hasLikedComment($reply) == false )
                                                        <a href='{{ route('comment.like', ['commentId'=>$reply->id]) }}'>Харесвам</a>
                                                        @else
                                                        <a href='{{ route('comment.dislike', ['commentId'=>$reply->id]) }}'>Отхаресвам</a>
                                                        @endif
                                                    @else
                                                        <a class="link" onClick="alert('Трябва да се регистрирате, за да използвате функцията!')">Харесвам</a>
                                                    @endif
                                                    &bull;<span class="glyphicon glyphicon-thumbs-up thumbs"></span><span class='thumbs-count'>{{ $reply->likes->count() }}</span> &bull; <span class='time'>{{ $reply->created_at->diffForHumans() }}</span>
                                                </p>   
                                                    @if(Auth::check() && !Auth::user()->hasReportedComment($reply))  
                                                <p class="margin-top--10">              
                                                    @if(Auth::user()->id == $reply->user_id || Auth::user()->is_admin == 1)
                                                                        <a href="{{ route('delete.comment', ['id' => $reply->id]) }}" onclick="if (!confirm('Веднъж изтрит, отговорът не може да бъде възобновен. Сигурни ли сте?'))
                                                                                    return false;">Изтрийте отговора</a>
                                                                    @else
                                                                        @if(!Auth::user()->hasReportedComment($reply))
                                                                        <a onclick="if (!confirm('На път сте да отбележете коментара като неподходящ или спам. Сигурни ли сте?'))
                                            return false;" href="{{ route('comment.report', ['id'=>$reply->id]) }}">Докладвайте отговора</a>
                                                                        @endif
                                                                    @endif
                                                </p>
                                                    @endif
                                            </div>
                                        </li>
                                        <!-- Reply end -->   
                                        @endif
                                        @endforeach
                                        <!-- Replies end -->
                                    </ul>
                                </div>
                            </div>
                        </li>
                        @endif
                        @endforeach
                        <!-- Comment end -->    
                        <!-- Comments end -->  
                    </ul>
                </div>    
            </div>            
        </div>
        <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12 colorfff margin-top-10" id="border-responsive">
            <div class='row colorfff block-border'>
                <div class='col-lg-12'>
                    <div class='condition'><span class='size18'>Статус</span>
                        @if(!$problem->solution)
                        <span class='glyphicon glyphicon-remove margin-left-15 color-danger'></span><span class='margin-left-3 color-danger'>Проблемът не е решен</span>
                        @elseif($problem->solution->solution_condition == 1)
                        <span class='glyphicon glyphicon-transfer margin-left-15 color-waiting'></span><span class='margin-left-3 color-waiting'>Решението чака потвърждение</span>
                        @elseif($problem->solution->solution_condition == 2)
                        <span class='glyphicon glyphicon-ok margin-left-15 color-success'></span><span class='margin-left-3 color-success'>Проблемът е решен</span>
                        @else
                        Нещо се е объркало
                        @endif
                    </div>
                    @if($problem->solution && ($problem->solution->solution_condition == 1 || $problem->solution->solution_condition == 2))
                    <a href='./images/solutionphotos/{{ $problem->solution->picture->picture_name }}' class='fancybox sol-image-holder' data-fancybox-group="solutions" title="От {{ $problem->solution->user_fullname ?: 'Анонимен потребител' }} {{ $problem->solution->created_at->diffForHumans() }}"><img class='sol-image' alt="Снимка на решение" src="./images/solutionphotos/{{ $problem->solution->picture->picture_name }}"></a>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 margin-top-15">
                            <div class="row">   
                                @if(Auth::check() && !Auth::user()->hasReportedSolution($problem->solution))
                                <div class="col-lg-11 col-md-10 col-sm-10 col-xs-10">
                                    @else
                                    <div class="col-lg-12">
                                        @endif
                                        <div class="media-left text-center">
                                            @if($problem->solution->user_id)
                                            <a title="Профилна снимка" href="{{ route('user.index', ['id'=>$problem->solution->user->getId()]) }}" class="problem-comment-holder" >
                                                @endif
                                                @if(!$problem->solution->user)
                                                <img class="problem-comment" src="https://gravatar.com/avatar/md5({{ $problem->solution->solution_description }})?d=mm&s=40">
                                                @else
                                                @if($problem->solution->user->picture)
                                                <img class="problem-comment" alt="Профилна снимка на потребител" src="./images/userphotos/{{ $problem->solution->user->picture->picture_name }}">
                                                @else
                                                <img class="problem-comment" src="https://gravatar.com/avatar/md5({{ $problem->solution->solution_description }})?d=mm&s=40">
                                                @endif
                                                @endif
                                                @if($problem->solution->user_id)
                                            </a>
                                            @endif
                                        </div>
                                        <div class="media-body">
                                            @if($problem->solution->user_id)
                                            <a title="{{ $problem->solution->user->getFirstAndLastName() }}" href="{{ route('user.index', ['id'=>$problem->solution->user->getId()]) }}" class="just-link" >
                                                <h4 class="media-heading problem-author">{{ $problem->solution->user->getFirstAndLastName() }}</h4>
                                            </a>    
                                            @endif
                                            @if(!$problem->solution->user_id)
                                            @if($problem->solution->user_fullname)
                                            <h4 class="media-heading problem-author">{{ $problem->solution->user_fullname }} <small>(нерегистриран/а)</small></h4>
                                            @else
                                            <h4 class="media-heading problem-author">Анонимен потребител</h4>
                                            @endif
                                            @endif
                                            <div class="row">
                                                <div class="col-lg-11 col-md-10 col-sm-11 col-xs-10">
                                                    <p>
                                                        <span class="problem-location">
                                                            @if($problem->solution->user && $problem->solution->user->location)
                                                            {{ $problem->solution->user->location }}
                                                            @endif
                                                        </span>
                                                        @if($problem->solution->user && $problem->solution->user->location)
                                                        · 
                                                        @endif
                                                        <a class="just-link"><span class="problem-location">{{ $problem->solution->created_at->diffForHumans() }}</span></a>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>   
                                    @if(Auth::check() && !Auth::user()->hasReportedSolution($problem->solution))
                                    <div class="col-lg-1 col-md-2 col-sm-2 col-xs-2 text-right margin-left--13 margin-top--7">
                                        <div class="row">
                                            <div class="dropdown">
                                                <button class="dropdown-toggle colorfff no-border" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                    <span class="caret"></span>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu1">
                                                    @if(!Auth::user()->hasReportedSolution($problem->solution) && Auth::user()->id != $problem->solution->user_id)
                                                    <li><a onclick="if (!confirm('На път сте да отбележете решението като неподходящ или спам. Сигурни ли сте?'))
                                            return false;" href="{{ route('solution.report', ['id'=>$problem->solution->id]) }}">Докладвайте решението</a></li>
                                                    @endif
                                                    @if(Auth::user()->id == $problem->solution->user_id || Auth::user()->is_admin == 1)
                                                    <li>
                                                        <a href="{{ route('solution.delete', ['id'=>$problem->solution->id]) }}" onclick="if (!confirm('Веднъж изтрито, решението не може да бъде възобновено. Сигурни ли сте?'))
                                                                    return false;">Изтрийте решението
                                                        </a>
                                                    </li>
                                                    @endif
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                </div>    
                            </div>    
                        </div> 
                        <div class='row'>
                            <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>
                                <h4>Описание</h4>
                                <p>{!! $problem->solution->solution_description !!}</p>
                            </div>
                        </div>
                        @else
                        <div>
                            <a class='btn btn-success btn-small problem-solved' href='{{ route('add.solution', ['id'=>$problem->id]) }}'>Реших проблема</a>
                        </div>
                        @endif
                        @if($problem->solution && ($problem->solution->solution_condition == 1 && Auth::check() && (Auth::user()->id == $problem->user_id || Auth::user()->is_admin == 1)))
                        <div class='row'>
                            <div class='margin-right-15'>
                                <a href='{{ route('decline.solution', ['id'=> $problem->solution->id]) }}' class='btn btn-danger btn-small float-right margin-bottom-14'>Нерешен</a>
                                <a href='{{ route('approve.solution', ['id'=> $problem->solution->id]) }}' class='btn btn-success btn-small float-right margin-bottom-14 margin-right-10'>Решен</a>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
                <div class='row colorfff block-border'>
                    <div class="col-lg-12 border-social">
                        <li id="face" class="share-button margin-left-7"></li>
                        <a target='_blank' title="Споделете във Facebook" id='facebookbtn-link' class="face-hover" href="https://www.facebook.com/sharer/sharer.php?u={{ route('problem.custom', ['id'=>$problem->id]) }}&title={{ $problem->problem_title }}">
                            <h4 class="margin-left-7 social-media-face">Споделете във Facebook</h4>
                        </a>
                    </div>
                    <div class="col-lg-12 border-social">
                        <li id="plus" class="share-button margin-left-7"></li>
                        <a target='_blank' title="Споделете в Google+" id='google-link' class="plus-hover" href="https://plus.google.com/share?url={{ route('problem.custom', ['id'=>$problem->id]) }}">
                            <h4 class="margin-left-7 social-media-plus">Споделете в Google+</h4>
                        </a>
                    </div>
                    <div class="col-lg-12 border-social">
                        <li id="tweet" class="share-button margin-left-7"></li>
                        <a target='_blank' title="Споделете в Twitter" id='twitterbtn-link' class="twitter-hover" href="https://twitter.com/intent/tweet?status={{ $problem->problem_title }}+{{ route('problem.custom', ['id'=>$problem->id]) }}">
                            <h4 class="margin-left-7 social-media-tweet">Споделете в Twitter</h4>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
