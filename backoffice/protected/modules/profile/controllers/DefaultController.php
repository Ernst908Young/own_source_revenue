<?php

class DefaultController extends Controller {
	public function init()
		{
		    if(isset(Yii::app()->session['uid']) || @$_SESSION['RESPONSE']['user_id'] || @$_SESSION['RESPONSE']['agent_user_id'])
		    {
		        
		    }else{
		    	$this->redirect(Yii::app()->createAbsoluteUrl("../sso/account/signin"));
		    }
		}

	public function actionMyaccount(){
		return $this->render('my_account');
	}

	public function actionMyaccountbo(){
		return $this->render('bo/my_account');
	}

	


	public function actionEditdetails(){
		if(isset($_POST['user_profile_id']) && isset($_POST['user_id'])){
			
			$fn = DefaultUtility::dataSenetize($_POST['first_name']);
			$mn = DefaultUtility::dataSenetize($_POST['middle_name']);
			$sn = DefaultUtility::dataSenetize($_POST['surname']);
			$gender = DefaultUtility::dataSenetize($_POST['gender']);
			$dob = DefaultUtility::dataSenetize($_POST['dob']);
			$mobile = DefaultUtility::dataSenetize($_POST['mobile']);
			$telephone = DefaultUtility::dataSenetize($_POST['telephone']);
			$nationality = DefaultUtility::dataSenetize($_POST['nationality']);
			$pan_card = isset($_POST['pan_card']) ? DefaultUtility::dataSenetize($_POST['pan_card']) : NULL;
			$add1 = DefaultUtility::dataSenetize($_POST['address']);
			$add2 = DefaultUtility::dataSenetize($_POST['address2']);
			$city = DefaultUtility::dataSenetize($_POST['city_name']);
			$state = DefaultUtility::dataSenetize($_POST['state_parish']);
			$pin = DefaultUtility::dataSenetize($_POST['pin_code']);
			$country = DefaultUtility::dataSenetize($_POST['country']);
			$profile_id = DefaultUtility::dataSenetize($_POST['user_profile_id']);
			$user_id = DefaultUtility::dataSenetize($_POST['user_id']);
			
			Yii::app()->db->createCommand("UPDATE sso_profiles SET first_name='$fn', last_name='$mn', surname='$sn', gender='$gender',date_of_birth='$dob',mobile_number='$mobile',telephone='$telephone',nationality='$nationality', pan_card='$pan_card', address='$add1', address2='$add2', city_name='$city', state_name='$state', pin_code='$pin', country_name='$country' WHERE profile_id=".$profile_id)->execute();
			Yii::app()->db->createCommand("UPDATE sso_users SET mobile_no='$mobile' WHERE user_id=".$user_id)->execute();
			Yii::app()->user->setFlash('success','Your profile has been updated successfully');
			$this->redirect('/backoffice/profile/default/myaccount');
		}
		return $this->render('edit_details');
	}

	public function actionEditdetailsbo(){
		if(isset($_POST['uid'])){
			$uid = DefaultUtility::dataSenetize(base64_decode($_POST['uid']));
			$fn = DefaultUtility::dataSenetize($_POST['full_name']);
			$mn = DefaultUtility::dataSenetize($_POST['middle_name']);
			$sn = DefaultUtility::dataSenetize($_POST['last_name']);			
			$mobile = DefaultUtility::dataSenetize($_POST['mobile']);

			$fax = DefaultUtility::dataSenetize($_POST['fax']);
			$delegate_officer_number = DefaultUtility::dataSenetize($_POST['delegate_officer_number']);
			$delegate_officer_name = DefaultUtility::dataSenetize($_POST['delegate_officer_name']);			
			$delegate_officer_email = DefaultUtility::dataSenetize($_POST['delegate_officer_email']);
		    $office_no = DefaultUtility::dataSenetize($_POST['office_no']);
			
			Yii::app()->db->createCommand("UPDATE bo_user SET full_name='$fn', middle_name='$mn', last_name='$sn', mobile='$mobile', fax='$fax', delegate_officer_number='$delegate_officer_number', delegate_officer_name='$delegate_officer_name', delegate_officer_email='$delegate_officer_email', office_no='$office_no' WHERE uid=".$uid)->execute();
			
			if(isset($_FILES['sign']) && $_FILES['sign']['name']!=NULL){
				$img_type_array = ['image/png','image/PNG','image/jpg','image/jpeg','image/JPG','image/JPEG'];
				$file = $_FILES['sign'];
				if(in_array($_FILES['sign']['type'], $img_type_array)){
					$dir = "/var/www/html/backoffice/themes/investor_theme/img/".$_FILES['sign']['name'];
				 //  $dir = Yii::app()->basePath .'/uploads/tickets';


				    if(move_uploaded_file($_FILES['sign']['tmp_name'], $dir)) {
		        		$checksign = Yii::app()->db->createCommand("SELECT userid FROM tbl_bo_signature_detail where isactive=1 AND userid = '".$_POST['uid']."'")->queryScalar();

	                if($checksign){
	                	Yii::app()->db->createCommand("UPDATE tbl_bo_signature_detail SET signature = '".$_FILES['sign']['name']."' WHERE userid=". $checksign)->execute();
	                }else{
	                	//Yii::app()->db->createCommand("INSERT INTO tbl_bo_signature_detail (userid,signatories_name,designation,signature)")->execute();
	                }

	                $_filename=$dir;
					$_backgroundColour='0,0,0';
					$_img = imagecreatefrompng($_filename);
					$_backgroundColours = explode(',', $_backgroundColour);
					$_removeColour = imagecolorallocate($_img, (int)$_backgroundColours[0], (int)$_backgroundColours[1], (int)$_backgroundColours[2]);
					imagecolortransparent($_img, $_removeColour);
					imagesavealpha($_img, true);
					$_transColor = imagecolorallocatealpha($_img, 0, 0, 0, 127);
					imagefill($_img, 0, 0, $_transColor);
					imagepng($_img, $_filename);


		        } else {
		           echo Yii::app()->basePath.'<br>';
		          print_r($_FILES['sign']);
		          die();
		        }

	               
	                

	                

				}else{					
					Yii::app()->user->setFlash('error','Only png and jpg format supported to upload signature');
					$this->redirect('/backoffice/profile/default/editdetailsbo');
				}				
			}

			Yii::app()->user->setFlash('success','Your profile has been updated successfully');
			$this->redirect('/backoffice/profile/default/myaccountbo');
		}
		return $this->render('bo/edit_details');
	}
	
	public function actionChangepassword(){
		return $this->render('change_password');
	}

	public function actionChangepasswordbo(){
		$uid =  @$_SESSION['uid'];
		return $this->render('bo/change_password',['uid'=>$uid]);
	}
	
	public function actionUpdatePassword()
	{
		$user_id =  @$_SESSION['RESPONSE']['user_id'];
		$iuid =  @$_SESSION['RESPONSE']['iuid'];
		$email =  @$_SESSION['RESPONSE']['email'];
		
		if(isset($_POST['old_password']) && isset($_POST['new_password']) && isset($_POST['confirm_password'])){
			$users =  Yii::app()->db->createCommand("SELECT * FROM sso_users u WHERE u.user_id =$user_id and u.iuid =$iuid and u.email= '".$email."' and  u.is_account_active='Y'")->queryRow();
			//echo  PASSWORD_SECRET_KEY;die; 
			$salt = $users['salt'];
			$passwd = $_POST['old_password'];
			$password2 = $users['password'];
			$passwd=hash_hmac("sha1",$passwd.$salt,'b99#3H?AQ7Zfsj'); // b99#3H?AQ7Zfsj - static value of PASSWORD_SECRET_KEY
			if($passwd === $password2){
				$new_input_pass = $_POST['new_password'];
				$salt=md5($new_input_pass."_".time()."-".rand(111,9999999));
				$new_password = $passwd=hash_hmac("sha1",$new_input_pass.$salt,'b99#3H?AQ7Zfsj');
				$date = date('Y-m-d');
				$usermodal =  Yii::app()->db->createCommand("update sso_users set password= '".$new_password."', salt= '".$salt."', is_passwd_reset='Y', passwd_reset_date='".$date."'  where user_id=$user_id ");
				$usermodal->execute(); 
				echo 'success';
		
			}
			else{
				echo 'error';
			}
		}		
	}
	
	public function actionUpdatePasswordbo()
	{
		//$user_id =  @$_SESSION['uid'];
		
		
		if(isset($_POST['uid']) && isset($_POST['old_password']) && isset($_POST['new_password']) && isset($_POST['confirm_password'])){
			$uid = DefaultUtility::dataSenetize(base64_decode($_POST['uid']));

			$userdetails = Yii::app()->db->createCommand("SELECT * FROM bo_user WHERE uid=".$uid)->queryRow();    


			$old_pass = hash_hmac('sha1', trim($_POST['old_password']), PASSWORD_SECRET_KEY);
			$password2 = $userdetails['password'];
			$pass = hash_hmac('sha1', trim($_POST['new_password']), PASSWORD_SECRET_KEY);

			if($old_pass === $password2){
				$usermodal =  Yii::app()->db->createCommand("update bo_user set password= '".$pass."'  where uid=$uid");
				$usermodal->execute(); 
				echo 'success';
			}else{
				echo 'error';
			}	
			
		}else{
			echo 'something missing';
		}
		
	}


/// below functions is for agent profiles
public function actionAgentaccount(){
		return $this->render('agent_account');
	}

	public function actionAgenteditdetails(){
		if(isset($_POST['user_profile_id'])){
			
			$fn = DefaultUtility::dataSenetize($_POST['first_name']);
			$mn = DefaultUtility::dataSenetize($_POST['middle_name']);
			$sn = DefaultUtility::dataSenetize($_POST['surname']);
			$gender = DefaultUtility::dataSenetize($_POST['gender']);
			$dob = $_POST['dob'];
			$telephone = DefaultUtility::dataSenetize($_POST['telephone']);
			$nationality = DefaultUtility::dataSenetize($_POST['nationality']);
			$pan_card = isset($_POST['pan_card']) ? $_POST['pan_card'] : NULL;
			$add1 = DefaultUtility::dataSenetize($_POST['address']);
			$add2 = DefaultUtility::dataSenetize($_POST['address2']);
			$city = DefaultUtility::dataSenetize($_POST['city_name']);
			$state = DefaultUtility::dataSenetize($_POST['state_parish']);
			$pin = DefaultUtility::dataSenetize($_POST['pin_code']);
			$country = DefaultUtility::dataSenetize($_POST['country']);
			
			Yii::app()->db->createCommand("UPDATE sso_profiles SET first_name='$fn', last_name='$mn', surname='$sn', gender='$gender',date_of_birth='$dob',telephone='$telephone',nationality='$nationality', pan_card='$pan_card', address='$add1', address2='$add2', city_name='$city', state_name='$state', pin_code='$pin', country_name='$country' WHERE profile_id=".$_POST['user_profile_id'])->execute();
			Yii::app()->user->setFlash('success','Your profile has been updated successfully');
			$this->redirect('/backoffice/profile/default/agentaccount');
		}
		return $this->render('agent_edit_details');
	}
	
	public function actionAgentchangepassword(){
		return $this->render('agent_change_password');
	}
	
	public function actionAgentupdatePassword()
	{
		$user_id =  @$_SESSION['RESPONSE']['agent_user_id'];		
	//	$email =  @$_SESSION['RESPONSE']['email'];
		
		if(isset($_POST['old_password']) && isset($_POST['new_password']) && isset($_POST['confirm_password'])){
			$users =  Yii::app()->db->createCommand("SELECT * FROM sso_users u WHERE u.user_id =$user_id AND u.is_account_active='Y'")->queryRow();
			//echo  PASSWORD_SECRET_KEY;die; 
			$salt = $users['salt'];
			$passwd = $_POST['old_password'];
			$password2 = $users['password'];
			$passwd=hash_hmac("sha1",$passwd.$salt,'b99#3H?AQ7Zfsj'); // b99#3H?AQ7Zfsj - static value of PASSWORD_SECRET_KEY
			if($passwd === $password2){
				$new_input_pass = $_POST['new_password'];
				$salt=md5($new_input_pass."_".time()."-".rand(111,9999999));
				$new_password = $passwd=hash_hmac("sha1",$new_input_pass.$salt,'b99#3H?AQ7Zfsj');
				$date = date('Y-m-d');
				$usermodal =  Yii::app()->db->createCommand("update sso_users set password= '".$new_password."', salt= '".$salt."', is_passwd_reset='Y', passwd_reset_date='".$date."'  where user_id=$user_id ");
				$usermodal->execute(); 
				echo 'success';		
			}
			else{
				echo 'error';
			}
		}
		
	}
	
	public function actionVm(){
		return $this->render('vm');
	}
}