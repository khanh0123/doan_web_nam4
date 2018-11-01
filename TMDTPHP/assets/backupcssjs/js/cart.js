$(function() {
	$('body').on('click','.go-pay', function(event) {

		//check policy
		if( $('#accept-policy').is(':checked') ){
			
			//check name, phone , address
			if( $('#name').val() == '' ) {

				alert("Vui lòng nhập họ tên");
				$('#name').focus();

			} else if ( $('#phone').val() == '' ) {

				alert("Vui lòng nhập số điện thoại");
				$('#phone').focus();

			} else if ( $('#address').val() == '' ) {

				alert("Vui lòng nhập địa chỉ");
				$('#address').focus();

			}

			//check city, district, ward
			else if( $('#city').val() == 'not checked' ) {

				alert('Vui lòng chọn tỉnh/ thành phố');
				return false;

			} else if( $('#district').val() == 'not checked' ) {

				alert('Vui lòng chọn quận/ huyện')
				return false;

			} else if( $('#ward').val() == 'not checked' ) {

				alert('Vui lòng chọn phường/xã');
				return false;

			}


		} else {

			alert('Bạn phải đồng ý với các điều khoản, điều kiện');
			return false;

		}
	});
	$('body').on('click','.method',function(event) {
		var method_code = $(this).data('method');

		var url = $(this).parent('.method-payment-list').data("url");
		$('.description-method .description-info').html("Đang kiểm tra ...");
		var btn = $(this);
		$(btn).parent().addClass('disabled');
		$.ajax({
			url: url,
			type: "POST",
			dataType: 'JSON',
			data: {'method': method_code},
		})
		.done(function(res) {
			if(res.error){
				$('.description-method .description-info').html("");
				alert(res.error);

			} else if(res.success) {
				$('#method-payment-current').val(method_code);
				$('.description-method .description-info').html(res.success.html);
				$('.method.active').removeClass('active');
				$(btn).addClass('active');
			}
		})
		.fail(function(res) {
			alert("Server bị lỗi. Vui lòng thử lại");
		})
		.always(function() {
			$(btn).parent().removeClass('disabled');
		});
	});


	$('body').on('change', 'input.number', function(event) {
		$('.update-cart').removeClass('disabled');
		$(this).parent().parent('.product').addClass("needupdate");
	});

	//code nút update cart
	$('.update-cart').click(function(event) {
		event.preventDefault();

		//get all product
		var arrayProduct = $('.product');

		//update total cart
		var total_cart = 0;
		for(var i = 0 ; i < arrayProduct.length ; i++) {

			var price = $(arrayProduct[i]).children().nextAll('.product-price').children('span').html();
			price = price.replace(/,/g,""); //replace all symbol
				
			var number = parseInt($(arrayProduct[i]).children().nextAll('.product-quantity').children('input').val());
			var total = (price*number);
			$(arrayProduct[i])
							.children()
								.nextAll('.product-total')
									.children('span')
										.html(total.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,"));

			total_cart = total_cart + total;
		}

		$('.cart-total-detail .temp-total .price').html(total_cart.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,"));
		$('.cart-total-detail .sum-total .price').html(total_cart.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,"));

		var url = $(this).data('url');
		var data = [];
		var arrayProduct = $('.product.needupdate');
		for (var i = 0; i < arrayProduct.length; i++) {
			var code = $(arrayProduct[i]).find('input[name="code"]').val();
			var num = $(arrayProduct[i]).find('input[name="num"].number').val();
			var item = {'code':code,'num':num};
			data.push(item);
		}
		data = JSON.stringify(data);
		$.ajax({
			url: url,
			type: 'POST',
			dataType: 'JSON',
			data: {'dataupdate':data},
		})
		.done(function(res) {
			if(res.error) {
				alert("Xóa không thành công");
			} else if(res.success) {
				$('#cart span.count').html(res.count);
				if(res.count == 0) {
					var html = "<div class='col-md-12 text-center alert alert-info'>Không có sản phẩm nào trong giỏ hàng</div>";
					html+='<span><a href="'+window.location.origin+'" class="btn btn-outline-success back-to-shopping">Tiếp tục mua sắm</a></span>';
					$('.shopping-cart>.row').html(html);

				}

				
				
			}
		})
		.fail(function() {
			alert("Lỗi server. Vui lòng thử lại sau");
		})
		

		//finish update
		$(this).addClass('disabled');
	});


	//delete item cart
	$('.my-cart .remove-item-cart').click(function(event) {
		event.preventDefault();
		var url = $(this).data("url");
		var code = $(this).prevAll("input[name='code']").val();
		var btn_remove = $(this);

		$.ajax({
			url: url,
			type: 'POST',
			dataType: 'JSON',
			data: {'code':code}
			
		})
		.done(function(res) {
			if(res.error) {
				alert("Xóa không thành công");
			} else if(res.success) {
				$('#cart span.count').html(res.count);
				if(res.count == 0) {
					var html = "<div class='col-md-12 text-center alert alert-info'>Không có sản phẩm nào trong giỏ hàng</div>";
					html+='<span><a href="'+window.location.origin+'" class="btn btn-outline-success back-to-shopping">Tiếp tục mua sắm</a></span>';
					$('.shopping-cart>.row').html(html);

				} else {
					$(btn_remove).parent().parent("tr.product").remove();
					$('.cart-total span.price').html(res.total);
				}

				
				
			}
		})
		.fail(function() {
			alert("Lỗi server. Vui lòng thử lại sau");
		})

		
	});
	$('.my-cart .cart-total .btn-next').click(function(event) {
		var checklogin = $('#security').val();
		if( ! checklogin) {
			var t = confirm("Bạn phải đăng nhập để tiếp tục");
			if( t == true ) {
				$('.btn-frm-login').click();
			}
			return false;
		}
	});

	$('body').on('submit', '#formpayment', function(event) {
		var response = grecaptcha.getResponse();
		if(response.length == 0 ) {
			alert("Bạn phải hoàn thành captcha bằng việc tích vào ô Tôi không phải là người máy.");
			return false;
		}
	});

});