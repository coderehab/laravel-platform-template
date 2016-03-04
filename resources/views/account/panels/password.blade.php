@extends('partials.panel')

@section('panel-content-'.$panelID)
<div class="{!! $errors->first('password', 'error') !!}">
	{!! Form::label('password', 'Nieuw Wachtwoord') !!}
	{!! $errors->first('password', '<span class="message" >:message</span>') !!}
	{!! Form::password('password') !!}
</div>
<div class="{!! $errors->first('confirm', 'error') !!}">
	{!! Form::label('confirm', 'Bevestig Wachtwoord') !!}
	{!! $errors->first('confirm', '<span class="message" >:message</span>') !!}
	{!! Form::password('confirm') !!}
</div>
@stop
