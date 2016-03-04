@extends('partials.panel', [
'classes' => $classes . " selector",
])

@section('panel-header-'.$panelID)
<a href="#" id='add-link' class='show-popup color-1 top-right' data-popup="select-product"><strong>+</strong> Product koppelen</a>
@stop

@section('panel-content-'.$panelID)

<section class='variation-choices'>

	<ul class='linked-items sortable large'>
		@if($variation->linked_products != null)
		@foreach($variation->linked_products as $product)
		<li class="item">
			<span class="title">{{$product['name']}}</span>
			<a href="#delete" class="icon right unlink"><i class="fa fa-unlink"></i></a>
			<span class="right">{{ ($product['price'] == "") ? "Product prijs" : "€" . number_format($product['price'], 2, '.', ' ') }}</span>

			<input name="products[product_{{$product['id']}}][id]" type="hidden" value="{{$product['id']}}">
			<input name="products[product_{{$product['id']}}][name]" type="hidden" value="{{$product['name']}}">
			<input name="products[product_{{$product['id']}}][price]" type="hidden" value="{{$product['price']}}">
			<input id="order_value" name="products[product_{{$product['id']}}][order]" type="hidden" value="{{$product['order']}}">
		</li>
		@endforeach
		@endif

	</ul>

</section>

@stop
