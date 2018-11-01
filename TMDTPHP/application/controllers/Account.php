<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account extends CI_Controller {

	public function __construct()
	{
		
		parent::__construct();
		//Load Dependencies
		$this->load->model('account_model');

	}
	
	
	// Add a new item
	public function add()
	{
		if( $this->session->has_userdata('username') && 
				( $this->session->userdata('role') == 'admin' || $this->session->userdata('role') == 'mod' ) ) {

			if(isset($_POST['adduser']) ) {

				$res = array();
				$username = $this->input->post('username');
				$email = $this->input->post('email');
				$password = hash("sha256",$this->input->post('password'));
				$security = $this->input->post('security');

				//validate value
				if(empty($username)) {
					$error  = 'Tên tài khoản không được để trống';
					
				} else if(empty($password)) {
					$error  = 'Mật khẩu không được để trống';
				} else if(empty($security) || $security != $this->session->userdata('security')) {
					$error  = 'Yêu cầu không hợp lệ. Vui lòng thử lại sau';
				} else if(preg_match("/[^A-Za-z0-9\!]/", $username)){
					$error = 'Tên tài khoản không được chứa kí tự đặc biệt';
				} else if( !filter_var($email, FILTER_VALIDATE_EMAIL) ) {

					$error = "Hãy nhập đúng định dạng email";
				}

				if(!empty($error)) {
					$error = array(
						'error' => $error
					);
					array_push($res,$error);
					

				} else {
					$usernameExists = array(
						'username' => $username
					);
					$emailExists = array(
						'email' => $email
					);
					if($this->account_model->get($usernameExists) ){

						$error = array(
							'error' => 'Tên tài khoản đã tồn tại'
						);
						array_push($res,$error);

					} else if( $this->account_model->get($emailExists) ){

						$error = array(
							'error' => 'Email đã tồn tại'
						);
						array_push($res,$error);

					} else {

						$user = array(
							'username' => $username,
							'password' => $password,
							'email' => $email,
							'role' => 'member'
						);
						if($this->account_model->insert($user) > 0){
							$success = array(
								'success' => 'Tạo tài khoản thành công'
							);
							array_push($res,$success);

							
						}

					}

				}
				die(json_encode($res));
				return;


			} else if ( isset($_GET) ) {

				$this->load->view('admin/account/addUser_view');
				return;

			}  
		}

		$this->load->view('notfound_view');
	}

		//Update one item
	public function update( $id = NULL )
	{
		if( $this->session->has_userdata('username') && $this->session->has_userdata('role') &&  $this->session->userdata('role') == 'admin' ){

			$res = array();

			$id = (int)$id;
			$username = $this->input->post('username');
			$email = $this->input->post('email');
			$role = $this->input->post('role');
			$security = $this->input->post('security');

			if( $id == NULL || empty($username) || empty($security) || empty($role) || empty($email) ) {

				$error = array('error' => 'Dữ liệu bị thiếu');
				array_push($res,$error);
			} else {

				
				if( $security != $this->session->userdata('security') ) {

					$error = array('error' => 'Yêu cầu không hợp lệ!');
					array_push($res,$error);

				} else {

					//get user by id
					$where = array(
						'id' => $id
					);
					$user_curr = $this->account_model->get($where);
					if( !$user_curr ) {

						$error = array('error' => 'Tài khoản không tồn tại');
						array_push($res,$error);
					} else {

						foreach ($user_curr as $value) {
							$username_curr = $value['username'];
							$email_curr = $value['email'];
							break;
						}

						//check exists username if username is changed
						if($username == $username_curr) {

							$data = array(
								'role' => $role
							);

						} else {
							$where = array(
								'username' => $username
							);
							if($this->account_model->get($where)) {
								$error = array(
									'error' => 'Tên tài khoản đã tồn tại'
								);
								array_push($res,$error);
								

							} else {

								$data = array(
									'username' => $username,
									'role' => $role
								);
							}
						}
						//check exists email if username is changed
						if($email != $email_curr) {
							$where = array(
								'email' => $email
							);
							if($this->account_model->get($where)) {
								$error = array(
									'error' => 'Email đã tồn tại'
								);
								array_push($res,$error);
								

							} else {

								$data['email'] = $email;
							}
						}
						
						if(empty($error)) {

							$where = array(
								'id' => $id
							);

							$this->account_model->update($data,$where);
							$success = array('success' => 'Cập nhật tài khoản thành công');
							array_push($res,$success);

						}
					}
				}
			}

			//return response to client (json)
			die(json_encode($res));
			return;
		} else {

			$this->load->view('notfound_view');
		}
	}

		//Delete one item
	public function delete( $id = NULL )
	{
		if( $this->session->has_userdata('username') && $this->session->has_userdata('role') &&  $this->session->userdata('role') == 'admin' ){

			$res = array();

			$id = (int)$id;
			$username = $this->input->post('username');
			$security = $this->input->post('security');

			if( $id == NULL || empty($username) || empty($security) ) {

				$error = array('error' => 'Dữ liệu bị thiếu');
				array_push($res,$error);
			} else {

				$where = array(
					'id' => $id,
					'username' => $username
				);
				if( $security != $this->session->userdata('security') ) {

					$error = array('error' => 'Yêu cầu không hợp lệ!');
					array_push($res,$error);

				} else if( $this->session->userdata('username') == $username ){

					$error = array('error' => 'Không thể xóa tài khoản này');
					array_push($res,$error);

				} else if( !$this->account_model->get($where) ) {
				 

					$error = array('error' => 'Tài khoản không tồn tại');
					array_push($res,$error);

				} else if( $this->account_model->delete($where) > 0 ) {

					$success = array('success' => 'Xóa tài khoản thành công');
					array_push($res,$success);

				} else {

					$error = array('error' => 'Xóa tài khoản không thành công');
					array_push($res,$error);
				}
			}
			die(json_encode($res));
			return;
			

		} else {

			$this->load->view('notfound_view');
		}
	}
	public function logout()
	{
		if(isset($_GET['logout']) && $this->session->has_userdata('username')) {

			session_destroy();

			Header('Location: '.$_SERVER['PHP_SELF']);


		} else {

			$this->load->view('notfound_view');
		}

	}
	public function control()
	{
		if( $this->session->has_userdata('username') && $this->session->has_userdata('role') &&  $this->session->userdata('role') == 'admin' ){
			$data = $this->account_model->get();
			$data = array(
				'listUser' => $data
			);
			$this->load->view('admin/account/controlUser_view', $data);
		} else {
			$this->load->view('notfound_view');
		}
	}
	public function apilogin()
	{
		$res = array();
		if( isset($_POST['login']) ) {

			if( !empty($_POST['username']) && !empty($_POST['password']) ) {

				$username = $this->input->post('username');
				$password = hash('sha256', $this->input->post('password'));

				$auth = array(
					'username' => $username,
					'password' => $password
				);

				$result = $this->account_model->get($auth);

				if(!$result) {

					$error = array(
						'error' => 'Tên tài khoản hoặc mật khẩu không đúng'
					);

					array_push($res,$error);
					

				} else {

					foreach ($result as $value) {
						$array = array(
							'id' => $value['id'],
							'username' => $value['username'],
							'email' => $value['email'],
							'role' => $value['role'],
							'security' => hash("sha256",random_bytes(30))
						);
						$this->session->set_userdata( $array );

						if( ! empty($value['cart'])) {
							$cart = json_decode($value['cart'],true);							
							
						} else {
							$cart = array();
						}
													
						if( $this->session->has_userdata('cart') ) {

							$cart_session = $this->session->userdata('cart');
							for($i = 0 ; $i < count($cart_session) ; $i++ ) {

								//get info from session cart
								$code = $cart_session[$i]['code'];
								$num = $cart_session[$i]['num'];
								$size = $cart_session[$i]['size'];
								$color = $cart_session[$i]['color'];

								$exist = false;
								//update in database
								for($j = 0; $j < count($cart) ; $j++) {
									if($cart[$j]['code'] == $code) {
										$cart[$i]['num'] += $num;
										$exist = true;
										break;
									}
								}
								if( ! $exist) {
									$item = array('code' => $code, 'num' => $num , 'size' => $size , 'color' => $color);
									array_push($cart, $item);
								}
							}
						}

						$where = array('username' => $username);
						$data = array('cart' => json_encode($cart));
						$this->account_model->update($data,$where);

						$cart = array('cart' => $cart);
						$this->session->unset_userdata('cart');
						$this->session->set_userdata( $cart );
						
						break;
					}
					
					$this->account_model->setActive( $username );

					$success = array(
						'success' => 'Đăng nhập thành công'
					);
					array_push($res,$success);

				}

			} else {

				$error = array(
					'error' => "Tên tài khoản và mật khẩu không được để trống"
				);

				array_push($res,$error);

			}

		} else {

			$error = array(
				'error' => "Phương thức không được hỗ trợ"
			);

			array_push($res,$error);

		}

		die(json_encode($res));


	}
	public function apilogout()
	{
		$res = array();
		if(isset($_POST['logout']) && $this->session->has_userdata('username')) {

			session_destroy();

			$success = array(
				'success' => 'Đăng xuất thành công'
			);
			array_push($res,$success);

		} else {

			$error = array(
				'error' => "Phương thức không được hỗ trợ"
			);

			array_push($res,$error);

		}

		die(json_encode($res));
	}
	public function apisignup()
	{

		if(isset($_POST['adduser']) ) {

			if( ! empty($_POST['username']) && ! empty($_POST['password']) && ! empty($_POST['repassword']) && ! empty($_POST['g-recaptcha-response']) ) {
				$this->load->model('captcha_model');

				$username = $this->input->post('username');
				$password = $this->input->post('password');
				$email = $this->input->post('email');
				$repassword = $this->input->post('repassword');

				$captcha = $this->captcha_model->get();

				//veri captcha google
				if(!empty($captcha)) {
					try{
						$secret = $captcha[0]['privatekey'];
						$response=$this->input->post('g-recaptcha-response');
						$arrContextOptions=array(
							"ssl"=>array(
								"verify_peer"=>false,
								"verify_peer_name"=>false
							)
						);  
						$verify=file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret={$secret}&response={$response}"."&remoteip=".$_SERVER['REMOTE_ADDR'],false, stream_context_create($arrContextOptions));
						$captcha_success=json_decode($verify);

					} catch( Exception $e) {
						$captcha_success = null;
					}
					
					  
				} else {
					$error = "Vui lòng hoàn thành captcha để tiếp tục";
				}
				
				//validate value
				if( ! empty($captcha_success) && $captcha_success->success != true) {

					$error  = 'Captcha không chính xác';

				} else if(empty($username)) {

					$error  = 'Tên tài khoản không được để trống';

				} else if(empty($password)) {

					$error  = 'Mật khẩu không được để trống';

				} else if($password != $repassword) {

					$error  = 'Mật khẩu nhập lại không chính xác';

				} else if(preg_match("/[^A-Za-z0-9\!]/", $username)){

					$error = 'Tên tài khoản không được chứa kí tự đặc biệt';

				} else if( !filter_var($email, FILTER_VALIDATE_EMAIL) ) {

					$error = "Hãy nhập đúng định dạng email";
				}

				if(empty($error)) {
					$usernameExists = array(
						'username' => $username
					);
					$emailExists = array(
						'email' => $email
					);
					if($this->account_model->get($usernameExists) ){

						$error = 'Tên tài khoản đã tồn tại';

					} else if( $this->account_model->get($emailExists) ){

						$error = 'Email đã tồn tại';
						

					} else {

						$user = array(
							'username' => $username,
							'password' => hash("sha256",$password),
							'email' => $email,
							'role' => 'member'
						);
						if($this->account_model->insert($user) > 0){
							$success = 'Tạo tài khoản thành công';


							//send mail
							$this->load->model('mail_model');
							$data_mail = array(
								'email' => $email,
								'name' => $username,
								'title' => "Thông báo tài khoản",
								'message' => "Bạn vừa đăng kí thành công tài khoản tại website ".base_url(),
								'status' => "wait"
							);
							$this->mail_model->insert($data_mail);
							//end mail
						}

					}

				}
				
			} else {
				$error  = 'Dữ liệu nhập bị thiếu hoặc không hợp lệ';
			}
			$res = !empty($error) ? array('error' => $error) : array('success' => $success) ;
			die(json_encode($res));
			return;
		} 

		$this->load->view('notfound_view');
	}

	public function changepass() {

		if($this->session->has_userdata('username') ) {

			if(!empty($_POST['oldpass']) && !empty($_POST['newpass']) && !empty($_POST['renewpass'])) {

				$username = $this->session->userdata('username');
				$oldpass = $this->input->post('oldpass');
				$newpass = $this->input->post('newpass');
				$renewpass = $this->input->post('renewpass');
				$where = array(
					'username' => $username,
					'password' => hash("sha256", $oldpass) 
				);
				$user = $this->account_model->get($where);
				if(! empty($user)) {

					if($newpass != $renewpass) {

						$error = "Mật khẩu nhập lại không đúng";

					} else {

						$data = array('password' => hash("sha256", $newpass) );
						$where = array('username' => $username);
						if($this->account_model->update($data,$where)) {
							$success = "Thay đổi mật khẩu thành công";


							//add to table mail
							$this->load->model('mail_model');
							$data_mail = array(
								'email' => $this->session->userdata('email'),
								'name' => $username,
								'title' => "Thông báo tài khoản",
								'message' => "Bạn vừa đổi mật khẩu tài khoản tại website ".base_url(),
								'status' => "wait"
							);
							$this->mail_model->insert($data_mail);
							//end mail


						} else {
							$error = "Mật khẩu không thay đổi";
						}
					}

				} else {
					$error = "Mật khẩu cũ không chính xác";
				}

			} else {
				$error = "Dữ liệu bị thiếu";
			}
			

			if(isset($_POST['apichangepass'])) {
				$res = !empty($success) ? array('success' => $success) : array('error' => $error);
				die(json_encode($res));
			} else {
				header("Location:".base_url());
			}

		} else {
			$this->load->view('notfound_view');
		}
	}
}

/* End of file Account.php */
/* Location: ./application/controllers/account/Account.php */
