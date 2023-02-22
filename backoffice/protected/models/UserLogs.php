<?php

/**
 * This is the model class for table "bo_user_logs".
 *
 * The followings are the available columns in table 'bo_user_logs':
 * @property integer $log_id
 * @property string $edited_by
 * @property string $action
 * @property string $before_edit
 * @property string $after_edit
 * @property string $remote_ip
 * @property string $user_agent
 * @property string $other_info
 * @property string $created_time
 */
class UserLogs extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'bo_user_logs';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('edited_by, action, remote_ip, user_agent, created_time', 'required'),
			array('edited_by, action, user_agent', 'length', 'max'=>255),
			array('remote_ip', 'length', 'max'=>50),
			array('before_edit, after_edit, other_info', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('log_id, edited_by, action, before_edit, after_edit, remote_ip, user_agent, other_info, created_time', 'safe', 'on'=>'search'),
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
			'log_id' => 'Log',
			'edited_by' => 'Edited By',
			'action' => 'Action',
			'before_edit' => 'Before Edit',
			'after_edit' => 'After Edit',
			'remote_ip' => 'Remote Ip',
			'user_agent' => 'User Agent',
			'other_info' => 'Other Info',
			'created_time' => 'Created Time',
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

		$criteria->compare('log_id',$this->log_id);
		$criteria->compare('edited_by',$this->edited_by,true);
		$criteria->compare('action',$this->action,true);
		$criteria->compare('before_edit',$this->before_edit,true);
		$criteria->compare('after_edit',$this->after_edit,true);
		$criteria->compare('remote_ip',$this->remote_ip,true);
		$criteria->compare('user_agent',$this->user_agent,true);
		$criteria->compare('other_info',$this->other_info,true);
		$criteria->compare('created_time',$this->created_time,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return UserLogs the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
