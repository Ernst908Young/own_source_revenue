<?php

/**
 * This is the model class for table "bo_infowiz_page_master".
 *
 * The followings are the available columns in table 'bo_infowiz_page_master':
 * @property string $id
 * @property string $service_id
 * @property string $form_id
 * @property string $form_code
 * @property string $prefrence
 * @property string $page_name
 * @property string $is_active
 * @property string $created
 * @property string $modified
 
 */
class PageMaster extends CActiveRecord  
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'bo_infowiz_page_master';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('service_id,page_name,form_id, is_active ,form_code,prefrence, created', 'required'),  
			array('page_name', 'length', 'max'=>200),
			array('form_code', 'length', 'max'=>200),
			array('form_id', 'length', 'max'=>200),
			array('is_active', 'length', 'max'=>1),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, page_name, service_id,form_id,form_code,prefrence,is_active, created, modified', 'safe', 'on'=>'search'),
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
			'page_name' => 'Page Name',
			'service_id' =>'Service ID',
			'form_id' => 'Form ID',
			'form_code' => 'Form Code',
			'prefrence' => 'Prefrence',
			'is_active' => 'Is Active', 
			'created' =>   'Created',
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
		$criteria->compare('category_name',$this->category_name,true);
	 
		$criteria->compare('created',$this->created,true);
		$criteria->compare('modified',$this->modified,true);
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
