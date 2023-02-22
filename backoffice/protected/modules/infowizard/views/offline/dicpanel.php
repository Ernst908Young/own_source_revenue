<?php $flg=0; ?>

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

<h4 class="row alert alert-warning" style="text-align:center;" ><b>Physical Document Acceptence Panel</b></h4>

<div class="site-min-height">

    <section class='panel'><div style='color:#797979; font-size:18px' class='panel-heading'><b>Service Name :

            <?php
		$datavalue=count($saveddata);	
$stringArr=array();  
if(!empty($saveddata)) { 
foreach($saveddata as $rstl)
{
$stringArr[]=$rstl['doc_id'];  
$var = $implodedString=implode(",",$stringArr);
$options=explode(',',$var);
}}
else {
 $options=array(); } 

             $sql="SELECT core_service_name FROM bo_information_wizard_service_parameters WHERE service_id='$_GET[serviceID]' AND servicetype_additionalsubservice='$_GET[subserviceID]' LIMIT 1";

                                                                              

                                                                        $connection=Yii::app()->db; 

                                                                         $command=$connection->createCommand($sql);

                                                                         $services=$command->queryAll();

                                                                         if(!empty($services))

                                                                         echo $services[0]['core_service_name']; ?>

            </b>

<t class='pull-right'>&nbsp;&nbsp;<b>Offline Application Id ::<?php echo $_GET['appID']; ?></b></t></div>



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

        <div class='row'>&nbsp;</div><div id='heading'>Acknowledge Receipt of Offline Documents</div>

        <div class="row-fluid">
            <form  name="form" action="" method="post" enctype= "multipart/form-data">
		

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

									

		<?php $ddd=1; if(!empty($other_doc)){  $cno=1; foreach ($other_doc as $key => $docfields) { if ($docfields['type_of_document']=='S') { ?>

									<tr>

									<td>1.<?php echo $cno; ?></td>

									<td><?php echo $docfields['document_name']; ?></td>

									<td><?php if (!empty($docfields['document_file_name'])) {   ?>                                                                             
		<a href="/themes/backend/mydoc/IUID/<?php echo $docfields['document_file_name'];?>" target="_blank"class="btn btn-warning">View Document</a>

                                                                             

		<?php } ?>

</td>

									<td>
									<?php if(!in_array($docfields['id'],$options)) {  $ddd++;  ?>
                                            <input type="hidden" name="doccccc_id[]" value="<?php echo $docfields['id']; ?>" />
                                                                            <select class="form-control forward" name="received[]">

                                                                              <option value="Not Received">Not Received</option>

                                                                              <option value="Received">Received</option><option value="Mismatch">Mismatch</option>

                                                                        </select>
																		
									<?php 
										if($flg==0){$flg=1;}
									 } if(in_array($docfields['id'],$options)) { 
								
									
									?> 
				<button type="button" class="btn btn-primary">Recieved &nbsp; <span class="badge"><i class="fa fa-check "></i></span></button>
									
									<?php  } ?>

                                                                        </td></tr>

									<?php }}} ?>

									<tr>

									<td colspan="5"></td>

									</tr>

	<?php   if(!empty($other_doc)){ $countno=1; foreach ($other_doc as $key => $docfields) { if ($docfields['type_of_document']=='O') { 
									   ?>

									<tr>

									<td>2.<?php $ddd++; echo $countno++; ?></td>

									<td><?php echo $docfields['document_name']; ?></td>

									<td><?php if (!empty($docfields['document_file_name'])) {   ?>

                                                                            

   <a href="/themes/backend/mydoc/IUID/<?php echo $docfields['document_file_name'];?>" target="_blank" class="btn btn-warning">View Document</a>

		<?php } ?>

</td>

									<td>
                                               <?php if(!in_array($docfields['id'],$options))  { $ddd++; ?>
                                                   <input type="hidden" name="doccccc_id[]" value="<?php echo $docfields['id']; ?>"  />
                                                                            <select class="form-control forward" name="received[]">

                                                                              <option value="Not Received">Not Received</option>

                                                                              <option value="Received">Received</option><option value="Mismatch">Mismatch</option>

                                                                        </select>
																		
									<?php  if($flg==0){$flg=1;}} if(in_array($docfields['id'],$options)) { ?> 
				<button type="button" class="btn btn-primary">Recieved &nbsp; <span class="badge"><i class="fa fa-check "></i></span></button>
									
									<?php  } ?>


                                                                        </td></tr>

									<?php } } } ?>



									<tr>

									<td colspan="5"></td>

									</tr>

									

									<?php   if(!empty($docs)){ $count=1;  foreach ($docs as $key => $appfields) {?>

									<tr>

									<td>3.<?php $ddd++; echo $count++; ?></td>

									<td><?php //echo $appfields['name'];

                                                                       $sql="SELECT docchk_id FROM cdn_dms_documents WHERE documents_id='$appfields[documents_id]' LIMIT 1";

                                                                              

                                                                        $connection=Yii::app()->db; 

                                                                         $command=$connection->createCommand($sql);

                                                                         $services=$command->queryAll();

                                                                         $doocchkID=$services[0]['docchk_id'];

                                                                          $sql="SELECT name FROM bo_infowizard_documentchklist WHERE docchk_id='$doocchkID' LIMIT 1";

                                                                            $connection=Yii::app()->db; 

                                                                         $command=$connection->createCommand($sql);

                                                                         $documentName =$command->queryAll();

                                                                         echo $documentName[0]['name'];

                        //print_r($services);

                                                                        

                                                                        

                                                                        

                                                                        ?></td>

									<td><?php if (!empty($appfields['document_file_name'])) {   

            $hj=   explode("_UK-DCL", $appfields['document_file_name']);       ?>      <a href="/themes/backend/mydoc/<?php echo $hj[0];?>/<?php echo $appfields['document_file_name'];?>" target="_blank"class="btn btn-warning">View Document</a>

		<?php } ?>

</td>

									<td>

                                                                       <?php if(!in_array($appfields['documents_id'],$options)) { $ddd++; ?>
                                                                     <input type="hidden" name="doccccc_id[]" value="<?php echo $appfields['documents_id']; ?>"  />
                                                                            <select class="form-control forward" name="received[]">

                                                                              <option value="Not Received">Not Received</option>

                                                                              <option value="Received">Received</option><option value="Mismatch">Mismatch</option>

                                                                        </select>
																		
									<?php  if($flg==0){$flg=1;}} if(in_array($appfields['documents_id'],$options)) { ?> 
				<button type="button" class="btn btn-primary">Recieved &nbsp; <span class="badge"><i class="fa fa-check "></i></span></button>
									
									<?php  } ?>


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

<!-----//////////////////////////////////////////////////////////////////////////////////////////////------->
<div class='row'>&nbsp;</div>

<div id='heading' align="left"> Timeline </div>
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
															 <?php if($allStatus['status']=="AD"){ echo "Acknowldge Document"; }?>
                                                            <?php if($allStatus['status']=="P"){ echo "Application Pending"; }?>
                                                            <?php if($allStatus['status']=="IP"){ echo "Internal Processing"; }?>
                                                            <?php if($allStatus['status']=="I"){ echo "Incomplete"; }?>
                                                            <?php if($allStatus['status']=="A"){ echo "Application Approved"; }?>
                                                            <?php if($allStatus['status']=="F"){ echo "Application Forwarded"; }?>
                                                        
                                                        
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
                                                            <?php } ?>&nbsp;<?php echo $allStatus['comment']; ?></td>        
                                                        
                                                        <td><?php echo $allStatus['created_date']?></td>        
                                                          </tr>           
                                                                         <?php }}
                                                                        // echo "<tr><td colspan='5'>No comment for this application</td></tr>";
                                                                         ?>
                                                        
                                                    </tr>
                                                </table>
                                                </div>





<!-----//////////////////////////////////////////////////////////////////////////////////////////////------->










<div class='row'>&nbsp;</div>

<div id='heading' align="left"> Aplication Proccessing </div>

        

		  			

					<div class="row">

					<div class="col-md-12">

					 <table class='table'>

					 <tr>

					 <td>Comments :</td>

                                         <td><textarea id="comment" name="comment" class="form-control" required></textarea></td>

					 <td >Action : </td>

					 <td ><select id="status" name="status" class="form-control acilppr" >

					 <option value="" >Select Action</option>

				<?php if($flg==0){ ?>	<option value="F"  >Forward to Department</option><?php } ?>
					<?php if($flg==1){ ?><option value="AD" >Acknowledge of Document</option><?php } ?>

					<option value="RBI" >Revert Back to Investor</option>

					</select></td>

					</tr>
					
					<tr>

					 <td colspan=>Upload :</td>

                     <td><input type="file" id="upload" name="upload"/></td>
					 <td colspan="2"></td>
					
                     </tr>

					 <tr class="allhide">
 <td>Mode of Forward of Physical Copy :  </td>
					

					 <td><select id="tracking_detail_dic" name="tracking_detail_dic" class="form-control" >

					<option value="Self">Self</option>

					<option value="Courier">Courier</option>

					<option value="Runner">Runner</option>

					</select></td>

					 <td>Tracking Details :</td>

                                         <td><textarea id="mode_of_submission_dic" name="mode_of_submission_dic" class="form-control"></textarea></td>

					

					</tr>


					</table>

					

					

					

					</div></div>

					

					

				
    <div class="row buttons" align="center">
	<input type="hidden" value="<?php echo $ddd-1; ?>" name="dddd"  />
	<input type="submit" class="btn btn-primary ack" value="Acknowledge of Document">
    <input type="submit" class="btn btn-default revert" value="Revert Back To Investor">
	<input type="submit"  class="btn btn-primary allhide" value="Forword To Department">
	</div> 
           



      </div>

   </div>

</div>

</div>



<!-- /Modal -->

<script>

        

        $(document).ready(function(){ 

             $(".allhide").hide();
			  $(".revert").hide();  
               $(".ack").hide();
            $("#status").change(function(){ 

                  $(".allhide").hide(); 
                   $(".revert").hide();
				    $(".ack").hide();
             // alert($(this).val());

		     if($(this).val()=="F"){

              $(".allhide").show();  
             }
		  
		  if($(this).val()=="RBI"){

              $(".revert").show();  
             } 
			 if($(this).val()=="AD"){

              $(".ack").show();  
             }

        });
        });
		 
		/*function hideAction(){
        var flg=0;
		$(".forward").each(function(){
		if($(this).val()=="Not Received"){
		flg=1;
		}
		
		});
		if(flg==1){
		$(".action1").hide();
		}else{
                   $(".action1").show(); 
                }
		}
		hideAction();
		$(".forward").change(function(){
		hideAction();
		});*/

   
		
	// forward action1 action2	
	


        </script>