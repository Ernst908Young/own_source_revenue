<?php

/**
 * This is the model class for table "bo_landowner_contact_log".
 *
 * The followings are the available columns in table 'bo_landowner_contact_log':
 * @property integer $id
 * @property integer $user_id
 * @property integer $land_id
 * @property string $contact_type
 * @property string $owner_name
 * @property string $owner_contact_no
 * @property string $owner_alternate_no
 * @property string $owner_email
 * @property string $agent_name
 * @property string $agent_contact_no
 * @property string $agent_alternate_no
 * @property string $agent_email
 * @property string $is_active
 * @property string $remote_ip
 * @property string $user_agent
 * @property string $created
 * @property string $modified
 */
class BoLandownerContactLog extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'bo_landowner_contact_log';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('land_id, contact_type, owner_name, owner_contact_no', 'required'),
			array('user_id, land_id', 'numerical', 'integerOnly'=>true),
			array('contact_type', 'length', 'max'=>12),
			array('owner_name, owner_email, agent_name, agent_email, user_agent', 'length', 'max'=>255),
			array('owner_contact_no, owner_alternate_no, agent_contact_no, agent_alternate_no', 'length', 'max'=>10),
			array('is_active', 'length', 'max'=>1),
			array('remote_ip', 'length', 'max'=>50),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, user_id, land_id, contact_type, owner_name, owner_contact_no, owner_alternate_no, owner_email, agent_name, agent_contact_no, agent_alternate_no, agent_email, is_active, created, modified', 'safe', 'on'=>'search'),
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
			'id' => 'ID',
			'user_id' => 'User',
			'land_id' => 'Land',
			'contact_type' => 'Contact Type',
			'owner_name' => 'Owner Name',
			'owner_contact_no' => 'Owner Contact No',
			'owner_alternate_no' => 'Owner Alternate No',
			'owner_email' => 'Owner Email',
			'agent_name' => 'Agent Name',
			'agent_contact_no' => 'Agent Contact No',
			'agent_alternate_no' => 'Agent Alternate No',
			'agent_email' => 'Agent Email',
			'is_active' => 'Is Active',
			'remote_ip' => 'Remote Ip',
			'user_agent' => 'User Agent',
			'created' => 'Created',
			'modified' => 'Modified',
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
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('land_id',$this->land_id);
		$criteria->compare('contact_type',$this->contact_type,true);
		$criteria->compare('owner_name',$this->owner_name,true);
		$criteria->compare('owner_contact_no',$this->owner_contact_no,true);
		$criteria->compare('owner_alternate_no',$this->owner_alternate_no,true);
		$criteria->compare('owner_email',$this->owner_email,true);
		$criteria->compare('agent_name',$this->agent_name,true);
		$criteria->compare('agent_contact_no',$this->agent_contact_no,true);
		$criteria->compare('agent_alternate_no',$this->agent_alternate_no,true);
		$criteria->compare('agent_email',$this->agent_email,true);
		$criteria->compare('is_active',$this->is_active,true);
		$criteria->compare('created',$this->created,true);
		$criteria->compare('modified',$this->modified,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return BoLandownerContactLog the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
