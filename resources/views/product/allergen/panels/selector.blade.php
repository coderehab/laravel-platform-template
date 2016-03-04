@extends('partials.panel', [
'classes' => $classes . " selector",
])

@section('panel-content-'.$panelID)

<div id="allergen-selector-{{ $panelID }}">

	<div class="selectwrapper" >
		<div class="selectbox" >
			{!! Form::select('allergens', $allergens_list, null, ['placeholder' => "Maak een keuze"]) !!}
		</div>
		<div class="buttonholder" >
			{!! Form::submit("+") !!}
		</div>
	</div>

	<ul class='linked-items sortable'>

		@if($parent->allergens != null)
		@foreach($parent->allergens as $allergen)
		<li class="item">
			<span>{{$allergen->name}}</span>
			<a href="#" class='icon right unlink'><i class="fa fa-unlink"></i></a>
			<a href="{{route('admin.allergen.show', $allergen->id)}}" class='icon right edit'><i class="fa fa-pencil"></i></a>
			{!! Form::hidden('allergens[' . $allergen->id . ']', $allergen->id) !!}
		</li>
		@endforeach
		@endif
	</ul>

</div>

<script> $(function() {

	var selector_{{$panelID}} = $('#allergen-selector-{{ $panelID }}');

	selector_{{ $panelID }}.find('.buttonholder input').click(function(e){
		e.preventDefault();

		var value = selector_{{ $panelID }}.find('.selectbox select').val();
		var name = selector_{{ $panelID }}.find('.selectbox select option[value=' + value + ']').text();

		if(value){
			var html = '<li class="item">';
			html += '<span>' + name + '</span>';
			html += '<a href="#delete" class="icon right unlink"><i class="fa fa-unlink"></i></a>';
			html += '<a target="_blank" href="/admin/allergen/' + value + '" class="icon right edit"><i class="fa fa-pencil"></i></a>';
			html += '<input name="allergens[]" type="hidden" value="' + value + '">';
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
