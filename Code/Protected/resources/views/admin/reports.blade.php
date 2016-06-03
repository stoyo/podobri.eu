@extends ('templates.default')
@section('content')
<div class='container'>
    @include('templates.partials.alerts')
    <h3>Доклади от потребители</h3>
    <div class="table-responsive">
        <table class="table table-striped table-bordered margin-top-25">
            <tr class="danger"><td>#</td><td>Потребител</td><td>Номер на докладван елемент</td><td>Тип докладван елемент</td><td>Дата</td></tr> 
            @foreach($reports as $report)
            <tr><td>{{ $report->id }}</td><td>
                    @if($report->user)
                    <a target="_blank" href="{{ route('user.index', ['id' => $report->user->id]) }}">{{ $report->user->first_name }} {{ $report->user->last_name }}</a>
                    @else
                    {{ 'Потребителят е изтрил профила си' }}
                    @endif
                </td><td>
                    @if($report->reportable_type == 'Podobri\Models\Problem')
                    <a href='{{ route('problem.custom', ['id' => $report->reportable_id]) }}' target='_blank'>{{ $report->reportable_id }}</a>
                    @else
                    {{ $report->reportable_id }}
                    @endif
                </td><td>{{ $report->reportable_type }}</td><td>{{ $report->created_at->diffForHumans() }}</td></tr>
            @endforeach
        </table>
        {!! $reports->render() !!}
    </div>
</div>
@stop






