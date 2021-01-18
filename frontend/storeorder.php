<?php

	session_start();
	require '../db_connect.php';
	$itemlists=$_POST['itemlist'];
	$note=$_POST['note'];
	$total=$_POST['total'];
	//var_dump($total);die();

	date_default_timezone_set("Asia/Rangoon");
	$orderdate=date("Y-m-d");
	$status="Order";
	$voucherno=strtotime(date("h:m:s"));
	$user_id=$_SESSION['login_user']['id'];

	$sql="INSERT INTO orders (orderdate,voucherno,total,note,status,user_id) VALUES (:value1,:value2,:value3,:value4,:value5,:value6)";
	
	$stmt=$conn->prepare($sql);
	$stmt->bindParam(":value1",$orderdate);
	$stmt->bindParam(":value2",$voucherno);
	$stmt->bindParam(":value3",$total);
	$stmt->bindParam(":value4",$note);
	$stmt->bindParam(":value5",$status);
	$stmt->bindParam(":value6",$user_id);

	//var_dump($status);

	$stmt->execute();

	$orderid=$conn->LastInsertId();
	foreach ($itemlists as $itemlist) {
		$id=$itemlist['id'];
		$qty=$itemlist['qty'];

		$sql="INSERT INTO item_order(qty,item_id,order_id)VALUES (:value1,:value2,:value3)";

		$stmt=$conn->prepare($sql);
		$stmt->bindParam(":value1",$qty);
		$stmt->bindParam(":value2",$id);
		$stmt->bindParam(":value3",$orderid);

		$stmt->execute();

	}


?>