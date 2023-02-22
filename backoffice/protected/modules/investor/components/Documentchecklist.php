
<?php 

	Class Documentchecklist{
		
		public static function Isdoc_required($service_id,$caf_id,$mapped_documents_array){
			// print_r($mapped_documents_array);die;
			$app = Yii::app()->db->createCommand("SELECT * FROM bo_new_application_submission where submission_id='" .$caf_id. "'")->queryRow();
			// print_r($app);die;
			switch ($service_id) {
				case 2:
						$newAppSubArr = json_decode($app['field_value'],true);
	                    if(isset($newAppSubArr['UK-FCL-00044_0']) && !empty($newAppSubArr['UK-FCL-00044_0']) && $newAppSubArr['UK-FCL-00044_0']==3){                                 
	                     }else{
	                        unset($mapped_documents_array[0]);
	                     }
					break;
				case 41:
						$newAppSubArr = json_decode($app['field_value'],true);
	                    if(isset($newAppSubArr['UK-FCL-00613_0']) && !empty($newAppSubArr['UK-FCL-00613_0'])){  if($newAppSubArr['UK-FCL-00613_0']=='Has voluntarily resolved to liquidate and dissolve (Section 366 - Voluntary Liquidtaion/Dissolution)'){
	                    			unset($mapped_documents_array[2]);
	                    			unset($mapped_documents_array[3]);
	                    		} 
	                    		if($newAppSubArr['UK-FCL-00613_0']=='Has no property and no liabilities (Section 364 - Dissolution by resolution of shareholders)'){
	                    			unset($mapped_documents_array[2]);
	                    			unset($mapped_documents_array[4]);
	                    		} 
	                    		if($newAppSubArr['UK-FCL-00613_0']=='Has not issued any shares and has no liabilities (Section 363 - Dissolution by resolution of Directors)'){
	                    			unset($mapped_documents_array[3]);
	                    			unset($mapped_documents_array[4]);
	                    		}

					
								
	                     }
					break;
				// form 35	
				case 29:
						$newAppSubArr = json_decode($app['field_value'],true);
	                    if(isset($newAppSubArr['UK-FCL-00562_0']) && !empty($newAppSubArr['UK-FCL-00562_0'])){  if($newAppSubArr['UK-FCL-00562_0']=='No'){
								unset($mapped_documents_array[0]);
								
							} 	
	                    }
					break; 
				// form 34		
				case 31:
						$newAppSubArr = json_decode($app['field_value'],true);
						// print_r($mapped_documents_array);die;
						
	                    if(isset($newAppSubArr['UK-FCL-00579_0']) && !empty($newAppSubArr['UK-FCL-00579_0'])){  if($newAppSubArr['UK-FCL-00579_0']=='Financial disclosure – section 148'){
							
								unset($mapped_documents_array[0]);
								unset($mapped_documents_array[1]);
								
							}
								if($newAppSubArr['UK-FCL-00579_0']=='Proxy solicitation – section 142'){
	                    			unset($mapped_documents_array[0]);
	                    			unset($mapped_documents_array[1]);
	                    		} 							
	                    }
					break;
				//form 11
				case 27:
						$newAppSubArr = json_decode($app['field_value'],true);
						
						if(isset($newAppSubArr['UK-FCL-00628_0']) && !empty($newAppSubArr['UK-FCL-00628_0'])){  if($newAppSubArr['UK-FCL-00628_0']=='No'){
							
								unset($mapped_documents_array[0]);
								
							}
										
	                    }
						if(isset($newAppSubArr['UK-FCL-00629_0']) && !empty($newAppSubArr['UK-FCL-00629_0'])){  if($newAppSubArr['UK-FCL-00629_0']=='No'){
							
								unset($mapped_documents_array[1]);
								
							}
										
	                    }
						if(isset($newAppSubArr['UK-FCL-00630_0']) && !empty($newAppSubArr['UK-FCL-00630_0'])){  if($newAppSubArr['UK-FCL-00630_0']=='No'){
							
								unset($mapped_documents_array[2]);
								
							}
										
	                    }
						
					break;
					
				// form 17
				case 37:
						$newAppSubArr = json_decode($app['field_value'],true);
						
						if(isset($newAppSubArr['UK-FCL-00699_0']) && !empty($newAppSubArr['UK-FCL-00699_0'])){  if($newAppSubArr['UK-FCL-00699_0']!='Long Form Amalgamation by Agreement'){
							
								unset($mapped_documents_array[4]);
								
							}
										
	                    }
						
						
					break;
					
				
				default:
					# code...
					break;
			}
				return $mapped_documents_array;
				
		}

		

			
	}
?>