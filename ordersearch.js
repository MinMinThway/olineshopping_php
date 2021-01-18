$(document).ready(function(){
	//alert("ok");
	$(".searchBtn").click(function(){
		//alert("ok");
	var startDate=$("#startDate").val();
	var endDate=$("#endDate").val();
	//console.log(startDate);
	// console.log(endDate);


	$.ajax({
		method:'POST',
		url:'order_search.php',
		data:{
			start:startDate,
			end:endDate
		},
		success:function(response){
			// console.log(response);
			// alert(response);
			var searchResults=JSON.parse(response);
			
			console.log(response);

			var showtable='';

			showtable+=` <div class="table-responsive">
                                                                
                                <table class="table table-hover table-bordered display" >
                                         <thead>
                                            <tr>
                                              <th>#</th>
                                               <th>Voucherno</th>
                                              <th>Date</th>
                                              <th>Total</th>
                                         	<th>Status</th>
                                         	<th>Action</th>
                                     </tr>
                             </thead>
                           <tbody>`;
                          var i=1;
                       $.each(searchResults,function(i,v){
                       	if(v){

                       		var id=v.id;
                       		var voucherno=v.voucherno;
                       		var total=v.total;
                       		var status=v.status;
                       		var date=v.orderdate;
                       		if (status=="Order") {
                       			var actionBtn=`<a href="order_detail.php?id=${id}" class="btn btn-outline-info"><i class="icofont-info"></i></a>

                                             <a href="orderstatus_change.php?id=${id}&status=0" class="btn btn-outline-success"><i class="icofont-ui-check"></i></a>

                                              <a href="orderstatus_change.php?id=${id}&status=1" class="btn btn-outline-danger"><i class="icofont-close"></i></a>`;



                       		}
                       		else
                       		{
                       			var actionBtn=`<a href="order_detail.php?id=${id}" class="btn btn-outline-info"><i class="icofont-info"></i></a> `;
                       		}

                       		$("#todaylist div.tile-body").hide();
                       		
      						showtable+=`
      									<tr>
      									<td> ${i++} </td>
      									<td>${voucherno}</td>
      									<td>${date}</td>
      									<td>${total}</td>
      									<td>${status}</td>
      									<td>${actionBtn}</td>
      									</tr>`                 		
                       	}
                       	$("#todaylist").html(showtable)
                       });



			showtable=`           
                       </tbody>
                     </table>
                  </div>`
			 
		  console.log(searchResults);
		}
	});
	
	});







$.ajax({
  type:'POST',
  url:'getEarning.php',
  success:function(response){
    var earningresult=JSON.parse(response);

 
   
      var data = {
        labels: ["January", "February", "March", "April", "May","June","July","August","September","Octber","November","December"],
        datasets: [
            {
                label: "My First dataset",
                fillColor: "rgba(220,220,220,0.2)",
                strokeColor: "rgba(220,220,220,1)",
                pointColor: "rgba(220,220,220,1)",
                pointStrokeColor: "#fff",
                pointHighlightFill: "#fff",
                pointHighlightStroke: "rgba(220,220,220,1)",
               data: [earningresult[0],earningresult[1],earningresult[2],
                      earningresult[3],earningresult[4],earningresult[5],earningresult[6],earningresult[7],
                      earningresult[8],earningresult[9],earningresult[10],earningresult[11]]

            }
        ]
      };
      // var pdata = [
      //   {
      //       value: 300,
      //       color: "#46BFBD",
      //       highlight: "#5AD3D1",
      //       label: "Complete"
      //   },
      //   {
      //       value: 50,
      //       color:"#F7464A",
      //       highlight: "#FF5A5E",
      //       label: "In-Progress"
      //   }
      // ]
      
      var ctxl = $("#lineChartDemo").get(0).getContext("2d");
      var lineChart = new Chart(ctxl).Line(data);
      
      // var ctxp = $("#pieChartDemo").get(0).getContext("2d");
      // var pieChart = new Chart(ctxp).Pie(pdata);
    
 }
})

	
	
})

