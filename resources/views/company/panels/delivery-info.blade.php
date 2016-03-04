@extends('partials.panel')

@section('panel-content-'.$panelID)
<div class='row '>
	<p>Indien u aan uw klant wenst te bezorgen vink dan onderstaande checkbox aan en vul de benodigde velden in.</p>
</div>

<p>
	{!! $errors->first('delivery_available', '<span class="message" >:message</span>') !!}
	{!! Form::checkbox('delivery_available', 1, $company->delivery_available) !!}
	{!! Form::label('delivery_available', 'Bezorging is mogelijk') !!}
</p>

<p>
	<strong>Postcodegebieden</strong>
	<a href="#" id='add-link' class='show-popup right gray-3 top-right' data-popup="create-postal-area"><strong>+</strong>Regel toevoegen</a>
</p>

<ul id="delivery_postal_areas" class='linked-items'>

	@if($company->delivery_postal_areas != null)
	@foreach(json_decode($company->delivery_postal_areas, true) as $key => $postal_area)
	<li class="item">
		<span class="title">{{$postal_area['postal_from']}} {{($postal_area['postal_to'] != "") ? " - " . $postal_area['postal_to'] : ""}}</span>
		<a href="#delete" class="icon right unlink"><i class="gray-3 fa fa-trash"></i></a>
		<span class="right">{{ ($postal_area['postal_delivery_price'] == "") ? "" : "€" . number_format($postal_area['postal_delivery_price'], 2, '.', ' ') }}</span>

		<input name="delivery_postal_areas[{{$key}}][postal_from]" type="hidden" value="{{$postal_area['postal_from']}}">
		<input name="delivery_postal_areas[{{$key}}][postal_to]" type="hidden" value="{{$postal_area['postal_to']}}">
		<input name="delivery_postal_areas[{{$key}}][postal_delivery_price]" type="hidden" value="{{$postal_area['postal_delivery_price']}}">
	</li>
	@endforeach
	@endif

</ul>

@stop
