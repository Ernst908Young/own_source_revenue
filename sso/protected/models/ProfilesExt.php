<?php 
	class ProfilesExt extends Profiles{

		static function getAllActiveSSODept(){
			$criteria=new CDbCriteria;
			$criteria->condition="is_service_provider_active=:active";
			$criteria->params=array(":active"=>'Y');
			$depptt=ServiceProviders::model()->findAll($criteria);
			// echo "<pre>";print_r($depptt);die;
			if($depptt===null)
				return false;
			$returnDept="";
			foreach ($depptt as $key => $dept) {
				$returnDept[]=array("sp_id"=>$dept->sp_id,"service_provider_name"=>$dept->service_provider_name,"service_provider_tag"=>$dept->service_provider_tag);
			}
			return $returnDept;
		}
		/**
		* Function is used to update user profile
		* @author : Hemant Thakur
		*/
		public static function updateUserprofiile($info,$user_id){
			$criteria = new CDbCriteria();
			$criteria->condition="user_id=:user_id";
			$criteria->params = array(':user_id'=>$user_id);
			$model = Profiles::model()->find($criteria);
			if(empty($model))
				return FALSE;
			$model->first_name=$info->first_name;
			$model->last_name=$info->last_name;
			$model->pan_card=$info->pan_card;
			$model->adhaar_number=$info->aadhar_card;
			$model->city_name=$info->city;
			$model->pin_code=$info->pin_code;
			$model->address=$info->address;
			$model->mobile_number=$info->mob_number;
			if($model->save())
				return TRUE;
			else
				return FALSE;
		}
		/**
		* Function is used to update user password
		* @author : Hemant Thakur
		*/
		public static function updatePassword($info,$iuid){
			$criteria = new CDbCriteria();
			$criteria->condition = 'iuid=:iuid';
			$criteria->params = array(':iuid'=>$iuid);
			$users = Users::model()->find($criteria);
			$users = $users->attributes;
			$status='';
			if(isset($users['salt']) && !empty($users['salt'])){
				$salt = $users['salt'];
				$user_id = $users['user_id'];
    			$password2 = $users['password'];
    			$passwd=hash_hmac("sha1",$info->current_pwd.$salt,PASSWORD_SECRET_KEY);
    			if($passwd!=$password2)
    				$status='NotMatch';
    			else{
    				$salt=md5($info->new_pwd."_".time()."-".rand(111,9999999));
    				$password=hash_hmac("sha1",$info->new_pwd.$salt,PASSWORD_SECRET_KEY);
    				$model=Users::model()->findByPk($user_id);
    				if($model===null)
    					$status='NotFound';
    				else{
    					$model->salt=$salt;
    					$model->password=$password;
    					if($model->save()){
    						$criteria = new CDbCriteria();
    						$criteria->condition="user_id=:user_id";
    						$criteria->params = array(':user_id'=>$user_id);
    						$modelProfile = Profiles::model()->find($criteria);
    						$hmac=hash_hmac("sha1",$modelProfile->mobile_number.$users['email'],OTP_SECRET_KEY);
    						$data=array("mobile"=>$modelProfile->mobile_number,'email'=>$users['email'],'msg'=>"Your SWCS password has successfully changed. If this is not you, Please visit your SWCS's profile and update your password.",'hmac'=>$hmac,'uuid'=>$iuid);		
							$result=json_decode(Utility::getViaCurl(BO_API_BASEURL,'sendMobMsg',$data));
    						$status='save';
    					}
    					else
    						$status='NotSave';	
    				}
    			}
			}
			else
				$status='NotFound';
		return $status;
	}
	/**
		* Function is used to get total registered user
		* @author : Hemant Thakur
		*/
	public static function getTotalRegisteredUsers(){
			$active='Y';
			$sql="SELECT count(user_id) as user_count FROM sso_users WHERE is_account_active=:active";
			$connection=Yii::app()->db;
			$command=$connection->createCommand($sql);
			$command->bindParam(":active",$active,PDO::PARAM_STR);
			$Users=$command->queryAll();
			if($Users===false)
				return false;
			return $Users[0];
		}
		private function getInvestorDetail($iuid){
			$criteria=new CDbCriteria;
			$criteria->condition="iuid=:iuid";
			$criteria->params=array(":iuid"=>$iuid);
			$model=Users::model()->find($criteria);
			return $model;
		}
		public function activateAccount($data){
			$model=ProfilesExt::getInvestorDetail($data['iuid']);
			if(!$model)
				return false;
			$model->is_account_active=$data['status'];
			if($model->save())
				return true;
			return false;
		}

		/** 
		* this function is used to get the information of all the registered users
		*@author: Hemant Thakur
		*/
		static function getUsersWithInfo(){
			$sql="SELECT su.iuid,su.email,su.created_on,su.is_account_active,sup.first_name,sup.country_name,sup.state_name,sup.distt_name,sup.last_name,sup.pan_card,sup.adhaar_number,sup.city_name,sup.pin_code,sup.address,sup.mobile_number  FROM sso_users su
				INNER JOIN sso_profiles sup
				ON su.user_id=sup.user_id";
			$connection=Yii::app()->db;
			$command=$connection->createCommand($sql);
			$Users=$command->queryAll();
			if($Users===false)
				return false;

			return $Users;
		}


	/**
	*This function is used to get the username from the userid 
	*/
	public static function getUsernameFromUserId($uid){
		$sql="SELECT first_name,last_name FROM sso_profiles WHERE user_id=:uid";
		$connection=Yii::app()->db;
		$command=$connection->createCommand($sql);
		$command->bindParam(":uid",$uid,PDO::PARAM_STR);
		$Users=$command->queryRow();
		if($Users===false)
			return false;
		$name=$Users['first_name'].' '.$Users['last_name'];
		return $name;
	}
	/**
	*This function is used to get the username from the userEmail 
	*/
	public static function getUsernameFromUserEmail($email){
		$sql="SELECT prf.first_name,prf.last_name FROM sso_profiles prf 
			 INNER JOIN sso_users usr
			 ON usr.user_id=prf.user_id
			 WHERE usr.email=:email";
		$connection=Yii::app()->db;
		$command=$connection->createCommand($sql);
		$command->bindParam(":email",$email,PDO::PARAM_STR);
		$Users=$command->queryRow();
		if($Users===false)
			return false;
		$name=$Users['first_name'].' '.$Users['last_name'];
		return $name;
	}

	/**
	*this function is used to get detail of the user from the email id
	*/
	static function getUserDetailFromEmail($email){

		$sql="SELECT prf.*,usr.* FROM sso_profiles prf 
			 INNER JOIN sso_users usr
			 ON usr.user_id=prf.user_id
			 WHERE usr.email=:email";
		$connection=Yii::app()->db;
		$command=$connection->createCommand($sql);
		$command->bindParam(":email",$email,PDO::PARAM_STR);
		$uinfo=$command->queryRow();
		if($uinfo===false)
			return false;
		return $uinfo;
	}
	/**
	*This function is used to get the username from the userid 
	*/
	public static function getMobileFromUserId($uid){
		// echo $uid;die;
		$sql="SELECT mobile_number FROM sso_profiles WHERE user_id=:uid";
		$connection=Yii::app()->db;
		$command=$connection->createCommand($sql);
		$command->bindParam(":uid",$uid,PDO::PARAM_STR);
		$mobile=$command->queryRow();
		// echo "<pre>";print_r($mobile);
		if($mobile===false)
			return false;
		
		return $mobile['mobile_number'];
	}
	/**
	*This function is used to get the username from the userid 
	*/
	public static function getEmailFromUserId($uid){
		// echo $uid;die;
		$sql="SELECT email FROM sso_users WHERE user_id=:uid";
		$connection=Yii::app()->db;
		$command=$connection->createCommand($sql);
		$command->bindParam(":uid",$uid,PDO::PARAM_STR);
		$email=$command->queryRow();
		if($email===false)
			return false;
		
		return $email['email'];
	}

}
	
?>