<?php

/**
 * This is the model class for table "bo_information_wizard_inspection".
 *
 * The followings are the available columns in table 'bo_information_wizard_inspection':
 * @property integer $id
 * @property integer $service_id
 * @property string $service_type
 * @property string $servicetype_additionalsubservice
 * @property string $is_inspection_required
 * @property string $is_inspection_mandatory
 * @property string $is_fee_required
 * @property string $is_self_creation_allowed_in_lieu_of_inspection
 * @property string $self_certification_excerpt_from_act
 * @property string $self_certification_format
 * @property string $self_certification_creation
 * @property string $is_third_party_certification_allowed
 * @property string $third_party_excerpt_from
 * @property string $third_party_cettification_format
 * @property string $inspecion_report_timeline
 * @property string $is_inspection_checklist_available
 * @property string $inspection_excerpt_from_act
 * @property string $inspection_checklist_format
 * @property string $inspection_checklist_format_creation
 * @property string $periodic_inspection_mandate_for_service
 * @property string $checklist_periodic_inspection_avilable
 * @property string $upload_periodic_checklist_format
 * @property string $is_surprise_inspection_allowed_in_service
 * @property string $upload_periodic_checklist_format_sruprise
 * @property string $checklist_avilable_for_surprise
 * @property string $basic_of_surprise_inspection
 * @property string $comment
 * @property string $created
 * @property string $modified
 */
class BoInformationWizardInspection extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'bo_information_wizard_inspection';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('service_id, service_type, created', 'required'),
			array('service_id', 'numerical', 'integerOnly'=>true),
			array('service_type, servicetype_additionalsubservice, self_certification_excerpt_from_act, self_certification_format, self_certification_creation, third_party_excerpt_from, third_party_cettification_format, inspecion_report_timeline, inspection_excerpt_from_act, inspection_checklist_format, inspection_checklist_format_creation, upload_periodic_checklist_format, upload_periodic_checklist_format_sruprise, basic_of_surprise_inspection', 'length', 'max'=>255),
			array('is_inspection_required, is_inspection_mandatory, is_fee_required, is_self_creation_allowed_in_lieu_of_inspection, is_third_party_certification_allowed, is_inspection_checklist_available, periodic_inspection_mandate_for_service, checklist_periodic_inspection_avilable, is_surprise_inspection_allowed_in_service, checklist_avilable_for_surprise', 'length', 'max'=>1),
			array('comment, modified', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, service_id, service_type, servicetype_additionalsubservice, is_inspection_required, is_inspection_mandatory, is_fee_required, is_self_creation_allowed_in_lieu_of_inspection, self_certification_excerpt_from_act, self_certification_format, self_certification_creation, is_third_party_certification_allowed, third_party_excerpt_from, third_party_cettification_format, inspecion_report_timeline, is_inspection_checklist_available, inspection_excerpt_from_act, inspection_checklist_format, inspection_checklist_format_creation, periodic_inspection_mandate_for_service, checklist_periodic_inspection_avilable, upload_periodic_checklist_format, is_surprise_inspection_allowed_in_service, upload_periodic_checklist_format_sruprise, checklist_avilable_for_surprise, basic_of_surprise_inspection, comment, created, modified', 'safe', 'on'=>'search'),
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
			'service_type' => 'Service Type',
			'servicetype_additionalsubservice' => 'Servicetype Additionalsubservice',
			'is_inspection_required' => 'Is Inspection Required',
			'is_inspection_mandatory' => 'Is Inspection Mandatory',
			'is_fee_required' => 'Is Fee Required',
			'is_self_creation_allowed_in_lieu_of_inspection' => 'Is Self Creation Allowed In Lieu Of Inspection',
			'self_certification_excerpt_from_act' => 'Self Certification Excerpt From Act',
			'self_certification_format' => 'Self Certification Format',
			'self_certification_creation' => 'Self Certification Creation',
			'is_third_party_certification_allowed' => 'Is Third Party Certification Allowed',
			'third_party_excerpt_from' => 'Third Party Excerpt From',
			'third_party_cettification_format' => 'Third Party Cettification Format',
			'inspecion_report_timeline' => 'Inspecion Report Timeline',
			'is_inspection_checklist_available' => 'Is Inspection Checklist Available',
			'inspection_excerpt_from_act' => 'Inspection Excerpt From Act',
			'inspection_checklist_format' => 'Inspection Checklist Format',
			'inspection_checklist_format_creation' => 'Inspection Checklist Format Creation',
			'periodic_inspection_mandate_for_service' => 'Periodic Inspection Mandate For Service',
			'checklist_periodic_inspection_avilable' => 'Checklist Periodic Inspection Avilable',
			'upload_periodic_checklist_format' => 'Upload Periodic Checklist Format',
			'is_surprise_inspection_allowed_in_service' => 'Is Surprise Inspection Allowed In Service',
			'upload_periodic_checklist_format_sruprise' => 'Upload Periodic Checklist Format Sruprise',
			'checklist_avilable_for_surprise' => 'Checklist Avilable For Surprise',
			'basic_of_surprise_inspection' => 'Basic Of Surprise Inspection',
			'comment' => 'Comment',
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
		$criteria->compare('service_id',$this->service_id);
		$criteria->compare('service_type',$this->service_type,true);
		$criteria->compare('servicetype_additionalsubservice',$this->servicetype_additionalsubservice,true);
		$criteria->compare('is_inspection_required',$this->is_inspection_required,true);
		$criteria->compare('is_inspection_mandatory',$this->is_inspection_mandatory,true);
		$criteria->compare('is_fee_required',$this->is_fee_required,true);
		$criteria->compare('is_self_creation_allowed_in_lieu_of_inspection',$this->is_self_creation_allowed_in_lieu_of_inspection,true);
		$criteria->compare('self_certification_excerpt_from_act',$this->self_certification_excerpt_from_act,true);
		$criteria->compare('self_certification_format',$this->self_certification_format,true);
		$criteria->compare('self_certification_creation',$this->self_certification_creation,true);
		$criteria->compare('is_third_party_certification_allowed',$this->is_third_party_certification_allowed,true);
		$criteria->compare('third_party_excerpt_from',$this->third_party_excerpt_from,true);
		$criteria->compare('third_party_cettification_format',$this->third_party_cettification_format,true);
		$criteria->compare('inspecion_report_timeline',$this->inspecion_report_timeline,true);
		$criteria->compare('is_inspection_checklist_available',$this->is_inspection_checklist_available,true);
		$criteria->compare('inspection_excerpt_from_act',$this->inspection_excerpt_from_act,true);
		$criteria->compare('inspection_checklist_format',$this->inspection_checklist_format,true);
		$criteria->compare('inspection_checklist_format_creation',$this->inspection_checklist_format_creation,true);
		$criteria->compare('periodic_inspection_mandate_for_service',$this->periodic_inspection_mandate_for_service,true);
		$criteria->compare('checklist_periodic_inspection_avilable',$this->checklist_periodic_inspection_avilable,true);
		$criteria->compare('upload_periodic_checklist_format',$this->upload_periodic_checklist_format,true);
		$criteria->compare('is_surprise_inspection_allowed_in_service',$this->is_surprise_inspection_allowed_in_service,true);
		$criteria->compare('upload_periodic_checklist_format_sruprise',$this->upload_periodic_checklist_format_sruprise,true);
		$criteria->compare('checklist_avilable_for_surprise',$this->checklist_avilable_for_surprise,true);
		$criteria->compare('basic_of_surprise_inspection',$this->basic_of_surprise_inspection,true);
		$criteria->compare('comment',$this->comment,true);
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
	 * @return BoInformationWizardInspection the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
