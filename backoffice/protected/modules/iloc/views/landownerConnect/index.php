<style>

     <?php // WITHOUT LOGIN [CHANGE 1]- EXTRA CODE
    if (empty($_SESSION['RESPONSE']['user_id']) && empty($_SESSION['uid'])){
        ?>
        .page-sidebar.navbar-collapse.collapse {
            display: none !important;
        }
        .page-content{margin-left:0px !important;}
        .col-md-1{width:12.50% !important;}
        .uppercase { font-size: 16px !important;

        }
<?php } // WITHOUT LOGIN [CHANGE 1] - EXTRA CODE - ENDS HERE ?>
        </style>
<div class="portlet-body">
      <div class="tabbable tabbable-tabdrop">
          <ul class="nav nav-tabs">
        				<li class="active">
        					<a href="#tab1" data-toggle="tab">Manage Land </a>
        				</li>
        				<li>
        					<a href="#tab2" data-toggle="tab">Manage Requirement </a>
        				</li>
            </ul>
       <div class="tab-content">
    			<div class="tab-pane active" id="tab1">

            <div class="row">
              <div class="dt-buttons" style="margin-bottom: 10px; float:right; margin-right:15px" >
                <a class="btn btn-success" tabindex="0" href="<?=$this->createUrl('/iloc/landownerMessage/inbox')?>"><span> Messages </span></a>
              </div>
              <div class="dt-buttons" style="margin-bottom: 10px; float:right; margin-right:15px" >
                <a class="btn btn-success" tabindex="0" href="<?=$this->createUrl('/iloc/landownerConnect/create')?>" target="_blank"><span>Add New Land Record for Sale/Lease </span></a>
              </div>
            </div>
            <div class='portlet box green'>
            <div class='portlet-title'>
                <div class='caption'>
                    <i style=" font-size:20px;" class='fa fa-list'></i>Land Record for Sale/Lease</div>
                <div class='tools'> </div>
            </div>
             <div class="portlet-body">
                      <table class="table table-striped table-bordered table-hover" id="sample_2" >
                        <thead>
                        <tr>
                            <th>S.No.</th>
            		<th>Sell/Lease</th>
            		<th>District</th>
                            <th>Village</th>
            		<th>Type of Land</th>
                            <th >Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php //print_r($dataProvider); die;
                          if(empty($dataProvider)){
                            echo "<tr><td colspan='5'>No applications</td></tr>";

                          }
                          else{
                            $count=1;
                            foreach ($dataProvider as $key => $act) {
                                ?>
                                <tr>
                            <td ><?=$count++;?></td>
                        <td ><?php if(!empty($act['is_sale']) && $act['is_sale']==1){ echo 'Sell';  } if($act['is_sale']==1 && $act['is_lease']==1){ echo ' , ';}
            			 if(!empty($act['is_lease']) && $act['is_lease']==1){ echo 'Lease'; }?></td>
                            <td><?php echo $allList=LandownerConnectEXT::getMasterName('bo_district',$act['district_id'],'distric_name','district_id'); ?></td>
                            <td >
							
							<?php /*Author:Pankaj Kumar Tiwari
			                        Date:16Feb2018*/   ?>
							
							<?php  if(isset($act['village']) && !empty($act['village'])){

								  $village = LandownerConnectEXT::getMasterName('lg_code_villages',$act['village'],'village_name','village_code');

								}else {
									
								  $village ='';
								  
								}  echo $village;
                           ?>  </td>
							
							<?php /*------------------------------------------------------*/?>
							
            				<td ><?php echo $act['type_of_land'];?></td>
                            <td>
                                <!--<a href="<?php echo Yii::app()->createAbsoluteUrl('/iloc/landownerConnect/view/id/'.$act['id'].'')?>" >View </a>-->
                                <a href="<?php echo Yii::app()->createAbsoluteUrl('/iloc/landownerConnect/update/id/'.base64_encode($act['id']).'')?>" >Edit </a></td>
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

        <div class="tab-pane" id="tab2">

          <div class="row">
              <div class="dt-buttons" style="margin-bottom: 10px; float:right; margin-right:15px" >
                <a class="btn btn-success" tabindex="0" href="<?=$this->createUrl('/iloc/landownerMessage/inbox')?>"><span> Messages </span></a>
              </div>
              <div class="dt-buttons" style="margin-bottom: 10px; float:right; margin-right:15px">
                <a class="btn btn-success" tabindex="0" href="<?=$this->createUrl('/iloc/landrequesterConnect/create')?>" target="_blank"><span>Add New Land For Requirement </span></a>
              </div>
          </div>
          <div class='portlet box green'>
          <div class='portlet-title'>
              <div class='caption'>
                  <i style=" font-size:20px;" class='fa fa-list'></i>Land Requirement</div>
              <div class='tools'> </div>
          </div>
           <div class="portlet-body">
                    <table class="table table-striped table-bordered table-hover" id="sample_3" >
                      <thead>
                      <tr>
                          <th>S.No.</th>
                          <th>Sell/Lease</th>
                          <th>District</th>
                          <th>Village</th>
                          <th>Type of Land</th>
                          <th >Action</th>
                      </tr>
                      </thead>
                      <tbody>
                      <?php //print_r($dataProvider); die;
                        if(empty($dataProvider_r)){
                          echo "<tr><td colspan='5'>No applications</td></tr>";

                        }
                        else{
                          $count=1;
                          foreach ($dataProvider_r as $key => $act) {
                              ?>
                              <tr>
                          <td ><?=$count++;?></td>
                      <td ><?php if(!empty($act['is_sale']) && $act['is_sale']==1){ echo 'Sell';  } if($act['is_sale']==1 && $act['is_lease']==1){ echo ' , ';}
                          if(!empty($act['is_lease']) && $act['is_lease']==1){ echo 'Lease'; }?></td>
                          <td><?php echo $allList=LandownerConnectEXT::getMasterName('bo_district',$act['district_id'],'distric_name','district_id'); ?></td>
                           
						   
						    <?php /*Author:Pankaj Kumar Tiwari
			                        Date:16Feb2018*/   ?>
								<td>
										<?php  if(isset($act['village']) && !empty($act['village'])){

											  $village = LandownerConnectEXT::getMasterName('lg_code_villages',$act['village'],'village_name','village_code');

											}else {
												
											  $village ='';
											  
											}  echo $village;
									   ?> 
							   </td>
						   
						   <?php /*------------------------------------------*/?>
						   
                            <td ><?php echo $act['type_of_land'];?></td>
                            <td>
                                <a href="<?php echo Yii::app()->createAbsoluteUrl('/iloc/landrequesterConnect/update/id/'.base64_encode($act['id']).'')?>" >Edit </a>
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
