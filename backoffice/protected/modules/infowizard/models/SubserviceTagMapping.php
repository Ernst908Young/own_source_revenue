<?php

/**
 * This is the model class for table "bo_infowizard_subservice_tag_mapping".
 *
 * The followings are the available columns in table 'bo_infowizard_subservice_tag_mapping':
 * @property integer $id
 * @property string $sub_service_id
 * @property integer $service_id
 * @property integer $subservice_id
 * @property string $to_be_used_in_cis
 * @property string $to_be_used_in_online_offline
 * @property string $to_be_used_in_infowiz
 * @property string $to_be_used_in_caf_2
 * @property string $to_be_used_in_inter_departmental_clearance
 * @property string $to_be_used_in_sectoral_clearence
 * @property string $to_be_used_in_dms
 * @property string $is_active
 * @property string $ip_address
 * @property string $user_agent
 * @property integer $user_id
 * @property string $created
 * @property string $modified
 */
class SubserviceTagMapping extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'bo_infowizard_subservice_tag_mapping';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('sub_service_id, service_id, subservice_id, is_active, ip_address, user_agent, user_id, created, modified', 'required'),
			array('service_id, subservice_id, user_id', 'numerical', 'integerOnly'=>true),
			array('sub_service_id', 'length', 'max'=>10),
			array('to_be_used_in_cis, to_be_used_in_online_offline, to_be_used_in_infowiz, to_be_used_in_caf_2, to_be_used_in_inter_departmental_clearance, to_be_used_in_sectoral_clearence, to_be_used_in_dms, is_active', 'length', 'max'=>1),
			array('ip_address', 'length', 'max'=>20),
			array('user_agent', 'length', 'max'=>500),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, sub_service_id, service_id, subservice_id, to_be_used_in_cis, to_be_used_in_online_offline, to_be_used_in_infowiz, to_be_used_in_caf_2, to_be_used_in_inter_departmental_clearance, to_be_used_in_sectoral_clearence, to_be_used_in_dms, is_active, ip_address, user_agent, user_id, created, modified', 'safe', 'on'=>'search'),
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
			'sub_service_id' => 'Sub Service',
			'service_id' => 'Service',
			'subservice_id' => 'Subservice',
			'to_be_used_in_cis' => 'To Be Used In Cis',
			'to_be_used_in_online_offline' => 'To Be Used In Online Offline',
			'to_be_used_in_infowiz' => 'To Be Used In Infowiz',
			'to_be_used_in_caf_2' => 'To Be Used In Caf 2',
			'to_be_used_in_inter_departmental_clearance' => 'To Be Used In Inter Departmental Clearance',
			'to_be_used_in_sectoral_clearence' => 'To Be Used In Sectoral Clearence',
			'to_be_used_in_dms' => 'To Be Used In Dms',
			'is_active' => 'Is Active',
			'ip_address' => 'Ip Address',
			'user_agent' => 'User Agent',
			'user_id' => 'User',
			'created' => 'Created',
			'modified' => 'Modified',
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
		$criteria->compare('sub_service_id',$this->sub_service_id,true);
		$criteria->compare('service_id',$this->service_id);
		$criteria->compare('subservice_id',$this->subservice_id);
		$criteria->compare('to_be_used_in_cis',$this->to_be_used_in_cis,true);
		$criteria->compare('to_be_used_in_online_offline',$this->to_be_used_in_online_offline,true);
		$criteria->compare('to_be_used_in_infowiz',$this->to_be_used_in_infowiz,true);
		$criteria->compare('to_be_used_in_caf_2',$this->to_be_used_in_caf_2,true);
		$criteria->compare('to_be_used_in_inter_departmental_clearance',$this->to_be_used_in_inter_departmental_clearance,true);
		$criteria->compare('to_be_used_in_sectoral_clearence',$this->to_be_used_in_sectoral_clearence,true);
		$criteria->compare('to_be_used_in_dms',$this->to_be_used_in_dms,true);
		$criteria->compare('is_active',$this->is_active,true);
		$criteria->compare('ip_address',$this->ip_address,true);
		$criteria->compare('user_agent',$this->user_agent,true);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('created',$this->created,true);
		$criteria->compare('modified',$this->modified,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return SubserviceTagMapping the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
