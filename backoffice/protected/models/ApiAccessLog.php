<?php

/**
 * This is the model class for table "bo_api_access_log".
 *
 * The followings are the available columns in table 'bo_api_access_log':
 * @property integer $access_id
 * @property string $sp_tag
 * @property string $request_method
 * @property string $request_uri
 * @property string $request_time
 * @property string $post_info
 * @property string $user_agent
 * @property string $created_date_time
 * @property string $remote_ip
 * @property string $response_return
 */
class ApiAccessLog extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'bo_api_access_log';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('sp_tag, request_method, request_uri, request_time, post_info, user_agent, created_date_time, remote_ip', 'required'),
			array('sp_tag, request_method, request_uri, request_time', 'length', 'max'=>512),
			array('user_agent, remote_ip', 'length', 'max'=>250),
			array('response_return', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('access_id, sp_tag, request_method, request_uri, request_time, post_info, user_agent, created_date_time, remote_ip, response_return', 'safe', 'on'=>'search'),
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
			'access_id' => 'Access',
			'sp_tag' => 'Sp Tag',
			'request_method' => 'Request Method',
			'request_uri' => 'Request Uri',
			'request_time' => 'Request Time',
			'post_info' => 'Post Info',
			'user_agent' => 'User Agent',
			'created_date_time' => 'Created Date Time',
			'remote_ip' => 'Remote Ip',
			'response_return' => 'Response Return',
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

		$criteria->compare('access_id',$this->access_id);
		$criteria->compare('sp_tag',$this->sp_tag,true);
		$criteria->compare('request_method',$this->request_method,true);
		$criteria->compare('request_uri',$this->request_uri,true);
		$criteria->compare('request_time',$this->request_time,true);
		$criteria->compare('post_info',$this->post_info,true);
		$criteria->compare('user_agent',$this->user_agent,true);
		$criteria->compare('created_date_time',$this->created_date_time,true);
		$criteria->compare('remote_ip',$this->remote_ip,true);
		$criteria->compare('response_return',$this->response_return,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ApiAccessLog the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
