<?php

/**
 * This is the model class for table "supportmain".
 *
 * The followings are the available columns in table 'supportmain':
 * @property integer $id
 * @property integer $querycode 
  * @property string $query_type
 * @property string $servicecategory
 * @property string $mobile_no
 * @property string $email
 * @property string $service_id
 * @property string $user_id
 * @property string $querypriority
 * @property string $subject
 * @property string $status  default 1 set 1 for open 0 for closed
 * @property string $created_on
 */
class Querymain extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'querymain';
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
		
				array('email', 'length', 'max'=>100),
			array('subject', 'length', 'max'=>300),
			array('querycode, servicecategory, service_id, user_id, querypriority, subject, status, created_on,mobile_no,query_type', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, querycode, servicecategory, service_id, user_id, querypriority, subject, status, created_on', 'safe', 'on'=>'search'),
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
			'querycode' => 'querycode',
			'servicecategory' => 'servicecategory',
			'mobile_no' => 'Mobile',
			'email'=>'Email ID',
			'service_id' => 'service_id ',
			'user_id' => 'user_id ',
			'querypriority' => 'querypriority',
			'subject' => 'subject',
			'status'=>'status',
			'created_on' => 'created_on',
			
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
		$criteria->compare('querycode',$this->querycode,true);
		$criteria->compare('servicecategory',$this->servicecategory,true);
		$criteria->compare('service_id',$this->service_id,true);
		$criteria->compare('user_id',$this->user_id,true);
		$criteria->compare('querypriority',$this->querypriority,true);
		$criteria->compare('subject',$this->subject,true);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('created_on',$this->created_on,true);
			$criteria->compare('query_type',$this->query_type,true);
		
	
		
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
		$catarry = array('business_name_services'=>'Name Related Services','incorporation_services'=>'Incorporation Services','continuance_services'=>'Continuance Services','amalgamation_services'=>'Amalgamation Services','closure_service'=>'Clousre Services','Other'=>'Other');

		return $catarry[$cat];

	}
}
