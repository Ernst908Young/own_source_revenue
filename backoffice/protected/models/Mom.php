<?php

/**
 * This is the model class for table "bo_mom".
 *
 * The followings are the available columns in table 'bo_mom':
 * @property integer $mom_id
 * @property string $caf_id
 * @property string $company_name
 * @property string $mom_date
 * @property string $status
 * @property string $mom_description
 * @property string $created_time
 * @property string $ip_address
 * @property string $user_agent
 *
 * The followings are the available model relations:
 * @property ApplicationSubmission $caf
 */
class Mom extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'bo_mom';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('caf_id, company_name, mom_date, status, mom_description, created_time, ip_address, user_agent', 'required'),
			array('caf_id', 'length', 'max'=>10),
			array('company_name, ip_address, user_agent', 'length', 'max'=>255),
			array('status', 'length', 'max'=>13),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('mom_id, caf_id, company_name, mom_date, status, mom_description, created_time, ip_address, user_agent', 'safe', 'on'=>'search'),
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
			'caf' => array(self::BELONGS_TO, 'ApplicationSubmission', 'caf_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'mom_id' => 'Mom',
			'caf_id' => 'Caf',
			'company_name' => 'Company Name',
			'mom_date' => 'Mom Date',
			'status' => 'Status',
			'mom_description' => 'Mom Description',
			'created_time' => 'Created Time',
			'ip_address' => 'Ip Address',
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

		$criteria->compare('mom_id',$this->mom_id);
		$criteria->compare('caf_id',$this->caf_id,true);
		$criteria->compare('company_name',$this->company_name,true);
		$criteria->compare('mom_date',$this->mom_date,true);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('mom_description',$this->mom_description,true);
		$criteria->compare('created_time',$this->created_time,true);
		$criteria->compare('ip_address',$this->ip_address,true);
		$criteria->compare('user_agent',$this->user_agent,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Mom the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
