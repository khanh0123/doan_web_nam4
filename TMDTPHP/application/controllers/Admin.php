<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		// $this->load->model('account_model');
	}

	public function index()
	{
		if($this->session->has_userdata('role') && ($this->session->userdata('role') == 'admin' || $this->session->userdata('role') == 'mod') ) {

			$this->load->view('admin/admindashboard');

		} else {

			$this->load->view('notfound_view');
		}
		
	}

}

/* End of file Admin.php */
/* Location: ./application/controllers/Admin.php */
 ?>