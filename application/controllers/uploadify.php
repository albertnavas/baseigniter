<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Uploadify extends MY_Controller {
	
	public function index()
	{

		// Define a destination
		$targetFolder = '/photos/'; // Relative to the root

		if (!empty($_FILES)) {
			$tempFile = $_FILES['Filedata']['tmp_name'];
			$targetPath = $_SERVER['DOCUMENT_ROOT'] . $targetFolder;
			$targetFile = rtrim($targetPath,'/') . '/' . $_FILES['Filedata']['name'];
			
			// Validate the file type
			$fileTypes = array('jpg','jpeg','gif','png'); // File extensions
			$fileParts = pathinfo($_FILES['Filedata']['name']);
			
			if (in_array($fileParts['extension'],$fileTypes)) {
				move_uploaded_file($tempFile,$targetFile);
				echo '1';

				$last_id = $this->Userprofile_class->insertProfilePicId($imgFile);

				$respuestaFile = _('done');
				$fileName = $imgFile;
				$mensajeFile = $imgFile;
				$content = '{img_profile}'.$last_id.'{/img_profile}';

				$this->Posts_class->add($content, 0);
				
			} else {
				echo _('Invalid file type.');
			}
		}
	}
}