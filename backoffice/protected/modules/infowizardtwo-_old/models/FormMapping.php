<?php

/**
 * This is the model class for table "bo_infowiz_form_mapping".
 *
 * The followings are the available columns in table 'bo_infowiz_form_mapping':
 * @property integer $id
 * @property string $form_name
 * @property integer $form_type_id
 * @property string $form_code
 * @property string $service_id
 * @property string $is_active
 * @property string $created
 * @property string $modified
 */
class FormMapping extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'bo_infowiz_form_mapping';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('form_name, form_type_id, form_code, service_id, is_active, created, modified', 'required'),
			array('form_type_id', 'numerical', 'integerOnly'=>true),
			array('form_name, form_code', 'length', 'max'=>255),
			array('service_id', 'length', 'max'=>10),
			array('is_active', 'length', 'max'=>1),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, form_name, form_type_id, form_code, service_id, is_active, created, modified', 'safe', 'on'=>'search'),
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
			'form_name' => 'Form Name',
			'form_type_id' => 'Form Type',
			'form_code' => 'Form Code',
			'service_id' => 'Service',
			'is_active' => 'Is Active',
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
		$criteria->compare('form_name',$this->form_name,true);
		$criteria->compare('form_type_id',$this->form_type_id);
		$criteria->compare('form_code',$this->form_code,true);
		$criteria->compare('service_id',$this->service_id,true);
		$criteria->compare('is_active',$this->is_active,true);
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
	 * @return FormMapping the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
