<?php

/**
 * This is the model class for table "bo_grievance_ticket_detail".
 *
 * The followings are the available columns in table 'bo_grievance_ticket_detail':
 * @property integer $id
 * @property string $grievance_id
 * @property integer $topic_id
 * @property string $user_id
 * @property string $ticket_number
 * @property string $created_date_time
 * @property string $user_agent
 *
 * The followings are the available model relations:
 * @property Grievance $grievance
 * @property GrievanceTopicMaster $topic
 * @property SsoUsers $user
 */
class GrievanceTicketDetail extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'bo_grievance_ticket_detail';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('grievance_id, topic_id, user_id, ticket_number, created_date_time, user_agent', 'required'),
			array('topic_id', 'numerical', 'integerOnly'=>true),
			array('grievance_id, user_id', 'length', 'max'=>10),
			array('ticket_number', 'length', 'max'=>100),
			array('user_agent', 'length', 'max'=>300),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, grievance_id, topic_id, user_id, ticket_number, created_date_time, user_agent', 'safe', 'on'=>'search'),
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
			'grievance' => array(self::BELONGS_TO, 'Grievance', 'grievance_id'),
			'topic' => array(self::BELONGS_TO, 'GrievanceTopicMaster', 'topic_id'),
			'user' => array(self::BELONGS_TO, 'SsoUsers', 'user_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'grievance_id' => 'Grievance',
			'topic_id' => 'Topic',
			'user_id' => 'User',
			'ticket_number' => 'Ticket Number',
			'created_date_time' => 'Created Date Time',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('grievance_id',$this->grievance_id,true);
		$criteria->compare('topic_id',$this->topic_id);
		$criteria->compare('user_id',$this->user_id,true);
		$criteria->compare('ticket_number',$this->ticket_number,true);
		$criteria->compare('created_date_time',$this->created_date_time,true);
		$criteria->compare('user_agent',$this->user_agent,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return GrievanceTicketDetail the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
