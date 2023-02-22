<?php

/**
 * This is the model class for table "bo_survey".
 *
 * The followings are the available columns in table 'bo_survey':
 * @property string $survey_id
 * @property string $title
 * @property string $survey_start_date
 * @property string $survey_end_date
 * @property string $url_hash
 * @property string $is_active
 * @property string $created_time
 *
 * The followings are the available model relations:
 * @property SurveyQuestionMapping[] $surveyQuestionMappings
 */
class Survey extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'bo_survey';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title, survey_start_date, survey_end_date, url_hash, created_time', 'required'),
			array('title, url_hash', 'length', 'max'=>255),
			array('is_active', 'length', 'max'=>1),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('survey_id, title, survey_start_date, survey_end_date, url_hash, is_active, created_time', 'safe', 'on'=>'search'),
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
			'surveyQuestionMappings' => array(self::HAS_MANY, 'SurveyQuestionMapping', 'survey_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'survey_id' => 'Survey',
			'title' => 'Title',
			'survey_start_date' => 'Survey Start Date',
			'survey_end_date' => 'Survey End Date',
			'url_hash' => 'Url Hash',
			'is_active' => 'Is Active',
			'created_time' => 'Created Time',
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

		$criteria->compare('survey_id',$this->survey_id,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('survey_start_date',$this->survey_start_date,true);
		$criteria->compare('survey_end_date',$this->survey_end_date,true);
		$criteria->compare('url_hash',$this->url_hash,true);
		$criteria->compare('is_active',$this->is_active,true);
		$criteria->compare('created_time',$this->created_time,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Survey the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
