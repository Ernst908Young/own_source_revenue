<?php

/**
 * This is the model class for table "bo_sp_applications_map".
 *
 * The followings are the available columns in table 'bo_sp_applications_map':
 * @property integer $sno
 * @property string $sp_tag
 * @property integer $sp_app_id
 * @property string $app_id
 * @property string $app_name
 * @property string $app_fields
 * @property string $app_status
 * @property string $app_comments
 * @property string $app_distt
 * @property string $app_distt_name
 * @property string $app_location
 * @property string $is_applied_by_caf
 * @property integer $caf_id
 * @property string $unit_name
 * @property string $reverted_call_back_url
 * @property string $print_app_call_back_url
 * @property string $download_certificate_call_back_url
 * @property integer $user_id
 * @property string $created_on
 * @property string $updated_on
 * @property string $is_active
 * @property string $remote_server
 * @property string $user_agent
 * @property string $param_1
 * @property string $param_2
 * @property string $param_3
 * @property string $param_4
 * @property string $param_5
 * @property string $is_offline_application
 * @property string $offline_application_id
 * @property string $timeline_ref
 * @property integer $noe
 * @property string $infowiz_service_id
 * @property string $created_date_time
 * @property string $last_updated_date_time
 *
 * The followings are the available model relations:
 * @property SpApplicationHistoryMap[] $spApplicationHistoryMaps
 */
class SpApplicationsMap extends CActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'bo_sp_applications_map';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('sp_tag, sp_app_id, app_id, app_name, app_fields, app_status, app_comments, app_distt,  app_location,  unit_name,  print_app_call_back_url, user_id, created_on, updated_on', 'required'),
            array('sp_app_id, caf_id, user_id, noe', 'numerical', 'integerOnly'=>true),
            array('sp_tag, app_name, unit_name, remote_server, user_agent', 'length', 'max'=>255),
            array('app_id, param_1', 'length', 'max'=>20),
            array('app_status', 'length', 'max'=>3),
            array('app_distt, param_2, param_3, param_4, param_5,is_applied_by_caf', 'length', 'max'=>200),
            array('app_distt_name, app_location', 'length', 'max'=>150),
            array('is_active, is_offline_application,is_applied_by_sw', 'length', 'max'=>1),
            array('offline_application_id', 'length', 'max'=>11),
            array('timeline_ref', 'length', 'max'=>100),
            array('infowiz_service_id', 'length', 'max'=>10),
            array('created_date_time, last_updated_date_time', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('sno, sp_tag, sp_app_id, app_id, app_name, app_fields, app_status, app_comments, app_distt, app_distt_name, app_location,is_applied_by_sw, is_applied_by_caf, caf_id, unit_name, reverted_call_back_url, print_app_call_back_url, download_certificate_call_back_url, user_id, created_on, updated_on, is_active, remote_server, user_agent, param_1, param_2, param_3, param_4, param_5, is_offline_application, offline_application_id, timeline_ref, noe, infowiz_service_id, created_date_time, last_updated_date_time', 'safe', 'on'=>'search'),
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
            'spApplicationHistoryMaps' => array(self::HAS_MANY, 'SpApplicationHistoryMap', 'sp_app_id'),
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
            'sp_app_id' => 'Sp App',
            'app_id' => 'App',
            'app_name' => 'App Name',
            'app_fields' => 'App Fields',
            'app_status' => 'App Status',
            'app_comments' => 'App Comments',
            'app_distt' => 'App Distt',
            'app_distt_name' => 'App Distt Name',
            'app_location' => 'App Location',
            'is_applied_by_caf' => 'Is Applied By Caf',
            'is_applied_by_sw' => 'Is Applied By SW',
            'caf_id' => 'Caf',
            'unit_name' => 'Unit Name',
            'reverted_call_back_url' => 'Reverted Call Back Url',
            'print_app_call_back_url' => 'Print App Call Back Url',
            'download_certificate_call_back_url' => 'Download Certificate Call Back Url',
            'user_id' => 'User',
            'created_on' => 'Created On',
            'updated_on' => 'Updated On',
            'is_active' => 'Is Active',
            'remote_server' => 'Remote Server',
            'user_agent' => 'User Agent',
            'param_1' => 'Param 1',
            'param_2' => 'Param 2',
            'param_3' => 'Param 3',
            'param_4' => 'Param 4',
            'param_5' => 'Param 5',
            'is_offline_application' => 'Is Offline Application',
            'offline_application_id' => 'Offline Application',
            'timeline_ref' => 'Timeline Ref',
            'noe' => 'Noe',
            'infowiz_service_id' => 'Infowiz Service',
            'created_date_time' => 'Created Date Time',
            'last_updated_date_time' => 'Last Updated Date Time',
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
        $criteria->compare('sp_app_id',$this->sp_app_id);
        $criteria->compare('app_id',$this->app_id,true);
        $criteria->compare('app_name',$this->app_name,true);
        $criteria->compare('app_fields',$this->app_fields,true);
        $criteria->compare('app_status',$this->app_status,true);
        $criteria->compare('app_comments',$this->app_comments,true);
        $criteria->compare('app_distt',$this->app_distt,true);
        $criteria->compare('app_distt_name',$this->app_distt_name,true);
        $criteria->compare('app_location',$this->app_location,true);
        $criteria->compare('is_applied_by_sw',$this->is_applied_by_sw,true);
        $criteria->compare('is_applied_by_caf',$this->is_applied_by_caf,true);
        $criteria->compare('caf_id',$this->caf_id);
        $criteria->compare('unit_name',$this->unit_name,true);
        $criteria->compare('reverted_call_back_url',$this->reverted_call_back_url,true);
        $criteria->compare('print_app_call_back_url',$this->print_app_call_back_url,true);
        $criteria->compare('download_certificate_call_back_url',$this->download_certificate_call_back_url,true);
        $criteria->compare('user_id',$this->user_id);
        $criteria->compare('created_on',$this->created_on,true);
        $criteria->compare('updated_on',$this->updated_on,true);
        $criteria->compare('is_active',$this->is_active,true);
        $criteria->compare('remote_server',$this->remote_server,true);
        $criteria->compare('user_agent',$this->user_agent,true);
        $criteria->compare('param_1',$this->param_1,true);
        $criteria->compare('param_2',$this->param_2,true);
        $criteria->compare('param_3',$this->param_3,true);
        $criteria->compare('param_4',$this->param_4,true);
        $criteria->compare('param_5',$this->param_5,true);
        $criteria->compare('is_offline_application',$this->is_offline_application,true);
        $criteria->compare('offline_application_id',$this->offline_application_id,true);
        $criteria->compare('timeline_ref',$this->timeline_ref,true);
        $criteria->compare('noe',$this->noe);
        $criteria->compare('infowiz_service_id',$this->infowiz_service_id,true);
        $criteria->compare('created_date_time',$this->created_date_time,true);
        $criteria->compare('last_updated_date_time',$this->last_updated_date_time,true);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return SpApplicationsMap the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
}