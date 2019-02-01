<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require 'MultiFormUpload.php';
class Homepage extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		//Load Dependencies
		$this->load->model('homepage_model');
		$this->load->model('category_model');
		$this->load->model('account_model');

	}

	// Add a new item
	public function addBanner()
	{
		if( isset($_POST) &&  $this->session->has_userdata('username') && 
				( $this->session->userdata('role') == 'admin' || $this->session->userdata('role') == 'mod' ) ) {

			if(isset($_POST['addbanner']) && !empty($_POST['title']) && !empty($_POST['security']) && !empty($_FILES['image']) ) {

				
				$security = $_POST['security'];
				if(!$this->session->has_userdata('security') || $this->session->userdata('security') != $security) {

					$error = 'Yêu cầu không hợp lệ';

				} else {
					$title = $_POST['title'];
					$image_type = $_FILES['image']['type'];
					if( $image_type != "image/jpeg" && $image_type != "image/png" && $image_type != "image/jpg"){

						$error = 'Chỉ chấp nhận file ảnh';

					} else {

						$upload = new MultiFormUpload();
						$upload->setFolderUrl('assets/images/banner/');
						$upload->setFile($_FILES['image']);
						if($upload->uploadImage() == true){

							//get the current banner
							$where = array(
								'name' => 'banner'
							);
							$data = $this->homepage_model->get($where);
							foreach ($data as $value) {
								$banner = json_decode($value['value'],true);
								if($banner == '') {
									$banner = array();
								} 

								$stt = count($banner)+1;
								$newbanner = array(
									'stt' => (int)$stt,
									'title' => $title,
									'url' => $upload->result
								);

								array_push($banner,$newbanner);
								$banner = json_encode($banner);
								$data_update = array('value' => $banner);

								if($this->homepage_model->update($data_update,$where)) {
									$success = array('data'=> $newbanner);
								} else {
									$error = "Thêm không thành công";
								}

								break;
							}
						} else {
							$error = $upload->getError();
						}
					}
				}

				
			} else {
				$error = 'Dữ kiện bị thiếu';
			}
			$res = !empty($error) ? array('error' => $error) : array('success' => $success) ;
			die(json_encode($res));

		} else {
			$this->load->view('notfound_view');
		}


		
	}
	public function controlBanner()
	{
		if( $this->session->has_userdata('username') && 
				( $this->session->userdata('role') == 'admin' || $this->session->userdata('role') == 'mod' ) ) {

			$where = array('name'=>'banner');
			$data = $this->homepage_model->get($where);
			foreach ($data as $value) {
				$banner = json_decode($value['value'],true);
				if(empty($banner)) {
					$banner = array();
				}

				$banner = array(
					'databanner' => $banner
				);

				break;
			}

			$this->load->view('admin/homepage/controlBanner_view',$banner);
			return;
		}

		$this->load->view('notfound_view');
	}
	//Delete one item
	public function deleteBanner( $stt = NULL )
	{
		if( $this->session->has_userdata('username') && 
				( $this->session->userdata('role') == 'admin' || $this->session->userdata('role') == 'mod' ) ) {

			$security = $this->input->post('security');
			if(!$this->session->has_userdata('security') || $this->session->userdata('security') != $security) {

				$error = 'Yêu cầu không hợp lệ';

			} else if($stt == null) {
			
				$error = 'Dữ kiện bị thiếu';

			} else {

				//get current banner
				$where = array(
					'name' => 'banner'
				);
				$data = $this->homepage_model->get($where);
				foreach ($data as $value) {
					$banner = json_decode($value['value'],true);
					$newbanner = array();

					$st = 1;

					foreach ($banner as $val) {
						if($val['stt'] != $stt) {
							$val['stt'] = $st;
							array_push($newbanner, $val);
							$st++;

						} else {
							$url_delete = $this->getURIFromLink($val['url']);
						}
						
					}
					break;
				}
				
				$data = array(
					'value' => json_encode($newbanner)
				);
				if($this->homepage_model->update($data,$where)) {
					$success = array(
						'data' => $newbanner
					);

					//delete file in server
					unlink($url_delete);
				} else {
					$error = 'Cập nhật không thành công';
				}
				
			}
			$res = !empty($error) ? array('error' => $error) : array('success' => $success) ;
			die(json_encode($res));
		} else {
			$this->load->view('notfound_view');
		}

		
	}

	//Update options product
	public function updateOptionsProduct( )
	{

		if( $this->session->has_userdata('username') && 
				( $this->session->userdata('role') == 'admin' || $this->session->userdata('role') == 'mod' ) ) {

			if(!empty($_POST['security']) && (!$this->session->has_userdata('security') || $this->session->userdata('security') != $_POST['security']) ){

				$error = 'Yêu cầu không hợp lệ';

			} else if( empty($_POST['listnew']) || empty($_POST['listseller']) || empty($_POST['listsale']) ) {

				$error = 'Dữ liệu bị thiếu. Vui lòng kiểm tra lại';

			} else {


				
				$listnew = json_decode($_POST['listnew'],true);
				$listseller = json_decode($_POST['listseller'],true);
				$listsale = json_decode($_POST['listsale'],true);

				if( ! isset($listnew['checked']) ||  ! isset($listnew['notcheck']) ||  ! isset($listseller['checked']) || !  isset($listseller['checked']) ||  ! isset($listsale['checked']) ||  ! isset($listsale['checked']) ) {

					$error = "Dữ liệu bị thiếu hoặc không chính xác. Vui lòng kiểm tra lại";

				} else if(! is_array($listnew['checked']) || ! is_array($listseller['checked']) || ! is_array($listsale['checked']) || ! is_array($listnew['notcheck']) || ! is_array($listseller['notcheck']) || ! is_array($listsale['notcheck'])  ) {

					$error = "Kiểu dữ liệu không chính xác";

				} else {


					//get value old from data base
					$where = array('name' => 'optionsproduct' );
					$data_get = $this->homepage_model->get($where);
					foreach ($data_get as $value) {

						$data_current = $value['value'];

					}
					if(empty($data_current)) {
						$data_current = array();
					} else {
						$data_current = json_decode($data_current,true);
					}


					
					//update listnew
					for ($i = 0; $i < count($data_current['listnew']); $i++) {
						$keyf = array_search($data_current['listnew'][$i], $listnew['notcheck']);
						$keyt = array_search($data_current['listnew'][$i], $listnew['checked']);
						if( $keyf == false && $keyf !== 0 && $keyt == false && $keyt !== 0) {						
								array_push($listnew['checked'], $data_current['listnew'][$i] );
						}
						
						  
					}

					

					//update list seller
					for ($i = 0; $i < count($data_current['listseller']); $i++) {
						$keyf = array_search($data_current['listseller'][$i], $listseller['notcheck']);
						$keyt = array_search($data_current['listseller'][$i], $listseller['checked']);
						if( $keyf == false && $keyf !== 0 && $keyt == false && $keyt !== 0) {								
							array_push($listseller['checked'], $data_current['listseller'][$i] );
						}
					}
					//update list sale
					for ($i = 0; $i < count($data_current['listsale']); $i++) {
						$keyf = array_search($data_current['listsale'][$i], $listsale['notcheck']);
						$keyt = array_search($data_current['listsale'][$i], $listsale['checked']);
						if( $keyf == false && $keyf !== 0 && $keyt == false && $keyt !== 0) {										
							array_push($listsale['checked'], $data_current['listsale'][$i] );
						}
					}



					$optionsproduct = array(
						'listnew' => $listnew['checked'],
						'listseller' => $listseller['checked'],
						'listsale' => $listsale['checked']
					);

					$where= array('name' => 'optionsproduct');
					$data = array('name' => 'optionsproduct','value' => json_encode($optionsproduct));
					if($this->homepage_model->update($data,$where)) {
						$success = "Cập nhật thành công";
					} else {
						$error = "Dữ liệu không thay đổi";
					}

				}
			}

			$res = !empty($error) ? array('error' => $error) : array('success' => $success) ;
			die(json_encode($res));

		} else {
			$this->load->view('notfound_view');
		}

	}
	public function searchProduct()
	{
		define("numperpage", 10);
		$query = isset($_GET['q']) ? preg_replace("/(?![a-zA-Z0-9.\ ].*$)/","",$_GET['q'])  : '';
		$page = (isset($_GET['page']) && is_numeric($_GET['page']) && (int)$_GET['page'] > 0) ? (int)$_GET['page'] : 1 ;
		$data_category = $this->category_model->get();

		if( ! empty($query)) {
			$data = $this->homepage_model->searchProduct($query,$page,numperpage);
			if(!empty($data['data'])) {
				for($i = 0 ; $i < count($data['data']) ; $i++ ){

					$data['data'][$i]['detail'] = json_decode($data['data'][$i]['detail'],true);
				}
			}
		}

		$res = array(
			'products' => isset($data['data']) ? $data['data'] : array(),
			'numpage' => isset($data['total']) ? $data['total'] : 0,
			'currentpage' => $page,
			'countcart' => $this->totalCart(),
			'category' => $data_category
		);
		
		$this->load->view('product/displaySearch_view', $res);
		
	}
	

	
	private function getURIFromLink($link)
	{

		$pos1 = strpos($link, "//");
		$pos2 = strpos($link, "/", $pos1 + strlen("//"));
		if(!strpos($link, "localhost")){
			$link = substr($link, $pos2+1);
		}
		else{
			$pos3 = strpos($link,"/", $pos2 + strlen("/"));
			$link = substr($link,$pos3+1);
		}
		return "/".$link;
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

/* End of file HomePage.php */
/* Location: ./application/controllers/HomePage.php */
