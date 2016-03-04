@extends('layouts.admin',[
'page_title' => 'Categorie overzicht',
])

@section('page-navigation')
<a href="{{route('admin.product.index')}}" class="btn back"></a>
@stop

@section('page-content')

<section class='row'>

	@include('product.category.panels.create_form', [
	'panelID'=>1,
	'id' => "category-form",
	'classes' => "cols-4",
	'title' => "Categorie Toevoegen",
	'inline_form' => true,
	])

	@include('partials.basic-list', [
	'panelID'=>2,
	'id' => "category-list",
	'classes' => "cols-8",
	'title' => false,
	'data' => $categories,
	'type_key' => 'category',
	'list_params' =>
	[
	'name' => 'Naam',
	'description' => 'Omschrijving',
	]
	])

</section>
@stop
