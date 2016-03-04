@extends('partials.panel')

@section('panel-content-'.$panelID)
<div class='row '>
	<div class=''>
		<p>Vul onderstaand uw algemene bedrijfsgegevens in.</p>
	</div>
</div>

<div class="{!! $errors->first('name', 'error') !!}">
	{!! Form::label('name', 'Bedrijfsnaam') !!}
	{!! $errors->first('name', '<span class="message" >:message</span>') !!}
	{!! Form::text('name', $company->name, array('placeholder' => 'Bedrijfsnaam')) !!}
</div>

<div class="{!! $errors->first('description', 'error') !!}">
	{!! Form::label('description', 'Over het bedrijf') !!} <br />
	{!! $errors->first('description', '<span class="message" >:message</span>') !!}
	{!! Form::textarea('description', $company->description, array('placeholder' => 'Omschrijving')) !!}
</div>

<div class="{!! $errors->first('address', 'error') !!}">
	{!! Form::label('address', 'Straatnaam + huisnummer') !!}
	{!! $errors->first('address', '<span class="message" >:message</span>') !!}
	{!! Form::text('address', $company->address, array('placeholder' => 'Straatnaam + huisnummer')) !!}
</div>

<div class='row'>
	<div class="cols-4 {!! $errors->first('postal', 'error') !!}">
		{!! Form::label('postal', 'Postcode ') !!}
		{!! $errors->first('postal', '<span class="message" >:message</span>') !!}
		{!! Form::text('postal', $company->postal, array('placeholder' => 'Postcode')) !!}
	</div>
	<div class="cols-8 {!! $errors->first('city', 'error') !!}">
		{!! Form::label('city', 'Plaatsnaam') !!}
		{!! $errors->first('city', '<span class="message" >:message</span>') !!}
		{!! Form::text('city', $company->city, array('placeholder' => 'Plaatsnaam')) !!}
	</div>
</div>

<div class="{!! $errors->first('phone', 'error') !!}">
	{!! Form::label('phone', 'Telefoonnummer') !!}
	{!! $errors->first('phone', '<span class="message" >:message</span>') !!}
	{!! Form::text('phone', $company->phone, array('placeholder' => 'Telefoonnummer')) !!}
</div>

<div class="{!! $errors->first('email_account', 'error') !!}">
	{!! Form::label('email_account', 'Algemeen E-mailadres') !!}
	{!! $errors->first('email_account', '<span class="message" >:message</span>') !!}
	{!! Form::text('email_account', $company->email_account, array('placeholder' => 'E-mailadres')) !!}
</div>

<div class="{!! $errors->first('email_orders', 'error') !!}">
	{!! Form::label('email_orders', 'E-mailadres voor bestelbevestiging') !!}
	{!! $errors->first('email_orders', '<span class="message" >:message</span>') !!}
	{!! Form::text('email_orders', $company->email_orders, array('placeholder' => 'E-mailadres')) !!}
</div>

<div class=''>
	{!! Form::label('category', 'Banner afbeelding') !!}
	{!! Form::file('image_banner') !!}
</div>

<div class=''>
	{!! Form::label('category', 'Afbeelding') !!}
	{!! Form::file('image_logo') !!}
</div>

<div class="{!! $errors->first('terms_of_delivery', 'error') !!}">
	{!! Form::label('terms_of_delivery', 'Uw leveringsvoorwaarden') !!} <br />
	{!! $errors->first('terms_of_delivery', '<span class="message" >:message</span>') !!}
	{!! Form::textarea('terms_of_delivery', $company->terms_of_delivery, array('placeholder' => 'Uw Leveringsvoorwaarden')) !!}
</div>

<div class="{!! $errors->first('extra_information', 'error') !!}">
	{!! Form::label('extra_information', 'Extra informatie') !!} <br />
	{!! $errors->first('extra_information', '<span class="message" >:message</span>') !!}
	{!! Form::textarea('extra_information', $company->extra_information, array('placeholder' => 'Extra informatie')) !!}
</div>

@stop
