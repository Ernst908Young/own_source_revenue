<?php

/**
 * This is the model class for table "bo_appeal".
 *
 * The followings are the available columns in table 'bo_appeal':
 * @property string $appeal_id
 * @property string $reference_number
 * @property string $appeal_subject
 * @property string $appeal_reason
 * @property string $appeal_document
 * @property string $appeal_status
 * @property string $appeal_created_datetime
 * @property string $appeal_updated_datetime
 * @property string $remote_address
 * @property string $user_agent
 *
 * The followings are the available model relations:
 * @property AppealConversation[] $appealConversations
 */
class Appeal extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'bo_appeal';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('reference_number, appeal_subject, appeal_reason, appeal_document, appeal_status, appeal_created_datetime, remote_address, user_agent', 'required'),
			array('reference_number', 'length', 'max'=>100),
			array('appeal_subject, appeal_document', 'length', 'max'=>250),
			array('appeal_status', 'length', 'max'=>1),
			array('remote_address, user_agent', 'length', 'max'=>255),
			array('appeal_updated_datetime', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('appeal_id, reference_number, appeal_subject, appeal_reason, appeal_document, appeal_status, appeal_created_datetime, appeal_updated_datetime, remote_address, user_agent', 'safe', 'on'=>'search'),
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
			'appealConversations' => array(self::HAS_MANY, 'AppealConversation', 'appeal_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'appeal_id' => 'Appeal',
			'reference_number' => 'Reference Number',
			'appeal_subject' => 'Appeal Subject',
			'appeal_reason' => 'Appeal Reason',
			'appeal_document' => 'Appeal Document',
			'appeal_status' => 'Appeal Status',
			'appeal_created_datetime' => 'Appeal Created Datetime',
			'appeal_updated_datetime' => 'Appeal Updated Datetime',
			'remote_address' => 'Remote Address',
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

		$criteria->compare('appeal_id',$this->appeal_id,true);
		$criteria->compare('reference_number',$this->reference_number,true);
		$criteria->compare('appeal_subject',$this->appeal_subject,true);
		$criteria->compare('appeal_reason',$this->appeal_reason,true);
		$criteria->compare('appeal_document',$this->appeal_document,true);
		$criteria->compare('appeal_status',$this->appeal_status,true);
		$criteria->compare('appeal_created_datetime',$this->appeal_created_datetime,true);
		$criteria->compare('appeal_updated_datetime',$this->appeal_updated_datetime,true);
		$criteria->compare('remote_address',$this->remote_address,true);
		$criteria->compare('user_agent',$this->user_agent,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Appeal the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
