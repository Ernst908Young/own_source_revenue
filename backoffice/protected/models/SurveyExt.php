<?php
class SurveyExt extends Survey
{
	static function getSurveyDetails($url_hash){
		$is_active='Y';

		$connection=Yii::app()->db;
		$sql="SELECT survey_id FROM bo_survey WHERE url_hash=:url_hash AND is_active=:is_active";
		$command=$connection->createCommand($sql);
		$command->bindParam(":url_hash",$url_hash,PDO::PARAM_STR);
		$command->bindParam(":is_active",$is_active,PDO::PARAM_STR);
		$row=$command->queryRow();
		if($row){
			$survey_id = $row['survey_id'];
			
			$sql = "SELECT *
					FROM 
					bo_survey s 
					INNER JOIN bo_survey_question_mapping sqm ON sqm.survey_id = s.survey_id
					INNER JOIN bo_feedback_question_answer_mapping qam ON qam.qa_mapping_id = sqm.qa_mapping_id
					INNER JOIN bo_feedback_answer_type_master atm ON atm.answer_type_id = qam.answer_type_id
					INNER JOIN bo_feedback_question_master qm ON qm.question_id = qam.question_id
					
					WHERE qam.is_active='Y' AND atm.is_active='Y' AND sqm.is_active='Y' AND s.survey_id='".$survey_id."'
					";
			$command=$connection->createCommand($sql);
			//$command->bindParam(":is_service_provider_active",'Y',PDO::PARAM_STR);
			$rows = $command->queryAll();	
			return $rows;
			
			
		}
		return false;		
	}
	
	public static function getPropsedDitrictList($dbtable = null, $key = null, $value = null, $state_code = null, $active = null, $isactivevalue = null) {
        if (empty($active)) {
            $active = "is_active";
        } if (empty($isactivevalue)) {
            $isactivevalue = "Y";
        } $connection = Yii::app()->db;
        $sql = "SELECT $key,$value FROM $dbtable where $active=:$active";
        $command = $connection->createCommand($sql);
        $command->bindParam(":$active", $isactivevalue, PDO::PARAM_INT);
        $allData = $command->queryAll();
        $listData = array();
		$listData['718'] = 'Entire State';
		$listData['719'] = 'Not decided yet';
        foreach ($allData as $data) {
            $k = $data[$key];
            $listData[$k] = ucfirst($data[$value]);
        } 
		
		return $listData;
    }
}
