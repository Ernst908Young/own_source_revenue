<?php

class ServiceValidityController extends Controller
{
/**
     * Discription: Adds service Validity for a particular service
     * params: Service ID  
     * Author: Neha Jaiswal
     */
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
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
	/*public function accessRules()
	{
		return array( 
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('create','other'),
				'expression'=>'RolesExt::isAdminUser()',
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('create','other'),
				'expression'=>'DefaultUtility::isInfoWizardAdmin()',
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}*/

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
            unset($_SESSION['ServiceValidity']);
	 $serviceID = $_GET['serviceID'];
     $serviceData = BoInformationWizardServiceMaster::model()->findByPk($serviceID);
      $connection=Yii::app()->db;
	 if (!empty($_POST)) {
              BoInfowizardServiceValidity::model()->deleteAll("service_id='$serviceID'"); 
                 
	// print_r($_POST); 
	       $model = new BoInfowizardServiceValidity;
              
            $alldata = $_POST;  //print_r($alldata);
            $acilppr['acilppr'] = $_POST['acilppr'];
			$acilppr['acilppr']['service_type'] = $alldata['service_type'][0]; //servicetype_additionalsubservice
			$acilppr['acilppr']['servicetype_additionalsubservice'] = '0';
			if(!empty($acilppr['acilppr']))
			{
		    $c=count($acilppr['acilppr']['day_month_year']); 
			for($i=0;$i<$c;$i++)
			{
			     $model->attributes = $acilppr['acilppr'];
				 $model->day_month_year = $acilppr['acilppr']['day_month_year'][$i];
				 $model->day_month_year_no = $acilppr['acilppr']['day_month_year_no'][$i];
				 $data[]=$model->attributes;
			 }
             }
			$renewal['renewal'] = $_POST['renewal'];
			$renewal['renewal']['service_type'] = 'Renewal';
			$renewal['renewal']['servicetype_additionalsubservice'] = '6';
			if(!empty($renewal['renewal']))
			{
		    $d=count($renewal['renewal']['day_month_year']); 
			for($j=0;$j<$d;$j++)
			{
			     $model->attributes = $renewal['renewal'];
				 $model->day_month_year = $renewal['renewal']['day_month_year'][$j];
				 $model->day_month_year_no = $renewal['renewal']['day_month_year_no'][$j];
				 $data[]=$model->attributes;
			 }
             } 
			   //print_r($data );	
		    
            foreach ($data as $key => $datasave) { 
			$model=new BoInfowizardServiceValidity;
			   $model->attributes = $datasave;
                $model->service_id = $serviceID;
				 $model->created = date('Y-m-d H:m:s');
				 $model->modified = date('Y-m-d H:m:s');
             
                if ($model->save()) 
				{ }
		
          // print_r($model->attributes);	
            }
			//die;
			$status = $alldata['service_type'][0] . ", " . $alldata['service_type'][1];
            if ($status != "") {
                Yii::app()->user->setFlash('Success', "Service Validity for $status has been saved");
            } else {
                Yii::app()->user->setFlash('Error', "Service Validity saving failed");
            }
            $serviceFeeURL = "/infowizard/ServiceValidity/other/serviceID/$serviceID";
            $this->redirect(Yii::app()->createUrl($serviceFeeURL));
		
	 }
          $connection=Yii::app()->db;       
	  $sql = "SELECT * from bo_infowizard_service_validity where service_id=$serviceID";
		$command=$connection->createCommand($sql);
		$ServiceParameter=$command->queryAll();	
              if(!empty($ServiceParameter)){
                foreach($ServiceParameter as $params){
                    $service_type=$params['service_type'];
                      
                    if($service_type=="Renewal"){
                 $_SESSION['ServiceValidity']["Renewal"][]=$params;   
                }else{  $_SESSION['ServiceValidity']["services"][]=$params;  }
                }
                }else{
                    $_SESSION['ServiceValidity']="";
                }
		$this->render('create',array("serviceData" => $serviceData));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	 public function actionOther()
	{
		$serviceID = $_GET['serviceID'];
        $serviceData = BoInformationWizardServiceMaster::model()->findByPk($serviceID);
		$this->render('other',array("serviceData" => $serviceData));
	}
	
	
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['BoInfowizardServiceValidity']))
		{
			$model->attributes=$_POST['BoInfowizardServiceValidity'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('BoInfowizardServiceValidity');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return BoInfowizardServiceValidity the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=BoInfowizardServiceValidity::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param BoInfowizardServiceValidity $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='bo-infowizard-service-validity-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
