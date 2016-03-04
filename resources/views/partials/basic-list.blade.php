@extends('partials.panel')

@section('panel-content-'.$panelID)
@if(isset($data))

@if(count($data) > 0 )
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
		<th></th>
	</tr>

	@foreach($data as $data)
	@if(isset($list_params))

	<tr>
	@foreach($list_params as $key => $rowdata)
		@if(gettype($rowdata) != 'array')
		<td>
			{!! $data[$key] !!}</td>
		@else
		<td>{!! isset($rowdata['before']) ? $rowdata['before'] : '' !!}{!!$data[$key]!!}{!! isset($rowdata['after']) ? $rowdata['after'] : '' !!}</td>
		@endif
	@endforeach
		@if(!isset($hide_edit) || $hide_edit == false)
		<td width="50" class="alignright">
			@if(isset($data->id))
			{!! link_to_route('admin.' . $type_key . '.show', "Aanpassen", ["id" => $data->id]) !!}
			@else
			{!! link_to_route('admin.' . $type_key . '.show', "Aanpassen", array($data->id)) !!}
			@endif
		</td>
		@endif
		@if(!isset($hide_remove) || $hide_remove == false)
		<td width="10" class="alignright">
			{!! Form::open(array('route' => array('admin.' . $type_key . '.destroy', $data->id), 'method' => 'delete')) !!}
			<button type="submit" class='btn right remove'></button>
			{!! Form::close() !!}
		</td>
		@endif
	</tr>

	@endif
	@endforeach

</table>

@else
Er zijn nog geen items aanwezig!
@endif

@else
<p>Data not set</p>
@endif
@stop
