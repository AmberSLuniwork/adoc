@extends('../layout')
@section('title', $funder->name . ' - Edit')
@section('breadcrumbs')
  <li><a href="{{route('person.index')}}">Funders</a></li>
  <li><a href="{{route('funder.show', [$funder])}}">{{$funder->abbreviation}}</a>
  <li class="current"><a href="{{route('funder.edit', [$funder])}}">Edit</a>
@endsection
@section('content')
  <div class="row">
    <div class="column small-12">
      <h1>{{$funder->abbreviation}} - Edit</h1>
    </div>
  </div>
  <div class="row">
    <div class="column small-12 medium-8 large-6">
      {!! Form::model($funder, ['route' => ['funder.update', $funder], 'method' => 'PUT']) !!}
        @include('../partials/_form_field', ['field_type' => 'text', 'field_name' => 'name', 'label' => 'Name'])
        @include('../partials/_form_field', ['field_type' => 'text', 'field_name' => 'abbreviation', 'label' => 'Abbreviation'])
        @include('../partials/_form_field', ['field_type' => 'text', 'field_name' => 'country', 'label' => 'Country'])
        <div class="row collapse">
          <div class="column small-12 text-right">
            <input type="submit" class="button" value="Update"/>
          </div>
        </div>
      {!! Form::close() !!}
    </div>
  </div>
  @endsection