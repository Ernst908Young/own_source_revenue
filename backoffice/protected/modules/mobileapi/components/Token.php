<?php 
define('SECRET_KEY', "caipo");
	Class Token{

		public static function gettoken($userID){
			 $tokenGeneric = SECRET_KEY.$_SERVER["SERVER_NAME"];    
   			 $token = hash_hmac('sha1', $tokenGeneric.$userID,PASSWORD_SECRET_KEY,false);
   			 // echo $token;die;
			return $token;		
		}

		public static function matchtoken($token,$userID){
			$gettoken = self::gettoken($userID);
			if($gettoken==$token){
				return true;
			}else{
				return false;
			}
		}
		
	}
?>