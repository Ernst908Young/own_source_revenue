<?php

/**
 * This is the model class for table "bo_cdn_master".
 *
 * The followings are the available columns in table 'bo_cdn_master':
 * @property string $doc_id
 * @property string $doc_name
 * @property string $doc_type
 * @property string $doc_max_size
 * @property string $doc_min_size
 * @property string $doc_created_on
 * @property string $is_doc_active
 * @property string $remote_ip
 * @property string $user_agent
 *
 * The followings are the available model relations:
 * @property ApplicationCdnMapping[] $applicationCdnMappings
 * @property CdnDms[] $cdnDms
 */
class CdnMaster extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'bo_cdn_master';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('doc_name, doc_type, doc_max_size, doc_min_size, doc_created_on, remote_ip, user_agent', 'required'),
			array('doc_name, remote_ip, user_agent', 'length', 'max'=>255),
			array('doc_type', 'length', 'max'=>10),
			array('doc_max_size, doc_min_size', 'length', 'max'=>20),
			array('is_doc_active', 'length', 'max'=>1),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('doc_id, doc_name, doc_type, doc_max_size, doc_min_size, doc_created_on, is_doc_active, remote_ip, user_agent', 'safe', 'on'=>'search'),
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
			'applicationCdnMappings' => array(self::HAS_MANY, 'ApplicationCdnMapping', 'doc_id'),
			'cdnDms' => array(self::HAS_MANY, 'CdnDms', 'doc_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'doc_id' => 'Doc',
			'doc_name' => 'Doc Name',
			'doc_type' => 'Doc Type',
			'doc_max_size' => 'Doc Max Size',
			'doc_min_size' => 'Doc Min Size',
			'doc_created_on' => 'Doc Created On',
			'is_doc_active' => 'Is Doc Active',
			'remote_ip' => 'Remote Ip',
			'user_agent' => 'User Agent',
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

		$criteria->compare('doc_id',$this->doc_id,true);
		$criteria->compare('doc_name',$this->doc_name,true);
		$criteria->compare('doc_type',$this->doc_type,true);
		$criteria->compare('doc_max_size',$this->doc_max_size,true);
		$criteria->compare('doc_min_size',$this->doc_min_size,true);
		$criteria->compare('doc_created_on',$this->doc_created_on,true);
		$criteria->compare('is_doc_active',$this->is_doc_active,true);
		$criteria->compare('remote_ip',$this->remote_ip,true);
		$criteria->compare('user_agent',$this->user_agent,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return CdnMaster the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
