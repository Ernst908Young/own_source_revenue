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
.btn-success {
    color: #fff;
    background-color: #5cb85c;
    border-color: #4cae4c;
}
.btn-success {
    color: #fff;
    background-color: #5cb85c;
    border-color: #4cae4c;
}
</style>
<h4 class="row alert alert-warning" style="text-align:center;" ><b>Offline Processing Panel</b></h4>
<div class="site-min-height">
    <section class='panel'><div style='color:#797979;font-size:1.2em' class='panel-heading'> <small>Service Name : <?php
             $sql="SELECT core_service_name FROM bo_information_wizard_service_parameters WHERE service_id='$_GET[serviceID]' AND servicetype_additionalsubservice='$_GET[subserviceID]' LIMIT 1";
                                                                              
                                                                        $connection=Yii::app()->db; 
                                                                         $command=$connection->createCommand($sql);
                                                                         $services=$command->queryAll();
                                                                         if(!empty($services))
                                                                         echo $services[0]['core_service_name']; ?></small>
<t class='pull-right'>&nbsp;&nbsp;<small>Offline Application Id :<?php echo $_GET['appID']; ?></small></t></div>

<section class='panel'>


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
										<th>View Document</th>
										<th>Document Received Status</th>
										
									</tr>
									</thead>
									
									<?php    if(!empty($other_doc)){  foreach ($other_doc as $key => $docfields) { if ($docfields['type_of_document']=='S') { ?>
									<tr>
									<td>1.1</td>
									<td><?php echo $docfields['document_name']; ?></td>
									<td><?php if (!empty($docfields['document_file_name'])) { 
                                                                              $hj=   explode("_UK-DCL", $docs[0]['document_file_name']);   $IUID=$hj[0]   ?>      <a href="/themes/backend/mydoc/<?php echo $IUID;?>/offline/<?php echo $docfields['document_file_name'];?>" target="_blank"class="btn btn-success">View Document <span class="badge"><i class="fa fa-file"></i></span></a>
                                                                              
 
                                                                             
		<?php } ?>
</td>
									<td>
                                                                                 <button type="button" class="btn btn-primary">Received &nbsp;<span class="badge"><i class="fa fa-check "></i></span></button>
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
                                                                            
                                                                                                                                   $hj=   explode("_UK-DCL", $docs[0]['document_file_name']);   $IUID=$hj[0]   ?>      <a href="/themes/backend/mydoc/<?php echo $IUID;?>/offline/<?php echo $docfields['document_file_name'];?>" target="_blank"class="btn btn-success">View Document <span class="badge"><i class="fa fa-file"></i></span></a>
		<?php } ?>
</td>
                                                  
</td>
									<td>
                                                                               <button type="button" class="btn btn-primary">Received &nbsp; <span class="badge"><i class="fa fa-check "></i></span></button>
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
                                                                            
                                                                            
                                                                            
                                                                                                                                $hj=   explode("_UK-DCL", $appfields['document_file_name']);       ?>      <a href="/themes/backend/mydoc/<?php echo $hj[0];?>/<?php echo $appfields['document_file_name'];?>" target="_blank"class="btn btn-success">View Document <span class="badge"><i class="fa fa-file"></i></span></a>
		<?php } ?>
</td>
									<td>
                                                                       <button type="button" class="btn btn-primary">Received &nbsp;<span class="badge"><i class="fa fa-check "></i></span></button>
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
<div id='heading' align="left">Timeline </div>
       
		  			
					<div class="row">
                                            <div class="col-md-12">
                                                <table class="table">
                                                    <tr>
                                                        <th>From</th><th>Action</th><th>Status By Department</th> <th>Comment</th><th>Comment Date</th>
                                                        
                                                     	<?php  $isAccepted=0; $sql="SELECT * FROM bo_offline_forward_level WHERE offline_application_id='$_GET[appID]' ORDER BY created_date DESC";
                                                                        $connection=Yii::app()->db; 
                                                                         $command=$connection->createCommand($sql);
                                                                         $as=$command->queryAll();
                                                                       //  print_r($allStatus);die;
                                                                         foreach($as as $allStatus){ 
                                                                             if(!empty($as)){
                                                                             ?>
                                                        <tr>
                                                        <td><?php echo $allStatus['sender']?></td>        
                                                        <td>
                                                            <?php if($allStatus['status']=="R"){ echo "Application Rejected"; }?>
                                                            <?php if($allStatus['status']=="RBI"){ echo "Application Reverted"; }?>
                                                            <?php if($allStatus['status']=="AA"){$isAccepted=1; echo "Application Accepted"; }?>
                                                            <?php if($allStatus['status']=="P"){ echo "Application Pending"; }?>
                                                            <?php if($allStatus['status']=="IP"){ echo "Internal Processing"; }?>
                                                            <?php if($allStatus['status']=="I"){ echo "Incomplete"; }?>
                                                            <?php if($allStatus['status']=="A"){ echo "Application Approved"; }?>
                                                            <?php if($allStatus['status']=="F"){ echo "Application Forwarded"; }?>
                                                            <?php if($allStatus['status']=="AD"){ echo "Acknowldge Document"; }?>
                                                        
                                                        
                                                        </td>        
                                                        <td><?php 
                                                        
                                                          
                                                        $sql="SELECT * FROM bo_information_wizard_offline_status WHERE id='$allStatus[offline_status_id]'";
                                                                        $connection=Yii::app()->db; 
                                                                         $command=$connection->createCommand($sql);
                                                                         $ast=$command->queryAll();
                                                                         if(!empty($ast)){
                                                                             echo $ast[0]['status_name'];
                                                                         }
                                                        
                                                        ?></td>  
                                                        <td>
                                                            <?php if(!empty($allStatus['upload'])){ ?>
                                                            <a href="<?php echo $allStatus['upload']?>"  target="_blank"><i class="fa fa-file"></i></a>
                                                            <?php } ?>&nbsp;<?php echo $allStatus['comment']?></td>        
                                                        
                                                        <td><?php echo $allStatus['created_date']?></td>        
                                                          </tr>           
                                                                         <?php }}
                                                                        // echo "<tr><td colspan='5'>No comment for this application</td></tr>";
                                                                         ?>
                                                        
                                                    </tr>
                                                </table>
                                                </div>
                                            <form action="/backoffice/infowizard/offlineStatus/addComment/appID/<?php echo $_GET['appID']; ?>" method="post" id="offlineComment" enctype= multipart/form-data>
					<div class="col-md-12">
                                            
                                         
                                            
					 <table class='table'>
                                              <tr>
					 <td style="width:200px;"> Status</td>
                                        <td><select class="form-control" id="approverAction" name="action" >
                                       <?php if($isAccepted==0){   ?> <option value="">Select Action</option> 
                                        <option value="Accept">Accept Application</option>
                                          <option value="Revert">Revert Back To Investor</option>
                                       <option value="Reject">Reject Application</option> 
                                           <?php }else{ ?>
                                       <option value="Accept">Accept Application</option>                                       
                                       <?php } ?>
                                       
                                         </select>
                                             <input type="hidden" name="approved" id="applicationApproved" value="">
                                         </td>
                                         </tr>			
					</table>
                                            </div>
                                            <div class="col-md-12">
                                             
					
<table class="Accept  <?php if($isAccepted==0){   ?>hideit<?php }  ?> processingPanel table"> 
    <tr><td colspan="2" class="alert alert-warning" style="text-align:center;"><b>Process Application</b></td></tr>
    <tr>
                      <td style="width:200px;">Action </td>
					 <td><select id="status" name="status" class="form-control acilppr">
					
					<?php  $sql="SELECT * FROM bo_information_wizard_offline_status WHERE service_id='$_GET[serviceID]' AND servicetype_additionalsubservice=$_GET[subserviceID]";
                                                                              
                                                                        $connection=Yii::app()->db; 
                                                                         $command=$connection->createCommand($sql);
                                                                         $allStatus=$command->queryAll();
                                                                         if(empty($allStatus)){
                                                                            echo "<option value=''>No Status Available</option>"; 
                                                                         }else{
                                                                             ?>
                                                  <option value="" >Select Processing</option>
                                                 <?php
                                                                         foreach($allStatus as $as){ ?>
                                                                             <option value="<?php echo $as['id']; ?>"><?php echo $as['status_name']; ?></option>
                                                                  <?php       }   
                                                                         }
                                                                        ?> 
					</select></td>
    </tr>
    
</table>
                                                </div>
                                                <div class="col-md-12"><div style="width:192px;float: left;">Upload Document</div><div class="col-md-9">
                                                        <input type="file" name="file"></div>
                                                <br>
                                                <br>
                                                </div>
                                            <div class="col-md-12">
<table class="table">
     <tr>
         <td style="width:200px;">Comments<span style="color:red;">*</span></td>
         <td><textarea id="comment" name="comment" class="form-control" required></textarea></td>
     </tr>
</table>					
</div>
                                            
                                            <div class="row" style="text-align:center;">           
                                              <?php if($isAccepted=="0"){ ?>
                                                <input type="submit" class="btn btn-default Revert hideit" value="Revert Back To Investor">
                                                <input type="submit" class="btn btn-success Accept hideit approveIT" rel="AA" value="Proceed">
                                                <input type="button" class="btn btn-primary hideit approveIT" value="Approve Application" >
                                                <input type="submit"  class="btn btn-danger Reject hideit" value="Reject Application" >                                                   
                                              <?php }else{ ?>
                                                <input type="submit" class="btn btn-default Revert approveIT" rel="RBI" value="Revert Back To Investor">
                                                <input type="submit" class="btn btn-success Accept approveIT" rel="IP" value="Proceed">
                                                <input type="button" class="btn btn-primary Accept approveIT" rel="A" value="Approve Application">
                                                <input type="submit"  class="btn btn-danger Reject approveIT" rel="R" value="Reject Application">                                                 
                                                <?php } ?>
         </div>
                                            </form>
                                        </div>				
           

      </div>
   </div>
</div>
</div>

<!-- /Modal -->
<script>
        
        $(document).ready(function(){
              <?php if($isAccepted=="1"){ ?>$(".processingPanel").show(); <?php } ?>
             $(".allhide").hide(); 
            $("#status").change(function(){ 
                  $(".allhide").hide(); 
               if($(this).val()=="F"){
              $(".allhide").show();  
          }
                
            });
            
            $(".hideit").hide();
            
            $("#approverAction").change(function(){
               $(".hideit").hide();
              var selectedAction= $(this).val();
              $("."+selectedAction).show();
              if(selectedAction=="Accept"){
                 $(".processingPanel").hide();
              }else{
                  $(".processingPanel").show();  
              }
            });
            
             $(".approveIT").click(function(){
             
                var ty=$(this).attr('rel');
                $("#applicationApproved").val(ty);
                
             if(ty=="A"){ var r=  confirm('Are you sure you want to approve this application'); 
                //  alert("Approved "+r);
               if (r == true){  $("#offlineComment").submit();return true; }else{ return false; }
             }
             
             if(ty=="R"){ var r = confirm('Are you sure you want to reject this application');
                   //  alert("Reject "+r);
            if (r == true){  $("#offlineComment").submit(); return true;  }else{ return false; }     
            }
              
           
                
            });
        })
        </script>