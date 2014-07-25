<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

	public function MY_Controller(){
	
		parent::__construct();
		$this->ci =& get_instance();
		$this->user_id = $this->ci->session->userdata('user_id');
		
		// Loggin
		if (!$this->tank_auth->is_logged_in()) {
			$this->showUnLogged();
		} else {
			$this->showLogged();
		}
		// ****************
		
	}
 
	public function index() {
	}
	
	public function showLogged()
	{
		$uid = $this->user_id;
		$u_data = $this->Users_Model->getUserDataFromUserId($uid);
		$this->islogged = true;
	}

	public function showUnLogged()
	{
		$url = $this->uri->segment(1);
		if (!empty($url)) {
			redirect('http://www.baseigniter.com', 301);
			exit;
		} else {
			$this->load->view('home');
		}
	}
	
	public function initHeader($data)
	{
		$data['user'] = $this->Users_Model->getAllData($this->user_id);
		
		$data['css'] = array (
			'//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css',
			'/public/css/custom.css',
			'/public/plugins/fineuploader/fineuploader-3.8.0.css',
		);
		
		$data['js'] = array (
			'//code.jquery.com/jquery-2.1.1.min.js',
			'//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js',
			'/public/plugins/fineuploader/jquery.fineuploader-3.8.0.min.js',
			'/public/js/custom.js',
		);
						
		$this->load->view('templates/header.php', $data);
	}
	
	public function initFooter($data)
	{
		$this->load->view('templates/footer.php', $data);
	}

}