<?php

/**
 * This is the model class for table "NotificationSubmission".
 *
 * The followings are the available columns in table 'NotificationSubmission':
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
class NotificationSubmission extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'bo_notification';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('sender_id, receiver_id, sender_role_id,receiver_role_id,subject,message, created', 'required'),
			array('sender_id, receiver_id, sender_role_id,receiver_role_id', 'numerical', 'integerOnly'=>true),		
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('sender_id, receiver_id, sender_role_id,receiver_role_id,subject,message,notification_type, created', 'safe', 'on'=>'search'),
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
			'sender_id' => 'sender_id',
			'receiver_id' => 'receiver_id',
			'sender_role_id' => 'sender_role_id',
			'receiver_role_id' => 'receiver_role_id',
			'subject' => 'subject',
			'message' => 'message'
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
	/* public function search()
	{
		
	}
 */
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
