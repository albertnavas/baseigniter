<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Manage extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		
		$this->load->database();
		$this->load->helper('url');
		
		$this->load->library('Grocery_CRUD');	
	}
	
	function index()
	{
		try{
			$crud = new grocery_CRUD();

			//$crud->set_theme('twitter-bootstrap');
			$crud->set_theme('datatables');
			$crud->set_table('users');
			$crud->set_subject('Users');
			$crud->required_fields('email');
			$crud->columns('id', 'username', 'email', 'activated', 'banned', 'last_ip', 'last_login', 'created', 'profile_photo');
			
			$crud->unset_edit();
			$crud->unset_delete();
			
			$output = $crud->render();
			
			$data = array();
			$this->loadHeader($data);
			$this->load->view('manage_users.php',$output);	
			$this->loadFooter($data);
			
			
		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}	
		
	function valueToEuro($value, $row)
	{
		return $value.' &euro;';
	}
	
}