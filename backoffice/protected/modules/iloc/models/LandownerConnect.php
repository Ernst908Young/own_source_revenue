<?php

/**
 * This is the model class for table "bo_landowner_connect".
 *
 * The followings are the available columns in table 'bo_landowner_connect':
 * @property integer $id
 * @property string $la_type
 * @property string $land_title
 * @property integer $department_id
 * @property string $user_id
 * @property integer $is_sale
 * @property integer $is_lease
 * @property integer $district_id
 * @property integer $sub_district_id
 * @property string $village
 * @property string $address
 * @property string $keshra_khatian
 * @property string $type_of_land
 * @property string $distance_highway
 * @property string $name_highway
 * @property string $distance_airport
 * @property string $name_airport
 * @property string $distance_railway
 * @property string $name_railway
 * @property string $area_sqmt
 * @property string $area_type
 * @property string $existing_loan
 * @property string $comment
 * @property string $status
 * @property string $share_contact
 * @property string $latlong
 * @property integer $dept_user_id
 * @property string $created_date
 * @property string $modified_date
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
            array('land_title, district_id, sub_district_id, address, keshra_khatian, type_of_land, distance_highway, name_highway, distance_airport, name_airport, distance_railway, name_railway, area_sqmt, area_type, existing_loan, comment, status, , created_date', 'required'),
            array('department_id, is_sale, is_lease, district_id, sub_district_id, dept_user_id', 'numerical', 'integerOnly'=>true),
            array('la_type', 'length', 'max'=>3),
            array('land_title, area_type, latlong', 'length', 'max'=>255),
            array('user_id', 'length', 'max'=>10),
            array('existing_loan, status, share_contact', 'length', 'max'=>1),
            array('modified_date', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, la_type, land_title, department_id, user_id, is_sale, is_lease, district_id, sub_district_id, village, address, keshra_khatian, type_of_land, distance_highway, name_highway, distance_airport, name_airport, distance_railway, name_railway, area_sqmt, area_type, existing_loan, comment, status, share_contact, latlong, dept_user_id, created_date, modified_date', 'safe', 'on'=>'search'),
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
			'la_type' => 'Land Type',
			'department_id' => 'Department',
			'land_title' => 'Land Title',
			'is_sale' => 'Is Sale',
			'is_lease' => 'Is Lease',
			'district_id' => 'District',
			'address' => 'Address',
			'sub_district_id' => 'Sub District',
			'village' => 'Village',
			'keshra_khatian' => 'Keshra Khatian',
			'type_of_land' => 'Type Of Land',
			'keshra_khatian' => 'Khasra Khatauni',
			'type_of_land' => 'Type Of Land',
			'distance_highway' => 'Distance from Highway',
			'name_highway' => 'Name of Highway',
			'distance_airport' => 'Distance Airport',
			'name_airport' => 'Name of Airport',
			'distance_railway' => 'Distance From Railway',
			'name_railway' => 'Name of Railway',
			'area_sqmt' => 'Area',
			'area_type' => 'Area Type',
			'existing_loan' => 'Existing Loan',
			'comment' => 'Comment',
			'status' => 'Status',
			'share_contact' => 'Share Contact',
			'latlong' => 'Latlong',
			'dept_user_id' => 'Dept User',
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
                $criteria->compare('department_id',$this->department_id);
		$criteria->compare('la_type',$this->la_type);
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
		$criteria->compare('area_type',$this->area_type,true);
		$criteria->compare('existing_loan',$this->existing_loan,true);
		$criteria->compare('comment',$this->comment,true);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('share_contact',$this->share_contact,true);
		$criteria->compare('latlong',$this->latlong,true);
		$criteria->compare('dept_user_id',$this->dept_user_id);
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
