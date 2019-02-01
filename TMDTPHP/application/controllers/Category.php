<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		//Load Dependencies
		$this->load->model('category_model');
		$this->load->model('product_model');

	}
	public function control()
	{
		if( $this->session->has_userdata('username') && 
				( $this->session->userdata('role') == 'admin' || $this->session->userdata('role') == 'mod' ) ) {
			$data = $this->category_model->get();

		foreach ($data as $key => $value) {
			$where = [
				'category' => $value['id']
			];
			$data_product = $this->product_model->get($where);
			$data[$key]['count'] = count($data_product);
		}


		
			$data = array(
				'category' => $data
			);


			$this->load->view('admin/category/controlCategory_view',$data);

		} else {
			$this->load->view('notfound_view');
		}
	}
	// Add a new item
	public function add()
	{
		if(isset($_POST) && $this->session->has_userdata('username') && 
				( $this->session->userdata('role') == 'admin' || $this->session->userdata('role') == 'mod' ) ) {
			if(isset($_POST['name']) && isset($_POST['security'])) {
				$name = $this->input->post('name');
				$security = $this->input->post('security');
				if($this->session->has_userdata('security') && $this->session->has_userdata('security') == $security) {

					$datainsert = array(
						'name' => $name
					);
					if($this->category_model->get($datainsert)){
						$error = "Tên danh mục đã tồn tại";
					} else {

						if($this->category_model->insert($datainsert)){
							$data = $this->category_model->get($datainsert);
							foreach ($data as $value) {
								$success = $value;
								break;
							}

						} else {
							$error = "Thêm danh mục thất bại";
						}
					}

				} else {
					$error = "Yêu cầu không hợp lệ";
				}
			} else{
				$error = "Dữ kiện bị thiếu";
			}
			$res = !empty($error) ? array('error' => $error) : array('success' => $success);
			die(json_encode($res));

		} else {

			$this->load->view('notfound_view');
		}

		
	}

	//Update one item
	public function update( $id = NULL )
	{
		if(isset($_POST) && $this->session->has_userdata('username') && 
				( $this->session->userdata('role') == 'admin' || $this->session->userdata('role') == 'mod' ) ) { 

			if($id == null){$id = (int)$this->input->post('id');}
		
			if(!empty($_POST['security']) && !empty($_POST['name']) && $id != null) {

				$security = $this->input->post('security');
				$name = $this->input->post('name');

				if($this->session->has_userdata('security') && $this->session->userdata('security') == $security) {

					$where = array(
						'id' => $id
					);
					$data = array(
						'name' => $name
					);
					if($this->category_model->update($data,$where)){

						$success = "Cập nhật thành công";

					} else {

						$error = "Cập nhật không thành công";

					}

				} else {
					$error = "Yêu cầu không hợp lệ";
				}


			} else {

				$error = "Dữ kiện bị thiếu";

			}
			$res = !empty($error) ? array('error' => $error) : array('success' => $success);
			die(json_encode($res));
		} else {

			$this->load->view('notfound_view');

		}
		
		
	}

	//Delete one item
	public function delete( $id = NULL )
	{
		if(isset($_POST) && $this->session->has_userdata('username') && 
				( $this->session->userdata('role') == 'admin' || $this->session->userdata('role') == 'mod' ) ) { 

			if($id == null){$id = (int)$this->input->post('id');}

			if(!empty($_POST['security']) && $id != null) {

				$security = $this->input->post('security');

				if($this->session->has_userdata('security') && $this->session->userdata('security') == $security) {
					$where = [
						'category' => $id
					];
					$data_product = $this->product_model->get($where);
					if(count($data_product) > 0){
						$error = "Đã có sản phẩm chứa danh mục này";

					} else {
						$where = array(
							'id' => $id
						);
						if($this->category_model->delete($where)){

							$success = "Xóa thành công";

						} else {

							$error = "Xóa không thành công";

						}
					}

				} else {
					$error = "Yêu cầu không hợp lệ";
				}

			} else {

				$error = "Dữ kiện bị thiếu";
			}
			$res = !empty($error) ? array('error' => $error) : array('success' => $success);
			die(json_encode($res));

		} else {
			$this->load->view('notfound_view');
		}
		
	}
}

/* End of file Category.php */
/* Location: ./application/controllers/Category.php */
