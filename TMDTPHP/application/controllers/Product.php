<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require 'MultiFormUpload.php';

class Product extends CI_Controller {
	private $num_per_page = 5;

	public function __construct()
	{
		parent::__construct();
		//Load Dependencies
		$this->load->model('category_model');
		$this->load->model('product_model');
		$this->load->model('homepage_model');
		$this->load->model('captcha_model');
		$this->load->model('account_model');

	}
	public function detail($id = null)
	{	
		
		$captcha = $this->captcha_model->get();

		//veri captcha google
		if(!empty($captcha)) {
			$publickey = $captcha[0]['publickey'];
		}

		$id = (int)$id;
		$where = array('id' => $id);
		$dataproduct = $this->product_model->get($where);
		if( empty($id) || empty($dataproduct) ) {			

			$this->load->view('notfound_view');

		} else {
			$data_category = $this->category_model->get();
			$dataproduct[0]['detail'] = json_decode($dataproduct[0]['detail'],true);			
			$data = array(
				'product' => $dataproduct,
				'countcart'=>$this->totalcart(),
				'publickeycaptcha' => !empty($publickey) ? $publickey : '',
				'category' => $data_category,
				'url' => base_url().'sanpham/'.$dataproduct[0]['id'].(!empty($dataproduct[0]['seo-link']) ? '.'.$dataproduct[0]['seo-link'] : '')
			);
			$this->load->view('product/detail_view', $data);
		}

	}

	// Add a new item
	public function add()
	{
		if( isset($_POST) &&  $this->session->has_userdata('username') && 
				( $this->session->userdata('role') == 'admin' || $this->session->userdata('role') == 'mod' ) ) {

			if(isset($_POST['addProduct'])){

				$error = array();

				if(count($_POST) < 14 || empty($_FILES['images']) || !isset($_POST['security']) ) {

					$error[count($error)] = "Dữ kiện bị thiếu";

				} else {

					$security = $_POST['security'];
					if(!$this->session->has_userdata('security') || $this->session->userdata('security') != $security) {

						$error[count($error)] = 'Yêu cầu không hợp lệ';

					} else {

						//get info product
						$data = array();
						foreach($_POST as $key => $value)
						{
							if($key == "addProduct" || $key == "security"){continue;}

							if($key == "code") {$code = $value;continue;}

							if($key == "number" ) {$value = (int)$value;}

							if($key == "price") {$value = (double)$value;}

							if($key == "category"){$idcategory = (int)$value;continue;}

							if($key == "color" || $key == "size") {$value = explode(",",$value);}

							if($key == "seo-link") {$value = preg_replace ('/[^\p{L}\p{N}]/u', '-', $value);}
							
							if($key == "seo-keywords") {							
								$value = explode(",",str_replace(" ", "-", $value));
							}

							$data[$key] = $value;
						}
						if(!empty($code)) {
							$where = array('code' => $code);
							if($this->product_model->get($where)){

								$error[count($error)] = "Mã sản phẩm đã tồn tại";
							}//get images
							else if( !empty($idcategory) ) {
								$where = array(
									'id' => $idcategory
								);
								$cgr = $this->category_model->get($where);
								if(!empty($cgr)){
									foreach ($cgr as $value) {
										$category_name = str_replace(" ", '', $value['name']); 
										break;
									}
									// call service upload image
									$upload = new MultiFormUpload();
									$upload->setFolderUrl('assets/images/product/'.$category_name.'/');

									//upload images
									$images = array();
									
									for($i = 0 ; $i < count($_FILES['images']['name']) ; $i++ ){

										$file = array();
										$file['name'] = $_FILES['images']['name'][$i];
										$file['type'] = $_FILES['images']['type'][$i];
										$file['size'] = $_FILES['images']['size'][$i];
										$file['tmp_name'] = $_FILES['images']['tmp_name'][$i];
										$upload->setFile($file);

										if( $upload->uploadImage() ){

											$images[count($images)] = $upload->getResult();

										} else {

											$error[count($error)] = 'Lỗi: '.$upload->getError();

										}

									}
									if( ! empty($images)) {

										$data['images'] = $images;
										$datainsert = array(
											'code' => $code,
											'category' => (int)$idcategory,
											'detail' => json_encode($data)
										);
										if($this->product_model->insert($datainsert)) {
											$success = "Thêm sản phẩm thành công";
										} else {
											$error[count($error)] = "Thêm sản phẩm thất bại";
										}

									} else {
										$error[count($error)] = "Upload ảnh không thành công.";
									}

									
								} else {
									$error[count($error)] = "Danh mục không tồn tại";
								}
							} else {
								$error[count($error)] = "Danh mục không được để trống";
							}
						}

					}
				}
				$res = array('error' => $error,'success' => !empty($success) ? $success : '' );
				die(json_encode($res));

			} else {
				$category = $this->category_model->get();
				$category = array('category' => $category);
				$this->load->view('admin/product/addProduct_view',$category);
			}
		} else {

			$this->load->view('notfound_view');
		}
	}

	public function control()
	{
		if( $this->session->has_userdata('username') && 
				( $this->session->userdata('role') == 'admin' || $this->session->userdata('role') == 'mod' ) ) {

			$data_product  = $this->product_model->get();
			$data_categogy = $this->category_model->get();
			$where 		   = array('name' => "optionsproduct");
			$data_optionsproduct = $this->homepage_model->get($where);
			
			foreach ($data_optionsproduct as $value) {
				$optionsproduct = json_decode($value['value'],true);
				if( empty($optionsproduct) ) {					
					$optionsproduct = array();
				}
				break;
			}
			

			for($i = 0 ; $i < count($data_product) ; $i++ ){

				$data_product[$i]['detail'] = json_decode($data_product[$i]['detail'],true);
				foreach ($data_categogy as $cgr) {
					if($cgr['id'] == $data_product[$i]['category']){
						$data_product[$i]['category'] = $cgr['name'];
						break;
					}
				}
			}

			//

			$data = array(
				'products' => $data_product,
				'optionsproduct' => $optionsproduct
			);
			$this->load->view('admin/product/controlProduct_view', $data);
			


		} else {

			$this->load->view('notfound_view');

		}
	}
	//Update one item
	public function update( $id = NULL )
	{
		if( isset($_POST) &&  $this->session->has_userdata('username') && ( $this->session->userdata('role') == 'admin' || $this->session->userdata('role') == 'mod' ) ) {

			$error = array();
			if(!isset($_POST['security']) || empty($id) ) {

				$error[count($error)] = "Yêu cầu không hợp lệ";

			} else {

				$security = $_POST['security'];
				if(!$this->session->has_userdata('security') || $this->session->userdata('security') != $security) {

					$error[count($error)] = 'Yêu cầu không hợp lệ';

				} else {

					//get info product need to update
					$data_update = array();
					foreach($_POST as $key => $value)
					{
						if($key == "security"){ continue ; }
						if($key == "code") { $code = $value ; continue;}
						if($key == "currentimage"){ $currentimage = $value ; continue;}
						if($key == "category"){$idcategory = (int)$value;continue;}

						//get the detail product
						if($key == "number") {$value = (int)$value;}
						if($key == "price") {$value = (double)$value;}
						if($key == "color" || $key == "size") {$value = explode(",",$value);}
						if($key == "seo-link") { $value = preg_replace ('/[^\p{L}\p{N}]/u', '-', $value);}
						if($key == "seo-keywords") {							
							$value = explode(",",str_replace(" ", "-", $value));
						}

						$data_update[$key] = $value;
					}

					if( empty($currentimage) ) {
						$currentimage = array();
					} else {
						$currentimage = json_decode($currentimage,true);
					}

					//get the data current
					$where = array('id' => (int)$id);
					$data_product = $this->product_model->get($where);


					//check changed code and update code
					if( ! empty($code) ) {

						$where = array('code' => $code);
						if($this->product_model->get($where)){

							$error[count($error)] = "Mã sản phẩm đã tồn tại";

						} else {

							$data_product[0]['code'] = $code;

						}
					} 
					// check changed category and update category

					if( ! empty($idcategory) ) {

						$where = array('id' => (int)$idcategory);
						$cgr = $this->category_model->get($where);
						if( ! empty($cgr) ){
							$error[count($error)] = "Danh mục không tồn tại";
						} else {

							$data_product[0]['category'] = (int)$idcategory;
							foreach ($cgr as $value) {
								$category_name = str_replace(" ", '', $value['name']); 
								break;
							}
						}
					} else {
						$where = array('id' => (int)$data_product[0]['category']);
						$cgr = $this->category_model->get($where);
						foreach ($cgr as $value) {
							$category_name = str_replace(" ", '', $value['name']); 
							break;
						}
					}
					
					// if not error then update
					if( empty($error) ) {

						
						if( ! empty($data_product) ) {

							
							//update detail product
							$data_product[0]['detail'] = json_decode($data_product[0]['detail'],true);	
							$data_images_old = $data_product[0]['detail']['images'];				
							foreach ($data_update as $key => $value) {
								$data_product[0]['detail'][$key] = $value;
							}

							//upload images
							if(!empty($_FILES['images'])) {

								// call service upload image
								$upload = new MultiFormUpload();
								$upload->setFolderUrl('assets/images/product/'.$category_name.'/');

								for( $i = 0 ; $i < count($_FILES['images']['name']) ; $i++ ){

									$file = array();
									$file['name']    	= $_FILES['images']['name'][$i];
									$file['type']    	= $_FILES['images']['type'][$i];
									$file['size']    	= $_FILES['images']['size'][$i];
									$file['tmp_name']	= $_FILES['images']['tmp_name'][$i];
									$upload->setFile($file);

									if( $upload->uploadImage() ){

										$currentimage[count($currentimage)] = $upload->getResult();

									} else {

										if( strpos($upload->getError(), "đã tồn tại") > - 1) {

											$currentimage[count($currentimage)] = base_url().'assets/images/product/'.$category_name.'/'.$_FILES['images']['name'][$i];
										} else {

											$error[count($error)] = 'Lỗi: '.$upload->getError();
										}
									}

								}
							}
							if( ! empty($currentimage) ) {
								$data_product[0]['detail']['images'] = $currentimage;
								$data_product[0]['detail'] = json_encode($data_product[0]['detail']);
								$data = array(
									'code'    	=> 	$data_product[0]['code'],
									'category'	=> 	$data_product[0]['category'],
									'detail'  	=> 	$data_product[0]['detail']
								);
								$where = array('id' => (int)$id);
								if($this->product_model->update($data_product[0],$where)) {

									$success = "Cập nhật thành công";

								//delete images old not using
									for( $i = 0 ; $i < count($data_images_old) ; $i++ ){

										if( !in_array($data_images_old[$i], $currentimage) ) {

											$filename = $this->getURIFromLink($data_images_old[$i]);
											if(file_exists($filename)){
												unlink($filename);
											}

										}					
									}

								} else {

									$error[count($error)] = "Dữ liệu không thay đổi.";

								}
							} else {

								$error[count($error)] = "Upload ảnh không thành công.Hủy bỏ cập nhật";

							}
							

							
							


						} else {

							$error[count($error)] = "Sản phẩm không tồn tại";
						}
					}//end if
					
				}
			}

			$res = array('error' => $error,'success' => !empty($success) ? $success : '' );
			die(json_encode($res));
			
		}else{

			$this->load->view('notfound_view');

		}

		
	}
	public function edit($id = NULL) 
	{
		$id = (int)$id;
		if( !empty($id) && $this->session->has_userdata('username') && 
				( $this->session->userdata('role') == 'admin' || $this->session->userdata('role') == 'mod' ) ) {

			$where = array('id' => $id);
			$data_product = $this->product_model->get($where);
			$data_categogy = $this->category_model->get();

			if( ! empty($data_product) ){

				$data_product[0]['detail'] = json_decode($data_product[0]['detail'],true);					
				$data = array(
					'products' => $data_product,
					'category' => $data_categogy
				);
				$this->load->view('admin/product/editProduct_view', $data);
			}
			return;

		} 
		$this->load->view('notfound_view');
	}

	//Delete one item
	public function delete( $id = NULL )
	{
		if( isset($_POST['security']) && 
						$this->session->has_userdata('username') && $this->session->userdata('role') == 'admin' ) {

			$security = $this->input->post('security');
			if(!$this->session->has_userdata('security') || $this->session->userdata('security') != $security) {

				$error = 'Yêu cầu không hợp lệ';

			} else {
				$id = (int)$id;
				if(empty($id)){
					$error = "Dữ liệu không hợp lệ";
				} else {

					$where = array('id' => $id);
					//get url images
					$data = $this->product_model->get($where);
					if(!empty($data)) {
						foreach ($data as $value) {
							$images = json_decode($value['detail'],true);
							$images = $images['images'];
							break;
						}
					}

					if($this->product_model->delete($where)){						
						for($i = 0 ; $i < count($images) ; $i++) {
							$link = $this->getURIFromLink($images[$i]);
							if(file_exists($link)){
								unlink($link);
							}
						}
						$success = "Xóa sản phẩm thành công";
					} else{
						$error = "Xóa sản phẩm thất bại";
					}
				}
			}
			$res = !empty($error) ? array('error' => $error) : array('success' => $success) ;
			die(json_encode($res));

		} else {
			$this->load->view('notfound_view');
		}

		
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
		return $link;
	}

	public function category()
	{
		if(isset($_GET['setpage'])){
			$captcha = $this->captcha_model->get();

			//veri captcha google
			if(!empty($captcha)) {
				$publickey = $captcha[0]['publickey'];
			}

			$name_category = $_GET['setpage'];

			$page = (isset($_GET['page']) && is_numeric($_GET['page']) && (int)$_GET['page'] > 0) ? (int)$_GET['page'] : 1 ;
			

			$data_category = $this->category_model->get();
			foreach ($data_category as $value) {
				if(strtolower($value['name']) == strtolower($name_category)) {
					$idcategory = (int)$value['id'];
					break;
				}
			}
			if(!empty($idcategory)) {

				$where = array('category' => $idcategory);
				$data_product = $this->product_model->getByCategory($where,$this->num_per_page,$page);
				if(!$data_product) {
					$data_product = array();
				}

				//get number product
				$count_product = $this->product_model->getNumberByCategory($where,$this->num_per_page);
				$count_product = (int)$count_product[0]['count'];
				$num_page = CEIL($count_product/$this->num_per_page);
				

				//decode json
				for($i = 0 ; $i < count($data_product) ; $i++ ){
					$data_product[$i]['detail'] = json_decode($data_product[$i]['detail'],true);
				}


				$data = array(
					'products' => $data_product,
					'category' => $data_category,
					'numpage' => $num_page,
					'currentpage' => $page,
					'countcart' => $this->totalCart(),
					'publickeycaptcha' => !empty($publickey) ? $publickey : ''
				);

				$this->load->view('product/displaybycategory_view', $data);
				return;

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

/* End of file Product.php */
/* Location: ./application/controllers/Product.php */
