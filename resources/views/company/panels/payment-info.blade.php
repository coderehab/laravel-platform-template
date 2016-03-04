@extends('partials.panel')

@section('panel-content-'.$panelID)
<div class='row'>
	<p>Indien u klant de bestellingen bij u kan afhalen vinkt u dan de onderstaande checkbox aan en vul de benodigde velden in.</p>
</div>

<p>
	{!! $errors->first('payment_cash_available', '<span class="message" >:message</span>') !!}
	{!! Form::checkbox('payment_cash_available', 1, $company->payment_cash_available) !!}
	{!! Form::label('payment_cash_available', 'Contante betalingen') !!}
	<br />
	{!! $errors->first('payment_account_available', '<span class="message" >:message</span>') !!}
	{!! Form::checkbox('payment_account_available', 1, $company->payment_account_available) !!}
	{!! Form::label('payment_account_available', 'Betaling op rekening') !!}
	<br />
	{!! $errors->first('payment_ideal_available', '<span class="message" >:message</span>') !!}
	{!! Form::checkbox('payment_ideal_available', 1, $company->payment_ideal_available) !!}
	{!! Form::label('payment_ideal_available', 'Mollie iDeal') !!}
</p>

@stop
