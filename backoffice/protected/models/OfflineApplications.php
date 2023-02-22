<?php

/**
 * This is the model class for table "bo_offline_applications".
 *
 * The followings are the available columns in table 'bo_offline_applications':
 * @property string $offline_application_id
 * @property string $offline_application_reference_number
 * @property string $iuid
 * @property string $user_id
 * @property integer $service_id
 * @property integer $sub_service_id
 * @property integer $department_id
 * @property integer $caf_id
 * @property string $offline_application_status
 * @property string $application_created_date
 * @property string $application_updated_date
 * @property string $ip_address
 * @property string $user_agent
 *
 * The followings are the available model relations:
 * @property SsoUsers $user
 * @property OfflineApplicationsDmsDocuments[] $offlineApplicationsDmsDocuments
 * @property OfflineApplicationsOtherDocuments[] $offlineApplicationsOtherDocuments
 * @property OfflineApplicationsPayment[] $offlineApplicationsPayments
 */
class OfflineApplications extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'bo_offline_applications';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('offline_application_reference_number, iuid, user_id, service_id, sub_service_id, department_id, offline_application_status, application_created_date, application_updated_date, ip_address, user_agent', 'required'),
			array('service_id, sub_service_id, department_id, caf_id', 'numerical', 'integerOnly'=>true),
			array('offline_application_reference_number, iuid', 'length', 'max'=>20),
			array('user_id', 'length', 'max'=>10),
			array('offline_application_status', 'length', 'max'=>1),
			array('ip_address, user_agent', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('offline_application_id, offline_application_reference_number, iuid, user_id, service_id, sub_service_id, department_id, caf_id, offline_application_status, application_created_date, application_updated_date, ip_address, user_agent', 'safe', 'on'=>'search'),
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
			'user' => array(self::BELONGS_TO, 'SsoUsers', 'user_id'),
			'offlineApplicationsDmsDocuments' => array(self::HAS_MANY, 'OfflineApplicationsDmsDocuments', 'offline_application_id'),
			'offlineApplicationsOtherDocuments' => array(self::HAS_MANY, 'OfflineApplicationsOtherDocuments', 'offline_application_id'),
			'offlineApplicationsPayments' => array(self::HAS_MANY, 'OfflineApplicationsPayment', 'offline_application_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'offline_application_id' => 'Offline Application',
			'offline_application_reference_number' => 'Offline Application Reference Number',
			'iuid' => 'Iuid',
			'user_id' => 'User',
			'service_id' => 'Service',
			'sub_service_id' => 'Sub Service',
			'department_id' => 'Department',
			'caf_id' => 'Caf',
			'offline_application_status' => 'Offline Application Status',
			'application_created_date' => 'Application Created Date',
			'application_updated_date' => 'Application Updated Date',
			'ip_address' => 'Ip Address',
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

		$criteria->compare('offline_application_id',$this->offline_application_id,true);
		$criteria->compare('offline_application_reference_number',$this->offline_application_reference_number,true);
		$criteria->compare('iuid',$this->iuid,true);
		$criteria->compare('user_id',$this->user_id,true);
		$criteria->compare('service_id',$this->service_id);
		$criteria->compare('sub_service_id',$this->sub_service_id);
		$criteria->compare('department_id',$this->department_id);
		$criteria->compare('caf_id',$this->caf_id);
		$criteria->compare('offline_application_status',$this->offline_application_status,true);
		$criteria->compare('application_created_date',$this->application_created_date,true);
		$criteria->compare('application_updated_date',$this->application_updated_date,true);
		$criteria->compare('ip_address',$this->ip_address,true);
		$criteria->compare('user_agent',$this->user_agent,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return OfflineApplications the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
