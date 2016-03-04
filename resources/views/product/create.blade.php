@extends('layouts.admin',[
'page_title' => 'Product overzicht',
'form_route_name' => 'admin.product.store'
])

@section('page-navigation')
<a href="{{URL::previous()}}" class="btn back"></a>
{!! Form::submit("Opslaan") !!}
@stop

@section('page-content')

@include('product.panels.create_form', [
'panelID'=>1,
'id' => "product-info",
'classes' => "cols-8 centered",
'title' => "Product Toevoegen",
])

<div class='cols-8 centered'>
<div class=row>
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
