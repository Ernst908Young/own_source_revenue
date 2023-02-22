<?php

/**
 * This is the model class for table "bo_landowner_users".
 *
 * The followings are the available columns in table 'bo_landowner_users':
 * @property integer $id
 * @property string $mobile_number
 * @property string $otp
 * @property string $is_otp_used
 * @property string $is_active
 * @property integer $user_id
 * @property string $created
 * @property string $user_agent
 * @property string $ip_address
 */
class LandownerUsers extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'bo_landowner_users';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('mobile_number, otp, created, user_agent, ip_address', 'required'),
			array('user_id', 'numerical', 'integerOnly'=>true),
			array('mobile_number, otp', 'length', 'max'=>10),
			array('is_otp_used, is_active', 'length', 'max'=>1),
			array('ip_address', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, mobile_number, otp, is_otp_used, is_active, user_id, created, user_agent, ip_address', 'safe', 'on'=>'search'),
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
			'mobile_number' => 'Mobile Number',
			'otp' => 'Otp',
			'is_otp_used' => 'Is Otp Used',
			'is_active' => 'Is Active',
			'user_id' => 'User',
			'created' => 'Created',
			'user_agent' => 'User Agent',
			'ip_address' => 'Ip Address',
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
		$criteria->compare('mobile_number',$this->mobile_number,true);
		$criteria->compare('otp',$this->otp,true);
		$criteria->compare('is_otp_used',$this->is_otp_used,true);
		$criteria->compare('is_active',$this->is_active,true);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('created',$this->created,true);
		$criteria->compare('user_agent',$this->user_agent,true);
		$criteria->compare('ip_address',$this->ip_address,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return LandownerUsers the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
