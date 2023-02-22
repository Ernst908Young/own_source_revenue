<?php 

	Class Check_agent{
		public static function indShow(){
			if($_SESSION['RESPONSE']['user_type']==1){
				$user_id = $_SESSION['RESPONSE']['user_id'];
				$checkassig = Yii::app()->db->createCommand("SELECT * FROM agent_service_provider WHERE user_id=$user_id AND is_revoke=0 AND activation_key=''")->queryRow();
				if($checkassig){
					return false;
				}else{
					return true;
				}
			}else{
				if($_SESSION['RESPONSE']['user_type']==2){
					if(isset($_SESSION['asp_id'])){
						$asp_id = $_SESSION['asp_id'];
						$checkassig_entity = Yii::app()->db->createCommand("SELECT * FROM agent_service_provider_sub_user_mapping WHERE asp_id=$asp_id AND activation_key='' AND is_revoke=0")->queryRow();
						if($checkassig_entity['sp_status']=='O'){
							return false;
						}else{
							return true;
						}
					}else{
						return false;
					}							
				}else{
					if($_SESSION['RESPONSE']['user_type']==3){
						if(isset($_SESSION['asp_sum_id'])){
							$asp_sum_id = $_SESSION['asp_sum_id'];
							$checkassig_entity = Yii::app()->db->createCommand("SELECT * FROM agent_service_provider_sub_user_mapping WHERE id=$asp_sum_id AND activation_key='' AND is_revoke=0")->queryRow();
							if($checkassig_entity['sp_status']=='O'){
								return true;
							}else{
								return false;
							}
						}else{
							return false;
						}							
					}else{
						return false;
					}	
				}				
			}			
		}
	}
?>