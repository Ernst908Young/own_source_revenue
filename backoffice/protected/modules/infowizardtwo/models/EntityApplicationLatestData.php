<?php

/**
 * This is the model class for table "entity_application_latest_data".
 *
 * The followings are the available columns in table 'entity_application_latest_data':
  *@property integer $id
 * @property integer $entity_no
 * @property string $srn_no
 * @property integer $service_id
 * @property integer $user_id
 * @property string $changed_from_service_id
 * @property string $changed_from_srn_no
 * @property string $field_value
 * @property string $is_active
 * @property string $created_on
 * @property string $updated_on
 * @property string $latest_entity_name
 */
class EntityApplicationLatestData extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'entity_application_latest_data';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(			
			array('entity_no, srn_no,user_id,changed_from_srn_no,is_active', 'numerical', 'integerOnly'=>true),
			array('service_id, changed_from_service_id' , 'length', 'max'=>20),
			
			array('field_value, created_on, updated_on, latest_entity_name','safe'),		
			
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

		
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return NewApplicationSubmission the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
