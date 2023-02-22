<?php

/**
 * This is the model class for table "bo_sp_applications".
 *
 * The followings are the available columns in table 'bo_sp_applications':
 * @property integer $sno
 * @property string $sp_tag
 * @property string $app_id
 * @property string $app_name
 * @property string $app_fields
 * @property string $app_status
 * @property integer $user_id
 * @property string $created_on
 * @property string $updated_on
 * @property string $is_active
 * @property string $remote_server
 * @property string $user_agent
 */
class SpApplications extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'bo_sp_applications';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('sp_tag, app_id, app_name, app_fields, app_status, user_id, created_on, updated_on, is_active, remote_server, user_agent', 'required'),
			array('user_id', 'numerical', 'integerOnly'=>true),
			array('sp_tag, app_name, remote_server, user_agent', 'length', 'max'=>255),
			array('app_id', 'length', 'max'=>20),
			array('app_status, is_active', 'length', 'max'=>1),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('sno, sp_tag, app_id, app_name, app_fields, app_status, user_id, created_on, updated_on, is_active, remote_server, user_agent', 'safe', 'on'=>'search'),
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
			'sno' => 'Sno',
			'sp_tag' => 'Sp Tag',
			'app_id' => 'App',
			'app_name' => 'App Name',
			'app_fields' => 'App Fields',
			'app_status' => 'App Status',
			'user_id' => 'User',
			'created_on' => 'Created On',
			'updated_on' => 'Updated On',
			'is_active' => 'Is Active',
			'remote_server' => 'Remote Server',
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

		$criteria->compare('sno',$this->sno);
		$criteria->compare('sp_tag',$this->sp_tag,true);
		$criteria->compare('app_id',$this->app_id,true);
		$criteria->compare('app_name',$this->app_name,true);
		$criteria->compare('app_fields',$this->app_fields,true);
		$criteria->compare('app_status',$this->app_status,true);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('created_on',$this->created_on,true);
		$criteria->compare('updated_on',$this->updated_on,true);
		$criteria->compare('is_active',$this->is_active,true);
		$criteria->compare('remote_server',$this->remote_server,true);
		$criteria->compare('user_agent',$this->user_agent,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return SpApplications the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
