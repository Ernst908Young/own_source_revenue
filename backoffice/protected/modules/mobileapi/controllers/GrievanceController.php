<?php

class GrievanceController extends Controller {

    function init() {

    }

	
/*
*  after login API
*/
    public function actionGrievanceDashboardSummary(){
        $responce = json_decode(file_get_contents('php://input'), true);
        if(isset($responce['user_id']) && isset($_SERVER['HTTP_TOKEN'])){   
            $is_match = Token::matchtoken($_SERVER['HTTP_TOKEN'],$responce['user_id']);
            if($is_match==true){
                if(isset($responce['applicant_user_id'])){
                  $uid = $responce['applicant_user_id'];
                }else{
                  $uid = $responce['user_id'];
                }              
				$uid = $responce['user_id'];
				$grievance_count = Yii::app()->db->createCommand("SELECT
					COUNT(*) AS total_t,
					COUNT(CASE WHEN `status` = 'O' THEN 1 END) AS open_t,
					COUNT(CASE WHEN `status` = 'RV' THEN 1 END) AS rv_t,
					COUNT(CASE WHEN `status` = 'RS' THEN 1 END) AS rs_t,
					COUNT(CASE WHEN `status` = 'RO' THEN 1 END) AS ro_t,
					COUNT(CASE WHEN `status` = 'W' THEN 1 END) AS withdrawn_t,
					COUNT(CASE WHEN `status` = 'ESC' THEN 1 END) AS esc_t  
					FROM grievance WHERE user_id=$uid")->queryRow();
		
		
				if(isset($responce['status'])){
					$status = $responce['status'];
					$grievance_records = Yii::app()->db->createCommand("SELECT sm.id,
						sm.existing_id,
						sm.priority,
						sm.subject,
						sm.status,
						sm.category,
						sm.created_on
						FROM grievance as sm 
						WHERE sm.user_id=$uid AND sm.status='".$status."' order by sm.id DESC")->queryAll();
                }else{
					$grievance_records = Yii::app()->db->createCommand("SELECT sm.id,
						sm.existing_id,
						sm.priority,
						sm.subject,
						sm.status,
						sm.category,
						sm.created_on
						FROM grievance as sm 
						WHERE sm.user_id=$uid order by sm.id DESC")->queryAll();
				}

                $token_msg = 'token match'; 
                $token = Token::gettoken($responce['user_id']);
                echo json_encode(['status'=>true,'msg'=>'success','token_msg'=>$token_msg,'token'=>$token,'user_id'=>$responce['user_id'],'applicant_user_id'=>$uid,'grievance_count'=>$grievance_count,'grievance_records'=>$grievance_records]);
            }else{
                echo json_encode(['status'=>false,'msg'=>'failed','token_msg'=>'token failed']);
            }        
        }else{
            echo json_encode(['status'=>false,'msg'=>'token miss']);
        }
    }
    public function actionUpdateGrievance(){
    
		$type = array('Withdrawn'=>'Withdrawn');
			echo json_encode(['status'=>true,'msg'=>'Success','type'=>$type]);
	}
	
	public function actionUpdateGrievanceStatus(){
    
		$responce = json_decode(file_get_contents('php://input'), true);
		//print_r($responce);die();
		if(isset($responce['id']) && isset($responce['status'])  && isset($responce['user_id'])){ 
            if(isset($responce['applicant_user_id'])){
              $uid = $responce['applicant_user_id'];
            }else{
              $uid = $responce['user_id'];
            } 

            // print_r($responce);die();
            $id = $responce['id'];  
			$model = Grievance::model()->findByPk($id);	
			$model->status = $responce['status'];
			$model->updated_on = date('Y-m-d H:i:s');
			$model->save();
			$status_arr = ['O'=>'Open','RV'=>'Reverted','RS'=>'Resolved','RO'=>'Reopened','C'=>'Closed','W'=>'Withdrown','ESC'=>'Escalated'];
			
			echo json_encode(['status'=>true,'msg'=>'success','applicant_user_id'=>$uid,'user_id'=>$responce['user_id'],'status'=>$status_arr[$responce['status']]]);
			
		}else{
            echo json_encode(['status'=>false,'msg'=>'Parameter missing']);
		}  
	}
	


public function actionGrievancereply(){
     $responce = json_decode(file_get_contents('php://input'), true);
     if(isset($responce['id']) && isset($responce['message']) && isset($responce['user_id'])){
        if(isset($responce['applicant_user_id'])){
          $uid = $responce['applicant_user_id'];
        }else{
          $uid = $responce['user_id'];
        } 

            $user_id = $responce['user_id'];
            $id = $responce['id'];   
            $message = $responce['message'];        
            
             $record = Yii::app()->db->createCommand("SELECT *
             FROM grievance as g          
            WHERE g.id='".$id."'  AND user_id='".$user_id."'")->queryRow();
            if($record){
                Yii::app()->db->createCommand("INSERT INTO grievancemsg (message, user_id, user_type, grievance_id, msgdatetime)
            VALUES ('".$message."','$user_id','AU','$id','".date('Y-m-d H:i:s')."')")->execute();
                echo json_encode(['status'=>true,'msg'=>'success','applicant_user_id'=>$uid,'user_id'=>$responce['user_id'],'id'=>$id]);
            }else{
                echo json_encode(['status'=>false,'msg'=>'No data found']);
            }
     }else{
            echo json_encode(['status'=>false,'msg'=>'Parameter missing']);
    }
}



    public function actionGrivenaceActionDetail(){
        $responce = json_decode(file_get_contents('php://input'), true);
        if(isset($responce['user_id']) && isset($_SERVER['HTTP_TOKEN'])){   
            $is_match = Token::matchtoken($_SERVER['HTTP_TOKEN'],$responce['user_id']);
            if($is_match==true){
                if(isset($responce['applicant_user_id'])){
                  $uid = $responce['applicant_user_id'];
                }else{
                  $uid = $responce['user_id'];
                } 
                
               /* $sc_id = isset($responce['sc_id']) ? $responce['sc_id'] : NULL;
                if($sc_id!=NULL){
                    
                }*/
                 $sm_id= $responce['sm_id'];   

                $data = Yii::app()->db->createCommand("SELECT A.id,A.category,A.status, A.created_on,  C.msgfilepath, A.currently_assign_to, A.priority, A.subject, B.message, B.msgdatetime FROM grievance as A INNER JOIN grievancemsg B ON A.id = B.grievance_id  
                		LEFT JOIN grievancefiles C ON C.gm_id = B.id WHERE A.id=$sm_id ")->queryAll();
                // do your work here

                $token_msg = 'token match'; 
                $token = Token::gettoken($responce['user_id']);
                echo json_encode(['status'=>true,'msg'=>'success','token_msg'=>$token_msg,'token'=>$token,'user_id'=>$responce['user_id'],'applicant_user_id'=>$uid,'data'=>$data]);
            }else{
                echo json_encode(['status'=>false,'msg'=>'failed','token_msg'=>'token failed']);
            }        
        }else{
            echo json_encode(['status'=>false,'msg'=>'token miss']);
        }
    }


public function actionTypes(){
    
     $type = array('Ticket'=>'Existing Ticket','Query'=>'Existing Query');
       echo json_encode(['status'=>true,'msg'=>'Success','type'=>$type]);
}


public function actionGetexistingid(){
    $responce = json_decode(file_get_contents('php://input'), true);
    if(isset($responce['user_id']) && isset($_SERVER['HTTP_TOKEN'])){   
        $is_match = Token::matchtoken($_SERVER['HTTP_TOKEN'],$responce['user_id']);
        if($is_match==true){
            if(isset($responce['applicant_user_id'])){
              $uid = $responce['applicant_user_id'];
            }else{
              $uid = $responce['user_id'];
            } 
            $category= $responce['category'];
            $user_id= $responce['user_id'];
            
           if($category=='Existing Ticket'){
                $q = Yii::app()->db->createCommand("SELECT CONCAT('Ticket ID: ',supporttypecode) AS Ticket from supportmain            
                where usercode=$user_id AND status='O' AND user_type='FO'")->queryAll();
                 
           }else{
               if($category=='Existing Query'){
                    $q = Yii::app()->db->createCommand("SELECT CONCAT('Query ID: ',querycode) AS Query
                   from querymain              
                    where user_id=$user_id AND status='1'")->queryAll();
                     
               }
           }
            $token_msg = 'token match'; 
            $token = Token::gettoken($responce['user_id']);
            echo json_encode(['status'=>true,'msg'=>'success','token_msg'=>$token_msg,'token'=>$token,'user_id'=>$responce['user_id'],'applicant_user_id'=>$uid,'category'=>$q]);
        }else{
            echo json_encode(['status'=>false,'msg'=>'failed','token_msg'=>'token failed']);
        }        
    }else{
        echo json_encode(['status'=>false,'msg'=>'token miss']);
    }
}



//Grevience Raise

public function actionGrivanceRaise(){    
    if(isset($_POST['user_id']) && isset($_SERVER['HTTP_TOKEN']) && isset($_POST['category']) && isset($_POST['category_id'])  && isset($_POST['subject']) && isset($_POST['message'])){ 
        if(isset($_POST['applicant_user_id'])){
          $uid = $_POST['applicant_user_id'];
        }else{
          $uid = $_POST['user_id'];
        } 

        $file = isset($_FILES['file']) ? $_FILES['file'] : NULL;

            $model = new Grievance;
          
            
            $model->category =$_POST['category'];
            $model->existing_id = $_POST['category_id'];        
            $model->subject = $_POST['subject'];         
          
            //$model->category = $_POST['type'];
            $model->priority = 'Normal';
            $model->user_id = $_POST['user_id'];
            $model->status ='O' ;
            $model->updated_on = date('Y-m-d H:i:s');

            $model->save();
            $msgModel = new Grievancemsg;
            $msgModel->message = $_POST['message'];
            $msgModel->user_id = $_POST['user_id'];
            $msgModel->user_type = "AU";
            $msgModel->grievance_id = $model->id;
            $msgModel->save();

            if($file!=NULL){
                 $targetDir = Yii::app()->basePath .'/uploads/grievance';
                 $file_name = $_FILES['file']['name']; 
                 if (!file_exists($targetDir)) {
                    @mkdir($targetDir);
                }
                $targetFile = $targetDir.'/'.$file_name;
                if(move_uploaded_file($_FILES['file']['tmp_name'], $targetFile)) {
                    $file_path = '/backoffice/protected/uploads/grievance/'.$file_name;
                    $file_msg = 'file uploaded';
                    $sfile = new Grievancefiles;
                    $sfile->msgfilepath = $file_path;
                    $sfile->gm_id = $msgModel->id;
                    $sfile->save();
                } else {
                    $file_msg = 'somthing went worng while uploading file';
                }
            }else{
                $file_msg = 'file not selected';
            }

                   
            $Appuserdetail = Yii::app()->db->createCommand("SELECT u.email, p.* 
                from sso_users u 
                INNER JOIN sso_profiles p ON p.user_id=u.user_id
                where u.user_id=$model->user_id")->queryRow();
            $dear_name = $Appuserdetail['first_name'].' '.$Appuserdetail['last_name'].' '.$Appuserdetail['surname'];
            

            
        $subject = "CAIPO-Grievance";
        $to = $Appuserdetail['email'];
        $name = $dear_name;
        $notification_msg_fo = 'Your Grievance has been submitted successfully';
        $content = "Dear ".$dear_name.",<br><br> Your Grievance has been successfully submitted in CAIPO Portal. You are allotted Grievance ID <b>".$model->id."</b> <br><br>Note: This is a system generated message. Please do not reply. For any queries reach out to CAIPO. <br><br>
            Regards,<br>
            Corporate Affairs and Intellectual Property Office<br>
            Ground Floor, BAOBAB Tower, Warrens<br>
            St. Michael, Barbados<br>
            Tel: (246) 535-2401 Fax: (246) 535-2444<br>
            <a href='".EMAIL_WEB_URL."' title='CAIPO Portal'>http://www.caipo.gov.bb</a><br>
            Email: <a href='#!' title='Email'>caipo.general@barbados.gov.bb</a>";


        $post_data= array('host'=>EMAIL_HOST,'port'=>EMAIL_PORT,'user'=>EMAIL_USERNAME,'pass'=>EMAIL_PASSWORD, 'subject'=>$subject,'to'=>$to,'content'=>$content,'email_name'=>EMAIL_NAME);                
        DefaultUtility::post_to_url(EMAIL_API,$post_data); 
        Alertsandnotification::sendnotification('Grievance',$model->id,$model->id,$model->user_id,'FO',$notification_msg_fo); 
        
        echo json_encode(['status'=>true,'msg'=>'Success! Grievance generated','file_msg'=>$file_msg,'grievance_id'=>$model->id,'applicant_user_id'=>$uid,'user_id'=>$_POST['user_id']]);
    }else{
         echo json_encode(['status'=>false,'msg'=>'Parameter missing']);
    }
}








}