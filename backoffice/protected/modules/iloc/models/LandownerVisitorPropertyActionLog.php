<?php

/**
 * This is the model class for table "bo_landowner_visitor_property_action_log".
 *
 * The followings are the available columns in table 'bo_landowner_visitor_property_action_log':
 * @property integer $id
 * @property string $user_id
 * @property integer $land_id
 * @property string $viewed
 * @property string $intrested
 * @property string $is_reported
 * @property string $comment
 * @property string $user_agent
 * @property string $ip_address
 * @property string $created
 */
class LandownerVisitorPropertyActionLog extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'bo_landowner_visitor_property_action_log';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('land_id, user_agent, ip_address, created', 'required'),
			array('land_id', 'numerical', 'integerOnly'=>true),
			array('user_id, ip_address', 'length', 'max'=>255),
			array('viewed, intrested, is_reported', 'length', 'max'=>1),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, user_id, land_id, viewed, intrested, is_reported, comment, user_agent, ip_address, created', 'safe', 'on'=>'search'),
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
			'viewed' => 'Viewed',
			'intrested' => 'Intrested',
			'is_reported' => 'Is Reported',
			'comment' => 'Comment',
			'user_agent' => 'User Agent',
			'ip_address' => 'Ip Address',
			'created' => 'Created',
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
		$criteria->compare('user_id',$this->user_id,true);
		$criteria->compare('land_id',$this->land_id);
		$criteria->compare('viewed',$this->viewed,true);
		$criteria->compare('intrested',$this->intrested,true);
		$criteria->compare('is_reported',$this->is_reported,true);
		$criteria->compare('comment',$this->comment,true);
		$criteria->compare('user_agent',$this->user_agent,true);
		$criteria->compare('ip_address',$this->ip_address,true);
		$criteria->compare('created',$this->created,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return LandownerVisitorPropertyActionLog the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
