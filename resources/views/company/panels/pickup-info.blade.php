@extends('partials.panel')

@section('panel-content-'.$panelID)
<div class='row'>
	<p>Indien u klant de bestellingen bij u kan afhalen vinkt u dan de onderstaande checkbox aan en vul de benodigde velden in.</p>
</div>

<p class="{!! $errors->first('pickup_available', 'error') !!}">
	{!! $errors->first('pickup_available', '<span class="message" >:message</span>') !!}
	{!! Form::checkbox('pickup_available', 1, $company->pickup_available) !!}
	{!! Form::label('pickup_available', 'Afhalen is mogelijk') !!}
</p>

@stop
