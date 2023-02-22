<?php 
/**
 * 
 */
class Updatecompanymasterdata_for_society
{
    

    public static function parentfunction($model=NULL){
      $name_change = NULL;
        /*$sql = "SELECT * FROM bo_new_application_submission where submission_id='2209'";
              $model = NewApplicationSubmission::model()->findBySql($sql);*/
         //    print_r($model); die();
        $entity_reg_no = $model->entity_name; // reg no
        $entity_details = Yii::app()->db->createCommand("SELECT * FROM bo_company_details WHERE reg_no=$entity_reg_no AND service_id='9.0'")->queryRow();
        $entity_srn = NULL;
        if($entity_details){
            if(isset($entity_details['srn_no'])){
                if($entity_details['srn_no']){
                    $entity_srn = $entity_details['srn_no'];
                    if($entity_srn){
                        $check_already_exist =  Yii::app()->db->createCommand("SELECT * FROM entity_application_latest_data where srn_no='" . $entity_srn  . "'")->queryRow();
                        if($check_already_exist){
                            $old_fields = (array) json_decode($check_already_exist['field_value']);

                            $service_id = $check_already_exist['service_id'];
                            $latest_meta = 'update';
                        }else{
                            $get_main_record =  Yii::app()->db->createCommand("SELECT * FROM bo_new_application_submission where submission_id='" . $entity_srn  . "'")->queryRow();
                         
                             $old_fields = (array) json_decode($get_main_record['field_value']);
                             $service_id = $get_main_record['service_id'];
                             $latest_meta = 'insert';  
                        }
                        $current_fields = (array) json_decode($model->field_value);
                        
                        if($old_fields){
                            switch ($model->service_id) {
                                case '11.0':
                                    $old_fields = self::addresschange_11_0($old_fields,$current_fields);
                                    $action_taken = 'Change in address';
                                    break;
                                 case '16.0':
                                    $old_fields = self::agentchange_16_0($old_fields,$current_fields);
                                    $action_taken = 'Appoinment of registered agent';
                                    break;
                                 case '12.0':
                                    $old_fields = self::managerchange_12_0($old_fields,$current_fields);
                                    $action_taken = 'Change of manager';
                                    break; 
                                 case '19.0':
									// print_r($current_fields);die;
                                    $old_fields = self::articlesofamendmentform4_19_0($old_fields,$current_fields);
                                    $action_taken = 'All'; // this is just for remark in log table
                                    break;   
                                case '29.0':
                                    // echo $service_id;die;
                                    $old_fields = self::annualreturn_29_0($service_id,$old_fields, $current_fields);
                                    $action_taken = 'All';
                                    break;  
                                                                
                                 default:
                                    throw new Exception("Error Processing Request", 1);
                                    break;
                            }
                            

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
                              $adModel->latest_entity_name = $name_change==NULL ?  $entity_details['company_name'] : $name_change;
                              $adModel->save();

                               /* Yii::app()->db->createCommand("INSERT INTO entity_application_latest_data (service_id, entity_no, srn_no, changed_from_srn_no, changed_from_service_id, user_id, field_value, created_on,  updated_on) VALUES ('".$service_id."', '".$entity_reg_no."', '".$entity_srn."', '".$model->submission_id."', '".$model->service_id."', '".$model->user_id."', '".$finalarray."', '".date('Y-m-d H:i:s')."', '".date('Y-m-d H:i:s')."')")->execute();*/
                            }else{
                              $sql = "SELECT * FROM entity_application_latest_data where srn_no=$entity_srn AND entity_no=$entity_reg_no AND service_id='" . $service_id  . "'";
                              $adModel = EntityApplicationLatestData::model()->findBySql($sql);
                              $adModel->field_value = $finalarray;
                              $adModel->changed_from_srn_no = $model->submission_id;
                              $adModel->changed_from_service_id = $model->service_id;
                              $adModel->updated_on = date('Y-m-d H:i:s');
                              $adModel->latest_entity_name = $name_change==NULL ?  $entity_details['company_name'] : $name_change;
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
                              $adlModel->entity_name = $name_change==NULL ?  $entity_details['company_name'] : $name_change;
                              $adlModel->save();

                            /*Yii::app()->db->createCommand("INSERT INTO entity_application_data_log (service_id, entity_no, srn_no, updated_by_srn, updated_by_service_id, user_id, field_value, action_taken, created_on) VALUES ('".$service_id."', '".$entity_reg_no."', '".$entity_srn."', '".$model->submission_id."', '".$model->service_id."', '".$model->user_id."', '".$finalarray."', '".$action_taken."', '".date('Y-m-d H:i:s')."')")->execute();*/
                                          
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
  * Post incorporation of society services (Notice of Change of Address Form Form 3)
  */
	static function addresschange_11_0($old_fields,$current_fields){		
     
        if(isset($current_fields['UK-FCL-00012_0'])){
            if($current_fields['UK-FCL-00012_0']=='Change in registered office address'){
                $old_fields = self::registerofficeaddress($old_fields,$current_fields);
                
            }else{
                if($current_fields['UK-FCL-00012_0']=='Change in mailing address'){
                      $old_fields =  self::mailingaddress($old_fields,$current_fields);      
                    }else{
                        // call when change in both address
                      $old_fields =  self::registerofficeaddress($old_fields,$current_fields);
                      $old_fields =   self::mailingaddress($old_fields,$current_fields);
                }
            }

        }

          return  $old_fields;
	}	

   static function registerofficeaddress($old_fields,$current_fields){
        // address line one
        @$old_fields['UK-FCL-00308_0'] = isset($current_fields['UK-FCL-00093_0']) ? $current_fields['UK-FCL-00093_0'] : @$old_fields['UK-FCL-00308_0'];

        // address line two
        @$old_fields['UK-FCL-00309_0'] = isset($current_fields['UK-FCL-00309_0']) ? $current_fields['UK-FCL-00309_0'] : @$old_fields['UK-FCL-00309_0'];


        //Parish 
        @$old_fields['UK-FCL-00405_0'] = isset($current_fields['UK-FCL-00404_0']) ? $current_fields['UK-FCL-00404_0'] : @$old_fields['UK-FCL-00405_0'];

        //Postal Code 
        @$old_fields['UK-FCL-00094_0'] = isset($current_fields['UK-FCL-00094_0']) ? $current_fields['UK-FCL-00094_0'] : @$old_fields['UK-FCL-00094_0'];

        //Country 
        @$old_fields['UK-FCL-00096_0'] = isset($current_fields['UK-FCL-00096_0']) ? $current_fields['UK-FCL-00096_0'] : @$old_fields['UK-FCL-00096_0'];

        return $old_fields;
    }

    static function mailingaddress($old_fields,$current_fields){
        // address line one
        @$old_fields['UK-FCL-00104_0'] = isset($current_fields['UK-FCL-00107_0']) ? $current_fields['UK-FCL-00107_0'] : @$old_fields['UK-FCL-00104_0'];

        // address line two
        @$old_fields['UK-FCL-00335_0'] = isset($current_fields['UK-FCL-00335_0']) ? $current_fields['UK-FCL-00335_0'] : @$old_fields['UK-FCL-00335_0'];


        //Parish 
        @$old_fields['UK-FCL-00228_0'] = isset($current_fields['UK-FCL-00372_0']) ? $current_fields['UK-FCL-00372_0'] : @$old_fields['UK-FCL-00228_0'];

        //Postal Code 
        unset($old_fields['UK-FCL-00338_0']);                               
        @$old_fields['UK-FCL-00401_0'] = isset($current_fields['UK-FCL-00401_0']) ? $current_fields['UK-FCL-00401_0'] : @$old_fields['UK-FCL-00401_0']; 

        //Country 
        @$old_fields['UK-FCL-00351_0'] = isset($current_fields['UK-FCL-00402_0']) ? $current_fields['UK-FCL-00402_0'] : @$old_fields['UK-FCL-00351_0'];

         return $old_fields;
    }


/*
  * Post incorporation of society services (Appointment of Registered Agent (Form 19))
  */
    public static function agentchange_16_0($old_fields,$current_fields){
         @$old_fields['UK-FCL-00362_0'] = 'Yes';
         //Agent Name Update
         @$old_fields['UK-FCL-00301_0'] = isset($current_fields['UK-FCL-00132_0']) ? $current_fields['UK-FCL-00132_0'] : @$old_fields['UK-FCL-00301_0'];
         @$old_fields['UK-FCL-00105_0'] = isset($current_fields['UK-FCL-00105_0']) ? $current_fields['UK-FCL-00105_0'] : @$old_fields['UK-FCL-00105_0'];
         @$old_fields['UK-FCL-00324_0'] = isset($current_fields['UK-FCL-00106_0']) ? $current_fields['UK-FCL-00106_0'] : @$old_fields['UK-FCL-00324_0'];

         //Address details
         @$old_fields['UK-FCL-00107_0'] = @$old_fields['UK-FCL-00308_0'];
         @$old_fields['UK-FCL-00457_0'] = @$old_fields['UK-FCL-00309_0'];
         @$old_fields['UK-FCL-00463_0'] = @$old_fields['UK-FCL-00310_0'];
         @$old_fields['UK-FCL-00404_0'] = @$old_fields['UK-FCL-00405_0'];
         @$old_fields['UK-FCL-00455_0'] = @$old_fields['UK-FCL-00094_0'];
         @$old_fields['UK-FCL-00320_0'] = @$old_fields['UK-FCL-00096_0'];
        
        return  $old_fields;
    }

    /*
  * Post incorporation of society services (Change of manager)
  */
    public static function managerchange_12_0($old_fields,$current_fields){
        
        unset($old_fields['UK-FCL-00397_0']); 
        unset($old_fields['UK-FCL-00466_0']);
        unset($old_fields['UK-FCL-00398_0']);
        unset($old_fields['UK-FCL-00468_0']);
        unset($old_fields['UK-FCL-00238_0']);
        unset($old_fields['UK-FCL-00382_0']);
        unset($old_fields['UK-FCL-00372_0']);
        unset($old_fields['UK-FCL-00384_0']);
        unset($old_fields['UK-FCL-00383_0']);
        unset($old_fields['UK-FCL-00239_0']);  


        // present manager details
        if(isset($current_fields['UK-FCL-00397_0'])){
            if(is_array($current_fields['UK-FCL-00397_0'])){    
            foreach ($current_fields['UK-FCL-00397_0'] as $key => $value) {         
            // name update
            $old_fields['UK-FCL-00397_0'][] = $value; 
            $old_fields['UK-FCL-00466_0'][] = @$current_fields['UK-FCL-00133_0'][$key]; 
            $old_fields['UK-FCL-00398_0'][] = @$current_fields['UK-FCL-00398_0'][$key]; 
            // address update
            $old_fields['UK-FCL-00468_0'][] = @$current_fields['UK-FCL-00107_0'][$key]; 
            $old_fields['UK-FCL-00238_0'][] = @$current_fields['UK-FCL-00335_0'][$key]; 
            $old_fields['UK-FCL-00384_0'][] = @$current_fields['UK-FCL-00402_0'][$key]; 
            $old_fields['UK-FCL-00372_0'][] = @$current_fields['UK-FCL-00400_0'][$key]; 
            $old_fields['UK-FCL-00382_0'][] = @$current_fields['UK-FCL-00399_0'][$key]; 
            $old_fields['UK-FCL-00383_0'][] = @$current_fields['UK-FCL-00401_0'][$key]; 
           
          
            // occupation
            $old_fields['UK-FCL-00239_0'][] = @$current_fields['UK-FCL-00137_0'][$key]; 
     

         }}} 

        // appointment manager details
        if(isset($current_fields['UK-FCL-00132_0'])){
            if(is_array($current_fields['UK-FCL-00132_0'])){    
            foreach ($current_fields['UK-FCL-00132_0'] as $key => $value) {  
                $old_fields['UK-FCL-00397_0'][] = $value; 
                $old_fields['UK-FCL-00466_0'][] = @$current_fields['UK-FCL-00105_0'][$key]; 
                $old_fields['UK-FCL-00398_0'][] = @$current_fields['UK-FCL-00324_0'][$key]; 
                // address update
                $old_fields['UK-FCL-00468_0'][] = @$current_fields['UK-FCL-00093_0'][$key]; 
                $old_fields['UK-FCL-00238_0'][] = @$current_fields['UK-FCL-00309_0'][$key]; 
                $old_fields['UK-FCL-00384_0'][] = @$current_fields['UK-FCL-00096_0'][$key]; 
                $old_fields['UK-FCL-00372_0'][] = @$current_fields['UK-FCL-00129_0'][$key]; 
                $old_fields['UK-FCL-00382_0'][] = @$current_fields['UK-FCL-00310_0'][$key]; 
                $old_fields['UK-FCL-00383_0'][] = @$current_fields['UK-FCL-00094_0'][$key]; 
                             
                // occupation
                $old_fields['UK-FCL-00239_0'][] = @$current_fields['UK-FCL-00304_0'][$key]; 
   
        }
    }
}
    


        return  $old_fields;
    }

// Form 4 Post incorporation o Service id 19.0 Start

    static function articlesofamendmentform4_19_0($old_fields,$current_fields){    
            // echo "<pre>";  
            // print_r($current_fields);die;
       if(isset($current_fields['UK-FCL-00501_0'])){
                //echo"221";die;

				if(trim($current_fields['UK-FCL-00501_0'][0])=='Name of the Society'){
					//echo"1";die;
					$old_fields = self::nameofthesociety($old_fields,$current_fields);
					
				}
				elseif(trim($current_fields['UK-FCL-00501_0'][0])=='Business Activity/Purpose of Society'){
					//echo"2";die;
					$old_fields = self::businessactivitypurposeofsociety($old_fields,$current_fields);
					
				}
				elseif(trim($current_fields['UK-FCL-00501_0'][0])== 'Duration of the Society'){
					//echo"3";die;
					$old_fields = self::durationofthesociety($old_fields,$current_fields);
					
				}
				elseif(trim($current_fields['UK-FCL-00501_0'][0])== 'Registered office of the Society'){
					//echo"4";die;
					$old_fields = self::registeredofficeofthesociety($old_fields,$current_fields);
					
				}
				elseif(trim($current_fields['UK-FCL-00501_0'][0])== 'Registered Agent'){
					//echo"5";die;
					$old_fields = self::registeredagent($old_fields,$current_fields);
					
				}
				elseif(trim($current_fields['UK-FCL-00501_0'][0])== 'Details of quotas and quota transfer'){
					
					// echo'sddsdsddsdf';die;
					$old_fields = self::detailsofquotasandquotatransfer($old_fields,$current_fields);
					//echo'6';die;
					
				}
				elseif(trim($current_fields['UK-FCL-00501_0'][0])=='Business of the Society'){
					//echo"7";die;
					$old_fields = self::businessofthesociety($old_fields,$current_fields);
					
				}
				else{
					//echo "zxc";die;
					$old_fields = self::otherprovisions($old_fields,$current_fields);                
				}
			
            
        }
            //print_r($current_fields);die;

		//echo"10";die;
		// print_r($old_fields);die;
          return  $old_fields;
    }

    static function nameofthesociety($old_fields,$current_fields){
         // Enter SRN of Name Reservation form (Form 15)
         @$old_fields['UK-FCL-00360_0'] = isset($current_fields['UK-FCL-00360_0']) ? $current_fields['UK-FCL-00360_0'] : @$old_fields['UK-FCL-00360_0'];

         // Name of society
         @$old_fields['UK-FCL-00197_0'] = isset($current_fields['UK-FCL-00503_0']) ? $current_fields['UK-FCL-00503_0'] : @$old_fields['UK-FCL-00197_0'];

         return $old_fields;
     }
    static function businessactivitypurposeofsociety($old_fields,$current_fields){
         // Main Business Activity Description, which the Society proposes to carry on
         @$old_fields['UK-FCL-00198_0'] = isset($current_fields['UK-FCL-00198_0']) ? $current_fields['UK-FCL-00198_0'] : @$old_fields['UK-FCL-00198_0'];

         // The amended purpose for the Society
         @$old_fields['UK-FCL-00199_0'] = isset($current_fields['UK-FCL-00663_0']) ? $current_fields['UK-FCL-00663_0'] : @$old_fields['UK-FCL-00199_0'];

         return $old_fields;
     }  
    static function durationofthesociety($old_fields,$current_fields){
         // The duration of the Society
         @$old_fields['UK-FCL-00361_0'] = isset($current_fields['UK-FCL-00200_0']) ? $current_fields['UK-FCL-00200_0'] : @$old_fields['UK-FCL-00361_0'];

        
         return $old_fields;
     } 
    static function registeredofficeofthesociety($old_fields,$current_fields){
        // address line one
        @$old_fields['UK-FCL-00308_0'] = isset($current_fields['UK-FCL-00093_0']) ? $current_fields['UK-FCL-00093_0'] : @$old_fields['UK-FCL-00308_0'];

        // address line two
        @$old_fields['UK-FCL-00309_0'] = isset($current_fields['UK-FCL-00238_0']) ? $current_fields['UK-FCL-00238_0'] : @$old_fields['UK-FCL-00309_0'];


        //Parish 
        @$old_fields['UK-FCL-00405_0'] = isset($current_fields['UK-FCL-00337_0']) ? $current_fields['UK-FCL-00337_0'] : @$old_fields['UK-FCL-00405_0'];

        //Postal Code 
        @$old_fields['UK-FCL-00094_0'] = isset($current_fields['UK-FCL-00094_0']) ? $current_fields['UK-FCL-00094_0'] : @$old_fields['UK-FCL-00094_0'];

        //Country 
        @$old_fields['UK-FCL-00096_0'] = isset($current_fields['UK-FCL-00096_0']) ? $current_fields['UK-FCL-00096_0'] : @$old_fields['UK-FCL-00096_0'];

        return $old_fields;
    }  
     static function registeredagent($old_fields,$current_fields){
        // First name
        @$old_fields['UK-FCL-00301_0'] = isset($current_fields['UK-FCL-00132_0']) ? $current_fields['UK-FCL-00132_0'] : @$old_fields['UK-FCL-00301_0'];
        // middle name
        @$old_fields['UK-FCL-00105_0'] = isset($current_fields['UK-FCL-00105_0']) ? $current_fields['UK-FCL-00105_0'] : @$old_fields['UK-FCL-00105_0'];
        // surname
        @$old_fields['UK-FCL-00324_0'] = isset($current_fields['UK-FCL-00106_0']) ? $current_fields['UK-FCL-00106_0'] : @$old_fields['UK-FCL-00324_0'];
        // address line one
        @$old_fields['UK-FCL-00107_0'] = isset($current_fields['UK-FCL-00104_0']) ? $current_fields['UK-FCL-00104_0'] : @$old_fields['UK-FCL-00107_0'];

        // address line two
        @$old_fields['UK-FCL-00457_0'] = isset($current_fields['UK-FCL-00309_0']) ? $current_fields['UK-FCL-00309_0'] : @$old_fields['UK-FCL-00457_0'];


        //Parish 
        @$old_fields['UK-FCL-00404_0'] = isset($current_fields['UK-FCL-00396_0']) ? $current_fields['UK-FCL-00396_0'] : @$old_fields['UK-FCL-00404_0'];

        //Postal Code 
        @$old_fields['UK-FCL-00455_0'] = isset($current_fields['UK-FCL-00242_0']) ? $current_fields['UK-FCL-00242_0'] : @$old_fields['UK-FCL-00455_0'];

        //Country 
        @$old_fields['UK-FCL-00320_0'] = isset($current_fields['UK-FCL-00295_0']) ? $current_fields['UK-FCL-00295_0'] : @$old_fields['UK-FCL-00320_0'];

        return $old_fields;
    }

        public static function detailsofquotasandquotatransfer($old_fields,$current_fields){
            //Old quota detail
			// print_r($current_fields);die;
            unset($old_fields['UK-FCL-00365_0']); 
            unset($old_fields['UK-FCL-00367_0']);
            unset($old_fields['UK-FCL-00368_0']);
            unset($old_fields['UK-FCL-00369_0']);
            unset($old_fields['UK-FCL-00370_0']);
            unset($old_fields['UK-FCL-00266_0']);
            unset($old_fields['UK-FCL-00371_0']);



            // new quota detail
            if(isset($current_fields['UK-FCL-00367_0'])){
                if(is_array($current_fields['UK-FCL-00367_0'])){    
                foreach ($current_fields['UK-FCL-00367_0'] as $key => $value) {         
                
                $old_fields['UK-FCL-00365_0'][] = $value; 
                $old_fields['UK-FCL-00367_0'][] = @$current_fields['UK-FCL-00367_0'][$key]; 
                $old_fields['UK-FCL-00368_0'][] = @$current_fields['UK-FCL-00368_0'][$key]; 
            
                $old_fields['UK-FCL-00369_0'][] = @$current_fields['UK-FCL-00369_0'][$key]; 
                $old_fields['UK-FCL-00370_0'][] = @$current_fields['UK-FCL-00370_0'][$key]; 
                $old_fields['UK-FCL-00266_0'][] = @$current_fields['UK-FCL-00266_0'][$key]; 
                $old_fields['UK-FCL-00371_0'][] = @$current_fields['UK-FCL-00371_0'][$key]; 
               
             }}} 
			// print_r($old_fields);die;
            // Are the Quotas of the Society transferable
            @$old_fields['UK-FCL-00230_0'] = isset($current_fields['UK-FCL-00230_0']) ? $current_fields['UK-FCL-00230_0'] : @$old_fields['UK-FCL-00230_0'];

            //Nature of Restriction on transfer of quotas
            @$old_fields['UK-FCL-00231_0'] = isset($current_fields['UK-FCL-00664_0']) ? $current_fields['UK-FCL-00664_0'] : @$old_fields['UK-FCL-00231_0'];    


            return  $old_fields;
        } 

    static function businessofthesociety($old_fields,$current_fields){
         // Restriction if, any, on business the Society may carry on 
         @$old_fields['UK-FCL-00232_0'] = isset($current_fields['UK-FCL-00665_0']) ? $current_fields['UK-FCL-00665_0'] : @$old_fields['UK-FCL-00232_0'];

         return $old_fields;
     }     
    static function otherprovisions($old_fields,$current_fields){
         // Restriction if, any, on business the Society may carry on 
         @$old_fields['UK-FCL-00233_0'] = isset($current_fields['UK-FCL-00233_0']) ? $current_fields['UK-FCL-00233_0'] : @$old_fields['UK-FCL-00233_0'];

         return $old_fields;
     }     
    
// Form 4 Post incorporation o Service id 19.0 End


// Form 35 Start Service id 29.0

      public static function annualreturn_29_0($service_id,$old_fields,$current_fields){
       
        
            
         @$old_fields['UK-FCL-00308_0'] = isset($current_fields['UK-FCL-00340_0']) ? $current_fields['UK-FCL-00340_0'] : @$old_fields['UK-FCL-00308_0'];

        //add2
        @$old_fields['UK-FCL-00309_0'] = isset($current_fields['UK-FCL-00341_0']) ? $current_fields['UK-FCL-00341_0'] : @$old_fields['UK-FCL-00309_0'];

        //country
        @$old_fields['UK-FCL-00096_0'] = isset($current_fields['UK-FCL-00347_0']) ? $current_fields['UK-FCL-00347_0'] : @$old_fields['UK-FCL-00096_0'];

        
       //city
        @$old_fields['UK-FCL-00310_0'] = isset($current_fields['UK-FCL-00344_0']) ? $current_fields['UK-FCL-00344_0'] : @$old_fields['UK-FCL-00310_0'];
        //state

        @$old_fields['UK-FCL-00405_0'] = isset($current_fields['UK-FCL-00345_0']) ? $current_fields['UK-FCL-00345_0'] : @$old_fields['UK-FCL-00405_0'];
                //postal
        @$old_fields['UK-FCL-003094_0'] = isset($current_fields['UK-FCL-00346_0']) ? $current_fields['UK-FCL-00346_0'] : @$old_fields['UK-FCL-00094_0'];


            //share Capital
       /*  unset($old_fields['UK-FCL-00643_0']);
        unset($old_fields['UK-FCL-00644_0']); */

        unset($old_fields['UK-FCL-00368_0']);
        unset($old_fields['UK-FCL-00369_0']);
        
       // new Share detail
        if(isset($current_fields['UK-FCL-00643_0'])){
           if(is_array($current_fields['UK-FCL-00643_0'])){    
               foreach ($current_fields['UK-FCL-00643_0'] as $key => $value) { 
                $old_fields['UK-FCL-00368_0'][] = @$current_fields['UK-FCL-00643_0'][$key]; 
                $old_fields['UK-FCL-00369_0'][] = @$current_fields['UK-FCL-00644_0'][$key]; 
                
                }
            }
        }  

            unset($old_fields['UK-FCL-00397_0']); //first
            unset($old_fields['UK-FCL-00466_0']);
            unset($old_fields['UK-FCL-00398_0']); //surname
            unset($old_fields['UK-FCL-00468_0']); //add 1
            unset($old_fields['UK-FCL-00238_0']);
            
            unset($old_fields['UK-FCL-00384_0']); //country
            unset($old_fields['UK-FCL-00372_0']); //state
            unset($old_fields['UK-FCL-00382_0']);
            
            unset($old_fields['UK-FCL-00383_0']); //postal 
            unset($old_fields['UK-FCL-00239_0']);  //occupation
      
            if(isset($current_fields['UK-FCL-00132_0'])){
               if(is_array($current_fields['UK-FCL-00132_0'])){    
                   foreach ($current_fields['UK-FCL-00132_0'] as $key => $value) { 
                    $old_fields['UK-FCL-00397_0'][] = @$current_fields['UK-FCL-00132_0'][$key]; 
                    $old_fields['UK-FCL-00466_0'][] = @$current_fields['UK-FCL-00105_0'][$key]; 
                    $old_fields['UK-FCL-00398_0'][] = @$current_fields['UK-FCL-00317_0'][$key];
                    $old_fields['UK-FCL-00468_0'][] = @$current_fields['UK-FCL-00093_0'][$key]; 
                    $old_fields['UK-FCL-00238_0'][] = @$current_fields['UK-FCL-00309_0'][$key]; 
                    $old_fields['UK-FCL-00384_0'][] = @$current_fields['UK-FCL-00096_0'][$key]; 
                    $old_fields['UK-FCL-00372_0'][] = @$current_fields['UK-FCL-00129_0'][$key]; 
                    $old_fields['UK-FCL-00382_0'][] = @$current_fields['UK-FCL-00310_0'][$key]; 
                    $old_fields['UK-FCL-00383_0'][] = @$current_fields['UK-FCL-00094_0'][$key]; 
                    $old_fields['UK-FCL-00239_0'][] = @$current_fields['UK-FCL-00137_0'][$key]; 
                    
                    }
                }
            } 

            return $old_fields;
        }

 
	
}
	