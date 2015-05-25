<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Manage extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		
		$uid = $this->user_id;
		$user_data = $this->Users_Model->getUser($uid);
		$this->user_data = $user_data;

		$this->load->database();
		$this->load->helper('url');

		$this->load->library('grocery_CRUD');
	}

	public function index()
	{
		redirect('/manage/users', 301);
	}

	public function users()
	{
		try{
			$crud = new grocery_CRUD();
			
			$crud->set_theme('datatables');
			$crud->set_table('users');
			$crud->set_subject('Usuarios');
			$crud->columns('id', 'username', 'email', 'last_login');
			$crud->fields('username', 'first_name', 'last_name','phone');
						
			
			$crud->callback_before_insert(array($this,'password_encrypt'));
			$crud->callback_before_update(array($this,'password_encrypt'));
			
			$crud->unset_delete();
			
			$output = $crud->render();
			
			$data = array();
			$this->load->view('backend/header_manage', $data);
			$this->load->view('backend/manage.php',$output);	
			$this->load->view('backend/footer_manage', $data);
			
			
		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}
	
	function password_encrypt($post_array)
	{
		if (substr($post_array['password'], 0, 4) != '$2y$') {
			exit;
			$this->load->model('ion_auth_model');
		    $post_array['password'] = $this->ion_auth_model->hash_password($post_array['password']);
		}
		return $post_array;
	}

}