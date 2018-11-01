<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Captcha extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		//Load Dependencies
		$this->load->model('captcha_model');

	}

	// List all your items
	public function control()
	{
		if($this->session->has_userdata('username') && 
			( $this->session->userdata('role') == 'admin' || $this->session->userdata('role') == 'mod' ) ) {


			$data = $this->captcha_model->get();
			if($this->session->userdata('role') != 'admin') {
				$data[0]['privatekey'] = '**********************';
			}
			$data = array(
				'data'=> $data
			);

			$this->load->view('admin/captcha/controlCaptcha_view', $data);

		} else {
			$this->load->view('notfound_view');
		}
	}


	//Update one item
	public function update()
	{
		if($this->session->has_userdata('username') && $this->session->userdata('role') == 'admin' &&  !empty($_POST['security']) && $_POST['security'] == $this->session->userdata('security') ) {
			if( ! empty($_POST['id']) && ! empty($_POST['email']) && !empty($_POST['publickey']) && !empty($_POST['privatekey']) ) {

				$id= $this->input->post('id');
				$email = $this->input->post('email');
				$publickey = $this->input->post('publickey');
				$privatekey = $this->input->post('privatekey');

				$data = array(
					'email' => $email,
					'publickey' => $publickey,
					'privatekey' => $privatekey
				);
				$where = array('id' => $id);
				if($this->captcha_model->update($data,$where)){
					$success = "Cập nhật thành công";
				} else {
					$error = "Dữ liệu không đổi";
				}

			} else {
				$error = "Dữ liệu không hợp lệ";
			}

			$res = !empty($error) ?  array('error' => $error) : array('success' => $success) ;
			die(json_encode($res));

		} else {
			$this->load->view('notfound_view');
		}
	}

}

/* End of file Captcha.php */
/* Location: ./application/controllers/Captcha.php */
