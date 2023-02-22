<?php

/**
 * This is the model class for table "bo_applications_submittions".
 *
 * The followings are the available columns in table 'bo_applications_submittions':
 * @property string $submission_id
 * @property string $application_id
 * @property string $user_id
 * @property string $field_id
 * @property string $field_value
 * @property string $application_status
 *
 * The followings are the available model relations:
 * @property Applications $application
 * @property Filelds $field
 */
class ApplicationsSubmittions extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'bo_applications_submittions';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('application_id, user_id, field_id, field_value', 'required'),
			array('application_id, user_id, field_id', 'length', 'max'=>10),
			array('field_value', 'length', 'max'=>512),
			array('application_status', 'length', 'max'=>1),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('submission_id, application_id, user_id, field_id, field_value, application_status', 'safe', 'on'=>'search'),
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
			'submission_id' => 'Submission',
			'application_id' => 'Application',
			'user_id' => 'User',
			'field_id' => 'Field',
			'field_value' => 'Field Value',
			'application_status' => 'Application Status',
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

		$criteria->compare('submission_id',$this->submission_id,true);
		$criteria->compare('application_id',$this->application_id,true);
		$criteria->compare('user_id',$this->user_id,true);
		$criteria->compare('field_id',$this->field_id,true);
		$criteria->compare('field_value',$this->field_value,true);
		$criteria->compare('application_status',$this->application_status,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ApplicationsSubmittions the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
