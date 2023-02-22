<?php

/**
 * This is the model class for table "bo_existing_unit_data".
 *
 * The followings are the available columns in table 'bo_existing_unit_data':
 * @property integer $swcs_id
 * @property integer $industryid
 * @property string $add_on_date
 * @property string $update_on_date
 * @property integer $status
 * @property string $added_by
 * @property string $alies_name
 * @property string $enterprise_name
 * @property string $proprietor_name
 * @property string $sub_name
 * @property string $date_of_production
 * @property integer $registration_type
 * @property string $registration_no
 * @property string $registration_date
 * @property string $certificate
 * @property string $certificate_name
 * @property string $social_categoryid
 * @property integer $physical_handicapped
 * @property integer $freedom_exserviceman
 * @property string $financial_status
 * @property string $govt_subsidy
 * @property string $subsidy_amt
 * @property string $schemeids
 * @property string $districtid
 * @property string $blockid
 * @property string $panchayat
 * @property string $village
 * @property string $address
 * @property string $mobile_no
 * @property string $phone_no
 * @property string $emailid
 * @property string $legalstatusid
 * @property string $plot_no
 * @property integer $no_of_plot
 * @property integer $enterprise_status
 * @property string $closing_month
 * @property integer $closing_year
 * @property integer $plot_status
 * @property string $product_description
 * @property string $digit_code_5
 * @property string $digit_code_2
 * @property string $enterprise_nature
 * @property string $enterprise_category
 * @property string $plant_mechanory
 * @property string $equipment
 * @property string $land
 * @property string $building
 * @property string $total_investment
 * @property string $export_oriented
 * @property string $annual_capacity
 * @property string $unitid
 * @property string $currencyid
 * @property string $uttarakhand_male
 * @property string $uttarakhand_female
 * @property string $other_male
 * @property string $other_female
 * @property string $total_employment
 * @property integer $is_emii
 * @property string $resitration_emiino
 * @property string $resitration_emiidate
 * @property string $emii_certificate
 * @property string $emii_certificate_name
 * @property string $std_code
 * @property string $industrialestatetypeid
 * @property string $industrialestateid
 * @property string $industrialestate_name
 * @property string $other_investment
 * @property string $sale_volume
 * @property integer $fyearid
 */
class ExistingUnitData extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'bo_existing_unit_data';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('add_on_date, date_of_production, registration_date, resitration_emiidate', 'required'),
			array('industryid, status, registration_type, physical_handicapped, freedom_exserviceman, no_of_plot, enterprise_status, closing_year, plot_status, is_emii, fyearid', 'numerical', 'integerOnly'=>true),
			array('added_by, alies_name, enterprise_name, proprietor_name, sub_name, registration_no, certificate, certificate_name, social_categoryid, financial_status, govt_subsidy, subsidy_amt, schemeids, districtid, blockid, panchayat, village, address, emailid, legalstatusid, plot_no, closing_month, digit_code_5, digit_code_2, enterprise_nature, enterprise_category, plant_mechanory, equipment, land, building, total_investment, export_oriented, annual_capacity, unitid, currencyid, uttarakhand_male, uttarakhand_female, other_male, other_female, total_employment, resitration_emiino, emii_certificate, emii_certificate_name, std_code, industrialestatetypeid, industrialestateid, industrialestate_name, other_investment, sale_volume', 'length', 'max'=>255),
			array('mobile_no, phone_no', 'length', 'max'=>20),
			array('update_on_date, product_description', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('swcs_id, industryid, add_on_date, update_on_date, status, added_by, alies_name, enterprise_name, proprietor_name, sub_name, date_of_production, registration_type, registration_no, registration_date, certificate, certificate_name, social_categoryid, physical_handicapped, freedom_exserviceman, financial_status, govt_subsidy, subsidy_amt, schemeids, districtid, blockid, panchayat, village, address, mobile_no, phone_no, emailid, legalstatusid, plot_no, no_of_plot, enterprise_status, closing_month, closing_year, plot_status, product_description, digit_code_5, digit_code_2, enterprise_nature, enterprise_category, plant_mechanory, equipment, land, building, total_investment, export_oriented, annual_capacity, unitid, currencyid, uttarakhand_male, uttarakhand_female, other_male, other_female, total_employment, is_emii, resitration_emiino, resitration_emiidate, emii_certificate, emii_certificate_name, std_code, industrialestatetypeid, industrialestateid, industrialestate_name, other_investment, sale_volume, fyearid', 'safe', 'on'=>'search'),
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
			'swcs_id' => 'Swcs',
			'industryid' => 'Industryid',
			'add_on_date' => 'Add On Date',
			'update_on_date' => 'Update On Date',
			'status' => 'Status',
			'added_by' => 'Added By',
			'alies_name' => 'Alies Name',
			'enterprise_name' => 'Enterprise Name',
			'proprietor_name' => 'Proprietor Name',
			'sub_name' => 'Sub Name',
			'date_of_production' => 'Date Of Production',
			'registration_type' => 'Registration Type',
			'registration_no' => 'Registration No',
			'registration_date' => 'Registration Date',
			'certificate' => 'Certificate',
			'certificate_name' => 'Certificate Name',
			'social_categoryid' => 'Social Categoryid',
			'physical_handicapped' => 'Physical Handicapped',
			'freedom_exserviceman' => 'Freedom Exserviceman',
			'financial_status' => 'Financial Status',
			'govt_subsidy' => 'Govt Subsidy',
			'subsidy_amt' => 'Subsidy Amt',
			'schemeids' => 'Schemeids',
			'districtid' => 'Districtid',
			'blockid' => 'Blockid',
			'panchayat' => 'Panchayat',
			'village' => 'Village',
			'address' => 'Address',
			'mobile_no' => 'Mobile No',
			'phone_no' => 'Phone No',
			'emailid' => 'Emailid',
			'legalstatusid' => 'Legalstatusid',
			'plot_no' => 'Plot No',
			'no_of_plot' => 'No Of Plot',
			'enterprise_status' => 'Enterprise Status',
			'closing_month' => 'Closing Month',
			'closing_year' => 'Closing Year',
			'plot_status' => 'Plot Status',
			'product_description' => 'Product Description',
			'digit_code_5' => 'Digit Code 5',
			'digit_code_2' => 'Digit Code 2',
			'enterprise_nature' => 'Enterprise Nature',
			'enterprise_category' => 'Enterprise Category',
			'plant_mechanory' => 'Plant Mechanory',
			'equipment' => 'Equipment',
			'land' => 'Land',
			'building' => 'Building',
			'total_investment' => 'Total Investment',
			'export_oriented' => 'Export Oriented',
			'annual_capacity' => 'Annual Capacity',
			'unitid' => 'Unitid',
			'currencyid' => 'Currencyid',
			'uttarakhand_male' => 'Uttarakhand Male',
			'uttarakhand_female' => 'Uttarakhand Female',
			'other_male' => 'Other Male',
			'other_female' => 'Other Female',
			'total_employment' => 'Total Employment',
			'is_emii' => 'Is Emii',
			'resitration_emiino' => 'Resitration Emiino',
			'resitration_emiidate' => 'Resitration Emiidate',
			'emii_certificate' => 'Emii Certificate',
			'emii_certificate_name' => 'Emii Certificate Name',
			'std_code' => 'Std Code',
			'industrialestatetypeid' => 'Industrialestatetypeid',
			'industrialestateid' => 'Industrialestateid',
			'industrialestate_name' => 'Industrialestate Name',
			'other_investment' => 'Other Investment',
			'sale_volume' => 'Sale Volume',
			'fyearid' => 'Fyearid',
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

		$criteria->compare('swcs_id',$this->swcs_id);
		$criteria->compare('industryid',$this->industryid);
		$criteria->compare('add_on_date',$this->add_on_date,true);
		$criteria->compare('update_on_date',$this->update_on_date,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('added_by',$this->added_by,true);
		$criteria->compare('alies_name',$this->alies_name,true);
		$criteria->compare('enterprise_name',$this->enterprise_name,true);
		$criteria->compare('proprietor_name',$this->proprietor_name,true);
		$criteria->compare('sub_name',$this->sub_name,true);
		$criteria->compare('date_of_production',$this->date_of_production,true);
		$criteria->compare('registration_type',$this->registration_type);
		$criteria->compare('registration_no',$this->registration_no,true);
		$criteria->compare('registration_date',$this->registration_date,true);
		$criteria->compare('certificate',$this->certificate,true);
		$criteria->compare('certificate_name',$this->certificate_name,true);
		$criteria->compare('social_categoryid',$this->social_categoryid,true);
		$criteria->compare('physical_handicapped',$this->physical_handicapped);
		$criteria->compare('freedom_exserviceman',$this->freedom_exserviceman);
		$criteria->compare('financial_status',$this->financial_status,true);
		$criteria->compare('govt_subsidy',$this->govt_subsidy,true);
		$criteria->compare('subsidy_amt',$this->subsidy_amt,true);
		$criteria->compare('schemeids',$this->schemeids,true);
		$criteria->compare('districtid',$this->districtid,true);
		$criteria->compare('blockid',$this->blockid,true);
		$criteria->compare('panchayat',$this->panchayat,true);
		$criteria->compare('village',$this->village,true);
		$criteria->compare('address',$this->address,true);
		$criteria->compare('mobile_no',$this->mobile_no,true);
		$criteria->compare('phone_no',$this->phone_no,true);
		$criteria->compare('emailid',$this->emailid,true);
		$criteria->compare('legalstatusid',$this->legalstatusid,true);
		$criteria->compare('plot_no',$this->plot_no,true);
		$criteria->compare('no_of_plot',$this->no_of_plot);
		$criteria->compare('enterprise_status',$this->enterprise_status);
		$criteria->compare('closing_month',$this->closing_month,true);
		$criteria->compare('closing_year',$this->closing_year);
		$criteria->compare('plot_status',$this->plot_status);
		$criteria->compare('product_description',$this->product_description,true);
		$criteria->compare('digit_code_5',$this->digit_code_5,true);
		$criteria->compare('digit_code_2',$this->digit_code_2,true);
		$criteria->compare('enterprise_nature',$this->enterprise_nature,true);
		$criteria->compare('enterprise_category',$this->enterprise_category,true);
		$criteria->compare('plant_mechanory',$this->plant_mechanory,true);
		$criteria->compare('equipment',$this->equipment,true);
		$criteria->compare('land',$this->land,true);
		$criteria->compare('building',$this->building,true);
		$criteria->compare('total_investment',$this->total_investment,true);
		$criteria->compare('export_oriented',$this->export_oriented,true);
		$criteria->compare('annual_capacity',$this->annual_capacity,true);
		$criteria->compare('unitid',$this->unitid,true);
		$criteria->compare('currencyid',$this->currencyid,true);
		$criteria->compare('uttarakhand_male',$this->uttarakhand_male,true);
		$criteria->compare('uttarakhand_female',$this->uttarakhand_female,true);
		$criteria->compare('other_male',$this->other_male,true);
		$criteria->compare('other_female',$this->other_female,true);
		$criteria->compare('total_employment',$this->total_employment,true);
		$criteria->compare('is_emii',$this->is_emii);
		$criteria->compare('resitration_emiino',$this->resitration_emiino,true);
		$criteria->compare('resitration_emiidate',$this->resitration_emiidate,true);
		$criteria->compare('emii_certificate',$this->emii_certificate,true);
		$criteria->compare('emii_certificate_name',$this->emii_certificate_name,true);
		$criteria->compare('std_code',$this->std_code,true);
		$criteria->compare('industrialestatetypeid',$this->industrialestatetypeid,true);
		$criteria->compare('industrialestateid',$this->industrialestateid,true);
		$criteria->compare('industrialestate_name',$this->industrialestate_name,true);
		$criteria->compare('other_investment',$this->other_investment,true);
		$criteria->compare('sale_volume',$this->sale_volume,true);
		$criteria->compare('fyearid',$this->fyearid);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ExistingUnitData the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
