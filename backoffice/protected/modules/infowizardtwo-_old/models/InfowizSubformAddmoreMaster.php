<?php

/**
 * This is the model class for table "bo_infowiz_subform_addmore_master".
 *
 * The followings are the available columns in table 'bo_infowiz_subform_addmore_master':
 * @property integer $id
 * @property integer $page_id
 * @property integer $button_id
 * @property integer $selected_field_id
 * @property string $is_active
 * @property string $create_at
 */
class InfowizSubformAddmoreMaster extends CActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'bo_infowiz_subform_addmore_master';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('page_id, button_id, selected_field_id, is_active,service_id, create_at', 'required'),
            array('page_id, button_id, selected_field_id', 'numerical', 'integerOnly'=>true),
            array('is_active', 'length', 'max'=>1),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, page_id, button_id, selected_field_id, is_active,service_id, create_at,updated_at', 'safe', 'on'=>'search'),
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
            'page_id' => 'Page',
            'button_id' => 'Button',
            'selected_field_id' => 'Selected Field',
            'is_active' => 'Is Active',
            'service_id'=>'Service Id',
            'create_at' => 'Create At',
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
        $criteria->compare('page_id',$this->page_id);
        $criteria->compare('button_id',$this->button_id);
        $criteria->compare('selected_field_id',$this->selected_field_id);
        $criteria->compare('is_active',$this->is_active,true);
        $criteria->compare('create_at',$this->create_at,true);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return InfowizSubformAddmoreMaster the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
}