@extends('layouts.admin',[
'page_title' => 'Aanbiedingen overzicht'
])

@section('page-navigation')
<a href="{{route('admin.product.index')}}" class="btn back"></a>
<a href="{{route('admin.offer.create')}}" class="btn">+ Nieuwe aanbieding</a>

@stop

@section('page-content')

@include('partials.basic-list', [
'panelID'=>1,
'id' => "offer-list",
'classes' => "cols-12",
'title' => false,
'data' => $offers,
'type_key' => 'offer',
'list_params' =>
[
'name' => 'Naam',
'description' => 'Omschrijving',
]
])

@stop
