<div class="dashboard-home">
    <div class="applied-status" >
        <ul class="breadcrumb">
          <li><a href="/backoffice/admin">Home</a></li>
          <li><a href="/backoffice/ticketing/default/supportindex">Ticket</a></li>
          <li>Ticket Details</li>
          </ul>
     
</div>
</div>
  <div class="reservation-form" style="margin-bottom: 10px;">   
<div class="form-part bussiness-det">   
        <h4 class="form-heading">Ticket Details</h4>
        <div class="form-row row">       
				<table class="table table-striped table-bordered table-hover">				
				<tr>
					<td class="a_cent" style="font-size: 16px;"><strong style="color: #333; font-size: 16px;">Ticket ID: </strong> <?php echo $ticket['supporttypecode']; ?></td>
					<td class="a_cent" style="font-size: 16px;"><strong style="color: #333; font-size: 16px;">SRN: </strong> <?php echo $ticket['srn_app_id']; ?></td>
								
				</tr>
				<tr>
					<td class="a_cent" style="font-size: 16px;"><strong style="color: #333; font-size: 16px;">Service Category: </strong> <?php echo $ticket['category_name']; ?></td>		
					<td class="a_cent" style="font-size: 16px;"><strong style="color: #333; font-size: 16px;">Service Name: </strong> <?php echo $ticket['service_name']; ?></td>
				</tr>
				<tr>

					
					<td class="a_cent" style="font-size: 16px;"><strong  style='color: #333; font-size: 16px;'>Status: </strong>
						<?php  $status_arr = ['O'=>'Open','RV'=>'Reverted','RS'=>'Resolved','RO'=>'Reopened','C'=>'Closed','ESC'=>'Escalated'];
               echo (array_key_exists($ticket['status'],$status_arr) ? $status_arr[$ticket['status']] : 'NA'); ?>  
					</td>
					<td class="a_cent" style="font-size: 16px;"><strong  style='color: #333; font-size: 16px;'>Created On: </strong> <?php echo date("d M Y h:i a",strtotime($ticket['created_on'])) ?>   </td>
				</tr>			
			
				<tr>
					<td class="a_cent" style="font-size: 16px;"><strong  style='color: #333; font-size: 16px;'>Priority: </strong><?php echo  $ticket['supportprioritycode']; ?></td>
					<td class="a_cent" style="font-size: 16px;">
						<strong  style='color: #333; font-size: 16px;'>Currently Assigned To BO User: </strong><?php
$ticket_currently_assign_to = $ticket['currently_assign_to'] ? $ticket['currently_assign_to'] : 0;
$assto_user = Yii::app()->db->createCommand("SELECT * from bo_user Where uid=".$ticket_currently_assign_to)->queryRow();
    $au =  $assto_user ? ( $assto_user['full_name'].' '.$assto_user['middle_name'].' '.$assto_user['last_name'].' '.$assto_user['email']) : 'NA';

						 echo  $au;	 ?>
					</td>
				</tr>
				<tr>
				<td colspan="3"><strong  style='color: #333; font-size: 16px;'>Documents: </strong>
					<?php 
					$files_arr = [];
					foreach($messages as $mk=>$mv){
					$filesdoc = Yii::app()->db->createCommand("SELECT * FROM supportmsgfiles WHERE supportmessagescode=".$mv['supportmessagescode'])->queryAll(); 
					foreach ($filesdoc as $key => $value) {
						$files_arr[] = $value;
					}
				}

				$count  = count($files_arr);
				$i=1;
				foreach ($files_arr as $f => $d) { 
					$sep = ($i==$count) ? '': ',';
					
					?>

					<a target="_blank" href="/backoffice/doc/mydoc?view=<?php echo DefaultUtility::getDockey($d['msgfilepath']); ?>&from=ticket"style="color:blue;">
                       Document <?= ($f+1)?><?php echo $sep; ?>
                    </a>

					<!-- echo  '<a target="_blank" href="'.$d['msgfilepath'].'" style="color:blue;">Documnet '.($f+1).', </a>'; -->
				<?php 
				$i++; 	
			}
					?>
				</td>
			</tr>			
			</table>

			<span class="hidden" id="supportmaincode_text"><?php echo  $ticket['supportmaincode'] ?></span>

<?php  

if(($ticket['status']=='O' || $ticket['status']=='ESC' || $ticket['status']=='RV' || $ticket['status']=='RO') && $_SESSION['role_id']=='85'){
	?>

<div class="assigntohigauth">
	<div class="col-md-6 form-group text-start mb-3" id="div_cat_select">
                   
                <label>Escalate to next level</label>	   	
 
	   		<select name="bo_user" id="bo_user" class="select2-me"  onchange="assignbouser($(this).val())">
				<option value="">Select User</option>
				<?php 	
			$bo_user = Yii::app()->db->createCommand("SELECT * FROM bo_user WHERE is_active=1 ")->queryAll();				
					foreach ($bo_user as $key => $bo_userval) { ?>
					<option value="<?php echo $bo_userval['uid']; ?>" >
						<?php echo $bo_userval['full_name'].' '.$bo_userval['middle_name'].' '.$bo_userval['last_name'].' '.$bo_userval['email']; ?>
					</option>
				<?php } ?>
			</select>  
		<span id="bo_user-error" style="color: red;"></span>	
  
    </div>
</div>
<?php }else{
	
} ?>

			<strong  style='color: #333;'>Subject: </strong> 
			<div class="row">
						<div class="col-md-12">
			<?php echo  $ticket['subject']; ?>
		</div></div>
			<br><br>
	<?php 
		if(($ticket['status']=='O' || $ticket['status']=='RV' || $ticket['status']=='RO') && $_SESSION['role_id']=='85'){ 
			if($ticket['currently_assign_to']==$_SESSION['uid'] || $ticket['currently_assign_to']==0){
	?>
				<form id="sticket_form" method="post" action="<?php echo Yii::app()->createAbsoluteUrl("/ticketing/default/statuspriority"); ?>" enctype="multipart/form-data">
					<input type="hidden" name="supportmaincode" value="<?php echo  $ticket['supportmaincode'] ?>">
				<div class="row">
					<div class="form-group col-md-4">
						<label>Set Priority</label>
							<?php
								$pri = array('Normal'=>'Normal','Medium'=>'Medium','High'=>'High','Low'=>'Low');
							?>

							<select name="tktpri" placeholder="Select Ticket Priority" class="form-control" id="tktpri" onchange="ajaxsubmit()">
							
								<?php foreach ($pri as $key => $val) { 
									$pri_selected = $val== $ticket['supportprioritycode'] ? 'selected': '';
									?>
								<option value="<?php echo $key; ?>" <?php echo $pri_selected?>><?php echo $val; ?></option>
							<?php } ?>
						</select>  
						<span id="tktpri-error" style="color: red;"></span>	   		
	   				</div>
	   				
	   			<!-- 	<div class="form-group col-md-4" style="margin-top: 25px;">
			   	      <span onclick="" id="stfs" class="btn btn-primary" style="font-size: 18px; width: 120px;">Update</span>
			   	    </div> -->
				</div>
			</form>
<?php }} ?>


			<hr style="color: #36c6d3;" />	
	<strong style="color: #000;">Replies Received</strong>
				<?php foreach($messages as $mk=>$mv){ ?><br><br>
						<small>
					<div class="row">
						<div class="col-md-8">
				<strong>By: </strong> 
					<?php echo $mv['usertype']=='AU' ? "Applicant User" : "Support Team User" ?> 
						</div>
						<div class="col-md-4">
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<strong>On: </strong> <?php echo date("d M Y h:i a",strtotime($mv['msgdatetime'])) ; ?><br>
						
					</div>
						
					</div>
				</small>
				<div class="row">
						<div class="col-md-12">
				<?php echo $mv['message']; ?><br><hr style="color: #36c6d3;" />	
			</div>
		</div>

				<?php } ?>
		

	<?php if($ticket['status']=='O' || $ticket['status']=='RV' || $ticket['status']=='RO' || $ticket['status']=='ESC'){ ?>
		<?php if($ticket['currently_assign_to']==$_SESSION['uid'] || $ticket['currently_assign_to']==0){ ?>
		
			<form id="sticket_msg_form" method="post" action="<?php echo Yii::app()->createAbsoluteUrl("/ticketing/default/supportticketdetail/sm_id/$sm_id"); ?>" enctype="multipart/form-data">
				<div class="row">
					<div class="form-group col-md-12">
						<label><strong style="color: #000;">Reply Message</strong>&nbsp;<span style="color:red">*</span></label>
						<textarea name="message" id="message" placeholder="Enter your Message here" rows='12' maxlength="1000" class="form-control" required></textarea>
						<!-- <small><span id="char_world">1000</span>/1000 characters remaining</small> -->
					</div>
					</div>
					<div class="row" style="margin-top: 10px;">
						<div class="form-group col-md-6">
						<label>Status</label>
					

							<select name="status" placeholder="Select status" class="form-control" id="status" required>
							<option value="<?php echo $ticket['status'];?>">Current Status: <?php echo  $status_arr[$ticket['status']] ?></option>
								<?php
$asts = ['RV'=>'Reverted','RS'=>'Resolved','C'=>'Closed','ESC'=>'Escalated'];
								 foreach ($asts as $key => $val) { 
									
									?>
								<option value="<?php echo $key; ?>" ><?php echo $val; ?></option>
							<?php } ?>
						</select> 
					</div>
					<div class="form-group col-md-6" style="margin-top: 25px;">

						 
						<span id="status-error" style="color: red;"></span>	   		
	   			
						 <button type="submit" class="btn btn-primary" style="width: 120px; margin-top: 10px;">Send</button>
					</div>
				</div>
			</form>
		<?php }} ?>
	</div>
</div>
</div>
<!--?php Yii::app()->clientScript->registerScript('myjquery','$("#stfs").submit(function(e) {
	ajaxsubmit(e);
}'); ?-->

<script type="text/javascript">
	function ajaxsubmit(){
		if(confirm('Are you sure to change the priority')){
	    var form = $("#sticket_form");
	    var url = form.attr('action');
		$.ajax({
	            type: "POST",
	            dataType:'json',
	            data: form.serialize(), // serializes the form's elements.
	            url: url,
	            beforeSend:function(){		           
					$("#tktpri-error").text("Please Wait...");        	        	
	            },
	            success: function(result) {	         		            		
        			$("#tktpri-error").text("");
        			tid = result.tid;      		            		
        				 window.location.href = "/backoffice/ticketing/default/supportticketdetail/sm_id/"+tid;		         
        		  //  alert("ticket has been updated");	
        		   }
		        });
	}else{
		return false;
	}
	}

function assignbouser(uid){
	var tid = $("#supportmaincode_text").text();
	if(uid){
		if(confirm('Are you sure to assign this ticket to next level')){
			$.ajax({
		            type: "POST",
		            dataType:'json',
		            data: {uid:uid,tid:tid}, // serializes the form's elements.
		            url: "/backoffice/ticketing/default/assignnextlevel",
		            beforeSend:function(){		           
						$("#bo_user-error").text("Please Wait...");        	        	
		            },
		            success: function(result) {	    		            		
        				 window.location.href = "/backoffice/ticketing/default/supportindex";
	        		   }
			        });
		}else{
			return false;
		}
	}
			
}
</script>

<script type="text/javascript">
	$(document).ready(function(){
		
		/*$("#message").keypress(function(){
			var messageword = $("#messageword").text();
			if(messageword<=0){
				return false;
			}else{
				$("#messageword").text(messageword-1);
			}
			

		});*/
	});
	$( document ).ready(function() {
    var maxLength = 1000;
    $('textarea').keyup(function() {
        var length = $(this).val().length;
        var length = maxLength-length;
        $('#char_world').text(length);
    });
});
</script>


<script src="/backoffice/themes/swcsNewTheme/fb/vendors/base/vendors.bundle.js" type="text/javascript"></script>
<script src="/backoffice/themes/swcsNewTheme/fb/demo/default/base/scripts.bundle.js" type="text/javascript"></script>
<script src="/backoffice/themes/swcsNewTheme/fb/demo/default/custom/components/forms/wizard/onboard_serviceprovider.js" type="text/javascript"></script>
<script src="<?= Yii::app()->theme->baseUrl ?>/assets/global/plugins/jquery-repeater/jquery.repeater.js" type="text/javascript">
</script>
<script src="<?= Yii::app()->theme->baseUrl ?>/assets/pages/scripts/form-repeater.min.js" type="text/javascript">
</script>
<!-- form repeater js -->

<link rel="stylesheet" href="<?= Yii::app()->theme->baseUrl ?>/assets/frontend/dashboard/css/plugins/select2/select2.css">
<!-- select2 -->
<script src="<?= Yii::app()->theme->baseUrl ?>/assets/frontend/dashboard/js/plugins/select2/select2.min.js"></script>
<!-- Theme framework -->
<script src="<?= Yii::app()->theme->baseUrl ?>/assets/frontend/dashboard/js/eakroko.min.js"></script>