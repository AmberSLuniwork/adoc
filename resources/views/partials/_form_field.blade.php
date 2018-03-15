<div class="row collapse">
  <div class="column small-12 {{$errors->first($field_name) ? 'error' : ''}}">
    @if($field_type === 'checkbox')
      <label>{!! Form::checkbox($field_name) !!} {{$label}}</label>
    @endif
    @if($field_type === 'text')
      <label>{{$label}} {!! Form::text($field_name) !!}</label>
    @elseif($field_type === 'hidden')
      {!! Form::hidden($field_name) !!}
    @elseif($field_type === 'textarea')
      <label>{{$label}} {!! Form::textarea($field_name) !!}</label>
    @elseif($field_type === 'password')
      <label>{{$label}} {!! Form::password($field_name) !!}</label>
    @elseif($field_type === 'number')
      <label>{{$label}} {!! Form::number($field_name, null, ['step' => 'any']) !!}</label>
    @elseif($field_type === 'email')
      <label>{{$label}} {!! Form::email($field_name) !!}</label>
    @elseif($field_type === 'url')
      <label>{{$label}} {!! Form::url($field_name) !!}</label>
    @elseif($field_type === 'date')
      <label>{{$label}} {!! Form::date($field_name) !!}</label>
    @elseif($field_type === 'select')
      <label>{{$label}} {!! Form::select($field_name, $values) !!}</label>
    @endif
    @if($errors->first($field_name))
      <small class="error">{{$errors->first($field_name)}}</small>
    @endif
  </div>
</div>
