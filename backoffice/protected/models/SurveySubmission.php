<?php

/**
 * This is the model class for table "bo_survey_submission".
 *
 * The followings are the available columns in table 'bo_survey_submission':
 * @property integer $submission_id
 * @property string $user_type
 * @property string $full_name
 * @property string $email
 * @property string $mobile
 * @property string $survey_id
 * @property integer $over_all_rating
 * @property string $over_all_comments
 * @property string $referral_url
 * @property string $remote_ip
 * @property string $user_agent
 * @property string $created_date
 *
 * The followings are the available model relations:
 * @property Survey $survey
 * @property SurveySubmissionDetails[] $surveySubmissionDetails
 */
class SurveySubmission extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'bo_survey_submission';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_type, survey_id, over_all_rating, over_all_comments, referral_url, remote_ip, user_agent, created_date', 'required'),
			array('over_all_rating', 'numerical', 'integerOnly'=>true),
			array('user_type', 'length', 'max'=>9),
			array('full_name, email', 'length', 'max'=>100),
			array('mobile', 'length', 'max'=>12),
			array('survey_id', 'length', 'max'=>11),
			array('remote_ip', 'length', 'max'=>50),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('submission_id, user_type, full_name, email, mobile, survey_id, over_all_rating, over_all_comments, referral_url, remote_ip, user_agent, created_date', 'safe', 'on'=>'search'),
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
			'survey' => array(self::BELONGS_TO, 'Survey', 'survey_id'),
			'surveySubmissionDetails' => array(self::HAS_MANY, 'SurveySubmissionDetails', 'submission_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'submission_id' => 'Submission',
			'user_type' => 'User Type',
			'full_name' => 'Full Name',
			'email' => 'Email',
			'mobile' => 'Mobile',
			'survey_id' => 'Survey',
			'over_all_rating' => 'Over All Rating',
			'over_all_comments' => 'Over All Comments',
			'referral_url' => 'Referral Url',
			'remote_ip' => 'Remote Ip',
			'user_agent' => 'User Agent',
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

		$criteria->compare('submission_id',$this->submission_id);
		$criteria->compare('user_type',$this->user_type,true);
		$criteria->compare('full_name',$this->full_name,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('mobile',$this->mobile,true);
		$criteria->compare('survey_id',$this->survey_id,true);
		$criteria->compare('over_all_rating',$this->over_all_rating);
		$criteria->compare('over_all_comments',$this->over_all_comments,true);
		$criteria->compare('referral_url',$this->referral_url,true);
		$criteria->compare('remote_ip',$this->remote_ip,true);
		$criteria->compare('user_agent',$this->user_agent,true);
		$criteria->compare('created_date',$this->created_date,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return SurveySubmission the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
