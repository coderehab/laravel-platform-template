@extends('partials.panel')

@section('panel-content-'.$panelID)

@if(isset($inline_form))

{!! Form::open(array('route'=>array('admin.category.store', isset($form_route_id) ? $form_route_id : null), 'files'=> true)) !!}
{!! Form::hidden('_method', 'POST') !!}
@endif

<div class='row '>
	<div class='cols-12'>
		<p>U bevind zich momenteel bij het bewerken van een category. Hier kunt u van alles aanpassen enzo. Je weet wel je klikt een veld aan en begint dan te typen. (korte uitleg)</p>
	</div>
	<div class="cols-12 {!! $errors->first('name', 'error') !!}">
		{!! Form::label('name', 'Categorie naam') !!}
		{!! $errors->first('name', '<span class="message" >:message</span>') !!}
		{!! Form::text('name', $category->name, array('placeholder' => 'Categorie naam')) !!}
	</div>
</div>

<div class="row">
	<div class="cols-12 {!! $errors->first('description', 'error') !!}">
		{!! Form::label('description', 'Omschrijving') !!} <br />
		{!! $errors->first('description', '<span class="message" >:message</span>') !!}
		{!! Form::textarea('description', $category->description, array('placeholder' => 'Omschrijving')) !!}
	</div>
</div>

<div class="row">
	<div class="cols-12">
		{!! Form::submit("Opslaan") !!}
	</div>
</div>

@if(isset($inline_form))
{!! Form::close() !!}
@endif
@stop
