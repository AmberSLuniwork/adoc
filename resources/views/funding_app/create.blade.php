@extends('../layout')
@section('title', 'Add a new Funding Application')
@section('breadcrumbs')
  <li><a href="{{route('funding_app.index')}}">Funding Applications</a></li>
  <li class="current"><a href="{{route('funding_app.create')}}">Add</a></li>
  @endsection
@section('content')
  <div class="row">
    <div class="column small-12">
      <h1>Add a new Funding Application</h1>
    </div>
  </div>
  <div class="row">
    <div class="column small-12 medium-8 large-6">
      {!! Form::open(['route' => 'funding_app.store']) !!}
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
            <input type="submit" class="button" value="Add"/>
          </div>
        </div>
      {!! Form::close() !!}
    </div>
  </div>
  @endsection