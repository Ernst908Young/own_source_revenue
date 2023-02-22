<?php

/**
 * This is the model class for table "cdn_grievance_document_metainfo".
 *
 * The followings are the available columns in table 'cdn_grievance_document_metainfo':
 * @property string $info_id
 * @property string $doc_id
 * @property string $uploaded_by
 * @property string $grievence_id
 * @property string $doc_size
 * @property string $uploaded_on
 * @property string $is_reply
 * @property string $status
 */
class GrievanceDocumentMetainfo extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'cdn_grievance_document_metainfo';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('doc_id, uploaded_by, grievence_id, doc_size, uploaded_on', 'required'),
			array('doc_id, uploaded_by, grievence_id', 'length', 'max'=>10),
			array('doc_size', 'length', 'max'=>20),
			array('is_reply, status', 'length', 'max'=>1),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('info_id, doc_id, uploaded_by, grievence_id, doc_size, uploaded_on, is_reply, status', 'safe', 'on'=>'search'),
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
			'info_id' => 'Info',
			'doc_id' => 'Doc',
			'uploaded_by' => 'Uploaded By',
			'grievence_id' => 'Grievence',
			'doc_size' => 'Doc Size',
			'uploaded_on' => 'Uploaded On',
			'is_reply' => 'Is Reply',
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

		$criteria->compare('info_id',$this->info_id,true);
		$criteria->compare('doc_id',$this->doc_id,true);
		$criteria->compare('uploaded_by',$this->uploaded_by,true);
		$criteria->compare('grievence_id',$this->grievence_id,true);
		$criteria->compare('doc_size',$this->doc_size,true);
		$criteria->compare('uploaded_on',$this->uploaded_on,true);
		$criteria->compare('is_reply',$this->is_reply,true);
		$criteria->compare('status',$this->status,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return GrievanceDocumentMetainfo the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
