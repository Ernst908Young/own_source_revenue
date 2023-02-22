<?php

/**
 * This is the model class for table "bo_app_workflow".
 *
 * The followings are the available columns in table 'bo_app_workflow':
 * @property integer $wrkflw_id
 * @property string $app_id
 * @property string $role_id
 * @property string $wrkflw_createdon
 * @property string $user_agent
 * @property string $ip_address
 * @property string $is_active_wrkflw
 *
 * The followings are the available model relations:
 * @property Applications $app
 * @property Roles $role
 */
class AppWorkflow extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'bo_app_workflow';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('app_id, role_id, wrkflw_createdon, user_agent, ip_address', 'required'),
			array('app_id, role_id', 'length', 'max'=>10),
			array('user_agent, ip_address', 'length', 'max'=>255),
			array('is_active_wrkflw', 'length', 'max'=>1),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('wrkflw_id, app_id, role_id, wrkflw_createdon, user_agent, ip_address, is_active_wrkflw', 'safe', 'on'=>'search'),
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
			'app' => array(self::BELONGS_TO, 'Applications', 'app_id'),
			'role' => array(self::BELONGS_TO, 'Roles', 'role_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'wrkflw_id' => 'Wrkflw',
			'app_id' => 'App',
			'role_id' => 'Role',
			'wrkflw_createdon' => 'Wrkflw Createdon',
			'user_agent' => 'User Agent',
			'ip_address' => 'Ip Address',
			'is_active_wrkflw' => 'Is Active Wrkflw',
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

		$criteria->compare('wrkflw_id',$this->wrkflw_id);
		$criteria->compare('app_id',$this->app_id,true);
		$criteria->compare('role_id',$this->role_id,true);
		$criteria->compare('wrkflw_createdon',$this->wrkflw_createdon,true);
		$criteria->compare('user_agent',$this->user_agent,true);
		$criteria->compare('ip_address',$this->ip_address,true);
		$criteria->compare('is_active_wrkflw',$this->is_active_wrkflw,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return AppWorkflow the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
