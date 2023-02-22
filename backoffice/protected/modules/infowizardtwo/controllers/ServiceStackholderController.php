<?php

class ServiceStackholderController extends Controller
{
	/**

    * This function is used to get the Stakeholder Master

     * @Author: Neha Jaiswal

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
	public function accessRules()
	{
		return array(
			
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','index'),
				'expression'=>'RolesExt::isAdminUser()',
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('create','index'),
				'expression'=>'DefaultUtility::isInfoWizardAdmin()',
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{   unset($_SESSION['ServiceStakeholder']);
		$serviceID = $_GET['serviceID'];
        $serviceData = BoInformationWizardServiceMaster::model()->findByPk($serviceID);
		$professionaldata=InfowizardQuestionMasterExt::getListProfessional();
		 $connection=Yii::app()->db;
		if (!empty($_POST)) 
		{  //print_r($_POST);
		 
		  BoInfowizardServiceStackholder::model()->deleteAll("service_id='$serviceID'");
			$serviceType = $_POST['service_type'];
            $alldata = $_POST;

            $acilppr['acilppr'] = $_POST['acilppr'];
            $acilppr['acilppr']['service_type'] = $alldata['service_type'][0]; 
			$acilppr['acilppr']['servicetype_additionalsubservice'] = '0';
			
               if(!empty($acilppr['acilppr']['list_professional']))
               $acilppr['acilppr']['list_professional'] = implode(",", $acilppr['acilppr']['list_professional']); 
			    if(!empty($acilppr['acilppr']['central_department']))
               $acilppr['acilppr']['central_department'] = implode(",", $acilppr['acilppr']['central_department']); 
			    if(!empty($acilppr['acilppr']['state_department']))
               $acilppr['acilppr']['state_department'] = implode(",", $acilppr['acilppr']['state_department']); 
               $data[] = $acilppr['acilppr'];
			   
			   if (in_array('Amendment - Others', $serviceType)) { //servicetype_additionalsubservice
                $ao['ao'] = $_POST['ao'];
                $ao['ao']['service_type'] = "Amendment - Others";
				$ao['ao']['servicetype_additionalsubservice'] = '1';
                if(!empty($ao['ao']['list_professional']))
                    $ao['ao']['list_professional'] = implode(",", $ao['ao']['list_professional']);
					if(!empty($ao['ao']['central_department']))
                    $ao['ao']['central_department'] = implode(",", $ao['ao']['central_department']);
					if(!empty($ao['ao']['state_department']))
                    $ao['ao']['state_department'] = implode(",", $ao['ao']['state_department']);
                $data[] = $ao['ao'];
            }
			
			if (in_array('Amendment - Cancellation', $serviceType)) { 
                $ac['ac'] = $_POST['ac'];
                $ac['ac']['service_type'] = "Amendment - Cancellation";
				$ac['ac']['servicetype_additionalsubservice'] = '2';
                if(!empty($ac['ac']['list_professional']))
                    $ac['ac']['list_professional'] = implode(",", $ac['ac']['list_professional']);
					if(!empty($ac['ac']['central_department']))
                    $ac['ac']['central_department'] = implode(",", $ac['ac']['central_department']);
					if(!empty($ac['ac']['state_department']))
                    $ac['ac']['state_department'] = implode(",", $ac['ac']['state_department']);
                $data[] = $ac['ac'];
            }
			
			if (in_array('Amendment - Surrender', $serviceType)) { 
                $as['as'] = $_POST['as'];
                $as['as']['service_type'] = "Amendment - Surrender";
				$as['as']['servicetype_additionalsubservice'] = '3';
                if(!empty($as['as']['list_professional']))
                    $as['as']['list_professional'] = implode(",", $as['as']['list_professional']);
					if(!empty($as['as']['central_department']))
                    $as['as']['central_department'] = implode(",", $as['as']['central_department']);
					if(!empty($as['as']['state_department']))
                    $as['as']['state_department'] = implode(",", $as['as']['state_department']);
                $data[] = $as['as'];
            }
			
			if (in_array('Amendment - Transfer', $serviceType)) { 
                $at['at'] = $_POST['at'];
                $at['at']['service_type'] = "Amendment - Transfer";
				$at['at']['servicetype_additionalsubservice'] = '4';
                if(!empty($at['at']['list_professional']))
                    $at['at']['list_professional'] = implode(",", $at['at']['list_professional']);
					if(!empty($at['at']['central_department']))
                    $at['at']['central_department'] = implode(",", $at['at']['central_department']);
					if(!empty($at['at']['state_department']))
                    $at['at']['state_department'] = implode(",", $at['at']['state_department']);
                $data[] = $at['at'];
            }
			   
			   if (in_array('Duplicate Copy', $serviceType)) {
                $duplicate['duplicate'] = $_POST['duplicate'];
                $duplicate['duplicate']['service_type'] = "Duplicate Copy";
				$duplicate['duplicate']['servicetype_additionalsubservice'] = '5';
                 if(!empty($duplicate['duplicate']['list_professional']))
                $duplicate['duplicate']['list_professional'] = implode(",", $duplicate['duplicate']['list_professional']);
				 if(!empty($duplicate['duplicate']['central_department']))
                $duplicate['duplicate']['central_department'] = implode(",", $duplicate['duplicate']['central_department']);
				 if(!empty($duplicate['duplicate']['state_department']))
                $duplicate['duplicate']['state_department'] = implode(",", $duplicate['duplicate']['state_department']);
                $data[] = $duplicate['duplicate'];
            }

            if (in_array('Renewal', $serviceType)) {

                $renewal['renewal'] = $_POST['renewal'];

                $renewal['renewal']['service_type'] = "Renewal";
				 $renewal['renewal']['servicetype_additionalsubservice'] = '6';
                  if(!empty($renewal['renewal']['list_professional']))
                $renewal['renewal']['list_professional'] = implode(",", $renewal['renewal']['list_professional']);
				if(!empty($renewal['renewal']['central_department']))
                $renewal['renewal']['central_department'] = implode(",", $renewal['renewal']['central_department']);
				if(!empty($renewal['renewal']['state_department']))
                $renewal['renewal']['state_department'] = implode(",", $renewal['renewal']['state_department']);
                $data[] = $renewal['renewal'];
            }

            if (in_array('Return', $serviceType)) {
                $return['return'] = $_POST['return'];
                $return['return']['service_type'] = "Return";
				$return['return']['servicetype_additionalsubservice'] = '7';
                 if(!empty($return['return']['list_professional']))
                $return['return']['list_professional'] = implode(",", $return['return']['list_professional']);
				if(!empty($return['return']['central_department']))
                $return['return']['central_department'] = implode(",", $return['return']['central_department']);
				if(!empty($return['return']['state_department']))
                $return['return']['state_department'] = implode(",", $return['return']['state_department']);
                $data[] = $return['return'];
            }

            if (in_array('Maintenance of Register', $serviceType)) {
                $maintainence['maintainence'] = $_POST['maintainence'];
                $maintainence['maintainence']['service_type'] = "Maintenance of Register";
				$maintainence['maintainence']['servicetype_additionalsubservice'] = '8';
                  if(!empty($maintainence['maintainence']['list_professional']))
                $maintainence['maintainence']['list_professional'] = implode(",", $maintainence['maintainence']['list_professional']);
				if(!empty($maintainence['maintainence']['central_department']))
                $maintainence['maintainence']['central_department'] = implode(",", $maintainence['maintainence']['central_department']);
				if(!empty($maintainence['maintainence']['state_department']))
                $maintainence['maintainence']['state_department'] = implode(",", $maintainence['maintainence']['state_department']);
                $data[] = $maintainence['maintainence'];
            }
			//print_r($data);
			 $status = "";
			  foreach ($data as $key => $datasave) { 
			     $model=new BoInfowizardServiceStackholder;
			     $model->attributes = $datasave;
			     $model->service_id = $serviceID;
				 $model->created = date('Y-m-d H:m:s');
				 $model->modified = date('Y-m-d H:m:s');
               // print_r($model->attributes); 
			   if ($model->save()) { $status = $status . ", " . $datasave['service_type']; }
            }
			
            if ($status != "") {
                Yii::app()->user->setFlash('Success', "Service Stackholder for $status has been saved");
            } else {
                Yii::app()->user->setFlash('Error', "Service Stackholder saving failed");
            }
            $serviceFeeURL = "/infowizard/ServiceValidity/create/serviceID/$serviceID";
            $this->redirect(Yii::app()->createUrl($serviceFeeURL));

           // print_r($data); die;
		}
		$sql = "SELECT * from bo_infowizard_service_stackholder where service_id=$serviceID";
		$command=$connection->createCommand($sql);
		$ServiceStakeholder=$command->queryAll();	
              if(!empty($ServiceStakeholder)){
                foreach($ServiceStakeholder as $key=>$params){
                    $service_type=$params['service_type'];
                    if($key==0){
                        $_SESSION['ServiceStakeholder']["service"]=$params; 
                    }else{
                 $_SESSION['ServiceStakeholder'][$service_type]=$params;   
                    }
                }   
                }else{
                    $_SESSION['ServiceStakeholder']="";
                }


		$this->render('create',array("serviceData" => $serviceData,"professionaldata"=>$professionaldata));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['BoInfowizardServiceStackholder']))
		{
			$model->attributes=$_POST['BoInfowizardServiceStackholder'];
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
		$dataProvider=new CActiveDataProvider('BoInfowizardServiceStackholder');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new BoInfowizardServiceStackholder('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['BoInfowizardServiceStackholder']))
			$model->attributes=$_GET['BoInfowizardServiceStackholder'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return BoInfowizardServiceStackholder the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=BoInfowizardServiceStackholder::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param BoInfowizardServiceStackholder $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='bo-infowizard-service-stackholder-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
