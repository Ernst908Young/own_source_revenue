<?php

/**
 * This is the model class for table "bo_ip_notification_logs".
 *
 * The followings are the available columns in table 'bo_ip_notification_logs':
 * @property integer $id
 * @property string $subject
 * @property string $msg_body
 * @property string $msg_html
 * @property string $msg_date
 * @property string $msg_uid
 * @property string $created_on
 * @property string $email_from
 * @property string $email_to
 * @property string $is_any_attachment
 * @property string $created_by
 * @property string $user_name
 * @property string $role_id
 * @property string $make_visible
 * @property integer $parent_id
 * @property string $remote_address
 * @property string $user_agent
 * @property string $msg_type
 *
 * The followings are the available model relations:
 * @property User $createdBy
 * @property Roles $role
 */
class IpNotificationLogs extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'bo_ip_notification_logs';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('subject, msg_body, msg_html, msg_date, created_on, email_from, email_to, remote_address, user_agent', 'required'),
			array('parent_id', 'numerical', 'integerOnly'=>true),
			array('subject', 'length', 'max'=>500),
			array('msg_date', 'length', 'max'=>100),
			array('msg_uid', 'length', 'max'=>50),
			array('email_from, email_to, user_name, remote_address, user_agent', 'length', 'max'=>255),
			array('is_any_attachment, make_visible, msg_type', 'length', 'max'=>1),
			array('created_by, role_id', 'length', 'max'=>10),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, subject, msg_body, msg_html, msg_date, msg_uid, created_on, email_from, email_to, is_any_attachment, created_by, user_name, role_id, make_visible, parent_id, remote_address, user_agent, msg_type', 'safe', 'on'=>'search'),
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
			'createdBy' => array(self::BELONGS_TO, 'User', 'created_by'),
			'role' => array(self::BELONGS_TO, 'Roles', 'role_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'subject' => 'Subject',
			'msg_body' => 'Msg Body',
			'msg_html' => 'Msg Html',
			'msg_date' => 'Msg Date',
			'msg_uid' => 'Msg Uid',
			'created_on' => 'Created On',
			'email_from' => 'Email From',
			'email_to' => 'Email To',
			'is_any_attachment' => 'Is Any Attachment',
			'created_by' => 'Created By',
			'user_name' => 'User Name',
			'role_id' => 'Role',
			'make_visible' => 'Make Visible',
			'parent_id' => 'Parent',
			'remote_address' => 'Remote Address',
			'user_agent' => 'User Agent',
			'msg_type' => 'Msg Type',
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
		$criteria->compare('subject',$this->subject,true);
		$criteria->compare('msg_body',$this->msg_body,true);
		$criteria->compare('msg_html',$this->msg_html,true);
		$criteria->compare('msg_date',$this->msg_date,true);
		$criteria->compare('msg_uid',$this->msg_uid,true);
		$criteria->compare('created_on',$this->created_on,true);
		$criteria->compare('email_from',$this->email_from,true);
		$criteria->compare('email_to',$this->email_to,true);
		$criteria->compare('is_any_attachment',$this->is_any_attachment,true);
		$criteria->compare('created_by',$this->created_by,true);
		$criteria->compare('user_name',$this->user_name,true);
		$criteria->compare('role_id',$this->role_id,true);
		$criteria->compare('make_visible',$this->make_visible,true);
		$criteria->compare('parent_id',$this->parent_id);
		$criteria->compare('remote_address',$this->remote_address,true);
		$criteria->compare('user_agent',$this->user_agent,true);
		$criteria->compare('msg_type',$this->msg_type,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return IpNotificationLogs the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	/**
	* this function is used to generate the logs
	*@author Shishir
	*@params array param
	*@return boolean
	*/
	public function generateLogs($params)
	{
		$this->attributes = $params;	
		$this->remote_address = $_SERVER['REMOTE_ADDR'];
		$this->created_on = date('Y-m-d H:i:s');		
		$this->user_agent = $_SERVER['HTTP_USER_AGENT'];
		if($this->save())
			return $insert_id = Yii::app()->db->getLastInsertID();
		return false;
	}
}
