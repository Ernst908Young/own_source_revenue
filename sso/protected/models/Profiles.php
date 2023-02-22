<?php

/**
 * This is the model class for table "sso_profiles".
 *
 * The followings are the available columns in table 'sso_profiles':
 * @property string $profile_id
 * @property string $user_id
 * @property string $first_name
 * @property string $last_name
 * @property string $pan_card
 * @property string $adhaar_number
 * @property string $country_name
 * @property string $state_name
 * @property string $city_name
 * @property string $distt_name
 * @property string $pin_code
 * @property string $address
 * @property string $mobile_number
 *
 * The followings are the available model relations:
 * @property Users $user
 */
class Profiles extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'sso_profiles';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, first_name, country_name, state_name, address', 'required'),
			array('user_id, pin_code', 'length', 'max'=>10),
			array('first_name, last_name, country_name, state_name, city_name', 'length', 'max'=>64),
			array('pan_card', 'length', 'max'=>16),
			array('adhaar_number', 'length', 'max'=>12),
			array('distt_name', 'length', 'max'=>100),
			array('mobile_number', 'length', 'max'=>20),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('profile_id, user_id, first_name, last_name, surname, pan_card, adhaar_number, country_name, state_name, city_name, distt_name, pin_code, address, address2,telephone, country_code, date_of_birth, gender, nationality, mobile_number', 'safe', 'on'=>'search'),
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
			'user' => array(self::BELONGS_TO, 'Users', 'user_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'profile_id' => 'Profile',
			'user_id' => 'User',
			'first_name' => 'First Name',
			'last_name' => 'Last Name',
			'pan_card' => 'Pan Card',
			'adhaar_number' => 'Adhaar Number',
			'country_name' => 'Country Name',
			'state_name' => 'State Name',
			'city_name' => 'City Name',
			'distt_name' => 'Distt Name',
			'pin_code' => 'Pin Code',
			'address' => 'Address',
			'mobile_number' => 'Mobile Number',
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

		$criteria->compare('profile_id',$this->profile_id,true);
		$criteria->compare('user_id',$this->user_id,true);
		$criteria->compare('first_name',$this->first_name,true);
		$criteria->compare('last_name',$this->last_name,true);
		$criteria->compare('pan_card',$this->pan_card,true);
		$criteria->compare('adhaar_number',$this->adhaar_number,true);
		$criteria->compare('country_name',$this->country_name,true);
		$criteria->compare('state_name',$this->state_name,true);
		$criteria->compare('city_name',$this->city_name,true);
		$criteria->compare('distt_name',$this->distt_name,true);
		$criteria->compare('pin_code',$this->pin_code,true);
		$criteria->compare('address',$this->address,true);
		$criteria->compare('mobile_number',$this->mobile_number,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Profiles the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
