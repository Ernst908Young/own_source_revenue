<?php

/**
 * This is the model class for table "cdn_appeal_documents".
 *
 * The followings are the available columns in table 'cdn_appeal_documents':
 * @property string $doc_id
 * @property string $document
 * @property string $document_name
 * @property string $doc_type
 * @property string $appeal_id
 * @property string $appeal_conversation_id
 * @property string $is_doc_active
 */
class AppealDocuments extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'cdn_appeal_documents';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('document, document_name', 'required'),
			array('document_name', 'length', 'max'=>500),
			array('doc_type', 'length', 'max'=>24),
			array('appeal_id, appeal_conversation_id', 'length', 'max'=>20),
			array('is_doc_active', 'length', 'max'=>1),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('doc_id, document, document_name, doc_type, appeal_id, appeal_conversation_id, is_doc_active', 'safe', 'on'=>'search'),
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
			'document' => 'Document',
			'document_name' => 'Document Name',
			'doc_type' => 'Doc Type',
			'appeal_id' => 'Appeal',
			'appeal_conversation_id' => 'Appeal Conversation',
			'is_doc_active' => 'Is Doc Active',
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
		$criteria->compare('document',$this->document,true);
		$criteria->compare('document_name',$this->document_name,true);
		$criteria->compare('doc_type',$this->doc_type,true);
		$criteria->compare('appeal_id',$this->appeal_id,true);
		$criteria->compare('appeal_conversation_id',$this->appeal_conversation_id,true);
		$criteria->compare('is_doc_active',$this->is_doc_active,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return AppealDocuments the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
