<div class="dashboard-home">
    <div class="applied-status">
    	<ul class="breadcrumb">
          <li><a href="/panchayatiraj/backoffice/investor/home/investorWalkthrough">Home</a></li>
        
          <li>Your Account Details</li>
          </ul>
      
             </div>
        </div>
        <?php if(Yii::app()->user->hasFlash('success')): ?>

<h5 style="text-align: center; color: green;">
	<?php echo Yii::app()->user->getFlash('success'); ?>
</h5>

<?php endif; ?>
<div class="reservation-form">
	<div class="form-part bussiness-det">   
        <h4 class="form-heading">Your Account Details</h4>
        <div class="form-row row"> 
        	<?php $userdetails = Yii::app()->db->createCommand("SELECT * FROM sso_users WHERE user_id=".$_SESSION['RESPONSE']['user_id'])->queryRow();
        	$profiledetail = Yii::app()->db->createCommand("SELECT * FROM sso_profiles WHERE user_id=".$_SESSION['RESPONSE']['user_id'])->queryRow();     	
        	 ?>
        	 <table class="table table-striped table-bordered table-hover">					
				<tr>
					<td class="a_cent" style="font-size: 16px;"><strong style="color: #333; font-size: 16px;">Full Name: </strong> <?php echo $profiledetail['first_name'].' '.$profiledetail['surname'].' '.$profiledetail['last_name']; ?></td>
					<!-- <td class="a_cent" style="font-size: 16px;"><strong style="color: #333; font-size: 16px;">Pan Card Number: </strong> <1?php echo $profiledetail['pan_card']; ?></td> -->
					<td class="a_cent" style="font-size: 16px;"><strong  style='color: #333; font-size: 16px;'>IUID: </strong> <?= $userdetails['iuid']  ?>
					</td>
					
				</tr>
				<tr>
					<td class="a_cent" style="font-size: 16px;"><strong style="color: #333; font-size: 16px;">Address: </strong> <?php 

  $country = Yii::app()->db->createCommand("SELECT lr_id,lr_name from bo_landregion where lr_id=".$profiledetail['country_name'])->queryRow(); 

  $state = Yii::app()->db->createCommand("SELECT lr_id,lr_name from bo_landregion where lr_id=".$profiledetail['state_name'])->queryRow(); 

					echo $profiledetail['address'].' '.$profiledetail['address2'].' '.$profiledetail['city_name'].' '.$profiledetail['distt_name'].' '.$profiledetail['pin_code'].' '.$state['lr_name'].' '.$country['lr_name']; ?>
				</td>

					<td class="a_cent" style="font-size: 16px;"><strong style="color: #333; font-size: 16px;">Mobile Number: </strong> <?php echo $profiledetail['mobile_number']; ?>
				</td>
				</tr>

				<tr>
					
					<td class="a_cent" style="font-size: 16px;"><strong  style='color: #333; font-size: 16px;'>Email: </strong> <?= $userdetails['email']  ?>   
					</td>
						<td class="a_cent" style="font-size: 16px;"><strong  style='color: #333; font-size: 16px;'>Created On: </strong><?= date('d-m-Y h:i s',strtotime($userdetails['created_on'])) ?> 
					</td>
				</tr>
					
</table>
		
        </div>
        <div class="form-row" style="text-align: center;">
        	<div class="col-lg-12">
        		<a href="/panchayatiraj/backoffice/profile/default/editdetails" title="change password" class="btn-primary">Edit Profile</a>
 			<a href="/panchayatiraj/backoffice/profile/default/changepassword" title="change password" class="btn-primary">Change Password</a>

 		</div>
        </div>

    </div>

</div>