<?php

	require 'db_connect.php';
	$start=$_POST['start'];
	$end=$_POST['end'];
	// var_dump($start);
	// var_dump($end);

	$sql="SELECT * FROM orders WHERE orderdate BETWEEN :value2 AND :value2";
	$stmt=$conn->prepare($sql);
	$stmt->bindParam(":value1",$start);
	$stmt->bindParam(":value2",$end);
	$stmt->execute();
	$searchResults=$stmt->fetchALL();
	echo json_encode($searchResults);



?>