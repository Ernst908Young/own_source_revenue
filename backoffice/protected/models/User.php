<?php

/**
 * This is the model class for table "bo_user".
 *
 * The followings are the available columns in table 'bo_user':
 * @property string $uid
 * @property string $full_name
 * @property string $email
 * @property string $mobile
 * @property string $password
 * @property string $created_datetime
 * @property string $dept_id
 * @property integer $disctrict_id
 * @property string $is_active
 *
 * The followings are the available model relations:
 * @property ApplicationVerificationLevel[] $applicationVerificationLevels
 * @property Departments $dept
 * @property District $disctrict
 * @property UserRoleMapping[] $userRoleMappings
 */
class User extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'bo_user';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('full_name, email, password, created_datetime, dept_id, disctrict_id, mobile, is_active','required'),
			array('disctrict_id', 'numerical', 'integerOnly'=>true),
			array('full_name', 'length', 'max'=>60),
			array('email, password, email_alert', 'length', 'max'=>128),
			array('mobile', 'length', 'max'=>16),
			array('dept_id', 'length', 'max'=>11),
			array('is_active', 'length', 'max'=>1),
                        array('delegate_officer_number', 'length', 'max'=>16),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('uid, full_name, email, email_alert, mobile, delegate_officer_number, password, created_datetime, dept_id, disctrict_id, is_active', 'safe', 'on'=>'search'),
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
			'applicationVerificationLevels' => array(self::HAS_MANY, 'ApplicationVerificationLevel', 'approval_user_id'),
			'dept' => array(self::BELONGS_TO, 'Departments', 'dept_id'),
			'disctrict' => array(self::BELONGS_TO, 'District', 'disctrict_id'),
			'userRoleMappings' => array(self::HAS_MANY, 'UserRoleMapping', 'user_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'uid' => 'user id',
			'full_name' => 'Full Name',
			'email' => 'E-mail',
			'email_alert' => 'E-mail Alert',
			'mobile' => 'Mobile',
                        'delegate_officer_number' => 'Delegate Officer Mobile Number',
			'password' => 'password',
			'created_datetime' => 'created on',
			'dept_id' => 'Dept',
			'disctrict_id' => 'Disctrict',
			'is_active' => 'Is Active',
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

		$criteria->compare('uid',$this->uid,true);
		$criteria->compare('full_name',$this->full_name,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('email_alert',$this->email_alert,true);
		$criteria->compare('mobile',$this->mobile,true);
                $criteria->compare('delegate_officer_number',$this->mobile,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('created_datetime',$this->created_datetime,true);
		$criteria->compare('dept_id',$this->dept_id,true);
		$criteria->compare('disctrict_id',$this->disctrict_id);
		$criteria->compare('is_active',$this->is_active,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return User the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
