@extends('../layout')
@section('title', 'Login')
@section('breadcrumbs')
  <li class="current"><a href="{{route('auth.login')}}">Login</a></li>
@endsection
@section('content')
  <div class="row">
    <div class="column small-12">
      <h1>Login</h1>
    </div>
  </div>
  <div class="row">
    <div class="column small-12 medium-6">
      {!! Form::open(['route' => 'auth.login']) !!}
        @include('../partials/_form_field', ['field_type' => 'email', 'field_name' => 'email', 'label' => 'E-Mail Address'])
        @include('../partials/_form_field', ['field_type' => 'password', 'field_name' => 'password', 'label' => 'Password'])
        @include('../partials/_form_field', ['field_type' => 'checkbox', 'field_name' => 'remember', 'label' => 'Remember me'])
        <div class="row collapse">
          <div class="column small-12 text-right">
            <input type="submit" class="button" value="Login"/>
          </div>
        </div>
      {!! Form::close() !!}
    </div>
  </div>
@endsection