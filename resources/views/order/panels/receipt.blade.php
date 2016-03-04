@extends('partials.panel',[
'title' => "" . isset($data->id) ? 'Bestelling #' . $data->id : $title,
])

@section('panel-header-'.$panelID)
@if(isset($data))
<span class='payment-status paid' class='green'>
	<h2>betaald</h2>
	<span class='payment-method'>Deze bestelling is betaald via iDeal</span>
</span>

<span class='order-status'>Nog niet afgerond</span>
@endif
@stop

@section('panel-content-'.$panelID)
@if(isset($data))

{!! Form::open(['route'=>['admin.order.complete', $data->id]]) !!}
{!! Form::hidden('_method', "POST") !!}

<table id='Receipt' class='list'>
	<thead>
		<tr>
			<th>{!! Form::checkbox('check-all', 0)!!}</th>
			<th class='amount'></th>
			<th width='400' class='product-info'>Product</th>
			<th width='100' class='alignright'>Prijs</th>
		</tr>
	</thead>
	<tbody>
		@foreach(json_decode($data->products) as $product)
		<tr>
			<td>{!! Form::checkbox('product[' . $product->id . ']', 0)!!}</td>
			<td class='amount'>{{ $product->amount }}x</td>
			<td class='product-info'>
				<h4>{{ $product->name }}</h4>
				@if(count($product->variations) > 0)
					@foreach($product->variations as $variation)

                    @if(isset($variation->value))
                      @if(isset($variation->value->name) && isset($variation->value->price))
                        <span class='variation-value'>+ {{$variation->value->name}} - €{{$variation->value->price}}</span>
                      @endif
                    @endif

					@endforeach
				@endif

				@if(isset($product->notes) && $product->notes != "")
				<p class='notes'><strong>Opmerking:</strong> {{$product->notes}}</p>
				@endif
			</td>
			<td class='price'>€{{ number_format(isset($product->subTotal) ? $product->subTotal :  $product->price, 2, '.', '') }}</td>
		</tr>
		@endforeach
	</tbody>
	<tfoot class='summary'>
		<tr>
			<td colspan='3'>Subtotaal</td>
			<td class='price'>€ {{ number_format($data->subtotal, 2, '.', '') }}</td>
		</tr>
		<tr>
			<td colspan='3'>Bezorgkosten</td>
			<td class='price'>€0.00</td>
		</tr>
		<tr class='total'>
			<td colspan='3'>Totaal</td>
			<td class='price'>€ {{ number_format($data->total, 2, '.', '') }}</td>
		</tr>
	</tfoot>
</table>

@if(isset($data->notes) && $data->notes != "")
<p class='notes'><strong>Opmerking:</strong>  {{$data->notes}}</p>
@endif

<p class='user_details'>
	<strong>Bestelling voor:</strong><br />
	{{$data->username}}<br />
	{{$data->address}}<br />
	{{$data->postal}} {{$data->city}}<br />
	{{$data->phone}}<br />
	{{$data->email}}
</p>

{{ Form::submit('Bestelling afronden', ['class'=>'right']) }}

{!! Form::close() !!}

@else
<p style='clear:both'>Geen Bestelling geselecteerd.</p>
@endif
@stop
