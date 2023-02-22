<?php

   /* @var $this DefaultController */
   @session_start();
   //$_SESSION['temp_new_ses']=array();
   $this->breadcrumbs = array(

       $this->module->id

   );
$flg=0;
   $baseUrl=Yii::app()->theme->baseUrl;

   $dept_id = $_SESSION['dept_id'];

   $deptModel = new DepartmentsExt;

   $dept      = $deptModel->getDeptbyId($dept_id);

   

   $AppDmsMapExt = new ApplicationDmsDocumentsMappingExt;

   $count_unverified = $AppDmsMapExt->getUsedDocumentsCount($dept_id,'U');

   //echo '<pre>';print_r($count_unverified);

   $status_array['U'] = 'Pending';

   $status_array['V'] = 'Approved';

   $status_array['R'] = 'Rejected';

   $status_array_lb['U'] = 'warning';

   $status_array_lb['V'] = 'success';

   $status_array_lb['R'] = 'danger';
   
   if(isset($_POST['idddd_arr']) && !empty($_POST['idddd_arr'])){
		
		//echo '<pre>'; print_r($_POST);  
		$mapping_id_s = $_POST['dm'];
		$btn_ses = array();
		unset($_SESSION['temp_new_ses'][$mapping_id_s]);
		foreach($_POST['idddd_arr'] as $key=>$idd_arr){
			if(!empty($_POST['action_'.$idd_arr])){
				//$btn_ses[$mapping_id_s][] = $_POST['action_'.$idd_arr];
				$_SESSION['temp_new_ses'][$mapping_id_s][] = $_POST['action_'.$idd_arr];
				$dcp_value=$_POST['action_'.$idd_arr];
				$comment=$_POST['comments_'.$idd_arr];
				$sql_up_dms="INSERT INTO bo_dcp_transactions SET mapping_id='$mapping_id_s',created_at=NOW(),dcp_id='$idd_arr',dcp_value='$dcp_value',comment='$comment'";
				$connection=Yii::app()->db; 
				$command=$connection->createCommand($sql_up_dms);
				$command->query();
			}else{
				//$btn_ses[$mapping_id_s] = 'NA';
				unset($_SESSION['temp_new_ses'][$mapping_id_s]);
				$_SESSION['temp_new_ses'][$mapping_id_s][] = 'NA';
			}
		}
		//$_SESSION['temp_new_ses'] = $btn_ses;
		//echo '<pre>'; print_r($btn_ses); die;
   }
    //echo '<pre>'; print_r($_SESSION['temp_new_ses']); echo '</pre>';
?>

<style type="text/css">

   .dataTables_wrapper .dt-buttons{

   margin-right: 18px;

   }

   td a:hover{color:#000;}

   .td_center{

	text-align:center;

	vertical-align:middle !important;

   }

   .td_left{

	text-align:left;

	vertical-align:middle !important;

   }
	.hide{display:none;}
</style>

<div class="site-min-height">

	<div style="margin:-7px -20px 0;" class="page-bar">

           <ul class="page-breadcrumb">

              <li>

                 <strong>Welcome to <?php echo $dept['department_name'] ?> Document Verification console </strong>

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

		<?php
		
		$list_arr = $AppDmsMapExt::getAllUsedDocumentsOfInvestorServiceWise2($sno,$user_id,'U');
		$iw_service_id=@$list_arr[0]['iw_service_id'];
		?>

		

		  

		  <!--- TABULAR DATAS -->

		  <div class="row">

            <div class="col-md-12">

               <!-- BEGIN EXAMPLE TABLE PORTLET-->

               <div class="portlet box green">

                  <div class="portlet-title">

                     <div class="caption">

                        <i style="font-size:24px" class="icon-list"></i>

                        <span class="caption-subject bold uppercase">Documents Listing</span>

                     </div>
					 <?php if(in_array($iw_service_id,array('2.0'))) { ?>
						<div class="tools"> <a href="/backoffice/infowizard/subFormCompanyNameReservation/departmentFormView/service_id/<?php echo $iw_service_id;?>/pageID/1/subID/<?php echo $list_arr[0]['app_id'];?>/formCodeID/2" class="btn btn-primary" style="height: 33px;">BACK</a></div>
                     <?php }?>   
                  </div>

                  <div class="portlet-body">

                     <?php

					 if($list_arr){

					 ?>

					 <p>

						<table class="table table-striped table-bordered" width="100%">
                                                    
							<!-- Added For Showing Application Info to Department Document Verifier : Rahul Kumar [17042018]-->
							<tr>
								<td>
								<?php 
								//echo @$list_arr[0]['sp_app_id'];
								$serviceData = ApplicationV2Ext::getDepartmentAndServiceDetail(@$list_arr[0]['sp_app_id']) ;
								$dsa = $serviceData['department_name']." : ".$serviceData['app_name']." : ".$list_arr[0]['app_id'];
								$encodeddsa = base64_encode($dsa);
								?>
								<a href="<?php echo Yii::app()->createAbsoluteUrl('mis/ServiceReport/servicedetail1/sid/' . @$list_arr[0]['sno']) ?>/d1/2015-04-01/d2/<?php echo date('Y-m-d')?>/type/SERVICES/financial_year/ALL/dsa/<?php echo $encodeddsa; ?>" > View Timeline</a>
								</td>
								<td colspan="3">
									<?php if(isset($list_arr[0]['print_app_call_back_url']) && (!empty($list_arr[0]['print_app_call_back_url']))){ ?> <a href="<?php echo rtrim($list_arr[0]['print_app_call_back_url'],"'");  ?>" class="pull-right" target="_blank"> <i class="fa fa-external-link"></i> View Application</a> <?php } ?>
								</td>
							</tr>
							<!-- End Of Adding [17042018] -->
                                                    
							<tr>
								<td><b>Unit Name </b> </td>
								<td><?php echo $list_arr[0]['unit_name']; ?></td>
								<td><b>Investor Name</b></td>
								<td><?php echo $list_arr[0]['full_name']; ?></td>
							</tr>
							<tr>
								<td><b>IUID</td>
								<td><?php echo $list_arr[0]['iuid']; ?></td>
								<td><b>Department Portal Application ID</b> </td>
								<td><?php echo $list_arr[0]['app_id']; ?></td>
							</tr>
							<tr>
								<td><b>Service Name</td>
								<td><?php echo $list_arr[0]['app_name']; ?></td>
								<td><b>Single window Application ID</b> </td>
								<td><?php echo $list_arr[0]['sno']; ?></td>
							</tr>

						</table>

					 </p>

					 <table id="sample_31" class="table table-striped table-bordered" width="100%">
                            <thead>
                              <tr>
                                <th class="td_center">S.N.</th>
                                <th class="td_center">Document Code</th>
                                <th class="td_left">Document Name</th>
                                <th class="td_center">Date</th>
                                <th class="td_center">Status</th>
								<th class="td_center">Validated By</th>
                                <th class="td_center">Document</th>
                                <th class="td_left">Actions</th>
                              </tr>
                            </thead>
							<tbody>
								<?php 		
								//echo '<pre>'; print_r($list_arr); die;
								$btn_ses = array();
								if($list_arr){

									$sn =1;

									foreach($list_arr as $key=>$val_arr){
									
									$documents_id = $val_arr['documents_id'];
									$mapping_id = $val_arr['mapping_id'];
									$sql = "SELECT docchk_id,vbi,valid_from,valid_to,document_reference_number FROM cdn_dms_documents WHERE documents_id='$documents_id' LIMIT 1";
									$connection=Yii::app()->db; 
									$command=$connection->createCommand($sql);
									$doc_chk=$command->queryRow();
                                                                        $docu=$doc_chk;
									$doc_chk_id = $doc_chk['docchk_id'];
									$vbi = $doc_chk['vbi'];
									$status_text_vbi='';
									if($vbi=='V'){
										$status_text_vbi ='Verified';
									}
									else if($vbi=='R'){
										$status_text_vbi ='Rejected';
									}
									
									
									$sql = "SELECT docchk_id,document_reference_number,valid_from,valid_to,doc_date_of_issuance FROM cdn_dms_documents WHERE documents_id='$documents_id' LIMIT 1";
									$connection=Yii::app()->db; 
									$command=$connection->createCommand($sql);
									$doc_chk=$command->queryRow();
									$doc_chk_id = $doc_chk['docchk_id'];
									//echo '<pre>'; print_r($doc_chk); die;
									
									$sqlccc = "SELECT document_checklist_id FROM bo_infowiz_document_check_list_mapping WHERE docchk_id='$doc_chk_id' ORDER BY id DESC LIMIT 1";
									$connection=Yii::app()->db; 
									$command=$connection->createCommand($sqlccc);
									$doc_chk=$command->queryRow();
									if($doc_chk){
										$conteee = json_decode($doc_chk['document_checklist_id'],true);
										foreach($conteee as $idd){
											$sqldccc = "SELECT * FROM bo_dcp_transactions WHERE mapping_id='$mapping_id' AND dcp_id='$idd' LIMIT 1";
											$connection=Yii::app()->db; 
											$command=$connection->createCommand($sqldccc);
											$dcccc=$command->queryRow();
											$dcccc_value = @$dcccc['dcp_value'];
											$dcccc_value = $dcccc_value==''?'NA':$dcccc_value;
											$btn_ses[$mapping_id][] = @$dcccc_value;
										}
									}
								?>

								<tr>

                                <td class="td_center"><?php echo $sn; ?></td>

                                <td class="td_center"><?php echo $val_arr['chklist_id']; ?></td>

                                <td class="td_left"><?php echo $val_arr['d_name']; ?></td>

                                <td class="td_center"><?php echo date("d-M-Y H:i:s",strtotime($val_arr['created_on'])); ?></td>

                                <td class="td_center"> <?php if($val_arr['status']=='U'){$flg="1";} ?>

								<span class="label label-<?php echo $status_array_lb[$val_arr['status']]; ?>"><i class="fa fa-hourglass-half fa-spin-hover"></i>  <?php echo $status_array[$val_arr['status']]; ?> </span>

								</td>
								<td class="td_center"><?php echo $status_text_vbi; ?></td>

								<td class="td_center">

								<a target="_blank" href="<?php echo FRONT_BASEURL."themes/backend/mydoc/".$val_arr['iuid']."/".$val_arr['document_name']; ?>">View</a>

								| <a href="<?php echo Yii::app()->request->baseUrl; ?>/dms/DepartmentDMS/DownloadMyDocument/ref_no/<?php echo base64_encode($val_arr['doc_ref_number']); ?>/iuid/<?php echo base64_encode($val_arr['iuid']); ?>">Download</a>
                                                               
								<?php //echo "<!--<pre>";print_r($docu);echo "</pre>-->"; ?>
							   <?php if(isset($docu['valid_from']) && $docu['valid_from']!="0000-00-00" && $docu['valid_from']!="1970-01-01"){ ?> <br> Valid From : <?php echo $docu['valid_from']; } ?>
							   <?php if(isset($docu['valid_to']) && $docu['valid_to']!="0000-00-00" && $docu['valid_to']!="1970-01-01"){ ?> <br> Valid To: <?php  echo $docu['valid_to']; } ?> 
							   <?php if(isset($docu['document_reference_number']) && $docu['document_reference_number']!=""){  ?><br> Reference No.: <?php echo $docu['document_reference_number']; } ?> 
							   <?php if(isset($docu['doc_date_of_issuance']) && $docu['doc_date_of_issuance']!=""){ ?> <br> Issued  On: <?php echo $docu['doc_date_of_issuance']; } ?>
							   
								</td>

								<td class="td_left">

									<?php 
										if($val_arr['status'] == 'U')
										{
										?>

											<p style="font-size:12px;display:none;">Comment is compulsory if document is to be rejected</p>
											<?php if(isset($btn_ses[$mapping_id]) && end($btn_ses[$mapping_id]) !='NA'){ ?>
											<textarea style="display:none;" placeholder="Comment is compulsory if document is to be rejected" id="dms_comment_<?php echo $val_arr['mapping_id']; ?>" cols="30" rows="3"></textarea> <br>
											<?php if (end($btn_ses[$mapping_id]) === 'Yes'){ ?>
											<input type="submit" class="btn btn-primary  vfy" value="Verify" onclick="actionOnDocument('<?php echo base64_encode($val_arr['mapping_id']); ?>','<?php echo base64_encode($val_arr['documents_id']); ?>','<?php echo base64_encode($val_arr['user_id']); ?>','verify','<?php echo $val_arr['mapping_id']; ?>')"  style="display:none;">
											<?php } ?>
											<input type="submit" class="btn btn-danger rjct" value="Reject" onclick="actionOnDocument('<?php echo base64_encode($val_arr['mapping_id']); ?>','<?php echo base64_encode($val_arr['documents_id']); ?>','<?php echo base64_encode($val_arr['user_id']); ?>','reject','<?php echo $val_arr['mapping_id']; ?>')"  style="display:none;"> 
											
											<?php }else{ ?>
											<input href="#faqs_div" data-toggle="modal" type="button" class="btn btn-primary" value="Document Checkpoint" onclick="openPopup('<?php echo $doc_chk_id; ?>','<?php echo $val_arr['mapping_id']; ?>','<?php echo $val_arr['sp_app_id']; ?>')">
											<?php } ?>

									<?php 
										}else{ 

											// Get user details which taken action on document
											
											if($val_arr['status'] == 'V' && $val_arr['comments']==''){

												//$comments = "Verified";

											}else if($val_arr['status'] == 'V' && $val_arr['comments']!=''){

												//$comments = @$val_arr['comments'];

											}else{
												//$comments = @$val_arr['comment'];											
											}	

										?>

										<b>Verified By :</b> <?php echo $val_arr['verifier_name']; ?>, <br>

										<b>Verified Date :</b> <?php echo $val_arr['verified_date_time']; ?>, <br>

										<b>Comments :</b> <?php echo @$val_arr['comment']; ?>

									<?php 
										}
										?>

								</td>

								</tr>

								<?php ++$sn; }
								
								}else{ echo "No request found.";} ?>

							</tbody>

					</table>

					<?php } else{ echo "<p>No request found.</p>";} 	?>
					  <?php  echo $docInOneGo=$AppDmsMapExt::docVerifyInOneGo($iw_service_id);
                                      //echo "<!--<pre>00000"; print_r($docInOneGo);echo "</pre>-->";
					  if($_GET['sno']=='NzQ1Nw=='){$docInOneGo=1;}
                                        if($docInOneGo){ 
                                            if($_SESSION['dept_id']==9){$aptype="PostStatus";}else{$aptype="PostStatusJson"; }
                                            ?>
                                         <form action="/backoffice/api/dms/<?php echo $aptype; ?>/sno/<?php echo base64_decode($_GET['sno']); ?>" method="POST">
                                            <div class="row">  <div class="col-md-12"> <div class="col-md-3">Remarks</div><div class="col-md-9"><textarea name="remarks" style="width:100%"></textarea></div></div></div>
                                            <input type="hidden" name="app_id" value="<?php echo $list_arr[0]['app_id']; ?>">
                                          
                                            <input type="hidden" name="user_id" value="<?php echo $list_arr[0]['user_id']; ?>">
                                            <p style="color:green;text-align:justify;font-weight:bold;font-size:17px;" >Final document submission :  Applicant will receive notification for rejected/approved documents. You may proceed to process the application on the departmental portal, if all documents have been approved</p>
                                             <div class="row" style="margin-top:20px;">
                                                 <p style="text-align:center;"><?php 
if($_GET['sno']=="NzQ1Nw=="){$flg=0;}
                                                 if($flg==0){ ?> <input type="submit" value="Proceed" class="btn btn-primary"><?php } else{ ?> <span  class="btn btn-default" title="Verify all remaining document before proceed" style="cursor:not-allowed;">  Submit</span><?php } ?> <span class="label label-default pull-right" style="margin-right:20px;"><?php  echo "Saved as Draft"; } ?></span></p>
                                            </div>
                                         </form >
					
					
				

                  </div>

               </div>

            </div>

        </div>

</div>
<?php //echo '<pre>'; print_r($btn_ses); echo '</pre>'; ?>


<div id="faqs_div" class="modal fade bs-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h4 class="modal-title">Document Verification Check Points <span id="title_txt" style="font-weight:bold;"></span></h4>
    </div>
	<form name="frm" action="" method="POST">
		<div class="col-lg-12" id="md_cont">
		   <?php //echo '<pre>'; print_r($list_arr); ?>
		</div>
	</form>
</div>

<!-- BEGIN PAGE LEVEL PLUGINS -->

<link href="<?=$baseUrl?>/assets/global/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css" rel="stylesheet" type="text/css" />

<link href="<?=$baseUrl?>/assets/global/plugins/bootstrap-modal/css/bootstrap-modal.css" rel="stylesheet" type="text/css" />

<!-- END PAGE LEVEL PLUGINS -->



 <!-- BEGIN PAGE LEVEL PLUGINS -->

<script src="<?=$baseUrl?>/assets/global/plugins/bootstrap-modal/js/bootstrap-modalmanager.js" type="text/javascript"></script>

<script src="<?=$baseUrl?>/assets/global/plugins/bootstrap-modal/js/bootstrap-modal.js" type="text/javascript"></script>

<!-- END PAGE LEVEL PLUGINS -->

<script type="text/javascript">
$(document).ready(function(){
	$(document).on('click','#save_comment',function(){	
		var actionval =$(".action_dp").val();
		if(actionval==''){
			alert("Please select action");
			return false;
		}else{
			$(".comment_form").submit();
			return true;
		}
	});
});
function openPopup(doc_chk_id,dm,sid){
	///$('#md_cont').html('');
	//var conteeee = load('/backoffice/dms/DepartmentDMS/actionGetDCP');
	$('#md_cont').load('/backoffice/dms/DepartmentDMS/GetDCP/doc_chk_id/'+doc_chk_id+'/dm/'+dm+'/sid/'+sid);
}

function action_dp_fun(idddd){
	//alert($('#'+idddd).val());
	if($('#'+idddd).val()=='No'){
		$('#cmt_'+idddd).attr('required','required');
	}else{
		$('#cmt_'+idddd).removeAttr('required');
	}
}
	function actionOnDocument(mapid,did,uid,action,map_new_id){

		var  cnf_msg = false;

		var comment  = $('#dms_comment_'+map_new_id).val();

		if(action == 'verify'){

			cnf_msg = "Are you sure you want to verify this document?";

		}else if(action == 'reject'){

/* 			if($.trim(comment)==''){

				//alert("Without your comment you can not reject document. Please enter your comment.");

				$('#dms_comment_'+map_new_id).val('');

				return false;

			}
 */
			cnf_msg = "Are you sure you want to reject this document?";

		}

		// if(confirm(cnf_msg)){

			$.ajax({

				type: "POST",

				url: "<?php echo Yii::app()->request->baseUrl; ?>/dms/DepartmentDMS/departmentActionOnDocument/",

				data:

				{

					mapid: mapid,did:did,action:action,uid:uid,comment:comment

				},

			   success:  function(data) {

				   //alert(data);

				   if(data == 'success'){

						//window.location.reload();
							window.location = window.location.href

						return;

				   }else{

					//alert(data);

				   }

				},

			error:function(jqXHR, textStatus, errorThrown){

				alert('error::'+errorThrown);

			}

	   });

		//}

		

	}

	
	
$(document).ready(function(){
var vrfybtnlength=$(".vfy").length;
var flg=0;
if(vrfybtnlength>0){
    $(".vfy").each(function(){
        flg=1;
        $(this).click();        
    });
}else{
    flg=1;
}
if(flg===1){
   $(".rjct").each(function(){
      var vrfybtnlength1=$(".vfy").length;

if(vrfybtnlength1==0){
        $(this).click();   
    }
    });  
}

});

</script>