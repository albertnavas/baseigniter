<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
				
		if (!$this->tank_auth->is_logged_in()) {
			$this->load->view('home');
		} else {
			redirect('front');
			exit;
		}
	}

	public function index()
	{
	}
	
}

/* End of file home.php */
/* Location: ./application/controllers/home.php */