<?php

/**
 * This is the model class for table "bo_survey_submission_details".
 *
 * The followings are the available columns in table 'bo_survey_submission_details':
 * @property integer $id
 * @property integer $submission_id
 * @property string $question_id
 * @property string $answer_value
 * @property integer $marks
 * @property string $created_time
 *
 * The followings are the available model relations:
 * @property SurveySubmission $submission
 * @property SurveyQuestionAnswerMapping $question
 */
class SurveySubmissionDetails extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'bo_survey_submission_details';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('submission_id, question_id, created_time', 'required'),
			array('submission_id, marks', 'numerical', 'integerOnly'=>true),
			array('question_id', 'length', 'max'=>11),
			array('answer_value', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, submission_id, question_id, answer_value, marks, created_time', 'safe', 'on'=>'search'),
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
			'submission' => array(self::BELONGS_TO, 'SurveySubmission', 'submission_id'),
			'question' => array(self::BELONGS_TO, 'SurveyQuestionAnswerMapping', 'question_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'submission_id' => 'Submission',
			'question_id' => 'Question',
			'answer_value' => 'Answer Value',
			'marks' => 'Marks',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('submission_id',$this->submission_id);
		$criteria->compare('question_id',$this->question_id,true);
		$criteria->compare('answer_value',$this->answer_value,true);
		$criteria->compare('marks',$this->marks);
		$criteria->compare('created_time',$this->created_time,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return SurveySubmissionDetails the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
