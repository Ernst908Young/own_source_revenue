<?php

/**
 * This is the model class for table "bo_offline_applications_payment".
 *
 * The followings are the available columns in table 'bo_offline_applications_payment':
 * @property string $id
 * @property string $first_name
 * @property string $middle_name
 * @property string $surname
 * @property string $mobile
 * @property double $email
 * @property string $user_id
 * @property string $company_id
 * @property string $created_on
 * @property string $is_active
 *
 * The followings are the available model relations:
 * @property OfflineApplications $offlineApplication
 */
class AgentServiceProvider extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'agent_service_provider';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
						
			array('first_name, middle_name, surname, service_provider_type, pin_code', 'length', 'max'=>50),
			array('entity_name, entity_type', 'length', 'max'=>200),
			array('city_name, entity_type', 'length', 'max'=>200),
			
			array('email, gender, sp_type, sp_status, action_date, action_type, date_of', 'length', 'max'=>50),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('mobile,user_id, company_id, created_on, is_active, activation_key, address_line1, address_line2, country_id, state_id, is_revoke, agent_user_id, revoke_reason, revoke_by, is_first_entry, app_entity_type_id, match_date, late_fee, file_path, key_expired_on, file_path_2', 'safe'),
			
			array('first_name, middle_name, surname, email, mobile,user_id, company_id, created_on, is_active', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
/*	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'offlineApplication' => array(self::BELONGS_TO, 'OfflineApplications', 'offline_application_id'),
		);
	}*/

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'id',
			'first_name' => 'first_name ',
			'middle_name' => 'middle_name ',
			'surname' => ' surname',
			'mobile' => 'mobile ',
			'email' => 'email',
			'user_id' => 'user_id ',
			'company_id' => 'company_id ',
			'created_on' => 'created_on ',
			'is_active' => 'is_active ',
		
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

		$criteria->compare('id',$this->id,true);
		$criteria->compare('first_name',$this->first_name,true);
		$criteria->compare('middle_name',$this->middle_name,true);
		$criteria->compare('surname',$this->surname,true);
		$criteria->compare('mobile',$this->mobile,true);
		$criteria->compare('email',$this->email);
		$criteria->compare('user_id',$this->user_id,true);
		$criteria->compare('company_id',$this->company_id,true);
		$criteria->compare('created_on',$this->created_on,true);
		$criteria->compare('is_active',$this->is_active,true);
	

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return BoOfflineApplicationsPayment the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
