<div class="media-left text-center">
    <a title="Профилна снимка" class="problem-comment-holder" href='{{ route('user.index', ['id' => $person->user->id]) }}'>
        @if($person->user->picture)
        <img class="problem-comment" alt="Профилна снимка на потребител" src="./images/userphotos/{{ $person->user->picture->picture_name }}">
        @else
        <img class="problem-comment" alt="Профилна снимка на потребител" src="https://gravatar.com/avatar/md5({{ $person->user->email }})?d=mm&s=40">
        @endif
    </a>
</div>
<div class="media-body">
    <a title="{{ $person->user->first_name }} {{ $person->user->last_name }}" href='{{ route('user.index', ['id' => $person->user->id]) }}' class="just-link"><h4 class="media-heading problem-author">{{ $person->user->first_name }} {{ $person->user->last_name }}</h4></a>
    <div class="row">
        <div class="col-lg-12">
            <p>Регистриран/а {{ $person->user->created_at->diffForHumans() }}</p>
        </div>
    </div>
</div>