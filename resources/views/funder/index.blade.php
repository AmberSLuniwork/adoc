@extends('../layout')
@section('title', 'Funders')
@section('breadcrumbs')
  <li class="current"><a href="{{route('funder.index')}}">Funders</a></li>
@endsection
@section('content')
  <div class="row">
    <div class="column small-12">
      <h1>Funders</h1>
    </div>
  </div>
  <div class="row">
    <div class="column small-12">
      <table class="small-12">
        <thead>
          <tr>
            <th>Name</th>
            <th>Abbreviation</th>
            <th>Country</th>
          </tr>
        </thead>
        <tbody>
          @foreach($funders as $funder)
            <tr>
              <td><a href="{{route('funder.show', [$funder])}}">{{$funder->name}}</a></td>
              <td>{{$funder->abbreviation}}</td>
              <td>{{$funder->country}}</td>
            </tr>
          @endforeach
          @if(count($funders) == 0)
            <tr>
              <td colspan="4" class="nothing-found">No funders were found</td>
            </tr>
          @endif
        </tbody>
      </table>
      {!! (new ADoc\Helpers\Pagination($funders))->render() !!}
    </div>
  </div>
@endsection