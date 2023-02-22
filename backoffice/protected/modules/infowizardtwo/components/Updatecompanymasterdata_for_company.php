
<?php 
/**
 * 
 */
class Updatecompanymasterdata_for_company
{

	// secho"xzcv";die;
    public static function parentfunction($model=NULL){
        $name_change = NULL;
		/* $sql = "SELECT * FROM bo_new_application_submission where submission_id='2248'";
        $model = NewApplicationSubmission::model()->findBySql($sql); */
         //     print_r($model); die();
        $entity_reg_no = $model->entity_name;
        // die($entity_reg_no);
        $entity_details = Yii::app()->db->createCommand("SELECT * FROM bo_company_details WHERE reg_no=$entity_reg_no AND service_id IN ('4.0','5.0','8.0')")->queryRow();
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

                            $service_id = $check_already_exist['service_id'];
                            $latest_meta = 'update';
                        }else{
                         
                            $get_main_record =  Yii::app()->db->createCommand("SELECT * FROM bo_new_application_submission where submission_id='" . $entity_srn  . "'")->queryRow();
                         
                             $old_fields = (array) json_decode($get_main_record['field_value']);
                             $service_id = $get_main_record['service_id'];
                             $latest_meta = 'insert';  
                        }
                        $current_fields = (array) json_decode($model->field_value);
                        //print_r($old_fields);die;
                        if($old_fields){
                            switch ($model->service_id) {
                                case '14.0':
                                    $old_fields = self::addresschange_14_0($service_id,$old_fields,$current_fields);
                                    $action_taken = 'Change in address';
                                    break;
                                case '13.0':
                                    $old_fields = self::directorchange_13_0($service_id,$old_fields,$current_fields);
                                    $action_taken = 'Change of director';
									break;
                                case '15.0':
                                    $old_fields = self::powerofattorney($old_fields, $current_fields);
                                    $action_taken = 'Power of attorney';
                                    break; 
								//form 31
								case '30.0':
                                    $old_fields = self::addressdetail_30_0($old_fields, $current_fields);
                                    $action_taken = 'Address Detail';
                                    break; 
                                //Form 5
                                case '20.0':
									// print_r($current_fields);die;
                                    $old_fields = self::articlesofamendmentform5_20_0($service_id,$old_fields, $current_fields);
                                    $action_taken = 'All';
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

                            //echo "<pre>";
             
                            //print_r($finalarray); 
                            //die;  

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
  * Post incorporation of INcorporation of company & NPC services (Notice of Change of Address Form Form 4)
  */
	static function addresschange_14_0($service_id, $old_fields, $current_fields){		
     
     //	die($service_id);
		if($service_id=='4.0'){
			$registerofficeaddress = 'registerofficeaddress_4_0';
			$mailingaddress = 'mailingaddress_4_0';
		}else{
			if($service_id=='5.0'){
				$registerofficeaddress = 'registerofficeaddress_5_0';
				$mailingaddress = 'mailingaddress_5_0';
			}else{
				return false;
			}
		}

        if(isset($current_fields['UK-FCL-00012_0'])){
            if($current_fields['UK-FCL-00012_0']=='Change in registered office address'){
                $old_fields = self::$registerofficeaddress($old_fields,$current_fields);
                
            }else{
                if($current_fields['UK-FCL-00012_0']=='Change in mailing address'){
                      $old_fields =  self::$mailingaddress($old_fields,$current_fields);      
                    }else{
                        // call when change in both address
                       $old_fields =  self::$registerofficeaddress($old_fields,$current_fields);
                      $old_fields =   self::$mailingaddress($old_fields,$current_fields);
                }
            }
        }

          return  $old_fields;
	}	

   static function registerofficeaddress_4_0($old_fields,$current_fields){
   	
        // address line one
        @$old_fields['UK-FCL-00340_0'] = isset($current_fields['UK-FCL-00093_0']) ? $current_fields['UK-FCL-00093_0'] : @$old_fields['UK-FCL-00340_0'];

        // address line two
        @$old_fields['UK-FCL-00341_0'] = isset($current_fields['UK-FCL-00309_0']) ? $current_fields['UK-FCL-00309_0'] : @$old_fields['UK-FCL-00341_0'];


        //Parish 
        @$old_fields['UK-FCL-00345_0'] = isset($current_fields['UK-FCL-00404_0']) ? $current_fields['UK-FCL-00404_0'] : @$old_fields['UK-FCL-00345_0'];

        //Postal Code 
        @$old_fields['UK-FCL-00346_0'] = isset($current_fields['UK-FCL-00094_0']) ? $current_fields['UK-FCL-00094_0'] : @$old_fields['UK-FCL-00346_0'];

        //Country 
        @$old_fields['UK-FCL-00347_0'] = isset($current_fields['UK-FCL-00096_0']) ? $current_fields['UK-FCL-00096_0'] : @$old_fields['UK-FCL-00347_0'];

        return $old_fields;
    }

    static function mailingaddress_4_0($old_fields,$current_fields){
        // address line one
        @$old_fields['UK-FCL-00342_0'] = isset($current_fields['UK-FCL-00107_0']) ? $current_fields['UK-FCL-00107_0'] : @$old_fields['UK-FCL-00342_0'];

        // address line two
        @$old_fields['UK-FCL-00343_0'] = isset($current_fields['UK-FCL-00335_0']) ? $current_fields['UK-FCL-00335_0'] : @$old_fields['UK-FCL-00343_0'];


        //Parish 
        @$old_fields['UK-FCL-00349_0'] = isset($current_fields['UK-FCL-00458_0']) ? $current_fields['UK-FCL-00458_0'] : @$old_fields['UK-FCL-00349_0'];

        //Postal Code                                  
        @$old_fields['UK-FCL-00350_0'] = isset($current_fields['UK-FCL-00401_0']) ? $current_fields['UK-FCL-00401_0'] : @$old_fields['UK-FCL-00350_0']; 

        //Country 
        @$old_fields['UK-FCL-00351_0'] = isset($current_fields['UK-FCL-00402_0']) ? $current_fields['UK-FCL-00402_0'] : @$old_fields['UK-FCL-00351_0'];

         return $old_fields;
    }

    static function registerofficeaddress_5_0($old_fields,$current_fields){
   	
        // address line one
        @$old_fields['UK-FCL-00093_0'] = isset($current_fields['UK-FCL-00093_0']) ? $current_fields['UK-FCL-00093_0'] : @$old_fields['UK-FCL-00093_0'];

        // address line two
        @$old_fields['UK-FCL-00309_0'] = isset($current_fields['UK-FCL-00309_0']) ? $current_fields['UK-FCL-00309_0'] : @$old_fields['UK-FCL-00309_0'];


        //Parish 
        @$old_fields['UK-FCL-00405_0'] = isset($current_fields['UK-FCL-00404_0']) ? $current_fields['UK-FCL-00404_0'] : @$old_fields['UK-FCL-00405_0'];

        //Postal Code 
        @$old_fields['UK-FCL-00242_0'] = isset($current_fields['UK-FCL-00094_0']) ? $current_fields['UK-FCL-00094_0'] : @$old_fields['UK-FCL-00242_0'];

        //Country 
        @$old_fields['UK-FCL-00096_0'] = isset($current_fields['UK-FCL-00096_0']) ? $current_fields['UK-FCL-00096_0'] : @$old_fields['UK-FCL-00096_0'];

        return $old_fields;
    }

    static function mailingaddress_5_0($old_fields,$current_fields){
        // address line one
        @$old_fields['UK-FCL-00104_0'] = isset($current_fields['UK-FCL-00107_0']) ? $current_fields['UK-FCL-00107_0'] : @$old_fields['UK-FCL-00104_0'];

        // address line two
        @$old_fields['UK-FCL-00335_0'] = isset($current_fields['UK-FCL-00335_0']) ? $current_fields['UK-FCL-00335_0'] : @$old_fields['UK-FCL-00335_0'];


        //Parish 
        @$old_fields['UK-FCL-00471_0'] = isset($current_fields['UK-FCL-00458_0']) ? $current_fields['UK-FCL-00458_0'] : @$old_fields['UK-FCL-00471_0'];

        //Postal Code                                  
        @$old_fields['UK-FCL-00094_0'] = isset($current_fields['UK-FCL-00401_0']) ? $current_fields['UK-FCL-00401_0'] : @$old_fields['UK-FCL-00094_0']; 

        //Country 
        @$old_fields['UK-FCL-00295_0'] = isset($current_fields['UK-FCL-00402_0']) ? $current_fields['UK-FCL-00402_0'] : @$old_fields['UK-FCL-00295_0'];

         return $old_fields;
    }




    /*
  * Post incorporation of IC/NPC services (Change of Directors)
  */
    public static function directorchange_13_0($service_id, $old_fields, $current_fields){
        
        if($service_id=='4.0'){
        	$old_fields = self::changedirectorof_ic($old_fields,$current_fields);		
		}else{
			if($service_id=='5.0'){
				$old_fields = self::changedirectorof_npc($old_fields,$current_fields);		
			}else{
				return false;
			}
		}
        return  $old_fields;
    }
	//form 31
	

    public static function changedirectorof_ic($old_fields,$current_fields){
    	unset($old_fields['UK-FCL-00132_0']); //fn
        unset($old_fields['UK-FCL-00133_0']); //mn
        unset($old_fields['UK-FCL-00134_0']); //ln
        unset($old_fields['UK-FCL-00093_0']); //add 1
        unset($old_fields['UK-FCL-00309_0']); //add 2
        unset($old_fields['UK-FCL-00096_0']); // country
        unset($old_fields['UK-FCL-00372_0']); // state parish
        unset($old_fields['UK-FCL-00310_0']);  //city
        unset($old_fields['UK-FCL-00094_0']);  // postal code
        unset($old_fields['UK-FCL-00137_0']);   // occu
        unset($old_fields['UK-FCL-00480_0']);   // Prominent public office
        unset($old_fields['UK-FCL-00481_0']);   // Details of office


        // present manager details
        if(isset($current_fields['UK-FCL-00441_0'])){
            if(is_array($current_fields['UK-FCL-00441_0'])){    
            foreach ($current_fields['UK-FCL-00441_0'] as $key => $value) {         
            // name update
            $old_fields['UK-FCL-00132_0'][] = $value; 
            $old_fields['UK-FCL-00133_0'][] = @$current_fields['UK-FCL-00442_0'][$key]; 
            $old_fields['UK-FCL-00134_0'][] = @$current_fields['UK-FCL-00443_0'][$key]; 
            // address update
            $old_fields['UK-FCL-00093_0'][] = @$current_fields['UK-FCL-00444_0'][$key]; 
            $old_fields['UK-FCL-00309_0'][] = @$current_fields['UK-FCL-00445_0'][$key]; 
            $old_fields['UK-FCL-00096_0'][] = @$current_fields['UK-FCL-00446_0'][$key]; 
            $old_fields['UK-FCL-00372_0'][] = @$current_fields['UK-FCL-00447_0'][$key]; 
            $old_fields['UK-FCL-00310_0'][] = @$current_fields['UK-FCL-00448_0'][$key]; 
            $old_fields['UK-FCL-00094_0'][] = @$current_fields['UK-FCL-00449_0'][$key]; 
                         
            // occupation
            $old_fields['UK-FCL-00137_0'][] = @$current_fields['UK-FCL-00450_0'][$key];
            // office details
            $old_fields['UK-FCL-00480_0'][] = @$current_fields['UK-FCL-00489_0'][$key];
            $old_fields['UK-FCL-00481_0'][] = @$current_fields['UK-FCL-00490_0'][$key];  
     

         }}} 

        // appointment manager details
        if(isset($current_fields['UK-FCL-00132_0'])){
            if(is_array($current_fields['UK-FCL-00132_0'])){    
            foreach ($current_fields['UK-FCL-00132_0'] as $key => $value) {  
                $old_fields['UK-FCL-00132_0'][] = $value; 
                $old_fields['UK-FCL-00133_0'][] = @$current_fields['UK-FCL-00105_0'][$key]; 
                $old_fields['UK-FCL-00134_0'][] = @$current_fields['UK-FCL-00106_0'][$key]; 
                // address update
                $old_fields['UK-FCL-00093_0'][] = @$current_fields['UK-FCL-00093_0'][$key]; 
                $old_fields['UK-FCL-00309_0'][] = @$current_fields['UK-FCL-00309_0'][$key]; 
                $old_fields['UK-FCL-00096_0'][] = @$current_fields['UK-FCL-00096_0'][$key]; 
                $old_fields['UK-FCL-00372_0'][] = @$current_fields['UK-FCL-00400_0'][$key]; 
                $old_fields['UK-FCL-00310_0'][] = @$current_fields['UK-FCL-00399_0'][$key]; 
                $old_fields['UK-FCL-00094_0'][] = @$current_fields['UK-FCL-00401_0'][$key]; 
                             
                // occupation
                $old_fields['UK-FCL-00137_0'][] = @$current_fields['UK-FCL-00304_0'][$key];
                // office details
                $old_fields['UK-FCL-00480_0'][] = @$current_fields['UK-FCL-00480_0'][$key];
                $old_fields['UK-FCL-00481_0'][] = @$current_fields['UK-FCL-00481_0'][$key]; 
   
		        }
		    }
		}
		return $old_fields;
    }

    public static function changedirectorof_npc($old_fields,$current_fields){
    	unset($old_fields['UK-FCL-00150_0']); //fn
        unset($old_fields['UK-FCL-00133_0']); //mn
        unset($old_fields['UK-FCL-00134_0']); //ln
        unset($old_fields['UK-FCL-00107_0']); //add 1
        unset($old_fields['UK-FCL-00390_0']); //add 2
        unset($old_fields['UK-FCL-00320_0']); // country
        unset($old_fields['UK-FCL-00400_0']); // state parish
        unset($old_fields['UK-FCL-00463_0']);  //city
        unset($old_fields['UK-FCL-00383_0']);  // postal code
        unset($old_fields['UK-FCL-00117_0']);   // occu
        unset($old_fields['UK-FCL-00217_0']);   // Prominent public office
        unset($old_fields['UK-FCL-00317_0']);   // Details of office


        // present manager details
        if(isset($current_fields['UK-FCL-00441_0'])){
            if(is_array($current_fields['UK-FCL-00441_0'])){    
            foreach ($current_fields['UK-FCL-00441_0'] as $key => $value) {         
            // name update
            $old_fields['UK-FCL-00150_0'][] = $value; 
            $old_fields['UK-FCL-00133_0'][] = @$current_fields['UK-FCL-00442_0'][$key]; 
            $old_fields['UK-FCL-00134_0'][] = @$current_fields['UK-FCL-00443_0'][$key]; 
            // address update
            $old_fields['UK-FCL-00107_0'][] = @$current_fields['UK-FCL-00444_0'][$key]; 
            $old_fields['UK-FCL-00390_0'][] = @$current_fields['UK-FCL-00445_0'][$key]; 
            $old_fields['UK-FCL-00320_0'][] = @$current_fields['UK-FCL-00446_0'][$key]; 
            $old_fields['UK-FCL-00400_0'][] = @$current_fields['UK-FCL-00447_0'][$key]; 
            $old_fields['UK-FCL-00463_0'][] = @$current_fields['UK-FCL-00448_0'][$key]; 
            $old_fields['UK-FCL-00383_0'][] = @$current_fields['UK-FCL-00449_0'][$key]; 
                         
            // occupation
            $old_fields['UK-FCL-00117_0'][] = @$current_fields['UK-FCL-00450_0'][$key];
            // office details
            $old_fields['UK-FCL-00217_0'][] = @$current_fields['UK-FCL-00489_0'][$key];
            $old_fields['UK-FCL-00317_0'][] = @$current_fields['UK-FCL-00490_0'][$key];  
     

         }}} 

        // appointment manager details
        if(isset($current_fields['UK-FCL-00132_0'])){
            if(is_array($current_fields['UK-FCL-00132_0'])){    
            foreach ($current_fields['UK-FCL-00132_0'] as $key => $value) {  
                $old_fields['UK-FCL-00150_0'][] = $value; 
                $old_fields['UK-FCL-00133_0'][] = @$current_fields['UK-FCL-00105_0'][$key]; 
                $old_fields['UK-FCL-00134_0'][] = @$current_fields['UK-FCL-00106_0'][$key]; 
                // address update
                $old_fields['UK-FCL-00107_0'][] = @$current_fields['UK-FCL-00093_0'][$key]; 
                $old_fields['UK-FCL-00390_0'][] = @$current_fields['UK-FCL-00309_0'][$key]; 
                $old_fields['UK-FCL-00320_0'][] = @$current_fields['UK-FCL-00096_0'][$key]; 
                $old_fields['UK-FCL-00400_0'][] = @$current_fields['UK-FCL-00400_0'][$key]; 
                $old_fields['UK-FCL-00463_0'][] = @$current_fields['UK-FCL-00399_0'][$key]; 
                $old_fields['UK-FCL-00383_0'][] = @$current_fields['UK-FCL-00401_0'][$key]; 
                             
                // occupation
                $old_fields['UK-FCL-00117_0'][] = @$current_fields['UK-FCL-00304_0'][$key];
                // office details
                $old_fields['UK-FCL-00217_0'][] = @$current_fields['UK-FCL-00480_0'][$key];
                $old_fields['UK-FCL-00317_0'][] = @$current_fields['UK-FCL-00481_0'][$key]; 
   
		        }
		    }
		}

		return $old_fields;
    }


	public static function powerofattorney($old_fields, $current_fields){

		// fn
		 @$old_fields['UK-FCL-00150_0'] = isset($current_fields['UK-FCL-00132_0']) ? $current_fields['UK-FCL-00132_0'] : @$old_fields['UK-FCL-00150_0'];

        // mn
        @$old_fields['UK-FCL-00105_0'] = isset($current_fields['UK-FCL-00105_0']) ? $current_fields['UK-FCL-00105_0'] : @$old_fields['UK-FCL-00105_0'];


        // ln
        @$old_fields['UK-FCL-00106_0'] = isset($current_fields['UK-FCL-00106_0']) ? $current_fields['UK-FCL-00106_0'] : @$old_fields['UK-FCL-00106_0'];

		//address line one
		 @$old_fields['UK-FCL-00107_0'] = isset($current_fields['UK-FCL-00093_0']) ? $current_fields['UK-FCL-00093_0'] : @$old_fields['UK-FCL-00107_0'];

        // address line two
        @$old_fields['UK-FCL-00335_0'] = isset($current_fields['UK-FCL-00309_0']) ? $current_fields['UK-FCL-00309_0'] : @$old_fields['UK-FCL-00335_0'];


 		//Country 
        @$old_fields['UK-FCL-00402_0'] = isset($current_fields['UK-FCL-00096_0']) ? $current_fields['UK-FCL-00096_0'] : @$old_fields['UK-FCL-00402_0'];

        //Parish 
        @$old_fields['UK-FCL-00400_0'] = isset($current_fields['UK-FCL-00129_0']) ? $current_fields['UK-FCL-00129_0'] : @$old_fields['UK-FCL-00400_0'];

        //city 
        @$old_fields['UK-FCL-00399_0'] = isset($current_fields['UK-FCL-00310_0']) ? $current_fields['UK-FCL-00310_0'] : @$old_fields['UK-FCL-00399_0'];

        //Postal Code                                  
        @$old_fields['UK-FCL-00401_0'] = isset($current_fields['UK-FCL-00094_0']) ? $current_fields['UK-FCL-00094_0'] : @$old_fields['UK-FCL-00401_0']; 

        return $old_fields;
	}

	public static function addressdetail_30_0($old_fields, $current_fields){
		// print_r($current_fields);die;
		
		//company name
		@$old_fields['UK-FCL-00211_0'] = isset($current_fields['UK-FCL-00089_0']) ? $current_fields['UK-FCL-00089_0'] : @$old_fields['UK-FCL-00211_0'];
		//Address of Registered or Head office 
		//add1
		 
		 @$old_fields['UK-FCL-00340_0'] = isset($current_fields['UK-FCL-00340_0']) ? $current_fields['UK-FCL-00340_0'] : @$old_fields['UK-FCL-00340_0'];

        //add2
        @$old_fields['UK-FCL-00341_0'] = isset($current_fields['UK-FCL-00341_0']) ? $current_fields['UK-FCL-00341_0'] : @$old_fields['UK-FCL-00341_0'];

        //country
        @$old_fields['UK-FCL-00347_0'] = isset($current_fields['UK-FCL-00347_0']) ? $current_fields['UK-FCL-00347_0'] : @$old_fields['UK-FCL-00347_0'];

		//state
		@$old_fields['UK-FCL-00385_0'] = isset($current_fields['UK-FCL-00385_0']) ? $current_fields['UK-FCL-00385_0'] : @$old_fields['UK-FCL-00385_0'];

       //city
        @$old_fields['UK-FCL-00344_0'] = isset($current_fields['UK-FCL-00344_0']) ? $current_fields['UK-FCL-00344_0'] : @$old_fields['UK-FCL-00344_0'];

 		//postal
        @$old_fields['UK-FCL-00346_0'] = isset($current_fields['UK-FCL-00346_0']) ? $current_fields['UK-FCL-00346_0'] : @$old_fields['UK-FCL-00346_0'];
		
		//Share Capital
		unset($old_fields['UK-FCL-00248_0']);
        unset($old_fields['UK-FCL-00249_0']); 
        unset($old_fields['UK-FCL-00250_0']); 
        unset($old_fields['UK-FCL-00256_0']); 
        unset($old_fields['UK-FCL-00257_0']); 
        unset($old_fields['UK-FCL-00258_0']);
        unset($old_fields['UK-FCL-00259_0']);
		
		if(isset($current_fields['UK-FCL-00248_0'])){
            if(is_array($current_fields['UK-FCL-00248_0'])){    
            foreach ($current_fields['UK-FCL-00248_0'] as $key => $value) {  
              
                $old_fields['UK-FCL-00248_0'][] = @$current_fields['UK-FCL-00248_0'][$key]; 
                $old_fields['UK-FCL-00249_0'][] = @$current_fields['UK-FCL-00249_0'][$key]; 
             
                $old_fields['UK-FCL-00250_0'][] = @$current_fields['UK-FCL-00250_0'][$key]; 
                $old_fields['UK-FCL-00256_0'][] = @$current_fields['UK-FCL-00256_0'][$key]; 
                $old_fields['UK-FCL-00257_0'][] = @$current_fields['UK-FCL-00257_0'][$key]; 
                $old_fields['UK-FCL-00258_0'][] = @$current_fields['UK-FCL-00258_0'][$key]; 
                $old_fields['UK-FCL-00259_0'][] = @$current_fields['UK-FCL-00259_0'][$key]; 
                
		        }
		    }
		}
		

		//Director(s) of Company
			unset($old_fields['UK-FCL-00132_0']);
			unset($old_fields['UK-FCL-00133_0']); 
			unset($old_fields['UK-FCL-00134_0']); 
			unset($old_fields['UK-FCL-00093_0']); 
			unset($old_fields['UK-FCL-00309_0']); 
			unset($old_fields['UK-FCL-00096_0']);
			unset($old_fields['UK-FCL-00372_0']);
			unset($old_fields['UK-FCL-00310_0']);
			unset($old_fields['UK-FCL-00356_0']);
			unset($old_fields['UK-FCL-00137_0']);
			
		if(isset($current_fields['UK-FCL-00132_0'])){
            if(is_array($current_fields['UK-FCL-00132_0'])){    
            foreach ($current_fields['UK-FCL-00132_0'] as $key => $value) {  
              
                $old_fields['UK-FCL-00132_0'][] = @$current_fields['UK-FCL-00150_0'][$key]; 
                $old_fields['UK-FCL-00133_0'][] = @$current_fields['UK-FCL-00133_0'][$key]; 
             
                $old_fields['UK-FCL-00134_0'][] = @$current_fields['UK-FCL-00134_0'][$key]; 
                $old_fields['UK-FCL-00093_0'][] = @$current_fields['UK-FCL-00169_0'][$key]; 
                $old_fields['UK-FCL-00309_0'][] = @$current_fields['UK-FCL-00335_0'][$key]; 
                $old_fields['UK-FCL-00096_0'][] = @$current_fields['UK-FCL-00295_0'][$key]; 
                $old_fields['UK-FCL-00372_0'][] = @$current_fields['UK-FCL-00372_0'][$key]; 
                $old_fields['UK-FCL-00310_0'][] = @$current_fields['UK-FCL-00354_0'][$key]; 
                $old_fields['UK-FCL-00356_0'][] = @$current_fields['UK-FCL-00094_0'][$key]; 
                $old_fields['UK-FCL-00137_0'][] = @$current_fields['UK-FCL-00137_0'][$key]; 
                
		        }
		    }
		}
		//ATTORNEY DETAILS
		 @$old_fields['UK-FCL-00150_0'] = isset($current_fields['UK-FCL-00132_0']) ? $current_fields['UK-FCL-00132_0'] : @$old_fields['UK-FCL-00150_0'];

        //add2
        @$old_fields['UK-FCL-00105_0'] = isset($current_fields['UK-FCL-00105_0']) ? $current_fields['UK-FCL-00105_0'] : @$old_fields['UK-FCL-00105_0'];

        //country
        @$old_fields['UK-FCL-00106_0'] = isset($current_fields['UK-FCL-00106_0']) ? $current_fields['UK-FCL-00106_0'] : @$old_fields['UK-FCL-00106_0'];

		//state
		@$old_fields['UK-FCL-00107_0'] = isset($current_fields['UK-FCL-00093_0']) ? $current_fields['UK-FCL-00093_0'] : @$old_fields['UK-FCL-00107_0'];

       //city
        @$old_fields['UK-FCL-00335_0'] = isset($current_fields['UK-FCL-00309_0']) ? $current_fields['UK-FCL-00309_0'] : @$old_fields['UK-FCL-00335_0'];

 		//postal
        @$old_fields['UK-FCL-00402_0'] = isset($current_fields['UK-FCL-00096_0']) ? $current_fields['UK-FCL-00096_0'] : @$old_fields['UK-FCL-00402_0'];
		
        @$old_fields['UK-FCL-00400_0'] = isset($current_fields['UK-FCL-00129_0']) ? $current_fields['UK-FCL-00129_0'] : @$old_fields['UK-FCL-00400_0'];
		
        @$old_fields['UK-FCL-00399_0'] = isset($current_fields['UK-FCL-00310_0']) ? $current_fields['UK-FCL-00310_0'] : @$old_fields['UK-FCL-00399_0'];
		
        @$old_fields['UK-FCL-00401_0'] = isset($current_fields['UK-FCL-00094_0']) ? $current_fields['UK-FCL-00094_0'] : @$old_fields['UK-FCL-00401_0'];
		
		//Address of principal office
		
		 @$old_fields['UK-FCL-00352_0'] = isset($current_fields['UK-FCL-00570_0']) ? $current_fields['UK-FCL-00570_0'] : @$old_fields['UK-FCL-00352_0'];

        //add2
        @$old_fields['UK-FCL-00353_0'] = isset($current_fields['UK-FCL-00571_0']) ? $current_fields['UK-FCL-00571_0'] : @$old_fields['UK-FCL-00353_0'];

        //country
        @$old_fields['UK-FCL-00354_0'] = isset($current_fields['UK-FCL-00572_0']) ? $current_fields['UK-FCL-00572_0'] : @$old_fields['UK-FCL-00354_0'];

		//state
		@$old_fields['UK-FCL-00355_0'] = isset($current_fields['UK-FCL-00573_0']) ? $current_fields['UK-FCL-00573_0'] : @$old_fields['UK-FCL-00355_0'];

       //city
        @$old_fields['UK-FCL-00356_0'] = isset($current_fields['UK-FCL-00574_0']) ? $current_fields['UK-FCL-00574_0'] : @$old_fields['UK-FCL-00356_0'];

 		//postal
        @$old_fields['UK-FCL-00357_0'] = isset($current_fields['UK-FCL-00575_0']) ? $current_fields['UK-FCL-00575_0'] : @$old_fields['UK-FCL-00357_0'];
		
      

        return $old_fields;
	}

    // Form 5 Post incorporation o Service id 20.0 Start IC and NPC


    static function articlesofamendmentform5_20_0($service_id, $old_fields, $current_fields){       
            
        
            if($service_id=='4.0'){
				
                $nameofthecompany = 'nameofthecompany_4_0';
                $detailsofsharecapitalandsharetransfer = 'detailsofsharecapitalandsharetransfer_4_0';
                $detailsofdirectors = 'detailsofdirectors_4_0';
                //$businessofthecompany = 'businessofthecompany_4_0';
                $typeofcompany = 'typeofcompany_4_0';
                $otherprovisions = 'otherprovisions_4_0';
            }else{
                if($service_id=='5.0'){
					// echo $service_id;die;
                $nameofthecompany = 'nameofthecompany_5_0';
               $detailsofsharecapitalandsharetransfer = 'detailsofsharecapitalandsharetransfer_5_0';
                $detailsofdirectors = 'detailsofdirectors_5_0';
                //$businessofthecompany = 'businessofthecompany_5_0';
               // $typeofcompany = 'typeofcompany_5_0';
                $otherprovisions = 'otherprovisions_5_0';
                }else{
                    return false;
                }
            }

            if(isset($current_fields['UK-FCL-00669_0'])){

                if($current_fields['UK-FCL-00669_0'][0]=='Name of the Company'){

                    $old_fields = self::$nameofthecompany($old_fields,$current_fields);                    
                }
                elseif($current_fields['UK-FCL-00669_0'][0]=='Details of share capital and share transfer'){
                  //die('gehegghgh');
                  $old_fields =  self::$detailsofsharecapitalandsharetransfer($old_fields,$current_fields);      
                }
                elseif($current_fields['UK-FCL-00669_0'][0]=='Details of Directors'){
                  $old_fields =  self::$detailsofdirectors($old_fields,$current_fields);      
                }
            // if($current_fields['UK-FCL-00669_0']=='Business of the Company'){
            //       $old_fields =  self::$businessofthecompany($old_fields,$current_fields);      
            //     }
                elseif($current_fields['UK-FCL-00669_0'][0]=='Type of Company'){
                  $old_fields =  self::$typeofcompany($old_fields,$current_fields);      
                }
                elseif($current_fields['UK-FCL-00669_0'][0]=='Other Provisions'){
                  $old_fields =  self::$otherprovisions($old_fields,$current_fields);      
                }                
                    else{
                            // call when change in both address
                          $old_fields =  self::$nameofthecompany($old_fields,$current_fields);
                          $old_fields =   self::$detailsofsharecapitalandsharetransfer($old_fields,$current_fields);
                          $old_fields =  self::$detailsofdirectors($old_fields,$current_fields);
                         // $old_fields =   self::$businessofthecompany($old_fields,$current_fields);
                          $old_fields =  self::$typeofcompany($old_fields,$current_fields);
                          $old_fields =   self::$otherprovisions($old_fields,$current_fields);
                    }                
            }

        

              return  $old_fields;
        }  

      static function nameofthecompany_4_0($old_fields,$current_fields){
       // Enter SRN of Name Reservation form (Form 33)
		
       @$old_fields['UK-FCL-00088_0'] = isset($current_fields['UK-FCL-00331_0']) ? $current_fields['UK-FCL-00331_0'] : @$old_fields['UK-FCL-00088_0'];

       // Name of company
       @$old_fields['UK-FCL-00089_0'] = isset($current_fields['UK-FCL-00507_0']) ? $current_fields['UK-FCL-00507_0'] : @$old_fields['UK-FCL-00089_0'];
		
       return $old_fields;
   }

   static function nameofthecompany_5_0($old_fields,$current_fields){
       // Enter SRN of Name Reservation form (Form 33)
       @$old_fields['UK-FCL-00331_0'] = isset($current_fields['UK-FCL-00331_0']) ? $current_fields['UK-FCL-00331_0'] : @$old_fields['UK-FCL-00331_0'];

       // Name of company
       @$old_fields['UK-FCL-00090_0'] = isset($current_fields['UK-FCL-00507_0']) ? $current_fields['UK-FCL-00507_0'] : @$old_fields['UK-FCL-00090_0'];

       return $old_fields;
   }
	
	public static function detailsofsharecapitalandsharetransfer_5_0($old_fields,$current_fields){
       //Old share detail
	    // print_r($old_fields);die;
		unset($old_fields['UK-FCL-00262_0']); 
		unset($old_fields['UK-FCL-00095_0']);
		unset($old_fields['UK-FCL-00263_0']);
		unset($old_fields['UK-FCL-00264_0']);
		unset($old_fields['UK-FCL-00265_0']);
		unset($old_fields['UK-FCL-00266_0']);
		unset($old_fields['UK-FCL-00113_0']); 

       // new Share detail
       if(isset($current_fields['UK-FCL-00095_0'])){
           if(is_array($current_fields['UK-FCL-00095_0'])){    
			   foreach ($current_fields['UK-FCL-00095_0'] as $key => $value) { 
				$old_fields['UK-FCL-00262_0'][] = @$current_fields['UK-FCL-00262_0'][$key];
				$old_fields['UK-FCL-00095_0'][] = @$current_fields['UK-FCL-00095_0'][$key]; 
				$old_fields['UK-FCL-00263_0'][] = @$current_fields['UK-FCL-00263_0'][$key]; 
		   
				$old_fields['UK-FCL-00264_0'][] = @$current_fields['UK-FCL-00264_0'][$key]; 
				$old_fields['UK-FCL-00265_0'][] = @$current_fields['UK-FCL-00265_0'][$key]; 
				$old_fields['UK-FCL-00266_0'][] = @$current_fields['UK-FCL-00266_0'][$key]; 
				$old_fields['UK-FCL-00113_0'][] = @$current_fields['UK-FCL-00113_0'][$key]; 
          
				}
			}
		} 
		 //print_r($old_fields);die;
       // Are the Quotas of the Society transferable
       @$old_fields['UK-FCL-00334_0'] = isset($current_fields['UK-FCL-00334_0']) ? $current_fields['UK-FCL-00334_0'] : @$old_fields['UK-FCL-00334_0'];

       //Restriction on share transfers (if any)
        @$old_fields['UK-FCL-00115_0'] = isset($current_fields['UK-FCL-00504_0']) ? $current_fields['UK-FCL-00504_0'] : @$old_fields['UK-FCL-00115_0'];    

		// print_r($old_fields);die;
       return  $old_fields;
   } 
   
   public static function detailsofsharecapitalandsharetransfer_4_0($old_fields,$current_fields){
       //Old share detail
	    //print_r($old_fields);die;
		unset($old_fields['UK-FCL-00262_0']); 
		unset($old_fields['UK-FCL-00095_0']);
		unset($old_fields['UK-FCL-00263_0']);
		unset($old_fields['UK-FCL-00264_0']);
		unset($old_fields['UK-FCL-00265_0']);
		unset($old_fields['UK-FCL-00266_0']);
		unset($old_fields['UK-FCL-00113_0']); 

       // new Share detail
       if(isset($current_fields['UK-FCL-00095_0'])){
           if(is_array($current_fields['UK-FCL-00095_0'])){    
			   foreach ($current_fields['UK-FCL-00095_0'] as $key => $value) { 
				$old_fields['UK-FCL-00262_0'][] = @$current_fields['UK-FCL-00262_0'][$key];
				$old_fields['UK-FCL-00095_0'][] = @$current_fields['UK-FCL-00095_0'][$key]; 
				$old_fields['UK-FCL-00263_0'][] = @$current_fields['UK-FCL-00263_0'][$key]; 
		   
				$old_fields['UK-FCL-00264_0'][] = @$current_fields['UK-FCL-00264_0'][$key]; 
				$old_fields['UK-FCL-00265_0'][] = @$current_fields['UK-FCL-00265_0'][$key]; 
				$old_fields['UK-FCL-00266_0'][] = @$current_fields['UK-FCL-00266_0'][$key]; 
				$old_fields['UK-FCL-00113_0'][] = @$current_fields['UK-FCL-00113_0'][$key]; 
          
				}
			}
		} 
		 //print_r($old_fields);die;
       // Are the Quotas of the Society transferable
       @$old_fields['UK-FCL-00334_0'] = isset($current_fields['UK-FCL-00334_0']) ? $current_fields['UK-FCL-00334_0'] : @$old_fields['UK-FCL-00334_0'];

       //Restriction on share transfers (if any)
        @$old_fields['UK-FCL-00115_0'] = isset($current_fields['UK-FCL-00504_0']) ? $current_fields['UK-FCL-00504_0'] : @$old_fields['UK-FCL-00115_0'];    

		// print_r($old_fields);die;
       return  $old_fields;
   } 

      static function detailsofdirectors_4_0($old_fields,$current_fields){
       // Enter SRN of Name Reservation form (Form 33)
        if(isset($current_fields['UK-FCL-00240_0'])){
                if($current_fields['UK-FCL-00240_0']=='In Range'){
                @$old_fields['UK-FCL-00119_0'] = isset($current_fields['UK-FCL-00119_0']) ? $current_fields['UK-FCL-00119_0'] : @$old_fields['UK-FCL-00119_0'];
                 @$old_fields['UK-FCL-00120_0'] = isset($current_fields['UK-FCL-00120_0']) ? $current_fields['UK-FCL-00120_0'] : @$old_fields['UK-FCL-00120_0'];                    
                }else
                {
                     @$old_fields['UK-FCL-00241_0'] = isset($current_fields['UK-FCL-00241_0']) ? $current_fields['UK-FCL-00241_0'] : @$old_fields['UK-FCL-00241_0'];
                }

       return $old_fields;
   }
}
   static function detailsofdirectors_5_0($old_fields,$current_fields){
     
        if(isset($current_fields['UK-FCL-00240_0'])){
                if($current_fields['UK-FCL-00240_0']=='In Range'){
                @$old_fields['UK-FCL-00119_0'] = isset($current_fields['UK-FCL-00119_0']) ? $current_fields['UK-FCL-00119_0'] : @$old_fields['UK-FCL-00119_0'];
                 @$old_fields['UK-FCL-00120_0'] = isset($current_fields['UK-FCL-00120_0']) ? $current_fields['UK-FCL-00120_0'] : @$old_fields['UK-FCL-00120_0'];                    
                }else
                {
                     @$old_fields['UK-FCL-00100_0'] = isset($current_fields['UK-FCL-00100_0']) ? $current_fields['UK-FCL-00100_0'] : @$old_fields['UK-FCL-00100_0'];
                }

       return $old_fields;
   }
}

   static function typeofcompany_4_0($old_fields,$current_fields){
     
       @$old_fields['UK-FCL-00123_0'] = isset($current_fields['UK-FCL-00306_0']) ? $current_fields['UK-FCL-00306_0'] : @$old_fields['UK-FCL-00123_0'];   

       return $old_fields;
   }

      static function otherprovisions_4_0($old_fields,$current_fields){
     
       @$old_fields['UK-FCL-00126_0'] = isset($current_fields['UK-FCL-00233_0']) ? $current_fields['UK-FCL-00233_0'] : @$old_fields['UK-FCL-00126_0'];   

       return $old_fields;
   }

      static function otherprovisions_5_0($old_fields,$current_fields){
     
       @$old_fields['UK-FCL-00494_0'] = isset($current_fields['UK-FCL-00233_0']) ? $current_fields['UK-FCL-00233_0'] : @$old_fields['UK-FCL-00494_0'];   

       return $old_fields;
   }

   //Form 35 start

    public static function annualreturn_29_0($service_id, $old_fields, $current_fields){
        //print_r($service_id);die;
        if($service_id=='4.0'){
			// echo"zxcv";die;
            $old_fields = self::annualreturn_29_0_ic($old_fields,$current_fields);       
        }else{
            if($service_id=='5.0'){
                $old_fields = self::annualreturn_29_0_npc($old_fields,$current_fields);      
            }else{
                return false;
            }
        }
        return  $old_fields;
    }


        public static function annualreturn_29_0_ic($old_fields,$current_fields){
			
         @$old_fields['UK-FCL-00340_0'] = isset($current_fields['UK-FCL-00340_0']) ? $current_fields['UK-FCL-00340_0'] : @$old_fields['UK-FCL-00340_0'];

        //add2
        @$old_fields['UK-FCL-00341_0'] = isset($current_fields['UK-FCL-00341_0']) ? $current_fields['UK-FCL-00341_0'] : @$old_fields['UK-FCL-00341_0'];

        //country
        @$old_fields['UK-FCL-00347_0'] = isset($current_fields['UK-FCL-00347_0']) ? $current_fields['UK-FCL-00347_0'] : @$old_fields['UK-FCL-00347_0'];

        
       //city
        @$old_fields['UK-FCL-00344_0'] = isset($current_fields['UK-FCL-00344_0']) ? $current_fields['UK-FCL-00344_0'] : @$old_fields['UK-FCL-00344_0'];
        //state

        @$old_fields['UK-FCL-00345_0'] = isset($current_fields['UK-FCL-00345_0']) ? $current_fields['UK-FCL-00345_0'] : @$old_fields['UK-FCL-00345_0'];
                //postal
        @$old_fields['UK-FCL-00346_0'] = isset($current_fields['UK-FCL-00346_0']) ? $current_fields['UK-FCL-00346_0'] : @$old_fields['UK-FCL-00346_0'];


            //share Capital
       /*  unset($old_fields['UK-FCL-00643_0']);
        unset($old_fields['UK-FCL-00644_0']); */

        unset($old_fields['UK-FCL-00263_0']);
        unset($old_fields['UK-FCL-00264_0']);
        
       // new Share detail
        if(isset($current_fields['UK-FCL-00643_0'])){
           if(is_array($current_fields['UK-FCL-00643_0'])){    
               foreach ($current_fields['UK-FCL-00643_0'] as $key => $value) { 
                $old_fields['UK-FCL-00263_0'][] = @$current_fields['UK-FCL-00643_0'][$key]; 
                $old_fields['UK-FCL-00264_0'][] = @$current_fields['UK-FCL-00644_0'][$key]; 
                
                }
            }
        }  

			unset($old_fields['UK-FCL-00132_0']);
            unset($old_fields['UK-FCL-00133_0']);
            unset($old_fields['UK-FCL-00134_0']); //surname
            unset($old_fields['UK-FCL-00093_0']);
            unset($old_fields['UK-FCL-00309_0']);
            
            unset($old_fields['UK-FCL-00096_0']); //country
            unset($old_fields['UK-FCL-00372_0']); //state
            unset($old_fields['UK-FCL-00310_0']);
            
            unset($old_fields['UK-FCL-00094_0']); //postal 
            unset($old_fields['UK-FCL-00137_0']); 
      
			if(isset($current_fields['UK-FCL-00132_0'])){
               if(is_array($current_fields['UK-FCL-00132_0'])){    
                   foreach ($current_fields['UK-FCL-00132_0'] as $key => $value) { 
                    $old_fields['UK-FCL-00132_0'][] = @$current_fields['UK-FCL-00132_0'][$key]; 
                    $old_fields['UK-FCL-00133_0'][] = @$current_fields['UK-FCL-00105_0'][$key]; 
                    $old_fields['UK-FCL-00134_0'][] = @$current_fields['UK-FCL-00317_0'][$key];
                    $old_fields['UK-FCL-00093_0'][] = @$current_fields['UK-FCL-00093_0'][$key]; 
                    $old_fields['UK-FCL-00309_0'][] = @$current_fields['UK-FCL-00309_0'][$key]; 
                    $old_fields['UK-FCL-00096_0'][] = @$current_fields['UK-FCL-00096_0'][$key]; 
                    $old_fields['UK-FCL-00372_0'][] = @$current_fields['UK-FCL-00129_0'][$key]; 
                    $old_fields['UK-FCL-00310_0'][] = @$current_fields['UK-FCL-00310_0'][$key]; 
                    $old_fields['UK-FCL-00094_0'][] = @$current_fields['UK-FCL-00094_0'][$key]; 
                    $old_fields['UK-FCL-00137_0'][] = @$current_fields['UK-FCL-00137_0'][$key]; 
                    
                    }
                }
            } 

            return $old_fields;
        }

        public static function annualreturn_29_0_npc($old_fields,$current_fields){

        @$old_fields['UK-FCL-00093_0'] = isset($current_fields['UK-FCL-00340_0']) ? $current_fields['UK-FCL-00340_0'] : @$old_fields['UK-FCL-00093_0'];

        //add2
        @$old_fields['UK-FCL-00309_0'] = isset($current_fields['UK-FCL-00341_0']) ? $current_fields['UK-FCL-00341_0'] : @$old_fields['UK-FCL-00309_0'];

        //country
        @$old_fields['UK-FCL-00096_0'] = isset($current_fields['UK-FCL-00347_0']) ? $current_fields['UK-FCL-00347_0'] : @$old_fields['UK-FCL-00096_0'];

        
       //city
        @$old_fields['UK-FCL-00310_0'] = isset($current_fields['UK-FCL-00344_0']) ? $current_fields['UK-FCL-00344_0'] : @$old_fields['UK-FCL-00310_0'];

        //postal
        @$old_fields['UK-FCL-00242_0'] = isset($current_fields['UK-FCL-00346_0']) ? $current_fields['UK-FCL-00346_0'] : @$old_fields['UK-FCL-00242_0'];
        ///state
        @$old_fields['UK-FCL-00405_0'] = isset($current_fields['UK-FCL-00345_0']) ? $current_fields['UK-FCL-00345_0'] : @$old_fields['UK-FCL-00405_0'];



            unset($old_fields['UK-FCL-00150_0']);
            unset($old_fields['UK-FCL-00133_0']);
            unset($old_fields['UK-FCL-00134_0']); //surname
            unset($old_fields['UK-FCL-00107_0']);
            unset($old_fields['UK-FCL-00390_0']);
            
            unset($old_fields['UK-FCL-00320_0']); //country
            unset($old_fields['UK-FCL-00400_0']); //state
            unset($old_fields['UK-FCL-00463_0']);
            
            unset($old_fields['UK-FCL-00383_0']); //postal 
           
      
            if(isset($current_fields['UK-FCL-00132_0'])){
               if(is_array($current_fields['UK-FCL-00132_0'])){    
                   foreach ($current_fields['UK-FCL-00132_0'] as $key => $value) { 
                    $old_fields['UK-FCL-00150_0'][] = @$current_fields['UK-FCL-00132_0'][$key]; 
                    $old_fields['UK-FCL-00133_0'][] = @$current_fields['UK-FCL-00105_0'][$key]; 
                    $old_fields['UK-FCL-00134_0'][] = @$current_fields['UK-FCL-00317_0'][$key];
                    $old_fields['UK-FCL-00107_0'][] = @$current_fields['UK-FCL-00093_0'][$key]; 
                    $old_fields['UK-FCL-00390_0'][] = @$current_fields['UK-FCL-00309_0'][$key]; 
                    $old_fields['UK-FCL-00320_0'][] = @$current_fields['UK-FCL-00096_0'][$key]; 
                    $old_fields['UK-FCL-00400_0'][] = @$current_fields['UK-FCL-00129_0'][$key]; 
                    $old_fields['UK-FCL-00463_0'][] = @$current_fields['UK-FCL-00310_0'][$key]; 
                    $old_fields['UK-FCL-00383_0'][] = @$current_fields['UK-FCL-00094_0'][$key]; 
                   
                    }
                }
            } 
           
     

        return $old_fields;
        }

//form 35 end
       

    

}
