<?php

/*
 * 
 * @authour: Rahul Kumar
 * @date: 05012019 17:26
 * @description: Single Sign on
 *  */

class SsoController extends Controller {

    public function actionLogin() {
      
        // Get Application DMS Documents List With Integration Department List
      if (isset($_SERVER['CONTENT_TYPE']) && ($_SERVER['CONTENT_TYPE'] == 'application/json' || $_SERVER['CONTENT_TYPE']=="application/json;charset=UTF-8"))  
        {        
            $type = json_decode(file_get_contents('php://input'), true);
            if(isset($type[0])){  
                $_POST = $type = $type[0]; 
            }else{
                $_POST = $type;
            }
        }
        
      // print_r($_POST);die;
        extract($_POST);
        
        $dataPosted = json_encode($_POST);
         if(!isset($sp_tag) && empty($sp_tag)){
             
          $response['STATUS'] = "401";
                $response['MESSAGE'] = "Unauthorized access. SP Tag is not valid";
                $response['DATA_RECIEVED'] = $dataPosted;
                $response['CALL_BACK_URL']="#";
                echo json_encode($response);
                die;
         }
         if(!isset($dept_application_id) && empty($dept_application_id)){
             
          $response['STATUS'] = "401";
                $response['MESSAGE'] = "Application not found";
                $response['DATA_RECIEVED'] = $dataPosted;
                $response['CALL_BACK_URL']="#";
                echo json_encode($response);
                die;
         }
        if(isset($department_id) && !empty($department_id) && isset($officer_key) && !empty($officer_key)){
         
        if(isset($_POST['email']) && !empty($_POST['email'])){ 
            $userData = Yii::app()->db->createCommand("Select * from bo_user where email='$_POST[email]'  AND disctrict_id=$_POST[district_id]")->queryRow();
            
            if(empty($userData))
            {
                extract($_POST);
                $currentDate = date('Y-m-d H:i:s'); 
                $userDatain = Yii::app()->db->createCommand("INSERT INTO `bo_user`( `full_name`, `email`,  `mobile`, `password`, `created_datetime`, `dept_id`, `disctrict_id`, `np_user_id`,`is_active`) VALUES ('$username','$email','$mobile_number','7cac711070d2877b264309c68678baf891f6a166','$currentDate','$department_id','$district_id','$officer_key','1')")->execute();
                
                $userData2 = Yii::app()->db->createCommand("Select * from bo_user where email='$_POST[email]'  AND disctrict_id=$_POST[district_id]")->queryRow();
                    
                $userDatarole = Yii::app()->db->createCommand("INSERT INTO `bo_user_role_mapping` (`user_id`,`role_id`,`department_id`,`created_time`,`is_mapping_active`) VALUES ('$userData2[uid]','$role','$department_id','$currentDate','Y')")->execute();

            } 
        }   
       
       $userResult = Yii::app()->db->createCommand("select * from bo_user 
            INNER JOIN bo_user_role_mapping ON bo_user.uid=bo_user_role_mapping.user_id
            Where bo_user.np_user_id=$officer_key AND bo_user.dept_id=$department_id AND bo_user.is_active=1")->queryRow();
                        
    if(!empty($userResult)){
             $applicationResult = Yii::app()->db->createCommand("select sno,user_id from bo_sp_applications where sp_tag='$sp_tag' AND app_id='$dept_application_id'")->queryRow();
               //AND sp_app_id='$service_id'
                if (!empty($userResult)) {
                    $token = "";

                    $token = $this->getToken(100);

                    if (!empty($token) && isset($token)) {
                        $access_model = new AccessToken;
                        $access_model->user_id = $userResult['uid'];
                        $access_model->access_token = $token;
                        $access_model->is_active = 1;
                        $access_model->created_date = Date('Y-m-d H:i:s');
                        $access_model->save();
                        $_SESSION['token'] = $token;
                    }
                }
                if(!empty($applicationResult['sno']))
               // $swappId= str_rot13($applicationResult['sno']);
                $swappId= base64_encode($applicationResult['sno']);
                $userID= base64_encode($applicationResult['user_id']);
                $response['STATUS'] = "200";
                $response['MESSAGE'] = "Validated Successfully";
                $response['DATA_RECIEVED'] = $dataPosted;
                $response['CALL_BACK_URL']="http://169.38.99.248/backoffice/api/sso/tokenValidate/token/$token/additionalInfo/$swappId/uInfo/$userID";
                //http://investuttarakhand.co.in/backoffice/dms/DepartmentDMS/view/sno/Mzg3OA==/user/MTE=
                echo json_encode($response);
                die;
    }
        
         }else{
                $response['STATUS'] = "401";
                $response['MESSAGE'] = "Department Or Officer Key is not valid";
                $response['DATA_RECIEVED'] = $dataPosted;
                $response['CALL_BACK_URL']="#";
                echo json_encode($response);
                die;             
         }   

      
    }
    
    
    public function actionLoginSwcs() {
      
        // Get Application DMS Documents List With Integration Department List
     
        if (isset($_SERVER['CONTENT_TYPE']) && ($_SERVER['CONTENT_TYPE'] == 'application/json' || $_SERVER['CONTENT_TYPE']=="application/json;charset=UTF-8"))  
        {        
            $type = json_decode(file_get_contents('php://input'), true);
            if(isset($type[0])){  
                $_POST = $type = $type[0]; 
            }else{
                $_POST = $type;
            }
        }
      // print_r($_POST);die;
        extract($_POST);
       
        $dataPosted = json_encode($_POST);
        // print_r($_POST);die;
         if(!isset($sp_tag) && empty($sp_tag)){
             
          $response['STATUS'] = "401";
                $response['MESSAGE'] = "Unauthorized access. SP Tag is not valid";
                $response['DATA_RECIEVED'] = $dataPosted;
                $response['CALL_BACK_URL']="#";
                echo json_encode($response);
                die;
         }
         if(!isset($dept_application_id) && empty($dept_application_id)){
             
          $response['STATUS'] = "401";
                $response['MESSAGE'] = "Application not found";
                $response['DATA_RECIEVED'] = $dataPosted;
                $response['CALL_BACK_URL']="#";
                echo json_encode($response);
                die;
         }
        if(isset($department_id) && !empty($department_id) && isset($officer_key) && !empty($officer_key)){
         
            ///
        $userData = Yii::app()->db->createCommand("Select * from bo_user where email='$_POST[email]'  AND disctrict_id=$_POST[district_id]")->queryRow();
        
        if(empty($userData))
        {
            extract($_POST);
            $currentDate = date('Y-m-d H:i:s'); 
            $userDatain = Yii::app()->db->createCommand("INSERT INTO `bo_user`( `full_name`, `email`,  `mobile`, `password`, `created_datetime`, `dept_id`, `disctrict_id`, `np_user_id`,`is_active`) VALUES ('$username','$email','$mobile_number','7cac711070d2877b264309c68678baf891f6a166','$currentDate','$department_id','$district_id','$officer_key','1')")->execute();
            
            $userData2 = Yii::app()->db->createCommand("Select * from bo_user where email='$_POST[email]'  AND disctrict_id=$_POST[district_id]")->queryRow();
                
            $userDatarole = Yii::app()->db->createCommand("INSERT INTO `bo_user_role_mapping` (`user_id`,`role_id`,`department_id`,`created_time`,`is_mapping_active`) VALUES ('$userData2[uid]','$role','$department_id','$currentDate','Y')")->execute();

        }
        
        $userResult = Yii::app()->db->createCommand("select * from bo_user 
            INNER JOIN bo_user_role_mapping ON bo_user.uid=bo_user_role_mapping.user_id
            Where bo_user.np_user_id=$officer_key AND bo_user.dept_id=$department_id AND bo_user.is_active=1")->queryRow();
                        
        if(!empty($userResult)){
             $applicationResult = Yii::app()->db->createCommand("select sno,user_id from bo_sp_applications where sp_tag='$sp_tag' AND app_id='$dept_application_id' AND sp_app_id='$service_id'")->queryRow();
               
                if (!empty($userResult)) {
                    $token = "";

                    $token = $this->getToken(100);

                    if (!empty($token) && isset($token)) {
                        $access_model = new AccessToken;
                        $access_model->user_id = $userResult['uid'];
                        $access_model->access_token = $token;
                        $access_model->is_active = 1;
                        $access_model->created_date = Date('Y-m-d H:i:s');
                        $access_model->save();
                        $_SESSION['token'] = $token;
                    }
                }
                if(!empty($applicationResult['sno']))
               // $swappId= str_rot13($applicationResult['sno']);
                $swappId= base64_encode($applicationResult['sno']);
                $userID= base64_encode($applicationResult['user_id']);
                $response['STATUS'] = "200";
                $response['MESSAGE'] = "Validated Successfully";
                $response['DATA_RECIEVED'] = $dataPosted;
                $response['CALL_BACK_URL']="http://169.38.99.248/backoffice/api/sso/tokenValidate/token/$token/additionalInfo/$swappId/uInfo/$userID";
                //http://investuttarakhand.co.in/backoffice/dms/DepartmentDMS/view/sno/Mzg3OA==/user/MTE=
                echo json_encode($response);
                die;
    }
        
         }else{
                $response['STATUS'] = "401";
                $response['MESSAGE'] = "Department Or Officer Key is not valid";
                $response['DATA_RECIEVED'] = $dataPosted;
                $response['CALL_BACK_URL']="#";
                echo json_encode($response);
                die;             
         }   

      
    }
    
    private function getToken($length) {

        $token = "";

        $codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";

        $codeAlphabet .= "abcdefghijklmnopqrstuvwxyz";

        $codeAlphabet .= "0123456789";

        $max = strlen($codeAlphabet); // edited

        for ($i = 0; $i < $length; $i++) {

            $token .= $codeAlphabet[$this->crypto_rand_secure(0, $max - 1)];
        }



        return $token;
    }

    private function crypto_rand_secure($min, $max) {

        $range = $max - $min;

        if ($range < 1)
            return $min; // not so random...

        $log = ceil(log($range, 2));

        $bytes = (int) ($log / 8) + 1; // length in bytes

        $bits = (int) $log + 1; // length in bits

        $filter = (int) (1 << $bits) - 1; // set all lower bits to 1

        do {

            $rnd = hexdec(bin2hex(openssl_random_pseudo_bytes($bytes)));

            $rnd = $rnd & $filter; // discard irrelevant bits
        } while ($rnd > $range);

        return $min + $rnd;
    }
    
    public function actionTokenValidate(){
        extract($_GET);
     //  print_r($_SERVER);die;
        if(isset($token) && !empty($token)){
             $userToken = Yii::app()->db->createCommand("select * from bo_access_token where access_token='$token' AND bo_access_token.is_active=1")->queryRow();
      
             $userResult = Yii::app()->db->createCommand("select * from bo_user 
            INNER JOIN bo_user_role_mapping ON bo_user.uid=bo_user_role_mapping.user_id
            Where bo_user.uid=$userToken[user_id] AND bo_user.is_active=1")->queryRow();
                //session_start();
                $role_id = $userResult['role_id'];
        $_SESSION['role_id']=$userResult['role_id'];
        $_SESSION['department_login'] = true;
        $_SESSION['uid'] = $userResult['uid'];
        $_SESSION['uname'] = $userResult['full_name'];
        $_SESSION['email'] = $userResult['email'];
        $_SESSION['dept_id'] = $userResult['dept_id'];
        $_SESSION['mobile'] = $userResult['mobile'];
        $_SESSION['district_id'] = $userResult['disctrict_id']; 
        $_SESSION['dist_id'] = $userResult['disctrict_id']; 
                $_SESSION['first_time_login']=1;
               // $swappId= str_rot13($additionalInfo);
                //$sno=base64_encode($additionalInfo);
                $redirectURL="/backoffice/dms/DepartmentDMS/view/sno/$additionalInfo/user/$uInfo";
                $this->redirect($redirectURL);
        }
    }

}
