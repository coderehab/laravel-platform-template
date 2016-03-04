@extends('layouts.admin',[
'page_title' => 'Product variaties'
])

@section('page-navigation')
<a href="{{route('admin.product.index')}}" class="btn back"></a>
<a href="{{route('admin.variation.create')}}" class="btn">+ Nieuwe variatie</a>
@stop

@section('page-content')

@include('partials.basic-list', [
'panelID'=>1,
'id' => "variation-list",
'classes' => "cols-12",
'title' => false,
'data' => $variations,
'type_key' => 'variation',
'list_params' =>
[
'name' => 'Naam',
'type' => 'Type',
'description' => 'Omschrijving',
]
])

@stop
