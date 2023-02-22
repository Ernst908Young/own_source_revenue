<?php 
$baseUrl=Yii::app()->theme->baseUrl;
@session_start();
$dept_id = @$_SESSION['dept_id'];
//$dept_id = 1;
$connection=Yii::app()->db;
$sqlS = "SELECT * FROM bo_dms_verifier WHERE dept_id='$dept_id'";
$command=$connection->createCommand($sqlS);
$lists=$command->queryAll();


if(isset($_POST['idddd_arr']) && !empty($_POST['idddd_arr'])){
		
		//echo '<pre>'; print_r($_POST);  
		$mapping_id_s = $_POST['dm'];
		$btn_ses = array();
		//unset(@$_SESSION['temp_new_ses'][$mapping_id_s]);
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
				//unset(@$_SESSION['temp_new_ses'][$mapping_id_s]);
				//$_SESSION['temp_new_ses'][$mapping_id_s][] = 'NA';
			}
		}
		//$_SESSION['temp_new_ses'] = $btn_ses;
		//echo '<pre>'; print_r($btn_ses); die;
   }
?>

<div class="site-min-height">

	<div style="margin:-7px -20px 0;" class="page-bar">

           <ul class="page-breadcrumb">

              <li>

                 <strong>Welcome to Document Verification console </strong>

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

                        <span class="caption-subject bold uppercase">Documents Listing</span>

                     </div>

                     

                  </div>

                  <div class="portlet-body">

                     
					 

					 <table id="sample_31" class="table table-striped table-bordered" width="100%">

                            <thead>

                              <tr>

                                <th class="td_center">S.No.</th>
                                <th class="td_left">Document Name</th>
                                <th class="td_center">Document Code</th>
                                <th class="td_center">Version</th>
                                <th class="td_center">Status</th>
                                <th class="td_center">Uploaded By</th>
                                <th class="td_center">IUID</th>
                                <th class="td_left">Actions</th>

                              </tr>

                            </thead>

							<tbody>

								<?php
								if($lists){
								$i=1;
								$btn_ses = array();
								foreach($lists as $lary){
									
									$document_id = $lary['document_id'];
									$documents_id = $lary['documents_id'];
									$mapping_id = $lary['id'];
									$sqlccc = "SELECT document_checklist_id FROM bo_infowiz_document_check_list_mapping WHERE docchk_id='$document_id' LIMIT 1";
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
									//echo '<pre>'; print_r($btn_ses); die;
									$lary['user_id']=11;
								?>
								<tr>

                                <td class="td_center"><?php echo $i; ?></td>

                                <td class="td_center"><?php echo $lary['document_name']; ?></td>

                                <td class="td_left"><a href="#faqs_div_log" data-toggle="modal" onclick="openPopupLog('<?php echo $lary['documents_id']; ?>');"><?php echo $lary['document_code']; ?></a></td>
                                <!-- <td class="td_left"><?php echo $lary['document_code']; ?></td> -->

                                <td class="td_center"><?php echo $lary['document_version']; ?></td>
                                <td class="td_center"><?php echo $lary['status']; ?></td>
                                <td class="td_center"><?php echo $lary['uploaded_by']; ?></td>
                                <td class="td_center"><?php echo $lary['iuid']; ?></td>

     
                                <td class="td_left">
									
									
									<?php if($lary['status'] == 'U'){ ?>

									<p style="font-size:12px;display:none;">Comment is compulsory if document is to be rejected</p>
									<?php if(isset($btn_ses[$mapping_id]) && end($btn_ses[$mapping_id]) !='NA'){ ?>
									<textarea placeholder="Comment is compulsory if document is to be rejected" id="dms_comment_<?php echo $lary['id']; ?>" cols="30" rows="3"></textarea> <br>
									<?php if (end($btn_ses[$mapping_id]) === 'Yes'){ ?>
									<input type="submit" class="btn btn-primary" value="Verify" onclick="actionOnDocument('<?php echo ($lary['id']); ?>','<?php echo ($lary['document_id']); ?>','<?php echo ($lary['user_id']); ?>','verify','<?php echo $lary['id']; ?>','<?php echo $lary['documents_id']; ?>')">
									<?php } ?>
									<input type="submit" class="btn btn-danger" value="Reject" onclick="actionOnDocument('<?php echo ($lary['id']); ?>','<?php echo ($lary['document_id']); ?>','<?php echo ($lary['user_id']); ?>','reject','<?php echo $lary['id']; ?>','<?php echo $lary['documents_id']; ?>')">
									
									<?php }else{ ?>
									<input href="#faqs_div" data-toggle="modal" type="button" class="btn btn-primary" value="Document Checkpoint" onclick="openPopup('<?php echo $lary['document_id']; ?>','<?php echo $lary['id']; ?>')">
									<?php } ?>

									<?php }else{ 

										// Get user details which taken action on document

										if($lary['status'] == 'V' && $lary['comments']==''){

											$comments = "Verified";

										}else{

											$comments = $lary['comments'];

										}

									?>

									<b>Verified By :</b> <?php echo $lary['verifier_name']; ?>, <br>

									<b>Verified Date :</b> <?php echo $lary['verified_date_time']; ?>, <br>

									<b>Comments :</b> <?php echo $comments; ?>

									<?php } ?>
									
									

								</td>

								</tr>
								<?php $i++;}} ?>
								


							</tbody>

					</table>

                  </div>

               </div>

            </div>

        </div>

</div>
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

<div id="faqs_div_log" class="modal fade bs-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">

	<div class="modal-header">

          <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>

            <h4 class="modal-title">Document Logs <span id="title_txt" style="font-weight:bold;"></span></h4>

    </div>
	<div class="col-lg-12" id="md_cont_log">
	   
	</div>

</div>

<!-- BEGIN PAGE LEVEL PLUGINS -->

<link href="<?=$baseUrl?>/assets/global/plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css" rel="stylesheet" type="text/css" />

<link href="<?=$baseUrl?>/assets/global/plugins/bootstrap-modal/css/bootstrap-modal.css" rel="stylesheet" type="text/css" />

<!-- END PAGE LEVEL PLUGINS -->



 <!-- BEGIN PAGE LEVEL PLUGINS -->

<script src="<?=$baseUrl?>/assets/global/plugins/bootstrap-modal/js/bootstrap-modalmanager.js" type="text/javascript"></script>

<script src="<?=$baseUrl?>/assets/global/plugins/bootstrap-modal/js/bootstrap-modal.js" type="text/javascript"></script>
<style>
#faqs_div_log{
	width:900px !important;
	left:35% !important;
}
</style>
<!-- END PAGE LEVEL PLUGINS -->

<script type="text/javascript">
function openPopup(doc_chk_id,dm){
	///$('#md_cont').html('');
	//var conteeee = load('/backoffice/dms/DepartmentDMS/actionGetDCP');
	$('#md_cont').load('/backoffice/dms/DepartmentDMS/GetDCP/doc_chk_id/'+doc_chk_id+'/dm/'+dm);
}


function openPopupLog(doc_chk_id){
	///$('#md_cont').html('');
	//var conteeee = load('/backoffice/dms/DepartmentDMS/actionGetDCP');
	$('#md_cont_log').load('/backoffice/dms/DocumentManagement/GetDocumentLogs/document_id/'+doc_chk_id);
}

function action_dp_fun(idddd){
	//alert($('#'+idddd).val());
	if($('#'+idddd).val()=='No'){
		$('#cmt_'+idddd).attr('required','required');
	}else{
		$('#cmt_'+idddd).removeAttr('required');
	}
}
	function actionOnDocument(mapid,did,uid,action,map_new_id,documents_id){

		var  cnf_msg = false;

		var comment  = $('#dms_comment_'+map_new_id).val();

		if(action == 'verify'){

			cnf_msg = "Are you sure you want to verify this document?";

		}else if(action == 'reject'){

			if($.trim(comment)==''){

				alert("Without your comment you can not reject document. Please enter your comment.");

				$('#dms_comment_'+map_new_id).val('');

				return false;

			}

			cnf_msg = "Are you sure you want to reject this document?";

		}

		if(confirm(cnf_msg)){

			$.ajax({

				type: "POST",

				url: "<?php echo Yii::app()->request->baseUrl; ?>/dms/DepartmentDMS/departmentActionOnDocumentDCP/",

				data:

				{

					mapid: mapid,did:did,action:action,uid:uid,comment:comment,documents_id:documents_id

				},

			   success:  function(data) {

				   //alert(data);

				   if(data == 'success'){

						window.location.reload();

						return;

				   }else{

					alert(data);

				   }

				},

			error:function(jqXHR, textStatus, errorThrown){

				alert('error::'+errorThrown);

			}

	   });

		}

		

	}

</script>