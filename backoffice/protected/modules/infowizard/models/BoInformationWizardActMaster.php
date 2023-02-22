<?php

/**
 * This is the model class for table "bo_information_wizard_act_master".
 *
 * The followings are the available columns in table 'bo_information_wizard_act_master':
 * @property integer $id
 * @property string $act_type
 * @property string $act_name_hindi
 * @property string $act_name_english
 * @property string $act_path_internal_hindi
 * @property string $act_path_internal_english
 * @property string $act_path_external_hindi
 * @property string $act_path_external_english
 * @property string $if_central_english
 * @property string $if_central_hindi
 * @property string $if_state_hindi
 * @property string $if_state_english
 * @property string $relevent_departments_state
 * @property string $relevent_departments_central
 * @property integer $user_id
 * @property string $is_active
 * @property string $created
 * @property string $modified
 */
class BoInformationWizardActMaster extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'bo_information_wizard_act_master';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('act_type, act_name_english,  is_active, created', 'required'),
			array('user_id', 'numerical', 'integerOnly'=>true),
			array('act_type', 'length', 'max'=>10),
			array('act_name_hindi, act_name_english, act_path_internal_hindi, act_path_internal_english, act_path_external_hindi, act_path_external_english', 'length', 'max'=>255),
			array('is_active', 'length', 'max'=>1),
			array('if_central_english, if_central_hindi, if_state_hindi, if_state_english, relevent_departments_state, relevent_departments_central, modified', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, type, act_type, act_name_hindi, act_name_english, act_path_internal_hindi, act_path_internal_english, act_path_external_hindi, act_path_external_english, if_central_english, if_central_hindi, if_state_hindi, if_state_english, relevent_departments_state, relevent_departments_central, user_id, is_active, created, modified', 'safe', 'on'=>'search'),
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
			'act' => 'Act',
			'act_type' => 'Act Type',
			'act_name_hindi' => 'Act Name Hindi',
			'act_name_english' => 'Act Name English',
			'act_path_internal_hindi' => 'Act Path Internal Hindi',
			'act_path_internal_english' => 'Act Path Internal English',
			'act_path_external_hindi' => 'Act Path External Hindi',
			'act_path_external_english' => 'Act Path External English',
			'if_central_english' => 'If Central English',
			'if_central_hindi' => 'If Central Hindi',
			'if_state_hindi' => 'If State Hindi',
			'if_state_english' => 'If State English',
			'relevent_departments_state' => 'Relevent Departments State',
			'relevent_departments_central' => 'Relevent Departments Central',
			'user_id' => 'User',
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
		$criteria->compare('act_type',$this->act_type,true);
		$criteria->compare('act_name_hindi',$this->act_name_hindi,true);
		$criteria->compare('act_name_english',$this->act_name_english,true);
		$criteria->compare('act_path_internal_hindi',$this->act_path_internal_hindi,true);
		$criteria->compare('act_path_internal_english',$this->act_path_internal_english,true);
		$criteria->compare('act_path_external_hindi',$this->act_path_external_hindi,true);
		$criteria->compare('act_path_external_english',$this->act_path_external_english,true);
		$criteria->compare('if_central_english',$this->if_central_english,true);
		$criteria->compare('if_central_hindi',$this->if_central_hindi,true);
		$criteria->compare('if_state_hindi',$this->if_state_hindi,true);
		$criteria->compare('if_state_english',$this->if_state_english,true);
		$criteria->compare('relevent_departments_state',$this->relevent_departments_state,true);
		$criteria->compare('relevent_departments_central',$this->relevent_departments_central,true);
		$criteria->compare('user_id',$this->user_id);
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
	 * @return BoInformationWizardActMaster the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
