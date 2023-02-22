<div class="row">
<div class="dt-buttons" style="margin-bottom: 10px; float:right; margin-right:15px" ><a class="btn btn-success" tabindex="0" href="<?=$this->createUrl('/infowizard/serviceMaster/servicepage/')?>"><span>Add New Service </span></a>
</div></div>
<div class='portlet box green'>
<div class='portlet-title'>
    <div class='caption'>
        <i style=" font-size:20px;" class='fa fa-list'></i>List of Services</div>
    <div class='tools'> </div>
	
</div>
 <div class="portlet-body">
          <table class="table table-striped table-bordered table-hover" id="sample_2" >
            <thead>
            <tr>
                <th>S.No.</th>
				<th>State/<br />Central</th>
				<th>Department Name</th>
                <th>Service Name</th>
				<th>Service Incidence</th>
				<th>Service Sector</th>
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
				<td><?php if($apps['incidence_pre_establishment']==1){ echo "Pre Establishment";  echo" ,"; echo"<br/>";  } 
				if($apps['incidence_pre_operation']==1){ echo "Pre Operations"; echo" ,"; echo"<br/>"; } 
				if($apps['is_incentive']==1){ echo "Incentive"; echo" ,"; echo"<br/>"; } 
				if($apps['incidence_post_operation']==1){ echo "Post Operations"; } //getNameOfSeviceSector?></td>
                <td> 
				<a href="javascript:viewSector('<?php echo $key; ?>')">View
</a>
<span id="s_<?php echo $key; ?>" style="display:none;"><?php $sector=explode(',',$apps['service_sector']); $aa=count($sector); for($i=0; $i<$aa ;$i++) { //echo $sector[$i]; }
				 $sectorname=serviceMasterController::getNameOfSeviceSector($sector[$i]); echo $sectorname['name']; if($i!=($aa-1)) echo " , <br>"; }?></span>				
				
				 </td>
				<td><?php echo date('d-m-Y',strtotime($apps['created']));  ?></td>
                                <td style="width:90px !important">
			<!--<a href="<?php // echo Yii::app()->createAbsoluteUrl('infowizard/serviceMaster/serviceupdate/serviceID/'.$apps['id'].'')?>" ><i class="fa fa-eye"></i> View</a>-->
				<a href="<?php echo Yii::app()->createAbsoluteUrl('infowizard/serviceMaster/update/serviceID/'.$apps['id'].'')?>" >Edit Service</a>
				<br>
				<a href="<?php echo Yii::app()->createAbsoluteUrl('infowizard/serviceMaster/view/serviceID/'.$apps['id'].'')?>" >View Service</a>
				<br>
                                <a href="<?php echo Yii::app()->createAbsoluteUrl('infowizard/serviceMaster/serviceupdate/serviceID/'.$apps['id'].'')?>" > Major form</a>
     <br>
         <?php $questioncount=serviceMasterController::getListofSubForm($apps['id']); if($questioncount>0) { ?>
   <a href="<?php echo Yii::app()->createAbsoluteUrl('infowizard/infowizardQuesansMapping/subformquestionanswerupdate/serviceID/'.$apps['id'].'')?>" >Edit Question</a>
   <?php } if($questioncount==0) {  ?>
   <a href="<?php echo Yii::app()->createAbsoluteUrl('infowizard/infowizardQuesansMapping/subformquestionanswer/serviceID/'.$apps['id'].'')?>" >Add Question</a>
   <?php } ?>
            <a href="#" class="services_list" data-toggle="modal" data-service_id="<?php echo $apps['id']; ?>" data-target="#subServiceTagMapping">Module-Service Mapping </a>

               
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
 <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="questionDiv" class="modal abc">
        <div class="modal-header">
          <button type="button" class="" data-dismiss="modal" aria-hidden="true" style="margin-right:50px; float:right;">Close</button>
            <h4 class="modal-title">Service Sector</h4>
        </div>
       
       <div class="model-content" id="mcont"style="padding:10px;">
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
<!-- BEGIN PAGE LEVEL PLUGINS -->
<!--<link href="<?=$base?>/assets/global/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css" rel="stylesheet" type="text/css" />
<link href="<?=$base?>/assets/global/plugins/bootstrap-modal/css/bootstrap-modal.css" rel="stylesheet" type="text/css" />-->
<!-- END PAGE LEVEL PLUGINS -->

<!-- BEGIN PAGE LEVEL PLUGINS -->
<!--<script src="<?=$base?>/assets/global/plugins/bootstrap-modal/js/bootstrap-modalmanager.js" type="text/javascript"></script>
<script src="<?=$base?>/assets/global/plugins/bootstrap-modal/js/bootstrap-modal.js" type="text/javascript"></script>-->

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
                 // For Service Module Mapping - Ends Here Rahul Kumar : 02052018
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
//For Service Module Mapping - Ends Here Rahul Kumar : 02052018
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
                        [0, "asc"]
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
function viewSector(key){
	$('#mcont').html($('#s_'+key).html());
	$('#questionDiv').modal('show');
}
</script>


<!-- For Service Module Mapping - Ends Here Rahul Kumar : 02052018 -->
<p id="loading-mask"></p>
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
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Module-Service List</h4>
        </div>
        <div class="modal-body">
            <p id="errormessageofservicemodulemapping"></p>
            <div id="sub_service_name_list">
                </div>



        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>

    </div>
  </div>
<!-- For Service Module Mapping - Ends Here Rahul Kumar : 02052018 -->
