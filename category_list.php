<?php

	require 'backendheader.php';
    require 'db_connect.php';
    $sql="SELECT * FROM categories ORDER BY id DESC";
    $stmt=$conn->prepare($sql);
    $stmt->execute();

    $categories=$stmt->fetchALL();

?>

	<div class="app-title">
                <div>
                    <h1> <i class="icofont-list"></i> Category </h1>
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
                        <div class="tile-body">
                            <div class="table-responsive">
                                <table class="table table-hover table-bordered" id="sampleTable">
                                    <thead>
                                        <tr>
                                          <th>#</th>
                                          <th>Name</th>
                                          <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php
                                        $i=1;
                                            foreach ($categories as $catagory) {
                                                $id=$catagory['id'];
                                                $name=$catagory['name'];
                                           

                                        ?>
                                        <tr>
                                            <td><?php echo $i++; ?></td>
                                            <td><?=$name; ?></td>
                                            <td>
                                                <a href="category_edit.php?id=<?php echo $id ?>" class="btn btn-warning">
                                                    <i class="icofont-ui-settings"></i>
                                                </a>

                                                <!-- <a href="" class="btn btn-outline-danger">
                                                    <i class="icofont-close"></i>
                                                </a> -->
                                            <form action="category_delete.php" method="POST" class="d-inline-block" onsubmit="return confirm('Are you sure want to delete')">
                                                <input type="hidden" name="id" value="<?=$id ?>">

                                                <button class="btn -btn-outline-danger"><i class="icofont-close"></i></button>
                                                
                                            </form>  
                                            </td>

                                        </tr>
                                    <?php  } ?>
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