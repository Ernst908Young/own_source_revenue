
<?php 
/**
 * 
 */
class Alertsandnotification 
{
	

	public static function sendnotification($module,$module_id,$module_code,$user_id,$user_type,$message){
		$model = new AlertNotification;
		$model->module_name = $module;
		$model->module_id = $module_id;
		$model->module_code = $module_code;
		$model->created_by = $user_id;
		$model->created_on = date('Y-m-d H:i:s');
		$model->user_type = $user_type;
		$model->notify_text = $message;
		$model->save(false);
	}


}
