<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

	public function MY_Controller(){
	
		parent::__construct();
		$this->ci =& get_instance();
		$this->user_id = $this->ci->session->userdata('user_id');
		
		// Loggin
		if (!$this->ion_auth->logged_in()) {
			redirect('login', 'refresh');
		}
		
	}
 
	public function index() {
	}
	
	public function loadHeader($data)
	{
		$data['user'] = $this->Users_Model->getUser($this->user_id);

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
	
	public function loadFooter($data)
	{
		$this->load->view('templates/footer.php', $data);
	}

}