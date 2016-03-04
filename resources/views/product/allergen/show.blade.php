@extends('layouts.admin',[
'page_title' => 'Allergeen bewerken: ' . $allergen->name,
'form_route_name' => 'admin.allergen.update',
'form_route_id' => $allergen->id,
'form_method' => "PUT"
])

@section('page-navigation')
<a href="{{URL::previous()}}" class="btn back"></a>
{!! Form::submit("Bijwerken") !!}
@stop

@section('page-content')

@include('product.allergen.panels.create_form', [
'panelID'=>1,
'id' => "allergen-info",
'classes' => "cols-8 centered",
'title' => "Allergeen Bijwerken",
])

@stop
