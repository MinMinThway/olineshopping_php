<?php

  require 'backendheader.php';
  require 'db_connect.php';

  date_default_timezone_set("Asia/Rangoon");
  $todaydate=date("Y-m-d");

  $orderStatus="Order";
  $confirmStatus="Confirm";
  $deleteStatus="Delete";

  $sql="SELECT * FROM orders WHERE orderdate=:value1 AND status=:value2 ORDER BY id DESC";
  $stmt=$conn->prepare($sql);
  $stmt->bindParam(":value1",$todaydate);
  $stmt->bindParam(":value2",$orderStatus);

  $stmt->execute();
  $pending_orders=$stmt->fetchAll();

  $sql="SELECT * FROM orders WHERE orderdate=:value1 AND status=:value2 ORDER BY id DESC";
  $stmt=$conn->prepare($sql);
  $stmt->bindParam(":value1",$todaydate);
  $stmt->bindParam(":value2",$confirmStatus);

  $stmt->execute();
  $confirm_orders=$stmt->fetchAll();


  $sql="SELECT * FROM orders WHERE orderdate=:value1 AND status=:value2 ORDER BY id DESC";
  $stmt=$conn->prepare($sql);
  $stmt->bindParam(":value1",$todaydate);
  $stmt->bindParam(":value2",$deleteStatus);

  $stmt->execute();
  $cancle_orders=$stmt->fetchAll();



?>

    <div class="app-title">
                <div>
                    <h1> <i class="icofont-list"></i> Order List </h1>
                </div>
                <ul class="app-breadcrumb breadcrumb side">
                    <a href="category_new.php" class="btn btn-outline-primary">
                        <i class="icofont-plus"></i>
                    </a>
                </ul>
            </div>
            <div class="row">
                <div class="col-md-12">
                  <div class="tile">
                    <h3 class="tile-title">History Order</h3>
                    <div class="tile-body">
                      <form class="row">
                        <div class="form-group col-md-5">
                          <label class="control-label">Start Date</label>
                          <input class="form-control" type="date" id="startDate">
                        </div>
                        <div class="form-group col-md-5">
                          <label class="control-label">End Date</label>
                          <input class="form-control" type="date" id="endDate">
                        </div>
                        <div class="form-group col-md-2 align-self-end">
                          <button class="btn btn-primary searchBtn" type="button">Search</button>
                        </div>
                      </form>
                    </div>
                  </div>




                    <div class="tile" id="todaylist">
                        <div class="tile-body">
                          <nav>
                              <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                <a class="nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-pending" aria-selected="true">Order Pending</a>
                                <a class="nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-confirm" aria-selected="false">Order-Confirm</a>
                                 <a class="nav-link" id="nav-cancle-tab" data-toggle="tab" href="#nav-cancle" role="tab" aria-controls="nav-delete" aria-selected="false">Order-Cancle</a>
   
                        </div>
                      </nav>
                                <div class="tab-content" id="nav-tabContent">
                                  <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                                     
                                       <div class="table-responsive">
                                                                <table class="table table-hover table-bordered display" >
                                                                    <thead>
                                                                        <tr>
                                                                          <th>#</th>
                                                                          <th>Voucherno</th>
                                                                          <th>Total</th>
                                                                          <th>Action</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                      <?php
                                                                      $i=1;
                                                                    //  var_dump($pending_orders);
                                                                        foreach ($pending_orders as $pending_order) {
                                                                          $pending_id=$pending_order['id'];
                                                                          $pending_voucherno=$pending_order['voucherno'];
                                                                          $pending_total=$pending_order['total'];
                                                                        ?>
                                                                        <tr>
                                                                          <td><?=$i++ ?></td>
                                                                          <td><?=$pending_voucherno ?></td>
                                                                          <td><?=$pending_total ?></td>
                                                                          <td>
                                                                            <a href="order_detail.php?id=<?=$pending_id ?>" class="btn btn-outline-info"><i class="icofont-info"></i></a>

                                                                            <a href="orderstatus_change.php?id=<?=$pending_id ?>&status=0" class="btn btn-outline-success"><i class="icofont-ui-check"></i></a>

                                                                            <a href="orderstatus_change.php?id=<?=$pending_id ?>&status=1" class="btn btn-outline-danger"><i class="icofont-close"></i></a>
                                                                                  
                                                                            </td>
                                                                        </tr>

                                                                      <?php } ?>
                                                                        
                                                                    </tbody>
                                                                </table>
                                                            </div>

                                  </div>
                                  <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                                        <div class="table-responsive">
                                                                <table class="table table-hover table-bordered display" >
                                                                    <thead>
                                                                        <tr>
                                                                          <th>#</th>
                                                                          <th>Voucherno</th>
                                                                          <th>Total</th>
                                                                          <th>Action</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                      <?php
                                                                      $i=1;
                                                                    //  var_dump($pending_orders);
                                                                        foreach ($confirm_orders as $confirm_order) {
                                                                          $confirm_id=$confirm_order['id'];
                                                                          $confirm_voucherno=$confirm_order['voucherno'];
                                                                          $confirm_total=$confirm_order['total'];
                                                                        ?>
                                                                        <tr>
                                                                          <td><?=$i++ ?></td>
                                                                          <td><?=$confirm_voucherno ?></td>
                                                                          <td><?=$confirm_total ?></td>
                                                                          <td>
                                                                            <a href="order_detail.php?id=<?=$confirm_id ?>" class="btn btn-outline-info"><i class="icofont-info"></i></a>

                                                                            <a href="" class="btn btn-outline-success"><i class="icofont-ui-check"></i></a>
                                                                           
                                                                                  
                                                                          </td>
                                                                        </tr>

                                                                      <?php } ?>
                                                                        
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                          </div>
                                                           <div class="tab-pane fade" id="nav-cancle" role="tabpanel" aria-labelledby="nav-cancle-tab">
                                                                <div class="table-responsive">
                                                                <table class="table table-hover table-bordered display">
                                                                    <thead>
                                                                        <tr>
                                                                          <th>#</th>
                                                                          <th>Voucherno</th>
                                                                          <th>Total</th>
                                                                          <th>Action</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                      <?php
                                                                      $i=1;
                                                                    //  var_dump($pending_orders);
                                                                        foreach ($cancle_orders as $cancle_order) {
                                                                          $cancle_id=$cancle_order['id'];
                                                                          $cancle_voucherno=$cancle_order['voucherno'];
                                                                          $cancle_total=$cancle_order['total'];
                                                                        ?>
                                                                        <tr>
                                                                          <td><?=$i++ ?></td>
                                                                          <td><?=$cancle_voucherno ?></td>
                                                                          <td><?=$cancle_total ?></td>
                                                                          <td>
                                                                         <a href="order_detail.php?id=<?=$cancle_id ?>" class="btn btn-outline-info"><i class="icofont-info"></i></a>  
                                                                            </td>
                                                                        </tr>

                                                                      <?php } ?>
                                                                        
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                  </div>
                                 
                                </div>


                            
                        </div>
                    </div>
                </div>
            </div>


<?php

  require 'backendfooter.php';

?>