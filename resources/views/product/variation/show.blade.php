@extends('layouts.admin',[
'page_title' => 'Variatie bewerken: ' . $variation->name,
'form_route_name' => 'admin.variation.update',
'form_route_id' => $variation->id,
'form_method' => "PUT"
])

@section('page-navigation')
<a href="{{URL::previous()}}" class="btn back"></a>
{!! Form::submit("Bijwerken") !!}
@stop

@section('page-content')

@include('product.variation.panels.create_form', [
'panelID'=>1,
'id' => "variation-info",
'classes' => "cols-4",
'title' => "Variatie Bijwerken",
])

@include('product.variation.panels.linked-products', [
'panelID'=>2,
'id' => "variation-info",
'classes' => "cols-8",
'title' => "Keuze mogelijkheden",
])

@stop

@section('page-after')

@include('product.variation.popups.select-product', [
'popupID'=>1,
'id' => "select-product",
'classes' => "",
'title' => "Selecteer een product",
])

@stop
