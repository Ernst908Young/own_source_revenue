<?php

/**
 * This is the model class for table "bo_manage_contact".
 *
 * The followings are the available columns in table 'bo_manage_contact':
 * @property integer $id
 * @property string $contact_addr
 * @property string $contact_city
 * @property string $contact_mobile
 * @property string $contact_fax
 * @property string $contact_email
 * @property string $contact_toll_free
 * @property string $about_you
 * @property string $is_active
 */
class ManageContact extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'bo_manage_contact';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('contact_addr, contact_city, contact_mobile, contact_fax, contact_email, contact_toll_free', 'required'),
			array('contact_addr, contact_city', 'length', 'max'=>500),
			array('contact_mobile, contact_fax, contact_email, contact_toll_free', 'length', 'max'=>250),
			array('is_active', 'length', 'max'=>1),
			array('about_you', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, contact_addr, contact_city, contact_mobile, contact_fax, contact_email, contact_toll_free, about_you, is_active', 'safe', 'on'=>'search'),
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
			'contact_addr' => 'Contact Addr',
			'contact_city' => 'Contact City',
			'contact_mobile' => 'Contact Mobile',
			'contact_fax' => 'Contact Fax',
			'contact_email' => 'Contact Email',
			'contact_toll_free' => 'Contact Toll Free',
			'about_you' => 'About You',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('contact_addr',$this->contact_addr,true);
		$criteria->compare('contact_city',$this->contact_city,true);
		$criteria->compare('contact_mobile',$this->contact_mobile,true);
		$criteria->compare('contact_fax',$this->contact_fax,true);
		$criteria->compare('contact_email',$this->contact_email,true);
		$criteria->compare('contact_toll_free',$this->contact_toll_free,true);
		$criteria->compare('about_you',$this->about_you,true);
		$criteria->compare('is_active',$this->is_active,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ManageContact the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
