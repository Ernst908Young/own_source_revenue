<?php

/**
 * This is the model class for table "bo_information_wizard_service_fee".
 *
 * The followings are the available columns in table 'bo_information_wizard_service_fee':
 * @property integer $id
 * @property integer $service_id
 * @property string $service_type
 * @property string $servicetype_additionalsubservice
 * @property string $is_fee_submitted
 * @property string $add_condition
 * @property string $fee_detail
 * @property string $upload_fee_structure
 * @property string $paymeny_mode
 * @property string $treasury_head_detail
 * @property string $treasury_head_ekosh
 * @property string $bank_account_holder_name
 * @property string $bank_account_number
 * @property string $bank_name
 * @property string $bank_ifsc_code
 * @property string $any_deposit_token
 * @property string $deposit_condition
 * @property string $nsc_deposit_token
 * @property string $conditions
 * @property string $payment_compulsory
 * @property string $comment
 * @property string $created
 * @property string $modified
 */
class BoInformationWizardServiceFee extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'bo_information_wizard_service_fee';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('service_id, service_type, is_fee_submitted, any_deposit_token, nsc_deposit_token, created', 'required'),
			array('service_id', 'numerical', 'integerOnly'=>true),
			array('service_type, servicetype_additionalsubservice, add_condition, fee_detail, upload_fee_structure, paymeny_mode, treasury_head_detail, bank_account_holder_name, bank_account_number, bank_name, bank_ifsc_code, deposit_condition, conditions', 'length', 'max'=>255),
			array('is_fee_submitted, treasury_head_ekosh, any_deposit_token, nsc_deposit_token, payment_compulsory', 'length', 'max'=>1),
			array('comment, modified', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, service_id, service_type, servicetype_additionalsubservice, is_fee_submitted, add_condition, fee_detail, upload_fee_structure, paymeny_mode, treasury_head_detail, treasury_head_ekosh, bank_account_holder_name, bank_account_number, bank_name, bank_ifsc_code, any_deposit_token, deposit_condition, nsc_deposit_token, conditions, payment_compulsory, comment, created, modified', 'safe', 'on'=>'search'),
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
			'id' => 'ID',
			'service_id' => 'Service',
			'service_type' => 'Service Type',
			'servicetype_additionalsubservice' => 'Servicetype Additionalsubservice',
			'is_fee_submitted' => 'Is Fee Submitted',
			'add_condition' => 'Add Condition',
			'fee_detail' => 'Fee Detail',
			'upload_fee_structure' => 'Upload Fee Structure',
			'paymeny_mode' => 'Paymeny Mode',
			'treasury_head_detail' => 'Treasury Head Detail',
			'treasury_head_ekosh' => 'Treasury Head Ekosh',
			'bank_account_holder_name' => 'Bank Account Holder Name',
			'bank_account_number' => 'Bank Account Number',
			'bank_name' => 'Bank Name',
			'bank_ifsc_code' => 'Bank Ifsc Code',
			'any_deposit_token' => 'Any Deposit Token',
			'deposit_condition' => 'Deposit Condition',
			'nsc_deposit_token' => 'Nsc Deposit Token',
			'conditions' => 'Conditions',
			'payment_compulsory' => 'Payment Compulsory',
			'comment' => 'Comment',
			'created' => 'Created',
			'modified' => 'Modified',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('service_id',$this->service_id);
		$criteria->compare('service_type',$this->service_type,true);
		$criteria->compare('servicetype_additionalsubservice',$this->servicetype_additionalsubservice,true);
		$criteria->compare('is_fee_submitted',$this->is_fee_submitted,true);
		$criteria->compare('add_condition',$this->add_condition,true);
		$criteria->compare('fee_detail',$this->fee_detail,true);
		$criteria->compare('upload_fee_structure',$this->upload_fee_structure,true);
		$criteria->compare('paymeny_mode',$this->paymeny_mode,true);
		$criteria->compare('treasury_head_detail',$this->treasury_head_detail,true);
		$criteria->compare('treasury_head_ekosh',$this->treasury_head_ekosh,true);
		$criteria->compare('bank_account_holder_name',$this->bank_account_holder_name,true);
		$criteria->compare('bank_account_number',$this->bank_account_number,true);
		$criteria->compare('bank_name',$this->bank_name,true);
		$criteria->compare('bank_ifsc_code',$this->bank_ifsc_code,true);
		$criteria->compare('any_deposit_token',$this->any_deposit_token,true);
		$criteria->compare('deposit_condition',$this->deposit_condition,true);
		$criteria->compare('nsc_deposit_token',$this->nsc_deposit_token,true);
		$criteria->compare('conditions',$this->conditions,true);
		$criteria->compare('payment_compulsory',$this->payment_compulsory,true);
		$criteria->compare('comment',$this->comment,true);
		$criteria->compare('created',$this->created,true);
		$criteria->compare('modified',$this->modified,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return BoInformationWizardServiceFee the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
