<?php


	require 'backendheader.php';
	require 'db_connect.php';
 date_default_timezone_set("Asia/Rangoon");

  $todaydate=date("Y-m-d");
  $sql="SELECT count(id) as ordertotal FROM orders WHERE orderdate=:value1";
  $stmt=$conn->prepare($sql);
  $stmt->bindParam(":value1",$todaydate);
  $stmt->execute();
  $orderCount=$stmt->fetch(PDO::FETCH_ASSOC);

	$role_id=2;
	$sql="SELECT count(users.id) as custmerTotal  FROM users INNER JOIN model_has_role ON users.id=model_has_role.user_id WHERE model_has_role.role_id=:value2";
	$stmt=$conn->prepare($sql);
	$stmt->bindParam(":value2",$role_id);
	$stmt->execute();
	$customerCount=$stmt->fetch(PDO::FETCH_ASSOC);

	//$id=2;
	$sql="SELECT count(brands.id) as totalbrand FROM brands ";
	$stmt=$conn->prepare($sql);
	$stmt->bindParam(':value3',$id);
	$stmt->execute();
	$brandCount=$stmt->fetch(PDO::FETCH_ASSOC);

	$sql="SELECT count(id) as itemtotal FROM items ";
	$stmt=$conn->prepare($sql);
	$stmt->bindParam(':value3',$id);
	$stmt->execute();
	$itemCount=$stmt->fetch(PDO::FETCH_ASSOC);

?>

	<div class="app-title">
        <div>
          <h1><<i class="icofont-dashboard"></i> Dashboard</h1>
         
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
        </ul>
      </div>
      <div class="row">
        <div class="col-md-6 col-lg-3">
         <div class="widget-small primary coloured-icon"><i class="icon icofont-shopify"></i></i>
            <div class="info">
              <h4>Today Orders</h4>
              <p><b><?=$orderCount['ordertotal'] ?></b></p>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-3">
         <div class="widget-small warnning coloured-icon"><i class="icon icofont-shopify"></i></i>
            <div class="info">
              <h4>Customner List</h4>
              <p class="text-center"><b><?=$customerCount['custmerTotal'] ?></b></p>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-3">
          <div class="widget-small info coloured-icon"><i class=" icon icofont-list"></i></i>
            <div class="info">
              <h4>Brands</h4>
              <p><b><?= $brandCount['totalbrand'] ?></b></p>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-3">
          <div class="widget-small danger coloured-icon"><i class="icon icofont-bucket"></i></i>
            <div class="info">
              <h4>Items</h4>
              <p><b><?=$itemCount['itemtotal'] ?></b></p>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <h3 class="tile-title">Monthly Sales</h3>
            <div class="embed-responsive embed-responsive-16by9">
              <canvas class="embed-responsive-item" id="lineChartDemo"></canvas>
            </div>
          </div>
        </div>
        <!-- <div class="col-md-6">
          <div class="tile">
            <h3 class="tile-title">Support Requests</h3>
            <div class="embed-responsive embed-responsive-16by9">
              <canvas class="embed-responsive-item" id="pieChartDemo"></canvas>
            </div>
          </div>
        </div> -->
      </div>

	
<?php

	require 'backendfooter.php';

?>