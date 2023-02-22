<?php 
/**
 * 
 */
class Processapplication 
{
	public static function Matchstatus($model,$current_status){
		$verifier_status = ['H','FA'];
		$approver_status = ['P','R','A'];
		$responce = true;
		if($_SESSION['role_id'] == '83'){
			if(in_array($model->application_status, $verifier_status)){
				$responce = false;
			}
		}
		if($_SESSION['role_id'] == '84'){
			if(in_array($model->application_status, $approver_status)){
				$responce = false;
			}
		}

		if(in_array($model->application_status, ['A','R'])){
			$responce = false;
		}

		/*
		*  required Documents checked if approved or not Aamir 19-10-2022
		*/
		if($responce == true && $current_status=='A'){
			$srn_no = $model->submission_id;
			$service_id = $model->service_id;
			$doc_list_sql = Yii::app()->db->createCommand("SELECT p.document_checklist_creation
            FROM 
             bo_new_application_submission a 
            INNER JOIN bo_information_wizard_service_parameters p on CONCAT(p.service_id,'.',p.servicetype_additionalsubservice)=a.service_id
            WHERE submission_id=$srn_no AND p.is_active ='Y' ")->queryRow();
            if(@$doc_list_sql['document_checklist_creation']){
                $doc_arr = json_decode($doc_list_sql['document_checklist_creation']);
               // print_r($doc_arr);
                $req_doc_list = [];
                foreach ($doc_arr as $key => $value) {
                    if($value->is_required=='Y'){
                        $req_doc_list[]=$value->doc_id;
                    }
                }

                //print_r($req_doc_list);
                if(is_array($req_doc_list) && !empty($req_doc_list)){
                    $req_doc_str = implode(',', $req_doc_list);
                }else{
                    $req_doc_str = NULL;
                }
                $appList = NULL;
                if($req_doc_str!==NULL){
                    
                    $appList = Yii::app()->db->createCommand("SELECT
                      bo_application_dms_documents_mapping.mapping_id, bo_application_dms_documents_mapping.status
                    FROM
                      (SELECT
                         doc_id, MAX(created_on) AS created_on
                       FROM
                         bo_application_dms_documents_mapping
                    WHERE sno= $srn_no AND doc_id IN ($req_doc_str)
                       GROUP BY
                         doc_id) AS latest_orders
                    INNER JOIN
                      bo_application_dms_documents_mapping
                    ON
                      bo_application_dms_documents_mapping.doc_id = latest_orders.doc_id AND
                      bo_application_dms_documents_mapping.created_on = latest_orders.created_on
                                         ")->queryAll();
                }

                if($appList){
                    foreach ($appList as $key => $value) {
                       if($value['status']=='R' && $responce==true){
                            $responce = false;
                       }
                    }
                }
            }

			
		}
		
		return $responce;
	}
}