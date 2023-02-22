<?php

/**
 * This is the model class for table "bo_infowizard_docunenttype_master".
 *
 * The followings are the available columns in table 'bo_infowizard_docunenttype_master':
 * @property integer $doc_id
 * @property string $name
 * @property string $abbr
 * @property string $is_doc_active
 */
class BoInfowizardDocunenttypeMaster extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'bo_infowizard_docunenttype_master';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, abbr', 'required'),
			array('name', 'length', 'max'=>200),
			array('name','unique', 'message'=>'This document type already exists.'),
			array('abbr','unique', 'message'=>'This Abbreviations already exists.'),
			array('abbr', 'length', 'max'=>50),
			array('is_doc_active', 'length', 'max'=>1),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('doc_id, name, abbr, is_doc_active', 'safe', 'on'=>'search'),
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
			'doc_id' => 'Doc',
			'name' => 'Name',
			'abbr' => 'Abbr',
			'is_doc_active' => 'Is Doc Active',
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

		$criteria->compare('doc_id',$this->doc_id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('abbr',$this->abbr,true);
		$criteria->compare('is_doc_active',$this->is_doc_active,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return BoInfowizardDocunenttypeMaster the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
