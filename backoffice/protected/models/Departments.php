<?php

/**
 * This is the model class for table "bo_departments".
 *
 * The followings are the available columns in table 'bo_departments':
 * @property string $dept_id
 * @property string $department_name
 * @property string $department_unique_code
 * @property string $department_link
 * @property string $department_img
 * @property string $added_on
 * @property integer $dept_order
 * @property string $updated_on
 * @property integer $is_department_active
 *
 * The followings are the available model relations:
 * @property ApplicationSubmission[] $applicationSubmissions
 * @property Roles[] $roles
 * @property UserRoleMapping[] $userRoleMappings
 */
class Departments extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'bo_departments';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('department_name, department_unique_code, department_link, added_on, dept_order', 'required'),
			array('department_unique_code,department_name', 'unique'),
			array('dept_order, is_department_active', 'numerical', 'integerOnly'=>true),
			array('department_name', 'length', 'max'=>512),
			array('department_unique_code, department_link', 'length', 'max'=>128),
			array('updated_on', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('dept_id, department_name, department_unique_code, department_link, added_on, dept_order, updated_on, is_department_active', 'safe', 'on'=>'search'),
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
			'applicationSubmissions' => array(self::HAS_MANY, 'ApplicationSubmission', 'dept_id'),
			'roles' => array(self::HAS_MANY, 'Roles', 'dept_id'),
			'userRoleMappings' => array(self::HAS_MANY, 'UserRoleMapping', 'department_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'dept_id' => 'Dept',
			'department_name' => 'Department Name',
			'department_unique_code' => 'Department Unique Code',
			'department_link' => 'Department Link',
			'department_img' => 'Department Img',
			'added_on' => 'Added On',
			'dept_order' => 'Dept Order',
			'updated_on' => 'Updated On',
			'is_department_active' => 'Is Department Active',
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

		$criteria->compare('dept_id',$this->dept_id,true);
		$criteria->compare('department_name',$this->department_name,true);
		$criteria->compare('department_unique_code',$this->department_unique_code,true);
		$criteria->compare('department_link',$this->department_link,true);
		$criteria->compare('department_img',$this->department_img,true);
		$criteria->compare('added_on',$this->added_on,true);
		$criteria->compare('dept_order',$this->dept_order);
		$criteria->compare('updated_on',$this->updated_on,true);
		$criteria->compare('is_department_active',$this->is_department_active);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Departments the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
