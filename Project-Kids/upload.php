<?php
       session_start();
		$link = mysqli_connect("localhost","root","","user");
if (!$link) {
	die("Connection failed: " . mysqli_connect_error());
}


	foreach ($_FILES['upload']['name'] as $key => $name){

		 $newFilename = time() . "_" . $name;
		 move_uploaded_file($_FILES['upload']['tmp_name'][$key], 'upload/' . $newFilename);
		$location = 'upload/' . $newFilename;

		
	}
	header('location:editprofiles.php');
?>

