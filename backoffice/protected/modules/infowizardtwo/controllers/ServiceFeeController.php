<?php

class ServiceFeeController extends Controller {

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
                'actions' => array('index', 'view', 'adddetails'),
                'users' => array('*'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('create', 'update'),
                'users' => array('*'),
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
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id) {
        $this->loadModel($id)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        $dataProvider = new CActiveDataProvider('BoInformationWizardServiceFee');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new BoInformationWizardServiceFee('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['BoInformationWizardServiceFee']))
            $model->attributes = $_GET['BoInformationWizardServiceFee'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return BoInformationWizardServiceParameters the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = BoInformationWizardServiceFee::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param BoInformationWizardServiceParameters $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'bo-information-wizard-service-fee-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    /**
     * Discription: Adds inspection details for a particular service
     * params: Service ID  
     * Author: Rahul Kumar
     */
    function actionAdddetails() {
	 unset($_SESSION['ServiceFee']);
        $serviceID = $_GET['serviceID'];
        $serviceData = BoInformationWizardServiceMaster::model()->findByPk($serviceID);
        $connection=Yii::app()->db;

        if (!empty($_POST)) {
		
		 BoInformationWizardServiceFee::model()->deleteAll("service_id='$serviceID'");
		 
            $serviceType = $_POST['service_type'];
            $alldata = $_POST;

            $acilppr['acilppr'] = $_POST['acilppr'];



            $acilppr['acilppr']['service_type'] = $alldata['service_type'][0];
            $data[] = $acilppr['acilppr'];

            if (in_array('Amendment - Others', $serviceType)) {
                $ao['ao'] = $_POST['ao'];
                $ao['ao']['service_type'] = "Amendment - Others";
                $data[] = $ao['ao'];
            }
			if (in_array('Amendment - Cancellation', $serviceType)) {
                $ac['ac'] = $_POST['ac'];
                $ac['ac']['service_type'] = "Amendment - Cancellation";
                $data[] = $ac['ac'];
            }
			if (in_array('Amendment - Surrender', $serviceType)) {
                $as['as'] = $_POST['as'];
                $as['as']['service_type'] = "Amendment - Surrender";
                $data[] = $as['as'];
            }
			if (in_array('Amendment - Transfer', $serviceType)) {
                $at['at'] = $_POST['at'];
                $at['at']['service_type'] = "Amendment - Transfer";
                $data[] = $at['at'];
            }

            if (in_array('Duplicate Copy', $serviceType)) {
                $duplicate['duplicate'] = $_POST['duplicate'];
                $duplicate['duplicate']['service_type'] = "Duplicate Copy";
                $data[] = $duplicate['duplicate'];
            }

            if (in_array('Renewal', $serviceType)) {
                $renewal['renewal'] = $_POST['renewal'];
                $renewal['renewal']['service_type'] = "Renewal";
                $data[] = $renewal['renewal'];
            }

            if (in_array('Return', $serviceType)) {
                $return['return'] = $_POST['return'];
                $return['return']['service_type'] = "Return";
                $data[] = $return['return'];
            }

            if (in_array('Maintenance of Register', $serviceType)) {
                $maintainence['maintainence'] = $_POST['maintainence'];
                $maintainence['maintainence']['service_type'] = "Maintenance of Register";
                $data[] = $maintainence['maintainence'];
            }
            // echo "<pre>";print_r($data);die;
            $status = "";
            foreach ($data as $datas) {
                $model = new BoInformationWizardServiceFee;
                $model->service_id = $serviceID;
                $model->service_type = $datas['service_type'];
                $model->created = date('Y-m-d H:m:s');
		$model->modified = date('Y-m-d H:m:s');
               
                $Sid = $datas['service_type'];
                   $allList = InfowizardQuestionMasterExt::getMasterList('bo_information_wizard_additional_sub_service_master', 'sub_service_name', 'id');
                   if (!empty($allList[$Sid])){
                    $model->servicetype_additionalsubservice = $allList[$Sid];
                   }else{
                    $model->servicetype_additionalsubservice = "0";
                   }
                    $InspectionData['BoInformationWizardServiceFee'] = $datas;
                $model->attributes = $InspectionData['BoInformationWizardServiceFee'];

               //  echo "<pre>";print_r($model->attributes);
                if ($model->save()) {
                    $status = $status . ", " . $datas['service_type'];
                }
				
            }
			//die;
            if ($status != "") {
                Yii::app()->user->setFlash('Success', "Service Fee for $status has been saved");
				$serviceFeeURL="/infowizard/ServiceTimeline/create/serviceID/$serviceID";
                $this->redirect(Yii::app()->createUrl($serviceFeeURL));
            } else {
                Yii::app()->user->setFlash('Error', "Service Fee saving failed");
            }
              
        }
        $applications = InfowizardQuestionMasterExt::getIWListDocChk();
		$sql = "SELECT * from bo_information_wizard_service_fee where service_id=$serviceID";
		$command=$connection->createCommand($sql);
		$ServiceFee=$command->queryAll();	
              if(!empty($ServiceFee)){
                foreach($ServiceFee as $key=>$params){
                    $service_type=$params['service_type'];
                    if($key==0){
                        $_SESSION['ServiceFee']["service"]=$params; 
                    }else{
                 $_SESSION['ServiceFee'][$service_type]=$params;   
                    }
                }   
                }else{
                    $_SESSION['ServiceFee']="";
                }
        $this->render("adddetails", array("applications" => $applications, "serviceData" => $serviceData));
    }

}
