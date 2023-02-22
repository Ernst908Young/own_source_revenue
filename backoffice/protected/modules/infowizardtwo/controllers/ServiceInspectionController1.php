<?php

class ServiceInspectionController extends Controller {

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
        $serviceID = $_GET['serviceID'];
        $serviceData = BoInformationWizardServiceMaster::model()->findByPk($serviceID);

        if (!empty($_POST)) {
            $serviceType = $_POST['service_type'];
            $alldata = $_POST;

            $acilppr['acilppr'] = $_POST['acilppr'];



            $acilppr['acilppr']['service_type'] = $alldata['service_type'][0];
            $data[] = $acilppr['acilppr'];

            if (in_array('Amendment including cancellation Surrender Transfer', $serviceType)) {
                $aisct['aisct'] = $_POST['aisct'];
                $aisct['aisct']['service_type'] = "Amendment including cancellation Surrender Transfer";
                $data[] = $aisct['aisct'];
            }

            if (in_array('Duplicate Copy', $serviceType)) {
                $duplicate['duplicate'] = $_POST['duplicate'];
                $duplicate['duplicate']['service_type'] = "Duplicate";
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
            $status = "";
            foreach ($data as $datas) {
                $model = new BoInformationWizardInspection;
                $model->service_id = $serviceID;
                $model->service_type = $datas['service_type'];

                $model->self_certification_creation = "Sub Form link";
                $model->inspection_checklist_format_creation = " Sub Form link";
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
        $applications = InfowizardQuestionMasterExt::getIWListDocChk();
        $this->render("adddetails", array("applications" => $applications, "serviceData" => $serviceData));
    }

}
