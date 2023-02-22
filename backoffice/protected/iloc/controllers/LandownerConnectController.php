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
                'actions' => array('index', 'manage', 'view', 'create', 'update', 'documentview', 'addProperty', 'pinLocation', 'locationData', 'PropertySetting', 'isAuthorisedToModify', 'guestAdPublish'),
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
            $model->attributes = $_POST['LandownerConnect'];
            // Saving current loggedin User
            if (!empty($_SESSION['RESPONSE']['user_id'])) {
                $model->user_id = $_SESSION['RESPONSE']['user_id'];
                // Setting redirection for guest User // 25012018
            } else {
                $guestUserUrl = "/type/frontend";
            }
            $model->status = 'Y';
            $model->created_date = date('Y-m-d h:i:s');
            $model->modified_date = date('Y-m-d h:i:s');
            if ($model->save()) {
                $url = "/backoffice/iloc/landownerContact/create/landID/" . base64_encode($model->id) . $guestUserUrl;
                $this->redirect($url);
            }
        }
        $this->render('create', array(
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
            $model->attributes = $_POST['LandownerConnect'];
            $model->modified_date = date('Y-m-d h:i:s');
            if ($model->save()) {
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

        if (!empty($_SESSION['land_user_id'])) {
            $application = LandownerConnectEXT::getLandownerConnectListbyLandUserID();
        }
        // For first time users system should redirect Land Owners to "Add Land Details" form 
        if (empty($application)) {
            $url = "/backoffice/iloc/landownerConnect/create";
            $this->redirect($url);
        }
        $this->render('index', array(
            'dataProvider' => $application,
        ));
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {


        $application = LandownerConnectEXT::getLandownerConnectList();

        // Added By : Rahul [30012018]
        if (!empty($_SESSION['land_user_id'])) {
            $application = LandownerConnectEXT::getLandownerConnectListbyLandUserID();
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

}
