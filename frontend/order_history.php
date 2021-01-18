<?php
	
	require 'frontendheader.php';
	require '../db_connect.php';
	$user_id=$_SESSION['login_user']['id'];
	$sql="SELECT * FROM orders WHERE user_id=:value1 ORDER BY orderdate";

	$stmt=$conn->prepare($sql);
	$stmt->bindParam(":value1",$user_id);
	$stmt->execute();

	$orders=$stmt->fetchAll();
	//var_dump($orders);	
	// $sql="  SELECT orders.id AS orderid, orders.orderdate,orders.voucherno,orders.total,orders.status,
 //           item_order.qty,items.name,items.codeno,items.description 
 //      FROM orders INNER JOIN item_order ON orders.id=item_order.order_id 
 //      INNER JOIN items ON item_order.item_id=items.id 
 //      WHERE item_order.order_id=:val";

 //     $stmt=$conn->prepare($sql);

 //    $stmt->bindParam(":val",$order_id);
 //      $item_orders=$stmt->fetchAll();

  // var_dump($item_orders);die();



?>

		<div class="jumbotron jumbotron-fluid subtitle">
  		<div class="container">
    		<h1 class="text-center text-white"> Subcategory name </h1>
  		</div>
	</div>
	<div class="container">
		<div class="row">
			<?php  
				$i=1;
				foreach ($orders as $order) {
					$id=$order['id'];
					$orderdate=$order['orderdate'];
					$voucherno=$order['voucherno'];
					$total=$order['total'];
					$note=$order['note'];
					$status=$order['status'];
				//	$qty=$order['qty'];
			
			?>
			<div class="col-lg-4 col-md-6 col-sm-12 col-12 p-4">
				<div class="card">
					<div class="card-body">
						<h5 class="card-title"><?=$voucherno ?></h5>
						<h6 class="card-subtitle mb-2 text-muted"><?=$orderdate ?></h6>
						<p class="text-white card-text float-right">
							
					<?php if ($status=="Order") { ?>
							<span class="badge rounded-pill bg-warning" ><?=$status ?></span>
					<?php	} else if($status=="Delete") { ?>
								<span class="badge rounded-pill bg-danger" ><?=$status ?></span>
					<?php } else{ ?>
							<span class="badge rounded-pill bg-success" ><?=$status ?></span>
					<?php } ?>
							
						</p>
						<p><?=$total ?>Ks</p>
						<a href="orderdetail.php?id=<?= $id ?>"  class="card-link"> Detail </a>	<!--  -->
					</div>
				</div>
			</div>
		<?php 	} ?>
		</div>
	</div>



<!-- Modal -->
<!-- <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div> -->

<!-- <div class="modal" id="Modal">

	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h3>This is your order detail</h3>
				<button class="close" data-dismiss='modal'>
					<span>&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<p>
					<table border="1" cellpadding="10">
						<thead>
							<tr>
							<th>Id</th>
							<th>Date</th>
							<th>Voucherno</th>
							<th>Descrption</th>
							<th>Total</th>
						</tr>
						</thead>
						<thead>
                      <tr>

                        <th>Qty</th>
                        <th>Product</th>
                        <th>Serial #</th>
                        <th>Description</th>
                        <th>Subtotal</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php   
                        foreach ($item_orders as $item) {
                          $qty=$item['qty'];
                          $name=$item['name'];
                          $codeno=$item['codeno'];
                          $description=$item['description'];
                          $subtotal=$item['total'];
                       
                      ?>
                      <tr>
                        <td><?=$qty ?></td>
                        <td><?=$name?></td>
                        <td><?=$codeno?></td>
                       
                        <td><?=$description?></td>
                        <td><?=$subtotal?></td>

                      </tr>
                    <?php  } ?>
                    </tbody>
					</table>
				</p>
			</div>
			<div class="modal-footer">
				<button class="btn btn-danger " data-dismiss='modal'>Cancle</button>
				<button class="btn btn-info">Save</button>
			</div>
		</div>
	</div>
</div> -->

	
<?php 

	require 'frontendfooter.php';

?>