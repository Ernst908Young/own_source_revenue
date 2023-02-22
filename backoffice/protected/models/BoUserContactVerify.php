<?php

/**
 * This is the model class for table "bo_user_contact_verify".
 *
 * The followings are the available columns in table 'bo_user_contact_verify':
 * @property integer $id
 * @property string $user_id
 * @property string $mobile
 * @property string $email
 * @property string $mobile_verified
 * @property string $email_verified
 * @property string $mobile_otp
 * @property string $email_otp
 * @property string $created_time
 *
 * The followings are the available model relations:
 * @property BoUser $user
 */
class BoUserContactVerify extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'bo_user_contact_verify';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, mobile, email, mobile_verified, email_verified, mobile_otp, email_otp, created_time', 'required'),
			array('user_id, mobile', 'length', 'max'=>10),
			array('email', 'length', 'max'=>100),
			array('mobile_verified, email_verified', 'length', 'max'=>3),
			array('mobile_otp, email_otp', 'length', 'max'=>6),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, user_id, mobile, email, mobile_verified, email_verified, mobile_otp, email_otp, created_time', 'safe', 'on'=>'search'),
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
			'user' => array(self::BELONGS_TO, 'BoUser', 'user_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'user_id' => 'User',
			'mobile' => 'Mobile',
			'email' => 'Email',
			'mobile_verified' => 'Mobile Verified',
			'email_verified' => 'Email Verified',
			'mobile_otp' => 'Mobile Otp',
			'email_otp' => 'Email Otp',
			'created_time' => 'Created Time',
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
		$criteria->compare('user_id',$this->user_id,true);
		$criteria->compare('mobile',$this->mobile,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('mobile_verified',$this->mobile_verified,true);
		$criteria->compare('email_verified',$this->email_verified,true);
		$criteria->compare('mobile_otp',$this->mobile_otp,true);
		$criteria->compare('email_otp',$this->email_otp,true);
		$criteria->compare('created_time',$this->created_time,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return BoUserContactVerify the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
