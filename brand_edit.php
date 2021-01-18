<?php

    
    require 'backendheader.php';
     require 'db_connect.php';
     $id=$_GET['id'];
     $sql="SELECT * FROM brands WHERE id=:value1";
     $stmt=$conn->prepare($sql);
     $stmt->bindParam(':value1',$id);
    $stmt->execute();
     $brands=$stmt->fetch(PDO::FETCH_ASSOC);
?>

    <main class="app-content">
            <div class="app-title">
                <div>
                    <h1> <i class="icofont-list"></i> Brand Edit  Form </h1>
                </div>
                <ul class="app-breadcrumb breadcrumb side">
                    <a href="brand_list.php" class="btn btn-outline-primary">
                        <i class="icofont-double-left"></i>
                    </a>
                </ul>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="tile">
                        <div class="tile-body">
                            <form action="brand_update.php" method="POST" enctype="multipart/form-data">
                                <input type="hidden" name="id" value="<?php echo $brands['id'] ?>">
                                <input type="hidden" name="oldphoto" value="<?=$brands['photo']; ?>">
                                
                                <div class="form-group row">
                                    <label for="name_id" class="col-sm-2 col-form-label"> Name </label>
                                    <div class="col-sm-10">
                                      <input type="text" class="form-control" id="name_id" name="name" value="<?=$brands['name']; ?>">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="photo_id" class="col-sm-2 col-form-label"> Photo </label>
                                    <div class="col-sm-10">
                                    
                                    <nav>
                                      <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                        <a class="nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Profile</a>
                                        <a class="nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">New Profile</a>
                                       
                                      </div>
                                    </nav>
                                    <div class="tab-content" id="nav-tabContent">
                                      <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                                          <img src="<?=$brands['photo']; ?>" class="img-fluid" name="oldphoto">
                                      </div>
                                      <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                                            <input type="file" id="photo_id" name="photo">
                                      </div>
                                     
                                    </div>


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