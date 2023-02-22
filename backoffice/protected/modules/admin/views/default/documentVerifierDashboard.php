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
   $dept_user_id 	= $_SESSION['uid'];
   
   
//   if($_SERVER['REMOTE_ADDR']=="139.167.245.249"){
//       $dept_user_id='329';
//   }

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
		
		<div class="row">
             <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <a class="dashboard-stat dashboard-stat-v2 blue" href="#">
                   <div class="visual">
                      <i class="fa fa-bar-chart-o"></i>
                   </div>
                   <div class="details">
                      <div class="number">
                         <span data-counter="counterup" data-value=""></span>
                      </div>
                      <div class="desc">Pending</div>
                   </div>
                </a>
             </div>
             <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <a class="dashboard-stat dashboard-stat-v2 purple" href="#">
                   <div class="visual">
                      <i class="fa fa-shopping-cart"></i>
                   </div>
                   <div class="details">
                      <div class="number">
                         <span data-counter="counterup" data-value="<?php //echo $count_unverified; ?>"><?php //echo $count_unverified; ?></span>
                      </div>
                      <div class="desc">Unverified</div>
                   </div>
                </a>
             </div>
             <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <a class="dashboard-stat dashboard-stat-v2 green" href="#">
                   <div class="visual">
                      <i class="fa fa-globe"></i>
                   </div>
                   <div class="details">
                      <div class="number">
                         <span data-counter="counterup" data-value="<?php //echo //$count_verified; ?>"><?php //echo $count_verified; ?></span>
                      </div>
                      <div class="desc">Verified</div>
                   </div>
                </a>
             </div>
             <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <a class="dashboard-stat dashboard-stat-v2 red" href="#">
                   <div class="visual">
                      <i class="fa fa-globe"></i>
                   </div>
                   <div class="details">
                      <div class="number">
                         <span data-counter="counterup" data-value="<?php //echo //$count_rejected; ?>"><?php //echo $count_rejected; ?></span>
                      </div>
                      <div class="desc">Rejected </div>
                   </div>
                </a>
             </div>
          </div>
		  
		  <!--- TABULAR DATAS -->
		  <div class="row">
            <div class="col-md-12">
               <!-- BEGIN EXAMPLE TABLE PORTLET-->
               <div class="portlet box green">
                  <div class="portlet-title">
                     <div class="caption">
                        <i style="font-size:24px" class="icon-list"></i>
                        <span class="caption-subject bold uppercase">Request Listing</span>
                     </div>
                     
                  </div>
                  <div class="portlet-body">
                     <table id="sample_31" class="table table-striped table-bordered" width="100%">
                            	<?php 
								$list_arr = $AppDmsMapExt::getAllDmsPendingApplication($dept_id);
								if($list_arr){
								?>
								<thead>
                              <tr>
                                <th style="width:10%;" class="td_center">S.No.</th>
                                <th style="width:10%;" class="td_left">Unit Name</th>
                                <th style="width:10%;" class="td_left">District</th>
                                <th style="width:15%;" class="td_left">Service Name</th>
                                <th style="width:20%;" class="td_left">Investor Name</th>
                                <th style="width:5%;" class="td_center">Application ID</th>
                                <th style="width:5%;" class="td_center">Employee Count</th>
                                
                                <th style="width:20%;" class="td_center">Application Date</th>
                                <th style="width:5%;" class="td_center"> Actions</th>
                              </tr>
                            </thead>
							<tbody>
							
								<?php
									$sn =1;
                                                                        
                                                                        
									$arr_325=array();
									$arr_329=array(17298,17299,17300,17311,17313,10905,10907,10910,17322,17323,17365);
									$arr_326=array(17288,10901,17315,17318,17319,10916,10917);
                                                                        $arr_387=array(21244,20202,21241,26781);
									foreach($list_arr as $key=>$val_arr){ 
                                                                            
                                                                          //  echo "<!--<pre>".print_r($val_arr)."</pre>-->"; 
										$noe=$val_arr['noe'];
										$cond_lbr=FALSE;
										//$dept_user_id 	= $val_arr;
										$sar = array(11,10);
										
										$lbr_cond=0;
                                                                        if($dept_id == 9 && ($dept_user_id == '325' || $dept_user_id == '326' || $dept_user_id == '329' )){
											if($dept_user_id == '325' && in_array(@$val_arr['app_id'],$arr_325)   && $val_arr['app_id']!='17365' ){
												$lbr_cond=1;
											}else if($dept_user_id == '326' && in_array(@$val_arr['app_id'],$arr_326)){
												$lbr_cond=1;
											}else if($dept_user_id == '329' && in_array(@$val_arr['app_id'],$arr_329)){
												$lbr_cond=1;
											}
                                                                                        else if($dept_user_id == '387' && in_array(@$val_arr['app_id'],$arr_387)){ 
												$lbr_cond=1;
											}
											if(in_array(@$val_arr['sp_app_id'],$sar)){
												if($dept_user_id == '325' && $noe>500){
													$lbr_cond=1;
												}else if($dept_user_id == '326' && $noe>100 && $noe<=500){
													$lbr_cond=1;
												}else if($dept_user_id == '329' && $noe>0 && $noe<=100){
													$lbr_cond=1;
												}
											}
											
											
										}else{
											$lbr_cond=1;
										}
										if($lbr_cond == 1){
								?>
                                                            <tr title="<?php echo $noe; ?>">
                                                                    <td class="td_center"><?php echo $sn; ?></td>
                                                                    <td class="td_left"><?php echo $val_arr['unit_name']==''?'NA':$val_arr['unit_name']; ?></td>
                                                                    <td class="td_left"><?php if(is_numeric($val_arr['app_distt'])){ 
                                                                        $sql="select distric_name from bo_district where district_id=$val_arr[app_distt]"; //echo $val_arr['app_name']; 
                                                                       $connection=Yii::app()->db;
                                                                       $command=$connection->createCommand($sql);
                                                                       $appSub=$command->queryRow(); echo @$appSub['distric_name']; }else{echo $val_arr['app_distt'];} ?>
                                                                        </td>
                                                                    <td class="td_left"><?php echo $val_arr['app_name']; ?></td>
                                                                    <td class="td_left"><?php echo $val_arr['full_name']; ?></td>
                                                                    <td class="td_center"><?php echo $val_arr['app_id']; ?></td>
                                                                    <td class="td_center"><?php echo $noe; ?></td>
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
<script>
$(document).ready(function() {
    <?php if(isset($_SESSION['first_time_login']) && $_SESSION['first_time_login']==1 && $count_unverified){ ?>
		//$('#notification').modal('show');
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