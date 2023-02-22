<?php
/**
 * This is the model class for table "du_pis_call_log".
 *
 * The followings are the available columns in table 'du_pis_call_log':
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
class CallLog extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'du_pis_call_log';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.		
		return array(
			/* array('name_of_representative,phone_number,able_to_connect,calling_date, call_back,meeting_with_dept,land_requirement,financial_tie_up,created', 'required'), */
			array('able_to_connect,inprincipal_applied,forwarded_dept,timeline_for_grounding,timeline_for_commencement,land_requirement,financial_tie_up', 'required'),
			array('phone_number', 'numerical', 'integerOnly'=>true),
			array('phone_number', 'length', 'max'=>14),			
			array('reason,name_of_representative,phone_number,calling_date, call_back,meeting_with_dept,land_requirement,financial_tie_up,able_to_connect','checkreason'),		
			/* array('land_requirement,area_requirement,area_requirement_district,area_under_possession,area_under_possession_address,area_under_possession_tehsil,area_under_possession_district','checklandrequire'), */
			array('financial_tie_up,financial_partner','checkfinancialrequire'),	
			array('call_back,call_back_date_start,call_back_date_end','checkcallback'),		
			array('forwarded_dept,dic_dept','checkForward'),		
			array('inprincipal_applied,caf_id','checkCAF'),		
			array('calling_date,call_back,metting_agenda,meeting_request_dept,land_requirement,area_requirement,area_address,area_requirement_district,timeline_for_commencement,financial_tie_up,financial_partner,call_back_date,inprincipal_applied,inprincipal_approved,caf_id,siidcul_summary,dic_dept', 'safe', 'on'=>'search'),
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
			'salutation' => 'Salutation',			
			'name_of_representative' => 'Name of Representative',			
			'able_to_connect' => 'Able to Connect',			
			'phone_number' => 'Phone Number',			
			'email' => 'Email Id',			
			'call_back' => 'Call Back',			
			'call_back_date_start' => 'Call Back Date',			
			'meeting_with_dept' => 'Meeting With Dept ?',			
			'metting_agenda' => 'Meeting Agenda',			
			'meeting_request_dept' => 'Meeting Requested With Dept.',			
			'meeting_request' => 'Meeting Requested Date',	
			'land_requirement' => 'Land Requirement: ',			
			'area_requirement' => 'Area Requirement',			
			'area_requirement_district' => 'District Preferences (Where Required)',			
			'area_address' => 'Address',			
			'area_under_possession' => 'Area Under Possession',			
			'area_under_possession_unit' => 'Unit',			
			'area_under_possession_address' => 'Address',			
			'area_under_possession_tehsil' => 'Tehsil',			
			'area_under_possession_district' => 'District',			
			'timeline_for_commencement' => 'Targeted TimeLine For Commencement',			
			'timeline_for_grounding' => 'Targeted TimeLine For Grounding',			
			'financial_tie_up' => 'Already Have Financial Tie Up: ',			
			'financial_partner' => 'Forward Financial Requirement to Following Institutions',
			'caf_id' => 'CAF Id',			
			'forwarded_dept' => 'Responsible Department',			
			'siidcul_summary' => 'SIIDCUL Summary',			
			'dic_dept' => 'DIC',			
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
		$criteria->compare('calling_date',$this->calling_date,true);
		$criteria->compare('call_back',$this->call_back,true);
		$criteria->compare('call_back_date',$this->call_back_date,true);
		$criteria->compare('summary',$this->summary,true);
		$criteria->compare('meeting_request_dept',$this->meeting_request_dept,true);
		$criteria->compare('meeting1',$this->meeting1);
		$criteria->compare('land_requirement',$this->land_requirement,true);
		$criteria->compare('area_requirement',$this->area_requirement);
		$criteria->compare('area_requirement_district',$this->area_requirement_district,true);
		$criteria->compare('timeline_for_commencement',$this->timeline_for_commencement,true);
		$criteria->compare('financial_tie_up',$this->financial_tie_up);
		$criteria->compare('financial_partner',$this->financial_partner,true);
		$criteria->compare('is_active',$this->is_active,true);
		$criteria->compare('created',$this->created,true);
		$criteria->compare('modified',$this->modified,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	
	public function checkCAF($attribute,$params)
	{
		$inprincipal_applied = $this->inprincipal_applied;
		$caf_id = $this->caf_id;
		if($inprincipal_applied==true && empty($caf_id))
		{
			$this->addError('caf_id', "Please select CAF.");
			return false;
		}
		return true; 
	}
	
	public function checkForward($attribute,$params)
	{
		$forwarded_dept = $this->forwarded_dept;
		$dic_dept = $this->dic_dept;
		if($forwarded_dept=='dic' && empty($dic_dept))
		{
		
			$this->addError('dic_dept', "Please select DIC.");
			return false;
		}
		return true; 
	}
	
	public function checkreason($attribute,$params)
	{		
		$able_to_connect = $this->able_to_connect;		
		$reason = $this->reason;		
		$name_of_representative = $this->name_of_representative;		
		$phone_number = $this->phone_number;		
		$call_back = $this->call_back;		
		$calling_date = $this->calling_date;		
		$meeting_with_dept = $this->meeting_with_dept;		
		$land_requirement = $this->land_requirement;		
		$financial_tie_up = $this->financial_tie_up;		
		if($able_to_connect=='No' && empty($reason)) {
            $this->addError('reason', "if not able to connect please select reason.");
			return false;
        }
		if($able_to_connect=='Yes'  && empty($name_of_representative)) {
            $this->addError('name_of_representative', "Name of representative required.");
			return false;
        }		
		
		if($able_to_connect=='Yes'  && empty($phone_number)) {
			$this->addError('phone_number', "Phone number required.");
			return false;
        }	

		if($able_to_connect=='Yes'  && empty($land_requirement)) {
            $this->addError('land_requirement', "Land requirement can not be blank.");
			return false;
        }	
		
		if($able_to_connect=='Yes'  && empty($financial_tie_up)) {
           $this->addError('financial_tie_up', "Financial tie up required.");
			return false;
        }	

		if($able_to_connect=='Yes'  && empty($meeting_with_dept)) {
            $this->addError('meeting_with_dept', "Meeting with dept required.");
			return false;
        }		
		
		if($able_to_connect=='Yes'  && empty($call_back)) {
            $this->addError('call_back', "Name of representative required.");
			return false;
        }		
		
		if($able_to_connect=='Yes'  && empty($calling_date)) {
            $this->addError('calling_date', "Calling date required.");
			return false;
        }
			
			
		return true; 
	}
	
	public function checklandrequire($attribute,$params)
	{		
		$land_requirement = $this->land_requirement;
		$area_requirement = $this->area_requirement;		
		$area_requirement_district = $this->area_requirement_district;		
		$area_under_possession = $this->area_under_possession;		
		$area_under_possession_address = $this->area_under_possession_address;		
		$area_under_possession_tehsil = $this->area_under_possession_tehsil;		
		$area_under_possession_district = $this->area_under_possession_district;		
		if($land_requirement=='Yes' && $area_requirement=='') {
            $this->addError('area_requirement', "Please enter area required.");
			return false;
        }
		if($land_requirement=='Yes' && $area_requirement_district=='') {
            $this->addError('area_requirement_district', "Please select district preferences.");
			return false;
        }
		
		if($land_requirement=='No' && $area_under_possession=='') {
            $this->addError('area_under_possession', "Please enter area under possession.");
			return false;
        }
		if($land_requirement=='No' && $area_under_possession_address=='') {
            $this->addError('area_under_possession_address', "Please enter address.");
			return false;
        }
		if($land_requirement=='No' && $area_under_possession_tehsil=='') {
            $this->addError('area_under_possession_tehsil', "Please enter thesil.");
			return false;
        }
		if($land_requirement=='No' && $area_under_possession_district=='') {
            $this->addError('area_under_possession_district', "Please select district.");
			return false;
        } 
		return true; 
	}
	
	public function checkfinancialrequire($attribute,$params)
	{		
		$financial_tie_up = $this->financial_tie_up;		
		$financial_partner = $this->financial_partner;				
		if($financial_tie_up=='No' && $financial_partner=='') {
            $this->addError('financial_partner', "Please select financial requirement institution.");
			return false;
        }		
		return true; 
	}
	
	public function checkcallback($attribute,$params)
	{	
		$call_back = $this->call_back;		
		$call_back_date_start = $this->call_back_date_start;				
		$call_back_date_end = $this->call_back_date_end;				
		if($call_back=='Yes' && $call_back_date_start=='') {
            $this->addError('call_back_date_start', "Please select call back from.");
			return false;
        }	
		if($call_back=='Yes' && $call_back_date_end=='') {
            $this->addError('call_back_date_end', "Please select call back to.");
			return false;
        }	
		return true; 
	}

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
