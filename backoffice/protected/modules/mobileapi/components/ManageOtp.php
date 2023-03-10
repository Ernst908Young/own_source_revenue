<?php

/**
 * This is the model class for table "sso_manage_otp".
 *
 * The followings are the available columns in table 'sso_manage_otp':
 * @property integer $id
 * @property string $iuuid
 * @property string $mobile_number
 * @property integer $otp
 * @property string $created_date
 * @property string $email
 */
class ManageOtp extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'sso_manage_otp';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('iuuid, mobile_number, otp, created_date', 'required'),
			array('otp', 'numerical', 'integerOnly'=>true),
			array('iuuid', 'length', 'max'=>8),
			array('mobile_number', 'length', 'max'=>12),
			array('email', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, iuuid, mobile_number, otp, created_date, email', 'safe', 'on'=>'search'),
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
			'iuuid' => 'Iuuid',
			'mobile_number' => 'Mobile Number',
			'otp' => 'Otp',
			'created_date' => 'Created Date',
			'email' => 'Email',
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
		$criteria->compare('iuuid',$this->iuuid,true);
		$criteria->compare('mobile_number',$this->mobile_number,true);
		$criteria->compare('otp',$this->otp);
		$criteria->compare('created_date',$this->created_date,true);
		$criteria->compare('email',$this->email,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ManageOtp the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
