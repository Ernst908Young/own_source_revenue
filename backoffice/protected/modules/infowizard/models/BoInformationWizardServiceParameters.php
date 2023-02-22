<?php

/**
 * This is the model class for table "bo_information_wizard_service_parameters".
 *
 * The followings are the available columns in table 'bo_information_wizard_service_parameters':
 * @property integer $id
 * @property integer $service_id
 * @property string $service_type
 * @property string $sub_service_name
 * @property string $core_service_name
 * @property string $servicetype_additionalsubservice
 * @property string $is_online
 * @property string $is_integrated_with_swcs
 * @property integer $department_id
 * @property integer $swcs_service_id
 * @property string $service_url
 * @property string $third_party_url
 * @property string $is_in_uttarakhand_right_to_service_act
 * @property string $is_in_uttarakhand_single_window_act
 * @property string $is_statutory_forms_available
 * @property string $statutory_form_no
 * @property string $statutory_form_upload
 * @property string $statutory_forms_creation
 * @property string $document_checkList
 * @property string $document_checklist_upload
 * @property string $document_checklist_creation
 * @property string $is_sop
 * @property string $sop
 * @property string $is_statutory_timeline
 * @property string $statutory_timeline_upload
 * @property string $is_integrated_with_dms
 * @property string $comment
 * @property string $is_active
 * @property string $document_type_mapping
 * @property string $created
 * @property string $modified
 *
 * The followings are the available model relations:
 * @property InformationWizardServiceMaster $service
 */
class BoInformationWizardServiceParameters extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'bo_information_wizard_service_parameters';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('service_id, service_type', 'required'),
			array('service_id, department_id, swcs_service_id', 'numerical', 'integerOnly'=>true),
			array('service_type, sub_service_name, core_service_name, servicetype_additionalsubservice, statutory_form_no, statutory_form_upload', 'length', 'max'=>255),
			array('is_online, is_integrated_with_swcs, is_in_uttarakhand_right_to_service_act, is_in_uttarakhand_single_window_act, is_statutory_forms_available, document_checkList, is_sop, is_statutory_timeline, is_integrated_with_dms, is_active', 'length', 'max'=>1),
			array('service_url, third_party_url, statutory_forms_creation, document_checklist_upload, document_checklist_creation, sop, statutory_timeline_upload, comment, document_type_mapping, created, modified', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, service_id, service_type, sub_service_name, core_service_name, servicetype_additionalsubservice, is_online, is_integrated_with_swcs, department_id, swcs_service_id, service_url, third_party_url, is_in_uttarakhand_right_to_service_act, is_in_uttarakhand_single_window_act, is_statutory_forms_available, statutory_form_no, statutory_form_upload, statutory_forms_creation, document_checkList, document_checklist_upload, document_checklist_creation, is_sop, sop, is_statutory_timeline, statutory_timeline_upload, is_integrated_with_dms, comment, is_active, document_type_mapping, created, modified', 'safe', 'on'=>'search'),
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
			'service' => array(self::BELONGS_TO, 'InformationWizardServiceMaster', 'service_id'),
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
			'sub_service_name' => 'Sub Service Name',
			'core_service_name' => 'Core Service Name',
			'servicetype_additionalsubservice' => 'Servicetype Additionalsubservice',
			'is_online' => 'Is Online',
			'is_integrated_with_swcs' => 'Is Integrated With Swcs',
			'department_id' => 'Department',
			'swcs_service_id' => 'Swcs Service',
			'service_url' => 'Service Url',
			'third_party_url' => 'Third Party Url',
			'is_in_uttarakhand_right_to_service_act' => 'Is In Uttarakhand Right To Service Act',
			'is_in_uttarakhand_single_window_act' => 'Is In Uttarakhand Single Window Act',
			'is_statutory_forms_available' => 'Is Statutory Forms Available',
			'statutory_form_no' => 'Statutory Form No',
			'statutory_form_upload' => 'Statutory Form Upload',
			'statutory_forms_creation' => 'Statutory Forms Creation',
			'document_checkList' => 'Document Check List',
			'document_checklist_upload' => 'Document Checklist Upload',
			'document_checklist_creation' => 'Document Checklist Creation',
			'is_sop' => 'Is Sop',
			'sop' => 'Sop',
			'is_statutory_timeline' => 'Is Statutory Timeline',
			'statutory_timeline_upload' => 'Statutory Timeline Upload',
			'is_integrated_with_dms' => 'Is Integrated With Dms',
			'comment' => 'Comment',
			'is_active' => 'Is Active',
			'document_type_mapping' => 'Document Type Mapping',
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
		$criteria->compare('sub_service_name',$this->sub_service_name,true);
		$criteria->compare('core_service_name',$this->core_service_name,true);
		$criteria->compare('servicetype_additionalsubservice',$this->servicetype_additionalsubservice,true);
		$criteria->compare('is_online',$this->is_online,true);
		$criteria->compare('is_integrated_with_swcs',$this->is_integrated_with_swcs,true);
		$criteria->compare('department_id',$this->department_id);
		$criteria->compare('swcs_service_id',$this->swcs_service_id);
		$criteria->compare('service_url',$this->service_url,true);
		$criteria->compare('third_party_url',$this->third_party_url,true);
		$criteria->compare('is_in_uttarakhand_right_to_service_act',$this->is_in_uttarakhand_right_to_service_act,true);
		$criteria->compare('is_in_uttarakhand_single_window_act',$this->is_in_uttarakhand_single_window_act,true);
		$criteria->compare('is_statutory_forms_available',$this->is_statutory_forms_available,true);
		$criteria->compare('statutory_form_no',$this->statutory_form_no,true);
		$criteria->compare('statutory_form_upload',$this->statutory_form_upload,true);
		$criteria->compare('statutory_forms_creation',$this->statutory_forms_creation,true);
		$criteria->compare('document_checkList',$this->document_checkList,true);
		$criteria->compare('document_checklist_upload',$this->document_checklist_upload,true);
		$criteria->compare('document_checklist_creation',$this->document_checklist_creation,true);
		$criteria->compare('is_sop',$this->is_sop,true);
		$criteria->compare('sop',$this->sop,true);
		$criteria->compare('is_statutory_timeline',$this->is_statutory_timeline,true);
		$criteria->compare('statutory_timeline_upload',$this->statutory_timeline_upload,true);
		$criteria->compare('is_integrated_with_dms',$this->is_integrated_with_dms,true);
		$criteria->compare('comment',$this->comment,true);
		$criteria->compare('is_active',$this->is_active,true);
		$criteria->compare('document_type_mapping',$this->document_type_mapping,true);
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
	 * @return BoInformationWizardServiceParameters the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
