@extends('../layout')
@section('title', 'Add a new Funder')
@section('breadcrumbs')
  <li><a href="{{route('funder.index')}}">Funders</a></li>
  <li class="current"><a href="{{route('funder.create')}}">Add</a></li>
  @endsection
@section('content')
  <div class="row">
    <div class="column small-12">
      <h1>Add a new Funder</h1>
    </div>
  </div>
  <div class="row">
    <div class="column small-12 medium-8 large-6">
      {!! Form::open(['route' => 'funder.store']) !!}
        @include('../partials/_form_field', ['field_type' => 'text', 'field_name' => 'name', 'label' => 'Name'])
        @include('../partials/_form_field', ['field_type' => 'text', 'field_name' => 'abbreviation', 'label' => 'Abbreviation'])
        @include('../partials/_form_field', ['field_type' => 'text', 'field_name' => 'country', 'label' => 'Country'])
        <div class="row collapse">
          <div class="column small-12 text-right">
            <input type="submit" class="button" value="Add"/>
          </div>
        </div>
      {!! Form::close() !!}
    </div>
  </div>
  @endsection