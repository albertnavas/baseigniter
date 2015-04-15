<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

	public function MY_Controller(){
		parent::__construct();
		
		date_default_timezone_set("Europe/Madrid");
			
		$this->ci =& get_instance();
		$this->user_id = $this->ci->session->userdata('user_id');
		
		// Loggin
		if (!$this->ion_auth->logged_in())
		{
			redirect('login');
		}
		// ****************
		
	}
 
	public function index() {
		
	}
		
	public function initHeader($data)
	{
		$data['user'] = $this->Users_Model->getUser($this->user_id);

		$data['css'] = array (
			'//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css',
			'/assets/css/custom.css',
		);
		
		$data['js'] = array (
			'/assets/js/jquery-2.1.3.min.js',
			'//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js',
			'/assets/js/custom.js',
		);
						
		$this->load->view('templates/header.php', $data);
	}
	
	public function initFooter($data)
	{
		$this->load->view('templates/footer.php', $data);
	}

}