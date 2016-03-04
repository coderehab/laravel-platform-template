@extends('layouts.admin',[
'page_title' => 'Category bewerken: ' . $category->name,
'form_route_name' => 'admin.category.update',
'form_route_id' => $category->id,
'form_method' => "PUT"
])

@section('page-navigation')
<a href="{{URL::previous()}}" class="btn back"></a>
{!! Form::submit("Opslaan") !!}
@stop

@section('page-content')

@include('product.category.panels.create_form', [
'panelID'=>1,
'id' => "product-info",
'classes' => "cols-4 centered",
'title' => "Category Bewerken",
])

@stop
