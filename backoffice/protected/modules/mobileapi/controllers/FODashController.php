<?php

class FODashController extends Controller {

    function init() {

    }

/*
*  Test API without login
*/
    public function actionIndex() {
        $userID = 1;    
        $token = Token::gettoken($userID);
        echo json_encode(['status'=>true,'msg'=>'Success','token'=>$token]);
    }

    

/*
*  All Service filter
*/
    public function actionListofservice(){
        $responce = json_decode(file_get_contents('php://input'), true);
        if(isset($responce['user_id']) && isset($_SERVER['HTTP_TOKEN'])){   
            $is_match = Token::matchtoken($_SERVER['HTTP_TOKEN'],$responce['user_id']);
            if($is_match==true){
                
                $data = Yii::app()->db->createCommand("SELECT * FROM bo_information_wizard_services_category")->queryAll();
                // do your work here

                $token_msg = 'token match'; 
                $token = Token::gettoken($responce['user_id']);
                echo json_encode(['status'=>true,'msg'=>'success','token_msg'=>$token_msg,'token'=>$token,'user_id'=>$responce['user_id'],'data'=>$data]);
            }else{
                echo json_encode(['status'=>false,'msg'=>'failed','token_msg'=>'token failed']);
            }        
        }else{
            echo json_encode(['status'=>false,'msg'=>'token miss']);
        }
    }


/*
*  Status wise services list
*/
 public function actionSwsl(){
        $responce = json_decode(file_get_contents('php://input'), true);

        if(isset($responce['user_id']) && isset($_SERVER['HTTP_TOKEN']) && isset($responce['application_status'])){   
            $is_match = Token::matchtoken($_SERVER['HTTP_TOKEN'],$responce['user_id']);
            if($is_match==true){
                                                                                                 
             $sc_id = isset($responce['sc_id']) ? $responce['sc_id'] : NULL;   
                // do your work here
             $userID = isset($responce['applicant_user_id']) ? $responce['applicant_user_id'] : $responce['user_id'];
                $applications_data = $this->getappdataByservicestatus($userID,$sc_id,$responce['application_status']);

                $token_msg = 'token match'; 
                $token = Token::gettoken($responce['user_id']);
                echo json_encode(['status'=>true,'msg'=>'success','token_msg'=>$token_msg,'token'=>$token,'user_id'=>$responce['user_id'],'data'=>$applications_data,'sc_id'=>$sc_id ]);
            }else{
                echo json_encode(['status'=>false,'msg'=>'failed','token_msg'=>'token failed']);
            }        
        }else{
            echo json_encode(['status'=>false,'msg'=>'Parameters missing']);
        }
    }

//count no.

public function actionAppCount(){
    $responce = json_decode(file_get_contents('php://input'), true);
    if(isset($responce['user_id']) && isset($_SERVER['HTTP_TOKEN'])){   
        $is_match = Token::matchtoken($_SERVER['HTTP_TOKEN'],$responce['user_id']);
        if($is_match==true){

            $userID= $responce['user_id'];
            $sc_id = isset($responce['sc_id']) ? $responce['sc_id'] : NULL;   
            $count_data = $this->getservicescount($userID,$sc_id);

            $token_msg = 'token match'; 
            $token = Token::gettoken($responce['user_id']);
            echo json_encode(['status'=>true,'msg'=>'success','token_msg'=>$token_msg,'token'=>$token,'user_id'=>$responce['user_id'],'data'=>$count_data,'sc_id'=>$sc_id]);
        }else{
            echo json_encode(['status'=>false,'msg'=>'failed','token_msg'=>'token failed']);
        }        
    }else{
        echo json_encode(['status'=>false,'msg'=>'token miss']);
    }
}


//dashboard listing

public function actionAppDashlist(){
    $responce = json_decode(file_get_contents('php://input'), true);
    if(isset($responce['user_id']) && isset($_SERVER['HTTP_TOKEN'])){   
        $is_match = Token::matchtoken($_SERVER['HTTP_TOKEN'],$responce['user_id']);
        if($is_match==true){
            
         
           $submissionid = $responce['submission_id'];
            
            $data = Yii::app()->db->createCommand("SELECT bo_new_application_submission.*, bosp.is_certificate 
                FROM bo_new_application_submission
                 INNER JOIN bo_information_wizard_service_parameters bosp
      ON bo_new_application_submission.service_id=CONCAT(bosp.service_id,'.',bosp.servicetype_additionalsubservice) 
                where where  bosp.is_active='Y' AND submission_id= '".$submissionid."'")->queryRow();
            // do your work here    
           
            $responceData=[];
            if(empty($data)){
                echo json_encode(['status'=>true,'msg'=>'No data found','token_msg'=>$token_msg,'token'=>$token,'user_id'=>$responce['user_id'],'data'=>$responceData,'submission_id'=>$submissionid]);
                exit;
            }else{
                $responceData['submission_id']=$submissionid = $data['submission_id'];
                $responceData['service_name']=$app_name = $data['app_name'];
                $responceData['application_created_date']=$application_created_date = $data['application_created_date'];
                $responceData['application_status']=$application_status = $data['application_status'];
              
                $token_msg = 'token match'; 
                $token = Token::gettoken($responce['user_id']);
                
                echo json_encode(['status'=>true,'msg'=>'success','token_msg'=>$token_msg,'token'=>$token,'user_id'=>$responce['user_id'],'data'=>$responceData,'submission_id'=>$submissionid]);
            }            
        }else{
            echo json_encode(['status'=>false,'msg'=>'failed','token_msg'=>'token failed']);
        }        
    }else{
        echo json_encode(['status'=>false,'msg'=>'token miss']);
    }
}

    
// Ex: Post Incorporation - Form 4, Form 5, form 21 etc...
     
    public function actionInternallistservice(){
        $responce = json_decode(file_get_contents('php://input'), true);
        if(isset($responce['user_id']) && isset($_SERVER['HTTP_TOKEN'])){   
            $is_match = Token::matchtoken($_SERVER['HTTP_TOKEN'],$responce['user_id']);
            if($is_match==true){
                
             
                $scid = $responce['sc_id'];
               // $service_id = $responce['service_id'];
                
                $data = Yii::app()->db->createCommand("  SELECT p.service_id,p.core_service_name as service_name,sm.service_description, 
(select group_concat(fee_amount) from  tbl_service_fee where status='1' and  case when service_id='2.0' then page_form_id!=1 else 1 end and tbl_service_fee.service_id = CONCAT(p.service_id,'.',p.servicetype_additionalsubservice)) as fee_amount
                                FROM bo_information_wizard_service_parameters p
                                INNER JOIN bo_information_wizard_service_master sm ON p.service_id = sm.id
                                WHERE sm.sc_id ='".$scid."'  AND p.is_active='Y'")->queryAll();

              



                         // echo "<pre>";print_r($data);die;
                // do your work here    
                
                
                $token_msg = 'token match'; 
                $token = Token::gettoken($responce['user_id']);
                echo json_encode(['status'=>true,'msg'=>'success','token_msg'=>$token_msg,'token'=>$token,'user_id'=>$responce['user_id'],'data'=>$data,'sc_id'=>$scid]);
                
            }else{
                echo json_encode(['status'=>false,'msg'=>'failed','token_msg'=>'token failed']);
            }        
        }else{
            echo json_encode(['status'=>false,'msg'=>'token miss']);
        }
    }

   


    //VPD Dashboard count no.

    public function actionVPDDashCount(){
        $responce = json_decode(file_get_contents('php://input'), true);
        if(isset($responce['user_id']) && isset($_SERVER['HTTP_TOKEN'])){   
            $is_match = Token::matchtoken($_SERVER['HTTP_TOKEN'],$responce['user_id']);
            if($is_match==true){
                
               /* $sc_id = isset($responce['sc_id']) ? $responce['sc_id'] : NULL;
                if($sc_id!=NULL){
                    
                }*/
                $userID= $responce['user_id']; 
                
                 

                 $sql = "SELECT COUNT(CASE when doc_status='P' then id end) as documentpending_count, 
                                COUNT(CASE when doc_status='D' then id end) as downloaded_count,                                
                        (SELECT COUNT(CASE when doc_status='PD' then id end) as paymentdue_count FROM temp_vpd_doclist WHERE user_id='".$userID."') AS               paymentdue_count,     
                        (SELECT COUNT(CASE when doc_status='C' then id end) as cart_count FROM temp_vpd_doclist WHERE user_id='".$userID."')               AS cart_count
                        FROM vpd_documents WHERE user_id='".$userID."'";                  
                   //print_r($sql);
                  // die;
               
               $data=Yii::app()->db->createCommand($sql)->queryAll();      
                                             
               

                $token_msg = 'token match'; 
                $token = Token::gettoken($responce['user_id']);
                echo json_encode(['status'=>true,'msg'=>'success','token_msg'=>$token_msg,'token'=>$token,'user_id'=>$responce['user_id'],'data'=>$data]);
            }else{
                echo json_encode(['status'=>false,'msg'=>'failed','token_msg'=>'token failed']);
            }        
        }else{
            echo json_encode(['status'=>false,'msg'=>'token miss']);
        }
    }


    //VPD Dashoboard Application List


     public function actionVPDDashList(){
        $responce = json_decode(file_get_contents('php://input'), true);
        if(isset($responce['user_id']) && isset($_SERVER['HTTP_TOKEN'])){   
            $is_match = Token::matchtoken($_SERVER['HTTP_TOKEN'],$responce['user_id']);
            if($is_match==true){
                
               /* $sc_id = isset($responce['sc_id']) ? $responce['sc_id'] : NULL;
                if($sc_id!=NULL){
                    
                }*/
                $userID= $responce['user_id'];    

                 $sql = "SELECT vpd.id, vpd.doc_status, bosp1.core_service_name as ser_name_for_documentname,
                        (SELECT company_name FROM bo_company_details c WHERE c.service_id=vpd.entity_service_id AND c.reg_no=vpd.entity_reg_no) as company_name
                        FROM vpd_documents vpd          
                        INNER JOIN bo_information_wizard_service_parameters bosp
                        ON vpd.entity_service_id=CONCAT(bosp.service_id,'.',bosp.servicetype_additionalsubservice)
                        INNER JOIN bo_new_application_submission a
                        ON vpd.srn_no=a.submission_id
                        INNER JOIN bo_information_wizard_service_parameters bosp1
                        ON a.service_id=CONCAT(bosp1.service_id,'.',bosp1.servicetype_additionalsubservice)
                        WHERE bosp.is_active='Y' AND bosp1.is_active='Y' AND vpd.user_id= '".$userID."'
                        Order by id DESC ";                  
                   //print_r($sql);
                  // die;
               
               $data=Yii::app()->db->createCommand($sql)->queryAll();                    

                $token_msg = 'token match'; 
                $token = Token::gettoken($responce['user_id']);
                echo json_encode(['status'=>true,'msg'=>'success','token_msg'=>$token_msg,'token'=>$token,'user_id'=>$responce['user_id'],'data'=>$data]);
            }else{
                echo json_encode(['status'=>false,'msg'=>'failed','token_msg'=>'token failed']);
            }        
        }else{
            echo json_encode(['status'=>false,'msg'=>'token miss']);
        }
    }

//Entity Document Summery


     public function actionVPDEntityDocumentSummery(){
        $responce = json_decode(file_get_contents('php://input'), true);
        if(isset($responce['user_id']) && isset($_SERVER['HTTP_TOKEN'])){   
            $is_match = Token::matchtoken($_SERVER['HTTP_TOKEN'],$responce['user_id']);
            if($is_match==true){
                
               /* $sc_id = isset($responce['sc_id']) ? $responce['sc_id'] : NULL;
                if($sc_id!=NULL){
                    
                }*/
                $userID= $responce['user_id'];    

                 $sql = "SELECT (SELECT company_name FROM bo_company_details c WHERE c.service_id=vpd.entity_service_id AND c.reg_no=vpd.entity_reg_no) as company_name,vpd.entity_service_id,vpd.entity_reg_no,bosp.core_service_name,
                        COUNT(CASE when vpd.doc_status IN ('P','D','E') then vpd.id end) as paid_docs,
                        COUNT(CASE when vpd.doc_status IN ('D') then vpd.id end) as downloades_docs,
                         vpd.created_on FROM vpd_documents vpd
                        INNER JOIN bo_information_wizard_service_parameters bosp
                        ON vpd.entity_service_id=CONCAT(bosp.service_id,'.',bosp.servicetype_additionalsubservice)
                        WHERE bosp.is_active='Y' AND vpd.user_id= '".$userID."' GROUP BY vpd.entity_reg_no, vpd.entity_service_id order by vpd.created_on DESC";                  
                   
               
               $data=Yii::app()->db->createCommand($sql)->queryAll();       
               // print_r($data);
               //     die;             

                $token_msg = 'token match'; 
                $token = Token::gettoken($responce['user_id']);
                echo json_encode(['status'=>true,'msg'=>'success','token_msg'=>$token_msg,'token'=>$token,'user_id'=>$responce['user_id'],'data'=>$data]);
            }else{
                echo json_encode(['status'=>false,'msg'=>'failed','token_msg'=>'token failed']);
            }        
        }else{
            echo json_encode(['status'=>false,'msg'=>'token miss']);
        }
    }

    //vpd entity document detail 
     public function actionVPDEntityDocumentDetail(){
        $responce = json_decode(file_get_contents('php://input'), true);
        if(isset($responce['user_id']) && isset($_SERVER['HTTP_TOKEN'])){   
            $is_match = Token::matchtoken($_SERVER['HTTP_TOKEN'],$responce['user_id']);

            if($is_match==true){                
               /* $sc_id = isset($responce['sc_id']) ? $responce['sc_id'] : NULL;
                if($sc_id!=NULL){
                    
                }*/
                $user_id= $responce['user_id'];    
                $reg_no = $responce['entity_reg_no'];   
                $service_id = $responce['entity_service_id']; 
				 //print_r($responce);die;
                  $sql ="SELECT  (SELECT company_name FROM bo_company_details c WHERE c.service_id=vpd.entity_service_id AND c.reg_no=vpd.entity_reg_no) as company_name, bosp.core_service_name, bosp1.core_service_name as ser_name_for_documentname, vpd.expired_on, vpd.doc_status
                       FROM vpd_documents vpd INNER JOIN bo_information_wizard_service_parameters bosp
                        ON vpd.entity_service_id=CONCAT(bosp.service_id,'.',bosp.servicetype_additionalsubservice)
                        INNER JOIN bo_new_application_submission a
                        ON vpd.srn_no=a.submission_id
                        INNER JOIN bo_information_wizard_service_parameters bosp1
                        ON a.service_id=CONCAT(bosp1.service_id,'.',bosp1.servicetype_additionalsubservice)
                        WHERE bosp.is_active='Y' AND bosp1.is_active='Y' AND vpd.user_id=$user_id AND vpd.entity_reg_no ='".$reg_no."' AND vpd.entity_service_id ='".$service_id."' order by vpd.created_on DESC";                  
                 
              
                 $data=Yii::app()->db->createCommand($sql)->queryAll();                       
				  // print_r($data);
      //             die;
                $token_msg = 'token match'; 
                $token = Token::gettoken($responce['user_id']);
                echo json_encode(['status'=>true,'ms

                    g'=>'success','token_msg'=>$token_msg,'token'=>$token,'user_id'=>$responce['user_id'],'data'=>$data]);
            }else{
                echo json_encode(['status'=>false,'msg'=>'failed','token_msg'=>'token failed']);
            }        
        }else{
            echo json_encode(['status'=>false,'msg'=>'token miss']);
        }
    }

    // VPD filter form data list

 public function actionVPDfilterlist(){
        $responce = json_decode(file_get_contents('php://input'), true);
        if(isset($responce['user_id']) && isset($_SERVER['HTTP_TOKEN'])){   
            $is_match = Token::matchtoken($_SERVER['HTTP_TOKEN'],$responce['user_id']);

            if($is_match==true){                
               /* $sc_id = isset($responce['sc_id']) ? $responce['sc_id'] : NULL;
                if($sc_id!=NULL){
                    
                }*/ 
                $records = NULL;
        if(isset($responce['entity_type'])){
            $entity_type = $responce['entity_type'];
            $company_name = $responce['company_name'];
            $company_reg_no = $responce['company_reg_no'];
           
          // $state_parish_txt = NULL;
            $cofo = $responce['cofo'];
            if($cofo=='barbados'){
                $state_parish_sel = isset($responce['state_parish_sel']) ? $responce['state_parish_sel'] : NULL;
                $state_parish_txt = NULL;
            }else{
                $state_parish_sel = NULL;
                $state_parish_txt = isset($responce['state_parish_txt']) ? $responce['state_parish_txt'] : NULL;

               // $state_parish_txt = $responce['state_parish_txt'];
            }

            switch ($entity_type) {
                case 'Company':
                    $service_id_in = '(4.0, 5.0, 8.0)';
                    break;
                case 'Society':
                    $service_id_in = '(9.0)';
                    break;
                case 'Charity':
                    $service_id_in = '(6.0, 7.0)';
                    break;
                case 'LLP':
                    $service_id_in = '(10.0)';
                    break;
                case 'Business Name Registration':
                    $service_id_in = '(2.0)';
                    break;
                default:
                    $service_id_in = NULL;
                    break;
            }

            if($service_id_in){
                if($cofo=='barbados'){
                    if($entity_type=='Business Name Registration'){
                        $country_con = $state_parish_con = '';
                    }else{
                        $country_con = 'AND country="barbados"';
                        if($state_parish_sel){
                            $state_parish_con = 'AND state_parish_id='.$state_parish_sel;
                        }else{
                            $state_parish_con = '';
                        }
                    }                   
                }else{
                    $state_parish_txt = isset($responce['state_parish_txt']) ? $responce['state_parish_txt'] : NULL;

                    $country_con = 'AND country!="barbados"';
                    if($state_parish_txt){
                        $state_parish_con = 'AND state_parish LIKE "%'.$state_parish_txt.'%" ';
                    }else{
                        $state_parish_con = '';
                    }
                }

             $state_parish_txt ;

                if($company_name){
                    $company_name_con = 'AND company_name LIKE "%'.$company_name.'%" ';
                }else{
                    $company_name_con = '';
                }

                if($company_reg_no){
                    $company_reg_no_con = 'AND reg_no='.$company_reg_no;
                }else{
                    $company_reg_no_con = '';
                }
                
                
                $records = Yii::app()->db->createCommand("SELECT * FROM bo_company_details WHERE service_id IN $service_id_in $country_con $company_name_con $state_parish_con $company_reg_no_con")->queryAll();

            }

            $records_search = true;
        }else{
            $entity_type = 'Company';
            $cofo = 'barbados';
            $company_name = $company_reg_no = $state_parish_sel = $state_parish_txt = NULL;
            $records_search = false;
        }              

                $token_msg = 'token match'; 
                $token = Token::gettoken($responce['user_id']);
                echo json_encode(['status'=>true,'msg'=>'success','token_msg'=>$token_msg,'token'=>$token,'user_id'=>$responce['user_id'],'records'=>$records]);
            }else{
                echo json_encode(['status'=>false,'msg'=>'failed','token_msg'=>'token failed']);
            }        
        }else{
            echo json_encode(['status'=>false,'msg'=>'token miss']);
        }
    }


//VPD bucekt and filling year filter list


     public function actionVPDBucketfillingyearlist(){
        $responce = json_decode(file_get_contents('php://input'), true);
        if(isset($responce['user_id']) && isset($_SERVER['HTTP_TOKEN'])){   
            $is_match = Token::matchtoken($_SERVER['HTTP_TOKEN'],$responce['user_id']);

            if($is_match==true){                
                $user_id= $responce['user_id'];                
                $sql ="SELECT * FROM bo_information_wizard_services_category";                  
                $data=Yii::app()->db->createCommand($sql)->queryAll();  
                for ($i=2015; $i <= 2030 ; $i++) { 
                   $res[] = $i;
                }  
                $resutl['service_category_sel'] =  $data;
                $resutl['year_sel']             =  $res;          
                $token_msg = 'token match'; 
                $token = Token::gettoken($responce['user_id']);
                echo json_encode(['status'=>true,'msg'=>'success','token_msg'=>$token_msg,'token'=>$token,'user_id'=>$responce['user_id'],'data'=>$resutl]);
            }else{
                echo json_encode(['status'=>false,'msg'=>'failed','token_msg'=>'token failed']);
            }        
        }else{
            echo json_encode(['status'=>false,'msg'=>'token miss']);
        }
    }




// VPD after click 500015 then select service category and filling year filter list


    public function actionVPDfillingyearlist(){
           $responce = json_decode(file_get_contents('php://input'), true);
           if(isset($responce['user_id']) && isset($_SERVER['HTTP_TOKEN'])){   
               $is_match = Token::matchtoken($_SERVER['HTTP_TOKEN'],$responce['user_id']);

               if($is_match==true){ 
                $user_id= $responce['user_id'];
                $year_sel= $responce['year_sel'];
                $service_category_sel= $responce['service_category_sel'];
                $reg_no= $responce['reg_no'];
                $service_id= $responce['service_id'];

                                 
                   // $serviceIds = $responce['serviceIds'];;
                    //$serviceIds=implode(',', $serviceIds);
                   $entity_records = Yii::app()->db->createCommand("SELECT * FROM bo_company_details WHERE reg_no ='".$reg_no."' AND service_id IN ('".$service_id."')")->queryRow();
                   if(isset($responce['service_category_sel']) && isset($responce['year_sel'])){
                    $service_category_sel = $responce['service_category_sel'];
                    $year_sel = $responce['year_sel']; 
                    switch ($responce['service_category_sel']) {
                        case '1':
                             $ser_con = "AND a.service_id='2.0'";
                            break;
                        case '2':
                             $ser_con = "AND a.service_id IN ('4.0','5.0','6.0','7.0','8.0','9.0','10.0')";
                            break;
                        case '3':
                             $ser_con = "AND a.service_id IN ('19.0','20.0','21.0','22.0','23.0','24.0','25.0','33.0')";
                            break;
                        case '4':
                             $ser_con = "AND a.service_id IN ('37.0','38.0')";
                            break;
                        case '5':
                             $ser_con = "AND a.service_id IN ('39.0','40.0','41.0','42.0','43.0','44.0')";
                            break;
                        case '6':
                             $ser_con = "AND a.service_id IN ('11.0','12.0','13.0','14.0','15.0','16.0','17.0','18.0','26.0','27.0','28.0','29.0','30.0','31.0','32.0','34.0','35.0','36.0')";
                            break;
                        default:
                            $ser_con = "";
                            break;
                    }   
            if($responce['service_category_sel']==1 || $responce['service_category_sel']==2){
                $subID = $entity_records['srn_no'];
                $submissiondaterecord =  Yii::app()->db->createCommand("SELECT   bosp.core_service_name a.application_updated_date_time
                  FROM bo_new_application_submission a
                  INNER JOIN bo_information_wizard_service_parameters bosp
                  ON a.service_id=CONCAT(bosp.service_id,'.',bosp.servicetype_additionalsubservice)

                  where bosp.is_active='Y' AND a.submission_id = $subID and a.application_status='A' AND year(a.application_updated_date_time)=$year_sel $ser_con order BY a.application_updated_date_time ASC")->queryAll();
            }else{
                $submissiondaterecord =  Yii::app()->db->createCommand("SELECT a.submission_id, a.service_id, a.application_updated_date_time, bosp.is_certificate, bosp.core_service_name
                  FROM bo_new_application_submission a
                  INNER JOIN bo_information_wizard_service_parameters bosp
                  ON a.service_id=CONCAT(bosp.service_id,'.',bosp.servicetype_additionalsubservice)

                  where bosp.is_active='Y' AND a.application_status='A' AND year(a.application_updated_date_time)=$year_sel  AND a.entity_name = '".$reg_no."' $ser_con
                   order BY a.application_updated_date_time ASC")->queryAll();
            }
                    
                    /*$submissiondaterecord =  Yii::app()->db->createCommand("SELECT * FROM bo_infowiz_form_builder_application_log where app_Sub_id = $subID and action_status='A' AND year(created)=$year_sel $ser_con order BY id DESC")->queryRow();*/  
                    $records_search = true; 
                   }else{
                    $records_search = false;
                    $submissiondaterecord = $service_category_sel = $year_sel = NULL;
                   }

                   $token_msg = 'token match'; 
                   $token = Token::gettoken($responce['user_id']);
                   echo json_encode(['status'=>true,'msg'=>'success','token_msg'=>$token_msg,'token'=>$token,'user_id'=>$responce['user_id'],'submissiondaterecord'=>$submissiondaterecord]);
               }else{
                   echo json_encode(['status'=>false,'msg'=>'failed','token_msg'=>'token failed']);
               }        
           }else{
               echo json_encode(['status'=>false,'msg'=>'token miss']);
           }
       }



//timeline icon data
        public function actionTimelinedetail(){
           $responce = json_decode(file_get_contents('php://input'), true);
           if(isset($responce['user_id']) && isset($_SERVER['HTTP_TOKEN'])){   
               $is_match = Token::matchtoken($_SERVER['HTTP_TOKEN'],$responce['user_id']);

               if($is_match==true){                
                  /* $sc_id = isset($responce['sc_id']) ? $responce['sc_id'] : NULL;
                   if($sc_id!=NULL){
                       
                   }*/
                   $user_id= $responce['user_id'];    
                   $subID = $responce['app_Sub_id'];   
                  

                     $sql ="SELECT log.created, log.action_taken_by_name, log.action_status, log.action_message, ifnull(datediff(created, (select created from bo_infowiz_form_builder_application_log log1 where app_Sub_id='".$subID."' and log1.id < log.id order by id desc limit 1 )),0) as time_taken  from  bo_infowiz_form_builder_application_log log where app_Sub_id='".$subID."'";                  
                      //print_r($sql);
                     // die;
                 
                  $data=Yii::app()->db->createCommand($sql)->queryAll();                    

                   $token_msg = 'token match'; 
                   $token = Token::gettoken($responce['user_id']);
                   echo json_encode(['status'=>true,'msg'=>'success','token_msg'=>$token_msg,'token'=>$token,'user_id'=>$responce['user_id'],'data'=>$data]);
               }else{
                   echo json_encode(['status'=>false,'msg'=>'failed','token_msg'=>'token failed']);
               }        
           }else{
               echo json_encode(['status'=>false,'msg'=>'token miss']);
           }
       }

    //Applicant uploaded document management detail

        public function actionUplodeddocumentdetail(){
           $responce = json_decode(file_get_contents('php://input'), true);
           if(isset($responce['user_id']) && isset($_SERVER['HTTP_TOKEN'])){   
               $is_match = Token::matchtoken($_SERVER['HTTP_TOKEN'],$responce['user_id']);

               if($is_match==true){                
                  /* $sc_id = isset($responce['sc_id']) ? $responce['sc_id'] : NULL;
                   if($sc_id!=NULL){
                       
                   }*/
                   $user_id= $responce['user_id'];    
                   $subID = $responce['sno'];   
                  

                     $sql ="SELECT dc.name, dm.created_on, dm.usercomment FROM bo_application_dms_documents_mapping dm
                            INNER JOIN bo_infowizard_documentchklist dc on dc.docchk_id=dm.doc_id
                            WHERE sno='".$subID."' AND dm.status='V'";                  
                      //print_r($sql);
                     // die;
                 
                  $data=Yii::app()->db->createCommand($sql)->queryAll();                    

                   $token_msg = 'token match'; 
                   $token = Token::gettoken($responce['user_id']);
                   echo json_encode(['status'=>true,'msg'=>'success','token_msg'=>$token_msg,'token'=>$token,'user_id'=>$responce['user_id'],'data'=>$data]);
               }else{
                   echo json_encode(['status'=>false,'msg'=>'failed','token_msg'=>'token failed']);
               }        
           }else{
               echo json_encode(['status'=>false,'msg'=>'token miss']);
           }
       }

       //VPD cart detail

        public function actionVPDCartdetaillist(){
           $responce = json_decode(file_get_contents('php://input'), true);
           if(isset($responce['user_id']) && isset($_SERVER['HTTP_TOKEN'])){   
               $is_match = Token::matchtoken($_SERVER['HTTP_TOKEN'],$responce['user_id']);

               if($is_match==true){                
                  /* $sc_id = isset($responce['sc_id']) ? $responce['sc_id'] : NULL;
                   if($sc_id!=NULL){
                       
                   }*/
                   $user_id= $responce['user_id'];    
                  

                     $sql ="SELECT (SELECT company_name FROM bo_company_details c WHERE c.service_id=t.entity_service_id AND c.reg_no=t.entity_reg_no) as company_name, bosp.core_service_name, a.application_updated_date_time,t.doc_status
                        FROM temp_vpd_doclist t INNER JOIN bo_new_application_submission a ON t.srn_no=a.submission_id
                        INNER JOIN bo_information_wizard_service_parameters bosp ON a.service_id=CONCAT(bosp.service_id,'.',bosp.servicetype_additionalsubservice) WHERE bosp.is_active='Y' AND t.user_id='".$user_id."' order BY t.id ASC";                  
                      //print_r($sql);
                     // die;
                 
                  $data=Yii::app()->db->createCommand($sql)->queryAll();                    

                   $token_msg = 'token match'; 
                   $token = Token::gettoken($responce['user_id']);
                   echo json_encode(['status'=>true,'msg'=>'success','token_msg'=>$token_msg,'token'=>$token,'user_id'=>$responce['user_id'],'data'=>$data]);
               }else{
                   echo json_encode(['status'=>false,'msg'=>'failed','token_msg'=>'token failed']);
               }        
           }else{
               echo json_encode(['status'=>false,'msg'=>'token miss']);
           }
       }


    // VPD payment form


        public function actionVPDpaymentdetail(){
           $responce = json_decode(file_get_contents('php://input'), true);
           if(isset($responce['user_id']) && isset($_SERVER['HTTP_TOKEN'])){   
               $is_match = Token::matchtoken($_SERVER['HTTP_TOKEN'],$responce['user_id']);

               if($is_match==true){                
                  /* $sc_id = isset($responce['sc_id']) ? $responce['sc_id'] : NULL;
                   if($sc_id!=NULL){
                       
                   }*/
                   $user_id= $responce['user_id'];    
                  

                     $sql ="SELECT (SELECT company_name FROM bo_company_details c WHERE c.service_id=vpd.entity_service_id AND c.reg_no=vpd.entity_reg_no) as company_name, bosp.core_service_name, bosp1.core_service_name as ser_name_for_documentname
                        FROM temp_vpd_doclist vpd INNER JOIN bo_information_wizard_service_parameters bosp
                        ON vpd.entity_service_id=CONCAT(bosp.service_id,'.',bosp.servicetype_additionalsubservice)
                        INNER JOIN bo_new_application_submission a ON vpd.srn_no=a.submission_id
                        INNER JOIN bo_information_wizard_service_parameters bosp1
                        ON a.service_id=CONCAT(bosp1.service_id,'.',bosp1.servicetype_additionalsubservice)
                        WHERE bosp.is_active='Y' AND bosp1.is_active='Y' AND vpd.user_id='".$user_id."' AND doc_status='PD' order BY vpd.id ASC";                  
                      //print_r($sql);
                     // die;
                 
                  $data=Yii::app()->db->createCommand($sql)->queryAll();                    

                   $token_msg = 'token match'; 
                   $token = Token::gettoken($responce['user_id']);
                   echo json_encode(['status'=>true,'msg'=>'success','token_msg'=>$token_msg,'token'=>$token,'user_id'=>$responce['user_id'],'data'=>$data]);
               }else{
                   echo json_encode(['status'=>false,'msg'=>'failed','token_msg'=>'token failed']);
               }        
           }else{
               echo json_encode(['status'=>false,'msg'=>'token miss']);
           }
       }
	   
	
public function actionCtspcrdashboard(){
     $responce = json_decode(file_get_contents('php://input'), true);
       if(isset($responce['user_id']) && isset($responce['user_type']) && isset($_SERVER['HTTP_TOKEN'])){   
            // echo "<pre>";print_r($responce);die;
           $is_match = Token::matchtoken($_SERVER['HTTP_TOKEN'],$responce['user_id']);

           if($is_match==true){ 
            if($responce['user_type']==2){
               $token_msg = 'token match'; 
               $token = Token::gettoken($responce['user_id']);
               $user_id= $responce['user_id']; 

               $user_detail = Yii::app()->db->createCommand("SELECT * FROM sso_users where is_account_active='Y'AND user_id=$user_id")->queryRow();                    
               $email = $user_detail['email'];
               $user_id = $user_detail['user_id'];
               $applicant_company = Yii::app()->db->createCommand("SELECT a.id as asp_id ,a.email,c.reg_no,c.company_name, a.user_id, up.*
                FROM agent_service_provider a
                INNER JOIN sso_users u ON u.user_id= a.user_id
                INNER JOIN sso_profiles up ON up.user_id= u.user_id
                INNER JOIN bo_company_details c ON c.id = a.company_id
                where u.is_account_active='Y' AND  a.is_active=1 AND u.user_type=1 AND a.is_revoke=0 AND a.sp_status IN ('O') AND (a.email = '".$email."' OR agent_user_id=$user_id)")->queryAll();
               if(isset($responce['asp_id'])){
                 $check_key = Yii::app()->db->createCommand("SELECT *
                    from agent_service_provider where id=".$responce['asp_id'])->queryRow(); 
                    // do dashboard code here for dashboard use user_id = $check_key['user_id']

                  $token_msg = 'token match'; 
                  $token = Token::gettoken($responce['user_id']);

                if($check_key){
                   $app_user_id =  $check_key['user_id'];
                   $sc_id = isset($responce['sc_id']) ? $responce['sc_id'] : NULL;
                   $count_data = $this->getservicescount($app_user_id,$sc_id);
                   echo json_encode(['status'=>true,'msg'=>'success! counts and application records fetch','token_msg'=>$token_msg,'token'=>$token,'user_id'=>$responce['user_id'],'applicant_company'=>$applicant_company,'services_count_data'=>$count_data,'applicant_user_id'=>$app_user_id,'sc_id'=>$sc_id]);
                }else{
                    echo json_encode(['status'=>true,'msg'=>'NO data found for selected entity','token_msg'=>$token_msg,'token'=>$token,'user_id'=>$responce['user_id'],'applicant_company'=>$applicant_company,'services_count_data'=>[]]);
                }            

               }else{
                echo json_encode(['status'=>true,'msg'=>'success','token_msg'=>$token_msg,'token'=>$token,'user_id'=>$responce['user_id'],'applicant_company'=>$applicant_company]);
               }      
            }else{
                echo json_encode(['status'=>false,'msg'=>'user type not match']);
            }           
        }else{
            // die('dsjdsk');
               echo json_encode(['status'=>false,'msg'=>'failed','token_msg'=>'token failed']);
           }        
       }else{
           echo json_encode(['status'=>false,'msg'=>'Parameter missing']);
       }
}

public function actionSubuserdashboard(){
     $responce = json_decode(file_get_contents('php://input'), true);
       if(isset($responce['user_id']) && isset($responce['user_type']) && isset($_SERVER['HTTP_TOKEN'])){   
           $is_match = Token::matchtoken($_SERVER['HTTP_TOKEN'],$responce['user_id']);

           if($is_match==true){ 
            if($responce['user_type']==3){
                $user_id= $responce['user_id'];    
                $token_msg = 'token match'; 
                $token = Token::gettoken($responce['user_id']);                  
                
                $user = Yii::app()->db->createCommand("SELECT * FROM sso_users where is_account_active='Y'AND user_id=$user_id")->queryRow();                    
               $email = $user['email'];

                $applicant_company = Yii::app()->db->createCommand("SELECT a.id, am.id as asp_sum_id, a.email,c.reg_no,c.company_name, a.user_id, up.*
                    FROM agent_service_provider_sub_user_mapping am
                    INNER JOIN  agent_service_provider a ON am.asp_id = a.id
                    INNER JOIN sso_users u ON u.user_id= a.user_id
                    INNER JOIN sso_profiles up ON up.user_id= u.user_id
                    INNER JOIN bo_company_details c ON c.id = a.company_id
                    where u.is_account_active='Y' AND u.user_type=1 AND am.sp_status IN ('O') AND a.is_revoke=0 AND am.is_revoke=0 AND  am.email = '".$email."'")->queryAll();
                 if(isset($responce['asp_sum_id'])){
                 $check_key = Yii::app()->db->createCommand("SELECT *
                    from agent_service_provider_sub_user_mapping where id=".$responce['asp_sum_id'])->queryRow();
                    if($check_key){
                         $asp_details = Yii::app()->db->createCommand("SELECT *
                        from agent_service_provider where id=".$check_key['asp_id'])->queryRow();
                        // do dashboard code here for dashboard use user_id = $asp_details['user_id']

                if($asp_details){
                   $app_user_id =  $asp_details['user_id'];
                   $sc_id = isset($responce['sc_id']) ? $responce['sc_id'] : NULL;
                   $count_data = $this->getservicescount($app_user_id,$sc_id);
                   echo json_encode(['status'=>true,'msg'=>'success! counts and application records fetch','token_msg'=>$token_msg,'token'=>$token,'user_id'=>$responce['user_id'],'applicant_company'=>$applicant_company,'services_count_data'=>$count_data,'applicant_user_id'=>$app_user_id,'sc_id'=>$sc_id]);
                }else{
                    echo json_encode(['status'=>true,'msg'=>'NO data found for selected entity','token_msg'=>$token_msg,'token'=>$token,'user_id'=>$responce['user_id'],'applicant_company'=>$applicant_company,'services_count_data'=>[]]);
                }                         
            }else{
                echo json_encode(['status'=>false,'msg'=>'Record not found']);
            } 
                

               }else{
                echo json_encode(['status'=>true,'msg'=>'success','token_msg'=>$token_msg,'token'=>$token,'user_id'=>$responce['user_id'],'applicant_company'=>$applicant_company]);
               }  
      
            }else{
                echo json_encode(['status'=>false,'msg'=>'user type not match']);
            }           
           }else{
               echo json_encode(['status'=>false,'msg'=>'failed','token_msg'=>'token failed']);
           }        
       }else{
           echo json_encode(['status'=>false,'msg'=>'Parameter missing']);
       }
}

    //individual Onboard CTSP/CR

    public function actionOnboardCTSP(){
        $responce = json_decode(file_get_contents('php://input'), true);
        if(isset($responce['user_id']) && isset($_SERVER['HTTP_TOKEN'])){   
            $is_match = Token::matchtoken($_SERVER['HTTP_TOKEN'],$responce['user_id']);

            if($is_match==true){                
               
                $user_id= $responce['user_id'];    
               

                  $sql = "SELECT A.id,C.first_name,C.last_name,C.surname,B.email,A.sp_type,D.company_name,A.sp_status FROM agent_service_provider A
                        INNER JOIN sso_users B ON A.agent_user_id = B.user_id
                        INNER JOIN sso_profiles C ON C.user_id= B.user_id
                        LEFT JOIN bo_company_details D ON D.id = A.company_id
                        where  A.user_id='".$user_id."'
                        ORDER BY A.created_on DESC";                  
                   
              
               $data=Yii::app()->db->createCommand($sql)->queryAll();                    

                $token_msg = 'token match'; 
                $token = Token::gettoken($responce['user_id']);
                echo json_encode(['status'=>true,'msg'=>'success','token_msg'=>$token_msg,'token'=>$token,'user_id'=>$responce['user_id'],'data'=>$data]);
            }else{
                echo json_encode(['status'=>false,'msg'=>'failed','token_msg'=>'token failed']);
            }        
        }else{
            echo json_encode(['status'=>false,'msg'=>'token miss']);
        }
    }

    //Click On Representative then popup detail

    public function actionOnboardCTSPRepresentativePopup(){
        $responce = json_decode(file_get_contents('php://input'), true);
        if(isset($responce['user_id']) && isset($_SERVER['HTTP_TOKEN'])){   
            $is_match = Token::matchtoken($_SERVER['HTTP_TOKEN'],$responce['user_id']);

            if($is_match==true){                
               /* $sc_id = isset($responce['sc_id']) ? $responce['sc_id'] : NULL;
                if($sc_id!=NULL){
                    
                }*/
                $user_id= $responce['user_id'];    
                $id= $responce['id'];  
               

                  $sql ="SELECT A.id as asp_id,C.first_name,C.last_name,C.surname,B.email,A.sp_type,D.company_name,D.reg_no,E.action_remark,E.created_on FROM agent_service_provider A
                        INNER JOIN sso_users B ON A.agent_user_id = B.user_id
                        INNER JOIN sso_profiles C ON C.user_id= B.user_id
                        LEFT JOIN bo_company_details D ON D.id = A.company_id
                        INNER JOIN agent_service_provider_and_sub_user_log E ON E.asp_id = A.id            

                        where  A.user_id='".$user_id."' AND A.id='".$id."'
                        ORDER BY A.created_on DESC;";  
				
				
                   //print_r($sql);
                  // die;
              
               $data=Yii::app()->db->createCommand($sql)->queryAll();                    

                $token_msg = 'token match'; 
                $token = Token::gettoken($responce['user_id']);
                echo json_encode(['status'=>true,'msg'=>'success','token_msg'=>$token_msg,'token'=>$token,'user_id'=>$responce['user_id'],'data'=>$data]);
            }else{
                echo json_encode(['status'=>false,'msg'=>'failed','token_msg'=>'token failed']);
            }        
        }else{
            echo json_encode(['status'=>false,'msg'=>'token miss']);
        }
    }
	
	 //ctsp after login Onboard CTSP/CR

    public function actionLoginOnboardCTSP(){
        $responce = json_decode(file_get_contents('php://input'), true);
		// print_r($responce);die;
        if(isset($responce['user_id']) && isset($_SERVER['HTTP_TOKEN']) && $responce['usertype'] == 2 ){   
            $is_match = Token::matchtoken($_SERVER['HTTP_TOKEN'],$responce['user_id']);

            if($is_match==true){                
              
                $user_id= $responce['user_id'];  
				
				$sql =  "SELECT su.* , c.company_name, c.reg_no FROM agent_service_provider_sub_user_mapping su INNER JOIN agent_service_provider a ON su.asp_id=a.id INNER JOIN bo_company_details c ON a.company_id=c.id WHERE a.agent_user_id=$user_id ORDER BY created_on DESC";
				 
				$data=Yii::app()->db->createCommand($sql)->queryAll(); 
				// print_r($data);die;

                $token_msg = 'token match'; 
                $token = Token::gettoken($responce['user_id']);
                echo json_encode(['status'=>true,'msg'=>'success','token_msg'=>$token_msg,'token'=>$token,'user_id'=>$responce['user_id'],'data'=>$data]);
            }else{
                echo json_encode(['status'=>false,'msg'=>'failed','token_msg'=>'token miss']);
            }        
        }else{
            echo json_encode(['status'=>false,'msg'=>'parameter missing']);
        }
    }
	
	public function actionLoginOnboardCTSPRepresentativePopup(){
        $responce = json_decode(file_get_contents('php://input'), true);
        if(isset($responce['user_id']) && isset($responce['id']) && isset($_SERVER['HTTP_TOKEN']) && $responce['usertype'] == 2 )	{   
            $is_match = Token::matchtoken($_SERVER['HTTP_TOKEN'],$responce['user_id']);

            if($is_match==true){                
              
                $user_id= $responce['user_id'];    
                $id= $responce['id']; 

				
						 
                $sql ="SELECT * FROM agent_service_provider_and_sub_user_log WHERE asp_sum_id=$id ORDER BY created_on DESC";
				
				$data=Yii::app()->db->createCommand($sql)->queryAll();                    
				
                $token_msg = 'token match'; 
                $token = Token::gettoken($responce['user_id']);
                echo json_encode(['status'=>true,'msg'=>'success','token_msg'=>$token_msg,'token'=>$token,'user_id'=>$responce['user_id'],'data'=>$data]);
            }else{
                echo json_encode(['status'=>false,'msg'=>'failed','token_msg'=>'token miss']);
            }        
        }else{
            echo json_encode(['status'=>false,'msg'=>'parameter miss']);
        }
    }

protected function getservicescount($userID,$sc_id){
    $wheresc = '';
    if($sc_id!=NULL){       
        $wheresc = " AND sc_id= $sc_id";
    }
   $sql="SELECT count(*) as total,
      count(CASE WHEN `application_status` IN ('I','DP','SP') THEN 1 END) AS draft,
      count(CASE WHEN `application_status` IN ('PD') THEN 1 END) AS paymentdue,
      count(CASE WHEN `application_status` IN ('P','F','AB','FA') THEN 1 END) AS pending,
      count(CASE WHEN `application_status` IN ('A') THEN 1 END) AS approved,
      count(CASE WHEN `application_status` IN ('H') THEN 1 END) AS reverted,
      count(CASE WHEN `application_status` IN ('RI','R') AND bo_new_application_submission.service_id NOT IN ('6.0','7.0') THEN 1 END) AS refundrequest,
      count(CASE WHEN `application_status` IN ('RS') THEN 1 END) AS refundsuccess
    
      FROM bo_new_application_submission 
      INNER JOIN bo_information_wizard_service_parameters bosp
      ON bo_new_application_submission.service_id=CONCAT(bosp.service_id,'.',bosp.servicetype_additionalsubservice)
      INNER JOIN bo_information_wizard_service_master 
      ON bo_information_wizard_service_master.id = bosp.service_id
      where  bosp.is_active='Y' $wheresc 
      AND bo_new_application_submission.user_id='".$userID."'";

  
   $result=Yii::app()->db->createCommand($sql)->queryAll();
   return $result;
}  

protected function getappdataByservicestatus($userID,$sc_id, $app_status){
           $wheresc = '';
    if($sc_id!=NULL){      
        $wheresc = " AND sc_id= $sc_id";
    }
    switch ($app_status) {
        case 'draft':
            $serv_status_cond = "a.application_status IN ('I','DP','SP')";
            break;
        case 'paymentdue':
            $serv_status_cond = "a.application_status IN ('PD')";
            break;
        case 'pending':
            $serv_status_cond = "a.application_status IN ('P','F','AB','FA')";
            break;
        case 'approved':
            $serv_status_cond = "a.application_status IN ('A')";
            break;
        case 'reverted':
            $serv_status_cond = "a.application_status IN ('H')";
            break;
        case 'refundrequest':
            $serv_status_cond = "a.application_status IN ('RI','R')";
            break;
        case 'refundsuccess':
            $serv_status_cond = "a.application_status IN ('RS')";
            break;
        default:
            $serv_status_cond = "a.application_status NOT IN ('Z')";
            break;
    }

    $ra_ser = Yii::app()->db->createCommand("SELECT a.submission_id, a.application_status, a.application_created_date, a.app_name
     FROM bo_new_application_submission as a
        INNER JOIN bo_information_wizard_service_parameters bosp
        ON a.service_id=CONCAT(bosp.service_id,'.',bosp.servicetype_additionalsubservice)
        INNER JOIN bo_information_wizard_service_master as sm
        ON sm.id = bosp.service_id
        where  bosp.is_active='Y' $wheresc          
        AND $serv_status_cond
        AND a.user_id=$userID ORDER BY application_created_date DESC")->queryAll(); 
    return $ra_ser;
}          
             
                
   
}
