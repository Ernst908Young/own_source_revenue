<?php

/**
 * This is the model class for table "bo_landregion".
 *
 * The followings are the available columns in table 'bo_landregion':
 * @property string $lr_id
 * @property string $lr_name
 * @property string $lr_type
 * @property string $hadbast_number
 * @property string $vtc_code
 * @property string $is_lr_active
 *
 * The followings are the available model relations:
 * @property Country $country
 * @property UserRoleMapping[] $userRoleMappings
 */
class Landregion extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'bo_landregion';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('lr_name, lr_type', 'required'),
			array('lr_name', 'length', 'max'=>90),
			array('lr_type', 'length', 'max'=>8),
			array('hadbast_number, vtc_code', 'length', 'max'=>10),
			array('is_lr_active', 'length', 'max'=>1),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('lr_id, lr_name, lr_type, hadbast_number, vtc_code, is_lr_active', 'safe', 'on'=>'search'),
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
			'country' => array(self::HAS_ONE, 'Country', 'lr_id'),
			'userRoleMappings' => array(self::HAS_MANY, 'UserRoleMapping', 'lr_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'lr_id' => 'Lr',
			'lr_name' => 'Lr Name',
			'lr_type' => 'Lr Type',
			'hadbast_number' => 'Hadbast Number',
			'vtc_code' => 'Vtc Code',
			'is_lr_active' => 'Is Lr Active',
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

		$criteria->compare('lr_id',$this->lr_id,true);
		$criteria->compare('lr_name',$this->lr_name,true);
		$criteria->compare('lr_type',$this->lr_type,true);
		$criteria->compare('hadbast_number',$this->hadbast_number,true);
		$criteria->compare('vtc_code',$this->vtc_code,true);
		$criteria->compare('is_lr_active',$this->is_lr_active,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Landregion the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
