<?php

/**
 * This is the model class for table "bo_notification_config".
 *
 * The followings are the available columns in table 'bo_notification_config':
 * @property integer $id
 * @property string $notification_type
 * @property string $host
 * @property string $user_name
 * @property string $password
 * @property string $port
 * @property string $notification_name
 * @property string $notification_category
 * @property string $is_active
 */
class NotificationConfig extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public $from; 
	public $to; 
	public $subject; 
	public $message; 
	public $cc;
	public function tableName()
	{
		return 'bo_notification_config';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('notification_type, host, user_name, password, port, notification_category,from,to,subject,message, is_active', 'required'),
			array('notification_type, notification_category, is_active', 'length', 'max'=>1),
			array('host, password', 'length', 'max'=>500),
			array('user_name, notification_name', 'length', 'max'=>255),
			array('port', 'length', 'max'=>20),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, notification_type, host, user_name, password, port, notification_name, notification_category, is_active', 'safe', 'on'=>'search'),
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
			'notification_type' => 'Notification Type',
			'host' => 'Host',
			'user_name' => 'User Name',
			'password' => 'Password',
			'port' => 'Port',
			'notification_name' => 'Notification Name',
			'notification_category' => 'Notification Category',
			'is_active' => 'Is Active',
			'from' => 'From',
			'message'=>'Message',
			'to'=>'To',
			'subject'=>'Subject',
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
		$criteria->compare('notification_type',$this->notification_type,true);
		$criteria->compare('host',$this->host,true);
		$criteria->compare('user_name',$this->user_name,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('port',$this->port,true);
		$criteria->compare('notification_name',$this->notification_name,true);
		$criteria->compare('notification_category',$this->notification_category,true);
		$criteria->compare('is_active',$this->is_active,true);
		
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return NotificationConfig the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
