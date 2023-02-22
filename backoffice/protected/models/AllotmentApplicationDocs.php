<?php

/**
 * This is the model class for table "bo_allotment_application_docs".
 *
 * The followings are the available columns in table 'bo_allotment_application_docs':
 * @property integer $app_doc_id
 * @property string $doc_id
 * @property string $app_id
 * @property string $app_submission_id
 * @property string $created_on
 *
 * The followings are the available model relations:
 * @property CdnDocuments $doc
 */
class AllotmentApplicationDocs extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'bo_allotment_application_docs';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('doc_id, app_id, app_submission_id, created_on', 'required'),
			array('doc_id, app_id, app_submission_id', 'length', 'max'=>10),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('app_doc_id, doc_id, app_id, app_submission_id, created_on', 'safe', 'on'=>'search'),
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
			'doc' => array(self::BELONGS_TO, 'CdnDocuments', 'doc_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'app_doc_id' => 'App Doc',
			'doc_id' => 'Doc',
			'app_id' => 'App',
			'app_submission_id' => 'App Submission',
			'created_on' => 'Created On',
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

		$criteria->compare('app_doc_id',$this->app_doc_id);
		$criteria->compare('doc_id',$this->doc_id,true);
		$criteria->compare('app_id',$this->app_id,true);
		$criteria->compare('app_submission_id',$this->app_submission_id,true);
		$criteria->compare('created_on',$this->created_on,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return AllotmentApplicationDocs the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
