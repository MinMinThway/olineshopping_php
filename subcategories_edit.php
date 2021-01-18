<?php
    
    require 'backendheader.php';
     require 'db_connect.php';
    $sql="SELECT * FROM categories ORDER BY id DESC";
    $stmt=$conn->prepare($sql);
    $stmt->execute();

    $categories=$stmt->fetchALL();


    $id=$_GET['id'];
    $sql="SELECT * FROM  subcategories WHERE id=:value1";
    $stmt=$conn->prepare($sql);
    $stmt->bindParam(":value1",$id);
    $stmt->execute();
    $subcategories=$stmt->fetch(PDO::FETCH_ASSOC);

?>

 <main class="app-content">
            <div class="app-title">
                <div>
                    <h1> <i class="icofont-list"></i>Sub Category Edit Form </h1>
                </div>
                <ul class="app-breadcrumb breadcrumb side">
                    <a href="subcategories_list.php" class="btn btn-outline-primary">
                        <i class="icofont-double-left"></i>
                    </a>
                </ul>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="tile">
                        <div class="tile-body">
                            <form action="subcategories_update.php" method="POST" enctype="multipart/form-data">

                                <input type="hidden" name="id" value="<?=$subcategories['id']; ?>">
                                
                                <div class="form-group row">
                                    <label for="name_id" class="col-sm-2 col-form-label"> Name </label>
                                    <div class="col-sm-10">
                                      <input type="text" class="form-control" id="name_id" name="name" value="<?=$subcategories['name']; ?>">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="photo_id" class="col-sm-2 col-form-label"> Category </label>
                                    <div class="col-sm-10">
                                      <select class="form-control" name="category_id">
                                          <?php
                                            foreach ($categories as $category) {
                                                $id=$category['id'];
                                                $name=$category['name']
                                           
                                          ?>
                                          <option value="<?=$id; ?>"<?php if($id==$subcategories['category_id']) { echo "selected";} ?>><?=$name; ?></option>

                                      <?php } ?>
                                      </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-10">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="icofont-save"></i>
                                            Save
                                        </button>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </main>

<?php

    require 'backendfooter.php';

?>