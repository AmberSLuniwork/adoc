@extends('../layout')
@section('title', $qualification->long . ' - Edit')
@section('breadcrumbs')
  <li><a href="{{route('qualification.index')}}">Qualifications</a></li>
  <li><a href="{{route('qualification.show', [$qualification])}}">{{$qualification->long}}</a>
  <li class="current"><a href="{{route('qualification.edit', [$qualification])}}">Edit</a>
@endsection
@section('content')
  <div class="row">
    <div class="column small-12">
      <h1>{{$qualification->long}} - Edit</h1>
    </div>
  </div>
  <div class="row">
    <div class="column small-12 medium-8 large-6">
      {!! Form::model($qualification, ['route' => ['qualification.update', $qualification], 'method' => 'PUT']) !!}
        @include('../partials/_form_field', ['field_type' => 'text', 'field_name' => 'long', 'label' => 'Long form'])
        @include('../partials/_form_field', ['field_type' => 'text', 'field_name' => 'short', 'label' => 'Short form'])
        @include('../partials/_form_field', ['field_type' => 'select', 'field_name' => 'position', 'label' => 'Position', 'values' => ['after' => 'After', 'before' => 'Before']])
        @include('../partials/_form_field', ['field_type' => 'number', 'field_name' => 'weight', 'label' => 'Weight'])
        <div class="row collapse">
          <div class="column small-12 text-right">
            <input type="submit" class="button" value="Update"/>
          </div>
        </div>
      {!! Form::close() !!}
    </div>
  </div>
  @endsection