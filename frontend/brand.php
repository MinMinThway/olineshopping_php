<?php

	require 'frontendheader.php';
	$id=$_GET['id'];

	$sql="SELECT * FROM items WHERE brand_id=:val";
	$stmt=$conn->prepare($sql);
	$stmt->bindParam(':val',$id);
	$stmt->execute();
	$discountitems=$stmt->fetchALL();
?>



	

	   <div class="container">
	   	<div class="row mt-5">
			<h1 class="text-center">Brandas</h1>
		</div>
	   		 <!-- Disocunt Item -->
		<div class="card jumbotron">
			<div class="card-body">
				<div class="row">
					<div class="col-12">
				<div class="MultiCarousel" data-items="1,3,5,6" data-slide="1" id="MultiCarousel"  data-interval="1000">
		            <div class="MultiCarousel-inner">

		            <?php
		            
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
			</div>
		</div>	
	   </div>

<?php

	
	require 'frontendfooter.php';


?>