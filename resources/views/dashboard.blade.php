@extends('layouts.admin',[
'page_title' => 'Dashboard'
])

@section('page-navigation')
@stop

@section('page-content')

<div class='row'>

	@include('order.panels.advanced-list', [
	'panelID'=>1,
	'id' => "order-list",
	'classes' => "cols-7",
	'title' => "Bestellingen",
	'data' => $orders,
	'data_before' => $finished_orders,
	'type_key' => 'order',
	'list_params' =>
	[
	'id' => ['label' => 'Bestelling ID', 'before' => '#'],
	'created_at' => 'Ontvangen op',
	'address' => 'Adres',
	'city' => 'Stad',
	]
	])

	@include('order.panels.receipt', [
	'panelID'=>2,
	'id' => "order-receipt",
	'classes' => "cols-5",
	'title' => "Selecteer een bestelling",
	'data' => $selectedOrder,
	'type_key' => 'order',
	'list_params' =>
	[
	'created_at' => 'Ontvangen op',
	]
	])

</div>

<script>
	var parseDate = function(s) {
		return new Date(s);
	};

	var updateOrderList = function(){
		var now = new Date()

		$('#open-orders td.created_at').each(function(i, td){
			//alert('update rows')
			var row = $(td).closest('tr');
			var datestring = $(td).text().replace(/-/g, '/');;
			var date = new Date(datestring);

			var	time = now.getTime() - date.getTime();

			var prioTime1 = 40 * 60 * 1000 // 40 minutes
			var prioTime2 = 20 * 60 * 1000 // 20 minutes

			if(time <= prioTime2 && !row.hasClass('priority-3')) {
				row.removeClass('priority-1');
				row.removeClass('priority-2');
				row.addClass('priority-3');
			}

			if(time > prioTime2 && time <= prioTime1 && !row.hasClass('priority-2')){
				row.removeClass('priority-1');
				row.removeClass('priority-3');
				row.addClass('priority-2');
			}

			if(time > prioTime1 && !row.hasClass('priority-1')) {
				row.removeClass('priority-3');
				row.removeClass('priority-2');
				row.addClass('priority-1');
			};
		});

		$('#order-list tr.first-of-priority').removeClass('first-of-priority');
		$('#order-list .priority-1').first().addClass('first-of-priority');
		$('#order-list .priority-2').first().addClass('first-of-priority');
		$('#order-list .priority-3').first().addClass('first-of-priority');
	}

	updateOrderList();
	setInterval(updateOrderList, 1000);
</script>
@stop
