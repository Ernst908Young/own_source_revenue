<?php

class LandownerConnectEXT extends LandownerConnect{
    

        public static function getLandownerConnectList(){                    
		$connection=Yii::app()->db;
	    $sql = "SELECT * FROM bo_landowner_connect where user_id=".$_SESSION['RESPONSE']['user_id'];
		$command=$connection->createCommand($sql);
		$allData=$command->queryAll();	
		return $allData;
	}
        
        
	 // Added By : Rahul [30012018]
         public static function getLandownerConnectListbyLandUserID(){                    
		$connection=Yii::app()->db;   
                $mobileNumber=$_SESSION['land_mobile'];
	        $sql = "SELECT * FROM bo_landowner_connect as b_lc where id in ((Select blc.land_id from bo_landowner_contact as blc where blc.owner_contact_no='$mobileNumber' OR blc.agent_contact_no='$mobileNumber'))";
		$command=$connection->createCommand($sql);
		$allData=$command->queryAll();	                
		//print_r($allData); die;
		return $allData;
	}
        
	
	 /**   @author : Rahul Kumar
          *    @return  : array of list
          */
	 public static function getMasterList($dbtable=null,$key=null,$value=null,$active=null,$isactivevalue=null){           
                     if(empty($active)){  $active="is_active"; }
                     if(empty($isactivevalue)){ $isactivevalue="Y"; }
		$connection=Yii::app()->db;
		
	        $sql = "SELECT $key,$value FROM $dbtable where $active=:$active";
		$command=$connection->createCommand($sql);
		$command->bindParam(":$active",$isactivevalue,PDO::PARAM_INT);
		$allData=$command->queryAll();	
                foreach ($allData as $data){
                    $k=$data[$key];
                    $listData[$k]=$data[$value];
                    
                }
		return $listData;
	}
        
	 /**   @author : Rahul Kumar
          *    @return list in array
          */

   public static function getMasterList1($dbtable=null,$key=null,$value=null){                    
		$connection=Yii::app()->db;
		$isactive='Y'; 
	        $sql = "SELECT $key,$value FROM $dbtable where is_formvar_active=:is_formvar_active";
		$command=$connection->createCommand($sql);
		$command->bindParam(":is_formvar_active",$isactive,PDO::PARAM_INT);
		$allData=$command->queryAll();	
                foreach ($allData as $data){
                    $k=$data[$key];
                    
                }
		return $listData;
	}
	 /**   @author : Rahul Kumar
          *    @return : value
          */
	
	 public static function getMasterName($dbtable=null,$key=null,$value=null,$id=null){                    
		$connection=Yii::app()->db;
		$isactive='Y'; 
	        $sql = "SELECT $value FROM $dbtable where $id=$key";
		$command=$connection->createCommand($sql);
		$allData=$command->queryAll();	                
		return $allData[0][$value];
	}
        
          /**   @author : Rahul Kumar
            *   @created 15012018
            *   @Description:  This will check that the person who is updating data "is authorized as a owner / agent to modify this".
            *   @return boolean 
           */
        
	public static function isAuthorisedToModify($landID=null)
	{
        $model=LandownerConnect::model()->findByPk($landID);
        if(!empty($model->user_id) && $model->user_id==$_SESSION['RESPONSE']['user_id']){
         //echo "true";
         return true;
        }else{
         // echo "false";
          return false;
        }
       // die;
        }
        
        /**   @author : Rahul Kumar
            *   @created 15012018
            *   @Description:  This will check that the person who is updating data "is authorized as a owner / agent to modify this".
            *   @return array 
           */
        
	public static function isLandContactAvailable($landID=null)
	{
            $landID= base64_decode($landID);
            $requested = Yii::app()->db->createCommand("SELECT * FROM bo_landowner_contact where land_id=$landID")->queryRow();
            return $requested;
        }
        
        /**
     * @author Rahul Kumar
     * @created_on 14012018
     */
    public static function truncate_string($string, $length, $append = "...") {
        // Trimming here
        $string = trim($string);
        // evaluvating length
        if (strlen($string) > $length) {

            // getting string as per given length
            $string = wordwrap($string, $length);
            $string = explode("\n", $string);

            // adding $append
            $string = array_shift($string) . $append;
        }
        // returning result here
        return $string;
    }
    
          /**   @author : Rahul Kumar
            *   @created 17012018
            *   @Description:  This will return count of passed argument Eg: $fieldVal= viewed/ intrested / is_reported.
            *   @return value 
            */
        
	public static function landRelatedCounts($landID=null,$fieldVal=null)
	{
            $landID= base64_decode($landID);
            $requested = Yii::app()->db->createCommand("SELECT count(*) as total FROM bo_landowner_visitor_property_action_log where land_id=$landID and $fieldVal='Y'" )->queryRow();
            if(empty($requested['total'])){
               return 0; 
            }
            return $requested['total'];
        }
        
        
          /**   @author : Rahul Kumar
            *   @created 19012018
            *   @Description:  If latitude and longitude is not set by land owner/agent for the land/property then it will allow to pick latitude & longitude from district's lat long.
            *   @return value 
            */
        
	public static function getDistrictLatLong($districtID=null)
	{
            $requested = Yii::app()->db->createCommand("SELECT latlong FROM bo_landowner_latlong_master where district_id=$districtID")->queryRow();
            return $requested['latlong'];
        }
}
