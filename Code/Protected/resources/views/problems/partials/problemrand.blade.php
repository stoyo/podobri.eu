<a title="Прочетете още" href="{{ route('problem.custom', ['id'=>$problem->id]) }}" class="list-group-item"
   @if($problem->state($problem->id) == 1)
   style="border-left:2px solid #cc8400; margin-bottom:19px !important;"
   @elseif($problem->state($problem->id) == 2)
   style="border-left:2px solid #00990a; margin-bottom:19px !important;"
   @else($problem->state($problem->id) == 0)
   style="border-left:2px solid #EF4255; margin-bottom:19px !important;"
   @endif
   >
   @if($problem->pictures->first())
   <img class="full-width margin-bottom-10" src="./images/problemphotos/{{ $problem->pictures->first()->picture_name }}" alt="Снимка на проблем" />
    @else
    <div class="videos">
        <img class="full-width margin-bottom-10" alt="Миниатюра от видео на проблем" src="{{ $problem->video->getVideoThumbnail() }}" />
        <img class='playlay' src="../images/playvid.png" />
    </div>
    @endif
    <span class='glyphicon glyphicon-edit margin-right-4'></span>{{ str_limit($problem->problem_title, 70) }}<hr class="margin-top-6">
    @if($problem->likes->count() == 1)
    {{ $problem->likes->count() }} Харесване
    @else
    {{ $problem->likes->count() }} Харесвания
    @endif        
    @if(count($problem->comments->where('problem_id', $problem->id)->where('parent_id', null)) == 1) 
    {{ count($problem->comments->where('problem_id', $problem->id)->where('parent_id', null)) }} Коментар
    @else
    {{ count($problem->comments->where('problem_id', $problem->id)->where('parent_id', null)) }} Коментара
    @endif
    @if(Counter::show('customimg', $problem->id) == 1)
    {{ Counter::show('customimg', $problem->id) }} Преглед
    @else
    {{ Counter::show('customimg', $problem->id) }} Прегледа
    @endif
</a>
