<?php  
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MainController extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('product_model');
		$this->load->model('homepage_model');
		$this->load->model('category_model');
		$this->load->model('account_model');
		$this->load->model('captcha_model');
	}

	public function index()
	{
		$homepage = $this->homepage_model->get();
		$captcha = $this->captcha_model->get();

				//veri captcha google
		if(!empty($captcha)) {
			$publickey = $captcha[0]['publickey'];
		}

		$data_category = $this->category_model->get();
		
		foreach ($homepage as $value) {
			if($value['name'] == "banner") {
				$banner = $value['value'];
				$banner = json_decode($banner,true);
			}
			if($value['name'] == "optionsproduct") {
				$optionsproduct = $value['value'];
				$optionsproduct = json_decode($optionsproduct,true);
			}
			
		}
		
		empty($banner) ? $banner                 = array() : $banner ;
		empty($optionsproduct) ? $optionsproduct = array() : $optionsproduct ;

		
		$listid = array();
		foreach ($optionsproduct as $key => $value) {
			for ( $i = 0 ; $i < count($optionsproduct[$key]) ; $i++ ) {

				if( ! in_array( $optionsproduct[$key][$i], $listid ) ) {

					$listid[count($listid)] = $optionsproduct[$key][$i];		

				}
						
			}
			
		}
		if(!empty($listid) && is_array($listid) ){
			$dataproduct = $this->product_model->getByListId($listid);
			
			for($i = 0 ; $i < count($dataproduct) ; $i++ ){

				$dataproduct[$i]['detail'] = json_decode($dataproduct[$i]['detail'],true);

			}
			

		} else {
			$dataproduct = array();
		}		
		

		$data = array(
			'product'       => $dataproduct,
			'optionsproduct'=> $optionsproduct,
			'banner'        => $banner,
			'category' => $data_category,
			'countcart' => $this->totalCart(),
			'publickeycaptcha' => !empty($publickey) ? $publickey : ''
		);

		$this->load->view('index_view',$data);
	}
	public function totalCart()
	{
		$total = 0;
		if( $this->session->has_userdata('cart') ) {
			$cart = $this->session->userdata('cart');	

			for($i = 0 ; $i < count($cart) ; $i++ ) {
				
				
				$total += $cart[$i]['num'];
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

/* End of file MainController.php */
/* Location: ./application/controllers/MainController.php */
