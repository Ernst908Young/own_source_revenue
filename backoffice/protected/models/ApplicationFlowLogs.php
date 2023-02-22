<?php

/**
 * This is the model class for table "bo_application_flow_logs".
 *
 * The followings are the available columns in table 'bo_application_flow_logs':
 * @property string $log_id
 * @property string $submission_id
 * @property string $approver_role_id
 * @property string $approval_user_id
 * @property string $investor_id
 * @property string $approver_comments
 * @property string $created_date_time
 * @property string $user_agent
 * @property string $remote_ip_address
 * @property string $application_status
 *
 * The followings are the available model relations:
 * @property ApplicationSubmission $submission
 * @property Roles $approverRole
 */
class ApplicationFlowLogs extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'bo_application_flow_logs';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('submission_id, created_date_time, user_agent, remote_ip_address, application_status', 'required'),
			array('submission_id, approver_role_id, approval_user_id, investor_id', 'length', 'max'=>10),
			array('user_agent, remote_ip_address', 'length', 'max'=>250),
			array('application_status', 'length', 'max'=>3),
			array('approver_comments', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('log_id, submission_id, approver_role_id, approval_user_id, investor_id, log_type, approver_comments, created_date_time, user_agent, remote_ip_address, application_status', 'safe', 'on'=>'search'),
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
			'submission' => array(self::BELONGS_TO, 'ApplicationSubmission', 'submission_id'),
			'approverRole' => array(self::BELONGS_TO, 'Roles', 'approver_role_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'log_id' => 'Log',
			'submission_id' => 'Submission',
			'approver_role_id' => 'Approver Role',
			'approval_user_id' => 'Approval User',
			'investor_id' => 'Investor',
			'approver_comments' => 'Approver Comments',
			'created_date_time' => 'Created Date Time',
			'user_agent' => 'User Agent',
			'remote_ip_address' => 'Remote Ip Address',
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

		$criteria->compare('log_id',$this->log_id,true);
		$criteria->compare('submission_id',$this->submission_id,true);
		$criteria->compare('approver_role_id',$this->approver_role_id,true);
		$criteria->compare('approval_user_id',$this->approval_user_id,true);
		$criteria->compare('investor_id',$this->investor_id,true);
		$criteria->compare('approver_comments',$this->approver_comments,true);
		$criteria->compare('created_date_time',$this->created_date_time,true);
		$criteria->compare('user_agent',$this->user_agent,true);
		$criteria->compare('remote_ip_address',$this->remote_ip_address,true);
		$criteria->compare('application_status',$this->application_status,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ApplicationFlowLogs the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	public static function generateWorkFlow($sub_id,$approver_role_id=null,$approval_user_id=null,$approver_comments=null,$investor_id=null,$application_status='P'){
			$model=new ApplicationFlowLogs;
			$model->submission_id=$sub_id;
			$model->approver_role_id=$approver_role_id;
			$model->approval_user_id=$approval_user_id;
			$model->approver_comments=$approver_comments;
			$model->investor_id=$investor_id;
			$model->application_status=$application_status;
			$model->created_date_time=date('Y-m-d H:i:s');
			$model->user_agent=$_SERVER['HTTP_USER_AGENT'];;
			$model->remote_ip_address=$_SERVER['REMOTE_ADDR'];
			$model->save();

		}
}
