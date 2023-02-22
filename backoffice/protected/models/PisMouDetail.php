<?php

/**
 * This is the model class for table "du_pis_mou_detail".
 *
 * The followings are the available columns in table 'du_pis_mou_detail':
 * @property integer $id
 * @property integer $pis_mou_parent_id
 * @property integer $type
 * @property integer $sector_detail
 * @property double $proposed_investment_type
 * @property double $proposed_investment
 * @property integer $proposed_employment
 * @property string $is_active
 * @property integer $created
 * @property integer $modified
 *
 * The followings are the available model relations:
 * @property DuPisMouUpload $pisMouParent
 */
class PisMouDetail extends CActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'du_pis_mou_detail';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('pis_mou_parent_id, type, proposed_investment_type, proposed_investment, proposed_employment', 'required'),
            array('id, pis_mou_parent_id,   proposed_employment', 'numerical', 'integerOnly'=>true),
          array('proposed_investment_type', 'length', 'max'=>5),
            array('is_active', 'length', 'max'=>4),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, pis_mou_parent_id,dept_user_id,mrn_sub_number, type, sector1, proposed_investment_type, proposed_investment, proposed_employment,project_detail,proposed_location,proposed_commencement_date, is_active, created, modified', 'safe', 'on'=>'search'),
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
            'pisMouParent' => array(self::BELONGS_TO, 'DuPisMouUpload', 'pis_mou_parent_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'pis_mou_parent_id' => 'Pis Mou Parent',
            'type' => 'Type',
            'sector1' => 'Sector 1',
            'sector2' => 'Sector 2',
            'proposed_investment_type' => 'Rs In',
            'proposed_investment' => 'Proposed Investment',
            'proposed_employment' => 'Proposed Employment',
            'is_active' => 'Is Active',
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

        $criteria->compare('id',$this->id);
        $criteria->compare('pis_mou_parent_id',$this->pis_mou_parent_id);
		$criteria->compare('dept_user_id',$this->dept_user_id);
        $criteria->compare('type',$this->type);
        //$criteria->compare('sector_detail',$this->sector_detail);
        $criteria->compare('proposed_investment_type',$this->proposed_investment_type);
        $criteria->compare('proposed_investment',$this->proposed_investment);
        $criteria->compare('proposed_employment',$this->proposed_employment);
        $criteria->compare('is_active',$this->is_active,true);
        $criteria->compare('created',$this->created);
        $criteria->compare('modified',$this->modified);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return PisMouDetail the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
}