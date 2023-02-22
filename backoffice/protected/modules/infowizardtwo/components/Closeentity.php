<?php 
/**
 * 
 */
class Closeentity
{

    public static function parentfunction($model=NULL){
      /* $sql = "SELECT * FROM bo_new_application_submission where submission_id='2607'";
        $model = NewApplicationSubmission::model()->findBySql($sql);*/
         //     print_r($model); die();
        $entity_reg_no = $model->entity_name;    
        switch ($model->service_id) {
            case '41.0':     
                $service_id_in = 'AND service_id IN ("4.0","5.0")';                              
                $action_taken = 'Dissolution of Company';
                break;
            case '42.0': 
                $service_id_in = 'AND service_id IN ("9.0")';                                 
                $action_taken = 'Dissolution of Society';
                break;
            case '44.0': 
                $service_id_in = 'AND service_id IN ("8.0")';                                 
                $action_taken = 'Cancellation Of External Company';
                break;
            case '43.0': 
                $service_id_in = 'AND service_id IN ("2.0")';                                 
                $action_taken = 'Cessation of Business';
                break;   
                                            
            default:
                throw new Exception("Error Processing Request. Service not match with condition please connect to support team", 1);
                break;
        } 
        $entity_details = Yii::app()->db->createCommand("SELECT * FROM bo_company_details WHERE reg_no=$entity_reg_no $service_id_in")->queryRow();
		//print_r($entity_details);die;
        $entity_srn = NULL;
        if($entity_details){
            if(isset($entity_details['srn_no'])){
                if($entity_details['srn_no']){
                    $entity_srn = $entity_details['srn_no'];
                   // die($entity_srn);
                    if($entity_srn){
                        $check_already_exist =  Yii::app()->db->createCommand("SELECT * FROM entity_application_latest_data where srn_no='" . $entity_srn  . "'")->queryRow();

                        if($check_already_exist){
                            $old_fields = (array) json_decode($check_already_exist['field_value']);
							// print_r($entity_details);die;
                            $service_id = $check_already_exist['service_id'];
                            $latest_entity_name = $check_already_exist['latest_entity_name'];
                            // $latest_entity_name = $entity_details['company_name'];
                            $latest_meta = 'update';
                        }else{
                            $get_main_record =  Yii::app()->db->createCommand("SELECT * FROM bo_new_application_submission where submission_id='" . $entity_srn  . "'")->queryRow();
                         
                             $old_fields = (array) json_decode($get_main_record['field_value']);
                             $service_id = $get_main_record['service_id'];
                             $latest_entity_name = $entity_details['company_name'];
                             $latest_meta = 'insert';  
                        }

                        //$current_fields = (array) json_decode($model->field_value);
                        
                        if($old_fields){
                            
                            $finalarray = json_encode($old_fields);
                            if($latest_meta=='insert'){
                            	$adModel = new EntityApplicationLatestData;
                            	$adModel->service_id = $service_id;
                            	$adModel->entity_no = $entity_reg_no;
                            	$adModel->srn_no = $entity_srn;
                            	$adModel->user_id = $model->user_id;
             					$adModel->field_value = $finalarray;
             					$adModel->changed_from_srn_no = $model->submission_id;
             					$adModel->changed_from_service_id = $model->service_id;
             					$adModel->created_on = date('Y-m-d H:i:s');
             					$adModel->updated_on = date('Y-m-d H:i:s');
             					$adModel->latest_entity_name = $latest_entity_name;
                                $adModel->is_active = 0;
             					$adModel->save();

                               /* Yii::app()->db->createCommand("INSERT INTO entity_application_latest_data (service_id, entity_no, srn_no, changed_from_srn_no, changed_from_service_id, user_id, field_value, created_on,  updated_on) VALUES ('".$service_id."', '".$entity_reg_no."', '".$entity_srn."', '".$model->submission_id."', '".$model->service_id."', '".$model->user_id."', '".$finalarray."', '".date('Y-m-d H:i:s')."', '".date('Y-m-d H:i:s')."')")->execute();*/
                            }else{
                            	$sql = "SELECT * FROM entity_application_latest_data where srn_no=$entity_srn AND entity_no=$entity_reg_no AND service_id='" . $service_id  . "'";
             					$adModel = EntityApplicationLatestData::model()->findBySql($sql);
             					$adModel->field_value = $finalarray;
             					$adModel->changed_from_srn_no = $model->submission_id;
             					$adModel->changed_from_service_id = $model->service_id;
             					$adModel->updated_on = date('Y-m-d H:i:s');
             					$adModel->latest_entity_name = $latest_entity_name;
             					$adModel->save();
                               /* Yii::app()->db->createCommand("UPDATE entity_application_latest_data SET field_value='".$finalarray."',changed_from_srn_no='".$model->submission_id."', changed_from_service_id='".$model->service_id."', updated_on='".date('Y-m-d H:i:s')."' WHERE service_id='".$service_id."' AND srn_no=$entity_srn AND entity_no=$entity_reg_no")->execute();*/
                            }

                            Yii::app()->db->createCommand("UPDATE bo_company_details SET is_active='0' WHERE id='".$entity_details['id']."'")->execute();

                            $adlModel = new EntityApplicationDataLog;
                        	$adlModel->service_id = $service_id;
                        	$adlModel->entity_no = $entity_reg_no;
                        	$adlModel->srn_no = $entity_srn;
                        	$adlModel->user_id = $model->user_id;
         					$adlModel->field_value = $finalarray;
         					$adlModel->updated_by_srn = $model->submission_id;
         					$adlModel->updated_by_service_id = $model->service_id;
         					$adlModel->created_on = date('Y-m-d H:i:s');
         					$adlModel->action_taken = $action_taken;
         					$adlModel->entity_name = $latest_entity_name;
         					$adlModel->save();

                            
                           /* Yii::app()->db->createCommand("INSERT INTO entity_application_data_log (service_id, entity_no, srn_no, updated_by_srn, updated_by_service_id, user_id, field_value, action_taken, created_on) VALUES ('".$service_id."', '".$entity_reg_no."', '".$entity_srn."', '".$model->submission_id."', '".$model->service_id."', '".$model->user_id."', '".$finalarray."', '".$action_taken."', '".date('Y-m-d H:i:s')."')")->execute();*/
                                          
                        }else{
                            return false;
                        }
                    }else{
                        return false;
                    } 
                }
            }
        }
    }
}
