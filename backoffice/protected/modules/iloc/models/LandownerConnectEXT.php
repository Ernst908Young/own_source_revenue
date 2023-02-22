<?php

class LandownerConnectEXT extends LandownerConnect{

         // Added By : Rahul [30012018]
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
	 // Added By : Rahul [07022018]
         public static function getLandownerConnectListbyLandDeptUserID(){
		$connection=Yii::app()->db;
                $sql = "SELECT * FROM bo_landowner_connect where dept_user_id=".$_SESSION['uid'];
		$command=$connection->createCommand($sql);
		$allData=$command->queryAll();
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
                $listData=array();
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
          *    @ Pass SELECT 3-$value FROM 1-$dbtable where 4-$id=2-$key
          *    @return : value
          */

	 public static function getMasterName($dbtable=null,$key=null,$value=null,$id=null){
                if(empty($key) ){
                    return "";
                }
		//echo "hi...";
		$connection=Yii::app()->db;
		$isactive='Y';
	    $sql = "SELECT $value FROM $dbtable where $id=$key";
		// echo  $sql;die;
		$command=$connection->createCommand($sql);
		$allData=$command->queryAll();
		if(isset($allData[0][$value]) && !empty($allData[0][$value]))
		{
			return $allData[0][$value];
		}else{
			return false;
		}
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


    
           // Added By : Jitendra [15022018]
         public static function getLandrequesterConnectListbyLandUserID(){
           $connection=Yii::app()->db;
           $mobileNumber=$_SESSION['land_mobile'];
           $sql = "SELECT * FROM bo_landowner_requester_connect as b_lc where id in ((Select blc.land_id from bo_landowner_requester_contact as blc where blc.requester_contact_no='$mobileNumber' OR blc.agent_contact_no='$mobileNumber'))";
            $command=$connection->createCommand($sql);
            $allData=$command->queryAll();
            //print_r($allData); die;
            return $allData;
          }
           // Added By : Jitendra [15022018]
         public static function getLandrequesterConnectListbyLandDeptUserID(){
            $connection=Yii::app()->db;
            $sql = "SELECT * FROM bo_landowner_requester_connect where user_type ='Department' AND user_id=".$_SESSION['uid'];
            $command=$connection->createCommand($sql);
            $allData=$command->queryAll();
            return $allData;
          }
       /// jitendra 15022018
          public static function isLandRequesterContactAvailable($landID=null)
          {
              $landID= base64_decode($landID);
              $requested = Yii::app()->db->createCommand("SELECT * FROM bo_landowner_requester_contact where land_id=$landID")->queryRow();
              return $requested;
          }

   // jitendra 15022018

     public static function getLandrequesterConnectList(){
           $connection=Yii::app()->db;
           $sql = "SELECT * FROM bo_landowner_requester_connect where user_id=".$_SESSION['RESPONSE']['user_id'];
           $command=$connection->createCommand($sql);
           $allData=$command->queryAll();
           return $allData;
     }

      /**   @author : Rahul Kumar
            *   @created 13032018
            *   @Description: Get Land Added by DM of that district
            *   @return value
            */

      	public static function getLandAddedByDM($districtID=null,$type=null)
      	{
                  $requested = Yii::app()->db->createCommand("SELECT bo_user.uid FROM bo_user LEFT JOIN bo_user_role_mapping ON bo_user.uid= bo_user_role_mapping.user_id LEFT JOIN bo_departments ON bo_user.dept_id=bo_departments.dept_id  Where bo_user_role_mapping.role_id=74 AND bo_user.disctrict_id=$districtID")->queryAll();
                  $user_id="0";
                  foreach($requested as $uid){
                    $user_id=$user_id.",".$uid['uid'];  
                  }
                  $requested1 = Yii::app()->db->createCommand("SELECT * from bo_landowner_connect as blc INNER JOIN  bo_district as bd ON bd.district_id=blc.district_id where blc.status='Y' AND blc.dept_user_id IN ($user_id)")->queryAll();//blc.status='Y' AND
                  
                  if($type!="fullData")
                      return count($requested1);
                  else
                      return $requested1; 
        }
        
         /**   @author : Rahul Kumar
            *   @created 13032018
            *   @Description: Get Land Added by Department(HOD) 
            *   @return value
            */

      	public static function getLandAddedByDepartment($departmentID=null,$type=null)
      	{
                  $requested = Yii::app()->db->createCommand("SELECT bo_user.uid FROM bo_user LEFT JOIN bo_user_role_mapping ON bo_user.uid= bo_user_role_mapping.user_id LEFT JOIN bo_departments ON bo_user.dept_id=bo_departments.dept_id  Where  bo_user_role_mapping.role_id=62 AND bo_user_role_mapping.department_id=$departmentID")->queryAll();
                  $user_id="0";
                  foreach($requested as $uid){
                    $user_id=$user_id.",".$uid['uid'];  
                  }
                  $requested1 = Yii::app()->db->createCommand("SELECT * from bo_landowner_connect as blc INNER JOIN  bo_district as bd ON bd.district_id=blc.district_id  where blc.status='Y' AND blc.dept_user_id IN ($user_id)")->queryAll();
                  if($type!="fullData")
                      return count($requested1);
                  else
                      return $requested1; 
        }
        
        
    public static function getDitrictList($dbtable = null, $key = null, $value = null, $state_code = null, $active = null, $isactivevalue = null) {
        if (empty($active)) {
            $active = "is_active";
        } if (empty($isactivevalue)) {
            $isactivevalue = "Y";
        } $connection = Yii::app()->db;
        $sql = "SELECT $key,$value FROM $dbtable where $active=:$active and state_code=$state_code";
        $command = $connection->createCommand($sql);
        $command->bindParam(":$active", $isactivevalue, PDO::PARAM_INT);
        $allData = $command->queryAll();
        $listData = array();
        foreach ($allData as $data) {
            $k = $data[$key];
            $listData[$k] = $data[$value];
        } return $listData;
    }

        public static function getDitrictList1($dbtable = null, $key = null, $value = null, $state_code = null, $active = null, $isactivevalue = null) {
        if (empty($active)) {
            $active = "is_active";
        } if (empty($isactivevalue)) {
            $isactivevalue = "Y";
        } $connection = Yii::app()->db;
        $sql = "SELECT $key,$value,district_code FROM $dbtable where $active=:$active and state_code=$state_code";	  
        $command = $connection->createCommand($sql);
        $command->bindParam(":$active", $isactivevalue, PDO::PARAM_INT);
        $allData = $command->queryAll();
        $listData = array();
		/* echo "<pre>";
		print_r($allData);die();  */
		foreach ($allData as $data) {
            if(isset($data[$key]) && !empty($data[$key]))
			{
				$k = $data[$key];
			}else{
				$k = $data['district_code'];
			}	
            $listData[$k] = $data[$value];
        } 
		return $listData;
    }
	
	public static function getIndustrialAreaList($dbtable = null, $key = null, $value = null, $land_type = null, $active = null, $isactivevalue = null) {
        if (empty($active)) {
            $active = "is_active";
        } if (empty($isactivevalue)) {
            $isactivevalue = "Y";
        } $connection = Yii::app()->db;
        $sql = "SELECT $key,$value FROM $dbtable where $active=:$active and land_type='$land_type'";
        $command = $connection->createCommand($sql);
        $command->bindParam(":$active", $isactivevalue, PDO::PARAM_INT);
        $allData = $command->queryAll();
        $listData = array();
        foreach ($allData as $data) {
            $k = $data[$key];
            $listData[$k] = $data[$value];
        } 
		return $listData;
    }
    
    public static function getAllLandWithOwner() {
        if (empty($active)) {
            $active = "is_active";
        } if (empty($isactivevalue)) {
            $isactivevalue = "Y";
        } $connection = Yii::app()->db;
        $sql = "select * from bo_landowner_connect left join bo_landowner_contact on bo_landowner_connect.id = bo_landowner_contact.land_id left join"
                . " bo_district on bo_landowner_connect.district_id =bo_district.district_id "
                . " left join sso_profiles on bo_landowner_connect.user_id = sso_profiles.user_id where status = 'Y'";
        $command = $connection->createCommand($sql);
        $command->bindParam(":$active", $isactivevalue, PDO::PARAM_INT);
        $dataProvider = $command->queryAll();           
       
        
		return $dataProvider;
    }
    
    public static function getLandUnitConversion($area,$areatype) {
        
        if(!empty($area) && !empty($areatype)){
            if ($areatype =='Acres'){
                $area = $area*4046.86;
            }
            else if ($areatype =='Bigha'){
                $area = $area*800;
            }
            else if ($areatype =='Hectare'){
                $area = $area*10000;
            }
            else if ($areatype =='Nala'){
                $area = $area*200;
            }
            else if (($areatype =='Sq. ft') || ($areatype =='Sq Ft')){
                $area = $area*0.092903;
            }
            else{
                $area ='invalid';
            }
        }   
	return $area;
    }
    
    public static function getLandrequesterConnectListAll(){
           $connection=Yii::app()->db;
           $sql = "SELECT * FROM bo_landowner_requester_connect left join sso_users on bo_landowner_requester_connect.user_id = sso_users.user_id left join bo_district on "
                   . "bo_landowner_requester_connect.district_id = bo_district.district_id left join sso_profiles on sso_users.user_id = sso_profiles.user_id ";
           $command=$connection->createCommand($sql);
           $allData=$command->queryAll();
           
           
           //echo '<pre>';print_r($allData);die;
           return $allData;
    }
	
	public static function getCircle($dbtable = null, $key = null, $value = null, $district_id = null, $active = null, $isactivevalue = null) 
	{
        if (empty($active)) {
            $active = "is_active";
        } if (empty($isactivevalue)) {
            $isactivevalue = "Y";
        } 
		$connection = Yii::app()->db;
        $sql = "SELECT $key,$value FROM $dbtable where $active=:$active and district_id=$district_id";	  
        $command = $connection->createCommand($sql);
        $command->bindParam(":$active", $isactivevalue, PDO::PARAM_INT);
        $allData = $command->queryAll();
        $listData = array();
		/* echo "<pre>";
		print_r($allData);die();  */
		foreach ($allData as $data) {
            if(isset($data[$key]) && !empty($data[$key]))
			{
				$k = $data[$key];
			}else{
				$k = $data['circle_name'];
			}	
            $listData[$k] = $data[$value];
        } 
		return $listData;
    } 
}
