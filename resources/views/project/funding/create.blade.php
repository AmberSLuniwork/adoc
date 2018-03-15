@extends('../layout')
@section('title', $project->title . ' - Add Funding')
@section('breadcrumbs')
  <li><a href="{{route('project.index')}}">Projects</a></li>
  <li><a href="{{route('project.show', [$project])}}">{{$project->title}}</a>
  <li class="current"><a href="{{route('project.funding.create', [$project])}}">Add Funding</a>
@endsection
@section('content')
  <div class="row">
    <div class="column small-12">
      <h1>{{$project->title}} - Add Funding</h1>
    </div>
  </div>
  <div class="row">
    <div class="column small-12 medium-8 large-6">
      {!! Form::open(['route' => ['project.funding.store', $project]]) !!}
        @include('../partials/_form_field', ['field_type' => 'hidden', 'field_name' => 'funding_application_id' ])
        @include('../partials/_form_field', ['field_type' => 'text', 'field_name' => 'name', 'label' => 'Funding Application Name'])
        @include('../partials/_form_field', ['field_type' => 'number', 'field_name' => 'amount', 'label' => 'Amount'])
        @include('../partials/_form_field', ['field_type' => 'select', 'field_name' => 'currency', 'label' => 'Currency', 'values' => ['eur' => 'Euros', 'gbp' => 'British Pound']])
        <div class="row collapse">
          <div class="column small-12 text-right">
            <input type="submit" class="button" value="Add"/>
          </div>
        </div>
      {!! Form::close() !!}
    </div>
  </div>
@endsection
@section('javascript')
  <script>
    $('input[name=name]').autocomplete({
        serviceUrl: '{{route('funding_app.autocomplete')}}',
        noCache: true,
        onSelect: function(suggestion) {
            $('input[name=funding_application_id]').val(suggestion.data);
        }
    });
  </script>
@endsection
