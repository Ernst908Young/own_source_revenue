<?php

/**
 * This is the model class for table "bo_offline_applications_payment".
 *
 * The followings are the available columns in table 'bo_offline_applications_payment':
 * @property string $payment_id
 * @property string $offline_application_id
 * @property string $reference_no
 * @property string $payment_mode
 * @property string $payment_details
 * @property double $amount
 * @property string $fee_receipt
 * @property string $payment_status
 * @property string $payment_datetime
 * @property string $ip_address
 * @property string $user_agent
 *
 * The followings are the available model relations:
 * @property OfflineApplications $offlineApplication
 */
class BoOfflineApplicationsPayment extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'bo_offline_applications_payment';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('offline_application_id, reference_no, payment_mode, payment_details, amount, payment_status, payment_datetime, ip_address, user_agent', 'required'),
			array('amount', 'numerical'),
			array('offline_application_id', 'length', 'max'=>11),
			array('reference_no', 'length', 'max'=>100),
			array('payment_mode, fee_receipt, ip_address, user_agent', 'length', 'max'=>255),
			array('payment_status', 'length', 'max'=>50),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('payment_id, offline_application_id, reference_no, payment_mode, payment_details, amount, fee_receipt, payment_status, payment_datetime, ip_address, user_agent', 'safe', 'on'=>'search'),
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
			'offlineApplication' => array(self::BELONGS_TO, 'OfflineApplications', 'offline_application_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'payment_id' => 'Payment',
			'offline_application_id' => 'Offline Application',
			'reference_no' => 'Reference No',
			'payment_mode' => 'Payment Mode',
			'payment_details' => 'Payment Details',
			'amount' => 'Amount',
			'fee_receipt' => 'Fee Receipt',
			'payment_status' => 'Payment Status',
			'payment_datetime' => 'Payment Datetime',
			'ip_address' => 'Ip Address',
			'user_agent' => 'User Agent',
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

		$criteria->compare('payment_id',$this->payment_id,true);
		$criteria->compare('offline_application_id',$this->offline_application_id,true);
		$criteria->compare('reference_no',$this->reference_no,true);
		$criteria->compare('payment_mode',$this->payment_mode,true);
		$criteria->compare('payment_details',$this->payment_details,true);
		$criteria->compare('amount',$this->amount);
		$criteria->compare('fee_receipt',$this->fee_receipt,true);
		$criteria->compare('payment_status',$this->payment_status,true);
		$criteria->compare('payment_datetime',$this->payment_datetime,true);
		$criteria->compare('ip_address',$this->ip_address,true);
		$criteria->compare('user_agent',$this->user_agent,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return BoOfflineApplicationsPayment the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
