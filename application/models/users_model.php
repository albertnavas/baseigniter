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

	function getUser($user_id)
	{
		$query = $this->db->get_where('users', array('id' => $user_id));
		$data = $query->result_array();
		$data = $data[0];
		if (empty($data['profile_photo'])) {
			$data['profile_photo'] = 'default_profile.png';
		}

		return $data;
	}
}