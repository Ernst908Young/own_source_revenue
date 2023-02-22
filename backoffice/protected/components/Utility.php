<?php
/**
 * Library for SWCS CMS
 */
class Utility {
    static function getAllLanguages(){
        $sql = "SELECT * FROM bo_languages WHERE is_active = '1' ORDER BY lang_id ASC";
        $connection = Yii::app()->db;
        $command = $connection->createCommand($sql);
        $info = $command->queryAll();
        return $info;
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
     * Function to sanatize a sting
     * 
     * @param string $parameter
     * @param boolean $strip_tags
     * 
     * @return string
     */
    static function sanatizeParams($parameter, $strip_tags = true) {

        if (is_array($parameter)) {
            $results = array();
            foreach ($parameter as $key => $value) {
                $value = trim($value);
                if ($strip_tags) {
                    $value = strip_tags($value);
                }
                //$value = Utility::swcs_mysql_escape_string($value);
                $results[$key] = $value;
            }
            return $results;
        } else {
            $parameter = trim($parameter);
            if ($strip_tags) {
                $parameter = strip_tags($parameter);
            }
            //$parameter = Utility::swcs_mysql_escape_string($parameter);
            return $parameter;
        }
    }
    
    static function getUserName($uid) {
        $sql = "SELECT * FROM bo_users WHERE uid = $uid";
        $connection = Yii::app()->db;
        $command = $connection->createCommand($sql);
        $info = $command->queryRow();
        return $info['full_name'].' ('.$uid.')';
    }
    
    static function renderVideo($video) {
		$videoEmbedCode="<embed src='$video' width='400' height='400' /> <a href='$video'>Download Video</a>";
        /*
        $videoEmbedCode='
			<object id="player_api" name="player_api" data="./flowplayer.swf" type="application/x-shockwave-flash" width="100%" height="100%">
			<param name="allowfullscreen" value="true">
			<param name="allowscriptaccess" value="always">
			<param name="quality" value="high">
			<param name="bgcolor" value="#000000">
			<param name="flashvars" value="config={&quot;playerId&quot;:&quot;player&quot;,&quot;clip&quot;:{&quot;url&quot;:&quot;$video&quot;},&quot;playlist&quot;:[{&quot;url&quot;:&quot;$video&quot;}]}">
			</object>';
        */
        return $videoEmbedCode;
    }
    
    static function isValidEmail($email) {
        $info = array();
        $sql = "SELECT * FROM bo_users WHERE email = :email";
        $connection = Yii::app()->db;
        $command = $connection->createCommand($sql);
        $command->bindParam(":email", $email, PDO::PARAM_STR);
        $info = $command->queryRow();
        return $info;
    }
    
    static function isActiveEmail($email) {
        $sql = "SELECT count(*) as TOTAL FROM bo_users WHERE email = :email AND is_active = 1";
        $connection = Yii::app()->db;
        $command = $connection->createCommand($sql);
        $command->bindParam(":email", $email, PDO::PARAM_STR);
        $info = $command->queryRow();
        return $info['TOTAL'];
    }
    
    static function checkStub($stub,$pageId) {
        $sql = "SELECT count(*) as TOTAL FROM bo_page_info WHERE page_stub LIKE :stub AND page_id <> :pageId";
        $connection = Yii::app()->db;
        $command = $connection->createCommand($sql);
        $command->bindParam(":stub", $stub, PDO::PARAM_STR);
        $command->bindParam(":pageId", $pageId, PDO::PARAM_STR);
        $info = $command->queryRow();
        return $info['TOTAL'];
    }

    public function getLastInsertedPageId($stub) {
        $stub = strtolower($stub);
        $sql = "SELECT * FROM bo_page_info WHERE lower(page_stub) = '" . $stub . "'";
        $connection = Yii::app()->db;
        $command = $connection->createCommand($sql);
        //$command->bindParam(":stub", $stub, PDO::PARAM_STR);
        $info = $command->queryRow();
        return $info['page_id'];
    }

    static function getLastOrderNumber($catid) {
        $sql = "SELECT * FROM bo_page_category_relation WHERE cat_id = :cateid ORDER BY page_order DESC";
        $connection = Yii::app()->db;
        $command = $connection->createCommand($sql);
        $command->bindParam(":cateid", $catid, PDO::PARAM_INT);
        $info = $command->queryRow();
        if (count($info) > 0) {
            return $info['page_order'];
        } else {
            $id = 0;
            return $id;
        }
    }

    static function getHomePageSliderInfo() {
        $status = 1;
        $sql = "SELECT * FROM bo_manage_homepage_slider WHERE is_active = 1";
        $connection = Yii::app()->db;
        $command = $connection->createCommand($sql);
        $rows = $command->queryAll();
        return $rows;
    }

    static function getHomePageInfo() {
        $status = 1;
        $sql = "SELECT * FROM bo_manage_homepage WHERE is_active = 1";
        $connection = Yii::app()->db;
        $command = $connection->createCommand($sql);
        $rows = $command->queryRow();
        return $rows;
    }

    static function getFooterLinks($id) {
        $sql = "SELECT *
                FROM bo_page_info
                INNER JOIN bo_page_category_relation
                ON bo_page_info.page_id=bo_page_category_relation.page_id 
                WHERE bo_page_info.is_active = 1 AND page_category_relation.is_active = 1 AND  page_category_relation.cat_id = :id
                ORDER BY page_category_relation.page_order";
        $connection = Yii::app()->db;
        $command = $connection->createCommand($sql);
        $command->bindParam(":id", $id, PDO::PARAM_INT);
        $result = array();
        $rows = $command->queryAll();
        return $rows;
    }

    static function getPageName($id) {
        $sql = "SELECT * FROM bo_page_info WHERE page_id = :id";
        $connection = Yii::app()->db;
        $command = $connection->createCommand($sql);
        $command->bindParam(":id", $id, PDO::PARAM_INT);
        $result = array();
        $rows = $command->queryRow();
        return $rows['page_name'];
    }

    static function getCategoryName($id) {
        $sql = "SELECT * FROM bo_page_categories WHERE pcat_id = :id";
        $connection = Yii::app()->db;
        $command = $connection->createCommand($sql);
        $command->bindParam(":id", $id, PDO::PARAM_INT);
        $result = array();
        $rows = $command->queryRow();
        return $rows['pcat_name'];
    }
    
    /**
     * Function to get stub name of the page from Page ID
     * 
     * @param int $page_id
     * @return string
     */
    static function getStubNameFromId($page_id) {
        if ($page_id == 0) {
            return " -NA- ";
        } else {
            return PageInfo::model()->findByPk($page_id)->page_stub;
        }
    }
    
    static function getChildrenTreeByStub($stub) {
        $connection = Yii::app()->db;
        $result = array();         
        $select = "SELECT page_id,parent_id,page_name,page_name1,page_name2,page_name3,page_name4 FROM bo_page_info WHERE page_stub = :page_stub";
        $command = $connection->createCommand($select);
        $command->bindParam(":page_stub", $stub, PDO::PARAM_STR);
        $row = $command->queryRow();
        //check if page has children
        $select2="SELECT count(parent_id) as Children FROM bo_page_info 
                WHERE parent_id = (SELECT page_id FROM bo_page_info WHERE page_stub = :page_stub)";
        $command = $connection->createCommand($select2);
        $command->bindParam(":page_stub", $stub, PDO::PARAM_STR);        
        $row2 = $command->queryRow();
        if($row2['Children']==0){
            $page_id = $row['parent_id'];        
        }
        else{
            $page_id = $row['page_id'];        
        }
        $page_name = PageInfo::model()->findByPk($page_id)->page_name;
        $page_name1 = PageInfo::model()->findByPk($page_id)->page_name1;
        $page_name2 = PageInfo::model()->findByPk($page_id)->page_name2;
        $page_name3 = PageInfo::model()->findByPk($page_id)->page_name3;
        $page_name4 = PageInfo::model()->findByPk($page_id)->page_name4;
        $page_stub = PageInfo::model()->findByPk($page_id)->page_stub;
        /*$sql = "SELECT a.page_id,b.* FROM `page_info` as a
				INNER JOIN page_info as b
				ON a.page_id = b.parent_id
				WHERE a.page_id  = :page_id
				LIMIT 30"; */
	    $sql = "SELECT a.page_id,b.*,c.* FROM `bo_page_info` as a
                    INNER JOIN bo_page_info as b ON a.page_id = b.parent_id
                    INNER JOIN bo_page_category_relation as c ON b.page_id = c.page_id
                    WHERE a.page_id  = :page_id
                    GROUP BY b.page_stub 
                    ORDER BY c.page_order";
        $command = $connection->createCommand($sql);
        $command->bindParam(":page_id", $page_id, PDO::PARAM_INT);       
        $row = $command->queryAll();
        return array("page_name"=>$page_name,"page_name1"=>$page_name1,"page_name2"=>$page_name2,"page_name3"=>$page_name3,"page_name4"=>$page_name4,"links"=>$row,"page_stub"=>$page_stub);
    }
    
    /**
     * Function to get page tree
     * 
     * @return array
     */
    static function getPageTreeByStub($stub = 'branches') {
        /*$sql = "SELECT a.page_id,b.* FROM `page_info` as a
				INNER JOIN page_info as b
				ON a.page_id = b.parent_id
				WHERE a.page_stub  = :stub
				LIMIT 30";*/
	    $sql = "SELECT a.page_id,b.*,c.* FROM `bo_page_info` as a
				INNER JOIN bo_page_info as b
				ON a.page_id = b.parent_id

                INNER JOIN bo_page_category_relation as c
				ON b.page_id = c.page_id
				WHERE a.page_stub  = :stub 
				GROUP BY b.page_stub 
				ORDER BY c.page_order";
        $connection = Yii::app()->db;
        $command = $connection->createCommand($sql);
        $command->bindParam(":stub", $stub, PDO::PARAM_STR);
        $result = array();
        $row = $command->queryAll();
        return $row;
    }

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
     * Function to get page order
     * 
     * @param int $pageId
     * @return array
     */
    static function getPageOrder($page_id = 0) {
        $return = array();
        $pages = Utility::getAllPages(true, false, $page_id);
        $total = count($pages);
        for ($i = 1; $i <= ($total + 3); $i++) {
            $return[$i] = $i;
        }
        return $return;
    }

    /**
     * Function to get total page order for page cat relation table
     * 
     * @param int $pageId
     * @return array
     */
    static function getTotalPageOrder($page_id = 0) {
        $return = array();
        $sql = "SELECT count(page_id) as total  FROM bo_page_info WHERE is_active = 1;";
        $connection = Yii::app()->db;
        $command = $connection->createCommand($sql);
        $result = array();
        $info = $command->queryRow();
        $total = $info['total'];
        for ($i = 1; $i <= ($total + 3); $i++) {
            $return[$i] = $i;
        }
        return $return;
    }

    /**
     * Function to get all Roles
     * 
     * @param boolean $active  [OPTIONAL]
     * @return array
     */
    public static function getAllRoles($active = true) {
        if ($active !== false) {
            $sql = "SELECT role_id,role_name FROM bo_roles";
        } else {
            $sql = "SELECT role_id,role_name FROM bo_roles WHERE is_active=1";
        }
        $return = array();
        $connection = Yii::app()->db;
        $command = $connection->createCommand($sql);
        $result = array();
        $rows = $command->queryAll();
        if ($rows === FALSE) {
            return array();
        } else {
            foreach ($rows as $key => $row) {
                extract($row);
                $result[$role_id] = $role_name;
            }
            return $result;
        }
    }

    /**
     * Function to get the Name of the page category from cat ID
     * 
     * @param int $catId
     * @return string $catName
     */
    static function getCatNameFrom($catId) {
        $sql = "SELECT pcat_name FROM bo_page_categories WHERE pcat_id = '$catId'";
        $connection = Yii::app()->db;
        $command = $connection->createCommand($sql);
        $result = array();
        $row = $command->queryRow();
        if (!empty($row['pcat_name'])) {
            return $row['pcat_name'];
        } else {
            return " - ";
        }
    }

    /**
     * Function to get the ID of the page category from cat name
     * 
     * @param string $catName
     * @return int $catId
     */
    public static function getCatIdFromName($catName) {
        $sql = "SELECT pcat_id FROM bo_page_categories WHERE pcat_name LIKE '$catName'";
        $connection = Yii::app()->db;
        $command = $connection->createCommand($sql);
        $result = array();
        $row = $command->queryRow();
        if (!empty($row['pcat_id'])) {
            return $row['pcat_id'];
        } else {
            return 0;
        }
    }

    /**
     * Function to Get all Pages
     * 
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
                     bo_page_info.new_tab,
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
                    bo_page_info.new_tab,
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

    /**
     * Function to get all categories
     * 
     * @param boolean $active [Optional]
     * @return array
     */
    static function getAllCategories($active = true) {
        if ($active) {
            $sql = "SELECT pcat_id,pcat_name FROM bo_page_categories WHERE is_active=1";
        } else {
            $sql = "SELECT pcat_id,pcat_name FROM bo_page_categories";
        }
        $connection = Yii::app()->db;
        $command = $connection->createCommand($sql);
        $result = array();
        $rows = $command->queryAll();
        foreach ($rows as $row) {
            extract($row);
            $result[$pcat_id] = $pcat_name;
        }
        return $result;
    }

    /**
     * Function to get html content from stub
     * 
     * @param string $stub
     * @return string
     */
    static function getContentFromStub($stub) {
        $stub = Utility::sanatizeParams($stub);
		$connection = Yii::app()->db;
		
		//Search page info		
        $sql = "SELECT * FROM bo_page_info WHERE is_active='1' AND page_stub = :page_stub";        
        $command = $connection->createCommand($sql);
        $command->bindParam(":page_stub", $stub, PDO::PARAM_STR);
        $row = $command->queryRow();
        if ($row) {		
            return $row;
        } else {
		
			return false;
        }
    }  

    
    static function getMapedPageIds($roleId) {
        $sql = "SELECT * FROM bo_map_roles_pages WHERE role_id = :roleId AND is_active='1'";
        $connection = Yii::app()->db;
        $command = $connection->createCommand($sql);
        $command->bindParam(":roleId", $roleId, PDO::PARAM_INT);
        $rows = $command->queryAll();
        foreach($rows as $k=>$v) {
            $all .= $v['parent_page_id'].',';
        }
        return $all;
    }

    static function isSuperAdmin() { 
        $session = new CHttpSession;
        $session->open();
        if (!isset($session['ROLE_ID']) || empty($session['ROLE_ID'])) {
            return FALSE;
        } else {
            if ($session['ROLE_ID'] == "1") {
                return TRUE;
            } else {
                return FALSE;
            }
        }
    }
    
    static function isAuthUser() {
    	@session_start();
		if (isset($_SESSION['UID']) && !empty($_SESSION[UID]) ) {
			return TRUE;
		}
		else{
			return FALSE;
		}
    	/*
        $session = new CHttpSession;
        $session->open();
        if (!isset($session['ROLE_ID']) || empty($session['ROLE_ID'])) {
            return FALSE;
        } else {
            $pageIds = $_SESSION['PAGE_IDS']; 
		   $pageIds = trim($pageIds,","); 
		    if(empty($pageIds)) {
                return FALSE;
            } else { 
                return TRUE;
            }
        }*/
    }

    /**
     * Function to check if the iviss_cookie is present and/or valid
     *
     * @return boolean
     */
    static function isSessionValid() { 
        if (isset(Yii::app()->request->cookies['swcscms_cookie']->value)) {
            $swcscms_cookie = @Yii::app()->request->cookies['swcscms_cookie']->value;
            $session = new CHttpSession;
            $session->open();
            if (!isset($session['UID']) || empty($session['UID'])) {
                return false;
            }
            $token = 22;
            $rand_number = $session['RandomNumner'];
            $RID = $session['UID'];
            $ua = $_SERVER['HTTP_USER_AGENT'];
            $ip = $_SERVER['REMOTE_ADDR'];
            $session->regenerateID();
            $date = date("D-M-Y");
            $hash = $token . "_" . $date . "-" . $ua . "_" . $ip . "-" . $RID . "_" . $rand_number;
            $hash = hash_hmac("sha1", $hash, "swcs_cms");
            if ($hash == $swcscms_cookie) {
                return true;
            }
        }
        return false;
    } 

    /**
     * Function to create iviss_cookie after successful login
     *
     * @return void
     */
    static function initLogin() {
        $session = new CHttpSession;
        $session->open();
        if (!isset($session['UID']) || empty($session['UID'])) {
            return false;
        }
        $session['RandomNumner'] = $rand_number = rand(999, 9999999);
        $session->regenerateID();
        $RID = $session['UID'];
        $token = 22;
        $ua = $_SERVER['HTTP_USER_AGENT'];
        $ip = $_SERVER['REMOTE_ADDR'];
        $date = date("D-M-Y");
        $hash = $token . "_" . $date . "-" . $ua . "_" . $ip . "-" . $RID . "_" . $rand_number;
        $hash = hash_hmac("sha1", $hash, "swcs_cms");
        $expire = time() + 60 * 60 * 3;    //Cookie valid for 3 hours
        $cOptions = array("secure" => false, "httpOnly" => false, 'expire' => $expire); 
        Yii::app()->request->cookies['swcscms_cookie'] = new CHttpCookie("swcscms_cookie", $hash, $cOptions);
    }
    
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

    
    static function sendEmailAlert($email, $subject, $message) {
        Yii::app()->mailer->Host = EMAIL_HOST;
        Yii::app()->mailer->IsSMTP();
        Yii::app()->mailer->From = SMTP_EMAIL;
        Yii::app()->mailer->FromName = 'SWCS Admin';
        Yii::app()->mailer->AddReplyTo(SMTP_EMAIL);
        Yii::app()->mailer->AddAddress($email);
        Yii::app()->mailer->Subject = $subject;
        Yii::app()->mailer->Body = $message;
        Yii::app()->mailer->Send();
    }
    
    static function addLoginAccessLog($uid){
		$connection=Yii::app()->db;
		
		$uid=intval($uid);
		$time_stamp=time();
		$date_time=date('Y-m-d H:i:s');
		$sql="INSERT INTO bo_login_access_log(uid,time_stamp,date_time) VALUES($uid,$time_stamp,'$date_time')";
				
		$command=$connection->createCommand($sql);
		$rowCount=$command->execute(); 
		if($rowCount>0){
			return true;
		}
		else{
			return false;
		}		
	}
	
	/**
     * Function to filter output
     * 
     * @param string $str
     * @return string
     */
    static function outputfilter($str) {
        $str = strip_tags($str);
        $str = preg_replace('/[^A-Za-z0-9\-\(]/', ' ', $str);
        $str = str_replace('(', ' ', $str);
        return $str;
    }

    /**
     * Function to get body content from html content
     * 
     * @param string $htmlContent
     * @return string
     */
    
    static function getBodyContent($htmlContent) {
      $noheader = "";
      $bodypattern = ".*<body>";
      $bodyendpattern = "</body>.*";
     /* $noheader = eregi_replace($bodypattern, "", $htmlContent);
      $noheader = eregi_replace($bodyendpattern, "", $noheader);
      echo "<pre>";print_r($noheader);die;
      return $noheader;*/
       preg_match("/<body[^>]*>(.*?)<\/body>/is", $htmlContent, $matches);
       return $matches[1];
    }
    
    /**
     * Function to get slider content
     * 
     * @param none
     * @return array
     * @auther Hemant Thakur
     */
    
    static function getSliderContent(){
        $sql = "SELECT * FROM bo_manage_homepage_slider WHERE is_active = '1' ORDER BY image_order ASC";
        $connection = Yii::app()->db;
        $command = $connection->createCommand($sql);
        $result = array();
        $rows = $command->queryAll();
        if ($rows === FALSE)
            return 0;
         else 
            return $rows;        
    }
    /**
     * Function to get minister content
     * 
     * @param none
     * @return string
     * @auther Hemant Thakur
     */
    
    static function getMinisterInfo(){
        $sql = "SELECT homepage_minitster_image,homepage_minister_name,homepage_minister_readmore_link,homepage_minister_designation,homepage_minsiter_message FROM bo_manage_homepage WHERE is_active = '1'";
        $connection = Yii::app()->db;
        $command = $connection->createCommand($sql);
        $result = array();
        $rows = $command->queryAll();
        if ($rows === FALSE)
            return 0;
         else 
            return $rows[0];        
    }
     /**
     * Function to get minister content
     * 
     * @param none
     * @return array
     * @auther Hemant Thakur
     */
    
    static function getAccordionInfo(){
        $sql = "SELECT acc_descr,acc_title FROM bo_manage_accordion_block WHERE is_active = '1' ORDER BY acc_order ASC";
        $connection = Yii::app()->db;
        $command = $connection->createCommand($sql);
        $result = array();
        $rows = $command->queryAll();
        if ($rows === FALSE)
            return 0;
         else 
            return $rows;        
    }
    /**
     * Function to get minister content
     * 
     * @param none
     * @return array
     * @auther Hemant Thakur
     */
    
    static function getProgressBarInfo(){
        $sql = "SELECT inv_title,inv_val_percentage,inv_backgroud_color,inv_title_backgroud_color FROM bo_manage_accordion_block2 WHERE is_active = '1' ORDER BY inv_order ASC";
        $connection = Yii::app()->db;
        $command = $connection->createCommand($sql);
        $result = array();
        $rows = $command->queryAll();
        if ($rows === FALSE)
            return 0;
         else 
            return $rows;        
    }
     /**
     * Function to get minister content
     * 
     * @param none
     * @return array
     * @auther Hemant Thakur
     */
    
    static function getActiveDeptInfo(){
        $sql = "SELECT department_name,department_link,department_img FROM bo_departments WHERE is_department_active = '1' ORDER BY dept_order ASC";
        $connection = Yii::app()->db;
        $command = $connection->createCommand($sql);
        $result = array();
        $rows = $command->queryAll();
        if ($rows === FALSE)
            return 0;
         else 
            return $rows;        
    }
    /**
     * Function to get minister content
     * 
     * @param none
     * @return array
     * @auther Hemant Thakur
     */
    
    static function getNonActiveDeptInfo(){
        $sql = "SELECT department_name,department_link,department_img FROM bo_departments WHERE is_department_active <> '1' ORDER BY dept_order ASC";
        $connection = Yii::app()->db;
        $command = $connection->createCommand($sql);
        $result = array();
        $rows = $command->queryAll();
        if ($rows === FALSE)
            return 0;
         else 
            return $rows;        
    }
    /**
     * Function to get minister content
     * 
     * @param none
     * @return string
     * @auther Hemant Thakur
     */
    
    static function getContactInfo(){
        $sql = "SELECT homepage_footer_aboutus,contact_us_email,contact_us_phone,contact_us_address FROM bo_manage_homepage WHERE is_active = '1'" ;
        $connection = Yii::app()->db;
        $command = $connection->createCommand($sql);
        $result = array();
        $rows = $command->queryAll();
        if ($rows === FALSE)
            return 0;
         else 
            return $rows[0];        
    }
    /**
     * Function to get minister content
     * 
     * @param none
     * @return string
     * @auther Hemant Thakur
     */
    
    static function getSerContentInfo(){
        $sql = "SELECT block1_after_slider_heading,block1_after_slider_desc,block1_after_slider_read_more_link,block2_after_slider_heading,block2_after_slider_desc,block2_after_slider_read_more_link,block3_after_slider_heading,block3_after_slider_desc,block3_after_slider_read_more_link,block_after_slider_main_heading FROM bo_manage_homepage WHERE is_active = '1'" ;
        $connection = Yii::app()->db;
        $command = $connection->createCommand($sql);
        $result = array();
        $rows = $command->queryAll();
        if ($rows === FALSE)
            return 0;
         else 
            return $rows[0];        
    }
	
	
	
	
	
    
    
    
    
    
    
    
    
    
    
	
	static function getHomepageImage($type="share"){
		if($type=="share"){
			$dir="images/share";
		}
		else{
			$dir="images/public";
		}
		
		if ($dh = opendir($dir)) {
	        while (($file = readdir($dh)) !== false) {
	        	if($file!="." && $file!=".."){
	            	return $dir ."/". $file;
				}
	        }
	        closedir($dh);
	    }
		return "images/1.png";
	}
	
	static function clean($string) {
   		$string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
   		$string = preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
	   	return preg_replace('/-+/', '-', $string); // Replaces multiple hyphens with single one.
	}
	
	static function getUserInteractions($from=NULL, $to=NULL){
		if(empty($from) && empty($to)){
			return array();
		}
		if(empty($from) && !empty($to)){
			$sql="SELECT *  FROM `user_interactions` WHERE msg_to=$to ORDER BY added_date	DESC";
		}
		elseif(!empty($from) && empty($to)){
			$sql="SELECT *  FROM `user_interactions` WHERE user_id=$from ORDER BY added_date	DESC";
		}
		elseif(!empty($from) && !empty($to)){
			$sql="SELECT *  FROM `user_interactions` WHERE user_id=$from AND msg_to=$to ORDER BY added_date	DESC";
		}
		$connection = Yii::app()->db;
        $command = $connection->createCommand($sql);
        $row= $command->queryAll();
		return $row;
	}
	
	static function getLiveTelecastUrl(){
		$sql="SELECT *  FROM `live_telecast` WHERE is_active='Y' ORDER BY tid DESC LIMIT 0,1";
		$connection = Yii::app()->db;
        $command = $connection->createCommand($sql);
        $row= $command->queryRow();
		$telecast_url=$row['telecast_url'];
		$telecast_url=trim($telecast_url);
		$telecast_url=str_replace("http://","//",$telecast_url);
		$telecast_url=str_replace("https://","//",$telecast_url);
		$telecast_url=end(explode("?v=",$telecast_url));
		
		$telecast_url="//www.youtube.com/embed/".$telecast_url;
		
		return $telecast_url;
	}
	
	
    
	
	static function xss_clean($data){
		// Fix &entity\n;
		$data = str_replace(array('&amp;','&lt;','&gt;'), array('&amp;amp;','&amp;lt;','&amp;gt;'), $data);
		$data = preg_replace('/(&#*\w+)[\x00-\x20]+;/u', '$1;', $data);
		$data = preg_replace('/(&#x*[0-9A-F]+);*/iu', '$1;', $data);
		$data = html_entity_decode($data, ENT_COMPAT, 'UTF-8');	
		// Remove any attribute starting with "on" or xmlns
		$data = preg_replace('#(<[^>]+?[\x00-\x20"\'])(?:on|xmlns)[^>]*+>#iu', '$1>', $data);	
		// Remove javascript: and vbscript: protocols
		$data = preg_replace('#([a-z]*)[\x00-\x20]*=[\x00-\x20]*([`\'"]*)[\x00-\x20]*j[\x00-\x20]*a[\x00-\x20]*v[\x00-\x20]*a[\x00-\x20]*s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:#iu', '$1=$2nojavascript...', $data);
		$data = preg_replace('#([a-z]*)[\x00-\x20]*=([\'"]*)[\x00-\x20]*v[\x00-\x20]*b[\x00-\x20]*s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:#iu', '$1=$2novbscript...', $data);
		$data = preg_replace('#([a-z]*)[\x00-\x20]*=([\'"]*)[\x00-\x20]*-moz-binding[\x00-\x20]*:#u', '$1=$2nomozbinding...', $data);
		// Only works in IE: <span style="width: expression(alert('Ping!'));"></span>
		$data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?expression[\x00-\x20]*\([^>]*+>#i', '$1>', $data);
		$data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?behaviour[\x00-\x20]*\([^>]*+>#i', '$1>', $data);
		$data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:*[^>]*+>#iu', '$1>', $data);
		// Remove namespaced elements (we do not need them)
		$data = preg_replace('#</*\w+:\w[^>]*+>#i', '', $data);
		$data = preg_replace('#</*(?:applet|b(?:ase|gsound|link)|embed|frame(?:set)?|i(?:frame|layer)|l(?:ayer|ink)|meta|object|s(?:cript|tyle)|title|xml)[^>]*+>#i', '', $data);
		$data = strip_tags($data);
		
		return $data;
	}
	
	static function getVisitorCount(){
		$sql="SELECT count(DISTINCT(unique_key)) as visitors FROM accesss_log";
		//$sql="SELECT count(unique_key) as visitors FROM accesss_log";
		$connection = Yii::app()->db;
        $command = $connection->createCommand($sql);
        $row= $command->queryRow();
		//fake
		$visitors=$row['visitors'];
		if(empty($visitors)){
			$visitors=100;
		}
		else{
			$visitors=$visitors*30;
		}
		$visitors=number_format($visitors);
		return $visitors;
	}
	
	static function getSamvadMagazineInfo(){
		$sql="SELECT * FROM samvad_magazine WHERE is_active='1' ";
		$connection = Yii::app()->db;
        $command = $connection->createCommand($sql);
        return $command->queryRow();
	}
	
     /**
     * Function to add access log
     */
    static function addAccessLog() {
        $model= new AccesssLog;
        $info = array();
        $info['user_agent']     = $_SERVER['HTTP_USER_AGENT'];
        $info['requester_ip']     = $_SERVER['REMOTE_ADDR'];
        $info['date_time']   = date("Y-m-d"); 
        $info['unique_key'] = md5($_SERVER['HTTP_USER_AGENT'].$_SERVER['REMOTE_ADDR'].date("Y-m-d"));               
        $model->attributes=$info;
        try{
		    $model->save(); 
		} catch (Exception $e){ 
		    return true;
		}
    }
    
    static function getSpeechVideos() {
		$data=$speechCatInfo=array();
		$criteria1=new CDbCriteria;
		$criteria1->limit = 3;
		$criteria1->offset = 0;			
		$criteria1->condition ="is_active=1";
		$criteria1->order = "scat_id ASC";
		$speechCategories = ManageSpeechCategories::model()->findAll($criteria1);
		$i = 0;
		foreach($speechCategories as $info){
			$speechCatInfo[$i]=$info->attributes;
			$catId = $info->scat_id;
			
			$criteria=new CDbCriteria;
			$criteria->limit = 1;
			$criteria->offset = 0;			
			$criteria->condition ="is_active=1 AND 	speech_cat_id = $catId";
			$criteria->order = "speech_id DESC";
			$_videoInfo=ManageSpeechgallery::model()->findAll($criteria);		
			$speechCatInfo[$i]['speeches'] = $_videoInfo;
			$i++;
		}
		return $speechCatInfo;
		//echo "<pre>";print_r($speechCatInfo); die;    
    }
    
	static function getSpeech() {
	 	$sql = "SELECT * FROM manage_speechgallery WHERE is_active = '1' ";
        $connection = Yii::app()->db;
        $command = $connection->createCommand($sql);
        return $command->queryRow();
	}
	 
    
    
    
    
    static function getTotalVisitors(){
        $allVisitors = AccesssLog::model()->count();
        return $allVisitors;
    }
    
    static function getTodaysVisitors(){
        $criteria = new CDbCriteria();
        $date = date("Y-m-d");
        $criteria->condition = "date_time= '$date 00:00:00'";
        $allVisitors = AccesssLog::model()->count($criteria);
        return $allVisitors;
    
    }
    
     /**
     * Function to get misc label
     * 
     * @param string $label and int $langId
     * @return string
     */
    public static function getMicsLabel($label,$langId) {
        if($langId == 0){
            $langId = '';
        }
        $sql = "SELECT label$langId FROM misc_labels WHERE label LIKE '$label'";
        $connection = Yii::app()->db;
        $command = $connection->createCommand($sql);
        $info = $command->queryRow();
        return $info['label'.$langId];
    }
    
    
    
    static function getimageCatName($id){
        $sql = "SELECT image_category FROM manage_image_categories WHERE cat_id = :id AND is_active = '1'";
        $connection = Yii::app()->db;
        $command = $connection->createCommand($sql);
        $command->bindParam(":id", $id, PDO::PARAM_INT);
        $info = $command->queryRow();
        return $info['image_category'];
    }
    static function getVideoCatName($id){
        $sql = "SELECT video_category FROM manage_video_categories WHERE vcat_id = :id AND is_active = '1'";
        $connection = Yii::app()->db;
        $command = $connection->createCommand($sql);
        $command->bindParam(":id", $id, PDO::PARAM_INT);
        $info = $command->queryRow();
        return $info['video_category'];
    }

    

    /**
     * Function to fetch all active images from db
     * @return string
     */
    static function getAllImages() {
        $sql = "SELECT * FROM manage_imagegallery WHERE is_active = '1'";
        $connection = Yii::app()->db;
        $command = $connection->createCommand($sql);
        $result = array();
        $rows = $command->queryAll();
        if ($rows === FALSE) {
            return 0;
        } else {
            return $rows;
        }
    }

    /**
     * Function to fetch all active videos from db
     * @return string
     */
    static function getAllVideos() {
        $sql = "SELECT * FROM manage_videogallery WHERE is_active = '1'";
        $connection = Yii::app()->db;
        $command = $connection->createCommand($sql);
        $result = array();
        $rows = $command->queryAll();
        if ($rows === FALSE) {
            return 0;
        } else {
            return $rows;
        }
    }

    /**
     * Function to fetch all active news from db
     * @return string
     */
    static function getAllNews() {
        $sql = "SELECT * FROM manage_news WHERE is_active = '1'";
        $connection = Yii::app()->db;
        $command = $connection->createCommand($sql);
        $result = array();
        $rows = $command->queryAll();
        if ($rows === FALSE) {
            return 0;
        } else {
            return $rows;
        }
    }

    /**
     * Function to fetch all active tender list from db
     * @return string
     */
    static function getTenderList() {
        $sql = "SELECT * FROM manage_tenders WHERE is_active = '1'";
        $connection = Yii::app()->db;
        $command = $connection->createCommand($sql);
        $result = array();
        $rows = $command->queryAll();
        //echo "<pre>"; print_r($rows); die;
        if ($rows === FALSE) {
            return 0;
        } else {
            return $rows;
        }
    }

    /**
     * Function to fetch home page right side image info from db
     * @return string
     */
    static function getHomePageRightSideInfo() {
        $sql = "SELECT * FROM manage_homepage WHERE is_active = '1'";
        $connection = Yii::app()->db;
        $command = $connection->createCommand($sql);
        $result = array();
        $row = $command->queryRow();
        if ($row === FALSE) {
            return 0;
        } else {
            return $row;
        }
    }

    /**
     * Function to fetch home page right side image from db
     * @return string
     */
    static function getHomePageRightSideImage() {
        $image = Utility::getHomePageRightSideInfo();
        if ($image != 0) {
            return $image['homepage_image'];
        }
    }

    /**
     * Function to fetch home page right side image from db
     * @param string $str
     * @return string
     */
    static function getHomePageRightSideTitle() {
        $image = Utility::getHomePageRightSideInfo();
        if ($image != 0) {
            return $image['homepage_image_title'];
        }
    }

      static function getViaCurl($url,$action,$data=null){
         $post = curl_init();
         $url=$url.DIRECTORY_SEPARATOR.$action;

        curl_setopt($post, CURLOPT_URL, $url);
        curl_setopt($post, CURLOPT_TIMEOUT, 500);
        curl_setopt($post, CURLOPT_CONNECTTIMEOUT, 500);
        curl_setopt($post, CURLOPT_POST, TRUE);
        curl_setopt($post, CURLOPT_POSTFIELDS, $data);
        curl_setopt($post, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec($post);
        // print_r($result);
        if (curl_errno($post) > 0) 
                return "Error";
        curl_close($post);
        return $result;
    }
        
    
    static function getBodyContentOld($htmlContent) {
        $matches = array();
        $pattern = "/<body>(.*)<\/body>/Uis";
        preg_match_all($pattern, $htmlContent, $matches, PREG_SET_ORDER);
        echo "============".$htmlContent; die;
        if (count($matches) == 0) {
            return $htmlContent;
        } else {
            return $matches[0][1];
        }
    }

    
}
