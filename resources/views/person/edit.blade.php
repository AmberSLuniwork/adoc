@extends('../layout')
@section('title', $person->fullName() . ' - Edit')
@section('breadcrumbs')
  <li><a href="{{route('person.index')}}">People</a></li>
  <li><a href="{{route('person.show', [$person])}}">{{$person->fullName()}}</a>
  <li class="current"><a href="{{route('person.edit', [$person])}}">Edit</a>
@endsection
@section('content')
  <div class="row">
    <div class="column small-12">
      <h1>{{$person->fullName()}} - Edit</h1>
    </div>
  </div>
  <div class="row">
    <div class="column small-12 medium-8 large-6">
      {!! Form::model($person, ['route' => ['person.update', $person], 'method' => 'PUT']) !!}
        @include('../partials/_form_field', ['field_type' => 'text', 'field_name' => 'firstname', 'label' => 'First name'])
        @include('../partials/_form_field', ['field_type' => 'text', 'field_name' => 'middlename', 'label' => 'Middle name'])
        @include('../partials/_form_field', ['field_type' => 'text', 'field_name' => 'lastname', 'label' => 'Last name'])
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