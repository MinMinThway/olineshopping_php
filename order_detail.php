<?php

  require 'backendheader.php';
  require 'db_connect.php';

    
    $order_id=$_GET['id'];
    //var_dump($order_id);die();

  // $sql="SELECT item_order.id,item_order.qty,item_order.order_id,
  //             items.name as itemame, items.description as itemdescription, 
  //             orders.voucherno as ordevoucher 
  //             FROM item_order  
  //             INNER JOIN items 
  //             ON item_order.order_id=items.id 
  //             INNER JOIN orders 
  //             ON item_order.order_id=orders.id WHERE order_id=:val";

    // $sql="SELECT item_order.id,item_order.qty,item_order.order_id, items.name as itemame, items.description as itemdescription,items.codeno ,orders.voucherno as ordevoucher,orders.total as subtotal FROM item_order INNER JOIN items ON item_order.order_id=items.id INNER JOIN orders ON item_order.order_id=orders.id WHERE order_id=:val";
    $sql=" SELECT orders.id AS orderid, orders.orderdate,orders.voucherno,orders.total,orders.status,
           item_order.qty,items.name,items.codeno,items.description 
          FROM orders INNER JOIN item_order ON orders.id=item_order.order_id 
          INNER JOIN items ON item_order.item_id=items.id 
          WHERE item_order.order_id=:val";

     $stmt=$conn->prepare($sql);

    $stmt->bindParam(":val",$order_id);


    $stmt->execute();

    //var_dump($order_id);die();

   $item_orders=$stmt->fetchAll();

   //var_dump($item_orders);die();


        date_default_timezone_set("Asia/Rangoon");
         $today=date('m/d/Y');
      //  $admin=$_SESSION['login_user'];

?>
      <div class="app-title">
        <div>
          <h1><i class="fa fa-file-text-o"></i> Invoice</h1>
          <p>A Printable Invoice Format</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="#">Invoice</a></li>
        </ul>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <section class="invoice">
              <div class="row mb-4">
                <div class="col-6">
                  <h2 class="page-header"><i class="fa fa-globe"></i> Vali Inc</h2>
                </div>
                <div class="col-6">
                  <h5 class="text-right"><?=$today?></h5>
                </div>
              </div>
              <div class="row invoice-info">
                <div class="col-4">From
                  <address><strong>Vali Inc.</strong><br>518 Akshar Avenue<br>Gandhi Marg<br>New Delhi<br>Email: hello@vali.com</address>
                </div>
                <div class="col-4">To
                  <address><strong>John Doe</strong><br>795 Folsom Ave, Suite 600<br>San Francisco, CA 94107<br>Phone: (555) 539-1037<br>Email: john.doe@example.com</address>
                </div>
                <div class="col-4"><b>Invoice #007612</b><br><br><b>Order ID:</b> 4F3S8J<br><b>Payment Due:</b> 2/22/2014<br><b>Account:</b> 968-34567</div>
              </div>
              <div class="row">
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
              <div class="row d-print-none mt-2">
                <div class="col-12 text-right"><a class="btn btn-primary" href="javascript:window.print();" target="_blank"><i class="fa fa-print"></i> Print</a></div>
              </div>
            </section>
          </div>
        </div>
      </div>
  <?php

  require 'backendfooter.php';

  ?>