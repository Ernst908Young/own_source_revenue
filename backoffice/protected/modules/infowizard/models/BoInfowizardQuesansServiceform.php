<?php

/**
 * This is the model class for table "bo_infowizard_quesans_serviceform".
 *
 * The followings are the available columns in table 'bo_infowizard_quesans_serviceform':
 * @property string $queans_service_id
 * @property integer $service_id
 * @property integer $question_id
 * @property integer $queans_mapp_id
 * @property string $is_active
 * @property string $created_date
 * @property string $modified
 */
class BoInfowizardQuesansServiceform extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'bo_infowizard_quesans_serviceform';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('service_id, question_id, queans_mapp_id, created_date, modified', 'required'),
			array('service_id, question_id, queans_mapp_id', 'numerical', 'integerOnly'=>true),
			array('is_active', 'length', 'max'=>1),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('queans_service_id, service_id, question_id, queans_mapp_id, is_active, created_date, modified', 'safe', 'on'=>'search'),
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
			'queans_service_id' => 'Queans Service',
			'service_id' => 'Service',
			'question_id' => 'Question',
			'queans_mapp_id' => 'Queans Mapp',
			'is_active' => 'Is Active',
			'created_date' => 'Created Date',
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

		$criteria->compare('queans_service_id',$this->queans_service_id,true);
		$criteria->compare('service_id',$this->service_id);
		$criteria->compare('question_id',$this->question_id);
		$criteria->compare('queans_mapp_id',$this->queans_mapp_id);
		$criteria->compare('is_active',$this->is_active,true);
		$criteria->compare('created_date',$this->created_date,true);
		$criteria->compare('modified',$this->modified,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return BoInfowizardQuesansServiceform the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
