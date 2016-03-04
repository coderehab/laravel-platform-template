@extends('layouts.admin',[
'page_title' => 'Bestelling overzicht'
])

@section('page-navigation')
{{-- <a href="{{route('admin.order.create')}}" class="btn">+ Nieuwe Bestelling</a> --}}
@stop

@section('page-content')

@include('partials.basic-list', [
'panelID'=>1,
'id' => "order-list",
'classes' => "cols-12",
'title' => false,
'data' => $orders,
'type_key' => 'order',
'list_params' =>
[
'created_at' => 'Ontvangen op',
]
])

@stop
