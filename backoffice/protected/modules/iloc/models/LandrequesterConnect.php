<?php

/**
 * This is the model class for table "bo_landrequest_connect".
 *
 * The followings are the available columns in table 'bo_landrequest_connect':
 * @property integer $id
 * @property string $user_id
 * @property integer $is_sale
 * @property integer $is_lease
 * @property integer $district_id
 * @property integer $sub_district_id
 * @property string $village
 * @property string $type_of_land
 * @property string $area_sqmt
 * @property string $area_type
 * @property string $comment
 * @property string $status
 * @property string $share_contact
 * @property string $latlong
 * @property integer $user_type
 * @property string $created_date
 * @property string $modified_date
 */
class LandrequesterConnect extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'bo_landowner_requester_connect';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('district_id,sub_district_id,type_of_land,created_date,comment', 'required'),
			array('is_sale, is_lease, district_id, sub_district_id', 'numerical', 'integerOnly'=>true),
			array('user_id', 'length', 'max'=>10),
			array('land_title, area_type, latlong', 'length', 'max'=>255),
			array('comment', 'length', 'max'=>250),
			array('status,share_contact', 'length', 'max'=>1),
			array('modified_date,area_sqmt,user_type', 'safe'),
			// The following rule is used by search(). comment
			// @todo Please remove those attributes that should not be searched.
			array('id, user_id, land_title, is_sale, is_lease, district_id, sub_district_id, village,type_of_land,area_sqmt, area_type,comment, status, share_contact, latlong,user_type, created_date, modified_date', 'safe', 'on'=>'search'),
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
			'land_title' => 'Land Title',
			'is_sale' => 'Is Sale',
			'is_lease' => 'Is Lease',
			'district_id' => 'District',
			'sub_district_id' => 'Sub District',
			'village' => 'Village',
			'type_of_land' => 'Type Of Land',
			'area_sqmt' => 'Area Sqmt',
			'area_type' => 'Area Type',
			'comment' => 'Comment',
			'status' => 'Status',
			'share_contact' => 'Share Contact',
			'latlong' => 'Latlong',
			'user_type' => 'User Type',
			'created_date' => 'Created Date',
			'modified_date' => 'Modified Date',
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
		$criteria->compare('land_title',$this->land_title,true);
		$criteria->compare('is_sale',$this->is_sale);
		$criteria->compare('is_lease',$this->is_lease);
		$criteria->compare('district_id',$this->district_id);
		$criteria->compare('sub_district_id',$this->sub_district_id);
		$criteria->compare('village',$this->village,true);
		$criteria->compare('type_of_land',$this->type_of_land,true);
		$criteria->compare('area_sqmt',$this->area_sqmt,true);
		$criteria->compare('area_type',$this->area_type,true);
		$criteria->compare('comment',$this->comment,true);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('share_contact',$this->share_contact,true);
		$criteria->compare('latlong',$this->latlong,true);
		$criteria->compare('user_type',$this->user_type);
		$criteria->compare('created_date',$this->created_date,true);
		$criteria->compare('modified_date',$this->modified_date,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return LandrequestConnect the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
