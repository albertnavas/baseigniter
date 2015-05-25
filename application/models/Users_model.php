<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Users_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
		$ci =& get_instance();
		$this->user_id = $ci->session->userdata('user_id');
	}
	
	function getUser($user_id)
	{
		$query = $this->db->get_where('users', array('id' => $user_id));
		$data = $query->result_array();
		
		if (!isset($data[0])) {
			return '';
		} else {
			return $data[0];
		}
	}

}