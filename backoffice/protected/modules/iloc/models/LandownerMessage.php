<?php

/**
 * This is the model class for table "bo_landowner_message".
 *
 * The followings are the available columns in table 'bo_landowner_message':
 * @property integer $id
 * @property string $land_id
 * @property string $from_user
 * @property integer $to_user
 * @property integer $is_lease
 * @property integer $from_user_type
 * @property string  $to_user_type
 * @property integer $message
 * @property integer $is_seen
 * @property string $is_deleted
 * @property string $created_date
 * @property string $updated_date
 
 */
 
class LandownerMessage extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'bo_landowner_message';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array(' land_id, from_user, to_user, message, remote_ip, user_agent, created_date', 'required'),
			array('is_deleted, is_seen, land_id', 'numerical', 'integerOnly'=>true),
			array('from_user, to_user, from_user_type, to_user_type', 'length', 'max'=>10),
			array('user_agent', 'length', 'max'=>255),
			array('is_deleted, is_seen', 'length', 'max'=>1),
			array('updated_date', 'safe'),
			array('remote_ip', 'length', 'max'=>50),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, from_user, to_user, land_id, from_user_type, to_user_type, is_deleted, created_date, updated_date', 'safe', 'on'=>'search'),
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
			'id'        => 'ID',
			'land_id'   => 'Land Id',
			'from_user' => 'From',
			'to_user'   => 'To',
			'from_user_type' => 'From User Type',
			'to_user_type'   => 'To User Type',
			'message'        => 'Message',
			'is_seen'        => 'Is Seen',
			'is_deleted'     => 'Is Deleted',
			'created_date'   => 'Created Date',
			'updated_date'   => 'Modified Date',
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
		$criteria->compare('land_id',$this->land_id,true);
		$criteria->compare('user_from',$this->user_from,true);
		$criteria->compare('user_to',$this->user_to);
		$criteria->compare('from_user_type',$this->from_user_type);
		$criteria->compare('to_user_type',$this->to_user_type);
		$criteria->compare('message',$this->message,true);
		$criteria->compare('is_deleted',$this->is_deleted);
		$criteria->compare('created_date',$this->created_date,true);
		$criteria->compare('updated_date',$this->updated_date,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return LandownerConnect the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
