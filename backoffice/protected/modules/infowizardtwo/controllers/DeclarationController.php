<?php

class DeclarationController extends Controller

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
			$model=new Declarationmaster; 
			if(!empty($_POST));
			{   

		        $model->attributes = $_POST['Declarationmaster'];
		        $checkexist =Yii::app()->db->createCommand("SELECT  * FROM  bo_declaration_master  WHERE is_active=1 AND service_id=".$model->service_id)->queryRow();
		        if($checkexist){
		        	 Yii::app()->user->setFlash('error', "Declaration of this service is already created");
		        	 $this->redirect(array('index'));

		        }else{
		        	if($model->save()){				 
					 $this->redirect(array('index'));
				 } 
		        }
				// $model->save();
				 //print_r($model->getErrors());die;
				 
				 
			} 
        
		 

	} 

	public function actionUpdate($id)
	{ 
	
	    
         $model=$this->loadModel($id);  
         $application=$this->getFormTypesData();  
		 
        if(!empty($_POST)){  
		
     		//print_r($_POST['FormType']['form_name']); die;
			   /*if(isset($_POST['FormCategory']['parent_id']) && !empty($_POST['FormCategory']['parent_id'])){  
				 
					 $model->parent_id =$_POST['FormCategory']['parent_id']; 
				}*/

            //$model->service_id=$_POST['service_id'];  
			//$model->dept_id   =$_POST['dept_id'];
			 $model->attributes = $_POST['Declarationmaster'];
			 //$formType->save();
			 //print_r($formType->getErrors());die;
			 if($model->save()){  
					 
				    $this->redirect(array('index'));
			 } 
			 
        } 

        $this->render('update',array('apps'=>$application,'model'=>$model));

    }
 

	/**

	 * Deletes a particular model.

	 * If deletion is successful, the browser will be redirected to the 'admin' page.

	 * @param integer $id the ID of the model to be deleted

	 */



	

	public function actionIndex()

	{   
	
	
		$model=new Declarationmaster;  
		$application=$this->getFormTypesData();  
		$this->render('index',array(

			'apps'=>$application,'model'=>$model

		));

	}

    
/**

	 * Lists all models.

	 */
	 
  public function getFormTypesData()
	{   
 
	    $formsData =Yii::app()->db->createCommand("SELECT  * FROM  bo_declaration_master  WHERE is_active=1 ORDER BY id DESC")->queryAll(); 
		if($formsData===false)
		return false;
		return $formsData; 
    }

	 

 
	public function loadModel($id)

	{

		$model= Declarationmaster::model()->findByPk($id);

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
	
	protected function getFormCategoryName($form_id){
		 
		//echo "hi..";die;	 
		$sql_d = "SELECT category_name FROM bo_infowiz_form_categories WHERE is_active='Y' AND id=$form_id ";
		$connection=Yii::app()->db; 
		$command=$connection->createCommand($sql_d);
		$res_d = $command->queryRow(); 
		return $res_d['category_name'];
	}
	 


}

