<?php

class ActMasterController extends Controller
{
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
	public function accessRules()
	{
		return array(	
			
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('create','update','index','view'),
				'expression'=>'DefaultUtility::isInfoWizardAdmin()',
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('create','update','index','view'),
				'expression'=>'RolesExt::isIwDataEntry()',
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
		$model=new BoInformationWizardActMaster;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(!empty($_POST))
		{      //  print_r($_POST); die;
		if($_FILES['act_path_internal_english']['type'] == 'application/pdf' && $_FILES['act_path_internal_english']['name']!='' && 
		$_FILES['act_path_internal_english']['size']<=(1024*1024*100) )
		  {                 
		//$path = Yii::app()->basePath."/acts/";
		$path = Yii::app()->basePath."/../../themes/backend/acts/";
		$nname = "act_english".time().".pdf";
		move_uploaded_file($_FILES['act_path_internal_english']['tmp_name'], $path.$nname);
		$act_path_internal_english = "/themes/backend/acts/".$nname;
		  }
		else {  $act_path_internal_english=""; }
		
		if($_FILES['act_path_internal_hindi']['type'] == 'application/pdf' && $_FILES['act_path_internal_hindi']['name']!='' && 
		$_FILES['act_path_internal_hindi']['size']<=(1024*1024*100) )
		  {                 
		//$path = Yii::app()->basePath."/acts/";
		$path = Yii::app()->basePath."/../../themes/backend/acts/";
		$nname = "act_hindi".time().".pdf";
		move_uploaded_file($_FILES['act_path_internal_hindi']['tmp_name'], $path.$nname);
		$act_path_internal_hindi = "/themes/backend/acts/".$nname;
		  }
		else {  $act_path_internal_hindi=""; }
		
		          $model->attributes=$_POST;
				  $model->user_id=$_SESSION['uid'];
				   $model->type=$_POST['type'];
				  $model->act_path_internal_hindi=$act_path_internal_hindi;
			       $model->act_path_internal_english=$act_path_internal_english;
				   if(!empty(@$_POST['relevent_departments_state'])){
				   $releventdepartments_state=implode(",", @$_POST['relevent_departments_state']); } else { $releventdepartments_state="";}
				   if(!empty(@$_POST['relevent_departments_central'])){
				   $releventdepartments_central=implode(",", @$_POST['relevent_departments_central']); } else { $releventdepartments_central="";}
				   $model->relevent_departments_state=$releventdepartments_state;
				   $model->relevent_departments_central=$releventdepartments_central;
                    $actName= str_replace(" ", "_",$_POST['act_name_english']);
					
		
             $model->created=date('Y-m-d h:i:s');
                //  echo "<pre>"; print_r($_POST);      print_r($model->attributes);die;
						 ////////////////////////////////////////////////////////
			$sqlbv="select * from  bo_information_wizard_act_master where act_type=:act_type11 and act_name_english=:act_name_english11";
		    $connection=Yii::app()->db; 
		    $command=$connection->createCommand($sqlbv);
			$command->bindParam(":act_type11",$_POST['act_type'],PDO::PARAM_INT);
			$command->bindParam(":act_name_english11",$actName,PDO::PARAM_INT);
		    $Fieldsaadssd=$command->queryAll(); 
			//print_r($Fieldsaadssd);
		    $aaaa=count($Fieldsaadssd);
			//die;
			if($aaaa==0)
			{
			if($model->save()) { $this->redirect(array('view','id'=>$model->id));
			Yii::app()->user->setFlash('Success', "Act Master Saved Successfully"); }
				}
			else { Yii::app()->user->setFlash('Failure', "Data Already Exist"); }	
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		if(!empty($_POST))
		{
			if($_FILES['act_path_internal_english']['type'] == 'application/pdf' && $_FILES['act_path_internal_english']['name']!='' && $_FILES['act_path_internal_english']['size']<=(1024*1024*100) )
			{                 
				//$path = Yii::app()->basePath."/acts/";
				$path = Yii::app()->basePath."/../../themes/backend/acts/";
				$nname = "act_english".time().".pdf";
				move_uploaded_file($_FILES['act_path_internal_english']['tmp_name'], $path.$nname);
				$act_path_internal_english = "/themes/backend/acts/".$nname;
			}
			else {  $act_path_internal_english=$model['act_path_internal_english']; }

			if($_FILES['act_path_internal_hindi']['type'] == 'application/pdf' && $_FILES['act_path_internal_hindi']['name']!='' && 
			$_FILES['act_path_internal_hindi']['size']<=(1024*1024*100) )
			{                 
				//$path = Yii::app()->basePath."/acts/";
				$path = Yii::app()->basePath."/../../themes/backend/acts/";
				$nname = "act_hindi".time().".pdf";
				move_uploaded_file($_FILES['act_path_internal_hindi']['tmp_name'], $path.$nname);
				$act_path_internal_hindi = "/themes/backend/acts/".$nname;
			}
			else { 
				$act_path_internal_hindi=$model['act_path_internal_hindi']; 
			}

			$model->attributes=$_POST;
			$model->act_path_internal_hindi=$act_path_internal_hindi;
			$model->act_path_internal_english=$act_path_internal_english;
			if(!empty($_POST['relevent_departments_state'])){
				$releventdepartments_state=implode(",", $_POST['relevent_departments_state']); 
			} 
			else { 
				$releventdepartments_state="";
			}
			if(!empty($_POST['relevent_departments_central'])){
				$releventdepartments_central=implode(",", $_POST['relevent_departments_central']); 
			} else { 
				$releventdepartments_central="";
			}
			$model->relevent_departments_state=@$releventdepartments_state;
			$model->relevent_departments_central=@$releventdepartments_central;
			$actName= str_replace(" ", "_",$_POST['act_name_english']);

			$model->modified=date('Y-m-d h:i:s');
			$model->priority=$_POST['set_priority'];
			$model->type=$_POST['type'];
			$model->act_type=$_POST['act_type'];
			$model->act_name_english=$_POST['act_name_english'];
                        $model->is_active=$_POST['is_active'];
			//print_r($_POST); print_r($model->attributes); die;
			 ////////////////////////////////////////////////////////
			$sqlbv="select * from  bo_information_wizard_act_master where  act_name_english=:act_name_english11 and id!=:id1";
		    $connection=Yii::app()->db; 
		    $command=$connection->createCommand($sqlbv);
			$command->bindParam(":id1",$id,PDO::PARAM_INT);
			//$command->bindParam(":act_type11",$_POST['act_type'],PDO::PARAM_INT);
			$command->bindParam(":act_name_english11",$actName,PDO::PARAM_INT);
		    $Fieldsaadssd=$command->queryAll(); 
			//print_r($Fieldsaadssd);
		    $aaaa=count($Fieldsaadssd);
			//die;
			if($aaaa==0)
			{
                            // print_r($model->attributes); die;
				if($model->save()) {  
					$this->redirect(array('view','id'=>$model->id));
					Yii::app()->user->setFlash('Success', "Act Master Updated Successfully"); 
				}
			}
			
			else { 			
                                 if($model->save()) {  
					$this->redirect(array('view','id'=>$model->id));
					Yii::app()->user->setFlash('Success', "Act Master Updated Successfully"); 
				}
				Yii::app()->user->setFlash('Failure', "Data Already Exist"); 
			}	
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
		/*$dataProvider=new CActiveDataProvider('BoInformationWizardActMaster');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));*/
            $sql="SELECT * FROM bo_information_wizard_act_master ORDER BY priority ASC";
		$connection=Yii::app()->db; 
		$command=$connection->createCommand($sql);
		$actMasterData=$command->queryAll();
		//return $users;
                $this->render('index',array(
			'actMasterData'=>$actMasterData,
		));
            
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new BoInformationWizardActMaster('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['BoInformationWizardActMaster']))
			$model->attributes=$_GET['BoInformationWizardActMaster'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return BoInformationWizardActMaster the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=BoInformationWizardActMaster::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param BoInformationWizardActMaster $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='bo-information-wizard-act-master-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
