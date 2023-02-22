<?php

class FormBuilderConfigurationController extends Controller
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
				'actions'=>array('index','view','create','update','makeEntries'),
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
		$model=new FormBuilderConfiguration;
                if(isset($_POST['FormBuilderConfiguration'])){
                   // print_r($_POST['FormBuilderConfiguration']);die; 
                    $model->attributes=$_POST['FormBuilderConfiguration'];
                    if(is_array($_POST['FormBuilderConfiguration']['permissable_tab_form_id'])){
                       $model->permissable_tab_form_id = implode(",",$_POST['FormBuilderConfiguration']['permissable_tab_form_id']); 
                    }
                    if($model->save()){
                    print_r($model->attributes);die;} 
                }

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);


			/*$model->attributes=$_POST['ServiceFormMapping'];
			$model->created = date("Y-m-d h:i:s");
			$model->form_code = "Test-Form-code-01";
			$model->modified = date('Y-m-d H:i:s');
			$model->form_version = "V1";

			if($model->save()){
				$modelupdate = $this->loadModel($model->id, 'ServiceFormMapping');
				$service_data = explode(".", $model->service_id);
				$form_id = $model->id;
				$form_type_id = $model->form_type_id;
				$serviceID=$model->service_id;
				$ServiceEntry=Yii::app()->db->createCommand("SELECT * FROM bo_infowiz_form_mapping where service_id='$serviceID' and is_active='Y'")->queryAll();
				$serviceCount=count($ServiceEntry);
				$countinformcode=$serviceCount;
				$form_code = 'UK-SR-' . str_pad($service_data['0'], 3, '0', STR_PAD_LEFT) . '_' . str_pad($service_data['1'], 2, '0', STR_PAD_LEFT) . '-FRM-' . str_pad($countinformcode, 2, '0', STR_PAD_LEFT) . "_" . str_pad($form_type_id, 2, '0', STR_PAD_LEFT);
				$modelupdate->form_code = $form_code;
				if ($modelupdate->update()) {
					Yii::app()->user->setFlash('Success', "Form type has been mapped with Service");
				} else {
					die(var_dump($model->getErrors()));
					Yii::app()->user->setFlash('Error', "Data not saved, Please check.");
				}
				$this->redirect(array('view','id'=>$model->id));
			}*/
		               
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
        
        public function actionMakeEntries(){
           //  die; 
            
           // if(!isset($_GET['bn'])){die('tem blocked');} 
           
            if(isset($_GET['newpage']) && isset($_GET['sid'])){ 
            $previous_entries = Yii::app()->db->createCommand("SELECT * FROM bo_information_wizard_form_builder WHERE service_id = '121.0' and page_name = '".$_GET['newpage']."'")->queryAll();  
            if(!empty($previous_entries)){
                //die("entries already exist"); 
            }
            $existing_entries = Yii::app()->db->createCommand("SELECT * FROM bo_information_wizard_form_builder WHERE service_id = '591.0' and page_name in ('1')")->queryAll(); 
            //echo "<pre>";print_r($existing_entries);die;
            
            foreach($existing_entries as $entries){
                 $existing_entries = Yii::app()->db->createCommand("insert into bo_information_wizard_form_builder(service_id,form_id,page_name,category_id,category_preference,caption_slug,helptext,sub_form,form_field_id,input_type,is_with_caf,max_length,is_required,validation_rule,"
                         . "row_type,preference,is_editable,is_active,created,modified) values('".$_GET['sid']."','".$entries['form_id']."','".$_GET['newpage']."','".$entries['category_id']."','".$entries['category_preference']."','".$entries['caption_slug']."','".$entries['helptext']."','".$entries['sub_form']."','".$entries['form_field_id']."','".$entries['input_type']."','".$entries['is_with_caf']."','".$entries['max_length']."','".$entries['is_required']."','".$entries['validation_rule']."','".$entries['row_type']."','".$entries['preference']."','".$entries['is_editable']."','".$entries['is_active']."','".$entries['created']."','".$entries['modified']."') ")->execute();
                 
            } 
            
            $cat_entries = $existing_entries = Yii::app()->db->createCommand("SELECT * FROM bo_page_category_mapping WHERE page_id = '141' and is_active = 'Y'")->queryAll(); 
            foreach($cat_entries as $entries){
                $existing_entries = Yii::app()->db->createCommand("insert into bo_page_category_mapping(page_id,category_id,prefrence,help_text,is_active) values('".$_GET['newpage']."','".$entries['category_id']."','".$entries['prefrence']."','".$entries['help_text']."','".$entries['is_active']."') ")->execute();
                  
            }
            echo "done";
            }else{ die("Please provide both parameters");}   
            
            }
}
