<?php
$file = $_FILES['fotoPaciente'];
		$file['name']; //name of the uploaded file 
		$file['tmp_name']; //name of the file in the temporary storage

move_uploaded_file($file["tmp_name"], "aaa"); //move files
?>