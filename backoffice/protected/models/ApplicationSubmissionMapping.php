<?php

/**
 * This is the model class for table "bo_application_submission".
 *
 * The followings are the available columns in table 'bo_application_submission':
 * @property string $submission_id
 * @property string $application_id
 * @property string $user_id
 * @property string $dept_id
 * @property string $field_value
 * @property string $application_status
 * @property string $application_created_date
 * @property string $ip_address
 * @property string $user_agent
 * @property integer $landrigion_id
 *
 * The followings are the available model relations:
 * @property ApplicationForwardLevel[] $applicationForwardLevels
 * @property Departments $dept
 * @property Applications $application
 * @property District $landrigion
 * @property ApplicationVerificationLevel[] $applicationVerificationLevels
 * @property PaymentDetail[] $paymentDetails
 */
class ApplicationSubmissionMapping extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'bo_new_application_submission_mapping';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
				);
	}

	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
