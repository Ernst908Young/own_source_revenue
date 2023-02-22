<title>Download Documents</title>
<?php

if((isset($_SESSION) && !empty($_SESSION['uid'])) || (isset($_SESSION['RESPONSE']['user_id'])))
{   
    $basePath="/themes/investuk";
?>


<div class="dashboard-home">
    <div class="applied-status" >
        <ul class="breadcrumb">
            <?php if(isset($_SESSION['role_id'])){ ?>
                <li><a href="/panchayatiraj/backoffice/admin">Home</a></li>
          <?php }else{ ?>
                <li><a href="/panchayatiraj/backoffice/investor/home/investorWalkthrough">Home</a></li>
           <?php } ?>
          
       
          <li>Download Documents</li>
          </ul>
    



        <table class="table table-striped table-bordered table-hover" >
            <?php 
            if($srn_no != '')
            {            
            ?>
                <tr>
                    <td><b>Service</b></td>
                    <td><?php echo $app_details['core_service_name']; ?></td>
                    <td><b>SRN No.</b></td>
                    <td><?php echo $srn_no ?></td>
                </tr>
              
                
            <?php 
            } 
            ?>          
           
        </table>


        <table id="sample_2" width="100%">
            <thead>
                <tr>
                    <th  class="text-center">
                    S.No.
                    </th>
                    <th  class="text-center">Document Name</th>
                    <th  class="text-center">Description of Document</th>
                    <th  class="text-center">Date and time</th>
                    <th  class="text-center">Action item</th>                   
                  
                </tr>
            </thead>
            <tbody class="ticket-item">
               <?php
                if (empty($documents)) {

                    echo "<tr><td colspan='5'>No Document Uploaded</td></tr>";
                } else { 
                    
                   
                    foreach($documents as $key => $val) 
                    {                        
                       
                        ?>

                             <tr class="ticket-row tableinside" id="<?php echo $key; ?>">
                                <td class="text-center"><?php echo $key+1; ?></td>
                                <td class="text-center">
                                	<?= $val['name'] ?>
                                </td>
                                <td class="text-center">  
                                                         
                                 <?= $val['usercomment'] ?>
                                </td>
                                <td class="text-center">
                                   <?= $val['created_on'] ? date('d-m-Y | H:i',strtotime($val['created_on'])) : "" ?>
                                </td>
                                                         
                                <td class='text-center'>
                                	<!--  <a target="_blank" href="/backoffice/doc/mydoc?view=<1?php echo DefaultUtility::getDockey($val['document_file_name']); ?>"style="color:blue;">
                                             Open 
                                            </a>  
                                            | -->
	                                <a target="_blank" href="/panchayatiraj/backoffice/investor/documentManagement/previewdoc?doc_map_id=<?php echo $val['mapping_id']; ?>"style="color:blue;">
	                                               <img src="<?php echo $basePath; ?>/assets/applicant/images/print-icon.png">
	                                </a>                                
                                </td>                      
                            </tr>
                        <?php
                        

                    }

                }
                ?>       
               
            </tbody>
        </table>    

</div>
</div>
<?php
}else{
    echo "You are unauthorised to access this url"; 
}
$base=Yii::app()->theme->baseUrl;

?>

<!-- BEGIN PAGE LEVEL PLUGINS -->

<script src="<?=$base?>/assets/global/scripts/datatable.js" type="text/javascript"></script>

<script src="<?=$base?>/assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>

<script src="<?=$base?>/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>

<!-- <script src="<?=$base?>/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script>


<link href="<?=$base?>/assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />

<link href="<?=$base?>/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" /> -->

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

                    info: "<span style='font-size:15px'>Showing _START_ to _END_ of _TOTAL_ entries</span>",
                    infoEmpty: "<span style='font-size:15px'>No entries found</span>",
                    infoFiltered: "<span style='font-size:15px'>(filtered1 from _MAX_ total entries)</span>",
                    lengthMenu: "<span style='font-size:15px; font-weight:100; margin-top:5px;'>Entries:</span>  <span style='margin-left:5px;'>_MENU_ </span>",
                    search: "<span style='font-size:15px; font-weight:100; margin-top:5px;'>Search:</span>",

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

                     [0, "asc"]

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

             var e = $("#sample_3"),

                 t = e.dataTable({

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

            /* $(".date-picker").datepicker({

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

     TableDatatablesButtons.init();
     /* $("#sample_2_length").find("label").attr('style','font-size:15px; font-weight:100;');
    $("#sample_2_length").find("select").attr("style","width:50px; margin-left:5px;");

    $("#sample_2_filter").find("label").attr('style','font-size:15px; font-weight:100;');
    $("#sample_2_filter").find("input").attr("placeholder",'Search by keywords');
    $("#sample_2_info").attr("style","font-size:15px; margin-top:10px;");
    $("#sample_2_paginate").attr("style",'margin-top:15px;');*/

   });

</script>

