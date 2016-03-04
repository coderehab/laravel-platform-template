$(function(){

	//////////////////////////////////////////////////////
	// Settings
	//////////////////////////////////////////////////////

	$(".sortable").sortable({
		stop:function(event, ui){
			var items = $(this).find('.item');
			$.each(items, function(i, item){
				$(item).find('input[type=hidden]#order_value').val(i);
			})
		}
	});

	var tRowFixHelper = function(e, ui) {
		ui.children().each(function() {
			$(this).width($(this).width());
		});
		return ui;
	}

	$(".sortable-table").sortable({
		items: "tbody tr",
		cancel: "thead tr",
		connectWith: ".sortable-table",
		helper: tRowFixHelper,
		update: function() {
		}
	});

	$("#menu-list .heading th").click(function(){
		$(this).closest('.list').toggleClass('collapsed');
	})

	$( ".sortable .item, .sortable-table tr, .sortable-table td, .sortable-table th" ).disableSelection();

	//////////////////////////////////////////////////////
	// Popup events
	//////////////////////////////////////////////////////

	$('.popup form').submit(function(e){ e.preventDefault() })

	$(".show-popup").click(function(e){
		var popupID = $(this).attr('data-popup');
		$("#" + popupID).addClass('visible');
	});

	$('.popup .close').click(function(e){
		e.preventDefault();
		$(this).closest('.popup').removeClass('visible');
	})

	$('.popup .bg').click(function(e){
		e.preventDefault();
		$(this).parent().removeClass('visible');
	})

	//////////////////////////////////////////////////////
	// Other
	//////////////////////////////////////////////////////

});

