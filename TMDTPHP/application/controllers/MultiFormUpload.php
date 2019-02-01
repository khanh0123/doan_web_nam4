<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MultiFormUpload {

	//file need to upload
	private $file;

	private $maxsize = 3000000;
	private $folderurl = 'Uploaded/';


	public $result = "";
	public $error = "";
		
	public function setFile($file)
	{
		$this->file = $file;
	}
	public function setMaxSize($value)
	{
		$this->maxsize = (int)$value;
	}
	public function setFolderUrl($value)
	{
		$this->folderurl = $value;
	}
	public function getError()
	{
		return $this->error;
	}
	public function getResult()
	{
		return $this->result;
	}
	public function uploadImage()
	{
		$upload_stt = 1;
		$target_dir = $this->folderurl;
		$target_file = $target_dir . time()."-".$this->file['name'];		

		$type = $this->file['type'];
		$match = ['image/jpg','image/jpeg','image/gif','image/png'];
		if(!in_array($type, $match)){
			$this->error = "Sai định dạng file ".$type;
			return false;
		}
		if (file_exists($target_file)) {
		    $this->error = "File ".$this->file['name']." đã tồn tại";
		    return false;
		}
		if($this->file['size'] > $this->maxsize){
			$this->error = "Dung lượng file ".$this->file['name']." quá lớn";
			return false;
		}
		if ( ! is_dir($this->folderurl)) {
			mkdir($this->folderurl, 0777 , true);

		}
		if(move_uploaded_file($this->file['tmp_name'], $target_file)){
			$this->result = "/".$target_file;
			return true;
		}
		else{
			$this->error = "Upload file không thành công";
			return false;
		}
	}
}

/* End of file MultiFormUpload.php */
/* Location: ./application/controllers/MultiFormUpload.php */