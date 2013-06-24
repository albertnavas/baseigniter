<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Front extends MY_Controller {

	public function index()
	{
	
		if (isset($this->islogged) && $this->islogged) {
			$this->show_profile();
		}
		
	}
	
	public function show_profile($user=false)
	{
		$user_id = $this->user_id;
		$my_user_id = $this->user_id;
		$data['user'] = $this->Users_Model->getAllData($my_user_id);
		
		$this->initHeader($data);
		$this->load->view('templates/sidebar_left.php', $data);
		$this->load->view('profile', $data);
		$this->initFooter($data);
	}
	
	public function upload_photo_profile()
	{
		// Define a destination
		$targetFolder = '/public/img/users/'; // Relative to the root

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
				echo $imgFile;

				$last_id = $this->Users_Model->insertProfilePicId($imgFile);

				$respuestaFile = _('done');
				$fileName = $imgFile;
				$mensajeFile = $imgFile;
				
			} else {
				echo _('Invalid file type.');
			}
		}
	}

}

/* End of file front.php */
/* Location: ./application/controllers/front.php */