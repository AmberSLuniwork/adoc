@extends('../layout')
@section('title', 'Funding Applications')
@section('breadcrumbs')
  <li class="current"><a href="{{route('funding_app.index')}}">Funding Applications</a></li>
@endsection
@section('content')
  <div class="row">
    <div class="column small-12">
      <h1>Funding Applications</h1>
    </div>
  </div>
  <div class="row">
    <div class="column small-12">
      <table class="small-12">
        <thead>
          <tr>
            <th>Title</th>
            <th>Funder</th>
            <th>Amount</th>
            <th>Stage</th>
            @if(Auth::check())
              <th>Successful</th>
            @endif
          </tr>
        </thead>
        <tbody>
          @foreach($funding_apps as $funding_app)
            <tr>
              <td><a href="{{route('funding_app.show', [$funding_app])}}">{{$funding_app->title}}</a></td>
              <td><a href="{{route('funder.show', [$funding_app->funder()])}}"><abbr title="{{$funding_app->funder()->name}} - {{$funding_app->funder()->country}}">{{$funding_app->funder()->abbreviation}}</abbr></a></td>
              <td>
                @if($funding_app->amount)
                  {{strtoupper($funding_app->currency)}} {{number_format($funding_app->amount, 2)}}
                @endif
              </td>
              <td>
                @if($funding_app->stage === 'preparation')
                  In preparation
                @elseif($funding_app->stage === 'review')
                  Under review
                @elseif($funding_app->stage === 'decision')
                  Decision received
                @endif
              </td>
              <td>@if($funding_app->stage === 'decision')
                  {{$funding_app->success ? 'Yes' : 'No'}}
                @endif
              </td>
            </tr>
          @endforeach
          @if(count($funding_apps) == 0)
            <tr>
              <td colspan="4" class="nothing-found">No funding applications were found</td>
            </tr>
          @endif
        </tbody>
      </table>
      {!! (new ADoc\Helpers\Pagination($funding_apps))->render() !!}
    </div>
  </div>
@endsection