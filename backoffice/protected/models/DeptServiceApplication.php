 <?php

/**
 * This is the model class for table "bo_dept_service_application".
 *
 * The followings are the available columns in table 'bo_dept_service_application':
 * @property integer $sno
 * @property string $sp_tag
 * @property integer $infowiz_dept_id
 * @property string $infowiz_service_id
 * @property string $infowiz_service_name
 * @property string $dept_application_number
 * @property string $is_applied_through_sw
 * @property string $iuid
 * @property integer $caf_id
 * @property string $sw_user_id
 * @property string $dept_user_id
 * @property string $applicant_name
 * @property string $applicant_email
 * @property string $applicant_contact_no
 * @property string $app_status
 * @property string $app_comment
 * @property string $unit_name
 * @property integer $unit_district_id
 * @property string $unit_address
 * @property integer $number_of_employee
 * @property string $download_certificate_call_back_url
 * @property string $reverted_call_back_url
 * @property string $print_app_call_back_url
 * @property string $remote_server
 * @property string $user_agent
 * @property string $application_created_on
 * @property string $application_updated_on
 * @property string $is_active
 * @property string $dms_time_taken_by_doc_verifier
 * @property string $dms_time_taken_by_investor
 * @property string $application_time_taken_by_investor
 * @property string $application_time_taken_by_department
 * @property string $payment_mode
 * @property string $payment_amount
 * @property string $payment_datetime
 * @property string $payment_reference_number
 * @property string $created
 * @property string $modified
 *
 * The followings are the available model relations:
 * @property InfowizardIssuerbyMaster $infowizDept
 * @property SsoUsers $swUser
 * @property District $unitDistrict
 */
class DeptServiceApplication extends CActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'bo_dept_service_application';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('infowiz_dept_id, infowiz_service_id, infowiz_service_name, dept_application_number, is_applied_through_sw,  app_status, app_comment, unit_name, unit_district_id, unit_address, print_app_call_back_url, remote_server, user_agent, application_created_on, is_active, created', 'required'),
            array('infowiz_dept_id, caf_id, unit_district_id, number_of_employee', 'numerical', 'integerOnly'=>true),
            array('sp_tag, infowiz_service_name, dept_application_number, applicant_name, applicant_email, unit_name, user_agent, payment_mode, payment_amount, payment_datetime, payment_reference_number,licence_no,dept_sw_reference_no', 'length', 'max'=>255),
            array('infowiz_service_id, dept_user_id,  dms_time_taken_by_doc_verifier, dms_time_taken_by_investor, application_time_taken_by_investor, application_time_taken_by_department', 'length', 'max'=>20),
            array('is_applied_through_sw, is_active', 'length', 'max'=>1),
            array('iuid', 'length', 'max'=>8),
            array('sw_user_id', 'length', 'max'=>10),
            //array('applicant_contact_no', 'length', 'max'=>14),
            array('app_status', 'length', 'max'=>3),
            array('download_certificate_call_back_url, reverted_call_back_url, application_updated_on', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('sno, sp_tag, infowiz_dept_id, infowiz_service_id, infowiz_service_name, licence_no, dept_application_number,dept_sw_reference_no, is_applied_through_sw, iuid, caf_id, sw_user_id, dept_user_id, applicant_name, applicant_email, applicant_contact_no, app_status, app_comment, unit_name, unit_district_id, unit_address, number_of_employee, download_certificate_call_back_url, reverted_call_back_url, print_app_call_back_url, remote_server, user_agent, application_created_on, application_updated_on, is_active, dms_time_taken_by_doc_verifier, dms_time_taken_by_investor, application_time_taken_by_investor, application_time_taken_by_department, payment_mode, payment_amount, payment_datetime, payment_reference_number, created, modified', 'safe', 'on'=>'search'),
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
            'infowizDept' => array(self::BELONGS_TO, 'InfowizardIssuerbyMaster', 'infowiz_dept_id'),
            'swUser' => array(self::BELONGS_TO, 'SsoUsers', 'sw_user_id'),
            'unitDistrict' => array(self::BELONGS_TO, 'District', 'unit_district_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'sno' => 'Sno',
            'sp_tag' => 'Sp Tag',
            'licence_no' => 'Licence No',
            'infowiz_dept_id' => 'Infowiz Dept',
            'infowiz_service_id' => 'Infowiz Service',
            'infowiz_service_name' => 'Infowiz Service Name',
            'dept_application_number' => 'Dept Application Number',
            'dept_sw_reference_no' => 'Dept SW Reference No',
            'is_applied_through_sw' => 'Is Applied Through Sw',
            'iuid' => 'Iuid',
            'caf_id' => 'Caf',
            'sw_user_id' => 'Sw User',
            'dept_user_id' => 'Dept User',
            'applicant_name' => 'Applicant Name',
            'applicant_email' => 'Applicant Email',
            'applicant_contact_no' => 'Applicant Contact No',
            'app_status' => 'App Status',
            'app_comment' => 'App Comment',
            'unit_name' => 'Unit Name',
            'unit_district_id' => 'Unit District',
            'unit_address' => 'Unit Address',
            'number_of_employee' => 'Number Of Employee',
            'download_certificate_call_back_url' => 'Download Certificate Call Back Url',
            'reverted_call_back_url' => 'Reverted Call Back Url',
            'print_app_call_back_url' => 'Print App Call Back Url',
            'remote_server' => 'Remote Server',
            'user_agent' => 'User Agent',
            'application_created_on' => 'Application Created On',
            'application_updated_on' => 'Application Updated On',
            'is_active' => 'Is Active',
            'dms_time_taken_by_doc_verifier' => 'Dms Time Taken By Doc Verifier',
            'dms_time_taken_by_investor' => 'Dms Time Taken By Investor',
            'application_time_taken_by_investor' => 'Application Time Taken By Investor',
            'application_time_taken_by_department' => 'Application Time Taken By Department',
            'payment_mode' => 'Payment Mode',
            'payment_amount' => 'Payment Amount',
            'payment_datetime' => 'Payment Datetime',
            'payment_reference_number' => 'Payment Reference Number',
            'created' => 'Created',
            'modified' => 'Modified',
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

        $criteria->compare('sno',$this->sno);
        $criteria->compare('sp_tag',$this->sp_tag,true);
        $criteria->compare('licence_no',$this->licence_no,true);
        $criteria->compare('infowiz_dept_id',$this->infowiz_dept_id);
        $criteria->compare('infowiz_service_id',$this->infowiz_service_id,true);
        $criteria->compare('infowiz_service_name',$this->infowiz_service_name,true);
        $criteria->compare('dept_application_number',$this->dept_application_number,true);
        $criteria->compare('dept_sw_reference_no',$this->dept_sw_reference_no,true);
        $criteria->compare('is_applied_through_sw',$this->is_applied_through_sw,true); 
        $criteria->compare('iuid',$this->iuid,true);
        $criteria->compare('caf_id',$this->caf_id);
        $criteria->compare('sw_user_id',$this->sw_user_id,true);
        $criteria->compare('dept_user_id',$this->dept_user_id,true);
        $criteria->compare('applicant_name',$this->applicant_name,true);
        $criteria->compare('applicant_email',$this->applicant_email,true);
        $criteria->compare('applicant_contact_no',$this->applicant_contact_no,true);
        $criteria->compare('app_status',$this->app_status,true);
        $criteria->compare('app_comment',$this->app_comment,true);
        $criteria->compare('unit_name',$this->unit_name,true);
        $criteria->compare('unit_district_id',$this->unit_district_id);
        $criteria->compare('unit_address',$this->unit_address,true);
        $criteria->compare('number_of_employee',$this->number_of_employee);
        $criteria->compare('download_certificate_call_back_url',$this->download_certificate_call_back_url,true);
        $criteria->compare('reverted_call_back_url',$this->reverted_call_back_url,true);
        $criteria->compare('print_app_call_back_url',$this->print_app_call_back_url,true);
        $criteria->compare('remote_server',$this->remote_server,true);
        $criteria->compare('user_agent',$this->user_agent,true);
        $criteria->compare('application_created_on',$this->application_created_on,true);
        $criteria->compare('application_updated_on',$this->application_updated_on,true);
        $criteria->compare('is_active',$this->is_active,true);
        $criteria->compare('dms_time_taken_by_doc_verifier',$this->dms_time_taken_by_doc_verifier,true);
        $criteria->compare('dms_time_taken_by_investor',$this->dms_time_taken_by_investor,true);
        $criteria->compare('application_time_taken_by_investor',$this->application_time_taken_by_investor,true);
        $criteria->compare('application_time_taken_by_department',$this->application_time_taken_by_department,true);
        $criteria->compare('payment_mode',$this->payment_mode,true);
        $criteria->compare('payment_amount',$this->payment_amount,true);
        $criteria->compare('payment_datetime',$this->payment_datetime,true);
        $criteria->compare('payment_reference_number',$this->payment_reference_number,true);
        $criteria->compare('created',$this->created,true);
        $criteria->compare('modified',$this->modified,true);  

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return DeptServiceApplication the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
}