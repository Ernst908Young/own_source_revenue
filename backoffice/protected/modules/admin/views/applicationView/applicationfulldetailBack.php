<style type="text/css">
	.comment_section{
		display: inline;
		background: #ddd;
		color:red;
    	resize: none;
		padding: 5px 15px 5px 15px;
	}
	.apprvr_comments{
		display: inline;
		background: #F7F7F7;
		color:#222;
    	resize: none;
		padding: 5px 15px 5px 15px;	
	}
	#heading{
	   background-color: #006699;
	   text-align: center;
	   color:#fff;
	   padding-top: 7px;
	   padding-bottom: 7px;
	   margin-bottom: 20px;
	   font-weight: bold;
	   }
	   .btn_select{
	   	    margin-top: 8px;
	   	    padding: 0px 25px;
	   	    top:25px;
	   	    position: relative;
	   }
	   .panel
{
background-color: #FBFBEF; 
}
</style>
<div class="site-min-height">
<?php
	$this->breadcrumbs=array(
	'Application View',
);
$app_name=ApplicationExt::getAppNameViaId($data['application_id']);
echo "<section class='panel'><div style='color:#797979;font-size:1.8em' class='panel-heading'> <b>Application Name ". ucwords(str_replace('_', ' ', $app_name['application_name']));
echo "<t class='pull-right'>&nbsp;&nbsp;Application Id ".$data['submission_id']."<input type='hidden' id='sub_id' value='".$data['submission_id']."'>&nbsp;&nbsp;</t></b></div>";
	
echo "<div class='row'>";
foreach(Yii::app()->user->getFlashes() as $key => $message) {
	echo '<font color="red"><div class="alert-message error"><p>' . $message . "</font></p></div>\n";
}
echo "</div>";
echo "<section class='panel'>";
$appFields=ApplicationExt::getDeptAppFields($data['application_id']);
$fields=json_decode($data['field_value']);
	echo "<div class='row'>";
	$sepCount=0;
	foreach ($appFields as $key => $app_fields) {
		$field_type=FieldsExt::getFieldTypeFromId($app_fields['field_id']);
		if($field_type['filed_type']==='separator'){
				echo "<div class='row'>&nbsp;</div>";
				echo "<div id='heading'>".$app_fields['field_value']."</div>";
			}
			else{
					if(is_array($fields->$app_fields['field_name'])){
								echo"
									<div class='row $key'>
						    	      <div class='form-group col-md-12'>
										<label class='control-label col-md-10'>".ucwords(str_replace('_', ' ', $app_fields['field_name'])) ."</label>";
								foreach ($fields->$app_fields['field_name'] as $key => $fields) {
									echo "<div class='form-group col-md-4'>
											<input type='text' id='$key' readonly name='$key' value='$fields' class='form-control'>
									      </div>";}
								  echo "</div>
									</div>";
							}
						else{
							$count=0;
								if($count%2==0)
									echo "<div class='col-md-6 $key'>
									  	   <div class='form-group'>
									  		<label class='control-label'>".ucwords(str_replace('_', ' ', $app_fields['field_name']))."</label>
									  		<input type='text' readonly name='$key' value='".$fields->$app_fields['field_name']."' class='form-control'>
										   </div>
										</div>";
								if($count%2 == 1)
								echo "</div>";
								$count++;
						}
			}
		}
		$count--;
		if($count%2 != 1)
		echo "</div>";
		unset($i);	


		
		
$apprvr_comments= new ApplicationSubmissionExt;
$cmnt=$apprvr_comments->getAprvrComment($data['submission_id']);
?>
<div class="row">
	<div class='col-md-6 comments'>
		<div class='form-group'>
			<label class='control-label'>Previous Level Verifier Comments:</label>
	<?php 
		$roleModel=new RolesExt;
		$uid=$_SESSION['uid'];
		if(!empty($cmnt))
			foreach ($cmnt as $cmnt) {
				$role=$roleModel->getUserRoleViaId($cmnt['next_role_id']);
				if(empty($cmnt['approval_user_comment']))
					echo "<textarea class='form-control comment_section' readonly='readonly' >No Comments</textarea>";
				else{
					echo "<textarea class='form-control comment_section' readonly='readonly' >$role[role_name]: $cmnt[approval_user_comment]</textarea>&nbsp;&nbsp;";
				}
			}
			else
				echo "<textarea class='form-control comment_section' readonly='readonly'>No Comments</textarea>";
	?>
		</div>
	</div>
	<div class='col-md-6'>
		<div class='form-group'>
			<label class='control-label'>Approver Comments:</label>
			<textarea class='form-control apprvr_comments' placeholder="Approver Comments&hellip;" required id="apprvr_comments" name='apprvr_comments'></textarea>
		</div>
		<div class="row" id="error_comnt" style="color:red"></div>
	</div>
</div>	
<?php
	$status_pen=false;
	if(isset($docs) && !empty($docs)){
		echo "<div class='row'>&nbsp;</div><div id='heading'>Uploaded Documents</div>";
		echo "<table class='table table-hover'>
                     <thead>
                           <tr>
                              <th>Document Name</th>
                              <th>View/Download</th>
                              <th>Status</th>
                              <th>Action</th>
                           </tr>";
		foreach ($docs as $doc) {
			 echo "<tr>
                        <td>$doc[doc_name]</td>
                        <td><a href='data:".$doc['doc_type'].";base64, $doc[doc_blob_data]' download='$doc[doc_name]";
                        if($doc['doc_type']=='image/jpeg')
                        	echo ".jpg";
                        if($doc['doc_type']=='application/pdf')
                        	echo ".pdf";
                        echo "'>Download</a></td>
                        <td>";
                        echo "<span class='label label-danger'>";
                        if($doc['doc_status']=='P')
                        	echo "Pending for verification";
                        elseif($doc['doc_status']=='V')
                        	echo "Verified";
                        elseif($doc['doc_status']=='R')
                        	echo "Rejected";
                        echo "</span></td>
                        <td colspan='5'>";
                        	 if($doc['doc_status']=='P'){
                                $status_pen=true;
                                echo "<div class='form-inline'>";
                                echo "<form class='submit_doc form-group' action='".Yii::app()->createAbsoluteUrl('/admin/ApplicationView/verifyDocuments')."' method='POST'>
		                        <input type='hidden' class='verify_documents' name='document_doc_id' value='".$doc['cdn_doc_id']."'>
		                        <input type='hidden' class='application_id' name='application_id' value='".$data['application_id']."'>
		                        <input type='hidden' class='submit_user_id' name='submit_user_id' value='".$data['user_id']."'>
		                        <input type='hidden' class='submit_user_id' name='application_submit_id' value='".$data['submission_id']."'>
		                        <input type='submit' class='btn btn-primary' value='Verify Document'>
                                </form>";
                               echo " &nbsp;&nbsp;<form class='submit_doc form-group' action='".Yii::app()->createAbsoluteUrl('/admin/ApplicationView/rejectDocuments')."' method='POST'>
		                       	<input type='hidden' name='document_doc_id' value='".$doc['cdn_doc_id']."'>
		                        <input type='hidden' class='application_id' name='application_id' value='".$data['application_id']."'>
		                        <input type='hidden' class='submit_user_id' name='submit_user_id' value='".$data['user_id']."'>
		                        <input type='hidden' class='submit_user_id' name='application_submit_id' value='".$data['submission_id']."'>
		                        <input type='submit' class='btn btn-danger' value='Reject Document'>
                               </form>";
                              echo "&nbsp;&nbsp;<a href='#' class='forward_to_next_level btn btn-default form-group'>Forward to Next Level</a>";
                        }
                        echo "</div></td>


               </tr>";
			
	}
	echo "</table>";
}
else
echo "No documents";
?>



<div class="row ">
	<div class="file_error" style="color:red">
	</div>
</div>
<?php
	/**
		Other Department comments
	*/
	$otheDeptCmnt=	ApplicationSubmissionExt::getOtherDepartmentComments($data['submission_id']);
	if(!empty($otheDeptCmnt)){
		echo "<div class='row'>&nbsp;</div><div id='heading'>Other Department's Comments</div>";
		echo "<table class='table table-hover table-bordered'>
								 <tr><th>S.No.</th><th>Forwarded Dept Name</th><th>Verifier Name</th><th>Comments</th></tr>";
								 $count=1;
		foreach ($otheDeptCmnt as $key => $value) {
			$dept_name=DepartmentsExt::getDeptbyId($value['forwarded_dept_id']);
			$uname=UserExt::getUNameviaIdMap($value['verifier_user_id']);
			echo "<tr><td>".$count++."</td><td>$dept_name[department_name]</td><td>$uname</td><td>";
			if(empty($value['verifier_user_comment'])){
				$finalStatus=false;
				echo "No comments yet";
			}
			else
				echo "$value[verifier_user_comment]</td>";
							
		}
		echo "</table>";
	}
?>
<div class="row"> &nbsp;</div>
<div id="heading">Verifier Documents</div>
	<div class="row">
		<?php 
			if(isset($verifier_docs) && !empty($verifier_docs)){
				echo "<table class='table table-hover'>
                     <thead>
                           <tr>
                              <th>Document Name</th>
                              <th>View/Download</th>
                           </tr>";
				foreach ($verifier_docs as $doc) {
				   echo "<tr>
                        <td>$doc->document_name</td>
                        <td><a href='data:".$doc->document_mime_type.";base64, ".$doc->document."' download='".$doc->document_name;
                        if($doc->document_mime_type=='image/jpeg')
                        	echo ".jpg";
                        if($doc->document_mime_type=='application/pdf')
                        	echo ".pdf";
                        echo "'>Download</a></td></tr>";
				}
				echo "</table>";
			}
			else{
				echo "<div class='row'>
						<div class='col-md-6'>
						 <label class='control-label col-md-3' > No Documents</label>
						</div>
					 </div>";
			}

		  echo "<div class='row'>
		  	  	<div class='col-md-12'>
		  	  		<div class='col-md-6'>
		  	  	  		<frameset><legend>Upload Documents</legend>
		  	  	  	</div>
		  	  	  	<div class='row'>&nbsp;</div>
		  	  			<div class='col-md-6'>";
		  	  				echo "<form action='".Yii::app()->createUrl('admin/ApplicationView/uploadVerifierDocs')."'  enctype='multipart/form-data' class='form-inline' name='verify_doc' method='post'>";
		  	  				echo "<input type='hidden' name='ApplicationField[sub_id]' value='$data[submission_id]'>";
		  					echo "<input type='file' class='form-control' name='verifier_files'>&nbsp;&nbsp;";
		  					echo "<input type='submit' value='upload' class='btn btn-primary'>";
		  					echo "</form>";
		  		  echo "</div>";
		  	     echo "</frameset>
		  	    </div>
		  	 </div>";
		?>
	</div>
	<div class="row application_action_options" <?php if($status_pen) echo "style='display:none'";?>>
		<div class='col-md-12 text-center' style="top:10px;">
			<div class='form-group'>
				<?php 
				$role_id=RolesExt::getUserRoleViaId($_SESSION['uid']);
				$rolesAccess=RoleAccessMappingExt::getDeptUsersRoles($role_id['role_id']);
				if(!empty($rolesAccess)){
					foreach ($rolesAccess as $rolesAccess) {
					if(isset($rolesAccess['access_id']) && $rolesAccess['access_id']==1)
						echo "&nbsp;<a href='#' id='verify_app' class='btn btn-primary'>Proceed</a>";
					if(isset($rolesAccess['access_id']) && $rolesAccess['access_id']==2)
						echo "&nbsp;<a href='#'' id='reject_app' class='btn btn-danger'>Reject </a>";
					if(isset($rolesAccess['access_id']) && $rolesAccess['access_id']==3)
						echo "&nbsp;<a data-toggle='modal' class='fields_properties_modal btn btn-info' href='#forward_to_multi_dept'>Forward To Dept</a>";
					if(isset($rolesAccess['access_id']) && $rolesAccess['access_id']==4)
						echo "&nbsp;<a href='#' id='hold_app' class='btn btn-default'>Revert Back to Investor </a>";
					if(isset($rolesAccess['access_id']) && $rolesAccess['access_id']==5)
						echo "&nbsp;<a class='btn btn-success' target='_blank' href='".Yii::app()->createAbsoluteUrl('admin/ApplicationView/downloadapp/id/'). "/".$data['submission_id']."/name/".$app_name['application_name']."'> Print</a>";
					}
					if(isset($rolesAccess['access_id']) && $rolesAccess['access_id']==6){
						if(ApplicationVerificationLevelExt::getLastVerifierofApplication($data['submission_id'])){
							echo "&nbsp;<a class='btn btn-default' id='revert_back_prev_level' href='#'>Revert Back</a>";
						}
					}
					if(isset($rolesAccess['access_id']) && $rolesAccess['access_id']==7)
					   echo "&nbsp;<a class='btn btn-default' href='".Yii::app()->createAbsoluteUrl('admin/ApplicationView/revertToNodal/app_sub_id/'.base64_encode($data['submission_id']))."'> Revert To Nodal </a>";

				}
				
				?>
				
			</div>	
		</div>	
	</div>
</div>

<!-- Modal -->
<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="forward_to_multi_dept" class="modal fade">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title">Select the Departments</h4>
         </div>
         <div class="modal-body">
         <div class="row">
         <?php $Departments=DefaultUtility::getAllDept();
       	echo "<div class='row'>&nbsp;</div><div class='col-md-5'>
       	<form action='".Yii::app()->createAbsoluteUrl('admin/ApplicationView/forwardToDept')."' method='post'>
       	<select class='form-control MasterSelectBox' multiple></div>";
         foreach ($Departments as $dept) {
         		echo "<option value='$dept[dept_id]'>$dept[department_name]</option>";
         	}
         	echo "</select></div>";
         	echo "<div class='col-md-2'><a href='#' class='btn btn-default btn_select' id='btnAdd'>></a>
							<a href='#' class='btn btn-default btn_select' id='btnRemove'><</a></div>";
         	echo "<div class='col-md-5'><select class='PairedSelectBox' required multiple  name='forwardDept[]' style='min-width: 200px;float:left;'>
				  </select></div>";
				 echo "<input type='hidden' id='sub_id' name='app_sub_id' value='".$data['submission_id']."'>";
			echo "<div class='row'>&nbsp;</div><div class='row'>&nbsp;</div><div class='col-md-12'><textarea class='form-control' name='comments' placeholder='Enter Some Message' required></textarea>";
         ?>
            <div class="row"><span class="select_error"></span></div>
         </div>
         </div>
         <div class="modal-footer">
            <button data-dismiss="modal" class="btn btn-default" type="button">Cancel</button>
            <input type='submit' class="btn btn-success" value="Forward">
            </form>
         </div>
      </div>
   </div>
</div>


<!-- /Modal -->
<script type="text/javascript">
   $( document ).ready(function() {
   	var url ="<?php echo Yii::app()->createUrl('ajax/alldept');?>";
     	    getAllDeptAPI(url,'#ApplicationsFieldsMapping_dept_id');
    $('.MasterSelectBox').pairMaster();

    $('#btnAdd').click(function(){
    	$('.MasterSelectBox').addSelected('.PairedSelectBox');
    });

    $('#btnRemove').click(function(){
    	$('.PairedSelectBox').removeSelected('.MasterSelectBox'); 
    });
   });
</script>

<script type="text/javascript">
	$('#revert_back_prev_level').click(function(e){
		 e.preventDefault();
		 if(!confirm("Are you sure to revert back the application to Lower Level?"))
		 	return false;
		var sub_id=$("#sub_id").val();
		if(sub_id!=''){
			var comments=$("#apprvr_comments").val();
			if(comments.length==0){
				$("#error_comnt").text("Please give comments");
				return false;
			}
						var url="<?php echo Yii::app()->createAbsoluteUrl('/admin/ApplicationView/revertBacktoLower');?>";
						console.log(url);
						var app_id="<?php echo $data['application_id'];?>";
						var data={"sub_id":sub_id,"comments":comments};
						jQuery.ajax({
			            url: url,
			            type: 'POST',
			            dataType: 'json',
			            data: data,
			            success: function (data) {
			            	if(data!=''){
			            		$("#error_comnt").empty();
			            		$("#error_comnt").show();
			            		$("#error_comnt").text(data.status);
			            		console.log(data);
			            		window.location = "<?php echo Yii::app()->createUrl('/admin');?>";
								return true;
			            	}
			              
			            },
			            error: function (data) {
			                console.log(data);
			            }
			        });
		}
	})
	$('.forward_to_next_level').click(function(e){
		 e.preventDefault();
		 if(!confirm("Are you sure you want forward it to next Level ?"))
		 	return false;
		 var url="<?php echo Yii::app()->createUrl('/frontuser/ajax/checkForLast');?>";
		 var app_id="<?php echo $data['application_id'];?>";
		 var u_id="<?php echo $data['user_id'];?>";
		 var sub_app_id="<?php echo $data['submission_id'];?>";
		 			var data={"app_id":app_id,"user_id":u_id,"sub_app_id":sub_app_id};
		 			jQuery.ajax({
		             url: url,
		             type: 'POST',
		             dataType: 'json',
		             data: data,
		             success: function (data) {
		             	if(data!=''){
		             		if(data.STATUS==='NOT LAST'){
		             			console.log('here');
		             			$('.application_action_options').show();
		             		}
		             		else if(data.STATUS==='LAST'){
		             			console.log('LAS');
		             			$('.file_error').text("You can't forward it to next level. There is no another next role");
		             		}
		             	}
		               
		             },
		             error: function (data) {
		                 console.log(data);
		             }
		         });		 

		
	})
	$("#verify_app").click(function(e){
		 e.preventDefault();
		 if(!confirm("Are you sure you want Verify Application?"))
		 	return false;
		var sub_id=$("#sub_id").val();
		if(sub_id!=''){
			var comments=$("#apprvr_comments").val();
			if(comments.length==0){
				$("#error_comnt").text("Please give comments");
				return false;
			}
			var url="<?php echo Yii::app()->createUrl('/frontuser/ajax/applicationstatus');?>";
			var app_id="<?php echo $data['application_id'];?>";
			var data={"app_id":app_id,"sub_id":sub_id,"comments":comments};
			jQuery.ajax({
            url: url,
            type: 'POST',
            dataType: 'json',
            data: data,
            success: function (data) {
            	if(data!=''){
            		$("#error_comnt").empty();
            		$("#error_comnt").show();
            		$("#error_comnt").text(data.status);
            		console.log(data);
            		window.location = "<?php echo Yii::app()->createUrl('/admin');?>";
					return true;
            	}
              
            },
            error: function (data) {
                console.log(data);
            }
        });
		}
	});
	$("#revert_app").click(function(e){
		 e.preventDefault();
		 if(!confirm("Are you sure to revert back the application "))
		 	return false;
		var sub_id=$("#sub_id").val();
		if(sub_id!=''){
			var comments=$("#apprvr_comments").val();
			if(comments.length==0){
				$("#error_comnt").text("Please give Reason");
				return false;
			}
			var url="<?php echo Yii::app()->createUrl('/frontuser/ajax/revertApplicationtoPrevious');?>";
			var app_id="<?php echo $data['application_id'];?>";
			var data={"app_id":app_id,"sub_id":sub_id,"comments":comments};
			jQuery.ajax({
            url: url,
            type: 'POST',
            dataType: 'json',
            data: data,
            success: function (data) {
            	if(data!=''){
            		console.log(data);
            		$("#error_comnt").empty();
            		$("#error_comnt").show();
            		$("#error_comnt").text(data.status);
            		console.log(data);
            		window.location = "<?php echo Yii::app()->createUrl('/admin');?>";
					return true;
            	}
              
            },
            error: function (data) {
                console.log(data.status);
            }
        });
		}
	});
	$("#reject_app").click(function(e){
		 e.preventDefault();
		 if(!confirm("Are you sure you want Reject Application?"))
		 	return false;
		var sub_id=$("#sub_id").val();
		if(sub_id!=''){
			var comments=$("#apprvr_comments").val();
			if(comments.length==0){
				$("#error_comnt").text("Please give comments");
				return false;
			}
			var url="<?php echo Yii::app()->createUrl('/frontuser/ajax/applicationstatusreject');?>";
			var app_id="<?php echo $data['application_id'];?>";
			var data={"app_id":app_id,"sub_id":sub_id,"comments":comments};
			jQuery.ajax({
            url: url,
            type: 'POST',
            dataType: 'json',
            data: data,
            success: function (data) {
            	if(data!=''){
            		$("#error_comnt").empty();
            		$("#error_comnt").show();
            		$("#error_comnt").text(data.status);
            		window.location = "<?php echo Yii::app()->createUrl('/admin');?>";
					return true;
            	}
              
            },
            error: function (data) {
                console.log(data);
            }
        });
		}
	});
	$("#hold_app").click(function(e){
		 e.preventDefault();
		 if(!confirm("Are your sure to Revert back Application to investor?"))
		 	return false;
		var sub_id=$("#sub_id").val();
		if(sub_id!=''){
			var comments=$("#apprvr_comments").val();
			if(comments.length==0){
				$("#error_comnt").text("Please give comments");
				return false;
			}
			var url="<?php echo Yii::app()->createUrl('/frontuser/ajax/applicationstatushold');?>";
			var app_id="<?php echo $data['application_id'];?>";
			var data={"app_id":app_id,"sub_id":sub_id,"comments":comments};
			jQuery.ajax({
            url: url,
            type: 'POST',
            dataType: 'json',
            data: data,
            success: function (data) {
            	if(data!=''){
            		$("#error_comnt").empty();
            		$("#error_comnt").show();
            		$("#error_comnt").text(data.status);
            		window.location = "<?php echo Yii::app()->createUrl('/admin');?>";
					return true;
            	}
              
            },
            error: function (data) {
                console.log(data);
            }
        });
		}
	});
</script>
