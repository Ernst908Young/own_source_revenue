<?php
class LmInspection extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'bo_lm_inspection_report';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('service_id, iuid, firm_name, service_type, district_id,app_id,licence_number, inspector_name, last_inspection_date,inspection_commence,inspection_report', 'required'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('service_id, iuid, firm_name, service_type, district_id,app_id, licence_number, inspector_name, last_inspection_date,inspection_commence,inspection_report, created, is_active', 'safe', 'on'=>'search'),
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
			'firm_name' => 'Firm Name',
			'service_type' => 'Service Type',
			'district_id' => 'District',
			'licence_number' => 'Licence Number',
			'inspector_name' => 'Inspector Name',
			'last_inspection_date' => 'Last Inspection Date',
			'inspection_commence' => 'Inspection Commence',
			'inspection_report' => 'Upload Inspection Report',
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
