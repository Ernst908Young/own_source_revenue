<?php

class ServiceFormWorkflowController extends Controller {

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

	
	function actionCreation(){	
    
		@session_start();  
		 
		$base=Yii::app()->theme->baseUrl;
		$sql_d = "SELECT * FROM bo_infowizard_issuerby_master WHERE is_issuerby_active='Y' AND issuer_id='2' ORDER BY name ASC";
		$connection=Yii::app()->db; 
		$command=$connection->createCommand($sql_d);
		$res_d = $command->queryAll();  
		$res_caf=array();
		// Get all services list
		$res_s=false;
		$id=false;
		if(isset($_GET['id']) && $_GET['id']>0){
			$id=$_GET['id'];
			$sql_s="SELECT * FROM bo_information_wizard_service_master as sm  
				  INNER JOIN bo_information_wizard_service_parameters as sp ON sp.service_id=sm.id   
				  WHERE issuerby_id='$id' AND is_active='Y' ORDER BY service_name ASC";
			$connection=Yii::app()->db; 
			$command=$connection->createCommand($sql_s);
			$res_s = $command->queryAll();
		}
		
		$this->render("creation",array('res_d'=>$res_d,'res_caf'=>$res_caf,'res_s'=>$res_s,'id'=>$id));
	}
	
	

}
