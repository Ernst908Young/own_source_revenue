<?php

class NicMasterController extends Controller
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
				'actions'=>array('index','view','getniclevel'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('*'),
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
		$model=new NicMaster;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['NicMaster']))
		{
			$model->attributes=$_POST['NicMaster'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}
$nicData=$this->getniclevel();
		$this->render('create',array(
			'model'=>$model,'nicData'=>$nicData
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

		if(isset($_POST['NicMaster']))
		{
			$model->attributes=$_POST['NicMaster'];
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
		$dataProvider=new CActiveDataProvider('NicMaster');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new NicMaster('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['NicMaster']))
			$model->attributes=$_GET['NicMaster'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return NicMaster the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=NicMaster::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param NicMaster $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='nic-master-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
        function  getniclevel(){
            $n="";
             $sql="SELECT * FROM bo_nic_master where parent_id=0 ORDER BY code ASC";
		$connection=Yii::app()->db; 
		$command=$connection->createCommand($sql);
		$nicMasterData=$command->queryAll();
                foreach($nicMasterData as $key=>$niclevel1){
                    $p_id=$niclevel1['id'];
                     $sql="SELECT * FROM bo_nic_master where parent_id=$p_id ORDER BY code ASC";
		$connection=Yii::app()->db; 
		$command=$connection->createCommand($sql);
		$nicMasterlevel2=$command->queryAll();
                $n[$key]=$niclevel1;
                $n[$key]['level1']=$nicMasterlevel2;
                //Level 3
                    if(!empty($nicMasterlevel2)){  
                        foreach($nicMasterlevel2 as $keylevel2=>$niclevel3){
                    $p_idl2=$niclevel3['id'];
                     $sql="SELECT * FROM bo_nic_master where parent_id=$p_idl2 ORDER BY code ASC";$connection=Yii::app()->db; 
		$command=$connection->createCommand($sql);$nicMasterlevel3=$command->queryAll();
               
                $n[$key]['level1'][$keylevel2]['level2']=$nicMasterlevel3;
                //Level 4
                 if(!empty($nicMasterlevel3)){  foreach($nicMasterlevel3 as $keylevel3=>$niclevel4){
                    $p_idl3=$niclevel4['id'];
                     $sql="SELECT * FROM bo_nic_master where parent_id=$p_idl3 ORDER BY code ASC";
		$connection=Yii::app()->db; 
		$command=$connection->createCommand($sql);
		$nicMasterlevel4=$command->queryAll();
               
                $n[$key]['level1'][$keylevel2]['level2'][$keylevel3]['level3']=$nicMasterlevel4;
                      //Level 5
                 if(!empty($nicMasterlevel4)){ foreach($nicMasterlevel4 as $keylevel4=>$niclevel5){
                    $p_idl4=$niclevel5['id'];
                     $sql="SELECT * FROM bo_nic_master where parent_id=$p_idl4 ORDER BY code ASC";
		$connection=Yii::app()->db; 
		$command=$connection->createCommand($sql);
		$nicMasterlevel5=$command->queryAll();
               
                $n[$key]['level1'][$keylevel2]['level2'][$keylevel3]['level3'][$keylevel4]['level4']=$nicMasterlevel5;
                    
                  }}
                    }}
                }}
                }
              //  echo "<pre>";                print_r($n);die;
		return $n;
             /*   $this->render('index',array(
			'actMasterData'=>$actMasterData,
		));*/
            
        }
}
