$(function() {
	jQuery.event.special.touchstart = {
		setup: function( _, ns, handle ){
			if ( ns.includes("noPreventDefault") ) {
			  this.addEventListener("touchstart", handle, { passive: true });
			} else {
				return false;
			}
		}
	};

	var status_menu = 0; // define scroll
	$(document).scroll(function(event) {
		var current_location = $(document).scrollTop();
		if(current_location > 200 && status_menu == 0) {

			$('#header>nav').addClass('fixed-top');
			status_menu = 1;

		} else if(current_location < 50 && status_menu == 1) {

   			$('#header>nav').removeClass('fixed-top');
   			status_menu = 0;

		}
	});

	$('.backtop_dad a').click(function(event) {
		event.preventDefault();

		$('html,body').animate({scrollTop:0},500);

	});

	$('body').on('click', '.product-quantity .minus', function(event) {
		event.preventDefault();

		var current_number = parseInt($('#product_quantity').val());
		if(current_number < 2) {

			$('#product_quantity').val(1);

		} else {

			$('#product_quantity').val(current_number - 1);

		}
	});
    $('body').on('click', '.product-quantity .plus', function(event) {
		event.preventDefault();

		var current_number = parseInt($('#product_quantity').val());
		var max_product = parseInt($('.product-count>.count').html());

		if(current_number < 1) {

			$('#product_quantity').val(1);

		} else if(current_number < max_product){

			$('#product_quantity').val(current_number + 1);

		}
	});

	$('body').on('click', '.buynow_detail', function(event) {
		event.preventDefault();
		//xu ly hieu ung them gio hang
		var url = $(this).data("url");

		//xu ly thêm
		var code = $(this).parent().prevAll('.product-code').children('.code').html();
		var color = $('.product-options #colorSelect').val();
		var size = $('.product-options #sizeSelect').val();
		var number = parseInt($('#product_quantity').val());
		if(code == '' || color == '' || size == '' || number == '' ) {
			alert("Chọn đầy đủ size và màu sắc");
			return false;
		}

		$.ajax({
			url: url,
			type: 'POST',
			dataType: 'JSON',
			data: {'code': code,'color': color,'size' : size,'number' : number },
		})
		.done(function(res) {
			if(res.error) {
				alert(res.error);
			} else if(res.success) {
				window.location.href=window.location.origin+"/giohang.html";
			}
		})
		.fail(function() {
			alert("Lỗi server. Vui lòng thử lại sau");
		})	

	});
	

});