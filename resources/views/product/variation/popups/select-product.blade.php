@extends('partials.popup')

@section('popup-content-'.$popupID)

<form id="popup-form-{{$popupID}}">
	<div class='row'>
		<div class="cols-8">
			{!! Form::label('type', 'Variatie type') !!}
			{!! Form::select('type', $product_list, null, ['placeholder' => 'Maak een keuze']) !!}
		</div>

		<div class="cols-4">
			{!! Form::label('price', 'Aangepaste prijs:') !!}
			{!! Form::text('name', '', array('id' => 'alt-price', 'placeholder' => 'prijs')) !!}
		</div>
	</div>

	<div class="row">
		<br />
		<input type='submit' value='Invoegen' class='right'>
		<input type='submit' value='Annuleren' class='right close btn-inverse' style="margin-right:10px;">
	</div>
</form>

<script>

	var list = $('.variation-choices .linked-items');
	var popup_form_{{ $popupID }} = $('#popup-form-' + {{$popupID}});

	popup_form_{{$popupID}}.submit(function(e){
		e.preventDefault();

		var id = popup_form_{{ $popupID }}.find('select').val();
		var name = popup_form_{{ $popupID }}.find('select option[value=' + id + ']').text();
		var price = popup_form_{{ $popupID }}.find('input#alt-price').val();
		var priceHtml = (price) ? '€' + price : "Product prijs";

		if(id){
			var html = '<li class="item">';
			html += '<span class="title">' + name + '</span>';
			html += '<a href="#delete" class="icon right unlink"><i class="fa fa-unlink"></i></a>';
			html += '<span class="right">' + priceHtml + '</span>';
			html += '<input name="products[product_' + id + '][id]" type="hidden" value="' + id + '">';
			html += '<input name="products[product_' + id + '][name]" type="hidden" value="' + name + '">';
			html += '<input name="products[product_' + id + '][price]" type="hidden" value="' + price + '">';
			html += '<input id="order_value" name="products[product_' + id + '][order]" type="hidden" value="' + (list.length+1) + '">';
			html += '</li>';
			list.append(html);

			popup_form_{{ $popupID }}.find('select').val('');
			popup_form_{{ $popupID }}.find('input[type!=submit]').val('');
		}

		popup_form_{{ $popupID }}.closest('.popup').removeClass('visible');
	});

	list.on('click', '.item .unlink', function(e){
		$(this).parent('.item').remove();
	});

</script>

@stop
