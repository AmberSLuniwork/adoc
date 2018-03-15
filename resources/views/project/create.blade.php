@extends('../layout')
@section('title', 'Add a new Project')
@section('breadcrumbs')
  <li><a href="{{route('project.index')}}">Projects</a></li>
  <li class="current"><a href="{{route('project.create')}}">Add</a></li>
  @endsection
@section('content')
  <div class="row">
    <div class="column small-12">
      <h1>Add a new Project</h1>
    </div>
  </div>
  <div class="row">
    <div class="column small-12 medium-8 large-6">
      {!! Form::open(['route' => 'project.store']) !!}
        @include('../partials/_form_field', ['field_type' => 'text', 'field_name' => 'title', 'label' => 'Title'])
        @include('../partials/_form_field', ['field_type' => 'text', 'field_name' => 'acronym', 'label' => 'Acronym'])
        @include('../partials/_form_field', ['field_type' => 'textarea', 'field_name' => 'summary', 'label' => 'Summary'])
        @include('../partials/_form_field', ['field_type' => 'date', 'field_name' => 'start', 'label' => 'Start Date'])
        @include('../partials/_form_field', ['field_type' => 'date', 'field_name' => 'end', 'label' => 'End Date'])
        @include('../partials/_form_field', ['field_type' => 'select', 'field_name' => 'stage', 'label' => 'Stage', 'values' => ['planning' => 'Planning', 'active' => 'Active', 'inactive' => 'Inactive', 'completed' => 'Completed']])
        @include('../partials/_form_field', ['field_type' => 'select', 'field_name' => 'status', 'label' => 'Status', 'values' => ['private' => 'Private', 'public' => 'Public']])
        <div class="row collapse">
          <div class="column small-12 text-right">
            <input type="submit" class="button" value="Add"/>
          </div>
        </div>
      {!! Form::close() !!}
    </div>
  </div>
  @endsection