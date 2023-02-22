<?php

class DocumentsController extends Controller {

    function init() {

    }

/*
*  Test API without login
*/
    public function actionIndex() {
    	
    }

/*
*  after login API
*/
    public function actionGetapppdf(){
        $responce = json_decode(file_get_contents('php://input'), true);
        if(isset($responce['user_id']) && isset($_SERVER['HTTP_TOKEN']) && isset($responce['srn_no'])){   
            $is_match = Token::matchtoken($_SERVER['HTTP_TOKEN'],$responce['user_id']);
            if($is_match==true){
                $token = Token::gettoken($responce['user_id']);

              $app_data =  Yii::app()->db->createCommand("SELECT print_app_call_back_url FROM bo_new_application_submission WHERE submission_id = ".$responce['srn_no'])->queryRow();
              if($app_data){               
                 $pdf_url = $app_data['print_app_call_back_url'];
                    header("Content-type:application/pdf");
                    header("Content-Disposition:attachment;filename=application_pdf.pdf");
                    header("Cache-control: private");
                    $url = CURL_URL.$pdf_url;
                    $ch = curl_init($url);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt($ch, CURLOPT_REFERER, $url);
                    curl_setopt($ch, CURLOPT_POSTFIELDS,'is_api_user=true');
                    $data = curl_exec($ch);
                   
                    if (curl_error($ch)) {          
                        $error_msg = curl_error($ch);
                        echo json_encode(['status'=>false,'msg'=>'PDF content header problem','token_msg'=>'token found','token'=>$token]);
                    }
                    curl_close($ch);
                    print($data);
                    //echo json_encode(['status'=>true,'msg'=>'token']);
              }else{
                echo json_encode(['status'=>false,'msg'=>'failed','token_msg'=>'token found','token'=>$token]);
              }    
            }else{
                echo json_encode(['status'=>false,'msg'=>'failed','token_msg'=>'token failed']);
            }        
        }else{
            echo json_encode(['status'=>false,'msg'=>'token miss']);
        }
    }

    public function actionGetcertificatepdf(){
        $responce = json_decode(file_get_contents('php://input'), true);
        if(isset($responce['user_id']) && isset($_SERVER['HTTP_TOKEN']) && isset($responce['srn_no'])){   
            $is_match = Token::matchtoken($_SERVER['HTTP_TOKEN'],$responce['user_id']);
            if($is_match==true){
                $token = Token::gettoken($responce['user_id']);

              $app_data =  $v = Yii::app()->db->createCommand("SELECT * FROM bo_new_application_submission WHERE submission_id = ".$responce['srn_no'])->queryRow();
              if($app_data){               
                switch ($app_data['service_id']) {
            case '2.0':
                $fetchcompanydetails = Yii::app()->db->createCommand("SELECT * FROM bo_company_details WHERE srn_no=".$v['submission_id'])->queryRow();
                if($fetchcompanydetails)
                $url = "/backoffice/infowizardtwo/subFormPdf/SaveNewApprovalCertificate2_0/service_id/" . base64_encode($v['service_id']) . "/subID/" . base64_encode($v['submission_id']) . "/dept_id/" . base64_encode($dept_id).'/reg_no/'.base64_encode($fetchcompanydetails['reg_no']).'/approved_id/'.base64_encode($fetchcompanydetails['approved_by']);
                else
                    $url=NULL;
            break;
            case '4.0':
                $url = "/backoffice/infowizardtwo/subFormPdf/SaveNewApprovalCertificate4_0/service_id/" . base64_encode($v['service_id']) . "/subID/" . base64_encode($v['submission_id']) . "/dept_id/" . base64_encode($v['dept_id'])."/utility/Utility4_0c";
            break;
            case '5.0':
                $url = "/backoffice/infowizardtwo/subFormPdf/SaveNewApprovalCertificate5_0/service_id/" . base64_encode($v['service_id']) . "/subID/" . base64_encode($v['submission_id']) . "/dept_id/" . base64_encode($v['dept_id'])."/utility/Utility5_0c";
            break;
            case '6.0':
                $url = "/backoffice/infowizardtwo/subFormPdf/SaveNewApprovalCertificate6_0/service_id/" . base64_encode($v['service_id']) . "/subID/" . base64_encode($v['submission_id']) . "/dept_id/" . base64_encode($v['dept_id'])."/utility/Utility6_0c";
            break;
            case '7.0':
                $url = "/backoffice/infowizardtwo/subFormPdf/SaveNewApprovalCertificate7_0/service_id/" . base64_encode($v['service_id']) . "/subID/" . base64_encode($v['submission_id']) . "/dept_id/" . base64_encode($v['dept_id'])."/utility/Utility7_0c";
            break;
            case '8.0':
                $url = "/backoffice/infowizardtwo/subFormPdf/SaveNewApprovalCertificate8_0/service_id/" . base64_encode($v['service_id']) . "/subID/" . base64_encode($v['submission_id']) . "/dept_id/" . base64_encode($v['dept_id'])."/utility/Utility8_0c";
            break;
            case '9.0':
                $url = "/backoffice/infowizardtwo/subFormPdf/SaveNewApprovalCertificate9_0/service_id/" . base64_encode($v['service_id']) . "/subID/" . base64_encode($v['submission_id']) . "/dept_id/" . base64_encode($v['dept_id'])."/utility/Utility9_0c";
            break;
            case '10.0':
                $url = "/backoffice/infowizardtwo/subFormPdf/SaveNewApprovalCertificate10_0/service_id/" . base64_encode($v['service_id']) . "/subID/" . base64_encode($v['submission_id']) . "/dept_id/" . base64_encode($v['dept_id'])."/utility/Utility10_0c";
            break;


            case '19.0':
                $url = "/backoffice/infowizardtwo/subFormPdf/SaveNewApprovalCertificate19_0/service_id/" . base64_encode($v['service_id']) . "/subID/" . base64_encode($v['submission_id']) . "/dept_id/" . base64_encode($v['dept_id'])."/utility/Utility19_0c";
            break;
            case '20.0':
                $url = "/backoffice/infowizardtwo/subFormPdf/SaveNewApprovalCertificate20_0/service_id/" . base64_encode($v['service_id']) . "/subID/" . base64_encode($v['submission_id']) . "/dept_id/" . base64_encode($v['dept_id'])."/utility/Utility20_0c";
            break;
            case '21.0':
                $url = "/backoffice/infowizardtwo/subFormPdf/SaveNewApprovalCertificate21_0/service_id/" . base64_encode($v['service_id']) . "/subID/" . base64_encode($v['submission_id']) . "/dept_id/" . base64_encode($v['dept_id'])."/utility/Utility21_0c";
            break;
            case '22.0':
                $url = "/backoffice/infowizardtwo/subFormPdf/SaveNewApprovalCertificate22_0/service_id/" . base64_encode($v['service_id']) . "/subID/" . base64_encode($v['submission_id']) . "/dept_id/" . base64_encode($v['dept_id'])."/utility/Utility22_0c";
            break;          
            case '23.0':
                $url = "/backoffice/infowizardtwo/subFormPdf/SaveNewApprovalCertificate23_0/service_id/" . base64_encode($v['service_id']) . "/subID/" . base64_encode($v['submission_id']) . "/dept_id/" . base64_encode($v['dept_id'])."/utility/Utility23_0c";
            break;          
            case '24.0':
                $url = "/backoffice/infowizardtwo/subFormPdf/SaveNewApprovalCertificate24_0/service_id/" . base64_encode($v['service_id']) . "/subID/" . base64_encode($v['submission_id']) . "/dept_id/" . base64_encode($v['dept_id'])."/utility/Utility24_0c";
            break;
            case '25.0':
                $url = "/backoffice/infowizardtwo/subFormPdf/SaveNewApprovalCertificate25_0/service_id/" . base64_encode($v['service_id']) . "/subID/" . base64_encode($v['submission_id']) . "/dept_id/" . base64_encode($v['dept_id'])."/utility/Utility25_0c";
            break;
            case '27.0':
                $url = "/backoffice/infowizardtwo/subFormPdf/SaveNewApprovalCertificate27_0/service_id/" . base64_encode($v['service_id']) . "/subID/" . base64_encode($v['submission_id']) . "/dept_id/" . base64_encode($v['dept_id'])."/utility/Utility27_0c";
            break;
            case '33.0':
                $url = "/backoffice/infowizardtwo/subFormPdf/SaveNewApprovalCertificate33_0/service_id/" . base64_encode($v['service_id']) . "/subID/" . base64_encode($v['submission_id']) . "/dept_id/" . base64_encode($v['dept_id'])."/utility/Utility33_0c";
            break;
            case '36.0':
                $url = "/backoffice/infowizardtwo/subFormPdf/SaveNewApprovalCertificate36_0/service_id/" . base64_encode($v['service_id']) . "/subID/" . base64_encode($v['submission_id']) . "/dept_id/" . base64_encode($v['dept_id'])."/utility/Utility36_0c";
            break;
            case '37.0':
                $url = "/backoffice/infowizardtwo/subFormPdf/SaveNewApprovalCertificate37_0/service_id/" . base64_encode($v['service_id']) . "/subID/" . base64_encode($v['submission_id']) . "/dept_id/" . base64_encode($v['dept_id'])."/utility/Utility37_0c";
            break;
            case '38.0':
                $url = "/backoffice/infowizardtwo/subFormPdf/SaveNewApprovalCertificate38_0/service_id/" . base64_encode($v['service_id']) . "/subID/" . base64_encode($v['submission_id']) . "/dept_id/" . base64_encode($v['dept_id'])."/utility/Utility38_0c";
            break;
            case '39.0':
                $url = "/backoffice/infowizardtwo/subFormPdf/SaveNewApprovalCertificate39_0/service_id/" . base64_encode($v['service_id']) . "/subID/" . base64_encode($v['submission_id']) . "/dept_id/" . base64_encode($v['dept_id'])."/utility/Utility39_0c";
            break;
            case '40.0':
                $url = "/backoffice/infowizardtwo/subFormPdf/SaveNewApprovalCertificate40_0/service_id/" . base64_encode($v['service_id']) . "/subID/" . base64_encode($v['submission_id']) . "/dept_id/" . base64_encode($v['dept_id'])."/utility/Utility40_0c";
            break;
            case '41.0':
                $url = "/backoffice/infowizardtwo/subFormPdf/SaveNewApprovalCertificate41_0/service_id/" . base64_encode($v['service_id']) . "/subID/" . base64_encode($v['submission_id']) . "/dept_id/" . base64_encode($v['dept_id'])."/utility/Utility41_0c";
            break;
            case '42.0':
                $url = "/backoffice/infowizardtwo/subFormPdf/SaveNewApprovalCertificate42_0/service_id/" . base64_encode($v['service_id']) . "/subID/" . base64_encode($v['submission_id']) . "/dept_id/" . base64_encode($v['dept_id'])."/utility/Utility42_0c";
            break;
            case '43.0':
                $url = "/backoffice/infowizardtwo/subFormPdf/SaveNewApprovalCertificate43_0/service_id/" . base64_encode($v['service_id']) . "/subID/" . base64_encode($v['submission_id']) . "/dept_id/" . base64_encode($v['dept_id'])."/utility/Utility43_0c";
            break;
            case '44.0':
                $url = "/backoffice/infowizardtwo/subFormPdf/SaveNewApprovalCertificate44_0/service_id/" . base64_encode($v['service_id']) . "/subID/" . base64_encode($v['submission_id']) . "/dept_id/" . base64_encode($v['dept_id'])."/utility/Utility44_0c";
            break;
            
            
            default:
                $url = NULL;
                break;
        }
        if($url!=NULL){
            header("Content-type:application/pdf");
            header("Content-Disposition:attachment;filename=certificate_pdf.pdf");
            header("Cache-control: private");
            $url = CURL_URL.$url;
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_REFERER, $url);
            $data = curl_exec($ch);
           
            if (curl_error($ch)) {          
                $error_msg = curl_error($ch);
                echo json_encode(['status'=>false,'msg'=>'PDF content header problem','token_msg'=>'token found','token'=>$token]);
            }
            curl_close($ch);
            print($data);
        }else{
             echo json_encode(['status'=>false,'msg'=>'certificate not found','token_msg'=>'token found','token'=>$token]);
        }
                    
                    //echo json_encode(['status'=>true,'msg'=>'token']);
              }else{
                echo json_encode(['status'=>false,'msg'=>'failed','token_msg'=>'token found','token'=>$token]);
              }    
            }else{
                echo json_encode(['status'=>false,'msg'=>'failed','token_msg'=>'token failed']);
            }        
        }else{
            echo json_encode(['status'=>false,'msg'=>'token miss']);
        }
    }


public function actionVpdpaymentreciept(){

     $responce = json_decode(file_get_contents('php://input'), true);
        if(isset($responce['user_id']) && isset($_SERVER['HTTP_TOKEN']) && isset($responce['vpd_id'])){   
            $is_match = Token::matchtoken($_SERVER['HTTP_TOKEN'],$responce['user_id']);
            if($is_match==true){
                $token = Token::gettoken($responce['user_id']);

              $app_data =  Yii::app()->db->createCommand("SELECT * FROM vpd_documents WHERE doc_status='PI' AND id = ".$responce['vpd_id'])->queryRow();
              if($app_data){    
               
                 $pdf_url = "/backoffice/investor/services/printofflinefeeform/vpd_id/".base64_encode($responce['vpd_id']);
                    header("Content-type:application/pdf");
                    header("Content-Disposition:attachment;filename=vpdpaymentfeeform.pdf");
                    header("Cache-control: private");

                    $url = CURL_URL.$pdf_url;
                    $ch = curl_init($url);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt($ch, CURLOPT_REFERER, $url);
                    $data = curl_exec($ch);
                   
                    if (curl_error($ch)) {          
                        $error_msg = curl_error($ch);
                        echo json_encode(['status'=>false,'msg'=>'PDF content header problem','token_msg'=>'token found','token'=>$token]);
                    }
                    curl_close($ch);
                   
                    print($data);
                    //echo json_encode(['status'=>true,'msg'=>'token']);
              }else{
                echo json_encode(['status'=>false,'msg'=>'No data found','token_msg'=>'token found','token'=>$token]);
              }    
            }else{
                echo json_encode(['status'=>false,'msg'=>'failed','token_msg'=>'token failed']);
            }        
        }else{
            echo json_encode(['status'=>false,'msg'=>'Parameter missing']);
        }     
}

    
}