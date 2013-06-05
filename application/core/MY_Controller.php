<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

	public function MY_Controller(){
	
		parent::__construct();
		$this->ci =& get_instance();
		$this->user_id = $this->ci->session->userdata('user_id');
		
	}
 
	public function index() {
	}
	
	public function showLogged()
	{
		$uid = $this->user_id;
		$u_data = $this->Users_Model->getUserDataFromUserId($uid);
	}

	public function showUnLogged()
	{
		$this->load->view('home');
	}
	
	public function init_header($data)
	{
		$data['user'] = $this->Users_Model->getAllData($this->user_id);
		
		$data['css'] = array (
			'/public/plugins/bootstrap/css/bootstrap.css',
			'/public/plugins/bootstrap/css/bootstrap-responsive.css',
			'/public/css/custom.css',
			'/public/css/jquery-ui-1.9.2.custom.css',
			'/public/plugins/uploadify/uploadify.css',
		);
		
		$data['js'] = array (
			'/public/js/jquery-1.8.2.js',
			'/public/js/jquery-ui.js',
			'/public/plugins/bootstrap/js/bootstrap.js',
			'/public/plugins/uploadify/jquery.uploadify-3.1.min.js',
			'/public/js/custom.js',
		);
				
		$this->load->view('templates/header.php', $data);
	}
	
	public function init_footer($data)
	{
		$this->load->view('templates/footer.php', $data);
	}

}