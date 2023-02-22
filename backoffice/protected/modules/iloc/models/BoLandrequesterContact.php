<?php

/**
 * This is the model class for table "bo_landrequester_contact".
 *
 * The followings are the available columns in table 'bo_landrequester_contact':
 * @property integer $id
 * @property integer $user_id
 * @property integer $land_id
 * @property string $contact_type
 * @property string $requester_name
 * @property string $requester_contact_no
 * @property string $requester_alternate_no
 * @property string $requester_email
 * @property string $agent_name
 * @property string $agent_contact_no
 * @property string $agent_alternate_no
 * @property string $agent_email
 * @property string $is_active
 * @property string $created
 * @property string $modified
 */
class BoLandrequesterContact extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'bo_landowner_requester_contact';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('land_id, contact_type, requester_name, requester_contact_no', 'required'),
			array('user_id, land_id', 'numerical', 'integerOnly'=>true),
			array('contact_type', 'length', 'max'=>12),
			array('requester_name, requester_email, agent_name, agent_email', 'length', 'max'=>255),
			array('requester_contact_no, requester_alternate_no, agent_contact_no, agent_alternate_no', 'length', 'max'=>10),
			array('is_active', 'length', 'max'=>1),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, user_id, land_id, contact_type, requester_name, requester_contact_no, requester_alternate_no, requester_email, agent_name, agent_contact_no, agent_alternate_no, agent_email, is_active, created, modified', 'safe', 'on'=>'search'),
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
			'requester_name' => 'Requester Name',
			'requester_contact_no' => 'Requester Contact No',
			'requester_alternate_no' => 'Requester Alternate No',
			'requester_email' => 'Requester Email',
			'agent_name' => 'Agent Name',
			'agent_contact_no' => 'Agent Contact No',
			'agent_alternate_no' => 'Agent Alternate No',
			'agent_email' => 'Agent Email',
			'is_active' => 'Is Active',
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
		$criteria->compare('requester_name',$this->requester_name,true);
		$criteria->compare('requester_contact_no',$this->requester_contact_no,true);
		$criteria->compare('requester_alternate_no',$this->requester_alternate_no,true);
		$criteria->compare('requester_email',$this->requester_email,true);
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
	 * @return BoLandrequesterContact the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
