Dropzone.autoDiscover = false;
var listImage = [];
window.onload = function () {

	var dropzoneOptions = {
		dictDefaultMessage: 'Chọn hoặc kéo thả hình ảnh vào đây!',
		paramName: "images[]",
		maxFilesize: 5, // MB
		addRemoveLinks: true,
		acceptedFiles:"image/*",
		init: function () {
		this.on("addedfile", function (file) {
			var checkexists = false;
			for (var i = 0; i < listImage.length; i++) {
				if(listImage[i].name == file.name) {
					this.removeFile(file);
					checkexists = true;
					break;
				}
			}
			if(!checkexists)
				listImage.push(file);        		
		});
		this.on('removedfile', function(file) {
			var f = -1;
			for(f in listImage) {
				if(listImage[f].name == file.name) {
					break;
				}
			}
			listImage.splice(f,1);
		});

	}
};
var uploader = document.querySelector('#my-awesome-dropzone');
var newDropzone = new Dropzone(uploader, dropzoneOptions);   
};