<?php

	$dbserver='localhost';
	$dbname='olineshop';
	$user='root';
	$password='';
	$dsn="mysql:host=$dbserver;dbname=$dbname";

	$pdo= new PDO($dsn,$user,$password);

	try{

		$conn=$pdo;
		$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

	}catch(PDOException  $e){
		echo "not connected".$e->getMessage;
	}

?>