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
</style>
<div class="site-min-height">
<?php
	$this->breadcrumbs=array(
	'Application View',
);
$app_name=ApplicationExt::getAppNameViaId($data['application_id']);
echo "<section class='panel'><div style='color:#797979;font-size:1.8em' class='panel-heading'> <b>Application Name: ". $app_name['application_name'];
echo "<t class='pull-right'>&nbsp;&nbsp;Submit Id: ".$data['submission_id']."<input type='hidden' id='sub_id' value='".$data['submission_id']."'>&nbsp;&nbsp;</t></b></div>";
	
echo "<div class='row'>";
foreach(Yii::app()->user->getFlashes() as $key => $message) {
	echo '<font color="red"><div class="alert-message error"><p>' . $message . "</font></p></div>\n";
}
echo "</div>";
echo "<section class='panel-body'>";
$fields=json_decode($data['field_value']);

	echo "<div class='row'>";
	foreach ($fields as $key => $fields) {
		
		if(is_array($fields)){
			echo"
				<div class='row $key'>
	    	      <div class='form-group col-md-12'>
					<label class='control-label col-md-10'>$key</label>";
			foreach ($fields as $key => $fields) {
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
				  		<label class='control-label'>$key</label>
				  		<input type='text' readonly name='$key' value='$fields' class='form-control'>
					   </div>
					</div>";
			if($count%2 == 1)
			echo "</div>";
			$count++;
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
			<label class='control-label'>Other Verifier Comments:</label>
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

		foreach ($docs as $doc) {
			echo "<div class='row'>";
			echo "<div class='form-group last'>
                                          <label class='control-label col-md-3'> $doc[doc_name]</label>
                                          <div class='col-md-3'>
                                              <div class='fileupload fileupload-new'>
                                                  <div class='fileupload-preview fileupload-exists thumbnail' style='max-width: 200px; max-height: 150px; line-height: 20px;'>
                                                  <img src='data:".$doc['doc_type'].";base64, $doc[doc_blob_data]' />
                                                  </div>
                                              </div>
                                              <span class='label label-danger'>";
                                              	 if($doc['doc_status']=='P')
                                              	 	echo "Pending for verification";
                                              	 elseif($doc['doc_status']=='V')
                                              	 	echo "Verified";
                                              	 elseif($doc['doc_status']=='R')
                                              	 	echo "Rejected";

                                              echo "</span>
                                          </div>
                                          <div class='col-md-5 form-inline' style='margin-bottom:5px'>";
                                           if($doc['doc_status']=='P'){
                                           	$status_pen=true;
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
                                          		
                                          echo "</div>
                                      </div>";
            echo "</div>";
		}
	}
?>



<div class="row ">
	<div class="file_error" style="color:red">
	</div>
</div>

<div class="row"> &nbsp;</div>
<div id="heading">Verifier Documents</div>
	<div class="row">
		<?php 
			if(isset($verifier_docs) && !empty($verifier_docs)){
				foreach ($verifier_docs as $doc) {
				  echo "<div class='row'>";
				        echo "<div class='col-md-6'>
					            <label class='control-label col-md-4'>Uploaded Documents $doc->doc_name</label>
					    		<div class='col-md-3'>
					            	<div class='fileupload fileupload-new'>
					                	<div class='fileupload-preview fileupload-exists thumbnail' style='max-width: 200px; max-height: 150px; line-height: 20px;'>
					                    	<img src='data:".$doc->document_mime_type.";base64, $doc->document' />
					                    </div>
					                </div>
					            </div>
					        <div>
					   </div>";
				}
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
		<div class='col-md-12 text-center'>
			<div class='form-group'>	
				<a class="btn btn-info" id="revert_back_dept"> Revert Back </a>
				<a class="btn btn-success" href="<?php echo Yii::app()->createAbsoluteUrl('admin/ApplicationView/downloadapp/id/');echo "/".$data['submission_id']."/name/".$app_name['application_name'];?>"> Print</a>
			</div>	
		</div>	
	</div>
</div>


<script type="text/javascript">
	$('#revert_back_dept').click(function(e){
				 e.preventDefault();
				 if(!confirm("Are you sure you want Revert back Application?"))
				 	return false;
				var sub_id=$("#sub_id").val();
				if(sub_id!=''){
					var comments=$("#apprvr_comments").val();
					if(comments.length==0){
						$("#error_comnt").text("Please give comments");
						return false;
					}
					var url="<?php echo Yii::app()->createUrl('/frontuser/ajax/revertBackToDept');?>";
					var app_id="<?php echo $data['application_id'];?>";
					var data={"app_id":app_id,"sub_id":sub_id,"comments":comments};
					jQuery.ajax({
		            url: url,
		            type: 'POST',
		            dataType: 'json',
		            data: data,
		            success: function (data) {
		            	if(data!=''){
		            		alert(data.STATUS);
		            		$("#error_comnt").empty();
		            		$("#error_comnt").show();
		            		$("#error_comnt").text(data.status);
		            		/*window.location = "<?php //echo Yii::app()->createUrl('/admin');?>";*/
							return true;
		            	}
		              
		            },
		            error: function (data) {
		                console.log(data);
		            }
		        });
				}
			
				 
		
	})
</script>