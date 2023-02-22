<?php

/**
 * This is the model class for table "bo_sp_all_applications".
 *
 * The followings are the available columns in table 'bo_sp_all_applications':
 * @property integer $app_id
 * @property string $app_name
 * @property string $department_name
 * @property string $department_app_id
 * @property string $app_url
 * @property string $sp_id
 * @property string $is_app_active
 * @property string $created_on
 * @property string $remote_server
 * @property string $user_agent
 *
 * The followings are the available model relations:
 * @property SsoServiceProviders $sp
 */
class SpAllApplications extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'bo_sp_all_applications';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('app_name, department_name, department_app_id, app_url, sp_id, is_app_active, created_on, remote_server, user_agent', 'required'),
			array('app_name, department_name, department_app_id, app_url, remote_server, user_agent', 'length', 'max'=>255),
			array('sp_id', 'length', 'max'=>10),
			array('is_app_active', 'length', 'max'=>1),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('app_id, app_name, department_name, department_app_id, app_url, sp_id, is_app_active, created_on, remote_server, user_agent', 'safe', 'on'=>'search'),
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
			'sp' => array(self::BELONGS_TO, 'SsoServiceProviders', 'sp_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'app_id' => 'App',
			'app_name' => 'App Name',
			'department_name' => 'Department Name',
			'department_app_id' => 'Department App',
			'app_url' => 'App Url',
			'sp_id' => 'Sp',
			'is_app_active' => 'Is App Active',
			'created_on' => 'Created On',
			'remote_server' => 'Remote Server',
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

		$criteria->compare('app_id',$this->app_id);
		$criteria->compare('app_name',$this->app_name,true);
		$criteria->compare('department_name',$this->department_name,true);
		$criteria->compare('department_app_id',$this->department_app_id,true);
		$criteria->compare('app_url',$this->app_url,true);
		$criteria->compare('sp_id',$this->sp_id,true);
		$criteria->compare('is_app_active',$this->is_app_active,true);
		$criteria->compare('created_on',$this->created_on,true);
		$criteria->compare('remote_server',$this->remote_server,true);
		$criteria->compare('user_agent',$this->user_agent,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return SpAllApplications the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
