<p>
	<strong>{{$title}}</strong>
	<a href="#" id='add-link' class='show-popup right gray-3 top-right' data-popup="create-timerule"><strong>+</strong>Regel toevoegen</a>
</p>

<ul id="timerules-{{$id}}" class='linked-items timerules'>
@if(isset($timerules) && count($timerules) > 0)

	@foreach($timerules as $key => $timerules_type)
	@foreach($timerules_type as $key => $timerule)
	<li class="item {{ $timerule['type'] }}">
		@if($timerule['repeat_on'] != 'other')
		<span class="title"><strong> {{ $timerule['typeText'] }} van: </strong>{{ $timerule['time_from'] }}-{{ $timerule['time_to'] }}</span>
		@else
		<span class="title">{{ $timerule['rule_title'] }}, {{ $timerule['typeText'] }} van: {{ $timerule['time_from'] }}-{{ $timerule['time_to'] }}</span>
		@endif
		<a href="#delete" class="icon right unlink"><i class="gray-3 fa fa-trash"></i></a>
		<span class="right">{{ $timerule['menu'] }}</span>
		<input name="openinghours[{{ $timerule['repeat_on'] }}][{{ $timerule['type'] }}][{{ $key }}][type]" type="hidden" value="{{ $timerule['type'] }}">
		<input name="openinghours[{{ $timerule['repeat_on'] }}][{{ $timerule['type'] }}][{{ $key }}][typeText]" type="hidden" value="{{ $timerule['typeText'] }}">
		<input name="openinghours[{{ $timerule['repeat_on'] }}][{{ $timerule['type'] }}][{{ $key }}][time_from]" type="hidden" value="{{ $timerule['time_from'] }}">
		<input name="openinghours[{{ $timerule['repeat_on'] }}][{{ $timerule['type'] }}][{{ $key }}][time_to]" type="hidden" value="{{ $timerule['time_to'] }}">
		<input name="openinghours[{{ $timerule['repeat_on'] }}][{{ $timerule['type'] }}][{{ $key }}][repeat_on]" type="hidden" value="{{ $timerule['repeat_on'] }}">
		<input name="openinghours[{{ $timerule['repeat_on'] }}][{{ $timerule['type'] }}][{{ $key }}][rule_title]" type="hidden" value="{{ $timerule['rule_title'] }}">
		<input name="openinghours[{{ $timerule['repeat_on'] }}][{{ $timerule['type'] }}][{{ $key }}][date_day]" type="hidden" value="{{ $timerule['date_day'] }}">
		<input name="openinghours[{{ $timerule['repeat_on'] }}][{{ $timerule['type'] }}][{{ $key }}][date_month]" type="hidden" value="{{ $timerule['date_month'] }}">
		<input name="openinghours[{{ $timerule['repeat_on'] }}][{{ $timerule['type'] }}][{{ $key }}][date_year]" type="hidden" value="{{ $timerule['date_year'] }}">
		<input name="openinghours[{{ $timerule['repeat_on'] }}][{{ $timerule['type'] }}][{{ $key }}][menu]" type="hidden" value="{{ $timerule['menu'] }}">
	</li>
	@endforeach
	@endforeach

@else


<p>{{$no_data_text}}</p>

@endif
</ul>
