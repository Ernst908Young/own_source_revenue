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
<h4 class="row alert alert-warning" style="text-align:center;" ><b>Offline Processing Panel</b></h4>
<div class="site-min-height">
    <section class='panel'><div style='color:#797979;font-size:1.8em' class='panel-heading'> <small>Service Name : <?php
             $sql="SELECT core_service_name FROM bo_information_wizard_service_parameters WHERE service_id='$_GET[serviceID]' AND servicetype_additionalsubservice='$_GET[subserviceID]' LIMIT 1";
                                                                              
                                                                        $connection=Yii::app()->db; 
                                                                         $command=$connection->createCommand($sql);
                                                                         $services=$command->queryAll();
                                                                         if(!empty($services))
                                                                         echo $services[0]['core_service_name']; ?></small>
<t class='pull-right'>&nbsp;&nbsp;<small>Offline Application Id :<?php echo $_GET['appID']; ?></small></t></div>

<section class='panel'>

<!--/*<div class="row-fluid">
	<div class='col-md-6 comments'>
		<div class='form-group'>
			<label class='control-label'>Comments From Previous Level:</label>
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
			<label class='control-label'>Comments:</label>
			<textarea class='form-control apprvr_comments' placeholder="Enter Your Comments&hellip;" required id="apprvr_comments" name='apprvr_comments'></textarea>
		</div>
		<div class="row" id="error_comnt" style="color:red"></div>
	</div>
</div>	*/-->

<div class="row-fluid">
		<div class='col-md-12 text-center' style="top:10px;">
			<div class='form-group'>
			<table class='table table-bordered'>
				                <thead>
									<tr><td>Application Preview</td></tr>
									</thead></table>	
			</div>	
	</div>
 </div>
        <div class='row'>&nbsp;</div><div id='heading'>Offline Application Documents Uploaded </div>
        <div class="row-fluid">
		  			<div class="col-md-12">
				    <table class='table table-bordered'>
				                <thead>
									<tr>
										<th>S.No.</th>
										<th>Document Name</th>
										<th>View/Download</th>
										<th>Action</th>
										
									</tr>
									</thead>
									
									<?php    if(!empty($other_doc)){  foreach ($other_doc as $key => $docfields) { if ($docfields['type_of_document']=='S') { ?>
									<tr>
									<td>1.1</td>
									<td><?php echo $docfields['document_name']; ?></td>
									<td><?php if (!empty($docfields['document_file_name'])) { 
 
                                                                            ?>                                                                             <a href="/themes/backend/mydoc/IUID/<?php echo $docfields['document_file_name'];?>" target="_blank"class="btn btn-warning">View Document <span class="badge"><i class="fa fa-file"></i></span></a>
                                                                             
		<?php } ?>
</td>
									<td>
                                                                                 <button type="button" class="btn btn-primary">Recieved &nbsp;<span class="badge"><i class="fa fa-check "></i></span></button>
                                                                        </td></tr>
									<?php }}} ?>
									<tr>
									<td colspan="5"></td>
									</tr>
									<?php if(!empty($other_doc)){ $countno=1; foreach ($other_doc as $key => $docfields) { if ($docfields['type_of_document']=='O') {  ?>
									<tr>
									<td>2.<?php echo $countno++; ?></td>
									<td><?php echo $docfields['document_name']; ?></td>
									<td><?php if (!empty($docfields['document_file_name'])) {   
                                                                            
                                                                                                                                $hj=   explode("_UK-DCL", $docfields['document_file_name']);       ?>      <a href="/themes/backend/mydoc/<?php echo $hj[0];?>/offline/<?php echo $docfields['document_file_name'];?>" target="_blank"class="btn btn-warning">View Document <span class="badge"><i class="fa fa-file"></i></span></a>
		<?php } ?>
</td>
                                                  
</td>
									<td>
                                                                               <button type="button" class="btn btn-primary">Recieved &nbsp; <span class="badge"><i class="fa fa-check "></i></span></button>
                                                                        </td></tr>
									<?php } } } ?>

									<tr>
									<td colspan="5"></td>
									</tr>
									
									<?php    if(!empty($docs)){ $count=1; foreach ($docs as $key => $appfields) {?>
									<tr>
									<td>3.<?php echo $count++; ?></td>
									<td><?php //echo $appfields['name'];
                                                                       $sql="SELECT docchk_id FROM cdn_dms_documents WHERE documents_id='$appfields[documents_id]' LIMIT 1";
                                                                              
                                                                        $connection=Yii::app()->db; 
                                                                         $command=$connection->createCommand($sql);
                                                                         $services=$command->queryAll();
                                                                         $doocchkID=$services[0]['docchk_id'];
                                                                           if(!empty($doocchkID)){
                                                                          $sql="SELECT name FROM bo_infowizard_documentchklist WHERE docchk_id='$doocchkID' LIMIT 1";
                                                                            $connection=Yii::app()->db; 
                                                                         $command=$connection->createCommand($sql);
                                                                         $documentName =$command->queryAll();
                                                                         if(!empty($documentName)){
                                                                         echo $documentName[0]['name'];
                                                                         }
                                                                           }
                        //print_r($services);}
                                                                        
                                                                        
                                                                        
                                                                        ?></td>
									<td><?php if (!empty($appfields['document_file_name'])) {   
                                                                            
                                                                            
                                                                            
                                                                                                                                $hj=   explode("_UK-DCL", $appfields['document_file_name']);       ?>      <a href="/themes/backend/mydoc/<?php echo $hj[0];?>/<?php echo $appfields['document_file_name'];?>" target="_blank"class="btn btn-warning">View Document <span class="badge"><i class="fa fa-file"></i></span></a>
		<?php } ?>
</td>
									<td>
                                                                       <button type="button" class="btn btn-primary">Recieved &nbsp;<span class="badge"><i class="fa fa-check "></i></span></button>
                                                                        </td>
									
									</tr>
									<?php }  }?>
									</table>
									
							           
    <?php    if(empty($docs)){
      echo '<div class="row">
			  <div class="col-md-10 col-md-offset-1 text-center">
			    <h5 class="col-md-12 control-label alert alert-info col-md-3"> No Documents</h5>
			  </div>
			</div>';
      } ?>



	
</div></div>



<div class='row'>&nbsp;</div>
<div id='heading' align="left">Comments : </div>
       
		  			
					<div class="row">
					<div class="col-md-12">
					 <table class='table'>
                                              <tr>
					 <td> Action :</td>
                                         <td><select class="form-control" id="approverAction">
                                         <option value="Accept">Accept Application</option>
                                         <option value="Revert">Revert Back To Investor</option>
                                         <option value="reject">Reject Application</option>
                                         </select></td>
                                         </tr>			
					</table>
					
<table class="Accept hideit"> 
    <tr><td colspan="2" class="alert alert-success">Process Application</td></tr>
    <tr>
                      <td>Action :</td>
					 <td><select id="status" name="status" class="form-control acilppr" >
					
					<?php  $sql="SELECT * FROM bo_information_wizard_offline_status WHERE service_id='$_GET[serviceID]' AND servicetype_additionalsubservice=$_GET[subserviceID]";
                                                                              
                                                                        $connection=Yii::app()->db; 
                                                                         $command=$connection->createCommand($sql);
                                                                         $allStatus=$command->queryAll();
                                                                         if(empty($allStatus)){
                                                                            echo "<option value=''>No Status Available</option>"; 
                                                                         }else{
                                                                             ?>
                                                  <option value="" >Select Action</option>
                                                 <?php
                                                                         foreach($allStatus as $as){ ?>
                                                                             <option value="<?php echo $as['id']; ?>"><?php echo $as['status_name']; ?></option>
                                                                  <?php       }   
                                                                         }
                                                                        ?> 
					</select></td>
    </tr>
    
</table>			
<table>
     <tr>
	 <td>Comments :</td>
         <td><textarea id="comment" name="comment" class="form-control"></textarea></td>
     </tr>
</table>					
</div>
                                        </div>				
           
<div class="row" style="text-align:center;">           
     <input type="button" class="btn btn-default Revert hideit" value="Revert Back To Investor">
     <input type="button"  class="btn btn-danger Reject hideit" value="Reject Application">     
 </form>
         </div>
      </div>
   </div>
</div>
</div>

<!-- /Modal -->
<script>
        
        $(document).ready(function(){
             $(".allhide").hide(); 
            $("#status").change(function(){ 
                  $(".allhide").hide(); 
             // alert($(this).val());
		     if($(this).val()=="F"){
              $(".allhide").show();  
          }
                
            });
        })
        </script>