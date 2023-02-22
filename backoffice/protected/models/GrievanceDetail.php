<?php

/**
 * This is the model class for table "bo_grievance_detail".
 *
 * The followings are the available columns in table 'bo_grievance_detail':
 * @property integer $detail_id
 * @property string $grievence_no
 * @property string $user_name
 * @property string $comapany_name
 * @property string $mobile_number
 * @property string $address
 * @property string $zip_code
 * @property integer $district_id
 * @property string $dept_id
 * @property string $created_date
 * @property string $remote_ip
 * @property string $usre_agent
 * @property string $is_active
 *
 * The followings are the available model relations:
 * @property Grievance $grievenceNo
 * @property Departments $dept
 */
class GrievanceDetail extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'bo_grievance_detail';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('grievence_no, user_name, mobile_number, address, zip_code, created_date, remote_ip, usre_agent', 'required'),
			array('district_id', 'numerical', 'integerOnly'=>true),
			array('grievence_no', 'length', 'max'=>10),
			array('user_name, comapany_name, remote_ip, usre_agent', 'length', 'max'=>250),
			array('mobile_number, zip_code', 'length', 'max'=>20),
			array('dept_id', 'length', 'max'=>11),
			array('is_active', 'length', 'max'=>1),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('detail_id, grievence_no, user_name, comapany_name, mobile_number, address, zip_code, district_id, dept_id, created_date, remote_ip, usre_agent, is_active', 'safe', 'on'=>'search'),
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
			'grievenceNo' => array(self::BELONGS_TO, 'Grievance', 'grievence_no'),
			'dept' => array(self::BELONGS_TO, 'Departments', 'dept_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'detail_id' => 'Detail',
			'grievence_no' => 'Grievence No',
			'user_name' => 'User Name',
			'comapany_name' => 'Comapany Name',
			'mobile_number' => 'Mobile Number',
			'address' => 'Address',
			'zip_code' => 'Zip Code',
			'district_id' => 'District',
			'dept_id' => 'Dept',
			'created_date' => 'Created Date',
			'remote_ip' => 'Remote Ip',
			'usre_agent' => 'Usre Agent',
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

		$criteria->compare('detail_id',$this->detail_id);
		$criteria->compare('grievence_no',$this->grievence_no,true);
		$criteria->compare('user_name',$this->user_name,true);
		$criteria->compare('comapany_name',$this->comapany_name,true);
		$criteria->compare('mobile_number',$this->mobile_number,true);
		$criteria->compare('address',$this->address,true);
		$criteria->compare('zip_code',$this->zip_code,true);
		$criteria->compare('district_id',$this->district_id);
		$criteria->compare('dept_id',$this->dept_id,true);
		$criteria->compare('created_date',$this->created_date,true);
		$criteria->compare('remote_ip',$this->remote_ip,true);
		$criteria->compare('usre_agent',$this->usre_agent,true);
		$criteria->compare('is_active',$this->is_active,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return GrievanceDetail the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
