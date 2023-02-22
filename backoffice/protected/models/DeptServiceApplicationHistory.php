<?php

/**
 * This is the model class for table "bo_dept_service_application_history".
 *
 * The followings are the available columns in table 'bo_dept_service_application_history':
 * @property integer $app_transaction_id
 * @property integer $swcs_application_id
 * @property integer $infowiz_dept_id
 * @property string $dept_application_number
 * @property string $app_status
 * @property string $app_comment
 * @property string $transaction_datetime
 * @property integer $processed_by_role_id
 * @property string $processed_by_role_name
 * @property string $processed_by_role_user_mobile_number
 * @property string $processed_by_role_user_email
 * @property integer $next_role_id
 * @property string $next_role_user_name
 * @property string $next_role_user_mobile_number
 * @property string $next_role_user_email
 * @property string $payment_amount
 * @property string $payment_mode
 * @property string $payment_datetime
 * @property string $user_agent
 * @property string $remote_server
 * @property string $payment_reference_number
 * @property string $created
 *
 * The followings are the available model relations:
 * @property InfowizardIssuerbyMaster $infowizDept
 * @property DeptServiceApplication $swcsApplication
 */
class DeptServiceApplicationHistory extends CActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'bo_dept_service_application_history';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('swcs_application_id, infowiz_dept_id, dept_application_number, app_status, transaction_datetime, user_agent, remote_server, created', 'required'),
            array('swcs_application_id, infowiz_dept_id, processed_by_role_id, next_role_id', 'numerical', 'integerOnly'=>true),
            array('dept_application_number, processed_by_role_name, processed_by_role_user_email, next_role_user_name, next_role_user_email, payment_mode, user_agent, remote_server, payment_reference_number', 'length', 'max'=>255),
            array('app_status', 'length', 'max'=>3),
            array('processed_by_role_user_mobile_number, next_role_user_mobile_number', 'length', 'max'=>14),
            array('payment_amount', 'length', 'max'=>20),
            array('app_comment, payment_datetime', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('app_transaction_id, swcs_application_id, infowiz_dept_id, dept_application_number, app_status, app_comment, transaction_datetime, processed_by_role_id, processed_by_role_name, processed_by_role_user_mobile_number, processed_by_role_user_email, next_role_id, next_role_user_name, next_role_user_mobile_number, next_role_user_email, payment_amount, payment_mode, payment_datetime, user_agent, remote_server, payment_reference_number, created', 'safe', 'on'=>'search'),
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
            'swcsApplication' => array(self::BELONGS_TO, 'DeptServiceApplication', 'swcs_application_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'app_transaction_id' => 'App Transaction',
            'swcs_application_id' => 'Swcs Application',
            'infowiz_dept_id' => 'Infowiz Dept',
            'dept_application_number' => 'Dept Application Number',
            'app_status' => 'App Status',
            'app_comment' => 'App Comment',
            'transaction_datetime' => 'Transaction Datetime',
            'processed_by_role_id' => 'Processed By Role',
            'processed_by_role_name' => 'Processed By Role Name',
            'processed_by_role_user_mobile_number' => 'Processed By Role User Mobile Number',
            'processed_by_role_user_email' => 'Processed By Role User Email',
            'next_role_id' => 'Next Role',
            'next_role_user_name' => 'Next Role User Name',
            'next_role_user_mobile_number' => 'Next Role User Mobile Number',
            'next_role_user_email' => 'Next Role User Email',
            'payment_amount' => 'Payment Amount',
            'payment_mode' => 'Payment Mode',
            'payment_datetime' => 'Payment Datetime',
            'user_agent' => 'User Agent',
            'remote_server' => 'Remote Server',
            'payment_reference_number' => 'Payment Reference Number',
            'created' => 'Created',
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

        $criteria->compare('app_transaction_id',$this->app_transaction_id);
        $criteria->compare('swcs_application_id',$this->swcs_application_id);
        $criteria->compare('infowiz_dept_id',$this->infowiz_dept_id);
        $criteria->compare('dept_application_number',$this->dept_application_number,true);
        $criteria->compare('app_status',$this->app_status,true);
        $criteria->compare('app_comment',$this->app_comment,true);
        $criteria->compare('transaction_datetime',$this->transaction_datetime,true);
        $criteria->compare('processed_by_role_id',$this->processed_by_role_id);
        $criteria->compare('processed_by_role_name',$this->processed_by_role_name,true);
        $criteria->compare('processed_by_role_user_mobile_number',$this->processed_by_role_user_mobile_number,true);
        $criteria->compare('processed_by_role_user_email',$this->processed_by_role_user_email,true);
        $criteria->compare('next_role_id',$this->next_role_id);
        $criteria->compare('next_role_user_name',$this->next_role_user_name,true);
        $criteria->compare('next_role_user_mobile_number',$this->next_role_user_mobile_number,true);
        $criteria->compare('next_role_user_email',$this->next_role_user_email,true);
        $criteria->compare('payment_amount',$this->payment_amount,true);
        $criteria->compare('payment_mode',$this->payment_mode,true);
        $criteria->compare('payment_datetime',$this->payment_datetime,true);
        $criteria->compare('user_agent',$this->user_agent,true);
        $criteria->compare('remote_server',$this->remote_server,true);
        $criteria->compare('payment_reference_number',$this->payment_reference_number,true);
        $criteria->compare('created',$this->created,true);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return DeptServiceApplicationHistory the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
}