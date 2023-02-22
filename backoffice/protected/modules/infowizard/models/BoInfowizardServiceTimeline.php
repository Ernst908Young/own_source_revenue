<?php

/**
 * This is the model class for table "bo_infowizard_service_timeline".
 *
 * The followings are the available columns in table 'bo_infowizard_service_timeline':
 * @property integer $id
 * @property integer $service_id
 * @property string $service_type
 * @property string $servicetype_additionalsubservice
 * @property string $deemed_approval
 * @property string $yes_deemed
 * @property string $go_notification
 * @property string $gov_act
 * @property string $gov_act_first_appellate
 * @property string $gov_act_first
 * @property string $gov_act_second_appellate
 * @property string $gov_act_second
 * @property string $uksw_act
 * @property string $uksw_act_first_appellate
 * @property string $uksw_act_first
 * @property string $uksw_act_second_appellate
 * @property string $uksw_act_second
 * @property string $ukrts_act
 * @property string $ukrts_act_first_appellate
 * @property string $ukrts_act_first
 * @property string $ukrts_act_second_appellate
 * @property string $ukrts_act_second
 * @property string $comment
 * @property string $created
 * @property string $modified
 */
class BoInfowizardServiceTimeline extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'bo_infowizard_service_timeline';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('service_id, service_type, deemed_approval, created', 'required'),
			array('service_id', 'numerical', 'integerOnly'=>true),
			array('service_type, servicetype_additionalsubservice, yes_deemed, gov_act_first_appellate, gov_act_second_appellate, uksw_act_first_appellate, uksw_act_second_appellate, ukrts_act_first_appellate, ukrts_act_second_appellate, comment', 'length', 'max'=>255),
			array('deemed_approval', 'length', 'max'=>1),
			array('go_notification, gov_act, gov_act_first, gov_act_second, uksw_act, uksw_act_first, uksw_act_second, ukrts_act, ukrts_act_first, ukrts_act_second, modified', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, service_id, service_type, servicetype_additionalsubservice, deemed_approval, yes_deemed, go_notification, gov_act, gov_act_first_appellate, gov_act_first, gov_act_second_appellate, gov_act_second, uksw_act, uksw_act_first_appellate, uksw_act_first, uksw_act_second_appellate, uksw_act_second, ukrts_act, ukrts_act_first_appellate, ukrts_act_first, ukrts_act_second_appellate, ukrts_act_second, comment, created, modified', 'safe', 'on'=>'search'),
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
			'service_id' => 'Service',
			'service_type' => 'Service Type',
			'servicetype_additionalsubservice' => 'Servicetype Additionalsubservice',
			'deemed_approval' => 'Deemed Approval',
			'yes_deemed' => 'Yes Deemed',
			'go_notification' => 'Go Notification',
			'gov_act' => 'Gov Act',
			'gov_act_first_appellate' => 'Gov Act First Appellate',
			'gov_act_first' => 'Gov Act First',
			'gov_act_second_appellate' => 'Gov Act Second Appellate',
			'gov_act_second' => 'Gov Act Second',
			'uksw_act' => 'Uksw Act',
			'uksw_act_first_appellate' => 'Uksw Act First Appellate',
			'uksw_act_first' => 'Uksw Act First',
			'uksw_act_second_appellate' => 'Uksw Act Second Appellate',
			'uksw_act_second' => 'Uksw Act Second',
			'ukrts_act' => 'Ukrts Act',
			'ukrts_act_first_appellate' => 'Ukrts Act First Appellate',
			'ukrts_act_first' => 'Ukrts Act First',
			'ukrts_act_second_appellate' => 'Ukrts Act Second Appellate',
			'ukrts_act_second' => 'Ukrts Act Second',
			'comment' => 'Comment',
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
		$criteria->compare('service_id',$this->service_id);
		$criteria->compare('service_type',$this->service_type,true);
		$criteria->compare('servicetype_additionalsubservice',$this->servicetype_additionalsubservice,true);
		$criteria->compare('deemed_approval',$this->deemed_approval,true);
		$criteria->compare('yes_deemed',$this->yes_deemed,true);
		$criteria->compare('go_notification',$this->go_notification,true);
		$criteria->compare('gov_act',$this->gov_act,true);
		$criteria->compare('gov_act_first_appellate',$this->gov_act_first_appellate,true);
		$criteria->compare('gov_act_first',$this->gov_act_first,true);
		$criteria->compare('gov_act_second_appellate',$this->gov_act_second_appellate,true);
		$criteria->compare('gov_act_second',$this->gov_act_second,true);
		$criteria->compare('uksw_act',$this->uksw_act,true);
		$criteria->compare('uksw_act_first_appellate',$this->uksw_act_first_appellate,true);
		$criteria->compare('uksw_act_first',$this->uksw_act_first,true);
		$criteria->compare('uksw_act_second_appellate',$this->uksw_act_second_appellate,true);
		$criteria->compare('uksw_act_second',$this->uksw_act_second,true);
		$criteria->compare('ukrts_act',$this->ukrts_act,true);
		$criteria->compare('ukrts_act_first_appellate',$this->ukrts_act_first_appellate,true);
		$criteria->compare('ukrts_act_first',$this->ukrts_act_first,true);
		$criteria->compare('ukrts_act_second_appellate',$this->ukrts_act_second_appellate,true);
		$criteria->compare('ukrts_act_second',$this->ukrts_act_second,true);
		$criteria->compare('comment',$this->comment,true);
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
	 * @return BoInfowizardServiceTimeline the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
