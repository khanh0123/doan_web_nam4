<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Cart extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		//Load Dependencies
		$this->load->model('account_model');
		$this->load->model('product_model');
		$this->load->model('category_model');
		$this->load->model('captcha_model');
		$this->load->model('payment_model');
		$this->load->model('status_model');
		$this->load->model('orders_model');

	}
	public function mycart()
	{

		$captcha = $this->captcha_model->get();
		//veri captcha google
		if(!empty($captcha)) {
			$publickey = $captcha[0]['publickey'];
		}

		$data_category = $this->category_model->get();
		if($this->session->has_userdata('cart')  ) {
			$cart_session = $this->session->userdata('cart');
			
			if(empty($cart_session)) {

				$cart_session = array();

			} else {
				$listcode = array();
				
				foreach ($cart_session as $value) {
					array_push($listcode,$value['code']);
				}
				$data_product = $this->product_model->getByListCode($listcode);
				
				for ( $i = 0 ; $i < count($data_product) ; $i++ ) {

					$data_product[$i]['detail'] = json_decode($data_product[$i]['detail'],true);

				}
				
				

			}
		} else {
			$cart_session = array();
		}

		
		$data = array(
			'cart' => $cart_session,
			'category' => $data_category,
			'countcart' => $this->totalCart(),
			'product' => !empty($data_product) ? $data_product : '',
			'publickeycaptcha' => !empty($publickey) ? $publickey : ''
		);
		$this->load->view('cart/mycart_view',$data);
	}
	public function checkout()
	{
		if( ! $this->session->has_userdata('cart') || ! $this->session->has_userdata('username'))  {
			header("Location:".base_url().'giohang.html');
			return;
		} else {


			$data_category = $this->category_model->get();
			$cart_session = $this->session->userdata('cart');
			
			if(empty($cart_session)) {
				$this->session->unset_userdata('cart');
				$cart_session = array();

			} else {
				$listcode = array();
				$total_money = 0;
				
				foreach ($cart_session as $value) {
					array_push($listcode,$value['code']);
					// die();
				}
				$data_product = $this->product_model->getByListCode($listcode);
				$products = array();

				
				for ( $i = 0 ; $i < count($data_product) ; $i++ ) {
					$data_product[$i]['detail'] = json_decode($data_product[$i]['detail'],true);

					for( $j = 0 ; $j < count($cart_session) ; $j++ ) {
						if( $data_product[$i]['code'] == $cart_session[$j]['code']) {
							$num = $cart_session[$j]['num'];
							break;
						}
					}
					$total = (int)$num * (double)$data_product[$i]['detail']['price'];
					$total_money += $total;
					$item = array(
						'code' => $data_product[$i]['code'],
						'name' => $data_product[$i]['detail']['name'],
						'num' => $num,
						'total' => $total
					);
					array_push($products, $item );

					

				}
			}
			$data = array(
				'cart' => $cart_session,
				'category' => $data_category,
				'product' => $products,
				'countcart' => $this->totalCart(),
				'totalmoney'=> $total_money
			);
			$this->load->view('cart/checkout_view',$data);
		}

		
	}

	
	public function payment()
	{
		if(! $this->session->has_userdata('username') || ! $this->session->userdata('cart')) {

			header("Location:".base_url()."giohang.html");
			return;

		}
		if(!empty($_POST['name'] && !empty($_POST['email']) && !empty($_POST['phone']) && !empty($_POST['address'])) && !empty($_POST['policy']) && filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) && is_numeric($_POST['phone'])) {


			$name = $this->input->post('name');
			$email = $this->input->post('email');
			$phone = $this->input->post('phone').'';
			$address = $this->input->post('address');

			$captcha = $this->captcha_model->get();

				//veri captcha google
			if(!empty($captcha)) {
				$publickey = $captcha[0]['publickey'];
			}
			
			$info_payment = array(
				'name' => $name,
				'email' => $email,
				'phone' => $phone,
				'address' => $address				
			);

			$array = array(
				'info_payment' => $info_payment
			);
			if($this->session->has_userdata('info_payment')) {
				$this->session->unset_userdata('info_payment');
			}
			$this->session->set_userdata( $array );


			$data_category = $this->category_model->get();
			$countcart = $this->totalCart();
			$data = array(
				'category' => $data_category,
				'countcart' => $countcart,
				'total_money' => $this->total_money(),
				'shipping' => 20000*(int)$countcart,
				'publickeycaptcha' => !empty($publickey) ? $publickey : ''
			);
			$this->load->view('cart/payment_view',$data);

		} else {

			header("Location:".base_url()."thong-tin-giao-hang.html");
		}
		
	}
	public function chooseMethodPayment()
	{
		if(!empty($_POST['method']) && is_numeric($_POST['method']) && $this->session->has_userdata('username') && $this->session->has_userdata('cart')) {


			$method_id = $_POST['method'];
			$where = array('id' => $method_id);
			$data = $this->payment_model->get($where);
			if(empty($data)) {
				$error = "Phương thức thanh toán không tồn tại";
			} else {
				$success = array();

				$status = $data[0]['status'];
				$name = strtolower($data[0]['name']);
				
				if($status == "disabled") {
					$success['html'] = '<p>Phương thức thanh toán này hiện không khả dụng. Vui lòng chọn phương thức thanh toán khác</p>';
				} else if( $method_id == 1 ) {

					$success['html'] = '<p>Bạn có thể thanh toán bằng tiền mặt khi nhận hàng tại nhà</p>'.
				'<input type="submit" class="finish-pay btn btn-success" value="Đặt hàng ngay">';

				} else if( $method_id == 4 ) {

					$success['html'] = '<p>Bạn có thể thanh toán qua cổng thanh toán nganluong.vn</p>'.
				'<input type="submit" class="finish-pay btn btn-success" value="Đặt hàng ngay">';

				} else {
					$error = "Phương thức thanh toán không được hỗ trợ";
				}
				
			}

			$res = !empty($error) ? array('error' => $error) : array('success' => $success);
			die(json_encode($res));
		} else {
			$this->load->view('notfound_view');
		}
	}

	public function complete()
	{

		

		if($this->session->has_userdata('username') && !empty( $this->session->userdata('cart')) && !empty($_POST['method-payment']) &&  !empty($this->session->userdata('info_payment')) && !empty($_POST['g-recaptcha-response']) ) {

			$captcha = $this->captcha_model->get();

				//veri captcha google
			if(!empty($captcha)) {
				$secret = $captcha[0]['privatekey'];
				$response=$this->input->post('g-recaptcha-response');
				try {

					$arrContextOptions=array(
						"ssl"=>array(
							"verify_peer"=>false,
							"verify_peer_name"=>false,
						),
					);
					$verify=file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret={$secret}&response={$response}",false, stream_context_create($arrContextOptions));
					$captcha_success=json_decode($verify);


				} catch (Exception $e) {

					$captcha_success = null;
				}
				
				
				if(!empty($captcha_success) && $captcha_success->success != true) {
					$error  = 'Captcha không chính xác';
				}
			} else {
				$error = "Captcha bị lỗi. Vui lòng thử lại";
			}
			$id_method_payment = (int)$this->input->post('method-payment');
			$cart_session = $this->session->userdata('cart');


			//check auth method payment
			$where = array('id' =>$id_method_payment);
			$data = $this->payment_model->get($where);

			if( ! empty($data) && empty($error)) {

				//get id account
				$where = array('username' => $this->session->userdata('username'));
				$acc = $this->account_model->get($where);
				$id = (int)$acc[0]['id'];

				if($id_method_payment == 4) //thanh toan online
				{
					$where = array(
						'name' => 'Chờ thanh toán'
					);
				} else {
					$where = array(
						'name' => 'Chờ xác nhận'
					);
				}
				//get id status 				
				$status = $this->status_model->get($where);
				if(!empty($status)) {
					$id_status = $status[0]['id'];
				} else {
					$id_status = -1;
				}
			
				
				//get the total_money
				$total_money = $this->total_money();
				//get the total cart 
				$total_cart = $this->totalCart();
				
				//create new orders
				$info_payment = $this->session->userdata('info_payment');

				$detail = array(
					'info_payment' => $info_payment,
					'cart' => $cart_session,
					'shipping' => $total_cart*20000,
					'total_money' => $total_money,					
				);
				$data_insert = array(
					'account' => $id,
					'detail' => json_encode($detail),
					'payment' => $id_method_payment,
					'status' => $id_status
				);
				$id_order = $this->orders_model->insert($data_insert);
				
				//delete in session
				$this->session->unset_userdata('cart');
				$this->session->unset_userdata('info_payment');

				//update in database
				$user = array('cart' => '');
				$where = array('username' => $this->session->userdata('username'));
				$this->account_model->update($user,$where);

				//load_view complete
				if( ! empty($id_order) ) {
					$success = "Đơn hàng #".$id_order.' đã được đặt thành công';

					//send mail
					$this->load->model('mail_model');
					$username = $this->session->userdata('username');
					$email = $this->session->userdata('email');	
					$data_mail = array(
						'email' => $email,
						'name' => $username,
						'title' => "Thông báo đơn hàng",
						'message' => "Bạn vừa đặt thành công đơn hàng tại website ".base_url()." với mã đơn hàng là #".$id_order,						
						'status' => "wait"
					);
					$this->mail_model->insert($data_mail);
					//end mail

				} else {
					$error = "Đặt hàng không thành công";
				}
				
			} else if(empty($error)) {
				$error = "Phương thức thanh toán không hợp lệ";
			}
			$data_category = $this->category_model->get();
			$data = array(
				'category' => $data_category,
				'countcart' => $this->totalCart(),
				'error' => !empty($error) ? $error : '',
				'success' => !empty($success) ? $success : '',
				'redirectto' => ($id_method_payment === 4) ? 'https://www.nganluong.vn/button_payment.php?receiver=khanhit197@gmail.com&product_name='.$id_order.'&price='.((double)$total_money+(int)$total_cart*20000).'&return_url='.base_url().'&comments=order' : ''
			);

			
			
			$this->load->view('cart/complete_view', $data);

		} else {

			header("Location:".base_url().'giohang.html');
		}
	}
	// Add a new item
	public function add()
	{
		if( ! empty($_POST['code']) && !empty($_POST['color']) && !empty($_POST['size']) ) {
			$code = $this->input->post('code');
			$color = $this->input->post('color');
			$size = (int)$this->input->post('size');
			$num = isset($_POST['number']) ? (int)$_POST['number'] : 1;

			//check exists code
			$where = array('code' => $code);
			$data_product_check = $this->product_model->get($where);

			if(empty($data_product_check)) {

				$error = "Sản phẩm không tồn tại";

			} else {
				$data_product_check[0]['detail'] = json_decode($data_product_check[0]['detail'],true);
				$detail = $data_product_check[0]['detail'];				
				
				//check exists color
				if( array_search($color, $detail['color']) < 0) {

					$error = "Màu sắc không tồn tại";

				} else if ( array_search($size, $detail['size']) < 0) {

					$error = "Kích thước không đúng";

				} else {

					
					$count_num_cart = 0;
					$cart = array();

					//check has session cart
					if( ! $this->session->has_userdata('cart')  ) {

						$item = array(
							'code' => $code,
							'num' => (int)$num,
							'color' => $color,
							'size' => (int)$size
						);
						array_push($cart, $item);
						$count_num_cart = $num;


					} else {

						$cart = $this->session->userdata('cart');
						$exist = false;
						for($i = 0 ; $i < count($cart) ; $i++ ) {
							if($cart[$i]['code'] == $code) {

								$cart[$i]['num'] += $num;
								$exist = true;
							}
							$count_num_cart += $cart[$i]['num'];

						}

						if( ! $exist) {
							$add = array(
								'code' => $code,
								'num' => (int)$num,
								'color' => $color,
								'size' => (int)$size
							);
							array_push($cart, $add);
							$count_num_cart += $num;
						}
						
					} //end check session cart

					//update cart if already login
					if($this->session->has_userdata('username') && $this->session->has_userdata('security')) {
						$where = array('username' => $this->session->userdata('username'));
						$data = array('cart' => json_encode($cart));
						if( ! $this->account_model->update($data,$where)){

							$error = "Có lỗi khi thêm sản phẩm vào giỏ hàng";

						} 
					}

					$cart = array(
						'cart' => $cart
					);
					$this->session->unset_userdata('cart');
					$this->session->set_userdata( $cart );

					if(empty($error)) {
						$success = "Thêm vào giỏ hàng thành công";
					}
				}
			}
		} else {
			$error ="Có lỗi khi thêm vào giỏ hàng";
		}
		$res = !empty($success) ? array('success' => $success,'count' => ! empty($count_num_cart) ? $count_num_cart : $this->totalCart()) : array('error' => $error) ;
		echo json_encode($res);
		
	}

	//Update one item
	public function update( )
	{
		if(!empty($_POST['dataupdate'])) {
			$cartupdate = json_decode($_POST['dataupdate'],true);
			$cart_new = array();
			if($this->session->has_userdata('cart')) {

				$cart_session = $this->session->userdata('cart');
				

				for ($i = 0; $i < count($cart_session); $i++) {
					
					for ($j = 0; $j < count($cartupdate); $j++) {
						
						if($cart_session[$i]['code'] == $cartupdate[$j]['code']) {
							$cart_session[$i]['num'] = $cartupdate[$j]['num'] ;
						}
					}
					array_push($cart_new, $cart_session[$i]);
				}
			}
			//update database if already login
			if($this->session->has_userdata('username')) {
				$where = array('username' => $this->session->userdata('username'));
				$data = array('cart' => json_encode($cart_new));
				$this->account_model->update($data,$where);
			}
			//update session
			$this->session->unset_userdata('cart');
			if( ! empty($cart_new) ) {
				$array = array(
					'cart' => $cart_new
				);
				$this->session->set_userdata( $array );
			}

			$count_num_cart = $this->totalCart();
			$success = "Cập nhật thành công";

		} else {

			$error = "Cập nhật thất bại";
		}
		$res = !empty($success) ? array('success' => $success,'count' => $count_num_cart) : array('error' => $error) ;
		echo json_encode($res);
	}

	//Delete one item
	public function delete( )
	{
		if( !empty($_POST['code']) && $this->session->has_userdata('cart') ) {

			$code = $this->input->post('code');
			$cart_session = $this->session->userdata('cart');
			$cart_new = array();
			for($i = 0 ; $i < count($cart_session) ; $i++ ) {

				if($cart_session[$i]['code'] == $code) {

					continue;

				} else {
					array_push($cart_new, $cart_session[$i]);
				}
			}
			
			if($this->session->has_userdata('username')) {
				$where = array('username' => $this->session->userdata('username'));
				$data = array('cart' => json_encode($cart_new));
				$this->account_model->update($data,$where);
			}
			
			$this->session->unset_userdata('cart');
			if( ! empty($cart_new) ) {
				$array = array(
					'cart' => $cart_new
				);
				$this->session->set_userdata( $array );
			}
			

			//tính lại tổng tiền
			$listcode = array();

			for ( $i = 0 ; $i < count($cart_new) ; $i++ ) {

				array_push($listcode, $cart_new[$i]['code']);

			}
			$total = 0;
			if(!empty($listcode)) {
				$data_product = $this->product_model->getByListCode($listcode);
				for ( $i = 0 ; $i < count($data_product) ; $i++ ) {
					$code = $data_product[$i]['code'];
					for ( $j = 0 ; $j < count($cart_session) ; $j++ ) {

						if($cart_new[$j]['code'] == $code) {
							$num = $cart_new[$j]['num'];
							break;
						}

					}

					$data_product[$i]['detail'] = json_decode($data_product[$i]['detail'],true);
					$total += $data_product[$i]['detail']['price']*$num;

				}
			}
			
			$count_num_cart = $this->totalCart();
			$success = "Xóa thành công";

		} else {

			$error = "Xóa không thành công";
		}

		$res = !empty($success) ? array('success' => $success,'count' => $count_num_cart,'total' => number_format($total)) : array('error' => $error) ;
		echo json_encode($res);
	}
	
	private function total_money()
	{	
		$cart_session = $this->session->userdata('cart');
		$listcode = array();
		$total_money = 0;

		foreach ($cart_session as $value) {
			array_push($listcode,$value['code']);
					// die();
		}
		$data_product = $this->product_model->getByListCode($listcode);
		$products = array();


		for ( $i = 0 ; $i < count($data_product) ; $i++ ) {
			$data_product[$i]['detail'] = json_decode($data_product[$i]['detail'],true);

			for( $j = 0 ; $j < count($cart_session) ; $j++ ) {
				if( $data_product[$i]['code'] == $cart_session[$j]['code']) {
					$num = $cart_session[$j]['num'];
					break;
				}
			}
			$total = (int)$num * (double)$data_product[$i]['detail']['price'];
			$total_money += $total;
		}
		return $total_money;
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

/* End of file Cart.php */
/* Location: ./application/controllers/Cart.php */
