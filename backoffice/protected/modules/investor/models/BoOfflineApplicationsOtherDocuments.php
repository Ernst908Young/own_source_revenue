<?php

/**
 * This is the model class for table "bo_offline_applications_other_documents".
 *
 * The followings are the available columns in table 'bo_offline_applications_other_documents':
 * @property string $id
 * @property string $offline_application_id
 * @property string $type_of_document
 * @property string $document_name
 * @property string $document_file_name
 * @property string $created_datetime
 * @property string $status
 *
 * The followings are the available model relations:
 * @property BoOfflineApplications $offlineApplication
 */
class BoOfflineApplicationsOtherDocuments extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'bo_offline_applications_other_documents';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('offline_application_id, type_of_document, document_name, document_file_name, created_datetime, status', 'required'),
			array('offline_application_id', 'length', 'max'=>11),
			array('type_of_document', 'length', 'max'=>1),
			array('document_file_name', 'length', 'max'=>255),
			array('status', 'length', 'max'=>10),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, offline_application_id, type_of_document, document_name, document_file_name, created_datetime, status', 'safe', 'on'=>'search'),
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
			'offlineApplication' => array(self::BELONGS_TO, 'BoOfflineApplications', 'offline_application_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'offline_application_id' => 'Offline Application',
			'type_of_document' => 'S=Statuory Form, O=Others',
			'document_name' => 'Document Name',
			'document_file_name' => 'Document File Name',
			'created_datetime' => 'Created Datetime',
			'status' => 'Status',
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
		$criteria->compare('offline_application_id',$this->offline_application_id,true);
		$criteria->compare('type_of_document',$this->type_of_document,true);
		$criteria->compare('document_name',$this->document_name,true);
		$criteria->compare('document_file_name',$this->document_file_name,true);
		$criteria->compare('created_datetime',$this->created_datetime,true);
		$criteria->compare('status',$this->status,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return BoOfflineApplicationsOtherDocuments the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
