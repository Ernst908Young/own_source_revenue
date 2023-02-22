<?php

/**
 * This is the model class for table "bo_information_wizard_service_master".
 *
 * The followings are the available columns in table 'bo_information_wizard_service_master':
 * @property integer $id
 * @property string $service_name
 * @property integer $incidence_pre_establishment
 * @property integer $incidence_pre_operation
 * @property integer $incidence_post_operation
 * @property integer $is_incentive
 * @property string $service_sector
 * @property integer $central_state
 * @property integer $issuerby_id
 * @property string $service_type
 * @property string $additional_sub_service
 * @property string $periodic_inspection
 * @property string $checklist_periodic_inspection
 * @property string $act
 * @property string $hsn_code
 * @property string $sac_code
 * @property string $nic_two_digit_code
 * @property string $voluntary_mandatory_type
 * @property string $definer_voluntary
 * @property string $qualifier_voluntary
 * @property string $definer_mandatory
 * @property string $qualifier_mandatory
 * @property string $to_be_used_in_cis
 * @property string $to_be_used_in_online_offline
 * @property string $to_be_used_in_iw
 * @property string $to_be_used_in_caf_2
 * @property string $created
 * @property string $modified
 */
class BoInformationWizardServiceMaster extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'bo_information_wizard_service_master';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('service_name, service_sector, central_state, issuerby_id, created', 'required'),
			array('incidence_pre_establishment, incidence_pre_operation, incidence_post_operation, is_incentive, central_state, issuerby_id', 'numerical', 'integerOnly'=>true),
			array('service_name, service_type, additional_sub_service, act', 'length', 'max'=>255),
			array('periodic_inspection, checklist_periodic_inspection, voluntary_mandatory_type, to_be_used_in_cis, to_be_used_in_online_offline, to_be_used_in_iw, to_be_used_in_caf_2, to_be_used_in_construction_permit', 'length', 'max'=>1),
			array('hsn_code, sac_code, nic_two_digit_code, definer_voluntary, qualifier_voluntary, definer_mandatory, qualifier_mandatory', 'length', 'max'=>500),
			array('modified', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, service_name, incidence_pre_establishment, incidence_pre_operation, incidence_post_operation, is_incentive, service_sector, central_state, issuerby_id, service_type, additional_sub_service, periodic_inspection, checklist_periodic_inspection, act, hsn_code, sac_code, nic_two_digit_code, voluntary_mandatory_type, definer_voluntary, qualifier_voluntary, definer_mandatory, qualifier_mandatory, to_be_used_in_cis, to_be_used_in_online_offline, to_be_used_in_iw, to_be_used_in_caf_2,to_be_used_in_construction_permit,incentive_id,incentive_incidence_code, created, modified', 'safe', 'on'=>'search'),
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
			'service_name' => 'Service Name',
			'incidence_pre_establishment' => 'Incidence Pre Establishment',
			'incidence_pre_operation' => 'Incidence Pre Operation',
			'incidence_post_operation' => 'Incidence Post Operation',
			'is_incentive' => 'Is Incentive',
			'service_sector' => 'Service Sector',
			'central_state' => 'Central State',
			'issuerby_id' => 'Issuerby',
			'service_type' => 'Service Type',
			'additional_sub_service' => 'Additional Sub Service',
			'periodic_inspection' => 'Periodic Inspection',
			'checklist_periodic_inspection' => 'Checklist Periodic Inspection',
			'act' => 'Act',
			'hsn_code' => 'Hsn Code',
			'sac_code' => 'Sac Code',
			'nic_two_digit_code' => 'Nic Two Digit Code',
			'voluntary_mandatory_type' => 'Voluntary Mandatory Type',
			'definer_voluntary' => 'Definer Voluntary',
			'qualifier_voluntary' => 'Qualifier Voluntary',
			'definer_mandatory' => 'Definer Mandatory',
			'qualifier_mandatory' => 'Qualifier Mandatory',
			'to_be_used_in_cis' => 'To Be Used In Cis',
			'to_be_used_in_online_offline' => 'To Be Used In Online Offline',
			'to_be_used_in_iw' => 'To Be Used In Iw',
			'to_be_used_in_caf_2' => 'To Be Used In Caf 2',
			'to_be_used_in_construction_permit' => 'To Be Used In Construction Permit',
                        'incentive_id' => 'Incentive ID',
                        'incentive_incidence_code' => 'Incentive Incidence Code',
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
		$criteria->compare('service_name',$this->service_name,true);
		$criteria->compare('incidence_pre_establishment',$this->incidence_pre_establishment);
		$criteria->compare('incidence_pre_operation',$this->incidence_pre_operation);
		$criteria->compare('incidence_post_operation',$this->incidence_post_operation);
		$criteria->compare('is_incentive',$this->is_incentive);
		$criteria->compare('service_sector',$this->service_sector,true);
		$criteria->compare('central_state',$this->central_state);
		$criteria->compare('issuerby_id',$this->issuerby_id);
		$criteria->compare('service_type',$this->service_type,true);
		$criteria->compare('additional_sub_service',$this->additional_sub_service,true);
		$criteria->compare('periodic_inspection',$this->periodic_inspection,true);
		$criteria->compare('checklist_periodic_inspection',$this->checklist_periodic_inspection,true);
		$criteria->compare('act',$this->act,true);
		$criteria->compare('hsn_code',$this->hsn_code,true);
		$criteria->compare('sac_code',$this->sac_code,true);
		$criteria->compare('nic_two_digit_code',$this->nic_two_digit_code,true);
		$criteria->compare('voluntary_mandatory_type',$this->voluntary_mandatory_type,true);
		$criteria->compare('definer_voluntary',$this->definer_voluntary,true);
		$criteria->compare('qualifier_voluntary',$this->qualifier_voluntary,true);
		$criteria->compare('definer_mandatory',$this->definer_mandatory,true);
		$criteria->compare('qualifier_mandatory',$this->qualifier_mandatory,true);
		$criteria->compare('to_be_used_in_cis',$this->to_be_used_in_cis,true);
		$criteria->compare('to_be_used_in_online_offline',$this->to_be_used_in_online_offline,true);
		$criteria->compare('to_be_used_in_iw',$this->to_be_used_in_iw,true);
		$criteria->compare('to_be_used_in_caf_2',$this->to_be_used_in_caf_2,true);
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
	 * @return BoInformationWizardServiceMaster the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
