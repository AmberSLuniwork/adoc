@extends('../layout')
@section('title', $person->fullName() . ' - Edit Qualification')
@section('breadcrumbs')
  <li><a href="{{route('person.index')}}">People</a></li>
  <li><a href="{{route('person.show', [$person])}}">{{$person->fullName()}}</a>
  <li class="current"><a href="{{route('person.award.edit', [$person, $award])}}">Edit Qualification</a>
@endsection
@section('content')
  <div class="row">
    <div class="column small-12">
      <h1>{{$person->fullName()}} - Edit Qualification</h1>
        </div>
  </div>
  <div class="row">
    <div class="column small-12 medium-8 large-6">
      {!! Form::model($award, ['route' => ['person.award.update', $person, $award], 'method' => 'PUT']) !!}
        @include('../partials/_form_field', ['field_type' => 'select', 'field_name' => 'qualification_id', 'label' => 'Qualification', 'values' => $qualifications])
        @include('../partials/_form_field', ['field_type' => 'number', 'field_name' => 'year', 'label' => 'Year'])
        <div class="row collapse">
          <div class="column small-12 text-right">
            <input type="submit" class="button" value="Update"/>
          </div>
        </div>
      {!! Form::close() !!}
    </div>
  </div>
@endsection
