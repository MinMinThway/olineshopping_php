<?php

	require 'frontendheader.php';
	require '../db_connect.php';

	 $sql="SELECT * FROM categories ORDER BY rand() LIMIT 8";
    $stmt=$conn->prepare($sql);
    $stmt->execute();

    $categories=$stmt->fetchALL();

?>
	


<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
  		<ol class="carousel-indicators">
    		<li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
    		<li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
    		<li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
  		</ol>
  		
  		<div class="carousel-inner">
    		<div class="carousel-item active">
		      	<img src="image/banner/ac.jpg" class="d-block w-100 bannerImg" alt="...">
		    </div>
		    <div class="carousel-item">
		      	<img src="image/banner/giordano.jpg" class="d-block w-100 bannerImg" alt="...">
		    </div>
		    <div class="carousel-item">
		      	<img src="image/banner/garnier.jpg" class="d-block w-100 bannerImg" alt="...">
		    </div>
  		</div>
	</div>


	<!-- Content -->
	<div class="container mt-5 px-5">
		<!-- Category -->
		<div class="row">

			<?php

				foreach ($categories as $category) {
					$id=$category['id'];
					$name=$category['name'];
					$photo=$category['logo'];
				

			 ?>
			<div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 col-12 ">
				<div class="card categoryCard border-0 shadow-sm p-3 mb-5 rounded text-center">
				  	<img src="../<?=$photo ?>" width="160px" height="200px" class="card-img-top" alt="...">
				  	<div class="card-body">
				    	<p class="card-text font-weight-bold text-truncate"><?=$name ?></p>
				  	</div>
				</div>
			</div>


		<?php } ?>
		</div>

		<div class="whitespace d-xl-block d-lg-block d-md-none d-sm-none d-none"></div>
		
		<!-- Discount Item -->
		<div class="row mt-5">
			<h1> Discount Item </h1>
		</div>

	    <!-- Disocunt Item -->
		<div class="row">
			<div class="col-12">
				<div class="MultiCarousel" data-items="1,3,5,6" data-slide="1" id="MultiCarousel"  data-interval="1000">
		            <div class="MultiCarousel-inner">

		            <?php
		            
		            	$sql="SELECT * FROM items WHERE discount !='' ORDER BY rand() LIMIT 8";
		            	$stmt=$conn->prepare($sql);
		            	$stmt->execute();
		            	$discountitems=$stmt->fetchALL();
		            	foreach ($discountitems as $discountitem) {
		            		$di_id=$discountitem['id'];
		            		$di_name=$discountitem['name'];
		            		$di_price=$discountitem['price'];
		            		$di_codeno=$discountitem['codeno'];
		            		$di_discount=$discountitem['discount'];
		            		$di_photo=$discountitem['photo'];

		            ?>	

		                <div class="item">
		                    <div class="pad15">
		                    	<img src="../<?=$di_photo ?>" class="img-fluid">
		                        <p class="text-truncate"><?=$di_name ?></p>
		                        <p class="item-price">
		                        	<strike><?=$di_price ?> Ks </strike> 
		                        	<span class="d-block"><?=$di_discount ?> Ks</span>
		                        </p>

		                        <div class="star-rating">
									<ul class="list-inline">
										<li class="list-inline-item"><i class='bx bxs-star' ></i></li>
										<li class="list-inline-item"><i class='bx bxs-star' ></i></li>
										<li class="list-inline-item"><i class='bx bxs-star' ></i></li>
										<li class="list-inline-item"><i class='bx bxs-star' ></i></li>
										<li class="list-inline-item"><i class='bx bxs-star-half' ></i></li>
									</ul>
								</div>

								<a href="#" class="addtocartBtn text-decoration-none" data-id="<?=$di_id ?>" data-name="<?=$di_name?>" data-photo="<?=$di_photo?>" data-codeno="<?=$di_codeno ?>" data-discount="<?=$di_discount ?>" data-price="<?=$di_price ?>"
								>Add to Cart</a> <a href="itemdetail.php?id=<?php echo $di_id ?>"  class="btn btn-outline-primary my-3">Detail</a>

		                    </div>
		                </div>

		            <?php 	} ?>
		            </div>
		            <button class="btn btnMain leftLst"><</button>
		            <button class="btn btnMain rightLst">></button>
		        </div>
		    </div>
		</div>

		<!-- Flash Sale Item -->
		<div class="row mt-5">
			<h1> Flash Sale </h1>
		</div>

	    <!-- Flash Sale Item -->
		<div class="row">
			<div class="col-12">
				<div class="MultiCarousel" data-items="1,3,5,6" data-slide="1" id="MultiCarousel"  data-interval="1000">
		            <div class="MultiCarousel-inner">
		            	<?php
		            		$sql="SELECT * FROM items ORDER BY created_at   DESC lIMIT 8 ";
		            		$stmt=$conn->prepare($sql);
		            		$stmt->execute();
		            		$hotitems=$stmt->fetchALL();

		            		foreach ($hotitems as $hotitem) {
		            			$hot_id=$hotitem['id'];
		            			$hot_name=$hotitem['name'];
		            			$hot_price=$hotitem['price'];
		            			$hot_codeno=$hotitem['codeno'];
		            			$hot_discount=$hotitem['discount'];
		            			$hot_photo=$hotitem['photo'];
		            		
		            	 ?>
		                <div class="item">
		                    <div class="pad15">
		                    	<img src="../<?=$hot_photo ?>" class="img-fluid">
		                        <p class="text-truncate"><?=$hot_name ?></p>
		                        <?php  if($hot_discount) {?>

		                        	<p class="item-price">
		                        	<strike><?=$hot_price ?> Ks </strike> 
		                        	<span class="d-block"><?=$hot_discount ?> Ks</span>
		                        </p>
		                    <?php } else {?>
		                    		<span class="d-block"><?=$hot_price ?> Ks</span>
		                    	<?php } ?>

		                        <div class="star-rating">
									<ul class="list-inline">
										<li class="list-inline-item"><i class='bx bxs-star' ></i></li>
										<li class="list-inline-item"><i class='bx bxs-star' ></i></li>
										<li class="list-inline-item"><i class='bx bxs-star' ></i></li>
										<li class="list-inline-item"><i class='bx bxs-star' ></i></li>
										<li class="list-inline-item"><i class='bx bxs-star-half' ></i></li>
									</ul>
								</div>

								<a href="#" class="addtocartBtn text-decoration-none" data-id="<?=$hot_id ?>" data-name="<?=$hot_name?>" data-photo="<?=$hot_photo?>" data-codeno="<?=$hot_codeno ?>" data-discount="<?=$hot_discount ?>" data-price="<?=$hot_price ?>"
								>Add to Cart</a>
								<a href="itemdetail.php?id=<?php echo $hot_id ?>"  class="btn btn-outline-primary my-3">Detail</a>

		                    </div>
		                </div>
		               
		                <?php } ?>
		            </div>
		            <button class="btn btnMain leftLst"><</button>
		            <button class="btn btnMain rightLst">></button>
		        </div>
		    </div>
		</div>

		<!-- Random Catgory ~ Item -->
		<div class="row mt-5">
			<h1> Fresh Picks </h1>
		</div>

	    <!-- Random Item -->

				<div class="row">
			<div class="col-12">
				<div class="MultiCarousel" data-items="1,3,5,6" data-slide="1" id="MultiCarousel"  data-interval="1000">
		            <div class="MultiCarousel-inner">
		            	<?php
								
		            	$sql="SELECT * FROM items WHERE subcategory_id=90 ORDER BY rand() LIMIT 8";
									
		            		$stmt=$conn->prepare($sql);
		            		$stmt->execute();
		            		$hotitems=$stmt->fetchALL();

		            		foreach ($hotitems as $hotitem) {
		            			$hot_id=$hotitem['id'];
		            			$hot_name=$hotitem['name'];
		            			$hot_price=$hotitem['price'];
		            			$hot_codeno=$hotitem['codeno'];
		            			$hot_discount=$hotitem['discount'];
		            			$hot_photo=$hotitem['photo'];
		            		
		            	 ?>
		                <div class="item">
		                    <div class="pad15">
		                    	<img src="../<?=$hot_photo ?>" class="img-fluid">
		                        <p class="text-truncate"><?=$hot_name ?></p>
		                        <?php  if($hot_discount) {?>

		                        	<p class="item-price">
		                        	<strike><?=$hot_price ?> Ks </strike> 
		                        	<span class="d-block"><?=$hot_discount ?> Ks</span>
		                        </p>
		                    <?php } else {?>
		                    		<span class="d-block"><?=$hot_price ?> Ks</span>
		                    	<?php } ?>

		                        <div class="star-rating">
									<ul class="list-inline">
										<li class="list-inline-item"><i class='bx bxs-star' ></i></li>
										<li class="list-inline-item"><i class='bx bxs-star' ></i></li>
										<li class="list-inline-item"><i class='bx bxs-star' ></i></li>
										<li class="list-inline-item"><i class='bx bxs-star' ></i></li>
										<li class="list-inline-item"><i class='bx bxs-star-half' ></i></li>
									</ul>
								</div>

								<a href="#" class="addtocartBtn text-decoration-none" data-id="<?=$hot_id ?>" data-name="<?=$hot_name?>" data-photo="<?=$hot_photo?>" data-codeno="<?=$hot_codeno ?>" data-discount="<?=$hot_discount ?>" data-price="<?=$hot_price ?>"
								>Add to Cart</a>
								<a href="itemdetail.php?id=<?php echo $hot_id ?>"  class="btn btn-outline-primary my-3">Detail</a>

		                    </div>
		                </div>
		               
		                <?php } ?>
		            </div>
		            <button class="btn btnMain leftLst"><</button>
		            <button class="btn btnMain rightLst">></button>
		        </div>
		    </div>
		</div>	

		
		<div class="whitespace d-xl-block d-lg-block d-md-none d-sm-none d-none"></div>

	    <!-- Brand Store -->
	    <div class="row mt-5">
			<h1> Top Brand Stores </h1>
	    </div>

	    <!-- Brand Store Item -->
	    <section class="customer-logos slider mt-5">

	    	<?php

	    		$sql="SELECT * FROM brands ORDER BY rand() lIMIT 8";
	    		$stmt=$conn->prepare($sql);
	    		$stmt->execute();
	    		$brands=$stmt->fetchALL();
	    		foreach ($brands as $brand) {
	    			$name=$brand['name'];
	    			$photo=$brand['photo'];
	    		
	    	?>
	      	<div class="slide">
	      		<a href="../brand_list.php">
		      		<img src="../<?=$photo?>">
		      	</a>
	      	</div>
	      	
	      	<?php } ?>
	   	</section>

	    <div class="whitespace d-xl-block d-lg-block d-md-none d-sm-none d-none"></div>

	</div>

<?php

	require 'frontendfooter.php';


?>





