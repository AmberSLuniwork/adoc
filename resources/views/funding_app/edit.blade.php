@extends('../layout')
@section('title', $funding_app->title . ' - Edit')
@section('breadcrumbs')
  <li><a href="{{route('funding_app.index')}}">Funding Applications</a></li>
  <li><a href="{{route('funding_app.show', [$funding_app])}}">{{$funding_app->title}}</a>
  <li class="current"><a href="{{route('funding_app.edit', [$funding_app])}}">Edit</a>
@endsection
@section('content')
  <div class="row">
    <div class="column small-12">
      <h1>{{$funding_app->title}} - Edit</h1>
    </div>
  </div>
  <div class="row">
    <div class="column small-12 medium-8 large-6">
      {!! Form::model($funding_app, ['route' => ['funding_app.update', $funding_app], 'method' => 'PUT']) !!}
        @include('../partials/_form_field', ['field_type' => 'text', 'field_name' => 'title', 'label' => 'Title'])
        @include('../partials/_form_field', ['field_type' => 'select', 'field_name' => 'funder_id', 'label' => 'Funder', 'values' => $funders])
        @include('../partials/_form_field', ['field_type' => 'text', 'field_name' => 'scheme', 'label' => 'Scheme'])
        @include('../partials/_form_field', ['field_type' => 'number', 'field_name' => 'amount', 'label' => 'Amount'])
        @include('../partials/_form_field', ['field_type' => 'select', 'field_name' => 'currency', 'label' => 'Currency', 'values' => ['eur' => 'Euros', 'gbp' => 'British Pound']])
        @include('../partials/_form_field', ['field_type' => 'date', 'field_name' => 'submission_date', 'label' => 'Submission Date'])
        @include('../partials/_form_field', ['field_type' => 'textarea', 'field_name' => 'summary', 'label' => 'Summary'])
        @include('../partials/_form_field', ['field_type' => 'select', 'field_name' => 'stage', 'label' => 'Stage', 'values' => ['preparation' => 'In Preparation', 'review' => 'Under Review', 'decision' => 'Decision received']])
        @include('../partials/_form_field', ['field_type' => 'checkbox', 'field_name' => 'success', 'label' => 'Successful'])
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