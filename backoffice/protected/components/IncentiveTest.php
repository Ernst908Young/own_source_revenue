<?php
	class IncentiveTest{
		static function getDeptMob($dept_id,$role_id,$app_sub_id){
			$application=IncentiveSchemes::loadApplication($app_sub_id,true);
			$distt=$application['landrigion_id'];
		 	$sql="SELECT * from bo_user usr
				inner join bo_user_role_mapping url
				on url.user_id=usr.uid
				Where url.department_id=:dept_id and url.role_id=:role_id AND usr.disctrict_id=:distt";
				$connection=Yii::app()->db;
				$command=$connection->createCommand($sql);
				$command->bindParam(":role_id",$role_id,PDO::PARAM_INT);
				$command->bindParam(":distt",$distt,PDO::PARAM_INT);
				$command->bindParam(":dept_id",$dept_id,PDO::PARAM_INT);
				$userInfo=$command->queryRow();
				echo $userInfo
				if(empty($userInfo))
					return false;
				return $userInfo['mobile'];
		}
		static function sendEmailNotification($email,$message,$subject){
			   // print_r(Utility::sendEmailTest(EMAIL_HOST,EMAIL_PORT,EMAIL_USERNAME,EMAIL_PASSWORD,"TestEmail","Please ignore this mail if you got","er.hemant908thakur@gmail.com"));
			    Yii::import('ext.phpmailer.JPhpMailer');
			    $mail = new JPhpMailer();
			    $mail->IsSMTP();
			    $mail->Host = EMAIL_HOST;
			    $mail->SMTPDebug = 1;
			    $mail->port = EMAIL_PORT;
			    $mail->SMTPAuth = true;
			    $mail->Username = EMAIL_USERNAME;
			    $mail->Password = EMAIL_PASSWORD;
			    $mail->SetFrom(EMAIL_USERNAME, EMAIL_NAME);
			    $mail->Subject = $subject;
			    $mail->AltBody = 'To view the message, please use an HTML compatible email viewer!';
			    $mail->MsgHTML($message);
			    $mail->SMTPSecure = 'tls';
			    $mail->AddAddress($to, $email);
			    if($mail->Send()==FALSE){
			        return false;
			    }
			    else{
			       return true;
			    }
		}
	}
?>