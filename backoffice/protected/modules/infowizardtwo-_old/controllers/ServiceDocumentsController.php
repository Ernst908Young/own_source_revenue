<?php

class ServiceDocumentsController extends Controller {

    public function actionIndex() {
        $this->render('index');
    }

  /*  public function accessRules() {
        return array(
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('listing'),
                'expression' => 'DefaultUtility::isInfoWizardAdmin()',
            ),
            array('deny', // deny all users 
                'users' => array('*'),
            ),
        );
    }*/

    /**
     * 22-10-2017
     * @author: Rahul Kumar
     * @return:
     * @param:
     * */
    public function actionListing($issuer_by = 2) {
        //echo "here";die;
        @session_start();

        $sql = "SELECT * FROM bo_infowizard_issuerby_master as ibm
				INNER JOIN bo_information_wizard_service_master ON sm.issuerby_id=ibm.issuerby_id
				INNER JOIN bo_information_wizard_service_parameters ON";
        $service_id = 6;
        $sql = "SELECT * FROM bo_information_wizard_service_parameters WHERE service_id='$service_id'";
        $connection = Yii::app()->db;
        $command = $connection->createCommand($sql);
        $res = $command->queryAll();
       // print_r($res);die;
        $this->render("service_listing", array('datas' => $res));
    }
    
    /**
     * 23-10-2017
     * @author: Rahul Kumar
     * @return:
     * @param:
     * */
    	public function actionListingInspection($issuer_by=2){
		@session_start();
		
		$sql = "SELECT * FROM bo_infowizard_issuerby_master as ibm
				INNER JOIN bo_information_wizard_service_master ON sm.issuerby_id=ibm.issuerby_id
				INNER JOIN bo_information_wizard_service_parameters ON 
		";
		$service_id=6;
		$sql="SELECT * FROM bo_information_wizard_service_parameters WHERE service_id='$service_id'";
		$connection=Yii::app()->db; 
		$command=$connection->createCommand($sql);
		$res = $command->queryAll();
		$this->render("service_listing_inspection",array('datas'=>$res));
	}

}