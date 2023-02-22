<?php

/**
 * This is the model class for table "bo_prefilled_fields".
 *
 * The followings are the available columns in table 'bo_prefilled_fields':
 * @property string $field_id
 * @property string $field_name
 * @property string $created_on
 * @property string $user_agent
 * @property string $remote_ip
 */
class PrefilledFields extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'bo_prefilled_fields';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('field_name, created_on, user_agent, remote_ip', 'required'),
			array('field_name, user_agent, remote_ip', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('field_id, field_name, created_on, user_agent, remote_ip', 'safe', 'on'=>'search'),
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
			'field_id' => 'Field',
			'field_name' => 'Field Name',
			'created_on' => 'Created On',
			'user_agent' => 'User Agent',
			'remote_ip' => 'Remote Ip',
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

		$criteria->compare('field_id',$this->field_id,true);
		$criteria->compare('field_name',$this->field_name,true);
		$criteria->compare('created_on',$this->created_on,true);
		$criteria->compare('user_agent',$this->user_agent,true);
		$criteria->compare('remote_ip',$this->remote_ip,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return PrefilledFields the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
