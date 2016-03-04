@extends('layouts.admin',[
'page_title' => 'Categorie toevoegen',
'form_route_name' => 'admin.product.store'
])

@section('page-navigation')
<a href="{{URL::previous()}}" class="btn back"></a>
{!! Form::submit("Opslaan") !!}
@stop

@section('page-content')

@include('products.panels.create', [
'panelID'=>1,
'id' => "product-info",
'classes' => "cols-8 centered",
'title' => "Product Toevoegen",
])

@stop
