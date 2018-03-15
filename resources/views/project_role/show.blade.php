@extends('../layout')
@section('title', $project_role->long)
@section('breadcrumbs')
  <li><a href="{{route('project_role.index')}}">Project Roles</a></li>
  <li class="current"><a href="{{route('project_role.show', [$project_role])}}">{{$project_role->long}}</a>
@endsection
@section('content')
  <div class="row">
    <div class="column small-12">
      @if(Auth::check())
        <div class="right">
          @permission('projectrole.edit')
            <a href="{{route('project_role.edit', [$project_role])}}" class="button tiny">Edit</a>
          @endpermission
          @permission('projectrole.delete')
            <a href="{{route('project_role.destroy', [$project_role])}}" class="button tiny alert" data-method="DELETE" data-confirm="{{UI::confirmDeleteSettings('project role', $project_role->long)}}" data-token="{{csrf_token()}}">Delete</a>
          @endpermission
        </div>
      @endif
      <h1>{{$project_role->long}}</h1>
      <dl>
        <dt class="column small-4 medium-3 large-2">Short form</dt>
        <dd class="column small-8 medium-9 large-10">{{$project_role->short}}</dd>
      </dl>
    </div>
  </div>
@endsection
@section('javascript')
  <script>
  $('a[data-method]').postLink();
  </script>
@endsection