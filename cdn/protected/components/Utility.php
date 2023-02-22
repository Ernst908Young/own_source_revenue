<?php

class Utility {
	
	public static function isLoggedIn(){
		@session_start();
		if(isset($_SESSION['LOGGED_IN']) && $_SESSION['LOGGED_IN']==1){
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	
	public static function logout(){
		@session_start();
		session_destroy();
		setcookie('SSO_TOKEN','',time()-1000,"/");
		setcookie('SSO_HREF','',time()-1000,"/");
	}
	
	public static function sanatizeString($string){
		$string=strip_tags(trim($string));
		
		return $string;
	}
	
	public static function xss_clean($data){
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
		return $data;
	} 
	
	public static function postViaCurl($url, $params=NULL) {
		$url = Utility::sanatizeString($url);
		$cookiejar = "SSO_COOKIE.txt";

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 5.1; rv:5.0) Gecko/20100101 Firefox/5.0');
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_COOKIEFILE, $cookiejar);
		curl_setopt($ch, CURLOPT_COOKIEJAR, $cookiejar);
		curl_setopt($ch, CURLOPT_TIMEOUT, CURL_TIMEOUT);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
		$output = curl_exec($ch);
		
		if ($output === false) {
			$error = array();
			$error['ERROR_MSG'] = curl_error($ch);
			$error['ERROR_CODE'] = curl_errno($ch);
			$error['url'] = $url;
			$return = array();
			$return['STATUS_ID'] = '222';
			$return['STATUS_MSG'] = 'CURL_ERROR';
			$return['RESPONSE'] = $error;

			$error_message = "cURL ERROR: \t " . curl_errno($ch) . " - " . curl_error($ch);
			Yii::log($error_message, 'error', 'system.*');
			return json_encode($return);
		} 
		else {
			$info = curl_getinfo($ch);
			curl_close($ch);
			$matches = array();
			$regex = '/Content-Length:\s([0-9].+?)\s/';
			$count = preg_match($regex, $output, $matches);
			$remote_filesize = isset($matches[1]) ? $matches[1] : "";
			$regex = '/Content-Type:\s([a-z].+?)\s/';
			$count = preg_match($regex, $output, $matches);
			$remote_file_content_type = isset($matches[1]) ? $matches[1] : "";

			if (empty($remote_file_content_type)) {
				extract($info);
				echo $output;
				exit ;
			}

			if (empty($remote_file_content_type)) {
				$remote_file_content_type = "text/html";
			}
			header("HTTP/1.1 200 OK");
			header("Content-Type: $remote_file_content_type");

			return $output;
		}
	}

	public static function getViaCurl($url) {
		$url = Utility::sanatizeString($url);
		$cookiejar = "SSO_COOKIE.txt";
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 5.1; rv:5.0) Gecko/20100101 Firefox/5.0');
		curl_setopt($ch, CURLOPT_POST, FALSE);
		curl_setopt($ch, CURLOPT_COOKIEFILE, $cookiejar);
		curl_setopt($ch, CURLOPT_COOKIEJAR, $cookiejar);
		curl_setopt($ch, CURLOPT_TIMEOUT, CURL_TIMEOUT);
		$output = curl_exec($ch);
		if ($output === false) {
			$error = array();
			$error['ERROR_MSG'] = curl_error($ch);
			$error['ERROR_CODE'] = curl_errno($ch);
			$error['url'] = $url;
			$return = array();
			$return['STATUS_ID'] = '222';
			$return['STATUS_MSG'] = 'CURL_ERROR';
			$return['RESPONSE'] = $error;

			$error_message = "cURL ERROR: \t " . curl_errno($ch) . " - " . curl_error($ch);
			Yii::log($error_message, 'error', 'system.*');
			return json_encode($return);
		} 
		else {
			return $output;
		}
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
        
            //Search page info
            $sql = "SELECT * FROM bo_form_info
                    INNER JOIN bo_form_field_name
                    ON bo_form_field_name.form_id=bo_form_info.form_id
                    WHERE bo_form_info.is_active = '1' AND bo_form_info.form_stub = :form_stub";            
            $command = $connection->createCommand($sql);
            $command->bindParam(":form_stub", $stub, PDO::PARAM_STR);
            $row = $command->queryRow();
            return $row;
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
	
}
