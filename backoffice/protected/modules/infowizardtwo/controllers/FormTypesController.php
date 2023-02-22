<?php

class FormTypesController extends Controller

{

	/**

	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning

	 * using two-column layout. See 'protected/views/layouts/column2.php'.

	 */

	 public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index', 'view', 'getDataByCategory'),
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
	
	 

	public function actionView($id)
	{
        $model=$this->loadModel($id); 
		$this->render('view',array('model'=>$model));

	} 

	/**

	 * Creates a new model.

	 * If creation is successful, the browser will be redirected to the 'view' page.

	 */

	public function actionCreate()
     {   
       
	   //echo "hi..";die;	 
	    $model=new FormTypes;
		 
        if(!empty($_POST))
		{   
			 $model->form_type =$_POST['FormTypes']['form_type']; 
			 $model->is_active =$_POST['FormTypes']['is_active'];
			 $model->created   =date('Y-m-d h:i:s'); 
			// $model->save();
			 //print_r($model->getErrors());die;
			 if($model->save()){
				 $this->redirect(array('index'));
			 } 
             
        }
		
		 
        
		   $this->render('create',array(

				'model'=>$model,

			)); 

	} 

	public function actionUpdate($id)
	{ 
	
	    @session_start(); 
        $model=$this->loadModel($id); 
        $application=$this->getFormTypesData();
       
        if(!empty($_POST))
		{  
     		//print_r($_POST['FormType']['form_name']); die;

             //$model->service_id=$_POST['service_id'];  
			 //$model->dept_id   =$_POST['dept_id'];
			 $model->form_type =$_POST['FormTypes']['form_type']; 
			 $model->is_active =$_POST['FormTypes']['is_active'];
			 $model->modified  =date('Y-m-d h:i:s'); 
			 //$formType->save();
			 //print_r($formType->getErrors());die;
			 if($model->save()){
				 $this->redirect(array('index'));
			 } 
			 
        } 

        $this->render('update',array('model'=>$model,'apps'=>$application,));

    }
 

	/**

	 * Deletes a particular model.

	 * If deletion is successful, the browser will be redirected to the 'admin' page.

	 * @param integer $id the ID of the model to be deleted

	 */



	

	public function actionIndex()

	{   @session_start();
	     $uid=$_SESSION['uid']; 

		$application=$this->getFormTypesData();
         
		//print_r($application); die;

		$this->render('index',array(

			'apps'=>$application,

		));

	}

    
/**

	 * Lists all models.

	 */
	 
  public function getFormTypesData()
	{   
 
	    $formsData =Yii::app()->db->createCommand("SELECT  * FROM  bo_infowiz_forms_type  WHERE is_active='Y' ")->queryAll(); 
		if($formsData===false)
		return false;
		return $formsData; 
    }

	 

 
	public function loadModel($id)

	{

		$model= FormTypes::model()->findByPk($id);

		if($model===null)

			throw new CHttpException(404,'The requested page does not exist.');

		return $model;

	} 
	
	protected function getDepartmentName($dept_id){
		 
		//echo "hi..";die;	 
		$sql_d = "SELECT name FROM bo_infowizard_issuerby_master WHERE is_issuerby_active='Y' AND issuer_id='2' AND issuerby_id=$dept_id ";
		$connection=Yii::app()->db; 
		$command=$connection->createCommand($sql_d);
		$res_d = $command->queryRow(); 
		return $res_d['name'];
	}
	 
   	protected function getServiceName($s_id,$sub_id){ 
		 
		$sql_d = "SELECT core_service_name FROM bo_information_wizard_service_parameters WHERE service_id=$s_id AND servicetype_additionalsubservice=$sub_id AND is_active='Y' ORDER BY id DESC limit 1";
		$connection=Yii::app()->db; 
		$command=$connection->createCommand($sql_d);
		$res_d = $command->queryRow(); 
		return $res_d['core_service_name'];
	}
	 


}

