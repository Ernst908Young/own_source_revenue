<?php

/**
 * This is the model class for table "bo_sp_applications".
 *
 * The followings are the available columns in table 'bo_sp_applications':
 * @property integer $sno
 * @property string $sp_tag
 * @property integer $sp_app_id
 * @property string $app_id
 * @property string $app_name
 * @property string $app_fields
 * @property string $app_status
 * @property string $app_comments
 * @property string $app_distt
 * @property string $app_distt_name
 * @property string $app_location
 * @property string $is_applied_by_caf
 * @property string $caf_id
 * @property string $unit_name
 * @property string $reverted_call_back_url
 * @property string $print_app_call_back_url
 * @property string $download_certificate_call_back_url
 * @property integer $user_id
 * @property string $created_on
 * @property string $updated_on
 * @property string $is_active
 * @property string $remote_server
 * @property string $user_agent
 * @property string $param_1
 * @property string $param_2
 * @property string $param_3
 * @property string $param_4
 * @property string $param_5
 * @property string $created_date_time
 * @property string $last_updated_date_time
 *
 * The followings are the available model relations:
 * @property SpApplicationHistory[] $spApplicationHistories
 * @property ApplicationSubmission $caf
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
			array('sp_tag, app_id, app_name, app_status, user_id, created_on, is_active, remote_server, user_agent', 'required'),
			array('sp_app_id, user_id', 'numerical', 'integerOnly'=>true),
			array('sp_tag, app_name, unit_name, remote_server, user_agent, param_2, param_3, param_4, param_5', 'length', 'max'=>255),
			array('app_id, param_1', 'length', 'max'=>20),
			array('app_status', 'length', 'max'=>3),
			array('app_distt', 'length', 'max'=>200),
			array('app_distt_name, app_location', 'length', 'max'=>150),
			array('is_applied_by_caf, is_active', 'length', 'max'=>1),
			array('caf_id', 'length', 'max'=>10),
			array('app_fields, app_comments, reverted_call_back_url, print_app_call_back_url, download_certificate_call_back_url, created_date_time, last_updated_date_time, noe', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			//Rahul Kumar : added assigned_to parameters at 25-10-2018 
			array('sno, sp_tag, sp_app_id, app_id, app_name, app_fields, app_status, app_comments, app_distt, app_distt_name, app_location, is_applied_by_caf, caf_id, unit_name, reverted_call_back_url, print_app_call_back_url, download_certificate_call_back_url, user_id, created_on, updated_on, is_active, remote_server, user_agent, param_1, param_2, param_3, param_4, param_5, created_date_time, assigned_to, circle_id,noe, last_updated_date_time', 'safe', 'on'=>'search'),
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
			'spApplicationHistories' => array(self::HAS_MANY, 'SpApplicationHistory', 'sp_app_id'),
			'caf' => array(self::BELONGS_TO, 'ApplicationSubmission', 'caf_id'),
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
			'sp_app_id' => 'Sp App',
			'app_id' => 'App',
			'app_name' => 'App Name',
			'app_fields' => 'App Fields',
			'app_status' => 'App Status',
			'app_comments' => 'App Comments',
			'app_distt' => 'App Distt',
			'app_distt_name' => 'App Distt Name',
			'app_location' => 'App Location',
			'is_applied_by_caf' => 'Is Applied By Caf',
			'caf_id' => 'Caf',
			'circle_id' => 'Circle',
			'unit_name' => 'Unit Name',
			'reverted_call_back_url' => 'Reverted Call Back Url',
			'print_app_call_back_url' => 'Print App Call Back Url',
			'download_certificate_call_back_url' => 'Download Certificate Call Back Url',
			'user_id' => 'User',
			'created_on' => 'Created On',
			'updated_on' => 'Updated On',
			'is_active' => 'Is Active',
			'remote_server' => 'Remote Server',
			'user_agent' => 'User Agent',
			'param_1' => 'Param 1',
			'param_2' => 'Param 2',
			'param_3' => 'Param 3',
			'param_4' => 'Param 4',
			'param_5' => 'Param 5',
			'created_date_time' => 'Created Date Time',
			'last_updated_date_time' => 'Last Updated Date Time',
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
		$criteria->compare('sp_app_id',$this->sp_app_id);
		$criteria->compare('app_id',$this->app_id,true);
		$criteria->compare('app_name',$this->app_name,true);
		$criteria->compare('app_fields',$this->app_fields,true);
		$criteria->compare('app_status',$this->app_status,true);
		$criteria->compare('app_comments',$this->app_comments,true);
		$criteria->compare('app_distt',$this->app_distt,true);
		$criteria->compare('app_distt_name',$this->app_distt_name,true);
		$criteria->compare('app_location',$this->app_location,true);
		$criteria->compare('is_applied_by_caf',$this->is_applied_by_caf,true);
		$criteria->compare('caf_id',$this->caf_id,true);
		$criteria->compare('unit_name',$this->unit_name,true);
		$criteria->compare('reverted_call_back_url',$this->reverted_call_back_url,true);
		$criteria->compare('print_app_call_back_url',$this->print_app_call_back_url,true);
		$criteria->compare('download_certificate_call_back_url',$this->download_certificate_call_back_url,true);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('created_on',$this->created_on,true);
		$criteria->compare('updated_on',$this->updated_on,true);
		$criteria->compare('is_active',$this->is_active,true);
		$criteria->compare('remote_server',$this->remote_server,true);
		$criteria->compare('user_agent',$this->user_agent,true);
		$criteria->compare('param_1',$this->param_1,true);
		$criteria->compare('param_2',$this->param_2,true);
		$criteria->compare('param_3',$this->param_3,true);
		$criteria->compare('param_4',$this->param_4,true);
		$criteria->compare('param_5',$this->param_5,true);
		$criteria->compare('created_date_time',$this->created_date_time,true);
		$criteria->compare('last_updated_date_time',$this->last_updated_date_time,true);

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
