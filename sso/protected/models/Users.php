<?php

/**
 * This is the model class for table "sso_users".
 *
 * The followings are the available columns in table 'sso_users':
 * @property string $user_id
 * @property string $email
 * @property string $password
 * @property string $salt
 * @property string $created_on
 * @property string $is_account_active
 * @property string $user_type
  * @property string $sp_type
 *
 * The followings are the available model relations:
 * @property ActiveTokens[] $activeTokens
 * @property Logs[] $logs
 * @property Profiles[] $profiles
 */
class Users extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'sso_users';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('email, password, salt, created_on', 'required'),
			array('email', 'length', 'max'=>512),
			array('iuid', 'length', 'max'=>8),
			array('password', 'length', 'max'=>40),
			array('sp_type,lic_no', 'length', 'max'=>50),
			
			array('salt', 'length', 'max'=>32),
			array('is_account_active', 'length', 'max'=>1),
			//array('email', 'unique'),
			array('user_type','safe'),  
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('user_id, email, password, salt, created_on, is_account_active,mobile_no,user_type,entity_name,entity_type', 'safe', 'on'=>'search'),
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
			'activeTokens' => array(self::HAS_MANY, 'ActiveTokens', 'user_id'),
			'logs' => array(self::HAS_MANY, 'Logs', 'user_id'),
			'profiles' => array(self::HAS_MANY, 'Profiles', 'user_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'user_id' => 'User',
			'email' => 'Email',
			'iuid' => 'IUID',
			'password' => 'Password',
			'salt' => 'Salt',
			'created_on' => 'Created On',
			'is_account_active' => 'Is Account Active',
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

		$criteria->compare('user_id',$this->user_id,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('iuid',$this->iuid,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('salt',$this->salt,true);
		$criteria->compare('created_on',$this->created_on,true);
		$criteria->compare('is_account_active',$this->is_account_active,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Users the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
