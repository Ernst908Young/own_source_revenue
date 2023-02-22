<?php

class Utility{

	public function logEntry(){
		
	}
	 /**
     * Function to escape the string 
     * 
     * @param string $string
     * @return string
     */
    static function swcs_mysql_escape_string($string) {
        $link = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
        $string = mysqli_real_escape_string($link, $string);
        mysqli_close($link);
        return $string;
    }
	/**
     * Function to get all the countries list
     * auther: Hemant thakur
     * @param 
     * @return array
     */


	static function getCountryList(){
        $active='Y';
        $sql = "SELECT lr.lr_id,lr.lr_name FROM bo_landregion lr INNER JOIN bo_country bc ON lr.lr_id = bc.lr_id WHERE lr.is_lr_active=:active";
        $connection = Yii::app()->db;
        $command = $connection->createCommand($sql);
        $command->bindParam(":active", $active, PDO::PARAM_STR);
        $info = $command->queryAll();
        if($info===FALSE)
            return;
        return $info;
    }

    static function validateToken($token){
        if(empty($token))
            return false;
        $url=SSO_API_URL."/gettokeninfo/token/".$token;
        $post = curl_init();
        curl_setopt($post, CURLOPT_URL, $url);
        curl_setopt($post, CURLOPT_POST,0);
        // curl_setopt($post, CURLOPT_POSTFIELDS, $fields);
        curl_setopt($post, CURLOPT_TIMEOUT, 500);
        curl_setopt($post, CURLOPT_CONNECTTIMEOUT, 500);
        curl_setopt($post, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec($post);
        if ($result === false) {
            $error = array();
            $error['ERROR_MSG'] = curl_error($post);
            $error['ERROR_CODE'] = curl_errno($post);
            $error['url'] = $url;
            $return = array();
            $return['STATUS_ID'] = '222';
            $return['STATUS_MSG'] = 'CURL_ERROR';
            $return['RESPONSE'] = $error;

            $error_message = "cURL ERROR: \t " . curl_errno($post) . " - " . curl_error($post);
           echo json_encode($return);
           return false;
        } 
       return $result;

    }
    /**
     * Function to get all the state list corresponding to the counrty
     * auther: Hemant thakur
     * @param string
     * @return array
     */

    static function getStateList($country){

        $active='Y';
        $sql="SELECT bc.id FROM bo_landregion lr INNER JOIN bo_country bc ON lr.lr_id = bc.lr_id WHERE lr.is_lr_active=:active AND lr.lr_id=:country";
        $connection = Yii::app()->db;
        $command = $connection->createCommand($sql);
        $command->bindParam(":active", $active, PDO::PARAM_STR);
        $command->bindParam(":country", $country, PDO::PARAM_INT);
        $info = $command->queryRow();
        if($info===FALSE)
            return;
        $sql="SELECT lr.lr_id,lr.lr_name FROM bo_landregion lr INNER JOIN bo_state bs ON lr.lr_id=bs.lr_id WHERE lr.is_lr_active=:active AND bs.country_id=:cid";
        $connection = Yii::app()->db;
        $command = $connection->createCommand($sql);
        $command->bindParam(":active", $active, PDO::PARAM_STR);
        $command->bindParam(":cid", $info['id'], PDO::PARAM_STR);
        $state = $command->queryAll();
        if($state===FALSE)
            return;
        return $state;
    }
     /**
     * Function to push otp
     * auther: Hemant thakur
     * @param string array
     * @return boolean
     */
   static function post_to_url($url, $data) {
        $fields = '';
        foreach($data as $key => $value) {
           $fields .= $key . '=' . $value . '&';
        }
        rtrim($fields, '&');
        // $url=$url.'?'.$fields;
        $post = curl_init();
        curl_setopt($post, CURLOPT_URL, $url);
        curl_setopt($post, CURLOPT_POST, count($data));
        curl_setopt($post, CURLOPT_POSTFIELDS, $fields);
        curl_setopt($post, CURLOPT_TIMEOUT, 500);
        curl_setopt($post, CURLOPT_CONNECTTIMEOUT, 500);
        curl_setopt($post, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec($post);
        if ($result === false) {
            $error = array();
            $error['ERROR_MSG'] = curl_error($post);
            $error['ERROR_CODE'] = curl_errno($post);
            $error['url'] = $url;
            $return = array();
            $return['STATUS_ID'] = '222';
            $return['STATUS_MSG'] = 'CURL_ERROR';
            $return['RESPONSE'] = $error;

            $error_message = "cURL ERROR: \t " . curl_errno($post) . " - " . curl_error($post);
           echo json_encode($return);
           return false;
        } 
       /* if (curl_errno($post) > 0) 
                return FALSE;*/
        curl_close($post);

          return TRUE;

        }
   
         /**
     * Function to send otp to mobile
     * auther: Hemant thakur
     * @param number number
     * @return boolean
     */
    static function sendOTPToMobile($mobile,$msg){
        $data = array(
        "Id" => SMS_GATEWAY_ID,            
       "Pwd" => SMS_GATEWAY_PASSWD,
       "PhNo" =>"91".$mobile,      
       "text"  => $msg        
       );
        if(Utility::post_to_url(SMS_GATEWAY, $data))
            return true;
        return false;

    }
       /**
     * Function to send email
     * auther: Hemant thakur
     * @param string string
     * @return boolean
     */
       static function sendEmail($host,$port,$username,$password,$subject,$message,$to) {
        Yii::import('ext.phpmailer.JPhpMailer');
        $mail = new JPhpMailer();
        $mail->IsSMTP();
        $mail->Host = $host;
        $mail->SMTPDebug = 1;
        $mail->port = $port;
        $mail->SMTPAuth = true;
        $mail->Username = $username;
        $mail->Password = $password;
        $mail->SetFrom($username, EMAIL_NAME);
        $mail->Subject = $subject;
        $mail->AltBody = 'To view the message, please use an HTML compatible email viewer!';
        $mail->MsgHTML($message);
        $mail->SMTPSecure = 'tls';
        $mail->AddAddress($to, $username);
        if($mail->Send()==FALSE){
            return false;
        }
        else{
           return true;
        }
    }
    static function sendEmailTest($host,$port,$username,$password,$subject,$message,$to) {
        Yii::import('ext.phpmailer.JPhpMailer');
        $mail = new JPhpMailer();
        $mail->IsSMTP();
        $mail->Host = $host;//"ssl://smtp.gmail.com";
        $mail->SMTPDebug = 2;
        $mail->port = 465;
        $mail->SMTPAuth = true;
        $mail->Username = $username;
        $mail->Password = $password;
        $mail->SetFrom($username, EMAIL_NAME);
        $mail->Subject = $subject;
        $mail->AltBody = 'To view the message, please use an HTML compatible email viewer!';
        $mail->MsgHTML($message);
        $mail->SMTPSecure = 'tls';
        $mail->AddAddress($to, $username);
        if($mail->Send()==FALSE){
            return false;
        }
        else{
           return true;
        }
    }
    /**
     * Function to get tree
     * auther: Hemant thakur
     * @param 
     * @return array
     */
    static function getPageTree($pcat_id = 1) {
        $return = array();
        $pages = Utility::getAllPages(true, false, 0, $pcat_id);
        foreach ($pages as $page) {
            $page_id = $page['page_id'];
            $children = Utility::getAllPages(true, false, $page_id, $pcat_id);
            $children1 = array();
            foreach ($children as $child) {
                $childpage_id = $child['page_id'];
                $sub_child = Utility::getAllPages(true, false, $childpage_id, $pcat_id);
                $child['children'] = $sub_child;
                $children1[] = $child;
            }

            $page['children'] = $children1;
            $return[] = $page;
        }
        return $return;
    }
    /**
     * Function to Get all Pages
     * auther Hemant Thakur
     * @param boolean $active [Optional]
     * @return array
     */
    static function getAllPages($active = true, $render = true, $parent_id = false, $pcat_id = 1) {
        $active = (int) $active;
        if ($parent_id !== false) {
            $parent_id = (int) $parent_id;
            //$sql = "SELECT page_order,page_id,page_stub,page_name,parent_id FROM page_info WHERE pcat_id=$pcat_id AND parent_id=$parent_id AND is_active=$active ORDER BY page_order";
            $sql = "SELECT 
                    bo_page_info.page_id,
                    bo_page_info.page_stub,
                    bo_page_info.page_name,
                    bo_page_info.page_name1,
                    bo_page_info.page_name2,
                    bo_page_info.page_name3,
                    bo_page_info.page_name4,
                    bo_page_info.parent_id,
                    bo_page_info.is_direct_link,
                    bo_page_info.link_address,
                    bo_page_category_relation.relation_id,
                    bo_page_category_relation.page_order,
                    bo_page_category_relation.cat_id FROM bo_page_info 
                    INNER JOIN bo_page_category_relation
                    ON bo_page_info.page_id=bo_page_category_relation.page_id 
                    WHERE 
                    bo_page_category_relation.cat_id=$pcat_id 
                    AND bo_page_info.parent_id=$parent_id 
                    AND bo_page_info.is_active=$active
                    AND bo_page_category_relation.is_active=$active
                    ORDER BY bo_page_category_relation.page_order";
        } else {
            //$sql = "SELECT page_order,page_order,page_id,page_stub,page_name,parent_id FROM page_info WHERE pcat_id=$pcat_id  AND is_active=$active ORDER BY page_order";
            $sql = "SELECT bo_page_info.page_id,
                    bo_page_info.page_stub,
                    bo_page_info.page_name,
                    bo_page_info.page_name1,
                    bo_page_info.page_name2,
                    bo_page_info.page_name3,
                    bo_page_info.page_name4,
                    bo_page_info.parent_id,
                    bo_page_info.is_direct_link,
                    bo_page_info.link_address,
                    bo_page_category_relation.relation_id,
                    bo_page_category_relation.page_order,
                    bo_page_category_relation.cat_id FROM bo_page_info 
                    INNER JOIN page_category_relation
                    ON bo_page_info.page_id=bo_page_category_relation.page_id 
                    WHERE page_category_relation.cat_id = $pcat_id  
                        AND bo_page_info.is_active=$active ORDER BY bo_page_category_relation.page_order";
        }
        // die;
        $connection = Yii::app()->db;
        $command = $connection->createCommand($sql);
        $result = array();
        $rows = $command->queryAll();
        if ($render === TRUE) {
            $result[0] = " (No Parent Page) ";
            foreach ($rows as $row) {
                extract($row);
                $result[$page_id] = "$page_name  -  ($page_stub) ";
            }
        } else {
            foreach ($rows as $row) {
                $result[] = $row;
            }
        }
        return $result;
    }


}