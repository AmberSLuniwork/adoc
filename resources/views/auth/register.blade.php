@extends('../layout')
@section('title', 'Register')
@section('breadcrumbs')
  <li class="current"><a href="{{route('auth.register')}}">Register</a></li>
@endsection
@section('content')
  <div class="row">
    <div class="column small-12">
      <h1>Register</h1>
    </div>
  </div>
  <div class="row">
    <div class="column small-12 medium-6">
      {!! Form::open(['route' => 'auth.register']) !!}
        @include('../partials/_form_field', ['field_type' => 'text', 'field_name' => 'name', 'label' => 'Your Name'])
        @include('../partials/_form_field', ['field_type' => 'email', 'field_name' => 'email', 'label' => 'E-Mail Address'])
        @include('../partials/_form_field', ['field_type' => 'password', 'field_name' => 'password', 'label' => 'Password'])
        @include('../partials/_form_field', ['field_type' => 'password', 'field_name' => 'password_confirmation', 'label' => 'Confirm your Password'])
        <div class="row collapse">
          <div class="column small-12 text-right">
            <input type="submit" class="button" value="Register"/>
          </div>
        </div>
      {!! Form::close() !!}
    </div>
  </div>
@endsection