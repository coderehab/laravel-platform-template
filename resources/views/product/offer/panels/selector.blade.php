@extends('partials.panel', [
'classes' => $classes . " selector",
])

@section('panel-content-'.$panelID)

<div id="offer-selector-{{ $panelID }}">

	<div class="selectwrapper" >
		<div class="selectbox" >
			{!! Form::select('offers', $offers_list, null, ['placeholder' => "Maak een keuze"]) !!}
		</div>
		<div class="buttonholder" >
			{!! Form::submit("+") !!}
		</div>
	</div>

	<ul class='linked-items sortable large'>

		@if($parent->offers != null)
		@foreach($parent->offers as $offer)
		<li class="item">
			<span>{{$offer->name}}</span>
			<a href="#" class='icon right unlink'><i class="fa fa-unlink"></i></a>
			<a href="{{route('admin.offer.show', $offer->id)}}" class='icon right edit'><i class="fa fa-pencil"></i></a>
			{!! Form::hidden('offers[' . $offer->id . ']', $offer->id) !!}
		</li>
		@endforeach
		@endif
	</ul>

</div>

<script> $(function() {

		var selector_{{$panelID}} = $('#offer-selector-{{ $panelID }}');

		selector_{{ $panelID }}.find('.buttonholder input').click(function(e){
			e.preventDefault();

			var value = selector_{{ $panelID }}.find('.selectbox select').val();
			var name = selector_{{ $panelID }}.find('.selectbox select option[value=' + value + ']').text();

			if(value){
				var html = '<li class="item">';
				html += '<span>' + name + '</span>';
				html += '<a href="#delete" class="icon right unlink"><i class="fa fa-unlink"></i></a>';
				html += '<a target="_blank" href="/admin/offer/' + value + '" class="icon right edit"><i class="fa fa-pencil"></i></a>';
				html += '<input name="offers[]" type="hidden" value="' + value + '">';
				html += '</li>';
				selector_{{ $panelID }}.find('.linked-items').append(html);
				selector_{{ $panelID }}.find('.selectbox select').val('');
			}
		});

		selector_{{ $panelID }}.on('click', '.item .unlink', function(e){
			$(this).parent('.item').remove();
		});

});</script>

@stop
