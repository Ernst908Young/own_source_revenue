<?php

/**
 * @author Rahul Kumar
 * @created_on 14012018
 */
class PropertyController extends Controller {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column2';

    /**
     * @return array action filters
     */
    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
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
                'actions' => array('listing', 'detail'),
                'users' => array('*'),
            )
        );
    }

    /**
     * @author Rahul Kumar
     * @created_on 14012018
     */
    public function actionListing() {
        $connection = Yii::app()->db;

        $addedConditions="";
        // Search according the passed parameteres
        if(!empty($_GET['district'])){ $addedConditions=$addedConditions." AND blc.district_id=".$_GET['district']; }
        if(!empty($_GET['tehsil'])){ $addedConditions=$addedConditions." AND blc.sub_district_id=".$_GET['tehsil']; }
        if(!empty($_GET['village'])){ $addedConditions=$addedConditions." AND blc.village='".$_GET['village']."'"; }

        // Getting all active land records 
        $allActiveProperties = $connection->createCommand("SELECT * FROM bo_landowner_connect as blc INNER JOIN  bo_district as bd ON bd.district_id=blc.district_id where blc.status='Y' $addedConditions ORDER BY blc.created_date DESC")->queryAll();

       // Getting all land which are  open for sale
        $allSaleProperties = $connection->createCommand("SELECT COUNT(*) as sale FROM bo_landowner_connect where is_sale=1 AND status='Y'")->queryRow();

        // Getting all land which are  open for lease
        $allLeaseProperties = $connection->createCommand("SELECT COUNT(*) as lease FROM bo_landowner_connect where is_lease=1 AND status='Y'")->queryRow();

        $this->render('search', array('propertylisting' => $allActiveProperties, 'sale' => $allSaleProperties['sale'], 'lease' => $allLeaseProperties['lease']));
    }

    /**
     * @author Rahul Kumar
     * @created_on 14012018
     */
    function truncate_string($string, $length, $append = "...") {
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

    /**
     * @author Rahul Kumar
     * @created_on 14012018
     */
    public function actionDetail() {
        $connection = Yii::app()->db;
        // Getting land Id and encodeing that
        $landID = base64_decode($_GET['landID']);
        // Getting detail of requested land ID
        $propertyDetail = $connection->createCommand("SELECT * FROM bo_landowner_connect as blc INNER JOIN  bo_district as bd ON bd.district_id=blc.district_id  LEFT JOIN bo_landowner_contact as bloc ON bloc.land_id=blc.id  where  blc.status='Y' AND blc.id=$landID ORDER BY blc.created_date DESC")->queryRow();

        // Added on 17012017
        // update land visior detail
        $response = $this->propertyInvestorActionLog($_GET['landID'], "viewed");
        // End of adding 17012017
        // setting here for showing in view
        $this->render('detail', array('propertyDetail' => $propertyDetail));
    }

    /**
     * @author Rahul Kumar
     * @created_on 15012018
     * @updated_on 17012018 //$landID=null,$actionTaken=null,$comment=null
     */
    public function propertyInvestorActionLog($landID = null, $actionTaken = null, $comment = null) {

        // Getting all passed value in to variables
        //   extract($_GET);
        $landID = base64_decode($landID);

        // Testing Purpuse
        // $actionTaken = "viewed"; http://localhost/ukswcs/backoffice/iloc/property/propertyInvestorActionLog/landID/NQ%3D%3D/actionTaken/viewed
        // $actionTaken = "intrested"; http://localhost/ukswcs/backoffice/iloc/property/propertyInvestorActionLog/landID/NQ%3D%3D/actionTaken/intrested
        // $actionTaken = "reported"; http://localhost/ukswcs/backoffice/iloc/property/propertyInvestorActionLog/landID/NQ%3D%3D/actionTaken/reported/comment/Test Comment
        // $comment = "Test Comment";

        @session_start();
        $model = new LandownerVisitorPropertyActionLog;
        
        if(!empty($_SESSION['RESPONSE']['user_id'])){
        $model->user_id = $_SESSION['RESPONSE']['user_id'];
        }else if(!empty($_SESSION['land_user_id'])){
        $model->user_id = $_SESSION['land_user_id'];
        }else{
            $model->user_id = "Guest"; 
        }
        
        
        $model->land_id = $landID;
        // In case of visitor visits
        if ($actionTaken == "viewed") {
            $model->viewed = 'Y';
        }
        // In case of visitor expresed intrest for property
        if ($actionTaken == "intrested") {
            $model->intrested = 'Y';
        }
        // In case of visitor make property marked/reported as spam 
        if ($actionTaken == "reported") {
            $model->is_reported = 'Y';
            // Whatever visitor write in comment at the time of report as spam
            $model->comment = $comment;
        }
        // Capturing other Log details 
        $model->created = date('Y-m-d h:i:s');
        $model->user_agent = $_SERVER['HTTP_USER_AGENT'];
        $model->ip_address = $_SERVER['REMOTE_ADDR'];
       //  print_r($model);die;
        if ($model->save())
            return true;
        else
            return false;
    }

    /**
     * @author Rahul Kumar
     * @created_on 17012017
     * @description when visitor/investor express interest 
     */
    public function actionUpdateInterest() {
        $response = $this->propertyInvestorActionLog($_GET['landID'], "intrested");
        Yii::app()->user->setFlash('Success', "Thank you, your interest has been recorded");
        $url = $_SERVER['HTTP_REFERER'];
        $this->redirect($url);
    }

    /**
     * @author Rahul Kumar
     * @created_on 20012017
     * @description It will get all the list of villages as per  passed tehsil ID
     */
    public function actionGetVilagesOfTehsil() {
        $villages = "<option value=''>Select Village</option>";
        $subDistCode = $_GET['subDistCode'];
        $allDepartmentServiceList = LandownerConnectEXT::getMasterList('lg_code_villages', 'village_code', 'village_name', 'sub_district_code', $subDistCode);
        foreach ($allDepartmentServiceList as $k => $v) {
            $villages = "$villages<option value='$k'>$v</options>";
        }
        echo "$villages";
        die;
    }

    /**
     * @author Rahul Kumar
     * @created_on 22012017
     * @description It Save Report content against Land
     */
    
    public function actionAddReportAgainstLand() {
        if (!empty($_POST)) {
            $reported = $this->propertyInvestorActionLog($_GET['landID'], "reported", $_POST['comment']);
            if($reported){
                Yii::app()->user->setFlash('Success', "Land Details for this plot has been marked as spam by you. Our team will check the respective content and if found spam, will stop displaying on the portal.");
            }else{
                Yii::app()->user->setFlash('Failure', "Please Try Again. Your request has not been submitted.");
            }
            $url = "/backoffice/iloc/property/detail/landID/" . $_GET['landID'];     
            
            $this->redirect($url);
        }
    }
    
       /**
     * @author Rahul Kumar
     * @created_on 23012017
     * @description It will get all the list of Tehsil [sub district] as per  passed district ID
     */
    public function actionGetTehsil() {
        $tehsils = "<option value=''>Select Tehsil</options>";
        $districtID = $_GET['districtID'];
        $all = LandownerConnectEXT::getMasterList('lg_code_sub_disctrct', 'sub_district_code', 'sub_district_name', 'district_id', $districtID);
        foreach ($all as $k => $v) {
            $tehsils = "$tehsils<option value='$k'>$v</options>";
        }
        echo "$tehsils";
        die;
    }
    
     /**
     * @author Rahul Kumar
     * @created_on 27012018
     */
    public function actionPreview() {
        
        $connection = Yii::app()->db;
        // Getting land Id and encodeing that
        $landID = base64_decode($_GET['landID']);
        //echo $landID;die;
        // Getting detail of requested land ID
        $propertyDetail = $connection->createCommand("SELECT * FROM bo_landowner_connect as blc INNER JOIN  bo_district as bd ON bd.district_id=blc.district_id  LEFT JOIN bo_landowner_contact as bloc ON bloc.land_id=blc.id  where  blc.id=$landID ORDER BY blc.created_date DESC")->queryRow();

        // setting here for showing in view
        $this->render('preview', array('propertyDetail' => $propertyDetail));
    }
    
    /**  @author : Rahul Kumar
     *   @created 29012018
     *   @Description:  Viewer will verify his/her contact detail, Once verification Done, He will be able to see the Contact Info of land owner/ Express Interest / Report  
     */
    public function actionSentOtp() {
        
                // Getting GET values here
                extract($_GET);
                $msgOtp = rand(111111, 999999);
                $mobileOtpMessage = "Your mobile verification OTP is " . $msgOtp ." For Security reason, Please do not share with anyone.";
                //Sending OTP here 
                $mobileMsgSendStatus = DefaultUtility::sendOTPToMobile($mobileNumber, $mobileOtpMessage);
               
                // Saving Data 
                @session_start();
                $model = new LandownerUsers;        
                $model->mobile_number = $mobileNumber;
                $model->otp = $msgOtp;
                $model->is_otp_used = 'N';
                $model->is_active  = 'Y';
                $model->user_id = "";
                $model->created = date('Y-m-d H:i:s');
                $model->user_agent = $_SERVER['HTTP_USER_AGENT'];
                $model->ip_address = $_SERVER['REMOTE_ADDR'];
                
                if ($model->save())
                        echo 1;
                    else
                        echo 0;
                    die;
                
             
    }
    /**  @author : Rahul Kumar
     *   @created 29012018
     *   @Description:  Viewer will verify otp (which was sent earlier on his mobile number)
     */
    public function actionVerifyOtp() {
        
           // Extracting Get Values
            extract($_GET);
           
             $connection = Yii::app()->db;
             
            // Gettting values from dattabase as per passed otp and mobile number 
            $propertyDetail = $connection->createCommand("SELECT * FROM bo_landowner_users where otp=$otp AND mobile_number=$mobileNumber")->queryRow();

            // Processing furthur if record get matched with passed values
            if(!empty($propertyDetail)){
                 $_SESSION['land_user_id']="Land User - ".$propertyDetail['id'];
                 $_SESSION['land_mobile']=$mobileNumber;
               
                if($propertyDetail['is_otp_used']=="N"){
                  // Update data and start temporary session here
                  $propertyDetail = $connection->createCommand("UPDATE bo_landowner_users SET is_otp_used='Y' where id=$propertyDetail[id]")->execute();  
                  // If Otp is not valid  then return with an success message
                  Yii::app()->user->setFlash('Success', "Your mobile number has been verified");
                  echo "Otp Verified"; die;
                  
                }else{
                  echo "Otp Verified";die;  
                }
            }else{
               // If Otp is not valid  then return with an eroor message
                echo "You have entered an unvalid OTP";die;
            }
    }
}
