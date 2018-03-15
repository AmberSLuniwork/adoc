@extends('../layout')
@section('title', $project->title)
@section('breadcrumbs')
  <li><a href="{{route('project.index')}}">Projects</a></li>
  <li class="current"><a href="{{route('project.show', [$project])}}">{{$project->title}}</a>
@endsection
@section('content')
  <div class="row">
    <div class="column small-12">
      @if(Auth::check())
        <div class="right">
          @allowed('project.edit', $project)
            <a href="{{route('project.edit', [$project])}}" class="button tiny">Edit</a>
          @endallowed
          @allowed('project.delete', $project)
            <a href="{{route('project.destroy', [$project])}}" class="button tiny alert" data-method="DELETE" data-confirm="{{UI::confirmDeleteSettings('project', $project->title)}}" data-token="{{csrf_token()}}">Delete</a>
          @endallowed
        </div>
      @endif
      <h1>{{$project->title}}
        @if($project->acronym)
          ({{$project->acronym}})
        @endif
        <small>{{$project->stage}}</small>
      </h1>
      <dl>
        @if($project->start)
          <dt class="column small-6 medium-4 large-3">Start Date</dt>
          <dd class="column small-6 medium-8 large-9">{{$project->start}}</dd>
        @endif
        @if($project->end)
          <dt class="column small-6 medium-4 large-3">End Date</dt>
          <dd class="column small-6 medium-8 large-9">{{$project->end}}</dd>
        @endif
      </dl>
      <h2>Summary</h2>
      <p>{{$project->summary}}</p>
      @if(count($project->participants()->getResults()) > 0 || (Auth::check() && Auth::user()->allowed('project.edit', $project)))
        <h2>People</h2>
        <table>
          <thead>
            <tr>
              <th>Role</th>
              <th>Name</th>
              <th>Allocation</th>
              @allowed('project.edit', $project)
                <th>Action</th>
              @endallowed
            </tr>
          </thead>
          <tbody>
            @foreach($project->participants()->getResults() as $participant)
              <tr>
                <td><abbr title="{{$participant->role()->long}}">{{$participant->role()->short}}</abbr></td>
                <td>
                  @if($participant->person()->status == 'public' || (Auth::check() && Auth::user()->allowed('person.view', $participant->person())))
                    <a href="{{route('person.show', [$participant->person()])}}">{{$participant->person()->fullName()}}</a>
                  @else
                    {{$participant->person()->fullName()}}
                  @endif
                </td>
                <td>{{$participant->allocation}}</td>
                @allowed('project.edit', $project)
                  <td>
                    <a href="{{route('project.participant.edit', [$project, $participant])}}" class="button tiny">Edit</a>
                    <a href="{{route('project.participant.destroy', [$project, $participant])}}" class="button tiny alert" data-method="DELETE" data-confirm="{{UI::confirmActionSettings('remove', 'person', $participant->person()->fullName())}}" data-token="{{csrf_token()}}">Remove</a>
                  </td>
                @endif
              </tr>
            @endforeach
            @if(count($project->participants()->getResults()) === 0)
              <tr>
                <td colspan="4" class="nothing-found">No people linked to this project</td>
              </tr>
            @endif
          </tbody>
        </table>
        @allowed('project.edit', $project)
          <a href="{{route('project.participant.create', [$project])}}" class="button tiny">Add</a>
        @endallowed
      @endif
      @if(count($project->fundings()->getResults()) > 0 || (Auth::check() && Auth::user()->allowed('project.edit', $project)))
        <h2>Funding</h2>
        <table>
          <thead>
            <tr>
              <th>Name</th>
              <th>Amount</th>
              @allowed('project.edit', $project)
                <th>Action</th>
              @endallowed
            </tr>
          </thead>
          <tbody>
            @foreach($project->fundings()->getResults() as $funding)
              <tr>
                <td>
                  @if($funding->fundingApplication()->status == 'public' || (Auth::check() && Auth::user()->allowed('fundingapplication.view', $funding->fundingApplication())))
                    <a href="{{route('funding_app.show', [$funding->fundingApplication()])}}">{{$funding->fundingApplication()->title}}</a>
                  @else
                    {{$funding->fundingApplication()->title}}
                  @endif
                </td>
                <td>{{strtoupper($funding->currency)}} {{number_format($funding->amount, 2)}}</td>
                @allowed('project.edit', $project)
                  <td>
                    <a href="{{route('project.funding.edit', [$project, $funding])}}" class="button tiny">Edit</a>
                    <a href="{{route('project.funding.destroy', [$project, $funding])}}" class="button tiny alert" data-method="DELETE" data-confirm="{{UI::confirmActionSettings('remove', 'funding', $funding->fundingApplication()->title)}}" data-token="{{csrf_token()}}">Remove</a>
                  </td>
                @endif
              </tr>
            @endforeach
            @if(count($project->fundings()->getResults()) === 0)
              <tr>
                <td colspan="4" class="nothing-found">No funding linked to this project</td>
              </tr>
            @endif
          </tbody>
        </table>
        @allowed('project.edit', $project)
          <a href="{{route('project.funding.create', [$project])}}" class="button tiny">Add</a>
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
