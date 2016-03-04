@extends('layouts.admin',[
'page_title' => 'Account',
'form_route_name' => 'admin.account.update',
'form_route_id' => $user->id,
'form_method' => "PUT"
])
@section('page-navigation')
{!! Form::submit("Bijwerken") !!}
@stop

@section('page-content')

<div class='cols-4'>
@include('account.panels.account-info', [
	'panelID'=>1,
	'id' => "account-info",
	'classes' => "cols-12",
	'title' => "Jouw Gegevens",
	'inline_form' => true,
	])
</div>

<div class='cols-4'>
@include('account.panels.password', [
	'panelID'=>2,
	'id' => "password",
	'classes' => "cols-12",
	'title' => "Wachtwoord wijzigen",
	'inline_form' => true,
	])
</div>

@stop
