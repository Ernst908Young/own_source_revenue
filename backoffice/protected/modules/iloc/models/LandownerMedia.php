<?php

/**
 * This is the model class for table "bo_landowner_media".
 *
 * The followings are the available columns in table 'bo_landowner_media':
 * @property integer $id
 * @property string $document_name
 * @property integer $land_id
 * @property string $media_type
 * @property string $document_mime_type
 * @property string $doc_size
 * @property string $is_active
 * @property string $create_date
 * @property string $update_date
 */
class LandownerMedia extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'bo_landowner_media';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('document_name, land_id, media_type, document_mime_type, doc_size', 'required'),
			array('land_id', 'numerical', 'integerOnly'=>true),
			array('document_name, document_mime_type, doc_size', 'length', 'max'=>200),
			array('media_type', 'length', 'max'=>20),
			array('is_active', 'length', 'max'=>1),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, document_name, land_id, media_type, document_mime_type, doc_size, is_active, create_date, update_date', 'safe', 'on'=>'search'),
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
			'document_name' => 'Document Name',
			'land_id' => 'Land',
			'media_type' => 'Media Type',
			'document_mime_type' => 'Document Mime Type',
			'doc_size' => 'Doc Size',
			'is_active' => 'Is Active',
			'create_date' => 'Create Date',
			'update_date' => 'Update Date',
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
		$criteria->compare('document_name',$this->document_name,true);
		$criteria->compare('land_id',$this->land_id);
		$criteria->compare('media_type',$this->media_type,true);
		$criteria->compare('document_mime_type',$this->document_mime_type,true);
		$criteria->compare('doc_size',$this->doc_size,true);
		$criteria->compare('is_active',$this->is_active,true);
		$criteria->compare('create_date',$this->create_date,true);
		$criteria->compare('update_date',$this->update_date,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return LandownerMedia the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
