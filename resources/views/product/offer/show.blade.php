@extends('layouts.admin',[
'page_title' => 'Aanbieding bewerken: ' . $offer->name,
'form_route_name' => 'admin.offer.update',
'form_route_id' => $offer->id,
'form_method' => "PUT"
])

@section('page-navigation')
<a href="{{URL::previous()}}" class="btn back"></a>
{!! Form::submit("Bijwerken") !!}
@stop

@section('page-content')

@include('product.offer.panels.create_form', [
'panelID'=>1,
'id' => "offer-info",
'classes' => "cols-8 centered",
'title' => "Aanbieding Bijwerken",
])

@stop
