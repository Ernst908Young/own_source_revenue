<?php

/**
 * This is the model class for table "bo_service_certificate_download_history".
 *
 * The followings are the available columns in table 'bo_service_certificate_download_history':
 * @property string $id
 * @property integer $swcs_service_id
 * @property integer $infowiz_service_id
 * @property integer $infowiz_sub_service_id
 * @property string $source_certificate_url
 * @property string $downloded_location
 * @property integer $sno
 * @property string $downloaded_datetime
 * @property string $inserted_in_dms
 * @property string $inserted_datetime
 * @property string $log_created_datetime
 */
class ServiceCertificateDownloadHistory extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'bo_service_certificate_download_history';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('swcs_service_id, source_certificate_url, downloded_location, sno, log_created_datetime', 'required'),
			array('swcs_service_id, infowiz_service_id, infowiz_sub_service_id, sno', 'numerical', 'integerOnly'=>true),
			array('source_certificate_url, downloded_location', 'length', 'max'=>255),
			array('inserted_in_dms', 'length', 'max'=>3),
			array('downloaded_datetime, inserted_datetime', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, swcs_service_id, infowiz_service_id, infowiz_sub_service_id, source_certificate_url, downloded_location, sno, downloaded_datetime, inserted_in_dms, inserted_datetime, log_created_datetime', 'safe', 'on'=>'search'),
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
			'swcs_service_id' => 'Swcs Service',
			'infowiz_service_id' => 'Infowiz Service',
			'infowiz_sub_service_id' => 'Infowiz Sub Service',
			'source_certificate_url' => 'Source Certificate Url',
			'downloded_location' => 'Downloded Location',
			'sno' => 'Sno',
			'downloaded_datetime' => 'Downloaded Datetime',
			'inserted_in_dms' => 'Inserted In Dms',
			'inserted_datetime' => 'Inserted Datetime',
			'log_created_datetime' => 'Log Created Datetime',
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
		$criteria->compare('swcs_service_id',$this->swcs_service_id);
		$criteria->compare('infowiz_service_id',$this->infowiz_service_id);
		$criteria->compare('infowiz_sub_service_id',$this->infowiz_sub_service_id);
		$criteria->compare('source_certificate_url',$this->source_certificate_url,true);
		$criteria->compare('downloded_location',$this->downloded_location,true);
		$criteria->compare('sno',$this->sno);
		$criteria->compare('downloaded_datetime',$this->downloaded_datetime,true);
		$criteria->compare('inserted_in_dms',$this->inserted_in_dms,true);
		$criteria->compare('inserted_datetime',$this->inserted_datetime,true);
		$criteria->compare('log_created_datetime',$this->log_created_datetime,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ServiceCertificateDownloadHistory the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
