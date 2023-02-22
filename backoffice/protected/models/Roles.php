<?php

/**
 * This is the model class for table "bo_roles".
 *
 * The followings are the available columns in table 'bo_roles':
 * @property string $role_id
 * @property string $role_name
 * @property string $rele_desc
 * @property string $is_role_active
 * @property string $is_external
 *
 * The followings are the available model relations:
 * @property BoAppWorkflow[] $boAppWorkflows
 * @property BoApplicationFlowLogs[] $boApplicationFlowLogs
 * @property BoApplicationVerificationLevel[] $boApplicationVerificationLevels
 * @property BoRoleAccessMapping[] $boRoleAccessMappings
 * @property BoUserRoleMapping[] $boUserRoleMappings
 * @property BoUsers[] $boUsers
 */
class Roles extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'bo_roles';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('role_name, rele_desc', 'required'),
			array('role_name', 'length', 'max'=>64),
			array('is_role_active, is_external', 'length', 'max'=>1),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('role_id, role_name, rele_desc, is_role_active, is_external', 'safe', 'on'=>'search'),
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
			'boAppWorkflows' => array(self::HAS_MANY, 'BoAppWorkflow', 'role_id'),
			'boApplicationFlowLogs' => array(self::HAS_MANY, 'BoApplicationFlowLogs', 'approver_role_id'),
			'boApplicationVerificationLevels' => array(self::HAS_MANY, 'BoApplicationVerificationLevel', 'next_role_id'),
			'boRoleAccessMappings' => array(self::HAS_MANY, 'BoRoleAccessMapping', 'role_id'),
			'boUserRoleMappings' => array(self::HAS_MANY, 'BoUserRoleMapping', 'role_id'),
			'boUsers' => array(self::HAS_MANY, 'BoUsers', 'role_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'role_id' => 'Role',
			'role_name' => 'Role Name',
			'rele_desc' => 'Rele Desc',
			'is_role_active' => 'Is Role Active',
			'is_external' => 'Is External',
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

		$criteria->compare('role_id',$this->role_id,true);
		$criteria->compare('role_name',$this->role_name,true);
		$criteria->compare('rele_desc',$this->rele_desc,true);
		$criteria->compare('is_role_active',$this->is_role_active,true);
		$criteria->compare('is_external',$this->is_external,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Roles the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
