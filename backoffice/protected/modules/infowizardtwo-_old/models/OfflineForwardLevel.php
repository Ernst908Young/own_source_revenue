<?php

/**
 * This is the model class for table "bo_offline_forward_level".
 *
 * The followings are the available columns in table 'bo_offline_forward_level':
 * @property string $id
 * @property string $offline_application_id
 * @property string $sender
 * @property integer $sender_role
 * @property string $sender_id
 * @property string $receiver
 * @property integer $receiver_role
 * @property integer $department_id
 * @property integer $district_id
 * @property string $comment
 * @property string $upload
 * @property string $mode_of_submission_dic
 * @property string $tracking_detail_dic
 * @property string $user_agent
 * @property string $ip_address
 * @property string $status
 * @property integer $offline_status_id
 * @property string $created_date
 */
class OfflineForwardLevel extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'bo_offline_forward_level';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('offline_application_id, sender, status, created_date', 'required'),
			array('sender_role, receiver_role, department_id, district_id, offline_status_id', 'numerical', 'integerOnly'=>true),
			array('offline_application_id, sender_id', 'length', 'max'=>11),
			array('sender, receiver, comment, upload, mode_of_submission_dic, tracking_detail_dic, user_agent, ip_address, status', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, offline_application_id, sender, sender_role, sender_id, receiver, receiver_role, department_id, district_id, comment, upload, mode_of_submission_dic, tracking_detail_dic, user_agent, ip_address, status, offline_status_id, created_date', 'safe', 'on'=>'search'),
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
			'sender' => 'Sender',
			'sender_role' => 'Sender Role',
			'sender_id' => 'Sender',
			'receiver' => 'Receiver',
			'receiver_role' => 'Receiver Role',
			'department_id' => 'Department',
			'district_id' => 'District',
			'comment' => 'Comment',
			'upload' => 'Upload',
			'mode_of_submission_dic' => 'Mode Of Submission Dic',
			'tracking_detail_dic' => 'Tracking Detail Dic',
			'user_agent' => 'User Agent',
			'ip_address' => 'Ip Address',
			'status' => 'Status',
			'offline_status_id' => 'Offline Status',
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
		$criteria->compare('sender',$this->sender,true);
		$criteria->compare('sender_role',$this->sender_role);
		$criteria->compare('sender_id',$this->sender_id,true);
		$criteria->compare('receiver',$this->receiver,true);
		$criteria->compare('receiver_role',$this->receiver_role);
		$criteria->compare('department_id',$this->department_id);
		$criteria->compare('district_id',$this->district_id);
		$criteria->compare('comment',$this->comment,true);
		$criteria->compare('upload',$this->upload,true);
		$criteria->compare('mode_of_submission_dic',$this->mode_of_submission_dic,true);
		$criteria->compare('tracking_detail_dic',$this->tracking_detail_dic,true);
		$criteria->compare('user_agent',$this->user_agent,true);
		$criteria->compare('ip_address',$this->ip_address,true);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('offline_status_id',$this->offline_status_id);
		$criteria->compare('created_date',$this->created_date,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return OfflineForwardLevel the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
