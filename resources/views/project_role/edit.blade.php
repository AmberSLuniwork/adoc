@extends('../layout')
@section('title', $project_role->long . ' - Edit')
@section('breadcrumbs')
  <li><a href="{{route('project_role.index')}}">Project Roles</a></li>
  <li><a href="{{route('project_role.show', [$project_role])}}">{{$project_role->long}}</a>
  <li class="current"><a href="{{route('project_role.edit', [$project_role])}}">Edit</a>
@endsection
@section('content')
  <div class="row">
    <div class="column small-12">
      <h1>{{$project_role->long}} - Edit</h1>
    </div>
  </div>
  <div class="row">
    <div class="column small-12 medium-8 large-6">
      {!! Form::model($project_role, ['route' => ['project_role.update', $project_role], 'method' => 'PUT']) !!}
        @include('../partials/_form_field', ['field_type' => 'text', 'field_name' => 'long', 'label' => 'Long form'])
        @include('../partials/_form_field', ['field_type' => 'text', 'field_name' => 'short', 'label' => 'Short form'])
        <div class="row collapse">
          <div class="column small-12 text-right">
            <input type="submit" class="button" value="Update"/>
          </div>
        </div>
      {!! Form::close() !!}
    </div>
  </div>
  @endsection