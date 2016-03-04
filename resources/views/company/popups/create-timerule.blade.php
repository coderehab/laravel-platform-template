@extends('partials.popup')

@section('popup-content-'.$popupID)

<form id="popup-form-{{$popupID}}">

	<div class='row'>
		{!! Form::label('type', 'Type') !!}
		{!! Form::select('type',  ['pickup' => 'Afhalen', 'closed' => 'Gesloten', 'delivery' => 'Bezorgen'], null, array('id' => 'type', 'placeholder' => 'Maak een keuze')) !!}
	</div>

	<div class='row'>
		<div class="cols-6">
			{!! Form::label('time_from', 'Van:') !!}
			{!! Form::text('time_from', '', array('id' => 'time_from', 'placeholder' => '00:00')) !!}
		</div>
		<div class="cols-6">
			{!! Form::label('time_to', 'Tot:') !!}
			{!! Form::text('time_to', '', array('id' => 'time_to', 'placeholder' => '00:00')) !!}
		</div>
	</div>

	<div class='row'>
		{!! Form::label('repeat_on', 'Herhalen op:') !!}
		{!! Form::select('repeat_on',  ['monday' => 'Maandag', 'tuesday' => 'Dinsdag', 'wednesday' => 'Woensdag', 'thursday' => 'Donderdag', 'friday' => 'Vrijdag', 'saturday' => 'Zaterdag', 'sunday' => 'Zondag'], null, array('id' => 'repeat_on', 'placeholder' => 'Niet herhalen')) !!}
	</div>

	<div id='timerule-no-repeat-fields'>
		<div class='row'>
			{!! Form::label('rule_title', 'Titel') !!}
			{!! Form::text('rule_title', '', array('id' => 'rule_title', 'placeholder' => 'Naam van de regel')) !!}
		</div>

		<div class='cols-12'>{!! Form::label('rule_date_days', 'Datum') !!}</div>
		<div class='row'>
			<div class="cols-2">
				{!! Form::text('date_day', '', array('id' => 'date_days', 'placeholder' => 'dd')) !!}
			</div>
			<div class="cols-2">
				{!! Form::text('date_month', '', array('id' => 'date_months', 'placeholder' => 'mm')) !!}
			</div>
			<div class="cols-3">
				{!! Form::text('date_year', '', array('id' => 'date_years', 'placeholder' => 'yyyy')) !!}
			</div>
		</div>
	</div>

	<div class="row">
		<br />
		<input type='submit' value='Invoegen' class='right'>
		<input type='submit' value='Annuleren' class='right close btn-inverse' style="margin-right:10px;">
	</div>
</form>

<script>

	var popup_form_{{ $popupID }} = $('#popup-form-' + {{$popupID}});
	popup_form_{{ $popupID }}.css('width','400px')

	popup_form_{{$popupID}}.submit(function(e){
		e.preventDefault();

		var type = popup_form_{{ $popupID }}.find('select#type').val();
		var typeText = popup_form_{{ $popupID }}.find('select#type option[value='+type+']').text();
		var time_from = popup_form_{{ $popupID }}.find('input#time_from').val();
		var time_to = popup_form_{{ $popupID }}.find('input#time_to').val();
		var repeat_on = popup_form_{{ $popupID }}.find('select#repeat_on').val();
		var rule_title = popup_form_{{ $popupID }}.find('input#rule_title').val();
		var date_day = popup_form_{{ $popupID }}.find('input#date_day').val();
		var date_month = popup_form_{{ $popupID }}.find('input#date_month').val();
		var date_year = popup_form_{{ $popupID }}.find('input#date_year').val();
		var menu = "mainmenu";

		repeat_on = repeat_on || 'other';

		var list = $('#timerules-' + repeat_on);
		var list_length = list.length+1;
		var html = '<li class="item ' + type + '">';

		if(repeat_on != 'other')
			html += '<span class="title">'+ typeText + ' van: ' + time_from + '-' + time_to + '</span>';
		else
			html += '<span class="title">' + rule_title + ', ' + typeText + ' van: ' + time_from + '-' + time_to + '</span>';

		html += '<a href="#delete" class="icon right unlink"><i class="gray-3 fa fa-trash"></i></a>';
		html += '<span class="right">' + menu + '</span>';
		html += '<input name="openinghours[' + repeat_on + '][' + type + ']['+ list_length +'][type]" type="hidden" value="' + type + '">';
		html += '<input name="openinghours[' + repeat_on + '][' + type + ']['+ list_length +'][typeText]" type="hidden" value="' + typeText + '">';
		html += '<input name="openinghours[' + repeat_on + '][' + type + ']['+ list_length +'][time_from]" type="hidden" value="' + time_from + '">';
		html += '<input name="openinghours[' + repeat_on + '][' + type + ']['+ list_length +'][time_to]" type="hidden" value="' + time_to + '">';
		html += '<input name="openinghours[' + repeat_on + '][' + type + ']['+ list_length +'][repeat_on]" type="hidden" value="' + repeat_on + '">';
		html += '<input name="openinghours[' + repeat_on + '][' + type + ']['+ list_length +'][rule_title]" type="hidden" value="' + rule_title + '">';
		html += '<input name="openinghours[' + repeat_on + '][' + type + ']['+ list_length +'][date_day]" type="hidden" value="' + date_day + '">';
		html += '<input name="openinghours[' + repeat_on + '][' + type + ']['+ list_length +'][date_month]" type="hidden" value="' + date_month + '">';
		html += '<input name="openinghours[' + repeat_on + '][' + type + ']['+ list_length +'][date_year]" type="hidden" value="' + date_year + '">';
		html += '<input name="openinghours[' + repeat_on + '][' + type + ']['+ list_length +'][menu]" type="hidden" value="' + menu + '">';
		html += '</li>';
		list.append(html);

		popup_form_{{ $popupID }}.find('select').val('');
		popup_form_{{ $popupID }}.find('input[type!=submit]').val('');
		popup_form_{{ $popupID }}.closest('.popup').removeClass('visible');
	});

</script>

@stop
