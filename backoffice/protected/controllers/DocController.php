<?php

class DocController extends Controller {
    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    //public $layout='//layouts/column2';

    /**
     * @return array action filters
     */
    public function filters() {
        return array(
                //'accessControl', // perform access control for CRUD operations
                //'postOnly + delete', // we only allow deletion via POST request
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules() {
        return array(
            array('allow', // allow all users to perform 'index' and 'view' actions
                'actions' => array('index'),
            //'expression' => 'DefaultUtility::isHODNodal()',
            /* 'users'=>array('*'), */
            ),
        );
    }

    public function actionMydoc($view = "NULL", $from =NULL) {
        @session_start();
        $method = 'aes-256-cbc';
        $key = substr(hash('sha256', DOC_PASS, true), 0, 32);
        $decrypted = openssl_decrypt(base64_decode($view), $method, $key, OPENSSL_RAW_DATA, DOC_CIPHER);
        if (isset($decrypted) && $decrypted != "") {
            $iuid_array = explode('_', $decrypted);
            if (!empty($iuid_array)) {
                $iuid = $iuid_array[0];
            }
        }

        if (isset($iuid) && $iuid != "" && isset($_SESSION)) {
            if ((isset($_SESSION['RESPONSE']['iuid']) && ($_SESSION['RESPONSE']['iuid'] == $iuid)) || isset($_SESSION['uid']) || isset($_SESSION['RESPONSE']['user_id'])) {

                if($from=='ticket' || $from=='grievance'){
                    $file = "/var/www/html/$decrypted";
                }else{             
                    $file = "/var/www/html/themes/backend/mydoc/$iuid/$decrypted";       
                }
               
                $ftype = explode('.',$decrypted);
                
                $fp = fopen($file, "r");
                header("Cache-Control: maxage=1");
                header("Pragma: public");

                if(end($ftype)=='pdf' || end($ftype)=='PDF'){
                header("Content-type: application/pdf");
                }
                if(end($ftype)=='jpeg' || end($ftype)=='JPEG' || end($ftype)=='jpg' || end($ftype)=='JPG'){
                header("Content-type: image/jpeg");
                }
                if(end($ftype)=='png' || end($ftype)=='PNG'){
                header("Content-type: image/png");
                }
                if(end($ftype)=='doc' || end($ftype)=='docx'){
                header("Content-type: application/msword");
                }
                
                header("Content-Disposition: inline;");
                header("Content-Description: CAIPO");
                header("Content-Transfer-Encoding: binary");
                header('Content-Length:' . filesize($file));
                ob_clean();
                flush();
                while (!feof($fp)) {
                    $buff = fread($fp, 8024);
                    print $buff;
                }
                exit;
            } else {
                echo "Access Denied";
            }
        } else {
            echo "Access Denied";
        } die;
    }
    
    public function actionView($param1 = "NULL", $param2 = "Null") {
        @session_start();

        $core_service = base64_decode($param1);
        $connection = Yii::app()->db;
        $sql = "SELECT service_provider_tag as sp_tag from bo_sp_all_applications sp inner join sso_service_providers ssp on sp.sp_id = ssp.sp_id where sp.app_id=:id";
        $command = $connection->createCommand($sql);
        $command->bindParam(":id", $param1, PDO::PARAM_INT);
        $sp_tag = $command->queryRow();
        if (!empty($sp_tag) && $sp_tag['sp_tag'] != "") {
            $method = 'aes-256-cbc';
            $key = substr(hash('sha256', $sp_tag['sp_tag'], true), 0, 32);
            $decrypted = openssl_decrypt(base64_decode($param2), $method, $key, OPENSSL_RAW_DATA, DOC_CIPHER);
            if (isset($decrypted) && $decrypted != "") {
                $iuid_array = explode('_', $decrypted);
                if (!empty($iuid_array)) {
                    $iuid = $iuid_array[0];
                    $file = "/var/www/html/themes/backend/mydoc/$iuid/$decrypted";
                    $fp = fopen($file, "r");
                    header("Cache-Control: maxage=1");
                    header("Pragma: public");
                    header("Content-type: application/pdf");
                    header("Content-Disposition: inline; filename=doc.pdf");
                    header("Content-Description: SWCS");
                    header("Content-Transfer-Encoding: binary");
                    header('Content-Length:' . filesize($file));
                    ob_clean();
                    flush();
                    while (!feof($fp)) {
                        $buff = fread($fp, 1024);
                        print $buff;
                    }
                    exit;
                }
            } else {
                echo "Incorrect Parameters";
            }
        } else {
            echo "Access Denied";
        }
    } 
    
    public function actionView2($param1 = "NULL", $param2 = "Null") {
        @session_start();

                   // $iuid = $iuid_array[0];
                    $file = "/var/www/html/backoffice/@@46BRKG180348.afp";
                    $fp = fopen($file, "r");
                    header("Cache-Control: maxage=1");
                    header("Pragma: public");
                    header("Content-type: application/vnd.ibm.modcap");
                    header("Content-Disposition: inline; filename=doc.afp");
                    header("Content-Description: SWCS");
                    header("Content-Transfer-Encoding: binary");
                    header('Content-Length:' . filesize($file));
                    ob_clean();
                    flush();
                    while (!feof($fp)) {
                        $buff = fread($fp, 1024);
                        print $buff;
                    }
                    exit;
                }


}
