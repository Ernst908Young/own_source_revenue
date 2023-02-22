<?php

/**
 * This is the model class for table "bo_information_wizard_act_notification".
 *
 * The followings are the available columns in table 'bo_information_wizard_act_notification':
 * @property integer $id
 * @property integer $act_id
 * @property string $notifiction
 * @property string $notification_doc
 * @property string $is_active
 * @property string $created
 *
 * The followings are the available model relations:
 * @property BoInformationWizardActMaster $act
 */
class BoInformationWizardActNotification extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'bo_information_wizard_act_notification';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('act_id, notifiction, notification_doc, is_active, created', 'required'),
			array('act_id', 'numerical', 'integerOnly'=>true),
			array('notification_doc', 'length', 'max'=>255),
			array('is_active', 'length', 'max'=>1),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, act_id, notifiction, notification_doc, is_active, created', 'safe', 'on'=>'search'),
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
			'act' => array(self::BELONGS_TO, 'BoInformationWizardActMaster', 'act_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'act_id' => 'Act',
			'notifiction' => 'Notifiction',
			'notification_doc' => 'Notification Doc',
			'is_active' => 'Is Active',
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
		$criteria->compare('act_id',$this->act_id);
		$criteria->compare('notifiction',$this->notifiction,true);
		$criteria->compare('notification_doc',$this->notification_doc,true);
		$criteria->compare('is_active',$this->is_active,true);
		$criteria->compare('created',$this->created,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return BoInformationWizardActNotification the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
