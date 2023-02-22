<?php

/**
 * This is the model class for table "sso_service_providers".
 *
 * The followings are the available columns in table 'sso_service_providers':
 * @property string $sp_id
 * @property string $service_provider_name
 * @property string $service_provider_tag
 * @property string $remote_server_ip
 * @property string $secret_key
 * @property string $server_base_url
 * @property string $is_service_provider_active
 */
class ServiceProviders extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'sso_service_providers';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('service_provider_name, service_provider_tag, remote_server_ip, secret_key, server_base_url', 'required'),
			array('service_provider_name', 'length', 'max'=>512),
			array('service_provider_tag', 'length', 'max'=>128),
			array('remote_server_ip, secret_key', 'length', 'max'=>32),
			array('server_base_url', 'length', 'max'=>1024),
			array('is_service_provider_active', 'length', 'max'=>1),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('sp_id, service_provider_name, service_provider_tag, remote_server_ip, secret_key, server_base_url, is_service_provider_active', 'safe', 'on'=>'search'),
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
			'sp_id' => 'Sp',
			'service_provider_name' => 'Service Provider Name',
			'service_provider_tag' => 'Service Provider Tag',
			'remote_server_ip' => 'Remote Server Ip',
			'secret_key' => 'Secret Key',
			'server_base_url' => 'Server Base Url',
			'is_service_provider_active' => 'Is Service Provider Active',
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

		$criteria->compare('sp_id',$this->sp_id,true);
		$criteria->compare('service_provider_name',$this->service_provider_name,true);
		$criteria->compare('service_provider_tag',$this->service_provider_tag,true);
		$criteria->compare('remote_server_ip',$this->remote_server_ip,true);
		$criteria->compare('secret_key',$this->secret_key,true);
		$criteria->compare('server_base_url',$this->server_base_url,true);
		$criteria->compare('is_service_provider_active',$this->is_service_provider_active,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ServiceProviders the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
