<?php

/**
 * Author - ksansi
 
 */
class MappingExt extends CActiveRecord
{
	
	static function getAllMappingDepartment(){
		$connection=Yii::app()->db; 
		$sql = "SELECT * FROM bo_departments_mapping";
		$command=$connection->createCommand($sql);		
		$sp=$command->queryAll();	
		$results=[];
		
		foreach($sp as $key=>$val){
			$results[] = $val['department_id'] ;
		}		
		return $results;
	}

	
	static function getAllCafMappingFields(){
		$connection=Yii::app()->db; 
		$sql = "SELECT * FROM bo_caf_field_mappings";
		$command=$connection->createCommand($sql);		
		$sp=$command->queryAll();	
		$results=[];
		
		foreach($sp as $key=>$val){
			$results[$val['old_field_name']] = $val['new_field_name'] ;
		}		
		return $results;
	}

	static function getAllCafMappingFieldsOld($CafFields,$fields){
		
		foreach($fields as $key => $value ){
			if(isset($CafFields->$value)){
				$fields[$key] = $CafFields->$value ; 
			}
		}		
		return $fields ; 
		
	}
	
	static function getAllCafDetails($caf_id){
		$connection=Yii::app()->db; 
		$sql = "SELECT * FROM bo_new_application_submission_mapping where submission_id=$caf_id";
		$command=$connection->createCommand($sql);		
		$results=$command->queryRow();					
		return $results;
	}
	
	static function getApplicationMapping(){
							
		return false;
		
		
	}
	
        static function getNewCafMapping($appID) {

        if (isset($appID) && ($appID != "")) {
            $sql = "SELECT * FROM bo_new_application_submission WHERE submission_id='$appID' LIMIT 1";
            $connection = Yii::app()->db;
            $command = $connection->createCommand($sql);
            $res = $command->queryRow();
            if (!empty($res) && $res['service_id']=='591.0') {
                if (isset($res['field_value']) && $res['field_value'] != "") {
                    //  echo $res['field_value'];die;
                }

                $sql = "SELECT old_field_name,new_field_name FROM bo_caf_field_mappings";
                $connection = Yii::app()->db;
                $command = $connection->createCommand($sql);
                $mappings = $command->queryAll();

                foreach ($mappings as $mapping) {
                    //$res['field_value'] = str_replace($mapping['new_field_name'], $mapping['old_field_name'], $res['field_value']);
                }


                return $res; 
            } else if (!empty($res) && $res['service_id']!='591.0') {
				return $res['field_value'];
			}else{
                return 0;
				
			}	
        }}
    }
