@extends('partials.panel')

@section('panel-content-'.$panelID)

@if(isset($data))
@if(count($data) > 0 )

<table class='list'>
	<tr class='list-head'>

		@if(isset($list_params))
		@foreach($list_params as $key => $rowdata)
		@if(gettype($rowdata) != 'array')
		<th class="{{$key}}" >{!! $rowdata !!}</th>
		@else
		<th class="{{$key}}" >{!! $rowdata['label'] !!}</th>
		@endif
		@endforeach
		@endif

		<th class="alignright in_menu"></th>
		<th class="alignright is_active">&nbsp;</th>
		<th class="alignright edit">&nbsp;</th>
		<th class="alignright remove">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
	</tr>
</table>

<div id="sortable-menu" class='sortable'>
@foreach($parent_data as $parent)
<table class='list sortable-table {{ isset($listclasses) ? $listclasses : "" }}'>

	<?php $lonely_childs = (count($parent_data) > 0) ? [] : $data ?>

	@if(isset($list_params))

	<?php $heading = null ?>
	@foreach($data as $item)
	@if(!$item->taxonomy_id) <?php $lonely_childs[] = $item ?> @endif
	@if ($item->taxonomy_id == $parent->id)
	@if (!$heading)
	<thead>
	<tr class='heading'>
		<th colspan="{{count($list_params) + 4}}">{{ $parent->name }}</th>
		<?php $heading = $parent->name ?>
	</tr>
	</thead>
	<tbody>
	@endif

	<tr>
		@foreach($list_params as $key => $rowdata)
		@if(gettype($rowdata) != 'array')
		<td class="{{$key}}">
			{!! $item[$key] !!}
		</td>
		@else
		<td class="{{$key}}">{{ isset($rowdata['before']) ? $rowdata['before'] : '' }}{{$item[$key]}}{{ isset($rowdata['after']) ? $rowdata['after'] : '' }}</td>
		@endif
		@endforeach


		<td  class="alignright in_menu">
			@if(isset($item->menu_id) && $item->menu_id == 0)
			{!! link_to_route('admin.' . $type_key . '.appendtomenu', "Toevoegen aan menu", array($item->id)) !!}
			@else
			{!! link_to_route('admin.' . $type_key . '.removefrommenu', "Verwijder uit menu", ["id" => $item->id]) !!}
			@endif
		</td>

		<td class="alignright is_active">
			@if(isset($item->active) && $item->active == 0)
			{!! link_to_route('admin.' . $type_key . '.toggleactive', "Activeren", ["id" => $item->id]) !!}
			@else
			{!! link_to_route('admin.' . $type_key . '.toggleactive', "Deactiveren", array($item->id)) !!}
			@endif
		</td>

		<td class="alignright edit">
			@if(isset($item->id))
			{!! link_to_route('admin.' . $type_key . '.show', "Aanpassen", ["id" => $item->id]) !!}
			@else
			{!! link_to_route('admin.' . $type_key . '.show', "Aanpassen", array($item->id)) !!}
			@endif
		</td>

		<td class="alignright remove">
			{!! link_to_route('admin.' . $type_key . '.destroy',"", ['id' => $item->id], ['class'=>'btn right remove']) !!}
		</td>
	</tr>

	@endif
	@endforeach
	@endif
	</tbody>
</table>
	@endforeach

    @if(isset($lonely_childs))
<table class='list sortable-table {{ isset($listclasses) ? $listclasses : "" }}'>
	@if(count($lonely_childs) > 0)
	<tr>
		<th colspan="{{count($list_params) + 2}}">Niet toegewezen</th>
	</tr>
	@foreach($lonely_childs as $item)

	<tr>
		@foreach($list_params as $key => $rowdata)
		@if(gettype($rowdata) != 'array')
		<td>
			{{ $item[$key] }}</td>
		@else
		<td>{{ isset($rowdata['before']) ? $rowdata['before'] : '' }}{{$item[$key]}}{{ isset($rowdata['after']) ? $rowdata['after'] : '' }}</td>
		@endif
		@endforeach



		<td class="alignright">
			@if(isset($item->menu_id) && $item->menu_id == 0))
			{!! link_to_route('admin.' . $type_key . '.appendtomenu', "Toon in hoofdmenu", ["id" => $item->id]) !!}
			@else
			{!! link_to_route('admin.' . $type_key . '.removefrommenu', "Verwijder uit hoofdmenu", array($item->id)) !!}
			@endif
		</td>

		<td class="alignright">
			@if(isset($item->menu_id))
			{!! link_to_route('admin.' . $type_key . '.toggleactive', "Deactiveren", ["id" => $item->id]) !!}
			@else
			{!! link_to_route('admin.' . $type_key . '.toggleactive', "Activeren", array($item->id)) !!}
			@endif
		</td>

		<td class="alignright">
			@if(isset($item->id))
				{!! link_to_route('admin.' . $type_key . '.show', "Aanpassen", ["id" => $item->id]) !!}
			@else
				{!! link_to_route('admin.' . $type_key . '.show', "Aanpassen", array($item->id)) !!}
			@endif
		</td>

		<td class="alignright">
			{!! link_to_route('admin.' . $type_key . '.destroy',"", ['id' => $item->id], ['class'=>'btn right remove']) !!}
		</td>
	</tr>

	@endforeach
	@endif

</table>
@endif
</div>
@else
Er zijn nog geen items aanwezig!
@endif

@else
<p>Data not set</p>
@endif
@stop
