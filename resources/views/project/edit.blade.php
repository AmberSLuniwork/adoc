@extends('../layout')
@section('title', $project->title . ' - Edit')
@section('breadcrumbs')
  <li><a href="{{route('project.index')}}">Projects</a></li>
  <li><a href="{{route('project.show', [$project])}}">{{$project->title}}</a>
  <li class="current"><a href="{{route('project.edit', [$project])}}">Edit</a>
@endsection
@section('content')
  <div class="row">
    <div class="column small-12">
      <h1>{{$project->title}} - Edit</h1>
    </div>
  </div>
  <div class="row">
    <div class="column small-12 medium-8 large-6">
      {!! Form::model($project, ['route' => ['project.update', $project], 'method' => 'PUT']) !!}
        @include('../partials/_form_field', ['field_type' => 'text', 'field_name' => 'title', 'label' => 'Title'])
        @include('../partials/_form_field', ['field_type' => 'text', 'field_name' => 'acronym', 'label' => 'Acronym'])
        @include('../partials/_form_field', ['field_type' => 'textarea', 'field_name' => 'summary', 'label' => 'Summary'])
        @include('../partials/_form_field', ['field_type' => 'date', 'field_name' => 'start', 'label' => 'Start Date'])
        @include('../partials/_form_field', ['field_type' => 'date', 'field_name' => 'end', 'label' => 'End Date'])
        @include('../partials/_form_field', ['field_type' => 'select', 'field_name' => 'stage', 'label' => 'Stage', 'values' => ['planning' => 'Planning', 'active' => 'Active', 'inactive' => 'Inactive', 'completed' => 'Completed']])
        @include('../partials/_form_field', ['field_type' => 'select', 'field_name' => 'status', 'label' => 'Status', 'values' => ['private' => 'Private', 'public' => 'Public']])
        <div class="row collapse">
          <div class="column small-12 text-right">
            <input type="submit" class="button" value="Update"/>
          </div>
        </div>
      {!! Form::close() !!}
    </div>
  </div>
  @endsection