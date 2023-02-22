<?php $basePath="/themes/investuk"; ?>
<div class="container" style="font-family: 'Montserrat', sans-serif; font-size: 14px;" >
	<div style="margin-top: 20px;">
		<h3 style="font-size: 25px;">Entity Documents Details</h3>
    </div>
<br>

<table class="table table-bordered">
	<tr>
		<th>#</th>	
		<th>Entity Name</th>
		<th>Document Category</th>
		<th>Document Name</th>
		<th>Document download expiry date</th>
		<th>Status</th>	
		<th>Action</th>	
	</tr>
	<?php $i = 1;
	foreach($model  as $key => $v){  ?>
			<tr>
				<td>				    			
	    			<?= $key+1 ?>
	    		</td>
	    		<td>
	    			<?= $v['company_name'] ?>	
	    		</td>
	    		<td>
	    			<?= $v['core_service_name'] ?>
	    		</td>
	    		<td>
	    			<?= $v['ser_name_for_documentname'] ?>
	    			<?php if($v['doc_name']=='certificate'){
			    				echo 'Certificate';
			    			}else{
			    				echo 'Application Form';
			    			}
			    			?>
	    		</td>
	    		
	    		<td>
	    			<?= $v['expired_on'] ? date('d-m-Y',strtotime($v['expired_on'])) : "NA" ?>
	    		</td>
	    		<td>
	    			<div id="status_<?= $v['id'] ?>">
	    			<?php 
	    			
	    			switch ($v['doc_status']) {
                        case 'PD':
                            $s = 'Payment Due';
                            break;
                        case 'PI':
                            $s = 'Payment Initiate';
                            break;
                        case 'P':
                            $s = 'Download Pending';
                            break;
                        case 'D':
                            $s = 'Downloaded';
                            break;
                        case 'E':
                            $s = 'Expired';
                            break;
                        
                        default:
                            $s = $v['doc_status'];
                            break;
                    }
	    			echo $s;
	    			 ?>
	    			</div>
	    		</td>
	    		<td>
	    			<?php 
	    			if($v['doc_status']=="PD"){ ?>
	    				<a href="/backoffice/investor/vpd/payment" style="color: blue;">
	    					Make Payment
	    				</a>
	    				
	    				<!-- <a href="/backoffice/investor/vpd/delete/vpd_id/<1?= $v['id'] ?>" style="color: blue;">Delete</a> -->
	    			<?php } ?>

    				<?php if($v['doc_status']=="P"){ ?>
    						<div id="link_<?= $v['id'] ?>">
    						<a href="/backoffice/investor/vpd/download/vpd_id/<?= base64_encode($v['id']) ?>" onclick="downloadjs(<?= $v['id'] ?>)" style="color: blue;">
	    						Download
	    					</a>
	    				</div>

 		<!--  <a href="#" onclick="downloadpdf(<?= $v['id'] ?>)" style="color: blue;">
            Download
          </a> --><?php } ?>
	    		
	    			 <?php if($v['doc_status']=='PI'){ ?>
                          <a target="_blank" href="<?php echo Yii::app()->createAbsoluteUrl('investor/vpd/printofflinefeeform/vpd_id/'. base64_encode($v['id']));?>" title="Offline Payment Form">  
                          <img src="<?php echo $basePath; ?>/assets/applicant/images/ic_print_refund.png">
                      <?php } ?>
	    		</td>
	    		
	    	</tr>		    
	<?php   } ?>
</table>

<div style="text-align: center;">
		
			<a class="btn btn-primary backbtn mx-2" href="javascript:;" onclick="window.history.go(-1);">Back</a> 
		</div>

<script type="text/javascript">
	function downloadjs(vpd_id){
		$("#link_"+vpd_id).html("");
		$("#status_"+vpd_id).html("Downloaded");
	}
	/*function downloadpdf(vpd_id){
     $('#logmodal').modal('show');
     $.ajax({
                type: "POST",
                  dataType: 'json',
                url: "/backoffice/investor/vpd/download/vpd_id/"+vpd_id,              
                 beforeSend:function(){
                      $("#logdatamsg").text("Please wait...");
                },
                success: function(result) {    
                	alert(result);
                if(result==true){
                   console.log('make your code after success');
                }else{
                	console.log('Something went wrong')
                   
                }                                  
              }             
            });
  }*/
</script>