<?php

/**
 * This is the model class for table "bo_grievance_status_detail".
 *
 * The followings are the available columns in table 'bo_grievance_status_detail':
 * @property string $status_id
 * @property string $grievence_no
 * @property string $status
 * @property string $status_change_date
 * @property string $status_changed_by
 * @property string $remote_ip_address
 * @property string $user_agent
 *
 * The followings are the available model relations:
 * @property Grievance $grievenceNo
 * @property User $statusChangedBy
 */
class GrievanceStatusDetail extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'bo_grievance_status_detail';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('grievence_no, status, status_change_date, status_changed_by, remote_ip_address, user_agent', 'required'),
			array('grievence_no, status_changed_by', 'length', 'max'=>10),
			array('status', 'length', 'max'=>1),
			array('remote_ip_address, user_agent', 'length', 'max'=>250),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('status_id, grievence_no, status, status_change_date, status_changed_by, remote_ip_address, user_agent', 'safe', 'on'=>'search'),
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
			'grievenceNo' => array(self::BELONGS_TO, 'Grievance', 'grievence_no'),
			'statusChangedBy' => array(self::BELONGS_TO, 'User', 'status_changed_by'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'status_id' => 'Status',
			'grievence_no' => 'Grievence No',
			'status' => 'Status',
			'status_change_date' => 'Status Change Date',
			'status_changed_by' => 'Status Changed By',
			'remote_ip_address' => 'Remote Ip Address',
			'user_agent' => 'User Agent',
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

		$criteria->compare('status_id',$this->status_id,true);
		$criteria->compare('grievence_no',$this->grievence_no,true);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('status_change_date',$this->status_change_date,true);
		$criteria->compare('status_changed_by',$this->status_changed_by,true);
		$criteria->compare('remote_ip_address',$this->remote_ip_address,true);
		$criteria->compare('user_agent',$this->user_agent,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return GrievanceStatusDetail the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
