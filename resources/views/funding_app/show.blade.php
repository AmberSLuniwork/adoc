@extends('../layout')
@section('title', $funding_app->title)
@section('breadcrumbs')
  <li><a href="{{route('funding_app.index')}}">Funding Applications</a></li>
  <li class="current"><a href="{{route('funding_app.show', [$funding_app])}}">{{$funding_app->title}}</a>
@endsection
@section('content')
  <div class="row">
    <div class="column small-12">
      @if(Auth::check())
        <div class="right">
          @allowed('fundingapplication.edit', $funding_app)
            <a href="{{route('funding_app.edit', [$funding_app])}}" class="button tiny">Edit</a>
          @endallowed
          @allowed('fundingapplication.delete', $funding_app)
            <a href="{{route('funding_app.destroy', [$funding_app])}}" class="button tiny alert" data-method="DELETE" data-confirm="{{UI::confirmDeleteSettings('funding application', $funding_app->title)}}" data-token="{{csrf_token()}}">Delete</a>
          @endallowed
        </div>
      @endif
      <h1>{{$funding_app->title}}
        <small>
          @if($funding_app->stage === 'preparation')
            in preparation
          @elseif($funding_app->stage === 'review')
            under review
          @elseif($funding_app->stage === 'decision' && $funding_app->success)
            successful
          @elseif($funding_app->stage === 'decision' && !$funding_app->success)
            unsuccessful
          @endif
        </small>
      </h1>
      <dl>
        <dt class="column small-6 medium-4 large-3">Funder</dt>
        <dd class="column small-6 medium-8 large-9"><a href="{{route('funder.show', $funding_app->funder())}}">{{$funding_app->funder()->name}}</a> ({{$funding_app->funder()->country}})</dd>
        @if($funding_app->scheme !== '')
          <dt class="column small-6 medium-4 large-3">Scheme</dt>
          <dd class="column small-6 medium-8 large-9">{{$funding_app->scheme}}</dd>
        @endif
        @if($funding_app->amount)
          <dt class="column small-6 medium-4 large-3">Amount</dt>
          <dd class="column small-6 medium-8 large-9">{{strtoupper($funding_app->currency)}} {{number_format($funding_app->amount, 2)}}</dd>
        @endif
        @if($funding_app->submission_date)
          <dt class="column small-6 medium-4 large-3">Submitted</dt>
          <dd class="column small-6 medium-8 large-9">{{$funding_app->submission_date}}</dd>
        @endif
      </dl>
      <h2>Summary</h2>
      <p>{{$funding_app->summary}}</p>
      @if(count($funding_app->applicants()->getResults()) > 0 || (Auth::check() && Auth::user()->allowed('fundingapplication.edit', $funding_app)))
        <h2>People</h2>
        <table>
          <thead>
            <tr>
              <th>Role</th>
              <th>Name</th>
              <th>Allocation</th>
              @allowed('fundingapplication.edit', $funding_app)
                <th>Action</th>
              @endallowed
            </tr>
          </thead>
          <tbody>
            @foreach($funding_app->applicants()->getResults() as $applicant)
              <tr>
                <td><abbr title="{{$applicant->role()->long}}">{{$applicant->role()->short}}</abbr></td>
                <td>
                  @if($applicant->person()->status == 'public' || (Auth::check() && Auth::user()->can('person.view', $applicant->person())))
                    <a href="{{route('person.show', [$applicant->person()])}}">{{$applicant->person()->fullName()}}</a>
                  @else
                    {{$applicant->person()->fullName()}}
                  @endif
                </td>
                <td>{{$applicant->allocation}}</td>
                @allowed('fundingapplication.edit', $funding_app)
                  <td>
                    <a href="{{route('funding_app.applicant.edit', [$funding_app, $applicant])}}" class="button tiny">Edit</a>
                    <a href="{{route('funding_app.applicant.destroy', [$funding_app, $applicant])}}" class="button tiny alert" data-method="DELETE" data-confirm="{{UI::confirmActionSettings('remove', 'person', $applicant->person()->fullName())}}" data-token="{{csrf_token()}}">Remove</a>
                  </td>
                @endif
              </tr>
            @endforeach
            @if(count($funding_app->applicants()->getResults()) === 0)
              <tr>
                <td colspan="4" class="nothing-found">No people linked to this funding application</td>
              </tr>
            @endif
          </tbody>
        </table>
        @allowed('fundingapplication.edit', $funding_app)
          <a href="{{route('funding_app.applicant.create', $funding_app->id)}}" class="button tiny">Add</a>
        @endallowed
      @endif
      @if(count($funding_app->fundings()->getResults()) > 0 || (Auth::check() && Auth::user()->allowed('fundingapplication.edit', $funding_app)))
        <h2>Funded Projects</h2>
        <table>
          <thead>
            <tr>
              <th>Name</th>
              <th>Amount</th>
            </tr>
          </thead>
          <tbody>
            @foreach($funding_app->fundings()->getResults() as $funding)
              <tr>
                <td>
                  @if($funding->project()->status == 'public' || (Auth::check() && Auth::user()->allowed('project.view', $funding->project())))
                    <a href="{{route('project.show', [$funding->project()])}}">{{$funding->project()->title}}</a>
                  @else
                    {{$funding->project()->title}}
                  @endif
                </td>
                <td>{{strtoupper($funding->currency)}} {{number_format($funding->amount, 2)}}</td>
              </tr>
            @endforeach
            @if(count($funding_app->fundings()->getResults()) === 0)
              <tr>
                <td colspan="2" class="nothing-found">No projects linked to this funding application</td>
              </tr>
            @endif
          </tbody>
        </table>
      @endif
    </div>
  </div>
@endsection
@section('javascript')
  <script>
  $('a[data-method]').postLink();
  </script>
@endsection