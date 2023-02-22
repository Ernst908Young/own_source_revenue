<?php

/**
 * This is the model class for table "bo_offline_applications_payment".
 *
 * The followings are the available columns in table 'bo_offline_applications_payment':
 * @property string $id
 * @property string $first_name
 * @property string $middle_name
 * @property string $surname
 * @property string $mobile
 * @property double $email
 * @property string $user_id
 * @property string $company_id
 * @property string $created_on
 * @property string $is_active
 *
 * The followings are the available model relations:
 * @property OfflineApplications $offlineApplication
 */
class VpdDocuments extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'vpd_documents';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
						
			array('entity_reg_no, entity_service_id, srn_no, doc_name, user_id, created_on, expired_on, doc_status, updated_on', 'safe'),

		);
	}

	
	public function attributeLabels()
	{
		return array(
		'entity_reg_no' => 'entity_reg_no',
		
		);
	}


	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
