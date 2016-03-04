@extends('partials.popup')

@section('popup-content-'.$popupID)

<form id="popup-form-{{$popupID}}">
	<div class='row'>
		<div class="cols-4">
			{!! Form::label('type', 'Van:') !!}
			{!! Form::text('postal_from', '', array('id' => 'postal_from', 'placeholder' => 'Postcode')) !!}
		</div>

		<div class="cols-4">
			{!! Form::label('price', 'Tot:') !!}
			{!! Form::text('postal_to', '', array('id' => 'postal_to', 'placeholder' => 'Postcode')) !!}
		</div>

		<div class="cols-4">
			{!! Form::label('delivery_costs', 'Bezorgkosten') !!}
			{!! Form::text('delivery_costs', '', array('id' => 'delivery_costs', 'placeholder' => 'Prijs')) !!}
		</div>
	</div>

	<div class="row">
		<br />
		<input type='submit' value='Invoegen' class='right'>
		<input type='submit' value='Annuleren' class='right close btn-inverse' style="margin-right:10px;">
	</div>
</form>

<script>

	var list = $('#delivery_postal_areas');
	var popup_form_{{ $popupID }} = $('#popup-form-' + {{$popupID}});

	popup_form_{{ $popupID }}.css('width','400px')

	popup_form_{{$popupID}}.submit(function(e){
		e.preventDefault();

		var postal_from = popup_form_{{ $popupID }}.find('input#postal_from').val();
		var postal_to = popup_form_{{ $popupID }}.find('input#postal_to').val();
		var postal_delivery_price = popup_form_{{ $popupID }}.find('input#delivery_costs').val();
		var priceHtml = (postal_delivery_price) ? '€' + postal_delivery_price : "";
		var list_length = $('#delivery_postal_areas .item').length;

		var html = '<li class="item">';
		if (postal_to == '') html += '<span class="title">' + postal_from + '</span>';
		else html += '<span class="title">' + postal_from + '-' + postal_to + '</span>';
		html += '<a href="#delete" class="icon right unlink"><i class="gray-3 fa fa-trash"></i></a>';
		html += '<span class="right">' + priceHtml + '</span>';
		html += '<input name="delivery_postal_areas['+ list_length +'][postal_from]" type="hidden" value="' + postal_from + '">';
		html += '<input name="delivery_postal_areas['+ list_length +'][postal_to]" type="hidden" value="' + postal_to + '">';
		html += '<input name="delivery_postal_areas['+ list_length +'][postal_delivery_price]" type="hidden" value="' + postal_delivery_price + '">';
		html += '</li>';
		list.append(html);

		popup_form_{{ $popupID }}.find('select').val('');
		popup_form_{{ $popupID }}.find('input[type!=submit]').val('');


		popup_form_{{ $popupID }}.closest('.popup').removeClass('visible');
	});

	list.on('click', '.item .unlink', function(e){
		$(this).parent('.item').remove();
	});

</script>

@stop
