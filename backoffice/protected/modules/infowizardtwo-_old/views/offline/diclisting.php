<!-- BEGIN PAGE BAR -->

<div class="page-bar">

    <ul class="page-breadcrumb">

        <li>

            <a href="index.html">Home</a>

            <i class="fa fa-circle"></i>

        </li>

        <li>

            <span>Page Layouts</span>

        </li>

    </ul>

</div>

<!-- END PAGE HEADER-->





<div class="portlet light bordered">

   <div class="portlet-title">

      <div class="caption font-dark">

         <i class="icon-globe font-dark"></i>

         <span class="caption-subject bold uppercase">List of pending Offline Application </span>

      </div>

   </div>

   <div class="portlet-body">

        <table class="table table-striped table-bordered table-hover table-header-fixed dataTable no-footer" id="sample_2" role="grid" aria-describedby="sample_1_info">

           <thead>

               <tr>

	               <th>ID</th>
				   
				   <th>Application Reference No.</th>

	               <th>Application Name</th>

	               <th>Company Name</th>

	               <th>Submission Date</th>

	               <th>Department</th>

	               <th>Status</th>

	               <th>Action</th>

               </tr>

           </thead>

           <tbody>

            <?php 
			if(empty($allOfflineApplication)){

                echo "<tr><td colspan='5'>No Application Pending</td></tr>";



              }

              else{

                $count=1; $arr=array();

                foreach ($allOfflineApplication as $key => $data) {  // print_r($data); 
				  if(!in_array($data['offline_application_reference_number'],$arr)) { 
 if($data['offline_application_status']=="P") { 
                      $arr[]=$data['offline_application_reference_number']; 

				
				///////////////////////////////////////////////////////////////////////////////
				

                    $deptModel = new DepartmentsExt;            
                    $dept = $deptModel->getDeptbyId($data['dept_id']);   
				    $cc=$data['caf_id'];
					$caf=OfflineController::getCAFDetailAll($cc); 
					?>

                    <tr>

                             <td><?php echo $count++;  ?></td>

                             <td><?php echo $data['offline_application_reference_number']; ?> </td>

                             <td><?php echo $data['app_name']; ?> </td>

                             <td><?php  $val= json_decode($caf['field_value']); //print_r($val); 
							 $ddddd=(array)$val; if(!empty($ddddd['company_name'])){ echo $ddddd['company_name']; } //die; ?>  </td>

                             <td><?php echo date("D d/m/y h:i:s",strtotime($data['application_created_date'])); ?> </td>

                             <td><?php echo $dept['department_name']; ?>  </td>

                             <td> 
                   <?php if($data['offline_application_status']=="P") { ?> <span class='badge badge-info'>Pending</span><?php } ?>
                          
                      </td>

                             <td> <!--<a href='".Yii::app()->createAbsoluteUrl('/admin/ApplicationView/applicationfulldetail/app_sub_id/'.$vi['submission_id'])."' class='btn btn-xs btn-success' title='View Application'><i class='fa fa-eye'></i> view</a>-->
							 <a href="/backoffice/infowizard/offline/dicpanel/appID/<?php echo $data['offline_application_id']; ?>/serviceID/<?php echo $data['service_id']; ?>/subserviceID/<?php echo $data['sub_service_id']; ?>">View Application</a>
							 </td>

                          </tr>     

              <?php }  }  }  } ?>

           </tbody>

        </table>

   </div>

</div>

<?php

   $base=Yii::app()->theme->baseUrl;

?>

<!-- BEGIN PAGE LEVEL PLUGINS -->

<script src="<?=$base?>/assets/global/scripts/datatable.js" type="text/javascript"></script>

<script src="<?=$base?>/assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>

<script src="<?=$base?>/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>

<script src="<?=$base?>/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script>

<!-- END PAGE LEVEL PLUGINS -->

<!-- BEGIN PAGE LEVEL PLUGINS -->

<link href="<?=$base?>/assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />

<link href="<?=$base?>/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />

<!-- END PAGE LEVEL PLUGINS -->

<script type="text/javascript">

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

                     info: "Showing _START_ to _END_ of _TOTAL_ entries",

                     infoEmpty: "No entries found",

                     infoFiltered: "(filtered1 from _MAX_ total entries)",

                     lengthMenu: "_MENU_ entries",

                     search: "Search:",

                     zeroRecords: "No matching records found"

                 },

                 buttons: [{

                     extend: "print",

                     className: "btn dark btn-outline"

                 }, {

                     extend: "copy",

                     className: "btn red btn-outline"

                 }, {

                     extend: "pdf",

                     className: "btn green btn-outline"

                 }, {

                     extend: "excel",

                     className: "btn yellow btn-outline "

                 }, {

                     extend: "csv",

                     className: "btn purple btn-outline "

                 }, {

                     extend: "colvis",

                     className: "btn dark btn-outline",

                     text: "Columns"

                 }],

                 responsive: !0,

                 order: [

                     [0, "asc"]

                 ],

                 lengthMenu: [

                     [5, 10, 15, 20, -1],

                     [5, 10, 15, 20, "All"]

                 ],

                 pageLength: 10,

                 dom: "<'row' <'col-md-12'B>><'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r><'table-scrollable't><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>"

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

                     info: "Showing _START_ to _END_ of _TOTAL_ entries",

                     infoEmpty: "No entries found",

                     infoFiltered: "(filtered1 from _MAX_ total entries)",

                     lengthMenu: "_MENU_ entries",

                     search: "Search:",

                     zeroRecords: "No matching records found"

                 },

                 buttons: [{

                     extend: "print",

                     className: "btn default"

                 },  {

                     extend: "pdf",

                     className: "btn default"

                 }, {

                     extend: "excel",

                     className: "btn default"

                 }],

                 order: [

                     [0, "asc"]

                 ],

                 lengthMenu: [

                     [5, 10, 15, 20, -1],

                     [5, 10, 15, 20, "All"]

                 ],

                 pageLength: 10,

                 dom: "<'row' <'col-md-12'B>><'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r><'table-scrollable't><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>"

             })

         },

         a = function() {

             var e = $("#sample_3"),

                 t = e.dataTable({

                     language: {

                         aria: {

                             sortAscending: ": activate to sort column ascending",

                             sortDescending: ": activate to sort column descending"

                         },

                         emptyTable: "No data available in table",

                         info: "Showing _START_ to _END_ of _TOTAL_ entries",

                         infoEmpty: "No entries found",

                         infoFiltered: "(filtered1 from _MAX_ total entries)",

                         lengthMenu: "_MENU_ entries",

                         search: "Search:",

                         zeroRecords: "No matching records found"

                     },

                     buttons: [{

                         extend: "print",

                         className: "btn dark btn-outline"

                     }, {

                         extend: "copy",

                         className: "btn red btn-outline"

                     }, {

                         extend: "pdf",

                         className: "btn green btn-outline"

                     }, {

                         extend: "excel",

                         className: "btn yellow btn-outline "

                     }, {

                         extend: "csv",

                         className: "btn purple btn-outline "

                     }, {

                         extend: "colvis",

                         className: "btn dark btn-outline",

                         text: "Columns"

                     }],

                     responsive: !0,

                     order: [

                         // [0, "asc"]

                     ],

                     lengthMenu: [

                         [5, 10, 15, 20, -1],

                         [5, 10, 15, 20, "All"]

                     ],

                     pageLength: 10

                 });

             $("#sample_3_tools > li > a.tool-action").on("click", function() {

                 var e = $(this).attr("data-action");

                 t.DataTable().button(e).trigger()

             })

         },

         n = function() {

             $(".date-picker").datepicker({

                 rtl: App.isRTL(),

                 autoclose: !0

             });

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

                         [1, "asc"]

                     ],

                     buttons: [{

                         extend: "print",

                         className: "btn default"

                     }, {

                         extend: "copy",

                         className: "btn default"

                     }, {

                         extend: "pdf",

                         className: "btn default"

                     }, {

                         extend: "excel",

                         className: "btn default"

                     }, {

                         extend: "csv",

                         className: "btn default"

                     }, {

                         text: "Reload",

                         className: "btn default",

                         action: function(e, t, a, n) {

                             t.ajax.reload(), alert("Datatable reloaded!")

                         }

                     }]

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

             jQuery().dataTable && (e(), t(), a(), n())

         }

     }

   }();

   jQuery(document).ready(function() {

     TableDatatablesButtons.init()

   });

</script>