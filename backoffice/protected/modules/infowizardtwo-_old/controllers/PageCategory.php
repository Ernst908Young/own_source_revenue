<?php

/**
 * This is the model class for table "bo_page_category_mapping".
 *
 * The followings are the available columns in table 'bo_page_category_mapping':
 * @property string $id
 * @property string $page_id
 * @property string $category_id	
 * @property string $prefrence
 * @property string $help_text 
 * @property string $is_active
 * @property string $created
 * @property string $modified
 
 */
class PageCategory extends CActiveRecord  
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'bo_page_category_mapping';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('page_id,category_id,prefrence, is_active , created', 'required'),  
			array('page_name', 'length', 'max'=>200),
			array('prefrence', 'length', 'max'=>200),
			array('help_text', 'length', 'max'=>200),
			array('is_active', 'length', 'max'=>1),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, page_id, category_id,form_id,prefrence,is_active, created, modified', 'safe', 'on'=>'search'),
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
