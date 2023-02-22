<title>Dashboard</title>
<?php
$role_id = $_SESSION['role_id'];
//print_r(); die();
$userId = $_SESSION['uid'];
//$disctrict_id = $_SESSION['disctrict_id'];
$baseUrl = Yii::app()->theme->baseUrl;
$basePath="/themes/investuk";

?>


<div style="text-align:center;font-size:16px;color:green;">
<?php
  foreach(Yii::app()->user->getFlashes() as $key => $message) {
    echo '<div class="flash-' . $key . '">' . $message . "</div>\n";
  }

  
?>
</div>

<div class="dashboard-home">

   <div class="applied-status">
       <div class="row">
            <div id="tickettab" class="my-5">
                <ul>
                    <!-- <li><a href="#pa" id="palink">District Wise Report</a></li> -->
                    <li><a href="#fa" id="falink">Grampanchayat Report</a></li>
                    <li><a href="#aa" id="falink">Asset Wise Report</a></li>
                    <!-- <li><a href="#df" id="falink">District Wise Forcasting</a></li> -->
                    <li><a href="#gf" id="falink">Grampanchayat Wise Forcasting</a></li>
                </ul>
            
			<!-- <div id="pa">

				<br><br>
				<div>Dashboard</div><br><br>
				<h5>Demand|Collection|Pending For FY 2022-2023</h5>
				<div class="row">
					<div class="col-md-6">
					<canvas id="bargraph1" height="200" width="0"></canvas>   
					</div> 
					<div class="col-md-6">
						<canvas id="piegraph1"></canvas>
					</div>
				</div>
			
				<div id="sample_2_wrapper" class="dataTables_wrappers dataTables_wrapper"> <br>
					<table width="100%" id='sample_2'>
					<thead>
						<tr>
						<th  class="text-center">Sr. No.</th>
						<th  class="text-center">District Name</th>
						<th  class="text-center">Total Grampanchayat Count</th>
						<th  class="text-center">Total Asset Count</th>
						<th  class="text-center">Total Demand</th>
						<th  class="text-center">Total Collection</th>
						<th  class="text-center">Pending Amount</th>
						</tr> 
					</thead>
					
						<tbody class="ticket-item">

						<tr class="ticket-row tableinside">
								<td class="text-center">1</td>
								<td class="text-center">Kapurthala</td>  
								<td class="text-center">190</td>  
								<td class="text-center">50</td> 
								<td class="text-center">60000</td>  
								<td class="text-center">7000</td> 
								<td class="text-center">8080</td> 
							</tr> 
							<tr class="ticket-row tableinside">
								<td class="text-center">2</td>
								<td class="text-center">XYZ2</td>   
								<td class="text-center">19</td>   
								<td class="text-center">70</td>   
								<td class="text-center">80000</td>   
								<td class="text-center">60000</td>   
								<td class="text-center">20000</td>   
							</tr>
							<tr class="ticket-row tableinside">
								<td class="text-center">2</td>
								<td class="text-center">XYZ3</td>   
								<td class="text-center">19</td>   
								<td class="text-center">70</td>   
								<td class="text-center">80000</td>   
								<td class="text-center">20000</td>   
								<td class="text-center">60000</td>   
							</tr>
					
					</tbody> 
					</table>
				</div>
		
			</div> -->

			<div id="fa"> <br><br>
				<div>Dashboard</div><br><br>
				<h5>Demand|Collection|Pending For FY 2022-2023</h5>
				<div class="row">
					<div class="col-md-8">
						<canvas id="piegraph2" height="300" width="0"></canvas>
					</div>
				</div>  
				<div id="sample_1_wrapper" class="dataTables_wrappers dataTables_wrapper">
					<table width="100%" id='sample_1'>
						<thead>
							<tr>
							<th  class="text-center">Sr. No.</th>
							<th  class="text-center">Grampanchayat Name</th>
							<th class="text-center">Total Asset Count</th>
							<th class="text-center">Total Demand(₹)</th>
							<th  class="text-center">Total Collection(₹)</th>
							<th  class="text-center">Pending Amount(₹)</th>
							</tr> 

						</thead>
			
						<tbody class="ticket-item">
							<tr class="ticket-row tableinside">
								<td class="text-center">1</td>
								<td class="text-center">Kapurthala</td>
								<td class="text-center">200</td>
								<td class="text-center">30000</td>
								<td class="text-center">4000</td>
								<td class="text-center">40000</td>
							</tr>
							<!-- <tr class="ticket-row tableinside">
								<td class="text-center">2</td>
								<td class="text-center">XYZ2</td>
								<td class="text-center">200</td>
								<td class="text-center">30000</td>
								<td class="text-center">4000</td>
								<td class="text-center">40000</td>
							</tr>
							<tr class="ticket-row tableinside">
								<td class="text-center">3</td>
								<td class="text-center">XYZ3</td>
								<td class="text-center">200</td>
								<td class="text-center">30000</td>
								<td class="text-center">20000</td>
								<td class="text-center">10000</td>
							</tr> -->
						
						</tbody>
					</table>  
				</div>
            </div>

			<div id="aa"> <br><br>
				<div>Dashboard</div><br><br>
				<h5>Demand|Collection|Pending For FY 2022-2023</h5>
				<div class="row"> 
					
					<div class="col-md-6">
						<canvas id="piegraph3" height="300" width="0"></canvas>
					</div>
				</div>   
				<div id="sample_3_wrapper" class="dataTables_wrappers dataTables_wrapper">
					<table width="100%" id='sample_3'>
						<thead>
							<tr>
							<th  class="text-center">Sr. No.</th>
							<th  class="text-center">Grampanchayat Name</th>
							<th  class="text-center">Asset Name</th>
							<th class="text-center">Total Demand(₹)</th>
							<th  class="text-center">Total Collection(₹)</th>
							<th  class="text-center">Pending Amount(₹)</th>
							</tr> 

						</thead>
		
						<tbody class="ticket-item">
							<tr class="ticket-row tableinside">
								<td class="text-center">1</td>
								<td class="text-center">Kapurthala</td>
								<td class="text-center">Asset 1</td>
								<td class="text-center">800000</td>
								<td class="text-center">200000</td>
								<td class="text-center">600000</td>
								</tr>
								<tr class="ticket-row tableinside">
								<td class="text-center">2</td>
								<td class="text-center">Kapurthala</td>
								<td class="text-center">Asset 2</td>
								<td class="text-center">900000</td>
								<td class="text-center">300000</td>
								<td class="text-center">600000</td>
								</tr>
								<tr class="ticket-row tableinside">
								<td class="text-center">3</td>
								<td class="text-center">Kapurthala</td>
								<td class="text-center">Asset 3</td>
								<td class="text-center">700000</td>
								<td class="text-center">300000</td>
								<td class="text-center">400000</td>
								</tr>
						
						</tbody>
					</table>  
				</div>
			</div>

			<!-- <div id="df"> <br><br>
				<div>Dashboard</div><br><br>
				<h5>Demand|Collection|Pending For FY 2023-2024</h5>
				<div class="row">
				<div class="col-md-6">
						<canvas id="bargraph4" height="300" width="0"></canvas>
					</div>
					<div class="col-md-6">
						<canvas id="piegraph4" height="300" width="0"></canvas>
					</div>
				</div>   
				<div id="sample_4_wrapper" class="dataTables_wrappers dataTables_wrapper">
					<table width="100%" id='sample_4'>
						<thead>
							<tr>
							<th  class="text-center">Sr. No.</th>
							<th  class="text-center">Grampanchayat Name</th>
							<th  class="text-center">Asset Name</th>
							<th class="text-center">Total Demand</th>
							<th  class="text-center">Total Collection</th>
							<th  class="text-center">Pending Amount</th>
							</tr> 

						</thead>
				
						<tbody class="ticket-item">
							<tr class="ticket-row tableinside">
								<td class="text-center">1</td>
								<td class="text-center">XYZ</td>
								<td class="text-center">Asset 1</td>
								<td class="text-center">700000</td>
								<td class="text-center">300000</td>
								<td class="text-center">400000</td>
								</tr>
								<tr class="ticket-row tableinside">
								<td class="text-center">2</td>
								<td class="text-center">XYZ</td>
								<td class="text-center">Asset 2</td>
								<td class="text-center">1500000</td>
								<td class="text-center">700000</td>
								<td class="text-center">800000</td>
								</tr>
								<tr class="ticket-row tableinside">
								<td class="text-center">3</td>
								<td class="text-center">XYZ3</td>
								<td class="text-center">Asset 3</td>
								<td class="text-center">1700000</td>
								<td class="text-center">1300000</td>
								<td class="text-center">1400000</td>
								</tr>
						
						</tbody>
					</table>  
				</div>
			</div> -->

			<div id="gf"> <br><br>
				<div>Dashboard</div><br><br>
				<h5>Demand|Collection|Pending For FY 2023-2024</h5>
				<div class="row">
				<div class="col-md-6">
						<canvas id="bargraph5" height="300" width="0"></canvas>
					</div> 
					<div class="col-md-6">
						<canvas id="piegraph5" height="300" width="0"></canvas>
					</div>
				</div>   
				<div id="sample_5_wrapper" class="dataTables_wrappers dataTables_wrapper">
					<table width="100%" id='sample_5'>
						<thead>
							<tr>
							<th  class="text-center">Sr. No.</th>
							<th  class="text-center">Grampanchayat Name</th>
							<th  class="text-center">Asset Name</th>
							<th class="text-center">Total Demand(₹)</th>
							<th  class="text-center">Total Collection(₹)</th>
							<th  class="text-center">Pending Amount(₹)</th>
							</tr> 

						</thead>
				
						<tbody class="ticket-item">
							<tr class="ticket-row tableinside">
								<td class="text-center">1</td>
								<td class="text-center">Kapurthala</td>
								<td class="text-center">Asset 1</td>
								<td class="text-center">700000</td>
								<td class="text-center">300000</td>
								<td class="text-center">400000</td>
								</tr>
								<tr class="ticket-row tableinside">
								<td class="text-center">2</td>
								<td class="text-center">Kapurthala</td>
								<td class="text-center">Asset 2</td>
								<td class="text-center">500000</td>
								<td class="text-center">100000</td>
								<td class="text-center">400000</td>
								</tr>
								<tr class="ticket-row tableinside">
								<td class="text-center">3</td>
								<td class="text-center">Kapurthala</td>
								<td class="text-center">Asset 3</td>
								<td class="text-center">900000</td>
								<td class="text-center">300000</td>
								<td class="text-center">600000</td>
							</tr>
						
						</tbody>
					</table>  
				</div>
			</div>
       </div>
    </div>

       
</div>
 </div>
<?php

   $base=Yii::app()->theme->baseUrl;

?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>

<script src="<?=$base?>/assets/global/scripts/datatable.js" type="text/javascript"></script>

<script src="<?=$base?>/assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>

<script src="<?=$base?>/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>

<!-- <script src="<?=$base?>/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script> -->

<!-- END PAGE LEVEL PLUGINS -->

<!-- BEGIN PAGE LEVEL PLUGINS -->

<!-- <link href="<?=$base?>/assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />

<link href="<?=$base?>/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" /> -->

<!-- END PAGE LEVEL PLUGINS -->

<script type="text/javascript">
    var xValues =["Total Demand","Total Collection","Pending Amount"];
  
    var yValues = ["100000","60000","70000"];     

    var barColors =["Red","Green","Yellow"]; 

  var bargraph1 = new Chart("bargraph1", {
  type: "bar",
  data: {
    labels: xValues,
    datasets: [{
      backgroundColor: barColors,
      data: yValues
    }]
  },
  options: { 
    legend: {display: false},
    title: {
      display: true,
      text: ""
    },
    scales: {
           yAxes: [ {
          display: true,
          scaleLabel: {
            display: true,
            labelString: ''
          }
        } ]
          },
           animation: {
      onComplete: function() {       
       // console.log(bargraph.toBase64Image());
        
      /*  document.getElementById('barshow').src = bargraph.toBase64Image();*/
      }
    }
  }
});
</script>

<script type="text/javascript">
   
    var xValues =["Total Demand","Total Collection","Pending Amount"];
    var yValues = ["100000","60000","70000"]; 
    var barColors =["Red","Green","Blue"]; 

    var piegraph1 =  new Chart("piegraph1", {
      type: "pie",
      data: {
        labels: xValues,
        datasets: [{
         backgroundColor: barColors,
          data: yValues
        }]
      },
      options: {

          /*legend:{
            display:true,
            position:'right',

        },*/
        title: {
          display: true,
          text: ""
        },
         animation: {
          onComplete: function() {       
                   
          }
        }
      }
    });
</script>


<script type="text/javascript">
   
    var xValues =["Total Demand","Total Collection","Pending Amount"];
    var yValues = ["100000","60000","70000"]; 
    var barColors =["Yellow","Green","Blue"]; 

    var piegraph2 =  new Chart("piegraph2", {
      type: "pie",
      data: {
        labels: xValues,
        datasets: [{
         backgroundColor: barColors,
          data: yValues
        }]
      },
      options: {

          /*legend:{
            display:true,
            position:'right',

        },*/
        title: {
          display: true,
          text: ""
        },
         animation: {
          onComplete: function() {       
            $("#piechartdata2").val(piegraph2.toBase64Image());       
          }
        }
      }
    });
</script>






<script type="text/javascript">
   
    var xValues =["Total Demand","Total Collection","Pending Amount"];
    var yValues = ["100000","60000","70000"]; 
    var barColors =["Red","Green","Blue"]; 

    var piegraph3 =  new Chart("piegraph3", {
      type: "pie",
      data: {
        labels: xValues,
        datasets: [{
         backgroundColor: barColors,
          data: yValues
        }]
      },
      options: {

          /*legend:{
            display:true,
            position:'right',

        },*/
        title: {
          display: true,
          text: ""
        },
         animation: {
          onComplete: function() {       
            $("#piechartdata").val(piegraph3.toBase64Image());       
          }
        }
      }
    });
</script>

<script type="text/javascript">
    var xValues =["Total Demand","Total Collection","Pending Amount"];
  
    var yValues = ["800000","60000","70000"];     

    var barColors =["Red","Green","Pink"]; 

  var bargraph4 = new Chart("bargraph4", {
  type: "bar",
  data: {
    labels: xValues,
    datasets: [{
      backgroundColor: barColors,
      data: yValues
    }]
  },
  options: { 
    legend: {display: false},
    title: {
      display: true,
      text: ""
    },
    scales: {
           yAxes: [ {
          display: true,
          scaleLabel: {
            display: true,
            labelString: ''
          }
        } ]
          },
           animation: {
      onComplete: function() {       
       // console.log(bargraph.toBase64Image());
        
      /*  document.getElementById('barshow').src = bargraph.toBase64Image();*/
      }
    }
  }
});
</script>

<script type="text/javascript">
   
    var xValues =["Total Demand","Total Collection","Pending Amount"];
	var yValues = ["800000","60000","70000"];     

	var barColors =["Red","Green","Pink"]; 

    var piegraph4 =  new Chart("piegraph4", {
      type: "pie",
      data: {
        labels: xValues,
        datasets: [{
         backgroundColor: barColors,
          data: yValues
        }]
      },
      options: {

          /*legend:{
            display:true,
            position:'right',

        },*/
        title: {
          display: true,
          text: ""
        },
         animation: {
          onComplete: function() {       
                   
          }
        }
      }
    });
</script>
<script type="text/javascript">
    var xValues =["Total Demand","Total Collection","Pending Amount"];
    var yValues = ["6000000","400000","700000"]; 
    var barColors =["Red","Orange","Blue"]; 

  var bargraph5 = new Chart("bargraph5", {
  type: "bar",
  data: {
    labels: xValues,
    datasets: [{
      backgroundColor: barColors,
      data: yValues
    }]
  },
  options: { 
    legend: {display: false},
    title: {
      display: true,
      text: ""
    },
    scales: {
           yAxes: [ {
          display: true,
          scaleLabel: {
            display: true,
            labelString: ''
          }
        } ]
          },
           animation: {
      onComplete: function() {       
       // console.log(bargraph.toBase64Image());
        
      /*  document.getElementById('barshow').src = bargraph.toBase64Image();*/
      }
    }
  }
});
</script>

<script type="text/javascript">
   
    var xValues =["Total Demand","Total Collection","Pending Amount"];
    var yValues = ["6000000","400000","700000"]; 
    var barColors =["Red","Orange","Blue"]; 

    var piegraph5 =  new Chart("piegraph5", {
      type: "pie",
      data: {
        labels: xValues,
        datasets: [{
         backgroundColor: barColors,
          data: yValues
        }]
      },
      options: {

          /*legend:{
            display:true,
            position:'right',

        },*/
        title: {
          display: true,
          text: ""
        },
         animation: {
          onComplete: function() {       
                   
          }
        }
      }
    });
</script>

<script type="text/javascript">

  function tabchange(id){
    $("#"+id).trigger('click');
  }

   var TableDatatablesButtons = function() {

     var e = function() {

             var e = $("#sample_1");

             e.dataTable({

                 language: {

                     aria: {

                         sortAscending: ": activate to sort column ascending",

                         sortDescending: ": activate to sort column descending"

                     },

                     emptyTable: "No data available in table",

                    info: "<span style='font-size:15px'>Showing _START_ to _END_ of _TOTAL_ entries</span>",
                    infoEmpty: "<span style='font-size:15px'>No entries found</span>",
                    infoFiltered: "<span style='font-size:15px'>(filtered1 from _MAX_ total entries)</span>",
                    lengthMenu: "<span style='font-size:15px; font-weight:100; margin-top:5px;'>Entries:</span>  <span style='margin-left:5px;'>_MENU_ </span>",
                    search: "<span style='font-size:15px; font-weight:100; margin-top:5px;'>Search:</span>",

                     zeroRecords: "No matching records found"

                 },

                 buttons: [],
                 order: [

                     [1, "desc"]

                 ],

                 lengthMenu: [

                     [5, 10, 15, 20, -1],

                     [5, 10, 15, 20, "All"]

                 ],

                 pageLength: 10,

                  dom: "<'row'<'col-md-6 col-sm-12 form-group'l><'col-md-6 col-sm-12 form-group'f>r><'mb-3't><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>"

             })

         },

         t = function() {

             var e = $("#sample_2");

             e.dataTable({

                 language: {

                     aria: {

                         sortAscending: ": activate to sort column ascending",

                         sortDescending: ": activate to sort column descending"

                     },

                     emptyTable: "No data available in table",

                    info: "<span style='font-size:15px'>Showing _START_ to _END_ of _TOTAL_ entries</span>",
                    infoEmpty: "<span style='font-size:15px'>No entries found</span>",
                    infoFiltered: "<span style='font-size:15px'>(filtered1 from _MAX_ total entries)</span>",
                    lengthMenu: "<span style='font-size:15px; font-weight:100; margin-top:5px;'>Entries:</span>  <span style='margin-left:5px;'>_MENU_ </span>",
                    search: "<span style='font-size:15px; font-weight:100; margin-top:5px;'>Search:</span>",

                     zeroRecords: "No matching records found"

                 },

                 buttons: [],

                 order: [

                     [1, "desc"]

                 ],

                 lengthMenu: [

                     [5, 10, 15, 20, -1],

                     [5, 10, 15, 20, "All"]

                 ],

                 pageLength: 10,

                 dom: "<'row'<'col-md-6 col-sm-12 form-group'l><'col-md-6 col-sm-12 form-group'f>r><'mb-3't><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>"

             })

         },

a = function() {

             var e = $("#sample_3");

             e.dataTable({

                 language: {

                     aria: {

                         sortAscending: ": activate to sort column ascending",

                         sortDescending: ": activate to sort column descending"

                     },

                     emptyTable: "No data available in table",

                    info: "<span style='font-size:15px'>Showing _START_ to _END_ of _TOTAL_ entries</span>",
                    infoEmpty: "<span style='font-size:15px'>No entries found</span>",
                    infoFiltered: "<span style='font-size:15px'>(filtered1 from _MAX_ total entries)</span>",
                    lengthMenu: "<span style='font-size:15px; font-weight:100; margin-top:5px;'>Entries:</span>  <span style='margin-left:5px;'>_MENU_ </span>",
                    search: "<span style='font-size:15px; font-weight:100; margin-top:5px;'>Search:</span>",

                     zeroRecords: "No matching records found"

                 },

                 buttons: [],

                 order: [

                     [1, "desc"]

                 ],

                 lengthMenu: [

                     [5, 10, 15, 20, -1],

                     [5, 10, 15, 20, "All"]

                 ],

                 pageLength: 10,

                 dom: "<'row'<'col-md-6 col-sm-12 form-group'l><'col-md-6 col-sm-12 form-group'f>r><'mb-3't><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>"

             })

         },
		 
	aa = function() {

	var dff= $("#sample_4");

	dff.dataTable({

		language: {

			aria: {

				sortAscending: ": activate to sort column ascending",

				sortDescending: ": activate to sort column descending"

			},

			emptyTable: "No data available in table",

		info: "<span style='font-size:15px'>Showing _START_ to _END_ of _TOTAL_ entries</span>",
		infoEmpty: "<span style='font-size:15px'>No entries found</span>",
		infoFiltered: "<span style='font-size:15px'>(filtered1 from _MAX_ total entries)</span>",
		lengthMenu: "<span style='font-size:15px; font-weight:100; margin-top:5px;'>Entries:</span>  <span style='margin-left:5px;'>_MENU_ </span>",
		search: "<span style='font-size:15px; font-weight:100; margin-top:5px;'>Search:</span>",

			zeroRecords: "No matching records found"

		},

		buttons: [],

		order: [

			[1, "desc"]

		],

		lengthMenu: [

			[5, 10, 15, 20, -1],

			[5, 10, 15, 20, "All"]

		],

		pageLength: 10,

		dom: "<'row'<'col-md-6 col-sm-12 form-group'l><'col-md-6 col-sm-12 form-group'f>r><'mb-3't><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>"

	})

	},
	aaa = function() {

var gff = $("#sample_5");

gff.dataTable({

	language: {

		aria: {

			sortAscending: ": activate to sort column ascending",

			sortDescending: ": activate to sort column descending"

		},

		emptyTable: "No data available in table",

	info: "<span style='font-size:15px'>Showing _START_ to _END_ of _TOTAL_ entries</span>",
	infoEmpty: "<span style='font-size:15px'>No entries found</span>",
	infoFiltered: "<span style='font-size:15px'>(filtered1 from _MAX_ total entries)</span>",
	lengthMenu: "<span style='font-size:15px; font-weight:100; margin-top:5px;'>Entries:</span>  <span style='margin-left:5px;'>_MENU_ </span>",
	search: "<span style='font-size:15px; font-weight:100; margin-top:5px;'>Search:</span>",

		zeroRecords: "No matching records found"

	},

	buttons: [],

	order: [

		[1, "desc"]

	],

	lengthMenu: [

		[5, 10, 15, 20, -1],

		[5, 10, 15, 20, "All"]

	],

	pageLength: 10,

	dom: "<'row'<'col-md-6 col-sm-12 form-group'l><'col-md-6 col-sm-12 form-group'f>r><'mb-3't><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>"

})

},
         

         n = function() {

           /*  $(".date-picker").datepicker({

                 rtl: App.isRTL(),

                 autoclose: !0

             });*/

             var e = new Datatable;

             e.init({

                 src: $("#datatable_ajax"),

                 onSuccess: function(e, t) {},

                 onError: function(e) {},

                 onDataLoad: function(e) {},

                 loadingMessage: "Loading...",

                 dataTable: {

                     bStateSave: !0,

                     lengthMenu: [

                         [10, 20, 50, 100, 150, -1],

                         [10, 20, 50, 100, 150, "All"]

                     ],

                     pageLength: 10,

                     ajax: {

                         url: "../demo/table_ajax.php"

                     },

                     order: [

                         [1, "desc"]

                     ],

                     buttons: []

                 }

             }), e.getTableWrapper().on("click", ".table-group-action-submit", function(t) {

                 t.preventDefault();

                 var a = $(".table-group-action-input", e.getTableWrapper());

                 "" != a.val() && e.getSelectedRowsCount() > 0 ? (e.setAjaxParam("customActionType", "group_action"), e.setAjaxParam("customActionName", a.val()), e.setAjaxParam("id", e.getSelectedRows()), e.getDataTable().ajax.reload(), e.clearAjaxParams()) : "" == a.val() ? App.alert({

                     type: "danger",

                     icon: "warning",

                     message: "Please select an action",

                     container: e.getTableWrapper(),

                     place: "prepend"

                 }) : 0 === e.getSelectedRowsCount() && App.alert({

                     type: "danger",

                     icon: "warning",

                     message: "No record selected",

                     container: e.getTableWrapper(),

                     place: "prepend"

                 })

             }), $("#datatable_ajax_tools > li > a.tool-action").on("click", function() {

                 var t = $(this).attr("data-action");

                 e.getDataTable().button(t).trigger()

             })

         };

     return {

         init: function() {

             jQuery().dataTable && (e(), t(), n(), a(), aa(), aaa())

         }

     }

   }();

   jQuery(document).ready(function() {

     TableDatatablesButtons.init();

   
    /*$("#sample_2_filter").find("input").attr("placeholder",'Search by keywords');
 
    $("#sample_1_filter").find("input").attr("placeholder",'Search by keywords');*/
 

   });

</script>

<script>  
        $(function() {  
           $( "#tickettab" ).tabs();  
        });  
         function categchang(sc_id){
           var url = "<?php echo Yii::app()->createUrl('/admin/default/index') ?>";
           var param = '/sc_id/'+sc_id;
       window.location.href = url+param; 
    }
     </script> 