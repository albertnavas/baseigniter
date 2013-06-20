<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Users_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
		$ci =& get_instance();
		$this->user_id = $ci->session->userdata('user_id');
	}
	
	function insertProfilePicId($imgFile)
	{

		$data['profile_photo'] = $imgFile;
		$this->db->where('id', $this->user_id);

		$this->db->update('users', $data); 

		return $imgFile;
	}
	
	function getAllData($user_id=null)
	{
		$out['data'] = $this->getUserDataFromUserId($user_id);
		if (empty($out['data']['profile_photo'])) {
			$out['data']['profile_photo'] = 'default_profile.png';
		}
		return $out;
	}
	
	function getUserDataFromUserId($user_id)
	{
		$query = $this->db->get_where('users', array('id' => $user_id));
		$data = $query->result_array();
		return $data[0];
	}
}