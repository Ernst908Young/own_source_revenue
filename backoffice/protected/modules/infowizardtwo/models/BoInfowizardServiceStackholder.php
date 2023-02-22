<?php

/**
 * This is the model class for table "bo_infowizard_service_stackholder".
 *
 * The followings are the available columns in table 'bo_infowizard_service_stackholder':
 * @property integer $id
 * @property integer $service_id
 * @property string $service_type
 * @property string $servicetype_additionalsubservice
 * @property string $services_professionals
 * @property string $list_professional
 * @property string $other_professional
 * @property string $delivery_dependent
 * @property string $central_department
 * @property string $state_department
 * @property string $comment
 * @property string $created
 * @property string $modified
 */
class BoInfowizardServiceStackholder extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'bo_infowizard_service_stackholder';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('service_id, service_type, services_professionals, delivery_dependent, created', 'required'),
			array('service_id', 'numerical', 'integerOnly'=>true),
			array('service_type, servicetype_additionalsubservice, comment', 'length', 'max'=>255),
			array('services_professionals, delivery_dependent', 'length', 'max'=>1),
			array('list_professional, other_professional, central_department, state_department', 'length', 'max'=>100),
			array('modified', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, service_id, service_type, servicetype_additionalsubservice, services_professionals, list_professional, other_professional, delivery_dependent, central_department, state_department, comment, created, modified', 'safe', 'on'=>'search'),
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
			'services_professionals' => 'Services Professionals',
			'list_professional' => 'List Professional',
			'other_professional' => 'Other Professional',
			'delivery_dependent' => 'Delivery Dependent',
			'central_department' => 'Central Department',
			'state_department' => 'State Department',
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
		$criteria->compare('services_professionals',$this->services_professionals,true);
		$criteria->compare('list_professional',$this->list_professional,true);
		$criteria->compare('other_professional',$this->other_professional,true);
		$criteria->compare('delivery_dependent',$this->delivery_dependent,true);
		$criteria->compare('central_department',$this->central_department,true);
		$criteria->compare('state_department',$this->state_department,true);
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
	 * @return BoInfowizardServiceStackholder the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
