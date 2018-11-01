$(function() {
	"use strict";
	var level = $('#current_level').val();
	var security = $('#security_code').val();


	$('body').on('click','.users .addUser', function(event) {
		event.preventDefault();
		if($(this).hasClass('disabled')) {
			toast("","Yêu cầu đang được xử lý. Vui lòng đợi",'error');
			return false;
		}
		var username = $('.users .username').val();
		var password = $('.users .password').val();
		var repassword = $('.users .repassword').val();
		var email = $('.users .email').val();
		var url = $(this).data('url');
		if(username == '') {

			$('.result').html("<span style='color:red'>Tên tài khoản không được để trống</span>");

		} else if(password == '') {

			$('.result').html("<span style='color:red'>Mật khẩu không được để trống</span>");

		} else if(repassword == '') {

			$('.result').html("<span style='color:red'>Mật khẩu nhập lại không được để trống</span>");

		} else if(password != repassword) {

			$('.result').html("<span style='color:red'>Mật khẩu và mật khẩu nhập lại không khớp</span>");

		} else {
			var btn = $(this);
			$(btn).addClass('disabled');
			$.ajax({
				url: url,
				type: 'POST',
				dataType: 'JSON',
				data: {'adduser':true,'username': username,'password':password,'email':email,'security':security}
			})
			.done(function(res) {
				var data = res[0];
				if(data.error) {
					$('.result').html("<span style='color:red'>" + data.error + "</span>");
				} else if(data.success) {
					var html = "<span style='color:green'>" + data.success + "</span>";
					$('.result').html(html);

					//reset
					$('.username').val('');
					$('.password').val('');
					$('.repassword').val('');
					$('.email').val('');
					
				} else {
					$('.result').html("<span style='color:red'>Có lỗi vui lòng thử lại</span>");
				}
			})
			.fail(function() {
				$('.result').html("<span style='color:red'>Có lỗi vui lòng thử lại</span>");
			})
			.always(function(){
				$(btn).removeClass('disabled');
			})

		}
	});

	$('body').on('click', '.users .btn-edit' ,function(event) {
		event.preventDefault();
		$(this).addClass('hidden-xs-up');
		$(this).next().removeClass('hidden-xs-up');
		$(this).parents().prevAll('.username').children('input').removeAttr('disabled');
		$(this).parents().prevAll('.email').children('input').removeAttr('disabled');
		$(this).parents().prevAll('.role').children('select').removeAttr('disabled');
		
	});

	$('body').on('click','.users .btn-remove', function(event) {
		event.preventDefault();
		if($(this).hasClass('disabled')) {
			toast("","Yêu cầu đang được xử lý. Vui lòng đợi",'error');
			return false;
		}
		
		var t = confirm("Xác nhận lại lệnh xóa..");
		if(t == false) {
			return false;
		} else {

			if(level == 'mod' || level == 'member') {

				toast('Cảnh báo','Yêu cầu không được thực hiện. Vui lòng liên hệ ADMIN','error');
				return false;

			} else if(level == 'admin') {

				var id = parseInt($(this).parents().prevAll('th.id').html());
				var username = $(this).parents().prevAll('td.username').children('input').val();
				var url = $(this).data("url");

				//show progress
				var current_user = $(this).parents('tr.oneuser');
				var data_button = $(this).parents('td').html();
				var button_remove = $(this).parents('td');
				$(this).parents('td').html('<span style="color:red">Đang xử lý.. </span>');
				
				var btn = $(this);
				$(btn).addClass('disabled');

				//request server
				$.ajax({
					url: url,
					type: 'POST',
					dataType: 'JSON',
					data: {username: username, security: security},
				})
				.done(function(res) {
					res = res[0];
					if(res.error) {
						toast('Thất bại',res.error,'error');

					} else if(res.success) {
						toast('Thành công',res.error,'success');
						$(current_user).remove();
					} else {
						toast('Thất bại','Lỗi server!','error');
					}

				})
				.fail(function() {
					toast('Thất bại','Lỗi server!','error');
				})
				.always(function() {
					$(button_remove).html(data_button);
					$(btn).removeClass('disabled');
				});
				

			} else {
				return false;
			}


		}
	});

	// event click button save 
	$('body').on('click','.users .btn-save', function(event) {
		event.preventDefault();
		if($(this).hasClass('disabled')) {
			toast("","Yêu cầu đang được xử lý. Vui lòng đợi",'error');
			return false;
		}

		if(level == 'mod' || level == 'member') {

			toast('Cảnh báo','Yêu cầu không được thực hiện. Vui lòng liên hệ ADMIN','error');
			return false;

		} else if(level == 'admin') {

			$(this).addClass('hidden-xs-up');
			$(this).prev().removeClass('hidden-xs-up');

			//get value 
			var id = parseInt($(this).parents().prevAll('th.id').html());
			var username = $(this).parents().prevAll('td.username').children('input').val();
			var email = $(this).parents().prevAll('td.email').children('input').val();
			var role = $(this).parents().prevAll('td.role').children('select').val();
			if(id == '' || username == '' || email == "" || role == "") {
				toast('',"Thông tin không được để trống",'error');
				return false;
			}
			var url = $(this).data("url");

			//show progress
			var current_user = $(this).parents('tr.oneuser');
			var data_button = $(this).parents('td').html();
			var button = $(this).parents('td');
			$(this).parents('td').html('<span style="color:red">Đang xử lý.. </span>');

			var btn = $(this);
			$(btn).addClass('disabled');
			//request server
			$.ajax({
				url: url,
				type: 'POST',
				dataType: 'JSON',
				data: {username: username,role:role, security: security,email: email, }
			})
			.done(function(res) {
				res = res[0];
				if(res.error) {
					toast('Thất bại',res.error,'error');

				} else if(res.success) {
					toast('Thành công',res.success,'success');
				} else {
					toast('Thất bại','Lỗi server!','error');
				}

			})
			.fail(function() {
				toast('Thất bại','Lỗi server!','error');
			})
			.always(function() {
				$(button).html(data_button);
				$(button).prevAll('.username').children('input').attr('disabled','disabled');
				$(button).prevAll('.email').children('input').attr('disabled','disabled');
				$(button).prevAll('.role').children('select').attr('disabled','disabled');
				$(btn).removeClass('disabled');
			});

		} else {
			return false;
		}

	});
	// END event click button save
	$('body').on('click','.btn-logout', function(event) {
		event.preventDefault();
		if($(this).hasClass('disabled')) {
			toast("","Yêu cầu đang được xử lý. Vui lòng đợi",'error');
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
				toast('Thất bại',res.error,'error');
			} else {
				location.reload();
			}
		})
		.fail(function() {
			toast('Thất bại','Có lỗi vui lòng thử lại sau','error');
		})
		.always(function(){
			$(btn).removeClass('disabled');
		})
		
	});

	//event for choose image banner
	$('body').on('change', '.banner #chooseimagebanner', function(event) {
		event.preventDefault();

		var file = $(this).prop('files')[0];
		if(file == null ) {
			$(this).parents().nextAll('.result').html('');
			$(this).parents().nextAll('.review-image').children('img.img-thumb').removeAttr('src');
			return;

		} else if(file.type != "image/jpg" && file.type != "image/jpeg" && file.type != "image/png" && file.type != "image/gif") {

			$(this).val('');
			$(this).parents().nextAll('.result').html("<span style='color:red'>Chỉ chấp nhận file ảnh</span>");
			return;

		} else {
			$(this).parents().nextAll('.result').html('');
			var url = URL.createObjectURL(file);
			$(this).parents().nextAll('.review-image').children('img.img-thumb').attr('src',url);
		}
		
	});

	//event click add banner
	$('body').on('click','.banner .btn-addbanner',function(event) {
		if(level != "admin" && level != "mod") {

			toast('Cảnh báo','Yêu cầu không được thực hiện. Vui lòng liên hệ ADMIN','error');
			return false;
		}

		var file_data = $('#chooseimagebanner').prop('files')[0];
		var title = $('.banner .title').val();
		var url = $(this).data('url');
		var url_ = $(this).data('url_');

		if(file_data == null || title == '') {
			toast('Có lỗi','Ảnh và mô tả không được để trống','error');
			return;
		} else  {
			var form_data = new FormData();
            //thêm files vào trong form data
            form_data.append('image', file_data);
			form_data.append('title',title);
			form_data.append('security',security);
			form_data.append('addbanner','');


			var btn = $(this);
			$(btn).addClass('disabled');
			$.ajax({
				url: url,
				dataType:'JSON',
				type: 'POST',
				cache: false,
                contentType: false,
                processData: false,
                data: form_data                       
			})
			.done(function(res) {
				if(res.error) {
					toast('Thất bại',res.error,'error');
				} else if(res.success) {
					var data = res.success.data;
					var data_res = '<tr>'+
								'<th scope="row" class="stt">'+ data.stt +'</th>'+
								'<td class="title">'+ data.title +'</th>'+
								'<td style="width: 15%" class="image"><img class="img-fluid" src="'+ data.url +'" alt="'+ data.title +'"></td>'+
								'<td><b class="btn btn-danger btn-removebanner" data-url="'+ url_ +'"><i class="fa fa-remove"></i></b></td>'+
							'</tr>';
					$('.banner .listbanner tbody').append(data_res);
					toast('Thành công','Thêm dữ liệu thành công','success');
				} else {
					toast('Thất bại','Lỗi server','error');
				}
			})
			.fail(function() {
				toast('Thất bại','Lỗi server, kiểm tra lại đường truyền','error');
			})
			.always(function(){
				$('#chooseimagebanner').val('');
				$('.banner .review-image img').removeAttr('src');
				$('.banner .title').val('');
				$(btn).removeClass('disabled');
			})
		}

	});
	//end click add banner

	//event remove banner
	$('body').on('click', '.banner .btn-removebanner', function(event) {
		event.preventDefault();
		if($(this).hasClass('disabled')) {
			toast("","Yêu cầu đang được xử lý. Vui lòng đợi",'error');
			return false;
		}

		var t = confirm("Xác nhận lại lệnh xóa..");
		if(t == false) {
			return false;
		}
		if(level != "admin" && level != "mod") {

			toast('Cảnh báo','Yêu cầu không được thực hiện. Vui lòng liên hệ ADMIN','error');
			return false;
		}


		var url = $(this).data('url');
		var stt = parseInt($(this).parents().prevAll('th').html());
		var btn = $(this);
		$(btn).addClass('disabled');
		$.ajax({
			url: url+'/'+stt,
			type: 'POST',
			dataType: 'JSON',
			data: {stt: stt,security:security}
		})
		.done(function(res) {
			if(res.error) {
				toast('Thất bại',res.error,'error');
			} else if(res.success) {
				var data = res.success.data;
				$('.banner .listbanner tbody').html('');
				for(var key in data ) {
				
					var data_res = '<tr>'+
					'<th scope="row" class="stt">'+ data[key].stt +'</th>'+
					'<td class="title">'+ data[key].title +'</th>'+
					'<td style="width: 15%" class="image"><img class="img-fluid" src="'+ data[key].url +'" alt="'+ data[key].title +'"></td>'+
					'<td><b class="btn btn-danger btn-removebanner" data-url="'+url+'"><i class="fa fa-remove"></i></b></td>'+
					'</tr>';
					$('.banner .listbanner tbody').append(data_res);
				}
				toast('Thành công','Xóa thành công','success');
			} else {
				toast('Thất bại','Lỗi server','error');
			}
		})
		.fail(function() {
			toast('Thất bại','Lỗi server, kiểm tra lại đường truyền','error');
		})
		.always(function(){
			$(btn).removeClass('disabled');
		})
	});
	//end remove banner

	//add category
	$('body').on('click','.category .btn-add',function(event) {
		if($(this).hasClass('disabled')) {
			toast("","Yêu cầu đang được xử lý. Vui lòng đợi",'error');
			return false;
		}
		if(level != "admin" && level != "mod") {

			toast('Cảnh báo','Yêu cầu không được thực hiện. Vui lòng liên hệ ADMIN','error');
			return false;
		}
		var name = $('.category .add-name').val();
		if(name == '') {
			toast('Lỗi','Tên danh mục không được để trống','error');
			$('.category .add-name').focus();
			return false;
		}
		var url = $(this).data('url');
		var url_save = $('.category .btn-save').data('url');
		var url_delete = $('.category .btn-delete').data('url');

		var btn = $(this);
		$(btn).addClass('disabled');
		$.ajax({
			url: url,
			type: 'POST',
			dataType: 'JSON',
			data: {'name': name,'security':security}
		})
		.done(function(res) {
			if(res.error) {
				toast('Thất bại',res.error,'error');
			} else if(res.success) {
				var data_insert = '<div class="card card-inverse card-primary mb-3">'+
						'<div class="card-block">'+
							'<div class="text-sm-right">'+
								'<a class="btn btn-info btn-edit"><i class="fa fa-pencil"></i></a>'+
								'<a data-url="'+ url_save  +'" class="btn btn-success btn-save hidden-xs-up"><i class="fa fa-floppy-o" ></i></a>'+
								'<a data-url="'+ url_delete +'" class="btn btn-danger btn-delete"><i class="fa fa-remove"></i></a>'+
							'</div>'+
							'<blockquote class="card-blockquote  ">'+
								'<fieldset class="form-group hidden-xs-up ">'+
									'<input type="text" class="form-control name-edit" value="Laptop">'+
									'<input type="hidden" class="form-control id" value="' + res.success.id  + '">'+
								'</fieldset>'+
								'<div class="name-category">'+res.success.name+'</div>'+
							'</blockquote>'+
						'</div>'+
					'</div>';
				$('.category .list-category').append(data_insert);
				toast('Thành công','Thêm danh mục thành công','success');
			}  else {
				toast('Thất bại','Lỗi server','error');
			}
		})
		.fail(function() {
			toast('Thất bại','Lỗi server, kiểm tra lại đường truyền','error');
		})
		.always(function(){
			$(btn).removeClass('disabled');
		})
		
	});
	//end add category

	//delete category
	$('body').on('click', '.category .btn-delete', function(event) {
		event.preventDefault();
		if($(this).hasClass('disabled')) {
			toast("","Yêu cầu đang được xử lý. Vui lòng đợi",'error');
			return false;
		}

		var t = confirm("Xác nhận lại lệnh xóa..");
		if(t == false) {
			return false;
		}

		
		if(level != "admin" && level != "mod") {

			toast('Cảnh báo','Yêu cầu không được thực hiện. Vui lòng liên hệ ADMIN','error');
			return false;
		}

		var card = $(this).parents('.card');
		
		var url = $(this).data('url');
		var id = $(this).nextAll('.id').val();

		var btn = $(this);
		$(btn).addClass('disabled');
		$.ajax({
			url: url+'/'+id,
			type: 'POST',
			dataType: 'JSON',
			data: {security: security,id:id}
		})
		.done(function(res) {
			if(res.error) {
				toast('Thất bại',res.error,'error');
			} else if(res.success) {
				toast('Thành công',res.success,'success');
				$(card).remove();

			} else{
				toast('Thất bại','Lỗi server','error');
			}
		})
		.fail(function() {
			toast('Thất bại','Lỗi server, kiểm tra lại đường truyền','error');
		})
		.always(function(){
			$(btn).removeClass('disabled');
		})

	});
	//end delete category

	//event when click button edit category
	$('body').on('click', '.category .btn-edit', function(event) {
		event.preventDefault();
		if($(this).hasClass('disabled')) {
			toast("","Yêu cầu đang được xử lý. Vui lòng đợi",'error');
			return false;
		}

		if(level != "admin" && level != "mod") {

			toast('Cảnh báo','Yêu cầu không được thực hiện. Vui lòng liên hệ ADMIN','error');
			return false;
		}
	    
	    $(this).addClass('hidden-xs-up');
	    $(this).next('.btn-save').removeClass('hidden-xs-up');
	    $(this).parents().next('.card-blockquote').find('fieldset').removeClass('hidden-xs-up');
	    $(this).parents().next('.card-blockquote').find('.name-category').addClass('hidden-xs-up');
	    

	});
	//end click button edit category

	//click button save category
	$('body').on('click', '.category .btn-save', function(event) {
		event.preventDefault();
		if($(this).hasClass('disabled')) {
			toast("","Yêu cầu đang được xử lý. Vui lòng đợi",'error');
			return false;
		}
		if(level != "admin" && level != "mod") {

			toast('Cảnh báo','Yêu cầu không được thực hiện. Vui lòng liên hệ ADMIN','error');
			return false;
		}

	   

	    var id = $(this).nextAll('.id').val();
	    var name = $(this).parents().nextAll('.card-blockquote').find('.name-edit').val();
	    if(name == '') {
	    	toast("Lỗi","Tên danh mục không được để trống","error");
	    	return false;
	    }
	   	var url = $(this).data('url');
	   	var btn = $(this);
		$(btn).addClass('disabled');
	   	$.ajax({
	   		url: url+'/'+id,
	   		type: 'POST',
	   		dataType: 'JSON',
	   		data: {security:security, id: id,name:name}
	   	})
	   	.done(function(res) {
	   		if(res.error){
	   			toast('Thất bại',res.error,'error');
	   			$(btn).parents().next('.card-blockquote').find('.name-edit').val($(btn).parents().next('.card-blockquote').find('.name-category').html());
	   		} else if(res.success) {
	   			toast('Thành công',res.success,'success');
			    $(btn).parents().next('.card-blockquote').find('.name-category').html(name);
	   		} else {
	   			toast('Thất bại','Lỗi server','error');
	   			$(btn).parents().next('.card-blockquote').find('.name-edit').val($(btn).parents().next('.card-blockquote').find('.name-category').html());
	   		}
	   	})
	   	.fail(function() {
	   		toast('Thất bại','Lỗi server, kiểm tra lại đường truyền','error');
	   	})
	   	.always(function(){
	   		$(btn).addClass('hidden-xs-up');
	   		$(btn).prev('.btn-edit').removeClass('hidden-xs-up');
	   		$(btn).parents().next('.card-blockquote').find('fieldset').addClass('hidden-xs-up');
	   		$(btn).parents().next('.card-blockquote').find('.name-category').removeClass('hidden-xs-up');
	   		$(btn).removeClass('disabled');
	   	})

	});
	//end click button save category

	//add new product
	$('body').on('click','.product #btn-addnewproduct',function(event) {

		if($(this).hasClass('disabled')) {
			toast("","Yêu cầu đang được xử lý. Vui lòng đợi",'error');
			return false;
		}
		
		if(level != "admin" && level != "mod") {

			toast('Cảnh báo','Yêu cầu không được thực hiện. Vui lòng liên hệ ADMIN','error');
			return false;
		}

		var formData = new FormData();
		formData.append('addProduct','');
		formData.append('security',security);
		var arrInfo = $('#frm-info-product').serializeArray();
		for(var i = 0 ; i < arrInfo.length ; i++){
			if(arrInfo[i].value == "" && arrInfo[i].name != 'material' && arrInfo[i].name != 'origin' && arrInfo[i].name.indexOf('seo') < 0){
				toast("Lỗi","Hãy nhập đầy đủ thông tin","error");
				return;
			} else if((arrInfo[i].name == "price" || arrInfo[i].name == "number" ) && isNaN(parseInt(arrInfo[i].value)) ){

				toast("Lỗi",arrInfo[i].name == "price" ? 'Giá tiền không hợp lệ' : 'Số lượng không hợp lệ',"error");
				return;

			} else {
				formData.append(arrInfo[i].name,arrInfo[i].value);
			}
		}

		if(listImage == ''){
			toast("Lỗi","Hãy chọn ảnh hiển thị","error");
			return;
		} else {
			for(var i = 0 ; i < listImage.length ; i++){
				formData.append('images[]',listImage[i]);
			}
			
		}
		var url = $(this).data("url");
		$('.progress').html("<span style='color:green'>Đang xử lý vui lòng chờ ...</span>");
		$(this).addClass('disabled');
		var btn = $(this);
		$.ajax({
			url: url,
			type: 'POST',
			dataType: 'JSON',
			data: formData,
			cache: false,
			contentType: false,
			processData: false
		})
		.done(function(res) {
			
			if(res.error) {
				for(var i = 0 ; i < res.error.length ; i++){
					toast('Lỗi',res.error[i],'error');
				}
			}
			if(res.success) {
				toast('Thành công',res.success,'success');
				$('#frm-info-product')[0].reset();
				listImage = [];
				$('#my-awesome-dropzone').html('<div class="dz-default dz-message"><span>Chọn hoặc kéo thả hình ảnh vào đây!</span></div>');
				$('#my-awesome-dropzone').removeClass('dz-started');

			}
		})
		.fail(function() {
	   		toast('Thất bại','Lỗi server, kiểm tra lại đường truyền','error');
	   	})
		.always(function(){
			$('.progress').html("");
			$(btn).removeClass('disabled');
		})
	}); //end add new product

	//delete product
	$('body').on('click','.product .btn-delete',function(event) {
		if($(this).hasClass('disabled')) {
			toast("","Yêu cầu đang được xử lý. Vui lòng đợi",'error');
			return false;
		}

		if(level != "admin") {

			toast('Cảnh báo','Yêu cầu không được thực hiện. Vui lòng liên hệ ADMIN','error');
			return false;
		}
		var t = confirm("Xác nhận lại lệnh xóa..");
		if(t == false) {
			return false;
		}
		var url = $(this).data("url");
		var btn = $(this);
		$(btn).addClass('disabled');
		$.ajax({
			url: url,
			type: 'POST',
			dataType: 'JSON',
			data: {security: security}
		})
		.done(function(res) {
			if(res.success){
				toast('Thành công',res.success,'success');
				$(btn).parent().parent().remove();
			} else if(res.error) {
				toast('Thất bại',res.error,'error');
			} else {
				toast('Thất bại','Lỗi server','error');
			}
		})
		.fail(function() {
	   		toast('Thất bại','Lỗi server, kiểm tra lại đường truyền','error');
	   	})
		.always(function() {
			$(btn).removeClass('disabled');
		});
		
	});
	//end delete product

	//update product
	$('body').on('submit','.product #frm-edit-product',function(event) {
		event.preventDefault();
		if($(this).hasClass('disabled')) {
			toast("","Yêu cầu đang được xử lý. Vui lòng đợi",'error');
			return false;
		}

		if(level != "admin" && level != "mod") {

			toast('Cảnh báo','Yêu cầu không được thực hiện. Vui lòng liên hệ ADMIN','error');
			return false;
		}
		var t = confirm("Lưu thay đổi..");
		if(t == false) {
			return false;
		}

		//get name of input have class changed
		var listchange = $('#frm-edit-product .changed');
		var listnamechange = [];
		for(var i = 0 ; i < listchange.length ; i++) {
			listnamechange[i] = $(listchange[i]).attr('name');

		}
		var formData = new FormData();
		formData.append('security',security);
		var arrInfo = $('#frm-edit-product').serializeArray();
		for(var i = 0 ; i < arrInfo.length ; i++){

			if(listnamechange.indexOf(arrInfo[i].name) == -1){
				continue;
			}
			if(arrInfo[i].value == ""){
				toast("Lỗi","Hãy nhập đầy đủ thông tin","error");
				return;
			} 
			if((arrInfo[i].name == "price" || arrInfo[i].name == "number" ) && isNaN(parseInt(arrInfo[i].value)) ){
				toast("Lỗi",arrInfo[i].name == "price" ? 'Giá tiền không hợp lệ' : 'Số lượng không hợp lệ',"error");
				return;

			} else {
				formData.append(arrInfo[i].name,arrInfo[i].value);
			}
		}

		//get current images
		var list_img = $('.current-image');
		var currentimage = [];
		for(var i = 0 ; i < list_img.length ; i++ ){
			currentimage[i] = $(list_img[i]).val();
		}
		if(currentimage != '') {
			currentimage = JSON.stringify(currentimage);
			formData.append('currentimage', currentimage);
		}

		if(listImage != '') {

			for(var i = 0 ; i < listImage.length ; i++){
				formData.append('images[]',listImage[i]);
			}

		}
		$('.progress').html("<span style='color:green'>Đang xử lý vui lòng chờ ...</span>");
		var url = $(this).data('url');
		var btn = $(this);
		$(btn).addClass('disabled');
		$.ajax({
			url: url,
			type: 'POST',
			dataType: 'JSON',
			data: formData,
			cache: false,
			contentType: false,
			processData: false
		})
		.done(function(res) {
			if(res.error) {
				for(var i = 0 ; i < res.error.length ; i++){
					toast('Lỗi',res.error[i],'error');
				}
			}
			if(res.success) {
				toast('Thành công',res.success,'success');
			}
		})
		.fail(function() {
	   		toast('Thất bại','Lỗi server, kiểm tra lại đường truyền','error');
	   	})
		.always(function() {
			$('.progress').html('');
			$(btn).removeClass('disabled');
		});
		


	});
	//end update product

	//event for the update product
	$('body').on('change','#frm-edit-product input,#frm-edit-product select',function(event) {
		$(this).addClass('changed');
	});
	$('body').on('click','#my-awesome-dropzone .btn-delete-image',function(event) {
		event.preventDefault();
		$(this).parent().remove();
	});
	//end event for the update product

	//save the new,seller,
	$('body').on('click','.product .btn-save-options',function(event) {
		event.preventDefault();

		if($(this).hasClass('disabled')) {
			toast("","Yêu cầu đang được xử lý. Vui lòng đợi",'error');
			return false;
		}

		var btn = $(this);
		var newproduct = $('input.option-product-check');
		var listnew= {'checked':[],'notcheck':[] };
		var listseller= {'checked':[],'notcheck':[] };
		var listsale= {'checked':[],'notcheck':[] };

		for(var i = 0 ; i < newproduct.length ; i++) {

			if( $(newproduct[i]).attr("name") == "cbo-newproduct"  ) {

				if( $(newproduct[i]).is(':checked') )
					listnew.checked[listnew.checked.length] = parseInt($(newproduct[i]).val());
				else
					listnew.notcheck[listnew.notcheck.length] = parseInt($(newproduct[i]).val());
			}

			if( $(newproduct[i]).attr("name") == "cbo-sellerproduct") {
				if( $(newproduct[i]).is(':checked') )
					listseller.checked[listseller.checked.length] = parseInt($(newproduct[i]).val());
				else 
					listseller.notcheck[listseller.notcheck.length] = parseInt($(newproduct[i]).val());
			}

			if( $(newproduct[i]).attr("name") == "cbo-saleproduct"  ) {
				if( $(newproduct[i]).is(':checked') )
					listsale.checked[listsale.checked.length] = parseInt($(newproduct[i]).val());
				else
					listsale.notcheck[listsale.notcheck.length] = parseInt($(newproduct[i]).val()); 
			}
			
		}
		var url = $(this).data("url");
		$(btn).html("Đang xử lý ...");
		$(btn).addClass('disabled');
		$.ajax({
			url: url,
			type: 'POST',
			dataType: 'JSON',
			data: {'security':security, 'listnew': JSON.stringify(listnew),'listseller' :JSON.stringify(listseller), 'listsale' :JSON.stringify(listsale) },
		})
		.done(function(res) {
			if(res.error) {
				toast('Lỗi',res.error,'error');
			}
			if(res.success) {
				toast('Thành công',res.success,'success');
			}
		})
		.fail(function() {
	   		toast('Thất bại','Lỗi server, kiểm tra lại đường truyền','error');
	   	})
		.always(function() {
			$(btn).removeClass('disabled');
			$(btn).html("Lưu lại");
		});
	});

	//end save the new,seller,

	$('body').on('change', '.order-status', function(event) {
		$(this).addClass('selectchanged');
	});
	//update status order
	$('body').on('click', '.update-status-order', function(event) {
		event.preventDefault();

		if($(this).hasClass('disabled')) {
			toast("","Yêu cầu đang được xử lý. Vui lòng đợi",'error');
			return false;
		}
		if(level != "admin" && level != "mod") {

			toast('Cảnh báo','Yêu cầu không được thực hiện. Vui lòng liên hệ ADMIN','error');
			return false;
		}
		if ($(this).parent().prev().children('.order-status').hasClass('selectchanged')) {
			
			var id = $(this).prev('input[name="id-order"]').val();
			var status = $(this).parent().prev().children('.order-status').val();
			var url = $(this).data('url');

			var btn = $(this);
			$(btn).addClass('disabled');
			$.ajax({
				url: url,
				type: 'POST',
				dataType: 'JSON',
				data: {'id':id,'status': status,'security':security},
			})
			.done(function(res) {
				if(res.error) {
					toast('Lỗi',res.error,'error');
				}
				if(res.success) {
					toast('Thành công',res.success,'success');
				}
			})
			.fail(function() {
				toast('Thất bại','Lỗi server, kiểm tra lại đường truyền','error');
			})
			.always(function() {
				$(btn).removeClass('disabled');
			});
			
		} else {
			toast('','Dữ liệu không thay đổi','error');
		}
		
		
		
	});
	//end update status order

	//event click btn-edit in control captcha
	$('body').on('click', '.control-captcha .btn-edit', function(event) {
		event.preventDefault();
		if(level != "admin") {

			toast('Cảnh báo','Yêu cầu không được thực hiện. Vui lòng liên hệ ADMIN','error');
			return false;
		}
		$(this).addClass('hidden-xs-up');
		$(this).next().removeClass('hidden-xs-up');
		$(this).parent().prevAll('td').find('input').removeAttr('disabled');
	});
	//end //event click btn-edit in control captcha

	//event click save captcha
	$('body').on('click', '.control-captcha .btn-save', function(event) {
		event.preventDefault();
		if(level != "admin") {

			toast('Cảnh báo','Yêu cầu không được thực hiện. Vui lòng liên hệ ADMIN','error');
			return false;
		}
		if($(this).hasClass('disabled')) {
			toast("","Yêu cầu đang được xử lý. Vui lòng đợi",'error');
			return false;
		}
		$(this).addClass('hidden-xs-up');
		$(this).prev().removeClass('hidden-xs-up');
		$(this).parent().prevAll('td').find('input').attr('disabled','disabled');
		var url = $(this).data('url');
		var id = $(this).nextAll("input[name='id']").val();
		var email = $(this).parent().prevAll('td').find('input[name="email"]').val();
		var publickey = $(this).parent().prevAll('td').find('input[name="publickey"]').val();
		var privatekey = $(this).parent().prevAll('td').find('input[name="privatekey"]').val();
		if(id == '' || email == '' || publickey == '' || privatekey == '') {
			toast("","Dữ liệu không hợp lệ. Kiểm tra lại",'error');
			return false;
		}

		var btn = $(this);
		$(btn).addClass('disabled');
		$.ajax({
			url: url,
			type: 'POST',
			dataType: '',
			data: {'id':id,'email': email,'publickey':publickey,'privatekey':privatekey,'security':security},
		})
		.done(function(res) {
			if(res.error) {
				toast('Lỗi',res.error,'error');
			}
			if(res.success) {
				toast('Thành công',res.success,'success');
			}
		})
		.fail(function() {
			toast('Thất bại','Lỗi server, kiểm tra lại đường truyền','error');
		})
		.always(function() {
			$(btn).removeClass('disabled');
		});
		
	});
	//end event click save captcha

	

});


function toast(heading,text,icon){$.toast({heading: heading,text: text,showHideTransition: 'fade',icon: icon,position: 'bottom-right',hideAfter : 5000})}
