@extends ('templates.default')
@section('content')
<div class='container'>
    @include('templates.partials.alerts')
    <h3>Съобщения от потребители</h3>
    <div class="table-responsive">
        <table class="table table-striped table-bordered margin-top-25">
            <tr class="danger"><td>#</td><td>Причина</td><td>Съобщение</td><td>Линк към проблем</td><td>Електронна поща</td><td>Дата</td></tr>
            @foreach($maintenance as $message)
            <tr><td>{{ $message->id }}</td><td>{{ $message->reason }}</td><td>{{ $message->message }}</td><td><a href='{{ $message->url }}' target='_blank'>{{ $message->url }}</a></td><td>{{ $message->user_email }}</td><td>{{ $message->created_at->diffForHumans() }}</td></tr>
            @endforeach
        </table>
        {!! $maintenance->render() !!}
    </div>
</div>
@stop






