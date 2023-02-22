<?php

/**
 * This is the model class for table "bo_filelds".
 *
 * The followings are the available columns in table 'bo_filelds':
 * @property string $field_id
 * @property string $field_name
 * @property string $field_desc
 * @property string $filed_type
 * @property string $is_field_active
 *
 * The followings are the available model relations:
 * @property ApplicationsFieldsMapping[] $applicationsFieldsMappings
 * @property ApplicationsSubmittions[] $applicationsSubmittions
 */
class Filelds extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'bo_filelds';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('field_name, field_desc, filed_type', 'required'),
			array('field_name', 'length', 'max'=>64),
			array('field_desc', 'length', 'max'=>512),
			array('filed_type', 'length', 'max'=>12),
			array('is_field_active', 'length', 'max'=>1),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('field_id, field_name, field_desc, filed_type, is_field_active', 'safe', 'on'=>'search'),
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
			'applicationsFieldsMappings' => array(self::HAS_MANY, 'ApplicationsFieldsMapping', 'field_id'),
			'applicationsSubmittions' => array(self::HAS_MANY, 'ApplicationsSubmittions', 'field_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'field_id' => 'Field',
			'field_name' => 'Field Name',
			'field_desc' => 'Field Desc',
			'filed_type' => 'Field Type',
			'is_field_active' => 'Is Field Active',
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

		$criteria->compare('field_id',$this->field_id,true);
		$criteria->compare('field_name',$this->field_name,true);
		$criteria->compare('field_desc',$this->field_desc,true);
		$criteria->compare('filed_type',$this->filed_type,true);
		$criteria->compare('is_field_active',$this->is_field_active,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Filelds the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
