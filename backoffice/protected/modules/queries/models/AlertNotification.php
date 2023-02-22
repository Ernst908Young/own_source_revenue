
<?php

/**
 * @property string $id
 * @property string $module_name
 * @property string $module_id
  * @property string $module_code
 * @property string $created_by
 * @property string $created_on
 * @property string $user_type
 * @property string $is_seen
 * @property string $notify_text
 */
class AlertNotification extends CActiveRecord  
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'alert_notification';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
		
		
			array('id, module_name, module_id, created_by, created_on, user_type,
				is_seen, notify_text, module_code', 'safe'),
		);
	}

	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	
	
	
}
