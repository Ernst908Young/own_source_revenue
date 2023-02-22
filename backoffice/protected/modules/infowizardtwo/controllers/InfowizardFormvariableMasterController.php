<?php

class InfowizardFormvariableMasterController extends Controller
{
	/**
    * This function is used to get the Form Field Master
     * @Author: Rahul Kumar
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
				'actions'=>array('admin','create','update','listformfield','viewlist'),
				'expression'=>'RolesExt::isAdminUser()',
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','create','update','listformfield','viewlist','slugify','makeparentchildidakeparentchildid'),
				'expression'=>'DefaultUtility::isInfoWizardAdmin()',
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','create','update','listformfield','viewlist','slugify','makeparentchildidakeparentchildid'),
				'expression'=>'DefaultUtility::isIwDataEntry()',
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
	public function actionViewlist($id)
	{
		//echo  "here";die;
		$this->render('viewlist',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page. 
	 */
	  public function actionListformfield()
	{
		@session_start();
		if(!Yii::app()->user->isGuest){
			throw new CHttpException(400, "you can't access this page");
		}
		/*if(!$_SESSION['LOGGED_IN']) { //print_r(ghghghg); //$this->redirect(SSO_URL1);  
		}*/
			
		
		$applications=InfowizardQuestionMasterExt::getIWListFormfield();
		//print_r($applications); die;
		$this->render("listformfield",array("apps"=>$applications));
	}
	public function actionCreate()
	{
		$model=new InfowizardFormvariableMaster;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['InfowizardFormvariableMaster']))
		{
			$latestParent=Yii::app()->db->createCommand("SELECT formvar_id from bo_infowizard_formvariable_master where parent_id=0 Order By formvar_id DESC")->queryAll();
			if(!empty($latestParent))
			$yh=count($latestParent)+1;
		    else
			$yh=1;
			$model->attributes=$_POST['InfowizardFormvariableMaster'];
			$model->formchk_id="TEMP-FCL-".$model->parent_id."-".strtotime(date('Y-m-d H:i:s'));
			$model->created_date=date('Y-m-d H:m:s');
			$model->category_id=$_POST['InfowizardFormvariableMaster']['category_id'];
                        //print_r($model);die;
			if($model->save()){
			$modelupdate=$this->loadModel($model->formvar_id); 
			$parentID=$model->parent_id;
			 if($parentID<1){
			$genratedIdWithLeadingZero=str_pad( $yh , 5, '0', STR_PAD_LEFT);
			$modelupdate->formchk_id="UK-FCL-".@$genratedIdWithLeadingZero."_0";;
			}else{		
                         $allChlid = Yii::app()->db->createCommand("SELECT * from bo_infowizard_formvariable_master where parent_id=".$parentID." ORDER BY parent_id DESC")->queryAll();
		       // print_r($allChlid);die;
			if(!empty($allChlid[0]['formchk_id'])){
				$allcountofchild=count($allChlid);
			}else{
				$allcountofchild=0;
			}
			$latestParent=Yii::app()->db->createCommand("SELECT * from bo_infowizard_formvariable_master where formvar_id=".$parentID." Order By formvar_id DESC")->queryRow();
			//print_r($latestParent);die;
			//echo $allcountofchild;
                       $latestParent['formchk_id']= str_replace("_0","",$latestParent['formchk_id']);
			$modelupdate->formchk_id=@$latestParent['formchk_id']."_".($allcountofchild);
			}
			if($modelupdate->update()){
				$this->redirect(array('create'));
			}else{
			//die(var_dump($modelupdate->getErrors()));
			}
		}else{
			 //die(var_dump($model->getErrors())); 
		}
		}
        $NoRow = InfowizardQuestionMasterExt::getNorowformfieldlistForInfoWizard();
    	$count=$NoRow[0]['count']; 
		$check=1;
                $applications=InfowizardQuestionMasterExt::getIWListFormfield();
		//print_r($applications); die;
		//$this->render("listformfield",array("apps"=>$applications));
		$this->render('create',array(
			'model'=>$model,
			'countid'=>$count,
			'check'=>$check,
			"apps"=>$applications,
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

		if(isset($_POST['InfowizardFormvariableMaster']))
		{
			$model->attributes=$_POST['InfowizardFormvariableMaster'];
			if($model->save())
				$this->redirect(array('create'));
		}
        $check=2;
		$this->render('update',array(
			'model'=>$model,
			'check'=>$check,
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
		$dataProvider=new CActiveDataProvider('InfowizardFormvariableMaster');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new InfowizardFormvariableMaster('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['InfowizardFormvariableMaster']))
			$model->attributes=$_GET['InfowizardFormvariableMaster'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return InfowizardFormvariableMaster the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=InfowizardFormvariableMaster::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param InfowizardFormvariableMaster $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='infowizard-formvariable-master-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
			/* 
		* @Author : Rahul Kumar
		* @Date   : 06042018
		* @Description :  It will slugify a string 
		*/
			 public function actionSlugify($text=null)
			{
				
				//print_r($_POST['InfowizardFormvariableMaster']['name']);
				//$text="testAadsfdf^$#%$^&%&**897&(*&~!!@@#$%^&";
				// Testing by static test
				$text="jnjckvnuioh se7485982tut2 hgivnjnf23483414 23452436357 46#@!$!#@$ $%T~~@$%(*kjhjjkhj";
			  // replace non letter or digits by -
			  $text = preg_replace('~[^\pL\d]+~u', '_', $text);

			  // transliterate
			  $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

			  // remove unwanted characters
			  $text = preg_replace('~[^-\w]+~', '', $text);

			  // trim
			  $text = trim($text, '-');

			  // remove duplicate -
			  $text = preg_replace('~-+~', '_', $text);

			  // lowercase
			  $text = strtolower($text);

			  if (empty($text)) {
				return 'n-a';
			  }

			  echo  $text; die;
			  $this->render('slugify');
			}
			
			static function makeparentchildidakeparentchildid($value){
			$genratedIdWithLeadingZero=str_pad($value, 5, '0', STR_PAD_LEFT);
				echo $genratedIdWithLeadingZero;die;
			}
		

}
