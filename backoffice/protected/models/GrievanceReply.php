<?php

/**
 * This is the model class for table "bo_grievance_reply".
 *
 * The followings are the available columns in table 'bo_grievance_reply':
 * @property string $reply_id
 * @property string $grievance_id
 * @property string $reply_text
 * @property string $is_bo_reply
 * @property integer $replied_by
 * @property string $user_agent
 * @property string $remote_ip
 * @property string $created_date_time
 *
 * The followings are the available model relations:
 * @property Grievance $grievance
 */
class GrievanceReply extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'bo_grievance_reply';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('grievance_id, reply_text, user_agent, remote_ip, created_date_time', 'required'),
			array('replied_by', 'numerical', 'integerOnly'=>true),
			array('grievance_id', 'length', 'max'=>10),
			array('is_bo_reply', 'length', 'max'=>1),
			array('user_agent, remote_ip', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('reply_id, grievance_id, reply_text, is_bo_reply, replied_by, user_agent, remote_ip, created_date_time', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'reply_id' => 'Reply',
			'grievance_id' => 'Grievance',
			'reply_text' => 'Reply Text',
			'is_bo_reply' => 'Is Bo Reply',
			'replied_by' => 'Replied By',
			'user_agent' => 'User Agent',
			'remote_ip' => 'Remote Ip',
			'created_date_time' => 'Created Date Time',
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

		$criteria->compare('reply_id',$this->reply_id,true);
		$criteria->compare('grievance_id',$this->grievance_id,true);
		$criteria->compare('reply_text',$this->reply_text,true);
		$criteria->compare('is_bo_reply',$this->is_bo_reply,true);
		$criteria->compare('replied_by',$this->replied_by);
		$criteria->compare('user_agent',$this->user_agent,true);
		$criteria->compare('remote_ip',$this->remote_ip,true);
		$criteria->compare('created_date_time',$this->created_date_time,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return GrievanceReply the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
