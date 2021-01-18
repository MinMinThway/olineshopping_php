 <?php

	require 'backendheader.php';
	require 'db_connect.php';
	//$sql="SELECT * FROM  items ORDER BY id DESC";
	$sql="SELECT items.*,brands.id as bid,brands.name as bname,subcategories.id as subid,subcategories.name as subname  FROM items INNER JOIN brands ON items.brand_id=brands.id JOIN  subcategories ON items.subcategory_id=subcategories.id ORDER BY id DESC";

    // $sql2="SELECT items.*,subcategories.id as subid,subcategories.name as subname FROM items LEFT JOIN subcategories ON items.brand_id=subcategories.id ORDER BY id DESC";
    $stmt=$conn->prepare($sql);
    //$stmt=$conn->prepare($sql2);
	$stmt->execute();
	$items=$stmt->fetchAll();
   // var_dump($items);die();

?>

	<div class="app-title">
                <div>
                    <h1> <i class="icofont-list"></i> Item List </h1>
                </div>
                <ul class="app-breadcrumb breadcrumb side">
                    <a href="item_new.php" class="btn btn-outline-primary">
                        <i class="icofont-plus"></i>
                    </a>
                </ul>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="tile">
                        <div class="tile-body">
                            <div class="table-responsive">
                                <table class="table table-hover table-bordered" id="sampleTable">
                                    <thead>
                                        <tr>
                                          <th>#</th>
                                          <th>Codeno</th>
                                          <th>Name</th>
                                          <th>Price</th>
                                          <th>Discount</th>
                                          <th>Description</th>
                                          <th>Brand </th>
                                          <th>Subcategories</th>
                                          <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    	<?php
                                    	$i=1;
                                    		foreach ($items as $item) {
                                    			$id=$item['id'];
                                                $codeno=$item['codeno'];
                                    			$name=$item['name'];
                                                $price=$item['price'];
                                                $discount=$item['discount'];
                                                $description=$item['description'];
                                                $bid=$item['brand_id'];
                                                $subid=$item['subcategory_id'];
                                                $bname=$item['bname'];
                                                $subname=$item['subname'];
                                    		
                                    	?>
                                        <tr>
                                            <td><?=$i++; ?></td>
                                            <td><?=$codeno; ?></td>
                                            <td><?php echo $name; ?></td>
                                            <td><?=$price ?></td>
                                            <td><?=$discount ?></td>
                                            <td><?=$description?></td>
                                            <td><?=$bname ?></td>
                                            <td><?=$subname ?></td>
                                           <td>
                                                <a href="item_edit.php?id=<?php echo $id; ?>" class="btn btn-warning">
                                                    <i class="icofont-ui-settings"></i>
                                                </a>

                                                <form action="item_delete.php" method="POST" class="d-inline-block" onsubmit="return confirm('Are you wnat to item_delete')">
                                                    <input type="hidden" name="id"  value="<?=$id ?>">
                                                    <button class="btn btn-outline-danger"><i class="icofont-close"></i></button>
                                                </form>
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

<?php

	require 'backendfooter.php';

?>