<?php

/**
 * This is the model class for table "sso_service_providers_cert_download".
 *
 * The followings are the available columns in table 'sso_service_providers_cert_download':
 * @property string $sno
 * @property string $service_provider_tag
 * @property string $is_web_service
 * @property string $download_url
 * @property string $parameter_list
 * @property string $reqest_type
 *
 * The followings are the available model relations:
 * @property ServiceProviders $serviceProviderTag
 */
class ServiceProvidersCertDownload extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'sso_service_providers_cert_download';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('service_provider_tag, download_url', 'required'),
			array('service_provider_tag', 'length', 'max'=>10),
			array('is_web_service', 'length', 'max'=>1),
			array('reqest_type', 'length', 'max'=>6),
			array('parameter_list', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('sno, service_provider_tag, is_web_service, download_url, parameter_list, reqest_type', 'safe', 'on'=>'search'),
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
			'serviceProviderTag' => array(self::BELONGS_TO, 'ServiceProviders', 'service_provider_tag'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'sno' => 'Sno',
			'service_provider_tag' => 'Service Provider Tag',
			'is_web_service' => 'Is Web Service',
			'download_url' => 'Download Url',
			'parameter_list' => 'Parameter List',
			'reqest_type' => 'Reqest Type',
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

		$criteria->compare('sno',$this->sno,true);
		$criteria->compare('service_provider_tag',$this->service_provider_tag,true);
		$criteria->compare('is_web_service',$this->is_web_service,true);
		$criteria->compare('download_url',$this->download_url,true);
		$criteria->compare('parameter_list',$this->parameter_list,true);
		$criteria->compare('reqest_type',$this->reqest_type,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ServiceProvidersCertDownload the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
