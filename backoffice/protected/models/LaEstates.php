<?php

/**
 * This is the model class for table "la_estates".
 *
 * The followings are the available columns in table 'la_estates':
 * @property integer $land_estate_id
 * @property integer $district_id
 * @property string $land_estate_name
 * @property string $estate_area
 * @property string $estate_link
 * @property string $created_on
 * @property string $is_active
 */
class LaEstates extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'la_estates';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('district_id, land_estate_name, estate_area, estate_link, created_on', 'required'),
			array('district_id', 'numerical', 'integerOnly'=>true),
			array('land_estate_name, estate_area', 'length', 'max'=>300),
			array('is_active', 'length', 'max'=>1),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('land_estate_id, district_id, land_estate_name, estate_area, estate_link, created_on, is_active', 'safe', 'on'=>'search'),
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
			'land_estate_id' => 'Land Estate',
			'district_id' => 'District',
			'land_estate_name' => 'Land Estate Name',
			'estate_area' => 'Estate Area',
			'estate_link' => 'Estate Link',
			'created_on' => 'Created On',
			'is_active' => 'Is Active',
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

		$criteria->compare('land_estate_id',$this->land_estate_id);
		$criteria->compare('district_id',$this->district_id);
		$criteria->compare('land_estate_name',$this->land_estate_name,true);
		$criteria->compare('estate_area',$this->estate_area,true);
		$criteria->compare('estate_link',$this->estate_link,true);
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
	 * @return LaEstates the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
