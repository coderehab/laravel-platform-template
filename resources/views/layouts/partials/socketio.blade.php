<script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/1.3.7/socket.io.min.js"></script>
<script>

	var current_company_id = {{ Auth::user()->companies->first()->id }}
	var socket = io.connect(':3000');

	socket.on('order.created', function(response) {
		if(response.company_id == current_company_id){
			prependOrder(response);
			appendNotification(response);
			printReceipt(response.receipt);
		}
	}.bind(this));

	$('.chat button').click(function(e){
		e.preventDefault();
		socket.emit('order.created', 'click');
	})

	function printReceipt(receipt) {
		if (notReady()) { return; }

		qz.setCopies(1);
		qz.append(receipt);

		qz.print();
	}

	function qzDonePrinting() {
		// Alert error, if any
		if (qz.getException()) {
			console.log('Error printing:\n\n\t' + qz.getException().getLocalizedMessage());
			qz.clearException();
			return;
		}
		//TODO: change order status to printed!
	}

	function prependOrder(order){
		console.log(order);
		var html = "<tr class='priority-3'>"
		html += "<td class='checkbox'></td>";
		html += "<td>#" + order.id + "</td>";
		html += "<td>" + order.created_at.date.replace('.000000', "") + "</td>";
		html += "<td>" + order.address + "</td>";
		html += "<td>" + order.city + "</td>";
		html += "<td><a href='/admin/dashboard?order=" + order.id + "'>Bekijken</a></td>";
		html += "</tr>";

		$('.no-orders-available').remove();
		$('.dynamic-order-list tbody').append(html);
		$('.dynamic-order-list .added').hide().fadeIn(1500, function(){
			$(this).removeClass('added');
		});

	}

	function appendNotification(order){
		var html = "<div class='notification latest' style='position:fixed; top:50px; right:-220px; background:#82a417; color:#fff; padding:20px; width:220px;'>"
		html += "<p style='margin:0; font-weight:500; font-size:14px'>Er is een nieuwe bestelling binnengekomen</p>";
		html += "</div>";

		$('body').append(html);
		$('.notification.latest').animate({"right": '0'}, 300, function(){
			$(this).removeClass('latest');
			$(this).delay(1000).fadeOut(1000);
		});
	}

	//appendNotification();
</script>
