<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class App extends MY_Controller {
	
	function __construct()
	{
		parent::__construct();
		
	}

	public function index()
	{
		$data['user'] = $this->Users_Model->getUser($this->user_id);
		
		$this->initHeader($data);
		$this->load->view('dashboard');
		$this->initFooter($data);
	}
}
