<?php

class TicketController extends Controller {

    function init() {

    }

	
/*
*  after login API
*/
    public function actionTicketDashboardSummary(){
        $responce = json_decode(file_get_contents('php://input'), true);
        if(isset($responce['user_id']) && isset($_SERVER['HTTP_TOKEN'])){   
            $is_match = Token::matchtoken($_SERVER['HTTP_TOKEN'],$responce['user_id']);
            if($is_match==true){                
              if(isset($responce['applicant_user_id'])){
                $uid = $responce['applicant_user_id'];
              }else{
                $uid = $responce['user_id'];
              }	
				
				
				// print_r($status);die;
				$tickets_count = Yii::app()->db->createCommand("SELECT
			    COUNT(*) AS total_t,
			    COUNT(CASE WHEN `status` = 'O' THEN 1 END) AS open_t,
			    COUNT(CASE WHEN `status` = 'RV' THEN 1 END) AS rv_t,
			    COUNT(CASE WHEN `status` = 'RS' THEN 1 END) AS rs_t,
			    COUNT(CASE WHEN `status` = 'RO' THEN 1 END) AS ro_t,
			    COUNT(CASE WHEN `status` = 'C' THEN 1 END) AS close_t,
				COUNT(CASE WHEN `status` = 'ESC' THEN 1 END) AS esc_t 
				FROM supportmain WHERE usercode=$uid AND user_type='FO'")->queryRow();
				
				// print_r($tickets_count);die;

				
				$query_count = Yii::app()->db->createCommand("SELECT
			    COUNT(*) AS total_q,
			    COUNT(CASE WHEN `status` = 1 THEN 1 END) AS open_q,
			    COUNT(CASE WHEN `status` = 0 THEN 1 END) AS close_q			  
				FROM querymain WHERE user_id=$uid")->queryRow();
			
				if(isset($responce['status'])){
					$status = $responce['status'];
                $tickets_records = Yii::app()->db->createCommand("SELECT sm.supportmaincode,
					sm.supporttypecode,	sm.servicecategory,sm.supportprioritycode,sm.subject,sm.status,	sm.service_id,sm.srn_app_id,sm.created_on,
					sm.filepath,
					s.service_name, 
					sc.category_name,
					sm.ticket_type 
					 FROM supportmain as sm 
					LEFT OUTER JOIN bo_information_wizard_service_master as s ON sm.service_id=s.id
					LEFT OUTER JOIN bo_information_wizard_services_category as sc ON s.sc_id=sc.id  
					WHERE sm.usercode=$uid AND sm.user_type='FO' AND sm.status='".$status."' order by sm.supportmaincode DESC")->queryAll();
					
				$query_records = Yii::app()->db->createCommand("SELECT q.id, q.querycode,q.query_type,
					q.mobile_no,
					q.email,
					q.servicecategory,
					q.service_id,
					q.user_id,
					q.querypriority,
					q.subject,
					q.created_on,
					q.status,			
					s.service_name, 
					sc.category_name
					 FROM querymain as q 
					LEFT OUTER JOIN bo_information_wizard_service_master as s ON q.service_id=s.id
					LEFT OUTER JOIN bo_information_wizard_services_category as sc ON s.sc_id=sc.id  
					WHERE q.user_id=$uid AND q.status='".$status."' order by q.id DESC")->queryAll();
				}else{
					$tickets_records = Yii::app()->db->createCommand("SELECT sm.supportmaincode,
					sm.supporttypecode,	sm.servicecategory,sm.supportprioritycode,sm.subject,sm.status,	sm.service_id,sm.srn_app_id,sm.created_on,
					sm.filepath,
					s.service_name, 
					sc.category_name,
					sm.ticket_type 
					 FROM supportmain as sm 
					LEFT OUTER JOIN bo_information_wizard_service_master as s ON sm.service_id=s.id
					LEFT OUTER JOIN bo_information_wizard_services_category as sc ON s.sc_id=sc.id  
					WHERE sm.usercode=$uid AND sm.user_type='FO'  order by sm.supportmaincode DESC")->queryAll();
					
					$query_records = Yii::app()->db->createCommand("SELECT q.id, q.querycode,q.query_type,
					q.mobile_no,
					q.email,
					q.servicecategory,
					q.service_id,
					q.user_id,
					q.querypriority,
					q.subject,
					q.created_on,
					q.status,			
					s.service_name, 
					sc.category_name
					 FROM querymain as q 
					LEFT OUTER JOIN bo_information_wizard_service_master as s ON q.service_id=s.id
					LEFT OUTER JOIN bo_information_wizard_services_category as sc ON s.sc_id=sc.id  
					WHERE q.user_id=$uid order by q.id DESC")->queryAll();
				}
				
				
                $token_msg = 'token match'; 
                $token = Token::gettoken($responce['user_id']);
                echo json_encode(['status'=>true,'msg'=>'success','token_msg'=>$token_msg,'token'=>$token,'user_id'=>$responce['user_id'],'applicant_user_id'=>$uid,'ticket_summary'=>$tickets_count,'query_summary'=>$query_count,'tickets_records'=>$tickets_records,'query_records'=>$query_records]);
            }else{
                echo json_encode(['status'=>false,'msg'=>'failed','token_msg'=>'token failed']);
            }        
        }else{
            echo json_encode(['status'=>false,'msg'=>'token miss']);
        }
    }
	
	public function actionPaymentHistory(){
        $responce = json_decode(file_get_contents('php://input'), true);
        if(isset($responce['user_id']) && isset($_SERVER['HTTP_TOKEN'])){   
            $is_match = Token::matchtoken($_SERVER['HTTP_TOKEN'],$responce['user_id']);
            if($is_match==true){
                if(isset($responce['applicant_user_id'])){
                $uid = $responce['applicant_user_id'];
              }else{
                $uid = $responce['user_id'];
              }
                
              
				$payment = Yii::app()->db->createCommand("SELECT p.*, s.service_name, sc.category_name FROM tbl_payment as p INNER JOIN bo_new_application_submission app ON p.submission_id=app.submission_id
				 	INNER JOIN bo_information_wizard_service_parameters sp ON app.service_id = CONCAT(sp.service_id,'.',sp.servicetype_additionalsubservice)
					INNER JOIN bo_information_wizard_service_master s ON sp.service_id = s.id
					INNER JOIN bo_information_wizard_services_category sc ON s.sc_id = sc.id
				  GROUP BY p.submission_id ORDER BY submission_id DESC ")->queryAll();
                

                $token_msg = 'token match'; 
                $token = Token::gettoken($responce['user_id']);
                echo json_encode(['status'=>true,'msg'=>'success','token_msg'=>$token_msg,'token'=>$token,'user_id'=>$responce['user_id'],'applicant_user_id'=>$uid,'payment_history'=>$payment]);
            }else{
                echo json_encode(['status'=>false,'msg'=>'failed','token_msg'=>'token failed']);
            }        
        }else{
            echo json_encode(['status'=>false,'msg'=>'token miss']);
        }
    }
	
	public function actionPaymentHistoryDetail(){
        $responce = json_decode(file_get_contents('php://input'), true);
        if(isset($responce['user_id']) && isset($_SERVER['HTTP_TOKEN'])){   
            $is_match = Token::matchtoken($_SERVER['HTTP_TOKEN'],$responce['user_id']);
            if($is_match==true){
                if(isset($responce['applicant_user_id'])){
                $uid = $responce['applicant_user_id'];
              }else{
                $uid = $responce['user_id'];
              }
                if(isset($responce['submission_id'])){ 
					$submission_id = $responce['submission_id'];
					$mainpay = Yii::app()->db->createCommand("SELECT p.service_total_fee, p.submission_id, s.service_name, sc.category_name FROM tbl_payment as p
							 INNER JOIN bo_new_application_submission app ON p.submission_id=app.submission_id 
							 INNER JOIN bo_information_wizard_service_parameters sp ON app.service_id = CONCAT(sp.service_id,'.',sp.servicetype_additionalsubservice)
							INNER JOIN bo_information_wizard_service_master s ON sp.service_id = s.id
							INNER JOIN bo_information_wizard_services_category sc ON s.sc_id = sc.id
							 where p.submission_id=$submission_id")->queryRow();

					$payment = Yii::app()->db->createCommand("SELECT p.* FROM tbl_payment as p
							 INNER JOIN bo_new_application_submission app ON p.submission_id=app.submission_id
							 where p.submission_id=$submission_id AND is_fee_refunded=0")->queryAll();

					$paymentrefundrequest = Yii::app()->db->createCommand("SELECT * FROM tbl_refund_requested  
							 where submission_id=$submission_id")->queryAll();

					$paymentefund = Yii::app()->db->createCommand("SELECT p.* FROM tbl_payment as p
							 INNER JOIN bo_new_application_submission app ON p.submission_id=app.submission_id
							 where p.submission_id=$submission_id AND is_fee_refunded=1")->queryAll();
                
					$token_msg = 'token match'; 
					$token = Token::gettoken($responce['user_id']);
					echo json_encode(['status'=>true,'msg'=>'success','token_msg'=>$token_msg,'token'=>$token,'user_id'=>$responce['user_id'],'applicant_user_id'=>$uid,'mainpay'=>$mainpay,'payment'=>$payment,'paymentrefundrequest'=>$paymentrefundrequest,'paymentefund'=>$paymentefund]);
				}else{
					echo json_encode(['status'=>false,'msg'=>'required submission id ']);
				}
            }else{
                echo json_encode(['status'=>false,'msg'=>'failed','token_msg'=>'token failed']);
            }        
        }else{
            echo json_encode(['status'=>false,'msg'=>'token miss']);
        }
    }


 public function actionTicketActionDetailHeader(){
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

                $data = Yii::app()->db->createCommand("SELECT supporttypecode, srn_app_id, category_name, service_name, status, created_on, subject
			 	FROM supportmain as sm LEFT OUTER JOIN bo_information_wizard_service_master as s ON sm.service_id=s.id
				LEFT OUTER JOIN bo_information_wizard_services_category as sc ON s.sc_id=sc.id   
				WHERE sm.supportmaincode=$sm_id")->queryAll();
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

     public function actionTicketReplyReceived(){
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

                $data = Yii::app()->db->createCommand("SELECT supportmaincode, message, msgdatetime FROM supportmessages			
					WHERE supportmaincode=$sm_id order by msgdatetime DESC")->queryAll();
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


         public function actionQueryActionDetailHeader(){
            $responce = json_decode(file_get_contents('php://input'), true);
            if(isset($responce['user_id']) && isset($_SERVER['HTTP_TOKEN'])){   
                $is_match = Token::matchtoken($_SERVER['HTTP_TOKEN'],$responce['user_id'],$responce['q_id']);
                if($is_match==true){
                    if(isset($responce['applicant_user_id'])){
                $uid = $responce['applicant_user_id'];
              }else{
                $uid = $responce['user_id'];
              }
                    
                   /* $sc_id = isset($responce['sc_id']) ? $responce['sc_id'] : NULL;
                    if($sc_id!=NULL){
                        
                    }*/
                    $q_id= $responce['q_id']; 

                    $data = Yii::app()->db->createCommand("SELECT q.id, q.querycode,q.mobile_no,q.email,q.query_type,sc.category_name, s.service_name, q.status, q.created_on,q.querypriority,q.subject FROM querymain as q 
						LEFT OUTER JOIN bo_information_wizard_service_master as s ON q.service_id=s.id
						LEFT OUTER JOIN bo_information_wizard_services_category as sc ON s.sc_id=sc.id    
						WHERE q.id=$q_id")->queryAll();
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

        public function actionQueryReplyReceived(){
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
                $q_id= $responce['q_id']; 

                $data = Yii::app()->db->createCommand("SELECT querymain_id, message, msgdatetime FROM querymessage			
							WHERE querymain_id=$q_id order by msgdatetime DESC")->queryAll();
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


/*
* before login query search BY Aamir
*/
public function actionQuerysearch(){
     $responce = json_decode(file_get_contents('php://input'), true);
     if(isset($responce['query_no']) && isset($responce['email'])){  
          if(isset($responce['applicant_user_id'])){
          $uid = $responce['applicant_user_id'];
        }else{
          $uid = $responce['user_id'];
        } 
            $q_code = $responce['query_no'];
            $email = $responce['email'];
            $record = Yii::app()->db->createCommand("SELECT *
             FROM querymain as q            
            WHERE q.querycode='".$q_code."' AND q.email='".$email."'")->queryRow();
            if($record){
                echo json_encode(['status'=>true,'msg'=>'success','user_id'=>$responce['user_id'],'applicant_user_id'=>$uid, 'data'=>$record]);
            }else{
                echo json_encode(['status'=>false,'msg'=>'No data found']);
            }
     }else{
            echo json_encode(['status'=>false,'msg'=>'Parameter missing']);
    }
}

/*
* before login query details BY Aamir
*/
public function actionQuerydetail(){
     $responce = json_decode(file_get_contents('php://input'), true);
     if(isset($responce['query_id'])){  
          if(isset($responce['applicant_user_id'])){
          $uid = $responce['applicant_user_id'];
        }else{
          $uid = $responce['user_id'];
        }

            $query_id = $responce['query_id'];           
            $record = Yii::app()->db->createCommand("SELECT q.id, q.querycode,q.query_type,
            q.mobile_no,
            q.email,
            q.name,
            q.servicecategory,
            q.service_id,
            q.user_id,
            q.querypriority,
            q.subject,
            q.created_on,
            q.status,
            s.service_name,
            sc.category_name
             FROM querymain as q 
            LEFT OUTER JOIN bo_information_wizard_service_master as s ON q.service_id=s.id
            LEFT OUTER JOIN bo_information_wizard_services_category as sc ON s.sc_id=sc.id  
            WHERE q.id=$query_id")->queryRow();
            $messages = Yii::app()->db->createCommand("SELECT *
             FROM querymessage          
            WHERE querymain_id=$query_id order by msgdatetime DESC")->queryAll();

            if($record){
                echo json_encode(['status'=>true,'msg'=>'success','user_id'=>$responce['user_id'],'applicant_user_id'=>$uid,'data'=>$record,'messages'=>$messages]);
            }else{
                echo json_encode(['status'=>false,'msg'=>'No data found']);
            }
     }else{
            echo json_encode(['status'=>false,'msg'=>'Parameter missing']);
    }
}

/*
* before login query reply by message BY Aamir
*/
public function actionQueryreply(){
     $responce = json_decode(file_get_contents('php://input'), true);
     if(isset($responce['query_id']) && isset($responce['message']) && isset($responce['user_id'])){  
          if(isset($responce['applicant_user_id'])){
          $uid = $responce['applicant_user_id'];
        }else{
          $uid = $responce['user_id'];
        } 
            $query_id = $responce['query_id'];   
            $message = $responce['message'];        
            
             $record = Yii::app()->db->createCommand("SELECT *
             FROM querymain as q            
            WHERE q.id=$query_id")->queryRow();
            if($record){
                Yii::app()->db->createCommand("INSERT INTO querymessage (message, user_type, querymain_id, msgdatetime)
            VALUES ('".$message."','AU','$query_id','".date('Y-m-d H:i:s')."')")->execute();
                echo json_encode(['status'=>true,'msg'=>'success','user_id'=>$responce['user_id'],'applicant_user_id'=>$uid,'query_id'=>$query_id]);
            }else{
                echo json_encode(['status'=>false,'msg'=>'No data found']);
            }
     }else{
            echo json_encode(['status'=>false,'msg'=>'Parameter missing']);
    }
}

public function actionTicketreply(){
     $responce = json_decode(file_get_contents('php://input'), true);
     if(isset($responce['supportmaincode']) && isset($responce['message']) && isset($responce['usercode'])){  
            if(isset($responce['applicant_user_id'])){
              $uid = $responce['applicant_user_id'];
            }else{
              $uid = $responce['usercode'];
            }  
            $supportmaincode = $responce['supportmaincode'];   
            $message = $responce['message']; 
            $usercode = $responce['usercode'];        
            
             $record = Yii::app()->db->createCommand("SELECT *
             FROM supportmain as s           
            WHERE supportmaincode ='".$supportmaincode."' AND usercode='".$usercode."'")->queryRow();
            if($record){
                Yii::app()->db->createCommand("INSERT INTO supportmessages (message, usercode, usertype, supportmaincode, msgdatetime)
            VALUES ('".$message."','$usercode','AU','$supportmaincode','".date('Y-m-d H:i:s')."')")->execute();
                echo json_encode(['status'=>true,'msg'=>'success','user_id'=>$responce['usercode'],'applicant_user_id'=>$uid,'supportmaincode'=>$supportmaincode]);
            }else{
                echo json_encode(['status'=>false,'msg'=>'No data found']);
            }
     }else{
            echo json_encode(['status'=>false,'msg'=>'Parameter missing']);
    }
}

public function actionUpdateTicketStatus(){
    
        $responce = json_decode(file_get_contents('php://input'), true);
        // print_r($responce);die;
        if(isset($responce['supportmaincode']) && isset($responce['status'])  && isset($responce['user_id']) ){ 
            if(isset($responce['applicant_user_id'])){
              $uid = $responce['applicant_user_id'];
            }else{
              $uid = $responce['user_id'];
            } 
            $supportmaincode = $responce['supportmaincode'];  
            $model = Supportmain::model()->findByPk($supportmaincode); 
            $model->status = $responce['status'];
            $model->updated_on = date('Y-m-d H:i:s');
            $model->save();
            $status_arr = ['O'=>'Open','RV'=>'Reverted','RS'=>'Resolved','RO'=>'Reopened','C'=>'Closed','W'=>'Withdrown','ESC'=>'Escalated'];
            
            echo json_encode(['status'=>true,'msg'=>'success','user_id'=>$responce['user_id'],'applicant_user_id'=>$uid,'status'=>$status_arr[$responce['status']]]);
            
        }else{
            echo json_encode(['status'=>false,'msg'=>'Parameter missing']);
        }  
    }



/*
* before login raise query BY Aamir
*/
public function actionSubmitquery(){
     $responce = json_decode(file_get_contents('php://input'), true);
     if(isset($responce['name']) && isset($responce['mobile']) && isset($responce['email']) && isset($responce['query_type'])  && isset($responce['subject']) && isset($responce['message'])){   
        if(isset($responce['applicant_user_id'])){
          $uid = $responce['applicant_user_id'];
        }else{
          $uid = $responce['user_id'];
        } 

        $service_category = isset($responce['service_category']) ? $responce['service_category']: NULL;
        $service_name = isset($responce['service_name']) ? $responce['service_name'] : NULL;

        $model = new Querymain;
        
        $next_id = Yii::app()->db->createCommand('SELECT IFNULL (max(id),0)+1 as max FROM querymain')->queryScalar();

        $model->querycode = date('y').$next_id;
        $model->subject = $responce['subject'];
        $model->servicecategory =  $service_category;
        $model->service_id = $service_name;
        $model->mobile_no = $responce['mobile'];
        $model->name = $responce['name'];
        $model->email = $responce['email'];
        $model->user_id = NULL;
        $model->query_type = $responce['query_type'];
        $model->querypriority = 'Normal';
        $model->updated_on = date('Y-m-d H:i:s');
        if($model->save()){
            Yii::app()->db->createCommand("INSERT INTO querymessage (message, user_type, querymain_id, msgdatetime)
            VALUES ('".$responce['message']."','AU','".$model->id."','".date('Y-m-d H:i:s')."')")->execute();

            echo json_encode(['status'=>true,'msg'=>'Success! query was submitted','query_code'=>$model->querycode,'query_id'=>$model->id,'user_id'=>$responce['user_id'],'applicant_user_id'=>$uid]);
        }else{
            echo json_encode(['status'=>false,'msg'=>'Failed! somethig went wrong please try again']);
        }               
           
     }else{
            echo json_encode(['status'=>false,'msg'=>'Parameter missing']);
    }
}


/*
* Get list of service category BY Aamir
*/
public function actionGetservicescategory(){
    
      $service_category = Yii::app()->db->createCommand("SELECT * FROM bo_information_wizard_services_category")->queryAll();
       echo json_encode(['status'=>true,'msg'=>'Success','service_category'=>$service_category]);
}

/*
* Get list of service name BY Aamir
*/
public function actionGetservices(){
     $responce = json_decode(file_get_contents('php://input'), true);
     //print_r($responce);die();
      if(isset($responce['category'])){ 
        $category = $responce['category'];
        $services = Yii::app()->db->createCommand("SELECT id,sc_id,service_name
              from bo_information_wizard_service_master             
               where sc_id=$category")->queryAll();
         echo json_encode(['status'=>true,'msg'=>'Success','services'=>$services]);
      }else{
        echo json_encode(['status'=>false,'msg'=>'Parameter missing']);
      }
}

/*
* Get list of tickets or query type BY Aamir
*/
public function actionTypes(){
    
     $type = array('Functional'=>'Functional','Technical'=>'Technical','Others'=>'Others');
       echo json_encode(['status'=>true,'msg'=>'Success','type'=>$type]);
}

public function actionUpdateTicket(){
    
     $type = array('Reopened'=>'Reopened','Closed'=>'Closed');
       echo json_encode(['status'=>true,'msg'=>'Success','type'=>$type]);
}

public function actionGetsrn(){
    $responce = json_decode(file_get_contents('php://input'), true);
    if(isset($responce['user_id']) && isset($_SERVER['HTTP_TOKEN'])){

        if(isset($responce['applicant_user_id'])){
          $uid = $responce['applicant_user_id'];
        }else{
          $uid = $responce['user_id'];
        } 

        $user_id = $responce['user_id'];
        $srns = Yii::app()->db->createCommand("SELECT submission_id, service_id FROM bo_new_application_submission WHERE user_id ='".$user_id."'")->queryAll();
        $srnss = array_merge([array('submission_id'=>'Other')],$srns);  

        echo json_encode(['status'=>true,'msg'=>'success','srnss'=>$srnss,'user_id'=>$responce['user_id'],'applicant_user_id'=>$uid]);
    }else{
        echo json_encode(['status'=>false,'msg'=>'Parameter missing']);
    }
}

public function actionGetcatser(){
    if(isset($_POST['user_id']) && isset($_POST['srn']) && isset($_SERVER['HTTP_TOKEN'])){

        if(isset($_POST['applicant_user_id'])){
          $uid = $_POST['applicant_user_id'];
        }else{
          $uid = $_POST['user_id'];
        } 
       $srn_no = $_POST['srn'];
       $srn = Yii::app()->db->createCommand("SELECT * from bo_new_application_submission where submission_id=$srn_no")->queryRow();
       if($srn){
         $service_id_array = explode(".",$srn['service_id']);
         $s_id = $service_id_array[0];
         $gsnacn = Yii::app()->db->createCommand("SELECT sm.id as ser_id,sm.sc_id as sercat_id,sm.service_name,sc.category_name 
            from bo_information_wizard_service_master as sm
            INNER JOIN bo_information_wizard_services_category as sc ON sm.sc_id=sc.id
             where sm.id=$s_id")->queryRow();
         if($gsnacn){
             echo CJavaScript::jsonEncode(array('msg'=>'success','status'=>true,
                'user_id'=>$_POST['user_id'],'applicant_user_id'=>$uid,
                'category_id'=>$gsnacn['sercat_id'],
                'category_name'=>$gsnacn['category_name'],
                'service_name'=>$gsnacn['service_name'],
                'service_id'=>$gsnacn['ser_id']));
         }else{
             echo CJavaScript::jsonEncode(array('status'=>false,'msg'=>'Something went wrong'));
         } 
       }else{
           echo json_encode(['status'=>false,'msg'=>'no data found']);
       } 
    }else{
        echo json_encode(['status'=>false,'msg'=>'Parameter missing']);
    }
}

/*
* Raise ticket FO user with file upload
*/
public function actionTicketraise(){    
    if(isset($_POST['user_id']) && isset($_SERVER['HTTP_TOKEN']) && isset($_POST['srn_app_id']) && isset($_POST['type'])  && isset($_POST['subject']) && isset($_POST['message'])){
        

        if(isset($_POST['applicant_user_id'])){
          $uid = $_POST['applicant_user_id'];
        }else{
          $uid = $_POST['user_id'];
        } 


        $servicecategory = isset($_POST['servicecategory']) ? $_POST['servicecategory'] : NULL;
        $service_id = isset($_POST['service_id']) ? $_POST['service_id'] : NULL;
        $file = isset($_FILES['file']) ? $_FILES['file'] : NULL;

            $model = new Supportmain;
            $model->servicecategory = $servicecategory;
            $next_id = Yii::app()->db->createCommand('SELECT IFNULL (max(supportmaincode),0)+1 as max FROM supportmain')->queryScalar();
            $model->supporttypecode = date('y').$next_id;
            $model->subject = $_POST['subject'];
            $model->service_id = $service_id;
            $model->srn_app_id = $_POST['srn_app_id'];
            $model->ticket_type = $_POST['type'];
            $model->supportprioritycode = 'Normal';
            $model->usercode = $_POST['user_id'];
            $model->updated_on = date('Y-m-d H:i:s');
            

            $model->save();
            $msgModel = new Supportmessages;
            $msgModel->message = $_POST['message'];
            $msgModel->usercode = $_POST['user_id'];
            $msgModel->usertype = "AU";
            $msgModel->supportmaincode = $model->supportmaincode;
            $msgModel->save();

            if($file!=NULL){
                 $targetDir = Yii::app()->basePath .'/uploads/tickets';
                 $file_name = $_FILES['file']['name']; 
                 if (!file_exists($targetDir)) {
                    @mkdir($targetDir);
                }
                $targetFile = $targetDir.'/'.$file_name;
                if(move_uploaded_file($_FILES['file']['tmp_name'], $targetFile)) {
                    $file_path = '/backoffice/protected/uploads/tickets/'.$file_name;
                    $file_msg = 'file uploaded';
                    $sfile = new Supportmsgfiles;
                    $sfile->msgfilepath = $file_path;
                    $sfile->supportmessagescode = $msgModel->supportmessagescode;
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
                where u.user_id=$model->usercode")->queryRow();
            $dear_name = $Appuserdetail['first_name'].' '.$Appuserdetail['last_name'].' '.$Appuserdetail['surname'];
            

            
        $subject = "CAIPO-Ticket";
        $to = $Appuserdetail['email'];
        $name = $dear_name;
        $notification_msg_fo = 'Your Ticket has been submitted successfully';
        $content = "Dear ".$dear_name.",<br><br> Your Ticket has been successfully submitted in CAIPO Portal. You are allotted Ticket ID <b>".$model->supporttypecode."</b> <br><br>Note: This is a system generated message. Please do not reply. For any queries reach out to CAIPO. <br><br>
        Regards,<br>
        Corporate Affairs and Intellectual Property Office<br>
        Ground Floor, BAOBAB Tower, Warrens<br>
        St. Michael, Barbados<br>
        Tel: (246) 535-2401 Fax: (246) 535-2444<br>
        <a href='".EMAIL_WEB_URL."' title='CAIPO Portal'>http://www.caipo.gov.bb</a><br>
        Email: <a href='#!' title='Email'>caipo.general@barbados.gov.bb</a>";


        $post_data= array('host'=>EMAIL_HOST,'port'=>EMAIL_PORT,'user'=>EMAIL_USERNAME,'pass'=>EMAIL_PASSWORD, 'subject'=>$subject,'to'=>$to,'content'=>$content,'email_name'=>EMAIL_NAME);                
        DefaultUtility::post_to_url(EMAIL_API,$post_data); 
        Alertsandnotification::sendnotification('Ticket', $model->supporttypecode,$model->supporttypecode,$model->usercode,'FO',$notification_msg_fo); 
        
        echo json_encode(['status'=>true,'msg'=>'Success! Ticket generated','file_msg'=>$file_msg,'ticket_id'=>$model->supportmaincode,'model_code'=>$model->supporttypecode,'user_id'=>$_POST['user_id'],'applicant_user_id'=>$uid]);
    }else{
         echo json_encode(['status'=>false,'msg'=>'Parameter missing']);
    }
}


//Query Raise

public function actionQueryRaise(){    
    $_POST = json_decode(file_get_contents('php://input'), true);
	// print_r($_POST);die();
    if(isset($_POST['user_id']) && isset($_SERVER['HTTP_TOKEN']) && isset($_POST['name']) && isset($_POST['email']) && isset($_POST['mobile_no'])  && isset($_POST['type'])  && isset($_POST['subject']) && isset($_POST['message'])){
        
        if(isset($_POST['applicant_user_id'])){
          $uid = $_POST['applicant_user_id'];
        }else{
          $uid = $_POST['user_id'];
        } 

        $servicecategory = isset($_POST['servicecategory']) ? $_POST['servicecategory'] : NULL;
        $service_id = isset($_POST['service_id']) ? $_POST['service_id'] : NULL;
      

            $model = new Querymain;
            $model->servicecategory = $servicecategory;
            $next_id = Yii::app()->db->createCommand('SELECT IFNULL (max(id),0)+1 as max FROM querymain')->queryScalar();
            $model->querycode = date('y').$next_id;
            $model->subject = $_POST['subject'];
            
            $model->service_id = $service_id;
            $model->name = $_POST['name'];
            $model->email = $_POST['email'];
            $model->mobile_no = $_POST['mobile_no'];
            $model->query_type = $_POST['type'];
            $model->querypriority = 'Normal';
            $model->user_id = $_POST['user_id'];
            $model->updated_on = date('Y-m-d H:i:s');
            $model->save();
			
			$msgModel = new Querymessage;
			$msgModel->message = $_POST['message'];
			$msgModel->user_type = $model->user_id == NULL ? "URU" :"AU";
			$msgModel->user_id = $_POST['user_id'];
			$msgModel->querymain_id = $model->id;
			//$msgModel->msgdatetime = date('Y-m-d H:i:s');
			$msgModel->save();
                  
            $Appuserdetail = Yii::app()->db->createCommand("SELECT u.email, p.* 
                from sso_users u 
                INNER JOIN sso_profiles p ON p.user_id=u.user_id
                where u.user_id=$model->user_id")->queryRow();
            $dear_name = $Appuserdetail['first_name'].' '.$Appuserdetail['last_name'].' '.$Appuserdetail['surname'];
            

            
        $subject = "CAIPO-Query";
        $to = $Appuserdetail['email'];
        $name = $dear_name;
        $notification_msg_fo = 'Your Query has been submitted successfully';
        $content = "Dear User, You have Successfully created a Query with Query ID  (".$model->querycode.") on CAIPO.<br><br>
            Regards,<br>
            Corporate Affairs and Intellectual Property Office<br>
            Ground Floor, BAOBAB Tower, Warrens<br>
            St. Michael, Barbados<br>
            Tel: (246) 535-2401 Fax: (246) 535-2444<br>
            <a href='".EMAIL_WEB_URL."' title='CAIPO Portal'>http://www.caipo.gov.bb</a><br>
            Email: <a href='#!' title='Email'>caipo.general@barbados.gov.bb</a>";


        $post_data= array('host'=>EMAIL_HOST,'port'=>EMAIL_PORT,'user'=>EMAIL_USERNAME,'pass'=>EMAIL_PASSWORD, 'subject'=>$subject,'message'=>$_POST['message'],'to'=>$to,'content'=>$content,'email_name'=>EMAIL_NAME);                
        DefaultUtility::post_to_url(EMAIL_API,$post_data); 
        Alertsandnotification::sendnotification('Query', $model->querycode,$model->querycode,$model->user_id,'FO',$notification_msg_fo); 
        
        echo json_encode(['status'=>true,'msg'=>'Success! Query generated','model_id'=>$model->id,'model_code'=>$model->querycode,'user_id'=>$_POST['user_id'],'applicant_user_id'=>$uid]);
    }else{
         echo json_encode(['status'=>false,'msg'=>'Parameter missing']);
    }
}






/* this below function is for test API of file upload
public function actionUploadf(){

    if(isset($_FILES['file'])){
        $file = $_FILES['file'];
         if($file!=NULL){
                 $targetDir = Yii::app()->basePath .'/uploads/tickets';
                 $file_name = $_FILES['file']['name']; 
                 if (!file_exists($targetDir)) {
                    @mkdir($targetDir);
                }
                $targetFile = $targetDir.'/'.$file_name;
                if(move_uploaded_file($_FILES['file']['tmp_name'], $targetFile)) {
                    $file_path = '/backoffice/protected/uploads/tickets/'.$file_name;
                    $file_msg = 'file uploaded';
                    $sfile = new Supportmsgfiles;
                    $sfile->msgfilepath = $file_path;
                    $sfile->supportmessagescode = 98;
                    $sfile->save();
                } else {
                    $file_msg = 'somthing went worng while uploading file';
                }
            }else{
                $file_msg = 'file not selected';
            }
             echo json_encode(['status'=>true,'file_msg'=>$file_msg,'f'=>$file]);
    }else{
        echo json_encode(['status'=>false,'msg'=>'Parameter missing']);
    }
}*/

// without login query

public function actionWithoutLoginQueryRaise(){    
    $_POST = json_decode(file_get_contents('php://input'), true);
    // print_r($_POST);die();
    if(isset($_POST['name']) && isset($_POST['email']) && isset($_POST['mobile_no'])  && isset($_POST['type'])  && isset($_POST['subject']) && isset($_POST['message'])){
        $servicecategory = isset($_POST['servicecategory']) ? $_POST['servicecategory'] : NULL;
        $service_id = isset($_POST['service_id']) ? $_POST['service_id'] : NULL;
      

            $model = new Querymain;
            $model->servicecategory = $servicecategory;
            $next_id = Yii::app()->db->createCommand('SELECT IFNULL (max(id),0)+1 as max FROM querymain')->queryScalar();
            $model->querycode = date('y').$next_id;
            $model->subject = $_POST['subject'];
            
            $model->service_id = $service_id;
            $model->name = $_POST['name'];
            $model->email = $_POST['email'];
            $model->mobile_no = $_POST['mobile_no'];
            $model->query_type = $_POST['type'];
            $model->querypriority = 'Normal';
         
            $model->updated_on = date('Y-m-d H:i:s');
            $model->save();
            
            $msgModel = new Querymessage;
            $msgModel->message = $_POST['message'];
            $msgModel->user_type = $model->user_id == NULL ? "URU" :"AU";
            
            $msgModel->querymain_id = $model->id;
            //$msgModel->msgdatetime = date('Y-m-d H:i:s');
            $msgModel->save();
                  
            $Appuserdetail = Yii::app()->db->createCommand("SELECT u.email, p.* 
                from sso_users u 
                INNER JOIN sso_profiles p ON p.user_id=u.user_id")->queryRow();
            $dear_name = $Appuserdetail['first_name'].' '.$Appuserdetail['last_name'].' '.$Appuserdetail['surname'];
            

            
        $subject = "CAIPO-Query";
        $to = $Appuserdetail['email'];
        $name = $dear_name;
        $notification_msg_fo = 'Your Query has been submitted successfully';
        $content = "Dear User, You have Successfully created a Query with Query ID  (".$model->querycode.") on CAIPO.<br><br>
            Regards,<br>
            Corporate Affairs and Intellectual Property Office<br>
            Ground Floor, BAOBAB Tower, Warrens<br>
            St. Michael, Barbados<br>
            Tel: (246) 535-2401 Fax: (246) 535-2444<br>
            <a href='".EMAIL_WEB_URL."' title='CAIPO Portal'>http://www.caipo.gov.bb</a><br>
            Email: <a href='#!' title='Email'>caipo.general@barbados.gov.bb</a>";


       
        
        echo json_encode(['status'=>true,'msg'=>'Success! Query generated','model_id'=>$model->id,'model_code'=>$model->querycode]);
    }else{
         echo json_encode(['status'=>false,'msg'=>'Parameter missing']);
    }
}

public function actionWithoutLoginQueryreply(){
     $responce = json_decode(file_get_contents('php://input'), true);
     if(isset($responce['query_id']) && isset($responce['message'])){  
         
            $query_id = $responce['query_id'];   
            $message = $responce['message'];        
            
             $record = Yii::app()->db->createCommand("SELECT *
             FROM querymain as q            
            WHERE q.id=$query_id")->queryRow();
            if($record){
                Yii::app()->db->createCommand("INSERT INTO querymessage (message, user_type, querymain_id, msgdatetime)
            VALUES ('".$message."','AU','$query_id','".date('Y-m-d H:i:s')."')")->execute();
                echo json_encode(['status'=>true,'msg'=>'success','query_id'=>$query_id]);
            }else{
                echo json_encode(['status'=>false,'msg'=>'No data found']);
            }
     }else{
            echo json_encode(['status'=>false,'msg'=>'Parameter missing']);
    }
}


public function actionWithoutLoginQueryActionDetailHeader(){
            $responce = json_decode(file_get_contents('php://input'), true);
        
                $is_match = $responce['q_id'];
                if($is_match==true){               
                    $q_id= $responce['q_id']; 

                    $data = Yii::app()->db->createCommand("SELECT q.id, q.querycode,q.mobile_no,q.email,q.query_type,sc.category_name, s.service_name, q.status, q.created_on,q.querypriority,q.subject FROM querymain as q 
                        LEFT OUTER JOIN bo_information_wizard_service_master as s ON q.service_id=s.id
                        LEFT OUTER JOIN bo_information_wizard_services_category as sc ON s.sc_id=sc.id    
                        WHERE q.id=$q_id")->queryAll();
                    // do your work here                 
                    echo json_encode(['status'=>true,'msg'=>'success','data'=>$data]);
                }else{
                    echo json_encode(['status'=>false,'msg'=>'failed','token_msg'=>'token failed']);
                }            
        }

        public function actionWithoutloginQuerysearch(){
             $responce = json_decode(file_get_contents('php://input'), true);
             if(isset($responce['query_no']) && isset($responce['email'])){  
              
                    $q_code = $responce['query_no'];
                    $email = $responce['email'];
                    $record = Yii::app()->db->createCommand("SELECT *
                     FROM querymain as q            
                    WHERE q.querycode='".$q_code."' AND q.email='".$email."'")->queryRow();
                    if($record){
                        echo json_encode(['status'=>true,'msg'=>'success', 'data'=>$record]);
                    }else{
                        echo json_encode(['status'=>false,'msg'=>'No data found']);
                    }
             }else{
                    echo json_encode(['status'=>false,'msg'=>'Parameter missing']);
            }
        }




}