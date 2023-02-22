<?php

class LandrequesterContactController extends Controller
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
		$model=new BoLandrequesterContact;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
      $guestUserUrl="";
      // Checking and redirecting if not passed landID
          if(empty($_GET['landID'])){
             // echo "here";die;
             $url="/backoffice/iloc/landrequesterConnect/create";
              $this->redirect($url);
          }
		if(isset($_POST['BoLandrequesterContact']))
		{ //echo $_GET['landID'];die;
	               	$model->attributes=$_POST['BoLandrequesterContact'];
                      // Saving current loggedin User
									 $_SESSION['BoLandrequesterContact'] =$_POST['BoLandrequesterContact'];
                   if(!empty($_SESSION['RESPONSE']['user_id'])){
                      $model->user_id=$_SESSION['RESPONSE']['user_id'];
                      // Setting redirection for guest User // 25012018
										}else if(isset($_SESSION['uid']) && !empty($_SESSION['uid'])){
											  $model->user_id=$_SESSION['uid'];
										}else{
                          $guestUserUrl="/type/frontend";
													if(isset($_SESSION['land_guest_user_id']) && !empty($_SESSION['land_guest_user_id'])){
                               $model->user_id  =$_SESSION['land_guest_user_id'];
													 }
                     }

                        // decoding and saving land ID here
			            $model->land_id= base64_decode($_GET['landID']);
							    if($model->save()){
				                   // After saving successfully , setting url for redirecting
													if($model->land_id){
																$sql    = "SELECT * FROM bo_landowner_requester_connect  where id=$model->land_id";
									              $allData=Yii::app()->db->createCommand($sql)->queryRow();
                                $landowner_requester_id =$allData['id'];
                               //echo $landowner_requester_id;die;
                                //$_SESSION['land_seach'] =$allData;
																if((isset($_SESSION['land_guest_user_id']) && !empty($_SESSION['land_guest_user_id']) ) && $allData['user_type']=='Guest'){
																	 $land_guest_user_id = $_SESSION['land_guest_user_id']; // jitendra singh:  12/feb/2018
																	 $connection = Yii::app()->db;
								                   $connection->createCommand("UPDATE bo_landowner_requester_connect SET  user_id=$land_guest_user_id where id=$landowner_requester_id")->execute();
																	// $connection->createCommand("UPDATE bo_landowner_contact SET  user_id=$land_guest_user_id where id=$model->id")->execute();
																}
																$district_id =$allData['district_id']?$allData['district_id']:'';
																$sub_district_id =$allData['sub_district_id']?$allData['sub_district_id']:'';
																$village =$allData['village']?$allData['village']:'';
																$option  =''; //area_sqmt ,area_type, land_title
																$type_of_land =$allData['type_of_land']?"/type_of_land/".$allData['type_of_land']:'';
																$option .=$allData['type_of_land']?"/type_of_land/".$allData['type_of_land']:'';
																$option .=$allData['is_sale']?"/is_sale/".$allData['is_sale']:'';
																$option .=$allData['is_lease']?"/is_lease/".$allData['is_lease']:'';
																$option .=$allData['area_sqmt']?"/area_sqmt/".$allData['area_sqmt']:'';
																$option .=$allData['area_type']?"/area_type/".$allData['area_type']:'';
																$option .=$allData['land_title']?"/land_title/".$allData['land_title']:'';
																Yii::app()->user->setFlash('Success', "Your land requirements has been published successfully. Based on your requirements, below are few lands available in which you might be interested.");
														   // $url="/backoffice/iloc/property/listing/district/$district_id/tehsil/$sub_district_id/village/$village".$option;
															  $url="/backoffice/iloc/property/listing/district/$district_id/type_of_land/$type_of_land";
													 }
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
		//echo $id;die;

    $sql = "SELECT * FROM bo_landowner_requester_contact  where land_id=$id";
		$allData=Yii::app()->db->createCommand($sql)->queryRow();
    $model=$this->loadModel($allData['id']);

		if(isset($_POST['BoLandrequesterContact']))
		{
                    $guestUserUrl="";
                        if(empty($_SESSION['RESPONSE']['user_id'])){
                             // Setting redirection for guest User // 25012018
                                $guestUserUrl="/type/frontend";
                           }

			                $model->attributes=$_POST['BoLandrequesterContact'];
											 //echo "<pre/>";
												//print_r($model);die;

                        if($model->save()){
												//	echo "<pre/>";
													//print_r($model);die;
                                // After saving successfully , setting url for redirecting
																if($model->land_id){
																			$sql    = "SELECT * FROM bo_landowner_requester_connect  where id=$model->land_id";
												              $allData=Yii::app()->db->createCommand($sql)->queryRow();
																			$district_id =$allData['district_id']?$allData['district_id']:'';
																			$sub_district_id =$allData['sub_district_id']?$allData['sub_district_id']:'';
																			$village =$allData['village']?$allData['village']:'';
																			$option  =''; //area_sqmt ,area_type, land_title
																			$type_of_land =$allData['type_of_land']?"/type_of_land/".$allData['type_of_land']:'';
																			$option .=$allData['type_of_land']?"/type_of_land/".$allData['type_of_land']:'';
																			$option .=$allData['is_sale']?"/is_sale/".$allData['is_sale']:'';
																			$option .=$allData['is_lease']?"/is_lease/".$allData['is_lease']:'';
																			$option .=$allData['area_sqmt']?"/area_sqmt/".$allData['area_sqmt']:'';
																			$option .=$allData['area_type']?"/area_type/".$allData['area_type']:'';
																			$option .=$allData['land_title']?"/land_title/".$allData['land_title']:'';
																			Yii::app()->user->setFlash('Success', "Your land requirements have been published successfully. Based on your requirements, below are few lands available in which you might be interested.");
																	   // $url="/backoffice/iloc/property/listing/district/$district_id/tehsil/$sub_district_id/village/$village".$option;
																		  $url=	"/backoffice/iloc/property/listing/district/$district_id/type_of_land/$type_of_land";
																 }
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
		$model=BoLandrequesterContact::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param BoLandrequesterContact $model the model to be validated
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
