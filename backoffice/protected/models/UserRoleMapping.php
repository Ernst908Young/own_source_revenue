<?php

/**
 * This is the model class for table "bo_user_role_mapping".
 *
 * The followings are the available columns in table 'bo_user_role_mapping':
 * @property string $mapping_id
 * @property integer $user_id
 * @property string $role_id
 * @property string $department_id
 * @property string $lr_id
 * @property string $created_time
 * @property string $modified_time
 * @property string $is_mapping_active
 *
 * The followings are the available model relations:
 * @property Roles $role
 * @property Departments $department
 * @property Landregion $lr
 */
class UserRoleMapping extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'bo_user_role_mapping';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, role_id, department_id, created_time', 'required'),
			array('user_id', 'numerical', 'integerOnly'=>true),
			array('role_id, lr_id', 'length', 'max'=>10),
			array('department_id', 'length', 'max'=>11),
			array('is_mapping_active', 'length', 'max'=>1),
			array('modified_time', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('mapping_id, user_id, role_id, department_id, lr_id, created_time, modified_time, is_mapping_active', 'safe', 'on'=>'search'),
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
			'department' => array(self::BELONGS_TO, 'Departments', 'department_id'),
			'lr' => array(self::BELONGS_TO, 'Landregion', 'lr_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'mapping_id' => 'Mapping',
			'user_id' => 'User',
			'role_id' => 'Role',
			'department_id' => 'Department',
			'lr_id' => 'Lr',
			'created_time' => 'Created Time',
			'modified_time' => 'Modified Time',
			'is_mapping_active' => 'Is Mapping Active',
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

		$criteria->compare('mapping_id',$this->mapping_id,true);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('role_id',$this->role_id,true);
		$criteria->compare('department_id',$this->department_id,true);
		$criteria->compare('lr_id',$this->lr_id,true);
		$criteria->compare('created_time',$this->created_time,true);
		$criteria->compare('modified_time',$this->modified_time,true);
		$criteria->compare('is_mapping_active',$this->is_mapping_active,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return UserRoleMapping the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
