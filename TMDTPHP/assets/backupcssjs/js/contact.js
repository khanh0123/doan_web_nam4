$(function() {
	$('body').on('submit','.contact #form-contact form#user_contact', function(event) {
		event.preventDefault();
		var url = $(this).attr('action');
		var name = $('input[name="name"]').val();
		var organization = $('input[name="organization"]').val();
		var email = $('input.email[name="email"]').val();
		var subject = $('input[name="subject"]').val();
		var message = $('textarea[name="message"]').val();

		var captcha = grecaptcha.getResponse(widgetId2);
		if(captcha.length == 0) {
			alert("Bạn phải hoàn thành captcha để tiếp tục");
			return;
		} 
		

		$.ajax({
			url: url,
			type: 'POST',
			dataType: 'JSON',
			data: {
				'apiusercontact':true,
				'name':name,
				'organization':organization,
				'email':email,
				'subject':subject,
				'message':message,
				'g-recaptcha-response':captcha
			}
			
		})
		.done(function(res) {
			if(res.error) {
				alert("Lỗi, vui lòng liên hệ lại sau");
			} else if(res.success){
				alert("Gửi liên hệ thành công. Chúng tôi sẽ gửi email phản hồi cho bạn sau. Xin cám ơn!");
				$('input[name="name"]').val("");
				$('input[name="organization"]').val("");
				$('input.email[name="email"]').val("");
				$('input[name="subject"]').val("");
				$('textarea[name="message"]').val("");
				grecaptcha.reset(widgetId2);
			}
			
		})
		.fail(function() {
			alert("Lỗi server. Vui lòng liên hệ sau ...");
		})

		
	});
});