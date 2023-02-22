<?php

/**
 * This is the model class for table "bo_infowizard_issuerby_master".
 *
 * The followings are the available columns in table 'bo_infowizard_issuerby_master':
 * @property integer $issuerby_id
 * @property integer $issuer_id
 * @property string $name
 * @property string $abb
 * @property string $is_issuerby_active
 */
class BoInfowizardIssuerbyMaster extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'bo_infowizard_issuerby_master';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('issuer_id, name, abb', 'required'),
			array('issuer_id', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>500),
			array('abb','unique', 'message'=>'This Abbreviations already exists.'),
			array('abb', 'length', 'max'=>100),
			array('is_issuerby_active', 'length', 'max'=>1),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('issuerby_id, issuer_id, name, abb, is_issuerby_active,left_department_logo,right_department_logo,header_content', 'safe', 'on'=>'search'),
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
			'issuerby_id' => 'Issuerby',
			'issuer_id' => 'Issuer',
			'name' => 'Name',
			'abb' => 'Abb',
			'left_department_logo' => 'Left Side Logo of Department',
			'right_department_logo' => 'Right Side Logo of Department',
			'header_content' => 'Header Content',
			'is_issuerby_active' => 'Is Issuerby Active',
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

		$criteria->compare('issuerby_id',$this->issuerby_id);
		$criteria->compare('issuer_id',$this->issuer_id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('abb',$this->abb,true);
		$criteria->compare('department_logo',$this->department_logo,true);
		$criteria->compare('is_issuerby_active',$this->is_issuerby_active,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return BoInfowizardIssuerbyMaster the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
