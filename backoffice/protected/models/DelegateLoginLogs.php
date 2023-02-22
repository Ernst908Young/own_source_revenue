<?php

/**
 * This is the model class for table "bo_delegate_login_logs".
 *
 * The followings are the available columns in table 'bo_delegate_login_logs':
 * @property integer $id
 * @property string $loggedin_from_mobile_number
 * @property string $notified_to_mobile_number
 * @property string $notified_message
 * @property integer $uid
 * @property integer $role_id
 * @property integer $created
 */
class DelegateLoginLogs extends CActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'bo_delegate_login_logs';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('loggedin_from_mobile_number, notified_to_mobile_number, notified_message, uid, role_id, created', 'required'),
            array('uid, role_id', 'numerical', 'integerOnly'=>true),
            array('loggedin_from_mobile_number, notified_to_mobile_number', 'length', 'max'=>16),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, loggedin_from_mobile_number, notified_to_mobile_number, notified_message, uid, role_id, created', 'safe', 'on'=>'search'),
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
            'loggedin_from_mobile_number' => 'Loggedin From Mobile Number',
            'notified_to_mobile_number' => 'Notified To Mobile Number',
            'notified_message' => 'Notified Message',
            'uid' => 'Uid',
            'role_id' => 'Role',
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

        $criteria->compare('id',$this->id);
        $criteria->compare('loggedin_from_mobile_number',$this->loggedin_from_mobile_number,true);
        $criteria->compare('notified_to_mobile_number',$this->notified_to_mobile_number,true);
        $criteria->compare('notified_message',$this->notified_message,true);
        $criteria->compare('uid',$this->uid);
        $criteria->compare('role_id',$this->role_id);
        $criteria->compare('created',$this->created);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return DelegateLoginLogs the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
}