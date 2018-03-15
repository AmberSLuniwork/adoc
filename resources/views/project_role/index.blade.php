@extends('../layout')
@section('title', 'Project Roles')
@section('breadcrumbs')
  <li class="current"><a href="{{route('project_role.index')}}">Project Roles</a></li>
@endsection
@section('content')
  <div class="row">
    <div class="column small-12">
      <h1>Project Roles</h1>
    </div>
  </div>
  <div class="row">
    <div class="column small-12">
      <table class="small-12">
        <thead>
          <tr>
            <th>Long Form</th>
            <th>Short Form</th>
          </tr>
        </thead>
        <tbody>
          @foreach($project_roles as $project_role)
            <tr>
              <td><a href="{{route('project_role.show', [$project_role])}}">{{$project_role->long}}</a></td>
              <td>{{$project_role->short}}</td>
            </tr>
          @endforeach
          @if(count($project_roles) == 0)
            <tr>
              <td colspan="3" class="nothing-found">No project roles were found</td>
            </tr>
          @endif
        </tbody>
      </table>
      {!! (new ADoc\Helpers\Pagination($project_roles))->render() !!}
    </div>
  </div>
@endsection