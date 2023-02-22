<?php

/**
 * This is the model class for table "bo_grievance_ticket_detail".
 *
 * The followings are the available columns in table 'bo_grievance_ticket_detail':
 * @property integer $id
 * @property string $grievance_id
 * @property integer $caff_id
 * @property string $user_id
 * @property string $type
 * @property string reffrence number
 * @property string $user_agent
 *
 * The followings are the available model relations:
 * @property Grievance $grievance
 * @property GrievanceTopicMaster $topic
 * @property SsoUsers $user
 */
class GrievanceForDetail extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'bo_grievance_for_detail';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('grievance_id, caf_id, user_id, ref_number, created_date_time,type', 'required'),
			array('caf_id', 'numerical', 'integerOnly'=>true),
			array('grievance_id, user_id', 'length', 'max'=>10),
			array('ref_number', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, grievance_id, caf_id, user_id, ref_number, created_date_time', 'safe', 'on'=>'search'),
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
			'grievance' => array(self::BELONGS_TO, 'Grievance', 'grievance_id'),
			'caf' => array(self::BELONGS_TO, 'ApplicationSubmission', 'submission_id'),
			'user' => array(self::BELONGS_TO, 'SsoUsers', 'user_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'grievance_id' => 'Grievance',
			'caf_id' => 'CAF ID',
			'type' => 'Type',
			'user_id' => 'User',
			'ref_number' => 'Reffrence Number',
			'created_date_time' => 'Created Date Time',
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
		$criteria->compare('grievance_id',$this->grievance_id,true);
		$criteria->compare('caf_id',$this->caf_id);
		$criteria->compare('user_id',$this->user_id,true);
		$criteria->compare('ref_number',$this->ref_number,true);
		$criteria->compare('created_date_time',$this->created_date_time,true);
		$criteria->compare('type',$this->type,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return GrievanceFortDetail the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
