<?php

/**
 * This is the model class for table "bo_application_dms_documents_mapping_logs".
 *
 * The followings are the available columns in table 'bo_application_dms_documents_mapping_logs':
 * @property string $id
 * @property string $mapping_id
 * @property string $documents_id
 * @property string $status
 * @property string $dept_user_id
 * @property string $verifier_name
 * @property string $verifier_designation
 * @property string $verifier_comments
 * @property string $created_time
 * @property string $remote_ip
 * @property string $user_agent
 *
 * The followings are the available model relations:
 * @property ApplicationDmsDocumentsMapping $mapping
 * @property CdnDmsDocuments $documents
 * @property User $deptUser
 */
class ApplicationDmsDocumentsMappingLogs extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'bo_application_dms_documents_mapping_logs';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('mapping_id, dept_user_id, created_time', 'required'),
			array('mapping_id, documents_id', 'length', 'max'=>11),
			array('status', 'length', 'max'=>1),
			array('dept_user_id', 'length', 'max'=>10),
			array('verifier_name, verifier_designation', 'length', 'max'=>100),
			array('remote_ip', 'length', 'max'=>20),
			array('user_agent', 'length', 'max'=>255),
			array('verifier_comments', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, mapping_id, documents_id, status, dept_user_id, verifier_name, verifier_designation, verifier_comments, created_time, remote_ip, user_agent', 'safe', 'on'=>'search'),
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
			'mapping' => array(self::BELONGS_TO, 'ApplicationDmsDocumentsMapping', 'mapping_id'),
			'documents' => array(self::BELONGS_TO, 'CdnDmsDocuments', 'documents_id'),
			'deptUser' => array(self::BELONGS_TO, 'User', 'dept_user_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'mapping_id' => 'Mapping',
			'documents_id' => 'Documents',
			'status' => 'Status',
			'dept_user_id' => 'Dept User',
			'verifier_name' => 'Verifier Name',
			'verifier_designation' => 'Verifier Designation',
			'verifier_comments' => 'Verifier Comments',
			'created_time' => 'Created Time',
			'remote_ip' => 'Remote Ip',
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

		$criteria->compare('id',$this->id,true);
		$criteria->compare('mapping_id',$this->mapping_id,true);
		$criteria->compare('documents_id',$this->documents_id,true);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('dept_user_id',$this->dept_user_id,true);
		$criteria->compare('verifier_name',$this->verifier_name,true);
		$criteria->compare('verifier_designation',$this->verifier_designation,true);
		$criteria->compare('verifier_comments',$this->verifier_comments,true);
		$criteria->compare('created_time',$this->created_time,true);
		$criteria->compare('remote_ip',$this->remote_ip,true);
		$criteria->compare('user_agent',$this->user_agent,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ApplicationDmsDocumentsMappingLogs the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
