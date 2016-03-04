@extends('layouts.admin',[
'page_title' => 'Allergenen overzicht'
])

@section('page-navigation')
<a href="{{URL::previous()}}" class="btn back"></a>
<a href="{{route('admin.allergen.create')}}" class="btn">+ Allergeen toevoegen</a>
@stop

@section('page-content')

@include('partials.basic-list', [
'panelID'=>1,
'id' => "allergen-list",
'classes' => "cols-12",
'title' => false,
'data' => $allergens,
'type_key' => 'allergen',
'list_params' =>
[
'name' => 'Naam',
'description' => 'Omschrijving',
]
])

@stop
