<?php

/**
 * This is the model class for table "du_pis_mou_upload".
 *
 * The followings are the available columns in table 'du_pis_mou_upload':
 * @property integer $id
 * @property string $company_name
 * @property string $representative_name
 * @property string $phone_number
 * @property string $email_id
 * @property string $project_detail
 * @property integer $sector
 * @property string $pis_proposed_investment_type
 * @property double $pis_proposed_investment_rs
 * @property string $pis_upload
 * @property string $mou_proposed_investment_type
 * @property double $mou_proposed_investment_rs
 * @property string $mou_upload
 * @property string $is_active
 * @property string $created
 * @property string $modified
 */
class PisMouLog extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'du_pis_mou_upload_log';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		// pis_proposed_employment, mou_proposed_employment,pis_proposed_investment_type, pis_proposed_investment_rs, pis_upload, mou_proposed_investment_type, mou_proposed_investment_rs, mou_upload,
		//representative_name, phone_number, email_id,  project_detail, total_investment , total_employment , 
		return array(
			 array('company_name, is_active, created, modified', 'required'),
			array('dept_user_id', 'numerical', 'integerOnly'=>true),
			array('pis_proposed_investment_rs, mou_proposed_investment_rs,pis_proposed_employment,mou_proposed_employment,total_investment,total_employment', 'numerical'),
			array('company_name,other_sector, pis_number,pis_signed_by,mou_signed_by, source,mou_number,dic,dm, representative_name, department,association,email_id, pis_upload, mou_upload', 'length', 'max'=>255),
			array('phone_number', 'length', 'max'=>14),
			array('pis_proposed_investment_type,investment_type, mou_proposed_investment_type', 'length', 'max'=>5),
			array('is_active,is_pis_signed_by_gov_uk,is_mou_signed_by_gov_uk', 'length', 'max'=>1), 
			//array('total_investment,pis_proposed_investment_rs,mou_proposed_investment_rs,investment_type,pis_proposed_investment_type,mou_proposed_investment_type','checkinvestment'),
			//array('total_employment,pis_proposed_employment,mou_proposed_employment','checkemployment'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id,master_reference_no, inprincipal_applied,dept_user_id_orignal,inprincipal_approved,caf_id,source_by,source_remark,source_upload, company_name, pis_signed_by,mou_signed_by,pis_number ,agreement_type,mou_number ,other_sector, representative_name, pis_proposed_employment,dept_user_id,mou_proposed_employmentphone_number, email_id, project_detail, sector, pis_proposed_investment_type, pis_proposed_investment_rs, pis_upload, mou_proposed_investment_type, mou_proposed_investment_rs, mou_upload, is_active, created, modified', 'safe', 'on'=>'search'),
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
			'company_name' => 'Name of the Company',
			'representative_name' => 'Name of the Representative',
			'phone_number' => 'Phone Number',
			'email_id' => 'Email ID',
			'project_detail' => 'Project Details',
			'sector' => 'Relevant to Sectors',
			'pis_proposed_investment_type' => 'Rs In',
			'pis_proposed_investment_rs' => 'Proposed Investment',
			'pis_signed_by' => 'Signed By',
			'mou_signed_by' => 'Signed By',
			'pis_upload' => 'PIS Upload',
			'source' => 'Source of PIS / MoU / EOI / ITI',
			'department' => 'Department',
			'association' => 'Association',
			'dic' => 'DIC',
			'dm' => 'DM',
			'pis_proposed_employment' => 'Proposed Employment',
			'mou_proposed_investment_type' => 'Rs In',
			'other_sector' => 'Sector Name',
			'mou_upload' => 'MoU Upload',
			'mou_proposed_investment_rs' => 'Proposed Investment',
			'mou_proposed_employment' => 'Proposed Employment',
			'mou_number' => 'MoU Number',
			'pis_number' => 'PIS Number',
			'source_upload' => 'Upload',
			'source_by' => 'Source Reference',
			'source_remark' => 'Reference Remark',
			'is_active' => 'Is Active',
			'created' => 'Created',
			'modified' => 'Modified',
			'caf_id' => 'CAF ID',	
			'inprincipal_applied' => 'Applied For In-Principle Approval',
			'inprincipal_approved' => 'In-Principle Granted'
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
		$criteria->compare('company_name',$this->company_name,true);
		$criteria->compare('representative_name',$this->representative_name,true);
		$criteria->compare('phone_number',$this->phone_number,true);
		$criteria->compare('email_id',$this->email_id,true);
		$criteria->compare('project_detail',$this->project_detail,true);
		$criteria->compare('sector',$this->sector);
		$criteria->compare('pis_proposed_investment_type',$this->pis_proposed_investment_type,true);
		$criteria->compare('pis_proposed_investment_rs',$this->pis_proposed_investment_rs);
		$criteria->compare('pis_upload',$this->pis_upload,true);
		$criteria->compare('mou_proposed_investment_type',$this->mou_proposed_investment_type,true);
		$criteria->compare('mou_proposed_investment_rs',$this->mou_proposed_investment_rs);
		$criteria->compare('mou_upload',$this->mou_upload,true);
		$criteria->compare('is_active',$this->is_active,true);
		$criteria->compare('created',$this->created,true);
		$criteria->compare('modified',$this->modified,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	/* public function checkinvestment($attribute,$params)
	{		
		$pis_proposed_investment_rs = 0;
		$mou_proposed_investment_rs = 0;
		
		$total_investment = $this->total_investment;
		$pis_proposed_investment_rs = $this->pis_proposed_investment_rs;
		$mou_proposed_investment_rs = $this->mou_proposed_investment_rs;
		
		$investment_type = $this->investment_type;
		$pis_proposed_investment_type = $this->pis_proposed_investment_type;
		$mou_proposed_investment_type = $this->mou_proposed_investment_type;
		
		if($investment_type=='Lakh')
		{
			$total_investment = $total_investment/100;
		}
		if($pis_proposed_investment_type=='Lakh')
		{
			$pis_proposed_investment_rs = $pis_proposed_investment_rs/100;
		}
		if($mou_proposed_investment_type=='Lakh')
		{
			$mou_proposed_investment_rs = $mou_proposed_investment_rs/100;
		}
		
		if(($total_investment != ($pis_proposed_investment_rs + $mou_proposed_investment_rs))) {
            $this->addError('total_investment', "Investment must be equal to sum of PIS and MoU Proposed Investment.");
			return false;
        }
		return true; 
	}  
	
	public function checkemployment($attribute,$params)
	{		
		$total_employment = 0;
		$mou_proposed_employment = 0;
		$mou_proposed_employment = 0;
		
		$total_employment = $this->total_employment;
		$pis_proposed_employment = $this->pis_proposed_employment;
		$mou_proposed_employment = $this->mou_proposed_employment;
		
		if(($total_employment != ($pis_proposed_employment + $mou_proposed_employment))) {
            $this->addError('total_employment', "Employment must be equal to sum of PIS and MoU Proposed Employment.");
			return false;
        }
		return true; 
	}
	*/
	

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return PisMou the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
