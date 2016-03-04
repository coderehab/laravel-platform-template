@extends('partials.panel')

@section('panel-content-'.$panelID)
<div class='row '>
	<div class=''>
		<p>De openingstijden zijn te beheren aan de hand van tijdsblokken. Hierin geeft u aan of de winkel geopend of gesloten is en welke menukaar er gebruikt dient te worden op het aangegeven tijdstip.</p>
		<span></span>
	</div>
</div>

@include('company.partials.timerules-group', [
'title' => "Maandag",
'id' => 'monday',
'timerules' => isset($openinghours['monday']) ? $openinghours['monday'] : null,
'no_data_text' => 'Gesloten',
])

@include('company.partials.timerules-group', [
'title' => "Dinsdag",
'id' => 'tuesday',
'timerules' => isset($openinghours['tuesday']) ? $openinghours['tuesday'] : null,
'no_data_text' => 'Gesloten',
])

@include('company.partials.timerules-group', [
'title' => "Woensdag",
'id' => 'wednesday',
'timerules' => isset($openinghours['wednesday']) ? $openinghours['wednesday'] : null,
'no_data_text' => 'Gesloten',
])

@include('company.partials.timerules-group', [
'title' => "Donderdag",
'id' => 'thursday',
'timerules' => isset($openinghours['thursday']) ? $openinghours['thursday'] : null,
'no_data_text' => 'Gesloten',
])

@include('company.partials.timerules-group', [
'title' => "Vrijdag",
'id' => 'friday',
'timerules' => isset($openinghours['friday']) ? $openinghours['friday'] : null,
'no_data_text' => 'Gesloten',
])

@include('company.partials.timerules-group', [
'title' => "Zaterdag",
'id' => 'saturday',
'timerules' => isset($openinghours['saturday']) ? $openinghours['saturday'] : null,
'no_data_text' => 'Gesloten',
])

@include('company.partials.timerules-group', [
'title' => "Zondag",
'id' => 'sunday',
'timerules' => isset($openinghours['sunday']) ? $openinghours['sunday'] : null,
'no_data_text' => 'Gesloten',
])

@include('company.partials.timerules-group', [
'title' => "Feestdagen/Overig",
'id' => 'other',
'timerules' => isset($openinghours['other']) ? $openinghours['other'] : null,
'no_data_text' => 'Geen regels aanwezig',
])

<script>

	$('.timerules').on('click', '.item .unlink', function(e){
		$(this).parent('.item').remove();
	});

</script>

@stop
