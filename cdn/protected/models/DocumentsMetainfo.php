<?php

/**
 * This is the model class for table "cdn_documents_metainfo".
 *
 * The followings are the available columns in table 'cdn_documents_metainfo':
 * @property string $info_id
 * @property string $doc_id
 * @property string $uploaded_by
 * @property string $department_id
 * @property string $application_id
 * @property string $uploaded_on
 * @property string $status
 * @property integer $verifier_id
 * @property integer $verifier_role_id
 * @property string $verified_date
 * @property string $verifier_comments
 * @property string $verifier_document
 *
 * The followings are the available model relations:
 * @property Documents $doc
 */
class DocumentsMetainfo extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'cdn_documents_metainfo';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('doc_id, uploaded_by, department_id, application_id, uploaded_on', 'required'),
			array('verifier_id, verifier_role_id', 'numerical', 'integerOnly'=>true),
			array('doc_id, uploaded_by, department_id, application_id', 'length', 'max'=>10),
			array('status, verifier_document', 'length', 'max'=>1),
			array('verified_date, verifier_comments', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('info_id, doc_id, uploaded_by, department_id, application_id, uploaded_on, status, verifier_id, verifier_role_id, verified_date, verifier_comments, verifier_document', 'safe', 'on'=>'search'),
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
			'doc' => array(self::BELONGS_TO, 'Documents', 'doc_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'info_id' => 'Info',
			'doc_id' => 'Doc',
			'uploaded_by' => 'Uploaded By',
			'department_id' => 'Department',
			'application_id' => 'Application',
			'uploaded_on' => 'Uploaded On',
			'status' => 'Status',
			'verifier_id' => 'Verifier',
			'verifier_role_id' => 'Verifier Role',
			'verified_date' => 'Verified Date',
			'verifier_comments' => 'Verifier Comments',
			'verifier_document' => 'Verifier Document',
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

		$criteria->compare('info_id',$this->info_id,true);
		$criteria->compare('doc_id',$this->doc_id,true);
		$criteria->compare('uploaded_by',$this->uploaded_by,true);
		$criteria->compare('department_id',$this->department_id,true);
		$criteria->compare('application_id',$this->application_id,true);
		$criteria->compare('uploaded_on',$this->uploaded_on,true);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('verifier_id',$this->verifier_id);
		$criteria->compare('verifier_role_id',$this->verifier_role_id);
		$criteria->compare('verified_date',$this->verified_date,true);
		$criteria->compare('verifier_comments',$this->verifier_comments,true);
		$criteria->compare('verifier_document',$this->verifier_document,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return DocumentsMetainfo the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
