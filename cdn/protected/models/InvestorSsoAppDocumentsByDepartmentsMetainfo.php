<?php

/**
 * This is the model class for table "cdn_investor_ssoApp_documents_by_Departments_metainfo".
 *
 * The followings are the available columns in table 'cdn_investor_ssoApp_documents_by_Departments_metainfo':
 * @property integer $info_id
 * @property integer $doc_id
 * @property string $doc_size
 * @property integer $uploaded_by
 * @property integer $department_id
 * @property string $uploaded_date_time
 * @property string $user_comments
 * @property string $user_agent
 * @property string $remote_ip_address
 *
 * The followings are the available model relations:
 * @property InvestorSsoAppDocumentsByDepartments $doc
 */
class InvestorSsoAppDocumentsByDepartmentsMetainfo extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'cdn_investor_ssoApp_documents_by_Departments_metainfo';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('doc_id, doc_size, uploaded_by, department_id, uploaded_date_time, user_agent, remote_ip_address', 'required'),
			array('doc_id, uploaded_by, department_id', 'numerical', 'integerOnly'=>true),
			array('doc_size', 'length', 'max'=>20),
			array('user_agent, remote_ip_address', 'length', 'max'=>255),
			array('user_comments', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('info_id, doc_id, doc_size, uploaded_by, department_id, uploaded_date_time, user_comments, user_agent, remote_ip_address', 'safe', 'on'=>'search'),
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
			'doc' => array(self::BELONGS_TO, 'InvestorSsoAppDocumentsByDepartments', 'doc_id'),
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
			'doc_size' => 'Doc Size',
			'uploaded_by' => 'Uploaded By',
			'department_id' => 'Department',
			'uploaded_date_time' => 'Uploaded Date Time',
			'user_comments' => 'User Comments',
			'user_agent' => 'User Agent',
			'remote_ip_address' => 'Remote Ip Address',
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

		$criteria->compare('info_id',$this->info_id);
		$criteria->compare('doc_id',$this->doc_id);
		$criteria->compare('doc_size',$this->doc_size,true);
		$criteria->compare('uploaded_by',$this->uploaded_by);
		$criteria->compare('department_id',$this->department_id);
		$criteria->compare('uploaded_date_time',$this->uploaded_date_time,true);
		$criteria->compare('user_comments',$this->user_comments,true);
		$criteria->compare('user_agent',$this->user_agent,true);
		$criteria->compare('remote_ip_address',$this->remote_ip_address,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return InvestorSsoAppDocumentsByDepartmentsMetainfo the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
