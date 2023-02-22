<?php

class LandownerContactController extends Controller
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
		$model=new BoLandownerContact;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
                $guestUserUrl="";
                // Checking and redirecting if not passed landID
                    if(empty($_GET['landID'])){
                       // echo "here";die;
                       $url="/backoffice/iloc/landownerConnect/create";
                        $this->redirect($url); 
                    }
		if(isset($_POST['BoLandownerContact']))
		{ //echo $_GET['landID'];die;
			$model->attributes=$_POST['BoLandownerContact'];
                        // Saving current loggedin User
                            if(!empty($_SESSION['RESPONSE']['user_id'])){
                            $model->user_id=$_SESSION['RESPONSE']['user_id'];
                            // Setting redirection for guest User // 25012018
                           }else{
                                $guestUserUrl="/type/frontend";
                           }
                        // decoding and saving land ID here
			$model->land_id= base64_decode($_GET['landID']);                       
			if($model->save()){
                            // After saving successfully , setting url for redirecting 
                            $url="/backoffice/iloc/landownerConnect/pinLocation/landID/".$_GET['landID']."$guestUserUrl";
				$this->redirect($url);
                        }
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
          
            $id= base64_decode($id);
		

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
                  
                
                $sql = "SELECT * FROM bo_landowner_contact  where land_id=$id";
		$allData=Yii::app()->db->createCommand($sql)->queryRow();
                $model=$this->loadModel($allData['id']);
			      
		if(isset($_POST['BoLandownerContact']))
		{
                    $guestUserUrl="";
                        if(empty($_SESSION['RESPONSE']['user_id'])){
                             // Setting redirection for guest User // 25012018
                                $guestUserUrl="/type/frontend";
                           }
                            
			$model->attributes=$_POST['BoLandownerContact'];
                       
                        if($model->save()){
                                // After saving successfully , setting url for redirecting 
                            $url="/backoffice/iloc/landownerConnect/pinLocation/landID/". base64_encode($id).$guestUserUrl;
				$this->redirect($url);
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
		$dataProvider=new CActiveDataProvider('BoLandownerContact');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new BoLandownerContact('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['BoLandownerContact']))
			$model->attributes=$_GET['BoLandownerContact'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return BoLandownerContact the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=BoLandownerContact::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param BoLandownerContact $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='bo-landowner-contact-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
