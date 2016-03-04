@extends('partials.panel')

@section('panel-content-'.$panelID)

<div class='row '>
	<div class='cols-6'>
		<p>U bevind zich momenteel bij het bewerken van een variatie. Hier kunt u van alles aanpassen enzo. Je weet wel je klikt een veld aan en begint dan te typen. (korte uitleg)</p>
	</div>
</div>

<div class='row '>
	<div class="cols-6 {!! $errors->first('name', 'error') !!}">
		{!! Form::label('name', 'Allergeen naam') !!}
		{!! $errors->first('name', '<span class="message" >:message</span>') !!}
		{!! Form::text('name', $allergen->name, array('placeholder' => 'Allergeen naam')) !!}
	</div>

</div>

<div class="row">
	<div class="cols-12 {!! $errors->first('description', 'error') !!}">
		{!! Form::label('description', 'Omschrijving') !!} <br />
		{!! $errors->first('description', '<span class="message" >:message</span>') !!}
		{!! Form::textarea('description', $allergen->description, array('placeholder' => 'Omschrijving')) !!}
	</div>
</div>

@stop
