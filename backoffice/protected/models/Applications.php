<?php

/**
 * This is the model class for table "bo_applications".
 *
 * The followings are the available columns in table 'bo_applications':
 * @property string $application_id
 * @property string $application_name
 * @property string $application_desc
 * @property string $dept_id
 * @property string $is_application_active
 *
 * The followings are the available model relations:
 * @property Departments $dept
 * @property ApplicationsFieldsMapping[] $applicationsFieldsMappings
 * @property ApplicationsSubmittions[] $applicationsSubmittions
 */
class Applications extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'bo_applications';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('application_name, application_desc, dept_id', 'required'),
			array('application_name', 'length', 'max'=>128),
			array('application_desc', 'length', 'max'=>512),
			array('dept_id', 'length', 'max'=>11),
			array('is_application_active', 'length', 'max'=>1),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('application_id, application_name, application_desc, dept_id, is_application_active', 'safe', 'on'=>'search'),
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
			'dept' => array(self::BELONGS_TO, 'Departments', 'dept_id'),
			'applicationsFieldsMappings' => array(self::HAS_MANY, 'ApplicationsFieldsMapping', 'application_id'),
			'applicationsSubmittions' => array(self::HAS_MANY, 'ApplicationsSubmittions', 'application_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'application_id' => 'Application',
			'application_name' => 'Application Name',
			'application_desc' => 'Application Desc',
			'dept_id' => 'Dept',
			'is_application_active' => 'Is Application Active',
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

		$criteria->compare('application_id',$this->application_id,true);
		$criteria->compare('application_name',$this->application_name,true);
		$criteria->compare('application_desc',$this->application_desc,true);
		$criteria->compare('dept_id',$this->dept_id,true);
		$criteria->compare('is_application_active',$this->is_application_active,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Applications the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
