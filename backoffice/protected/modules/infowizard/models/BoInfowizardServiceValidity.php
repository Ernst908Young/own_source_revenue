<?php

/**
 * This is the model class for table "bo_infowizard_service_validity".
 *
 * The followings are the available columns in table 'bo_infowizard_service_validity':
 * @property integer $id
 * @property integer $service_id
 * @property string $service_type
 * @property string $servicetype_additionalsubservice
 * @property string $validtity_of_service
 * @property string $day_month_year
 * @property integer $day_month_year_no
 * @property string $before_days
 * @property string $within_days
 * @property string $comment
 * @property string $created
 * @property string $modified
 */
class BoInfowizardServiceValidity extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'bo_infowizard_service_validity';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('service_id, service_type, validtity_of_service, created', 'required'),
			array('service_id, day_month_year_no', 'numerical', 'integerOnly'=>true),
			array('service_type, servicetype_additionalsubservice', 'length', 'max'=>255),
			array('validtity_of_service', 'length', 'max'=>1),
			array('day_month_year', 'length', 'max'=>6),
			array('before_days, within_days, comment', 'length', 'max'=>200),
			array('modified', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, service_id, service_type, servicetype_additionalsubservice, validtity_of_service, day_month_year, day_month_year_no, before_days, within_days, comment, created, modified', 'safe', 'on'=>'search'),
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
			'validtity_of_service' => 'Validtity Of Service',
			'day_month_year' => 'Day Month Year',
			'day_month_year_no' => 'Day Month Year No',
			'before_days' => 'Before Days',
			'within_days' => 'Within Days',
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
		$criteria->compare('validtity_of_service',$this->validtity_of_service,true);
		$criteria->compare('day_month_year',$this->day_month_year,true);
		$criteria->compare('day_month_year_no',$this->day_month_year_no);
		$criteria->compare('before_days',$this->before_days,true);
		$criteria->compare('within_days',$this->within_days,true);
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
	 * @return BoInfowizardServiceValidity the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
