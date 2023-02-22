<?php

/**
 * This is the model class for table "bo_appeal_conversation".
 *
 * The followings are the available columns in table 'bo_appeal_conversation':
 * @property string $id
 * @property string $appeal_id
 * @property string $message
 * @property string $dept_user_id
 * @property string $created_datetime
 * @property string $remote_address
 * @property string $user_agent
 *
 * The followings are the available model relations:
 * @property Appeal $appeal
 * @property User $deptUser
 */
class AppealConversation extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'bo_appeal_conversation';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('appeal_id, message, created_datetime, remote_address, user_agent', 'required'),
			array('appeal_id', 'length', 'max'=>20),
			array('dept_user_id', 'length', 'max'=>10),
			array('remote_address, user_agent', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, appeal_id, message, dept_user_id, created_datetime, remote_address, user_agent', 'safe', 'on'=>'search'),
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
			'appeal' => array(self::BELONGS_TO, 'Appeal', 'appeal_id'),
			'deptUser' => array(self::BELONGS_TO, 'User', 'dept_user_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'appeal_id' => 'Appeal',
			'message' => 'Message',
			'dept_user_id' => 'Dept User',
			'created_datetime' => 'Created Datetime',
			'remote_address' => 'Remote Address',
			'user_agent' => 'User Agent',
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

		$criteria->compare('id',$this->id,true);
		$criteria->compare('appeal_id',$this->appeal_id,true);
		$criteria->compare('message',$this->message,true);
		$criteria->compare('dept_user_id',$this->dept_user_id,true);
		$criteria->compare('created_datetime',$this->created_datetime,true);
		$criteria->compare('remote_address',$this->remote_address,true);
		$criteria->compare('user_agent',$this->user_agent,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return AppealConversation the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
