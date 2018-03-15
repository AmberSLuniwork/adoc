@extends('../layout')
@section('title', $qualification->long)
@section('breadcrumbs')
  <li><a href="{{route('qualification.index')}}">Qualifications</a></li>
  <li class="current"><a href="{{route('qualification.show', [$qualification])}}">{{$qualification->long}}</a>
@endsection
@section('content')
  <div class="row">
    <div class="column small-12">
      @if(Auth::check())
        <div class="right">
          @permission('qualification.edit')
            <a href="{{route('qualification.edit', [$qualification])}}" class="button tiny">Edit</a>
          @endpermission
          @permission('qualification.destroy')
            <a href="{{route('qualification.destroy', [$qualification])}}" class="button tiny alert" data-method="DELETE" data-confirm="{{UI::confirmDeleteSettings('qualification', $qualification->long)}}" data-token="{{csrf_token()}}">Delete</a>
          @endpermission
        </div>
      @endif
      <h1>{{$qualification->long}}</h1>
      <dl>
        <dt class="column small-4 medium-3 large-2">Short form</dt>
        <dd class="column small-8 medium-9 large-10">{{$qualification->short}}</dd>
        <dt class="column small-4 medium-3 large-2">Position</dt>
        <dd class="column small-8 medium-9 large-10">{{$qualification->position}}</dd>
      </dl>
    </div>
  </div>
@endsection
@section('javascript')
  <script>
  $('a[data-method]').postLink();
  </script>
@endsection