@extends('partials.panel')

@section('panel-content-'.$panelID)
@if(isset($data))

<table id="open-orders" class='list dynamic-order-list'>
	<tr class='list-head'>
		<th class='checkbox'></th>
		@if(isset($list_params))
		@foreach($list_params as $key => $rowdata)
		@if(gettype($rowdata) != 'array')
		<th>{!! $rowdata !!}</th>
		@else
		<th>{!! $rowdata['label'] !!}</th>
		@endif
		@endforeach
		@endif

		<th></th>
	</tr>


	@if(count($data) > 0 )

	@foreach($data as $item)
	@if(isset($list_params))

	<tr class="{{ (isset($selectedOrder->id) && $item->id == $selectedOrder->id) ? 'selected' : '' }}">
		<td class='checkbox'></td>
		@foreach($list_params as $key => $rowdata)
		@if(gettype($rowdata) != 'array')
		<td class='{{$key}}'>
			{!! $item[$key] !!}</td>
		@else
		<td>{!! isset($rowdata['before']) ? $rowdata['before'] : '' !!}{!!$item[$key]!!}{!! isset($rowdata['after']) ? $rowdata['after'] : '' !!}</td>
		@endif
		@endforeach
		<td width="50" class="alignright">

			{!! link_to_route('dashboard', "Bekijken", ["order" => $item->id]) !!}

		</td>
	</tr>

	@endif
	@endforeach


	@else
	<tr class='no-orders-available' style="border-top:3px solid #ddd"><td colspan="{{count($list_params)+2}}">Momenteel staan er geen bestellingen in de wacht.</td></tr>
	@endif

</table>


<h3>Eerdere bestellingen</h3>

<table class='list'>

	<tr class='list-head'>
		@if(isset($list_params))
		@foreach($list_params as $key => $rowdata)
		@if(gettype($rowdata) != 'array')
		<th>{!! $rowdata !!}</th>
		@else
		<th>{!! $rowdata['label'] !!}</th>
		@endif
		@endforeach
		@endif

		<th></th>
	</tr>

	@foreach($data_before as $item)
	@if(isset($list_params))

	<tr class="{{ (isset($selectedOrder->id) && $item->id == $selectedOrder->id) ? 'selected' : '' }}">
		@foreach($list_params as $key => $rowdata)
		@if(gettype($rowdata) != 'array')
		<td class='{{$key}}'>
			{!! $item[$key] !!}</td>
		@else
		<td>{!! isset($rowdata['before']) ? $rowdata['before'] : '' !!}{!!$item[$key]!!}{!! isset($rowdata['after']) ? $rowdata['after'] : '' !!}</td>
		@endif
		@endforeach
		<td width="50" class="alignright">

			{!! link_to_route('dashboard', "Bekijken", ["order" => $item->id]) !!}

		</td>
	</tr>

	@endif
	@endforeach
</table>

@else
<p>Data not set</p>
@endif

@stop
