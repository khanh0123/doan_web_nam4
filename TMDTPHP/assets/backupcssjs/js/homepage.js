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
		var curent_location = $(document).scrollTop();
		if(curent_location > 200 && status_menu == 0) {

			$('#header>nav').addClass('fixed-top');
			status_menu = 1;

		} else if(curent_location < 50 && status_menu == 1) {

   			$('#header>nav').removeClass('fixed-top');
   			status_menu = 0;

		}
	});

	$('#header .search .input-search').focus(function(event) {
		event.preventDefault();
		$("#header .search").css('width', '15em');
	});
	$('#header .search .input-search').blur(function(event) {
		event.preventDefault();
		$("#header .search").css('width', '9em');
	});
	

	$('.backtop_dad a').click(function(event) {
		event.preventDefault();

		$('html,body').animate({scrollTop:0},500);

	});
	$('.btn-search-submit').click(function(event) {
		$('.form-search').submit();
	});

	$('#formlogin').on('submit', function(event) {
		event.preventDefault();
		if($(this).hasClass('disabled')) {
			alert("Vui lòng chờ...");
			return false;
		}

		var url = $(this).attr('action');
		var user = $(this).children().find('#user1').val();
		var pass = $(this).children().find('#pwd1').val();
		var result = $(this).children().find('.result');
		
		if(user == '' || pass == '') {

			var res = '<span style="color:red;">Tên tài khoản và mật khẩu không được để trống</span>';
			$(result).html(res);

		} else {
			$(result).html("<span style='color:green'>Đang xử lý ... </span>");

			var btn = $(this);
			$(btn).addClass('disabled');
			$.ajax({
				url: url,
				type: 'POST',
				dataType: 'JSON',
				data: {login: 'true' ,username: user,password : pass}
			})
			.done(function(res) {
				res = res[0];
				var data = '';
				if(res.error) 
					data = '<span style="color:red;">'+ res.error +'</span>';
				else {
					data = '<span style="color:green;">'+ res.success +'</span>';
					location.reload();
				}
				$(result).html(data);

			})
			
			.fail(function() {
				alert("Có lỗi vui lòng thử lại sau");
			})
			.always(function(){
				$(btn).removeClass('disabled');
			})

		}
	});
	$('#formsignup').on('submit', function(event) {
		event.preventDefault();
		if($(this).hasClass('disabled')) {
			alert("Vui lòng chờ...");
			return false;
		}

		var url = $(this).attr('action');
		var user = $(this).children().find('#user2');
		var pass = $(this).children().find('#pwd2');
		
		var repass = $(this).children().find('#pwd2_re');
		var email = $(this).children().find('#email2');
		var result = $(this).children().find('.result');

		if( $(user).val() == '' || $(pass).val() == '') {

			var res = '<span style="color:red;">Tên tài khoản và mật khẩu không được để trống</span>';
			$(result).html(res);

		} else if( $(pass).val() != $(repass).val() ) {
			var res = '<span style="color:red;">Mật khẩu nhập lại không khớp</span>';
			$(result).html(res);

		} else {
			var captcha = grecaptcha.getResponse();
			if(captcha == '') {
				var res = '<span style="color:red;">Hãy hoàn thành captcha</span>';
				$(result).html(res);
				return;
			}
			$(result).html("<span style='color:green'>Đang xử lý ... </span>");
			var btn = $(this);
			$(btn).addClass('disabled');
			$.ajax({
				url: url,
				type: 'POST',
				dataType: 'JSON',
				data: {
					'adduser':'',
					'username': $(user).val(),
					'password':$(pass).val(),
					'repassword':$(repass).val(),
					'email':$(email).val(),
					'g-recaptcha-response':captcha
				},
			})
			.done(function(res) {
				
				if(res.error) {
					var html = '<span style="color:red;">'+res.error+'</span>';
					$(result).html(html);
				} else if(res.success) {
					var html = '<span style="color:green;">'+res.success+'</span>';
					$(result).html(html);
					$(user).val("");
					$(pass).val("");
					$(repass).val("");
					$(email).val("");

				}
			})
			.fail(function() {
				$(result).html("<span style='color:red;''>Lỗi máy chủ. Vui lòng thử lại</span>");
			})
			.always(function() {
				grecaptcha.reset();
				$(btn).removeClass('disabled');
			});
			
		}
		
	});

	$('.btn-logout').on('click', function(event) {
		event.preventDefault();

		if($(this).hasClass('disabled')) {
			alert("Vui lòng chờ...");
			return false;
		}

		var url = $(this).data('href');
		var btn = $(this);
		$(btn).addClass('disabled');
		$.ajax({
			url: url,
			type: 'POST',
			dataType: 'JSON',
			data: {logout:true}
		})
		.done(function(res) {
			if(res.error) {
				alert("Có lỗi vui lòng thử lại sau");
			} else {
				window.location.href=window.location.origin;
			}
		})
		.fail(function() {
			alert("Có lỗi vui lòng thử lại sau");
		})
		.always(function(){
			$(btn).removeClass('disabled');
		})
		
	});

	$('.add-cart').click(function(event) {
		event.preventDefault();
		if($(this).hasClass('disabled')) {
			alert("Vui lòng chờ...");
			return false;
		} else {
			
			var code = $(this).prevAll('input[name="code"]').val();
			var color = $(this).prevAll('input[name="color"]').val();
			var size = $(this).prevAll('input[name="size"]').val();
			var url = $(this).data('url');
			if( ! url) {
				url = "./giohang/them";
			}

			var btn = $(this);
			$(btn).addClass('disabled');

			$.ajax({
				url: url,
				type: 'POST',
				dataType: 'JSON',
				data: {'code': code,'size':size,'color':color}
			})
			.done(function(res) {
				if(res.success) {
					alert("Thêm vào giỏ hàng thành công");
					$('#cart span.count').html(res.count);
				} else if(res.error) {
					alert("Có lỗi khi thêm vào giỏ hàng");
				}
			})
			.fail(function() {
				alert("Server bị lỗi. Vui lòng thử lại sau");
			})
			.always(function(){
				$(btn).removeClass('disabled');
			})
		}

		
	});

	$('body').on('submit', '#formchangepass', function(event) {
		event.preventDefault();

		if($(this).hasClass('disabled')) {
			alert("Vui lòng chờ...");
			return false;
		}

		var url = $(this).attr('action');
		var oldpass = $(this).find('input[name="oldpass"]');
		var newpass = $(this).find('input[name="newpass"]');
		var renewpass = $(this).find('input[name="renewpass"]');

		var result = $(this).find('.result');
		if(oldpass == '' || newpass == '' || renewpass == '') {
			alert("Hãy nhập đầy đủ thông tin");
			return false;
		} else if( $(newpass).val() != $(renewpass).val() ) {
			alert("Mật khẩu nhập lại không khớp");
			return false;
		} else {


			var btn = $(this);
			$(btn).addClass('disabled');
			$(result).html("<span style='color:green'>Đang xử lý ... </span>");
			$.ajax({
				url: url,
				type: 'POST',
				dataType: 'JSON',
				data: {
					'apichangepass': '',
					'oldpass':$(oldpass).val(),
					'newpass':$(newpass).val(),
					'renewpass':$(renewpass).val()
				}
			})
			.done(function(res) {
				
				if(res.error) {
					var html = '<span style="color:red;">'+res.error+'</span>';
					$(result).html(html);
				} else if(res.success) {
					var html = '<span style="color:green;">'+res.success+'</span>';
					$(result).html(html);
					$(oldpass).val("");
					$(newpass).val("");
					$(renewpass).val("");

				}
			})
			.fail(function() {
				$(result).html("<span style='color:red;''>Lỗi máy chủ. Vui lòng thử lại</span>");
			})
			.always(function() {
				$(btn).removeClass('disabled');
			});
			
		}
	});

	$('#detail-order a.disabled').click(function(event) {
		event.preventDefault();
		alert("Đơn hàng đã được xác nhận. Nếu muốn hủy đơn hàng vui lòng liên hệ bộ phận CSKH.");
		return false;
	});
});	