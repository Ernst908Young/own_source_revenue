<?php

/**
 * This is the model class for table "du_pis_mou_forward_level".
 *
 * The followings are the available columns in table 'du_pis_mou_forward_level':
 * @property integer $id
 * @property integer $pis_mou_parrent_id
 * @property integer $forwarded_by
 * @property integer $assigned_role_id
 * @property integer $department_id
 * @property integer $action_taken_user_id
 * @property string $comment
 * @property string $action
 * @property string $created
 * @property string $action_taken_at
 *
 * The followings are the available model relations:
 * @property BoInfowizardDepartmentMaster $department
 */
class PisMouForwardLevel extends CActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'du_pis_mou_forward_level';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('pis_mou_parrent_id, forwarded_by, assigned_role_id,  created,', 'required'),
            array('pis_mou_parrent_id, forwarded_by, assigned_role_id, department_id, action_taken_user_id', 'numerical', 'integerOnly'=>true),
            array('comment', 'length', 'max'=>255),
            array('action', 'length', 'max'=>35),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, pis_mou_parrent_id, forwarded_by, assigned_role_id, department_id, action_taken_user_id, comment, action, created, action_taken_at', 'safe', 'on'=>'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
     /*   return array(
            'department' => array(self::BELONGS_TO, 'BoInfowizardDepartmentMaster', 'department_id'),
        ); */
    }

    /**
     * @return array customized attribute labels (name=>label 
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'pis_mou_parrent_id' => 'Pis Mou Parrent',
            'forwarded_by' => 'Forwarded By',
            'assigned_role_id' => 'Assigned Role',
            'department_id' => 'Department',
            'action_taken_user_id' => 'Action Taken User',
            'comment' => 'Comment',
            'action' => 'Action',
            'created' => 'Created',
            'action_taken_at' => 'Action Taken Atcrecre',
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
        $criteria->compare('pis_mou_parrent_id',$this->pis_mou_parrent_id);
        $criteria->compare('forwarded_by',$this->forwarded_by);
        $criteria->compare('assigned_role_id',$this->assigned_role_id);
        $criteria->compare('department_id',$this->department_id);
        $criteria->compare('action_taken_user_id',$this->action_taken_user_id);
        $criteria->compare('comment',$this->comment,true);
        $criteria->compare('action',$this->action,true);
        $criteria->compare('created',$this->created,true);
        $criteria->compare('action_taken_at',$this->action_taken_at,true);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return PisMouForwardLevel the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
}