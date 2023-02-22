<?php

/**
 * This is the model class for table "bo_application_forward_level".
 *
 * The followings are the available columns in table 'bo_application_forward_level':
 * @property string $appr_lvl_id
 * @property string $next_role_id
 * @property string $verifier_user_id
 * @property string $app_Sub_id
 * @property string $forwarded_dept_id
 * @property string $verifier_user_comment
 * @property string $created_on
 * @property string $user_agent
 * @property string $comment_date
 * @property string $ip_address
 * @property string $approv_status
 *
 * The followings are the available model relations:
 * @property ApplicationSubmission $appSub
 * @property Departments $forwardedDept
 */
class ApplicationForwardLevel extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'bo_application_forward_level';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('next_role_id, app_Sub_id, forwarded_dept_id, created_on, user_agent, ip_address', 'required'),
			array('next_role_id, verifier_user_id, app_Sub_id, forwarded_dept_id', 'length', 'max'=>10),
			array('user_agent, ip_address', 'length', 'max'=>255),
			array('approv_status', 'length', 'max'=>1),
			array('verifier_user_comment, comment_date', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('appr_lvl_id, next_role_id, verifier_user_id, app_Sub_id, forwarded_dept_id, verifier_user_comment, created_on, user_agent, comment_date, ip_address, approv_status', 'safe', 'on'=>'search'),
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
			'appSub' => array(self::BELONGS_TO, 'ApplicationSubmission', 'app_Sub_id'),
			'forwardedDept' => array(self::BELONGS_TO, 'Departments', 'forwarded_dept_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'appr_lvl_id' => 'Appr Lvl',
			'next_role_id' => 'Next Role',
			'verifier_user_id' => 'Verifier User',
			'app_Sub_id' => 'App Sub',
			'forwarded_dept_id' => 'Forwarded Dept',
			'verifier_user_comment' => 'Verifier User Comment',
			'created_on' => 'Created On',
			'user_agent' => 'User Agent',
			'comment_date' => 'Comment Date',
			'ip_address' => 'Ip Address',
			'approv_status' => 'Approv Status',
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

		$criteria->compare('appr_lvl_id',$this->appr_lvl_id,true);
		$criteria->compare('next_role_id',$this->next_role_id,true);
		$criteria->compare('verifier_user_id',$this->verifier_user_id,true);
		$criteria->compare('app_Sub_id',$this->app_Sub_id,true);
		$criteria->compare('forwarded_dept_id',$this->forwarded_dept_id,true);
		$criteria->compare('verifier_user_comment',$this->verifier_user_comment,true);
		$criteria->compare('created_on',$this->created_on,true);
		$criteria->compare('user_agent',$this->user_agent,true);
		$criteria->compare('comment_date',$this->comment_date,true);
		$criteria->compare('ip_address',$this->ip_address,true);
		$criteria->compare('approv_status',$this->approv_status,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ApplicationForwardLevel the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
