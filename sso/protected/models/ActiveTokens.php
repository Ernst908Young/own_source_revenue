<?php

/**
 * This is the model class for table "sso_active_tokens".
 *
 * The followings are the available columns in table 'sso_active_tokens':
 * @property string $token_id
 * @property string $user_id
 * @property string $token
 * @property string $callback_url
 * @property string $callback_failure_url
 * @property string $callback_success_url
 * @property string $token_created_on
 * @property string $token_access_on
 *
 * The followings are the available model relations:
 * @property Users $user
 */
class ActiveTokens extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'sso_active_tokens';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, token, callback_url, callback_failure_url, callback_success_url, token_created_on', 'required'),
			array('user_id', 'length', 'max'=>10),
			array('token', 'length', 'max'=>32),
			array('callback_url, callback_failure_url, callback_success_url', 'length', 'max'=>1024),
			array('token_access_on', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('token_id, user_id, token, callback_url, callback_failure_url, callback_success_url, token_created_on, token_access_on', 'safe', 'on'=>'search'),
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
			'token_id' => 'Token',
			'user_id' => 'User',
			'token' => 'Token',
			'callback_url' => 'Callback Url',
			'callback_failure_url' => 'Callback Failure Url',
			'callback_success_url' => 'Callback Success Url',
			'token_created_on' => 'Token Created On',
			'token_access_on' => 'Token Access On',
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

		$criteria->compare('token_id',$this->token_id,true);
		$criteria->compare('user_id',$this->user_id,true);
		$criteria->compare('token',$this->token,true);
		$criteria->compare('callback_url',$this->callback_url,true);
		$criteria->compare('callback_failure_url',$this->callback_failure_url,true);
		$criteria->compare('callback_success_url',$this->callback_success_url,true);
		$criteria->compare('token_created_on',$this->token_created_on,true);
		$criteria->compare('token_access_on',$this->token_access_on,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ActiveTokens the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
