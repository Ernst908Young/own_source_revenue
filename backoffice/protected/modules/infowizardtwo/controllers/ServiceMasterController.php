 <?php

 

class ServiceMasterController extends Controller

{ 

    /**

    * This function is used to get the Service Master

     * @Author: Neha Jaiswal

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

            

            array('allow', //allow authenticated user to perform 'create' and 'update' actions

                'actions'=>array('update','servicepage','issuerbydepartmentid','listservicepage','serviceupdate','view'),

                'expression'=>'RolesExt::isAdminUser()',

            ),
              array('allow', //allow authenticated user to perform 'create' and 'update' actions

                'actions'=>array('update','servicepage','issuerbydepartmentid','listservicepage','serviceupdate','view'),

                'expression'=>'DefaultUtility::isInfoWizardAdmin()',

            ),
            

            array('deny',  // deny all users

                'users'=>array('*'),

            ),

        );

    }

*/

    /**

     * Displays a particular model.

     * @param integer $id the ID of the model to be displayed  

     */

	 

	 

	 

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

   

   public function getNameOfSeviceSector($id){ //echo $id;  die; 

	   $sql="select name from bo_information_wizard_sector where id=:id";

		$connection=Yii::app()->db; 

		$command=$connection->createCommand($sql);

		$command->bindParam(":id",$id,PDO::PARAM_INT);

		$Fields=$command->queryRow();

		//echo "<pre>";print_r($Fields); die;

	        if($Fields===false)

			return false; 

			return $Fields;

   } 

   

   

	 

	 public function getListofService(){ //echo $id;  die; 

	   $sql="select * from bo_information_wizard_service_master ";

		$connection=Yii::app()->db; 

		$command=$connection->createCommand($sql);

		//$command->bindParam(":id",$id,PDO::PARAM_INT);

		$Fields=$command->queryAll();

		//echo "<pre>";print_r($Fields); die;

	        if($Fields===false)

			return false; 

			return $Fields;

   } 

   

   

   public function actionListServicePage()

	{

		$applications=$this->getListofService(); //print_r($applications); die; question_id

		$this->render('listservicepage',array("apps"=>$applications));

	}
        
        public function getListofSubForm($serviceID){ //echo $id;  die; 
    $sql="select * from bo_infowizard_quesans_serviceform where service_id=:serviceID and is_active='Y'";
  $connection=Yii::app()->db; 
  $command=$connection->createCommand($sql);
  $command->bindParam(":serviceID",$serviceID,PDO::PARAM_INT);
  $Fields=$command->queryAll();
  //echo "<pre>";print_r($Fields); die;
         if($Fields===false)
   return false; 
   return count($Fields);
   }

	

	public function getDetailsofService($id){ //echo $id;  die; 

	   $sql="select * from bo_information_wizard_service_master where id=:id";

		$connection=Yii::app()->db; 

		$command=$connection->createCommand($sql);

		$command->bindParam(":id",$id,PDO::PARAM_INT);

		$Fields=$command->queryRow();

		//echo "<pre>";print_r($Fields); die;

	        if($Fields===false)

			return false; 

			return $Fields;

   } 

	

	public function actionServiceUpdate($serviceID)

	{

	  $model=$this->loadModel($serviceID);

	if(!empty($_POST))

		{
          //print_r($_POST);die;
		$model->attributes=$_POST;
		if(!empty($_POST['additional_sub_service'])){

		$additional_sub_service=implode(",", $_POST['additional_sub_service']); }
		else { $additional_sub_service='';}

        $model->additional_sub_service=$additional_sub_service;
       $act="";
        if(isset($_POST['act']) && !empty($_POST['act'])){
        $act=implode(",", $_POST['act']); 
         }
                
             $model->act=$act;   

        $model->modified=date('Y-m-d h:i:s'); 

		//print_r($model->attributes);die;

         if($model->save()){

          Yii::app()->user->setFlash('Success', "Service Master data Updated Successfully");

          $serviceFeeURL="/infowizard/serviceParameters/Addparams/serviceID/$model->id";

          $this->redirect(Yii::app()->createUrl($serviceFeeURL));

		                   }

		}

		$applications=$this->getDetailsofService($serviceID);  //print_r($applications); die; 

		$this->render('serviceupdate',array("apps"=>$applications));

	}

	

	

	  public function actionServicePage()

    {

        if(!empty($_POST))

		{  

		$model=new BoInformationWizardServiceMaster;

		$model->attributes=$_POST;

		$serviceSector=implode(",", $_POST['service_sector']);

		$model->service_sector=$serviceSector;

		$model->created=date('Y-m-d h:i:s');

		$model->modified=date('Y-m-d h:i:s');

		//print_r($model->attributes); die;

		$sqlbv="select * from  bo_information_wizard_service_master where central_state=:central_state111 and service_name=:name111 and issuerby_id=:issuerby_id111";

		    $connection=Yii::app()->db; 

		    $command=$connection->createCommand($sqlbv);

			$command->bindParam(":central_state111",$_POST['central_state'],PDO::PARAM_INT);

			$command->bindParam(":name111",$_POST['service_name'],PDO::PARAM_INT);

			$command->bindParam(":issuerby_id111",$_POST['issuerby_id'],PDO::PARAM_INT);

		    $Fieldsaadssd=$command->queryAll(); 

			//print_r($Fieldsaadssd);

		    $aaaa=count($Fieldsaadssd);

			// die;

			if($aaaa == 0)

			{ //Yii::app()->user->setFlash('Success', "Service Master data has been saved");

                if($model->save()){

             Yii::app()->user->setFlash('Success', "Service Master data has been saved");

			 //$this->redirect("http://uk.swcspoc.com/backoffice/infowizard/infowizardQuesansMapping/subformquestionanswer/serviceID/$serviceID");

             /* $serviceFeeURL="/infowizard/infowizardQuesansMapping/subformquestionanswer/serviceID/$model->id";
              *      $this->redirect(Yii::app()->createUrl($serviceFeeURL));*/
            
$serviceFeeURL="/infowizard/serviceMaster/listservicepage";
              $this->redirect(Yii::app()->createUrl($serviceFeeURL));
         
             // $this->redirect("listservicepage");

                  }

			}

			else { Yii::app()->user->setFlash('Failure', "Data Already Exist"); }

		}

		

		$this->render('servicepage');

    }

	

    public function actionView($serviceID)
    {
        $database=$this->getListofSubFormQuestion($serviceID); 
		//print_r($database); die;
		$this->render('view',array('model'=>$this->loadModel($serviceID),"data"=>$database));
    }

public function getListofSubFormQuestion($serviceID){ //echo $id;  die; 
	   $sql="SELECT bo_infowizard_quesans_serviceform.queans_mapp_id,bo_infowizard_question_master.question_id,bo_infowizard_question_master.name,
	   bo_infowizard_quesans_mapping.anscat_id, bo_infowizard_quesans_mapping.answer_detail 
	   FROM bo_infowizard_quesans_serviceform , bo_infowizard_quesans_mapping , bo_infowizard_question_master where                           bo_infowizard_quesans_serviceform.queans_mapp_id=bo_infowizard_quesans_mapping.queans_mapp_id and bo_infowizard_question_master.question_id=bo_infowizard_quesans_serviceform.question_id and bo_infowizard_quesans_serviceform.service_id=:serviceID and bo_infowizard_quesans_serviceform.is_active='Y' ";
		$connection=Yii::app()->db; 
		$command=$connection->createCommand($sql);
		$command->bindParam(":serviceID",$serviceID,PDO::PARAM_INT);
		$Fields=$command->queryAll();
		//echo "<pre>";print_r($Fields); die;
	        if(!empty($Fields))
		{
		foreach ($Fields as $key => $field)
		{  
		if( isset($field['name'])) 
			{  	
			   $sectorid=$field['name'];
			   $newdetails[$sectorid][$key]['queans_mapp_id']=$field['queans_mapp_id']; 
			   $newdetails[$sectorid][$key]['answer_detail']=$field['answer_detail']; 
			   $newdetails[$sectorid][$key]['anscat_id']=$field['anscat_id'];     
			}
			
		 } // print_r($newdetails);die;
		 }
		 if(isset($newdetails)){ 
		if($newdetails==false)
			return false;
		//echo "<pre>";print_r($Fields);die;
		return $newdetails;
        }
   } 




    /**

     * Updates a particular model.

     * If update is successful, the browser will be redirected to the 'view' page.

     * @param integer $id the ID of the model to be updated

     */

    public function actionUpdate($serviceID)

    {

        $model=$this->loadModel($serviceID);



        if(!empty($_POST))

		{ 

		if(empty($_POST['incidence_pre_establishment'])){ $model->incidence_pre_establishment=0; }

		if(empty($_POST['incidence_pre_operation'])){ $model->incidence_pre_operation=0; }

		if(empty($_POST['incidence_post_operation'])){ $model->incidence_post_operation=0; }
		if(empty($_POST['is_incentive'])){ $model->is_incentive=0; }

		$model->attributes=$_POST; 

		//print_r($model->attributes); die;

		$serviceSector=implode(",", $_POST['service_sector']);

		$model->service_sector=$serviceSector;
                $model->incentive_id=$_POST['incentive_id'];
                $model->incentive_incidence_code=implode(",", $_POST['incentive_incidence_code']);

		$model->modified=date('Y-m-d h:i:s');

			 ////////////////////////////////////////////////////////

			$sqlbv="select * from  bo_information_wizard_service_master where central_state=:central_state111 and issuerby_id=:issuerby_id111 and service_name=:service_name111 

			and id!=:id1";

		    $connection=Yii::app()->db; 

		    $command=$connection->createCommand($sqlbv);

			$command->bindParam(":id1",$serviceID,PDO::PARAM_INT);

			$command->bindParam(":central_state111",$_POST['central_state'],PDO::PARAM_INT);

			$command->bindParam(":issuerby_id111",$_POST['issuerby_id'],PDO::PARAM_INT);

			$command->bindParam(":service_name111",$_POST['service_name'],PDO::PARAM_INT);

		    $Fieldsaadssd=$command->queryAll(); 

			//print_r($Fieldsaadssd);

		    $aaaa=count($Fieldsaadssd);

			//die;

			if($aaaa==0)

			{

            if($model->save()) { //print_r($model->attributes); die;

				//$serviceFeeURL="/infowizard/infowizardQuesansMapping/subformquestionanswerupdate/serviceID/$model->id";
$serviceFeeURL="/infowizard/serviceMaster/listservicepage";
              $this->redirect(Yii::app()->createUrl($serviceFeeURL));
             

				Yii::app()->user->setFlash('Success', "Service Master Updated Successfully");

            }

			}

			else { Yii::app()->user->setFlash('Failure', "Data Already Exist"); }	

			/////////////////////////////////////////////////////////////////

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

   

    /**

     * Lists all models.

     */

   

    /**

     * Manages all models.

     */

   

    /**

     * Returns the data model based on the primary key given in the GET variable.

     * If the data model is not found, an HTTP exception will be raised.

     * @param integer $id the ID of the model to be loaded

     * @return BoInformationWizardServiceMaster the loaded model

     * @throws CHttpException

     */

    public function loadModel($id)

    {

        $model=BoInformationWizardServiceMaster::model()->findByPk($id);

        if($model===null)

            throw new CHttpException(404,'The requested page does not exist.');

        return $model;

    }



    /**

     * Performs the AJAX validation.

     * @param BoInformationWizardServiceMaster $model the model to be validated

     */

    protected function performAjaxValidation($model)

    {

        if(isset($_POST['ajax']) && $_POST['ajax']==='bo-information-wizard-service-master-form')

        {

            echo CActiveForm::validate($model);

            Yii::app()->end();

        }

    }

     public function updateAllRelatedTable($serviceID=null,$subService=null,$serviceType=null){                 
                 $tableArray=array('BoInformationWizardServiceParameters','BoInformationWizardInspection','BoInformationWizardServiceFee','BoInfowizardServiceStackholder','BoInfowizardServiceTimeline','BoInfowizardServiceValidity');
                  $allList=InfowizardQuestionMasterExt::getMasterList('bo_information_wizard_additional_sub_service_master','sub_service_name','id'); 
                  
                   foreach($tableArray as $modTable){   
                      
                        $ExistingServices= $modTable::model()->findByAttributes(array('service_id'=>$serviceID,'servicetype_additionalsubservice'=>'0'));
                        if(empty($ExistingServices)){ 
                        $model=new $modTable;
                       $model->service_id=$serviceID;
                       $model->service_type=$serviceType;
                       $model->servicetype_additionalsubservice='0';
                       $model->created=date('Y-m-d h:i:s');    
                       if($model->save()){
                          echo "Saved For : ".$serviceID;
                       }else{
                           print_r($model->getErrors());}
                       } else{
                         //echo "===".$sS;  
                       }
                     
                    }
                    
                    
                    foreach($tableArray as $modTable){   
                        if(!empty($subService)){
                        $s= explode(",", $subService);
                         
                      //  print_r( $s);
                       foreach($s as $sS){ 
                       $ExistingServices= $modTable::model()->findByAttributes(array('service_id'=>$serviceID,'service_type'=>$sS));   
                        $model=new $modTable;
                       if(empty($ExistingServices)){                   
                       $model->service_id=$serviceID;
                       $model->service_type=$sS;
                       $model->servicetype_additionalsubservice=$allList[$sS];
                       $model->created=date('Y-m-d h:i:s');    
                      // print_r($model);
                      if($model->save()){
                          
                      }else{
                          print_r($model->getErrors());}
                       
                       }
                    }
                    }
                    }
                       
                 //die; 
    }

    
   public function actionUpdateForAll(){
   
	   $sql="select id,service_type,additional_sub_service from bo_information_wizard_service_master";

		$connection=Yii::app()->db; 

		$command=$connection->createCommand($sql);

		$command->bindParam(":id",$id,PDO::PARAM_INT);

		$allService=$command->queryAll();
                
            // print_r($allService);die;
                foreach($allService as $serviceData){  
                    if(!empty($serviceData['service_type'])){
                 $this->updateAllRelatedTable($serviceData['id'],$serviceData['additional_sub_service'],$serviceData['service_type']);     
                    }
                }
                
                echo "Done";die;

   }
   
   //For Service Module Mapping - Starts Here Rahul Kumar : 02052018 */ 
    public function actionSubservicetagmapping() {
        $this->render('subservicetagmapping');
    }

     public function actionAddsubservicetagmapping() {

        $model = new SubserviceTagMapping;
        //echo "<pre/>";
        //print_r($_POST);die;
        if (!empty($_POST)) {
            if (!empty($_POST['SubserviceTagMapping']['id'])) {
                $model = $model::model()->findByAttributes(array('id' => $_POST['SubserviceTagMapping']['id']));
                $model->modified = date('Y-m-d H:i:s');
                $model->to_be_used_in_cis = "N";
                $model->to_be_used_in_online_offline = "N";
                $model->to_be_used_in_infowiz = "N";
                $model->to_be_used_in_caf_2 = "N";
                $model->to_be_used_in_inter_departmental_clearance = "N";
                $model->to_be_used_in_sectoral_clearence = "N";
                $model->to_be_used_in_dms = "N";
            } else {
                $model = new SubserviceTagMapping;
                $model->created = date('Y-m-d H:i:s');
                $model->modified = date('Y-m-d H:i:s');
            }
            $model->attributes = $_POST['SubserviceTagMapping'];
             if(!empty($model->sub_service_id)){
                $serviceIDS= explode(".", $model->sub_service_id);
                $model->service_id=@$serviceIDS[0];
                $model->subservice_id=@$serviceIDS[1];
            }
            $model->is_active = "Y";
            $model->ip_address = $_SERVER['REMOTE_ADDR'];
            $model->user_agent = $_SERVER['HTTP_USER_AGENT'];
            $model->user_id = $_SESSION['uid'];


            if ($model->save()) {
               echo "Module Mapping with Tags for Service ID : " . $_POST['SubserviceTagMapping']['sub_service_id'] . " has been saved "; die;
             
            } else {
                //die(var_dump($model->getErrors()));
                 echo "Data saving failed. Please try again.";
                die;
            }
        }
    }
        //For Service Module Mapping - Ends Here Rahul Kumar : 02052018 */
          public function actionListSubServicePage() {
            //$applications=$this->getListofService(); //print_r($applications); die; question_id
            $this->render("service_listingnew");
            }
    
        public function getListofSubServiceForm($serviceID, $sub_service_id) { //echo $id;  die; 
        $sql = "select * from bo_infowizard_quesans_serviceform where service_id=:serviceID and subservice_id=:subserviceID and is_active='Y'";
        $connection = Yii::app()->db;
        $command = $connection->createCommand($sql);
        $command->bindParam(":serviceID", $serviceID, PDO::PARAM_INT);
        $command->bindParam(":subserviceID", $sub_service_id, PDO::PARAM_INT);
        $Fields = $command->queryAll();
       // print_r($Fields);die;
        //echo "<pre>";print_r($Fields); die;
        if ($Fields === false)
            return false;
        return count($Fields);
    }
    
        public function actionIncentiveCalculator() { //echo $id;  die; 
       // if(isset($_GET)) print_r($_GET); die;
        if(isset($_POST) && !empty($_POST)) { 
            $condition = "";
            if(isset($_POST['category']) && $_POST['category'] != ""){
                $condition.= " OR category_name = '$_POST[category]'";
                }
                
            if(isset($_POST['sector']) && $_POST['sector'] != ""){
                $condition.= " OR category_name = '$_POST[sector]'";
                }

            if(isset($_POST['gender']) && $_POST['gender'] != ""){
                $condition.= " OR category_name = '$_POST[gender]'";
                }

            if(isset($_POST['electricity']) && $_POST['electricity'] !=""){
                $condition.= " OR category_name = '$_POST[electricity]'";
            }
            if(isset($_POST['activity_type']) && $_POST['activity_type'] !=""){
                $condition.= " OR category_name = '$_POST[activity_type]'";
            }
            
            if(isset($_POST['operation']) && $_POST['operation'] !=""){
                $condition.= " OR category_name = '$_POST[operation]'";
            }
            if(isset($_POST['investment']) && $_POST['investment'] !=""){
                $inv_pro ="";
                if($_POST['unit_type'] =='Manufacturing' && $_POST['investment'] >=2500000 && $_POST['investment'] <=100000000 ){
                    $inv_pro = 'MSME Projects';
                } 
                if($_POST['unit_type'] =='Service' && $_POST['investment'] >=1000000 && $_POST['investment'] <=50000000 ){
                    $inv_pro = 'MSME Projects';
                }
                if($_POST['unit_type'] =='Manufacturing' && $_POST['investment'] >100000000 && $_POST['investment'] <=500000000 ){
                    $inv_pro = 'Heavy Projects';
                }
                if($_POST['unit_type'] =='Service' && $_POST['investment'] >50000000 && $_POST['investment'] <=500000000 ){ 
                    $inv_pro = 'Heavy Projects';
                }
                if($_POST['investment']>500000000 && $_POST['investment'] <=750000000 ){
                    $inv_pro = 'Mega Large Projects';
                }
                if($_POST['investment']>750000000 && $_POST['investment'] <=2000000000 ){
                    $inv_pro = 'Mega Mega Projects';
                }
                if($_POST['investment']>2000000000  ){
                    $inv_pro = 'Mega Ultra Mega Projects';
                }
                $condition.= " OR category_name = '$inv_pro'";
            }
            
           
            //echo "<pre>";print_r($services);die;
            
            //if(!empty($services)){ $result =  "You can avail ".$services[0]['category_quantum'] .' '.$services[0]['category_quantum_type'] .' '.$services[0]['incentive_frequency'].' upto '.$services[0]['category_quantum_limit'].$services[0]['category_quantum_limit_type'];}
            //echo "<pre>";print_r($services); //die;
            $this->render('incentive_calculator',array("condition"=>$condition,"row"=>$_POST));
             die;
            }
        $this->render("incentive_calculator");
    }
//For Service Module Mapping - Ends Here Rahul Kumar : 02052018 */
      public function actionGetlgCodeBlock() { //echo $id;  die; 
        if(isset($_POST['lgdist'])){
        $lgdist =  $_POST['lgdist'];
        //$lgdist =  $_GET['lgdist'];
        }
        $sql = "select block_code as id ,block_name as name from lg_code_blocks where district_id=:district_id ";
        $connection = Yii::app()->db;
        $command = $connection->createCommand($sql);
        $command->bindParam(":district_id", $lgdist, PDO::PARAM_INT);

        $services = $command->queryAll();
        $services1[] = array('id'=>'','name'=>'<---- Select ---->');
        foreach($services as $key=>$val){ $services1[] = $val; }
        echo json_encode($services1);

    } 
    
    public function actionGetIncentive() { //echo $id;  die; 
        if(isset($_POST['policy'])){
        $policy =  $_POST['policy'];
        //$lgdist =  $_GET['lgdist'];
        }
        $sql = "select service_id, service_name from  bo_incentive_master where service_id in 
                                            (select distinct(incentive_id) from bo_incentive_category_quantum_limit where policy_id=:policy)";
        $connection = Yii::app()->db;
        $command = $connection->createCommand($sql);
        $command->bindParam(":policy", $policy, PDO::PARAM_INT);

        $services = $command->queryAll();
        $services1[] = array('service_id'=>'','service_name'=>'<---- Select ---->');
        foreach($services as $key=>$val){ $services1[] = $val; }
        echo json_encode($services1);

    }
    
    public function actionValidFields() { //echo $id;  die; 
        if(isset($_POST['incentive'])){
        $incentive =  $_POST['incentive'];
        //$lgdist =  $_GET['lgdist'];
        }
        
        $sql = "select distinct(category_type) from bo_incentive_category_master where category_id in (select category_id_1 from bo_incentive_category_quantum_limit where incentive_id=:incentive union 
                                            select category_id_2 from bo_incentive_category_quantum_limit where incentive_id=:incentive union
                                            select category_id_3 from bo_incentive_category_quantum_limit where incentive_id=:incentive union
                                            select category_id_4 from bo_incentive_category_quantum_limit where incentive_id=:incentive union
                                            select category_id_5 from bo_incentive_category_quantum_limit where incentive_id=:incentive) and category_type not like '%Null%'";
        $connection = Yii::app()->db;
        $command = $connection->createCommand($sql);
        $command->bindParam(":incentive", $incentive, PDO::PARAM_INT);
        $services = $command->queryAll();
        //echo "<pre>";print_r($services);
        if(!empty($services)){
            $inc = array();
        foreach($services as $service){
            $inc[] = $service['category_type'];
        }
        //echo "<pre>";print_r($inc);
        echo json_encode($inc);}

    } 
    
    public function actionGetBlockCategory() { //echo $id;  die; 
        $height =0;
        if(isset($_POST['block'])){
        $block =  $_POST['block'];
        //$lgdist =  $_GET['lgdist'];
        }
        if(isset($_POST['height'])){
        $height =  $_POST['height'];
        //$lgdist =  $_GET['lgdist'];
        }
        
        $sql = "select unit_category,block_name from lg_code_blocks where block_code=:block and is_active='Y'";
        $connection = Yii::app()->db;
        $command = $connection->createCommand($sql);
        $command->bindParam(":block", $block, PDO::PARAM_INT);
        $block_cat = $command->queryAll();
        $cat = $block_cat[0]['unit_category'];
        
        if(in_array($block_cat[0]['block_name'],array('RAIPUR','SAHASPUR','VIKASNAGAR','DOIWALA'))){
          if(isset($height) && $height !=0){
              if($height > 650){
               $cat = 'C';   
              }else{
                $cat = 'D';  
              }
          }else{
             $cat = ""; 
          }
        }
        

        echo json_encode($cat);
        
        }
        
    public static function getPolicyIncentive($policy,$incentive,$condition,$unittype){
        
       $sql = "select * from bo_incentive_category_quantum_limit where policy_id = '$policy' and incentive_id = '$incentive' and nature_of_unit like '%$unittype%' and "
                    . "(category_id_1 in (Select category_id from bo_incentive_category_master where policy = '$policy' and (category_id in ('90') $condition) OR category_id_1 = 0) )and "
                    . "(category_id_2 in (Select category_id from bo_incentive_category_master where policy = '$policy' and (category_id in ('90') $condition) OR category_id_2 = 0) )and "
                    . "(category_id_3 in (Select category_id from bo_incentive_category_master where policy = '$policy' and (category_id in ('90') $condition) OR category_id_3 = 0) )and "
                    . "(category_id_4 in (Select category_id from bo_incentive_category_master where policy = '$policy' and (category_id in ('90') $condition) OR category_id_4 = 0) )and "
                    . "(category_id_5 in (Select category_id from bo_incentive_category_master where policy = '$policy' and (category_id in ('90') $condition) OR category_id_5 = 0) "
                    . ")";
            $connection = Yii::app()->db;
            $command = $connection->createCommand($sql);
            $services = $command->queryAll();
            $result['is'] ="";
            $result['value'] ="";
            if(!empty($services)){ 
                $result['is'] =  'YES';//$services[0]['category_quantum'] .' '.$services[0]['category_quantum_type'] .' '.$services[0]['incentive_frequency'].' upto '.$services[0]['category_quantum_limit'].$services[0]['category_quantum_limit_type'];} 
                $result['value'] =  $services[0]['category_comment'];
            }
            return $result;
            }
}
