<?php

/**
 * This is the model class for table "bo_information_wizard_service_certificate_maping".
 *
 * The followings are the available columns in table 'bo_information_wizard_service_certificate_maping':
 * @property integer $id
 * @property integer $department_id
 * @property string $final_service_id
 * @property integer $service_id
 * @property integer $sub_service_id
 * @property integer $doc_checklist_id
 * @property string $user_agent
 * @property string $ip_address
 * @property string $is_active
 * @property string $created
 * @property string $modified
 */
class InformationWizardServiceCertificateMaping extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'bo_information_wizard_service_certificate_maping';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('department_id, final_service_id, service_id, sub_service_id, doc_checklist_id, user_agent, ip_address, is_active, created, modified', 'required'),
			array('department_id, service_id, sub_service_id, doc_checklist_id', 'numerical', 'integerOnly'=>true),
			array('final_service_id', 'length', 'max'=>10),
                     array('final_service_id','unique', 'message'=>'Service has been already mapped with documents.'),			
			
			array('user_agent', 'length', 'max'=>255),
			array('ip_address', 'length', 'max'=>20),
			array('is_active', 'length', 'max'=>1),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, department_id, final_service_id, service_id, sub_service_id, doc_checklist_id, user_agent, ip_address, is_active, created, modified', 'safe', 'on'=>'search'),
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
			'department_id' => 'Department',
			'final_service_id' => 'Final Service',
			'service_id' => 'Service',
			'sub_service_id' => 'Sub Service',
			'doc_checklist_id' => 'Doc Checklist',
			'user_agent' => 'User Agent',
			'ip_address' => 'Ip Address',
			'is_active' => 'Is Active',
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
		$criteria->compare('department_id',$this->department_id);
		$criteria->compare('final_service_id',$this->final_service_id,true);
		$criteria->compare('service_id',$this->service_id);
		$criteria->compare('sub_service_id',$this->sub_service_id);
		$criteria->compare('doc_checklist_id',$this->doc_checklist_id);
		$criteria->compare('user_agent',$this->user_agent,true);
		$criteria->compare('ip_address',$this->ip_address,true);
		$criteria->compare('is_active',$this->is_active,true);
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
	 * @return InformationWizardServiceCertificateMaping the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
