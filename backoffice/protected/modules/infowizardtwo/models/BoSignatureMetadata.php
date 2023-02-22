<?php

/**
 * This is the model class for table "bo_infowiz_form_categories".
 *
 * The followings are the available columns in table 'bo_infowiz_form_categories':
 
 * @property string $id
 * @property string $service_id
 * @property string $application_id
 * @property string $created_on
 
 */
class BoSignatureMetadata extends CActiveRecord  
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'bo_signature_metadata';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(		
			array('submission_id, first_name, middle_name, last_name, designation, date_of_signing, is_active', 'safe'),			
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, submission_id, first_name, middle_name, last_name, designation, date_of_signing, is_active', 'safe', 'safe', 'on'=>'search'),
		);
	}

	
	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID', 
			'submission_id' => 'submission_id', 
			'first_name' => 'first_name', 
			'middle_name' =>   'middle_name',
			'last_name' => 'last_name', 
			'designation' => 'designation',
			'date_of_signing'=>'date_of_signing',
			'is_active'=>'is_active'
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
		$criteria->compare('submission_id',$this->service_id,true);
	 
		$criteria->compare('first_name',$this->application_id,true);
		$criteria->compare('middle_name',$this->created_on,true);
		$criteria->compare('last_name',$this->created_on,true);
	
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return CisInspectionIndustries the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
