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
         //die("listing");
        $addedConditions = "";
        // Search according the passed parameteres
        // Search according the passed parameteres  is_sale
        if (isset($_GET['district']) && !empty($_GET['district'])) {
            $addedConditions = $addedConditions . " AND blc.district_id=" . $_GET['district'];
        }
        if (isset($_GET['tehsil']) && !empty($_GET['tehsil'])) {
            $addedConditions = $addedConditions . " AND blc.sub_district_id=" . $_GET['tehsil'];
        }
        if (isset($_GET['village']) && !empty($_GET['village'])) {
            $addedConditions = $addedConditions . " AND blc.village='" . $_GET['village'] . "'";
        }
        if (isset($_GET['is_sale']) && !empty($_GET['is_sale'])) {
            $addedConditions = $addedConditions . " AND blc.is_sale='" . $_GET['is_sale'] . "'";
        }
        if (isset($_GET['is_lease']) && !empty($_GET['is_lease'])) {
            $addedConditions = $addedConditions . " AND blc.is_sale='" . $_GET['is_lease'] . "'";
        }
        if (isset($_GET['type_of_land']) && !empty($_GET['type_of_land'])) {
            $addedConditions = $addedConditions . " AND blc.type_of_land='" . $_GET['type_of_land'] . "'";
        }
        //area_sqmt ,area_type, land_title
        if (isset($_GET['area_sqmt']) && !empty($_GET['area_sqmt'])) {
            $addedConditions = $addedConditions . " AND blc.area_sqmt='" . $_GET['area_sqmt'] . "'";
        }
        if (isset($_GET['area_type']) && !empty($_GET['area_type'])) {
            $addedConditions = $addedConditions . " AND blc.area_type='" . $_GET['area_type'] . "'";
        }
        if (isset($_GET['land_title']) && !empty($_GET['land_title'])) {
            $addedConditions = $addedConditions . " AND blc.land_title LIKE '%" . $_GET['land_title'] . "%'";
        }
        if (isset($_GET['landtype']) && !empty($_GET['landtype'])) {
            $addedConditions = $addedConditions . " AND blc.la_type LIKE '%" . $_GET['landtype'] . "%'";
        }

		//echo "SELECT * FROM bo_landowner_connect as blc INNER JOIN  bo_district as bd ON bd.district_id=blc.district_id where blc.status='Y' $addedConditions ORDER BY blc.created_date DESC"; die;
        // Getting all active land records
        $allActiveProperties = $connection->createCommand("SELECT * FROM bo_landowner_connect as blc INNER JOIN  bo_district as bd ON bd.district_id=blc.district_id where blc.status='Y' $addedConditions ORDER BY blc.created_date DESC")->queryAll();

        // Getting all land which are  open for sale
        $allSaleProperties = $connection->createCommand("SELECT COUNT(*) as sale FROM bo_landowner_connect where is_sale=1 AND status='Y'")->queryRow();

        // Getting all land which are  open for lease
        $allLeaseProperties = $connection->createCommand("SELECT COUNT(*) as lease FROM bo_landowner_connect where is_lease=1 AND status='Y'")->queryRow();

        if (isset($_GET['AddedBy']) && !empty($_GET['AddedBy'])) {
            if ($_GET['AddedBy'] == "DM") {
                $allActiveProperties = LandownerConnectEXT::getLandAddedByDM($_GET['district'], "fullData");
            }
            if ($_GET['AddedBy'] == "DEPT") {
                $allActiveProperties = LandownerConnectEXT::getLandAddedByDepartment($_GET['department'], "fullData");
            }
        }
		
		//print_r($allActiveProperties); die; 
        $this->render('search', array('propertylisting' => $allActiveProperties, 'sale' => $allSaleProperties['sale'], 'lease' => $allLeaseProperties['lease']));
    }
	
	public function actionListing2() {
        $connection = Yii::app()->db;

        $addedConditions = "";
        // Search according the passed parameteres
        // Search according the passed parameteres  is_sale
        if (isset($_GET['district']) && !empty($_GET['district'])) {
            $addedConditions = $addedConditions . " AND blc.district_id=" . $_GET['district'];
        }
        if (isset($_GET['tehsil']) && !empty($_GET['tehsil'])) {
            $addedConditions = $addedConditions . " AND blc.sub_district_id=" . $_GET['tehsil'];
        }
        if (isset($_GET['village']) && !empty($_GET['village'])) {
            $addedConditions = $addedConditions . " AND blc.village='" . $_GET['village'] . "'";
        }
        if (isset($_GET['is_sale']) && !empty($_GET['is_sale'])) {
            $addedConditions = $addedConditions . " AND blc.is_sale='" . $_GET['is_sale'] . "'";
        }
        if (isset($_GET['is_lease']) && !empty($_GET['is_lease'])) {
            $addedConditions = $addedConditions . " AND blc.is_sale='" . $_GET['is_lease'] . "'";
        }
        if (isset($_GET['type_of_land']) && !empty($_GET['type_of_land'])) {
            $addedConditions = $addedConditions . " AND blc.type_of_land='" . $_GET['type_of_land'] . "'";
        }
        //area_sqmt ,area_type, land_title
        if (isset($_GET['area_sqmt']) && !empty($_GET['area_sqmt'])) {
            $addedConditions = $addedConditions . " AND blc.area_sqmt='" . $_GET['area_sqmt'] . "'";
        }
        if (isset($_GET['area_type']) && !empty($_GET['area_type'])) {
            $addedConditions = $addedConditions . " AND blc.area_type='" . $_GET['area_type'] . "'";
        }
        if (isset($_GET['land_title']) && !empty($_GET['land_title'])) {
            $addedConditions = $addedConditions . " AND blc.land_title LIKE '%" . $_GET['land_title'] . "%'";
        }
        if (isset($_GET['landtype']) && !empty($_GET['landtype'])) {
            $addedConditions = $addedConditions . " AND blc.la_type LIKE '%" . $_GET['landtype'] . "%'";
        }

        // Getting all active land records
        $allActiveProperties = $connection->createCommand("SELECT * FROM bo_landowner_connect as blc INNER JOIN  bo_district as bd ON bd.district_id=blc.district_id where blc.status='Y' $addedConditions ORDER BY blc.created_date DESC")->queryAll();

        // Getting all land which are  open for sale
        $allSaleProperties = $connection->createCommand("SELECT COUNT(*) as sale FROM bo_landowner_connect where is_sale=1 AND status='Y'")->queryRow();

        // Getting all land which are  open for lease
        $allLeaseProperties = $connection->createCommand("SELECT COUNT(*) as lease FROM bo_landowner_connect where is_lease=1 AND status='Y'")->queryRow();

        if (isset($_GET['AddedBy']) && !empty($_GET['AddedBy'])) {
            if ($_GET['AddedBy'] == "DM") {
                $allActiveProperties = LandownerConnectEXT::getLandAddedByDM($_GET['district'], "fullData");
            }
            if ($_GET['AddedBy'] == "DEPT") {
                $allActiveProperties = LandownerConnectEXT::getLandAddedByDepartment($_GET['department'], "fullData");
            }
        }
        $this->render('search2', array('propertylisting' => $allActiveProperties, 'sale' => $allSaleProperties['sale'], 'lease' => $allLeaseProperties['lease']));
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

        if (!empty($_SESSION['RESPONSE']['user_id'])) {
            $model->user_id = $_SESSION['RESPONSE']['user_id'];
        } else if (!empty($_SESSION['land_user_id'])) {
            $model->user_id = $_SESSION['land_user_id'];
        } else {
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
        $type = "Select ";
        if (!empty($_GET['type'])) {
            $type = "All ";
        }
        $villages = "<option value=''>$type Village</option>";
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
            if ($reported) {
                Yii::app()->user->setFlash('Success', "Land Details for this plot has been marked as spam by you. Our team will check the respective content and if found spam, will stop displaying on the portal.");
            } else {
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
        $type = "Select ";
        if (!empty($_GET['type'])) {
            $type = "All ";
        }
        $tehsils = "<option value=''>$type Tehsil</options>";
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
        $mobileOtpMessage = "Your mobile verification OTP is " . $msgOtp . " For Security reason, Please do not share with anyone.";
        //Sending OTP here
        $mobileMsgSendStatus = DefaultUtility::sendOTPToMobile($mobileNumber, $mobileOtpMessage);

        // Saving Data
        @session_start();
        $model = new LandownerUsers;
        $model->mobile_number = $mobileNumber;
        $model->otp = $msgOtp;
        $model->is_otp_used = 'N';
        $model->is_active = 'Y';
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
        if (!empty($propertyDetail)) {
            $_SESSION['land_user_id'] = "Land User - " . $propertyDetail['id'];
            $_SESSION['land_mobile'] = $mobileNumber;
            $_SESSION['land_guest_user_id'] = $propertyDetail['id']; // jitendra singh:  12/feb/2018


            if ($propertyDetail['is_otp_used'] == "N") {
                // Update data and start temporary session here
                $propertyDetail = $connection->createCommand("UPDATE bo_landowner_users SET is_otp_used='Y' where id=$propertyDetail[id]")->execute();
                // If Otp is not valid  then return with an success message
                Yii::app()->user->setFlash('Success', "Your mobile number has been verified");
                echo "Otp Verified";
                die;
            } else {
                echo "Otp Verified";
                die;
            }
        } else {
            // If Otp is not valid  then return with an eroor message
            echo "You have entered an unvalid OTP";
            die;
        }
    }

    /**  @author : Rahul Kumar
     *   @created 07022018
     *   @Description:  Viewer will verify his/her contact detail, Once verification Done, He will be able to see the Contact Info of land owner/ Express Interest / Report
     */
    public function actionAdvertisement() {
        $this->render('advertisement');
    }

    // Jitendra 16012018 requirement

    public function actionRequirementListing() {
        $connection = Yii::app()->db;
		
        $addedConditions = "";
        // Search according the passed parameteres
        // Search according the passed parameteres  is_sale
        if (isset($_GET['district']) && !empty($_GET['district'])) {
            $addedConditions = $addedConditions . " AND blc.district_id=" . $_GET['district'];
        }
        if (isset($_GET['tehsil']) && !empty($_GET['tehsil'])) {
            $addedConditions = $addedConditions . " AND blc.sub_district_id=" . $_GET['tehsil'];
        }
        if (isset($_GET['village']) && !empty($_GET['village'])) {
            $addedConditions = $addedConditions . " AND blc.village='" . $_GET['village'] . "'";
        }
        if (isset($_GET['is_sale']) && !empty($_GET['is_sale'])) {
            $addedConditions = $addedConditions . " AND blc.is_sale='" . $_GET['is_sale'] . "'";
        }
        if (isset($_GET['is_lease']) && !empty($_GET['is_lease'])) {
            $addedConditions = $addedConditions . " AND blc.is_sale='" . $_GET['is_lease'] . "'";
        }
        if (isset($_GET['type_of_land']) && !empty($_GET['type_of_land'])) {
            $addedConditions = $addedConditions . " AND blc.type_of_land='" . $_GET['type_of_land'] . "'";
        }
        //area_sqmt ,area_type, land_title
        if (isset($_GET['area_sqmt']) && !empty($_GET['area_sqmt'])) {
            $addedConditions = $addedConditions . " AND blc.area_sqmt='" . $_GET['area_sqmt'] . "'";
        }
        if (isset($_GET['area_type']) && !empty($_GET['area_type'])) {
            $addedConditions = $addedConditions . " AND blc.area_type='" . $_GET['area_type'] . "'";
        }
        if (isset($_GET['land_title']) && !empty($_GET['land_title'])) {
            $addedConditions = $addedConditions . " AND blc.land_title LIKE '%" . $_GET['land_title'] . "%'";
        }

        // Getting all active land records
        $allActiveProperties = $connection->createCommand("SELECT * FROM bo_landowner_requester_connect as blc INNER JOIN  bo_district as bd ON bd.district_id=blc.district_id where blc.status='Y' $addedConditions ORDER BY blc.created_date DESC")->queryAll();

        // Getting all land which are  open for sale
        $allSaleProperties = $connection->createCommand("SELECT COUNT(*) as sale FROM bo_landowner_requester_connect where is_sale=1 AND status='Y'")->queryRow();

        // Getting all land which are  open for lease
        $allLeaseProperties = $connection->createCommand("SELECT COUNT(*) as lease FROM bo_landowner_requester_connect where is_lease=1 AND status='Y'")->queryRow();
		/* echo "<pre>";
		print_r($allActiveProperties);
		print_r($allSaleProperties['sale']);
		print_r($allLeaseProperties['lease']);
		die; */
        $this->render('requirement_search', array('propertylisting' => $allActiveProperties, 'sale' => $allSaleProperties['sale'], 'lease' => $allLeaseProperties['lease']));
    }

    //jitendra
    public function actionRequester_contact() {
        $response = array();
        if (isset($_POST['landID']) && !empty($_POST['landID'])) {
            $connection = Yii::app()->db;
            $landID = $_POST['landID'];
            $cotactDetail = $connection->createCommand("SELECT * FROM bo_landowner_requester_contact where land_id=$landID")->queryRow();
            $response = array('data' => $cotactDetail, 'status' => 1);
        } else {
            $response = array('data' => '', 'status' => 0);
        }
        echo json_encode($response);
    }

    /**  @author : Rahul Kumar
     *   @created 05032018
     *   @Description:  This is for advance search page where A user can search gov land added by DM/Department
     */
    public function actionAdvanceSearch($search = NULL) {

        // Getting All the active district
        $allDistricts = Yii::app()->db->createCommand("SELECT * FROM bo_district WHERE is_active='Y'")->queryAll();
        //Getting All the active department
        $allDepartments = Yii::app()->db->createCommand("SELECT * FROM bo_departments WHERE is_department_active=1")->queryAll();
        // passing district and department to view page
        $this->render('advanceSearch', array('districts' => $allDistricts, 'departments' => $allDepartments));
    }

    /// jitendra Singh 
    // date 24-04-2018
    protected function getLandDocument($landId, $media_type) {
        $criteria = new CDbCriteria;
        $criteria->condition = "land_id=:landId AND media_type=:media_type AND is_active='Y'";
        $criteria->params = array(":landId" => $landId, ":media_type" => $media_type);
        $docs = LandownerMedia::model()->find($criteria);
        if (isset($docs) && !empty($docs)) {
            return $docs;
        } else {
            return false;
        }
    }
    // Rahul Kumar
    public function actionDownloadDocuments() {
        @session_start();
        // $uid=$_SESSION['RESPONSE']['user_id'];
        $name = base64_decode($_GET['document']);
        // if(empty($uid)){$uid="guestUser";}
        $dir_path = Yii::app()->basePath . "/../../themes/backend/mydoc/"; //Yii::getPathOfAlias('webroot') . '/themes/backend/mydoc/'.$uid.'/'; 
        $fileName = $dir_path . "/$name";
        //echo $fileName;die;
        if (file_exists($fileName))
            return Yii::app()->getRequest()->sendFile($name, @file_get_contents($fileName));
        else
            throw new CHttpException(404, 'The requested page does not exist.');
    }

    
    // Shishir
    public function actionGetVillagesOfBlock() {
        $type="Select ";
        if(!empty($_GET['type'])){
            $type="All ";
        }
        $villages = "<option value=''>$type Block</options>";
        $blockID = $_GET['blockID'];		
        $all = LandownerConnectEXT::getMasterList('lg_code_villages', 'village_code', 'village_name', 'block_id', $blockID);
        foreach($all as $k => $v) {
            $villages = "$villages<option value='$k'>$v</options>";
        }
        echo "$villages";
        die;
    }
    
    // Shishir
     public function actionGetBlocks() {
        $type="Select ";
        if(!empty($_GET['type'])){
            $type="All ";
        }
        $blocks = "<option value=''>$type Block</options>";
        $tehsilID = $_GET['tehsilID'];
        $all = LandownerConnectEXT::getMasterList('lg_code_blocks', 'block_code', 'block_name', 'tehsil_id', $tehsilID);
        foreach ($all as $k => $v) {
            $blocks = "$blocks<option value='$k'>$v</options>";
        }
        echo "$blocks";
        die;
    }
    public function actionGetTehsil1() {
        $type="Select ";
        if(!empty($_GET['type'])){
            $type="All ";
        }
        $tehsils = "<option value=''>$type Tehsil</options>";
        $districtID = $_GET['districtID'];
        $all = LandownerConnectEXT::getMasterList('lg_code_sub_disctrct', 'sub_district_code', 'sub_district_name', 'district_id', $districtID);
        foreach ($all as $k => $v) {
            $tehsils = "$tehsils<option value='$k'>$v</options>";
        }
		if(!empty($all))
		{
			 echo "$tehsils";
		}else{
			echo 'blank';
		}       
        die;
    }
	
	public function actionGetBlockByDistrictId() {
        $type="Select Blocks";
        $blocks = "<option value=''>$type</options>";
        $districtID = $_GET['districtID'];
        $all = LandownerConnectEXT::getMasterList('lg_code_blocks', 'block_code', 'block_name', 'district_id', $districtID);
        foreach($all as $k => $v) {
            $blocks = "$blocks<option value='$k'>$v</options>";
        }
		$blocks .= "<option value='0'>Other</options>";
		if(!empty($all))
		{
			 echo "$blocks";
		}else{
			echo '';
		}       
        die;
    }




public function actionGetDistrict() {
        $type = "Select ";
        if(!empty($_GET['type'])){
            $type="All ";
        }
        $districts = "<option value=''>$type District</options>";
        $stateCode = $_GET['stateCode'];
        $all = LandownerConnectEXT::getDitrictList1('lg_code_districts', 'swcs_district_id', 'district_name',$stateCode);
		
        foreach ($all as $k => $v) {
            $districts = "$districts<option value='$k'>$v</options>";
        }
        echo "$districts";
        die;
    }


public function actionGetSubdistrict() {
        $type = "Select ";
        if(!empty($_GET['type'])){
            $type="All ";
        }
        $subdistricts = "<option value=''>$type City</options>";
        $districtCode = $_GET['districtCode'];
        $all = LandownerConnectEXT::getSubDitrictList('lg_code_sub_disctrct', 'sub_district_code', 'sub_district_name',$districtCode);
		
        foreach ($all as $k => $v) {
            $subdistricts = "$subdistricts<option value='$k'>$v</options>";
        }
        echo "$subdistricts";
        die;
    }
	
	public function actionGetIndustrialArea() {
        $industrialArea = "<option value=''>--Select Industrial Area--</options>";
        $landType = $_GET['landType'];
        $all = LandownerConnectEXT::getIndustrialAreaList('bo_industrial_area_master', 'id', 'industrial_area',$landType);		
        foreach ($all as $k => $v) {
            $industrialArea = "$industrialArea<option value='$k'>$v</options>";
        }
        echo "$industrialArea";
        die;
    }
    
    /**
     * @author Rahul Kumar
     * @created_on 20012017
     * @description It will get all the list of service as per  passed dept ID
     */
    public function actionGetServicebydept() {
        $type = "Select ";
        if (!empty($_GET['type'])) {
            $type = "All ";
        }
        $services = "<option value=''>$type Services</option>";
        $dept_id = $_GET['dept_id'];
        
        $allServiceList =  Yii::app()->db->createCommand("SELECT app_id,app_name FROM bo_sp_all_applications LEFT JOIN sso_service_providers on bo_sp_all_applications.sp_id=sso_service_providers.sp_id LEFT JOIN bo_departments on sso_service_providers.department_id=bo_departments.dept_id where bo_departments.dept_id=$dept_id")->queryAll();
      //  print_r($allServiceList);die;
        foreach ($allServiceList as $k => $v) {   
            if(!empty($v))
           $services.= "<option value='".$v['app_id']."'>".$v['app_name']."</options>";
        }
        if(isset($services) && !empty($services))
        {    
            echo "$services";
        }    
        else {
            echo "";    
        }
        die;
    }
    
      /**
     * @author Rahul Kumar
     * @created_on 
     * @description It will get all the list of service as per  passed dept ID
     */
    public function actionGetServicebydeptNew() {
        $type = "Select ";
        if (!empty($_GET['type'])) {
            $type = "All ";
        }
        $services = "<option value=''>$type Services</option>";
        $dept_id = $_GET['dept_id'];
        
        $allServiceList =  Yii::app()->db->createCommand("SELECT concat(bo_information_wizard_service_parameters.service_id,'.',bo_information_wizard_service_parameters.servicetype_additionalsubservice) as app_id,bo_information_wizard_service_parameters.core_service_name  as app_name  FROM bo_departments 
INNER JOIN bo_infowizard_issuerby_master ON bo_infowizard_issuerby_master.abb=bo_departments.infowiz_short_code 
INNER JOIN bo_information_wizard_service_master ON bo_information_wizard_service_master.issuerby_id=bo_infowizard_issuerby_master.issuerby_id
INNER JOIN bo_information_wizard_service_parameters ON bo_information_wizard_service_parameters.service_id=bo_information_wizard_service_master.id
WHERE bo_information_wizard_service_parameters.is_active='Y' AND bo_departments.dept_id =$dept_id")->queryAll();
      //  print_r($allServiceList);die;
        foreach ($allServiceList as $k => $v) {   
            if(!empty($v))
           $services.= "<option value='".$v['app_id']."'>".$v['app_name']."</options>";
        }
        if(isset($services) && !empty($services))
        {    
            echo "$services";
        }    
        else {
            echo "";    
        }
        die;
    }
	
	public function actionGetDistrictIdByAuthority() {
        
        $devAuthId = $_GET['devAuthId'];
		$districtId =  Yii::app()->db->createCommand("SELECT district_id FROM bo_development_authority  where id=$devAuthId")->queryRow();
        
        if(isset($districtId) && !empty($districtId))
        {    
            echo $districtId['district_id'];
        }    
        else {
            echo "";    
        }
        die;
    }
	
	 /**
     * @author Rahul Kumar
     * @created_on 20012017
     * @description It will get all the list of category of unit as per  passed block ID
     */
    public function actionGetBlockofCategoryUnit() {
        $type = "Select ";
        if(!empty($_GET['type'])) {
            $type = "All ";
        }
        $Category = "";
        $blockValue = $_GET['blockValue'];
        $allcategoryList= LandownerConnectEXT::getMasterList('lg_code_blocks', 'id', 'unit_category', 'block_code', $blockValue);
        foreach ($allcategoryList as $k => $v) {
            $Category = "$Category<option value='$k' selected=selected>$v</options>";
        }
        echo "$Category";
        die;
    }
	public function actionGetCircleByDistrict() {
        $type = "Select ";
        if(!empty($_GET['type'])){
            $type="All ";
        }
        $circles = "<option value=''>$type Circle</options>";
        $district = $_GET['district'];
        $all = LandownerConnectEXT::getCircle('bo_district_circle', 'id', 'circle_name',$district);
		
        foreach ($all as $k => $v) {
            $circles = "$circles<option value='$k'>$v</options>";
        }
        echo "$circles";
        die;
    }  

	public function actionGetPlotAreabyMsmeId() {
        $type = "Select ";        
        //$services = "<option value=''>$type Services</option>";
        $msme_id = $_GET['msme_id'];
        $plots = "<option value=''>$type Plots</option>";
        $allPlotsList =  Yii::app()->db->createCommand("SELECT auc_plot_id,area_name FROM la_auction_plots  where estate_id=$msme_id")->queryAll();
      //  print_r($allServiceList);die;
        foreach ($allPlotsList as $k => $v) {   
            if(!empty($v))
           $plots.= "<option value='".$v['auc_plot_id']."'>".$v['area_name']."</options>";
        }
        if(isset($plots) && !empty($plots))
        {    
            echo "$plots";
        }    
        else {
            echo "";    
        }
        die;
    }	
	
	public function actionGetStateByCountryID() {
       
        $states = "<option value=''>Please Select </options>";
        $countryCode = $_GET['countryCode'];
		$all =  Yii::app()->db->createCommand("SELECT lr_id,lr_name FROM bo_landregion where parent_id='$countryCode' and lr_type='state' AND is_lr_active='Y'")->queryAll();        
        foreach ($all as $k => $v) {
            $states = "$states<option value='$v[lr_id]'>$v[lr_name]</options>";
        }
        echo "$states";
        die;
    }  
	
	public function actionGetBusinessSuffix() {
       
        $businessEntityType = $_GET['businessEntityType'];
		
		$businessEntityTypeOption = "";
		
		if(isset($_GET['namereserve']) && !empty($_GET['namereserve']) && $_GET['namereserve']==3){
			$namereserve = $_GET['namereserve'];
			$all =  Yii::app()->db->createCommand("SELECT id,suffix_name FROM bo_business_entity_type_suffix where id IN('1','2') and status='1'")->queryAll();   
		}else{
			$all =  Yii::app()->db->createCommand("SELECT id,suffix_name FROM bo_business_entity_type_suffix where bo_business_entity_type_id='$businessEntityType' and status='1'")->queryAll();   
		}	
        foreach ($all as $k => $v) {
            $businessEntityTypeOption .= "<option value='$v[id]'>$v[suffix_name]</options>";
        }
        echo "$businessEntityTypeOption";
        die;
    }  
	
	public function actionGetBusinessSuffix2() {
       
        $businessEntityType = $_GET['businessEntityType'];
		
		$businessEntityTypeOption = "";
		
		if(isset($_GET['namereserve']) && !empty($_GET['namereserve']) && $_GET['namereserve']==2){
			$namereserve = $_GET['namereserve'];
			$all =  Yii::app()->db->createCommand("SELECT id,suffix_name FROM bo_business_entity_type_suffix where id IN('1','2') and status='1'")->queryAll();   
		}else{
			$all =  Yii::app()->db->createCommand("SELECT id,suffix_name FROM bo_business_entity_type_suffix where bo_business_entity_type_id='$businessEntityType' and status='1'")->queryAll();   
		}	
        foreach ($all as $k => $v) {
            $businessEntityTypeOption .= "<option value='$v[id]'>$v[suffix_name]</options>";
        }
        echo "$businessEntityTypeOption";
        die;
    }  
	
	public function actionGetBusinessSuffix3() {
       
        $businessEntityType = $_GET['businessEntityType'];
		
		$businessEntityTypeOption = "";
		
		$all =  Yii::app()->db->createCommand("SELECT id,suffix_name FROM bo_business_entity_type_suffix where bo_business_entity_type_id='$businessEntityType' and status='1'")->queryAll();   
		
        foreach ($all as $k => $v) {
            $businessEntityTypeOption .= "<option value='$v[id]'>$v[suffix_name]</options>";
        }
        echo "$businessEntityTypeOption";
        die;
    }  

    public function actionGetBusinessdetailByRegNo(){
        $business_reg_no = $_GET['business_reg_no'];
    
        $business_detail = Yii::app()->db->createCommand("SELECT * from bo_business_industry_list WHERE final_code='".$business_reg_no."'")->queryRow();
        if($business_detail){
            echo CJavaScript::jsonEncode(array('status'=>true,'records'=>$business_detail,'msg'=>'success'));
        }else{
            echo CJavaScript::jsonEncode(array('status'=>false,'msg'=>' Enter a valid Business Registration Number'));
        }
        
    }

     public function actionGetCause() {
        $type = "Select ";
        if(!empty($_GET['type'])){
            $type="All ";
        }
        $causes = "<option value=''>$type Cause</options>";
        $claim_id = $_GET['claim_id'];
        $all = Yii::app()->db->createCommand("SELECT * FROM master_sub_cause_claims WHERE is_active='Y' AND claim_id=$claim_id")->queryAll();
        
        foreach ($all as $k => $v) {
            $id = $v['id'];
            $val = $v['cause_name'];
            $causes = "$causes<option value='$id'>$val</options>";
        }
        echo "$causes";
        die;
    }


    
}
