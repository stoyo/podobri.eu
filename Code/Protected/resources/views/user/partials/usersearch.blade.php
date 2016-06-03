<div class="media colorfff block-border padding-3per">
    <div class="media-left">
        <a title="Профилна снимка" href="{{ route('user.index', ['id'=>$user->id]) }}">
            @if($user->picture)
            <img class="problem-comment" src="./images/userphotos/{{ $user->picture->picture_name }}" alt="Профилна снимка на потребител">
            @else
            <img class="problem-comment" src="https://gravatar.com/avatar/md5({{ $user->email }})?d=mm&s=40" alt="Профилна снимка на потребител">
            @endif
        </a>
    </div>
    <div class="media-body">
        <a title="{{ $user->getFirstAndLastName() }}" href="{{ route('user.index', ['id'=>$user->id]) }}">
            <h4 class="media-heading hsfield">{{ $user->getFirstAndLastName() }}</h4>
        </a>
        {{ clean($user->getAbout(), array('HTML.Allowed'=>''))?:'Регистриран/а '.$user->created_at->diffForHumans() }}
    </div>
</div>