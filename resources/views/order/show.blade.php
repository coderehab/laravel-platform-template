@extends('layouts.admin',[
'page_title' => 'Variatie: ' . $order->name,
'form_route_name' => 'admin.order.update',
'form_route_id' => $order->id,
'form_method' => "PUT"
])

@section('page-navigation')
<a href="{{URL::previous()}}" class="btn back"></a>
{!! Form::submit("Bijwerken") !!}
@stop

@section('page-content')

@include('product.order.panels.create_form', [
'panelID'=>1,
'id' => "order-info",
'classes' => "cols-8 centered",
'title' => "Bestelling Bijwerken",
])

@stop
