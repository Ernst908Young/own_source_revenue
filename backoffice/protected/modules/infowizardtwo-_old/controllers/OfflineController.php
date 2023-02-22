<?php



class OfflineController extends Controller {



    /**

     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning

     * using two-column layout. See 'protected/views/layouts/column2.php'.

     */

    public $layout = '//layouts/column2';



    /**

     * @return array action filters

     */

   /* public function filters() {

        return array(

            'accessControl', // perform access control for CRUD operations

            'postOnly + delete', // we only allow deletion via POST request

        );

    }*/

	

	/*public function accessRules()

	{

		return array(

			


			/*array('allow', // allow admin user to perform 'admin' and 'delete' actions

				'actions'=>array('feedetail','docdetail','modeofsubmission','dicpanel','satutorydetail','submittedAddressAll','deptpanel','diclisting','deptlisting','getCAFDetailAll'),

				'expression'=>'DefaultUtility::isNodalAgency()'
                 // 'expression'=>'RolesExt::isAdminUser()',
			),

			array('deny',  // deny all users

				'users'=>array('*'),

			),

		);

	}*/



public function actionDicpanel() 

	{    @session_start();
        // print_r(); die;
	     $appID = $_GET['appID'];

	     $serviceID = $_GET['serviceID'];

		 $subserviceID = $_GET['subserviceID']; 

		 $document=$this->getSubmittedDmsDocomentAll($appID);

		 $documentother=$this->getSubmittedDmsOtherAll($appID);
		 
		 if(!empty($_POST))
         {  
		 // print_r($_POST); die;
		 $selected_role_id=7;
		  $count=$_POST['dddd']; 
		 $status_dic=$_POST['status'];
		 
//		  $location="OfflineDocuments";
//            $docName="Offline";
//            $postFix= strtotime(date('Y-m-d h:i:s'));
//          if($file['upload']['type'] == 'application/pdf' && $file['upload']['name'] != '' &&  $file['upload']['size'] <= (1024  1024  5)) {
//                $path = Yii::app()->basePath . "/../../themes/backend/$location/";
//                $nname = $docName."-".$appID."-".$postFix. ".pdf";
//                move_uploaded_file($_FILES['upload']['tmp_name'], $path . $nname);
//                $pathUploaded = "/themes/backend/" . $location . "/" . $nname;
//            } else {
//                $pathUploaded = "";
//            }
                 $pathUploaded="";
                 if(!empty($_FILES)){ 
		if($_FILES['upload']['type'] == 'application/pdf' && $_FILES['upload']['name']!='' && 
  $_FILES['upload']['size']<=(1024*1024*5) )
    {                 
  //$path = Yii::app()->basePath."/acts/";
  $path = Yii::app()->basePath."/../../themes/backend/OfflineDocuments/";
  $nname = "Offline-".$appID."-".time().".pdf";
  move_uploaded_file($_FILES['upload']['tmp_name'], $path.$nname);
  $pathUploaded = "/themes/backend/OfflineDocuments/".$nname;
    }
  else {  $pathUploaded=""; }
         }
		 for($i=0;$i<$count;$i++)
		 {  
                     if(!empty($_POST['received'][$i])){
		 $model= new BoOfflineDocumentSubmission;   
		 $model->doc_id=$_POST['doccccc_id'][$i]; 
		 $model->offline_application_id=$appID;     
		 $model->received_notreceived=$_POST['received'][$i];  
		 $model->roleid=$selected_role_id; 
		 $model->user_id=$_SESSION['uid'];  
		 $model->status=$status_dic; 
		 $model->created_date=date('Y-m-d h:i:s');

		if($_POST['received'][$i]=="Received")
		{ // print_r($model->attributes); 
		if($model->save()){}
		}
                 }
                 
		 }
		// die;
		if($status_dic=='AD'){
		  $modelfrd= new BoOfflineForwardLevel;
		  $modelfrd->offline_application_id=$appID;  
		  $modelfrd->sender='DIC'; 
		  $modelfrd->sender_role=$selected_role_id; 
		  $modelfrd->sender_id=$_SESSION['uid'];
		  $modelfrd->department_id=$_SESSION['dept_id'];
		  $modelfrd->comment=$_POST['comment'];
		  $modelfrd->upload=$pathUploaded; 
		  $modelfrd->status=$status_dic; 
		  $modelfrd->created_date=date('Y-m-d h:i:s');
		     // print_r($modelfrd->attributes);  
		  if($modelfrd->save()){
		  }
		  }
		  
		  if($status_dic=='RBI'){
		  
		  $modelfrd= new BoOfflineForwardLevel;
		  $modelfrd->offline_application_id=$appID;  
		  $modelfrd->sender='DIC'; 
		  $modelfrd->sender_role=$selected_role_id; 
		  $modelfrd->sender_id=$_SESSION['uid'];
		  $modelfrd->department_id=$_SESSION['dept_id']; 
		  $modelfrd->receiver='Investor';
		 $modelfrd->comment=$_POST['comment'];
		  $modelfrd->upload=$pathUploaded; 
		  $modelfrd->status=$status_dic; 
		  $modelfrd->created_date=date('Y-m-d h:i:s');
		     // print_r($modelfrd->attributes);  
		  if($modelfrd->save()){
		   $date=date('Y-m-d h:i:s');
		    $sqlaa = "update bo_offline_applications SET offline_application_status=:status1 ,application_updated_date=:date1 where offline_application_id=:appID1";
            $parametersaa = array(":status1"=>$status_dic, ':date1' => $date ,':appID1' => $appID);
            $aa=Yii::app()->db->createCommand($sqlaa)->execute($parametersaa);
			
			     Yii::app()->user->setFlash('Success', "Data has been Saved Successfully");
				$this->redirect(array('diclisting'));
		  }
		  
		  
		  
		  }
		  
		  if($status_dic=='F')
		  {
		  $modelfrd= new BoOfflineForwardLevel;
		  $modelfrd->offline_application_id=$appID;  
		  $modelfrd->sender='DIC'; 
		  $modelfrd->sender_role=$selected_role_id; 
		  $modelfrd->sender_id=$_SESSION['uid'];
		  $modelfrd->department_id=$_SESSION['dept_id']; 
		  $modelfrd->receiver='Department';  
		  $modelfrd->receiver_role=33;  
		  $modelfrd->mode_of_submission_dic=$_POST['mode_of_submission_dic'];
		  $modelfrd->tracking_detail_dic=$_POST['tracking_detail_dic'];
		  $modelfrd->comment=$_POST['comment'];
		  $modelfrd->upload=$pathUploaded;
		  $modelfrd->status=$status_dic; 
		  $modelfrd->created_date=date('Y-m-d h:i:s');
		     // print_r($modelfrd->attributes);  
		  if($modelfrd->save()){
		   $date=date('Y-m-d h:i:s');
		    $sqlaa = "update bo_offline_applications SET offline_application_status=:status1 ,application_updated_date=:date1 where offline_application_id=:appID1";
            $parametersaa = array(":status1"=>$status_dic, ':date1' => $date ,':appID1' => $appID);
            $aa=Yii::app()->db->createCommand($sqlaa)->execute($parametersaa);
			
			     Yii::app()->user->setFlash('Success', "Data has been Saved Successfully");
				$this->redirect(array('diclisting'));
		  }
		  
		  }
		  
		
		 
		 }
		 
	    $sql = "SELECT * from bo_offline_document_submission where offline_application_id=$appID";
		$connection = Yii::app()->db;
        $command = $connection->createCommand($sql);
        $Service = $command->queryAll();
 

        $this->render('dicpanel',array("docs"=>$document,"other_doc"=>$documentother,"saveddata"=>$Service));

    }  
	
	 function getCAFDetailAll($CafID){ //print_r('hi'); print_r($_POST['post_issuerid']); die;  

        //$CafID = $_GET['CafID'];

        $sql="SELECT field_value,landrigion_id from bo_application_submission where submission_id=:CafID";

			$connection=Yii::app()->db; 

			$command=$connection->createCommand($sql);

			$command->bindParam(":CafID",$CafID,PDO::PARAM_STR);

			$services=$command->queryRow();

            return $services;

	}

public function actionDeptpanel() 

	{

	     $appID = $_GET['appID'];

	     $serviceID = $_GET['serviceID'];

		 $subserviceID = $_GET['subserviceID']; 

		 $document=$this->getSubmittedDmsDocomentAll($appID);

		 $documentother=$this->getSubmittedDmsOtherAll($appID);

        $this->render('deptpanel',array("docs"=>$document,"other_doc"=>$documentother));

    }

	

    public function actionDiclisting() 

	{

	    

		$sql="SELECT * FROM bo_offline_applications o

INNER JOIN bo_sp_applications a ON a.offline_application_id=o.offline_application_id

INNER JOIN bo_application_dms_documents_mapping m ON m.sno=a.sno



";

                //INNER JOIN sso_users s ON s.iuid=o.iuid

			$connection=Yii::app()->db; 

			$command=$connection->createCommand($sql);

			$allOfflineApplication=$command->queryAll();

            //print_r($allOfflineApplion);die;

	

        $this->render('diclisting',array('allOfflineApplication'=>$allOfflineApplication));

    }

    public function actionDeptlisting() 

	{

	    

		$sql="SELECT * FROM bo_offline_applications o

INNER JOIN bo_sp_applications a ON a.offline_application_id=o.offline_application_id

INNER JOIN bo_application_dms_documents_mapping m ON m.sno=a.sno



";

                //INNER JOIN sso_users s ON s.iuid=o.iuid

			$connection=Yii::app()->db; 

			$command=$connection->createCommand($sql);

			$allOfflineApplication=$command->queryAll();

            //print_r($allOfflineApplion);die;

	

        $this->render('deptlisting',array('allOfflineApplication'=>$allOfflineApplication));

    }

	private function getSubmittedDmsOtherAll(){ //print_r('hi'); print_r($_POST['post_issuerid']); die;  

        $appID = $_GET['appID'];

        

        

		$sql="SELECT * from bo_offline_applications_other_documents where offline_application_id=:appID";

			$connection=Yii::app()->db; 

			$command=$connection->createCommand($sql);

			$command->bindParam(":appID",$appID,PDO::PARAM_STR);

			$services=$command->queryAll();

            return $services;

	}

	

	 private function getSubmittedDmsDocomentAll(){ //print_r('hi'); print_r($_POST['post_issuerid']); die;  

        $appID = $_GET['appID'];

        

        		$sql="SELECT * FROM bo_offline_applications o

INNER JOIN bo_sp_applications a ON a.offline_application_id=o.offline_application_id

INNER JOIN bo_application_dms_documents_mapping m ON m.sno=a.sno

where o.offline_application_id='$_GET[appID]'";

		//$sql="SELECT * FROM bo_application_dms_documents_mapping where sno='2282'";

			$connection=Yii::app()->db; 

			$command=$connection->createCommand($sql);

			$command->bindParam(":appID",$appID,PDO::PARAM_STR);

			$services=$command->queryAll();

                      //  print_r($services);die;

            return $services;

	}

	

	



  public function actionSubmittedAddress(){ //print_r('hi'); print_r($_POST['post_data']); die;

  $issID=$_GET['type']; $distID=$_GET['dist'];

	if($issID=='DIC'){   

       

		$sql="SELECT * FROM bo_offline_submitted_to_address  WHERE type_of_entity=:issID and district_id=:distID and is_active='Y'";

			$connection=Yii::app()->db; 

			$command=$connection->createCommand($sql);

			$command->bindParam(":issID",$issID,PDO::PARAM_STR);

			$command->bindParam(":distID",$distID,PDO::PARAM_STR);

			$services=$command->queryAll();

			$html="";

			foreach($services as $key=>$val){

			$html=$html."<div class='row'><div class='form-group col-md-12'><label class='col-lg-4 col-sm-4 control-label' for='submitted_to'>".$val[type_of_office]."<span class='required' aria-required='true'> * </span></label><div class='col-md-6' style='padding-top:8px;'><textarea name='address' class='form-control' id='address' readonly >".$val[address]."</textarea></div></div></div>

			<div class='row'><div class='form-group col-md-12'><label class='col-lg-4 col-sm-4 control-label' for='submitted_to'>Pincode <span class='required' aria-required='true'> * </span></label><div class='col-md-6' style='padding-top:8px;'><input type='text' id='address' name='address' readonly class='form-control' 

value='".$val[pincode]."' /></div></div></div>

<div class='row'><div class='form-group col-md-12'><label class='col-lg-4 col-sm-4 control-label' for='submitted_to'>Contact No1 <span class='required' aria-required='true'> * </span></label><div class='col-md-6' style='padding-top:8px;'><input type='text' id='address' name='address' readonly class='form-control' 

value='".$val[phone_no1]."' /></div></div></div>

<div class='row'><div class='form-group col-md-12'><label class='col-lg-4 col-sm-4 control-label' for='submitted_to'>Contact No2 <span class='required' aria-required='true'> * </span></label><div class='col-md-6' style='padding-top:8px;'><input type='text' id='address' name='address' readonly class='form-control' 

value='".$val[phone_no2]."' /></div></div></div>

<div class='row'><div class='form-group col-md-12'><label class='col-lg-4 col-sm-4 control-label' for='submitted_to'>Fax <span class='required' aria-required='true'> * </span></label><div class='col-md-6' style='padding-top:8px;'><input type='text' id='address' name='address' readonly class='form-control' 

value='".$val[fax]."' /></div></div></div>

<div class='row'><div class='form-group col-md-12'><label class='col-lg-4 col-sm-4 control-label' for='submitted_to'>Email Id <span class='required' aria-required='true'> * </span></label><div class='col-md-6' style='padding-top:8px;'><input type='text' id='address' name='address' readonly class='form-control' 

value='".$val[email_id]."' /></div></div></div>";

			}

        }

		

		

		echo  $html;die;

	}

	

	 public function actionSubmittedAddressAll(){ //print_r('hi'); print_r($_POST['post_issuerid']); die;

	if($_POST['post_data']){   

        $issID=$_POST['post_data']; 

		$sql="SELECT name_of_office,entity_id FROM bo_offline_submitted_to_address  WHERE type_of_entity=:issID and is_active='Y'";

			$connection=Yii::app()->db; 

			$command=$connection->createCommand($sql);

			$command->bindParam(":issID",$issID,PDO::PARAM_STR);

			$services=$command->queryAll();

            $services1[] = array('name_of_office'=>'','name_of_office'=>'<---- Select ---->');

            foreach($services as $key=>$val){ $services1[] = $val; }

            echo json_encode($services1);

        }

		    //print_r($services);

	}

	

    public function actionIndex() {

        $this->render('index');

    }

	

	public function actionSatutorydetail() 

	{

	     $appID = $_GET['appID'];

	     $serviceID = $_GET['serviceID'];

		 $subserviceID = $_GET['subserviceID'];

		 $subservivcesData = $this->getSubServicesParameters($serviceID,$subserviceID);

		

		 if(!empty($_FILES))

		{   // print_r($_FILES);

		 $model=new BoOfflineApplicationsOtherDocuments;

		    echo $ss=count($_FILES['other_doc']); 

			if(!empty($_FILES['statutory_form']['name']))

			 { 

			if($_FILES['statutory_form']['type'] == 'application/pdf' && $_FILES['statutory_form']['name']!='' && $_FILES['statutory_form']['size']<=(1024*1024*5) )

		  {                 

		//$path = Yii::app()->basePath."/uploads/";

		$path = Yii::app()->basePath."/../../themes/backend/offline/".$appID;

		$nname = "statutory_form".time().".pdf";

		move_uploaded_file($_FILES['upload_certificate']['tmp_name'], $path.$nname);

		$statutory_form = "/themes/backend/offline/".$appID."/".$nname; 

		  }

		else {  $statutory_form=""; }

		   

		    $model->attributes=$_POST;   // 	document_name   	document_file_name

			$model->offline_application_id=$appID;

			$model->type_of_document='S';

			$model->document_name='Statutory Form';

			$model->document_file_name=$statutory_form;

			$model->created_datetime=date('Y-m-d h:i:s');

		    if($model->save()) {}

			print_r($model->attributes); 

		}

		for($i=0;$i<$ss;$i++)

		{ $j=$i+1;

		 if(!empty($_FILES['other_doc']['name'][$i])) 

		{

		

			if($_FILES['other_doc']['type'][$i] == 'application/pdf' && $_FILES['other_doc']['name'][$i]!='' && $_FILES['other_doc']['size'][$i]<=(1024*1024*5) )

		  {                 

		//$path = Yii::app()->basePath."/uploads/";

		$path = Yii::app()->basePath."/../../themes/backend/offline/".$appID;

		$nname = "other".$j.time().".pdf";

		move_uploaded_file($_FILES['other_doc']['tmp_name'], $path.$nname);

		$other_form = "/themes/backend/offline/".$appID."/".$nname;

		  }

		else {  $other_form=""; }

		

		

		    $model->offline_application_id=$appID;

			$model->type_of_document='O';

			$model->document_name=$_POST['document_name'][$i];

			$model->document_file_name=$other_form;

			$model->created_datetime=date('Y-m-d h:i:s');

			if($model->save()) {}

		//print_r($model->attributes); 

		}

		}

		//die;

			

	 // else { Yii::app()->user->setFlash('Failure', "Data Not Saved"); }	

		

		}

	   

        $this->render('satutorydetail',array("subservivcesData"=>$subservivcesData));

    }

	

	public function actionDocdetail() 

	{

	   

        $this->render('docdetail');

    }

	

	public function actionModeofSubmission() 

	{    $appID = $_GET['appID'];

	     $serviceID = $_GET['serviceID'];

		 $subserviceID = $_GET['subserviceID'];

		 $model=new BoOfflineModeOfSubmission;

		//print_r($_POST);

		  if(!empty($_POST))

		{

			$model->attributes=$_POST; 

			$model->offline_application_id=$appID;

			$model->date_of_submission=date('Y-m-d',strtotime($_POST['date_of_submission']));

			$model->created_date=date('Y-m-d h:i:s');

			//print_r($model->attributes);  die;

			if($model->save()) { 

			Yii::app()->user->setFlash('Success', "Data Saved Successfully"); 

			$this->redirect(array('modeofsubmission','appID'=>$appID,'serviceID'=>$serviceID,'subserviceID'=>$subserviceID));

			}

			else { Yii::app()->user->setFlash('Failure', "Data Not Saved"); }	

		}

	   

        $this->render('modeofsubmission');

    }





    public function actionFeedetail() 

	{

	     $appID = $_GET['appID'];

	     $serviceID = $_GET['serviceID'];

		 $subserviceID = $_GET['subserviceID'];

		 $subservivcesData = $this->getSubServices($serviceID,$subserviceID);

		 

		 $model=new BoOfflineApplicationsPayment;

		 

		 if(!empty($_POST))

		{

			$model->attributes=$_POST;

			$model->offline_application_id=$appID;

			$model->payment_details='hjgjh';

			$model->amount=$subservivcesData['fee_detail'];

			$model->payment_status='S';

			$model->ip_address='kjhkj';

			$model->user_agent='kjhkj';

			$model->payment_datetime=date('Y-m-d h:i:s');

			//print_r($model->attributes); die;

			

			if($model->save()) { 

			Yii::app()->user->setFlash('Success', "Payment Saved Successfully"); 

			$this->redirect(array('feedetail','appID'=>$appID,'serviceID'=>$serviceID,'subserviceID'=>$subserviceID));

			

				}

			else { Yii::app()->user->setFlash('Failure', "Payment Not Saved"); }	

		}



		 

		 $subservivcesData = $this->getSubServices($serviceID,$subserviceID);

		

	   //print_r($subservivcesData); die;

        $this->render('feedetail',array("subservivcesData"=>$subservivcesData));

    }

	

	

	private function getSubServices($serviceID,$subserviceID){ 

		$connection=Yii::app()->db;

		$isactive='Y'; 

	    $sql = "SELECT * FROM bo_information_wizard_service_fee where service_id=:serviceID AND servicetype_additionalsubservice=:subserviceID";

		$command=$connection->createCommand($sql);

		$command->bindParam(":serviceID",$serviceID,PDO::PARAM_INT);

		$command->bindParam(":subserviceID",$subserviceID,PDO::PARAM_INT);

		$docList=$command->queryRow();	

		return $docList;

	}

	

	private function getSubServicesParameters($serviceID,$subserviceID){   	

		$connection=Yii::app()->db;

		$isactive='Y'; 

	    $sql = "SELECT statutory_form_upload FROM bo_information_wizard_service_parameters where service_id=:serviceID AND servicetype_additionalsubservice=:subserviceID";

		$command=$connection->createCommand($sql);

		$command->bindParam(":serviceID",$serviceID,PDO::PARAM_INT);

		$command->bindParam(":subserviceID",$subserviceID,PDO::PARAM_INT);

		$docList=$command->queryRow();	

		return $docList;

	}

	

	



    /**

     * Displays a particular model.

     * @param integer $id the ID of the model to be displayed

     */

    public function actionCreateformajax() {

        extract($_POST);

        $connection = Yii::app()->db;

        $sqlQuery = "INSERT INTO `bo_information_wizard_form_builder`( `service_id`, `sub_form`, `form_field_id`, `input_type`, `is_with_caf`,`max_length`, `is_required`, `validation_rule`, `row_type`, `preference`)"

                . " VALUES ('$service_id','$sub_form','$form_field_id','$input_type','$is_with_caf','$max_length', '$is_required', '$validation_rule','$row_type','$preference')";

        $connection->createCommand($sqlQuery)->execute();

    }
}