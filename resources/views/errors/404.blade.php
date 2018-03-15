@extends('../layout')
@section('title', '404 Not Found')
@section('breadcrumbs')
  <li class="current"><a href="#">Not Found</a></li>
@endsection
@section('content')
  <div class="row">
    <div class="column small-12">
      <h1>404 Not Found</h1>
    </div>
  </div>
  <div class="row">
    <div class="column small-12">
      <p>Unfortunately the document you were looking for could not be found.</p>
    </div>
  </div>
  @endsection