<?php

class IssuerbyMasterController extends Controller
{
	/**
    * This function is used to get the IssuerBy Master
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
			
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('create','update','index','view','updateHeader'),
				'expression'=>'RolesExt::isAdminUser()',
			),
                    array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('create','update','index','view','updateHeader'),
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
	public function actionView($id)
	{
		$applications=InfowizardQuestionMasterExt::getViewIssuerBy($id);
		//print_r($applications); die;
		$this->render("view",array("apps"=>$applications));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new BoInfowizardIssuerbyMaster;
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['BoInfowizardIssuerbyMaster']))
		{
			$model->attributes=$_POST['BoInfowizardIssuerbyMaster'];
			//print_r($_POST['BoInfowizardIssuerbyMaster']); die;
			$sqlbv="select * from  bo_infowizard_issuerby_master where issuer_id=:issuer_id111 and name=:name111 and abb=:abb111";
		    $connection=Yii::app()->db; 
		    $command=$connection->createCommand($sqlbv);
			$command->bindParam(":issuer_id111",$_POST['BoInfowizardIssuerbyMaster']['issuer_id'],PDO::PARAM_INT);
			$command->bindParam(":name111",$_POST['BoInfowizardIssuerbyMaster']['name'],PDO::PARAM_INT);
			$command->bindParam(":abb111",$_POST['BoInfowizardIssuerbyMaster']['abb'],PDO::PARAM_INT);
		    $Fieldsaadssd=$command->queryAll(); 
			//print_r($Fieldsaadssd);
		    $aaaa=count($Fieldsaadssd);
			
			if($aaaa==0)
			{
			if($model->save())
			{
			$sql = "insert into bo_infowizard_issuer_mapping (issuer_id, issuerby_id, is_issmap_active) values (:issuer_id1, :issuerby_id1, :is_issmap_active1)";
            $parameters = array(":issuer_id1"=>$model->issuer_id, ':issuerby_id1' =>$model->issuerby_id, ':is_issmap_active1'=>'Y');
            Yii::app()->db->createCommand($sql)->execute($parameters);
			Yii::app()->user->setFlash('Success', "Data has been saved");
				$this->redirect(array('view','id'=>$model->issuerby_id));
			}
                
			}
			else { Yii::app()->user->setFlash('Failure', "Data Already Exist"); }	
		}

        $Issuer1[] = array('issuer_id'=>'','name'=>'--Select Issuer--');
    	$Issuer = InfowizardQuestionMasterExt::getIssuerForInfoWizard();
    	foreach($Issuer as $key=>$val){ $Issuer1[] = $val; } 
		
		//print_r($Issuer1);
		
		$this->render('create',array(
			'model'=>$model,
			'Issuerdata'=>$Issuer1,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id); // AND `issuer_id` = 2

		$sql="select * from  bo_infowizard_issuerby_master where issuerby_id=:id";
		$connection=Yii::app()->db; 
		$command=$connection->createCommand($sql);
		$command->bindParam(":id",$id,PDO::PARAM_INT);
		$Fields=$command->queryRow();
		
		$sqllll="select * from  bo_infowizard_issuer_mapping where issuerby_id=:issuerby_id11 and issuer_id=:issuer_id11";
		$connection=Yii::app()->db; 
		$command=$connection->createCommand($sqllll);
		$command->bindParam(":issuerby_id11",$id,PDO::PARAM_INT);
		$command->bindParam(":issuer_id11",$Fields['issuer_id'],PDO::PARAM_INT);
		$Fieldsaa=$command->queryRow();
	    $ss=$Fieldsaa['issmap_id']; 
		
	
		if(isset($_POST['BoInfowizardIssuerbyMaster']))
		{ // print_r($_FILES); die;
			if(!empty($_FILES)){ 
			
				if(in_array($_FILES['BoInfowizardIssuerbyMaster']['type']['left_department_logo'],array('image/jpg','image/jpeg','image/png')) && $_FILES['BoInfowizardIssuerbyMaster']['name']['left_department_logo']!='' && $_FILES['BoInfowizardIssuerbyMaster']['size']['left_department_logo']<=(1024*1024*5))
				{     
					$ext = pathinfo($_FILES['BoInfowizardIssuerbyMaster']['name']['left_department_logo']);
					//$path = "/var/www/html/themes/backend/departmentlogo/";
                                        $path = Yii::app()->basePath."/../../themes/backend/departmentlogo/";
                                        // echo $path;die;
					$nname = "Dept-LEFT-"."-".time().".".$ext['extension'];
					move_uploaded_file($_FILES['BoInfowizardIssuerbyMaster']['tmp_name']['left_department_logo'], $path.$nname);
					$pathUploaded = "/themes/backend/departmentlogo/".$nname;
					$_POST['BoInfowizardIssuerbyMaster']['left_department_logo'] = $pathUploaded;
				}
				
				if(in_array($_FILES['BoInfowizardIssuerbyMaster']['type']['middle_department_logo'],array('image/jpg','image/jpeg','image/png')) && $_FILES['BoInfowizardIssuerbyMaster']['name']['middle_department_logo']!='' && $_FILES['BoInfowizardIssuerbyMaster']['size']['middle_department_logo']<=(1024*1024*5))
				{     
					$ext = pathinfo($_FILES['BoInfowizardIssuerbyMaster']['name']['middle_department_logo']);
					//$path = "/var/www/html/themes/backend/departmentlogo/";
                                        $path = Yii::app()->basePath."/../../themes/backend/departmentlogo/";
                                        // echo $path;die;
					$nname = "Dept-MIDDLE-"."-".time().".".$ext['extension'];
					move_uploaded_file($_FILES['BoInfowizardIssuerbyMaster']['tmp_name']['middle_department_logo'], $path.$nname);
					$pathUploadedmid = "/themes/backend/departmentlogo/".$nname;
					$_POST['BoInfowizardIssuerbyMaster']['middle_department_logo'] = $pathUploadedmid;
				}
				
				if(in_array($_FILES['BoInfowizardIssuerbyMaster']['type']['right_department_logo'],array('image/jpg','image/jpeg','image/png')) && $_FILES['BoInfowizardIssuerbyMaster']['name']['right_department_logo']!='' && $_FILES['BoInfowizardIssuerbyMaster']['size']['right_department_logo']<=(1024*1024*5))
				{     
					$ext = pathinfo($_FILES['BoInfowizardIssuerbyMaster']['name']['right_department_logo']);
					$path = Yii::app()->basePath."/../../themes/backend/departmentlogo/";
                                                //$path = "/var/www/html/themes/backend/departmentlogo/";
					$nname = "Dept-RIGHT-"."-".time().".".$ext['extension'];
					move_uploaded_file($_FILES['BoInfowizardIssuerbyMaster']['tmp_name']['right_department_logo'], $path.$nname);
					$pathUploaded2 = "/themes/backend/departmentlogo/".$nname;
					$_POST['BoInfowizardIssuerbyMaster']['right_department_logo'] = $pathUploaded2;
				}				
				
			}
			/* echo "<pre>";
			print_r($_POST); */
			$model->attributes = $_POST['BoInfowizardIssuerbyMaster'];
			if(isset($pathUploaded) && !empty($pathUploaded))
			{
				$model->left_department_logo = $pathUploaded;
			}
			if(isset($pathUploadedmid) && !empty($pathUploadedmid))
			{
				$model->middle_department_logo = $pathUploadedmid;
			}
			if(isset($pathUploaded2) && !empty($pathUploaded2))
			{
				$model->right_department_logo = $pathUploaded2;
			}	
			
			/* print_r($model);die(); */
            $sqlbv="select * from  bo_infowizard_issuerby_master where issuer_id=:issuer_id111 and name=:name111 and abb=:abb111 and issuerby_id!=:issuerby_id111";
		    $connection=Yii::app()->db; 
		    $command=$connection->createCommand($sqlbv);
		    $command->bindParam(":issuerby_id111",$id,PDO::PARAM_INT);
			$command->bindParam(":issuer_id111",$_POST['BoInfowizardIssuerbyMaster']['issuer_id'],PDO::PARAM_INT);
			$command->bindParam(":name111",$_POST['BoInfowizardIssuerbyMaster']['name'],PDO::PARAM_INT);
			$command->bindParam(":abb111",$_POST['BoInfowizardIssuerbyMaster']['abb'],PDO::PARAM_INT);
		    $Fieldsaadssd=$command->queryAll(); 
			//print_r($Fieldsaadssd);
		    $aaaa=count($Fieldsaadssd);
			//die;
			if($aaaa==0)
			{	
				if($model->save()){ 					
					$sqlaa = "update bo_infowizard_issuer_mapping SET issuer_id=:issuer_id1 ,issuerby_id=:issuerby_id1 where issmap_id=:sss";
					$parametersaa = array(":issuer_id1"=>$model->issuer_id, ':issuerby_id1' => $id ,':sss' => $ss);
					$aa=Yii::app()->db->createCommand($sqlaa)->execute($parametersaa);

					Yii::app()->user->setFlash('Success', "Data has been Updated");
					$this->redirect(array('view','id'=>$model->issuerby_id));
				}
			}
			else {  Yii::app()->user->setFlash('Failure', "Data Already Exist"); }	
					
		}
		
		$Issuer1[] = array('issuer_id'=>'','name'=>'--Select Issuer--');
    	$Issuer = InfowizardQuestionMasterExt::getIssuerForInfoWizard();
    	foreach($Issuer as $key=>$val){ $Issuer1[] = $val; } 

		$this->render('update',array(
			'model'=>$model,
			'Issuerdata'=>$Issuer1
		));
	}
	
	public function actionUpdateHeader($id)
	{
		$model=$this->loadModel($id);
		
		$sql="select * from  bo_infowizard_issuerby_master where issuerby_id=:id";
		$connection=Yii::app()->db; 
		$command=$connection->createCommand($sql);
		$command->bindParam(":id",$id,PDO::PARAM_INT);
		$Fields=$command->queryRow();
		$leftImage = '';
		$rightImage = '';
		
		if(isset($Fields['left_department_logo']) && !empty($Fields['left_department_logo']))
		{
			$leftImage = "<img height='70px' width='70px' src='".'http://'.$_SERVER['SERVER_NAME'].$Fields['left_department_logo']."' >";
		}
		
		if(isset($Fields['right_department_logo']) && !empty($Fields['right_department_logo']))
		{
			$rightImage = "<img  height='70px' width='70px' src='".'http://'.$_SERVER['SERVER_NAME'].$Fields['right_department_logo']."'>";
		}
					
		$content = str_replace(array('{LEFT_DEPARTMENT_LOGO}','{RIGHT_DEPARTMENT_LOGO}'),array($leftImage,$rightImage),$Fields['header_content']); 
		
		if((strpos($Fields['header_content'], '{LEFT_DEPARTMENT_LOGO}') !== false) && isset($leftImage) && !empty($leftImage)) {				
			$content = str_replace(array('{LEFT_DEPARTMENT_LOGO}'),array($leftImage),$Fields['header_content']); 
		}else if((strpos($Fields['header_content'],'{RIGHT_DEPARTMENT_LOGO}') !== false) && isset($rightImage) && !empty($rightImage)) {			
			$content = str_replace(array('{RIGHT_DEPARTMENT_LOGO}'),array($rightImage),$Fields['header_content']); 
		}else{
			preg_match_all('/<img[^>]+>/i',$Fields['header_content'], $result);		
			if(isset($result[0][0]) && !empty($result[0][0]) && isset($leftImage) && !empty($leftImage))
			{	
				$content = str_replace(array($result[0][0]),array($leftImage),$Fields['header_content']);
			}
			if(isset($result[0][1]) && !empty($result[0][1]) && isset($rightImage) && !empty($rightImage))
			{	
				$content = str_replace(array($result[0][1]),array($rightImage),$Fields['header_content']);
			}
		}
		
		
		if(!empty($_POST))
		{
			if(isset($_POST['BoInfowizardIssuerbyMaster']['header_content']) && !empty($_POST['BoInfowizardIssuerbyMaster']['header_content']))
			{
				$model->header_content = $_POST['BoInfowizardIssuerbyMaster']['header_content'];
			}
			if($model->save()){ 
				Yii::app()->user->setFlash('Success', "Header content has been updated");
				$this->redirect(array('updateHeader','id'=>$model->issuerby_id));
			}
		}	
		
		$this->render('update_header',array('model'=>$model,'header_content'=>$content)); 
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
		$applications=InfowizardQuestionMasterExt::getListIssuerBy();
		//print_r($applications); die;
		$this->render("index",array("apps"=>$applications));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new BoInfowizardIssuerbyMaster('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['BoInfowizardIssuerbyMaster']))
			$model->attributes=$_GET['BoInfowizardIssuerbyMaster'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return BoInfowizardIssuerbyMaster the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=BoInfowizardIssuerbyMaster::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param BoInfowizardIssuerbyMaster $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='bo-infowizard-issuerby-master-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
