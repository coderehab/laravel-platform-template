@extends('layouts.admin',[
'page_title' => 'Bedrijfsinstellingen',
'form_route_name' => 'admin.company.update',
'form_route_id' => $company->id,
'form_method' => "PUT"
])

@section('page-navigation')
{!! Form::submit("Bijwerken") !!}
@stop

@section('page-content')

<div class='cols-4'>
	@include('company.panels.basic-info', [
	'panelID'=>1,
	'id' => "company-info",
	'classes' => "cols-12",
	'title' => "Bedrijfsgegevens",
	])
</div>

<div class='cols-4'>

	@include('company.panels.openinghours', [
	'panelID'=>2,
	'id' => "openinghours",
	'classes' => "cols-12",
	'title' => "Openingstijden",
	])

</div>

<div class='cols-4'>

	@include('company.panels.payment-info', [
	'panelID'=>3,
	'id' => "company-info",
	'classes' => "cols-12",
	'title' => "Betalingsmethoden",
	])

	@include('company.panels.pickup-info', [
	'panelID'=>4,
	'id' => "company-info",
	'classes' => "cols-12",
	'title' => "Afhaal instellingen",
	])

	@include('company.panels.delivery-info', [
	'panelID'=>5,
	'id' => "company-info",
	'classes' => "cols-12",
	'title' => "Bezorg instellingen",
	])

</div>

@stop

@section('page-after')

@include('company.popups.create-postal-area', [
'popupID'=>1,
'id' => "create-postal-area",
'classes' => "",
'title' => "Postcodegebied aanmaken",
])

@include('company.popups.create-timerule', [
'popupID'=>2,
'id' => "create-timerule",
'classes' => "",
'title' => "Tijdregel aanmaken",
])

@stop
