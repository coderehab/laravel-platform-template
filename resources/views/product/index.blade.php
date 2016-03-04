@extends('layouts.admin',[
'page_title' => 'Product overzicht'
])

@section('page-navigation')
<a href="{{route('admin.product.create')}}" class="btn">+ Nieuw product</a>
<a href="{{route('admin.category.index')}}" class="btn">Product categorieen</a>
<a href="{{route('admin.variation.index')}}" class="btn">Product variaties</a>
<a href="{{route('admin.offer.index')}}" class="btn">Aanbiedingen/Acties</a>
@stop

@section('page-content')

@include('product.panels.sortable-menu', [
'panelID'=>1,
'id' => "menu-list",
'classes' => "cols-12",
'listclasses' => "",
'title' => "Hoofdmenu",
'data' => $menu_products,
'parent_data' => $categories,
'type_key' => 'product',
'list_params' =>
[
'name_html' => 'Product Naam',
'price_html' => '',
]
])

@include('product.panels.sortable-menu', [
'panelID'=>3,
'id' => "menu-list",
'classes' => "cols-12",
'listclasses' => "",
'title' => "Overige producten",
'data' => $other_products,
'parent_data' => $categories,
'type_key' => 'product',
'list_params' =>
[
'name_html' => 'Product Naam',
'price_html' => '',
]
])


@stop
