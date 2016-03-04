@extends('layouts.admin',[
'page_title' => 'Allegeen toevoegen',
'form_route_name' => 'admin.allergen.store'
])

@section('page-navigation')
<a href="{{URL::previous()}}" class="btn back"></a>
{!! Form::submit("Opslaan") !!}
@stop

@section('page-content')

@include('product.allergen.panels.create_form', [
'panelID'=>1,
'id' => "allergen-info",
'classes' => "cols-8 centered",
'title' => "Allergeen Toevoegen",
])

@stop
