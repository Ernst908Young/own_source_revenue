<?php

/**
 * This is the model class for table "bo_caf_templates".
 *
 * The followings are the available columns in table 'bo_caf_templates':
 * @property integer $id
 * @property string $dept_id
 * @property string $role_id
 * @property string $is_active
 * @property string $created
 *
 * The followings are the available model relations:
 * @property Departments $dept
 * @property Roles $role
 */
class CafTemplates extends CActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'bo_caf_templates';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('dept_id, role_id, is_active, template', 'required'),
            array('dept_id', 'length', 'max'=>11),
            array('role_id', 'length', 'max'=>10),
            array('is_active', 'length', 'max'=>1),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, dept_id, role_id, is_active, template', 'safe', 'on'=>'search'),
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
            'dept' => array(self::BELONGS_TO, 'Departments', 'dept_id'),
            'role' => array(self::BELONGS_TO, 'Roles', 'role_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'dept_id' => 'Dept',
            'role_id' => 'Role',
            'is_active' => 'Is Active',
            'template' => 'Template',
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
        $criteria->compare('dept_id',$this->dept_id,true);
        $criteria->compare('role_id',$this->role_id,true);
        $criteria->compare('is_active',$this->is_active,true);
        $criteria->compare('template',$this->created,true);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return CafTemplates the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
}