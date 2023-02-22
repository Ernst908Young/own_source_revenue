<?php

class CafTemplatesController extends Controller
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
    /* public function accessRules()
    {
        return array(
            array('allow',  // allow all users to perform 'index' and 'view' actions
                'actions'=>array('index','view'),
                'users'=>array('*','DefaultUtility::isInfoWizardAdmin()'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions'=>array('create','update'),
                'users'=>array('@','DefaultUtility::isInfoWizardAdmin()'),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions'=>array('admin','delete'),
                'users'=>array('admin','DefaultUtility::isInfoWizardAdmin()'),
            ),
            array('deny',  // deny all users
                'users'=>array('*'),
            ),
        );
    } */

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id)
    {
		$sql = "SELECT *,bo_departments.department_name,bo_roles.role_name FROM bo_caf_templates left join bo_departments ON bo_departments.dept_id=bo_caf_templates.dept_id left join bo_roles ON bo_roles.role_id = bo_caf_templates.role_id where is_active='Y' AND bo_caf_templates.id=$id";
		$connection = Yii::app()->db;
		$command = $connection->createCommand($sql);
		$AllData = $command->queryRow();
        $this->render('view',array(
            'model'=>$this->loadModel($id),
			'allData'=>$AllData	
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate()
    {
        $model=new CafTemplates;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if(isset($_POST['CafTemplates']))
        {
            $model->attributes=$_POST['CafTemplates'];
            if($model->save())
                $this->redirect(array('view','id'=>$model->id));
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

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if(isset($_POST['CafTemplates']))
        {
            $model->attributes=$_POST['CafTemplates'];
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
        $dataProvider=new CActiveDataProvider('CafTemplates');
        $this->render('index',array(
            'dataProvider'=>$dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin()
    {
        $model = new CafTemplates('search');
        /*$model->unsetAttributes();  // clear any default values
        if(isset($_GET['CafTemplates']))
            $model->attributes=$_GET['CafTemplates'];
		
		echo "<pre>";
		print_r($model);die; */
		$sql = "SELECT *,bo_departments.department_name,bo_roles.role_name FROM bo_caf_templates left join bo_departments ON bo_departments.dept_id=bo_caf_templates.dept_id left join bo_roles ON bo_roles.role_id = bo_caf_templates.role_id where is_active='Y' ";
		$connection = Yii::app()->db;
		$command = $connection->createCommand($sql);
		$AllData = $command->queryAll();
        $this->render('admin',array('model'=>$model,'allData'=>$AllData));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return CafTemplates the loaded model
     * @throws CHttpException
     */
    public function loadModel($id)
    {
        $model=CafTemplates::model()->findByPk($id);
        if($model===null)
            throw new CHttpException(404,'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param CafTemplates $model the model to be validated
     */
    protected function performAjaxValidation($model)
    {
        if(isset($_POST['ajax']) && $_POST['ajax']==='caf-templates-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
}