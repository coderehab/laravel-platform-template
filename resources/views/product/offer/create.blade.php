@extends('layouts.admin',[
'page_title' => 'Aanbieding toevoegen',
'form_route_name' => 'admin.offer.store'
])

@section('page-navigation')
<a href="{{URL::previous()}}" class="btn back"></a>
{!! Form::submit("Opslaan") !!}
@stop

@section('page-content')

@include('product.offer.panels.create_form', [
'panelID'=>1,
'id' => "offer-info",
'classes' => "cols-8 centered",
'title' => "Aanbieding Toevoegen",
])

@stop
