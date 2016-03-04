@extends('partials.panel')

@section('panel-content-'.$panelID)

<div class='row '>
	<div class='cols-6'>
		<p>U bevind zich momenteel bij het bewerken van een variatie. Hier kunt u van alles aanpassen enzo. Je weet wel je klikt een veld aan en begint dan te typen. (korte uitleg)</p>
	</div>
</div>

<div class="cols-12 {!! $errors->first('name', 'error') !!}">
	{!! Form::label('name', 'Variatie naam') !!}
	{!! $errors->first('name', '<span class="message" >:message</span>') !!}
	{!! Form::text('name', $variation->name, array('placeholder' => 'Variatie naam')) !!}
</div>

<div class="cols-12 {!! $errors->first('type', 'error') !!}">
	{!! Form::label('type', 'Variatie type') !!}
	{!! $errors->first('type', '<span class="message" >:message</span>') !!}
	{!! Form::select('type', ['Maak een keuze', 'dropdown' => 'Dropdown', 'multiselect' => 'Multiselect', 'product-combination' => 'Product combinatie'], $variation->type) !!}
</div>

<div class="row validation min-max-selections">
	<div class="cols-6">
		{!! Form::label('min_selections', 'Min. selecties') !!} <br />
		{!! Form::text('min_selections', $variation->min_selections, array('placeholder' => 'Omschrijving')) !!}
	</div>
	<div class="cols-6">
		{!! Form::label('max_selections', 'Max. selecties') !!} <br />
		{!! Form::text('max_selections', $variation->max_selections, array('placeholder' => 'Omschrijving')) !!}
	</div>
</div>

<div class="cols-12  validation required">
	{!! Form::label('min_selections', 'Deze variatie is verplicht') !!} <br />
	{!! Form::checkbox('required', 1, $variation->required) !!}
</div>

<div class="row">
	<div class="cols-12 {!! $errors->first('description', 'error') !!}">
		{!! Form::label('description', 'Omschrijving') !!} <br />
		{!! $errors->first('description', '<span class="message" >:message</span>') !!}
		{!! Form::textarea('description', $variation->description, array('placeholder' => 'Omschrijving')) !!}
	</div>
</div>

<script>

	var show_validations = function (){

		$('.validation').hide();
		var type = $('#variation-info #type').find(':selected').val();

		if( type == 'product-combination' || type == 'multiselect' ) $('.min-max-selections').show();
		if( type == 'dropdown')  $('.required').show();

	}

	$('#variation-info #type').change(show_validations);

	show_validations();
</script>

@stop
