<?php
class LmApprovalCertificate extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'bo_lm_approval_certificate';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('service_id, iuid, firm_name,licencee_name, service_type, district_id, licence_number,licence_valid_from,licence_valid_to,date_of_licence_issue,approval_certificate', 'required'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('service_id, iuid, firm_name,licencee_name,app_id,firm_address, service_type, district_id, licence_number, inspector_name,licence_valid_from,licence_valid_to, date_of_licence_issue,approval_certificate, created, is_active', 'safe', 'on'=>'search'),
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
			'service_id' => 'Service',
			'iuid' => 'IUID',
			'licencee_name' => 'Licencee Name',
			'firm_name' => 'Firm Name',
			'firm_address' => 'Firm Address',
			'service_type' => 'Service Type',
			'district_id' => 'District',
			'licence_number' => 'Licence Number',
			'inspector_name' => 'Inspector Name',
			'licence_valid_from' => 'Licence Valid From',
			'licence_valid_to' => 'Licence Valid To',
			'date_of_licence_issue' => 'Date of Licence Issue',
			'approval_certificate' => 'Approval Certificate',
			'created' => 'Created'
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
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return SubserviceTagMapping the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
