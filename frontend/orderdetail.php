<?php

	require '../db_connect.php';
	require 'frontendheader.php';
	
	$id=$_GET['id'];

	 $sql="  SELECT orders.id AS orderid, orders.orderdate,orders.voucherno,orders.total,orders.status,
           item_order.qty,items.name,items.codeno,items.description 
      FROM orders INNER JOIN item_order ON orders.id=item_order.order_id 
      INNER JOIN items ON item_order.item_id=items.id 
      WHERE item_order.order_id=:val";

     $stmt=$conn->prepare($sql);
     $stmt->bindParam(":val",$id);
     $stmt->execute();
     $item_orders=$stmt->fetchAll();

     //var_dump($item_orders)

?>
	<div class="container">
      <div class="app-title">
        <div>
          <h1><i class="fa fa-file-text-o"></i> Invoice</h1>
          <p>A Printable Invoice Format</p>
        </div>
        
                <div class="col-12 table-responsive">
                  <table class="table table-striped">
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
                </div>
              </div>
              
        </div>
  <?php

  require 'frontendfooter.php';

  ?>