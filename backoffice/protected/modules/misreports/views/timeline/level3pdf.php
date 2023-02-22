<?php
$subID = $sub_id;
$sql="SELECT * from bo_infowiz_form_builder_application_log where app_Sub_id=$subID group by action_status,created order by created ASC";
$connection=Yii::app()->db; 
$command=$connection->createCommand($sql);
$res = $command->queryAll();
  
    
?>

<?php 
    $connection = Yii::app()->db;
    //$submission_id= $_GET['subID'];
    $sql = "SELECT sso_users.*,
	sso_profiles.*,
	bo_new_application_submission.* from sso_users LEFT JOIN sso_profiles on sso_users.user_id=sso_profiles.user_id LEFT JOIN bo_new_application_submission on sso_users.user_id=bo_new_application_submission.user_id where bo_new_application_submission.submission_id=$subID";
    $command = $connection->createCommand($sql);
    $invData = $command->queryRow();  
?>



<table style="padding-top: 10px; border-collapse: collapse; padding: 5px;">                 
	<thead>   
		<tr style="font-size: 10;">
			<th width="5%" style="border: 1px solid black; text-align: center;"><strong>SR. No.</strong>
			</th>
			
			<th width="40%" style="border: 1px solid black; text-align: center;"><strong>Activity</strong> 
			</th>
			<th width="40%" style="border: 1px solid black; text-align: center;">
				<strong>Action Taken By</strong>
			</th>
			<th width="15%" style="border: 1px solid black; text-align: center;"><strong>Timestamp</strong> 
			</th>                              
			
		   
		   
		</tr>
    </thead>
	<tbody>
	<?php
		$sql = "SELECT u.first_name,u.last_name,u.surname,sso.email,sso.mobile_no,bo_new_application_submission.*,
					bo_sp_application_history.application_status as current_status,
					bo_sp_application_history.added_date_time,
					bo_sp_application_history.comments,
					bo_sp_application_history.role_user_info
					from bo_sp_application_history
					LEFT JOIN bo_new_application_submission on bo_sp_application_history.app_id=bo_new_application_submission.submission_id
					left JOIN sso_profiles u on bo_new_application_submission.user_id=u.user_id
					left JOIN sso_users sso on bo_new_application_submission.user_id=sso.user_id where bo_sp_application_history.app_id=$subID";
		$command = $connection->createCommand($sql);
		$apps = $command->queryAll();
		
		$count = 1;
		if (empty($apps)) {

			echo "<tr><td colspan='5'>No Detail Found</td></tr>";
		} else { 
			
			$apps1 = $apps;
			$diffapplicant = 0;
			$diffdept = 0;
			$diffdept12=0;
			foreach($apps1 as $key => $apps) 
			{                        
				$appsgf = $apps['current_status'];
				$status = $apps['current_status'];
				if($appsgf != "I") 
				{
				?>
					<tr id="<?php echo $key; ?>">
						<td width="5%" style="border: 1px solid black; text-align: center;">
							<p><?php echo $count++; ?></p>
						</td>
						<td width="40%" style="border: 1px solid black; text-align: center;">
							<?php echo $apps['comments']; ?>
						</td>
					    <td width="40%" style="border: 1px solid black; text-align: center;">
							 <?php if($apps['role_user_info']){
                                        echo $apps['role_user_info'];
                                    }else{
                                        echo $apps['first_name'].' '.$apps['last_name'].' '.$apps['surname'].'<br>'. $apps['email'].'<br>'. $apps['mobile_no'];
                                    } ;?>
						</td>
						<td width="15%" style="border: 1px solid black; text-align: center;">
							<?php  
							echo  date('d-M-Y H:i:s', strtotime($apps['added_date_time']));
								/*if ($apps['current_status'] != "RBI") {
								
									if ($key == 0) {
										if ($status == "A" || $status == "R") {
											$date = $apps['added_date_time'];
										} else {
											
											if(isset($unverifiedDocExist['totalDocV']) && $unverifiedDocExist['totalDocV'] > 0)
											{
												$date = $apps['added_date_time'];
											} else{
												$date = date('Y-m-d H:i:s');
											}
										}
									} else {
										$keyval = $key - 1;
										$date = $apps1[$keyval]['added_date_time'];
									}

									$diff1 = abs(strtotime($apps['added_date_time']) - strtotime($date));
									$diffdept = $diffdept + $diff1;
									$years = floor($diff1 / (365 * 60 * 60 * 24));
									$months = floor(($diff1 - $years * 365 * 60 * 60 * 24) / (30 * 60 * 60 * 24));
									$days = floor(($diff1 - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24) / (60 * 60 * 24));
									$hours = floor(($diff1 - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24) / (60 * 60));
									$minuts = floor(($diff1 - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24 - $hours * 60 * 60) / 60);
									$seconds = floor(($diff1 - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24 - $hours * 60 * 60 - $minuts * 60));
									$allDays = ($months * 30) + $days;
									if($years!=0){echo "$years years,";}
									printf("%d days, %d hrs, %d min\n", $allDays, $hours, $minuts);
								  // printf("%d days", $allDays);
								} */
							?>
						</td>
					</tr>

				<?php
					}
				}
			}
			?>     
	</tbody>
</table>