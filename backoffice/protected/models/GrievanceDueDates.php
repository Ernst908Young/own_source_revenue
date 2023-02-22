<?php

/**
 * This is the model class for table "bo_grievance_due_dates".
 *
 * The followings are the available columns in table 'bo_grievance_due_dates':
 * @property integer $sno
 * @property string $grievance_id
 * @property string $due_date
 * @property string $added_by
 * @property string $added_date_time
 * @property string $user_agent
 * @property string $remote_address
 *
 * The followings are the available model relations:
 * @property Grievance $grievance
 * @property User $addedBy
 */
class GrievanceDueDates extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'bo_grievance_due_dates';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('grievance_id, due_date, added_by, added_date_time, user_agent, remote_address', 'required'),
			array('grievance_id, added_by', 'length', 'max'=>10),
			array('user_agent', 'length', 'max'=>300),
			array('remote_address', 'length', 'max'=>250),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('sno, grievance_id, due_date, added_by, added_date_time, user_agent, remote_address', 'safe', 'on'=>'search'),
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
			'addedBy' => array(self::BELONGS_TO, 'User', 'added_by'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'sno' => 'Sno',
			'grievance_id' => 'Grievance',
			'due_date' => 'Due Date',
			'added_by' => 'Added By',
			'added_date_time' => 'Added Date Time',
			'user_agent' => 'User Agent',
			'remote_address' => 'Remote Address',
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
		$criteria->compare('grievance_id',$this->grievance_id,true);
		$criteria->compare('due_date',$this->due_date,true);
		$criteria->compare('added_by',$this->added_by,true);
		$criteria->compare('added_date_time',$this->added_date_time,true);
		$criteria->compare('user_agent',$this->user_agent,true);
		$criteria->compare('remote_address',$this->remote_address,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return GrievanceDueDates the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
