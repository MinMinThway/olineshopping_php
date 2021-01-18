<?php

	session_start();
	require '../db_connect.php';
	$name=$_POST['name'];
	$phone=$_POST['phone'];
	$address=$_POST['address'];
	$email=$_POST['email'];
	$password=$_POST['password'];
	$confirmpassword=$_POST['confirm'];


	$role=2;

	$sql="INSERT INTO users (name,phone,address,email,password) VALUES(:value1,:value2,:value3,:value4,:value5)";

	$stmt=$conn->prepare($sql);
	$stmt->bindParam(":value1",$name);
	$stmt->bindParam(":value2",$phone);
	$stmt->bindParam(":value3",$address);
	$stmt->bindParam(":value4",$email);
	 $stmt->bindParam(":value5",$password);
	// $stmt->bindParam(":value6",$confirmpassword);
	// if ($password!=$confirmpassword) {
		
	// 	header("location:register.php");
	// }
	// else
	// {
	// 	$stmt->bindParam(":value5",$password);
	// }
	$stmt->execute();

	$user_id=$conn->lastInsertId();
	$sql="INSERT INTO model_has_role(user_id,role_id) VALUES(:value1,:value2)";
	$stmt=$conn->prepare($sql);
	$stmt->bindParam(":value1",$user_id);
	$stmt->bindParam(":value2",$role);

	$stmt->execute();

	$_SESSION['regsuccess']='Yes,It is not easy ,but you did it!Please signin Againg';

	header("location:login.php");

?>

				