<?php

/**
 * This is the model class for table "bo_grievance".
 *
 * The followings are the available columns in table 'bo_grievance':
 * @property string $grievence_no
 * @property string $grievence_title
 * @property string $grievence
 * @property string $grievence_created_by
 * @property string $grievence_created_on
 * @property string $have_replied
 * @property string $grievance_status
 * @property integer $grievance_reopen_count
 * @property string $remote_ip
 * @property string $user_get
 *
 * The followings are the available model relations:
 * @property GrievanceDetail[] $grievanceDetails
 * @property GrievanceDueDates[] $grievanceDueDates
 * @property GrievanceReply[] $grievanceReplies
 * @property GrievanceStatusDetail[] $grievanceStatusDetails
 * @property GrievanceTicketDetail[] $grievanceTicketDetails
 */
class Grievance extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'bo_grievance';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('grievence_title, grievence, grievence_created_by, grievence_created_on, remote_ip, user_get', 'required'),
			array('grievance_reopen_count', 'numerical', 'integerOnly'=>true),
			array('grievence_title, grievence_created_by', 'length', 'max'=>250),
			array('have_replied, grievance_status', 'length', 'max'=>1),
			array('remote_ip, user_get', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('grievence_no, grievence_title, grievence, grievence_created_by, grievence_created_on, have_replied, grievance_status, grievance_reopen_count, remote_ip, user_get', 'safe', 'on'=>'search'),
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
			'grievanceDetails' => array(self::HAS_MANY, 'GrievanceDetail', 'grievence_no'),
			'grievanceDueDates' => array(self::HAS_MANY, 'GrievanceDueDates', 'grievance_id'),
			'grievanceReplies' => array(self::HAS_MANY, 'GrievanceReply', 'grievance_id'),
			'grievanceStatusDetails' => array(self::HAS_MANY, 'GrievanceStatusDetail', 'grievence_no'),
			'grievanceTicketDetails' => array(self::HAS_MANY, 'GrievanceTicketDetail', 'grievance_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'grievence_no' => 'Grievence No',
			'grievence_title' => 'Grievence Title',
			'grievence' => 'Grievence',
			'grievence_created_by' => 'Grievence Created By',
			'grievence_created_on' => 'Grievence Created On',
			'have_replied' => 'Have Replied',
			'grievance_status' => 'Grievance Status',
			'grievance_reopen_count' => 'Grievance Reopen Count',
			'remote_ip' => 'Remote Ip',
			'user_get' => 'User Get',
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

		$criteria->compare('grievence_no',$this->grievence_no,true);
		$criteria->compare('grievence_title',$this->grievence_title,true);
		$criteria->compare('grievence',$this->grievence,true);
		$criteria->compare('grievence_created_by',$this->grievence_created_by,true);
		$criteria->compare('grievence_created_on',$this->grievence_created_on,true);
		$criteria->compare('have_replied',$this->have_replied,true);
		$criteria->compare('grievance_status',$this->grievance_status,true);
		$criteria->compare('grievance_reopen_count',$this->grievance_reopen_count);
		$criteria->compare('remote_ip',$this->remote_ip,true);
		$criteria->compare('user_get',$this->user_get,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Grievance the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
