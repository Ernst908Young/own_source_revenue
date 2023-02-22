<?php

/**
 * This is the model class for table "bo_incentive_modules".
 *
 * The followings are the available columns in table 'bo_incentive_modules':
 * @property integer $module_id
 * @property string $module_name
 * @property string $module_url
 * @property string $is_active
 * @property string $created_date
 *
 * The followings are the available model relations:
 * @property UserRoleModuleMapping[] $userRoleModuleMappings
 */
class IncentiveModules extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'bo_incentive_modules';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('module_name, module_url, created_date', 'required'),
			array('module_name', 'length', 'max'=>80),
			array('module_url', 'length', 'max'=>500),
			array('is_active', 'length', 'max'=>1),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('module_id, module_name, module_url, is_active, created_date', 'safe', 'on'=>'search'),
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
			'userRoleModuleMappings' => array(self::HAS_MANY, 'UserRoleModuleMapping', 'module_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'module_id' => 'Module',
			'module_name' => 'Module Name',
			'module_url' => 'Module Url',
			'is_active' => 'Is Active',
			'created_date' => 'Created Date',
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

		$criteria->compare('module_id',$this->module_id);
		$criteria->compare('module_name',$this->module_name,true);
		$criteria->compare('module_url',$this->module_url,true);
		$criteria->compare('is_active',$this->is_active,true);
		$criteria->compare('created_date',$this->created_date,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return IncentiveModules the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	public static function getModuleNameFromID($module_id){
		$module_name=IncentiveModules::model()->findByPK($module_id);
		if($module_name===null)
			return false;
		return $module_name->module_name;
	}
}
