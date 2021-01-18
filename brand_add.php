<?php

	require 'db_connect.php';
	$name=$_POST['name'];
	$photo=$_FILES['photo'];

	$basepath='image/brand/';

	$fullpath=$basepath.$photo['name'];

	move_uploaded_file($photo['tmp_name'],$fullpath);

	$sql="INSERT INTO brands (name,photo) VALUES(:val1,:val2)";
	$stmt=$conn->prepare($sql);
	$stmt->bindParam(":val1",$name);
	$stmt->bindParam(":val2",$fullpath);


	$stmt->execute();

	header("location:brand_list.php");
?>