<?php
/* Rahul Kumar */
class CafMaster2Ext extends ApplicationCdnMapping{
    public static function getCafPartaillySubmitExist($userId=null) {
		// AND application_status='AB'
        $connection = Yii::app()->db;
        $sql = "select submission_id from bo_application_submission where user_id='$userId' AND application_id=1 AND `field_value` LIKE '%\"have_own_land\":\"No\"%' AND application_status='AB' order by submission_id desc limit 1;";
	  
        $command = $connection->createCommand($sql);       
        $cafData = $command->queryRow();
		if(isset($cafData['submission_id']))
		{
			return $cafData['submission_id'];
		}else{
			return false;
		}	
    }
}
?>
