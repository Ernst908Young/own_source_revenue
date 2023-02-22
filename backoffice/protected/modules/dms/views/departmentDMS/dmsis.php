<?php
   /* @var $this DefaultController */
   $this->breadcrumbs = array(
       $this->module->id
   );
   $baseUrl=Yii::app()->theme->baseUrl;
   $dept_id = $_SESSION['dept_id'];
   $deptModel = new DepartmentsExt;
   $dept      = $deptModel->getDeptbyId($dept_id);
   
   $AppDmsMapExt = new ApplicationDmsDocumentsMappingExt;
   $count_unverified = $AppDmsMapExt->getUsedDocumentsCountNew($dept_id,'P','U');
   $count_verified = $AppDmsMapExt->getUsedDocumentsCountNew($dept_id,'A','V');
   $count_rejected = $AppDmsMapExt->getUsedDocumentsCountNew($dept_id,'R','R');
   //echo '<pre>';print_r($count_unverified);
   
?>
<style type="text/css">
   .dataTables_wrapper .dt-buttons{
   margin-right: 18px;
   }
   td a:hover{color:#000;}
   .td_center{text-align:center !important;vertical-align:middle !important;}
   .td_left{text-align:left !important;vertical-align:middle !important;}
</style>
<div class="site-min-height">
	<div style="margin:-7px -20px 0;" class="page-bar">
           <ul class="page-breadcrumb">
              <li>
                 <strong><strong>Welcome to <?php echo $dept['department_name']; ?> Document Verification console </strong> </strong>
              </li>
           </ul>
           <div class="page-toolbar">
              <div id="" class="pull-right tooltips btn btn-sm" data-container="body" data-placement="bottom">
                 <span class="thin uppercase hidden-xs" id="clock"><?=date('d-M Y')?>&nbsp;</span>
                 <span class="thin uppercase hidden-xs"></span>&nbsp;
              </div>
           </div>
        </div>
        <div style="margin:4px;" class="clearfix"></div>
		

		  
		  <!--- TABULAR DATAS -->
		  <div class="row">
            <div class="col-md-12">
               <!-- BEGIN EXAMPLE TABLE PORTLET-->
               <div class="portlet box green">
                  <div class="portlet-title">
                     <div class="caption">
                        <i style="font-size:24px" class="icon-list"></i>
                        <span class="caption-subject bold uppercase">Applications Processed</span>
                     </div>
                     
                  </div>
                  <div class="portlet-body">
                     <table id="sample_2" class="table table-striped table-bordered" width="100%">
                            	<?php 
								$list_arr = $AppDmsMapExt::getAllDmsVerifiedApplication($dept_id);
								if($list_arr){
								?>
								<thead>
                              <tr>
                                <th style="width:5%;" class="td_center">S.No.</th>
                                <th style="width:25%;" class="td_left">Unit Name</th>
                                <th style="width:20%;" class="td_left">Service Name</th>
                                <th style="width:20%;" class="td_left">Investor Detail</th>
								<?php if($dept_id==9){?>
                                <th style="width:10%;" class="td_left">Employee Count</th>
								<?php } ?>
                                <th style="width:10%;" class="td_center">Application Date</th>
                                <th style="width:5%;" class="td_center"> Actions</th>
                              </tr>
                            </thead>
							<tbody>
							
								<?php
									$sn =1;$dept_user_id 	= $_SESSION['uid'];
									$arr_325=array();
									$arr_329=array(17298,17299,17300,17311,17313,10905,10907,10910,17322,17323,17365);
									$arr_326=array(17288,10901,17315,17318,17319,10916,10917);
									foreach($list_arr as $key=>$val_arr){
										$noe=@$val_arr['noe'];
										$cond_lbr=FALSE;
										$dept_user_id 	= $_SESSION['uid'];
										$sar = array(11);
										
										$lbr_cond=True;
										if($_SESSION['uname']!=$val_arr['verifier_name']){$lbr_cond=False;}
										if($dept_id == 9 && ($dept_user_id == '325' || $dept_user_id == '326' || $dept_user_id == '329')){
											if($dept_user_id == '325' && in_array(@$val_arr['app_id'],$arr_325)){
											//echo "test";die;
												$lbr_cond=true;
											}else if($dept_user_id == '326' && in_array(@$val_arr['app_id'],$arr_326)){
												$lbr_cond=true;
											}else if($dept_user_id == '329' && in_array(@$val_arr['app_id'],$arr_329)){
												$lbr_cond=true;
											}
											if(in_array(@$val_arr['sp_app_id'],$sar)){
												if($dept_user_id == '325' && $noe>500   && $val_arr['app_id']!='17365'){
													$lbr_cond=TRUE;
												}else if($dept_user_id == '326' && $noe>100 && $noe<=500){
													$lbr_cond=TRUE;
												}else if($dept_user_id == '329' && $noe>0 && $noe<=100 ){
													$lbr_cond=TRUE;
												}
											}

											
											
										}else{
											$lbr_cond=true;
										}
										if($lbr_cond){
								?>
								<tr>
                                <td class="td_center"><?php echo $sn; ?></td>
                                <td class="td_left"><?php 
										echo $val_arr['unit_name']==''?'NA':$val_arr['unit_name'];
										echo "<br/>";
										echo "<b>CAF ID:</b> ".@$val_arr['caf_id'];
										echo "<br/>";
										echo "<b>Single Window App ID:</b> ".@$val_arr['sno'];
										echo "<br/>";
										echo "<b>Department Portal App ID:</b> ".@$val_arr['app_id'];
									?></td>
                                <td class="td_left"><?php echo $val_arr['app_name']; ?></td>
                                <td class="td_left"><?php 
										echo $val_arr['full_name'];  
										echo "</br>";
										echo "<b>IUID: </b>".$val_arr['iuid'];
										echo "</br>";
										echo "<b>Email Id: </b>".$val_arr['email']; 
										echo "</br>";	
										echo "<b>Mobile No.: </b>".$val_arr['mobile_number']; 										
										?>
								</td>  
								<?php if($dept_id==9){?>
								<td class="td_center"><?php echo $noe;?></td>	
								<?php }?>
                                <td class="td_center"><?php echo $val_arr['created_on']; ?></td>
                                <td class="td_center">
									<a href="<?php echo Yii::app()->createAbsoluteUrl('/dms/DepartmentDMS/view/sno/'.base64_encode($val_arr['sno']).'/user/'.base64_encode($val_arr['user_id']));?>">
									View
									</a>
								</td>
								</tr>
										<?php ++$sn; }}}else{ echo "No request found.";} ?>
							</tbody>
					</table>
                  </div>
               </div>
            </div>
        </div>
</div>

<!-- MODEL POPUP START -->
<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="notification" class="modal">
 		<div class="modal-header">
          <!-- <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>-->
            <h4 class="modal-title"><b>Notification</b></h4>
        </div>
		  <div class="row">	
			<div class="form-group col-lg-12" style="margin:10px; font-weight:bold; text-align:center;">
				You have <?php echo $count_unverified; ?> new unverified request to verify.
			</div>
		  </div>
		  <div class="row">
			<div class="form-group col-lg-12" style="text-align: center;">
				<input value="View" id="submit_btn" class="btn btn-primary" type="button" data-dismiss="modal" aria-hidden="true">
				<input value="Close" id="submit_btn" class="btn btn-primary" type="button" data-dismiss="modal" aria-hidden="true">    				
             </div>
			
		</div>
</div>
 
<!-- END OF MODEL POPUP -->

<!-- BEGIN PAGE LEVEL PLUGINS -->
<link href="<?=$baseUrl?>/assets/global/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css" rel="stylesheet" type="text/css" />
<link href="<?=$baseUrl?>/assets/global/plugins/bootstrap-modal/css/bootstrap-modal.css" rel="stylesheet" type="text/css" />
<!-- END PAGE LEVEL PLUGINS -->

 <!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="<?=$baseUrl?>/assets/global/plugins/bootstrap-modal/js/bootstrap-modalmanager.js" type="text/javascript"></script>
<script src="<?=$baseUrl?>/assets/global/plugins/bootstrap-modal/js/bootstrap-modal.js" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->
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
<script>
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
                     className: "btn white btn-outline"
                 },  {
                     extend: "pdf",
                     className: "btn white btn-outline"
                 }, {
                     extend: "excel",
                     className: "btn white btn-outline"
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
$(document).ready(function() {
	TableDatatablesButtons.init();
    <?php if(isset($_SESSION['first_time_login']) && $_SESSION['first_time_login']==1 && $count_unverified){ ?>
		$('#notification').modal('show');
	<?php $_SESSION['first_time_login']=2;} ?>
});

function createCookie(name, value, hr) {
            if (hr) {
                var date = new Date();
                date.setTime(date.getTime() + (hr * 60 * 60 * 1000));
                var expires = "; expires=" + date.toGMTString();
            }
            else var expires = "";               

            document.cookie = name + "=" + value + expires + "; path=/";
        }

        function readCookie(name) {
            var nameEQ = name + "=";
            var ca = document.cookie.split(';');
            for (var i = 0; i < ca.length; i++) {
                var c = ca[i];
                while (c.charAt(0) == ' ') c = c.substring(1, c.length);
                if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
            }
            return null;
        }
</script>
<?php //echo '<pre>'; print_r($list_arr); ?>