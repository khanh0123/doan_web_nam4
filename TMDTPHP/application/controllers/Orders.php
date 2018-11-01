<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orders extends CI_Controller {

	private $numperpage = 5;

	public function __construct()
	{
		parent::__construct();
		//Load Dependencies
		$this->load->model('orders_model');
		$this->load->model('status_model');
		$this->load->model('payment_model');
		$this->load->model('product_model');
		$this->load->model('category_model');
		$this->load->model('account_model');

	}


	// List all your items
	public function control()
	{
		if($this->session->has_userdata('username') && 
			( $this->session->userdata('role') == 'admin' || $this->session->userdata('role') == 'mod' ) ) {
			//get status
				$data_status = $this->status_model->get();
			
			//get data orders
			$data_orders = $this->orders_model->get();

			
			for ($i = 0; $i < count($data_orders); $i++) {
				$data_orders[$i]['detail'] = json_decode($data_orders[$i]['detail'],true);
			}
			$data = array(
				'listorder' => $data_orders,
				'liststatus' => $data_status
			);
			$this->load->view('admin/orders/controlOrders_view', $data);

		} else {
			$this->load->view('notfound_view');
		}
	}
	public function detail($id = null)
	{
		if($this->session->has_userdata('username') && 
			( $this->session->userdata('role') == 'admin' || $this->session->userdata('role') == 'mod' ) && $id != null ) {

				$id = (double)$id;

				//get data orders
				$where = array('id' => $id);
				$data_orders = $this->orders_model->get($where);
				if( ! empty($data_orders)) {

					$data_orders[0]['detail'] = json_decode($data_orders[0]['detail'],true);

					//get status
					$data_status = $this->status_model->get();

					//get method payment
					$where = array('id' => $data_orders[0]['payment']);
					$data_payment = $this->payment_model->get($where);
					if( ! empty($data_status) ) {
						 $data_orders[0]['payment'] = $data_payment[0]['name'];
					}

					//get info product
					for ($i = 0; $i < count($data_orders[0]['detail']['cart']); $i++) {

						$code_product  = $data_orders[0]['detail']['cart'][$i]['code'];			
						$where = array('code' => $code_product);
						$data_product = $this->product_model->get($where);
						$data_product[0]['detail'] = json_decode($data_product[0]['detail'],true);

						$data_orders[0]['detail']['cart'][$i]['productname'] = $data_product[0]['detail']['name'];
						$data_orders[0]['detail']['cart'][$i]['productprice'] = $data_product[0]['detail']['price'];
					}

					$data = array(
						'order' => $data_orders[0],
						'liststatus' => $data_status

					);
					$this->load->view('admin/orders/detailOrders_view', $data);
					return;
				}
				
		}
		$this->load->view('notfound_view');

	}


	//Update one item
	public function updateStatus( )
	{


		if($this->session->has_userdata('username') && 
			( $this->session->userdata('role') == 'admin' || $this->session->userdata('role') == 'mod' ) && ! empty($_POST['id']) && ! empty($_POST['status']) && !empty($_POST['security']) && $_POST['security'] == $this->session->userdata('security') ) {

			$id = (double)$this->input->post('id');

			$status = (int)$this->input->post('status');
			$where = array('id'=>$status);
			if($this->status_model->get($where)) {

				$data = array('status' => $status);
				$where = array('id' => $id);
				if($this->orders_model->update($data,$where)) {
					$success = "Cập nhật thành công";
				} else {
					$error = "Cập nhật thất bại";
				}



			} else {
				$error = "Trạng thái đơn hàng không tồn tại";
			}

			$res = !empty($error) ?  array('error' => $error) : array('success' => $success) ;
			die(json_encode($res));

		} else {
			$this->load->view('notfound_view');
		}
		
	}

	
	//view all orders
	public function viewOrders() {

		if($this->session->has_userdata('username')) {
			$data_category = $this->category_model->get();

			$id = (int)$this->session->userdata('id');
			$page = !empty($_GET['p']) ? (int)$_GET['p'] : 1;
			$where = array('account' => $id);
			$result = $this->orders_model->getById($where,$this->numperpage,$page);

			if($result['totalpage'] < $page && $page != 1) {
				$this->load->view('notfound_view');
				return;
			}

			$data = isset($result['result']) ? $result['result'] : '';

			for ($i = 0; $i < count($data); $i++) {
				$data[$i]['detail'] = json_decode($data[$i]['detail'],true);
				$cart = $data[$i]['detail']['cart'];

				//get images and name of product in cart
				for ($j = 0; $j < count($cart); $j++) {

					$where = array("code" =>  $cart[$j]['code']);
					$data_product = $this->product_model->get($where);
					
					if(! empty($data_product)) {
						$data_product[0]['detail'] = json_decode($data_product[0]['detail'],true);

						$data[$i]['detail']['cart'][$j]['thumbnail'] = $data_product[0]['detail']['images'][0];
						$data[$i]['detail']['cart'][$j]['name'] = $data_product[0]['detail']['name'];
						
						
					}
				}


				$id_status = $data[$i]['status'];
				$where = array('id' => $id_status);
				$data_status = $this->status_model->get($where);
				$data[$i]['status'] = $data_status[0]['name'];
				

			}			
			

			$data = array(
				'dataorders' => $data,
				'numpage' => isset($result['totalpage']) ? $result['totalpage'] : 0,
				'currentpage' => $page,
				'category' => $data_category,
				'countcart' => $this->totalCart()
			);

			
			$this->load->view('orders/viewOrders_view', $data);
		}
	}
	public function viewDetailOrder($id = null)
	{

		if( ! empty($id) &&  $this->session->has_userdata('username')) {
			
			$id = (double)$id;
			$where = array('id' => $id,'account' => $this->session->userdata('id'));

			$order = $this->orders_model->get($where);
			if(! empty($order)) {
				$data_category = $this->category_model->get();
				
				$order[0]['detail'] = json_decode($order[0]['detail'],true);
				$cart = $order[0]['detail']['cart'];

				//get status order
				$id_status = $order[0]['status'];
				$where = array('id' => $id_status);
				$data_status = $this->status_model->get($where);
				$order[0]['status'] = $data_status[0]['name'];

				//get the method payment
				$id_payment = $order[0]['payment'];
				$where = array('id' => $id_payment);
				$data_payment = $this->payment_model->get($where);
				$order[0]['payment'] = $data_payment[0]['name'];

				//get images and name of product in cart
				for ($j = 0; $j < count($cart); $j++) {

					$where = array("code" =>  $cart[$j]['code']);
					$data_product = $this->product_model->get($where);

					if(! empty($data_product)) {
						$data_product[0]['detail'] = json_decode($data_product[0]['detail'],true);

						$order[0]['detail']['cart'][$j]['thumbnail'] = $data_product[0]['detail']['images'][0];
						$order[0]['detail']['cart'][$j]['name'] = $data_product[0]['detail']['name'];
						$order[0]['detail']['cart'][$j]['price'] = $data_product[0]['detail']['price'];
						$order[0]['detail']['cart'][$j]['url'] = base_url().'sanpham/'.$data_product[0]['id'].(!empty($data_product[0]["detail"]["seo-link"]) ? ('.'.ucwords(strtolower($data_product[0]["detail"]["seo-link"]))) : '');
					}
				}
				$data = array(
					'dataorder' => $order,
					'category' => $data_category,
					'countcart' => $this->totalCart(),
					'redirectto' => ($id_payment == 4 && $order[0]['status'] != "Đã hủy") ? 'https://www.nganluong.vn/button_payment.php?receiver=khanhit197@gmail.com&product_name='.$order[0]['id'].'&price='.((double)$order[0]['detail']['total_money']+(int)$order[0]['detail']['shipping']).'&return_url='.base_url().'&comments=order' : ''
				);


				$this->load->view('orders/detailOrder_view', $data);

				return;
			}
		} 

			
		$this->load->view('notfound_view');

	}
	public function cancelOrder($id = null)
	{
		if($this->session->has_userdata('username') && !empty($id)) {


			$id = (int)$id;
			$where = array('id' => $id);
			$data_order = $this->orders_model->get($where);

			if(!empty($data_order)) {

				//get name of status
				$where = array('id' => $data_order[0]['status']);
				$data_status = $this->status_model->get($where);

				if(! empty($data_status)) {
					$name_status = $data_status[0]['name'];

					if($name_status == "Chờ xác nhận" || $name_status == "Chờ thanh toán") {

						$where = array('id' => $id);
						$data_update = array('status' => 7); //update status to cancel
						if( $this->orders_model->update($data_update,$where) ) {

							$alert = "Hủy đơn hàng #".$id." thành công";
							//send mail
									

							//add to table mail
							$this->load->model('mail_model');
							$username = $this->session->userdata('username');
							$email = $this->session->userdata('email');	
							$data_mail = array(
								'email' => $email,
								'title' => "Thông báo đơn hàng",
								'message' => "Bạn vừa hủy đơn hàng tại website ".base_url()." với mã đơn hàng là #".$id,
								'name' => $username,
								'status' => "wait"
							);
							$this->mail_model->insert($data_mail);
							//end mail

						} else {
							$alert = "Hủy đơn hàng #".$id." không thành công";
						}

						
					} else {
						$alert = "Hủy đơn hàng #".$id." không thành công. Vui lòng liên hệ bộ phận CSKH.";
					}
					$data = array('alert' => $alert);
					$this->load->view('orders/resultCancelOrder_view', $data);
					return;
				}
			}
		}	
		$this->load->view('notfound_view');	
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

/* End of file Orders.php */
/* Location: ./application/controllers/Orders.php */
