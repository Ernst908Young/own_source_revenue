<div class="dashboard-home">
    <div class="applied-status">
    	<ul class="breadcrumb">
          <li><a href="/panchayatiraj/backoffice/admin">Home</a></li>
           
         </li>
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
        	<?php $userdetails = Yii::app()->db->createCommand("SELECT * FROM bo_user WHERE uid=".$_SESSION['uid'])->queryRow();
        
        	 ?>
        	 <table class="table table-striped table-bordered table-hover">					
				<tr>
					<td class="a_cent" style="font-size: 16px;"><strong style="color: #333; font-size: 16px;">Full Name: </strong> <?php echo $userdetails['full_name'].' '.$userdetails['middle_name'].' '.$userdetails['last_name']; ?></td>
				
					
					
				</tr>
				<tr>
					

					<td class="a_cent" style="font-size: 16px;"><strong style="color: #333; font-size: 16px;">Mobile Number: </strong> <?php echo $userdetails['mobile']; ?>
				</td>
				</tr>

				<tr>
					
					<td class="a_cent" style="font-size: 16px;"><strong  style='color: #333; font-size: 16px;'>Email: </strong> <?= $userdetails['email']  ?>   
					
				</tr>
					
</table>
		
        </div>
        <div class="form-row" style="text-align: center;">
        	<div class="col-lg-12">
        		<a href="/panchayatiraj/backoffice/profile/default/editdetailsbo" title="change password" class="btn-primary">Edit Profile</a>
 			<a href="/panchayatiraj/backoffice/profile/default/changepasswordbo" title="change password" class="btn-primary">Change Password</a>

 		</div>
        </div>

    </div>

</div>