@extends('layouts.admin',[
'page_title' => 'Product overzicht'
])

@section('page-navigation')
<a href="{{route('admin.product.create')}}" class="btn">+ Nieuw Bedrijf</a>
@stop

@section('page-content')

@include('partials.basic-list', [
'panelID'=>1,
'id' => "company-list",
'classes' => "cols-12",
'title' => false,
'data' => $companies,
'type_key' => 'company',
'list_params' =>
[
'name' => 'Naam',
]
])

@stop
