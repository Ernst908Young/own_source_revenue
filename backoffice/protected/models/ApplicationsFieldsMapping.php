<?php

/**
 * This is the model class for table "bo_applications_fields_mapping".
 *
 * The followings are the available columns in table 'bo_applications_fields_mapping':
 * @property integer $app_mapping_id
 * @property string $application_id
 * @property string $field_id
 * @property string $field_name
 * @property string $field_value
 * @property string $field_max_length
 * @property string $field_min_length
 * @property string $field_file_type
 * @property integer $field_numbers
 * @property integer $field_size
 * @property string $field_class
 * @property string $field_autocomplete
 * @property string $field_validation
 * @property string $field_autofocus
 * @property string $each_field_placeholder
 * @property string $each_field_value
 * @property string $field_onblur
 * @property string $field_onchange
 * @property string $field_onkeyup
 * @property string $field_onsubmit
 * @property string $is_mapping_active
 * @property string $created_on
 * @property string $remote_server
 * @property string $user_agent
 *
 * The followings are the available model relations:
 * @property Applications $application
 * @property Filelds $field
 */
class ApplicationsFieldsMapping extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'bo_applications_fields_mapping';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('application_id, field_id, field_name, created_on, remote_server, user_agent', 'required'),
			array('field_numbers, field_size', 'numerical', 'integerOnly'=>true),
			array('application_id, field_id', 'length', 'max'=>10),
			array('field_name, field_value, field_class, each_field_placeholder, each_field_value, field_onblur, field_onchange, field_onkeyup, field_onsubmit, remote_server, user_agent', 'length', 'max'=>255),
			array('field_max_length, field_min_length', 'length', 'max'=>20),
			array('field_file_type', 'length', 'max'=>3),
			array('field_autocomplete, field_autofocus, is_mapping_active', 'length', 'max'=>1),
			array('field_validation', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('app_mapping_id, application_id, field_id, field_name, field_value, field_max_length, field_min_length, field_file_type, field_numbers, field_size, field_class, field_autocomplete, field_validation, field_autofocus, each_field_placeholder, each_field_value, field_onblur, field_onchange, field_onkeyup, field_onsubmit, is_mapping_active, created_on, remote_server, user_agent', 'safe', 'on'=>'search'),
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
			'application' => array(self::BELONGS_TO, 'Applications', 'application_id'),
			'field' => array(self::BELONGS_TO, 'Filelds', 'field_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'app_mapping_id' => 'App Mapping',
			'application_id' => 'Application',
			'field_id' => 'Field',
			'field_name' => 'Field Name',
			'field_value' => 'Field Value',
			'field_max_length' => 'Field Max Length',
			'field_min_length' => 'Field Min Length',
			'field_file_type' => 'Field File Type',
			'field_numbers' => 'Field Numbers',
			'field_size' => 'Field Size',
			'field_class' => 'Field Class',
			'field_autocomplete' => 'Field Autocomplete',
			'field_validation' => 'Field Validation',
			'field_autofocus' => 'Field Autofocus',
			'each_field_placeholder' => 'Each Field Placeholder',
			'each_field_value' => 'Each Field Value',
			'field_onblur' => 'Field Onblur',
			'field_onchange' => 'Field Onchange',
			'field_onkeyup' => 'Field Onkeyup',
			'field_onsubmit' => 'Field Onsubmit',
			'is_mapping_active' => 'Is Mapping Active',
			'created_on' => 'Created On',
			'remote_server' => 'Remote Server',
			'user_agent' => 'User Agent',
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

		$criteria->compare('app_mapping_id',$this->app_mapping_id);
		$criteria->compare('application_id',$this->application_id,true);
		$criteria->compare('field_id',$this->field_id,true);
		$criteria->compare('field_name',$this->field_name,true);
		$criteria->compare('field_value',$this->field_value,true);
		$criteria->compare('field_max_length',$this->field_max_length,true);
		$criteria->compare('field_min_length',$this->field_min_length,true);
		$criteria->compare('field_file_type',$this->field_file_type,true);
		$criteria->compare('field_numbers',$this->field_numbers);
		$criteria->compare('field_size',$this->field_size);
		$criteria->compare('field_class',$this->field_class,true);
		$criteria->compare('field_autocomplete',$this->field_autocomplete,true);
		$criteria->compare('field_validation',$this->field_validation,true);
		$criteria->compare('field_autofocus',$this->field_autofocus,true);
		$criteria->compare('each_field_placeholder',$this->each_field_placeholder,true);
		$criteria->compare('each_field_value',$this->each_field_value,true);
		$criteria->compare('field_onblur',$this->field_onblur,true);
		$criteria->compare('field_onchange',$this->field_onchange,true);
		$criteria->compare('field_onkeyup',$this->field_onkeyup,true);
		$criteria->compare('field_onsubmit',$this->field_onsubmit,true);
		$criteria->compare('is_mapping_active',$this->is_mapping_active,true);
		$criteria->compare('created_on',$this->created_on,true);
		$criteria->compare('remote_server',$this->remote_server,true);
		$criteria->compare('user_agent',$this->user_agent,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ApplicationsFieldsMapping the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
