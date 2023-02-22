<?php

/**
 * This is the model class for table "bo_payment_detail".
 *
 * The followings are the available columns in table 'bo_payment_detail':
 * @property string $payment_id
 * @property string $pgMeTrnRefNo
 * @property string $orderId
 * @property string $authNStatus
 * @property string $authZStatus
 * @property string $responseCode
 * @property string $bank_reference_bank
 * @property integer $user_id
 * @property string $application_id
 * @property string $app_sub_id
 * @property double $amount
 * @property string $trnReqDate
 * @property string $statusCode
 * @property string $status_description
 *
 * The followings are the available model relations:
 * @property Applications $application
 * @property ApplicationSubmission $appSub
 */
class PaymentDetail extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'bo_payment_detail';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('pgMeTrnRefNo, orderId, user_id, application_id, app_sub_id, amount, trnReqDate, statusCode, status_description', 'required'),
			array('user_id', 'numerical', 'integerOnly'=>true),
			array('amount', 'numerical'),
			array('pgMeTrnRefNo, orderId, bank_reference_bank', 'length', 'max'=>20),
			array('authNStatus, authZStatus, responseCode', 'length', 'max'=>250),
			array('application_id, app_sub_id', 'length', 'max'=>10),
			array('trnReqDate', 'length', 'max'=>100),
			array('statusCode', 'length', 'max'=>1),
			array('status_description', 'length', 'max'=>500),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('payment_id, pgMeTrnRefNo, orderId, authNStatus, authZStatus, responseCode, bank_reference_bank, user_id, application_id, app_sub_id, amount, trnReqDate, statusCode, status_description', 'safe', 'on'=>'search'),
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
			'application' => array(self::BELONGS_TO, 'Applications', 'application_id'),
			'appSub' => array(self::BELONGS_TO, 'ApplicationSubmission', 'app_sub_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'payment_id' => 'Payment',
			'pgMeTrnRefNo' => 'Pg Me Trn Ref No',
			'orderId' => 'Order',
			'authNStatus' => 'Auth Nstatus',
			'authZStatus' => 'Auth Zstatus',
			'responseCode' => 'Response Code',
			'bank_reference_bank' => 'Bank Reference Bank',
			'user_id' => 'User',
			'application_id' => 'Application',
			'app_sub_id' => 'App Sub',
			'amount' => 'Amount',
			'trnReqDate' => 'Trn Req Date',
			'statusCode' => 'Status Code',
			'status_description' => 'Status Description',
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
		$criteria->compare('pgMeTrnRefNo',$this->pgMeTrnRefNo,true);
		$criteria->compare('orderId',$this->orderId,true);
		$criteria->compare('authNStatus',$this->authNStatus,true);
		$criteria->compare('authZStatus',$this->authZStatus,true);
		$criteria->compare('responseCode',$this->responseCode,true);
		$criteria->compare('bank_reference_bank',$this->bank_reference_bank,true);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('application_id',$this->application_id,true);
		$criteria->compare('app_sub_id',$this->app_sub_id,true);
		$criteria->compare('amount',$this->amount);
		$criteria->compare('trnReqDate',$this->trnReqDate,true);
		$criteria->compare('statusCode',$this->statusCode,true);
		$criteria->compare('status_description',$this->status_description,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return PaymentDetail the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
