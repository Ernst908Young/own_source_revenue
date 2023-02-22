<?php

/**
 * This is the model class for table "bo_offline_document_submission".
 *
 * The followings are the available columns in table 'bo_offline_document_submission':
 * @property string $id
 * @property string $offline_application_id
 * @property string $doc_id
 * @property string $received_notreceived
 * @property integer $roleid
 * @property string $user_id
 * @property string $status
 * @property string $user_agent
 * @property string $ip_address
 * @property string $created_date
 */
class BoOfflineDocumentSubmission extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'bo_offline_document_submission';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('offline_application_id, doc_id, user_id, status, created_date', 'required'),
			array('roleid', 'numerical', 'integerOnly'=>true),
			array('offline_application_id, doc_id, user_id', 'length', 'max'=>11),
			array('received_notreceived, status, user_agent, ip_address', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, offline_application_id, doc_id, received_notreceived, roleid, user_id, status, user_agent, ip_address, created_date', 'safe', 'on'=>'search'),
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
			'id' => 'ID',
			'offline_application_id' => 'Offline Application',
			'doc_id' => 'Doc',
			'received_notreceived' => 'Received Notreceived',
			'roleid' => 'Roleid',
			'user_id' => 'User',
			'status' => 'Status',
			'user_agent' => 'User Agent',
			'ip_address' => 'Ip Address',
			'created_date' => 'Created Date',
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
		$criteria->compare('offline_application_id',$this->offline_application_id,true);
		$criteria->compare('doc_id',$this->doc_id,true);
		$criteria->compare('received_notreceived',$this->received_notreceived,true);
		$criteria->compare('roleid',$this->roleid);
		$criteria->compare('user_id',$this->user_id,true);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('user_agent',$this->user_agent,true);
		$criteria->compare('ip_address',$this->ip_address,true);
		$criteria->compare('created_date',$this->created_date,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return BoOfflineDocumentSubmission the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
