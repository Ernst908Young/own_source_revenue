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
class NewApplicationSubmission extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'bo_new_application_submission';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('application_id, user_id, dept_id, field_value, application_created_date, ip_address, user_agent', 'required'),
			array('landrigion_id', 'numerical', 'integerOnly'=>true),
			array('application_id, user_id', 'length', 'max'=>10),
			array('dept_id', 'length', 'max'=>11),
			array('application_status', 'length', 'max'=>10),
			array('ip_address, user_agent', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('submission_id, application_id, user_id, dept_id, field_value, application_status, application_created_date, ip_address, user_agent, landrigion_id', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'applicationForwardLevels' => array(self::HAS_MANY, 'ApplicationForwardLevel', 'app_Sub_id'),
			'dept' => array(self::BELONGS_TO, 'Departments', 'dept_id'),
			'application' => array(self::BELONGS_TO, 'Applications', 'application_id'),
			'landrigion' => array(self::BELONGS_TO, 'District', 'landrigion_id'),
			'applicationVerificationLevels' => array(self::HAS_MANY, 'ApplicationVerificationLevel', 'app_Sub_id'),
			'paymentDetails' => array(self::HAS_MANY, 'PaymentDetail', 'app_sub_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'submission_id' => 'Submission',
			'application_id' => 'Application',
			'user_id' => 'User',
			'dept_id' => 'Dept',
			'field_value' => 'Field Value',
			'application_status' => 'Application Status',
			'application_created_date' => 'Application Created Date',
			'ip_address' => 'Ip Address',
			'user_agent' => 'User Agent',
			'landrigion_id' => 'Landrigion',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('submission_id',$this->submission_id,true);
		$criteria->compare('application_id',$this->application_id,true);
		$criteria->compare('user_id',$this->user_id,true);
		$criteria->compare('dept_id',$this->dept_id,true);
		$criteria->compare('field_value',$this->field_value,true);
		$criteria->compare('application_status',$this->application_status,true);
		$criteria->compare('application_created_date',$this->application_created_date,true);
		$criteria->compare('ip_address',$this->ip_address,true);
		$criteria->compare('user_agent',$this->user_agent,true);
		$criteria->compare('landrigion_id',$this->landrigion_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ApplicationSubmission the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
