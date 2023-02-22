<?php

class ServiceFormMappingController extends Controller
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
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view','create','update'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create1','update1'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
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
		$model=new ServiceFormMapping;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['ServiceFormMapping']))
		{
			 $model->attributes=$_POST['ServiceFormMapping'];
                         $model->created = date("Y-m-d h:i:s");
                         $model->form_code = "Test-Form-code-01";
                         $model->modified = date('Y-m-d h:i:s');;
                         $model->form_version = "V1";
                   
			if($model->save()){
                            $modelupdate = $this->loadModel($model->id, 'ServiceFormMapping');
                            $service_data = explode(".", $model->service_id);
                            $form_id = $model->id;
                            $form_type_id = $model->form_type_id;
                           $serviceID=$model->service_id;
                          // print_r($service_data);
                          // echo $form_type_id."====";
                         //  $serviceID='789.0';
			    $ServiceEntry=Yii::app()->db->createCommand("SELECT * FROM bo_infowiz_form_mapping where service_id='$serviceID' and is_active='Y'")->queryAll();
                            $serviceCount=count($ServiceEntry);
                           $countinformcode=$serviceCount;
                            // Form Code genration
                            // COde Provided: UK-SR-001_01-FRM-01_01
                            // Formula: UK-SR-000<SERVICE_ID>_0<SUBSERVICEID>-FRM-0<ActiveServiceFormCount+1>_0<FORMTYPEID>
                           // Genrated UK-SR-052_03-FRM-01_03 For Service ID : 52.3
                            $form_code = 'UK-SR-' . str_pad($service_data['0'], 3, '0', STR_PAD_LEFT) . '_' . str_pad($service_data['1'], 2, '0', STR_PAD_LEFT) . '-FRM-' . str_pad($countinformcode, 2, '0', STR_PAD_LEFT) . "_" . str_pad($form_type_id, 2, '0', STR_PAD_LEFT);
                            // Form Code Update goes here
                            // echo $form_code;die;
                           //  print_r($modelupdate);die;
                    $modelupdate->form_code = $form_code;
                 
                    if ($modelupdate->update()) {
                        Yii::app()->user->setFlash('Success', "Form type has been mapped with Service");
                    } else {
                        die(var_dump($model->getErrors()));
                        Yii::app()->user->setFlash('Error', "Data not saved, Please check.");
                    }
				$this->redirect(array('view','id'=>$model->id));
                        }
		}

		
                
		$this->render('create',array(
			'model'=>$model
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

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['ServiceFormMapping']))
		{
			$model->attributes=$_POST['ServiceFormMapping'];
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
		$dataProvider=new CActiveDataProvider('ServiceFormMapping');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new ServiceFormMapping('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['ServiceFormMapping']))
			$model->attributes=$_GET['ServiceFormMapping'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return ServiceFormMapping the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=ServiceFormMapping::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param ServiceFormMapping $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='service-form-mapping-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
