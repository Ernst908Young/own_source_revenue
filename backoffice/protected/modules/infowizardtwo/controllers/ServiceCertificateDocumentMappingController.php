<?php

class ServiceCertificateDocumentMappingController extends Controller {

    
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
                'actions' => array('create'),
                'users' => array('*'),
            ),            
        );
    }

    /**
     * @author  Rahul Kumar
     * @date 14022018
     * @description Document Mapping : Service with their Certificates
     *
     */
    
    public function actionCreate() {


        $model = new InformationWizardServiceCertificateMaping;
        if (isset($_POST['InformationWizardServiceCertificateMaping'])) {
            $serviceData = explode(".", $_POST['InformationWizardServiceCertificateMaping']['final_service_id']);
            $model->attributes = $_POST['InformationWizardServiceCertificateMaping'];
            $model->service_id = $serviceData[0];
            $model->sub_service_id = $serviceData[1];
            $model->created = date('Y-m-d H:i:s');
            $model->modified = date('Y-m-d H:i:s');
            $model->is_active = 'Y';
            $model->user_agent = $_SERVER['HTTP_USER_AGENT'];
            $model->ip_address = $_SERVER['REMOTE_ADDR'];
            if ($model->save()){
                $this->redirect(array('manage'));
            }
        }

        $this->render('create', array(
            'model' => $model,
        ));
    }

     /**
     * @author  Rahul Kumar
     * @date 15022018
     * @description of all Listing Document Mapping : Service with their Certificates
     *
     */
    
    public function actionManage() {
        // Getting all data of certificate document mapping with services
        $sqldata = "SELECT * from bo_information_wizard_service_certificate_maping where is_active='Y'"; 
        $serviceCertificateMappingData = Yii::app()->db->createCommand($sqldata)->queryAll();
        // Rendering it in manage 
        $this->render('manage', array('serviceCertificateMappingData' => $serviceCertificateMappingData));
    }

}
