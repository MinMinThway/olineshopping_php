<?php


	session_start();
	require '../db_connect.php';
	$email=$_POST['email'];
	$password=$_POST['password'];

	$sql="SELECT users.*,model_has_role.role_id,roles.name as rolename

	FROM users INNER JOIN model_has_role ON users.id=model_has_role.user_id
	INNER JOIN roles ON model_has_role.role_id=roles.id WHERE email=:value1 AND password=:value2";
	$stmt=$conn->prepare($sql);
	$stmt->bindParam(":value1",$email);
	$stmt->bindParam(":value2",$password);
	$stmt->execute();

	$user=$stmt->fetch(PDO::FETCH_ASSOC);

	if ($stmt->rowCount() <= 0 ) {//data tar ma par yin 
		$_SESSION['login_fail'] = 'Your current email and password is invalid.';

		header('location:login.php');
	}

	// success
	else{
		$_SESSION['login_user'] = $user;

		if ($user['rolename'] == "admin") {
			header('location:../dishboard.php');
		}
		else{
			header('location:index.php');
		}
	}


?>