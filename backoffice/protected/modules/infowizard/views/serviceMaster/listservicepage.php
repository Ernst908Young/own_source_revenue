<div class="dashboard-home">
   <div class="applied-status">
        <div class="status-title d-flex flex-wrap align-items-center justify-content-between">
            <h4>Services Listing Page</h4>
         <a class="btn-primary" tabindex="0" href="<?=$this->createUrl('/infowizard/serviceMaster/servicepage/')?>"><span>Add New Service </span></a>
        </div>
     <style type="text/css">
tr:nth-child(even) {
           background-color: #f2f2f2;
      }
       
    </style>
        <div id="sample_2_wrapper" class="dataTables_wrappers dataTables_wrapper">
<table width="100%" id='sample_2'>


            <thead>
            <tr>
                <th>S.No.</th>
				<th>State/<br />Central</th>
				<th>Department Name</th>
                <th>Service Name</th>
				
				
                <th>Created On</th>
                 <th >Action</th>
               
            </tr>
            </thead>
            <tbody>
            <?php
			/* echo "<pre>";
			print_r($apps);die(); */
              if(empty($apps)){
                echo "<tr><td colspan='8'>No Data Found</td></tr>";

              }
              else{
                $count=1;  //   	   
                foreach ($apps as $key => $apps) {
                    ?>
                    <tr>
                <td align="center"><?=$count++;?></td>
				<td><?php  $dist_lable=$apps['central_state']; if($dist_lable==2) { echo "State"; } else { echo "Central";}?></td>
                <td><?php  $issuername=serviceMasterController::getNameOfIssuerBy($apps['issuerby_id']); echo $issuername['name'];  ?></td>
				
				<td><?php echo $apps['service_name'];  ?></td>
				
               
				<td><?php echo date('d-m-Y',strtotime($apps['created']));  ?></td>
                         <td>
                             <a style="color: blue;" href="<?php echo Yii::app()->createAbsoluteUrl('infowizard/serviceMaster/serviceupdate/serviceID/'.$apps['id'].'')?>" > Major form</a>

                             <a href="#" class="services_list" data-bs-toggle="modal" data-bs-service_id="<?php echo $apps['id']; ?>" data-bs-target="#subServiceTagMapping">Module-Service Mapping </a>
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
</div>  

 <?php
$base=Yii::app()->theme->baseUrl;
?>

   <!-- BEGIN PAGE LEVEL PLUGINS -->
        <script src="<?=$base?>/assets/global/scripts/datatable.js" type="text/javascript"></script>
        <script src="<?=$base?>/assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
        <script src="<?=$base?>/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>
      
        <!-- END PAGE LEVEL PLUGINS -->
    <script type="text/javascript">
  
  var TableDatatablesButtons = function() {
   
        t = function() {
            var e = $("#sample_2");

            e.dataTable({
                scrollX: true,
                language: {
                    aria: {
                        sortAscending: ": activate to sort column ascending",
                        sortDescending: ": activate to sort column descending"
                    },
                    emptyTable: "No data available in table",
                    info: "Showing _START_ to _END_ of _TOTAL_ entries",
                    infoEmpty: "No entries found",
                    infoFiltered: "(filtered1 from _MAX_ total entries)",
                    lengthMenu: "Entries: _MENU_ ",
                    search: "Search:",
                    zeroRecords: "No matching records found"
                },
                 "fnDrawCallback": function( oSettings ) {
                    //alert( 'DataTables has redrawn the table' );
                    $(".services_list").click(function(){
                     var service_id = $(this).data("service_id");
                         $.ajax({

                               type: "POST",
                               url: "<?php echo Yii::app()->request->baseUrl; ?>/infowizard/subServiceTagMapping/subServicelist",

                               data:{service_id: service_id},
                               success:  function(data) { //alert(data);
                                $('#sub_service_name_list').html('');
                                $('#sub_service_name_list').html(data);

                               },
                               complete: function (data) {
                                       submitme();
                               }
                                   });


                               });
                  },
                buttons: [],
               order: [
                    [0, "desc"]
                ],
                lengthMenu: [
                    [5, 10, 15, 20, -1],
                    [5, 10, 15, 20, "All"]
                ],
                pageLength: 10,
                  dom: "<'row' <'col-md-12'B>><'row'<'col-md-6 col-sm-12 form-group'l><'col-md-6 col-sm-12 form-group'f>r><''t><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>"
            })
        },
        n = function() {
           /*  $(".date-picker").datepicker({
               rtl: App.isRTL(),
                autoclose: !0
            }); */
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
            jQuery().dataTable && (t(),n())
        }
    }
}();
jQuery(document).ready(function() {
    TableDatatablesButtons.init();
     $("#sample_2_length").find("label").attr('style','font-size:15px; font-weight:100;');
    $("#sample_2_length").find("select").attr("style","width:50px; margin-left:5px;");

    $("#sample_2_filter").find("label").attr('style','font-size:15px; font-weight:100;');
    $("#sample_2_filter").find("input").attr("placeholder",'Search by keywords');
    $("#sample_2_info").attr("style","font-size:15px; margin-top:10px;");
    $("#sample_2_paginate").attr("style",'margin-top:15px;');

   

});
</script>

<script>

    jQuery(document).ready(function() {

     

        });

    function submitme(){

          $('.submit_page').click(function() {
             //alert('hi.. submit');
             var gy=$(this);
               var formID =   $(this).data('form_id');
               var    key =   $(this).data('key');
                $.ajax({
                    type: 'post',
                    url: '<?php echo Yii::app()->request->baseUrl; ?>/infowizard/serviceMaster/addsubservicetagmapping',
                    data: $('.tagmappingform' + key).serialize(),
                    success: function (data) {  
                        if(data!="Data saving failed. Please try again."){
                        gy.closest('td').html('Data Saved');
                        gy.closest('td').css('color','green');
                         $("#errormessageofservicemodulemapping").addClass('alert alert-success');
                    $("#errormessageofservicemodulemapping").html(data);
                   // gy.html('Save Data');
                    }else{
                        // gy.closest('td').html('Data Saved');
                       // gy.closest('td').css('color','green');
                         $("#errormessageofservicemodulemapping").addClass('alert alert-danger');
                    $("#errormessageofservicemodulemapping").html(data);
                    }
                }

          });
          });
     }
       </script>
  <!-- Modal -->
  <div class="modal fade" id="subServiceTagMapping" role="dialog">
    <div class="modal-dialog modal-lg">

      <!-- Modal content-->
      <div class="modal-content" style="width:100%">
        <div class="modal-header">
          <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
          <h4 class="modal-title">Module-Service List</h4>
        </div>
        <div class="modal-body">
            <p id="errormessageofservicemodulemapping"></p>
            <div id="sub_service_name_list">
                </div>



        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-bs-dismiss="modal">Close</button>
        </div>
      </div>

    </div>
  </div>