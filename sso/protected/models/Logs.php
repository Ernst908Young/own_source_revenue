<?php

/**
 * This is the model class for table "sso_logs".
 *
 * The followings are the available columns in table 'sso_logs':
 * @property string $log_id
 * @property string $user_id
 * @property string $token
 * @property string $event
 * @property string $accessed_from_url
 * @property string $accessed_on
 *
 * The followings are the available model relations:
 * @property Users $user
 */
class Logs extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'sso_logs';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, token, event, accessed_from_url,accessed_from_ip, accessed_on', 'required'),
			array('user_id', 'length', 'max'=>10),
			array('token', 'length', 'max'=>32),
			array('event', 'length', 'max'=>7),
			array('accessed_from_ip', 'length', 'max'=>32),
			array('accessed_from_url', 'length', 'max'=>512),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('log_id, user_id, token, event, accessed_from_url, accessed_on', 'safe', 'on'=>'search'),
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
			'user' => array(self::BELONGS_TO, 'Users', 'user_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'log_id' => 'Log',
			'user_id' => 'User',
			'token' => 'Token',
			'event' => 'Event',
			'accessed_from_ip' => 'Accessed From IP',
			'accessed_from_url' => 'Accessed From URL',
			'accessed_on' => 'Accessed On',
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

		$criteria->compare('log_id',$this->log_id,true);
		$criteria->compare('user_id',$this->user_id,true);
		$criteria->compare('token',$this->token,true);
		$criteria->compare('event',$this->event,true);
		$criteria->compare('accessed_from_url',$this->accessed_from_url,true);
		$criteria->compare('accessed_from_ip',$this->accessed_from_ip,true);		
		$criteria->compare('accessed_on',$this->accessed_on,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Logs the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
