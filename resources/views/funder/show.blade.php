@extends('../layout')
@section('title', $funder->name)
@section('breadcrumbs')
    <li><a href="{{route('funder.index')}}">Funders</a></li>
    <li class="current"><a href="{{route('funder.show', [$funder])}}">{{$funder->abbreviation}}</a>
        @endsection
        @section('content')
            <div class="row">
                <div class="column small-12">
                    @if(Auth::check())
                        <div class="right">
                            @permission('funder.edit')
                            <a href="{{route('funder.edit', [$funder])}}" class="button tiny">Edit</a>
                            @endpermission
                            @permission('funder.delete')
                            <a href="{{route('funder.destroy', [$funder])}}" class="button tiny alert" data-method="DELETE" data-confirm="{{UI::confirmDeleteSettings('funder', $funder->name)}}" data-token="{{csrf_token()}}">Delete</a>
                            @endpermission
                        </div>
                    @endif
                    <h1>{{$funder->name}} <small>({{$funder->abbreviation}})</small></h1>
                    <p>{{$funder->country}}</p>
                    </table>
                </div>
            </div>
        @endsection
        @section('javascript')
            <script>
                $('a[data-method]').postLink();
            </script>
@endsection