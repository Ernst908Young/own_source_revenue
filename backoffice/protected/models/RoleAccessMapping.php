<?php

/**
 * This is the model class for table "bo_role_access_mapping".
 *
 * The followings are the available columns in table 'bo_role_access_mapping':
 * @property integer $map_id
 * @property string $role_id
 * @property integer $access_id
 * @property string $created_on
 * @property string $ip_address
 * @property string $user_agent
 * @property string $is_active
 *
 * The followings are the available model relations:
 * @property Roles $role
 * @property RoleAccess $access
 */
class RoleAccessMapping extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'bo_role_access_mapping';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('role_id, access_id, created_on, ip_address, user_agent', 'required'),
			array('access_id', 'numerical', 'integerOnly'=>true),
			array('role_id', 'length', 'max'=>10),
			array('ip_address, user_agent', 'length', 'max'=>255),
			array('is_active', 'length', 'max'=>1),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('map_id, role_id, access_id, created_on, ip_address, user_agent, is_active', 'safe', 'on'=>'search'),
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
			'role' => array(self::BELONGS_TO, 'Roles', 'role_id'),
			'access' => array(self::BELONGS_TO, 'RoleAccess', 'access_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'map_id' => 'Map',
			'role_id' => 'Role',
			'access_id' => 'Access',
			'created_on' => 'Created On',
			'ip_address' => 'Ip Address',
			'user_agent' => 'User Agent',
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

		$criteria->compare('map_id',$this->map_id);
		$criteria->compare('role_id',$this->role_id,true);
		$criteria->compare('access_id',$this->access_id);
		$criteria->compare('created_on',$this->created_on,true);
		$criteria->compare('ip_address',$this->ip_address,true);
		$criteria->compare('user_agent',$this->user_agent,true);
		$criteria->compare('is_active',$this->is_active,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return RoleAccessMapping the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
