@extends('../layout')
@section('title', $project->title . ' - Edit Person')
@section('breadcrumbs')
  <li><a href="{{route('project.index')}}">Projects</a></li>
  <li><a href="{{route('project.show', [$project])}}">{{$project->title}}</a>
  <li class="current"><a href="{{route('project.participant.edit', [$project, $participant])}}">Edit Person</a>
@endsection
@section('content')
  <div class="row">
    <div class="column small-12">
      <h1>{{$project->title}} - Edit Person</h1>
    </div>
  </div>
  <div class="row">
    <div class="column small-12 medium-8 large-6">
      {!! Form::model($participant, ['route' => ['project.participant.update', $project, $participant], 'method' => 'PUT']) !!}
        @include('../partials/_form_field', ['field_type' => 'hidden', 'field_name' => 'person_id' ])
        @include('../partials/_form_field', ['field_type' => 'text', 'field_name' => 'name', 'label' => 'Applicant'])
        @include('../partials/_form_field', ['field_type' => 'select', 'field_name' => 'role_id', 'label' => 'Role', 'values' => $project_roles])
        @include('../partials/_form_field', ['field_type' => 'number', 'field_name' => 'allocation', 'label' => 'Allocation'])
        <div class="row collapse">
          <div class="column small-12 text-right">
            <input type="submit" class="button" value="Update"/>
          </div>
        </div>
      {!! Form::close() !!}
    </div>
  </div>
@endsection
@section('javascript')
  <script>
    $('input[name=name]').autocomplete({
        serviceUrl: '{{route('person.autocomplete')}}',
        noCache: true,
        onSelect: function(suggestion) {
            $('input[name=person_id]').val(suggestion.data);
        }
    });
  </script>
@endsection
