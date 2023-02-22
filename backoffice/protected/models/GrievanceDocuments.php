<?php

/**
 * This is the model class for table "cdn_grievance_documents".
 *
 * The followings are the available columns in table 'cdn_grievance_documents':
 * @property string $doc_id
 * @property string $document_name
 * @property string $document
 * @property double $document_version
 * @property string $document_mime_type
 * @property string $is_document_active
 * @property string $doc_status
 */
class GrievanceDocuments extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'cdn_grievance_documents';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('document_name, document', 'required'),
			array('document_version', 'numerical'),
			array('document_name', 'length', 'max'=>128),
			array('document_mime_type', 'length', 'max'=>24),
			array('is_document_active, doc_status', 'length', 'max'=>1),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('doc_id, document_name, document, document_version, document_mime_type, is_document_active, doc_status', 'safe', 'on'=>'search'),
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
			'doc_id' => 'Doc',
			'document_name' => 'Document Name',
			'document' => 'Document',
			'document_version' => 'Document Version',
			'document_mime_type' => 'Document Mime Type',
			'is_document_active' => 'Is Document Active',
			'doc_status' => 'Doc Status',
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

		$criteria->compare('doc_id',$this->doc_id,true);
		$criteria->compare('document_name',$this->document_name,true);
		$criteria->compare('document',$this->document,true);
		$criteria->compare('document_version',$this->document_version);
		$criteria->compare('document_mime_type',$this->document_mime_type,true);
		$criteria->compare('is_document_active',$this->is_document_active,true);
		$criteria->compare('doc_status',$this->doc_status,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return GrievanceDocuments the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
