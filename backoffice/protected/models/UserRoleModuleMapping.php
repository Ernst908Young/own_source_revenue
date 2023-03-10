<?php

/**
 * This is the model class for table "bo_user_role_module_mapping".
 *
 * The followings are the available columns in table 'bo_user_role_module_mapping':
 * @property integer $id
 * @property string $user_id
 * @property string $role_id
 * @property integer $module_id
 * @property integer $district_id
 * @property string $created_date_time
 * @property string $updated_date_time
 * @property string $is_active
 *
 * The followings are the available model relations:
 * @property District $district
 * @property User $user
 * @property Roles $role
 * @property IncentiveModules $module
 */
class UserRoleModuleMapping extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'bo_user_role_module_mapping';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, role_id, module_id, district_id, created_date_time, is_active', 'required'),
			array('module_id, district_id', 'numerical', 'integerOnly'=>true),
			array('user_id, role_id', 'length', 'max'=>10),
			array('is_active', 'length', 'max'=>1),
			array('updated_date_time', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, user_id, role_id, module_id, district_id, created_date_time, updated_date_time, is_active', 'safe', 'on'=>'search'),
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
			'district' => array(self::BELONGS_TO, 'District', 'district_id'),
			'user' => array(self::BELONGS_TO, 'User', 'user_id'),
			'role' => array(self::BELONGS_TO, 'Roles', 'role_id'),
			'module' => array(self::BELONGS_TO, 'IncentiveModules', 'module_id'),
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
			'role_id' => 'Role',
			'module_id' => 'Module',
			'district_id' => 'District',
			'created_date_time' => 'Created Date Time',
			'updated_date_time' => 'Updated Date Time',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('user_id',$this->user_id,true);
		$criteria->compare('role_id',$this->role_id,true);
		$criteria->compare('module_id',$this->module_id);
		$criteria->compare('district_id',$this->district_id);
		$criteria->compare('created_date_time',$this->created_date_time,true);
		$criteria->compare('updated_date_time',$this->updated_date_time,true);
		$criteria->compare('is_active',$this->is_active,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return UserRoleModuleMapping the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
