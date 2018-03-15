@extends('../layout')
@section('title', 'Add a new Qualification')
@section('breadcrumbs')
  <li><a href="{{route('qualification.index')}}">Qualifications</a></li>
  <li class="current"><a href="{{route('qualification.create')}}">Add</a></li>
  @endsection
@section('content')
  <div class="row">
    <div class="column small-12 medium-8 large-6">
      <h1>Add a new Qualification</h1>
    </div>
  </div>
  <div class="row">
    <div class="column small-12 medium-8 large-6">
      {!! Form::open(['route' => 'qualification.store']) !!}
        @include('../partials/_form_field', ['field_type' => 'text', 'field_name' => 'long', 'label' => 'Long form'])
        @include('../partials/_form_field', ['field_type' => 'text', 'field_name' => 'short', 'label' => 'Short form'])
        @include('../partials/_form_field', ['field_type' => 'select', 'field_name' => 'position', 'label' => 'Position', 'values' => ['after' => 'After', 'before' => 'Before']])
        @include('../partials/_form_field', ['field_type' => 'number', 'field_name' => 'weight', 'label' => 'Weight'])
        <div class="row collapse">
          <div class="column small-12 text-right">
            <input type="submit" class="button" value="Add"/>
          </div>
        </div>
      {!! Form::close() !!}
    </div>
  </div>
  @endsection