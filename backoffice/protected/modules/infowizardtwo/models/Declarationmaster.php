<?php

/**
 * This is the model class for table "bo_infowiz_form_categories".
 *
 * The followings are the available columns in table 'bo_infowiz_form_categories':
 
 * @property string $service_id
 * @property string $declaration_label
 * @property string $option
 * @property string $created_on
 
 */
class Declarationmaster extends CActiveRecord  
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'bo_declaration_master';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('service_id, declaration_label, option', 'required'),
			array('option', 'length', 'max'=>100),
			array('is_active', 'length', 'max'=>1),
			array('service_id, declaration_label, created_on','safe'),
			array('service_id','unique', 'message'=>'Declaration of this service is already created'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, service_id, declaration_label, option, created_on, is_active', 'safe', 'on'=>'search'),
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
			'service_id' => 'Category Name', 
			'declaration_label' => 'Is Active', 
			'option' =>   'Created',
			'created_on' => 'Modified', 
			'is_active'=>'is_active',
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
		$criteria->compare('declaration_label',$this->declaration_label,true);
		$criteria->compare('option',$this->option,true);
		$criteria->compare('created_on',$this->created_on,true); 
		$criteria->compare('is_active',$this->is_active,true); 
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
