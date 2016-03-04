@extends('layouts.admin',[
'page_title' => 'Product overzicht',
'form_route_name' => 'admin.product.update',
'form_route_id' => $product->id,
'form_method' => "PUT"
])

@section('page-navigation')
<a href="{{URL::previous()}}" class="btn back"></a>
{!! Form::submit("Opslaan") !!}
@stop

@section('page-content')

<div class='cols-4'>
	@include('product.panels.edit_form', [
	'panelID'=>1,
	'id' => "product-info",
	'classes' => "cols-12",
	'title' => "Product Toevoegen",
	])
</div>

<div class='cols-8'>
	@include('product.panels.statistics', [
	'panelID'=>2,
	'id' => "product-statistics",
	'classes' => "cols-12",
	'title' => "Statistieken",
	])

	@include('product.offer.panels.selector', [
	'panelID'=>3,
	'id' => "product-allergens",
	'classes' => "cols-12",
	'title' => "Gekoppelde Aanbiedingen",
	'parent' => $product,
	])

	<div class='row'>
		@include('product.allergen.panels.selector', [
		'panelID'=>4,
		'id' => "product-allergens",
		'classes' => "cols-6 compact",
		'title' => "Allergenen",
		'parent' => $product,
		])

		@include('product.variation.panels.selector', [
		'panelID'=>5,
		'id' => "product-variations",
		'classes' => "cols-6 compact",
		'title' => "Variaties",
		'parent' => $product,
		])
	</div>
</div>

@stop
