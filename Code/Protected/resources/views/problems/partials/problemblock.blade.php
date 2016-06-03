@if($problem->state($problem->id) == 1)
<div class="col-md-12 col-xs-12 margin-top-20 problem-holder colorfff block-border top-waiting">
@elseif($problem->state($problem->id) == 2)
<div class="col-md-12 col-xs-12 margin-top-20 problem-holder colorfff block-border top-success">
@else($problem->state($problem->id) == 0)
<div class="col-md-12 col-xs-12 margin-top-20 problem-holder colorfff block-border top-danger">
@endif
    <div class="row">
        <div class="col-lg-12 margin-top-15">
            <div class='row margin-bottom-14 margin-top--18 margin-left-4'>
                <a 
                    @if($problem->state($problem->id) == 1)
                    class="problem-category pending-category"
                    @elseif($problem->state($problem->id) == 2)
                    class="problem-category solved-category"
                    @else
                    class="problem-category unsolved-category"
                    @endif
                    href="{{ route('sort.category', [$problem->categoryslug()]) }}"><span class="hsfield">{{ $problem->category }}</span></a>
            </div>
            <div class="row">    
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
                            <div class="col-lg-12">
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
                                @if(Auth::check() && (Auth::user()->id == $problem->user_id || Auth::user()->is_admin == 1))
                                <li><a href="{{ route('problem.delete', ['id'=>$problem->id]) }}" onclick="if (!confirm('Веднъж изтрит, проблемът не може да бъде възобновен. Сигурни ли сте?'))
                                            return false;">Изтрийте проблема</a></li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
            </div>    
        </div>    
    </div> 
    <div class="row">
        <div class="col-lg-5 col-md-12">
            @if($problem->pictures->first())
            <a href="{{ route('problem.custom', ['id'=>$problem->id]) }}" class="index-image-holder">
                <img alt="Снимка на проблем" class="index-image" src="./images/problemphotos/{{ $problem->pictures->first()->picture_name }}" />
            </a>
            @else
            <div class="videos">
            <a href="{{ route('problem.custom', ['id'=>$problem->id]) }}" class="video index-image-holder">
                <span></span>
                <img alt="Миниатюра от видео на проблем" class="index-image" src="{{ $problem->video->getVideoThumbnail() }}" />
            </a>
            </div>
            @endif
        </div>
        <div class="col-lg-7 margin-top-responsive col-md-12">
            <div class="problem-head-p hsfield"><b><a class="just-link" href="{{ route('problem.custom', ['id'=>$problem->id]) }}">{{ str_limit($problem->problem_title, 59) }}</a></b></div>
            <div class="problem-head-p more margin-top-10 hsfield">{!! $problem->problem_description !!}</div>
            <div class="margin-top-6"><span class="glyphicon glyphicon-map-marker margin-left--4 color666"></span><span class="margin-left-3 color666 hsfield"><b>{{ str_limit($problem->location, 75) }}</b></span></div>
        </div>
    </div>
    <div class="row margin-top-5">
        <div class="col-lg-12">
            @if(count($problem->comments->where('problem_id', $problem->id)->where('parent_id', null))==0)
            <p class='link comment-decor'>
                @else
            <p class='link show-prob-com comment-decor'>
                @endif
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
                    @if(Counter::show('customimg', $problem->id) == 1)
                    {{ Counter::show('customimg', $problem->id) }} Преглед
                    @else
                    {{ Counter::show('customimg', $problem->id) }} Прегледа
                    @endif
                </span>
            </p>   
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 margin-top--10 padding-bottom-10">
            <ul class="list-inline interaction-wrapper">
                <li class="margin-right-12"><a target='_blank' title="Споделете във Facebook" id='facebookbtn-link' href="https://www.facebook.com/sharer/sharer.php?u={{ route('problem.custom', ['id'=>$problem->id]) }}&title={{ $problem->problem_title }}" class="face-hover social-media-face"><b>Facebook</b></a></li>
                <li class="margin-right-12 "><a target='_blank' title="Споделете в Google+" id='google-link' href="https://plus.google.com/share?url={{ route('problem.custom', ['id'=>$problem->id]) }}" class="plus-hover social-media-plus"><b>Google+</b></a></li>
                <li class="margin-right-12"><a target='_blank' title="Споделете в Twitter" id='twitterbtn-link' href='https://twitter.com/intent/tweet?status={{ $problem->problem_title }}+{{ route('problem.custom', ['id'=>$problem->id]) }}' class="twitter-hover social-media-tweet"><b>Twitter</b></a></li>
            </ul> 
        </div>
    </div>
    <div class='row hidden' id='prob-com'>
        <div class='col-lg-12 col-sm-12 col-md-12 col-xs-12 comment-background padding-top-5'>                               
            <ul class="media-list margin-top-10">
                <!-- comments start-->  
                <!-- comment start -->    
                @foreach($problem->comments as $comment)
                @if($comment->problem_id == $problem->id && !$comment->parent_id)
                <li class="media margin-top-10">
                    <div class="media-left text-center">
                        <a title="Профилна снимка" href='{{ route('user.index', ['id' => $comment->user_id]) }}' class="problem-comment-holder">
                            @if($comment->user->picture)
                            <img alt="Профилна снимка на потребител" class="problem-comment" src="./images/userphotos/{{ $comment->user->picture->picture_name }}">
                            @else
                            <img class="problem-comment" src="https://gravatar.com/avatar/md5({{ $comment->user->first_name }})?d=mm&s=40">
                            @endif
                        </a>
                    </div>
                    <div class="media-body reply-form">
                        <a title="{{ $comment->user->first_name }} {{ $comment->user->last_name }}" href='{{ route('user.index', ['id' => $comment->user_id]) }}' class="just-link"><h4 class="media-heading problem-author">{{ $comment->user->first_name }} {{ $comment->user->last_name }}</h4></a>
                        <div class="row">
                            <div class="col-lg-12">
                                <p>{{ $comment->comment_body }}</p>
                            </div>
                        </div>
                        <p><span class="glyphicon glyphicon-thumbs-up thumbs"></span><span class='thumbs-count'>{{ $comment->likes->count() }}</span> &bull; <span class='time'>{{ $comment->created_at->diffForHumans() }}</span></p>                          
                        <div  class="reply-pattern">
                            <ul class="media-list margin-top-10">
                                <!-- replies start-->
                                @foreach($problem->comments as $reply)
                                @if($reply->problem_id == $problem->id && $comment->id == $reply->parent_id)
                                <!-- reply start -->    
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
                                            <div class="col-lg-12">
                                                <p>{{ $reply->comment_body }}</p>
                                            </div>
                                        </div>
                                        <p>
                                            <span class="glyphicon glyphicon-thumbs-up thumbs"></span><span class='thumbs-count'>{{ $reply->likes->count() }}</span> &bull; <span class='time'>{{ $reply->created_at->diffForHumans() }}</span>
                                        </p>                          
                                    </div>
                                </li>
                                <!-- reply end -->   
                                @endif
                                @endforeach
                                <!-- replies end -->
                            </ul>
                        </div>
                    </div>
                </li>
                @endif
                @endforeach
                <!-- comment end -->    
                <!-- comments end -->  
            </ul>
        </div>    
    </div>                       
    
</div>
