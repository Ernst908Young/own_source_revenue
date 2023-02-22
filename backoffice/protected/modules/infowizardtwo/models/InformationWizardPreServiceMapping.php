<?php

/**
 * This is the model class for table "bo_information_wizard_pre_service_mapping".
 *
 * The followings are the available columns in table 'bo_information_wizard_pre_service_mapping':
 * @property integer $id
 * @property string $service_id
 * @property string $pre_service_id
 * @property string $status
 * @property string $user_agent
 * @property string $ip_address
 * @property string $created
 */
class InformationWizardPreServiceMapping extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'bo_information_wizard_pre_service_mapping';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('service_id, pre_service_id, status, user_agent, ip_address, created', 'required'),
			array('service_id, user_agent, ip_address', 'length', 'max'=>255),
			array('status', 'length', 'max'=>1),
                        array('service_id','unique', 'message'=>'Service has been already added, You can update that by managing pre service'),			
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, service_id, pre_service_id, status, user_agent, ip_address, created', 'safe', 'on'=>'search'),
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
			'service_id' => 'Service',
			'pre_service_id' => 'Pre Service',
			'status' => 'Status',
			'user_agent' => 'User Agent',
			'ip_address' => 'Ip Address',
			'created' => 'Created',
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
		$criteria->compare('service_id',$this->service_id,true);
		$criteria->compare('pre_service_id',$this->pre_service_id,true);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('user_agent',$this->user_agent,true);
		$criteria->compare('ip_address',$this->ip_address,true);
		$criteria->compare('created',$this->created,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return InformationWizardPreServiceMapping the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
