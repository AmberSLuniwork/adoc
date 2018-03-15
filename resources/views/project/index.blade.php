@extends('../layout')
@section('title', 'Projects')
@section('breadcrumbs')
  <li class="current"><a href="{{route('project.index')}}">Projects</a></li>
@endsection
@section('content')
  <div class="row">
    <div class="column small-12">
      <h1>Projects</h1>
    </div>
  </div>
  <div class="row">
    <div class="column small-12">
      <table class="small-12">
        <thead>
          <tr>
            <th>Title</th>
            <th>Start</th>
            <th>End</th>
            <th>Stage</th>
          </tr>
        </thead>
        <tbody>
          @foreach($projects as $project)
            <tr>
              <td><a href="{{route('project.show', [$project])}}">{{$project->title}}</a></td>
              <td>{{$project->start}}</td>
              <td>{{$project->end}}</td>
              <td>
                @if($project->stage === 'planning')
                  Planning
                @elseif($project->stage === 'active')
                  Active
                @elseif($project->stage === 'inactive')
                  Inactive
                @elseif($project->stage === 'completed')
                  Completed
                @endif
              </td>
            </tr>
          @endforeach
          @if(count($projects) == 0)
            <tr>
              <td colspan="4" class="nothing-found">No projects were found</td>
            </tr>
          @endif
        </tbody>
      </table>
      {!! (new ADoc\Helpers\Pagination($projects))->render() !!}
    </div>
  </div>
@endsection