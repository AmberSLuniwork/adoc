@extends('../layout')
@section('title', $person->fullName())
@section('breadcrumbs')
  <li><a href="{{route('person.index')}}">People</a></li>
  <li class="current"><a href="{{route('person.show', [$person])}}">{{$person->fullName()}}</a>
@endsection
@section('content')
  <div class="row">
    <div class="column small-12">
      @if(Auth::check())
        <div class="right">
          @allowed('person.edit', $person)
            <a href="{{route('person.edit', [$person])}}" class="button tiny">Edit</a>
          @endallowed
          @allowed('person.destroy', $person)
            <a href="{{route('person.destroy', [$person])}}" class="button tiny alert" data-method="DELETE" data-confirm="{{UI::confirmDeleteSettings('person', $person->fullName())}}" data-token="{{csrf_token()}}">Delete</a>
          @endallowed
        </div>
      @endif
      <h1><small>{{$person->titles('before')}}</small> {{$person->fullName()}} <small>{{$person->titles('after')}}</small></h1>
      @if(count($person->projects()->getResults()) > 0 || (Auth::check() && Auth::user()->allowed('person.edit', $person)))
        <h2>Projects</h2>
        <table>
          <thead>
            <tr>
              <th>Title</th>
              <th>Role</th>
              <th>Allocation</th>
            </tr>
          </thead>
          <tbody>
            @foreach($person->projects()->getResults() as $project)
              @if($project->project()->status === 'public' || (Auth::check() && Auth::user()->allowed('project.view', $project->project())))
                <tr>
                  <td><a href="{{route('project.show', [$project->project()])}}">{{$project->project()->title}}</a></td>
                  <td><abbr title="{{$project->role()->long}}">{{$project->role()->short}}</abbr></td>
                  <td>{{$project->allocation}}</td>
                </tr>
              @endif
            @endforeach
            @if(count($person->projects()->getResults()) === 0)
              <tr>
                <td colspan="3" class="nothing-found">No projects linked to this person</td>
              </tr>
            @endif
          </tbody>
        </table>
      @endif
      @if(count($person->applications()->getResults()) > 0 || (Auth::check() && Auth::user()->allowed('person.edit', $person)))
        <h2>Funding Applications</h2>
        <table>
          <thead>
            <tr>
              <th>Title</th>
              <th>Role</th>
              <th>Allocation</th>
            </tr>
          </thead>
          <tbody>
            @foreach($person->applications()->getResults() as $application)
              @if($application->fundingApplication()->status == 'public' || (Auth::check() && Auth::user()->can('fundingapplication.view', $application->fundingApplication())))
                <tr>
                  <td><a href="{{route('funding_app.show', [$application->fundingApplication()])}}">{{$application->fundingApplication()->title}}</a></td>
                  <td><abbr title="{{$application->role()->long}}">{{$application->role()->short}}</abbr></td>
                  <td>{{$application->allocation}}</td>
                </tr>
              @endif
            @endforeach
            @if(count($person->applications()->getResults()) === 0)
              <tr>
                <td colspan="3" class="nothing-found">No funding applications linked to this person</td>
              </tr>
            @endif
          </tbody>
        </table>
      @endif
      @if(count($person->awards()->getResults()) > 0 || (Auth::check() && Auth::user()->allowed('person.edit', $person)))
        <h2>Qualifications</h2>
        <table>
          <thead>
            <tr>
              <th>Qualification</th>
              <th>Year</th>
              @allowed('person.edit', $person)
                <th>Action</th>
              @endallowed
            </tr>
          </thead>
          <tbody>
            @foreach($person->awards()->getResults() as $award)
              <tr>
                <td>{{$award->qualification()->long}}</td>
                <td>{{$award->year}}</td>
                @allowed('person.edit', $person)
                  <td>
                    <a href="{{route('person.award.edit', [$person, $award])}}" class="button tiny">Edit</a>
                    <a href="{{route('person.award.destroy', [$person, $award])}}" class="button tiny alert" data-method="DELETE" data-confirm="{{UI::confirmActionSettings('remove', 'qualification', $award->qualification()->long)}}" data-token="{{csrf_token()}}">Remove</a>
                  </td>
                @endif
              </tr>
            @endforeach
            @if(count($person->awards()->getResults()) === 0)
              <tr>
                <td colspan="3" class="nothing-found">No qualifications linked to this person</td>
              </tr>
            @endif
          </tbody>
        </table>
        @allowed('person.edit', $person)
          <a href="{{route('person.award.create', $person->id)}}" class="button tiny">Add</a>
        @endallowed
      @endif
    </div>
  </div>
@endsection
@section('javascript')
  <script>
  $('a[data-method]').postLink();
  </script>
@endsection