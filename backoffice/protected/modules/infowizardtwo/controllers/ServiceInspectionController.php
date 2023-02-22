<?php

class ServiceInspectionController extends Controller {

   /**
     * Discription: Adds inspection details for a particular service
     * params: Service ID  
     * Author: Neha Jaiswal
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
        $dataProvider = new CActiveDataProvider('BoInformationWizardServiceParameters');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new BoInformationWizardServiceParameters('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['BoInformationWizardServiceParameters']))
            $model->attributes = $_GET['BoInformationWizardServiceParameters'];

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
        $model = BoInformationWizardServiceParameters::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param BoInformationWizardServiceParameters $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'bo-information-wizard-service-parameters-form') {
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
	    unset($_SESSION['ServiceInspection']);
        $serviceID = $_GET['serviceID'];
        $serviceData = BoInformationWizardServiceMaster::model()->findByPk($serviceID);
         $connection=Yii::app()->db;
        if (!empty($_POST)) {
		    BoInformationWizardInspection::model()->deleteAll("service_id='$serviceID'");
            $serviceType = $_POST['service_type'];
            $alldata = $_POST;

            $acilppr['acilppr'] = $_POST['acilppr'];



            $acilppr['acilppr']['service_type'] = $alldata['service_type'][0]; 
			$acilppr['acilppr']['servicetype_additionalsubservice'] = '0';
            $data[] = $acilppr['acilppr'];

             if (in_array('Amendment - Others', $serviceType)) {
                $ao['ao'] = $_POST['ao'];
                $ao['ao']['service_type'] = "Amendment - Others";
				$ao['ao']['servicetype_additionalsubservice'] = '1';
                $data[] = $ao['ao'];
            }
            if (in_array('Amendment - Cancellation', $serviceType)) {
                $ac['ac'] = $_POST['ac'];
                $ac['ac']['service_type'] = "Amendment - Cancellation";
				$ac['ac']['servicetype_additionalsubservice'] = '2';
                $data[] = $ac['ac'];
            }
            if (in_array('Amendment - Surrender', $serviceType)) {
                $as['as'] = $_POST['as'];
                $as['as']['service_type'] = "Amendment - Surrender";
				$as['as']['servicetype_additionalsubservice'] = '3';
                $data[] = $as['as'];
            }
            
            if (in_array('Amendment - Transfer', $serviceType)) {
                $at['at'] = $_POST['at'];
                $at['at']['service_type'] = "Amendment - Transfer";
				$at['at']['servicetype_additionalsubservice'] = '4';
                $data[] = $at['at'];
            }
			
            if (in_array('Duplicate Copy', $serviceType)) {
                $duplicate['duplicate'] = $_POST['duplicate'];
                $duplicate['duplicate']['service_type'] = "Duplicate Copy";
				$duplicate['duplicate']['servicetype_additionalsubservice'] = '5';
                $data[] = $duplicate['duplicate'];
            }

            if (in_array('Renewal', $serviceType)) {
                $renewal['renewal'] = $_POST['renewal'];
                $renewal['renewal']['service_type'] = "Renewal";
				$renewal['renewal']['servicetype_additionalsubservice'] = '6';
                $data[] = $renewal['renewal'];
            }

            if (in_array('Return', $serviceType)) {
                $return['return'] = $_POST['return'];
                $return['return']['service_type'] = "Return";
				$return['return']['servicetype_additionalsubservice'] = '7';
                $data[] = $return['return'];
            }

            if (in_array('Maintenance of Register', $serviceType)) {
                $maintainence['maintainence'] = $_POST['maintainence'];
                $maintainence['maintainence']['service_type'] = "Maintenance of Register";
				 $maintainence['maintainence']['servicetype_additionalsubservice'] = '8';
                $data[] = $maintainence['maintainence'];
            }
            $status = "";
            foreach ($data as $datas) {
                $model = new BoInformationWizardInspection;
                $model->service_id = $serviceID;
                $model->service_type = $datas['service_type'];

                $model->self_certification_creation = "Sub Form link";
                $model->inspection_checklist_format_creation = " Sub Form link";
				$model->created = date('Y-m-d H:m:s');
				 $model->modified = date('Y-m-d H:m:s');
                $InspectionData['BoInformationWizardInspection'] = $datas;
                $model->attributes = $InspectionData['BoInformationWizardInspection'];

                // echo "<pre>";print_r($model);die;
                if ($model->save()) {
                    $status = $status . ", " . $datas['service_type'];
                }
            }
            if ($status != "") {
                Yii::app()->user->setFlash('Success', "Service Parameters for $status has been saved");
            } else {
                Yii::app()->user->setFlash('Error', "Service Parameters saving failed");
            }
            $serviceFeeURL = "/infowizard/serviceFee/Adddetails/serviceID/$serviceID";
            $this->redirect(Yii::app()->createUrl($serviceFeeURL));
        }
        $sql = "SELECT * from bo_information_wizard_inspection where service_id=$serviceID";
		$command=$connection->createCommand($sql);
		$ServiceInspection=$command->queryAll();	
              if(!empty($ServiceInspection)){
                foreach($ServiceInspection as $key=>$params){
                    $service_type=$params['service_type'];
                    if($key==0){
                        $_SESSION['ServiceInspection']["service"]=$params; 
                    }else{
                 $_SESSION['ServiceInspection'][$service_type]=$params;   
                    }
                }   
                }else{
                    $_SESSION['ServiceInspection']="";
                }
        $this->render("adddetails", array("serviceData" => $serviceData));
    }

}
