<?php

require_once($_SERVER["DOCUMENT_ROOT"] . '/panchayatiraj/backoffice/protected/extensions/tcpdf/tcpdf/tcpdf.php');

class MYPDFTC extends TCPDF {

    //Page header
    public function Header() {
        // Logo
        $line_width = (0.85 / $this->k);
        $this->SetLineStyle(array('width' => $line_width, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => '#000'));
        $image_file = $_SERVER['DOCUMENT_ROOT'] . Yii::app()->theme->baseUrl . '/img/' . PDF_HEADER_LOGO;
        $this->Image($image_file, 1, 0.2, 2, '', '', '', 'T', false, 300, '', false, false, 0, false, false, false);
        // Set font
        $this->SetFont('times', '', 10);
        $data = '<table>
            <tr>
              <th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th>
            </tr>
            <tr>
            <td colspan="8" style="font-weight:900;font-size:1.5em" align="center">' . PDF_HEADER_TITLE_CAF . '</td>
             </tr>
             <tr>
            <td colspan="8" style="font-weight:600;font-size:0.9em" align="center">' . PDF_HEADER_STRING1 . '</td>
            </tr>
             <tr><td colspan="8" style="font-weight:600;font-size:0.9em" align="center"> ' . PDF_HEADER_STRING2 . ' </td>
             </tr>
          </table><br><hr>';

        // Title
        $this->Cell(0, -5, $this->writeHTML($data), 0, '', 'T', 0, 'C');
        $image_file2 = $_SERVER['DOCUMENT_ROOT'] . Yii::app()->theme->baseUrl . '/img/chips.jpg';
        $this->Image($image_file2, 18, 0.7, 2, '', '', '', 'T', false, 300, '', false, false, 0, false, false, false);
        $data = '<hr>';
        $this->Ln();
    }

    // Page footer
    public function Footer() {
        @session_start();
        // echo "<pre>";print_r($_SESSION);die;
        $uname = 'User';
        if (isset($_SESSION['uname']) && !empty($_SESSION['uname'])) {
            $uname = ucwords($_SESSION['uname']);
            if (preg_match('/_/', $uname))
                $uname = ucwords(str_replace('_', ' ', $uname));
        }
        $line_width = (0.85 / $this->k);
        $this->SetLineStyle(array('width' => $line_width, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => '#000'));
        //print document barcode
        $barcode = $this->getBarcode();
        if (!empty($barcode)) {
            $this->Ln($line_width);
            $barcode_width = round(($this->w - $this->original_lMargin - $this->original_rMargin) / 3);
            $style = array(
                'position' => $this->rtl ? 'R' : 'L',
                'align' => $this->rtl ? 'R' : 'L',
                'stretch' => false,
                'fitwidth' => true,
                'cellfitalign' => '',
                'border' => false,
                'padding' => 0,
                'fgcolor' => array(0, 0, 0),
                'bgcolor' => false,
                'text' => false
            );
            $this->write1DBarcode($barcode, 'C128', '', $cur_y + $line_width, '', (($this->footer_margin / 3) - $line_width), 0.3, $style, '');
        }
        // Position at 15 mm fr	om bottom
        $this->SetY(-1);
        // Set font
        $this->SetFont('helvetica', 'I', 8);
        $data = '<hr /><table class="tbl">
            <tr>
              <th colspan="1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Printed By: ' . $uname . '</th colspan="2"><th>Printed DateTime:' . date('Y-m-d H:m:s') . '</th><th>  Page Number:' . $this->getAliasNumPage() . '/' . $this->getAliasNbPages() . ' </th>';
        $data .= '</tr>
          </table>';


        // Page number
        $this->Cell(0, 0, $this->writeHTML($data), '', 1, 'R');
    }

}

class DefaultUtility {
    /* Function is used to Generate Application PDF
     * Author : Hemant OJHA
     * @param : int(role_id)
      @return : PDF
     */

    static function PDFApplication($content, $name, $isStore = null) {
        // die("aya");
        // $cnt=count($contentArray);
        // $pdf = Yii::createComponent('application.extensions.tcpdf.ETcPdf', 'P', 'cm', 'A4', true, 'UTF-8');
        $pdf = new MYPDFTC('P', 'cm', 'A4', true, 'UTF-8', false);
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor("SWCS Chhattisgarh");
        $pdf->SetTitle($name . "Application Form");
        $pdf->SetSubject($name);
        $pdf->SetKeywords("SWCS, Application Form");
        $pdf->setPrintHeader(true);
        $pdf->setHeaderFont(Array('helvetica', '', 10));
        $pdf->setFooterFont(Array('helvetica', '', 10));
        $pdf->SetMargins(1, 2.6, 1);
        // set default header data
        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);
        //$pdf->setHeader();
        $pdf->setPrintFooter(true);
        $pdf->AliasNbPages();
        $pdf->AddPage();
        $pdf->SetFont("helvetica", "", 10);
        $params = $pdf->serializeTCPDFtagParameters(array('CODE 39', 'C39', '', '', 80, 30, 0.4, array('position' => 'S', 'border' => true, 'padding' => 4, 'fgcolor' => array(0, 0, 0), 'bgcolor' => array(255, 255, 255), 'text' => true, 'font' => 'helvetica', 'fontsize' => 8, 'stretchtext' => 4), 'N'));
        $pdf->writeHTML($content, true, 0, 0, 0);
        $pdf->lastPage();
        if (is_null($isStore))
            $pdf->Output($name, "I");
        else
            $pdf->Output($name, "F");
    }

    /** @ SANTOSH KUMAR
     * this function is used to check whethe Helpdesk user is logged in or not 
     */
    static function isValidHelpdeskLogin() {
        @session_start();
        if (isset($_SESSION['helpdesk_login']) && $_SESSION['helpdesk_login'] == 1)
            return true;
        return false;
    }

    /**
     * this function is used to create the duration
     * @author Hemant Thakur

     */
    public static function formatTime($diff) { //echo "=====".$diff; die;
        $years = floor($diff / (365 * 60 * 60 * 24));
        $months = floor(($diff - $years * 365 * 60 * 60 * 24) / (30 * 60 * 60 * 24));
        $days = floor(($diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24) / (60 * 60 * 24));
        $hours = floor(($diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24) / (60 * 60));
        $minutes = floor(($diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24 - $hours * 60 * 60) / 60);
        $seconds = floor(($diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24 - $hours * 60 * 60 - $minutes * 60));
        $time = "";
        if (!empty($years)) {
            $time .= "$years years, ";
        }
        if (!empty($months)) {
            $time .= "$months months, ";
        }
        if (!empty($days)) {
            $time .= "$days days, ";
        }
        if (!empty($hours)) {
            $time .= "$hours hours, ";
        }
        /* if (!empty($minutes)) {
          $time.="$minutes minutes, ";
          }
          if (!empty($seconds)) {
          $time.="$seconds seconds";
          } */
        return $time;
    }

    /*     * this function is used to get the type of industries
     * @author Hemant thakur
     */

    static function getTypeOfIndustries() {
        //$sql="SELECT Ans_ID,Ans_Text  FROM answer_master WHERE Ques_ID=1 AND Is_Active=1";
        $sql = "select NIC_V_DIGIT as Ans_ID,CONCAT(NIC_V_DIGIT,'-',Description)as Ans_Text from NIC_Codes";
        $connection = Yii::app()->db;
        $command = $connection->createCommand($sql);
        $industries = $command->queryAll();
        return $industries;
    }

    static function getTypeOfIndustriesFromId($id) {
        $sql = "SELECT Ans_Text  FROM answer_master WHERE Ans_ID=:id";
        $connection = Yii::app()->db;
        $command = $connection->createCommand($sql);
        $command->bindParam(":id", $id, PDO::PARAM_INT);
        $industries = $command->queryAll();
        if ($industries === false)
            return false;
        return $industries['Ans_Text'];
    }

    /*     * This function is used to encrypt the text with rsa public key 
     * @author Hemant Thakur
     */

    static function getEncryption($string) {
        $key = file_get_contents(Yii::app()->basePath . '/public_key.pem');
        // echo $key;die;;
        openssl_public_encrypt($string, $encryptedData, $key);
        return base64_encode($encryptedData);
    }

    /*     * This function is used to dencrypt the text with rsa private key 
     * @author Hemant Thakur
     */

    static function getDecryption($string) {
        $prikey = file_get_contents(Yii::app()->basePath . '/private_key.pem');
        // echo $prikey;die;
        openssl_private_decrypt(base64_decode($string), $decrypted, $prikey);
        return $decrypted;
    }

    public static function getAllDept() {
        $model = new DepartmentsExt;
        $allDept = $model->getDept();
        return $allDept;
    }

    public static function getAllDeptFiltered($sub_id, $role_id) {
        $dist = DefaultUtility::getDisttId($sub_id);
        $sql = '';
        $active = 'Y';
        if ($role_id == 4)
            $sql = "SELECT * FROM bo_departments dept
				INNER JOIN bo_user_role_mapping rm
				ON dept.dept_id=rm.department_id AND rm.role_id=5
				WHERE dept.is_department_active=1 AND rm.is_mapping_active=:active";
        $sql = "SELECT uid,full_name, usr.dept_id,dept.department_name FROM bo_user usr
				   INNER JOIN bo_departments dept
				   ON dept.dept_id=usr.dept_id
				   WHERE usr.disctrict_id=:dist AND usr.dept_id!=1 AND dept.is_department_active=1 group by usr.dept_id";
        $connection = Yii::app()->db;
        $command = $connection->createCommand($sql);
        if ($role_id == 4)
            $command->bindParam(":active", $active, PDO::PARAM_STR);
        $command->bindParam(":dist", $dist, PDO::PARAM_STR);
        // $command->bindParam(":uid",$user_id,PDO::PARAM_INT);
        $deptList = $command->queryAll();
        // print_r($appList);die;	
        if ($deptList === false)
            return false;
        return $deptList;
    }

    public static function getDisttId($sub_id) {
        $sql = "SELECT landrigion_id  FROM bo_application_submission WHERE submission_id=:sub_id";
        $connection = Yii::app()->db;
        $command = $connection->createCommand($sql);
        //$command->bindParam(":aprvhold",$aprvhold,PDO::PARAM_STR);
        $command->bindParam(":sub_id", $sub_id, PDO::PARAM_INT);
        $dist = $command->queryRow();
        // print_r($appList);die;	
        if ($dist === false)
            return false;
        return $dist['landrigion_id'];
    }

    public static function getDeptApp($dept_id) {
        $model = new ApplicationExt;
        $dept_id = $model->getAppFromDept($dept_id);
        //print_r($dept_id);die;
        return $dept_id;
    }

    /**
     * Function is used to check for super admin role
     * @author : Hemant Thakur
     * @param : int(role_id)
     * @return : Boolean(true/false)
     */
    static function isSuperAdmin() {
        @session_start();
        if (!isset($_SESSION['uid']) && empty($_SESSION['uid']))
            return false;
        $uid = $_SESSION['uid'];
        $rolesModel = new RolesExt;
        $role_id = $rolesModel->getUserRoleViaId($uid);
        if ($role_id['role_id'] == 1)
            return true;
        else
            return false;
    }

    /**
     * Function is used to check for valid Investor Login
     * @author : Hemant Thakur
     * @param : 
     * @return : Boolean(true/false)
     */
    static function isValidLogin() {
        @session_start();
        if (!isset($_SESSION['sso_token']))
            return false;
        if (strlen($_SESSION['sso_token']) >= 32)
            return true;
        return false;
    }

    static function getBodyContent($htmlContent) {
        $noheader = "";
        // echo $htmlContent;
        $bodypattern = ".*<body>";
        $bodyendpattern = "</body>.*";
        /* $noheader = eregi_replace($bodypattern, "", $htmlContent);
          $noheader = eregi_replace($bodyendpattern, "", $noheader);
          echo "<pre>";print_r($noheader);die;
          return $noheader; */
        preg_match("/<body[^>]*>(.*?)<\/body>/is", $htmlContent, $matches);
        // echo "<pre>";print_r($matches);die;
        if (isset($matches[1]))
            return $matches[1];
        else
            return false;
    }

    static function mysql_escape_string($string) {
        $link = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
        $string = mysqli_real_escape_string($link, $string);
        mysqli_close($link);
        return $string;
    }

    static function sanatizeParams($parameter, $strip_tags = true) {
        if (is_array($parameter)) {
            $results = array();
            foreach ($parameter as $key => $value) {
                /**
                 * check for nested array 
                 * added by hemant
                 */
                if (is_array($value)) {
                    $returnValue[$key] = DefaultUtility::sanatizeParams($value);
                    $results = array_merge($results, $returnValue);
                    continue;
                }
                // edit finished
                $value = trim($value);
                if ($strip_tags) {
                    $value = strip_tags($value);
                }
                $value = DefaultUtility::mysql_escape_string($value);
                $results[$key] = $value;
            }
            return $results;
        } else {
            $parameter = trim($parameter);
            if ($strip_tags) {
                $parameter = strip_tags($parameter);
            }
            $parameter = DefaultUtility::mysql_escape_string($parameter);
            return $parameter;
        }
    }

    public static function sanatizeString($string) {
        $string = strip_tags(trim($string));

        return $string;
    }

    public static function httpRequest($url, $params = NULL, $method = 'GET') {
        $url = DefaultUtility::sanatizeString($url);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        //curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 5.1; rv:5.0) Gecko/20100101 Firefox/5.0');
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
        if (ENV == 'prod') {
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        }
        if (IS_HTTP_AUTH) {
            curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
            curl_setopt($ch, CURLOPT_USERPWD, HTTP_AUTH_USERNAME . ":" . HTTP_AUTH_PASSWORD);
        }
        // echo "<pre>";print_r($params);die;
        curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
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
        } else {
            return $output;
        }
    }

    public static function postViaCurl($url, $params = NULL) {
        $url = DefaultUtility::sanatizeString($url);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        //curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 5.1; rv:5.0) Gecko/20100101 Firefox/5.0');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
        if (ENV == 'prod') {
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        }
        if (IS_HTTP_AUTH) {
            curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
            curl_setopt($ch, CURLOPT_USERPWD, HTTP_AUTH_USERNAME . ":" . HTTP_AUTH_PASSWORD);
        }
        curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
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
        } else {
            return $output;
        }
    }

    /**
     * This function is used to check the noodles role
     * @author : Hemant Thakur
     * 
     */
    static function isNoodalOfficer() {
        @session_start();
        if (!isset($_SESSION['uid']) && empty($_SESSION['uid']))
            return false;
        $uid = $_SESSION['uid'];
        $rolesModel = new RolesExt;
        $role_id = $rolesModel->getUserRoleViaId($uid);
        if ($role_id['role_id'] == 3)
            return true;
        else
            return false;
    }

    static function isNoodalAgency() {
        @session_start();
        if (!isset($_SESSION['uid']) && empty($_SESSION['uid']))
            return false;
        $uid = $_SESSION['uid'];
        $rolesModel = new RolesExt;
        $role_id = $rolesModel->getUserRoleViaId($uid);
        if ($role_id['role_id'] == 7)
            return true;
        else
            return false;
    }

    static function grievanceNodal() {
        @session_start();
        if (!isset($_SESSION['uid']) && empty($_SESSION['uid']))
            return false;
        $uid = $_SESSION['uid'];
        $rolesModel = new RolesExt;
        $role_id = $rolesModel->getUserRoleViaId($uid);
        if (($role_id['role_id'] == 4) || ($role_id['role_id'] == 3))
            return true;
        else
            return false;
    }

    static function isNodalUser() {
        @session_start();
        if (!isset($_SESSION['uid']) && empty($_SESSION['uid']))
            return false;
        $uid = $_SESSION['uid'];
        $rolesModel = new RolesExt;
        $role_id = $rolesModel->getUserRoleViaId($uid);
        if (($role_id['role_id'] == 4) || ($role_id['role_id'] == 7))
            return true;
        else
            return false;
    }

    /**
     * this funciton is used validate whether sub admin or not
     * @author Hemnat thakur 
     */
    static function isSubAdmin() {
        @session_start();
        if (!isset($_SESSION['uid']) && empty($_SESSION['uid']))
            return false;
        $uid = $_SESSION['uid'];
        $rolesModel = new RolesExt;
        $role_id = $rolesModel->getUserRoleViaId($uid);
        if ($role_id['role_id'] == 61)
            return true;
        else
            return false;
    }

    /**
     * this funciton is used validate whether sub HOD or not
     * @author Hemnat thakur 
     */
    static function isHODNodal() {
        @session_start();
        if (!isset($_SESSION['uid']) && empty($_SESSION['uid']))
            return false;
        $uid = $_SESSION['uid'];
        $rolesModel = new RolesExt;
        $role_id = $rolesModel->getUserRoleViaId($uid);
        if ($role_id['role_id'] == 62)
            return true;
        else
            return false;
    }

    /**
     * Function to push otp
     * auther: Hemant thakur
     * @param string array
     * @return boolean
     */
    static function post_to_url($url, $data) {
        $fields = '';
      //  print_r($data); 
        foreach ($data as $key => $value) {
            if($key=='to'){
                if(is_array($value)){
                        foreach ($value as $k => $v) {
                            $fields .= $key."[$k]" . '=' . $v . '&';
                        }            
                     }else{
                         $fields .= $key . '=' . $value . '&';
                     }
            }else{
                $fields .= $key . '=' . $value . '&';
            }
            
        }
      // echo '<br><br>'.$fields; 
        rtrim($fields, '&');
        // $url=$url.'?'.$fields;
        $post = curl_init();
        curl_setopt($post, CURLOPT_URL, $url);
        curl_setopt($post, CURLOPT_POST, count($data));
        curl_setopt($post, CURLOPT_POSTFIELDS, $fields);
        curl_setopt($post, CURLOPT_TIMEOUT, 500);
        if (ENV == 'prod') {
            curl_setopt($post, CURLOPT_SSL_VERIFYHOST, false);
            curl_setopt($post, CURLOPT_SSL_VERIFYPEER, false);
        }
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
            // echo json_encode($return);
            return false;
        }
        /* if (curl_errno($post) > 0) 
          return FALSE; */
        curl_close($post);

        return $result;
    }

    /**
     * Function to send otp to mobile
     * auther: Hemant thakur
     * @param number number
     * @return boolean
     */
    static function sendMultipleSMS($mobile, $msg) {
        $data = array(
            "Id" => SMS_GATEWAY_ID,
            "Pwd" => SMS_GATEWAY_PASSWD,
            "PhNo" => "$mobile",
            "text" => urlencode($msg)
        );
        if (DefaultUtility::post_to_url(SMS_GATEWAY, $data))
            return true;
        return false;
    }

    static function sendOTPToMobile($mobile, $msg) {
        $data = array(
            "Id" => SMS_GATEWAY_ID,
            "Pwd" => SMS_GATEWAY_PASSWD,
            "PhNo" => "91" . $mobile,
            "text" => $msg
        );
        if (DefaultUtility::post_to_url(SMS_GATEWAY, $data))
            return true;
        return false;
    }

    /**
     * this function is used to check whether user is distric nodal or not
     * @author Hemant thakur
     */
    static function isDisttCommentLevelUser() {
        @session_start();
        if (!isset($_SESSION['uid']) && empty($_SESSION['uid']))
            return false;
        $uid = $_SESSION['uid'];
        $rolesModel = new RolesExt;
        $role_id = $rolesModel->getUserRoleViaId($uid);
        if ($role_id['role_id'] == 3)
            return true;
        else
            return false;
    }

    /**
     * this function is used to check whether user state approve
     * @author Hemant thakur
     */
    static function isStateApproverUser() {
        @session_start();
        if (!isset($_SESSION['uid']) && empty($_SESSION['uid']))
            return false;
        $uid = $_SESSION['uid'];
        $rolesModel = new RolesExt;
        $role_id = $rolesModel->getUserRoleViaId($uid);
        if ($role_id['role_id'] == 34)
            return true;
        else
            return false;
    }

    /**
     * this function is used to check whether user District approver
     * @author Hemant thakur
     */
    static function isDisttApproverUser() {
        @session_start();
        if (!isset($_SESSION['uid']) && empty($_SESSION['uid']))
            return false;
        $uid = $_SESSION['uid'];
        $rolesModel = new RolesExt;
        $role_id = $rolesModel->getUserRoleViaId($uid);
        if ($role_id['role_id'] == 33)
            return true;
        else
            return false;
    }

    /**
     * Function to send email
     * auther: Hemant thakur
     * @param string string
     * @return boolean
     */
    static function sendEmail($host, $port, $username, $password, $subject, $message, $to, $email_name = null, $cc = null, $bcc = null, $attchement = null) {
        //$email_name would be the notification_name in the database table
        Yii::import('ext.phpmailer.JPhpMailer');
        $mail = new JPhpMailer();
        $mail->IsSMTP();
        $mail->Host = $host;
        $mail->SMTPDebug = 2;
        $mail->port = $port;
        $mail->SMTPAuth = false;
        $mail->Username = $username;
        $mail->Password = $password;
        if (is_null($email_name))
            $mail->SetFrom($username, EMAIL_NAME);
        else
            $mail->SetFrom($username, $email_name);
        $mail->Subject = $subject;
        $mail->AltBody = 'To view the message, please use an HTML compatible email viewer!';
        $mail->MsgHTML(stripslashes(html_entity_decode($message, ENT_QUOTES, 'UTF-8' )));
        //  $mail->SMTPSecure = 'tls';
        $mail->AddAddress($to, $username);
        if (!is_null($cc) && is_array($cc)) {
            foreach ($cc as $key => $cCopy)
                $mail->AddAddress($cCopy);
        }
        /* if(isset($bcc) && !is_null($bcc))
          $mail->AddAddress($bcc,$username); */
        if (isset($attachment) && !is_null($attachment) && is_array($attachment)) {
            foreach ($attachment as $key => $attch)
                $mail->AddAttachment(@$attch['filePath'], @$attch['fileName']);
        }

        if ($mail->Send() === FALSE) {
            return 0;
        } else {
            return 1;
        }
    }

    static function isSMSSender() {
        @session_start();
        if (!isset($_SESSION['uid']) && empty($_SESSION['uid']))
            return false;
        $uid = $_SESSION['uid'];
        $rolesModel = new RolesExt;
        $role_id = $rolesModel->getUserRoleViaId($uid);
        if ($role_id['role_id'] == 60)
            return true;
        else
            return false;
    }

    /**
     * this function is used to check whether user is State comment nodal or not
     * @author Hemant thakur
     */
    static function isStateCommentLevelUser() {
        @session_start();
        if (!isset($_SESSION['uid']) && empty($_SESSION['uid']))
            return false;
        $uid = $_SESSION['uid'];
        $rolesModel = new RolesExt;
        $role_id = $rolesModel->getUserRoleViaId($uid);
        if ($role_id['role_id'] == 5)
            return true;
        else
            return false;
    }

    /**
     * this function is used to check whether user is state nodal or not
     */
    static function isStateNodalUser() {
        @session_start();
        if (!isset($_SESSION['uid']) && empty($_SESSION['uid']))
            return false;
        $uid = $_SESSION['uid'];
        $rolesModel = new RolesExt;
        $role_id = $rolesModel->getUserRoleViaId($uid);
        if ($role_id['role_id'] == 4)
            return true;
        else
            return false;
    }

    /**
     * this function is used to check whethe department user is logged in or not 
     */
    static function isValidDepartmentLogin() {
        @session_start();
        if (isset($_SESSION['department_login']) && $_SESSION['department_login'] == 1)
            return true;
        return false;
    }

    /**
     * this function is used to check whether investor is logged in or not
     * @author Hemant thakur
     */
    static function isInvestorLoggedIn() {
        @session_start();
        if (isset($_SESSION['RESPONSE']['token']) && strlen($_SESSION['RESPONSE']['token']) == 32)
            return true;
        else
            return false;
    }

    /**
     * Function is used to check for Information Wizard Login role
     * @author : Rahul Kumar
     * @param : int(role_id)
     * @return : Boolean(true/false)
     */
    static function isInfoWizardAdmin() {
        // echo "here";die;
        @session_start();
        if (!isset($_SESSION['uid']) && empty($_SESSION['uid']))
            return false;
        $uid = $_SESSION['uid'];
        $rolesModel = new RolesExt;
        $role_id = $rolesModel->getUserRoleViaId($uid);
        if ($role_id['role_id'] == 63)
            return true;
        else
            return false;
    }

    /** @ SANTOSH KUMAR
     * this function is used to check whethe Document Verifier user is logged in or not 
     */
    static function isValidDocumentVerifierLogin() {
        @session_start();
        if (!isset($_SESSION['uid']) && empty($_SESSION['uid']))
            return false;
        $uid = $_SESSION['uid'];
        $rolesModel = new RolesExt;
        $role_id = $rolesModel->getUserRoleViaId($uid);
        if ($role_id['role_id'] == 68)
            return true;
        else
            return false;
    }

    /**
     * Function is used to check for Information Wizard Login role
     * @author : Rahul Kumar
     * @param : int(role_id)
     * @return : Boolean(true/false)
     * 30-09-2017
     */
    static function isRoInspection() {
        // echo "here";die;
        @session_start();
        if (!isset($_SESSION['uid']) && empty($_SESSION['uid']))
            return false;
        $uid = $_SESSION['uid'];
        $rolesModel = new RolesExt;
        $role_id = $rolesModel->getUserRoleViaId($uid);
        if ($role_id['role_id'] == 69)
            return true;
        else
            return false;
    }

    /**
     * Function is used to check for Information Wizard Login role
     * @author : Rahul Kumar
     * @param : int(role_id)
     * @return : Boolean(true/false)
     * 31-09-2017
     */
    static function isInspectionInvestor() {
        // echo "here";die;
        @session_start();
        if (!isset($_SESSION['uid']) && empty($_SESSION['uid']))
            return false;
        $uid = $_SESSION['uid'];
        $rolesModel = new RolesExt;
        $role_id = $rolesModel->getUserRoleViaId($uid);
        if ($role_id['role_id'] == 70)
            return true;
        else
            return false;
    }

    /**
     * Function is used to check for SECRETARY Login role
     * @author : Rahul Kumar
     * @param : int(role_id)
     * @return : Boolean(true/false)
     * 22-11-2017
     */
    static function isSECRETARY() {
        @session_start();
        if (!isset($_SESSION['uid']) && empty($_SESSION['uid']))
            return false;
        $uid = $_SESSION['uid'];
        $rolesModel = new RolesExt;
        $role_id = $rolesModel->getUserRoleViaId($uid);
        if ($role_id['role_id'] == 71)
            return true;
        else
            return false;
    }

    /**
     * Function is used to check for PRINCIPAL SECRETARY Login role
     * @author : Rahul Kumar
     * @param : int(role_id)
     * @return : Boolean(true/false)
     * 08-12-2017
     */
    static function is_PRINCIPAL_SECRETARY() {

        @session_start();
        if (!isset($_SESSION['uid']) && empty($_SESSION['uid']))
            return false;
        $uid = $_SESSION['uid'];
        $rolesModel = new RolesExt;
        $role_id = $rolesModel->getUserRoleViaId($uid);
        if ($role_id['role_id'] == 72)
            return true;
        else
            return false;
    }

    /**
     * Function is used to check for  CHEIF SECRETARY Login role
     * @author : Rahul Kumar
     * @param : int(role_id)
     * @return : Boolean(true/false)
     * 09-12-2017
     */
    static function is_CHEIF_SECRETARY() {
        @session_start();
        if (!isset($_SESSION['uid']) && empty($_SESSION['uid']))
            return false;
        $uid = $_SESSION['uid'];
        $rolesModel = new RolesExt;
        $role_id = $rolesModel->getUserRoleViaId($uid);
        if ($role_id['role_id'] == 73)
            return true;
        else
            return false;
    }

    /**
     * Function is used to check remote URL status
     * @author : Apoorv
     * @param : url
     * @return : up/down
     * 09-12-2017
     */
    static function checkUrltatus($url) {
        $timeout = 300;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
        $http_respond = curl_exec($ch);
        $http_respond = trim(strip_tags($http_respond));
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        if (( $http_code == "200" ) || ( $http_code == "302" )) {
            return 'up';
        } else {
            // return $http_code;, possible too
            return 'down';
        }
    }

    /**
     * Function is used to check for iw data entry Login role
     * @author : Apoorv
     * @param : int(role_id)
     * @return : Boolean(true/false)
     * 22-11-2017
     */
    static function isIWDataEntry() {
        @session_start();
        if (!isset($_SESSION['uid']) && empty($_SESSION['uid']))
            return false;
        $uid = $_SESSION['uid'];
        $rolesModel = new RolesExt;
        $role_id = $rolesModel->getUserRoleViaId($uid);
        if ($role_id['role_id'] == 82)
            return true;
        else
            return false;
    }

    static function isVerifier() {
        @session_start();
        if (!isset($_SESSION['uid']) && empty($_SESSION['uid']))
            return false;
        $uid = $_SESSION['uid'];
        $rolesModel = new RolesExt;
        $role_id = $rolesModel->getUserRoleViaId($uid);

        if ($role_id['role_id'] == 87 || $role_id['role_id'] == 83)
            return true;
        else
            return false;
    }

    static function isSupport() {
        @session_start();
        if (!isset($_SESSION['uid']) && empty($_SESSION['uid']))
            return false;
        $uid = $_SESSION['uid'];
        $rolesModel = new RolesExt;
        $role_id = $rolesModel->getUserRoleViaId($uid);

        if ($role_id['role_id'] == 85)
            return true;
        else
            return false;
    }

    static function isApprover() {
        @session_start();
        if (!isset($_SESSION['uid']) && empty($_SESSION['uid']))
            return false;
        $uid = $_SESSION['uid'];
        $rolesModel = new RolesExt;
        $role_id = $rolesModel->getUserRoleViaId($uid);
        if ($role_id['role_id'] == 88 || $role_id['role_id'] == 84)
            return true;
        else
            return false;
    }

    /**
     * Function is used to check for super admin role
     * @author : Hemant Thakur
     * @param : int(role_id)
     * @return : Boolean(true/false)
     */
    static function isAdmin() {
        @session_start();
        if (!isset($_SESSION['uid']) && empty($_SESSION['uid']))
            return false;
        $uid = $_SESSION['uid'];
        $rolesModel = new RolesExt;
        $role_id = $rolesModel->getUserRoleViaId($uid);
        if ($role_id['role_id'] == 2)
            return true;
        else
            return false;
    }

    static function dataSenetize($param) {

        return addslashes(htmlentities(trim($param)));
    }
    
    static function getDockey($view="NULL") {
        @session_start();
        $method = 'aes-256-cbc';
        $key = substr(hash('sha256', DOC_PASS, true), 0, 32);        
        $encrypted = urlencode(base64_encode(openssl_encrypt($view, $method, $key, OPENSSL_RAW_DATA, DOC_CIPHER)));
        return $encrypted;
    }

    static function sendsmtpEmail($host, $port, $username, $password, $subject, $content, $to, $email_name = null, $cc = null, $bcc = null, $attchement = null) {
        //$email_name would be the notification_name in the database table
      //  print_r($to); die();
        Yii::import('application.extensions.phpmailer.JPhpMailer');
        $mail = new JPhpMailer();
        $mail->IsSMTP();
        $mail->Mailer = "smtp";
        $mail->SMTPDebug = 1;
        $mail->SMTPAuth = TRUE;
        $mail->SMTPSecure = "tls";
        $mail->Port = $port;
        $mail->Host = $host;
        $mail->Username = $username;
        $mail->Password = $password;
        $mail->IsHTML(true);
        if(is_array($to)){
            foreach ($to as $key => $value) {
                 $mail->AddAddress($value);
            }            
         }else{
             $mail->AddAddress($to);
         }
       
        $mail->SetFrom($username, $email_name);
        $mail->Subject = $subject;
        $mail->MsgHTML($content);
        if ($mail->Send() === FALSE) {
            return 0;
        } else {
            return 1;
        }
    }
    
    static function getSrnDetails($srn = NULL, $for = NULL) {
        if (isset($_SESSION['RESPONSE']['user_id'])) {
            $res_search = Yii::app()->db->createCommand("SELECT CTYPCN,CNUMCN,NTYPCN,CNAMCN from zdm_cnamcnp0 where CNUMCN = $srn and CTYPCN=$for")->queryRow();
            if (!empty($res_search)) {
                $status = 401;
                $user = true;
                $msg = 'You have already applied for this service';
                $response = array('status' => $status, 'user' => $user, 'msg' => $msg);
                return $response;
            }
            $bn_search = Yii::app()->db->createCommand("SELECT CTYPCN,CNUMCN,NTYPCN,CNAMCN from zdm_cnamcnp0 where CNUMCN = $srn and CTYPCN='BN'")->queryRow();
            if (!empty($bn_search)) {
                $status = 200;
                $user = true;
                $msg = 'success';
                $response = array('status' => $status, 'user' => $user, 'msg' => $msg);
                return $response;
            }

 
        } else {
            $status = 302;
            $user = false;
            $msg = 'Your session has expired. Please re-login to apply';
            $response = array('status' => $status, 'user' => $user, 'msg' => $msg);
            return $response;
        }
    }

    static function sendCaipoEmail($host = NULL, $port = NULL, $username = NULL, $password = NULL, $subject = NULL, $message = NULL, $to = NULL, $email_name = null, $cc = null, $bcc = null, $attchement = null) {
        Yii::import('application.extensions.phpmailer.PHPMailer');
        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();                                            // Send using SMTP
            $mail->Host = EMAIL_HOST;                    // Set the SMTP server to send through
            $mail->SMTPAuth = true;                                   // Enable SMTP authentication
            $mail->Username = EMAIL_USERNAME;                     // SMTP username
            $mail->Password = EMAIL_PASSWORD;                               // SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
            $mail->Port = 587;                                    // TCP port to connect to
            $mail->setFrom(EMAIL_USERNAME, 'GOV.BB');
            $mail->addAddress($to);               // Name is optional
            $mail->addReplyTo(EMAIL_USERNAME, 'GOV.BB');
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = $subject;
            $mail->Body = $message;
            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
            $mail->send();
        } catch (Exception $e) {
            echo "<br>Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }

}
