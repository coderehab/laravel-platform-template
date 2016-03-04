@extends('partials.panel')

@section('panel-content-'.$panelID)
<div class="{!! $errors->first('firstname', 'error') !!}">
	{!! Form::label('firstname', 'Voornaam') !!}
	{!! $errors->first('firstname', '<span class="message" >:message</span>') !!}
	{!! Form::text('firstname', $user->firstname, array('placeholder' => 'Voornaam')) !!}
</div>
<div class="{!! $errors->first('lastname', 'error') !!}">
	{!! Form::label('lastname', 'Achternaam') !!}
	{!! $errors->first('lastname', '<span class="message" >:message</span>') !!}
	{!! Form::text('lastname', $user->lastname, array('placeholder' => 'Achternaam')) !!}
</div>
<div class="{!! $errors->first('email', 'error') !!}">
	{!! Form::label('email', 'Email') !!}
	{!! $errors->first('email', '<span class="message" >:message</span>') !!}
	{!! Form::text('email', $user->email, array('placeholder' => 'Email')) !!}
</div>
@stop
