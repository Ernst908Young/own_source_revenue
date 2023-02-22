<?php

/**
 * This is the model class for table "bo_offline_mode_of_submission".
 *
 * The followings are the available columns in table 'bo_offline_mode_of_submission':
 * @property string $id
 * @property string $offline_application_id
 * @property string $mode_of_submission
 * @property string $tracking_details
 * @property string $date_of_submission
 * @property string $submitted_to
 * @property string $name_of_office
 * @property string $is_active
 * @property string $created_date
 */
class OfflineModeOfSubmission extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'bo_offline_mode_of_submission';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('offline_application_id, mode_of_submission, date_of_submission, submitted_to, name_of_office', 'required'),
			array('offline_application_id', 'length', 'max'=>11),
			array('mode_of_submission', 'length', 'max'=>7),
			array('submitted_to', 'length', 'max'=>10),
			array('name_of_office', 'length', 'max'=>255),
			array('is_active', 'length', 'max'=>1),
			array('tracking_details, created_date', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, offline_application_id, mode_of_submission, tracking_details, date_of_submission, submitted_to, name_of_office, is_active, created_date', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'offline_application_id' => 'Offline Application',
			'mode_of_submission' => 'Mode Of Submission',
			'tracking_details' => 'Tracking Details',
			'date_of_submission' => 'Date Of Submission',
			'submitted_to' => 'Submitted To',
			'name_of_office' => 'Name Of Office',
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

		$criteria->compare('id',$this->id,true);
		$criteria->compare('offline_application_id',$this->offline_application_id,true);
		$criteria->compare('mode_of_submission',$this->mode_of_submission,true);
		$criteria->compare('tracking_details',$this->tracking_details,true);
		$criteria->compare('date_of_submission',$this->date_of_submission,true);
		$criteria->compare('submitted_to',$this->submitted_to,true);
		$criteria->compare('name_of_office',$this->name_of_office,true);
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
	 * @return OfflineModeOfSubmission the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
