<?php

/**
 * This is the model class for table "bo_application_dms_documents_mapping".
 *
 * The followings are the available columns in table 'bo_application_dms_documents_mapping':
 * @property string $mapping_id
 * @property integer $iuid
 * @property string $user_id
 * @property integer $sno
 * @property string $dept_id
 * @property string $documents_id
 * @property string $document_file_name
 * @property string $status
 * @property string $ip_address
 * @property string $user_agent
 * @property string $created_on
 * @property string $last_updated
 * @property string $comments
 *
 * The followings are the available model relations:
 * @property SsoUsers $user
 * @property CdnDmsDocuments $documents
 * @property SpApplications $sno0
 * @property Departments $dept
 * @property ApplicationDmsDocumentsMappingLogs[] $applicationDmsDocumentsMappingLogs
 */
class ApplicationDmsDocumentsMapping extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'bo_application_dms_documents_mapping';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('iuid, user_id, sno, dept_id, document_file_name, ip_address, user_agent, created_on', 'required'),
			array('iuid, sno, doc_id', 'numerical', 'integerOnly'=>true),
			array('user_id', 'length', 'max'=>10),
			array('dept_id, documents_id', 'length', 'max'=>11),
			array('document_file_name, user_agent', 'length', 'max'=>255),
			array('status', 'length', 'max'=>1),
			array('ip_address', 'length', 'max'=>50),
			array('last_updated, comments, usercomment', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('mapping_id, iuid, user_id, sno, dept_id, documents_id, document_file_name, status, ip_address, user_agent, created_on, last_updated, comments', 'safe', 'on'=>'search'),
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
			'user' => array(self::BELONGS_TO, 'SsoUsers', 'user_id'),
			'documents' => array(self::BELONGS_TO, 'CdnDmsDocuments', 'documents_id'),
			'sno0' => array(self::BELONGS_TO, 'SpApplications', 'sno'),
			'dept' => array(self::BELONGS_TO, 'Departments', 'dept_id'),
			'applicationDmsDocumentsMappingLogs' => array(self::HAS_MANY, 'ApplicationDmsDocumentsMappingLogs', 'mapping_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'mapping_id' => 'Mapping',
			'iuid' => 'Iuid',
			'user_id' => 'User',
			'sno' => 'Sno',
			'dept_id' => 'Dept',
			'documents_id' => 'Documents',
			'document_file_name' => 'Document File Name',
			'status' => 'Status',
			'ip_address' => 'Ip Address',
			'user_agent' => 'User Agent',
			'created_on' => 'Created On',
			'last_updated' => 'Last Updated',
			'comments' => 'Comments',
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

		$criteria->compare('mapping_id',$this->mapping_id,true);
		$criteria->compare('iuid',$this->iuid);
		$criteria->compare('user_id',$this->user_id,true);
		$criteria->compare('sno',$this->sno);
		$criteria->compare('dept_id',$this->dept_id,true);
		$criteria->compare('documents_id',$this->documents_id,true);
		$criteria->compare('document_file_name',$this->document_file_name,true);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('ip_address',$this->ip_address,true);
		$criteria->compare('user_agent',$this->user_agent,true);
		$criteria->compare('created_on',$this->created_on,true);
		$criteria->compare('last_updated',$this->last_updated,true);
		$criteria->compare('comments',$this->comments,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ApplicationDmsDocumentsMapping the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
