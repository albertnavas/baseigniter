<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Front extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		
		// Loggin
		if (!$this->tank_auth->is_logged_in()) {
			$this->showUnLogged();
		} else {
			$this->showLogged();
		}
		// ****************
	}

	public function index()
	{
		$user_id = $this->user_id;
		$my_user_id = $this->user_id;
		$data['user'] = $this->Users_Model->getAllData($my_user_id);
		
		$this->init_header($data);
		$this->load->view('templates/sidebar_left.php', $data);
		$this->load->view('profile', $data);
		$this->init_footer($data);
	}

}

/* End of file front.php */
/* Location: ./application/controllers/front.php */