@extends('../layout')
@section('title', 'Add a new Person')
@section('breadcrumbs')
  <li><a href="{{route('person.index')}}">People</a></li>
  <li class="current"><a href="{{route('person.create')}}">Add</a></li>
  @endsection
@section('content')
  <div class="row">
    <div class="column small-12 medium-8 large-6">
      <h1>Add a new Person</h1>
    </div>
  </div>
  <div class="row">
    <div class="column small-12 medium-8 large-6">
      {!! Form::open(['route' => 'person.store']) !!}
        @include('../partials/_form_field', ['field_type' => 'text', 'field_name' => 'firstname', 'label' => 'First name'])
        @include('../partials/_form_field', ['field_type' => 'text', 'field_name' => 'middlename', 'label' => 'Middle name'])
        @include('../partials/_form_field', ['field_type' => 'text', 'field_name' => 'lastname', 'label' => 'Last name'])
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