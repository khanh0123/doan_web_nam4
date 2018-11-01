<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mail extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('mail_model');
		$this->load->model('homepage_model');
		$this->load->library("PHPMailer_Library");
		

	}


	public function sendMail()
	{

		if(!empty($_GET['s'])) {

			$pass = $_GET['s'];
			$where = array('name'=> 'passmail','value' => $pass);
			if($this->homepage_model->get($where)) {
				$where = array('status' => 'wait');
				$data_mail = $this->mail_model->get($where);
				foreach ($data_mail as $value) {

					if($this->phpmailer_library->sendMail("Thông báo từ ".$_SERVER['HTTP_HOST'],$value['title'],$value['email'],$value['name'],'giaystore.tk@gmail.com','ADMIN GIAYSTORE.TK',$value['message'])) {

						$where = array('id' => $value['id']);
						$data = array('status' => 'done');
						if($this->mail_model->update($data,$where)){
							echo "cap nhat thanh cong";
						} else {
							echo "cap nhat that bai";
						}
					} else {
						echo "Gửi mail không thành công";
					}

				}
				return;
			}

			

		} 
    	$this->load->view('notfound_view');
    	
	}

}

/* End of file Mail.php */
/* Location: ./application/controllers/Mail.php */