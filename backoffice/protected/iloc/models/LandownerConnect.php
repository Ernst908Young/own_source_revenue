<?php

/**
 * This is the model class for table "bo_landowner_connect".
 *
 * The followings are the available columns in table 'bo_landowner_connect':
 * @property integer $id
 * @property string $user_id
 * @property string $land_title
 * @property integer $is_sale
 * @property integer $is_lease
 * @property integer $district_id
 * @property string $address
 * @property integer $sub_district_id
 * @property string $village
 * @property string $keshra_khatian
 * @property string $type_of_land
 * @property string $distance_highway
 * @property string $name_highway
 * @property string $distance_airport
 * @property string $name_airport
 * @property string $distance_railway
 * @property string $name_railway
 * @property string $area_sqmt
 * @property string $existing_loan
 * @property string $comment
 * @property string $status
 * @property string $share_contact
 * @property string $latlong
 * @property string $created_date
 * @property string $modified_date
 *
 * The followings are the available model relations:
 * @property BoLandownerContact[] $boLandownerContacts
 * @property BoLandownerVisitorPropertyActionLog[] $boLandownerVisitorPropertyActionLogs
 */
class LandownerConnect extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'bo_landowner_connect';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('land_title, district_id, address, sub_district_id, village, keshra_khatian, type_of_land, distance_highway, name_highway, distance_airport, name_airport, distance_railway, name_railway, area_sqmt, existing_loan, comment, created_date', 'required'),
			array('is_sale, is_lease, district_id, sub_district_id,distance_highway,distance_airport,distance_railway,area_sqmt', 'numerical', 'integerOnly'=>true),
			array('user_id', 'length', 'max'=>10),
			array('land_title, latlong', 'length', 'max'=>255),
			array('existing_loan, status, share_contact', 'length', 'max'=>1),
			array('modified_date', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, user_id, land_title, is_sale, is_lease, district_id, address, sub_district_id, village, keshra_khatian, type_of_land, distance_highway, name_highway, distance_airport, name_airport, distance_railway, name_railway, area_sqmt, existing_loan, comment, status, share_contact, latlong, created_date, modified_date', 'safe', 'on'=>'search'),
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
			'boLandownerContacts' => array(self::HAS_MANY, 'BoLandownerContact', 'land_id'),
			'boLandownerVisitorPropertyActionLogs' => array(self::HAS_MANY, 'BoLandownerVisitorPropertyActionLog', 'land_id'),
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
			'address' => 'Address',
			'sub_district_id' => 'Sub District',
			'village' => 'Village',
			'keshra_khatian' => 'Keshra Khatian',
			'type_of_land' => 'Type Of Land',
			'distance_highway' => 'Distance Highway',
			'name_highway' => 'Name Highway',
			'distance_airport' => 'Distance Airport',
			'name_airport' => 'Name Airport',
			'distance_railway' => 'Distance Railway',
			'name_railway' => 'Name Railway',
			'area_sqmt' => 'Area Sqmt',
			'existing_loan' => 'Existing Loan',
			'comment' => 'Comment',
			'status' => 'Status',
			'share_contact' => 'Share Contact',
			'latlong' => 'Latlong',
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
		$criteria->compare('address',$this->address,true);
		$criteria->compare('sub_district_id',$this->sub_district_id);
		$criteria->compare('village',$this->village,true);
		$criteria->compare('keshra_khatian',$this->keshra_khatian,true);
		$criteria->compare('type_of_land',$this->type_of_land,true);
		$criteria->compare('distance_highway',$this->distance_highway,true);
		$criteria->compare('name_highway',$this->name_highway,true);
		$criteria->compare('distance_airport',$this->distance_airport,true);
		$criteria->compare('name_airport',$this->name_airport,true);
		$criteria->compare('distance_railway',$this->distance_railway,true);
		$criteria->compare('name_railway',$this->name_railway,true);
		$criteria->compare('area_sqmt',$this->area_sqmt,true);
		$criteria->compare('existing_loan',$this->existing_loan,true);
		$criteria->compare('comment',$this->comment,true);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('share_contact',$this->share_contact,true);
		$criteria->compare('latlong',$this->latlong,true);
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
	 * @return LandownerConnect the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
