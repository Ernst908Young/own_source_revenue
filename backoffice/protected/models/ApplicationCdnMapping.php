<?php

/**
 * This is the model class for table "bo_application_cdn_mapping".
 *
 * The followings are the available columns in table 'bo_application_cdn_mapping':
 * @property integer $map_id
 * @property string $application_id
 * @property string $doc_id
 * @property string $is_mapping_active
 * @property string $remote_server
 * @property string $mapping_created_on
 * @property string $user_agent
 *
 * The followings are the available model relations:
 * @property Applications $application
 * @property CdnMaster $doc
 */
class ApplicationCdnMapping extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'bo_application_cdn_mapping';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('application_id, doc_id, remote_server, mapping_created_on, user_agent', 'required'),
			//array('application_id, doc_id','unique','message'=>'Some/All Documents Already Mapped with application. Please check','on'=>'create'),
			array('application_id, doc_id', 'required','on'=>'creat'),
			array('application_id, doc_id', 'length', 'max'=>10),
			array('is_mapping_active', 'length', 'max'=>1),
			array('remote_server, user_agent', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('map_id, application_id, doc_id, is_mapping_active, remote_server, mapping_created_on, user_agent', 'safe', 'on'=>'search'),
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
			'application' => array(self::BELONGS_TO, 'Applications', 'application_id'),
			'doc' => array(self::BELONGS_TO, 'CdnMaster', 'doc_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'map_id' => 'Map',
			'application_id' => 'Application',
			'doc_id' => 'Doc',
			'is_mapping_active' => 'Is Mapping Active',
			'remote_server' => 'Remote Server',
			'mapping_created_on' => 'Mapping Created On',
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

		$criteria->compare('map_id',$this->map_id);
		$criteria->compare('application_id',$this->application_id,true);
		$criteria->compare('doc_id',$this->doc_id,true);
		$criteria->compare('is_mapping_active',$this->is_mapping_active,true);
		$criteria->compare('remote_server',$this->remote_server,true);
		$criteria->compare('mapping_created_on',$this->mapping_created_on,true);
		$criteria->compare('user_agent',$this->user_agent,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ApplicationCdnMapping the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
