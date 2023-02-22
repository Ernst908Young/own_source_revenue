<div class="dashboard-home">
    <div class="applied-status">
    	<ul class="breadcrumb">
          <li><a href="/panchayatiraj/backoffice/investor/home/investorWalkthrough">Home</a></li>
      
          <li>Notifications</li>
        </ul>      
    </div>
</div>
<div class="row">
	<div class="col-md-6 reservation-form">
		<div class="form-part bussiness-det">   
		    <h4 class="form-heading">Notification Details</h4>
		    <div class="form-row row"> 
		    	<?php 
		    		switch ($model->module_name) {
		    			case 'Services':
		    				$code_label = 'SRN No.';
		    				break;
		    			case 'Ticket':
		    				$code_label = 'Ticket ID';
		    				break;
		    			case 'Query':
		    				$code_label = 'Query ID';
		    				break;		    			
						case 'Grievance':
							$code_label = 'Grievance ID';
							break;		    			
						default:
		    				$code_label = 'Code';
		    				break;
		    		}
		    	?>
		        <table class="table table-striped table-bordered table-hover">					
					<tr>
						<td><b>Notification Type</b></td>
						<td><?= $model->module_name ?></td>
					</tr>
					<tr>
						<td><b><?= $code_label ?></b></td>
						<td><?= $model->module_code ?></td>
					</tr>
					<tr>
						<td><b>Message</b></td>
						<td><?= $model->notify_text ?></td>
					</tr>
					<tr>
						<td><b>Created On</b></td>
						<td><?= date('d-m-Y h:i a',strtotime($model->created_on)) ?></td>
					</tr>
				</table>
		        	 
				
		    </div>		   
		</div>
	</div>
	<div class="col-md-6 reservation-form">
		<?php 
				$notificationcount = 0;

				if(isset($_SESSION['RESPONSE']['user_id'])){
				    if($_SESSION['RESPONSE']['user_id']!=''){
				        $uid = $_SESSION['RESPONSE']['user_id'];
				        $notification = Yii::app()->db->createCommand("SELECT * From alert_notification where user_type='FO' AND created_by=$uid AND is_seen=0 order by id desc")->queryAll();
				        $notificationcount = sizeof($notification);
				       
				    }

				}else{
					$notificationcount = 0;

if(isset($_SESSION['uid'])){
    if($_SESSION['uid']!=''){
        $uid = $_SESSION['uid'];
        $notification = Yii::app()->db->createCommand("SELECT * From alert_notification where user_type='BO' AND created_by=$uid AND is_seen=0 order by id desc")->queryAll();
        $notificationcount = sizeof($notification);
       
    }

}
				} ?>
		<div class="form-part bussiness-det">   
		    <h4 class="form-heading">Unseen Notifications #<?= $notificationcount ?></h4>
		    <div class="form-row row"> 
		        	
		       <?php if(isset($notification)){
                    if(is_array($notification)){ ?>
                    	<table class="table table-striped table-bordered table-hover">					
							<tr>
								
								<th>Code</th>
								<th>Message</th>
								<th>Created On</th>
							</tr>
                     <?php  foreach ($notification as $key => $value) { ?>
                        	 <tr>
                        	 	<td>
                        	 		<a href="<?= Yii::app()->createAbsoluteUrl('/profile/notification/dashboard',array('an_id'=>base64_encode($value['id']),'nc'=>base64_encode(true)))?>" title="<?= $value['notify_text'] ?>" style="color:blue;">
                        	 		<?= $value['module_code']?>
                        	 		</a>
                        	 	</td>
                        	 	<td>
                        	 		
                                         <b><?= $value['module_name']?> : </b>   
                                        <?= mb_strimwidth($value['notify_text'],0,50,'...') ?>
                        	 	</td>
                        	 	<td>
                        	 		<?= date('d-m-Y h:i a',strtotime($value['created_on'])) ?>
                        	 	</td>
                        	 </tr>
                        
                       <?php }
                    }
                } ?> 	 
				
		      
		    </div>
		</div>
	</div>
</div>
