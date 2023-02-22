<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<?php $baseUrl = Yii::app()->theme->baseUrl; ?>
<div class="dashboard-home">
    <div class="applied-status" >
        <ul class="breadcrumb">
         <li><a href="/backoffice/admin">Home</a></li>
           <li>Reports</li>
             <li>
            <a href="<?php echo @$_SESSION['tl1previousurl'] ?>">
              Ticketing Report Level 1
            </a>
          </li>
          <li>Ticketing Report Level 2</li>
          </ul>
    

<div class="reservation-form p-0">
<div class="form-part bussiness-det">                          
            <h4 class="form-heading">
          		Ticketing Report Level 2
            </h4>

        <div class="form-row row">          
	<table class="table table-striped table-bordered table-hover">					
	<tr>
		<td class="a_cent" style="font-size: 16px;"><strong style="color: #333; font-size: 16px;">Ticket ID: </strong> <?php echo $ticket['supporttypecode']; ?></td>
		<td class="a_cent" style="font-size: 16px;"><strong style="color: #333; font-size: 16px;">SRN: </strong> <?php echo $ticket['srn_app_id']; ?></td>
		<td class="a_cent" style="font-size: 16px;"><strong style="color: #333; font-size: 16px;">Service Category: </strong> <?php echo $ticket['category_name']; ?></td>
	</tr>
	<tr>
		<td class="a_cent" style="font-size: 16px;"><strong style="color: #333; font-size: 16px;">Service Name: </strong> <?php echo $ticket['service_name']; ?></td>
		
		<td class="a_cent" style="font-size: 16px;"><strong  style='color: #333; font-size: 16px;'>Status: </strong>
			<?php 
				if($ticket['status']=='O'){
					$status = 'Open';
				}
				if($ticket['status']=='RV'){
					$status = 'Reverted';
				}
				if($ticket['status']=='RS'){
					$status = 'Resolved';
				}
				if($ticket['status']=='RO'){
					$status = 'Reopened';
				}
				if($ticket['status']=='C'){
					$status = 'Closed';
				}
				if($ticket['status']=='ESC'){
					$status = 'Escalated';
				}
			?>
			<?php 
			echo  '<span class="label label-success">'.$status.'</span>' ?> 
		</td>
		<td class="a_cent" style="font-size: 16px;"><strong  style='color: #333; font-size: 16px;'>Created On: </strong> <?php echo date("d M Y h:i a",strtotime($ticket['created_on'])) ?>   </td>
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

				foreach ($files_arr as $f => $d) {
					echo  '<a target="_blank" href="'.$d['msgfilepath'].'" style="color:blue;">Documnet '.($f+1).', </a>';
				}
					?>
				</td>
			</tr>
			<tr>
				<td class="a_cent" colspan="3" style="font-size: 16px;">
					<strong  style='color: #333; font-size: 16px;'>Currently Assigned To BO User: </strong><?php
						$ticket_currently_assign_to = $ticket['currently_assign_to'] ? $ticket['currently_assign_to'] : 0;
						$assto_user = Yii::app()->db->createCommand("SELECT * from bo_user Where uid=".$ticket_currently_assign_to)->queryRow();
						$au =  $assto_user ? ( $assto_user['full_name'].' '.$assto_user['middle_name'].' '.$assto_user['last_name'].' '.$assto_user['email']) : 'NA';

						echo  $au;	 ?>
				</td>
			</tr>
</table>

 <div class="col-md-12">
        <strong  style='color: #333;'>Subject: </strong> 
        <br><?php echo  $ticket['subject']; ?>
          </div>

<hr style="color: #36c6d3;" />	
	<strong style="color: #000;">Replies Received</strong>
				<?php foreach($messages as $mk=>$mv){ ?><br><br>
				<small>
					<div class="row">
						<div class="col-md-3">
				<strong>By: </strong> 
					<?php echo $mv['usertype']=='AU' ? "Applicant User" : "Support Team User" ?> 
						</div>
						<div class="col-md-4">
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<strong>On: </strong> <i><?php echo date("d M Y h:i a",strtotime($mv['msgdatetime'])) ; ?></i><br>
						
					</div>
						<div class="col-md-4"></div>
					</div>
				</small>
				 <div class="row">
		            <div class="col-md-12">
		            <?php echo $mv['message']; ?>
		          </div>
		        </div>
				<?php } ?>
		
		
		</div>
		</div>

</div>

<script type="text/javascript">
	$(document).ready(function(){
	
	});
</script>