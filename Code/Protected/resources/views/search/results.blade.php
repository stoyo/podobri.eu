@extends ('templates.default')
@section('content')
<div class='container'>
    @include('templates.partials.alerts')
    <div class="row">
        <div class="col-md-12">
            <div class="margin-top--10 margin-bottom-20"><h3>Резултати за "<span class="highlight">{{ Request::input('term') }}</span>"</h3></div>
        </div>
        <div class="col-md-12">
            <div class="col-md-8">
                @if(!$problems->count())
                <div class='colorfff block-border padding-left-10 margin-left--15 margin-top-10'>
                    <h4>Няма проблем, отговарящ на вашата заявка</h4>
                    <a href='{{ route('add.problem') }}' class='btn btn-default margin-bottom-10'>Добавете проблем</a>
                </div>
                @else
                @foreach($problems as $problem)
                <div class="row margin-top--10">
                    @include('problems.partials.problemblock')
                </div>
                @endforeach
                <div class="row">
                {!! $problems->appends(Request::except('page'))->render() !!}
                </div>
                @endif
            </div>
            <div class="hidden-sm hidden-xs col-md-4 margin-top-10">
                @if(!$users->count())
                <div class='colorfff block-border padding-left-10'>
                    <h4>Няма потребители, отговарящи на вашата заявка</h4>
                </div> 
                @else
                @foreach($users as $user)
                    @include('user.partials.usersearch')
                @endforeach
                @endif
            </div>
        </div>
    </div>    
</div>
@stop