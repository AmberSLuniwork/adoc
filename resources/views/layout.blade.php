<!DOCTYPE html>
<html>
  <head>
    <title>@yield('title')</title>
    <link href="//fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="{{url('css/app.css')}}" type="text/css"/>
  </head>
  <body>
    <nav class="top-bar" data-topbar role="navigation">
      <ul class="title-area">
        <li class="name"><h1><a href="{{route('root')}}">Academic Documentation</a></h1></li>
        <li class="toggle-topbar menu-icon"><a href="#"><span></span></a></li>
      </ul>
      <section class="top-bar-section">
        <ul class="right">
          <li class="has-dropdown">
            @if(Auth::check())
              <a href="#">{{Auth::user()['name']}}</a>
              <ul class="dropdown">
                <li><a href="{{route('auth.logout')}}">Logout</a></li>
              </ul>
            @else
              <a href="{{route('auth.login')}}">Login</a>
              <ul class="dropdown">
                <li><a href="{{route('auth.login')}}">Login</a></li>
                <li><a href="{{route('auth.register')}}">Register</a></li>
              </ul>
            @endif
          </li>
        </ul>
        <ul class="left">
          <li class="has-dropdown">
            <a href="#">Sections</a>
            <ul class="dropdown">
              <li class="{{strpos(Route::currentRouteName(), 'funding_app.') === 0 ? 'active' : ''}}"><a href="{{route('funding_app.index')}}">Funding Applications</a></li>
              <li class="{{strpos(Route::currentRouteName(), 'person.') === 0 ? 'active' : ''}}"><a href="{{route('person.index')}}">People</a></li>
              <li class="{{strpos(Route::currentRouteName(), 'project.') === 0 ? 'active' : ''}}"><a href="{{route('project.index')}}">Projects</a></li>
              <li class="divider"></li>
              <li class="has-dropdown">
                <a href="#">Other</a>
                <ul class="dropdown">
                  <li class="{{strpos(Route::currentRouteName(), 'funder.') === 0 ? 'active' : ''}}"><a href="{{route('funder.index')}}">Funders</a></li>
                  <li class="{{strpos(Route::currentRouteName(), 'project_role.') === 0 ? 'active' : ''}}"><a href="{{route('project_role.index')}}">Project Roles</a></li>
                  <li class="{{strpos(Route::currentRouteName(), 'qualification.') === 0 ? 'active' : ''}}"><a href="{{route('qualification.index')}}">Qualifications</a></li>
                </ul>
              </li>
            </ul>
          </li>
          @if(Auth::check())
            <li class="has-dropdown">
              <a href="#">Add</a>
              <ul class="dropdown">
                @permission('fundingapplication.create')
                  <li><a href="{{route('funding_app.create')}}">Funding Application</a></li>
                @endpermission
                @permission('project.create')
                  <li><a href="{{route('project.create')}}">Project</a></li>
                @endpermission
                @permission('person.create')
                  <li><a href="{{route('person.create')}}">Person</a></li>
                @endpermission
                <li class="divider"></li>
                <li class="has-dropdown">
                  <a href="#">Other</a>
                  <ul class="dropdown">
                    @permission('funder.create')
                      <li><a href="{{route('funder.create')}}">Funder</a></li>
                    @endpermission
                    @permission('qualification.create')
                      <li><a href="{{route('project_role.create')}}">Project Role</a></li>
                    @endpermission
                    @permission('qualification.create')
                      <li><a href="{{route('qualification.create')}}">Qualification</a></li>
                    @endpermission
                  </ul>
                </li>
              </ul>
            </li>
          @endif
        </ul>
      </section>
    </nav>
    <ul class="breadcrumbs">
      <li><a href="{{route('root')}}">Home</a></li>
    @yield('breadcrumbs')
    </ul>
    @yield('content')
    <script src="{{url('js/all.js')}}"></script>
    <script>jQuery(document).foundation();</script>
    @yield('javascript')
  </body>
</html>
