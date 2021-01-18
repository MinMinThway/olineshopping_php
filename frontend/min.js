$(document).ready(function(){
	//alert('lslsl');
	 showdata();
	 cartnoti();
	 price();
	$(".addtocartBtn").click(function(){
		alert("Do you want to select item");

		var id=$(this).data('id');
		var name=$(this).data('name');
		var codeno=$(this).data('codeno');
		var photo=$(this).data('photo');
		var disprice=$(this).data('discount');
		var price=$(this).data('price');
	

		  var item={
			id:id,
			name:name,
			photo:photo,
			codeno:codeno,
			disprice:disprice,
			price:price,
			qty:1

		}
		console.log(item);

		//console.log(name);
		var itemlist=localStorage.getItem('item');
		var itemArray;

		if(itemlist==null)
		{
			itemArray=[];
		}
		else
		{
			itemArray=JSON.parse(itemlist)
		}


		var status=false;
			itemArray.forEach( function(v, i) {
				if(id==v.id){
					v.qty++
					status=true;
				}
				// console.log(id);
				// console.log(v.id);


			});

			if(status==false){
				itemArray.push(item);
			}


	//itemArray.push(item);

		
		var itemString=JSON.stringify(itemArray);
		localStorage.setItem('item',itemString);
		showdata();
		cartnoti();
		price();
	})

	function showdata(){
		itemlist=localStorage.getItem('item');
		var html="";
		if(itemlist){

			var itemArray=JSON.parse(itemlist);

			
		//	var html2="";
			var subtotal=0;
			var total=0;
			itemArray.forEach(function(v,i){
				if (v.disprice) {
					subtotal=v.qty*v.disprice;
				}
				else
				{
					subtotal=v.qty*v.price;
				}
				//console.log(total);
				total+=subtotal;
				html+=`<tr>
							<td>
								<button class="btn btn-outline-danger remove btn-sm" style="border-radius: 50%"> 
									<i class="icofont-close-line"></i> 
								</button> 
							</td>
							<td> 
								<img src="../${v.photo}" width="170px" height="200px">						
							</td>
							<td> 
								<p>${v.name}</p>
								<p>${v.codeno}</p>
							</td>
							<td>
								<button class="btn btn-outline-secondary plus_btn" data-id="${i}"> 
									<i class="icofont-plus"></i> 
								</button>
							</td>
							<td>
								<p> ${v.qty}</p>
							</td>
							<td>
								<button class="btn btn-outline-secondary minus_btn" data-id="${i}"> 
									<i class="icofont-minus"></i>
								</button>
							</td>
							<td>`
								if (v.disprice) {
									html+=` <p class="text-danger"> 
												${v.disprice} Ks
											</p>
											<p class="font-weight-lighter"> 
											<del> ${v.price} Ks </del> </p> `
								}
								else
								{
									html+=` <p class="text-danger"> 
									${v.price} Ks </p> `
								
								}
							html+=`<td>
								${subtotal} Ks
							</td>
						</tr>`

			});


			html+=`<tr>
							<td colspan="8">
								<h3 class="text-right"> Total :${total} Ks </h3>
							</td>
						</tr>`
						

			$("#shoppingcart_table").html(html);



			//$("#shoppingcart_tfoot").html(htm2);
			
		}else
		{
			var html=`<div class="row mt-5 noneshoppingcart_div text-center">
			
			<div class="col-12">
				<h5 class="text-center"> There are no items in this cart </h5>
			</div>

			<div class="col-12 mt-5 ">
				<a href="categories" class="btn btn-secondary mainfullbtncolor px-3" > 
					<i class="icofont-shopping-cart"></i>
					Continue Shopping 
				</a>
			</div>

		</div>`;
			$('#noCart').html(html);
			$('#hasCart').attr('style',"display:none");
		}
	}

	function cartnoti(){

		var id=$(this).data('id');
		var itemlist=localStorage.getItem('item');
		if(itemlist){
			var itemArray=JSON.parse(itemlist);
			var total=0;
			itemArray.forEach(function(v,i){
					total+=v.qty;
			})
		}
		$(".cartNoti").html(total);
	}
	function price(){

		var id=$(this).data('id');
		var itemlist=localStorage.getItem('item');
		if(itemlist){
			var itemArray=JSON.parse(itemlist);
			var total=0;
			itemArray.forEach(function(v,i){
					// total+=v.qty*v.disprice;
					if (v.disprice) {

						total+=v.qty*v.disprice;
					}
					else
					{
						total+=v.qty*v.price;
					}
			})
		}
		$(".priceNoti").html(total);

	}
	$("#shoppingcart_table").on('click','.plus_btn',function(){
		//alert("ok");
				var id=$(this).data('id');
				//alert(id);
				var itemlist=localStorage.getItem("item");
				if(itemlist){
					var itemArray=JSON.parse(itemlist);

					
				itemArray.forEach( function(v, i) {

					if(i==id){
						// alert("ok");
						v.qty++;
					}
					});

					var itemString=JSON.stringify(itemArray);
					localStorage.setItem('item',itemString);
			showdata();
			cartnoti();
			price();
		}
	});

	$("#shoppingcart_table").on('click','.minus_btn',function(){
				//alert("ok");

				var id=$(this).data('id');
				var itemlist=localStorage.getItem('item');

				if(itemlist){
					var itemArray=JSON.parse(itemlist);

					itemArray.forEach(function(v,i){
						if(i==id){
							v.qty--;

							if(v.qty==0){
							itemArray.splice(id, 1);
						}
						}
					});

					var itemString=JSON.stringify(itemArray);
					localStorage.setItem('item',itemString);
					showdata();
					cartnoti();
					price();
				}
			});

	$(".remove").click(function(){
		
		var id=$(this).data('id');
		//alert(id);
		var itemlist=localStorage.getItem('item');
		if (itemlist) {
			var itemArray=JSON.parse(localStorage.getItem('item'));
			itemArray.splice(id,1);
			localStorage.setItem('item',JSON.stringify(itemArray));
			showdata();
			cartnoti();
			price();
		}
	});


	$(".checkoutbtn").click(function(){
		//alert("ok");
		var itemlist=localStorage.getItem('item');
		var note=$("#notes").val();
		var total=0;

		var itemArray=JSON.parse(itemlist);

		$.each(itemArray,function(i,v){

			if (v.disprice) {
					subtotal=v.qty*v.disprice;
				}
				else
				{
					subtotal=v.qty*v.price;
				}
				//console.log(total);
				total+=subtotal;
		});
		console.log(total);

		$.post('storeorder.php',
		{
			itemlist:itemArray,
			note:note,
			total:total
		},function(response){
			localStorage.clear();
			location.href="ordersuccess.php";
		});


	})




});