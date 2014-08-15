<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends MY_Controller {

	public function index()
	{
		$data['user'] = $this->Users_Model->getUser($this->user_id);

		$this->loadHeader($data);
		$this->load->view('templates/sidebar_left.php', $data);
		$this->load->view('dashboard', $data);
		$this->loadFooter($data);	
	}
	
	public function upload_photo_profile()
	{
		// Define a destination
		$targetFolder = '/public/img/users/'; // Relative to the root

		if (!empty($_FILES)) {
			$tempFile = $_FILES['qqfile']['tmp_name'];
			$targetPath = $_SERVER['DOCUMENT_ROOT'] . $targetFolder;
			$extension = explode('.',$_FILES['qqfile']['name']);
			$num = count($extension)-1;
			$imgFile = mktime().'.'.$extension[$num];

			$targetFile = rtrim($targetPath,'/') . '/' . $imgFile;
			
			// Validate the file type
			$fileTypes = array('jpg','jpeg','gif','png'); // File extensions
			$fileParts = pathinfo($_FILES['qqfile']['name']);
			
			if (in_array($fileParts['extension'],$fileTypes)) {
				move_uploaded_file($tempFile,$targetFile);
				//echo $imgFile;

				$last_id = $this->Users_Model->insertProfilePicId($imgFile);

				$respuestaFile = true;
				$fileName = $imgFile;
				$mensajeFile = $imgFile;
				$success = array('success'=>true,'data'=>$imgFile);
				echo json_encode($success);
				
			} else {
				echo 'Invalid file type.';
			}
		}
	}

}

/* End of file front.php */
/* Location: ./application/controllers/front.php */