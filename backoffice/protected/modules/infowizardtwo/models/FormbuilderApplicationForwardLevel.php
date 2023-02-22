<?php

/**
 * This is the model class for table "bo_infowiz_formbuilder_application_forward_level".
 *
 * The followings are the available columns in table 'bo_infowiz_formbuilder_application_forward_level':
 * @property integer $submission_id
 * @property integer $application_id
 * @property string $service_id
 * @property integer $user_id
 * @property integer $dept_id
 * @property string $field_value
 * @property string $application_status
 * @property string $application_created_date
 * @property string $application_updated_date_time
 * @property string $ip_address
 * @property string $user_agent
 * @property integer $landrigion_id
 */
class FormbuilderApplicationForwardLevel extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'bo_infowiz_formbuilder_application_forward_level';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('next_role_id', 'required'),
			array('next_role_id', 'numerical', 'integerOnly'=>true),
			// @todo Please remove those attributes that should not be searched.
			array('next_role_id, verifier_user_id, app_Sub_id, forwarded_dept_id, post_info, verifier_user_comment, created_on, updated_date_time, ip_address, user_agent, comment_date', 'safe', 'on'=>'search'),
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
			'next_role_id' => 'Next Role ID',
			'app_Sub_id' => 'Submission ID'			
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
/* 
		$criteria=new CDbCriteria;

		$criteria->compare('submission_id',$this->submission_id);
		$criteria->compare('application_id',$this->application_id);
		
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		)); */
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return NewApplicationSubmission the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
