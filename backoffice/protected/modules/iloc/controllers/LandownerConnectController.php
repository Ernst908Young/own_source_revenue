<?php
class LandownerConnectController extends Controller {

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
                'actions' => array('index', 'manage','landListCategoryWise', 'landList','logout', 'view', 'create', 'update', 'documentview', 'addProperty', 'pinLocation', 'locationData', 'PropertySetting', 'isAuthorisedToModify', 'guestAdPublish'),
                'users' => array('*'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array(),
                'users' => array('@'),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('admin', 'delete'),
                'users' => array('admin'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id) {
        $sql = "SELECT * FROM bo_landowner_connect  WHERE id=$id ";
        $connection = Yii::app()->db;
        $command = $connection->createCommand($sql);
        $services = $command->queryRow();
        $this->render('view', array(
            'apps' => $services,
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        @session_start();
        $model = new LandownerConnect;

        // Uncomment the following line if AJAX validation is needed
        $this->performAjaxValidation($model);
        $guestUserUrl = "";
        if (isset($_POST['LandownerConnect'])) {
			$YII_CSRF_TOKEN2 = Yii::app()->request->csrfToken;
			if($YII_CSRF_TOKEN2 != $_POST['LandownerConnect']['YII_CSRF_TOKEN']){
				//throw new CHttpException(400,"Fraudulent Activity :: Bad Request");
				echo $msg = "Fraudulent Activity :: Bad Request";
				exit;
			}
            $model->attributes = $_POST['LandownerConnect'];
		   // echo "<!-- CKHERE: ";//print_r($_POST);echo "-->";	
			/* Author:Pankaj Kumar Tiwari
			   Date:16Feb2018  */
			$model->village = !empty($_POST['LandownerConnect']['village'])?$_POST['LandownerConnect']['village']:'';
			/*---------------------------*/
			
			
            // Saving current loggedin User
            if (!empty($_SESSION['RESPONSE']['user_id'])) {
                $model->user_id = $_SESSION['RESPONSE']['user_id'];
                // Setting redirection for guest User // 25012018
            } else {
                $guestUserUrl = "/type/frontend";
            }
             if (!empty($_SESSION['uid'])){
             $model->dept_user_id=$_SESSION['uid'];
             /* Added By Rahul  */
             if(RolesExt::isDMUser()){  
                   // Getting District Id Of DM
                   $data=Yii::app()->db->createCommand("Select disctrict_id from bo_user where uid=".$_SESSION['uid'])->queryRow();
                     $model->district_id=@$data['disctrict_id'];
             }
              if(DefaultUtility::isHODNodal()){  
                        $model->department_id=@$_SESSION['dept_id']; 
                                 }
             }
            $model->status = 'Y';
            $model->created_date = date('Y-m-d h:i:s');
            $model->modified_date = date('Y-m-d h:i:s');
           // print_r($model);die;
            if ($model->save()) {
				/*---------Pankaj Kumar Tiwari @09Feb2018 actionCreateLog ----------*/
				$this->actionCreateLog($model->id);
                            //    print_r($_FILES);die;
            // File Upload 
                if (isset($_FILES['document']['tmp_name'], $_FILES['document']['error']) && $_FILES['document']['error'] == 0) {
                    if ($this->validateUploadedLandDocument($_FILES['document'], $model->id, 'pdf'))
                        if (!$this->uploadLandDocument($_FILES['document'], $model->id)) {
                            die("couldn't upload the document");
                        }
                }
                if (isset($_FILES['video']['tmp_name'], $_FILES['video']['error']) && $_FILES['video']['error'] == 0) {

                    if ($this->validateUploadedLandDocument($_FILES['video'], $model->id, 'video')) {
                        if (!$this->uploadLandDocument($_FILES['video'], $model->id)) {
                            die("couldn't upload the video");
                        }
                    }
                }

                $url = "/backoffice/iloc/landownerContact/create/landID/" . base64_encode($model->id) . $guestUserUrl;
                $this->redirect($url);
            }
        }
        $this->render('_form', array(
            'model' => $model,
        ));
    }

    // Neha
    public function actionDocumentView() {
        $this->render('documentview');
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id) {
        $id = base64_decode($id);
        $model = $this->loadModel($id);
        //print_r($_SERVER);die;
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);
        //$isAuthorised = LandownerConnectEXT::isAuthorisedToModify($id);
        //commented due to
        //  if ($isAuthorised != 1) {
        //     Yii::app()->user->setFlash('Error', "You are not authorised for this request");
        // } else {
        $guestUserUrl = "";
        if (empty($_SESSION['RESPONSE']['user_id'])) {
            // Setting redirection for guest User // 25012018
            $guestUserUrl = "/type/frontend";
        }
        if (isset($_POST['LandownerConnect'])) {
			
			
			//echo $id; print_r($_POST);   exit();
			
            $model->attributes = $_POST['LandownerConnect'];
			
			/* Author:Pankaj Kumar Tiwari
			   Date:16Feb2018  */
			
			$model->village = !empty($_POST['LandownerConnect']['village'])?$_POST['LandownerConnect']['village']:'';
			
			/*-------------------*/
			
            $model->modified_date = date('Y-m-d h:i:s');
			
			
			//echo '<pre/>'; print_r($_POST['LandownerConnect']);  print_r($model);  exit();
			
            if ($model->save()) {

				/*---------Pankaj Kumar Tiwari @09Feb2018 actionCreateLog() ----------*/

				    $this->actionCreateLog($id);

// File Upload 
                if (isset($_FILES['document']['tmp_name'], $_FILES['document']['error']) && $_FILES['document']['error'] == 0) {
                    if ($this->validateUploadedLandDocument($_FILES['document'], $model->id, 'pdf'))
                        if (!$this->uploadLandDocument($_FILES['document'], $model->id)) {
                            die("couldn't upload the document");
                        }
                }
                if (isset($_FILES['video']['tmp_name'], $_FILES['video']['error']) && $_FILES['video']['error'] == 0) {

                    if ($this->validateUploadedLandDocument($_FILES['video'], $model->id, 'video')) {
                        //echo '<pre/>'; print_r($_FILES['document']['tmp_name']);   exit();
                        if (!$this->uploadLandDocument($_FILES['video'], $model->id)) {
                            die("couldn't upload the video");
                        }
                    }
                }

				/*---------------------------------------------------------------*/

                $requestedProperty = LandownerConnectEXT::isLandContactAvailable(base64_encode($id));
                $urlPostFix = "/backoffice/iloc/landownerContact/create/landID/" . base64_encode($id) . $guestUserUrl;
                if (!empty($requestedProperty)) {
                    $urlPostFix = "/backoffice/iloc/landownerContact/update/id/" . base64_encode($id) . "/landID/" . base64_encode($id) . $guestUserUrl;
                }

                //  $url = "/backoffice/iloc/landownerContact/create/landID/" . base64_encode($model->id);
                $this->redirect($urlPostFix);
            }
        }
        //  }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id) {
        $isAuthorised = LandownerConnectEXT::isAuthorisedToModify($id);
        if ($isAuthorised != 1) {
            Yii::app()->user->setFlash('Error', "You are not authorised for this request");
            $this->redirect($this->referer());
        }
        $this->loadModel($id)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    /**
     * @author  Rahul Kumar
     * @date 30012018
     * @description Manage by land user only
     *
     */
    public function actionManage() {

      if (isset($_SESSION['RESPONSE']['user_id']) && !empty($_SESSION['RESPONSE']['user_id'])) {
            $application   = LandownerConnectEXT::getLandownerConnectList();
            $application_r = LandownerConnectEXT::getLandrequesterConnectList(); //jitendra
      }
      // Added By : Rahul [30012018]
      if (isset($_SESSION['land_user_id']) && !empty($_SESSION['land_user_id'])) {
          $application = LandownerConnectEXT::getLandownerConnectListbyLandUserID();
          $application_r = LandownerConnectEXT::getLandrequesterConnectListbyLandUserID();
      }
       // Added By : Rahul [30012018]
      if (isset($_SESSION['uid']) && !empty($_SESSION['uid'])) {
          $application = LandownerConnectEXT::getLandownerConnectListbyLandDeptUserID();
          $application_r = LandownerConnectEXT::getLandrequesterConnectListbyLandDeptUserID(); //jitendra
      }
        // For first time users system should redirect Land Owners to "Add Land Details" form 
      /*  if (empty($application)) {
            $url = "/backoffice/iloc/landownerConnect/create";
            $this->redirect($url);
        } */
        $this->render('index', array(
            'dataProvider' => $application,
            'dataProvider_r' => $application_r,
        ));
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {

  if (!empty($_SESSION['RESPONSE']['user_id'])) {
        $application = LandownerConnectEXT::getLandownerConnectList();
        $application_r = LandownerConnectEXT::getLandrequesterConnectList(); //jitendra
  }
        // Added By : Rahul [30012018]
        if (!empty($_SESSION['land_user_id'])) {
            $application = LandownerConnectEXT::getLandownerConnectListbyLandUserID();
            $application_r = LandownerConnectEXT::getLandrequesterConnectListbyLandUserID();

        }
         // Added By : Rahul [30012018]
        if (!empty($_SESSION['uid'])) {
            $application = LandownerConnectEXT::getLandownerConnectListbyLandDeptUserID();
            $application_r = LandownerConnectEXT::getLandrequesterConnectListbyLandDeptUserID(); //jitendra
        }
        //  End of adding [30012018]
        // Added By : Rahul [16012018]
        // For first time users system should redirect Land Owners to "Add Land Details" form 
        if (empty($application)) {
            $url = "/backoffice/iloc/landownerConnect/create";
            $this->redirect($url);
        }

        // end of adding: Rahul [16012018]
        $this->render('index', array(
            'dataProvider' => $application,
            'dataProvider_r' => $application_r,
        ));
    }

    // Added by : Rahul Kumar
    // Date 13012018
    public function actionPinLocation() {

        // Checking and redirecting if not passed landID
        if (empty($_GET['landID'])) {
            $url = "/backoffice/iloc/landownerContact/create/";
            $this->redirect($url);
        }
        $landID = base64_decode($_GET['landID']);

        // Updated Date : 15012018 ---------------------
        // Getting all active land records
        $requestedProperty = Yii::app()->db->createCommand("SELECT * FROM bo_landowner_connect where id=$landID")->queryRow();
        // print_r($requestedProperties);die;
        // End Update   ------------------------------

        $this->render('pinLocation', array('requestedProperty' => $requestedProperty));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new LandownerConnect('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['LandownerConnect']))
            $model->attributes = $_GET['LandownerConnect'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return LandownerConnect the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = LandownerConnect::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param LandownerConnect $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'landowner-connect-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    // Added by : Rahul Kumar
    // Date 14012018
    public function actionLocationData() {
        extract($_GET);
        $landID = base64_decode($landID);
        $connection = Yii::app()->db;

        // updating latlong details
        $allActiveProperties = $connection->createCommand("UPDATE bo_landowner_connect SET latlong='$latlong' WHERE id=$landID")->execute();

        if ($allActiveProperties = 1) {
            return true;
        } else {
            return false;
        }
    }

    /**   @author : Rahul Kumar
     *   @created 15012018
     *   @Description:  Land owner will set here bellow Given settings
     * - @condition1: Share My Contact Details with Visitors ($ShareContact)
     * - @condition2: Property Available for listing / Property Not Available for listing ($propertyAvailable)
     *   @return boolean
     */
    public function actionPropertySetting() {
        extract($_GET);

        // Added : 16012018
        // echo $landID;
        // $propertyAvailable   : Y OR N OR D OR A  // System should categorise the Add Land details under (a) Available Land Details (b) Not Available Land Details (c) Draft (d) Archived
        // $ShareContact
        //      : Y OR N
        $ShareContact = "";
        $propertyAvailable = "";
        $publishMsg = "";
        // print_r($_POST);die;
        if (!empty($_POST)) {
 //End of adding 16012018
            $landID = base64_decode($landID);

            // Share Contact
            if (!empty($_POST['share_contact']) && $_POST['share_contact'] == "on") {
                $ShareContact = "Y";
            } else {
                $ShareContact = "N";
            }

            // Ad status, In case of sending msg when it is for publish
            if (!empty($_POST['status'])) {
                $propertyAvailable = $_POST['status'];
                if ($propertyAvailable == "Y") {
                    $publishMsg = 'Your Land Advertisement has been successfully submitted on Uttarakhand Single Window Portal. Your application reference number is: ILOC000' . $landID;
                    $messageSent="";
                 //   $messageSent = DefaultUtility::sendOTPToMobile($mobileNumber, $publishMsg);
                    // Success message
                   // if ($messageSent) {
                        Yii::app()->user->setFlash('Success', $publishMsg);
                   // }
                }
            }


            /*  $isAuthorised = LandownerConnectEXT::isAuthorisedToModify($landID);
              if ($isAuthorised != 1) {
              Yii::app()->user->setFlash('Error', "You are not authorised for this request");
              $this->redirect($this->referer());
              } */

            $connection = Yii::app()->db;

            // updating setting data related to property
            $updatedProperties = $connection->createCommand("UPDATE bo_landowner_connect SET status='$propertyAvailable',share_contact='$ShareContact' WHERE id=$landID")->execute();

            /* ----  @Pankaj Kr Tiwari @09Feb2018  -----*/
			$this->actionPropertySettingLog();


		   if ($updatedProperties = 1) {
                if ($publishMsg == "") {
                    Yii::app()->user->setFlash('Success', "Settings have been saved successfully, Your application reference number is: ILOC00$landID");
                }

                // Redirecting to preview page
                $url = "/backoffice/iloc/property/preview/landID/" . base64_encode($landID);
                $this->redirect($url);
            }

        } else {
            Yii::app()->user->setFlash('Error', "Sorry, Settings have not been saved. Please recheck selected data");
        }
    }

    /**  @author : Rahul Kumar
     *   @created 27012018
     *   @Description:  Land owner will verify his/her contact detail , Once verification Done, Ad will be published
     */
    public function actionGuestAdPublish() {
        // Getting Post values here
        extract($_POST);
        $mobileNumber = $_POST['mobile_number'];
        $publishMsg = 'Your Land Advertisement has been successfully submitted on Uttarakhand Single Window Portal. Your application reference number is: ILOC000' . base64_decode($_POST['lID']);
        // Sending SMS HERE
        $messageSent = DefaultUtility::sendOTPToMobile($mobileNumber, $publishMsg);
        // Success message
        if ($messageSent) {
            Yii::app()->user->setFlash('Success', $publishMsg);
            // Redirecting to preview page
            $url = "/backoffice/iloc/property/preview/landID/" . $_POST['lID'];
            $this->redirect($url);
        } else {
            // Showing error on same page
            Yii::app()->user->setFlash('Error', "Sending sms failed, Please try again");
        }
    }


	/**   @author : Pankaj Kumar Tiwari
     *   @created 09 Feb 2017
     *   @Description:  Create Log of Land settings Given  Below By Land Owner
     * - @condition1: Share My Contact Details with Visitors ($ShareContact)
     * - @condition2: Property Available for listing / Property Not Available for listing ($propertyAvailable)
     *   @return boolean
     */

    public function actionPropertySettingLog() {
        extract($_GET);



        // Added : 09 Feb 2018
        // $propertyAvailable   : Y OR N OR D OR A  // System should categorise the Add Land details under (a) Available Land Details (b) Not Available Land Details (c) Draft (d) Archived
        // $ShareContact
        //      : Y OR N
        $ShareContact = "";
        $propertyAvailable = "";

        if (!empty($_POST)) {
            //End of adding 16012018
              $landID = base64_decode($landID); // die("Hello");

            // Share Contact
            if (!empty($_POST['share_contact']) && $_POST['share_contact'] == "on") {
                $ShareContact = "Y";
            } else {
                $ShareContact = "N";
            }

            // Ad status, In case of sending msg when it is for publish
            if (!empty($_POST['status'])) {
                $propertyAvailable = $_POST['status'];
            }

            $connection = Yii::app()->db;

			// updating setting data related to property
            $property = Yii::app()->db->createCommand(array(
					'select' => '*',
					'from' => 'bo_landowner_connect',
					'where' => 'id=:id',
					'params' => array(':id'=>$landID),
				))->queryRow();

				$land_id=$property['id'];
				unset($property['id']);
				unset($property['created_date']);
				unset($property['modified_date']);

				//echo '<pre/>'; echo $landID;  print_r($property);   exit();

			        $model = new LandownerConnectLog;
                    if (isset($property)) {

						$model->attributes = $property;
						$model->land_id = $land_id;
						// Saving current loggedin User Log
						if (!empty($_SESSION['RESPONSE']['user_id'])) {
							$model->user_id = $_SESSION['RESPONSE']['user_id'];
						}
						if (!empty($_SESSION['uid'])){
							 $model->dept_user_id=$_SESSION['uid'];
						}
						$model->status = 'Y';
						$model->created_date = date('Y-m-d h:i:s');
						$model->modified_date = date('Y-m-d h:i:s');
						$model->status = $propertyAvailable;
						$model->share_contact = $ShareContact;
						$model->remote_ip = $_SERVER['REMOTE_ADDR'];
						$agent = $_SERVER['HTTP_USER_AGENT'];
						$model->user_agent = $agent;

						//echo '<pre/>'; echo $landID;  print_r($model);   exit();

						$model->save();
						//print_r($model->getErrors());die;

					}

		}
    }


	/** @Created: 9 Feb 2018
	    @Author: Pankaj Kumar Tiwari
	    @Description: Save Log Detail on Create and update action of land
    */


    public function actionCreateLog($land_id) {

        $model = new LandownerConnectLog;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        //$guestUserUrl = "";
        if (isset($_POST['LandownerConnect'])) {
            $model->attributes = $_POST['LandownerConnect'];
            // Saving current loggedin User Log
            if (!empty($_SESSION['RESPONSE']['user_id'])) {
                $model->user_id = $_SESSION['RESPONSE']['user_id'];
            }
			if (!empty($_SESSION['uid'])){
				 $model->dept_user_id=$_SESSION['uid'];
			}
            $model->status = 'Y';
			$model->land_id=$land_id;
            $model->created_date = date('Y-m-d h:i:s');
            $model->modified_date = date('Y-m-d h:i:s');
			$model->remote_ip = $_SERVER['REMOTE_ADDR'];
			$agent = $_SERVER['HTTP_USER_AGENT'];
			$model->user_agent = $agent;

			$model->save();

        }

    }

public function actionLogout()
	{

		@session_start();
    //print_r($_SESSION);die;
		if(isset($_SESSION['land_mobile'])){
        unset($_SESSION['land_mobile']);
        unset($_SESSION['land_user_id']);
        unset($_SESSION['land_guest_user_id']);
       $this->redirect(FRONT_BASEURL);
		 }

	}
  private function uploadLandDocument($documentInfo, $landId) {
        $new_name_other = '';
        $path = Yii::app()->basePath . "/../../themes/backend/mydoc/";
        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }

        $ext = pathinfo($documentInfo['name'], PATHINFO_EXTENSION);
        if (trim($documentInfo['name']) != '') {
            $new_name_other = $documentInfo['name'] . "-" . time() . "." . $ext;
            move_uploaded_file($documentInfo['tmp_name'], $path . $new_name_other);
        }
        $criteria = new CDbCriteria;
        $criteria->condition = 'land_id=:landId AND  document_mime_type=:document_mime_type AND is_active="Y"';
        $criteria->params = array(':landId' => $landId, ':document_mime_type' => $documentInfo['type']);
        $document = LandownerMedia::model()->find($criteria);


        if (!$document) {
            $document = new LandownerMedia;
        }
        $document->document_name = $new_name_other;
        $document->land_id = $landId;
        $document->create_date = date("Y-m-d H::i:s");
        $document->doc_size = $documentInfo['size'];
        //$document->documents      = $documentInfo['name']; //base64_encode(file_get_contents($documentInfo['tmp_name']));
        $document->document_mime_type = $documentInfo['type'];
        $document->media_type = $ext;
        $document->remote_ip = $_SERVER['REMOTE_ADDR']; //$this->GetRealIPAddress();
        $document->user_agent = $_SERVER['HTTP_USER_AGENT'];
        
        if ($document->save()) {

            return true;
        } else {
            die(var_dump($document->getErrors()));
        }
        return false;
    }

    /// jitendra Singh 
    // date 18-03-2018
    protected function getLandDocument($landId, $media_type) {
        $criteria = new CDbCriteria;
        $criteria->condition = "land_id=:landId AND media_type=:media_type AND is_active='Y'";
        $criteria->params = array(":landId" => $landId, ":media_type" => $media_type);
        $docs = LandownerMedia::model()->find($criteria);
        //echo "<pre>";print_r($docs);die("kjsdhsjk");
        return $docs;
    }

    public function actionDownloadDocuments() {
        @session_start();
        $uid = $_SESSION['RESPONSE']['user_id'];
        $name = $_GET['document'];
        $dir_path = Yii::app()->basePath . "/../../themes/backend/mydoc/"; //Yii::getPathOfAlias('webroot') . '/themes/backend/mydoc/'.$uid.'/'; 
        $fileName = $dir_path . "/$name";
        //echo $fileName;die;
        if (file_exists($fileName))
            return Yii::app()->getRequest()->sendFile($name, @file_get_contents($fileName));
        else
            throw new CHttpException(404, 'The requested page does not exist.');
    }
    
    
    private function validateUploadedLandDocument($docInfo, $landID, $mtype) {

        $guestUserUrl = '';
        // Saving current loggedin User
        if (!empty($_SESSION['RESPONSE']['user_id'])) {
            $_SESSION['RESPONSE']['user_id'];
            // Setting redirection for guest User // 25012018
        } else {
            $guestUserUrl = "/type/frontend";
        }
        if ($mtype == 'pdf') {
            $file_type = array('application/pdf');
            $msg = 'Please upload pdf File Only.';
        }
        if ($mtype == 'video') {
            $file_type = array('video/mp4');
            $msg = 'Please upload  mp4 video File Only.';
        }


        if (!in_array($docInfo['type'], $file_type)) {
            Yii::app()->user->setFlash('Error', $msg);
            $this->redirect(Yii::app()->createAbsoluteUrl($url));
            exit;
        }

        $size = $docInfo['size'] / 1000000;

        if ($docInfo['type'] == 'application/pdf' && $size > 25) {
            Yii::app()->user->setFlash('Error', "Please upload file less than 25 MB Only.");
            $this->redirect(Yii::app()->createAbsoluteUrl($url));
            exit;
        } else {

            if ($docInfo['type'] == 'video/mp4' && $size > 50) {

                Yii::app()->user->setFlash('Error', "Please upload file less than 50 MB Only.");
                $this->redirect(Yii::app()->createAbsoluteUrl($url));
                exit;
            }
        }


        return true;
    }
    
     /**
     * @author  Rahul Kumar
     * @date 30012018
     * @description Manage by land user only
     *
     */
    public function actionLandList() {

     
            $application = LandownerConnectEXT::getAllLandWithOwner();
            
           $application_r = LandownerConnectEXT::getLandrequesterConnectListAll(); //jitendra
           //print_r($application_r);die;
 
     
        $this->render('list', array(
            'dataProvider' => $application,
            'dataProvider_r' => $application_r,
        ));
    }
    public function actionLandListCategoryWise() {

     
            $application = LandownerConnectEXT::getAllLandWithOwner();
           $application_r = LandownerConnectEXT::getLandrequesterConnectListAll(); //jitendra
 
     
        $this->render('listcw', array(
            'dataProvider' => $application,
            'dataProvider_r' => $application_r,
        ));
    }



}
