<?php

/**
 * This is the model class for table "bo_banned_words".
 *
 * The followings are the available columns in table 'bo_banned_words':
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
class Payment extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_payment';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			//array('banned_words_name, banned_words_type,app_id,status', 'required'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('service_id,user_id	,payment_for,submission_id,service_total_fee,late_fee,total_amount,payment_mode,payment_gateway_method,discount,payment_status,transaction_number,reference_name,reference_number,reference_email,process_id,payment_type,pg_account,fees_item,msg,created_at,updated_at,payment_submit_by,payment_received_by,payment_offline_detail_no,chalan_no,bank_name,is_fee_refunded,payment_code,is_payment_verified', 'safe', 'on'=>'search'),
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
		/* return array(
			'banned_words_name' => 'Banned Words Name',
			'banned_words_type' => 'Banned Words Type',
			'status' => 'Status',
		); */
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
