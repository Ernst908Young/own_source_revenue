<?php

/**
 * This is the model class for table "sso_sp_applcations_detail".
 *
 * The followings are the available columns in table 'sso_sp_applcations_detail':
 * @property string $sp_app_id
 * @property integer $app_id
 * @property string $timeline_period
 * @property string $form_download_link
 * @property string $application_created_on
 * @property string $procedure_link
 * @property string $remote_ip
 * @property string $user_agent
 * @property string $is_active
 *
 * The followings are the available model relations:
 * @property BoSpAllApplications $app
 */
class SpApplcationsDetail extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'sso_sp_applcations_detail';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('app_id, timeline_period, form_download_link, application_created_on, procedure_link, remote_ip, user_agent', 'required'),
			array('app_id', 'numerical', 'integerOnly'=>true),
			array('timeline_period', 'length', 'max'=>50),
			array('form_download_link, procedure_link', 'length', 'max'=>500),
			array('remote_ip, user_agent', 'length', 'max'=>250),
			array('is_active', 'length', 'max'=>1),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('sp_app_id, app_id, timeline_period, form_download_link, application_created_on, procedure_link, remote_ip, user_agent, is_active', 'safe', 'on'=>'search'),
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
			'app' => array(self::BELONGS_TO, 'BoSpAllApplications', 'app_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'sp_app_id' => 'Sp App',
			'app_id' => 'App',
			'timeline_period' => 'Timeline Period',
			'form_download_link' => 'Form Download Link',
			'application_created_on' => 'Application Created On',
			'procedure_link' => 'Procedure Link',
			'remote_ip' => 'Remote Ip',
			'user_agent' => 'User Agent',
			'is_active' => 'Is Active',
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

		$criteria->compare('sp_app_id',$this->sp_app_id,true);
		$criteria->compare('app_id',$this->app_id);
		$criteria->compare('timeline_period',$this->timeline_period,true);
		$criteria->compare('form_download_link',$this->form_download_link,true);
		$criteria->compare('application_created_on',$this->application_created_on,true);
		$criteria->compare('procedure_link',$this->procedure_link,true);
		$criteria->compare('remote_ip',$this->remote_ip,true);
		$criteria->compare('user_agent',$this->user_agent,true);
		$criteria->compare('is_active',$this->is_active,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return SpApplcationsDetail the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
