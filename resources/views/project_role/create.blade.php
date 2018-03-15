@extends('../layout')
@section('title', 'Add a new Project Role')
@section('breadcrumbs')
  <li><a href="{{route('project_role.index')}}">Project Roles</a></li>
  <li class="current"><a href="{{route('project_role.create')}}">Add</a></li>
  @endsection
@section('content')
  <div class="row">
    <div class="column small-12 medium-8 large-6">
      <h1>Add a new Project Role</h1>
    </div>
  </div>
  <div class="row">
    <div class="column small-12 medium-8 large-6">
      {!! Form::open(['route' => 'project_role.store']) !!}
        @include('../partials/_form_field', ['field_type' => 'text', 'field_name' => 'long', 'label' => 'Long form'])
        @include('../partials/_form_field', ['field_type' => 'text', 'field_name' => 'short', 'label' => 'Short form'])
        <div class="row collapse">
          <div class="column small-12 text-right">
            <input type="submit" class="button" value="Add"/>
          </div>
        </div>
      {!! Form::close() !!}
    </div>
  </div>
  @endsection