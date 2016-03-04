@extends('layouts.admin',[
'page_title' => 'Variatie overzicht',
'form_route_name' => 'admin.variation.store'
])

@section('page-navigation')
<a href="{{URL::previous()}}" class="btn back"></a>
{!! Form::submit("Opslaan") !!}
@stop

@section('page-content')

@include('product.variation.panels.create_form', [
'panelID'=>1,
'id' => "variation-info",
'classes' => "cols-8 centered",
'title' => "Variatie Toevoegen",
])

@stop
