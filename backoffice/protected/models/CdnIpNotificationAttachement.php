<?php

/**
 * This is the model class for table "cdn_ip_notification_attachement".
 *
 * The followings are the available columns in table 'cdn_ip_notification_attachement':
 * @property integer $attachement_id
 * @property integer $notification_id
 * @property string $document_name
 * @property string $document_type
 * @property string $document
 * @property string $created
 * @property string $is_active
 */
class CdnIpNotificationAttachement extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'cdn_ip_notification_attachement';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('notification_id, document_name, document_type, document, created', 'required'),
			array('notification_id', 'numerical', 'integerOnly'=>true),
			array('document_name, document_type', 'length', 'max'=>255),
			array('is_active', 'length', 'max'=>1),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('attachement_id, notification_id, document_name, document_type, document, created, is_active', 'safe', 'on'=>'search'),
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
			'attachement_id' => 'Attachement',
			'notification_id' => 'Notification',
			'document_name' => 'Document Name',
			'document_type' => 'Document Type',
			'document' => 'Document',
			'created' => 'Created',
			'is_active' => 'Is Active',
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

		$criteria->compare('attachement_id',$this->attachement_id);
		$criteria->compare('notification_id',$this->notification_id);
		$criteria->compare('document_name',$this->document_name,true);
		$criteria->compare('document_type',$this->document_type,true);
		$criteria->compare('document',$this->document,true);
		$criteria->compare('created',$this->created,true);
		$criteria->compare('is_active',$this->is_active,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return CdnIpNotificationAttachement the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
