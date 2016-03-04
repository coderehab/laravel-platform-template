@extends('partials.panel')

@section('panel-content-'.$panelID)

<div class='row '>
	<div class='cols-6'>
		<p>U bevind zich momenteel bij het bewerken van een product. Hier kunt u van alles aanpassen enzo. Je weet wel je klikt een veld aan en begint dan te typen. (korte uitleg)</p>
	</div>
	<div class='cols-6'>
		{!! Form::label('category', 'Afbeelding') !!}
		{!! Form::file('image') !!}
	</div>
</div>

<div class="row">
	<div class="cols-6 {!! $errors->first('name', 'error') !!}">
		{!! Form::label('name', 'Productnaam') !!}
		{!! $errors->first('name', '<span class="message" >:message</span>') !!}
		{!! Form::text('name', $product->name, array('placeholder' => 'Productnaam')) !!}
	</div>
	<div class="cols-6 {!! $errors->first('taxonomy_id', 'error') !!}">
		{!! Form::label('taxonomy_id', 'Categorie') !!}
		{!! $errors->first('taxonomy_id', '<span class="message" >:message</span>') !!}
		{!! Form::select('taxonomy_id', $category_list, $product->taxonomy_id) !!}
	</div>
</div>

<div class="row">
	<div class="cols-6 {!! $errors->first('description', 'error') !!}">
		{!! Form::label('description', 'Omschrijving') !!} <br />
		{!! $errors->first('description', '<span class="message" >:message</span>') !!}
		{!! Form::textarea('description', $product->description, array('placeholder' => 'Omschrijving')) !!}
	</div>
	<div class="cols-6">
		<div class="cols-6 {!! $errors->first('price', 'error') !!}">
			{!! Form::label('price', 'Prijs (€) ') !!}
			{!! $errors->first('price', '<span class="message" >:message</span>') !!}
			{!! Form::text('price', $product->price, array('placeholder' => 'Bedrag')) !!}
		</div>
		<div class="cols-6 {!! $errors->first('price_discount', 'error') !!}">
			{!! Form::label('price_discount', 'Kortingsprijs (€) ') !!}
			{!! $errors->first('price_discount', '<span class="message" >:message</span>') !!}
			{!! Form::text('price_discount', $product->price_discount, array('placeholder' => 'Bedrag')) !!}
		</div>
	</div>
	<div class="cols-6 {!! $errors->first('active', 'error') !!}">
		{!! Form::checkbox('active', '1', true) !!}
		{!! Form::label('active', 'Product is actief') !!}
		{!! $errors->first('active', '<span class="message" >:message</span>') !!}
	</div>
</div>

@stop
