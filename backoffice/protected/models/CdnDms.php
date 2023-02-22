<?php

/**
 * This is the model class for table "bo_cdn_dms".
 *
 * The followings are the available columns in table 'bo_cdn_dms':
 * @property integer $dms_id
 * @property string $dms_bucket_id
 * @property string $dms_user_id
 * @property string $field_id
 * @property string $dms_file_name
 * @property string $dms_file_type
 * @property string $dms_file_status
 * @property string $created_on
 * @property string $user_agent
 * @property string $remtoe_ip
 * @property string $is_active
 *
 * The followings are the available model relations:
 * @property Filelds $field
 */
class CdnDms extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'bo_cdn_dms';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('dms_bucket_id, dms_user_id, field_id, dms_file_name, dms_file_type, dms_file_status, created_on, user_agent, remtoe_ip', 'required'),
			array('dms_bucket_id, dms_file_name, user_agent, remtoe_ip', 'length', 'max'=>255),
			array('dms_user_id', 'length', 'max'=>20),
			array('field_id', 'length', 'max'=>10),
			array('dms_file_type', 'length', 'max'=>5),
			array('dms_file_status, is_active', 'length', 'max'=>1),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('dms_id, dms_bucket_id, dms_user_id, field_id, dms_file_name, dms_file_type, dms_file_status, created_on, user_agent, remtoe_ip, is_active', 'safe', 'on'=>'search'),
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
			'field' => array(self::BELONGS_TO, 'Filelds', 'field_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'dms_id' => 'Dms',
			'dms_bucket_id' => 'Dms Bucket',
			'dms_user_id' => 'Dms User',
			'field_id' => 'Field',
			'dms_file_name' => 'Dms File Name',
			'dms_file_type' => 'Dms File Type',
			'dms_file_status' => 'Dms File Status',
			'created_on' => 'Created On',
			'user_agent' => 'User Agent',
			'remtoe_ip' => 'Remtoe Ip',
			'is_active' => 'Is Active',
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

		$criteria->compare('dms_id',$this->dms_id);
		$criteria->compare('dms_bucket_id',$this->dms_bucket_id,true);
		$criteria->compare('dms_user_id',$this->dms_user_id,true);
		$criteria->compare('field_id',$this->field_id,true);
		$criteria->compare('dms_file_name',$this->dms_file_name,true);
		$criteria->compare('dms_file_type',$this->dms_file_type,true);
		$criteria->compare('dms_file_status',$this->dms_file_status,true);
		$criteria->compare('created_on',$this->created_on,true);
		$criteria->compare('user_agent',$this->user_agent,true);
		$criteria->compare('remtoe_ip',$this->remtoe_ip,true);
		$criteria->compare('is_active',$this->is_active,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return CdnDms the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
