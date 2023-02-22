<?php 
/**
 * 
 */
class Updatecompanymasterdata_for_business
{

    public static function parentfunction($model=NULL){
       /* $sql = "SELECT * FROM bo_new_application_submission where submission_id='2222'";
        $model = NewApplicationSubmission::model()->findBySql($sql);*/
         //     print_r($model); die();
        $entity_reg_no = $model->entity_name;
        // die($entity_reg_no);
        $entity_details = Yii::app()->db->createCommand("SELECT * FROM bo_company_details WHERE reg_no=$entity_reg_no AND service_id ='2.0'")->queryRow();
        $entity_srn = NULL;
        if($entity_details){
            if(isset($entity_details['srn_no'])){
                if($entity_details['srn_no']){
                    $entity_srn = $entity_details['srn_no'];
                   // die($entity_srn);
                    if($entity_srn){
                        $check_already_exist =  Yii::app()->db->createCommand("SELECT * FROM entity_application_latest_data where srn_no='" . $entity_srn  . "'")->queryRow();

                        if($check_already_exist){
                           $latest_meta = 'update';
                        }else{
                           
                             $latest_meta = 'insert';  
                        }

                         $get_main_record =  Yii::app()->db->createCommand("SELECT * FROM bo_new_application_submission where submission_id='" . $entity_srn  . "'")->queryRow();
                         
                             $old_fields = (array) json_decode($get_main_record['field_value']);
                             $service_id = $get_main_record['service_id'];

                        $current_fields = (array) json_decode($model->field_value);
                        
                        if($old_fields){
                            switch ($model->service_id) {
                                case '17.0':
                                    $updated_records = self::notice_of_change_form3_14_0($current_fields);
                                    $action_taken = json_encode(@$current_fields['UK-FCL-00416_0']);
                                    break;
                                                   
                                 default:
                                    throw new Exception("Error Processing Request", 1);
                                    break;
                            }
                           
                            
                            $finalarray = json_encode(array('2.0'=>$old_fields,'17.0'=>$current_fields));
                        

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
             					$adModel->latest_entity_name = $updated_records['name_change']==NULL ?  $entity_details['company_name'] : $updated_records['name_change'];
             					$adModel->save();

                               /* Yii::app()->db->createCommand("INSERT INTO entity_application_latest_data (service_id, entity_no, srn_no, changed_from_srn_no, changed_from_service_id, user_id, field_value, created_on,  updated_on) VALUES ('".$service_id."', '".$entity_reg_no."', '".$entity_srn."', '".$model->submission_id."', '".$model->service_id."', '".$model->user_id."', '".$finalarray."', '".date('Y-m-d H:i:s')."', '".date('Y-m-d H:i:s')."')")->execute();*/
                            }else{
                            	$sql = "SELECT * FROM entity_application_latest_data where srn_no=$entity_srn AND entity_no=$entity_reg_no AND service_id='" . $service_id  . "'";
             					$adModel = EntityApplicationLatestData::model()->findBySql($sql);
             					$adModel->field_value = $finalarray;
             					$adModel->changed_from_srn_no = $model->submission_id;
             					$adModel->changed_from_service_id = $model->service_id;
             					$adModel->updated_on = date('Y-m-d H:i:s');
             					$adModel->latest_entity_name = $updated_records['name_change']==NULL ?  $entity_details['company_name'] : $updated_records['name_change'];
             					$adModel->save();
                               /* Yii::app()->db->createCommand("UPDATE entity_application_latest_data SET field_value='".$finalarray."',changed_from_srn_no='".$model->submission_id."', changed_from_service_id='".$model->service_id."', updated_on='".date('Y-m-d H:i:s')."' WHERE service_id='".$service_id."' AND srn_no=$entity_srn AND entity_no=$entity_reg_no")->execute();*/
                            }

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
         					$adlModel->entity_name = $updated_records['name_change']==NULL ?  $entity_details['company_name'] : $updated_records['name_change'];
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
  /*
  * Post incorporation of Business Name Reservation Form 1 services (Statement Giving Notice Of Changes Form 3)
  * Array ( [0] => Change of name of firm [1] => Change of persons with names in full of new individuals [2] => Change of the name of persons who own the firm or business [3] => Change in Partner details where partner is a company [4] => Nationality of persons who own firm or business [5] => Change of place of business [6] => Change of registered office [7] => Change of nature of business )
  */
	static function notice_of_change_form3_14_0($current_fields){	 
	$name_change = NULL;  	
		if(isset($current_fields['UK-FCL-00416_0'])){
			if(!empty($current_fields['UK-FCL-00416_0']) && is_array($current_fields['UK-FCL-00416_0'])){
				foreach ($current_fields['UK-FCL-00416_0'] as $key => $value) {
					if($value=='Change of name of firm'){
						$name_change = @$current_fields['UK-FCL-00418_0'];
					}
				}
			}
		}

        return  ['name_change'=>$name_change];
	}	

   
}
