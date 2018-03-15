@extends('../layout')
@section('title', 'Qualifications')
@section('breadcrumbs')
  <li class="current"><a href="{{route('qualification.index')}}">Qualifications</a></li>
@endsection
@section('content')
  <div class="row">
    <div class="column small-12">
      <h1>Qualifications</h1>
    </div>
  </div>
  <div class="row">
    <div class="column small-12">
      <table class="small-12">
        <thead>
          <tr>
            <th>Long Form</th>
            <th>Short Form</th>
            <th>Position</th>
          </tr>
        </thead>
        <tbody>
          @foreach($qualifications as $qualification)
            <tr>
              <td><a href="{{route('qualification.show', [$qualification])}}">{{$qualification->long}}</a></td>
              <td>{{$qualification->short}}</td>
              <td>{{$qualification->position}}</td>
            </tr>
          @endforeach
          @if(count($qualifications) == 0)
            <tr>
              <td colspan="3" class="nothing-found">No qualifications were found</td>
            </tr>
          @endif
        </tbody>
      </table>
      {!! (new ADoc\Helpers\Pagination($qualifications))->render() !!}
    </div>
  </div>
@endsection