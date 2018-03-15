@extends('../layout')
@section('title', 'People')
@section('breadcrumbs')
  <li class="current"><a href="{{route('person.index')}}">People</a></li>
@endsection
@section('content')
  <div class="row">
    <div class="column small-12">
      <h1>People</h1>
    </div>
  </div>
  <div class="row">
    <div class="column small-12">
      <table class="small-12">
        <thead>
          <tr>
            <th>Name</th>
            <th>Qualifications</th>
          </tr>
        </thead>
        <tbody>
          @foreach($people as $person)
            <tr>
              <td><a href="{{route('person.show', [$person])}}">{{$person->fullName()}}</a></td>
              <td>{{$person->titles('all')}}</td>
            </tr>
          @endforeach
          @if(count($people) == 0)
            <tr>
              <td colspan="4" class="nothing-found">No people were found</td>
            </tr>
          @endif
        </tbody>
      </table>
      {!! (new ADoc\Helpers\Pagination($people))->render() !!}
    </div>
  </div>
@endsection