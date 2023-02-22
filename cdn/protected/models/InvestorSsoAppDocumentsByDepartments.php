<?php

/**
 * This is the model class for table "cdn_investor_ssoApp_documents_by_Departments".
 *
 * The followings are the available columns in table 'cdn_investor_ssoApp_documents_by_Departments':
 * @property integer $doc_id
 * @property integer $app_sub_id
 * @property string $doc_name
 * @property string $doc_type
 * @property string $document
 * @property integer $document_version
 * @property string $is_document_active
 *
 * The followings are the available model relations:
 * @property InvestorSsoAppDocumentsByDepartmentsMetainfo[] $investorSsoAppDocumentsByDepartmentsMetainfos
 */
class InvestorSsoAppDocumentsByDepartments extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'cdn_investor_ssoApp_documents_by_Departments';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('app_sub_id, doc_name, document', 'required'),
			array('app_sub_id, document_version', 'numerical', 'integerOnly'=>true),
			array('doc_name', 'length', 'max'=>255),
			array('doc_type', 'length', 'max'=>24),
			array('is_document_active', 'length', 'max'=>1),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('doc_id, app_sub_id, doc_name, doc_type, document, document_version, is_document_active', 'safe', 'on'=>'search'),
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
			'investorSsoAppDocumentsByDepartmentsMetainfos' => array(self::HAS_MANY, 'InvestorSsoAppDocumentsByDepartmentsMetainfo', 'doc_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'doc_id' => 'Doc',
			'app_sub_id' => 'App Sub',
			'doc_name' => 'Doc Name',
			'doc_type' => 'Doc Type',
			'document' => 'Document',
			'document_version' => 'Document Version',
			'is_document_active' => 'Is Document Active',
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

		$criteria->compare('doc_id',$this->doc_id);
		$criteria->compare('app_sub_id',$this->app_sub_id);
		$criteria->compare('doc_name',$this->doc_name,true);
		$criteria->compare('doc_type',$this->doc_type,true);
		$criteria->compare('document',$this->document,true);
		$criteria->compare('document_version',$this->document_version);
		$criteria->compare('is_document_active',$this->is_document_active,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return InvestorSsoAppDocumentsByDepartments the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
