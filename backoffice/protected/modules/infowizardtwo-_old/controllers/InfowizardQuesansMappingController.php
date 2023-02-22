<?php
/**
    * This function is used to get the Question Answer Mapping Master
     * @Author: Neha Jaiswal
     */
class InfowizardQuesansMappingController extends Controller
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
			
			/*array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('create','update','view','page','listquestionanswer','subformquestionanswer','checkservice','services','subformquestionanswerupdate','excludequestion','pageupdate','subformquestionanswerupdatenext','subFormQuestionAnswerNext','subformquestionanswerupdateandmapping'),
				'expression'=>'RolesExt::isAdminUser()',
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('create','update','view','page','listquestionanswer','subformquestionanswer','checkservice','services','subformquestionanswerupdate','excludequestion','pageupdate','subformquestionanswerupdatenext','subFormQuestionAnswerNext','subformquestionanswerupdateandmapping'),
				'expression'=>'DefaultUtility::isInfoWizardAdmin()',
			),
                        array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('create','update','view','page','listquestionanswer','subformquestionanswer','checkservice','services','subformquestionanswerupdate','excludequestion','pageupdate'),
				'expression'=>'DefaultUtility::isIWDataEntry()',
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),*/
		);
	}


 public function actionCheckService()
	{
	if(!empty($_POST))
		{ // print_r($_POST); die;
		 $resultarray=array();
		$i=0;
		foreach($_POST as $key => $value)
  {
    if (!is_array($value))
    {
      
		$resultarray[]= $value ."\r\n" ; 
		$k=0;
		 
    } 
    else
    {   //echo $i; 
	   $j=$i; //echo $j;
       foreach ($value as $key2 => $value2)
       {
         $resultarray[]= $value2 ."\r\n"; $j++;
       }
     $k=1;
     } 
	 if($k==0){ $i++; } if($k==1){ $i=$j++; } 
 } 
	
	//print_r($resultarray); die;
 $this->render('services',array('result'=>$resultarray));
	exit;
	}
	$this->render('checkservice');
	}
	
	
	public function getDetailofService($id){ //echo $id;  die; 
	   $sql="select service_name,issuerby_id from bo_information_wizard_service_master where id=:id ";
		$connection=Yii::app()->db; 
		$command=$connection->createCommand($sql);
		$command->bindParam(":id",$id,PDO::PARAM_INT);
		$Fields=$command->queryAll();
		//echo "<pre>";print_r($Fields); die;
	        if($Fields===false)
			return false; 
			return $Fields;
   } 
   
	
	public function actionServices()
	{
		//echo "jhgjh";
		$this->render('services');
		}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	 
	public function actionPage()
	{
		if(!empty($_POST))
		{   //print_r($_POST['answer']);
			$c=count($_POST['answer']); 
			$ques=$_POST['question_id']; 
			$sql="select * from bo_infowizard_quesans_mapping where question_id=$ques and is_quesans_active='Y'";
		    $connection=Yii::app()->db; 
		    $command=$connection->createCommand($sql);  
			$Fields=$command->queryAll();
			$countold=count($Fields);
			
			for($i=0;$i<$c;$i++)
			{
			if($countold>0){  $j=$countold+($i+1); } else {  $j=$i+1; }
			$model=new InfowizardQuesansMapping; 
			$model->attributes=$_POST;
			$model->created=date('Y-m-d H:m:s');
			$model->modified=date('Y-m-d H:m:s');
			$model->answer_detail=$_POST['answer'][$i];
			$model->priority=$ques.".".($j);
			//print_r($model->attributes);
			//print_r($model->getError());
			if($model->save()){}
			}
			// die;
			 $this->redirect(array('listquestionanswer'));
		}
		
		
	    $Question1[] = array('question_id'=>'','name'=>'--Select Question--');
		$Question = InfowizardQuestionMasterExt::getQuestionForInfoWizard();
		foreach($Question as $key=>$val){ $Question1[] = $val; }
		
	    $Anscat1[] = array('anscat_id'=>'','name'=>'--Select Answer Category--');
		$Anscat = InfowizardQuestionMasterExt::getAnsCatForInfoWizard();
		foreach($Anscat as $key=>$val){ $Anscat1[] = $val; }
		//print_r($Anscat1); 
		$this->render('page',array(
			'questiondata'=>$Question1,
			'anscatdata'=>$Anscat1
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	 public function actionPageUpdate()
	{
	
	   $quesID=$_GET['quesID'];
	   $sql="select * from bo_infowizard_quesans_mapping where question_id=$quesID and is_quesans_active='Y'";
		    $connection=Yii::app()->db; 
		    $command=$connection->createCommand($sql);  
			$Fields=$command->queryAll();
			// print_r($Fields); die;
			$countold=count($Fields);
			
$options=array();
$stringArr=array(); 
if(!empty($Fields)) { 
foreach($Fields as $rstl)
{
$stringArr[]=$rstl['queans_mapp_id'];
$var = $implodedString=implode(",",$stringArr);
$options=explode(',',$var);
//print_r($options);
} }
else { $options=array(); } 
			
		if(!empty($_POST))
		{   //print_r($_POST); die;
			 $c=count($_POST['answer']); 
			$j=0;
			for($i=0;$i<$c;$i++)
			{  //print_r($_POST['queans_mapp_id'][$i]); die;
			                 if(empty($_POST['queans_mapp_id'][$i]) && !empty($_POST['answer'][$i]))
							 {
							
							if(!empty($countold)){ $countold=$countold+1; $j=$countold; }
							$model=new InfowizardQuesansMapping; 
							$model->attributes=$_POST;
							$model->question_id=$quesID;
							$model->created=date('Y-m-d H:m:s');
							$model->modified=date('Y-m-d H:m:s');
							$model->answer_detail=$_POST['answer'][$i];
							$model->priority=$quesID.".".($j);
							//print_r($model->attributes);
							if($model->save()){}
							}
							
							
			if(!empty($_POST['queans_mapp_id'][$i]) && !empty($_POST['answer'][$i]))
							 {				
			if(in_array($_POST['queans_mapp_id'][$i],$options) ){ 
				 $doc=$_POST['queans_mapp_id'][$i]; $datee=date('Y-m-d h:i:s');  $answerere=$_POST['answer'][$i]; $anscatID=$_POST['anscat_id'];
 $sqlaa = "update bo_infowizard_quesans_mapping SET answer_detail=:answer1 ,anscat_id=:anscatID1 ,modified=:datee1 where question_id=:quesID1 and queans_mapp_id=:doc_id1";
      $parametersaa = array(':quesID1'=>$quesID, ':doc_id1' => $doc ,':answer1' =>$answerere  ,'datee1' =>$datee ,'anscatID1' =>$anscatID );
         $aa=Yii::app()->db->createCommand($sqlaa)->execute($parametersaa);
			        }
					}
			} 
			 
			 $this->redirect(array('listquestionanswer'));
		}
		
	    $Anscat1[] = array('anscat_id'=>'','name'=>'--Select Answer Category--');
		$Anscat = InfowizardQuestionMasterExt::getAnsCatForInfoWizard();
		foreach($Anscat as $key=>$val){ $Anscat1[] = $val; }
		//print_r($Anscat1); 
		$this->render('pageupdate',array(
			'Fields'=>$Fields,
			'anscatdata'=>$Anscat1
		));
	
	
	}
	
	

	public function getDetailOfQuesAns($id){ //echo $id;  die; 
	   $sql="select queans_mapp_id,anscat_id,answer_detail,priority from bo_infowizard_quesans_mapping where question_id=:id and is_quesans_active='Y'";
		$connection=Yii::app()->db; 
		$command=$connection->createCommand($sql);
		$command->bindParam(":id",$id,PDO::PARAM_INT);
		$Fields=$command->queryAll();
		//echo "<pre>";print_r($Fields); die;
	        if($Fields===false)
			return false; 
			return $Fields;
		} 
	
	public function getListofQuesAns(){ //echo $id;  die; 
	   $sql="select question_id from bo_infowizard_question_master where is_question_active='Y'";
		$connection=Yii::app()->db; 
		$command=$connection->createCommand($sql);
		//$command->bindParam(":id",$id,PDO::PARAM_INT);
		$Fields=$command->queryAll();
		//echo "<pre>";print_r($Fields); die;
	        if($Fields===false)
			return false; 
			return $Fields;
   } 
   
   public function getListofQuestion($id){ //echo $id;  die; 
	   $sql="select question_id,name from bo_infowizard_question_master where question_id=:id ";
		$connection=Yii::app()->db; 
		$command=$connection->createCommand($sql);
		$command->bindParam(":id",$id,PDO::PARAM_INT);
		$Fields=$command->queryRow();
		//echo "<pre>";print_r($Fields); die;
	        if($Fields===false)
			return false; 
			return $Fields;
   } 
	/**
	 * Manages all models. 
	 */
	public function actionListQuestionAnswer()
	{
		$applications=$this->getListofQuesAns(); //print_r($applications); die; question_id
		$this->render('listquestionanswer',array("apps"=>$applications));
	}
	
	public function getNameOfIssuerBy($id){ //echo $id;  die; 
	   $sql="select name from bo_infowizard_issuerby_master where issuerby_id=:id";
		$connection=Yii::app()->db; 
		$command=$connection->createCommand($sql);
		$command->bindParam(":id",$id,PDO::PARAM_INT);
		$Fields=$command->queryRow();
		//echo "<pre>";print_r($Fields); die;
	        if($Fields===false)
			return false; 
			return $Fields;
   } 
	
	
	 public function actionSubFormQuestionAnswerUpdate()
	{ //die('1');
		 $serviceID = $_GET['serviceID'];
	   if(!empty($_POST)) 
		{   //print_r($_POST);
			  $modidate=date('Y-m-d H:m:s');
		    $sqlaa = "UPDATE bo_infowizard_quesans_serviceform SET is_active=:is_active1 ,modified=:modified1 where service_id=:serviceID";
            $parametersaa = array(":is_active1"=>'N',':serviceID' => $serviceID,':modified1' => $modidate);
            $a=Yii::app()->db->createCommand($sqlaa)->execute($parametersaa);
		  $c=count($_POST['chkboxservice']);  
		//  print_r($_POST); die;
		foreach($_POST['chkboxservice'] as $datasss)
		{
			 $ss=$datasss;
			$ee=explode(',',$ss); //print_r($ee);
			$model=new BoInfowizardQuesansServiceform; 
			$model->is_active='Y';
			$model->service_id=$serviceID;
			//$model->exclude_question=$_POST['exclude_question'][$datasss];
			$model->created_date=date('Y-m-d H:m:s');
			$model->modified=date('Y-m-d H:m:s');
			$model->question_id=$ee[0];
			$model->queans_mapp_id=$ee[1];
			//print_r($model->attributes);
		    if($model->save()){}
			} 
			//die;
        $this->redirect(array('/infowizard/serviceMaster/listservicepage'));
		}
		
		$applications=$this->getListofQuesAns(); 
		$database=$this->getListofSubForm($serviceID); 
		//print_r($applications); print_r($database);  
		//die;
		$this->render('subformquestionanswerupdate',array("apps"=>$applications,"data"=>$database));
	}
	
	public function getListofSubForm($serviceID){ //echo $id;  die; 
	   $sql="select queans_mapp_id from bo_infowizard_quesans_serviceform where service_id=:serviceID and is_active='Y'";
		$connection=Yii::app()->db; 
		$command=$connection->createCommand($sql);
		$command->bindParam(":serviceID",$serviceID,PDO::PARAM_INT);
		$Fields=$command->queryAll();
		//echo "<pre>";print_r($Fields); die;
	        if($Fields===false)
			return false; 
			return $Fields;
   } 
   
   public function actionExcludeQuestion()
	{
	   if(!empty($_POST)) 
		{    //print_r($_POST); die;
			 $c=count($_POST['exclude_question']); 
			 for($i=0;$i<$c;$i++)
			{
			$exclude_question1=$_POST['exclude_question'][$i];
			$question_id1=$_POST['question_id'][$i];
			$queans_mapp_id1=$_POST['queans_mapp_id'][$i];
			
			$modidate=date('Y-m-d H:m:s');
		  $sqlaa = "UPDATE bo_infowizard_quesans_mapping SET exclude_question=:exclude_question , modified=:modified where question_id=:question_id and 
		queans_mapp_id=:queans_mapp_id";
 $parametersaa = array(':exclude_question' =>$exclude_question1,':modified'=>$modidate,':queans_mapp_id'=>$queans_mapp_id1,'question_id'=>$question_id1);
            $a=Yii::app()->db->createCommand($sqlaa)->execute($parametersaa);
			} 
			
			
        $this->redirect(array('/infowizard/serviceMaster/listservicepage'));
		}
		
		$applications=$this->getListofQuesAns(); 
		$excludequestion=$this->getListofExcludeQuestion();
       
		$this->render('excludequestion',array("apps"=>$applications,"excludee"=>$excludequestion));
	}
	
	
	public function getListofExcludeQuestion(){ //echo $id;  die; 
	   $sql="select * from bo_infowizard_quesans_mapping where exclude_question!=''";
		$connection=Yii::app()->db; 
		$command=$connection->createCommand($sql);
		//$command->bindParam(":id",$id,PDO::PARAM_INT);
		$Fields=$command->queryAll();
		//echo "<pre>";print_r($Fields); die;
	        if($Fields===false)
			return false; 
			return $Fields;
			
   } 
	
	
	public function actionSubFormQuestionAnswer()
	{ 
	   $serviceID = $_GET['serviceID'];
	   if(!empty($_POST)) 
		{   //print_r($_POST); 
			 $c=count($_POST['chkboxservice']); 
			 for($i=0;$i<$c;$i++)
			{
			$ss=$_POST['chkboxservice'][$i];
			$ee=explode(',',$ss); //echo $ee[0]; 
			$model=new BoInfowizardQuesansServiceform;
			$model->service_id=$serviceID;
			//$model->exclude_question=$_POST['exclude_question'][$i];
			$model->created_date=date('Y-m-d H:m:s');
			$model->modified=date('Y-m-d H:m:s');
			$model->question_id=$ee[0];
			$model->queans_mapp_id=$ee[1];
			//print_r($model->attributes); 
			if($model->save()){}
			} 
        $this->redirect(array('/infowizard/serviceMaster/listservicepage'));
		}
		
		$applications=$this->getListofQuesAns(); 
		$this->render('subformquestionanswer',array("apps"=>$applications));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return InfowizardQuesansMapping the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=InfowizardQuesansMapping::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param InfowizardQuesansMapping $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='infowizard-quesans-mapping-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
        
         public function actionSubFormQuestionAnswerUpdateNext() {
        $serviceID = $_GET['serviceID'];
        if (isset($_GET['subserviceID'])){$subserviceID = $_GET['subserviceID'];}
        if (!empty($_POST)) {

             $modidate=date('Y-m-d H:m:s');
              $sqlaa = "UPDATE bo_infowizard_quesans_serviceform SET is_active='N'  where service_id=$serviceID and subservice_id=$subserviceID";
             // $parametersaa = array(":is_active1"=>'N',':serviceID' => $serviceID,':subservice_id' => $subserviceID,':modified1' => $modidate);
              $a=Yii::app()->db->createCommand($sqlaa)->execute();//parametersaa);
              $c=count($_POST['chkboxservice']);
              //  print_r($_POST); die;
              foreach($_POST['chkboxservice'] as $datasss)
              {
              $ss=$datasss;
              $ee=explode(',',$ss); //print_r($ee);
              $model=new BoInfowizardQuesansServiceform;
              $model->is_active='Y';
              $model->service_id=$serviceID;
              //$model->exclude_question=$_POST['exclude_question'][$datasss];
              $model->created_date=date('Y-m-d H:m:s');
              $model->modified=date('Y-m-d H:m:s');
              $model->question_id=$ee[0];
              $model->queans_mapp_id=$ee[1];
              //print_r($model->attributes);
              if($model->save()){}
              } 
            //die;
            //$this->redirect(array('/infowizard/serviceMaster/listservicepage'));
            $this->redirect(array('/infowizard/infowizardQuesansMapping/subFormQuestionAnswerUpdateAndMapping/serviceID/'.$serviceID.'/subserviceID/'.$subserviceID));
        }

        $applications = $this->getListofQuesAns();
        $database = $this->getListofSubForm($serviceID);
        //print_r($applications); print_r($database);  
        //die;
        $this->render('subformquestionanswerupdate', array("apps" => $applications, "data" => $database));
    }
    
     public function actionSubFormQuestionAnswerNext() {
        $serviceID = $_GET['serviceID'];
        $subserviceID = $_GET['subserviceID'];
        if (!empty($_POST)) {   //print_r($_POST); 
            $c = count($_POST['chkboxservice']);
            for ($i = 0; $i < $c; $i++) {
                $ss = $_POST['chkboxservice'][$i];
                $ee = explode(',', $ss); //echo $ee[0]; 
                $model = new BoInfowizardQuesansServiceform;
                $model->service_id = $serviceID;
                $model->subservice_id = $subserviceID;
                //$model->exclude_question=$_POST['exclude_question'][$i];
                $model->created_date = date('Y-m-d H:m:s');
                $model->modified = date('Y-m-d H:m:s');
                $model->question_id = $ee[0];
                $model->queans_mapp_id = $ee[1];
               // print_r($model->attributes); die;
                if ($model->save()) {
                  // $this->redirect(array('/infowizard/infowizardQuesansMapping/subFormQuestionAnswerUpdateAndMapping/serviceID/'.$serviceID.'/subserviceID/'.$subserviceID)); 
                }
            }
          //  $this->redirect(array('/infowizard/serviceMaster/listSubServicePage/iw/Y/id/1'));
            $this->redirect(array('/infowizard/infowizardQuesansMapping/subFormQuestionAnswerUpdateAndMapping/serviceID/'.$serviceID.'/subserviceID/'.$subserviceID)); 
        }

        $applications = $this->getListofQuesAns();
        $this->render('subformquestionanswer', array("apps" => $applications));
    }
    
     public function actionSubFormQuestionAnswerUpdateAndMapping() {
        $serviceID = $_GET['serviceID'];
        if (isset($_GET['subserviceID'])){$subserviceID = $_GET['subserviceID'];}
        if (!empty($_POST)) {
            if (!empty($_POST['and_mapping'])) {
                $add_maps = $_POST['and_mapping'];
                //print_r($add_maps);die;
                
                $modidate = date('Y-m-d H:m:s');
                $createdate = date('Y-m-d H:m:s');
                $case_id = 0;
                $sql = "select max(case_id) as max_case_id from bo_infowiz_service_quesans_condition_mapping where service_id = $serviceID";
                $connection = Yii::app()->db;
                $command = $connection->createCommand($sql);
                $max_case_id = $command->queryAll();
                if(empty($max_case_id)){
                    $case_id = 1;
                }else{
                    $case_id = $max_case_id[0]['max_case_id'] + 1;
                }
                

                $sql = "Insert into bo_infowiz_service_quesans_condition_mapping (service_id,sub_service_id,case_id,status,user_id,created,modified) "
                        . "values(:service_ID, :sub_service_ID, :case_id, :status, :user_id, :created, :modified)";

                $parameters = array(":service_ID" => $serviceID,
                    ':sub_service_ID' => $subserviceID,
                    ':case_id' => $case_id,
                    ':status' => 'Y',
                    ':user_id' => $_SESSION['uid'],
                    ':created' => date('Y-m-d H:i:s'),
                    ':modified' => date('Y-m-d H:i:s'));
                Yii::app()->db->createCommand($sql)->execute($parameters);
                $insert_id = Yii::app()->db->getLastInsertID();
            }
            foreach ($add_maps as $addmap) {
                $sql = "Insert into bo_infowiz_service_conditional_answer_mappping (condition_id,answer_id,queans_mapp_id,status,user_id,created,modified) "
                        . "values(:case, :answer_id,:queans_mapp_id, :status, :user_id, :created, :modified)";

                $parameters = array(":case" => $insert_id,
                    ':answer_id' => $addmap,
                    ':queans_mapp_id' => $addmap,
                    ':status' => 'Y',
                    ':user_id' => $_SESSION['uid'],
                    ':created' => date('Y-m-d H:i:s'),
                    ':modified' => date('Y-m-d H:i:s'));
                Yii::app()->db->createCommand($sql)->execute($parameters);
            }

            //$this->redirect(array('/infowizard/serviceMaster/listservicepage'));
            //$this->redirect(array('/infowizard/infowizardQuesansMapping/subFormQuestionAnswerUpdateAndMapping/serviceID/'.$serviceID));
        }
        $applications = $this->getListofQuesAns();
        $database = $this->getListofSubForm($serviceID);
        $this->render('subformquestionanswerupdateandmapping', array("apps" => $applications, "service_ID" => $serviceID, "data" => $database,"subserviceID"=> $subserviceID));
    }
    
    
   public function actionSubFormQuestionAnswerMappingDeactivate(){
       extract($_GET);
       $conID=base64_decode($conID);
       $updateVerifierLevel = Yii::app()->db->createCommand("update bo_infowiz_service_conditional_answer_mappping set status='N' where condition_id=$conID")->execute();
      // print_r();die;
    $this->redirect($_SERVER['HTTP_REFERER']);
   }
}
