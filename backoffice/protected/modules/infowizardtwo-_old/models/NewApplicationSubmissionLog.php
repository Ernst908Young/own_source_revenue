<?php

/**
 * This is the model class for table "bo_infowiz_form_builder_investor_logs".
 *
 * The followings are the available columns in table 'bo_infowiz_form_builder_investor_logs':
 * @property integer $submission_id
 * @property integer $application_id
 * @property string $service_id
 * @property integer $user_id
 * @property integer $dept_id
 * @property string $field_value
 * @property string $application_status
 * @property string $application_created_date
 * @property string $application_updated_date_time
 * @property string $ip_address
 * @property string $user_agent
 * @property integer $landrigion_id
 */
class NewApplicationSubmissionLog extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'bo_infowiz_form_builder_investor_logs';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('service_id, user_id, dept_id, field_value, application_created_date, ip_address, user_agent', 'required'),
			array('application_id, user_id, dept_id', 'numerical', 'integerOnly'=>true),
			array('service_id', 'length', 'max'=>20),
			array('application_status', 'length', 'max'=>3),
			array('ip_address, user_agent', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('submission_id, application_id, service_id, user_id, dept_id, field_value, application_status, application_created_date, application_updated_date_time, ip_address, user_agent, landrigion_id', 'safe', 'on'=>'search'),
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
			'service_id' => 'Service',
			'user_id' => 'User',
			'dept_id' => 'Dept',
			'field_value' => 'Field Value',
			'application_status' => 'Application Status',
			'application_created_date' => 'Application Created Date',
			'application_updated_date_time' => 'Application Updated Date Time',
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

		$criteria->compare('submission_id',$this->submission_id);
		$criteria->compare('application_id',$this->application_id);
		$criteria->compare('service_id',$this->service_id,true);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('dept_id',$this->dept_id);
		$criteria->compare('field_value',$this->field_value,true);
		$criteria->compare('application_status',$this->application_status,true);
		$criteria->compare('application_created_date',$this->application_created_date,true);
		$criteria->compare('application_updated_date_time',$this->application_updated_date_time,true);
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
	 * @return NewApplicationSubmission the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
