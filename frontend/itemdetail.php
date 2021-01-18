<?php
	 require 'frontendheader.php';
	require '../db_connect.php';
	$sql="SELECT * FROM brands ORDER BY id DESC";
    $stmt=$conn->prepare($sql);
    $stmt->execute();
    $brands=$stmt->fetchAll();

    $sql2="SELECT * FROM subcategories ORDER BY id DESC";
    $stmt2=$conn->prepare($sql2);
    $stmt2->execute();

    $subcategories=$stmt2->fetchALL();


   	$id=$_GET['id'];

  	$sql="	SELECT items.*,brands.id as bid,brands.name as bname From items INNER JOIN brands ON items.brand_id=brands.id 
			WHERE items.id=:val";
  
    $stmt=$conn->prepare($sql);
    $stmt->bindParam(":val",$id);
    $stmt->execute();

    $items=$stmt->fetch(PDO::FETCH_ASSOC);
  
   	// var_dump($items);
   	// die();
?>
	
	<!-- Subcategory Title -->
	<div class="jumbotron jumbotron-fluid subtitle">
  		<div class="container">
    		<h1 class="text-center text-white"> Code Number </h1>
  		</div>
	</div>
	
	<!-- Content -->
	<div class="container">

		<!-- Breadcrumb -->
		<nav aria-label="breadcrumb ">
		  	<ol class="breadcrumb bg-transparent">
		    	<li class="breadcrumb-item">
		    		<a href="#" class="text-decoration-none secondarycolor"> Home </a>
		    	</li>
		    	<li class="breadcrumb-item">
		    		<a href="#" class="text-decoration-none secondarycolor"> Category </a>
		    	</li>
		    	<li class="breadcrumb-item">
		    		<a href="#" class="text-decoration-none secondarycolor"> Category Name </a>
		    	</li>
		    	<li class="breadcrumb-item active" aria-current="page">
					Subcategory Name
		    	</li>
		  	</ol>
		</nav>

		<div class="row mt-5">
						
			<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
				<img src="../<?=$items['photo'] ?>" class="img-fluid">
			</div>	


			<div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 col-12">
				<h4><?=$items['name'] ?></h4>

				<div class="star-rating">
					<ul class="list-inline">
						<li class="list-inline-item"><i class='bx bxs-star' ></i></li>
						<li class="list-inline-item"><i class='bx bxs-star' ></i></li>
						<li class="list-inline-item"><i class='bx bxs-star' ></i></li>
						<li class="list-inline-item"><i class='bx bxs-star' ></i></li>
						<li class="list-inline-item"><i class='bx bxs-star-half' ></i></li>
					</ul>
				</div>

				<!-- <p>
					Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
					tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
					quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
					consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
					cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
					proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
				</p> -->



				<p><?=$items['description']; ?></p>

				<p> 


					<span class="text-uppercase "> Current Price : </span>
					<span class="maincolor ml-3 font-weight-bolder"><?=$items['price']?>Ks </span>
				</p>
				<p> 
					<span class="text-uppercase "> Brand : </span>

					<span class="ml-3"> <a href="" class="text-decoration-none text-muted"><?=$items['bname'] ?></a> </span>
				</p>


				<!-- <a href="#" class="addtocartBtn text-decoration-none">
					<i class="icofont-shopping-cart mr-2"></i> Add to Cart
				</a> -->

				<a href="#" class="addtocartBtn text-decoration-none" 
				data-id="<?=$items['id'] ?>" 
				data-name="<?=$items['name']?>" 
				data-photo="<?=$items['photo']?>" 
				data-codeno="<?=$items['codeno'] ?>" 
				data-discount="<?=$items['discount'] ?>" 
				data-price="<?=$items['price']?>"
								>Add to Cart</a>
				
			</div>
		</div>

		<div class="row mt-5">
			<div class="col-12">
				<h3> Related Item </h3>
				<hr>
			</div>
			

			<div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
				<a href="">
					<img src="image/item/saisai_two.jpg" class="img-fluid">
				</a>
			</div>

			<div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
				<a href="">
					<img src="image/item/saisai_three.jpg" class="img-fluid">
				</a>
			</div>

			<div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
				<a href="">
					<img src="image/item/saisai_four.jpg" class="img-fluid">
				</a>
			</div>

			<div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
				<a href="">
					<img src="image/item/saisai_four.jpg" class="img-fluid">
				</a>
			</div>
		</div>

		
	</div>
	

<?php
	
	require 'frontendfooter.php'

?>
