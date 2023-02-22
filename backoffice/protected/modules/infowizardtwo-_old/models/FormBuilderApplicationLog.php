<?php

/**
 * This is the model class for table "bo_infowiz_form_builder_application_log".
 *
 * The followings are the available columns in table 'bo_infowiz_form_builder_application_log':
 * @property integer $id
 * @property string $service_id
 * @property string $form_id
 * @property integer $core_department_id
 * @property integer $app_Sub_id
 * @property integer $department_user_id
 * @property string $action_taken_by_name
 * @property string $action_status
 * @property string $action_message
 * @property string $department_comment
 * @property integer $investor_id
 * @property string $created
 */
class FormBuilderApplicationLog extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'bo_infowiz_form_builder_application_log';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('service_id, form_id, app_Sub_id, created', 'required'),
			array('core_department_id, app_Sub_id, department_user_id, investor_id', 'numerical', 'integerOnly'=>true),
			array('service_id, form_id, action_status', 'length', 'max'=>20),
			array('action_taken_by_name', 'length', 'max'=>255),
			array('action_message, department_comment', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, service_id, form_id, core_department_id, app_Sub_id, department_user_id, action_taken_by_name, action_status, action_message, department_comment, investor_id, created', 'safe', 'on'=>'search'),
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
			'form_id' => 'Form',
			'core_department_id' => 'Core Department',
			'app_Sub_id' => 'App Sub',
			'department_user_id' => 'Department User',
			'action_taken_by_name' => 'Action Taken By Name',
			'action_status' => 'Action Status',
			'action_message' => 'Action Message',
			'department_comment' => 'Department Comment',
			'investor_id' => 'Investor',
			'created' => 'Created',
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
		$criteria->compare('service_id',$this->service_id,true);
		$criteria->compare('form_id',$this->form_id,true);
		$criteria->compare('core_department_id',$this->core_department_id);
		$criteria->compare('app_Sub_id',$this->app_Sub_id);
		$criteria->compare('department_user_id',$this->department_user_id);
		$criteria->compare('action_taken_by_name',$this->action_taken_by_name,true);
		$criteria->compare('action_status',$this->action_status,true);
		$criteria->compare('action_message',$this->action_message,true);
		$criteria->compare('department_comment',$this->department_comment,true);
		$criteria->compare('investor_id',$this->investor_id);
		$criteria->compare('created',$this->created,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return FormBuilderApplicationLog the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
