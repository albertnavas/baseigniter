<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Users_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
		$ci =& get_instance();
		$this->user_id = $ci->session->userdata('user_id');
	}
	
	public function getUserInfo($user_id)
	{
		$query = $this->db->get_where('users', array('id' => $user_id));
		$data = $query->result_array();
		return $data[0];
	}
	
	function getAllData($user_id=null)
	{
		$out['data'] = $this->getUserDataFromUserId($user_id);
		return $out;
	}
	
	function getUserDataFromUserId($user_id)
	{
		$query = $this->db->get_where('users', array('id' => $user_id));
		$data = $query->result_array();
		return $data[0];
	}
}