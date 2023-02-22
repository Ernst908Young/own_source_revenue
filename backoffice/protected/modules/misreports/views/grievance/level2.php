<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<?php $baseUrl = Yii::app()->theme->baseUrl; ?>
<div class="dashboard-home">
    <div class="applied-status" >
        <ul class="breadcrumb">
         <li><a href="/backoffice/admin">Home</a></li>
           <li>Reports</li>
             <li>
            <a href="<?php echo @$_SESSION['tl1previousurl'] ?>">
              Grievance Redressal Report Level 1
            </a>
          </li>
          <li>Grievance Redressal Report Level 2</li>
          </ul>
    

<div class="reservation-form p-0">
<div class="form-part bussiness-det">                          
            <h4 class="form-heading">
			Grievance Redressal Report Level 2
            </h4>

        <div class="form-row row">          
	<table class="table table-striped table-bordered table-hover">					
	<tr>
		<td class="a_cent" style="font-size: 16px;"><strong style="color: #333; font-size: 16px;">Grievance ID: </strong> <?php echo $grievance['id']; ?></td>
		<td class="a_cent" style="font-size: 16px;"><strong style="color: #333; font-size: 16px;">Grievance Type: </strong> <?php echo ($grievance['category']=="Ticket" || $grievance['category']=="Query") ? 'Existing '.$grievance['category'] : $grievance['category']; ?></td>
	</tr>
	<tr>
		<td class="a_cent" style="font-size: 16px;"><strong  style='color: #333; font-size: 16px;'>Status: </strong>
			<?php 
				$status_arr = ['O'=>'Open','W'=>'Withdrawn','RV'=>'Reverted','RS'=>'Resolved','RO'=>'Reopened','C'=>'Closed','ESC'=>'Escalated'];
				echo  '<span class="label label-success">'. array_key_exists($grievance['status'],$status_arr) ? $status_arr[$grievance['status']] : 'NA' .'</span>' ?> 
		</td>
		<td class="a_cent" style="font-size: 16px;"><strong  style='color: #333; font-size: 16px;'>Created On: </strong> <?php echo date("d M Y h:i a",strtotime($grievance['created_on'])) ?>   </td>
	<tr>
		<td class="a_cent" style="font-size: 16px;" colspan="2"><strong  style='color: #333; font-size: 16px;'>Priority: </strong><?php echo  $grievance['priority']; ?></td>
	</tr>
	</tr>	
			<tr>
				<td colspan="3"><strong  style='color: #333; font-size: 16px;'>Documents: </strong>
					<?php 
					$files_arr = [];
					foreach($messages as $mk=>$mv){
					$filesdoc = Yii::app()->db->createCommand("SELECT * FROM grievancefiles WHERE gm_id=".$mv['id'])->queryAll(); 
					foreach ($filesdoc as $key => $value) {
						$files_arr[] = $value;
					}
				}

				$count  = count($files_arr);
				$i=1;
				foreach ($files_arr as $f => $d) {
					$sep = ($i==$count) ? '': ',';
					echo  '<a target="_blank" href="'.$d['msgfilepath'].'" style="color:blue;">Document '.($f+1).' </a>'.$sep;
					$i++; }
					?>
				</td>
			</tr>
			<tr>
				<td class="a_cent" colspan="3" style="font-size: 16px;">
					<strong  style='color: #333; font-size: 16px;'>Currently Assigned To BO User: </strong><?php
$grievance_currently_assign_to = $grievance['currently_assign_to'] ? $grievance['currently_assign_to'] : 0;
$assto_user = Yii::app()->db->createCommand("SELECT * from bo_user Where uid=".$grievance_currently_assign_to)->queryRow();
$au =  $assto_user ? ( $assto_user['full_name'].' '.$assto_user['middle_name'].' '.$assto_user['last_name'].' '.$assto_user['email']) : 'NA';

						echo  $au;	 ?>
				</td>
			</tr>
</table>

 <div class="col-md-12">
        <strong  style='color: #333;'>Subject: </strong> 
        <br><?php echo  $grievance['subject']; ?>
          </div>

<hr style="color: #36c6d3;" />	
	<strong style="color: #000;">Replies Received</strong>
				<?php foreach($messages as $mk=>$mv){ ?><br><br>
				<small>
					<div class="row">
						<div class="col-md-3">
				<strong>By: </strong> 
					<?php echo $mv['user_type']=='AU' ? "Applicant User" : "Support Team User" ?> 
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