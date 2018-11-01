$(function() {

	$('.btn-upload').click(function(event) {
		var formData = new FormData();
		var title = $('#title-2').val();
		var file = $('#file').prop('files')[0];
		var url = $(this).data('url');
		if(title != "" && file != "") {
			formData.append('title',title);
			formData.append('file',file);
			//upload bai moi
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
				if(!res.error){
					var data = '<div class="task">'+
								'<div class="task-title">' + res.data.title + '</div>'+
					 			'<a href="'+ res.data.file + '" class="task-link"><i class="fas fa-cloud-download-alt"></i>Link download</a></div>';
					$('.list-task').append(data);

					//clear form
					$('#title-2').val('');
					$('.upload-file').html($('.upload-file').html());
					$('.close-upload').click();
					alert('Thêm thành công');

				} else {
					alert(res.error);
				}
				
			})
			.fail(function() {
				alert("Lỗi server. Vui lòng thử lại sau");
			})
			

		} else {

			alert('Thông tin nhập không được để trống!');
		}
		

	});
});