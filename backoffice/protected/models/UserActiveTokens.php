<?php

/**
 * This is the model class for table "bo_user_active_tokens".
 *
 * The followings are the available columns in table 'bo_user_active_tokens':
 * @property integer $token_id
 * @property string $token
 * @property string $user_id
 * @property string $role_id
 * @property integer $module_id
 * @property string $token_created_on
 * @property string $token_accessed_on
 * @property string $callback_url
 *
 * The followings are the available model relations:
 * @property IncentiveModules $module
 * @property User $user
 * @property Roles $role
 */
class UserActiveTokens extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'bo_user_active_tokens';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('token, user_id, role_id, module_id, token_created_on, token_accessed_on', 'required'),
			array('module_id', 'numerical', 'integerOnly'=>true),
			array('token', 'length', 'max'=>32),
			array('user_id, role_id', 'length', 'max'=>10),
			array('callback_url', 'length', 'max'=>1024),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('token_id, token, user_id, role_id, module_id, token_created_on, token_accessed_on, callback_url', 'safe', 'on'=>'search'),
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
			'module' => array(self::BELONGS_TO, 'IncentiveModules', 'module_id'),
			'user' => array(self::BELONGS_TO, 'User', 'user_id'),
			'role' => array(self::BELONGS_TO, 'Roles', 'role_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'token_id' => 'Token',
			'token' => 'Token',
			'user_id' => 'User',
			'role_id' => 'Role',
			'module_id' => 'Module',
			'token_created_on' => 'Token Created On',
			'token_accessed_on' => 'Token Accessed On',
			'callback_url' => 'Callback Url',
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

		$criteria->compare('token_id',$this->token_id);
		$criteria->compare('token',$this->token,true);
		$criteria->compare('user_id',$this->user_id,true);
		$criteria->compare('role_id',$this->role_id,true);
		$criteria->compare('module_id',$this->module_id);
		$criteria->compare('token_created_on',$this->token_created_on,true);
		$criteria->compare('token_accessed_on',$this->token_accessed_on,true);
		$criteria->compare('callback_url',$this->callback_url,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return UserActiveTokens the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
