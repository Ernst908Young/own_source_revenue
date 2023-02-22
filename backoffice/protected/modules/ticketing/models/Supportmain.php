<?php

/**
 * This is the model class for table "supportmain".
 *
 * The followings are the available columns in table 'supportmain':
 * @property integer $supportmaincode
 * @property integer $supporttypecode 
 * @property string $servicecategory
 * @property string $usercode
 * @property string $supportprioritycode
 * @property string $subject
 * @property string $status  default 1 set 1 for open 0 for closed
 * @property string $service_id
 * @property string $srn_app_id
 * @property string $created_on
 */
class Supportmain extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'supportmain';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			//array('service_id, page_name', 'required'),		
			array('subject', 'length', 'max'=>300),
			array('servicecategory, usercode, supportprioritycode, status, service_id, srn_app_id, created_on,ticket_type,filepath,currently_assign_to, user_type', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('supportmaincode, subject, servicecategory, usercode, supportprioritycode, status, service_id, srn_app_id', 'safe', 'on'=>'search'),
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
			'supportmaincode' => 'Supportmaincode',
			'supporttypecode' => 'Supporttypecode',
			'servicecategory' => 'Servicecategory ',
			'usercode' => 'Usercode ',
			'supportprioritycode' => 'Supportprioritycode',
			'subject' => 'Subject',
			'status'=>'Status',
			'service_id' => 'Service_id',
			'srn_app_id' => 'SRN Application ID',
			'created_on' =>'Created On'
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

		$criteria->compare('supportmaincode',$this->supportmaincode);
		$criteria->compare('supporttypecode',$this->supporttypecode,true);
		$criteria->compare('servicecategory',$this->servicecategory,true);
		$criteria->compare('usercode',$this->usercode,true);
		$criteria->compare('supportprioritycode',$this->supportprioritycode,true);
		$criteria->compare('subject',$this->subject,true);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('service_id',$this->service_id,true);
		$criteria->compare('srn_app_id',$this->srn_app_id,true);
		$criteria->compare('created_on',$this->created_on,true);
		
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return BoInfowizPageMaster the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public static function Getservicecatlabel($cat){
		$catarry = array('business_name_services'=>'Business Name Services','incorporation_services'=>'Incorporation Services','continuance_services'=>'Continuance Services','amalgamation_services'=>'Amalgamation Services','closure_service'=>'Clousre Services','Other'=>'Other');

		return $catarry[$cat];

	}
}
