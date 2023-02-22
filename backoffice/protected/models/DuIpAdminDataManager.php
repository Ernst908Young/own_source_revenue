<?php

/**
 * This is the model class for table "du_ip_admin_data_manager".
 *
 * The followings are the available columns in table 'du_ip_admin_data_manager':
 * @property integer $id
 * @property string $mrn
 * @property string $company_name
 * @property integer $caf_id
 * @property string $application_status
 * @property string $is_a
 * @property string $is_b
 * @property string $is_c
 * @property string $is_d
 * @property string $created
 * @property string $modified
 * @property string $created_by
 * @property string $is_active
 */
class DuIpAdminDataManager extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'du_ip_admin_data_manager';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('mrn, company_name, caf_id, application_status, created, modified, created_by', 'required'),
			array('caf_id', 'numerical', 'integerOnly'=>true),
			array('mrn', 'length', 'max'=>5),
			array('company_name', 'length', 'max'=>255),
			array('application_status, is_a, is_b, is_c, is_d, is_active', 'length', 'max'=>1),
			array('created_by', 'length', 'max'=>10),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, mrn, company_name, caf_id, application_status, is_a, is_b, is_c, is_d, created, modified, created_by, is_active', 'safe', 'on'=>'search'),
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
			'mrn' => 'Mrn',
			'company_name' => 'Company Name',
			'caf_id' => 'Caf',
			'application_status' => 'Application Status',
			'is_a' => 'Is A',
			'is_b' => 'Is B',
			'is_c' => 'Is C',
			'is_d' => 'Is D',
			'created' => 'Created',
			'modified' => 'Modified',
			'created_by' => 'Created By',
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
		$criteria->compare('mrn',$this->mrn,true);
		$criteria->compare('company_name',$this->company_name,true);
		$criteria->compare('caf_id',$this->caf_id);
		$criteria->compare('application_status',$this->application_status,true);
		$criteria->compare('is_a',$this->is_a,true);
		$criteria->compare('is_b',$this->is_b,true);
		$criteria->compare('is_c',$this->is_c,true);
		$criteria->compare('is_d',$this->is_d,true);
		$criteria->compare('created',$this->created,true);
		$criteria->compare('modified',$this->modified,true);
		$criteria->compare('created_by',$this->created_by,true);
		$criteria->compare('is_active',$this->is_active,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return DuIpAdminDataManager the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
