<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Contact extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('contact_model');
		$this->load->model('category_model');
		$this->load->model('captcha_model');
		$this->load->model('account_model');
	}

	public function index()
	{
		$data_category = $this->category_model->get();
		$captcha = $this->captcha_model->get();

				//veri captcha google
		if(!empty($captcha)) {
			$publickey = $captcha[0]['publickey'];
		}
		$data = array(
			'category' => $data_category,
			'publickeycaptcha' => !empty($publickey) ? $publickey : '',
			'countcart'=>$this->totalcart(),

		);
		$this->load->view('contact/userContact_view',$data);
	}

	public function usercontact()
	{
				
		if(!empty($_POST)) {
			if(empty($_POST['name']) || empty($_POST['organization']) || empty($_POST['email']) || empty($_POST['subject']) || empty($_POST['message']) || empty($_POST['g-recaptcha-response'])) {
				$error = "Vui lòng nhập đầy đủ các thông tin và hoàn thành captcha";
			} else {


				$name = $this->input->post('name');
				$organization = $this->input->post('organization');
				$email = $this->input->post('email');

				
				$subject = $this->input->post('subject');
				$message = $this->input->post('message');
				$ip = $this->getClientIP();

				$captcha = $this->captcha_model->get();

				//validate email
				if( !filter_var($email, FILTER_VALIDATE_EMAIL) ) {

					$error = "Hãy nhập đúng định dạng email";
				}

				//veri captcha google
				else if(!empty($captcha) ) {
					$secret = $captcha[0]['privatekey'];
					$response=$this->input->post('g-recaptcha-response');
					$arrContextOptions=array(
						"ssl"=>array(
							"verify_peer"=>false,
							"verify_peer_name"=>false,
						),
					);  
					$verify=file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret={$secret}&response={$response}"."&remoteip=".$_SERVER['REMOTE_ADDR'],false, stream_context_create($arrContextOptions));
					$captcha_success=json_decode($verify);
					  
				} else  {
					$error = "Vui lòng hoàn thành captcha để tiếp tục";
				}
				
				if(empty($error) && $captcha_success->success == true) {
					$contact = array('name' => $name,'organization' => $organization,'email' => $email,'subject' => $subject,'message' => $message,'ip' => $ip);
					if($this->contact_model->insert($contact)) {
						$success = "Thêm liên hệ thành công";

						//add to table mail
						$this->load->model('mail_model');
						$data_mail = array(
							'email' => $email,
							'title' => 'Thông báo liên hệ',
							'message' => "Cám ơn bạn đã liên hệ với chúng tôi. Chúng tôi sẽ cố gắng phản hồi sớm nhất có thể.",
							'name' => $name,
							'status' => "wait"
						);
						$this->mail_model->insert($data_mail);
						
					} else {
						$error = "Thêm liên hệ thông thành công";
					}
				} else {
					$error = "Captcha không chính xác";
				}

				
			}
			//for api
			if(isset($_POST['apiusercontact'])) {
				if(!empty($error)) {
					$res = array('error' => $error);
					die(json_encode($res));	
				} else if(!empty($success)) {
					$res = array('success' => $success);
					die(json_encode($res));	
				}
						
			}
			//for form request
			if(isset($_POST['contact'])) {
				redirect(base_url().'lien-he-voi-chung-toi.html');
				return;
			} 


		} else {
			$this->load->view('notfound_view');
		}



	}
	public function control() {

		if( $this->session->has_userdata('username') && 
				( $this->session->userdata('role') == 'admin' || $this->session->userdata('role') == 'mod' ) ) {

			$data = $this->contact_model->get();
			$data = array('contact' => $data);
			$this->load->view('admin/contact/controlContact_view', $data);


		} else {

			$this->load->view('notfound_view');

		}
	}

	private function getClientIP() {
		return getenv('HTTP_CLIENT_IP') ? :
		getenv('HTTP_X_FORWARDED_FOR') ? :
		getenv('HTTP_X_FORWARDED') ? :
		getenv('HTTP_FORWARDED_FOR') ? :
		getenv('HTTP_FORWARDED') ? :
		getenv('REMOTE_ADDR') ? : 'Unknown IP';
	}
	private function totalCart()
	{
		$total = 0;
		if( $this->session->has_userdata('cart')  ) {
			$cart = $this->session->userdata('cart');	
					
			
			foreach ($cart as $value) {
				$total += (int)$value['num'];
			}
			

		} else if($this->session->has_userdata('username')) {
			$where = array('username' => $this->session->userdata('username'));
			$data = $this->account_model->get($where);
			
			foreach ($data as $value) {
				$cart = json_decode($value['cart'],true);
				break;
			}
			if( !empty($cart) ) {
				for($i = 0 ; $i < count($cart) ; $i++ ) {
					$total += $cart[$i]['num'];
				}
			}
		}
		return $total;
	}

}

/* End of file Contact.php */
/* Location: ./application/controllers/Contact.php */