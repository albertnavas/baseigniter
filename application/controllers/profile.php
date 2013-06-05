<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Profile extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->ci =& get_instance();
		if (!$this->tank_auth->is_logged_in())
			redirect('');
		$this->user_id = $this->ci->session->userdata('user_id');
	}

	public function updateCountryIam()
	{
		if(!$this->input->is_ajax_request())
			return;
		$country_code = geoip_country_code_by_name($_SERVER['REMOTE_ADDR']);
		$this->Userprofile_class->updateTravelCountry($country_code);
		$this->Userprofile_class->updateProfileVisibility($_POST['visible']);
	}

	public function updateCountry($country_id)
	{
		if(!$this->input->is_ajax_request())
			return;
		$this->Userprofile_class->updateTravelCountryFromID($country_id);
	}

	public function updateTravelType()
	{
		if(!$this->input->is_ajax_request())
			return;
		$travel_type = $_POST['type'];
		$this->Userprofile_class->updateTravelType($travel_type);
	}

	public function changeTourismTypeid($tourism_id)
	{
		if(!$this->input->is_ajax_request())
			return;
		$this->Userprofile_class->updateTourismTypeId($tourism_id);
	}

	public function friends($user_name)
	{
		$user_id = $this->Userprofile_class->getIdFromName($user_name);
		$data['username']=$user_name;
		$friends_list = $this->Friendship->getFriends($user_id);
		$data['friends'] = $this->Friendship->getFriendsInfo($friends_list);
		$data['showchat'] = true;
		$data['me'] = $this->Userprofile_class->getAllData($this->user_id);
		if($user_id != $this->user_id)
			$data['user'] = $this->Userprofile_class->getAllData($user_id);
		$data['isFriends']=true;
		$data['breadcrumbs'] = $this->Userprofile_class->makeBreadCrumbs($data);
		//Sidebar_left_user
		$data2 = $this->Tourismtype_class->getOptionsSidebarLeftUser();
		$data = array_merge($data,$data2);
		//-----
		$this->load->view('templates/head', $data);
		$this->load->view('templates/header', $data);
		if($user_id == $this->user_id)
			$this->load->view('templates/sidebar_left_user.php', $data);
		else
			$this->load->view('templates/sidebar_left_friend.php', $data);
		$this->load->view('profile/friends', $data);
		$this->load->view('templates/footer', $data);
	}

	public function albums($user_name)
	{
		$user_id = $this->Userprofile_class->getIdFromName($user_name);
		$data['user_id']=$user_id;
		$data['username']=$user_name;
		$data['showchat'] = true;
		$data['myPhotoWall'] = true;
		$data['me'] = $this->Userprofile_class->getAllData($this->user_id);
		if($user_id != $this->user_id)
		{
			$data['user'] = $this->Userprofile_class->getAllData($user_id);
			$data['myPhotoWall'] = false;
		}
		$data['isPhotos']=true;
		$data['breadcrumbs'] = $this->Userprofile_class->makeBreadCrumbs($data);
		$data['albums'] = $this->Userprofile_class->getAlbums($user_id);
		$data['page']=0;
		//Sidebar_left_user
		$data2 = $this->Tourismtype_class->getOptionsSidebarLeftUser();
		$data = array_merge($data,$data2);
		//-----
		$this->load->view('templates/head', $data);
		$this->load->view('templates/header', $data);
		if($user_id == $this->user_id)
			$this->load->view('templates/sidebar_left_user.php', $data);
		else
			$this->load->view('templates/sidebar_left_friend.php', $data);
		$this->load->view('photos/albums', $data);
		$this->load->view('templates/footer', $data);
	}

	public function albumAdd()
	{
		if(!$this->input->is_ajax_request())
			return;
		$album_name = $this->input->get('name');
		$code = $this->input->get('code');
		$this->Userprofile_class->insertAlbumId($album_name,$code);
	}

	public function albumDelete()
	{
		if(!$this->input->is_ajax_request())
			return;

		$albumid = $this->input->post('albumid');
		$this->Userprofile_class->deleteAlbumId($albumid);
	}

	public function album($user_name,$album_id)
	{
		$user_id = $this->Userprofile_class->getIdFromName($user_name);
		$data['user_id']=$user_id;
		$data['username']=$user_name;
		$data['showchat'] = true;
		$data['myPhotoWall'] = true;
		$data['me'] = $this->Userprofile_class->getAllData($this->user_id);
		if($user_id != $this->user_id)
		{
			$data['user'] = $this->Userprofile_class->getAllData($user_id);
			$data['myPhotoWall'] = false;
		}
		$data['isPhotos']=true;
		$data['breadcrumbs'] = $this->Userprofile_class->makeBreadCrumbs($data);
		$data['photos'] = $this->Userprofile_class->getPhotos($user_id,$album_id);
		$data['album']= $this->Userprofile_class->getAlbumDataFromAlbumId($album_id);
		$data['page']=0;
		//Sidebar_left_user
		$data2 = $this->Tourismtype_class->getOptionsSidebarLeftUser();
		$data = array_merge($data,$data2);
		//-----
		$this->load->view('templates/head', $data);
		$this->load->view('templates/header', $data);
		
		if($user_id == $this->user_id)
			$this->load->view('templates/sidebar_left_user.php', $data);
		else
			$this->load->view('templates/sidebar_left_friend.php', $data);
		$this->load->view('photos/album', $data);
		$this->load->view('templates/footer', $data);
	}

	public function getPhotosByPage($user_id, $page=0)
	{
		if(!$this->input->is_ajax_request())
			return;
		$start = $page*9;
		$data['photos'] = $this->Userprofile_class->getPhotos($user_id, $start);
		$data['page']=$page;
		$this->load->view('photos_list', $data);
	}

	public function photo($photo_id)
	{
		$photo = $this->Userprofile_class->getPhoto($photo_id);
		$user_id = $photo[0]['user_id'];
		$user = $this->Userprofile_class->getUser($user_id);

		$data['username'] = $user['username'];
		$data['showchat'] = true;
		$data['myPhotoWall'] = true;
		$data['me'] = $this->Userprofile_class->getAllData($this->user_id);
		if($user_id != $this->user_id)
		{
			$data['user'] = $this->Userprofile_class->getAllData($user_id);
			$data['myPhotoWall'] = false;
		}
		$data['isPhotos']=true;
		$data['breadcrumbs'] = $this->Userprofile_class->makeBreadCrumbs($data);
		$data['photo'] = $photo;
		//Sidebar_left_user
		$data2 = $this->Tourismtype_class->getOptionsSidebarLeftUser();
		$data = array_merge($data,$data2);
		//-----
		$this->load->view('templates/head', $data);
		$this->load->view('templates/header', $data);
		if($user_id == $this->user_id)
			$this->load->view('templates/sidebar_left_user.php', $data);
		else
			$this->load->view('templates/sidebar_left_friend.php', $data);
		$this->load->view('photos/photo', $data);
		$this->load->view('templates/footer', $data);
	}

	public function photoDelete()
	{
		if(!$this->input->is_ajax_request())
			return;

		$photoid = $this->input->post('photoid');
		$this->Userprofile_class->deletePhotoId($photoid);
	}

	public function gettourismtype($tourism_type_id)
	{
		$out=array();
		$tourism_type = $this->Userprofile_class->getAllTourismType($tourism_type_id);
		$out['name']=$tourism_type['name'];
		$out['description']=!empty($tourism_type['description'])?$tourism_type['description']:'Sin descripción';

		echo json_encode($out);
	}

	public function upload_album_photo()
	{
		// Define a destination
		$targetFolder = '/photos/'; // Relative to the root
		if (!empty($_FILES)) {
			$tempFile = $_FILES['Filedata']['tmp_name'];
			$targetPath = $_SERVER['DOCUMENT_ROOT'] . $targetFolder;
			
			$imageSize = getimagesize($tempFile);
			$extension = explode('.',$_FILES['Filedata']['name']);
			$num = count($extension)-1;
			$imgFile = mktime().'.'.$extension[$num];


			$targetFile = rtrim($targetPath,'/') . '/' . $imgFile;
			
			// Validate the file type
			$fileTypes = array('jpg','jpeg','gif','png'); // File extensions
			$fileParts = pathinfo($_FILES['Filedata']['name']);
			
			if (in_array($fileParts['extension'],$fileTypes)) {
				move_uploaded_file($tempFile,$targetFile);
				$thumb_dir_img = $targetPath = $_SERVER['DOCUMENT_ROOT'] . $targetFolder.'/thumbs/'.$imgFile;
				WideImage::load($targetFile)->resize(250, 250)->saveToFile($thumb_dir_img);
				$thumb_dir_img = $targetPath = $_SERVER['DOCUMENT_ROOT'] . $targetFolder.'/thumbs2/'.$imgFile;
				WideImage::load($targetFile)->resize(550, 550)->saveToFile($thumb_dir_img);
				echo '1';

				$album_id = $this->input->get('album_id', TRUE);				
				$last_id = $this->Userprofile_class->insertPicId($imgFile,$imageSize,$album_id);

				$respuestaFile = _('done');
				$fileName = $imgFile;
				$mensajeFile = $imgFile;
				//$content = '{img}'.$last_id.'{/img}';
				//$this->Posts_class->add($content, 0);
				
			} else {
				echo _('Invalid file type.');
			}
		}
	}

	public function upload_photo_profile()
	{
		// Define a destination
		$targetFolder = '/photos/'; // Relative to the root

		if (!empty($_FILES)) {
			$tempFile = $_FILES['Filedata']['tmp_name'];
			$targetPath = $_SERVER['DOCUMENT_ROOT'] . $targetFolder;
			
			$extension = explode('.',$_FILES['Filedata']['name']);
			$num = count($extension)-1;
			$imgFile = mktime().'.'.$extension[$num];

			$targetFile = rtrim($targetPath,'/') . '/' . $imgFile;
			
			// Validate the file type
			$fileTypes = array('jpg','jpeg','gif','png'); // File extensions
			$fileParts = pathinfo($_FILES['Filedata']['name']);
			
			if (in_array($fileParts['extension'],$fileTypes)) {
				move_uploaded_file($tempFile,$targetFile);
				$thumb_dir_img = $targetPath = $_SERVER['DOCUMENT_ROOT'] . $targetFolder.'/thumbs/'.$imgFile;
				WideImage::load($targetFile)->resize(230, 230)->saveToFile($thumb_dir_img);
				echo $imgFile;

				$last_id = $this->Userprofile_class->insertProfilePicId($imgFile);

				$respuestaFile = _('done');
				$fileName = $imgFile;
				$mensajeFile = $imgFile;
				//$content = '{img_profile}'.$last_id.'{/img_profile}';
				//$this->Posts_class->add($content, 0);
				
			} else {
				echo _('Invalid file type.');
			}
		}
	}

	public function upload_photo_front()
	{
		// Define a destination
		$targetFolder = '/photos/'; // Relative to the root

		if (!empty($_FILES)) {
			$tempFile = $_FILES['Filedata']['tmp_name'];
			$targetPath = $_SERVER['DOCUMENT_ROOT'] . $targetFolder;
			
			$extension = explode('.',$_FILES['Filedata']['name']);
			$num = count($extension)-1;
			$imgFile = mktime().'.'.$extension[$num];

			$targetFile = rtrim($targetPath,'/') . '/' . $imgFile;
			
			// Validate the file type
			$fileTypes = array('jpg','jpeg','gif','png'); // File extensions
			$fileParts = pathinfo($_FILES['Filedata']['name']);
			
			if (in_array($fileParts['extension'],$fileTypes)) {
				move_uploaded_file($tempFile,$targetFile);
				$thumb_dir_img = $targetPath = $_SERVER['DOCUMENT_ROOT'] . $targetFolder.'/thumbs/'.$imgFile;
				WideImage::load($targetFile)->resize(570, 300, 'inside', 'up')->saveToFile($thumb_dir_img);
				echo $imgFile;

				$last_id = $this->Userprofile_class->insertFrontPicId($imgFile);

				$respuestaFile = _('done');
				$fileName = $imgFile;
				$mensajeFile = $imgFile;
				//$content = '{img_front}'.$last_id.'{/img_front}';
				//$this->Posts_class->add($content, 0);
				
			} else {
				echo _('Invalid file type.');
			}
		}
	}

}